/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.2.37-MariaDB : Database - aries
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aries` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aries`;

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `company_id` varchar(5) DEFAULT '',
  `company_name` varchar(100) DEFAULT '',
  `refno` varchar(50) DEFAULT '00000',
  `address` varchar(150) DEFAULT '',
  `tinno` varchar(15) DEFAULT '000-000-000-000',
  `abbr` varchar(50) DEFAULT '',
  `active` varbinary(1) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `contact` varchar(11) DEFAULT '',
  `type` varchar(1) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `company_test` */

DROP TABLE IF EXISTS `company_test`;

CREATE TABLE `company_test` (
  `company_id` varchar(5) DEFAULT '',
  `company_name` varchar(100) DEFAULT '',
  `refno` varchar(50) DEFAULT '00000',
  `address` varchar(150) DEFAULT '',
  `abbr` varchar(50) DEFAULT '',
  `active` varbinary(1) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `contact` varchar(11) DEFAULT '',
  `type` varchar(1) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `department` */

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) DEFAULT NULL,
  `active` varchar(1) DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `drivers` */

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(15) DEFAULT '',
  `lastname` varchar(100) DEFAULT '',
  `firstname` varchar(100) DEFAULT '',
  `middlename` varchar(100) DEFAULT '',
  `contact` varchar(15) DEFAULT '',
  `address` varchar(150) DEFAULT '',
  `active` varchar(1) DEFAULT '',
  `company` varchar(1) DEFAULT '',
  `vehicle_id` varchar(2) DEFAULT '',
  `reg_routes` varchar(200) DEFAULT '',
  `ext_routes` varchar(200) DEFAULT '',
  `spe_routes` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

/*Table structure for table `drivers_test` */

DROP TABLE IF EXISTS `drivers_test`;

CREATE TABLE `drivers_test` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(15) DEFAULT '',
  `lastname` varchar(100) DEFAULT '',
  `firstname` varchar(100) DEFAULT '',
  `middlename` varchar(100) DEFAULT '',
  `contact` varchar(15) DEFAULT '',
  `address` varchar(150) DEFAULT '',
  `active` varchar(1) DEFAULT '',
  `company` varchar(1) DEFAULT '',
  `vehicle_id` varchar(10) DEFAULT '',
  `reg_routes` varchar(200) DEFAULT '',
  `ext_routes` varchar(200) DEFAULT '',
  `spe_routes` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Table structure for table `extended_sched2021` */

DROP TABLE IF EXISTS `extended_sched2021`;

CREATE TABLE `extended_sched2021` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=214053 DEFAULT CHARSET=latin1;

/*Table structure for table `extended_sched2022` */

DROP TABLE IF EXISTS `extended_sched2022`;

CREATE TABLE `extended_sched2022` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37520 DEFAULT CHARSET=latin1;

/*Table structure for table `extended_sched2023` */

DROP TABLE IF EXISTS `extended_sched2023`;

CREATE TABLE `extended_sched2023` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Table structure for table `extended_sched2024` */

DROP TABLE IF EXISTS `extended_sched2024`;

CREATE TABLE `extended_sched2024` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

/*Table structure for table `id_ctr` */

DROP TABLE IF EXISTS `id_ctr`;

