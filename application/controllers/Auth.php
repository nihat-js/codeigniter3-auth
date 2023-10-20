<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


	/**
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}


	public function index()
	{
		$this->load->view('auth');
	}


	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			exit;
		}


		$firstName = trim($this->input->post("firstName"));
		$lastName = trim($this->input->post("lastName"));
		$email = trim($this->input->post("email"));
		$password = $this->input->post("password");
		$birthday = $this->input->post("birthday");

		$this->load->model('user');

		$result = $this->user->register($firstName, $lastName, $email, $password, $birthday);

		if (!isset($result["token"])) {
			$this->load->view("auth", $result);
			return false;
		}

//		var_dump($result);

		$this->session->set_userdata($result);
		echo "<script>location.href='/';</script>";


		header("Location /");

	}

	public function login()
	{
		$email = trim($this->input->post("email"));
		$password = $this->input->post("password");
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			exit;
		}

		$this->load->model('user');
		$result = $this->user->login($email, $password);
		var_dump("line68",$result);

		if (!isset($result["token"])) {
			$this->load->view("auth", $result);

		}

		$this->session->set_userdata($result);
		echo "<script>location.href='/';</script>";


	}
	public function logout(){
		$this->session->unset_userdata(["firstname","lastname","email","token"]);
		echo "<script>location.href='/auth';</script>";

//		$this->output->set_header("Location"," \auth\ ");
	}

}
