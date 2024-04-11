-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: us-cdbr-iron-east-03.cleardb.net    Database: heroku_695150d79387277
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=626 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `assumptions`
--

DROP TABLE IF EXISTS `assumptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assumptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `causal_analysis`
--

DROP TABLE IF EXISTS `causal_analysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `causal_analysis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scenario` text COLLATE utf8_unicode_ci NOT NULL,
  `associated_causal_factor` text COLLATE utf8_unicode_ci NOT NULL,
  `requirement` text COLLATE utf8_unicode_ci NOT NULL,
  `role` text COLLATE utf8_unicode_ci NOT NULL,
  `rationale` text COLLATE utf8_unicode_ci NOT NULL,
  `guideword_id` int(10) unsigned NOT NULL,
  `safety_constraint_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5316 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Actuator','ControlledProcess','Controller','Sensor') COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `connections`
--

DROP TABLE IF EXISTS `connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `connections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `output_component_id` int(10) unsigned NOT NULL,
  `type_output` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `input_component_id` int(10) unsigned NOT NULL,
  `type_input` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3166 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `context_tables`
--

DROP TABLE IF EXISTS `context_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `context_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `controlaction_id` int(11) NOT NULL,
  `context` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_provided` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_not_provided` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wrong_time_order` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_early` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_late` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_soon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ca_too_long` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17156 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `control_actions`
--

DROP TABLE IF EXISTS `control_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `control_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `controller_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1826 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `controlled_processes`
--

DROP TABLE IF EXISTS `controlled_processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controlled_processes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=636 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `controllers`
--

DROP TABLE IF EXISTS `controllers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controllers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1686 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `guidewords`
--

DROP TABLE IF EXISTS `guidewords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guidewords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guideword` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hazards`
--

DROP TABLE IF EXISTS `hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hazards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2866 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `losses`
--

DROP TABLE IF EXISTS `losses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `losses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2466 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `losses_hazards`
--

DROP TABLE IF EXISTS `losses_hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `losses_hazards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loss_id` int(10) unsigned NOT NULL,
  `hazard_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4096 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purpose` text COLLATE utf8_unicode_ci NOT NULL,
  `method` text COLLATE utf8_unicode_ci NOT NULL,
  `goals` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_url_unique` (`URL`)
) ENGINE=InnoDB AUTO_INCREMENT=1026 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `controlaction_id` int(10) unsigned NOT NULL,
  `column` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=996 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rules_safetyconstraints_hazards`
--

DROP TABLE IF EXISTS `rules_safetyconstraints_hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rules_safetyconstraints_hazards` (
  `rule_id` int(10) unsigned NOT NULL,
  `sc_id` int(10) unsigned NOT NULL,
  `hazard_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rules_variables_states`
--

DROP TABLE IF EXISTS `rules_variables_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rules_variables_states` (
  `rule_id` int(10) unsigned NOT NULL,
  `variable_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `safety_constraints`
--

DROP TABLE IF EXISTS `safety_constraints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `safety_constraints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unsafe_control_action` text COLLATE utf8_unicode_ci NOT NULL,
  `safety_constraint` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `context` text COLLATE utf8_unicode_ci NOT NULL,
  `controlaction_id` int(10) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6786 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sensors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=446 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variable_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6876 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_goals`
--

DROP TABLE IF EXISTS `system_goals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_goals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=946 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_safety_constraint`
--

