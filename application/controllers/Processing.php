<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Process_model", "processmodel");
		$this->load->model("Mylib_model", "mylib");
	}

	public function index(){
		$data['page_title'] = 'pages/process';
		$this->load->view('main', $data);
	}

	public function loadVehicles(){
		echo json_encode($this->processmodel->loadvehicles());
	}

	public function viewTrnx(){
	
		$driverid = $this->input->get('driver_id');
		$data['pperiod'] = $this->processmodel->checkpp($driverid);
		$data['info'] = $this->processmodel->driverinfo($driverid);
		if($data['info']['type'] == 'T'){
			$data['page_title'] = 'pages/processing/trnx';
		}else{
			$data['page_title'] = 'pages/processing/trnxperday';
		}
		
		$this->load->view('main', $data);
	}

	public function saveTrnx(){
		$data['type'] = $this->input->post('type');
		$data['mdata'] = $this->input->post('mdata');
		echo json_encode($this->processmodel->savetrnx($data));
	}

	public function loadRegularForm(){
        $this->load->view('pages/processing/regular-form');
	}
	public function loadExtendedForm(){
        $this->load->view('pages/processing/extended-form');
	}
	public function loadSpecialForm(){
        $this->load->view('pages/processing/special-form');
	}

	public function regular_trnx(){
		$driverid = $this->input->post('driver_id');
		$data['type'] = $this->input->post('type');
		$data['pperiod'] = $this->processmodel->checkpp($driverid);
		$data['info'] = $this->processmodel->driverinfo($driverid);
		echo json_encode($this->processmodel->regulartrnx($data));
	}

	public function loadTrnxperday(){
		echo json_encode($this->processmodel->loadtrnxperday($this->input->post('mdata')));
	}
	public function saveTrnxperday(){
		echo json_encode($this->processmodel->savetrnxperday($this->input->post('mdata')));
	}

	public function loadPayroll(){
		$data['page_title'] = 'pages/processing/payroll';
		$this->load->view('main', $data);
	}

	public function getActivePeriod(){
		echo json_encode($this->processmodel->getactiveperiod());
	}

	public function ProcessPayroll(){
		echo json_encode($this->processmodel->processpayroll($this->input->post('mdata')));
	}
	
}
