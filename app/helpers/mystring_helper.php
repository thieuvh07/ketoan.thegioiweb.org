<?php
// giá trị truyền vào là mảng product ( YÊU CẦU PHẢI CÓ ID VS QUANTITY_OENING_STOCK)
function quantity_closing_stock($productList = [], $periodicid = ''){
	$CI =& get_instance();

	if(isset($productList) && check_array($productList)){
		if($periodicid == ''){
			$periodicid = $CI->common->last_id('periodic');
		}
		// lấy thời gian trong kì
		$periodic = $CI->autoload_model->_get_where(array(
			'table' => 'periodic',
			'select' => 'date_start, date_end',
			'query' => 'trash = 0 AND id = '.$periodicid,
		));

		if(isset($productList['id'])){
			// lấy ra danh sách số lượng nhập trong kì
			$import_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'import_relationship as tb1',
				'select' =>'sum(tb1.quantity) as quantity, tb1.productid',
				'group_by' => 'tb1.productid',
				'join' => array(array(
					'import as tb2', 'tb2.id = tb1.importid', 'left'
				)),
				'query' => 'tb1.productid = '.$productList['id'].' AND tb1.trash = 0 AND tb2.trash = 0 AND  tb1.created <= "'.$periodic['date_end'].'" AND tb1.created >= "'.$periodic['date_start'].'" ',
			));
			// lấy ra danh sách số lượng trả hàng trong kì
			$repay_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'repay_relationship as tb1',
				'select' =>'sum(tb1.quantity) as quantity, tb1.productid',
				'group_by' => 'tb1.productid',	
				'join' => array(array(
					'repay as tb2', 'tb2.id = tb1.repayid', 'left'
				)),
				'query' => 'tb1.productid = '.$productList['id'].' AND tb1.trash = 0 AND tb2.trash = 0 AND  tb1.created <= "'.$periodic['date_end'].'" AND tb1.created >= "'.$periodic['date_start'].'" ',
			));

			// lấy ra danh sách số lượng xuất
			$construction_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'construction_relationship',
				'select' =>'sum(thucdan) as quantity, productid',
				'group_by' => 'productid',
				'join' => array(array(
					'construction', 'construction.id = construction_relationship.constructionid', 'left'
				)),
				'query' => 'productid = '.$productList['id'].' AND construction.trash = 0 AND construction_relationship.trash = 0 AND date_start <= "'.$periodic['date_end'].'" AND date_start >= "'.$periodic['date_start'].'" ',
			));

			// tiến hành cập nhật lại số lượng quantity_closing_stock
			$productList['quantity_closing_stock'] = $productList['quantity_opening_stock'] ?? 0 + $import_relationship['quantity'] + $repay_relationship['quantity'] - $construction_relationship['quantity'];
			return $productList;
		}else{
			foreach ($productList as $keyPrd => $valPrd) {
				//kiểm tra điều kiện mảng phải có id vs quantity_opening_stock
				if(!isset($valPrd['id'])){
					return $productList;
				}
			}
			// lấy danh sách id sản phẩm 
			$idList = get_colum_in_array($productList, 'id');

			// lấy ra danh sách số lượng nhập trong kì
			$import_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'import_relationship as tb1',
				'select' =>'sum(tb1.quantity) as quantity, tb1.productid',
				'group_by' => 'tb1.productid',
				'where_in' => $idList,
				'where_in_field' => 'tb1.productid',
				'join' => array(array(
					'import as tb2', 'tb2.id = tb1.importid', 'left'
				)),
				'query' => 'tb1.trash = 0 AND tb2.trash = 0 AND  tb1.created <= "'.$periodic['date_end'].'" AND tb1.created >= "'.$periodic['date_start'].'" ',
			), true);

			// lấy ra danh sách số lượng trả hàng trong kì
			$repay_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'repay_relationship as tb1',
				'select' =>'sum(tb1.quantity) as quantity, tb1.productid',
				'group_by' => 'tb1.productid',
				'where_in' => $idList,
				'where_in_field' => 'tb1.productid',
				'join' => array(array(
					'repay as tb2', 'tb2.id = tb1.repayid', 'left'
				)),
				'query' => 'tb1.trash = 0 AND tb2.trash = 0 AND  tb1.created <= "'.$periodic['date_end'].'" AND tb1.created >= "'.$periodic['date_start'].'" ',
			), true);

			// lấy ra danh sách số lượng xuất
			$construction_relationship = $CI->autoload_model->_get_where(array(
				'table' =>'construction_relationship',
				'select' =>'sum(thucdan) as quantity, productid',
				'group_by' => 'productid',
				'where_in' => $idList,
				'where_in_field' => 'productid',
				'join' => array(array(
					'construction', 'construction.id = construction_relationship.constructionid', 'left'
				)),
				'query' => 'construction.trash = 0 AND construction_relationship.trash = 0 AND date_start <= "'.$periodic['date_end'].'" AND date_start >= "'.$periodic['date_start'].'" ',
			), true);

			// tiến hành cập nhật lại số lượng quantity_closing_stock
			foreach ($productList as $keyPrd => $valPrd) {
				// lặp qua từng sản phẩm
				$quantity_change = 0;
				if(isset($import_relationship) && check_array($import_relationship)){
					foreach ($import_relationship as $keyIm => $valIm) {
						if($valIm['productid'] == $valPrd['id']){
							$quantity_change = $quantity_change + $valIm['quantity'];
						}
					}
				}
				if(isset($repay_relationship) && check_array($repay_relationship)){
					foreach ($repay_relationship as $keyRe => $valRe) {
						if($valRe['productid'] == $valPrd['id']){
							$quantity_change = $quantity_change + $valRe['quantity'];
						}
					}
				}
				if(isset($construction_relationship) && check_array($construction_relationship)){
					foreach ($construction_relationship as $keyCon => $valCon) {
						if($valCon['productid'] == $valPrd['id']){
							$quantity_change = $quantity_change - $valCon['quantity'];
						}
					}
				}
				$productList[$keyPrd]['quantity_closing_stock'] = ($valPrd['quantity_opening_stock'] ?? 0) + $quantity_change;
			}
			return $productList;
		}

		
	}else{
		return $productList;
	}
}


