<!-- thời gian tìm ra mật khẩu của bạn https://www.grc.com/haystack.htm -->
<?php
regex check string pass
// pass
^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$

 // mail
/[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm

// phone
^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$

// đ/mm/yy
^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$

$title = $val['title'];
$image = $val['image'];
$href = rewrite_url($val['canonical'], true, true ); 
$detail_attr = (isset($val['detail_attr'])) ? $val['detail_attr'] : '';
$info = getPriceFrontend(array('productDetail' => $val));
$rate = $val['rate'];
$description = $detailProduct['description'];
$description_litter = cutnchar(strip_tags($detailProduct['description']),400);
if(isset($detail_product['end_date'])){
		$end_date  =  $detail_product['end_date'] ;
		$Y = gettime($end_date, 'Y');
		$m = gettime($end_date, 'm');
		$d = gettime($end_date, 'd');
	}



$prd_title = $detailProduct['title'];
	$prd_code = $detailProduct['code'];
	$list_image = json_decode(base64_decode($detailProduct['image_json']));
	$prd_href = rewrite_url($detailProduct['canonical']);
    $prd_description = $detailProduct['description'];
    $prd_description_litter = cutnchar(strip_tags($detailProduct['description']),400);
	$prd_info = getPriceFrontend(array('detail_prd' => $detailProduct));
    $commnet = comment(array('id' => $detailProduct['id'], 'module' => 'product'));
    $prd_rate = '';
	if(isset($commnet) && is_array($commnet) && count($commnet)){
		$prd_rate = round($commnet['statisticalRating']['averagePoint']);
	}


	if(in_array($valFolder, $dir_false)) continue;
	$listId = get_colum_in_array($array, 'id');
	$sum = array_sum($cusListCount)
	$this->load->library('nestedsetbie', array('table' => 'table'));

	if(isset($list) && check_array($list)){

	}
	if(isset($list) && check_array($list)){
		foreach ($list as $key => $val) {

	}}

	switch (nnnnnn) {
	    case label1:
	        break;
	    default:
	        ;
	}
	$array = explode(" ",$str);
	$str = substr($str, 0, strlen($str));
	$index = strpos($str, $val)


	// ___________________________________view___________________________________
	$queryData = render_query_in_search($this->input->get(), array('fieldKeywordArray' =>array('title','id')));
	$query = $queryData['query'];
	$data['isSearchAdvanced'] = $queryData['isSearchAdvanced'];
	$order_by = $queryData['order_by'];

	$moduleData = api_call(array(
		'url'=> 'api/view', 'method' => 'get',
		'data'=>  array(
			'table' => '{table_catalogue} as tb1',
			// change field
			'select' => 'id, title, created, (SELECT fullname FROM user WHERE user.id = tb1.userid_created) as user_created',
			'join' => array(
				array('appointment', 'appointment.customerid = customer.id', 'left'),
			),
			// end change field
			'page' => $page ?? 1,
			'perpage' => $perpage ?? 20,
			'query' => $this->queryCommon.(!empty($query) ? ' AND '.$query : ''),
			'order_by' => (!empty($order_by) ? $order_by.', ' : '').'lft asc',
		),
	));
	$data['from'] = $cataData['from'];
	$data['to'] = $cataData['to'];

	'where' => 'customerid IN '.convert_array_to_string(array_slice($customerListId, $index, $val)),


	// _____________________________________________get_____________________________________________
	$cataDetail = api_call(array(
		'url'=> 'api/index', 'method' => 'get',
		'data'=>  array(
			'select' => 'title, slug, permission',
			'where' => array('id' => $id),
			'table' => 'user_catalogue as tb1',
			'query' => $this->queryCommon,
			'flag' => false,
		),
	));

	// __________________________________________post__________________________________________
	$_insert = array(
		'title' => htmlspecialchars_decode(html_entity_decode($this->input->post('title'))),
		'slug' => slug($this->input->post('title')),
		'permission' => json_encode($this->input->post('permission')),
		'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
		'userid_created' => $this->auth['id'],
		'trash' => 0,
		'companyid' => $this->auth['companyid'],
	);
	if(isset($_insert) && is_array($_insert) && count($_insert)){
		$resultid = api_call(array(
			'url'=> 'api/index', 'method' => 'post',
			'data'=> array(
				'table' => 'user_catalogue',
				'data' => $_insert,
			),
		));
		if($resultid > 0){
			$this->session->set_flashdata('message-success','Thêm phòng ban mới thành công');
			redirect(base_url('user/backend/catalogue/create'));
		}else{
			$this->session->set_flashdata('message-danger','Có lỗi sảy ra vui lòng thử lại');
		}
	}


	$_update = array(
		'' => '',
	);
	$flag = api_call(array(
		'url'=> 'api/index', 'method' => 'put',
		'data'=> array(
			'table' => 'user_catalogue',
			'where' => array('id' => $id),
			'data' => $_update,
		),
	));

	$_insert = array(
		'' => '',
	);
	$resultid = api_call(array(
		'url'=> 'api/index', 'method' => 'post',
		'data'=> array(
			'table' => 'user_catalogue',
			'data' => $_insert,
		),
	));

	$s = microtime(true);
	$e = microtime(true);
	pre($e - $s);

	// thời gian tải của trang
	$this->benchmark->elapsed_time()

function sortBySubkey(&$array, $subkey, $sortType = SORT_ASC) {
    foreach ($array as $subarray) {
        $keys[] = $subarray[$subkey];
    }
    array_multisort($keys, $sortType, $array);
    return $array ;
}

function random_string($type = 'alnum', $len = 8)
	{
		switch ($type)
		{
			case 'basic':
				return mt_rand();
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
				switch ($type)
				{
					case 'alpha':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'alnum':
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}
				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
			case 'unique': // todo: remove in 3.1+
			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'encrypt': // todo: remove in 3.1+
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
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



?>
