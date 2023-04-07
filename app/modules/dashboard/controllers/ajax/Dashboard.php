<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		// if(!isset($this->auth)) redirect('admin');
		$this->load->library(array('configbie'));

	}
	public function get_select2(){
		$locationVal = $this->input->post('locationVal');
		$module = $this->input->post('module');
		$key = $this->input->post('key');
		$value = $this->input->post('value');
		$query = (!empty($this->input->post('query')) ? $this->input->post('query') : 'AND trash = 0');
		$selected = $this->input->post('selected');
		if(!empty($selected) ){
			$selected = json_decode(base64_decode($selected), true);
		}

		$temp = array(
			'select' => $key.','. $value,
			'table' => $module,
			'keyword'=> '('.$value.' LIKE \'%'.$locationVal.'%\''.$query.')',
			'order_by' => $key.' desc',
			'limit' => 10,
		);
		if(isset($selected) && is_array($selected) && count($selected)){
			$temp['where_in'] = $selected;
			$temp['where_in_field'] = $key;
		}
		$data = $this->Autoload_Model->_get_where($temp,TRUE);

		$temp = [];
		if(isset($data) && is_array($data) && count($data)){
			foreach($data as $index => $val){
				$temp[] = array(
					'id'=> $val[$key],
					'text' => $val[$value],
				);
			}
		}
		echo json_encode(array('items' => $temp));die();
	}
	


	// lấy dữ liệu từ ô search nâng cao
	function get_search_advance() {
		$param = $this->input->get();
		$keyword = $this->db->escape_like_str($this->input->get('keyword'));
		
		$moduleDetail = api_call(array(
			'url'=> $param['module'].'/backend/'.$param['module'].'/index', 'method' => 'get',
			'uri'=>  convert_uri(array(
				'select' => $param['fieldList'] ?? 'id, title',
				'query' => $this->queryCommon.'AND '.$param['name'].' LIKE \'%'.$keyword.'%\' ',
				'limit' => $param['limit'] ?? '',
			)),
		));
		pre($moduleDetail);
		$moduleDetail = json_decode($moduleDetail, true);

		if(isset($moduleDetail) && check_array($moduleDetail) ){
			foreach ($moduleDetail as $key => $val) { 
				$moduleDetail[$key]['info'] = base64_encode(json_encode($val));
		}} 
		echo json_encode($moduleDetail);die;
	}
	// lấy dữ liệu từ ô search nâng cao
	function get_search_by_phone() {
		$param = $this->input->get();
		$phone = $this->input->get('phone');
		
		$moduleDetail = api_call(array(
			'url'=> $param['module'].'/backend/'.$param['module'].'/index', 'method' => 'get',
			'uri'=>  convert_uri(array(
				'select' => $param['fieldList'] ?? 'id, title',
				'query' => $this->queryCommon.' AND phone = '.$phone,
				'limit' => $param['limit'] ?? '',
			)),
		));
		$moduleDetail = json_decode($moduleDetail, true);

		if(isset($moduleDetail) && check_array($moduleDetail) ){
			foreach ($moduleDetail as $key => $val) { 
				$moduleDetail[$key]['info'] = base64_encode(json_encode($val));
		}} 
		echo json_encode($moduleDetail);die;
	}

	/* ================ UPDATE FIELD ======================= */
	public function ajax_update_status_by_field(){
		$post['module'] = $this->input->post('module');
		$post['objectid'] = $this->input->post('id');
		$post['field'] = $this->input->post('field');
		// Lấy ra thông tin của  object dựa vào id
			
		$this->db->select('id, '.$post['field'].'');
		$this->db->from($post['module']);
		$this->db->where(array(
			'id' => $post['objectid'],
		));
		$data['object'] = $this->db->get()->row_array();
		
		//Cập nhật
		$temp[$post['field']] = (($data['object'][$post['field']] == 1)?0:1);
		$temp['userid_updated'] = 1;
		$temp['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where(array('id' => $post['objectid']));
		$this->db->update($post['module'], $temp);
		echo $temp[$post['field']];
		die();
	}
	public function get_location(){
		$post['parentid'] = $this->input->post('parentid');
		$post['select'] = $this->input->post('select');
		$post['table'] = $this->input->post('table');
		$post['text'] = $this->input->post('text');
		$post['parentField'] = $this->input->post('parentField');
		
		$locationList = get_location(array(
			'select' => $post['select'].', name',
			'table' => $post['table'],
			'where' => array($post['parentField'] => $post['parentid']),
			'field' => $post['select'],
			'text' => $post['text'],
		));
		$temp = '';
		if(isset($locationList) && is_array($locationList) && count($locationList)){
			foreach($locationList as $key => $val){
				$temp = $temp.'<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo json_encode(array(
			'html' => $temp,
		));die();
	}

	public function ajax_delete(){
		// lấy dữ liệu
		$param['module'] = $this->input->post('module');
		$param['moduleText'] = $this->input->post('moduleText');
		$param['id'] = (int)$this->input->post('id');

		$module = explode('_', $param['module']);
		$moduleText = explode(' ', $param['moduleText']);
		// TH module không phải là nhóm thì: 
		if(!isset($module[1]) || $module[1] != 'catalogue'){
			// kiểm tra quyền xóa
			$permission = $param['module'].'/backend/'.$param['module'].'/delete';
			if(in_array($permission, json_decode($this->auth['permission'], TRUE)) == false){
				$result['flag'] = false;
				$result['message'] = 'Bạn không có quyền sử dụng chức năng này';
				echo json_encode($result);die();
			}

			$resultid = api_call(array(
				'url'=>  $param['module'].'/backend/'.$param['module'].'/index/'.$param['id'], 'method' => 'put',
				'data'=> array(
					'trash' => 1,
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
					'userid_updated' => $this->auth['id'],
				),
			));
			if($resultid > 0){
				$result['flag'] = true;
				echo json_encode($result);die();
			}else{
				$result['flag'] = false;
				$result['message'] = 'Đã xảy ra lỗi, vui lòng thử lại';
				echo json_encode($result);die();
			}

		}else{ // TH module là nhóm
			// kiểm tra quyền xóa
			$permission = $module[0].'/backend/catalogue/delete';
			if(in_array($permission, json_decode($this->auth['permission'], TRUE)) == false){
				$result['flag'] = false;
				$result['message'] = 'Bạn không có quyền sử dụng chức năng này';
				echo json_encode($result);die();
			}

			// kiểm tra xem có nhóm con bên trong nhóm chính không
			$moduleNotLevel = array('user_catalogue', 'website_catalogue');
			if(!in_array($param['module'], $moduleNotLevel)){
				$temp = api_call(array(
					'url'=> $module[0].'/backend/catalogue/'.$param['id'], 'method' => 'get',
					'uri'=>  convert_uri(array(
						'select' => 'lft, rgt',
						'query' => $this->queryCommon,
					)),
				));
				$temp = json_decode($temp, true);

				// nếu rgt - lft > 1 thì chứng tỏ có nhóm con bên trong nhóm chính
				if(($temp['rgt'] - $temp['lft']) > 1){
					$result['flag'] = false;
					$result['message'] = 'Vui lòng xóa hết nhóm con trong nhóm trước';
					echo json_encode($result);die();
				}
			}

			// kiêm tra xem có thành phần bên trong nhóm không
			$count = api_call(array(
				'url'=> 'api/count',
				'method' => 'get',
				'data'=> array(
					'table' => $module[0],
					'where' => array('catalogueid' => $param['id']),
					'query' => $this->queryCommon,
				),
			));
			if($count > 0){
				$result['flag'] = false;
				$result['message'] = 'Vui lòng xóa hết '.$moduleText[1].$moduleText[2].' trong nhóm';
				echo json_encode($result);die();
			}else{
				// cập nhật trash = 1 cho 
				$flag = api_call(array(
					'url'=> $module[0].'/backend/catalogue/'.$param['id'], 'method' => 'put',
					'data'=> array(
							'trash' => 1,
							'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
							'userid_updated' => $this->auth['id'],
						),
				));
				if($flag > 0){
					$result['flag'] = true;
					echo json_encode($result);die();
				}else{
					$result['flag'] = false;
					$result['message'] = 'Đã xảy ra lỗi, vui lòng thử lại';
					echo json_encode($result);die();
				}
			}
		}
	}
	
	public function ajax_delete_all(){
		$flag = 0;
		$post = $this->input->post('post');
		if(isset($post['list']) && is_array($post['list']) && count($post['list'])){
			foreach($post['list'] as $key => $val){
				//Xóa bảng catalogue relation ship
				if($param['module'] != 'tag'){
					$deleteRelationShip = $this->Autoload_Model->_delete(array(
						'where' => array('moduleid' => $val,'module' => $post['module']),
						'table' => 'catalogue_relationship',
					));
					//Xóa bảng Tag
					$deleteTag = $this->Autoload_Model->_delete(array(
						'where' => array('moduleid' => $val, 'module' => $post['module']),
						'table' => 'tag_relationship',
					));
				}else{
					$deleteTag = $this->Autoload_Model->_delete(array(
						'where' => array('tagid' => $val),
						'table' => 'tag_relationship',
					));
				}
				//Xóa bảng Router
				$deleteRouter = $this->Autoload_Model->_delete(array(
					'where' => array('param' => $val,'uri' => ''.$post['module'].'/frontend/'.$post['module'].'/view'),
					'table' => 'router',
				));
				//Xóa đối tượng
				$deleteObject = $this->Autoload_Model->_delete(array(
					'where' => array('id' => $val),
					'table' => $post['module'],
				));
			}
			$flag = 1;
		}
		echo $flag;die();
	}
	
	
	
		
}
