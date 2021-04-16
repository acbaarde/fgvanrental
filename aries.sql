/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.16-MariaDB : Database - aries
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
  `abbr` varchar(50) DEFAULT '',
  `active` varbinary(1) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `contact` varchar(11) DEFAULT '',
  `type` varchar(1) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `company` */

insert  into `company`(`company_id`,`company_name`,`refno`,`address`,`abbr`,`active`,`email`,`contact`,`type`) values 
('A','TRANSITIONS OPTICAL PHILIPPINES, INC.','0034','MANILA','TOPI','Y','','','D'),
('B','OPTODEV, INC.','0035','LAGUNA','OPTO','Y','opto@gmail.com','09553175824','T');

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
  `vehicle_id` varchar(10) DEFAULT '',
  `reg_routes` varchar(200) DEFAULT '',
  `ext_routes` varchar(200) DEFAULT '',
  `spe_routes` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `drivers` */

insert  into `drivers`(`id`,`driver_id`,`lastname`,`firstname`,`middlename`,`contact`,`address`,`active`,`company`,`vehicle_id`,`reg_routes`,`ext_routes`,`spe_routes`) values 
(1,'2100001','DACANAY','ALFREDO','','09123456789','SAPANG PALAY','Y','B','1','1xOx2xOx3xOx5xOx7xOx','8xOx10xOx',''),
(3,'2100002','ZAMORA','MARK','','09123456789','FVR','Y','B','2','2xOx3xOx5xOx6xOx','8xOx',''),
(46,'2100041','DELA CRUZ','JUAN','','09553175824','','Y','B','3','1xOx2xOx3xOx4xOx5xOx6xOx','8xOx',''),
(47,'2100042','BAARDE','ARIES','CABRERA','09553175824','SAPANG PALAY','Y','B','4','1xOx2xOx3xOx4xOx5xOx','8xOx10xOx','11xOx12xOx'),
(48,'2100043','RIZAL','JOSE','','09553175824','MANILA','Y','A','6','5xOx','',''),
(49,'2100044','CRUZ','JUAN','DELA','09553175824','MANILA','Y','A','5','','','');

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
  `total_amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

/*Data for the table `extended_sched2021` */

insert  into `extended_sched2021`(`id`,`driver_id`,`vehicle_id`,`company_id`,`route_code`,`rate`,`pperiod`,`day_1`,`day_2`,`day_3`,`day_4`,`day_5`,`day_6`,`day_7`,`day_8`,`day_9`,`day_10`,`day_11`,`day_12`,`day_13`,`day_14`,`day_15`,`day_16`,`total_trip`,`total_amount`) values 
(169,'2100042','4','B','8','800.00','2021-01-01','1','0','0','0','0','0','0','2','0','0','0','0','0','0','0','0','3',2400.00),
(170,'2100042','4','B','10','100.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(187,'2100042','4','B','8','800.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(188,'2100042','4','B','10','100.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(190,'2100042','4','B','8','800.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(191,'2100042','4','B','10','100.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(202,'2100001','1','B','8','800.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(203,'2100001','1','B','10','100.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(217,'2100001','1','B','8','800.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',800.00),
(218,'2100001','1','B','10','100.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(225,'2100041','3','B','8','800.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(238,'2100042','4','B','8','800.00','2021-01-16','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',800.00),
(239,'2100042','4','B','10','100.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00);

/*Table structure for table `id_ctr` */

DROP TABLE IF EXISTS `id_ctr`;

CREATE TABLE `id_ctr` (
  `id_number` varchar(200) NOT NULL,
  PRIMARY KEY (`id_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `id_ctr` */

insert  into `id_ctr`(`id_number`) values 
('2100001'),
('2100002'),
('2100003'),
('2100004'),
('2100005'),
('2100006'),
('2100007'),
('2100008'),
('2100009'),
('2100010'),
('2100011'),
('2100012'),
('2100013'),
('2100014'),
('2100015'),
('2100016'),
('2100017'),
('2100018'),
('2100019'),
('2100020'),
('2100021'),
('2100022'),
('2100023'),
('2100024'),
('2100025'),
('2100026'),
('2100027'),
('2100028'),
('2100029'),
('2100030'),
('2100031'),
('2100032'),
('2100033'),
('2100034'),
('2100035'),
('2100036'),
('2100037'),
('2100038'),
('2100039'),
('2100040'),
('2100041'),
('2100042'),
('2100043'),
('2100044');

/*Table structure for table `operators` */

