<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Construction extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
	}

	public function view($page = 1){
		$data['script'] = 'construction';
		$data['template'] = 'construction/backend/construction/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		$data['moduleDetail']['code'] = CODE_CONSTRUCTION.str_pad(($this->common->last_id('construction') +1 ), 4, '0', STR_PAD_LEFT);
		$data['script'] = 'construction';
		$data['template'] = 'construction/backend/construction/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'construction/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'select' => 'trash,id,type,fullname,phone,code,date_start,status,userid_charge,note, data_json,type_business,catalogueid,sales_real',
				'query' => 'trash = 0',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		$moduleDetail = $moduleDetail['data']['list'];
		$data['moduleDetail'] = $moduleDetail;
		$data['moduleDetail']['data_json'] = json_decode(base64_decode($moduleDetail['data_json']), true);
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
			redirect('construction/backend/construction/view');
		}
		
		$data['script'] = 'construction';
		$data['template'] = 'construction/backend/construction/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
