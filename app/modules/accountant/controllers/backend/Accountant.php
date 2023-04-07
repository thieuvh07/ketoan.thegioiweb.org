<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountant extends MY_Controller {
	public $module;
	function __construct() {
        parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == false || count($this->auth) == 0) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	public function view($page = 1){
		$data['script'] = 'accountant';
		$data['template'] = 'accountant/backend/accountant/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
