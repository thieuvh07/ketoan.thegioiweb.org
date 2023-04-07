<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {
	

	function last_id($module = ''){
		$CI =& get_instance();
		$moduleLast = api_call(array(
			'url'=> 'api/index',
			'method' => 'get',
			'data'=> array(
				'table'=> $module,
				'select'=>'id',
				'order_by'=>'id DESC',
				'flag' => false,
			),
		));
		$moduleLast = json_decode($moduleLast, true);
		if(!isset($moduleLast) || !check_array($moduleLast) ){
		    return 0;
		}else{
			return $moduleLast['id'];
		}

	}


}