if(!function_exists('uploadFile')){
	function uploadFile($path = '', $config = []){
		if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0700, true);
        }
        $config['upload_path'] = $path;
        $config['allowed_types'] =  $config['allowed_types'] ?? 'xls';
        $config['remove_spaces'] = $config['remove_spaces'] ?? TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            pre($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        
        if (!empty($data['upload_data']['file_name'])) {
            $inputFileName = $data['upload_data']['file_name'];
        } else {
            $inputFileName = 0;
        }
        return  $inputFileName;
	}
}



if(!function_exists('convert_serialize')){
	function convert_serialize($data = []){
		if(isset($data) && check_array($data)){
			foreach ($data as $key => $val) {
				$temp[$val['name']] = $val['value'];
		}}
		return $temp ?? [];
	}
}
if(!function_exists('convert_uri')){
	function convert_uri($param){
		$str = '';
		if(isset($param['select'])){
			$param['select'] = preg_replace('/\s+/', '', $param['select']);
			$str = 'fields='.$param['select'].'&';
			unset($param['select']);
		}
		if(isset($param) && check_array($param)){
			$index = 0;
			foreach ($param as $key => $val) {
				if($val != ''){
					$key = preg_replace('/\s+/', '', $key);
					$val = preg_replace('/\s+/', '', $val);
					$str = $str.(($index > 0) ? '&' : '').$key.'='.$val;
					$index ++;
				}
		}}

		return '?'.$str;
	}
}
if(!function_exists('render_query_in_search')){
	function render_query_in_search($param = array()){
		if(isset($param['perpage'])) {unset($param['perpage']);}
		if(isset($param['page'])) {unset($param['page']);}
		$CI =& get_instance();
		$query = '';
		if(isset($param) && check_array($param) ){
		    foreach ($param as $field => $val) {
		    	if(!empty($val)){
					$query = $query.','.$field.'[in]='.$val;
					$isSearchAdvanced = true;
				}
		    }
		}
		$query = substr($query, 1, strlen($query));
		$data = [];
		$data['query'] = $query ?? '';
		$data['isSearchAdvanced'] = $isSearchAdvanced ?? '';
		return $data;
	}
}
if(!function_exists('get_time_of')){
	function get_time_of($date = ''){
		$date = new DateTime('now');

		$date->modify('first day of this month');
		$param['first_day_of_month'] = $date->format('Y-m-d').' 00:00:00';

		$date->modify('last day of this month');
		$param['last_day_of_month'] = $date->format('Y-m-d').' 23:59:59';


		$day = date('w');
		$param['first_day_of_week'] = date('Y-m-d', strtotime('-'.$day.' days')).' 00:00:00';
		$param['last_day_of_week'] = date('Y-m-d', strtotime('+'.(6-$day).' days')).' 23:59:59';

		$day = date('Y-m-d', time());
		$param['first_day_of_day'] = $day.' 00:00:00';
		$param['last_day_of_day'] = $day.' 23:59:59';
	    return $param;
	}
}

