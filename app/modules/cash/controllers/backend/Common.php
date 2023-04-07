<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
	}

	public function view($page = 1){
		$data['script'] = 'cash_common';
		$data['template'] = 'cash/backend/common/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
}
