<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public $module;
	function __construct() {
		parent::__construct();
		$this->load->library(array('configbie'));
		// if(!isset($this->auth)) redirect('admin');
		$this->load->library('nestedsetbie', array('table' => 'user'));
	}

	public function view($page = 1){
		$data['script'] = 'user';
		$data['template'] = 'user/backend/user/view';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function create(){
		$data['permission'] = $this->get_permission_all();
		
		$data['script'] = 'user';
		$data['template'] = 'user/backend/user/create';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}

	public function update($id = 0){
		// $this->commonbie->permission("user/backend/user/update", $this->auth['permission']);
		$id = (int)$id;
		$moduleDetail = api_call(array(
			'url'=> 'user/'.$id, 'method' => 'get',
			'uri'=>  convert_uri(array(
				'query' => 'trash = 0',
				'select' => 'id, catalogue, account, fullname, email, birthday, avatar, gender, address, phone, cityid, districtid, wardid, description, permission',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);
		$moduleDetail = $moduleDetail['data']['list'];
		$data['moduleDetail'] = $moduleDetail;
		if(!isset($moduleDetail) || !check_array($moduleDetail)){
			$this->session->set_flashdata('message-danger', 'Tài khoản nhận sự không tồn tại');
			redirect('user/backend/user/view');
		}
		
		$data['permission'] = $this->get_permission_all();
		$data['permissionPost'] = $this->input->post('permission');
		if(!isset($data['permissionPost']) || !check_array($data['permissionPost'])){
			$permissionActive = !empty($moduleDetail['permission']) ? $moduleDetail['permission'] : $moduleDetail['permission']  ;
			$data['permissionPost']  = json_decode($permissionActive);
		}
		$data['script'] = 'user';
		$data['template'] = 'user/backend/user/update';
		$this->load->view('dashboard/backend/layout/dashboard', isset($data)?$data:NULL);
	}
	

	protected function get_permission_all(){
		$dir = 'app/modules';
		$folder = scandir($dir);
		$permission = [];
		if(isset($folder) && check_array($folder)){
			foreach($folder as $keyFolder=> $valFolder){
				if(in_array($valFolder, array('.', '..'))) continue;
				if(!file_exists($dir.'/'.$valFolder.'/config.xml')) continue;

				$xml = simplexml_load_file($dir.'/'.$valFolder.'/config.xml') or die('Error: Cannot create object '.$dir.'/'.$valFolder.'/config.xml');
				$xml = json_decode(json_encode((array)$xml), TRUE);
				$permission = array_merge($xml['permissions'], $permission);
			}
		}
		return $permission;
	}
}
