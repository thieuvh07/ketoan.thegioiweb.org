<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nestedsetbie extends MY_Controller {
	
	function __construct($params = NULL){
		parent::__construct();
		$this->params = $params;
		$this->checked = NULL;
		$this->data = NULL;
		$this->count = 0;
		$this->count_level = 0;
		$this->lft = NULL;
		$this->rgt = NULL;
		$this->level = NULL;
	}

	public function Processed($param = []){
		$order = $param['order'] ?? 'level ASC, order ASC';
		$this->Get($order);
		$this->Recursive(0, $this->Set());
		$this->Action();
	}
	public function Get($order = 'lft ASC, order ASC'){
		$this->db->select('id, title, parentid, lft, rgt, level, order');
		$this->db->from($this->params['table']);
		$this->db->where('trash = 0');
		$this->db->order_by($order);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		$this->data = $result;
	}

	public function Set(){	
		if(isset($this->data) && is_array($this->data)){
			$arr = NULL;
			foreach($this->data as $key => $val){
				$arr[$val['id']][$val['parentid']] = 1;
				$arr[$val['parentid']][$val['id']] = 1;
			}
			return $arr;
		}
	}

	public function Recursive($start = 0, $arr = NULL){
		$this->lft[$start] = ++$this->count;
		$this->level[$start] = $this->count_level;
		if(isset($arr) && is_array($arr)){
			foreach($arr as $key => $val){
				if((isset($arr[$start][$key]) || isset($arr[$key][$start])) &&(!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))){
					$this->count_level++;
					$this->checked[$start][$key] = 1;
					$this->checked[$key][$start] = 1;
					$this->recursive($key, $arr);
					$this->count_level--;
				}
			}
		}
		$this->rgt[$start] = ++$this->count;
	}

    public function Action(){
		if(isset($this->level) && is_array($this->level) && isset($this->lft) && is_array($this->lft) && isset($this->rgt) && is_array($this->rgt)){
			$data = NULL;
			foreach($this->level as $key => $val){
				$data[] = array(
					'id' => $key,
					'level' => $val,
					'lft' => $this->lft[$key],
					'rgt' => $this->rgt[$key],
				);
			}
			$this->db->update_batch($this->params['table'], $data, 'id'); 
			$this->db->flush_cache();
		}
    }

	public function Dropdown($param = NULL){
		$this->get();
		if(isset($this->data) && is_array($this->data)){
			$temp = NULL;
			$temp[0] = (isset($param['text']) && !empty($param['text']))?$param['text']:'[Root]';
			foreach($this->data as $key => $val){
				$temp[$val['id']] = str_repeat('|-----', (($val['level'] > 0)?($val['level'] - 1):0)).$val['title'];
			}
			return $temp;
		}
	}

}