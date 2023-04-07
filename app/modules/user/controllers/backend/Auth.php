<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function Login(){
		$this->load->view('user/backend/auth/login', $data ?? '');
	}

	public function Recovery(){
		if(isset($this->auth)) redirect('dashboard/home/index');
		$this->load->view('user/backend/auth/recovery');
	}

	public function Logout(){
		if(isset($this->auth)){
			$this->load->helper('cookie');
			delete_cookie("auth");
		}
		redirect('admin');
	}
}
