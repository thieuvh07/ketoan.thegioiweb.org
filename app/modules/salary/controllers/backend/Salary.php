<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends MY_Controller {
	public $module;
	function __construct() {
        parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == false || count($this->auth) == 0) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	public function view($page = 1){
		$data['script'] = 'salary';
		$data['template'] = 'salary/backend/salary/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function view_worker($page = 1){
		$data['isSidebar'] = false;
		$data['script'] = 'salary_worker';
		$data['template'] = 'salary/backend/salary/view_worker';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function detail_worker($page = 1){
		$data['isSidebar'] = false;
		$data['script'] = 'salary_detail_worker';
		$data['template'] = 'salary/backend/salary/detail_worker';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function detail_office($page = 1){
		$data['isSidebar'] = false;
		$data['script'] = 'salary_detail_office';
		$data['template'] = 'salary/backend/salary/detail_office';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function BCTH($page = 1){
		$data['script'] = 'salary_BCTH';
		$data['template'] = 'salary/backend/salary/BCTH';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function timekeeping($page = 1){
		$data['script'] = 'salary_timekeeping';
		$data['template'] = 'salary/backend/salary/timekeeping';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
