<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($this->auth)) redirect('admin');
	}
	
	
	
}
