<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'import';
		$data['template'] = 'import/backend/import/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function excel($page = 1){
		$data['script'] = 'import';
		$data['template'] = 'import/backend/import/excel';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		$data['moduleDetail']['code'] = CODE_IMPORT.str_pad(($this->common->last_id('import') +1 ), 4, '0', STR_PAD_LEFT);
		$data['script'] = 'import';
		$data['template'] = 'import/backend/import/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	

	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'import/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'select' => 'id,code,supplierid,note,data_json,created, date_start',
				'query' => 'trash = 0',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		$moduleDetail = $moduleDetail['data']['list'];
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
			redirect('import/backend/import/view');
		}
		$moduleDetail['rela'] = json_decode(base64_decode($moduleDetail['data_json']), true);
		$data['moduleDetail'] = $moduleDetail;
		$data['script'] = 'import';
		$data['template'] = 'import/backend/import/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
}