if(!function_exists('sort_by_subkey')){
	function sort_by_subkey(&$array, $subkey, $sortType = SORT_ASC) {
	    foreach ($array as $subarray) {
	        $keys[] = $subarray[$subkey];
	    }
	    array_multisort($keys, $sortType, $array);
	    return $array ;
	}
}

if(!function_exists('convert_time')){
	function convert_time($time = '', $type = '-'){
		if($time == ''){
			return '0000-00-00 00:00:00';
		};
		$time = str_replace( '/', '-', $time );
		$current = explode('-', $time);
		$time_stamp = $current[2].'-'.$current[1].'-'.$current[0].' 00:00:00';
		return $time_stamp;
	}
}
if(!function_exists('convert_obj_to_array')){
	function convert_obj_to_array($obj, &$arr = '') {
		$arr = [];
	    if(!is_object($obj) && !is_array($obj)){
	        $arr = $obj;
	        return $arr;
	    }
	    foreach ($obj as $key => $val){
	        if (!empty($val)){

	            $arr[$key] = array();
	            convert_obj_to_array($val, $arr[$key]);
	        }else{
	            $arr[$key] = $val;
	        }
	    }
	    return $arr;
	}
}
if(!function_exists('api_call')){
	function api_call($param){
		$CI =& get_instance();

		$url = $param['url'] ?? '';
		$method = $param['method'] ?? 'post';
		$data = $param['data'] ?? [];
		$uri = $param['uri'] ?? '';
		// $content['SERVER_NAME'] = $_SERVER['SERVER_NAME'];
		// // kiẻm tra xem có file token json chưa
	 //    if(file_exists(TOKEN_PATH)){
	 //        $accessToken = json_decode(file_get_contents(TOKEN_PATH), true);
	 //    }
		// // gửi file token json
		// $content['accessToken'] = $accessToken ?? '';

		if(!empty($url)){
			// $CI->benchmark->mark($url.'_start');
			$CI->load->library('rest', array(
		        'server' => api_url(),
		        'http_user' => 'admin',
    			'http_pass' => '1234',
		        'http_auth' => 'digest' // basic or 'digest'
		    ));
			// echo $url;
			// $CI->benchmark->mark($url.'_end');
			// echo $CI->benchmark->elapsed_time($url.'_start', $url.'_end').'<br>';
		    switch ($method) {
			    case 'post':
			        return $CI->rest->post($url, $data);
					break;
			    case 'get':
			        return $CI->rest->get($url.$uri, $data);
					break;
			    case 'put':
			        return $CI->rest->put($url.$uri, $data);
					break;
			    case 'delete':
			        return $CI->rest->delete($url, $data);
					break;
			}
		}
	}
}
if(!function_exists('render_userid')){
	function render_userid() : string {
	  	$CI =& get_instance();

	  	$clientid = md5(random(500));
	  	$count = $CI->Autoload_Model->_get_where(array(
			'table' => 'user',
			'where' => array( 'clientid' => $clientid),
			'count' => true,
		));
		if($count > 0){
			render_userid();
		}
		$secretid = render_secretid($clientid);
		return json_encode(array(
			'clientid' => $clientid,
			'secretid' => $secretid,
		));
	}
}
if(!function_exists('render_secretid')){
	function render_secretid($clientid) : string {
	  	$secretid = md5(random(500));
	  	if($secretid == $clientid){
	  		render_secretid($clientid);
	  	}
		return $secretid;
	}
}

