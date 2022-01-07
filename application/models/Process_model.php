<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Process_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function loadvehicles(){
        $str = "select aa.driver_id,CONCAT(lastname,', ',firstname,' ',middlename)AS fullname,unit,plate_number,company
        FROM aries.drivers aa 
        LEFT JOIN aries.vehicles bb ON bb.id = aa.vehicle_id and bb.active = 'Y'
        LEFT JOIN aries.company cc on cc.company_id = aa.company and cc.active = 'Y'
        where aa.active = 'Y' order by aa.lastname";
        $result = $this->db->query($str)->result_array();
        return $result;
    }

    public function driverinfo($data=''){
        $str = "select
        driver_id,
        CONCAT(firstname,' ',lastname)AS `FULLNAME`,
        company_name,
        company_id,
        type,
        refno,
        plate_number,
        unit,
        reg_routes,
        ext_routes,
        spe_routes,
        vehicle_id
        FROM
         aries.drivers aa
         LEFT JOIN aries.vehicles bb ON bb.id = aa.vehicle_id
         LEFT JOIN aries.company cc ON cc.company_id = aa.company
         where aa.driver_id = '{$data}'";
         $result = $this->db->query($str)->row_array();
         return $result;
    }

    public function checkpp($data=''){
        $year = $this->mylib->get_active_yr();
        $str = "select * FROM aries.pp{$year}
        WHERE ppost != 'P'/* AND company = (SELECT company FROM aries.drivers WHERE driver_id = '{$data}') ORDER BY cfrom LIMIT 1*/";
        $result = $this->db->query($str)->row_array();
        return $result;
    }

    public function savetrnx($data=array()){
        $year = $this->mylib->get_active_yr();

        if($data['type'] == 'regular'){
            $tablename = "regular_sched{$year}";
        }elseif($data['type'] == 'extended'){
            $tablename = "extended_sched{$year}";
        }elseif($data['type'] == 'special'){
            $tablename = "special_sched{$year}";
        }

        $this->db->trans_begin();

        foreach($data['mdata'] as $row){
            $id = $row['id'];
            $day = $row['_day'];
            $val = $row['value'] == '' ? 0 : $row['value'];
            $value = array(
                $day => $val,
            );
            $this->db->update($tablename, $value ,"id =" . $id);
        }

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

    public function regulartrnx($data=array()){
        $year = $this->mylib->get_active_yr();
        $cfrom = substr($data['pperiod']['cfrom'],8,2);
        $cto = substr($data['pperiod']['cto'],8,2);
        $driver_id = $data['info']['driver_id'];
        $company_id = $data['info']['company_id'];
        $pperiod = $data['pperiod']['cfrom'];
        $vehicle_id = $data['info']['vehicle_id'];

        $pansamantala = "pansamantala";
        $dbname = "aries";
        
        if($data['type'] == 'regular'){
            $routes = explode("xOx",$data['info']['reg_routes']);
            $route_trip = 'R';
            $tablename = "regular_sched{$year}";
        }elseif($data['type'] == 'extended'){
            $routes = explode("xOx",$data['info']['ext_routes']);
            $route_trip = 'E';
            $tablename = "extended_sched{$year}";
        }elseif($data['type'] == 'special'){
            $routes = explode("xOx",$data['info']['spe_routes']);
            $route_trip = 'S';
            $tablename = "special_sched{$year}";
        }

        if(count($routes)==1){
            //NO ROUTES TAGGED IN DRIVER RECORDS
            $sstr = "delete from {$dbname}.{$tablename} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}'";
            $this->db->query($sstr);
            return false;
            die();
        }

        
        $th = '';
        $t = 0;
        $strtot = '(';
        for($i = $cfrom; $i <= $cto; $i++){
        $th .= "<th>" . strval(intval($i)) . "</th>";

        $t++;
        $strtot .= 'day_' . strval(intval($t)) . "+";
        }
        $strtot = substr($strtot,0,strlen($strtot)-1) . ")";       

        $temp_tbl = 'regsched_'. str_replace('-','',$pperiod) . $this->mylib->random_string(10); 
        $str = "create table if not exists {$pansamantala}.{$temp_tbl} (
            `driver_id` VARCHAR(10) DEFAULT '',
            `vehicle_id` VARCHAR(15) DEFAULT '',
            `company_id` VARCHAR(1) DEFAULT '',
            `route_code` VARCHAR(150) DEFAULT '',
            `rate` VARCHAR(6) DEFAULT '0.00',
            `pperiod` VARCHAR(15) DEFAULT '',
            `day_1` VARCHAR(6) DEFAULT '0',
            `day_2` VARCHAR(6) DEFAULT '0',
            `day_3` VARCHAR(6) DEFAULT '0',
            `day_4` VARCHAR(6) DEFAULT '0',
            `day_5` VARCHAR(6) DEFAULT '0',
            `day_6` VARCHAR(6) DEFAULT '0',
            `day_7` VARCHAR(6) DEFAULT '0',
            `day_8` VARCHAR(6) DEFAULT '0',
            `day_9` VARCHAR(6) DEFAULT '0',
            `day_10` VARCHAR(6) DEFAULT '0',
            `day_11` VARCHAR(6) DEFAULT '0',
            `day_12` VARCHAR(6) DEFAULT '0',
            `day_13` VARCHAR(6) DEFAULT '0',
            `day_14` VARCHAR(6) DEFAULT '0',
            `day_15` VARCHAR(6) DEFAULT '0',
            `day_16` VARCHAR(6) DEFAULT '0',
            `total_trip` VARCHAR(6) DEFAULT '0',
            `total_amount` DECIMAL(10,2) DEFAULT '0'
          ) ENGINE=INNODB DEFAULT CHARSET=utf8";
          $this->db->query($str);
        
        $route_codes = "(";
        for($i = 0; $i < count($routes); $i++){
            if(!empty($routes[$i])){
                $route_codes .= "'".$routes[$i]."',";
            }
        }  
        $route_codes = substr($route_codes,0,strlen($route_codes)-1) . ")";

        $str = "insert into {$pansamantala}.{$temp_tbl} (driver_id,vehicle_id,company_id,route_code,rate,pperiod,day_1,day_2,day_3,day_4,day_5,day_6,day_7,day_8,day_9,day_10,day_11,day_12,day_13,day_14,day_15,day_16,total_trip,total_amount)
        (select driver_id,vehicle_id,company_id,route_code,rate,pperiod,day_1,day_2,day_3,day_4,day_5,day_6,day_7,day_8,day_9,day_10,day_11,day_12,day_13,day_14,day_15,day_16,total_trip,total_amount from {$dbname}.{$tablename} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}' and route_code in {$route_codes})";
        $this->db->query($str);
        
        $str = "select * from {$pansamantala}.{$temp_tbl} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}'";
        $query = $this->db->query($str);
        
        $str = "insert into {$pansamantala}.{$temp_tbl} (driver_id,company_id,route_code,rate,pperiod,vehicle_id) VALUES ";
        $row = "";
        if($query->num_rows() == 0){
            for($i = 0; $i < count($routes); $i++){
                if(!empty($routes[$i])){
                    $rate = "select `rate` from {$dbname}.routes where id = '{$routes[$i]}' and route_trip = '{$route_trip}'";
                    $rate = $this->db->query($rate)->row_array();
                    $row .= "('{$driver_id}','{$company_id}','{$routes[$i]}','{$rate['rate']}','{$pperiod}','{$vehicle_id}'),";
                }
            }    
        }else{
            for($i = 0; $i < count($routes); $i++){
                if(!empty($routes[$i])){
                    $chkd = "select * from {$pansamantala}.{$temp_tbl} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}' and route_code = '{$routes[$i]}'";
                    $query = $this->db->query($chkd);
                    if($query->num_rows() == 0){
                        $rate = "select `rate` from {$dbname}.routes where id = '{$routes[$i]}' and route_trip = '{$route_trip}'";
                        $rate = $this->db->query($rate)->row_array();
                        $row .= "('{$driver_id}','{$company_id}','{$routes[$i]}','{$rate['rate']}','{$pperiod}','{$vehicle_id}'),";
                    }
                }
            }   
        }
        $row = substr($row,0,strlen($row)-1);
        $row == '' ? '' : $this->db->query($str . $row);
        
        //SUM TOTAL TRIPS
        $str = "update {$pansamantala}.{$temp_tbl} set total_trip = {$strtot} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}'";
        $this->db->query($str);
        //SUM TOTAL AMOUNT
        $str = "update {$pansamantala}.{$temp_tbl} set total_amount = total_trip * rate where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}'";
        $this->db->query($str);
        //UPDATE
        $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.drivers bb SET aa.vehicle_id = bb.vehicle_id WHERE aa.driver_id = bb.driver_id";
        $this->db->query($str);
        
        $sstr = "delete from {$dbname}.{$tablename} where driver_id = '{$driver_id}' and company_id = '{$company_id}' and pperiod = '{$pperiod}'";
        $this->db->query($sstr);
        
        $sstr = "insert into {$dbname}.{$tablename} select '',driver_id,vehicle_id,company_id,route_code,rate,pperiod,day_1,day_2,day_3,day_4,day_5,day_6,day_7,day_8,day_9,day_10,day_11,day_12,day_13,day_14,day_15,day_16,total_trip,total_amount from {$pansamantala}.{$temp_tbl}";
        $this->db->query($sstr);
        $sstr = "drop table if exists {$pansamantala}.{$temp_tbl}";
        $this->db->query($sstr);
        
        $str = "select aa.*,bb.route_name from {$dbname}.{$tablename} aa
        LEFT JOIN {$dbname}.routes bb ON bb.id = aa.route_code AND bb.route_trip = '{$route_trip}'
        where aa.driver_id = '{$driver_id}' and aa.company_id = '{$company_id}' and aa.pperiod = '{$pperiod}' order by bb.route_name";
        $info = $this->db->query($str)->result_array();

        $result['total_days'] = $t;
        $result['from'] = $cfrom;
        $result['to'] = $cto;
        $result['result'] = $info;

        return $result;
    }

    public function loadtrnxperday($data=array()){
        
        $driver_id = $data['driver_id'];
        $company_id = $data['company_id'];
        $pperiod = $data['pperiod'];
        $tablename = 'perday';
        
        $str = "select
        ifnull(chargeperday,0) as chargeperday,
        ifnull(days,0) as days,
        ifnull(totalamount,0) as totalamount 
        from aries.{$tablename} where driver_id='{$driver_id}' and company_id='{$company_id}' and pperiod='{$pperiod}'";
        return $this->db->query($str)->row_array();
    }

    public function savetrnxperday($data=array()){
        $driver_id = $data['driver_id'];
        $company_id = $data['company_id'];
        $pperiod = $data['pperiod'];
        $tablename = 'perday';
        $chargeperday = $data['chargeperday'];
        $days = $data['days'];
        $total_amount = intval($days) * intval($chargeperday);
        
        $str = "select * from aries.{$tablename} where driver_id='{$driver_id}' and company_id='{$company_id}' and pperiod='{$pperiod}'";
        $query = $this->db->query($str);


        $this->db->trans_begin();
        if($query->num_rows() > 0){
            //update
            $row = $query->row_array();
            $value = array(
                    'chargeperday' => $chargeperday,
                    'days' => $days,
                    'totalamount' => $total_amount
                );
            $this->db->update($tablename,$value, "id=".$row['id']);
        }else{
            //insert
            $value = array(
                'driver_id' => $driver_id,
                'company_id' => $company_id,
                'pperiod' => $pperiod,
                'chargeperday' => $chargeperday,
                'days' => $days,
                'totalamount' => $total_amount
            );
            $this->db->insert($tablename,$value);
        }

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

    public function getactiveperiod(){
        $myear = $this->mylib->get_active_yr();
        $str = "select * from aries.pp{$myear} where ppost != 'P' order by pperiod limit 1";
        return $this->db->query($str)->result_array();
    }

    public function processpayroll($data=array()){
        $myear = $this->mylib->get_active_yr();
        $mperiod = $data['mperiod'];
        $pansamantala = "pansamantala";
        $dbname = "aries";
        $tablename = 'payroll_pertrip';

        $str = "select * from {$dbname}.pp{$myear} where date(pperiod) = date('{$mperiod}') and ppost = 'P'";
        $query = $this->db->query($str);
        if($query->num_rows() > 0){
            return 'posted';
            $query->free_result();
            die();
        }

        $str = "select `company_id`,`type` from {$dbname}.company where `active` = 'Y'";
        $query = $this->db->query($str);
        
        if($query->num_rows() > 0){
            $rows = $query->result_array();
            foreach($rows as $row){
                //process company per trip
                if($row['type'] == 'T'){
                    $comp = $row['company_id'];
                    $temp_tbl = 'payroll'. str_replace('-','',$mperiod) . $this->mylib->random_string(10);
                    $str = "drop table if exists {$pansamantala}.{$temp_tbl}";
                    $this->db->query($str);

                    $str = "create table if not exists {$pansamantala}.{$temp_tbl} (
                        `company_id` varchar(1) DEFAULT '',
                        `driver_id` varchar(15) DEFAULT '',
                        `vehicle_id` varchar(10) DEFAULT '',
                        `pperiod` date DEFAULT '0000-00-00',
                        `totaltrips` varchar(10) DEFAULT '0',
                        `totalamount` decimal(10,2) DEFAULT '0.00',
                        `otherdeduc` decimal(10,2) DEFAULT '0.00',
                        `tax_10` decimal(10,2) DEFAULT '0.00',
                        `tax_3` decimal(10,2) DEFAULT '0.00',
                        `admin_fee` decimal(10,2) DEFAULT '0.00',
                        `days` varchar(10) DEFAULT '0',
                        `totalexpenses` decimal(10,2) DEFAULT '0.00',
                        `net` decimal(10,2) DEFAULT '0.00',
                        `refno` varchar(50) DEFAULT ''
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
                    $this->db->query($str);

                    $str = "insert into {$pansamantala}.{$temp_tbl} (company_id,driver_id,pperiod,totaltrips,totalamount)
                    (select aa.company_id,aa.driver_id,aa.pperiod,SUM(aa.total_trip)AS total_trips,SUM(aa.total_amount) AS total_amount 
                    FROM
                    (SELECT * FROM {$dbname}.regular_sched{$myear} WHERE company_id = '{$comp}' and pperiod = '{$mperiod}'
                    UNION ALL 
                    SELECT * FROM {$dbname}.extended_sched{$myear} WHERE company_id = '{$comp}' and pperiod = '{$mperiod}'
                    UNION ALL 
                    SELECT * FROM {$dbname}.special_sched{$myear} WHERE company_id = '{$comp}' and pperiod = '{$mperiod}')AS aa
                    WHERE aa.driver_id IN (SELECT driver_id FROM {$dbname}.drivers AS driver WHERE active = 'Y' and company = '{$comp}')
                    GROUP BY aa.driver_id,aa.company_id,aa.pperiod)";
                    $this->db->query($str);

                    $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.pp{$myear} bb set aa.days = bb.days where company_id = '{$comp}' and date(bb.pperiod) = date('{$mperiod}')";
                    $this->db->query($str);

                    $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.drivers bb SET aa.vehicle_id = bb.vehicle_id
                    WHERE aa.driver_id = bb.driver_id";
                    $this->db->query($str);

                    $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.company bb SET aa.refno = bb.refno
                    WHERE aa.company_id = bb.company_id";
                    $this->db->query($str);

                    $str = "update {$pansamantala}.{$temp_tbl} 
                    set tax_10 = totalamount * .10,tax_3 = totalamount * .03,admin_fee = 83 * days
                    where company_id = '{$comp}' and pperiod = '{$mperiod}' and totalamount > 0";
                    $this->db->query($str);

                    $str = "update {$pansamantala}.{$temp_tbl} 
                    set totalexpenses = tax_10 + tax_3 + admin_fee + otherdeduc,
                    net = (totalamount - (tax_10 + tax_3 + admin_fee))
                    where company_id = '{$comp}' and pperiod = '{$mperiod}'";
                    $this->db->query($str);


                    $this->db->trans_begin();
                    $sstr = "delete from {$dbname}.payroll_pertrip where company_id = '{$comp}' and pperiod = '{$mperiod}'";
                    $this->db->query($sstr);

                    $sstr = "insert into {$dbname}.payroll_pertrip (company_id,driver_id,vehicle_id,pperiod,totaltrips,totalamount,tax_10,tax_3,admin_fee,days,totalexpenses,net,refno)(select company_id,driver_id,vehicle_id,pperiod,totaltrips,totalamount,tax_10,tax_3,admin_fee,days,totalexpenses,net,refno from {$pansamantala}.{$temp_tbl})";
                    $this->db->query($sstr);

                    //PROCESS PAYROLL OF PERTRIP DRIVERS

                    $sstr = "delete from {$dbname}.payroll_drivers where company_id = '{$comp}' and pperiod = '{$mperiod}'";
                    $this->db->query($sstr);
                    
                    $str = "insert into {$dbname}.payroll_drivers (vehicle_id,driver_id,company_id,pperiod,day_1,day_2,day_3,day_4,day_5,day_6,day_7,day_8,day_9,day_10,day_11,day_12,day_13,day_14,day_15,day_16,total_trip)
                    (SELECT 
                    reg.vehicle_id,
                    reg.driver_id,
                    reg.company_id,
                    reg.pperiod,
                    SUM(reg.day_1)AS day_1,
                    SUM(reg.day_2)AS day_2,
                    SUM(reg.day_3)AS day_3,
                    SUM(reg.day_4)AS day_4,
                    SUM(reg.day_5)AS day_5,
                    SUM(reg.day_6)AS day_6,
                    SUM(reg.day_7)AS day_7,
                    SUM(reg.day_8)AS day_8,
                    SUM(reg.day_9)AS day_9,
                    SUM(reg.day_10)AS day_10,
                    SUM(reg.day_11)AS day_11,
                    SUM(reg.day_12)AS day_12,
                    SUM(reg.day_13)AS day_13,
                    SUM(reg.day_14)AS day_14,
                    SUM(reg.day_15)AS day_15,
                    SUM(reg.day_16)AS day_16,
                    SUM(reg.total_trip)AS total_trip
                    FROM 
                    (SELECT * FROM {$dbname}.regular_sched{$myear} WHERE company_id = '{$comp}' AND DATE(pperiod) = DATE('{$mperiod}') UNION ALL
                    SELECT * FROM {$dbname}.extended_sched{$myear} WHERE company_id = '{$comp}' AND DATE(pperiod) = DATE('{$mperiod}') UNION ALL
                    SELECT * FROM {$dbname}.special_sched{$myear} WHERE company_id = '{$comp}' AND DATE(pperiod) = DATE('{$mperiod}')) AS reg 
                    WHERE reg.company_id = '{$comp}' AND DATE(reg.pperiod) = DATE('{$mperiod}') AND reg.total_trip > 0
                    GROUP BY driver_id,vehicle_id,company_id,pperiod)";
                    $this->db->query($str);

                    $str = "update {$dbname}.payroll_drivers set rate = 125, salary = 125 * total_trip
                    where company_id = '{$comp}' and DATE(pperiod) = DATE('{$mperiod}')";
                    $this->db->query($str);
                    
                    $sstr = "drop table if exists {$pansamantala}.{$temp_tbl}";
                    $this->db->query($sstr);
                        
                    $this->db->trans_complete();
                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $result = false;
                        return $result;
                        die();
                    }else{
                        $this->db->trans_commit();
                        $result = true;
                    }

                //process company per day
                }elseif($row['type'] == 'D'){
                    $comp = $row['company_id'];
                    $temp_tbl = 'payroll'. str_replace('-','',$mperiod) . $this->mylib->random_string(10);
                    $str = "drop table if exists {$pansamantala}.{$temp_tbl}";
                    $this->db->query($str);

                    $str = "select driver_id FROM {$dbname}.drivers AS driver WHERE active = 'Y' and company = '{$comp}'";
                    $query = $this->db->query($str);
                    if($query->num_rows() > 0){
                        $query->free_result();
                        $str = "create table if not exists {$pansamantala}.{$temp_tbl} (
                            `company_id` varchar(2) DEFAULT '',
                            `driver_id` varchar(15) DEFAULT '',
                            `vehicle_id` varchar(10) DEFAULT '',
                            `pperiod` date DEFAULT '0000-00-00',
                            `chargeperday` decimal(10,2) DEFAULT '0.00',
                            `gross` decimal(10,2) DEFAULT '0.00',
                            `otherdeduc` decimal(10,2) DEFAULT '0.00',
                            `tax_10` decimal(10,2) DEFAULT '0.00',
                            `tax_3` decimal(10,2) DEFAULT '0.00',
                            `sop` decimal(10,2) DEFAULT '0.00',
                            `days` varchar(10) DEFAULT '0',
                            `totalexpenses` decimal(10,2) DEFAULT '0.00',
                            `net` decimal(10,2) DEFAULT '0.00',
                            `refno` varchar(50) DEFAULT ''
                          ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
                        $this->db->query($str);

                        $str = "insert INTO {$pansamantala}.{$temp_tbl} (driver_id,company_id,pperiod,chargeperday,days,gross)
                        (SELECT driver_id,company_id,pperiod,chargeperday,days,totalamount
                        FROM aries.perday
                        WHERE company_id = '{$comp}' 
                        AND DATE(pperiod) = DATE('{$mperiod}')
                        AND driver_id IN (SELECT `driver_id` FROM {$dbname}.drivers WHERE `active` = 'Y' AND company = '{$comp}'))";
                        $this->db->query($str);

                        $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.pp{$myear} bb set aa.days = bb.days where company_id = '{$comp}' and date(bb.pperiod) = date('{$mperiod}')";
                        $this->db->query($str);

                        $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.company bb SET aa.refno = bb.refno
                        WHERE aa.company_id = bb.company_id";
                        $this->db->query($str);

                        $str = "update {$pansamantala}.{$temp_tbl} aa, {$dbname}.drivers bb SET aa.vehicle_id = bb.vehicle_id
                        WHERE aa.driver_id = bb.driver_id";
                        $this->db->query($str);

                        $str = "update {$pansamantala}.{$temp_tbl} 
                        set tax_10 = ((if(chargeperday >= 4500, 4500,chargeperday) * .10) * days),
                            tax_3 = ((if(chargeperday >= 4500, 4500,chargeperday) * .03)* days),
                            sop = 83 * days
                        where company_id = '{$comp}' and pperiod = '{$mperiod}' and gross > 0";
                        $this->db->query($str);

                        $str = "update {$pansamantala}.{$temp_tbl} 
                        set totalexpenses = tax_10 + tax_3 + sop + otherdeduc,
                        net = (gross - (tax_10 + tax_3 + sop + otherdeduc))
                        where company_id = '{$comp}' and pperiod = '{$mperiod}'";
                        $this->db->query($str);

                        $this->db->trans_begin();
                        $sstr = "delete from {$dbname}.payroll_perday where company_id = '{$comp}' and pperiod = '{$mperiod}'";
                        $this->db->query($sstr);

                        $sstr = "insert into {$dbname}.payroll_perday (company_id,driver_id,vehicle_id,pperiod,chargeperday,gross,otherdeduc,tax_10,tax_3,sop,days,totalexpenses,net,refno)(select company_id,driver_id,vehicle_id,pperiod,chargeperday,gross,otherdeduc,tax_10,tax_3,sop,days,totalexpenses,net,refno from {$pansamantala}.{$temp_tbl})";
                        $this->db->query($sstr);

                        $sstr = "drop table if exists {$pansamantala}.{$temp_tbl}";
                        $this->db->query($sstr);
                            
                        $this->db->trans_complete();
                        if($this->db->trans_status() === FALSE){
                            $this->db->trans_rollback();
                            $result = false;
                            return $result;
                            die();
                        }else{
                            $this->db->trans_commit();
                            $result = true;
                        }
                    }

                }
            }
        }else{
            $result = 'nocomp';
        }

        if($result == true){
            $sstr = "update {$dbname}.pp{$myear} set ppost = 'P' where date(pperiod) = date('{$mperiod}')";
            $this->db->query($sstr);
        }

        return $result;


    }


}