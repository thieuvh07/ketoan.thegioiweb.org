<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends MY_Controller {
	function __construct() {
        parent::__construct();
	}
	public function view(){
		$data['template'] = 'excel/backend/excel/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
