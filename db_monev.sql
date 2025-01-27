-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_monev
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_activation_attempts`
--

DROP TABLE IF EXISTS `auth_activation_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_activation_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_activation_attempts`
--

LOCK TABLES `auth_activation_attempts` WRITE;
/*!40000 ALTER TABLE `auth_activation_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_activation_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups`
--

LOCK TABLES `auth_groups` WRITE;
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` VALUES (1,'gpm','site gpm'),(2,'dosen','site dosen'),(4,'admin','manage-user'),(5,'kajur','ini role kajur');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_permissions`
--

DROP TABLE IF EXISTS `auth_groups_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_permissions`
--

LOCK TABLES `auth_groups_permissions` WRITE;
/*!40000 ALTER TABLE `auth_groups_permissions` DISABLE KEYS */;
INSERT INTO `auth_groups_permissions` VALUES (1,4),(1,4),(2,3),(2,3);
/*!40000 ALTER TABLE `auth_groups_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL DEFAULT 0,
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` VALUES (1,8),(2,7),(4,10),(4,17),(4,25),(5,26);
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=410 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_logins`
--

LOCK TABLES `auth_logins` WRITE;
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` VALUES (5,'::1','admin123@gmail.com',2,'2024-10-28 07:34:02',1),(6,'::1','raja@gmail.com',3,'2024-10-28 11:01:21',1),(7,'::1','raja@gmail.com',3,'2024-10-28 11:11:39',1),(8,'::1','raja@gmail.com',3,'2024-10-28 11:12:07',1),(9,'::1','raja@gmail.com',3,'2024-10-28 11:15:12',1),(10,'::1','raja@gmail.com',3,'2024-10-28 11:15:49',1),(11,'::1','raja@gmail.com',3,'2024-10-28 11:16:42',1),(12,'::1','raja@gmail.com',3,'2024-10-28 11:18:46',1),(13,'::1','raja@gmail.com',3,'2024-10-28 11:20:02',1),(14,'::1','raja@gmail.com',3,'2024-10-28 11:23:24',1),(15,'::1','raja@gmail.com',3,'2024-10-28 11:24:30',1),(16,'::1','admin111@gmail.com',4,'2024-10-28 11:25:13',1),(17,'::1','raja@gmail.com',3,'2024-10-28 11:31:49',1),(18,'::1','raja@gmail.com',3,'2024-10-28 11:33:59',1),(19,'::1','raja@gmail.com',3,'2024-10-28 12:41:42',1),(20,'::1','raja@gmail.com',3,'2024-10-28 13:27:14',1),(21,'::1','raja@gmail.com',3,'2024-10-28 13:27:17',1),(22,'::1','raja@gmail.com',3,'2024-10-28 13:27:27',1),(23,'::1','raja@gmail.com',3,'2024-10-28 16:06:37',1),(24,'::1','raja@gmail.com',3,'2024-10-28 16:12:40',1),(25,'::1','raja@gmail.com',3,'2024-10-28 17:27:47',1),(26,'::1','raja@gmail.com',3,'2024-10-28 17:43:20',1),(27,'::1','dosen',NULL,'2024-10-28 18:47:56',0),(28,'::1','dosen',NULL,'2024-10-28 18:48:19',0),(29,'::1','dosen123@gmail.com',5,'2024-10-28 18:48:26',1),(30,'::1','admin123',NULL,'2024-10-28 19:10:30',0),(31,'::1','admin',NULL,'2024-10-28 19:10:40',0),(32,'::1','gpm@gmail.com',6,'2024-10-28 19:11:55',1),(33,'::1','gpm',NULL,'2024-10-28 19:22:08',0),(34,'::1','gpm@gmail.com',6,'2024-10-28 19:22:17',1),(35,'::1','dosen@gmail.com',7,'2024-10-28 19:56:12',1),(36,'::1','gpm',NULL,'2024-10-28 19:56:23',0),(37,'::1','gpm',NULL,'2024-10-28 19:56:31',0),(38,'::1','gpm@gmail.com',8,'2024-10-28 19:56:44',1),(39,'::1','gpm@gmail.com',8,'2024-10-28 20:00:26',1),(40,'::1','dosen@gmail.com',7,'2024-10-28 20:00:38',1),(41,'::1','gpm@gmail.com',8,'2024-10-28 20:19:01',1),(42,'::1','dosen@gmail.com',7,'2024-10-28 20:20:51',1),(43,'::1','gpm@gmail.com',8,'2024-10-28 20:21:54',1),(44,'::1','gpm@gmail.com',8,'2024-10-28 20:51:05',1),(45,'::1','dosen@gmail.com',7,'2024-10-28 20:51:23',1),(46,'::1','gpm@gmail.com',8,'2024-10-28 20:54:56',1),(47,'::1','gpm@gmail.com',8,'2024-10-28 20:56:08',1),(48,'::1','dosen@gmail.com',7,'2024-10-28 20:56:44',1),(49,'::1','gpm@gmail.com',8,'2024-10-29 07:34:26',1),(50,'::1','dosen@gmail.com',7,'2024-10-29 07:59:34',1),(51,'::1','dosen@gmail.com',7,'2024-10-29 08:02:18',1),(52,'::1','gpm',NULL,'2024-10-29 08:02:34',0),(53,'::1','gpm@gmail.com',8,'2024-10-29 08:02:41',1),(54,'::1','dosen@gmail.com',7,'2024-10-29 08:03:37',1),(55,'::1','gpm@gmail.com',8,'2024-10-29 08:22:24',1),(56,'::1','dosen@gmail.com',7,'2024-10-29 12:15:12',1),(57,'::1','dosen@gmail.com',7,'2024-10-29 12:16:28',1),(58,'::1','dosen',NULL,'2024-10-29 12:31:20',0),(59,'::1','dosen@gmail.com',7,'2024-10-29 12:31:27',1),(60,'::1','gpm@gmail.com',8,'2024-10-29 12:55:56',1),(61,'::1','dosen@gmail.com',7,'2024-10-29 12:56:11',1),(62,'::1','gpm@gmail.com',8,'2024-10-29 12:59:03',1),(63,'::1','gpm@gmail.com',8,'2024-10-29 12:59:22',1),(64,'::1','gpm@gmail.com',8,'2024-10-29 13:12:30',1),(65,'::1','gpm@gmail.com',8,'2024-10-29 13:14:23',1),(66,'::1','dosen@gmail.com',7,'2024-10-29 13:15:24',1),(67,'::1','gpm@gmail.com',8,'2024-10-29 13:21:02',1),(68,'::1','dosen',NULL,'2024-10-29 13:23:20',0),(69,'::1','dosen@gmail.com',7,'2024-10-29 13:23:31',1),(70,'::1','gpm@gmail.com',8,'2024-10-29 13:24:48',1),(71,'::1','gpm',NULL,'2024-10-29 13:25:39',0),(72,'::1','gpm@gmail.com',8,'2024-10-29 13:25:44',1),(73,'::1','gpm@gmail.com',8,'2024-10-29 13:26:46',1),(74,'::1','gpm@gmail.com',8,'2024-10-29 13:28:33',1),(75,'::1','gpm@gmail.com',8,'2024-10-29 13:33:10',1),(76,'::1','gpm@gmail.com',8,'2024-10-29 13:34:17',1),(77,'::1','gpm@gmail.com',8,'2024-10-29 13:35:05',1),(78,'::1','gpm@gmail.com',8,'2024-10-29 13:36:06',1),(79,'::1','gpm@gmail.com',8,'2024-10-29 13:37:06',1),(80,'::1','gpm@gmail.com',8,'2024-10-29 13:38:35',1),(81,'::1','gpm@gmail.com',8,'2024-10-29 13:40:59',1),(82,'::1','gpm@gmail.com',8,'2024-10-29 13:50:34',1),(83,'::1','gpm@gmail.com',8,'2024-10-29 13:58:08',1),(84,'::1','dosen',NULL,'2024-10-29 13:58:23',0),(85,'::1','dosen@gmail.com',7,'2024-10-29 13:58:32',1),(86,'::1','gpm@gmail.com',8,'2024-10-29 14:00:09',1),(87,'::1','dosen@gmail.com',7,'2024-10-29 14:00:23',1),(88,'::1','gpm@gmail.com',8,'2024-10-29 16:39:57',1),(89,'::1','gpm@gmail.com',8,'2024-10-29 16:50:41',1),(90,'::1','gpm@gmail.com',8,'2024-10-29 19:10:00',1),(91,'::1','admin@gmail.com',9,'2024-10-29 19:50:18',1),(92,'::1','admin@gmail.com',9,'2024-10-29 20:02:34',1),(93,'::1','gpm',NULL,'2024-10-29 20:02:54',0),(94,'::1','gpm@gmail.com',8,'2024-10-29 20:03:01',1),(95,'::1','admin@gmail.com',9,'2024-10-29 20:04:01',1),(96,'::1','admin@gmail.com',10,'2024-10-29 20:39:25',1),(97,'::1','admin@gmail.com',10,'2024-10-29 20:42:45',1),(98,'::1','gpm@gmail.com',8,'2024-10-29 20:43:07',1),(99,'::1','dosen@gmail.com',7,'2024-11-02 05:32:43',1),(100,'::1','gpm@gmail.com',8,'2024-11-02 05:32:56',1),(101,'::1','admin@gmail.com',10,'2024-11-02 05:33:05',1),(102,'::1','admin@gmail.com',10,'2024-11-02 05:34:03',1),(103,'::1','dosen',NULL,'2024-11-02 05:34:34',0),(104,'::1','dosen@gmail.com',7,'2024-11-02 05:34:46',1),(105,'::1','gpm',NULL,'2024-11-02 05:35:43',0),(106,'::1','gpm',NULL,'2024-11-02 05:35:54',0),(107,'::1','gpm@gmail.com',8,'2024-11-02 05:36:03',1),(108,'::1','gpm@gmail.com',8,'2024-11-02 05:38:48',1),(109,'::1','dosen@gmail.com',7,'2024-11-02 05:39:15',1),(110,'::1','dosen@gmail.com',7,'2024-11-04 05:05:56',1),(111,'::1','admin@gmail.com',10,'2024-11-04 05:06:35',1),(112,'::1','dosen@gmail.com',7,'2024-11-04 12:29:15',1),(113,'::1','gpm@gmail.com',8,'2024-11-04 12:29:26',1),(114,'::1','admin@gmail.com',10,'2024-11-04 12:29:40',1),(115,'::1','admin@gmail.com',10,'2024-11-04 12:30:03',1),(116,'::1','admin',NULL,'2024-11-04 17:19:46',0),(117,'::1','dosen@gmail.com',7,'2024-11-04 17:19:54',1),(118,'::1','admin@gmail.com',10,'2024-11-04 17:20:10',1),(119,'::1','gpm@gmail.com',8,'2024-11-04 17:23:40',1),(120,'::1','admin@gmail.com',10,'2024-11-04 17:24:40',1),(121,'::1','admin@gmail.com',10,'2024-11-04 17:35:09',1),(122,'::1','admin',NULL,'2024-11-04 17:39:30',0),(123,'::1','admin@gmail.com',10,'2024-11-04 17:39:41',1),(124,'::1','admin@gmail.com',10,'2024-11-04 17:42:48',1),(125,'::1','dosen@gmail.com',7,'2024-11-04 17:44:44',1),(126,'::1','admin@gmail.com',10,'2024-11-04 17:48:15',1),(127,'::1','dosen@gmail.com',7,'2024-11-04 17:51:46',1),(128,'::1','dosen@gmail.com',7,'2024-11-04 17:53:08',1),(129,'::1','dosen@gmail.com',7,'2024-11-04 17:55:37',1),(130,'::1','dosen@gmail.com',7,'2024-11-04 17:56:03',1),(131,'::1','admin',NULL,'2024-11-05 03:30:32',0),(132,'::1','admin@gmail.com',10,'2024-11-05 03:30:39',1),(133,'::1','dosen@gmail.com',7,'2024-11-05 03:30:58',1),(134,'::1','admin@gmail.com',10,'2024-11-05 03:32:05',1),(135,'::1','admin',NULL,'2024-11-05 03:32:37',0),(136,'::1','admin@gmail.com',10,'2024-11-05 03:32:45',1),(137,'::1','dosen@gmail.com',7,'2024-11-05 03:39:40',1),(138,'::1','gpm@gmail.com',8,'2024-11-05 03:40:03',1),(139,'::1','gpm@gmail.com',8,'2024-11-05 03:45:39',1),(140,'::1','gpm@gmail.com',8,'2024-11-05 06:23:29',1),(141,'::1','gpm@gmail.com',8,'2024-11-05 06:44:41',1),(142,'::1','admin@gmail.com',10,'2024-11-05 12:41:55',1),(143,'::1','admin@gmail.com',10,'2024-11-05 12:42:41',1),(144,'::1','admin@gmail.com',10,'2024-11-05 12:48:22',1),(145,'::1','admin@gmail.com',10,'2024-11-05 12:48:33',1),(146,'::1','admin@gmail.com',10,'2024-11-05 12:50:15',1),(147,'::1','admin@gmail.com',10,'2024-11-05 14:20:00',1),(148,'::1','admin@gmail.com',10,'2024-11-05 14:49:47',1),(149,'::1','admin@gmail.com',10,'2024-11-05 14:55:34',1),(150,'::1','admin@gmail.com',10,'2024-11-05 14:58:43',1),(151,'::1','admin@gmail.com',10,'2024-11-07 05:12:06',1),(152,'::1','admin',NULL,'2024-11-07 07:26:03',0),(153,'::1','admin@gmail.com',10,'2024-11-07 07:26:09',1),(154,'::1','admin@gmail.com',10,'2024-11-07 09:45:12',1),(155,'::1','admin@gmail.com',10,'2024-11-07 12:08:08',1),(156,'::1','admin@gmail.com',10,'2024-11-07 12:40:57',1),(157,'::1','admin@gmail.com',10,'2024-11-08 04:38:11',1),(158,'::1','admin@gmail.com',10,'2024-11-08 17:28:43',1),(159,'::1','admin@gmail.com',10,'2024-11-09 06:07:52',1),(160,'::1','admin@gmail.com',10,'2024-11-09 11:36:37',1),(161,'::1','admin2',NULL,'2024-11-09 12:43:06',0),(162,'::1','admin@gmail.com',10,'2024-11-09 12:43:18',1),(163,'::1','raja',NULL,'2024-11-09 12:44:32',0),(164,'::1','admin@gmail.com',10,'2024-11-10 07:10:57',1),(165,'::1','raja',NULL,'2024-11-10 07:24:25',0),(166,'::1','admin@gmail.com',10,'2024-11-10 07:24:33',1),(167,'::1','admin@gmail.com',10,'2024-11-10 07:31:38',1),(168,'::1','raja@gmail.com',16,'2024-11-10 07:34:12',1),(169,'::1','admin@gmail.com',10,'2024-11-10 07:38:34',1),(170,'::1','admin2@gmail.com',17,'2024-11-10 07:41:25',1),(171,'::1','azza@gmail.com',18,'2024-11-10 07:43:04',1),(172,'::1','admin@gmail.com',10,'2024-11-10 07:43:23',1),(173,'::1','admin@gmail.com',10,'2024-11-10 11:48:03',1),(174,'::1','admin@gmail.com',10,'2024-11-10 17:27:59',1),(175,'::1','admin@gmail.com',10,'2024-11-11 05:47:03',1),(176,'::1','admin@gmail.com',10,'2024-11-11 10:17:35',1),(177,'::1','raja',NULL,'2024-11-11 10:25:12',0),(178,'::1','raja',NULL,'2024-11-11 10:25:24',0),(179,'::1','admin@gmail.com',10,'2024-11-11 10:25:40',1),(180,'::1','raja',NULL,'2024-11-11 10:26:16',0),(181,'::1','raja',NULL,'2024-11-11 10:26:26',0),(182,'::1','admin@gmail.com',10,'2024-11-11 10:26:34',1),(183,'::1','rajaraja@gmail.com',20,'2024-11-11 10:27:36',1),(184,'::1','admin@gmail.com',10,'2024-11-11 10:27:50',1),(185,'::1','raja raja',NULL,'2024-11-11 10:28:07',0),(186,'::1','admin@gmail.com',10,'2024-11-11 10:33:47',1),(187,'::1','rajaraja',NULL,'2024-11-11 10:34:53',0),(188,'::1','rajaraja@gmail.com',21,'2024-11-11 10:35:01',1),(189,'::1','admin@gmail.com',10,'2024-11-11 10:35:14',1),(190,'::1','analisa@gmail.com',22,'2024-11-11 10:39:45',1),(191,'::1','admin@gmail.com',10,'2024-11-11 10:39:55',1),(192,'::1','raja',NULL,'2024-11-11 10:47:56',0),(193,'::1','raja@gmail.com',23,'2024-11-11 10:48:03',1),(194,'::1','admin@gmail.com',10,'2024-11-11 10:48:13',1),(195,'::1','admin@gmail.com',10,'2024-11-12 06:43:51',1),(196,'::1','dosen',NULL,'2024-11-12 06:45:59',0),(197,'::1','dosen@gmail.com',7,'2024-11-12 06:46:09',1),(198,'::1','admin',NULL,'2024-11-18 19:40:19',0),(199,'::1','admin',NULL,'2024-11-18 19:40:27',0),(200,'::1','admin@gmail.com',10,'2024-11-18 19:40:37',1),(201,'::1','admin@gmail.com',10,'2024-11-20 08:57:45',1),(202,'::1','admin@gmail.com',10,'2024-11-24 09:57:43',1),(203,'::1','admin@gmail.com',10,'2024-11-24 11:46:30',1),(204,'::1','dosen',NULL,'2024-11-26 03:37:59',0),(205,'::1','dosen@gmail.com',7,'2024-11-26 03:38:07',1),(206,'::1','admin@gmail.com',10,'2024-11-26 03:39:05',1),(207,'::1','dosen@gmail.com',7,'2024-11-26 03:40:47',1),(208,'::1','dosen@gmail.com',7,'2024-11-26 03:46:01',1),(209,'::1','dosen@gmail.com',7,'2024-11-26 03:50:29',1),(210,'::1','dosen@gmail.com',7,'2024-11-26 03:55:28',1),(211,'::1','dosen@gmail.com',7,'2024-11-26 03:59:12',1),(212,'::1','dosen@gmail.com',7,'2024-11-26 07:59:02',1),(213,'::1','dosen@gmail.com',7,'2024-11-26 08:44:59',1),(214,'::1','dosen@gmail.com',7,'2024-11-26 08:48:24',1),(215,'::1','dosen@gmail.com',7,'2024-11-26 11:28:05',1),(216,'::1','dosen@gmail.com',7,'2024-11-26 11:48:30',1),(217,'::1','dosen@gmail.com',7,'2024-11-26 13:32:38',1),(218,'::1','dosen@gmail.com',7,'2024-11-26 13:44:20',1),(219,'::1','admin@gmail.com',10,'2024-11-26 13:49:59',1),(220,'::1','dosen@gmail.com',7,'2024-11-26 13:50:54',1),(221,'::1','gpm@gmail.com',8,'2024-11-26 14:08:47',1),(222,'::1','dosen@gmail.com',7,'2024-11-26 14:09:12',1),(223,'::1','dosen@gmail.com',7,'2024-11-27 20:04:09',1),(224,'::1','admin@gmail.com',10,'2024-12-01 08:06:06',1),(225,'::1','dosen@gmail.com',7,'2024-12-01 08:06:15',1),(226,'::1','gpm@gmail.com',8,'2024-12-01 08:06:27',1),(227,'::1','dosen@gmail.com',7,'2024-12-01 08:07:41',1),(228,'::1','admin@gmail.com',10,'2024-12-01 11:16:27',1),(229,'::1','dosen@gmail.com',7,'2024-12-01 19:12:42',1),(230,'::1','dosen@gmail.com',7,'2024-12-01 19:14:14',1),(231,'::1','dosen@gmail.com',7,'2024-12-01 19:15:39',1),(232,'::1','dosen@gmail.com',7,'2024-12-02 08:54:12',1),(233,'::1','dosen@gmail.com',7,'2024-12-02 08:57:17',1),(234,'::1','dosen@gmail.com',7,'2024-12-02 09:00:29',1),(235,'::1','dosen@gmail.com',7,'2024-12-02 09:51:44',1),(236,'::1','admin@gmail.com',10,'2024-12-02 14:39:55',1),(237,'::1','dosen@gmail.com',7,'2024-12-02 17:21:50',1),(238,'::1','dosen@gmail.com',7,'2024-12-03 09:44:13',1),(239,'::1','admin',NULL,'2024-12-03 16:06:14',0),(240,'::1','dosen@gmail.com',7,'2024-12-03 16:06:19',1),(241,'::1','dosen@gmail.com',7,'2024-12-03 19:48:30',1),(242,'::1','dosen@gmail.com',7,'2024-12-03 19:56:33',1),(243,'::1','dosen@gmail.com',7,'2024-12-03 20:01:39',1),(244,'::1','raja@gmail.com',25,'2024-12-03 20:10:33',1),(245,'::1','dosen@gmail.com',7,'2024-12-03 20:15:10',1),(246,'::1','dosen@gmail.com',7,'2024-12-04 06:21:35',1),(247,'::1','raja',NULL,'2024-12-04 06:27:18',0),(248,'::1','raja',NULL,'2024-12-04 06:27:32',0),(249,'::1','raja@gmail.com',25,'2024-12-04 06:27:39',1),(250,'::1','dosen@gmail.com',7,'2024-12-04 06:35:42',1),(251,'::1','dosen@gmail.com',7,'2024-12-04 07:40:41',1),(252,'::1','dosen@gmail.com',7,'2024-12-04 18:11:34',1),(253,'::1','dosen',NULL,'2024-12-04 18:14:12',0),(254,'::1','dosen@gmail.com',7,'2024-12-04 18:14:19',1),(255,'::1','dosen@gmail.com',7,'2024-12-05 08:19:50',1),(256,'::1','dosen@gmail.com',7,'2024-12-05 11:35:55',1),(257,'::1','dosen@gmail.com',7,'2024-12-06 18:54:00',1),(258,'::1','gpm@gmail.com',8,'2024-12-08 18:03:29',1),(259,'::1','dosen@gmail.com',7,'2024-12-08 18:14:36',1),(260,'::1','dosen@gmail.com',7,'2024-12-09 17:16:18',1),(261,'::1','dosen@gmail.com',7,'2024-12-10 03:37:34',1),(262,'::1','gpm@gmail.com',8,'2024-12-10 03:42:13',1),(263,'::1','gpm',NULL,'2024-12-10 04:01:28',0),(264,'::1','dosen@gmail.com',7,'2024-12-10 04:01:37',1),(265,'::1','gpm@gmail.com',8,'2024-12-10 08:27:36',1),(266,'::1','gpm@gmail.com',8,'2024-12-10 19:36:00',1),(267,'::1','gpm@gmail.com',8,'2024-12-11 07:38:45',1),(268,'::1','admin',NULL,'2024-12-11 07:41:32',0),(269,'::1','admin@gmail.com',10,'2024-12-11 07:41:39',1),(270,'::1','dosen@gmail.com',7,'2024-12-11 07:45:05',1),(271,'::1','gpm@gmail.com',8,'2024-12-11 07:54:46',1),(272,'127.0.0.1','admin@gmail.com',10,'2024-12-11 16:40:21',1),(273,'127.0.0.1','dosen@gmail.com',7,'2024-12-11 16:41:08',1),(274,'::1','gpm@gmail.com',8,'2024-12-11 17:34:27',1),(275,'::1','dosen@gmail.com',7,'2024-12-11 17:41:14',1),(276,'::1','gpm@gmail.com',8,'2024-12-11 17:44:43',1),(277,'::1','dosen@gmail.com',7,'2024-12-11 20:35:08',1),(278,'::1','gpm@gmail.com',8,'2024-12-11 20:37:54',1),(279,'::1','dosen@gmail.com',7,'2024-12-11 20:42:51',1),(280,'::1','gpm@gmail.com',8,'2024-12-11 20:43:03',1),(281,'::1','gpm@gmail.com',8,'2024-12-11 20:53:14',1),(282,'::1','gpm@gmail.com',8,'2024-12-11 21:09:42',1),(283,'::1','dosen@gmail.com',7,'2024-12-11 21:23:00',1),(284,'::1','raja@gmail.com',25,'2024-12-11 21:23:37',1),(285,'::1','dosen@gmail.com',7,'2024-12-11 21:23:50',1),(286,'::1','gpm@gmail.com',8,'2024-12-11 21:34:57',1),(287,'::1','dosen@gmail.com',7,'2024-12-11 21:35:31',1),(288,'::1','dosen@gmail.com',7,'2024-12-12 07:48:37',1),(289,'::1','gpm@gmail.com',8,'2024-12-12 07:48:58',1),(290,'::1','dosen@gmail.com',7,'2024-12-12 07:49:26',1),(291,'::1','dosen',NULL,'2024-12-12 07:57:44',0),(292,'::1','dosen@gmail.com',7,'2024-12-12 07:57:50',1),(293,'::1','gpm@gmail.com',8,'2024-12-12 08:11:48',1),(294,'::1','dosen@gmail.com',7,'2024-12-12 08:30:53',1),(295,'::1','admin',NULL,'2024-12-12 08:36:49',0),(296,'::1','dosen@gmail.com',7,'2024-12-12 08:36:56',1),(297,'::1','admin@gmail.com',10,'2024-12-12 09:19:06',1),(298,'::1','kajur@gmail.com',26,'2024-12-12 09:21:37',1),(299,'::1','kajur@gmail.com',26,'2024-12-12 10:12:25',1),(300,'::1','kajur@gmail.com',26,'2024-12-12 10:13:29',1),(301,'::1','dosen@gmail.com',7,'2024-12-12 10:16:38',1),(302,'::1','kajur@gmail.com',26,'2024-12-12 12:06:10',1),(303,'::1','gpm@gmail.com',8,'2024-12-12 12:06:33',1),(304,'::1','dosen@gmail.com',7,'2024-12-12 12:27:09',1),(305,'::1','kajur@gmail.com',26,'2024-12-12 12:29:00',1),(306,'::1','admin@gmail.com',10,'2024-12-12 12:30:11',1),(307,'::1','dosen@gmail.com',7,'2024-12-12 12:37:51',1),(308,'::1','raja@gmail.com',25,'2024-12-12 12:40:57',1),(309,'::1','admin',NULL,'2024-12-12 13:03:42',0),(310,'::1','admin@gmail.com',10,'2024-12-12 13:03:50',1),(311,'::1','dosen@gmail.com',7,'2024-12-12 15:44:35',1),(312,'::1','gpm@gmail.com',8,'2024-12-12 15:45:11',1),(313,'::1','dosen@gmail.com',7,'2024-12-12 15:46:32',1),(314,'::1','gpm@gmail.com',8,'2024-12-12 19:24:05',1),(315,'::1','dosen@gmail.com',7,'2024-12-12 19:35:16',1),(316,'::1','gpm@gmail.com',8,'2024-12-12 20:58:27',1),(317,'::1','gpm@gmail.com',8,'2024-12-13 14:49:02',1),(318,'::1','dosen@gmail.com',7,'2024-12-13 15:00:25',1),(319,'::1','kajur@gmail.com',26,'2024-12-13 15:08:42',1),(320,'::1','admin@gmail.com',10,'2024-12-13 15:09:40',1),(321,'::1','admin@gmail.com',10,'2024-12-13 15:11:56',1),(322,'::1','dosen@gmail.com',7,'2024-12-13 15:20:32',1),(323,'::1','gpm@gmail.com',8,'2024-12-13 17:10:32',1),(324,'::1','kajur@gmail.com',26,'2024-12-13 17:12:51',1),(325,'::1','kajur@gmail.com',26,'2024-12-13 19:26:02',1),(326,'::1','dosen',NULL,'2024-12-14 09:22:18',0),(327,'::1','dosen',NULL,'2024-12-14 09:22:26',0),(328,'::1','dosen@gmail.com',7,'2024-12-14 09:22:34',1),(329,'::1','gpm@gmail.com',8,'2024-12-14 10:41:05',1),(330,'::1','kajur@gmail.com',26,'2024-12-14 11:57:19',1),(331,'::1','dosen@gmail.com',7,'2024-12-14 13:56:19',1),(332,'::1','dosen@gmail.com',7,'2024-12-14 14:01:04',1),(333,'::1','admin',NULL,'2024-12-14 14:37:28',0),(334,'::1','admin@gmail.com',10,'2024-12-14 14:37:34',1),(335,'::1','dosen@gmail.com',7,'2024-12-14 14:44:54',1),(336,'::1','dosen@gmail.com',7,'2024-12-15 02:41:09',1),(337,'::1','admin@gmail.com',10,'2024-12-15 02:43:28',1),(338,'::1','admin@gmail.com',10,'2024-12-15 02:43:35',1),(339,'::1','gpm@gmail.com',8,'2024-12-15 02:55:41',1),(340,'::1','gpm@gmail.com',8,'2024-12-15 02:57:49',1),(341,'::1','dosen@gmail.com',7,'2024-12-15 03:02:50',1),(342,'::1','admin@gmail.com',10,'2024-12-15 03:27:58',1),(343,'::1','dosen@gmail.com',7,'2024-12-15 03:30:06',1),(344,'::1','gpm@gmail.com',8,'2024-12-15 03:31:33',1),(345,'::1','admin@gmail.com',10,'2024-12-15 03:42:03',1),(346,'::1','admin@gmail.com',10,'2024-12-15 03:43:00',1),(347,'::1','gpm@gmail.com',8,'2024-12-15 03:45:28',1),(348,'::1','admin@gmail.com',10,'2024-12-15 03:46:40',1),(349,'::1','dosen@gmail.com',7,'2024-12-15 03:46:54',1),(350,'::1','gpm@gmail.com',8,'2024-12-15 03:48:45',1),(351,'::1','admin@gmail.com',10,'2024-12-15 04:13:51',1),(352,'::1','kajur@gmail.com',26,'2024-12-15 10:29:43',1),(353,'::1','dosen@gmail.com',7,'2024-12-15 10:35:50',1),(354,'::1','dosen@gmail.com',7,'2024-12-15 10:35:58',1),(355,'::1','admin@gmail.com',10,'2024-12-15 10:39:08',1),(356,'::1','dosen@gmail.com',7,'2024-12-15 10:40:52',1),(357,'::1','dosen@gmail.com',7,'2024-12-15 10:42:49',1),(358,'::1','admin@gmail.com',10,'2024-12-15 10:45:58',1),(359,'::1','dosen@gmail.com',7,'2024-12-15 10:46:31',1),(360,'::1','gpm@gmail.com',8,'2024-12-15 10:49:00',1),(361,'::1','kajur@gmail.com',26,'2024-12-15 10:55:33',1),(362,'::1','dosen@gmail.com',7,'2024-12-15 10:55:42',1),(363,'::1','gpm@gmail.com',8,'2024-12-15 10:56:50',1),(364,'::1','gpm@gmail.com',8,'2024-12-15 10:57:00',1),(365,'::1','kajur@gmail.com',26,'2024-12-15 10:57:50',1),(366,'::1','dosen@gmail.com',7,'2024-12-15 10:58:03',1),(367,'::1','gpm@gmail.com',8,'2024-12-15 10:59:20',1),(368,'::1','kajur@gmail.com',26,'2024-12-15 11:00:23',1),(369,'::1','admin@gmail.com',10,'2024-12-15 11:01:03',1),(370,'::1','kajur@gmail.com',26,'2024-12-15 11:03:40',1),(371,'::1','gpm@gmail.com',8,'2024-12-15 11:04:54',1),(372,'::1','dosen@gmail.com',7,'2024-12-15 11:05:29',1),(373,'::1','kajur@gmail.com',26,'2024-12-15 11:06:06',1),(374,'::1','dosen@gmail.com',7,'2024-12-15 11:06:35',1),(375,'::1','gpm@gmail.com',8,'2024-12-15 11:07:13',1),(376,'::1','dosen@gmail.com',7,'2024-12-15 11:07:33',1),(377,'::1','dosen@gmail.com',7,'2024-12-15 11:11:34',1),(378,'::1','kajur@gmail.com',26,'2024-12-15 11:14:36',1),(379,'::1','gpm@gmail.com',8,'2024-12-15 11:15:47',1),(380,'::1','kajur@gmail.com',26,'2024-12-15 11:15:56',1),(381,'::1','admin@gmail.com',10,'2024-12-15 11:16:01',1),(382,'::1','dosen@gmail.com',7,'2024-12-15 11:30:21',1),(383,'::1','gpm@gmail.com',8,'2024-12-15 11:30:52',1),(384,'::1','kajur@gmail.com',26,'2024-12-15 12:15:55',1),(385,'::1','dosen@gmail.com',7,'2024-12-15 12:25:29',1),(386,'::1','dosen@gmail.com',7,'2024-12-15 12:27:38',1),(387,'::1','kajur@gmail.com',26,'2024-12-15 12:28:27',1),(388,'::1','dosen@gmail.com',7,'2024-12-15 12:39:52',1),(389,'::1','dosen@gmail.com',7,'2024-12-15 12:55:37',1),(390,'::1','kajur@gmail.com',26,'2024-12-15 13:18:32',1),(391,'::1','dosen@gmail.com',7,'2024-12-15 13:22:04',1),(392,'::1','admin@gmail.com',10,'2024-12-15 13:37:25',1),(393,'::1','admin@gmail.com',10,'2024-12-15 13:44:23',1),(394,'::1','dosen@gmail.com',7,'2024-12-15 13:47:32',1),(395,'::1','admin@gmail.com',10,'2024-12-15 13:59:33',1),(396,'::1','admin@gmail.com',10,'2024-12-15 14:11:22',1),(397,'::1','dosen@gmail.com',7,'2024-12-15 14:11:37',1),(398,'::1','dosen@gmail.com',7,'2024-12-17 00:21:36',1),(399,'::1','dosen@gmail.com',7,'2024-12-17 00:26:56',1),(400,'::1','admin@gmail.com',10,'2024-12-17 00:27:04',1),(401,'::1','gpm@gmail.com',8,'2024-12-17 00:27:23',1),(402,'::1','dosen@gmail.com',7,'2024-12-17 00:28:21',1),(403,'::1','dosen@gmail.com',7,'2024-12-17 00:32:20',1),(404,'::1','dosen@gmail.com',7,'2024-12-17 00:50:49',1),(405,'::1','kajur@gmail.com',26,'2024-12-17 00:53:27',1),(406,'::1','dosen@gmail.com',7,'2024-12-17 00:54:10',1),(407,'::1','admin@gmail.com',10,'2024-12-17 00:54:19',1),(408,'::1','gpm@gmail.com',8,'2024-12-17 00:54:26',1),(409,'::1','dosen@gmail.com',7,'2024-12-17 00:59:48',1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_permissions`
--

