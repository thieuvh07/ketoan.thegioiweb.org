<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'product';
		$data['template'] = 'product/backend/product/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		$data['moduleDetail']['code'] = CODE_PRODUCT.str_pad(($this->common->last_id('product') +1 ), 4, '0', STR_PAD_LEFT);
		$data['script'] = 'product';
		$data['template'] = 'product/backend/product/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function createMulti(){
		$data['script'] = 'product';
		$data['template'] = 'product/backend/product/createMulti';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	public function month(){
		$data['script'] = 'product_month';
		$data['template'] = 'product/backend/product/month';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function update($id = 0){
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'product/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'query' => 'trash = 0',
				'select' => 'id, title,code ,price_input, price_output, catalogueid, supplierid, image, quantity_opening_stock, measure',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		$moduleDetail = $moduleDetail['data']['list'];
		$data['moduleDetail'] = $moduleDetail;
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Sản phẩm không tồn tại');
			redirect('product/backend/product/view');
		}
		
		$data['script'] = 'product';
		$data['template'] = 'product/backend/product/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	

	
}
