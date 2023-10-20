<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{

		$first_name = $this->session->userdata("user_firstname");
		$last_name = $this->session->userdata("user_lastname");

		$email = $this->session->userdata("user_email");
		$token = $this->session->userdata("user_token");

		if (!$token) {
			header("Location: /auth/");
			return false;
		}


		$this->load->view('home',[
			"first_name" => $first_name,
			"last_name" => $last_name,
			"token" => $token,
			"email" => $email,
		]);
	}
}
