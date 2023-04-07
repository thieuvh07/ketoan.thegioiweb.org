<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public $auth;
	public $search;
	public $replace;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard/Autoload_Model'));
		$this->load->library(array('configbie', 'common'));
		
		if(isset($_COOKIE['auth'])){
			$auth = $_COOKIE['auth'];
			$temp = json_decode($auth, true);
			$this->auth = $temp['auth'];
		}
		$this->currentTime =  gmdate('Y-m-d H:i:s', time() + 7*3600);
		
		$this->search = array('/\n/', // replace end of line by a space
			'/\>[^\S ]+/s', // strip whitespaces after tags, except space
			'/[^\S ]+\</s', // strip whitespaces before tags, except space
			'/(\s)+/s' // shorten multiple whitespace sequences
		);
		$this->replace = array(
			' ',
			'>',
			'<',
			'\\1'
		);
	}
}