CREATE TABLE `id_ctr` (
  `id_number` varchar(200) NOT NULL,
  PRIMARY KEY (`id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `id_ctr_test` */

DROP TABLE IF EXISTS `id_ctr_test`;

CREATE TABLE `id_ctr_test` (
  `id_number` varchar(200) NOT NULL,
  PRIMARY KEY (`id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `manual_trips2023` */

DROP TABLE IF EXISTS `manual_trips2023`;

CREATE TABLE `manual_trips2023` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(15) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `pperiod` varchar(15) DEFAULT NULL,
  `route` longtext DEFAULT NULL,
  `rates` decimal(10,2) DEFAULT 0.00,
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Table structure for table `manual_trips2024` */

DROP TABLE IF EXISTS `manual_trips2024`;

CREATE TABLE `manual_trips2024` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(15) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `pperiod` varchar(15) DEFAULT NULL,
  `route` longtext DEFAULT NULL,
  `rates` decimal(10,2) DEFAULT 0.00,
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `operators` */

DROP TABLE IF EXISTS `operators`;

CREATE TABLE `operators` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(200) DEFAULT '',
  `lastname` varchar(100) DEFAULT '',
  `firstname` varchar(100) DEFAULT '',
  `middlename` varchar(100) DEFAULT '',
  `contact` varbinary(12) DEFAULT '',
  `address` varchar(150) DEFAULT '',
  `active` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Table structure for table `operators_test` */

DROP TABLE IF EXISTS `operators_test`;

CREATE TABLE `operators_test` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(10) DEFAULT '',
  `lastname` varchar(100) DEFAULT '',
  `firstname` varchar(100) DEFAULT '',
  `middlename` varchar(100) DEFAULT '',
  `contact` varbinary(12) DEFAULT '',
  `address` varchar(150) DEFAULT '',
  `active` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `payroll_drivers` */

DROP TABLE IF EXISTS `payroll_drivers`;

CREATE TABLE `payroll_drivers` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(10) DEFAULT '',
  `driver_id` varchar(15) DEFAULT '',
  `company_id` varchar(2) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `bonus` decimal(10,2) DEFAULT 0.00,
  `salary` decimal(10,2) DEFAULT 0.00,
  `rate` decimal(10,2) DEFAULT 0.00,
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1192 DEFAULT CHARSET=latin1;

/*Table structure for table `payroll_perday` */

DROP TABLE IF EXISTS `payroll_perday`;

CREATE TABLE `payroll_perday` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(2) DEFAULT '',
  `driver_id` varchar(15) DEFAULT '',
  `vehicle_id` varchar(10) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `chargeperday` decimal(10,2) DEFAULT 0.00,
  `gross` decimal(10,2) DEFAULT 0.00,
  `otherdeduc` decimal(10,2) DEFAULT 0.00,
  `tax_10` decimal(10,2) DEFAULT 0.00,
  `tax_3` decimal(10,2) DEFAULT 0.00,
  `sop` decimal(10,2) DEFAULT 0.00,
  `days` varchar(10) DEFAULT '0',
  `totalexpenses` decimal(10,2) DEFAULT 0.00,
  `net` decimal(10,2) DEFAULT 0.00,
  `refno` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Table structure for table `payroll_pertrip` */

DROP TABLE IF EXISTS `payroll_pertrip`;

CREATE TABLE `payroll_pertrip` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(2) DEFAULT '',
  `driver_id` varchar(15) DEFAULT '',
  `vehicle_id` varchar(10) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `totaltrips` varchar(10) DEFAULT '0',
  `totalamount` decimal(10,2) DEFAULT 0.00,
  `manualtrips` varchar(10) DEFAULT '0',
  `manualtripsamount` decimal(10,2) DEFAULT 0.00,
  `otherdeduc` decimal(10,2) DEFAULT 0.00,
  `tax_10` decimal(10,2) DEFAULT 0.00,
  `tax_3` decimal(10,2) DEFAULT 0.00,
  `admin_fee` decimal(10,2) DEFAULT 0.00,
  `days` varchar(10) DEFAULT '0',
  `totalexpenses` decimal(10,2) DEFAULT 0.00,
  `net` decimal(10,2) DEFAULT 0.00,
  `refno` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1237 DEFAULT CHARSET=latin1;

/*Table structure for table `perday` */

DROP TABLE IF EXISTS `perday`;

CREATE TABLE `perday` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `pperiod` varchar(15) DEFAULT '',
  `chargeperday` double(10,2) DEFAULT 0.00,
  `days` varchar(3) DEFAULT '0',
  `totalamount` double(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `perday_test` */

DROP TABLE IF EXISTS `perday_test`;

CREATE TABLE `perday_test` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `pperiod` varchar(15) DEFAULT '',
  `chargeperday` double(10,2) DEFAULT 0.00,
  `days` varchar(3) DEFAULT '0',
  `totalamount` double(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `pmtempl` */

DROP TABLE IF EXISTS `pmtempl`;

CREATE TABLE `pmtempl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EMPNUMB` varchar(15) DEFAULT ' ',
  `EMPLNAM` varchar(15) DEFAULT ' ',
  `EMPFNAM` varchar(20) DEFAULT ' ',
  `EMPMNAM` varchar(15) DEFAULT ' ',
  `EMPSUFFIX` varchar(5) DEFAULT ''' ''',
  `EMPSXCD` varchar(1) DEFAULT ' ',
  `EMPBDTE` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPPOBT` varchar(15) DEFAULT ' ',
  `EMPRGCD` varchar(2) DEFAULT ' ',
  `EMPCSCD` varchar(1) DEFAULT ' ',
  `EMPCADD` varchar(40) DEFAULT ' ',
  `EMPTOWN` varchar(20) DEFAULT ' ',
  `EMPCITY` varchar(20) DEFAULT ' ',
  `EMPCZCD` varchar(2) DEFAULT ' ',
  `EMPTXCD` varchar(10) DEFAULT ' ',
  `EMPLDTE` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPSSNO` varchar(12) DEFAULT ' ',
  `EMPTINO` varchar(11) DEFAULT ' ',
  `EMPHDTE` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPODTE` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPPMCD` varchar(1) DEFAULT ' ',
  `EMPPCCD` varchar(1) DEFAULT ' ',
  `EMPCOCD` varchar(1) DEFAULT ' ',
  `EMPLCCD` varchar(4) DEFAULT ' ',
  `EMPSTAT` varchar(1) DEFAULT ' ',
  `EMPSTDT` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPPINO` varchar(19) DEFAULT ' ',
  `EMPAVOL` tinyint(1) DEFAULT 0,
  `EMPPVOL` tinyint(1) DEFAULT 0,
  `EMPTDPD` varchar(1) DEFAULT ' ',
  `EMPCBAT` varchar(1) DEFAULT ' ',
  `EMPDPCD` varchar(10) DEFAULT ' ',
  `EMPESCD` varchar(1) DEFAULT ' ',
  `EMPDPCC` varchar(10) DEFAULT ' ',
  `EMPINCO` varchar(1) DEFAULT ' ',
  `EMPALLO` double(15,2) DEFAULT 0.00,
  `EMPFEPF` varchar(1) DEFAULT ' ',
  `EMPHLDT` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPMENO` varchar(19) DEFAULT ' ',
  `EMPDBNK` varchar(5) DEFAULT ' ',
  `EMPEOCD` datetime DEFAULT '0000-00-00 00:00:00',
  `EMPEOCC` varchar(1) DEFAULT ' ',
  `EMPADDR1` varchar(500) DEFAULT ' ',
  `EMPADDR2` varchar(500) DEFAULT ' ',
  `EMPADDR3` varchar(500) DEFAULT ' ',
  `EMPADDR4` varchar(500) DEFAULT ' ',
  `EMPATMP` varchar(16) DEFAULT ' ',
  `EMPTELN` varchar(500) DEFAULT ' ',
  `EMPBKCD` varchar(5) DEFAULT ' ',
  `EMPUNITHEAD` varchar(150) DEFAULT ' ',
  `EMPUNIT` varchar(150) DEFAULT ' ',
  `EMPDEMINI_AMT` double(15,2) DEFAULT 0.00,
  `EMPCOMBASED` varchar(1) DEFAULT NULL,
  `EMPDPROC` datetime DEFAULT NULL,
  `EMPEPAYSLIP` varchar(1) DEFAULT NULL,
  `EMPWGCONTRI` int(1) DEFAULT 0,
  `EMPDEPTHEAD` varchar(255) DEFAULT NULL,
  `EMPDEPT` varchar(100) DEFAULT NULL,
  `fldCreated_by` varchar(100) DEFAULT NULL,
  `fldCreated_on` datetime DEFAULT NULL,
  `fldUpdated_by` varchar(100) DEFAULT NULL,
  `fldUpdated_on` datetime DEFAULT NULL,
  `fldregcode` varchar(100) DEFAULT NULL,
  `fldctycode` varchar(100) DEFAULT NULL,
  `fldbrgycode` varchar(100) DEFAULT NULL,
  `fldzpcode` varchar(100) DEFAULT NULL,
  `fldmomaidenname` varchar(255) DEFAULT NULL,
  `fldsubmittedid` varchar(255) DEFAULT NULL,
  `fldsubmittedidno` varchar(255) DEFAULT NULL,
  `fldorigempno` varchar(255) DEFAULT NULL COMMENT 'for loaned employees',
  `EMPSTATUS_POS` smallint(6) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pmtempl1` (`EMPNUMB`),
  KEY `pmtempl2` (`EMPLNAM`,`EMPFNAM`,`EMPMNAM`),
  KEY `pmtempl3` (`EMPSSNO`),
  FULLTEXT KEY `EMPNUMB` (`EMPNUMB`),
  FULLTEXT KEY `EMPLNAM` (`EMPLNAM`),
  FULLTEXT KEY `EMPFNAM` (`EMPFNAM`),
  FULLTEXT KEY `EMPMNAM` (`EMPMNAM`),
  FULLTEXT KEY `searchindx01` (`EMPNUMB`,`EMPLNAM`,`EMPFNAM`,`EMPMNAM`),
  FULLTEXT KEY `searchindx02` (`EMPLNAM`,`EMPFNAM`),
  FULLTEXT KEY `searchindx03` (`EMPLNAM`,`EMPFNAM`,`EMPMNAM`),
  FULLTEXT KEY `searchindx04` (`EMPFNAM`,`EMPLNAM`)
) ENGINE=InnoDB AUTO_INCREMENT=1077192 DEFAULT CHARSET=utf8;

/*Table structure for table `pmtemve` */

DROP TABLE IF EXISTS `pmtemve`;

CREATE TABLE `pmtemve` (
  `recid` int(25) NOT NULL AUTO_INCREMENT,
  `EMVNUMB` varchar(15) DEFAULT NULL,
  `EMVEDTE` datetime DEFAULT NULL,
  `EMVSCCD` varchar(3) DEFAULT NULL,
  `EMVSFCD` varchar(25) DEFAULT NULL,
  `EMVLCCD` varchar(4) DEFAULT NULL,
  `EMVDPCD` varchar(10) DEFAULT NULL,
  `EMVPSCD` varchar(3) DEFAULT NULL,
  `EMVBPAY` double(15,5) DEFAULT NULL,
  `EMVALLO` double(15,5) DEFAULT NULL,
  `EMVRDCD` varchar(2) DEFAULT NULL,
  `EMVESCD` varchar(1) DEFAULT NULL,
  `EMVFLAG` tinyint(1) DEFAULT NULL,
  `EMVPCCD` varchar(1) DEFAULT NULL,
  `EMVCOCD` varchar(1) DEFAULT NULL,
  `EMVFPER` varchar(1) DEFAULT NULL,
  `EMVPACD` varchar(3) DEFAULT NULL,
  `EMVDPCC` varchar(10) DEFAULT NULL,
  `EMVPADT` datetime DEFAULT NULL,
  `EMVTDPD` varchar(1) DEFAULT NULL,
  `EMVBLOC` varchar(3) DEFAULT NULL,
  `EMVTGTB` tinyint(1) DEFAULT 0 COMMENT 'is Target Based',
  `OCODE` varchar(3) DEFAULT NULL,
  `EMVWSCD` varchar(25) DEFAULT '',
  `DEMINIMISALLOW` double(15,5) DEFAULT NULL,
  `OTHERALLOW` double(15,5) DEFAULT NULL,
  `QUOTATYPE` varchar(5) DEFAULT NULL,
  `EMVPOMARK` varchar(50) DEFAULT '',
  `fldCreated_by` varchar(100) DEFAULT NULL,
  `fldCreated_on` datetime DEFAULT NULL,
  `fldUpdated_by` varchar(100) DEFAULT NULL,
  `fldUpdated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`recid`),
  KEY `OCODE` (`OCODE`),
  KEY `EMVNUMB` (`EMVNUMB`,`EMVEDTE`),
  KEY `pmtemve1` (`EMVNUMB`),
  KEY `EMVWSCD` (`EMVWSCD`)
) ENGINE=InnoDB AUTO_INCREMENT=38381783 DEFAULT CHARSET=utf8;

/*Table structure for table `pp2021` */

DROP TABLE IF EXISTS `pp2021`;

CREATE TABLE `pp2021` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cutoff` varchar(3) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `cfrom` date DEFAULT '0000-00-00',
  `cto` date DEFAULT '0000-00-00',
  `ppost` varchar(1) DEFAULT '',
  `days` varchar(2) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Table structure for table `pp2021_test` */

DROP TABLE IF EXISTS `pp2021_test`;

CREATE TABLE `pp2021_test` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cutoff` varchar(3) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `cfrom` date DEFAULT '0000-00-00',
  `cto` date DEFAULT '0000-00-00',
  `ppost` varchar(1) DEFAULT '',
  `days` varchar(2) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `pp2022` */

DROP TABLE IF EXISTS `pp2022`;

CREATE TABLE `pp2022` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cutoff` varchar(3) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `cfrom` date DEFAULT '0000-00-00',
  `cto` date DEFAULT '0000-00-00',
  `ppost` varchar(1) DEFAULT '',
  `days` varchar(2) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Table structure for table `pp2023` */

DROP TABLE IF EXISTS `pp2023`;

CREATE TABLE `pp2023` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cutoff` varchar(3) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `cfrom` date DEFAULT '0000-00-00',
  `cto` date DEFAULT '0000-00-00',
  `ppost` varchar(1) DEFAULT '',
  `days` varchar(2) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `pp2024` */

DROP TABLE IF EXISTS `pp2024`;

CREATE TABLE `pp2024` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cutoff` varchar(3) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `cfrom` date DEFAULT '0000-00-00',
  `cto` date DEFAULT '0000-00-00',
  `ppost` varchar(1) DEFAULT '',
  `days` varchar(2) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `regular_sched2021` */

DROP TABLE IF EXISTS `regular_sched2021`;

CREATE TABLE `regular_sched2021` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279815 DEFAULT CHARSET=latin1;

/*Table structure for table `regular_sched2022` */

DROP TABLE IF EXISTS `regular_sched2022`;

CREATE TABLE `regular_sched2022` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111389 DEFAULT CHARSET=latin1;

/*Table structure for table `regular_sched2023` */

DROP TABLE IF EXISTS `regular_sched2023`;

CREATE TABLE `regular_sched2023` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=latin1;

/*Table structure for table `regular_sched2024` */

DROP TABLE IF EXISTS `regular_sched2024`;

CREATE TABLE `regular_sched2024` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2639 DEFAULT CHARSET=latin1;

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `route_code` varbinary(50) DEFAULT NULL,
  `route_name` varchar(100) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `rate` double(15,2) DEFAULT 0.00,
  `route_trip` varchar(1) DEFAULT NULL,
  `active` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=465 DEFAULT CHARSET=latin1;

/*Table structure for table `routes_test` */

DROP TABLE IF EXISTS `routes_test`;

CREATE TABLE `routes_test` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `route_code` varbinary(50) DEFAULT NULL,
  `route_name` varchar(100) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `rate` double(15,2) DEFAULT 0.00,
  `route_trip` varchar(1) DEFAULT NULL,
  `active` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `special_sched2021` */

DROP TABLE IF EXISTS `special_sched2021`;

CREATE TABLE `special_sched2021` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106748 DEFAULT CHARSET=latin1;

/*Table structure for table `special_sched2022` */

DROP TABLE IF EXISTS `special_sched2022`;

CREATE TABLE `special_sched2022` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` varchar(6) DEFAULT '0.00',
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24693 DEFAULT CHARSET=latin1;

/*Table structure for table `special_sched2023` */

DROP TABLE IF EXISTS `special_sched2023`;

CREATE TABLE `special_sched2023` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `special_sched2024` */

DROP TABLE IF EXISTS `special_sched2024`;

CREATE TABLE `special_sched2024` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `vehicle_id` varchar(15) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `route_code` varchar(150) DEFAULT '',
  `rate` decimal(10,2) DEFAULT 0.00,
  `pperiod` varchar(15) DEFAULT '',
  `day_1` varchar(6) DEFAULT '0',
  `day_2` varchar(6) DEFAULT '0',
  `day_3` varchar(6) DEFAULT '0',
  `day_4` varchar(6) DEFAULT '0',
  `day_5` varchar(6) DEFAULT '0',
  `day_6` varchar(6) DEFAULT '0',
  `day_7` varchar(6) DEFAULT '0',
  `day_8` varchar(6) DEFAULT '0',
  `day_9` varchar(6) DEFAULT '0',
  `day_10` varchar(6) DEFAULT '0',
  `day_11` varchar(6) DEFAULT '0',
  `day_12` varchar(6) DEFAULT '0',
  `day_13` varchar(6) DEFAULT '0',
  `day_14` varchar(6) DEFAULT '0',
  `day_15` varchar(6) DEFAULT '0',
  `day_16` varchar(6) DEFAULT '0',
  `total_trip` varchar(6) DEFAULT '0',
  `total_amount` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=latin1;

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `operator_id` varchar(15) DEFAULT '',
  `plate_number` varchar(15) DEFAULT '',
  `unit` varchar(50) DEFAULT '',
  `stat` varchar(2) DEFAULT '',
  `active` varbinary(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Table structure for table `vehicles_test` */

DROP TABLE IF EXISTS `vehicles_test`;

CREATE TABLE `vehicles_test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `operator_id` varchar(15) DEFAULT '',
  `plate_number` varchar(15) DEFAULT '',
  `unit` varchar(50) DEFAULT '',
  `stat` varchar(2) DEFAULT '',
  `active` varbinary(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `year` */

DROP TABLE IF EXISTS `year`;

CREATE TABLE `year` (
  `year` year(4) DEFAULT NULL,
  `post` varchar(1) DEFAULT '' COMMENT 'mark "Y" if posted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `paypertrip_view` */

DROP TABLE IF EXISTS `paypertrip_view`;

/*!50001 DROP VIEW IF EXISTS `paypertrip_view` */;
/*!50001 DROP TABLE IF EXISTS `paypertrip_view` */;

/*!50001 CREATE TABLE  `paypertrip_view`(
 `refno` varchar(50) ,
 `company_id` varchar(2) ,
 `pperiod` date ,
 `operator_name` varchar(201) ,
 `plate_number` varchar(15) ,
 `totaltrips` varchar(10) ,
 `totalamount` decimal(10,2) ,
 `manualtrips` varchar(10) ,
 `manualtripsamount` decimal(10,2) ,
 `tax_10` decimal(10,2) ,
 `tax_3` decimal(10,2) ,
 `admin_fee` decimal(10,2) ,
 `days` varchar(10) ,
 `otherdeduc` decimal(10,2) ,
 `totalexpenses` decimal(10,2) ,
 `net` decimal(10,2) ,
 `manualtrips_tax_10` decimal(12,2) ,
 `manualtrips_tax_3` decimal(12,2) ,
 `manualexpenses` decimal(13,2) ,
 `manualnet` decimal(14,2) 
)*/;

/*View structure for view paypertrip_view */

/*!50001 DROP TABLE IF EXISTS `paypertrip_view` */;
/*!50001 DROP VIEW IF EXISTS `paypertrip_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `paypertrip_view` AS (select `pay`.`refno` AS `refno`,`pay`.`company_id` AS `company_id`,`pay`.`pperiod` AS `pperiod`,concat(`oper`.`firstname`,' ',`oper`.`lastname`) AS `operator_name`,`vehi`.`plate_number` AS `plate_number`,`pay`.`totaltrips` AS `totaltrips`,`pay`.`totalamount` AS `totalamount`,`pay`.`manualtrips` AS `manualtrips`,`pay`.`manualtripsamount` AS `manualtripsamount`,`pay`.`tax_10` AS `tax_10`,`pay`.`tax_3` AS `tax_3`,`pay`.`admin_fee` AS `admin_fee`,`pay`.`days` AS `days`,`pay`.`otherdeduc` AS `otherdeduc`,`pay`.`totalexpenses` AS `totalexpenses`,`pay`.`net` AS `net`,round(`pay`.`manualtripsamount` * 0.10,2) AS `manualtrips_tax_10`,round(`pay`.`manualtripsamount` * 0.03,2) AS `manualtrips_tax_3`,round(`pay`.`manualtripsamount` * 0.10,2) + round(`pay`.`manualtripsamount` * 0.03,2) AS `manualexpenses`,`pay`.`manualtripsamount` - (round(`pay`.`manualtripsamount` * 0.10,2) + round(`pay`.`manualtripsamount` * 0.03,2)) AS `manualnet` from ((`payroll_pertrip` `pay` left join `vehicles` `vehi` on(`vehi`.`id` = `pay`.`vehicle_id`)) left join `operators` `oper` on(`oper`.`id` = `vehi`.`operator_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
