<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{

	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'process', $value = -1){
		$data['usercataList'] = array(
			0 => array(
				'title' => 'Ban giám đốc',
				'url' => 'assigned/backend/catalogue/create',
			),
			1 => array(
				'title' => 'Phòng kĩ thuật',
				'url' => 'assigned/backend/catalogue/create/25',
			),
		);
		$data['perpage'] = array(
			20 => '20 bản ghi',
			30 => '30 bản ghi',
			40 => '40 bản ghi',
			50 => '50 bản ghi',
			60 => '60 bản ghi',
			70 => '70 bản ghi',
			80 => '80 bản ghi',
			90 => '90 bản ghi',
			100 => '100 bản ghi',
		);
		if($value == -1){
			return $data[$field];
		}else{
			return $data[$field][$value];
		}
	}
}