DROP TABLE IF EXISTS `operators`;

CREATE TABLE `operators` (
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

/*Data for the table `operators` */

insert  into `operators`(`id`,`vehicle_id`,`lastname`,`firstname`,`middlename`,`contact`,`address`,`active`) values 
(1,'','BOTE','ERNESTO','JHONG','09123456789','SAPANG PALAY','Y'),
(2,'','BAARDE','ARIES','CABRERA','09553175824','SAPANG PALAY','Y'),
(3,'','PENDUKO','JUAN','PEDRO','09123456789','SA INYO','N');

/*Table structure for table `payroll_drivers` */

DROP TABLE IF EXISTS `payroll_drivers`;

CREATE TABLE `payroll_drivers` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(10) DEFAULT '',
  `driver_id` varchar(15) DEFAULT '',
  `company_id` varchar(2) DEFAULT '',
  `pperiod` date DEFAULT '0000-00-00',
  `bonus` decimal(10,2) DEFAULT '0.00',
  `salary` decimal(10,2) DEFAULT '0.00',
  `rate` decimal(10,2) DEFAULT '0.00',
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `payroll_drivers` */

insert  into `payroll_drivers`(`id`,`vehicle_id`,`driver_id`,`company_id`,`pperiod`,`bonus`,`salary`,`rate`,`day_1`,`day_2`,`day_3`,`day_4`,`day_5`,`day_6`,`day_7`,`day_8`,`day_9`,`day_10`,`day_11`,`day_12`,`day_13`,`day_14`,`day_15`,`day_16`,`total_trip`) values 
(10,'4','2100042','B','2021-01-16',0.00,0.00,0.00,'5','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','6'),
(18,'1','2100001','B','2021-01-01',0.00,375.00,125.00,'2','0','0','0','1','0','0','0','0','0','0','0','0','0','0','0','3'),
(19,'2','2100002','B','2021-01-01',0.00,1000.00,125.00,'8','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','8'),
(20,'3','2100041','B','2021-01-01',0.00,750.00,125.00,'6','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','6'),
(21,'4','2100042','B','2021-01-01',0.00,4250.00,125.00,'4','10','4','8','6','0','0','2','0','0','0','0','0','0','0','0','34');

/*Table structure for table `payroll_perday` */

DROP TABLE IF EXISTS `payroll_perday`;

CREATE TABLE `payroll_perday` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
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
  `refno` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `payroll_perday` */

insert  into `payroll_perday`(`id`,`company_id`,`driver_id`,`vehicle_id`,`pperiod`,`chargeperday`,`gross`,`otherdeduc`,`tax_10`,`tax_3`,`sop`,`days`,`totalexpenses`,`net`,`refno`) values 
(22,'A','2100044','5','2021-01-16',4500.00,67500.00,0.00,7200.00,2160.00,1328.00,'16',10688.00,56812.00,'0034'),
(23,'A','2100043','6','2021-01-16',4725.00,70875.00,0.00,7200.00,2160.00,1328.00,'16',10688.00,60187.00,'0034'),
(26,'A','2100043','6','2021-01-01',4725.00,70875.00,0.00,6750.00,2025.00,1245.00,'15',10020.00,60855.00,'0034');

/*Table structure for table `payroll_pertrip` */

DROP TABLE IF EXISTS `payroll_pertrip`;

CREATE TABLE `payroll_pertrip` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(2) DEFAULT '',
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
  `refno` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `payroll_pertrip` */

insert  into `payroll_pertrip`(`id`,`company_id`,`driver_id`,`vehicle_id`,`pperiod`,`totaltrips`,`totalamount`,`otherdeduc`,`tax_10`,`tax_3`,`admin_fee`,`days`,`totalexpenses`,`net`,`refno`) values 
(53,'B','2100001','1','2021-01-16','0',0.00,0.00,0.00,0.00,0.00,'16',0.00,0.00,'0035'),
(54,'B','2100041','3','2021-01-16','0',0.00,0.00,0.00,0.00,0.00,'16',0.00,0.00,'0035'),
(55,'B','2100042','4','2021-01-16','6',3200.00,0.00,320.00,96.00,1328.00,'16',1744.00,1456.00,'0035'),
(63,'B','2100001','1','2021-01-01','3',2000.00,0.00,200.00,60.00,1245.00,'15',1505.00,495.00,'0035'),
(64,'B','2100002','2','2021-01-01','8',4300.00,0.00,430.00,129.00,1245.00,'15',1804.00,2496.00,'0035'),
(65,'B','2100041','3','2021-01-01','6',3370.00,0.00,337.00,101.10,1245.00,'15',1683.10,1686.90,'0035'),
(66,'B','2100042','4','2021-01-01','34',19600.00,0.00,1960.00,588.00,1245.00,'15',3793.00,15807.00,'0035');

/*Table structure for table `perday` */

DROP TABLE IF EXISTS `perday`;

CREATE TABLE `perday` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `driver_id` varchar(10) DEFAULT '',
  `company_id` varchar(1) DEFAULT '',
  `pperiod` varchar(15) DEFAULT '',
  `chargeperday` double(10,2) DEFAULT '0.00',
  `days` varchar(3) DEFAULT '0',
  `totalamount` double(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `perday` */

insert  into `perday`(`id`,`driver_id`,`company_id`,`pperiod`,`chargeperday`,`days`,`totalamount`) values 
(1,'2100043','A','2021-01-01',4725.00,'15',70875.00),
(2,'2100044','A','2021-01-16',4500.00,'15',67500.00),
(3,'2100043','A','2021-01-16',4725.00,'15',70875.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pp2021` */

insert  into `pp2021`(`id`,`cutoff`,`pperiod`,`cfrom`,`cto`,`ppost`,`days`) values 
(1,'011','2021-01-01','2021-01-01','2021-01-15','P','15'),
(2,'012','2021-01-16','2021-01-16','2021-01-31','','16'),
(3,'021','2021-02-01','2021-02-01','2021-01-15','','15'),
(4,'022','2021-02-16','2021-02-16','2021-02-28','','13'),
(6,'031','2021-03-01','2021-03-01','2021-03-15','','15'),
(7,'032','2021-03-16','2021-03-16','2021-03-31','','16'),
(8,'041','2021-04-01','2021-04-01','2021-04-15','','15'),
(9,'042','2021-04-16','2021-04-16','2021-04-30','','15');

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
  `total_amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=776 DEFAULT CHARSET=latin1;

/*Data for the table `regular_sched2021` */

insert  into `regular_sched2021`(`id`,`driver_id`,`vehicle_id`,`company_id`,`route_code`,`rate`,`pperiod`,`day_1`,`day_2`,`day_3`,`day_4`,`day_5`,`day_6`,`day_7`,`day_8`,`day_9`,`day_10`,`day_11`,`day_12`,`day_13`,`day_14`,`day_15`,`day_16`,`total_trip`,`total_amount`) values 
(533,'2100042','4','B','1','600.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(534,'2100042','4','B','2','520.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(535,'2100042','4','B','3','480.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(536,'2100042','4','B','4','620.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(537,'2100042','4','B','5','500.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(568,'2100042','4','B','1','600.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(569,'2100042','4','B','2','520.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(570,'2100042','4','B','3','480.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(571,'2100042','4','B','4','620.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(572,'2100042','4','B','5','500.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(575,'2100042','4','B','1','600.00','2021-01-01','1','2','4','1','2','0','0','0','0','0','0','0','0','0','0','0','10',6000.00),
(576,'2100042','4','B','2','520.00','2021-01-01','1','2','0','1','2','0','0','0','0','0','0','0','0','0','0','0','6',3120.00),
(577,'2100042','4','B','3','480.00','2021-01-01','1','1','0','3','2','0','0','0','0','0','0','0','0','0','0','0','7',3360.00),
(578,'2100042','4','B','4','620.00','2021-01-01','0','3','0','3','0','0','0','0','0','0','0','0','0','0','0','0','6',3720.00),
(579,'2100042','4','B','5','500.00','2021-01-01','0','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1000.00),
(610,'2100001','1','B','1','600.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(611,'2100001','1','B','2','520.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(612,'2100001','1','B','3','480.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(613,'2100001','1','B','5','500.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(614,'2100001','1','B','7','750.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(659,'2100001','1','B','1','600.00','2021-01-01','1','0','0','0','1','0','0','0','0','0','0','0','0','0','0','0','2',1200.00),
(660,'2100001','1','B','2','520.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(661,'2100001','1','B','3','480.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(662,'2100001','1','B','5','500.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(663,'2100001','1','B','7','750.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(666,'2100041','3','B','1','600.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(667,'2100041','3','B','2','520.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(668,'2100041','3','B','3','480.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(669,'2100041','3','B','4','620.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(670,'2100041','3','B','5','500.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(671,'2100041','3','B','6','650.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(701,'2100041','3','B','1','600.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',600.00),
(702,'2100041','3','B','2','520.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',520.00),
(703,'2100041','3','B','3','480.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',480.00),
(704,'2100041','3','B','4','620.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',620.00),
(705,'2100041','3','B','5','500.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',500.00),
(706,'2100041','3','B','6','650.00','2021-01-01','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1',650.00),
(715,'2100002','2','B','2','520.00','2021-01-01','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1040.00),
(716,'2100002','2','B','3','480.00','2021-01-01','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',960.00),
(717,'2100002','2','B','5','500.00','2021-01-01','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1000.00),
(718,'2100002','2','B','6','650.00','2021-01-01','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1300.00),
(771,'2100042','4','B','1','600.00','2021-01-16','1','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1200.00),
(772,'2100042','4','B','2','520.00','2021-01-16','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',1040.00),
(773,'2100042','4','B','3','480.00','2021-01-16','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2',960.00),
(774,'2100042','4','B','4','620.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00),
(775,'2100042','4','B','5','500.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0',0.00);

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `route_code` varbinary(50) DEFAULT NULL,
  `route_name` varchar(100) DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `rate` double(15,2) DEFAULT '0.00',
  `route_trip` varchar(1) DEFAULT NULL,
  `active` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `routes` */

insert  into `routes`(`id`,`route_code`,`route_name`,`landmark`,`rate`,`route_trip`,`active`) values 
(1,'','ALABANG','JOLLIBEE',600.00,'R','Y'),
(2,'','Binan 1','Jac Liner / Jollibee Binan Bayan 1 / NAPOCOR',520.00,'R','Y'),
(3,'','Binan 2','Olivares Motortrade',480.00,'R','Y'),
(4,'','San Pedro','AMA-Canlalay / 7-11 Landayan / Save More',620.00,'R','Y'),
(5,'','Carmona','Public Market',500.00,'R','Y'),
(6,'','Cabuyao 1','Novotel / Pergas / Motortrade / Katapatan-Acacia Subd.',650.00,'R','Y'),
(7,'','Cabuyao 3','Camella Homes / Waltermart Banlic / Pulo Church / San Isidro Puregold /Jollibee Pulo',750.00,'R','Y'),
(8,'','ALABANG','JOLLIBEE/MINI STOP/SUMMIT VILLE (KANTO)/CALTEX (SOLDIERS HILL)',800.00,'E','Y'),
(10,NULL,'MAKATI','GUARDALUPE',100.00,'E','Y'),
(11,NULL,'STA ROSA 1-4-5','',600.00,'S','Y'),
(12,NULL,'STA ROSA 1-4-5','',740.00,'S','Y');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `special_sched2021` */

insert  into `special_sched2021`(`id`,`driver_id`,`vehicle_id`,`company_id`,`route_code`,`rate`,`pperiod`,`day_1`,`day_2`,`day_3`,`day_4`,`day_5`,`day_6`,`day_7`,`day_8`,`day_9`,`day_10`,`day_11`,`day_12`,`day_13`,`day_14`,`day_15`,`day_16`,`total_trip`,`total_amount`) values 
(10,'2100042','4','B','11','600.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00'),
(11,'2100042','4','B','12','740.00','2021-01-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00'),
(19,'2100042','4','B','11','600.00','2021-02-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00'),
(20,'2100042','4','B','12','740.00','2021-02-16','2','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','2','1480.00'),
(22,'2100042','4','B','11','600.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00'),
(23,'2100042','4','B','12','740.00','2021-02-01','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00'),
(40,'2100042','4','B','11','600.00','2021-01-16','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','600.00'),
(41,'2100042','4','B','12','740.00','2021-01-16','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`operator_id`,`plate_number`,`unit`,`stat`,`active`) values 
(1,'1','MAJ2366','Nissan Urvan  NV 350 Premium','NA','Y'),
(2,'1','NDK1927','Toyota Hi Ace Grandia GL','NA','Y'),
(3,'1','P70612','Toyota Hi Ace Commuter','NA','Y'),
(4,'1','NDN 7854','Nissan Urvan NV350','NA','Y'),
(5,'2','NAK 1234','WIGO 125CC','NA','Y'),
(6,'2','ASD 1234','NMAX 150','NA','Y');

/*Table structure for table `year` */

DROP TABLE IF EXISTS `year`;

CREATE TABLE `year` (
  `year` year(4) DEFAULT NULL,
  `post` varchar(1) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `year` */

insert  into `year`(`year`,`post`) values 
(2021,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
