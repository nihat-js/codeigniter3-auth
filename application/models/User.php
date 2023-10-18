<?php

class User extends CI_Model
{

  public $username;
  public $email;
  public $password;
  public $createdAt;
  public $updatedAt;

  

  public function __construct()
  {
    $fields = array(
      'user_id' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'user_username' => array(
        'type' => 'VARCHAR',
        'constraint' => 30,
        'unique' => TRUE,
      ),
      'user_email' => array(
        'type' => 'VARCHAR',
        'constraint' => 255,
        "unique" => TRUE,
      ),
      'user_password' => array(
        'type' => 'VARCHAR',
        'constraint' => 255,
      ),
      'user_created_at' => array(
        'type' => 'INT',
      ),
      'user_updated_at' => array(
        'type' => 'INT'
      )

    );
    $this->load->dbforge();
    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('user_id', TRUE);
    $this->dbforge->create_table('users', TRUE);
  }

  private function validateBasic()
  {
    $result = [];
    if (strlen($this->username) < 6) {
      $result['username_err'] = "Username  shouldn't be less than 6 characters";
    }
    if (strlen($this->password) < 6) {
      $result['password_err'] = "Password  shouldn't be less than 6 characters";
    }
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $result["email_err"] = "Invalid email format";
    }
    return $result;
  }

  public function  check_login($username,$password)
  {
    $query = $this->db->select("user_password")->where('user_username', $username);
    if (count($query->row()) != 1)
    return ['username' => 'Username is not exists ' ];

    $input_password = $query->row()['password'];
    if (!password_verify($input_password,$password)){
      return ['password' => 'Username or password isn\'t correct'];
    }

    return [];
  }




  public function register($username, $email, $password)
  {

    $this->username = trim($username);
    $this->email = trim($email);
    $this->password = $password;

    $result = $this->validateBasic();
    if (count($result) > 0) return $result;

    $result_username = $this->validateUsername();
    $result_email = $this->validateEmail();

    $merged_result = array_merge($result_username,$email);
    
    if (count($merged_result) > 0) return $merged_result; 

    $fields = array(
      "user_username" => $username,
      "user_email" => $email,
      "user_password" =>  password_hash($password,PASSWORD_DEFAULT),
      "user_created_at" => time(),
      "user_updated_at" => time()
    );

    $this->load->database();
    $this->db->insert('users', $fields);
  }
  private function validateUsername()
  {
    $result = $this->db->select("user_username")->where('user_username', $this->username)->limit(1)->get('users');
    
    if ( count($result->row()) > 0) {
      return  array("username_err" =>"Username Already exists");
    }
    return array();
  }

  private function validateEmail()
  {

    $result = $this->db->select("user_email")->where('user_email', $this->email)->limit(1)->get('users');
    if ($result->row()) {
      return  array("email_err" =>"Email Already exists",);
    }
    return array();
  }
}
