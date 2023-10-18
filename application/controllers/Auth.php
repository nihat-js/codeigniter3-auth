<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	/**
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
    $this->load->view('auth');


	}
  
  public function login(){
    $this->load->model('user');
    // $this->user->();

    // echo $this->input->post("email");
  }
  public function register(){
    $username = $this->input->post("username");
    $email = $this->input->post("email");
    $password = $this->input->post("password");

    $this->load->model('user');
    $result = $this->user->register($username,$email,$password);
    if ( count($result) > 0 ){
      $this->load->view("auth",$result);
    }

  }

}
