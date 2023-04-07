<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repay extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'repay';
		$data['template'] = 'repay/backend/repay/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		$data['moduleDetail']['code'] = CODE_REPAY.str_pad(($this->common->last_id('repay') +1 ), 4, '0', STR_PAD_LEFT);
		$data['script'] = 'repay';
		$data['template'] = 'repay/backend/repay/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	

	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'repay/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'query' => 'trash = 0',
				'select' => 'id,code,supplierid,note,data_json,date_start',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		$moduleDetail = $moduleDetail['data']['list'];
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
			redirect('repay/backend/repay/view');
		}
		$moduleDetail['rela'] = json_decode(base64_decode($moduleDetail['data_json']), true);
		$data['moduleDetail'] = $moduleDetail;
		$data['script'] = 'repay';
		$data['template'] = 'repay/backend/repay/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
}
