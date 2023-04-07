<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['template'] = 'dashboard/backend/home/index';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function statistical(){
		$data['script'] = 'dashboard';
		$data['template'] = 'dashboard/backend/home/statistical';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
