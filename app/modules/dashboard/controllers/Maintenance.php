<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('dashboard/backend/maintenance/index', isset($data)?$data:NULL);
	}
	
		
}
