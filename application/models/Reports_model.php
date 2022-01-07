<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reports_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function getallyear(){
        $str = "select `year` from aries.year";
        return $this->db->query($str)->result_array();
    }
    
     public function getperiod(){
        $year = $this->input->post('mdata');
        // $year = $this->mylib->get_active_yr();
        $str = "select cfrom FROM aries.pp{$year}";
        return $this->db->query($str)->result_array();
    }

    public function getpertrip_rpt($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];

        $dbname = "aries";

        $str = "
        SELECT CONCAT(firstname,' ',lastname)AS driver_name,
        vehi.plate_number AS plate_number,
        vehi.unit AS unit,
        IFNULL(reg.trip,0) AS reg_trip,
        IFNULL(reg.amnt,0) AS reg_amnt,
        IFNULL(ext.trip,0) AS ext_trip,
        IFNULL(ext.amnt,0) AS ext_amnt,
        IFNULL(spe.trip,0) AS spe_trip,
        IFNULL(spe.amnt,0) AS spe_amnt
        FROM aries.drivers AS driver
        LEFT JOIN aries.vehicles AS vehi ON vehi.id = driver.vehicle_id
        LEFT JOIN (SELECT driver_id,company_id,pperiod,SUM(total_trip)AS trip,SUM(total_amount)AS amnt FROM {$dbname}.regular_sched{$myear} WHERE company_id = '{$mcompany}' AND pperiod = '{$mperiod}' GROUP BY driver_id,pperiod) AS reg ON reg.driver_id = driver.driver_id
        LEFT JOIN (SELECT driver_id,company_id,pperiod,SUM(total_trip)AS trip,SUM(total_amount)AS amnt FROM {$dbname}.extended_sched{$myear} WHERE company_id = '{$mcompany}' AND pperiod = '{$mperiod}' GROUP BY driver_id,pperiod) AS ext ON ext.driver_id = driver.driver_id
        LEFT JOIN (SELECT driver_id,company_id,pperiod,SUM(total_trip)AS trip,SUM(total_amount)AS amnt FROM {$dbname}.special_sched{$myear} WHERE company_id = '{$mcompany}' AND pperiod = '{$mperiod}' GROUP BY driver_id,pperiod) AS spe ON spe.driver_id = driver.driver_id
        WHERE driver.active = 'Y' AND driver.company = '{$mcompany}' AND (IFNULL(reg.trip,0) + IFNULL(ext.trip,0) + IFNULL(spe.trip,0)) > 0 order by driver.lastname";
        $result['result'] = $this->db->query($str)->result_array();

        $str ="select company_name,refno FROM aries.company WHERE company_id = '{$mcompany}'";
        $result['company'] = $this->db->query($str)->row_array();

        $str ="select pperiod,cfrom,cto,`days` FROM aries.pp{$myear} WHERE pperiod = '{$mperiod}'";
        $result['period'] = $this->db->query($str)->row_array();

        return $result;
    }

    public function getpertripbreakdown_rpt($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $dbname = "aries";

        $type = array('regular','extended','special');
        foreach($type as $row){
            $str = "select 
            rout.route_name,
            reg.rate,
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
            SUM(reg.total_trip)AS total_trip,
            SUM(reg.total_amount)AS total_amount
            FROM {$dbname}.{$row}_sched{$myear} AS reg
            LEFT JOIN aries.routes AS rout ON rout.id = reg.route_code AND `active` = 'Y'
            WHERE reg.company_id = '{$mcompany}' AND reg.pperiod = '{$mperiod}' and reg.total_trip > 0 GROUP BY reg.route_code order by rout.route_name";
            $result[$row] = $this->db->query($str)->result_array();
        }

        $str = "select cmp.company_id,cmp.refno,pp.pperiod,pp.cfrom as cfrom,pp.cto as cto,pp.days FROM aries.company AS cmp
        LEFT JOIN aries.pp{$myear} AS pp ON pp.pperiod = '{$mperiod}'
        WHERE cmp.company_id = '{$mcompany}'";
        $result['rpt_info'] = $this->db->query($str)->row_array();

        return $result;
    }

    public function getperroutebreakdown_rpt($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $mroutetype = $data['mroutetype'];
        $dbname = "aries";

        // $type = array('regular','extended','special');
        // foreach($type as $row){
            $str = "select 
            rout.route_name,
            reg.rate,
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
            SUM(reg.total_trip)AS total_trip,
            SUM(reg.total_amount)AS total_amount
            FROM {$dbname}.{$mroutetype}_sched{$myear} AS reg
            LEFT JOIN aries.routes AS rout ON rout.id = reg.route_code AND `active` = 'Y'
            WHERE reg.company_id = '{$mcompany}' AND reg.pperiod = '{$mperiod}' and reg.total_trip > 0 GROUP BY reg.route_code order by rout.route_name";
            $result['routetype'] = $this->db->query($str)->result_array();
        // }

        $str = "select cmp.company_id,cmp.refno,pp.pperiod,pp.cfrom as cfrom,pp.cto as cto,pp.days FROM aries.company AS cmp
        LEFT JOIN aries.pp{$myear} AS pp ON pp.pperiod = '{$mperiod}'
        WHERE cmp.company_id = '{$mcompany}'";
        $result['rpt_info'] = $this->db->query($str)->row_array();

        return $result;
    }

    public function getperday_rpt($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];

        $dbname = "aries";

        $str = "
        SELECT
        CONCAT(firstname, ' ', lastname) AS driver_name,
        vehi.plate_number AS plate_number,
        vehi.unit AS unit,
        pd.chargeperday,
        pd.days,
        pd.totalamount
        FROM
        aries.drivers AS driver
        LEFT JOIN aries.vehicles AS vehi ON vehi.id = driver.vehicle_id
        LEFT JOIN aries.perday AS pd ON pd.driver_id = driver.driver_id AND pd.company_id = company AND pd.pperiod = '{$mperiod}'
        WHERE driver.active = 'Y'
        AND driver.company = '{$mcompany}'
        AND pd.totalamount > 0 order by driver.lastname";
        $result['result'] = $this->db->query($str)->result_array();

        $str ="select company_name,refno FROM aries.company WHERE company_id = '{$mcompany}'";
        $result['company'] = $this->db->query($str)->row_array();

        $str ="select pperiod,cfrom,cto,`days` FROM aries.pp{$myear} WHERE pperiod = '{$mperiod}'";
        $result['period'] = $this->db->query($str)->row_array();

        return $result;
    }

    public function paypertripproc($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $dbname = "aries";

        $str = "select pay.refno,
        pay.pperiod,
        CONCAT(oper.firstname,' ',oper.lastname)AS operator_name,
        vehi.plate_number,
        pay.totaltrips,
        pay.totalamount,
        pay.tax_10,
        pay.tax_3,
        pay.admin_fee,
        pay.days,
        pay.otherdeduc,
        pay.totalexpenses,
        pay.net
        FROM {$dbname}.payroll_pertrip AS pay
        LEFT JOIN {$dbname}.vehicles AS vehi ON vehi.id = pay.vehicle_id
        LEFT JOIN {$dbname}.operators AS oper ON oper.id = vehi.operator_id
        WHERE pay.company_id = '{$mcompany}' AND DATE(pay.pperiod) = DATE('{$mperiod}')";
        $result['result'] = $this->db->query($str)->result_array();
        return $result;
    }

    public function payperdayproc($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $dbname = "aries";

        $str = "select pay.refno,
        pay.pperiod,
        CONCAT(oper.firstname,' ',oper.lastname)AS operator_name,
        CONCAT(driv.firstname,' ',driv.lastname)AS driver_name,
        vehi.plate_number,
        vehi.unit,
        comp.abbr,
        pay.chargeperday,
        pay.gross,
        pay.tax_10,
        pay.tax_3,
        pay.sop,
        pay.days,
        pay.otherdeduc,
        pay.totalexpenses,
        pay.net,
        (pay.tax_10 / pay.days) as 10percent,
        (pay.tax_3 / pay.days) as 3percent
        FROM {$dbname}.payroll_perday AS pay
        LEFT JOIN aries.company AS comp ON comp.company_id = pay.company_id
        LEFT JOIN {$dbname}.drivers AS driv ON driv.driver_id = pay.driver_id
        LEFT JOIN {$dbname}.vehicles AS vehi ON vehi.id = pay.vehicle_id
        LEFT JOIN {$dbname}.operators AS oper ON oper.id = vehi.operator_id
        WHERE pay.company_id = '{$mcompany}' AND DATE(pay.pperiod) = DATE('{$mperiod}')";
        $result['result'] = $this->db->query($str)->result_array();
        return $result;
    }

    public function paydriverproc($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $dbname = "aries";

        $str = "select
        pay.*,
        CONCAT(driver.firstname,' ',driver.lastname)AS driver_name,
        vehi.plate_number
        FROM {$dbname}.payroll_drivers AS pay
        LEFT JOIN {$dbname}.drivers AS driver ON driver.driver_id = pay.driver_id
        LEFT JOIN {$dbname}.vehicles AS vehi ON vehi.id = pay.vehicle_id
        WHERE pay.company_id = '{$mcompany}' AND DATE(pay.pperiod) = DATE('{$mperiod}')";
        $result['result'] = $this->db->query($str)->result_array();

        $str = "select * from {$dbname}.pp{$myear} where date(pperiod) =  DATE('{$mperiod}')";
        $result['pperiod'] = $this->db->query($str)->row_array();
        return $result;
    }

    public function getperdriverbreakdown_rpt($data=array()){
        $myear = $data['myear'];
        $mcompany = $data['mcompany'];
        $mperiod = $data['mperiod'];
        $dbname = "aries";

        // $str = "select
        // reg.*,
        // route.route_name,
        // route.rate,
        // route.route_trip
        // FROM
        // (SELECT * FROM {$dbname}.regular_sched{$myear} UNION ALL
        // SELECT * FROM {$dbname}.extended_sched{$myear} UNION ALL
        // SELECT * FROM {$dbname}.special_sched{$myear})AS reg
        // LEFT JOIN aries.routes AS route ON route.id = reg.route_code
        // WHERE reg.company_id = '{$mcompany}' AND DATE(reg.pperiod) = DATE('{$mperiod}')";
        // $result['result'] = $this->db->query($str)->result_array();


        $str = "select
        reg.driver_id,
        reg.company_id,
        reg.vehicle_id,
        reg.pperiod,
        pp.days,
        pp.cfrom,
        pp.cto,
        CONCAT(driver.firstname,' ',driver.lastname)AS driver_name,
        comp.company_name,
        comp.refno,
        vehi.plate_number
        FROM
        (SELECT * FROM regular_sched2021 UNION ALL
        SELECT * FROM extended_sched2021 UNION ALL
        SELECT * FROM special_sched2021) AS reg
        LEFT JOIN aries.company AS comp ON comp.company_id = reg.company_id
        LEFT JOIN aries.drivers AS driver ON driver.driver_id = reg.driver_id
        LEFT JOIN aries.vehicles AS vehi ON vehi.id = reg.vehicle_id
        LEFT JOIN aries.pp{$myear} as pp on date(pp.pperiod) = date(reg.pperiod)
        WHERE reg.company_id = '{$mcompany}' AND DATE(reg.pperiod) = DATE('{$mperiod}')
        GROUP BY reg.driver_id,reg.company_id,reg.pperiod";
        $result['result'] = $this->db->query($str)->result_array();

        $types = array('regular','extended','special');
        foreach($result['result'] as $k => $row){
            foreach($types as $type){
                $str = "select aa.*,route.route_name,route.route_trip FROM {$dbname}.{$type}_sched{$myear} AS aa 
                LEFT JOIN aries.routes AS route ON route.id = aa.route_code
                WHERE aa.driver_id = ". $this->db->escape($row['driver_id']) ."
                AND aa.company_id = ". $this->db->escape($row['company_id']) ." 
                AND date(aa.pperiod) = date(". $this->db->escape($row['pperiod']) .")";
                $result['result'][$k][$type] = $this->db->query($str)->result_array();
            }
        }
        
        return $result;
    }

}