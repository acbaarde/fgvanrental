<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mylib_model', 'mylib');
	}

	public function index()
	{	
		$data['page_title'] = 'pages/dashboard';
		$data['sysinfo'] = $this->mylib->getSysinfo();
		$this->load->view('main', $data);
	}
	
}
