<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mylib_model extends CI_Model { 
	public function __construct()
	{
		parent::__construct();
		
    }

    public function random_string($length) { 
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $key;
	}

	public function get_active_yr(){
		$str = "select year from aries.year where `post` != 'Y' order by `year` limit 1";
		$query = $this->db->query($str);
		$row = $query->row_array();
		$res = $row['year'];
		$query->free_result();
		return $res;
	}

	public function getcompanys($data=''){
		if($data != ''){
			$optn = "  and `type` = '{$data}'";
		}else{
			$optn = '';
		}

		$str = "select * FROM aries.company WHERE `active` = 'Y' {$optn}";
        return $this->db->query($str)->result_array();
	}
	public function getvehicles(){
		$str = "select v.*,CONCAT(lastname,', ',firstname,' ',middlename)AS operator FROM aries.vehicles as v
		LEFT JOIN aries.operators AS o ON o.id = v.operator_id
		WHERE v.`active` = 'Y'";
        return $this->db->query($str)->result_array();
	}
	public function getallvehicles(){
		$str = "select v.*,CONCAT(lastname,', ',firstname,' ',middlename)AS operator FROM aries.vehicles as v
		LEFT JOIN aries.operators AS o ON o.id = v.operator_id order by IF(v.active='Y',0,1),v.`unit`,v.plate_number";
        return $this->db->query($str)->result_array();
	}
	
	public function id_ctr(){
		$year = $this->mylib->get_active_yr();

		$str = "select (id_number + 1) AS id_number from aries.id_ctr order by id_number desc limit 1";
		$query = $this->db->query($str)->row_array();
		if(!empty($query)){
			$newid = $query['id_number'];
		}else{
			$newid = substr($year,2,2) . '00001';
		}
		return $newid;
	}

	public function getallroutes(){
		$str = "select * from aries.routes ORDER BY IF(active='Y',0,1),route_name,landmark";
		return $this->db->query($str)->result_array();
	}

	// public function num_frmt($nval=0,$nhaba=0) {
	// 	return str_pad(number_format($nval+0,2,'.',','),$nhaba,' ',STR_PAD_LEFT);
	// }

	public function num_decimal($num = 0){
		return number_format(round($num,2),2,'.',',');
	}

	public function deleteWithId($data){
		$table_name = isset($data['table_name']) ? $data['table_name'] : '';
		$id = isset($data['id']) ? $data['id'] : '';
		$year = isset($data['year']) ? $this->mylib->get_active_yr() : '';
		
		if(isset($data['year'])){
			$table_name = $table_name . $year;
		}

		$this->db->trans_begin();
		$str = "delete from {$table_name} where id = '{$id}'";
		$this->db->query($str);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$result = array(
				'status' => false,
				'message' => "Error deleting records! please contact system administrator."
			);
		}else{
			$this->db->trans_commit();
			$result = array(
				'status' => true,
				'message' => "Record(s) deleted!",
				'query' => $str
			);
		}
		return $result;
	}

	public function getsysinfo(){
		$data = "SELECT * FROM aries.sysinfo";
		return $this->db->query($data)->row_array();
	}

	public function getsigna(){
		$data = "SELECT * FROM aries.signatories";
		return $this->db->query($data)->result_array();
	}

}