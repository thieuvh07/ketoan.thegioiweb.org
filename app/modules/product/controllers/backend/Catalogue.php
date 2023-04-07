<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends MY_Controller {

	function __construct() {
		parent::__construct();
		if(!isset($this->auth) || is_array($this->auth) == FALSE || count($this->auth) == 0 ) redirect(BACKEND_DIRECTORY);
		$this->load->library(array('configbie'));
	}
	public function view($page = 1){
		$data['script'] = 'product_catalogue';
		$data['template'] = 'product/backend/catalogue/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	
	public function create(){
		$data['script']= 'product_catalogue';
		$data['template'] = 'product/backend/catalogue/create';
		$this->load->view('dashboard/backend/layout/dashboard', ((isset($data)) ? $data : ''));
	}
	
	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'api/index', 'method' => 'get',
			'data'=>  array(
				'select' => 'id, title, publish, description',
				'where' => array('id' => $id),
				'query' => 'trash = 0',
				'table' => 'product_catalogue as tb1',
				'flag' => false,
			),
		));
		$moduleDetail = json_decode($moduleDetail, true);
		$data['moduleDetail'] = $moduleDetail;
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Nhóm sản phẩm không tồn tại');
			redirect('product/backend/catalogue/view');
		}
		
		$data['script'] = 'product_catalogue';
		$data['template'] = 'product/backend/catalogue/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
}
