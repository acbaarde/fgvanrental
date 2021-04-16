<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends CI_Controller {

	public function index(){
		$data['page_title'] = 'pages/utilities';
		$this->load->view('main', $data);
	}
	
}
