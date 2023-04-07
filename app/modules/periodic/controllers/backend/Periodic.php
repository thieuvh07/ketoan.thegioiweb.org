<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodic extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'periodic';
		$data['template'] = 'periodic/backend/periodic/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}