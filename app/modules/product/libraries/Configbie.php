<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{

	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'measure', $value = -1){
		$data['usercataList'] = array(
			0 =>  array(
				'title' => 'Phòng kĩ thuật',
				'url' => 'assigned/backend/catalogue/create',
			),
			1 =>  array(
				'title' => 'Phòng kĩ thuật',
				'url' => 'assigned/backend/catalogue/create/25',
			),
		);
		$data['order_by'] = array(
			-1 => '- Sắp xếp theo -',
			'title=ASC' => 'Tiêu đề (A-Z)',
			'title=DESC' => 'Tiêu đề (Z-A)',
			'created=DESC' => 'Ngày tạo (Mới nhất)',
			'created=ASC' => 'Ngày tạo (Cũ nhất)',
			'updated=DESC'=> 'Ngày cập nhật (Mới dần)',
			'updated=ASC' => 'Ngày cập nhật (Cũ dần)',
		);
		$data['order_by_product'] = array(
			-1 => '- Sắp xếp theo -',
			'fullname=ASC' => 'Tiêu đề (A-Z)',
			'fullname=DESC' => 'Tiêu đề (Z-A)',
			'created=DESC' => 'Ngày tạo (Mới nhất)',
			'created=ASC' => 'Ngày tạo (Cũ nhất)',
			'updated=DESC'=> 'Ngày cập nhật (Mới dần)',
			'updated=ASC' => 'Ngày cập nhật (Cũ dần)',
		);
		$data['perpage'] = array(
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
			return (isset($data[$field])) ? $data[$field] : [];
		}
		else{
			return $data[$field][$value];
		}
	}
}
