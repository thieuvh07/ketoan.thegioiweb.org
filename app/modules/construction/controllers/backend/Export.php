<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
	}

	public function view($page = 1){
		$data['script'] = 'construction_export';
		$data['template'] = 'construction/backend/export/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'construction/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'query' => 'trash = 0',
				'select' => 'id, code, date_start, data_json, note, created, catalogueid, title_cata, userid_charge,export_note',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		$moduleDetail = $moduleDetail['data']['list'];
		$data['moduleDetail'] = $moduleDetail;
		$data['moduleDetail']['data_json'] = json_decode(base64_decode($moduleDetail['data_json']), true);
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Đơn hàng không tồn tại');
			redirect('construction/backend/export/view');
		}
		
		$data['script'] = 'construction_export';
		$data['template'] = 'construction/backend/export/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
