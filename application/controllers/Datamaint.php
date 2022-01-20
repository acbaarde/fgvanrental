<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datamaint extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Datamaint_model','datamaintmodel');
		$this->load->model('Mylib_model', 'mylib');
	}

	public function view(){
		$data['page_title'] = 'pages/datamaint';
		$this->load->view('main', $data);
	}

	public function getDrivers(){
		echo json_encode($this->datamaintmodel->getdrivers());
	}
	public function searchDriver(){
		echo json_encode($this->datamaintmodel->searchdriver($this->input->post('mdata')));
	}
	public function getDriverinfo(){
		echo json_encode($this->datamaintmodel->getdriverinfo($this->input->post('driver_id')));
	}
	public function saveDriver(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertdriver($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updatedriver($this->input->post('mdata')));
		}
	}

	

	public function getCompanys(){
		echo json_encode($this->mylib->getcompanys());
	}
	public function getCompanyinfo(){
		echo json_encode($this->datamaintmodel->getcompanyinfo($this->input->post('company_id')));
	}
	public function saveCompany(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertcompany($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updatecompany($this->input->post('mdata')));
		}
	}
	public function getVehicles(){
		echo json_encode($this->mylib->getvehicles());
	}
	public function getAllvehicles(){
		echo json_encode($this->mylib->getallvehicles());
	}
	
	public function getVehicleinfo(){
		echo json_encode($this->datamaintmodel->getvehicleinfo($this->input->post('vid')));
	}
	public function saveVehicle(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertvehicle($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updatevehicle($this->input->post('mdata')));
		}
	}
	public function getAllroutes(){
		echo json_encode($this->mylib->getallroutes());
	}

	public function getOperators(){
		echo json_encode($this->datamaintmodel->getoperators());
	}
	public function getOperatorinfo(){
		echo json_encode($this->datamaintmodel->getoperatorinfo($this->input->post('operator_id')));
	}
	public function saveOperator(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertoperator($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updateoperator($this->input->post('mdata')));
		}
	}

	public function getRoutesbytype(){
		echo json_encode($this->datamaintmodel->getroutesbytype($this->input->post('routetype')));
	}
	public function saveRoute(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertroute($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updateroute($this->input->post('mdata')));
		}
	}
	public function getRouteinfo(){
		echo json_encode($this->datamaintmodel->getrouteinfo($this->input->post('route_id')));
	}

	public function getPeriods(){
		echo json_encode($this->datamaintmodel->getperiods());
	}
	public function savePeriod(){
		$type = $this->input->post('type');
		if($type == "ADD"){
			echo json_encode($this->datamaintmodel->insertperiod($this->input->post('mdata')));
		}else{
			echo json_encode($this->datamaintmodel->updateperiod($this->input->post('mdata')));
		}
	}
	public function getPeriodinfo(){
		echo json_encode($this->datamaintmodel->getperiodinfo($this->input->post('period_id')));
	}

	public function deletePayperiod(){
		$year = $this->mylib->get_active_yr();
		$table_name = "pp{$year}";
		echo json_encode($this->mylib->deleteWithId($this->input->post('payperiod_id'), $table_name));
	}
}