DROP TABLE IF EXISTS `auth_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_permissions`
--

LOCK TABLES `auth_permissions` WRITE;
/*!40000 ALTER TABLE `auth_permissions` DISABLE KEYS */;
INSERT INTO `auth_permissions` VALUES (3,'dosen-access','khusus dosen'),(4,'gpm-access','khusus gpm');
/*!40000 ALTER TABLE `auth_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_reset_attempts`
--

DROP TABLE IF EXISTS `auth_reset_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_reset_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_reset_attempts`
--

LOCK TABLES `auth_reset_attempts` WRITE;
/*!40000 ALTER TABLE `auth_reset_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_reset_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_users_permissions`
--

DROP TABLE IF EXISTS `auth_users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) unsigned NOT NULL DEFAULT 0,
  `permission_id` int(11) unsigned NOT NULL DEFAULT 0,
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_users_permissions`
--

LOCK TABLES `auth_users_permissions` WRITE;
/*!40000 ALTER TABLE `auth_users_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bap`
--

DROP TABLE IF EXISTS `bap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `bap_user_id_foreign` (`user_id`),
  KEY `bap_kode_mk_foreign` (`kode_mk`),
  CONSTRAINT `bap_kode_mk_foreign` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliah` (`kode_mk`),
  CONSTRAINT `bap_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bap`
--

LOCK TABLES `bap` WRITE;
/*!40000 ALTER TABLE `bap` DISABLE KEYS */;
INSERT INTO `bap` VALUES (3,7,'2024-12-13','UNV12002','senggarang','2024-12-04 02:27:41','2024-12-05 05:47:45'),(6,7,'1945-12-12','INF11001','Hindia Belanda','2024-12-14 20:14:21','2024-12-14 20:14:21');
/*!40000 ALTER TABLE `bap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bap_catatan`
--

DROP TABLE IF EXISTS `bap_catatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bap_catatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bap_id` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bap_catatan_bap_id_foreign` (`bap_id`),
  CONSTRAINT `bap_catatan_bap_id_foreign` FOREIGN KEY (`bap_id`) REFERENCES `bap` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bap_catatan`
--

LOCK TABLES `bap_catatan` WRITE;
/*!40000 ALTER TABLE `bap_catatan` DISABLE KEYS */;
INSERT INTO `bap_catatan` VALUES (14,3,'bagus',0),(15,3,'saya menambah ini',0),(16,6,'Banzaiii',1);
/*!40000 ALTER TABLE `bap_catatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daftar_rps`
--

DROP TABLE IF EXISTS `daftar_rps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daftar_rps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `kode_mk` varchar(15) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `link_rps` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_mk` (`kode_mk`),
  KEY `fk_kode_mata_kuliah_` (`kode_mk`),
  KEY `fk_jurusan_id_` (`jurusan_id`),
  KEY `fk_user_id_rps` (`user_id`),
  CONSTRAINT `fk_daftar_rps_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kode_mata_kuliah_` FOREIGN KEY (`kode_mk`) REFERENCES `mata_kuliah` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id_rps` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_rps`
--

LOCK TABLES `daftar_rps` WRITE;
/*!40000 ALTER TABLE `daftar_rps` DISABLE KEYS */;
INSERT INTO `daftar_rps` VALUES (12,7,'FST12001',1,'2024/2025','Ganjil','12','https://docs.google.com/document/d/1-neYBih6WBxiXhdG-Ooo_eCS9TqRSBFB/edit?usp=drive_link&ouid=115892866959518709254&rtpof=true&sd=true','2024-12-03 09:08:51','2024-12-03 09:08:51'),(14,7,'INF12001',1,'2024/2025','Ganjil','12','https://docs.google.com/document/d/1-neYBih6WBxiXhdG-Ooo_eCS9TqRSBFB/edit?usp=drive_link&ouid=115892866959518709254&rtpof=true&sd=true','2024-12-03 09:48:29','2024-12-03 09:48:29'),(16,7,'INF12004',1,'2024/2025','Ganjil','12','https://docs.google.com/document/d/1-neYBih6WBxiXhdG-Ooo_eCS9TqRSBFB/edit?usp=drive_link&ouid=115892866959518709254&rtpof=true&sd=true','2024-12-03 09:50:35','2024-12-03 09:50:35'),(20,7,'INF11007',1,'2024/2025','Genap','7','https://docs.google.com/document/d/1-neYBih6WBxiXhdG-Ooo_eCS9TqRSBFB/edit?usp=drive_link&ouid=115892866959518709254&rtpof=true&sd=true','2024-12-13 10:11:44','2024-12-14 20:11:18');
/*!40000 ALTER TABLE `daftar_rps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fakultas`
--

DROP TABLE IF EXISTS `fakultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fakultas`
--

LOCK TABLES `fakultas` WRITE;
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;
INSERT INTO `fakultas` VALUES (1,'FTTK','FAKULTAS TEKNIK DAN TEKNOLOGI KEMARITIMAN'),(2,'FEBM','FAKULTAS EKONOMI DAN BISNIS MARITIM'),(3,'FIKP','FAKULTAS ILMU KELAUTAN DAN PERIKANAN'),(4,'FKIP','FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN'),(5,'FISIP','FAKULTAS ILMU SOSIAL DAN ILMU POLITIK'),(6,'FK','FAKULTAS KEDOKTERAN');
/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurusan`
--

DROP TABLE IF EXISTS `jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(50) NOT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fakultas_id` (`fakultas_id`),
  CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurusan`
--

LOCK TABLES `jurusan` WRITE;
/*!40000 ALTER TABLE `jurusan` DISABLE KEYS */;
INSERT INTO `jurusan` VALUES (1,'TEKNIK INFORMATIKA',1),(2,'TEKNIK ELEKTRO',1),(3,'TEKNIK PERKAPALAN',1),(4,'KIMIA',1),(5,'TEKNIK INDUSTRI',1),(6,'AKUNTANSI',2),(7,'MANAJEMEN',2),(8,'BISNIS DIGITAL',2),(9,'KEWIRAUSAHAAN',2),(10,'ILMU KELAUTAN',3),(11,'MANAJEMEN SUMBERDAYA PERAIRAN',3),(12,'TEKNOLOGI HASIL PERIKANAN',3),(13,'SOSIAL EKONOMI PERIKANAN',3),(14,'PENDIDIKAN BAHASA DAN SASTRA INDONESIA',4),(15,'PENDIDIKAN BAHASA INGGRIS',4),(16,'PENDIDIKAN MATEMATIKA',4),(17,'PENDIDIKAN BIOLOGI',4),(18,'PENDIDIKAN KIMIA',4),(19,'PENDIDIKAN PROFESI GURU (PROFESI)',4),(20,'ILMU PEMERINTAHAN',5),(21,'ADMINISTRASI PUBLIK',5),(22,'SOSIOLOGI',5),(23,'ILMU HUKUM',5),(24,'HUBUNGAN INTERNASIONAL',5),(25,'KAJIAN FILM, TELEVISI, DAN MEDIA',5),(26,'KEDOKTERAN',6),(27,'PENDIDIKAN PROFESI DOKTER',6);
/*!40000 ALTER TABLE `jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mata_kuliah`
--

DROP TABLE IF EXISTS `mata_kuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mata_kuliah` (
  `kode_mk` varchar(15) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  PRIMARY KEY (`kode_mk`),
  KEY `fk_mata_kuliah_jurusan` (`id_jurusan`),
  CONSTRAINT `fk_mata_kuliah_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mata_kuliah`
--

LOCK TABLES `mata_kuliah` WRITE;
/*!40000 ALTER TABLE `mata_kuliah` DISABLE KEYS */;
INSERT INTO `mata_kuliah` VALUES ('FST12001','PENGANTAR TEKNOLOGI INFORMASI',1),('INF11001','DASAR PEMROGRAMAN',1),('INF11002','ORGANISASI DAN ARSITEKTUR KOMPUTER',1),('INF11004','SISTEM BASIS DATA',1),('INF11005','PEMROGRAMAN BERORIENTASI OBJEK',1),('INF11006','SISTEM OPERASI',1),('INF11007','STRUKTUR DATA',1),('INF11008','ANALISIS DAN PERANCANGAN PERANGKAT LUNAK',1),('INF11009','KECERDASAN BUATAN',1),('INF11031','SISTEM TERDISTRIBUSI',1),('INF12001','KALKULUS',1),('INF12002','ALJABAR LINEAR',1),('INF12003','TEORI BAHASA FORMAL DAN OTOMATA',1),('INF12004','MATEMATIKA DISKRIT',1),('INF12007','METODOLOGI PENELITIAN',1),('UNV12001','AGAMA',1),('UNV12002','PANCASILA',1),('UNV12003','KEWARGANEGARAAN',1),('UNV12004','BAHASA INDONESIA',1),('UNV12005','BAHASA INGGRIS',1),('UNV12006','PENGANTAR ILMU TEKNOLOGI KEMARITIMAN',1),('UNV12007','TAMADUN DAN TUNJUK AJAR MELAYU',1);
/*!40000 ALTER TABLE `mata_kuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017-11-20-223112','Myth\\Auth\\Database\\Migrations\\CreateAuthTables','default','Myth\\Auth',1730080845,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_rps`
--

DROP TABLE IF EXISTS `review_rps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review_rps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daftar_rps_id` int(11) NOT NULL,
  `unsur_id` int(11) NOT NULL,
  `status` enum('Belum diperiksa','Sesuai','Revisi') NOT NULL DEFAULT 'Belum diperiksa',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `review_gpm` enum('Belum diperiksa','Sesuai','Revisi') NOT NULL DEFAULT 'Belum diperiksa',
  `review_kajur` enum('Belum diperiksa','Sesuai','Revisi') NOT NULL DEFAULT 'Belum diperiksa',
  `catatan_gpm` text DEFAULT NULL,
  `catatan_kajur` text DEFAULT NULL,
  `reviewer_role` enum('gpm','kajur') NOT NULL,
  `reviewer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_daftar_rps` (`daftar_rps_id`),
  KEY `fk_unsur` (`unsur_id`),
  CONSTRAINT `fk_daftar_rps` FOREIGN KEY (`daftar_rps_id`) REFERENCES `daftar_rps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_unsur` FOREIGN KEY (`unsur_id`) REFERENCES `unsur_rps` (`id_unsur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_rps`
--

LOCK TABLES `review_rps` WRITE;
/*!40000 ALTER TABLE `review_rps` DISABLE KEYS */;
INSERT INTO `review_rps` VALUES (19,14,1,'Revisi',NULL,'2024-12-12 05:28:19','2024-12-12 05:29:17','Sesuai','Revisi','','ini dari kajur','kajur',26),(20,14,3,'Revisi',NULL,'2024-12-12 05:28:19','2024-12-12 05:29:17','Sesuai','Revisi','','ini dari kajur','kajur',26),(21,14,7,'Revisi',NULL,'2024-12-12 05:28:19','2024-12-12 05:29:17','Revisi','Sesuai','ini dari gpm','','kajur',26),(22,20,1,'Sesuai',NULL,'2024-12-13 10:12:10','2024-12-13 10:13:18','Sesuai','Sesuai','','','kajur',26),(23,20,3,'Sesuai',NULL,'2024-12-13 10:12:10','2024-12-13 10:13:18','Sesuai','Sesuai','','','kajur',26),(24,20,7,'Sesuai',NULL,'2024-12-13 10:12:10','2024-12-13 10:13:18','Sesuai','Sesuai','','','kajur',26),(25,20,8,'Revisi',NULL,'2024-12-13 10:12:10','2024-12-13 10:13:18','Revisi','Revisi','ini kurang bagus','ini kurang dari kajur','kajur',26),(26,20,9,'Revisi',NULL,'2024-12-13 10:12:10','2024-12-13 10:13:18','Revisi','Revisi','ini belum sesuai','ini darikajur','kajur',26),(27,12,1,'Sesuai',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Sesuai','Sesuai','','','kajur',26),(28,12,3,'Revisi',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Revisi','Revisi','','','kajur',26),(29,12,7,'Revisi',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Sesuai','Sesuai','','','kajur',26),(30,12,8,'Revisi',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Sesuai','Revisi','','','kajur',26),(31,12,9,'Revisi',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Revisi','Sesuai','','','kajur',26),(32,12,11,'Revisi',NULL,'2024-12-14 20:34:28','2024-12-15 04:06:22','Sesuai','Revisi','','','kajur',26),(33,12,12,'Revisi',NULL,'2024-12-15 04:05:06','2024-12-15 04:06:22','Revisi','Sesuai','','','kajur',26);
/*!40000 ALTER TABLE `review_rps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unsur_rps`
--

DROP TABLE IF EXISTS `unsur_rps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unsur_rps` (
  `id_unsur` int(11) NOT NULL AUTO_INCREMENT,
  `unsur` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_unsur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unsur_rps`
--

LOCK TABLES `unsur_rps` WRITE;
/*!40000 ALTER TABLE `unsur_rps` DISABLE KEYS */;
INSERT INTO `unsur_rps` VALUES (1,'ini unsur pertama',''),(3,'ini unsur kedua',''),(7,'ini unsur ke tiga',''),(8,'ini unsur ke empat',''),(9,'ini unsur kelima',''),(11,'unsur baru lagi',''),(12,'ula lidi ula sawe','');
/*!40000 ALTER TABLE `unsur_rps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `fakultas_id` (`fakultas_id`),
  KEY `jurusan_id` (`jurusan_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'dosen@gmail.com','dosen','$2y$10$/NOqVvEh/yRqOfYR5Af2Pe/WSdv4ypPc1hhEEe8KaifwkcM/P170e',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-10-28 19:31:17','2024-10-28 19:31:17',NULL,NULL,NULL),(8,'gpm@gmail.com','gpm','$2y$10$.h/6F2LxnYz8Ibpgf25RkOmLN9fng4OSNJfxI0jWQluDuXJ3Sa.BG',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-10-28 19:31:50','2024-10-28 19:31:50',NULL,NULL,NULL),(10,'admin@gmail.com','admin','$2y$10$mbGs3wf/ZUQmFKyg1fF38ufU1CF9Katn1RblaOKtmCTcnYZxoNRRK',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-10-29 20:37:48','2024-10-29 20:37:48',NULL,NULL,NULL),(17,'admin2@gmail.com','admin2','$2y$10$9AtXVVylg5i2wpTPzB8Tle975g3T24V6ZNhiH1ggAjd7wckNUz/aO',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-11-10 07:40:35','2024-11-10 07:40:35',NULL,NULL,NULL),(25,'king@gmail.com','king','$2y$10$Er9V8u09kTyjjJApmEhEt./H/qnxwkmJxU.S8jZ9gV.n1dNt1sx4.',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-11-18 19:42:56','2024-12-15 03:42:37',NULL,NULL,NULL),(26,'kajur@gmail.com','kajur','$2y$10$.s2XHROXlaX54bLmKM6Ja.RB/s42iuqqXy9gLUVs/vMza0o82p1UG',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2024-12-12 09:21:24','2024-12-12 09:21:24',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_details`
--

DROP TABLE IF EXISTS `users_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nidn` varchar(20) DEFAULT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fakultas_id` (`fakultas_id`),
  KEY `fk_jurusan_id` (`jurusan_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_fakultas_id` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_jurusan_id` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_details`
--

LOCK TABLES `users_details` WRITE;
/*!40000 ALTER TABLE `users_details` DISABLE KEYS */;
INSERT INTO `users_details` VALUES (6,17,'ini admin 2','2010201002',1,1),(14,25,'raja aryansahputra','2201020070',1,18),(15,26,'Kepala Jurusan','2201020070',1,1);
/*!40000 ALTER TABLE `users_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-17  8:10:35
