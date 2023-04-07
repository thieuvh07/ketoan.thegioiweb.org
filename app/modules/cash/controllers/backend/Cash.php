<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'cash';
		$data['template'] = 'cash/backend/cash/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function detail($page = 1){
		$data['script'] = 'cash_detail';
		$data['isSidebar'] = false;
		$data['template'] = 'cash/backend/cash/detail';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function fillter($page = 1){
		$data['script'] = 'cash_detail';
		$data['isSidebar'] = false;
		$data['template'] = 'cash/backend/cash/fillter';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