DROP TABLE IF EXISTS `system_safety_constraint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_safety_constraint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2386 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `systemsafetyconstraint_hazards`
--

DROP TABLE IF EXISTS `systemsafetyconstraint_hazards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `systemsafetyconstraint_hazards` (
  `ssc_id` int(10) unsigned NOT NULL,
  `hazard_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1986 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=596 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `variables`
--

DROP TABLE IF EXISTS `variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `controller_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2756 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `causal_analysis`
--

LOCK TABLES `causal_analysis` WRITE;
/*!40000 ALTER TABLE `causal_analysis` DISABLE KEYS */;
INSERT INTO `causal_analysis` VALUES (1,'[CONTROLLER] receives the wrong value of [VARIABLE].','Failure in the communication between [CONTROLLER] and the external system.','The communication between [CONTROLLER] and external system must be improved.','Engineers or network administrator.','This external system are out of the scope of the system under analysis.',1,0,NULL,NULL),(2,'Value of [VARIABLE] is missing.','Failure in the communication between [CONTROLLER] and the external system.','The communication between [CONTROLLER] and external system must be improved.','Engineers or network administrator.','This external system are out of the scope of the system under analysis.',1,0,NULL,NULL),(3,'An incorrect algorithm was designed','Algorithm wrong or incomplete or lack of knowledge of the system.','The algorithm must be revised and tested after each change to minimize errors.','Engineers and testers','Simulations of the system can help to validate the algorithm.',2,0,NULL,NULL),(4,'Algorithm ineffective, unsafe or incomplete after process changes.','Algorithm was not updated to support changes of the process.','Algorithm must be updated, revised and tested after each change in the process to minimize errors.','Designers and operators.','Algorithm must be revised and adapted to support the process changes.',2,0,NULL,NULL),(5,'Algorithm updated incorrectly.','Flaw in the modifications or algorithm was not updated to support the modifications.','After each modification in the algorithm, it must be revised and tested to minimize errors.','Designers, testers and operators.','Algorithm should be updated properly for each change.',2,0,NULL,NULL),(6,'Current state of the process model is inconsistent, incorrect or incomplete.','Feedback of emergency missing or with wrong value.','Process model in the [CONTROLLER] must be consistent with the [CONTROLLED PROCESS] and external system status.','System’s designers','Not applicable (N/A)',3,0,NULL,NULL),(7,'[CONTROLLER] does not provide the control action or issued an incorrect.','Problems in the process model and/or control algorithms.','Process model in [CONTROLLER] must be the same in the [CONTROLLED PROCESS] and the control ','Engineers','Not Applicable (N/A)',4,0,NULL,NULL),(8,'[ACTUATOR] cannot act in [CONTROLLED PROCESS] or complete the execution of the Control Action.','Failure in the [ACTUATOR].','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',5,0,NULL,NULL),(9,'[ACTUATOR] performs a non-issued control action.','Failure in the [ACTUATOR].','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',5,0,NULL,NULL),(10,'The issued control action delays to be enforced by the [ACTUATOR].','Failure in the [ACTUATOR], electric failure or temporary loss of power','The [ACTUATOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',6,0,NULL,NULL),(11,'[CONTROLLER2] issues a control action that conflicts with the one provided by the [CONTROLLER].','Lack of resolution of controls or design error.','Analysis of conflicts should be done to avoid conflicting control actions.','Safety Engineer and Stakeholders.','Not Applicable (N/A)',7,0,NULL,NULL),(12,'The system components do not perform their functions.','Failure in one or more components of the system.','Ongoing STPA analysis must be done in order to cover each change in the system.','Maintainer','Reliability analysis can be done for small components introduced in the system. Complex components must have their own STPA analysis.',8,0,NULL,NULL),(13,'[CONTROLLED PROCESS] affected by natural or man made disasters.','Depends of the disaster.','Some disasters can be mitigated.','Safety Engineers.','Not Applicable (N/A)',11,0,NULL,NULL),(14,'Temporary obstruction not allow the reading of the [CONTROLLED PROCESS].','Obstruction for observing; Mean obstructed.','Alternative way to read the [CONTROLLED PROCESS] should be considered.','Design team','Not Applicable (N/A)',13,0,NULL,NULL),(15,'Current state of the [CONTROLLED PROCESS] cannot be read accurately.','Obstruction for observing; Mean obstructed; Poor environment conditions or; Accuracy property is not guaranteed.','Most capable sensor or alternative way to read the [CONTROLLED PROCESS] should be considered.','Design team','[SENSOR] may not be calibrated.',14,0,NULL,NULL),(16,'[CONTROLLED PROCESS] cannot be read by the [SENSOR].','Reading errors; Variations in the [CONTROLLED PROCESS] or; Precision and sensitivity properties are not guaranteed.','The correct type of sensor must be chosen according to the controlled process.','Design team','Not Applicable (N/A)',15,0,NULL,NULL),(17,'[SENSOR] cannot get the status of the [CONTROLLED PROCESS].','Failure in the [SENSOR].','The [SENSOR] must be maintained periodically.','Reliability engineers','Reliability analysis can minimize the failures.',16,0,NULL,NULL),(18,'Feedback delays to reach the [CONTROLLER]','Limitations in the communication protocol or problem in the communication mean (Wire or Wireless)','Communication between [CONTROLLER] and [SENSOR] must be improved.','Engineers','Alternative communication means can be considered.',17,0,NULL,NULL);

LOCK TABLES `guidewords` WRITE;
/*!40000 ALTER TABLE `guidewords` DISABLE KEYS */;
INSERT INTO `guidewords` VALUES (1,'Control input or external information wrong or missing',NULL,NULL),(2,'Inadequate Control Algorithm',NULL,NULL),(3,'Process Model inconsistent, incorrect or incomplete',NULL,NULL),(4,'Inappropriate, ineffective or missing control action',NULL,NULL),(5,'Inadequate Operation',NULL,NULL),(6,'Delayed Operation',NULL,NULL),(7,'Conflicting Control Actions',NULL,NULL),(8,'Component Failures',NULL,NULL),(9,'Changes over time',NULL,NULL),(10,'Process Input missing or wrong',NULL,NULL),(11,'Unidentified or out-of-range disturbance',NULL,NULL),(12,'Process output contributes to hazard',NULL,NULL),(13,'Feedback delays',NULL,NULL),(14,'Measurement inaccuracies',NULL,NULL),(15,'Incorrect or no information provided',NULL,NULL),(16,'Inadequate Operation',NULL,NULL),(17,'Feedback Delays',NULL,NULL),(18,'Inadequate or missing feedback',NULL,NULL),(19,'Missing, wrong or unauthorized communication with another controller',NULL,NULL);
/*!40000 ALTER TABLE `guidewords` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-07 15:15:20
