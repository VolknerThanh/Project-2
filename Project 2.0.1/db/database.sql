/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.1.28-MariaDB : Database - silverrain_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`silverrain_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `silverrain_db`;

/*Table structure for table `foodmaterials` */

DROP TABLE IF EXISTS `foodmaterials`;

CREATE TABLE `foodmaterials` (
  `Food_ID` int(5) NOT NULL,
  `Material_ID` int(5) NOT NULL,
  `isStandard` tinyint(1) NOT NULL,
  `Quantity` double NOT NULL,
  PRIMARY KEY (`Food_ID`,`Material_ID`),
  KEY `Material_ID` (`Material_ID`),
  CONSTRAINT `foodmaterials_ibfk_1` FOREIGN KEY (`Food_ID`) REFERENCES `foods` (`IdFood`),
  CONSTRAINT `foodmaterials_ibfk_2` FOREIGN KEY (`Material_ID`) REFERENCES `materials` (`IdMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `foodmaterials` */

insert  into `foodmaterials`(`Food_ID`,`Material_ID`,`isStandard`,`Quantity`) values 
(1,1,1,1),
(1,3,0,5.5);

/*Table structure for table `foodmethods` */

DROP TABLE IF EXISTS `foodmethods`;

CREATE TABLE `foodmethods` (
  `FM_id` int(5) NOT NULL AUTO_INCREMENT,
  `FM_name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`FM_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

/*Data for the table `foodmethods` */

insert  into `foodmethods`(`FM_id`,`FM_name`) values 
(1,'Hấp'),
(2,'Chiên');

/*Table structure for table `foods` */

DROP TABLE IF EXISTS `foods`;

CREATE TABLE `foods` (
  `IdFood` int(5) NOT NULL AUTO_INCREMENT,
  `FoodName` varchar(50) NOT NULL,
  `IdMethod` int(5) NOT NULL,
  PRIMARY KEY (`IdFood`),
  KEY `IdMethod` (`IdMethod`),
  CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`IdMethod`) REFERENCES `foodmethods` (`FM_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `foods` */

insert  into `foods`(`IdFood`,`FoodName`,`IdMethod`) values 
(1,'Bánh Bao',1);

/*Table structure for table `materials` */

DROP TABLE IF EXISTS `materials`;

CREATE TABLE `materials` (
  `IdMaterial` int(5) NOT NULL AUTO_INCREMENT,
  `Material_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `Material_Unit` varchar(10) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`IdMaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `materials` */

insert  into `materials`(`IdMaterial`,`Material_name`,`Material_Unit`) values 
(1,'Trứng','quả'),
(2,'Bột','gam'),
(3,'Thịt','gam'),
(4,'Muối','muỗng'),
(5,'Đường','muỗng');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
