-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: stpatool
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actuators`
--

DROP TABLE IF EXISTS `actuators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actuators` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actuators`
--

LOCK TABLES `actuators` WRITE;
/*!40000 ALTER TABLE `actuators` DISABLE KEYS */;
INSERT INTO `actuators` VALUES (1,'Train Door Actuator',1,NULL,NULL),(2,'Actuator',2,'2018-05-21 22:32:55','2018-05-21 22:32:55'),(3,'My Actuator',12,'2018-08-06 16:28:56','2018-08-06 16:28:56'),(5,'Pump',14,'2018-08-24 06:00:22','2018-08-24 06:00:22'),(6,'Insulin Pump',15,'2018-09-28 21:44:14','2018-09-28 22:07:07');
/*!40000 ALTER TABLE `actuators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assumptions`
--

DROP TABLE IF EXISTS `assumptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assumptions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assumptions`
--

LOCK TABLES `assumptions` WRITE;
/*!40000 ALTER TABLE `assumptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `assumptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `causal_analysis`
--

DROP TABLE IF EXISTS `causal_analysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `causal_analysis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `scenario` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `associated_causal_factor` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `requirement` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rationale` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `guideword_id` int unsigned NOT NULL,
  `safety_constraint_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `causal_analysis`
--

LOCK TABLES `causal_analysis` WRITE;
/*!40000 ALTER TABLE `causal_analysis` DISABLE KEYS */;
INSERT INTO `causal_analysis` VALUES (1,'[CONTROLLER] does receive the wrong value of [VARIABLE].','Failure in the communication between [CONTROLLER] and the external system.','The communication between [CONTROLLER] and external system must be improved.','Engineers or network administrator.','This external system are out of the scope of the system under analysis.',1,0,NULL,NULL),(2,'Value of [VARIABLE] is missing.','Failure in the communication between [CONTROLLER] and the external system.','The communication between [CONTROLLER] and external system must be improved.','Engineers or network administrator.','This external system are out of the scope of the system under analysis.',1,0,NULL,NULL),(3,'An incorrect algorithm was designed','Algorithm wrong or incomplete or lack of knowledge of the system.','The algorithm must be revised and tested after each change to minimize errors.','Engineers and testers','Simulations of the system can help to validate the algorithm.',2,0,NULL,NULL),(4,'Algorithm ineffective, unsafe or incomplete after process changes.','Algorithm was not updated to support changes of the process.','Algorithm must be updated, revised and tested after each change in the process to minimize errors.','Designers and operators.','Algorithm must be revised and adapted to support the process changes.',2,0,NULL,NULL),(5,'Algorithm updated incorrectly.','Flaw in the modifications or algorithm was not updated to support the modifications.','After each modification in the algorithm, it must be revised and tested to minimize errors.','Designers, testers and operators.','Algorithm should be updated properly for each change.',2,0,NULL,NULL),(6,'Current state of the process model is inconsistent, incorrect or incomplete.','Feedback of emergency missing or with wrong value.','Process model in the [CONTROLLER] must be consistent with the [CONTROLLED PROCESS] and external system status.','System’s designers','Not applicable (N/A)',3,0,NULL,NULL),(7,'[CONTROLLER] does not provide the control action or issued an incorrect.','Problems in the process model and/or control algorithms.','Process model in [CONTROLLER] must be the same in the [CONTROLLED PROCESS] and the control ','Engineers','Not Applicable (N/A)',4,0,NULL,NULL),(8,'[ACTUATOR] cannot act in [CONTROLLED PROCESS] or complete the execution of the Control Action.','Failure in the [ACTUATOR].','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',5,0,NULL,NULL),(9,'[ACTUATOR] performs a non-issued control action.','Failure in the [ACTUATOR].','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',5,0,NULL,NULL),(10,'The issued control action delays to be enforced by the [ACTUATOR].','Failure in the [ACTUATOR], electric failure or temporary loss of power','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',6,0,NULL,NULL),(11,'[CONTROLLER2] issues a control action that conflicts with the one provided by the [CONTROLLER].','Lack of resolution of controls or design error.','Analysis of conflicts should be done to avoid conflicting control actions.','Safety Engineer and Stakeholders.','Not Applicable (N/A)',7,0,NULL,NULL),(12,'The system components do not perform their functions.','Failure in one or more components of the system.','Ongoing STPA analysis must be done in order to cover each change in the system.','Maintainer','Reliability analysis can be done for small components introduced in the system. Complex components must have their own STPA analysis.',8,0,NULL,NULL),(13,'[CONTROLLED PROCESS] affected by natural or man made disasters.','Depends of the disaster.','Some disasters can be mitigated.','Safety Engineers.','Not Applicable (N/A)',11,0,NULL,NULL),(14,'Temporary obstruction not allow the reading of the [CONTROLLED PROCESS].','Obstruction for observing; Mean obstructed.','Alternative way to read the [CONTROLLED PROCESS] should be considered.','Design team','Not Applicable (N/A)',13,0,NULL,NULL),(15,'Current state of the [CONTROLLED PROCESS] cannot be read accurately.','Obstruction for observing; Mean obstructed; Poor environment conditions or; Accuracy property is not guaranteed.','Most capable sensor or alternative way to read the [CONTROLLED PROCESS] should be considered.','Design team','[SENSOR] may not be calibrated.',14,0,NULL,NULL),(16,'[CONTROLLED PROCESS] cannot be read by the [SENSOR].','Reading errors; Variations in the [CONTROLLED PROCESS] or; Precision and sensitivity properties are not guaranteed.','The correct type of sensor must be chosen according to the controlled process.','Design team','Not Applicable (N/A)',15,0,NULL,NULL),(17,'[SENSOR] cannot get the status of the [CONTROLLED PROCESS].','Failure in the [SENSOR].','The [SENSOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',16,0,NULL,NULL),(18,'Feedback delays to reach the [CONTROLLER]','Limitations in the communication protocol or problem in the communication mean (Wire or Wireless)','Communication between [CONTROLLER] and [SENSOR] must be improved.','Engineers','Alternative communication means can be considered.',17,0,NULL,NULL),(19,'Scenario','ACF','Recommendations','','Rationale',1,34,'2018-05-22 04:34:25','2018-05-22 04:34:25'),(20,'\n			        						Train Door Controller does not provide the control action or issued an incorrect.\n			        					','\n			        								        					Problems in the process model and/or control algorithms.\n			        				','\n			        								        					Process model in Train Door Controller must be the same in the Train Door and the control \n			        				','','\n			        								        					Not Applicable (N/A)\n			        				',4,28,'2018-05-22 14:44:50','2018-05-22 14:44:50'),(21,'\n			        						The issued control action delays to be enforced by the Actuator.\n			        					','\n			        								        					Failure in the Actuator, electric failure or temporary loss of power\n			        				','\n			        								        					The Actuator must be maintained periodically.\n			        				','','\n			        								        					Reliability analysis can minimize the failures.\n			        				',6,0,'2018-05-22 14:45:23','2018-05-22 14:45:23'),(22,'\n			        						Actuator performs a non-issued control action.\n			        					','\n			        								        					Failure in the Actuator.\n			        				','\n			        								        					The Actuator must be maintained periodically.\n			        				','','\n			        								        					Reliability analysis can minimize the failures.\n			        				',5,36,'2018-05-22 14:46:45','2018-05-22 14:46:45'),(23,'\n			        						Crossing Gate affected by natural or man made disasters.\n			        					','\n			        								        					Depends of the disaster.\n			        				','\n			        								        					Some disasters can be mitigated.\n			        				','','\n			        								        					Not Applicable (N/A)\n			        				',11,36,'2018-05-22 14:46:45','2018-05-22 14:46:45'),(24,'\n			        						Train Door Controller does not provide the control action or issued an incorrect.\n			        					','\n			        								        					Problems in the process model and/or control algorithms.\n			        				','\n			        								        					Process model in Train Door Controller must be the same in the Train Door and the control \n			        				','','\n			        								        					Not Applicable (N/A)\n			        				',4,0,'2018-05-22 14:47:30','2018-05-22 14:47:30'),(25,'\n			        						The system components do not perform their functions.\n			        					','\n			        								        					Failure in one or more components of the system.\n			        				','\n			        								        					Ongoing STPA analysis must be done in order to cover each change in the system.\n			        				','','\n			        								        					Reliability analysis can be done for small components introduced in the system. Complex components must have their own STPA analysis.\n			        				',8,0,'2018-05-22 14:47:30','2018-05-22 14:47:30'),(26,'\n			        						Train Door Actuator performs a non-issued control action.\n			        					','\n			        								        					Failure in the Train Door Actuator.\n			        				','\n			        								        					The Train Door Actuator must be maintained periodically.\n			        				','','\n			        								        					Reliability analysis can minimize the failures.\n			        				',5,0,'2018-05-22 14:47:30','2018-05-22 14:47:30'),(27,'\n			        						\n			        						The issued control action delays to be enforced by the Actuator.\n			        					\n			        					','\n			        								        					\n			        								        					Failure in the Actuator, electric failure or temporary loss of power\n			        				\n			        				','\n			        								        					\n			        								        					The Actuator must be maintained periodically.\n			        				\n			        				','','\n			        								        					\n			        								        					Reliability analysis can minimize the failures.\n			        				\n			        				',6,0,'2018-05-22 14:47:30','2018-05-22 14:47:30'),(28,'\n			        						Train Door Controller does not provide the control action or issued an incorrect.\n			        					','\n			        								        					Problems in the process model and/or control algorithms.\n			        				','\n			        								        					Process model in Train Door Controller must be the same in the Train Door and the control \n			        				','','\n			        								        					Not Applicable (N/A)\n			        				',4,29,'2018-05-22 14:49:42','2018-05-22 14:49:42'),(29,'\n			        						Train Door Actuator performs a non-issued control action.\n			        					','\n			        								        					Failure in the Train Door Actuator.\n			        				','\n			        								        					The Train Door Actuator must be maintained periodically.\n			        				','','\n			        								        					Reliability analysis can minimize the failures.\n			        				',5,29,'2018-05-22 14:49:42','2018-05-22 14:49:42'),(30,'			        						The system components do not perform their functions.\n			        					','			        								        					Failure in one or more components of the system.\n			        				','			        								        					Ongoing STPA analysis must be done in order to cover each change in the system.\n			        				','','	        								        					Reliability analysis can be done for small components introduced in the system. Complex components must have their own STPA analysis.\n			        				',8,29,'2018-05-22 14:49:42','2018-06-10 19:42:28'),(31,'			        						\n			        						The issued control action delays to be enforced by the Actuator.\n			        					\n			        					','			        								        					\n			        								        					Failure in the Actuator, electric failure or temporary loss of power\n			        				\n			        				','The Actuator must be maintained periodically.','','Reliability analysis can minimize the failures.',6,29,'2018-05-22 14:49:42','2018-06-10 19:43:11'),(36,'Integrity of external information is compromised.','Information communication: The integrity of communication cannot be assured.','The integrity of the communication channel must be kept.','N/A','Not Applicable (N/A)',1,0,NULL,NULL),(73,'Integrity of Control Algorithm is compromised.','Information generation: The integrity of the code is not assured. Information storage: The code is not protected.','The integrity of the code must be kept. The code must be protected.','N/A','Not Applicable (N/A)',2,0,NULL,NULL),(74,'Integrity of Process Model is compromised.','Information processing: The integrity of the process model is not assured. Information storage: The process model is not protected.','The integrity of the process model must be kept. The process model must be protected.','N/A','Not Applicable (N/A)',3,0,NULL,NULL),(75,'Integrity of Control Action is compromised.','Information communication: The integrity of the control action is not assured.','The integrity of the control action must be kept.','N/A','Not Applicable (N/A)',4,0,NULL,NULL),(76,'Integrity of Control Action is compromised.','Information consumption: The integrity of the control action is not assured. Information destruction: The control action is not properly destructed after issued.','The integrity of the control action must be kept. The destruction cannot leave residues/leftovers','N/A','Not Applicable (N/A)',5,0,NULL,NULL),(77,'The transference of physical energy is compromised.','Information processing: The integrity of the physical energy transfer is not assured.','The integrity of the physical energy transfer must be kept.','N/A','Not Applicable (N/A)',6,0,NULL,NULL),(78,'Integrity of Control Action is compromised.','Information processing: The integrity of the control action is not assured. Information consumption: The integrity of the control action is not assured.','The integrity of the control action must be kept.','N/A','Not Applicable (N/A)',7,0,NULL,NULL),(79,'The transference of physical energy is compromised.','Information processing: The integrity of the physical energy transfer is not assured.','The integrity of the physical energy transfer must be kept.','N/A','Not Applicable (N/A)',7,0,NULL,NULL),(80,'Integrity of Process input is compromised.','Information processing: The integrity of the process input is not assured.','The integrity of the process input must be kept.','N/A','Not Applicable (N/A)',10,0,NULL,NULL),(81,'Integrity of Process output is compromised.','Information processing: The integrity of the process output is not assured.','The integrity of the process output must be kept.','N/A','Not Applicable (N/A)',12,0,NULL,NULL),(82,'Integrity of sense event is compromised.','Information communication: The integrity of the sense event is not assured.','The integrity of the sense event must be kept.','N/A','Not Applicable (N/A)',15,0,NULL,NULL),(83,'Integrity of feedback data is compromised.','Information generation: The generation of feedback data cannot be assured. Information destruction: The control action is not properly destructed after issued.','The integrity of the feedback data must be kept. The destruction cannot leave residues/leftovers','N/A','Not Applicable (N/A)',16,0,NULL,NULL),(84,'Integrity of feedback data is compromised.','Information communication: The integrity of feedback data is not assured.','The integrity of the feedback data must be kept.','N/A','Not Applicable (N/A)',17,0,NULL,NULL),(85,'Integrity of communication data is compromised.','Information communication: The integrity of communication data is not assured.','The integrity of the communication data must be kept.','N/A','Not Applicable (N/A)',19,0,NULL,NULL),(123,'An incorrect algorithm was designed','Algorithm wrong or incomplete or lack of knowledge of the system.','The algorithm must be revised and tested after each change to minimize errors.','','Simulations of the system can help to validate the algorithm.',2,131,'2018-10-23 22:25:44','2018-10-23 22:25:44'),(124,'Scenario','Associated','Recommendations','','Rationales',5,132,'2018-10-23 22:26:03','2018-10-23 22:26:03'),(122,'Insulin Pump does receive the wrong value of Glucose Level.','Failure in the communication between Insulin Pump and the external system.','The communication between Insulin Pump and external system must be improved.','','This external system are out of the scope of the system under analysis.',1,130,'2018-10-23 22:24:20','2018-10-23 22:24:20'),(121,'Insulin Pump does receive the wrong value of Glucose Level.','Failure in the communication between Insulin Pump and the external system.','The communication between Insulin Pump and external system must be improved.','','This external system are out of the scope of the system under analysis.',1,133,'2018-10-23 22:21:52','2018-10-23 22:21:52'),(120,'Insulin Pump does receive the wrong value of Glucose Level, Battery level and Basal rate.','Failure in the communication between Insulin Pump and the external system.','The communication between Insulin Pump and external system must be improved.','','This external system are out of the scope of the system under analysis.',1,139,'2018-10-23 21:31:28','2018-10-23 21:31:28'),(105,'Current state of the Patient\'s Body cannot be read accurately.','Obstruction for observing; Mean obstructed; Poor environment conditions or; Accuracy property is not guaranteed.','Most capable sensor or alternative way to read the Patient\'s Body should be considered.','','Insulin Pump may not be calibrated.',14,112,'2018-10-23 16:48:03','2018-10-23 16:48:03'),(118,'Integrity of Control Algorithm is compromised.','Information generation: The integrity of the code is not assured. Information storage: The code is not protected.','The integrity of the code must be kept. The code must be protected.','','Not Applicable (N/A)',2,134,'2018-10-23 19:52:55','2018-10-23 19:52:55'),(115,'Insulin Pump does receive the wrong value of Glucose Level.','Failure in the communication between Insulin Pump and the external system.','The communication between Insulin Pump and external system must be improved.','','This external system are out of the scope of the system under analysis.',1,134,'2018-10-23 19:49:22','2018-10-23 19:49:22'),(108,'Insulin Pump does receive the wrong value of Glucose Level.','Failure in the communication between Insulin Pump and the external system.','The communication between Insulin Pump and external system must be improved.','','This external system are out of the scope of the system under analysis.',1,112,'2018-10-23 18:50:10','2018-10-23 18:50:10'),(117,'Integrity of external information is compromised.','Information communication: The integrity of communication cannot be assured.','The integrity of the communication channel must be kept.','','Not Applicable (N/A)',1,134,'2018-10-23 19:52:55','2018-10-23 19:52:55'),(116,'An incorrect algorithm was designed','Algorithm wrong or incomplete or lack of knowledge of the system.','The algorithm must be revised and tested after each change to minimize errors.','','Simulations of the system can help to validate the algorithm.',2,134,'2018-10-23 19:49:22','2018-10-23 19:49:22');
/*!40000 ALTER TABLE `causal_analysis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `components` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Actuator','ControlledProcess','Controller','Sensor') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `components`
--

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;
INSERT INTO `components` VALUES (1,'Train Door Actuator','Actuator',1,NULL,NULL),(2,'Train Door','ControlledProcess',1,NULL,NULL),(3,'Train Door Controller','Controller',1,NULL,NULL),(4,'Train Door Sensor','Sensor',1,NULL,NULL);
/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connections`
--

DROP TABLE IF EXISTS `connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `connections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `output_component_id` int unsigned NOT NULL,
  `type_output` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `input_component_id` int unsigned NOT NULL,
  `type_input` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connections`
--

LOCK TABLES `connections` WRITE;
/*!40000 ALTER TABLE `connections` DISABLE KEYS */;
INSERT INTO `connections` VALUES (1,1,'controller',1,'actuator',NULL,NULL),(2,1,'actuator',1,'controlled_process',NULL,NULL),(3,1,'controlled_process',1,'sensor',NULL,NULL),(4,1,'sensor',1,'controller',NULL,NULL),(5,2,'controller',2,'actuator','2018-05-21 22:45:28','2018-05-21 22:45:28'),(6,2,'actuator',2,'controlled_process','2018-05-21 22:45:34','2018-05-21 22:45:34'),(7,2,'controlled_process',2,'sensor','2018-05-21 22:45:39','2018-05-21 22:45:39'),(8,2,'sensor',2,'controller','2018-05-21 22:45:43','2018-05-21 22:45:43'),(9,3,'controller',3,'actuator','2018-08-06 16:30:44','2018-08-06 16:30:44'),(10,3,'actuator',3,'controlled_process','2018-08-06 16:30:50','2018-08-06 16:30:50'),(11,3,'controlled_process',3,'sensor','2018-08-06 16:30:54','2018-08-06 16:30:54'),(12,3,'sensor',3,'controller','2018-08-06 16:30:57','2018-08-06 16:30:57'),(22,5,'controlled_process',5,'sensor','2018-08-24 06:09:27','2018-08-24 06:09:27'),(21,5,'actuator',5,'controlled_process','2018-08-24 06:09:23','2018-08-24 06:09:23'),(20,7,'controller',5,'actuator','2018-08-24 06:09:18','2018-08-24 06:09:18'),(19,6,'controller',7,'controller','2018-08-24 06:09:07','2018-08-24 06:09:07'),(23,5,'sensor',7,'controller','2018-08-24 06:09:33','2018-08-24 06:09:33'),(24,8,'controller',6,'controlled_process','2018-09-28 13:43:40','2018-09-28 13:43:40'),(25,8,'controller',6,'actuator','2018-09-28 21:46:41','2018-09-28 21:46:41'),(26,6,'actuator',6,'controlled_process','2018-09-28 21:46:47','2018-09-28 21:46:47'),(27,6,'sensor',8,'controller','2018-09-28 21:46:55','2018-09-28 21:46:55'),(28,6,'sensor',6,'controlled_process','2018-09-28 21:51:21','2018-09-28 21:51:21'),(29,9,'controller',10,'controller','2018-10-20 20:55:38','2018-10-20 20:55:38'),(30,9,'controller',12,'controller','2018-10-20 20:55:43','2018-10-20 20:55:43'),(31,10,'controller',11,'controller','2018-10-20 20:55:57','2018-10-20 20:55:57'),(32,10,'controller',12,'controller','2018-10-20 20:55:59','2018-10-20 20:55:59'),(33,11,'controller',10,'controller','2018-10-20 20:56:05','2018-10-20 20:56:05'),(34,12,'controller',7,'controlled_process','2018-10-20 20:56:15','2018-10-20 20:56:15');
/*!40000 ALTER TABLE `connections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `context_tables`
--

DROP TABLE IF EXISTS `context_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `context_tables` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `controlaction_id` int NOT NULL,
  `context` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_provided` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_not_provided` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wrong_time_order` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_early` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_late` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_soon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_long` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `context_tables`
--

LOCK TABLES `context_tables` WRITE;
/*!40000 ALTER TABLE `context_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `context_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `control_actions`
--

DROP TABLE IF EXISTS `control_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_actions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controller_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `control_actions`
--

LOCK TABLES `control_actions` WRITE;
/*!40000 ALTER TABLE `control_actions` DISABLE KEYS */;
INSERT INTO `control_actions` VALUES (1,'Open door command','Description',1,NULL,NULL),(2,'Close door command','Description',1,NULL,NULL),(3,'Open the crossing gate','Description',2,'2018-05-21 22:46:01','2018-05-21 22:46:01'),(4,'Close the crossing gate','Description',2,'2018-05-21 22:46:08','2018-05-21 22:46:08'),(5,'My Control Action 01','Description',3,'2018-08-06 16:29:42','2018-08-06 16:29:42'),(6,'Input carbs level','Description',4,'2018-08-23 16:30:50','2018-08-23 16:30:50'),(7,'Start','Description',5,'2018-08-23 16:31:01','2018-08-23 16:31:01'),(8,'Stop','Description',5,'2018-08-23 16:31:04','2018-08-23 16:31:04'),(9,'Input carbs level','Description',6,'2018-08-24 06:09:43','2018-08-24 06:09:43'),(10,'Start','Description',7,'2018-08-24 06:09:49','2018-08-24 06:09:49'),(11,'Stop','Description',7,'2018-08-24 06:09:54','2018-08-24 06:09:54'),(12,'Pumping Insulin','Description',8,'2018-09-28 13:41:54','2018-09-28 13:41:54'),(13,'Stop Pumping Insulin','Description',8,'2018-09-28 13:42:19','2018-09-28 13:42:19'),(14,'Pump Insulin','Description',12,'2018-10-20 20:43:11','2018-10-20 20:43:11'),(15,'Stop insulin pump app software','Description',12,'2018-10-23 21:19:29','2018-10-23 21:19:29');
/*!40000 ALTER TABLE `control_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlled_processes`
--

DROP TABLE IF EXISTS `controlled_processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controlled_processes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlled_processes`
--

LOCK TABLES `controlled_processes` WRITE;
/*!40000 ALTER TABLE `controlled_processes` DISABLE KEYS */;
INSERT INTO `controlled_processes` VALUES (1,'Train Door',1,NULL,NULL),(2,'Crossing Gate',2,'2018-05-21 22:33:07','2018-05-21 22:47:19'),(3,'My Controlled Process',12,'2018-08-06 16:29:10','2018-08-06 16:29:10'),(5,'User Body',14,'2018-08-24 06:00:29','2018-08-24 06:00:29'),(6,'Patient Body',15,'2018-09-28 13:41:41','2018-09-28 13:41:41'),(7,'Patient\'s Body',16,'2018-10-20 20:39:22','2018-10-20 20:39:22');
/*!40000 ALTER TABLE `controlled_processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controllers`
--

DROP TABLE IF EXISTS `controllers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controllers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controllers`
--

LOCK TABLES `controllers` WRITE;
/*!40000 ALTER TABLE `controllers` DISABLE KEYS */;
INSERT INTO `controllers` VALUES (1,'Train Door Controller','Automatized',1,NULL,NULL),(2,'Controller','',2,'2018-05-21 22:43:55','2018-05-21 22:43:55'),(3,'My Controller','',12,'2018-08-06 16:29:03','2018-08-06 16:29:03'),(6,'User Controller','',14,'2018-08-24 06:00:10','2018-08-24 06:00:10'),(7,'Controller','',14,'2018-08-24 06:00:16','2018-08-24 06:00:16'),(8,'Insulin Pump','',15,'2018-09-28 13:41:34','2018-09-28 13:41:34'),(9,'Patient','',16,'2018-10-20 20:37:54','2018-10-20 20:37:54'),(10,'Mobile device + App','',16,'2018-10-20 20:38:06','2018-10-20 20:38:06'),(11,'Apple Store / Google Play','',16,'2018-10-20 20:39:03','2018-10-20 20:39:03'),(12,'Insulin Pump','',16,'2018-10-20 20:39:10','2018-10-20 20:39:10');
/*!40000 ALTER TABLE `controllers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guidewords`
--

DROP TABLE IF EXISTS `guidewords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guidewords` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `guideword` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guidewords`
--

LOCK TABLES `guidewords` WRITE;
/*!40000 ALTER TABLE `guidewords` DISABLE KEYS */;
INSERT INTO `guidewords` VALUES (1,'Control input or external information wrong or missing',NULL,NULL),(2,'Inadequate Control Algorithm',NULL,NULL),(3,'Process Model inconsistent, incorrect or incomplete',NULL,NULL),(4,'Inappropriate, ineffective or missing control action',NULL,NULL),(5,'Inadequate Operation',NULL,NULL),(6,'Delayed Operation',NULL,NULL),(7,'Conflicting Control Actions',NULL,NULL),(8,'Component Failures',NULL,NULL),(9,'Changes over time',NULL,NULL),(10,'Process Input missing or wrong',NULL,NULL),(11,'Unidentified or out-of-range disturbance',NULL,NULL),(12,'Process output contributes to hazard',NULL,NULL),(13,'Feedback delays',NULL,NULL),(14,'Measurement inaccuracies',NULL,NULL),(15,'Incorrect or no information provided',NULL,NULL),(16,'Inadequate Operation',NULL,NULL),(17,'Feedback Delays',NULL,NULL),(18,'Inadequate or missing feedback',NULL,NULL),(19,'Missing, wrong or unauthorized communication with another controller',NULL,NULL);
/*!40000 ALTER TABLE `guidewords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hazards`
--

DROP TABLE IF EXISTS `hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hazards` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hazards`
--

LOCK TABLES `hazards` WRITE;
/*!40000 ALTER TABLE `hazards` DISABLE KEYS */;
INSERT INTO `hazards` VALUES (1,'Door close on a person in the doorway.','Description',1,NULL,NULL),(2,'Door open when the train is moving or not in a station.','Description',1,NULL,NULL),(3,'Passengers/staff are unable to exit during an emergency.','Description',1,NULL,NULL),(4,'Minimum distance between vehicles is not assured','Teste',2,'2018-05-21 22:31:08','2018-05-21 22:31:08'),(25,'Pumping insulin when glucose level is going down - hypoglycaemia','Teste',16,'2018-10-19 19:59:08','2018-10-19 19:59:08'),(6,'Vehicle on the railway. ','Teste',2,'2018-05-21 22:31:23','2018-05-21 22:31:23'),(7,'Vehicle is passing through the crossing gate','Teste',2,'2018-05-21 22:31:32','2018-05-21 22:31:32'),(8,'State that allows non-authorized access to bank account info','tst',3,NULL,NULL),(9,'State that does not allow a legitimate user to access his account info','tst',3,NULL,NULL),(10,'Degradated or non operational state of the system ','tst',3,NULL,NULL),(11,'My Hazard','Teste',12,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(12,'Pumping insulin when glucose level is going down ','Description',14,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(13,'Not pumping insulin when glucose level is going up','Description',14,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(14,'Critical user’s data being exchanged  between devices','Description',14,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(26,'Not pumping insulin when glucose level is going up - hyperglycaemia','Teste',16,'2018-10-19 19:59:22','2018-10-19 19:59:22'),(27,'System in operation with battery or reservoir level below recommended values.','Teste',16,'2018-10-19 19:59:30','2018-10-19 20:00:22'),(28,'Disclosure sensitive information (exposure of patient data)','Teste',16,'2018-10-19 19:59:41','2018-10-19 19:59:41'),(29,'Reservoir filled with not recommended insulin or another product','Teste',16,'2018-10-19 19:59:50','2018-10-19 19:59:50'),(30,'Mobile device not paired with insulin pump','Teste',16,'2018-10-19 19:59:58','2018-10-19 19:59:58');
/*!40000 ALTER TABLE `hazards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `losses`
--

DROP TABLE IF EXISTS `losses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `losses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `losses`
--

LOCK TABLES `losses` WRITE;
/*!40000 ALTER TABLE `losses` DISABLE KEYS */;
INSERT INTO `losses` VALUES (1,'Injury to a person by falling out of the train.','Description',1,NULL,NULL),(2,'Being hit by a closing door.','Description',1,NULL,NULL),(3,'Being trapped inside a train during an emergency.','Description',1,NULL,NULL),(10,'Loss of confidentiality of bank account info','Teste',3,NULL,NULL),(6,'Collision between car and train, causing damage loss and human injury or death.','Teste',2,'2018-05-21 22:30:41','2018-05-21 22:30:41'),(7,'Collision between cars, causing damage loss and human injury or death.','Teste',2,'2018-05-21 22:30:46','2018-05-21 22:30:46'),(8,'Collision between car and crossing gate','Teste',2,'2018-05-21 22:30:50','2018-05-21 22:30:50'),(9,'Train derailment.','Teste',2,'2018-05-21 22:30:58','2018-05-21 22:30:58'),(11,'Loss of confidentiality of bank account info','Tst',3,NULL,NULL),(12,'User unable to access his account info (make business) (Inacessability and Unavailability )','ts',3,NULL,NULL),(16,'My Accident','Teste',12,'2018-08-06 16:26:42','2018-08-06 16:26:42'),(19,'Loss related to user life and health: Death, Coma, Kidney Failure, and others (Safety)','Teste',14,'2018-08-23 22:17:23','2018-08-23 22:17:23'),(20,'Loss of manufacturer’s credibility due to non-authorized system alteration (Security Integrity) that is more frequent and more severe than is acceptable','Teste',14,'2018-08-23 22:17:34','2018-08-23 22:17:34'),(26,'Patient is injured or killed from overdose or underdose (safety)','Teste',16,'2018-10-19 19:58:36','2018-10-23 02:31:32'),(27,'Loss of manufacturer’s credibility.','Teste',16,'2018-10-19 19:58:43','2018-10-23 02:31:42'),(28,'Loss of personal information (e.g. level of glucose, amount of glucose, and etc.) (privacy and security)','Teste',16,'2018-10-19 19:58:48','2018-10-19 19:58:48');
/*!40000 ALTER TABLE `losses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `losses_hazards`
--

DROP TABLE IF EXISTS `losses_hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `losses_hazards` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `losses_id` int unsigned NOT NULL,
  `hazards_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `losses_hazards`
--

LOCK TABLES `losses_hazards` WRITE;
/*!40000 ALTER TABLE `losses_hazards` DISABLE KEYS */;
INSERT INTO `losses_hazards` VALUES (1,2,1,NULL,NULL),(2,1,2,NULL,NULL),(3,3,3,NULL,NULL),(4,7,4,'2018-05-21 22:31:08','2018-05-21 22:31:08'),(5,6,5,'2018-05-21 22:31:16','2018-05-21 22:31:16'),(6,7,5,'2018-05-21 22:31:16','2018-05-21 22:31:16'),(7,9,5,'2018-05-21 22:31:16','2018-05-21 22:31:16'),(8,6,6,'2018-05-21 22:31:23','2018-05-21 22:31:23'),(9,9,6,'2018-05-21 22:31:23','2018-05-21 22:31:23'),(10,8,7,'2018-05-21 22:31:32','2018-05-21 22:31:32'),(11,11,8,NULL,NULL),(12,12,9,NULL,NULL),(13,12,10,NULL,NULL),(14,16,11,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(15,19,12,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(16,19,13,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(17,20,14,'2018-08-06 16:27:19','2018-08-06 16:27:19'),(18,21,15,'2018-09-03 05:00:16','2018-09-03 05:00:16'),(19,1,16,'2018-09-03 05:00:50','2018-09-03 05:00:50'),(20,2,16,'2018-09-03 05:00:50','2018-09-03 05:00:50'),(21,3,16,'2018-09-03 05:00:50','2018-09-03 05:00:50'),(22,21,16,'2018-09-03 05:00:50','2018-09-03 05:00:50'),(23,1,17,'2018-09-03 06:58:46','2018-09-03 06:58:46'),(24,3,17,'2018-09-03 06:58:46','2018-09-03 06:58:46'),(25,1,18,'2018-09-03 15:27:08','2018-09-03 15:27:08'),(26,3,18,'2018-09-03 15:27:08','2018-09-03 15:27:08'),(27,0,19,'2018-09-03 15:28:12','2018-09-03 15:28:12'),(28,0,19,'2018-09-03 15:28:12','2018-09-03 15:28:12'),(29,0,19,'2018-09-03 15:28:12','2018-09-03 15:28:12'),(30,1,20,'2018-09-03 15:29:25','2018-09-03 15:29:25'),(31,2,20,'2018-09-03 15:29:25','2018-09-03 15:29:25'),(32,3,20,'2018-09-03 15:29:25','2018-09-03 15:29:25'),(33,1,21,'2018-09-03 15:30:37','2018-09-03 15:30:37'),(34,2,21,'2018-09-03 15:30:37','2018-09-03 15:30:37'),(35,3,21,'2018-09-03 15:30:37','2018-09-03 15:30:37'),(36,1,22,'2018-09-03 15:31:36','2018-09-03 15:31:36'),(37,2,22,'2018-09-03 15:31:36','2018-09-03 15:31:36'),(38,3,22,'2018-09-03 15:31:36','2018-09-03 15:31:36'),(39,1,23,'2018-09-03 15:31:55','2018-09-03 15:31:55'),(40,2,23,'2018-09-03 15:31:55','2018-09-03 15:31:55'),(41,3,23,'2018-09-03 15:31:55','2018-09-03 15:31:55'),(42,1,24,'2018-09-03 15:32:12','2018-09-03 15:32:12'),(43,2,24,'2018-09-03 15:32:12','2018-09-03 15:32:12'),(44,3,24,'2018-09-03 15:32:12','2018-09-03 15:32:12'),(45,26,25,'2018-10-19 19:59:08','2018-10-19 19:59:08'),(46,26,26,'2018-10-19 19:59:22','2018-10-19 19:59:22'),(47,26,27,'2018-10-19 19:59:30','2018-10-19 19:59:30'),(48,27,28,'2018-10-19 19:59:41','2018-10-19 19:59:41'),(49,28,28,'2018-10-19 19:59:41','2018-10-19 19:59:41'),(50,26,29,'2018-10-19 19:59:50','2018-10-19 19:59:50'),(51,26,30,'2018-10-19 19:59:58','2018-10-19 19:59:58'),(52,27,30,'2018-10-19 19:59:58','2018-10-19 19:59:58'),(53,26,31,'2018-10-22 16:44:47','2018-10-22 16:44:47'),(54,26,32,'2018-10-22 16:46:00','2018-10-22 16:46:00'),(55,27,32,'2018-10-22 16:46:00','2018-10-22 16:46:00'),(56,28,32,'2018-10-22 16:46:00','2018-10-22 16:46:00'),(57,26,33,'2018-10-23 19:22:28','2018-10-23 19:22:28'),(58,27,33,'2018-10-23 19:22:28','2018-10-23 19:22:28'),(59,28,33,'2018-10-23 19:22:28','2018-10-23 19:22:28'),(60,26,34,'2018-10-24 01:48:40','2018-10-24 01:48:40'),(61,28,34,'2018-10-24 01:48:40','2018-10-24 01:48:40'),(62,27,35,'2018-10-24 01:48:52','2018-10-24 01:48:52'),(63,28,35,'2018-10-24 01:48:52','2018-10-24 01:48:52'),(64,40,53,'2020-05-16 00:32:42','2020-05-16 00:32:42'),(66,39,55,'2020-05-16 00:33:38','2020-05-16 00:33:38'),(70,43,59,'2020-05-16 00:43:58','2020-05-16 00:43:58'),(71,44,60,'2020-05-16 00:45:09','2020-05-16 00:45:09'),(73,46,62,'2020-05-16 00:49:31','2020-05-16 00:49:31');
/*!40000 ALTER TABLE `losses_hazards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_08_17_043157_create_projects_table',1),('2016_08_17_043205_create_teams_table',1),('2016_08_17_043223_create_accidents_table',1),('2016_08_17_043230_create_hazards_table',1),('2016_08_17_043240_create_accidents__hazards_table',1),('2016_08_17_043250_create_system_goals_table',1),('2016_08_17_043302_create_components_table',1),('2016_08_17_043311_create_variables_table',1),('2016_08_17_043317_create_states_table',1),('2016_08_17_043324_create_control_actions_table',1),('2016_09_14_035531_create_rules_table',1),('2016_09_26_220716_create_safety_constraint_table',1),('2016_11_06_184154_create_actuators_table',1),('2016_11_06_184204_create_controllers_table',1),('2016_11_06_184215_create_controlledprocesses_table',1),('2016_11_06_184222_create_sensors_table',1),('2016_11_07_104940_create_connections_table',1),('2017_02_07_180124_create_context_table',1),('2017_02_21_221309_create_ca_safety_constraint_table',1),('2017_03_22_145135_create_guideword_table',1),('2017_03_22_145513_create_causal_analysis_table',1),('2017_04_06_014538_create_foreign_key',1),('2020_05_14_204922_create_assumptions_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mission` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `purpose` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `method` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `goals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission`
--

LOCK TABLES `mission` WRITE;
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
INSERT INTO `mission` VALUES (2,'provide a smooth treatment of diabetes','monitoring the patient’s glucose;control of the  injection of insulin;provision of alerts about the its operation','make life of patients easier, improving their health awareness',16,'2018-10-22 22:33:13','2018-10-24 01:59:08'),(11,'my purpose','Method 01;method 02;Method 03','My goal;goal mine;hehe',13,'2018-10-23 07:34:39','2018-10-23 07:35:45');
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `URL` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `URL_UNIQUE` (`URL`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Train Door System','An example from the book \"An STPA Primer\"',NULL,'2018-08-01 06:04:42','train-door-system-1','Safety'),(2,'Level Crossing','Description',NULL,NULL,'level-crossing-system-2','Safety'),(3,'Online Bank System','Description',NULL,NULL,'online-bank-system-3','Security'),(13,'Security Project','It is a project to illustrate a security in WebSTAMP','2018-08-15 03:52:06','2018-08-15 03:52:06','security-project-13','Security'),(16,'Insulin Pump with Continuous Glucose Monitor','When people give insulin injections, they may take 1-2 injections of a long acting insulin every day and 3+ injections of rapid acting insulin for meals and snacks. The typical person with Type 1 Diabetes could take anywhere from 4-7+ injections a day. Many people currently give insulin through an insulin pen or a syringe.\nAn insulin pump delivers rapid acting insulin in two ways. First, the pump is programmed to give you insulin every hour throughout the hour referred to basal insulin. Basal, think “base,” it is the insulin your body needs even in the absence of food, it is also referred to as background insulin. This basal rate replaces the long acting injection that you take. Second, abolus, that is the insulin you take for food or to correct a high blood sugar. Once you are on a pump, all insulin is delivered through the pump and shots are no longer necessary.','2018-10-19 19:58:02','2018-10-19 19:58:02','insulin-pump-with-continuous-glucose-monitor-16','Security'),(15,'Glucose Pump System','Description','2018-09-28 13:41:17','2018-09-28 13:41:17','glucose-pump-system-15','Security'),(17,'Teste','Teste','2020-05-14 23:04:00','2020-05-14 23:04:00','teste-17','Safety');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rules` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `index` int NOT NULL,
  `variable_id` int NOT NULL,
  `state_id` int NOT NULL,
  `controlaction_id` int NOT NULL,
  `column` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rules`
--

LOCK TABLES `rules` WRITE;
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` VALUES (79,1,22,0,12,'Provided','2018-09-28 21:44:34','2018-09-28 21:44:34'),(78,1,21,0,12,'Provided','2018-09-28 21:44:34','2018-09-28 21:44:34'),(49,1,6,0,4,'Provided','2018-05-21 23:11:37','2018-05-21 23:11:37'),(48,1,7,17,3,'Provided;Provided too early;Provided too late;Applied too long','2018-05-21 23:03:58','2018-05-21 23:03:58'),(47,1,8,0,3,'Provided;Provided too early;Provided too late;Applied too long','2018-05-21 23:03:58','2018-05-21 23:03:58'),(46,1,6,12,3,'Provided;Provided too early;Provided too late;Applied too long','2018-05-21 23:03:57','2018-05-21 23:03:57'),(185,1,28,0,14,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 19:34:53','2018-10-23 19:34:53'),(171,1,1,0,1,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 01:55:47','2018-10-23 01:55:47'),(184,1,27,0,14,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 19:34:53','2018-10-23 19:34:53'),(182,1,25,0,14,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 19:34:53','2018-10-23 19:34:53'),(183,1,26,0,14,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 19:34:53','2018-10-23 19:34:53'),(50,1,8,18,4,'Provided','2018-05-21 23:11:38','2018-05-21 23:11:38'),(51,1,7,15,4,'Provided','2018-05-21 23:11:38','2018-05-21 23:11:38'),(181,1,24,53,14,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 19:34:52','2018-10-23 19:34:52'),(77,1,20,43,12,'Provided','2018-09-28 21:44:34','2018-09-28 21:44:34'),(80,1,23,0,12,'Provided','2018-09-28 21:44:34','2018-09-28 21:44:34'),(81,2,20,44,12,'Provided;Not Provided;Provided too early','2018-10-15 14:42:39','2018-10-15 14:42:39'),(82,2,22,0,12,'Provided;Not Provided;Provided too early','2018-10-15 14:42:39','2018-10-15 14:42:39'),(83,2,21,45,12,'Provided;Not Provided;Provided too early','2018-10-15 14:42:39','2018-10-15 14:42:39'),(84,2,23,0,12,'Provided;Not Provided;Provided too early','2018-10-15 14:42:39','2018-10-15 14:42:39'),(172,1,2,0,1,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 01:55:47','2018-10-23 01:55:47'),(173,1,3,0,1,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 01:55:47','2018-10-23 01:55:47'),(174,1,4,8,1,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 01:55:47','2018-10-23 01:55:47'),(175,1,5,0,1,'Provided;Provided too early;Provided too late;Stopped too soon;Applied too long','2018-10-23 01:55:47','2018-10-23 01:55:47');
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `safety_constraints`
--

DROP TABLE IF EXISTS `safety_constraints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `safety_constraints` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `unsafe_control_action` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `safety_constraint` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `context` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `controlaction_id` int unsigned NOT NULL,
  `rule_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `safety_constraints`
--

LOCK TABLES `safety_constraints` WRITE;
/*!40000 ALTER TABLE `safety_constraints` DISABLE KEYS */;
INSERT INTO `safety_constraints` VALUES (34,'Controller provided open the crossing gate when train position is closer of the crossing level and crossing gate position is fully closed','Controller must not provide open the crossing gate when train position is closer of the crossing level and crossing gate position is fully closed','Provided;Provided too early;Provided too late;Applied too long','12,17',3,0,'2018-05-21 23:03:58','2018-05-21 23:03:58'),(35,'Controller provided open the crossing gate provided too early when train position is closer of the crossing level and crossing gate position is fully closed','Controller must not provide open the crossing gate provided too early when train position is closer of the crossing level and crossing gate position is fully closed','Provided;Provided too early;Provided too late;Applied too long','12,17',3,0,'2018-05-21 23:03:58','2018-05-21 23:03:58'),(36,'Controller provided open the crossing gate provided too late when train position is closer of the crossing level and crossing gate position is fully closed','Controller must not provide open the crossing gate provided too late when train position is closer of the crossing level and crossing gate position is fully closed','Provided;Provided too early;Provided too late;Applied too long','12,17',3,0,'2018-05-21 23:03:58','2018-05-21 23:03:58'),(37,'Controller provided open the crossing gate applied too long when train position is closer of the crossing level and crossing gate position is fully closed','Controller must not provide open the crossing gate applied too long when train position is closer of the crossing level and crossing gate position is fully closed','Provided;Provided too early;Provided too late;Applied too long','12,17',3,0,'2018-05-21 23:03:58','2018-05-21 23:03:58'),(38,'Controller provided close the crossing gate when crossing gate position is fully opened and crossing gate status is vehicle passing through the cg','Controller must not provide close the crossing gate when crossing gate position is fully opened and crossing gate status is vehicle passing through the cg','Provided','15,18',4,0,'2018-05-21 23:11:38','2018-05-21 23:11:38'),(44,'User controller not provided input carbs level when the user eats meal with glucose','User controller must not eat a meal with glucose','Not Provided','30,33',9,0,'2018-08-24 06:54:00','2018-08-24 06:55:13'),(45,'User controller not provided input carbs level when carbs level is wrong.','User controller must provide input carbs level when carb level is wrong.','Provided','30,33',9,0,'2018-08-24 06:55:29','2018-08-24 06:56:15'),(46,'Controller provided start in wrong time when carb level is high and going to eat is yes.','Controller must not provide start in wrong time when carb level is high and going to eat is yes.','Provided in wrong time','32,33',10,0,'2018-09-03 15:51:29','2018-09-03 15:51:29'),(47,'Controller provided stop too late when carb level is medium and going to eat is yes.','Controller must not provide stop too late when carb level is medium and going to eat is yes.','Provided too late','31,33',11,0,'2018-09-03 15:51:37','2018-09-03 15:51:37'),(50,'Insulin pump provided pumping insulin when glucose level is above','Insulin pump must not provide pumping insulin when glucose level is above','Provided','43',12,0,'2018-09-28 21:46:14','2018-09-28 21:46:14'),(51,'Insulin pump provided pumping insulin when glucose level is below and reservoir level is above','Insulin pump must not provide pumping insulin when glucose level is below and reservoir level is above','Provided;Not Provided;Provided too early','44,45',12,0,'2018-10-15 14:42:40','2018-10-15 14:42:40'),(52,'Insulin pump not provided pumping insulin when glucose level is below and reservoir level is above','Insulin pump must not provide pumping insulin when glucose level is below and reservoir level is above','Provided;Not Provided;Provided too early','44,45',12,0,'2018-10-15 14:42:40','2018-10-15 14:42:40'),(53,'Insulin pump provided pumping insulin provided too early when glucose level is below and reservoir level is above','Insulin pump must not provide pumping insulin provided too early when glucose level is below and reservoir level is above','Provided;Not Provided;Provided too early','44,45',12,0,'2018-10-15 14:42:40','2018-10-15 14:42:40'),(54,'Insulin pump provided pumping insulin too early when glucose level is below, reservoir level is below, battery level is low and pump operational status is not transmitting.','Insulin pump must not provide pumping insulin too early when glucose level is below, reservoir level is below, battery level is low and pump operational status is not transmitting.','Provided too early','44,46,48,50',12,0,'2018-10-15 14:57:21','2018-10-15 14:57:21'),(134,'Insulin pump provided pump insulin applied too long when glucose level is above','Insulin pump must not provide pump insulin applied too long when glucose level is above','Applied too long','53',14,1,'2018-10-23 19:34:54','2018-10-24 02:07:41'),(59,'Insulin pump provided pumping insulin too early when glucose level is below, reservoir level is below, battery level is high and pump operational status is not transmitting.','Insulin pump must not provide pumping insulin too early when glucose level is below, reservoir level is below, battery level is high and pump operational status is not transmitting.','Provided too early','44,46,47,50',12,0,'2018-10-15 15:59:29','2018-10-15 15:59:29'),(122,'Train door controller not provided open door command when door position is fully closed, door situation is nothing in doorway, train position is not aligned at platform, train motion is stopped and emergency is no emergency.','Train door controller must provide open door command when door position is fully closed, door situation is nothing in doorway, train position is not aligned at platform, train motion is stopped and emergency is no emergency.','Not provided','3,5,7,9,11',1,0,'2018-10-23 01:56:25','2018-10-23 01:56:25'),(133,'Insulin pump provided pump insulin stopped too soon when glucose level is above','Insulin pump must not provide pump insulin stopped too soon when glucose level is above','Stopped too soon','53',14,1,'2018-10-23 19:34:54','2018-10-23 19:34:54'),(130,'Insulin pump provided pump insulin when glucose level is above','Insulin pump must not provide pump insulin when glucose level is above','Provided','53',14,1,'2018-10-23 19:34:53','2018-10-23 19:34:53'),(131,'Insulin pump provided pump insulin provided too early when glucose level is above','Insulin pump must not provide pump insulin provided too early when glucose level is above','Provided too early','53',14,1,'2018-10-23 19:34:53','2018-10-23 19:34:53'),(132,'Insulin pump provided pump insulin provided too late when glucose level is above','Insulin pump must not provide pump insulin provided too late when glucose level is above','Provided too late','53',14,1,'2018-10-23 19:34:54','2018-10-23 19:34:54'),(117,'Train door controller provided open door command when train motion is in movement','Train door controller must not provide open door command when train motion is in movement','Provided','8',1,1,'2018-10-23 01:55:48','2018-10-23 01:55:48'),(118,'Train door controller provided open door command provided too early when train motion is in movement','Train door controller must not provide open door command provided too early when train motion is in movement','Provided too early','8',1,1,'2018-10-23 01:55:48','2018-10-23 01:55:48'),(119,'Train door controller provided open door command provided too late when train motion is in movement','Train door controller must not provide open door command provided too late when train motion is in movement','Provided too late','8',1,1,'2018-10-23 01:55:48','2018-10-23 01:55:48'),(120,'Train door controller provided open door command stopped too soon when train motion is in movement','Train door controller must not provide open door command stopped too soon when train motion is in movement','Stopped too soon','8',1,1,'2018-10-23 01:55:48','2018-10-23 01:55:48'),(121,'Train door controller provided open door command applied too long when train motion is in movement','Train door controller must not provide open door command applied too long when train motion is in movement','Applied too long','8',1,1,'2018-10-23 01:55:48','2018-10-23 01:55:48');
/*!40000 ALTER TABLE `safety_constraints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sensors`
--

LOCK TABLES `sensors` WRITE;
/*!40000 ALTER TABLE `sensors` DISABLE KEYS */;
INSERT INTO `sensors` VALUES (1,'Train Door Sensor',1,NULL,NULL),(2,'Sensor',2,'2018-05-21 22:45:22','2018-05-21 22:45:22'),(3,'My Sensor',12,'2018-08-06 16:29:16','2018-08-06 16:29:16'),(5,'CGM',14,'2018-08-24 06:00:34','2018-08-24 06:00:34'),(6,'Insulin Pump Sensor',15,'2018-09-28 21:44:20','2018-09-28 21:50:59');
/*!40000 ALTER TABLE `sensors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `variable_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Fully Open',1,NULL,NULL),(2,'Partially Open',1,NULL,NULL),(3,'Fully Closed',1,NULL,NULL),(4,'Person or object in doorway',2,NULL,NULL),(5,'Nothing in doorway',2,NULL,NULL),(6,'Aligned at platform',3,NULL,NULL),(7,'Not aligned at platform',3,NULL,NULL),(8,'In Movement',4,NULL,NULL),(9,'Stopped',4,NULL,NULL),(10,'Evacuation Required',5,NULL,NULL),(11,'No Emergency',5,NULL,NULL),(12,'Closer of the crossing level',6,'2018-05-21 22:46:38','2018-05-21 22:46:38'),(13,'In the crossing level',6,'2018-05-21 22:46:38','2018-05-21 22:46:38'),(14,'Far from crossing level',6,'2018-05-21 22:46:47','2018-05-21 22:46:47'),(15,'Fully Opened',7,NULL,NULL),(16,'Partially Opened',7,NULL,NULL),(17,'Fully Closed',7,NULL,NULL),(18,'Vehicle passing through the CG',8,NULL,NULL),(19,'No Vehicle passing through the CG',8,NULL,NULL),(20,'My State 01',9,'2018-08-06 16:30:14','2018-08-06 16:30:14'),(21,'My State 02',9,'2018-08-06 16:30:14','2018-08-06 16:30:14'),(22,'My State 03',10,'2018-08-06 16:30:21','2018-08-06 16:30:21'),(23,'My State 04',10,'2018-08-06 16:30:21','2018-08-06 16:30:21'),(24,'My State 05',11,'2018-08-06 16:30:28','2018-08-06 16:30:28'),(25,'My State 06',11,'2018-08-06 16:30:28','2018-08-06 16:30:28'),(26,'CP State 01',12,'2018-08-06 20:20:13','2018-08-06 20:20:13'),(27,'CP State 02',12,'2018-08-06 20:20:13','2018-08-06 20:20:13'),(28,'CP State 03',13,'2018-08-06 20:20:19','2018-08-06 20:20:19'),(29,'CP State 04',13,'2018-08-06 20:20:19','2018-08-06 20:20:19'),(30,'Low',14,'2018-08-24 06:13:35','2018-08-24 06:13:35'),(31,'Medium',14,'2018-08-24 06:13:35','2018-08-24 06:13:35'),(32,'High',14,'2018-08-24 06:13:40','2018-08-24 06:13:40'),(33,'Yes',15,'2018-08-24 06:13:59','2018-08-24 06:13:59'),(34,'No',15,'2018-08-24 06:13:59','2018-08-24 06:13:59'),(43,'Above',20,'2018-09-28 13:42:49','2018-09-28 13:42:49'),(37,'Yes',17,'2018-08-24 06:18:46','2018-08-24 06:18:46'),(38,'No',17,'2018-08-24 06:18:46','2018-08-24 06:18:46'),(39,'Basal',18,'2018-08-24 06:19:02','2018-08-24 06:19:02'),(40,'Bolus',18,'2018-08-24 06:19:02','2018-08-24 06:19:02'),(41,'Increasing',19,'2018-08-24 06:21:54','2018-08-24 06:21:54'),(42,'Decreasing',19,'2018-08-24 06:21:54','2018-08-24 06:21:54'),(44,'Below',20,'2018-09-28 13:42:49','2018-09-28 13:42:49'),(45,'Above',21,'2018-09-28 13:43:08','2018-09-28 13:43:08'),(46,'Below',21,'2018-09-28 13:43:08','2018-09-28 13:43:08'),(47,'High',22,'2018-09-28 13:43:15','2018-09-28 13:43:15'),(48,'Low',22,'2018-09-28 13:43:15','2018-09-28 13:43:15'),(49,'Transmitting',23,'2018-09-28 13:43:33','2018-09-28 13:43:33'),(50,'Not transmitting',23,'2018-09-28 13:43:33','2018-09-28 13:43:33'),(51,'Below',24,'2018-10-20 20:39:43','2018-10-20 20:39:43'),(52,'Normal',24,'2018-10-20 20:39:43','2018-10-20 20:39:43'),(53,'Above',24,'2018-10-20 20:39:49','2018-10-20 20:39:49'),(54,'Below',25,'2018-10-20 20:40:12','2018-10-20 20:40:12'),(55,'Normal',25,'2018-10-20 20:40:12','2018-10-20 20:40:12'),(56,'Above',25,'2018-10-20 20:40:19','2018-10-20 20:40:19'),(57,'Below',26,'2018-10-20 20:40:33','2018-10-20 20:40:33'),(58,'Normal',26,'2018-10-20 20:40:33','2018-10-20 20:40:33'),(59,'Above',26,'2018-10-20 20:40:39','2018-10-20 20:40:39'),(60,'Transmitting',27,'2018-10-20 20:40:53','2018-10-20 20:40:53'),(61,'Not transmitting',27,'2018-10-20 20:40:53','2018-10-20 20:40:53'),(62,'Below',28,'2018-10-20 20:41:34','2018-10-20 20:41:34'),(63,'Normal',28,'2018-10-20 20:41:34','2018-10-20 20:41:34'),(64,'Above',28,'2018-10-20 20:41:40','2018-10-20 20:41:40'),(65,'Recent',29,'2018-10-20 20:42:14','2018-10-20 20:42:14'),(66,'Old',29,'2018-10-20 20:42:14','2018-10-20 20:42:14');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_goals`
--

DROP TABLE IF EXISTS `system_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_goals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_goals`
--

LOCK TABLES `system_goals` WRITE;
/*!40000 ALTER TABLE `system_goals` DISABLE KEYS */;
INSERT INTO `system_goals` VALUES (1,'Provide an easy way to control the door.','Description',1,NULL,NULL),(2,'Ensure the safety of passengers in boarding and landing at stations.','Description',1,NULL,NULL),(3,'Avoid any type of injury to passengers.','Description',1,NULL,NULL),(4,'Make a safe trip between stations.','Description',1,NULL,NULL),(5,'Ensure a safe passage along the level crossing','Teste',2,'2018-05-21 22:30:23','2018-05-21 22:30:23'),(6,'Avoid collisions','Teste',2,'2018-05-21 22:30:30','2018-05-21 22:30:30'),(7,'Protect the train, vehicles and passengers.','Teste',2,'2018-05-21 22:30:35','2018-05-21 22:30:35'),(8,'My System Goal','Teste',12,'2018-08-06 16:28:11','2018-08-06 16:28:11'),(12,'Provide a smooth treatment of diabetes, making life of patients easier.','Teste',16,'2018-10-22 19:47:27','2018-10-22 21:58:43');
/*!40000 ALTER TABLE `system_goals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_safety_constraint`
--

DROP TABLE IF EXISTS `system_safety_constraint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_safety_constraint` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_safety_constraint`
--

LOCK TABLES `system_safety_constraint` WRITE;
/*!40000 ALTER TABLE `system_safety_constraint` DISABLE KEYS */;
INSERT INTO `system_safety_constraint` VALUES (1,'Door must not be opened when train is in motion.','Description',1,NULL,NULL),(2,'When in Emergency situation, door must be opened.','Description',1,NULL,NULL),(3,'Door must not be closed when exist a person or object in the doorway.','Description',1,NULL,NULL),(4,'Minimum distance between vehicles must be assured','Teste',2,'2018-05-21 22:31:39','2018-05-21 22:31:39'),(5,'Vehicles must not be in the railway when train is approaching the level crossing ','Teste',2,'2018-05-21 22:31:45','2018-05-21 22:32:02'),(6,'Vehicles must not pass though the crossing gate when it is being closed','Teste',2,'2018-05-21 22:31:50','2018-05-21 22:32:10'),(7,'Do not allow non-authorized access to bank account info','tst',3,NULL,NULL),(8,'Must allow authorized  (legitimate) user access his bank account info','tst',3,NULL,NULL),(9,'Must be operational to a user at all times','tst',3,NULL,NULL),(11,'My System Safety Constraint','Teste',12,'2018-08-06 16:27:26','2018-08-06 16:27:26'),(12,'Not pump insulin when glucose level is going down','Teste',14,'2018-08-23 22:33:09','2018-08-23 22:33:09'),(13,'Pumping insulin when glucose level is going up','Teste',14,'2018-08-23 22:33:20','2018-08-23 22:33:20'),(17,'The pumping of insulin must be stopped when the glucose level goes below a configurable minimum level (for both Bolus and basal).','Teste',16,'2018-10-19 20:01:46','2018-10-19 20:01:46'),(18,'The system must automatically start pumping insulin after reaching some maximum configurable level','Teste',16,'2018-10-19 20:01:53','2018-10-19 20:01:53'),(19,'The system must never exposure patient data without patient\'s  approval.','Teste',16,'2018-10-19 20:01:59','2018-10-19 20:01:59');
/*!40000 ALTER TABLE `system_safety_constraint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,1,1,NULL,NULL),(2,1,2,NULL,NULL),(3,1,3,NULL,NULL),(4,1,4,NULL,NULL),(5,2,1,NULL,NULL),(6,2,2,NULL,NULL),(8,1,10,'2018-08-01 06:54:43','2018-08-01 06:54:43'),(9,2,10,'2018-08-01 06:54:43','2018-08-01 06:54:43'),(14,1,13,'2018-08-15 03:52:06','2018-08-15 03:52:06'),(15,0,13,'2018-08-15 03:52:06','2018-08-15 03:52:06'),(21,0,16,'2018-10-19 19:58:02','2018-10-19 19:58:02'),(20,1,16,'2018-10-19 19:58:02','2018-10-19 19:58:02'),(18,1,15,'2018-09-28 13:41:17','2018-09-28 13:41:17'),(19,0,15,'2018-09-28 13:41:17','2018-09-28 13:41:17'),(22,3,17,'2020-05-14 23:04:00','2020-05-14 23:04:00'),(23,0,17,'2020-05-14 23:04:00','2020-05-14 23:04:00');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fellipe Guilherme Rey de Souza','fellipeguilhermerey@gmail.com','$2y$10$qcf2YI3b8hw656cY83AjB.uXqkYtVD0QoRZWzPZWXGXhDErZRrkAq','Ees9jqpDqt89ihYpHumZdRIA6SDoY2eHAICoTKm6jZfb065YWdnpU95viBys','2018-04-26 09:33:47','2018-10-24 20:58:25'),(2,'Celso Hirata','hirata@ita.br','$2y$12$fgJ5wLI6cYwjbhvx.ooFgO4YDfvcseM1bXl6ZfWsgyeyriJJ2lyWK','2kCC5D5DGLEF8QcnLXKK5BANPGV9XzFYau7FA1zQs2DcLtDgUUNtPXxqsI52','2018-04-26 15:30:56','2018-10-24 03:05:14'),(3,'Filipe Ribeiro','filipe.parisoto@gmail.com','$2y$10$6IwMe4A1cl0kcaOqHpfqH.vowfDn/v7Nsa4ybQE8eSfk/LZKllOwW','WTRGJxLSdbaz47sfQCjLYCzDObQt32K8UAv81PaLhpGhzq1wPUOywTRyoLIw','2020-05-14 23:03:32','2020-05-20 03:05:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variables` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int unsigned NOT NULL,
  `controller_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variables`
--

LOCK TABLES `variables` WRITE;
/*!40000 ALTER TABLE `variables` DISABLE KEYS */;
INSERT INTO `variables` VALUES (1,'Door Position',1,0,NULL,NULL),(2,'Door Situation',1,0,NULL,NULL),(3,'Train Position',1,1,NULL,NULL),(4,'Train Motion',1,1,NULL,NULL),(5,'Emergency',1,1,NULL,NULL),(6,'Train Position',2,2,'2018-05-21 22:46:38','2018-05-21 22:46:38'),(7,'Crossing Gate Position',2,0,NULL,NULL),(8,'Crossing Gate Status',2,0,NULL,NULL),(9,'My Variable 01',12,3,'2018-08-06 16:30:14','2018-08-06 16:30:14'),(10,'My Variable 02',12,3,'2018-08-06 16:30:21','2018-08-06 16:30:21'),(11,'My Variable 03',12,3,'2018-08-06 16:30:28','2018-08-06 20:20:02'),(12,'My CP Variable 01',12,0,'2018-08-06 20:20:13','2018-08-06 20:20:13'),(13,'My CP Variable 02',12,0,'2018-08-06 20:20:19','2018-08-06 20:20:19'),(14,'Carb level',14,6,'2018-08-24 06:13:35','2018-08-24 06:13:35'),(15,'Going to eat',14,6,'2018-08-24 06:13:59','2018-08-24 06:13:59'),(20,'Glucose Level',15,0,'2018-09-28 13:42:49','2018-09-28 13:42:49'),(17,'Pumping',14,7,'2018-08-24 06:18:46','2018-08-24 06:18:46'),(18,'Injection',14,7,'2018-08-24 06:19:02','2018-08-24 06:19:02'),(19,'Glucose Level evolution',14,7,'2018-08-24 06:21:54','2018-08-24 06:21:54'),(21,'Reservoir level',15,8,'2018-09-28 13:43:08','2018-09-28 13:43:08'),(22,'Battery Level',15,8,'2018-09-28 13:43:15','2018-09-28 13:43:15'),(23,'Pump operational status',15,8,'2018-09-28 13:43:33','2018-09-28 13:43:33'),(24,'Glucose Level',16,0,'2018-10-20 20:39:43','2018-10-20 20:39:43'),(25,'Reservoir level',16,12,'2018-10-20 20:40:12','2018-10-20 20:40:12'),(26,'Battery level',16,12,'2018-10-20 20:40:33','2018-10-20 20:40:33'),(27,'Pump operational status',16,12,'2018-10-20 20:40:53','2018-10-20 20:40:53'),(28,'Basal rate',16,12,'2018-10-20 20:41:34','2018-10-20 20:41:34'),(29,'Date of release of new update or patch',16,11,'2018-10-20 20:42:14','2018-10-20 20:42:14');
/*!40000 ALTER TABLE `variables` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-20 17:20:57
