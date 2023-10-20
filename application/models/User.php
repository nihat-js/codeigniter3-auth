<?php

class User extends CI_Model
{
	private $firstName;
	private $lastName;
	private $birthday;
	private $email;
	public $password;
	private $createdAt;
	private $updatedAt;


	public function __construct()
	{
		$fields = array(
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_firstname' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
			),
			'user_lastname' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
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
			'user_birthday' => array(
				'type' => 'DATE',
			),
			'user_token' => array(
				'type' => "VARCHAR",
				'constraint' => 255,
			),
			'user_created_at' => array(
				'type' => 'INT',
			),
			'user_updated_at' => array(
				'type' => 'INT'
			),


		);
		$this->load->dbforge();
//		$this->dbforge->create_database('flup', TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('users', TRUE);
	}

	private function validateBasic()
	{
		$errors = [];
		if (strlen($this->firstName) < 2) {
			$errors['username'] = "First Name  shouldn't be less than 2 characters";
		}
		if (strlen($this->lastName) < 2) {
			$errors['lastName'] = "Last name shouldn't be less than 2 characters";
		}
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$errors["email_err"] = "Invalid email format";
		}

		if (strlen($this->password) < 6) {
			$errors['password'] = "Password  shouldn't be less than 6 characters";
		}

		return $errors;
	}

	public function login($email, $password)
	{

		$error = [];
		$query = $this->db->select(["user_id", "user_firstname", "user_lastname", "user_email", "user_password", "user_token"])->limit("1")->where('user_email', $email)->get("users");
		$row = (array)$query->row();
		if (!isset($row["user_id"])) {
			$error["login_error"] = 'Username doesn\'t  exists';
			return $error;
		}

		$cryted_password = $row["user_password"];

		if (!password_verify($password, $cryted_password)) {
			return ['login_error' => 'Username or password isn\'t correct'];
		}

		return [
			"id" => $row["user_id"],
			"firstname" => $row["user_firstname"],
			"lastname" => $row["user_lastname"],
			"email" => $row["user_email"],
			"token" => $row["user_token"]
		];

	}


	public function register($firstname, $lastname, $email, $password, $birthday)
	{

		$this->firstName = trim($firstname);
		$this->lastName = trim($lastname);
		$this->email = trim($email);
		$this->password = $password;
		$this->birthday = $birthday;
		$errors = $this->validateBasic();
//		var_dump($errors);

		if (count($errors) > 0) return $errors;

		$isEmailInUse= $this->isEmailInUse();
		if ($isEmailInUse){
			return ["register_error"=> "Email already exists. Try forgot password" ];
		}

		$randomToken = $this->generateRandomToken();
		$fields = array(
			"user_firstname" => $firstname,
			"user_lastname" => $lastname,
			"user_email" => $email,
			"user_password" => password_hash($password, PASSWORD_DEFAULT),
			"user_birthday" => $birthday,
			"user_created_at" => time(),
			"user_updated_at" => time(),
			"user_token" => $randomToken,
		);

		$this->load->database();
		$this->db->insert('users', $fields);
		$user_id = $this->db->insert_id();
		return [
			"id" => $user_id,
			"firstname" => $firstname,
			"lastname" => $lastname,
			"email" => $email,
			"token" => $randomToken
		];
	}

	public function generateRandomToken($length = 32)
	{
		return bin2hex(random_bytes($length));
	}

//	private function validateUsername()
//	{
//		$result = $this->db->select("user_username")->where('user_username', $this->username)->limit(1)->get('users');
//
//		if (count($result->row()) > 0) {
//			return array("username_err" => "Username Already exists");
//		}
//		return array();
//	}

	private function isEmailInUse()
	{

		$result = $this->db->select("user_email")->where('user_email', $this->email)->limit(1)->get('users');
		$row = (array)$result->row();
		if (isset($row["user_email"])) {
			return true;
		}
		return false;
	}
}