if(!function_exists('random')){
	function random($leng = 168, $char = FALSE){
		if($char == FALSE) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for ($i=0; $i<$leng; $i++){
			$salt = $salt . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $salt;
	}
}
if(!function_exists('operator_time')){
	function operator_time($time, $val = 0, $type = 'd', $return = 'd/m/Y'){
		$time = (isset($time)) ? $time : $this->currentTime;
		$data['H'] = 0;
		$data['i'] = 0;
		$data['s'] = 0;
		$data['d'] = 0;
		$data['m'] = 0;
		$data['Y'] = 0;
		$data[$type] = $val;
		$dateint = mktime(gettime($time, 'H') - $data['H'], gettime($time, 'i') - $data['i'], gettime($time, 's') - $data['s'], gettime($time, 'm') - $data['m'], gettime($time, 'd') - $data['d'], gettime($time, 'Y') - $data['Y']);
		return date($return, $dateint); // 02/12/2016
	}
}
if(!function_exists('password_encode')){
	function password_encode($password = '', $salt = ''){
		return md5(md5(md5($password).$salt));
	}
}
// tạo thông báo
if(!function_exists('show_flashdata')){
	function show_flashdata($body = TRUE){;
		$result = [];
		$message = '';
		$CI =& get_instance();
		$message = $CI->session->flashdata('message-success');
		if($message != null){
			// var_dump($message);
			$result['message'] = $message;
			if(isset($message)){
				$result['flag'] = 0;
				return $result;
			}
		}
		$message = $CI->session->flashdata('message-danger');
		if($message != null){
			$result['message'] = $message;
			if(isset($message)){
				$result['flag'] = 1;
			}
		}
		return $result;
	}
}


if(!function_exists('api_url')){
	function api_url($url = ''){
		return API_URL.$url;
	}
}

if(!function_exists('check_array')){
	function check_array($param = ''): bool{
		if(isset($param) && is_array($param) && count($param)){
			return true;
		}else{
			return false;
		}
	}
}
//trả về: sô điện thoại đã thêm khoảng trắng( chỉ tác dụng với sđt có 9 10 số )
//đầu vào:
if(!function_exists('number_phone')){
	function number_phone($number = ''): string{
		$length = strlen($number);
		// return $number = preg_replace("/(.*)(\d{3})(\d{3})(\d{3})$/", "$1 $2 $3 $4", $number);
		if($length == 10){
			$number = preg_replace("/(\d{4})(\d{3})(\d{3})$/", "$1 $2 $3 $4", $number);
		}elseif($length == 9){
			$number = preg_replace("/(\d{3})(\d{3})(\d{3})$/", "$1 $2 $3 $4", $number);
		}
		return $number;
	}
}

//trả về: mảng ko bị trùng lặp các mảng con bên trong( loại trừ trường field)
//đầu vào:
// array(
// 	'0' => array(
// 		'id' => 1,
// 		'name'=> sp1,
// 	),
// 	'1' => array(
// 		'id' => 2,
// 		'name'=> sp2,
// 	)
// )
if(!function_exists('array_unique_subkey')){
	function array_unique_subkey($param = '', $unfield = ''): array{
		if(isset($param) && is_array($param) && count($param)){
			$temp = '';
			foreach ($param as $key => $value) {
				$index = 0;
				$temp = [];
				foreach ($param as $sub => $subs) {
					if( $unfield != '' ){
						unset($value[$unfield]);
						unset($subs[$unfield]);
					}
					if($subs == $value){
						$index =$index + 1;
						if($index >= 2){
							$temp[] = $sub;
						}
					}
				}
				if(isset($temp) && check_array($temp)){
					foreach ($temp as $tempKey => $tempVal) {
						unset($param[$tempVal]);
					}
				}

			}
		}
		return $param ;
	}
}
//trả về: như hàm number_format
//đầu vào: $data
if(!function_exists('addCommas')){
	function addCommas($number = ''): string{
		$number = $number ?? 0;
		if(!empty($number)){
			return number_format($number,'0',',','.');
		}
		return 0;
	}
}
//trả về: chuỗi bị cắt từ 0 tới kí tự thứ n
//đầu vào: $str chuỗi bị cắt, $n cắt bn kí tự
if(!function_exists('cutnchar')){
	function cutnchar($str = '', $n = 320): string{
		$str = trim($str);

		if(strlen($str) < $n) return $str;
		if($n > 3){
			$str = substr($str, 0, $n - 3);
		}else{
			$str = substr($str, 0, $n);
		}
		return $str.'...';
	}
}


if(!function_exists('gettime')){
	function gettime($time, $type = 'H:i - d/m/Y'){
		if($time == '0000-00-00 00:00:00'){
			return false;
		}
		return gmdate($type, strtotime($time) + 7*3600);
	}
}
if(!function_exists('pre')){
	function pre($list, $exit = 'die'){
	    echo "<pre>";
	    print_r($list);
	    if($exit == 'die')
	    {
	        die();
	    }
	}
}

if(!function_exists('getthumb')){
	function getthumb($image = '' , $thumb = TRUE){
		$image = !empty($image) ? $image :  IMG_NOT_FOUND;
		if(!file_exists(dirname(dirname(dirname(__FILE__))).$image) ){
			$image = IMG_NOT_FOUND;
		}
		if($thumb == TRUE){
			$image_thumb = str_replace(SRC_IMG, SRC_THUMB, $image);
			if (file_exists(dirname(dirname(dirname(__FILE__))).$image_thumb)){
				return $image_thumb;
			}
		}
		return $image;
	}
}




if(!function_exists('removeutf8')){
	function removeutf8($value = NULL){
		$chars = array(
			'a'	=>	array('ấ','ầ','ẩ','ẫ','ậ','Ấ','Ầ','Ẩ','Ẫ','Ậ','ắ','ằ','ẳ','ẵ','ặ','Ắ','Ằ','Ẳ','Ẵ','Ặ','á','à','ả','ã','ạ','â','ă','Á','À','Ả','Ã','Ạ','Â','Ă'),
			'e' =>	array('ế','ề','ể','ễ','ệ','Ế','Ề','Ể','Ễ','Ệ','é','è','ẻ','ẽ','ẹ','ê','É','È','Ẻ','Ẽ','Ẹ','Ê'),
			'i'	=>	array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
			'o'	=>	array('ố','ồ','ổ','ỗ','ộ','Ố','Ồ','Ổ','Ô','Ộ','ớ','ờ','ở','ỡ','ợ','Ớ','Ờ','Ở','Ỡ','Ợ','ó','ò','ỏ','õ','ọ','ô','ơ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ơ'),
			'u'	=>	array('ứ','ừ','ử','ữ','ự','Ứ','Ừ','Ử','Ữ','Ự','ú','ù','ủ','ũ','ụ','ư','Ú','Ù','Ủ','Ũ','Ụ','Ư'),
			'y'	=>	array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
			'd'	=>	array('đ','Đ'),
		);
		foreach ($chars as $key => $arr)
			foreach ($arr as $val)
				$value = str_replace($val, $key, $value);
		return $value;
	}
}

if(!function_exists('slug')){
	function slug($value = NULL){
		$value = removeutf8($value);
		$value = str_replace('-', ' ', trim($value));
		$value = preg_replace('/[^a-z0-9-]+/i', ' ', $value);
		$value = trim(preg_replace('/\s\s+/', ' ', $value));
		return strtolower(str_replace(' ', '-', trim($value)));
	}

}
if(!function_exists('get_colum_in_array')){
	function get_colum_in_array($data=array(), $field= 'id' ){
	    if(empty($field) || empty($data) ){
	        return false ;
	    }
	    if(isset($data) && is_array($data) && count($data)){
	    	foreach ($data as $key => $val) {
	    		if(isset($val[$field])){
		    		$result[] = $val[$field];
	    		}
	    	}
	    }
	    return (isset($result)) ? $result : '' ;
	}
}
if(!function_exists('convertArrayToString')){
	function convert_array_to_string($array=array()){
	    $temp = '';
		if(isset($array) && check_array($array) ){
			foreach ($array as $key => $val) {
				$temp = $temp.','.$val;
		}}
		$str = substr($temp, 1, strlen($temp));
	 	return '('.$str.')';
	}
}
