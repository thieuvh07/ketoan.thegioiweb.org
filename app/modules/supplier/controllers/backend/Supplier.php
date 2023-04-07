<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class supplier extends MY_Controller {

	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	public function view($page = 1){
		$data['script'] = 'supplier';
		$data['template'] = 'supplier/backend/supplier/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function create(){
		$data['moduleDetail']['code'] = CODE_SUPPLIER.str_pad(($this->common->last_id('supplier') +1 ), 4, '0', STR_PAD_LEFT);;
		$data['script']= 'supplier';
		$data['template'] = 'supplier/backend/supplier/create';
		$this->load->view('dashboard/backend/layout/dashboard', ((isset($data)) ? $data : ''));
	}
	public function detail(){
		$data['script']= 'supplier_detail';
		$data['isSidebar'] = false;
		$data['template'] = 'supplier/backend/supplier/detail';
		$this->load->view('dashboard/backend/layout/dashboard', ((isset($data)) ? $data : ''));
	}
	
	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'api/index', 'method' => 'get',
			'data'=>  array(
				'select' => 'id,title,phone,address,code,fax,bank,mst,website,email',
				'where' => array('id' => $id),
				'query' => 'trash = 0',
				'table' => 'supplier as tb1',
				'flag' => false,
			),
		));
		$moduleDetail = json_decode($moduleDetail, true);
		$data['moduleDetail'] = $moduleDetail;
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Nhóm sản phẩm không tồn tại');
			redirect('supplier/backend/supplier/view');
		}
		
		$data['script'] = 'supplier';
		$data['template'] = 'supplier/backend/supplier/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
