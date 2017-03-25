-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: emergency_server
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_emergency_call`
--

DROP TABLE IF EXISTS `tbl_emergency_call`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_emergency_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nfc_type` int(11) NOT NULL,
  `nfc_type_id` int(11) DEFAULT NULL,
  `lattitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `report_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reported_by` int(11) NOT NULL,
  `duplicate_id` varchar(45) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_emergency_user_id_idx` (`user_id`),
  KEY `fk_tbl_emergency_reported_by_idx` (`reported_by`),
  CONSTRAINT `fk_tbl_emergency_reported_by` FOREIGN KEY (`reported_by`) REFERENCES `tbl_people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_emergency_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_emergency_call`
--

LOCK TABLES `tbl_emergency_call` WRITE;
/*!40000 ALTER TABLE `tbl_emergency_call` DISABLE KEYS */;
INSERT INTO `tbl_emergency_call` VALUES (1,1,1,1,'19.1334302','72.9132679','2017-03-25 09:02:52',2,'0',1,'2017-03-25 09:02:52','2017-03-25 09:23:33'),(2,2,1,2,'19.1334302','72.9132679','2017-03-25 09:04:39',2,'0',1,'2017-03-25 09:04:39','2017-03-25 09:23:33'),(3,1,1,1,NULL,NULL,'2017-03-25 12:25:10',1,'0',NULL,'2017-03-25 06:55:10','2017-03-25 06:55:10'),(4,1,1,1,NULL,NULL,'2017-03-25 14:04:30',1,'0',NULL,'2017-03-25 08:34:30','2017-03-25 08:34:30'),(5,1,1,1,NULL,NULL,'2017-03-25 14:09:30',1,'0',NULL,'2017-03-25 08:39:30','2017-03-25 08:39:30'),(6,1,1,1,NULL,NULL,'2017-03-25 15:17:21',1,'0',NULL,'2017-03-25 09:47:21','2017-03-25 09:47:21'),(7,1,1,1,NULL,NULL,'2017-03-25 15:17:58',1,'0',NULL,'2017-03-25 09:47:58','2017-03-25 09:47:58');
/*!40000 ALTER TABLE `tbl_emergency_call` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-25 21:16:46
