<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Datamaint_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function getdrivers(){
        $dbname = "aries";
        $tablename = "drivers";
        $str = "select * from {$dbname}.{$tablename} order by if(active='Y',0,1),lastname, firstname, middlename";
        return $this->db->query($str)->result_array();
    }
    public function searchdriver($data=''){
        $dbname = "aries";
        $tablename = "drivers";
        $str = "select * from {$dbname}.{$tablename} 
        where (lastname LIKE '%{$data}%' OR firstname LIKE '%{$data}%' OR middlename LIKE '%{$data}%' OR driver_id LIKE '%{$data}%')
        order by lastname";
        return $this->db->query($str)->result_array();
    }
    public function getvehicleinfo($data=''){
        $vehicle_id = $data;
        $str = "select vehicle.id,plate_number,CONCAT(TRIM(lastname),', ',TRIM(firstname),' ',TRIM(middlename))AS operator,vehicle.unit,vehicle.active,vehicle.operator_id FROM aries.vehicles AS vehicle
        LEFT JOIN aries.operators AS operator ON operator.id = vehicle.operator_id
        WHERE vehicle.id = '{$vehicle_id}'";
        $result = $this->db->query($str);
        return $result->row_array();
    }

    public function getoperators(){
        $dbname = "aries";
        $tablename = "operators";
        $str = "select * from {$dbname}.{$tablename} order by if(active='Y',0,1),lastname, firstname, middlename";
        return $this->db->query($str)->result_array();
    }

    public function insertdriver($data=array()){
        $newid = $this->mylib->id_ctr();
        $tablename = "drivers";

        $routes_id = explode("xOx", $data['routes_id']);
        $route_id = "(";
        for($i = 0; $i < count($routes_id); $i++){
            if(!empty($routes_id[$i])){
                $route_id .= "'".$routes_id[$i]."',";
            }
        }  
        $route_id = substr($route_id,0,strlen($route_id)-1) . ")";
        
        $regroutes = ''; $extroutes = ''; $speroutes = '';
        if(strlen($route_id) > 1){
            $str = "select id,route_code,route_trip from aries.routes where id in {$route_id}";
            $res_routes = $this->db->query($str)->result_array();
    
            foreach($res_routes as $row){
                if($row['route_trip'] == 'R'){
                    $regroutes .= $row['id'] . "xOx";
                }elseif($row['route_trip'] == 'E'){
                    $extroutes .= $row['id'] . "xOx";
                }elseif($row['route_trip'] == 'S'){
                    $speroutes .= $row['id'] . "xOx";
                }
            }
        }

        $insert = array(
            'driver_id' => $newid,
            'firstname' => strtoupper($data['firstname']),
            'lastname' => strtoupper($data['lastname']),
            'middlename' => strtoupper($data['middlename']),
            'address' => strtoupper($data['address']),
            'contact' => $data['contact'],
            'company' => $data['selcompany'],
            'vehicle_id' => $data['selvehicle'],
            'active' => $data['stat'],
            'reg_routes' => $regroutes,
            'ext_routes' => $extroutes,
            'spe_routes' => $speroutes
            );

        $updatevehicle = array(
            'stat' => 'NA'
        );        

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
            $this->db->insert('id_ctr', array('id_number' => $newid));
            $this->db->update('vehicles', $updatevehicle, "id=".$this->db->escape($data['selvehicle']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function getdriverinfo($data=''){
        $str = "select
        driver.id,
        driver.driver_id,
        driver.firstname,
        driver.lastname,
        driver.middlename,
        driver.contact,
        driver.address,
        driver.active,
        driver.company,
        driver.vehicle_id,
        driver.reg_routes,
        driver.ext_routes,
        driver.spe_routes,
        CONCAT(operator.lastname,', ',operator.firstname,' ',operator.middlename)AS operator,
        vehicle.plate_number
        FROM aries.drivers AS driver
        LEFT JOIN aries.vehicles AS vehicle ON vehicle.id = driver.vehicle_id
        LEFT JOIN aries.operators AS operator ON operator.id = vehicle.operator_id
        where driver.driver_id = '{$data}'";
        return $this->db->query($str)->row_array();
    }

    public function updatedriver($data=array()){
        $tablename = "drivers";
        $dbname = "aries";

        $routes_id = explode("xOx", $data['routes_id']);
        $route_id = "(";
        for($i = 0; $i < count($routes_id); $i++){
            if(!empty($routes_id[$i])){
                $route_id .= "'".$routes_id[$i]."',";
            }
        }  
        $route_id = substr($route_id,0,strlen($route_id)-1) . ")";

        $regroutes = ''; $extroutes = ''; $speroutes = '';
        if(strlen($route_id) > 1){
            $str = "select id,route_code,route_trip from aries.routes where id in {$route_id}";
            $res_routes = $this->db->query($str)->result_array();
    
            foreach($res_routes as $row){
                if($row['route_trip'] == 'R'){
                    $regroutes .= $row['id'] . "xOx";
                }elseif($row['route_trip'] == 'E'){
                    $extroutes .= $row['id'] . "xOx";
                }elseif($row['route_trip'] == 'S'){
                    $speroutes .= $row['id'] . "xOx";
                }
            }
        }        

        $value = array(
            'firstname' => strtoupper($data['firstname']),
            'middlename' => strtoupper($data['middlename']),
            'lastname' => strtoupper($data['lastname']),
            'contact' => $data['contact'],
            'address' => strtoupper($data['address']),
            'active' => $data['stat'],
            'company' => $data['selcompany'],
            'vehicle_id' => $data['selvehicle'],
            'reg_routes' => $regroutes,
            'ext_routes' => $extroutes,
            'spe_routes' => $speroutes
        );

        $str = "select vehicle_id from {$dbname}.{$tablename} where id='{$data['recid']}'";
        $prevvehicleid = $this->db->query($str)->row_array();

        //set vehicle status to NA not available
        $updatevehicle = array(
            'stat' => 'NA'
        );
        //set vehicle status to back to A Available
        $updateprevvehicle = array(
            'stat' => 'A'
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['recid']));
            $this->db->update('vehicles', $updateprevvehicle, "id=".$this->db->escape($prevvehicleid['vehicle_id']));
            $this->db->update('vehicles', $updatevehicle, "id=".$this->db->escape($data['selvehicle']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function insertoperator($data=array()){
        $tablename = "operators";
       
        $insert = array(
            'firstname' => strtoupper($data['firstname']),
            'lastname' => strtoupper($data['lastname']),
            'middlename' => strtoupper($data['middlename']),
            'address' => strtoupper($data['address']),
            'contact' => $data['contact'],
            'active' => $data['stat']
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function getoperatorinfo($data=''){
        $str = "select * from aries.operators where id='{$data}' order by lastname";
        return $this->db->query($str)->row_array();
    }

    public function updateoperator($data=array()){
        $tablename = "operators";

        $value = array(
            'firstname' => strtoupper($data['firstname']),
            'middlename' => strtoupper($data['middlename']),
            'lastname' => strtoupper($data['lastname']),
            'contact' => $data['contact'],
            'address' => strtoupper($data['address']),
            'active' => $data['stat']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['recid']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function insertcompany($data=array()){
        $tablename = "company";
        $db = "aries";

        $str = "select `company_id` from {$db}.{$tablename}  ORDER BY company_id DESC LIMIT 1";
        $query = $this->db->query($str);

        if($query->num_rows() == 0){
            $a = 'A';
        }else{
            $res = $query->row_array();
            $a = $res['company_id'];
        }

        foreach(range($a,'Z') as $chr){
            $str = "select `company_id` from {$db}.{$tablename} where company_id='{$chr}'";
            $query = $this->db->query($str);
            if($query->num_rows() == 0){
                $newcompid = $chr;
            break;
            }
        }


        $insert = array(
            'company_id' => $newcompid,
            'company_name' => strtoupper($data['company_name']),
            'address' => strtoupper($data['address']),
            'email' => strtoupper($data['email']),
            'contact' => strtoupper($data['contact']),
            'abbr' => strtoupper($data['abbr']),
            'active' => $data['stat'],
            'refno' => $data['refno'],
            'type' => $data['seltype'],
            'tinno' => $data['tinno']
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function getcompanyinfo($data=''){
        $str = "select * from aries.company where company_id='{$data}'";
        return $this->db->query($str)->row_array();
    }

    public function updatecompany($data=array()){
        $tablename = "company";

        $value = array(
            'company_name' => strtoupper($data['company_name']),
            'address' => strtoupper($data['address']),
            'email' => $data['email'],
            'contact' => $data['contact'],
            'refno' => $data['refno'],
            'abbr' => strtoupper($data['abbr']),
            'active' => $data['stat'],
            'type' => $data['seltype'],
            'tinno' => $data['tinno']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "company_id=". $this->db->escape($data['company_id']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function insertvehicle($data=array()){
        $tablename = "vehicles";

        $insert = array(
            'operator_id' => $data['seloperator'],
            'plate_number' => strtoupper($data['plate_number']),
            'unit' => strtoupper($data['unit']),
            'active' => $data['stat'],
            'stat' => 'A'
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }
    public function updatevehicle($data=array()){
        $tablename = "vehicles";

        $value = array(
            'plate_number' => strtoupper($data['plate_number']),
            'unit' => strtoupper($data['unit']),
            'operator_id' => $data['seloperator'],
            'active' => $data['stat']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['recid']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }
    public function getroutesbytype($data=''){
        $str = "select * from aries.routes where route_trip = '{$data}' ORDER BY IF(active='Y',0,1),route_name,landmark";
        return $this->db->query($str)->result_array();
    }

    public function insertroute($data=array()){
        $tablename = "routes";

        $insert = array(
            'route_name' => strtoupper($data['route_name']),
            'landmark' => strtoupper($data['landmark']),
            'rate' => $data['rate'],
            'active' => $data['stat'],
            'route_trip' =>$data['selroute_type']
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function updateroute($data=array()){
        $tablename = "routes";

        $value = array(
            'route_name' => strtoupper($data['route_name']),
            'landmark' => strtoupper($data['landmark']),
            'rate' => $data['rate'],
            'active' => $data['stat'],
            'route_trip' =>$data['selroute_type']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['route_id']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function getrouteinfo($data=''){
        $str = "select * from aries.routes where id='{$data}'";
        return $this->db->query($str)->row_array();
    }
    
    public function getperiods(){
        $year = $this->mylib->get_active_yr();
        $dbname = "aries";
        $tablename = "pp{$year}";
        $str = "select * from {$dbname}.{$tablename} order by cutoff";
        return $this->db->query($str)->result_array();
    }
    public function insertperiod($data=array()){
        $year = $this->mylib->get_active_yr();
        $tablename = "pp{$year}";

        $cf = substr($data['cfrom'],5,2);
        $ct = substr($data['cto'],8,1);
        if($ct != 1){
            $ct = 2;
        }
        $cutoff = $cf.$ct;

        $insert = array(
            'cutoff' => $cutoff,
            'pperiod' => $data['pperiod'],
            'cfrom' => $data['cfrom'],
            'cto' => $data['cto'],
            'ppost' => $data['selpost'],
            'days' =>$data['no_days']
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }

    public function getperiodinfo($data=''){
        $year = $this->mylib->get_active_yr();
        $tablename = "pp{$year}";
        $dbname = "aries";

        $str = "select * from {$dbname}.{$tablename} where id='{$data}'";
        return $this->db->query($str)->row_array();
    }

    public function updateperiod($data=array()){
        $year = $this->mylib->get_active_yr();
        $tablename = "pp{$year}";

        $cf = substr($data['cfrom'],5,2);
        $ct = substr($data['cto'],8,1);
        if($ct != 1){
            $ct = 2;
        }
        $cutoff = $cf.$ct;

        $value = array(
            'cutoff' => $cutoff,
            'pperiod' => $data['pperiod'],
            'cfrom' => $data['cfrom'],
            'cto' => $data['cto'],
            'ppost' => $data['selpost'],
            'days' =>$data['no_days']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['period_id']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }

        return $result;
    }
    public function getdepartment(){
        $str = "SELECT * FROM department order by active desc";
        $result = $this->db->query($str)->result_array();
        return $result;
    }
    public function getdepartmentinfo($data=''){
        $tablename = "department";
        $str = "select * from {$tablename} where id='{$data}'";
        return $this->db->query($str)->row_array();
    }
    public function insertdepartment($data=array()){
        $tablename = 'department';
        $insert = array(
            'dept_name' => $data['deptname'],
            'active' => $data['active']
            );     

        $this->db->trans_begin();
            $this->db->insert($tablename, $insert);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }
        return $result;
    }

    public function updatedepartment($data=array()){
        $tablename = 'department';
        $value = array(
            'dept_name' => $data['deptname'],
            'active' => $data['active']
        );
        
        $this->db->trans_begin();
            $this->db->update($tablename, $value, "id=". $this->db->escape($data['recid']));
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = false;
        }else{
            $this->db->trans_commit();
            $result = true;
        }
        return $result;
    }
    public function getroute($data){
        $year = $this->mylib->get_active_yr();
        $str = "select route from manual_trips{$year} where pperiod = '{$data}' group by route";
        return $this->db->query($str)->result_array();
    }
}