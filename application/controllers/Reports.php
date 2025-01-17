<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Reports_model', 'reports_model');
		$this->load->model("Mylib_model", "mylib");
	}

	public function index(){
		$data['page_title'] = 'pages/reports';
		$this->load->view('main', $data);
	}

	public function loadBilling(){
		$data['page_title'] = 'pages/reports/billing';
		$data['sysinfo'] = $this->mylib->getsysinfo();
		$this->load->view('main', $data);
	}

	public function loadPayslip(){
		$data['page_title'] = 'pages/reports/payslip';
		$this->load->view('main', $data);
	}
	public function loadReports(){
		$data['page_title'] = 'pages/reports/reports';
		$this->load->view('main', $data);
	}
	
	public function getAllYear(){
		echo json_encode($this->reports_model->getallyear());
	}

	public function getCompany(){
		echo json_encode($this->mylib->getcompanys($this->input->post('type')));
	}

	public function getPeriod(){
		echo json_encode($this->reports_model->getperiod());
	}

	public function billingForm(){
		return $this->load->view('pages/reports/billingpercomp');
	}
	public function payslipForm(){
		return $this->load->view('pages/reports/payslippercomp');
	}
	public function view(){
		$data['page_title'] = 'pages/reports/billing';
		$data['sysinfo'] = $this->mylib->getsysinfo();
		$this->load->view('main', $data);
	}
	public function payslip(){
		$data['page_title'] = 'pages/reports/payslip';
		$this->load->view('main', $data);
	}
	public function reports(){
		$data['page_title'] = 'pages/reports/reports';
		$this->load->view('main', $data);
	}

	public function getPertrip_rpt(){
		echo json_encode($this->reports_model->getpertrip_rpt($this->input->post('mdata')));
	}

	public function getPertripbreakdown_rpt(){
		echo json_encode($this->reports_model->getpertripbreakdown_rpt($this->input->post('mdata')));
	}

	public function getPerroutebreakdown_rpt(){
		echo json_encode($this->reports_model->getperroutebreakdown_rpt($this->input->post('mdata')));
	}

	public function getPerday_rpt(){
		echo json_encode($this->reports_model->getperday_rpt($this->input->post('mdata')));
	}

	public function getPerdriverbreakdown_rpt(){
		echo json_encode($this->reports_model->getperdriverbreakdown_rpt($this->input->post('mdata')));
	}

	public function paypertrip_rpt(){

		$data['myear'] = $this->input->get('myear');
		$data['mcompany'] = $this->input->get('mcompany');
		$data['mperiod'] = $this->input->get('mperiod');

		$result = $this->reports_model->paypertripproc($data);
		if(count($result['result'])==0){
			echo "<script>if(confirm('No Records found!!!')){window.close();}</script>";
			die();
		}
		$this->load->view('pages/reports/paypertrip-rpt', $result);
	}
	
	public function payperday_rpt(){

		$data['myear'] = $this->input->get('myear');
		$data['mcompany'] = $this->input->get('mcompany');
		$data['mperiod'] = $this->input->get('mperiod');

		$result = $this->reports_model->payperdayproc($data);
		if(count($result['result'])==0){
			echo "<script>if(confirm('No Records found!!!')){window.close();}</script>";
			die();
		}
		
		$this->load->view('pages/reports/payperday-rpt', $result);
	}

	public function paydriver_rpt(){

		$data['myear'] = $this->input->get('myear');
		$data['mcompany'] = $this->input->get('mcompany');
		$data['mperiod'] = $this->input->get('mperiod');

		$result = $this->reports_model->paydriverproc($data);
		if(count($result['result'])==0){
			echo "<script>if(confirm('No Records found!!!')){window.close();}</script>";
			die();
		}
		
		$this->load->view('pages/reports/paydrivers-rpt', $result);
	}

	public function getManualBilling(){
		echo json_encode($this->reports_model->getmanualbilling($this->input->post('mdata')));
	}

	public function getNewBiling(){
		$deptId = $this->input->post('mdata')['mdepartment_id'];
		if($deptId <= 0){
			$data['myear'] = $this->input->post('mdata')['myear'];
			$data['mcompany'] = $this->input->post('mdata')['mcompany_id'];
			$data['mperiod'] = $this->input->post('mdata')['mperiod'];

			if($deptId == 0){
				echo json_encode($this->reports_model->getpertripbreakdown_rpt($data));
			}else{
				$result = $this->reports_model->getpertripbreakdown_rpt($data);
				foreach ($this->reports_model->getmanualbilling($this->input->post('mdata'))['result'] as $key => $val) {
					array_push($result['result'], $val);
				}
				echo json_encode($result);
			}
		}else{
			echo json_encode($this->reports_model->getmanualbilling($this->input->post('mdata')));
		}
	}

	public function paymanual_rpt(){
		$data['myear'] = $this->input->get('myear');
		$data['mcompany'] = $this->input->get('mcompany');
		$data['mperiod'] = $this->input->get('mperiod');

		$result = $this->reports_model->paypertripproc($data);

		if(count($result['result'])>0){
			$arrRes = array();
			foreach($result['result'] as $rw){
				if($rw['manualtripsamount']>0){
					array_push($arrRes, $rw);
				}
			}
			$result['result'] = $arrRes;
		}
		
		if(count($result['result'])==0){
			echo "<script>if(confirm('No Records found!!!')){window.close();}</script>";
			die();
		}
		$this->load->view('pages/reports/paymanual-rpt', $result);
	}

}
