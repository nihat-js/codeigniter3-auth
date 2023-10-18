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

    // create table
    $this->dbforge->create_table('users', TRUE);
  }

  public function  check_login()
  {
    $query = $this->db->get('users', 10);
    print_r($query);
    // return $query->result();
  }



  public function register($username, $email, $password)
  {

    $username = trim($username);
    $email = trim($email);
    if (strlen($username) < 5) {
      return false;
    }
    if (strlen($email) < 5) {
      return false;
    }
    if (strlen($password) < 5) {
      return false;
    }

    $result = $this->db->select("username")->where('id', $username)->limit(1)->get('users');

    if ($result){
      return  array(
        "hasError" => "true", 
        "field" => "username",
        "message" => "Username Already exists",
      );
    }

    // $this->username = $username;
    // $this->email = $email;
    // $this->password = $password;
    // $this->createdAt = time();

    $fields = array(
      "user_username" => $username,
      "user_email" => $email,
      "user_password" => $password,
      "user_created_at" => time(),
      "user_updated_at" => time()
    );

    $this->load->database();
    $this->db->insert('users', $fields);
  }
}
