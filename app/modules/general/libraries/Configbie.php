<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{

	function __construct($params = NULL){
		$this->params = $params;
	}

	// meta_title là 1 row -> seo_meta_title
	// contact_address
	// chưa có thì insert
	// có thì update
	public function system(){
		$data['office'] =  array(
			'label' => '',
			'description' => 'Lương kinh doanh',
			'value' => array(
				'arrayPercentCT' => array('type' => 'text', 'label' => 'phần trăm lợi nhuận từ KDCT (truyền vào dạng 0,0.1,50000000,0.12,100000000,0.14,150000000,0.16)'),
				'percentVP' => array('type' => 'text', 'label' => 'phần trăm lợi nhuận từ KDVP(số phần trăm: 0.16))'),
				
			),
		);

		$data['work'] =  array(
			'label' => '',
			'description' => 'Lương thợ',
			'value' => array(
				'arrayPercentCT' => array('type' => 'text', 'label' => 'phần trăm lợi nhuận từ Công trình (truyền vào dạng 0,0.8,30000000,0.81,35000000,0.82,40000000,0.83,45000000,0.84,50000000,0.85)'),
				'percentLG' => array('type' => 'text', 'label' => 'phần trăm lợi nhuận từ Logo(số phần trăm: 0.6))'),
				
			),
		);

		$data['design'] =  array(
			'label' => '',
			'description' => 'Lương thiết kế',
			'value' => array(
				'percentVP' => array('type' => 'text', 'label' => 'phần trăm lợi nhuận từ KDVP(số phần trăm: 0.06))'),
				'percentCT' => array('type' => 'text', 'label' => 'phần trăm công thợ từ Công trình(số phần trăm: 0.8))'),
				// 'percentLG' => array('type' => 'text', 'label' => 'phần trăm công thợ từ Logo(số phần trăm: 1))'),
			),
		);
		// $data['woker_outside'] =  array(
		// 	'label' => '',
		// 	'description' => 'Lương thợ ngoài',
		// 	'value' => array(
		// 		'percentCT' => array('type' => 'text', 'label' => 'phần trăm công thợ từ Công trình(số phần trăm: 1))'),
		// 		'percentLG' => array('type' => 'text', 'label' => 'phần trăm công thợ từ logo(số phần trăm: 1))'),
		// 	),
		// );
		return $data;
	}
}
