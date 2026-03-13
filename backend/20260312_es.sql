/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: transformacion_digital
-- ------------------------------------------------------
-- Server version	12.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `trd_acceso_permiso_rol`
--

DROP TABLE IF EXISTS `trd_acceso_permiso_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_permiso_rol` (
  `pfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pfr_perfil_id` int(11) DEFAULT NULL,
  `pfr_rol_id` varchar(20) DEFAULT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pfr_id`),
  KEY `trd_acceso_perfiles_roles_trd_acceso_roles_FK` (`pfr_rol_id`),
  KEY `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` (`pfr_perfil_id`),
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` FOREIGN KEY (`pfr_perfil_id`) REFERENCES `trd_acceso_roles` (`prf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_roles_FK` FOREIGN KEY (`pfr_rol_id`) REFERENCES `trd_acceso_permisos` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permiso_rol`
--

LOCK TABLES `trd_acceso_permiso_rol` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permiso_rol` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permiso_rol` VALUES
(1,1,'1',1,'2026-02-02 08:34:53','2026-02-24 09:59:56'),
(2,1,'1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(3,1,'1.1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(4,1,'1.1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(5,1,'1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(6,1,'1.2.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(7,1,'1.2.1.1',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(8,1,'1.2.1.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(9,1,'1.2.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(10,1,'1.2.2.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(11,1,'1.2.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(12,1,'1.2.3.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(13,1,'1.2.3.2',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(14,1,'1.2.3.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(15,1,'1.2.3.4',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(16,1,'1.2.3.5',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(17,1,'A.0',1,'2026-02-02 08:40:58','2026-03-09 14:53:42'),
(18,4,'4',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(19,4,'4.1',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(20,4,'4.2',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(21,4,'4.3',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(22,4,'4.4',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(23,4,'4.5',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(24,4,'4.6',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(25,8,'8',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(26,8,'8.1',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(27,8,'8.2',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(28,8,'8.3',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(29,8,'8.4',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(30,8,'8.5',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(31,8,'8.6',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(32,8,'8.7',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(33,9,'4.3',1,'2026-02-02 15:42:38','2026-02-24 10:00:21'),
(34,9,'4.6',1,'2026-02-02 15:42:38','2026-02-24 10:00:29'),
(35,9,'4',1,'2026-02-02 15:52:03','2026-02-24 10:00:06'),
(36,2,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(37,7,'A.0',1,'2026-02-06 13:45:20','2026-03-09 14:53:19'),
(38,8,'A.0',1,'2026-02-06 13:45:20','2026-03-09 14:53:42'),
(39,9,'A.0',1,'2026-02-06 13:45:20','2026-02-24 09:59:51'),
(40,3,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(41,4,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(42,5,'A.0',1,'2026-02-06 13:45:29','2026-03-09 14:53:42'),
(43,6,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(44,10,'10',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(45,10,'10.1',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(46,10,'10.2',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(47,10,'10.3',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(48,10,'10.4',1,'2026-02-10 16:35:46','2026-02-26 13:34:46'),
(49,10,'10.5',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(50,10,'10.6',0,'2026-02-10 16:35:47','2026-02-10 16:35:47'),
(51,10,'10',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(52,10,'10.7',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(53,10,'A.0',0,'2026-02-11 11:40:33','2026-02-11 11:40:33'),
(54,11,'8',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(55,11,'8.1',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(56,11,'8.2',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(57,11,'8.7',0,'2026-02-12 15:51:35','2026-02-12 15:51:35'),
(58,9,'4',1,'2026-02-12 15:53:08','2026-02-24 10:00:06'),
(59,9,'4.1',1,'2026-02-12 15:53:08','2026-02-24 10:00:11'),
(60,9,'4.2',1,'2026-02-12 15:53:08','2026-02-24 10:00:17'),
(61,9,'4.3',1,'2026-02-12 15:53:09','2026-02-24 10:00:21'),
(62,12,'10',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(63,12,'10.1',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(64,12,'10.2',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(65,12,'10.3',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(66,12,'10.5',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(67,12,'10.7',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(68,14,'4',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(69,14,'4.2',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(70,14,'4.3',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(71,13,'8',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(72,13,'8.1',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(73,13,'8.7',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(74,15,'10',0,'2026-02-12 15:59:59','2026-02-12 15:59:59'),
(75,15,'10.1',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(76,15,'10.3',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(77,15,'10.5',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(78,13,'8',0,'2026-02-13 10:56:26','2026-02-13 10:56:26'),
(79,13,'8.2',0,'2026-02-13 10:56:26','2026-02-13 10:56:26'),
(80,14,'4',0,'2026-02-13 12:53:30','2026-02-13 12:53:30'),
(81,14,'4.1',0,'2026-02-13 12:53:31','2026-02-13 12:53:31'),
(82,12,'1',0,'2026-02-16 15:04:06','2026-02-16 15:04:06'),
(83,12,'1.2.4',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(84,12,'1.2.4.1',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(85,12,'1.2.4.2',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(86,12,'1.2.4.3',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(87,12,'1.2.4.4',0,'2026-02-16 15:04:08','2026-02-16 15:04:08'),
(88,1,'1',1,'2026-02-16 15:04:24','2026-02-24 09:59:56'),
(89,1,'1.1',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(90,1,'1.1.1',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(91,1,'1.1.2',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(92,1,'1.2',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(93,1,'1.2.1',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(94,1,'1.2.1.1',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(95,1,'1.2.1.2',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(96,1,'1.2.2',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(97,1,'1.2.2.1',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(98,1,'1.2.3',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(99,1,'1.2.3.1',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(100,1,'1.2.3.2',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(101,1,'1.2.3.3',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(102,1,'1.2.3.4',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(103,1,'1.2.3.5',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(104,1,'1.2.4',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(105,1,'1.2.4.1',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(106,1,'1.2.4.2',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(107,1,'1.2.4.3',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(108,1,'1.2.4.4',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(109,1,'1.2.2.5',0,'2026-02-16 15:14:51','2026-02-16 15:14:51'),
(110,9,'4',1,'2026-02-24 09:51:07','2026-02-24 10:00:06'),
(111,9,'4.2',1,'2026-02-24 09:51:07','2026-02-24 10:00:17'),
(112,9,'4.3',1,'2026-02-24 09:51:08','2026-02-24 10:00:21'),
(113,9,'4.6',1,'2026-02-24 09:51:08','2026-02-24 10:00:29'),
(114,9,'4.7',1,'2026-02-24 09:51:08','2026-02-24 10:00:35'),
(115,9,'4',0,'2026-02-24 10:01:13','2026-02-24 10:01:13'),
(116,9,'4.1',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(117,9,'4.2',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(118,9,'4.3',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(119,9,'4.6',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(120,9,'4.7',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(121,12,'10',0,'2026-02-26 14:52:47','2026-02-26 14:52:47'),
(122,12,'10.4',0,'2026-02-26 14:52:47','2026-02-26 14:52:47'),
(123,12,'10',0,'2026-02-26 15:07:40','2026-02-26 15:07:40'),
(124,12,'10.8',0,'2026-02-26 15:07:40','2026-02-26 15:07:40'),
(125,1,'10',0,'2026-02-26 15:07:56','2026-02-26 15:07:56'),
(126,1,'10.1',0,'2026-02-26 15:07:56','2026-02-26 15:07:56'),
(127,1,'10.2',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(128,1,'10.4',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(129,1,'10.5',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(130,1,'10.6',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(131,1,'10.7',0,'2026-02-26 15:07:58','2026-02-26 15:07:58'),
(132,1,'10.8',0,'2026-02-26 15:07:58','2026-02-26 15:07:58'),
(133,8,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(134,11,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(135,13,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(136,16,'9',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(137,16,'9.1',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(138,16,'9.2',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(139,16,'9.3',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(140,16,'9.4',0,'2026-03-02 15:45:33','2026-03-02 15:45:33'),
(141,18,'12',0,'2026-03-02 16:12:07','2026-03-02 16:12:07'),
(142,18,'12.2',0,'2026-03-02 16:12:07','2026-03-02 16:12:07'),
(143,18,'12.2.1',0,'2026-03-02 16:12:08','2026-03-02 16:12:08'),
(144,17,'12',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(145,17,'12.1',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(146,17,'12.1.1',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(147,17,'12.1.2',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(148,17,'12.1.3',0,'2026-03-02 16:12:21','2026-03-02 16:12:21'),
(149,17,'12.1.4',0,'2026-03-02 16:12:21','2026-03-02 16:12:21'),
(150,19,'13',1,'2026-03-02 17:37:25','2026-03-02 18:23:26'),
(151,19,'13.1',0,'2026-03-02 17:37:25','2026-03-02 17:37:25'),
(152,19,'13.2',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(153,19,'13.3',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(154,19,'13.4',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(155,19,'13.5',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(156,19,'13',1,'2026-03-02 17:54:34','2026-03-02 18:23:26'),
(157,19,'13.6',0,'2026-03-02 17:54:35','2026-03-02 17:54:35'),
(158,19,'13.7',0,'2026-03-02 17:54:35','2026-03-02 17:54:35'),
(159,19,'13',1,'2026-03-02 18:06:26','2026-03-02 18:23:26'),
(160,19,'13.8',0,'2026-03-02 18:06:26','2026-03-02 18:06:26'),
(161,19,'13',0,'2026-03-02 18:23:43','2026-03-02 18:23:43'),
(162,19,'13.9',0,'2026-03-02 18:23:43','2026-03-02 18:23:43'),
(163,12,'10',0,'2026-03-09 10:40:18','2026-03-09 10:40:18'),
(164,12,'10.9',0,'2026-03-09 10:40:18','2026-03-09 10:40:18'),
(165,10,'10',0,'2026-03-09 10:41:49','2026-03-09 10:41:49'),
(166,10,'10.9',0,'2026-03-09 10:41:50','2026-03-09 10:41:50'),
(167,8,'8.9',0,'2026-03-11 13:10:56','2026-03-11 13:10:56'),
(168,11,'8.9',0,'2026-03-11 13:10:56','2026-03-11 13:10:56'),
(169,13,'8.9',0,'2026-03-11 13:10:56','2026-03-11 13:10:56');
/*!40000 ALTER TABLE `trd_acceso_permiso_rol` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_permiso_rol_vecinos`
--

DROP TABLE IF EXISTS `trd_acceso_permiso_rol_vecinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_permiso_rol_vecinos` (
  `pfr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pfr_perfil_id` int(11) DEFAULT NULL,
  `pfr_rol_id` varchar(20) DEFAULT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pfr_id`),
  KEY `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` (`pfr_perfil_id`) USING BTREE,
  KEY `trd_acceso_perfiles_roles_trd_acceso_roles_FK` (`pfr_rol_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permiso_rol_vecinos`
--

LOCK TABLES `trd_acceso_permiso_rol_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permiso_rol_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permiso_rol_vecinos` VALUES
(1,1,'1',0,'2026-03-03 15:56:14','2026-03-03 15:56:14'),
(2,1,'2',0,'2026-03-03 16:26:50','2026-03-03 16:26:50'),
(3,1,'2.1',0,'2026-03-03 16:26:50','2026-03-03 16:26:50'),
(4,1,'3',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(5,1,'3.0',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(6,1,'3.1',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(7,1,'3.2',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(8,1,'3.3',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(9,1,'4',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(10,1,'4.1',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(11,1,'4.2',0,'2026-03-09 14:13:09','2026-03-09 14:13:09'),
(12,1,'4.3',0,'2026-03-09 14:13:09','2026-03-09 14:13:09');
/*!40000 ALTER TABLE `trd_acceso_permiso_rol_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_permisos`
--

DROP TABLE IF EXISTS `trd_acceso_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_permisos` (
  `rol_id` varchar(20) NOT NULL,
  `rol_orden` int(11) DEFAULT NULL,
  `rol_nombre` varchar(255) NOT NULL,
  `rol_enlace` varchar(255) DEFAULT NULL,
  `rol_formato` varchar(100) DEFAULT NULL,
  `rol_tipo` varchar(50) DEFAULT NULL,
  `rol_simbolo` varchar(100) DEFAULT 'dashboard',
  `rol_borrado` tinyint(1) DEFAULT 0,
  `rol_creacion` datetime DEFAULT current_timestamp(),
  `rol_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol_modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permisos`
--

LOCK TABLES `trd_acceso_permisos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permisos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permisos` VALUES
('1',1,'Administracion sistema','funcionarios/sisadmin/index.php','menu','categoria','settings',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('1.1',NULL,'Logs del Sistema',NULL,'menu','subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19','sisadmin'),
('1.1.1',NULL,'Consulta de Log','funcionarios/sisadmin/logs/consulta_log.php','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19','sisadmin'),
('1.1.2',NULL,'Listado de Logs','funcionarios/sisadmin/logs/listado_logs.php','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19','sisadmin'),
('1.1.3',NULL,'Acceso','','menu','subcategoria','menu',1,'2026-01-30 11:29:05','2026-02-26 14:54:19','sisadmin'),
('1.2',NULL,'Mantenedores',NULL,'menu','subcategoria','menu',0,'2026-01-14 09:33:54','2026-02-26 14:54:19','sisadmin'),
('1.2.1',NULL,'General',NULL,'menu','subcategoria','menu',0,'2026-01-14 09:33:54','2026-02-26 14:54:19','sisadmin'),
('1.2.1.1',NULL,'Contribuyentes','funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_contribuyentes.html','menu','Pagina','menu',0,'2026-01-14 09:33:54','2026-02-26 14:54:19','sisadmin'),
('1.2.1.2',NULL,'Organizaciones Comunitarias','funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_org_comunitarias.html','menu','Pagina','menu',0,'2026-01-26 10:30:51','2026-02-26 14:54:19','sisadmin'),
('1.2.2',NULL,'DESVE','','menu','subcategoria','menu',0,'2026-01-26 10:28:30','2026-02-26 14:54:19','sisadmin'),
('1.2.2.1',NULL,'Oigenes especiales','funcionarios/sisadmin/mantenedores/desve/origenes_especiales.php','menu','Pagina','menu',0,'2026-01-26 10:30:51','2026-02-26 15:31:52','sisadmin'),
('1.2.2.5',NULL,'General - Escolaridad','funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_escolaridad.php','menu','Pagina','book',0,'2026-02-16 15:13:53','2026-02-26 15:16:31','sisadmin'),
('1.2.3',NULL,'Acceso','','menu','subcategoria','menu',0,'2026-01-30 11:30:27','2026-02-26 14:54:19','sisadmin'),
('1.2.3.1',NULL,'Usuarios','funcionarios/sisadmin/mantenedores/acceso/usuarios.php','menu','Pagina','menu',0,'2026-01-30 11:33:12','2026-02-26 15:13:33','sisadmin'),
('1.2.3.2',NULL,'Roles de usuario','funcionarios/sisadmin/mantenedores/acceso/usuarios_roles.php','menu','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-26 15:13:33','sisadmin'),
('1.2.3.3',NULL,'Roles','funcionarios/sisadmin/mantenedores/acceso/roles.php','menu','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-26 15:13:33','sisadmin'),
('1.2.3.4',NULL,'Permisos de Rol','funcionarios/sisadmin/mantenedores/acceso/permisos_roles.php','menu','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-26 14:54:19','sisadmin'),
('1.2.3.5',NULL,'Permisos','funcionarios/sisadmin/mantenedores/acceso/permisos.php','menu','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-26 14:54:19','sisadmin'),
('1.2.4',NULL,'OIRS',NULL,'menu','subcategoria','menu',0,'2026-02-16 13:59:53','2026-02-26 14:54:19','sisadmin'),
('1.2.4.1',NULL,'OIRS - Temáticas','funcionarios/sisadmin/mantenedores/oirs/tematicas.php','menu','Pagina','list',0,'2026-02-16 15:03:29','2026-02-26 15:32:16','sisadmin'),
('1.2.4.2',NULL,'OIRS - Subtemáticas','funcionarios/sisadmin/mantenedores/oirs/subtematicas.php','menu','Pagina','layers',0,'2026-02-16 15:03:29','2026-02-26 15:32:16','sisadmin'),
('1.2.4.3',NULL,'OIRS - Tipos de Atención','funcionarios/sisadmin/mantenedores/oirs/tipo_atencion.php','menu','Pagina','user-check',0,'2026-02-16 15:03:29','2026-02-26 15:32:16','sisadmin'),
('1.2.4.4',NULL,'OIRS - Condiciones Especiales','funcionarios/sisadmin/mantenedores/oirs/condiciones.php','menu','Pagina','award',0,'2026-02-16 15:03:29','2026-02-26 15:32:16','sisadmin'),
('10',2,'OIRS','funcionarios/oirs/index.php','menu','categoria','command',0,'2026-02-10 16:23:11','2026-02-26 14:55:38','principal'),
('10.1',1,'Dashboard','funcionarios/oirs/index.php','menu','Pagina','list',0,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.2',2,'Nuevo Ingreso','funcionarios/oirs/ingresar.php','menu','Pagina','plus',0,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.3',99,'Listar OIRS','funcionarios/oirs/listar.php','menu','Pagina','map',1,'2026-02-10 16:23:11','2026-03-11 14:31:48','oirs'),
('10.4',0,'Ver','funcionarios/oirs/ver.php','vista','Pagina','search',0,'2026-02-10 16:23:11','2026-02-26 13:55:21','oirs'),
('10.5',3,'Por Revisar','funcionarios/oirs/revisar.php','menu','Pagina','message-square',0,'2026-02-10 16:23:11','2026-03-11 14:53:00','oirs'),
('10.6',6,'Visación de  Solicitudes','funcionarios/oirs/visacion.php','menu','Pagina','edit',0,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.7',4,'Mi Historial','funcionarios/oirs/historial.php','menu','Pagina','find_in_page',0,'2026-02-11 09:42:08','2026-03-11 14:22:03','oirs'),
('10.8',4,'Consulta ','funcionarios/oirs/consultar.php','menu','Pagina','archive',0,'2026-02-26 15:06:40','2026-03-11 14:04:10','oirs'),
('10.9',8,'Roles oirs','funcionarios/oirs/roles_oirs.php','menu','Pagina','edit',0,'2026-03-09 10:39:40','2026-03-09 10:39:40','oirs'),
('11',3,'Patentes',NULL,'menu','categoria','command',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('11.1',NULL,'Mis Solicitudes','funcionarios/no_asignadas/patentes_mis_solicitudes.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.2',NULL,'Pagos','funcionarios/no_asignadas/pagos.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.3',NULL,'Solicitud Única de Patentes','funcionarios/no_asignadas/patentes_solicitud_unica.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.4',NULL,'Consulta de Solicitud','funcionarios/no_asignadas/patentes_consulta_solicitud.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.c',NULL,'Gestión de Empresas','funcionarios/no_asignadas/contribuyente_empresas.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('12',9,'Licencias de conducir','funcionarios/licencias/index.php','menu','categoria','command',0,'2026-03-02 16:04:48','2026-03-02 17:19:18','principal'),
('12.1',NULL,'Filas',NULL,'menu','subcategoria','dashboard',0,'2026-03-02 16:09:06','2026-03-02 16:10:41',NULL),
('12.1.1',1,'Dashboard','funcionarios/licencias/filas/index.php','menu','Pagina','book',0,'2026-03-02 16:04:48','2026-03-02 16:15:13','licencias'),
('12.1.2',2,'Agenda','funcionarios/licencias/filas/agenda.php','menu','Pagina','user-check',0,'2026-03-02 16:04:48','2026-03-02 16:15:13','licencias'),
('12.1.3',3,'Reportes','funcionarios/licencias/filas/reportes.php','menu','Pagina','command',0,'2026-03-02 16:04:48','2026-03-02 16:15:13','licencias'),
('12.1.4',4,'Configuacion','funcionarios/licencias/filas/configuracion.php','menu','Pagina','settings',0,'2026-03-02 16:04:48','2026-03-02 17:18:16','licencias'),
('12.2',NULL,'Modulos',NULL,'menu','subcategoria','dashboard',0,'2026-03-02 16:09:06','2026-03-02 16:10:41',NULL),
('12.2.1',NULL,'Modulos','funcionarios/licencias/modulos/index.php','menu','Pagina','user-check',0,'2026-03-02 16:09:06','2026-03-02 17:19:18','licencias'),
('13',15,'Desarrollo Económico','funcionarios/desarrollo_economico/index.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:43:08','principal'),
('13.1',1,'Dashboard','funcionarios/desarrollo_economico/index.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:35:18','desarrollo_economico'),
('13.2',2,'Postulaciones','funcionarios/desarrollo_economico/postulacion.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:35:18','desarrollo_economico'),
('13.3',3,'Emprendedores','funcionarios/desarrollo_economico/emprendedores.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:44:23','desarrollo_economico'),
('13.4',4,'Espacios','funcionarios/desarrollo_economico/espacios.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:35:18','desarrollo_economico'),
('13.5',5,'Próximas','funcionarios/desarrollo_economico/proximas.php','menu','Pagina','clock',0,'2026-03-02 17:35:18','2026-03-02 17:35:18','desarrollo_economico'),
('13.6',NULL,'Ver Postulaciòn','funcionarios/desarrollo_economico/postulacion_ver.php','vista','Pagina','dashboard',0,'2026-03-02 17:53:37','2026-03-02 17:53:37','desarrollo_economico'),
('13.7',NULL,'Ver Emprendedores','funcionarios/desarrollo_economico/emprendedores_ver.php','vista','Pagina','dashboard',0,'2026-03-02 17:53:37','2026-03-02 17:53:37','desarrollo_economico'),
('13.8',NULL,'Próximas Ferias','funcionarios/desarrollo_economico/proximas_agregar.php','vista','Pagina','dashboard',0,'2026-03-02 18:05:52','2026-03-02 18:23:06','desarrollo_economico'),
('13.9',NULL,'Agregar Espacios','funcionarios/desarrollo_economico/emprendedores_agregar.php','vista','Pagina','dashboard',0,'2026-03-02 18:23:06','2026-03-02 18:23:06','desarrollo_economico'),
('2',4,'Organizaciones Comunitarias',NULL,'menu','categoria','command',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('2.1',NULL,'Organizaciones',NULL,'menu','subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19',NULL),
('2.1.1',NULL,'Consulta Organizacion','funcionarios/no_asignadas/organizaciones_consulta_organizacion.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('2.1.2',NULL,'Consulta Masiva Organizaciones','funcionarios/no_asignadas/organizaciones_consulta_masiva.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('3',5,'Subvenciones',NULL,'menu','categoria','command',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('3.1',NULL,'Subvenciones',NULL,'menu','subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19',NULL),
('3.1.1',NULL,'Consulta de Subvención','funcionarios/no_asignadas/subvenciones_consulta_subvencion.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('3.1.2',NULL,'Consulta Masiva de Subvenciones','funcionarios/no_asignadas/subvenciones_consulta_masiva.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('3.1.7',NULL,'Consulta Masiva de Pagos','funcionarios/no_asignadas/subvenciones_consulta_masiva_pagos.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('3.2',NULL,'Postulaciones',NULL,'menu',NULL,'menu',0,'2026-01-30 13:37:13','2026-02-26 14:54:19',NULL),
('3.2.1',NULL,'Consulta de Postulación','funcionarios/no_asignadas/postulaciones_consulta_postulacion.html','menu',NULL,'menu',0,'2026-01-30 13:37:13','2026-02-26 15:16:31',NULL),
('3.2.2',NULL,'Consulta Masiva de Postulaciones','funcionarios/no_asignadas/postulaciones_consulta_masiva.html','menu',NULL,'menu',0,'2026-01-30 13:37:13','2026-02-26 15:16:31',NULL),
('4',6,'DESVE','funcionarios/desve/index.php','menu','categoria','command',0,'2026-01-30 13:45:50','2026-02-26 14:55:38','principal'),
('4.1',2,'Nuevo Ingreso ','funcionarios/desve/nuevo.php','menu','Pagina','plus',0,'2026-01-30 13:45:50','2026-02-26 14:54:19','desve'),
('4.2',1,'Dashboard','funcionarios/desve/index.php','menu','Pagina','list',0,'2026-01-30 13:45:50','2026-02-26 14:54:19','desve'),
('4.3',4,'Mi Historial','funcionarios/desve/historial.php','menu','Pagina','find_in_page',0,'2026-01-30 13:45:50','2026-03-11 14:22:03','desve'),
('4.4',6,'Edicion ','funcionarios/desve/modificar.php','vista','Pagina','edit',0,'2026-01-30 13:45:50','2026-02-26 14:58:36','desve'),
('4.5',7,'Responder ','funcionarios/desve/responder.php','vista','Pagina','message-square',0,'2026-01-30 13:45:50','2026-02-26 14:58:36','desve'),
('4.6',5,'Consulta ','funcionarios/desve/consulta.php','menu','Pagina','archive',0,'2026-01-30 13:45:50','2026-03-11 14:04:10','desve'),
('4.7',3,'Mis Pendientes','funcionarios/desve/pendientes.php','menu','Pagina','alarm',0,'2026-02-24 09:42:40','2026-03-11 14:22:03','desve'),
('5',7,'Atenciones',NULL,'menu','categoria','menu',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('5.1',NULL,'Lista de espera','funcionarios/no_asignadas/atenciones_lista_espera.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('5.2',NULL,'Historial','funcionarios/no_asignadas/atenciones_listado_atenciones.html','menu','Pagina','archive',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('5.3',NULL,'Nueva','funcionarios/no_asignadas/atenciones_nueva_atencion.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('5.4',NULL,'Tomar Atención','funcionarios/no_asignadas/atenciones_tomar_atencion.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('5.5',NULL,'Consultar','funcionarios/no_asignadas/atenciones_consulta_atencion.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('8',8,'Ingresos','funcionarios/ingresos/index.php','menu','categoria','command',0,'2026-01-19 10:44:56','2026-02-26 14:55:38','principal'),
('8.0',NULL,'Dashboard','funcionarios/ingresos/index.php','menu','Pagina','dashboard',0,'2026-02-13 12:02:06','2026-02-26 14:54:19','ingresos'),
('8.1',1,'Dashboard','funcionarios/ingresos/index.php','menu','Pagina','list',0,'2026-01-19 10:54:34','2026-02-27 14:00:41','ingresos'),
('8.2',2,'Nuevo Ingreso','funcionarios/ingresos/crear.php','menu','Pagina','plus',0,'2026-01-19 10:54:34','2026-02-27 14:02:37','ingresos'),
('8.3',8,'Ver Ingreso','funcionarios/ingresos/ver.php','vista','Pagina','menu',0,'2026-01-19 10:54:34','2026-03-02 12:44:04','ingresos'),
('8.4',5,'Modificar ','funcionarios/ingresos/modificar.php','vista','Pagina','edit',0,'2026-01-19 10:54:34','2026-02-27 14:03:24','ingresos'),
('8.5',6,'Respoder','funcionarios/ingresos/responder.php','vista','Pagina','message-square',0,'2026-01-19 10:54:34','2026-02-27 14:03:24','ingresos'),
('8.6',7,'Fraccionar','funcionarios/ingresos/preparar.php','vista','Pagina','menu',0,'2026-01-19 10:54:34','2026-02-27 14:03:24','ingresos'),
('8.7',4,'Mi Historial','funcionarios/ingresos/historial.php','menu','Pagina','find_in_page',0,'2026-01-26 07:52:09','2026-03-11 14:22:03','ingresos'),
('8.8',5,'Consulta','funcionarios/ingresos/consulta.php','menu','Pagina','archive',0,'2026-03-02 12:44:04','2026-03-11 14:22:03','ingresos'),
('8.9',3,'Mis Pendientes','funcionarios/ingresos/pendientes.php','menu','Pagina','alarm',0,'2026-03-11 13:10:00','2026-03-11 14:22:03','ingresos'),
('9',10,'Blanco',NULL,'menu','categoria','dashboard',0,'2026-03-02 15:45:01','2026-03-02 16:18:44','principal'),
('9.1',1,'Dashboard','funcionarios/blanco/index.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.2',2,'Consultar','funcionarios/blanco/consultar.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.3',3,'Ver','funcionarios/blanco/ver.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.4',4,'Editar Maestro','funcionarios/blanco/maestro.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('A.0',NULL,'Bandeja','funcionarios/index.php','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19',NULL),
('A.1',NULL,'Bandeja Historial','funcionarios/bandeja_historial.php','menu','Pagina','find_in_page',0,'2026-02-11 16:34:04','2026-03-11 14:00:10',NULL);
/*!40000 ALTER TABLE `trd_acceso_permisos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_permisos_vecinos`
--

DROP TABLE IF EXISTS `trd_acceso_permisos_vecinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_permisos_vecinos` (
  `rol_id` varchar(20) NOT NULL,
  `rol_orden` int(11) DEFAULT NULL,
  `rol_nombre` varchar(255) NOT NULL,
  `rol_enlace` varchar(255) DEFAULT NULL,
  `rol_formato` varchar(100) DEFAULT NULL,
  `rol_tipo` varchar(50) DEFAULT NULL,
  `rol_simbolo` varchar(100) DEFAULT 'dashboard',
  `rol_borrado` tinyint(1) DEFAULT 0,
  `rol_creacion` datetime DEFAULT current_timestamp(),
  `rol_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol_modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permisos_vecinos`
--

LOCK TABLES `trd_acceso_permisos_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permisos_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permisos_vecinos` VALUES
('1',1,'test','test.php','menu','pagina','menu',0,'2026-03-03 15:55:29','2026-03-03 16:04:20','principal'),
('2',1,'Oirs','vecinos/oirs/index.php','menu','Categoria','menu',0,'2026-03-03 16:26:34','2026-03-03 16:53:02','principal'),
('2.1',2,'Oirs','index.php','menu','pagina','menu',0,'2026-03-03 16:26:34','2026-03-03 16:26:34','oirs'),
('3',3,'Licencia de Conducir','vecinos/licencias/index.php','menu','pagina','menu',0,'2026-03-09 13:41:38','2026-03-09 13:43:26','principal'),
('3.0',1,'Licencia de Conducir','vecinos/licencias/index.php','menu','pagina','menu',0,'2026-03-09 13:47:10','2026-03-09 13:47:10','licencias'),
('3.1',2,'Reservar Hora','vecinos/licencias/reservar.php','menu','pagina','menu',0,'2026-03-09 13:44:44','2026-03-09 13:51:22','licencias'),
('3.2',0,'Confirmar','vecinos/licencias/confirmar.php','vista','pagina','menu',0,'2026-03-09 13:45:30','2026-03-09 13:47:10','licencias'),
('3.3',0,'Gestionar','vecinos/licencias/gestionar.php','vista','pagina','menu',0,'2026-03-09 13:46:03','2026-03-09 13:47:10','licencias'),
('4',4,'Desarrollo Económico','vecinos/desarrollo_economico/index.php','menu','pagina','menu',0,'2026-03-09 14:08:12','2026-03-09 14:09:11','principal'),
('4.1',1,'Dashboard','vecinos/desarrollo_economico/index.php','menu','pagina','menu',0,'2026-03-09 14:09:11','2026-03-09 14:14:02','desarrollo_economico'),
('4.2',2,'Inscribirse','vecinos/desarrollo_economico/inscripcion.php','menu','pagina','menu',0,'2026-03-09 14:11:35','2026-03-09 14:14:02','desarrollo_economico'),
('4.3',3,'Postular','vecinos/desarrollo_economico/postular.php','menu','pagina','menu',0,'2026-03-09 14:11:35','2026-03-09 14:14:02','desarrollo_economico');
/*!40000 ALTER TABLE `trd_acceso_permisos_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_rol_usuario`
--

DROP TABLE IF EXISTS `trd_acceso_rol_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_rol_usuario` (
  `usp_id` int(11) NOT NULL AUTO_INCREMENT,
  `usp_usuario_id` int(11) NOT NULL,
  `usp_rol_id` int(11) NOT NULL,
  `usp_fecha_inicio` datetime DEFAULT current_timestamp(),
  `usp_fecha_termino` datetime DEFAULT NULL,
  `usp_usuario_subrogante_id` int(11) DEFAULT NULL,
  `usp_borrado` tinyint(1) DEFAULT 0,
  `usp_creacion` datetime DEFAULT current_timestamp(),
  `usp_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usp_id`),
  KEY `1` (`usp_usuario_id`),
  KEY `2` (`usp_usuario_subrogante_id`),
  CONSTRAINT `1` FOREIGN KEY (`usp_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `2` FOREIGN KEY (`usp_usuario_subrogante_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_rol_usuario`
--

LOCK TABLES `trd_acceso_rol_usuario` WRITE;
/*!40000 ALTER TABLE `trd_acceso_rol_usuario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_rol_usuario` VALUES
(1,1,1,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2026-01-30 15:48:51'),
(2,1,4,NULL,NULL,NULL,0,'2026-01-30 13:48:40','2026-01-30 13:48:40'),
(3,1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24'),
(4,1,10,NULL,NULL,NULL,0,'2026-02-10 16:36:13','2026-02-10 16:36:13'),
(5,1,16,NULL,NULL,NULL,0,'2026-03-02 16:05:04','2026-03-02 16:05:04'),
(6,1,17,NULL,NULL,NULL,0,'2026-03-02 16:12:36','2026-03-02 16:12:36'),
(7,1,18,NULL,NULL,NULL,0,'2026-03-02 16:12:51','2026-03-02 16:12:51'),
(8,1,19,NULL,NULL,NULL,0,'2026-03-02 17:41:42','2026-03-02 17:41:42'),
(9,2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(10,2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(11,2,12,NULL,NULL,NULL,0,'2026-03-05 13:26:04','2026-03-05 13:26:04'),
(12,3,8,'2026-02-05 13:39:00','2027-06-12 13:39:00',NULL,0,'2026-02-06 13:39:31','2026-02-06 13:52:29'),
(13,3,9,NULL,NULL,NULL,0,'2026-02-26 15:44:27','2026-02-26 15:44:27'),
(14,3,12,NULL,NULL,NULL,0,'2026-03-05 12:57:53','2026-03-05 12:57:53'),
(15,4,11,NULL,NULL,NULL,0,'2026-02-12 16:00:50','2026-02-12 16:00:50'),
(16,6,13,NULL,NULL,NULL,0,'2026-02-12 16:01:44','2026-02-12 16:01:44'),
(17,9,9,NULL,NULL,NULL,0,'2026-02-12 16:00:29','2026-02-24 14:36:34'),
(18,10,14,NULL,NULL,NULL,0,'2026-02-12 16:01:31','2026-02-12 16:01:31'),
(19,13,12,NULL,NULL,NULL,0,'2026-02-12 16:01:06','2026-02-12 16:01:06'),
(20,15,15,NULL,NULL,NULL,0,'2026-02-12 16:02:10','2026-02-12 16:02:10');
/*!40000 ALTER TABLE `trd_acceso_rol_usuario` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_rol_usuario_vecinos`
--

DROP TABLE IF EXISTS `trd_acceso_rol_usuario_vecinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_rol_usuario_vecinos` (
  `usp_usuario_id` int(11) NOT NULL,
  `usp_perfil_id` int(11) NOT NULL,
  `usp_fecha_inicio` datetime DEFAULT current_timestamp(),
  `usp_fecha_termino` datetime DEFAULT NULL,
  `usp_usuario_subrogante_id` int(11) DEFAULT NULL,
  `usp_borrado` tinyint(1) DEFAULT 0,
  `usp_creacion` datetime DEFAULT current_timestamp(),
  `usp_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usp_usuario_id`,`usp_perfil_id`),
  KEY `usp_perfil_id` (`usp_perfil_id`) USING BTREE,
  KEY `usp_usuario_subrogante_id` (`usp_usuario_subrogante_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_rol_usuario_vecinos`
--

LOCK TABLES `trd_acceso_rol_usuario_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_rol_usuario_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_rol_usuario_vecinos` VALUES
(1,1,'2026-03-03 15:57:03',NULL,NULL,0,'2026-03-03 15:57:03','2026-03-03 15:57:03'),
(2,1,'2026-03-03 15:57:20',NULL,NULL,0,'2026-03-03 15:57:20','2026-03-03 15:57:20');
/*!40000 ALTER TABLE `trd_acceso_rol_usuario_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_roles`
--

DROP TABLE IF EXISTS `trd_acceso_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_roles` (
  `prf_id` int(11) NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(100) NOT NULL,
  `prf_borrado` tinyint(1) DEFAULT 0,
  `prf_creacion` datetime DEFAULT current_timestamp(),
  `prf_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_roles`
--

LOCK TABLES `trd_acceso_roles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_roles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_roles` VALUES
(1,'Administrador de Sistema',0,'2025-12-29 12:53:09','2026-01-30 15:46:54'),
(2,'Patentes Comerciales',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'Organizaciones_comunitarias',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(4,'Desarollo_Vecinal',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(5,'Atenciones',0,'2025-12-29 12:53:09','2026-01-29 12:44:01'),
(6,'6',0,'2025-12-29 12:53:09','2026-02-02 08:34:42'),
(7,'Subvenciones',0,'2026-01-19 13:35:49','2026-01-19 13:35:49'),
(8,'Ingresos',0,'2026-01-19 13:35:49','2026-01-19 13:35:49'),
(9,'administrador DESVE',0,'2026-02-02 15:42:11','2026-02-12 15:52:34'),
(10,'OIRS',0,'2026-02-10 16:34:32','2026-02-10 16:34:32'),
(11,'administrador ingresos',0,'2026-02-12 15:49:41','2026-02-12 15:49:41'),
(12,'administrador oirs',0,'2026-02-12 15:50:17','2026-02-12 15:50:17'),
(13,'operador ingresos',0,'2026-02-12 15:57:33','2026-02-12 15:57:33'),
(14,'operador desve',0,'2026-02-12 15:57:43','2026-02-12 15:57:43'),
(15,'operador oirs',0,'2026-02-12 15:57:51','2026-02-12 15:57:51'),
(16,'Blanco',0,'2026-03-02 15:40:39','2026-03-02 15:40:57'),
(17,'Administrador de filas licencias',0,'2026-03-02 16:06:03','2026-03-02 16:06:03'),
(18,'operador de modulo licencias',0,'2026-03-02 16:06:03','2026-03-02 16:13:02'),
(19,'Desarrollo Economico',0,'2026-03-02 17:36:59','2026-03-02 17:36:59');
/*!40000 ALTER TABLE `trd_acceso_roles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_roles_vecinos`
--

DROP TABLE IF EXISTS `trd_acceso_roles_vecinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_roles_vecinos` (
  `prf_id` int(11) NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(100) NOT NULL,
  `prf_borrado` tinyint(1) DEFAULT 0,
  `prf_creacion` datetime DEFAULT current_timestamp(),
  `prf_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_roles_vecinos`
--

LOCK TABLES `trd_acceso_roles_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_roles_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_roles_vecinos` VALUES
(1,'base',0,'2026-03-03 15:55:56','2026-03-03 15:55:56');
/*!40000 ALTER TABLE `trd_acceso_roles_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_usuarios`
--

DROP TABLE IF EXISTS `trd_acceso_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_usuarios` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nombre` varchar(100) NOT NULL,
  `usr_apellido` varchar(100) NOT NULL,
  `usr_rut` varchar(12) NOT NULL,
  `usr_email` varchar(255) DEFAULT NULL,
  `usr_rango` tinyint(4) NOT NULL DEFAULT 1,
  `usr_borrado` tinyint(1) DEFAULT 0,
  `usr_creacion` datetime DEFAULT current_timestamp(),
  `usr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_rut` (`usr_rut`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_usuarios`
--

LOCK TABLES `trd_acceso_usuarios` WRITE;
/*!40000 ALTER TABLE `trd_acceso_usuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_usuarios` VALUES
(1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',1,0,'2025-12-29 12:53:09','2026-02-17 11:17:14'),
(2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',1,0,'2026-01-06 11:47:58','2026-02-17 11:17:14'),
(3,'Ramon','Martinez','14037230-7','ramon.martinez@munivina.cl',1,0,'2026-01-09 10:13:01','2026-02-17 16:19:59'),
(4,'Daniela','Ruiz','17753458-7','daniela.ruiz@munivina.cl',5,0,'2026-02-12 15:11:13','2026-03-04 16:48:09'),
(6,'usuario ingresos','operador','11111111-2','ingresos.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(7,'usuario ingresos','funcionaio','11111111-3','ingresos.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(8,'usuario ingresos','exteno','11111111-4','ingresos.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(9,'usuario desve','admin','11111112-1','desve.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-17 11:17:14'),
(10,'usuario desve','operador','11111112-2','desve.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(11,'usuario desve','funcionaio','11111112-3','desve.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(12,'usuario desve','exteno','11111112-4','desve.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(13,'usuario oirs','admin','11111113-1','oirs.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-17 11:17:14'),
(14,'usuario desve','operador','11111113-2','oirs.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(15,'usuario oirs','funcionaio','11111113-3','oirs.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(16,'usuario oirs','exteno','11111113-4','oirs.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-17 11:17:14'),
(17,'JAIME','RAMIREZ','9.423.023-3','jaime.ramirez@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(18,'EDGARDO','MOYANO','9.942.088-K','edgardo.moyano@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(19,'ANIBAL SEBASTIAN','RAMOS','15767647-4','anibal.ramos@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(20,'KAREN ANDREA','MALDONADO','15973805-1','KAREN.MALDONADO@MUNIVINA.CL',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(21,'CAMILA FERNANDA','ESTAY','16484057-3','CAMILA.ESTAY@MUNIVINA.CL',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(22,'Eric Alexis','Dinamarca','13025219-2','eric.dinamarca@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(23,'Jessica Angélica','Noveroy','15098163-8','jessica.noveroy@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(24,'Rodrigo Edir','Sánchez','16143070-6','rodrigo.sanchez@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(25,'Sebastián Andrés','Villarroel','10744411-4','sebastian.villarroel@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(26,'Daniela Margarita','Saavedra','14561871-1','daniela.saavedra@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(27,'Cecilia Andrea','Niño','11736906-4','cecilia.nino@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(28,'Lorena Olivia','Flores','14261866-4','lorena.flores@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(29,'César Alejandro','Contreras','12955025-2','cesar.contreras@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(30,'Patricia Alejandra','Peralta','19265001-1','patricia.peralta@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(31,'Julio Alez','Santos','9058327-1','julio.santos@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(32,'Alejandra','Puccio','13019058-8','alejandra.puccio@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(33,'Jorge Andres','Gonzalez','11261494-k','jorge.gonzalezvalladares@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(34,'DANAI','OLEA','16483866-8','danai.olea@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(35,'ROBERTO','ANDAUR','9143818-6','roberto.andaur@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(36,'GUILLERMO','PARRA','15557156-K','guillermo.parra@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(37,'NATHALY','CABRERA','13993411-3','nathaly.cabrera@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(38,'JUAN PABLO','GAVILAN','16483311-9','juan pablo.gavilan@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(39,'RODRIGO','PASTEN','14614957-K','rodrigo.pasten@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(40,'Evelyn Denisse','Urrutia','10729314-0','evelyn.urrutia@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(41,'Nicolas Marcelo','Monsalvez','18998258-5','nicolas.monsalvez@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(42,'Juan Marcelo','Bravo','12955269-7','juan.bravo@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(43,'Makarena Yazmin','Camacho','17275465-1','makarena.camacho@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(44,'Eliana','Perez','12846626-6','eliana.perez@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59'),
(45,'Giovanna Pamela','Ramírez','11736602-2','giovanna.ramirez@munivina.cl',1,0,'2026-03-09 13:28:59','2026-03-09 13:28:59');
/*!40000 ALTER TABLE `trd_acceso_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_vecinos`
--

DROP TABLE IF EXISTS `trd_acceso_vecinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_vecinos` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nombre` varchar(100) NOT NULL,
  `usr_apellido` varchar(100) NOT NULL,
  `usr_rut` varchar(12) NOT NULL,
  `usr_clave` varchar(100) DEFAULT NULL,
  `usr_email` varchar(255) DEFAULT NULL,
  `usr_borrado` tinyint(1) DEFAULT 0,
  `usr_creacion` datetime DEFAULT current_timestamp(),
  `usr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_rut` (`usr_rut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_vecinos`
--

LOCK TABLES `trd_acceso_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_vecinos` VALUES
(1,'acceso_vecinos','test','11111111-1',NULL,'vecino@test.cl',0,'2026-03-03 13:55:16','2026-03-03 13:55:16'),
(2,'maria','vecina','99999999-9',NULL,'maria.vecina@test.cl',0,'2026-03-03 13:55:16','2026-03-03 13:55:16'),
(3,'Juan Francisco','Hervas Farrú','14.711.939-9','$2y$10$svIG/9nne5IRBMsfV2ZUqOiOGW5Sj6xqvrIMlMf8lZRx32Y7YquIi','juan.hervas@munivina.cl',0,'2026-03-11 09:06:13','2026-03-11 09:06:13');
/*!40000 ALTER TABLE `trd_acceso_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_asistencia`
--

DROP TABLE IF EXISTS `trd_desecon_asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_asistencia` (
  `dea_id` int(11) NOT NULL AUTO_INCREMENT,
  `dea_postulacion` int(11) NOT NULL,
  `dea_fecha` date NOT NULL,
  `dea_accion` enum('Pendiente','Ingreso','Salida') DEFAULT 'Pendiente',
  `dea_evaluacion` int(11) DEFAULT NULL,
  `dea_creacion` time NOT NULL,
  `dea_borrado` time NOT NULL,
  PRIMARY KEY (`dea_id`),
  KEY `fk_trd_desecon_asistencia_trd_desecon_postulaciones1_idx` (`dea_postulacion`),
  CONSTRAINT `fk_trd_desecon_asistencia_trd_desecon_postulacion` FOREIGN KEY (`dea_postulacion`) REFERENCES `trd_desecon_postulaciones` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_asistencia`
--

LOCK TABLES `trd_desecon_asistencia` WRITE;
/*!40000 ALTER TABLE `trd_desecon_asistencia` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_asistencia` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_convocatorias`
--

DROP TABLE IF EXISTS `trd_desecon_convocatorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_convocatorias` (
  `dec_id` int(11) NOT NULL AUTO_INCREMENT,
  `dec_titulo` varchar(255) NOT NULL,
  `dec_registro_general_expediente` int(11) NOT NULL,
  `dec_espacio` int(11) NOT NULL,
  `dec_descripcion` text DEFAULT NULL,
  `dec_tipo` enum('Feria','Taller','Fondo','Capacitación') DEFAULT NULL,
  `dec_fecha_inicio` date DEFAULT NULL,
  `dec_fecha_fin` date DEFAULT NULL,
  `dec_costo_puntaje` int(11) DEFAULT NULL,
  `dec_capacidad` int(11) DEFAULT NULL,
  `dec_img_portada` varchar(255) DEFAULT NULL,
  `dec_bases` varchar(255) DEFAULT NULL,
  `dec_estado` enum('Borrador','Abierta','Cerrada','Finalizada') DEFAULT 'Borrador',
  `dec_creacion` datetime DEFAULT current_timestamp(),
  `dec_borrado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`dec_id`),
  KEY `fk_trd_desecon_convocatorias_trd_desecon_espacios1_idx` (`dec_espacio`),
  KEY `trd_desecon_registro_general_expedientes_FK` (`dec_registro_general_expediente`),
  CONSTRAINT `fk_trd_desecon_convocatorias_trd_desecon_espacios1` FOREIGN KEY (`dec_espacio`) REFERENCES `trd_desecon_espacios` (`des_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `trd_desecon_registro_general_expedientes_FK` FOREIGN KEY (`dec_registro_general_expediente`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_convocatorias`
--

LOCK TABLES `trd_desecon_convocatorias` WRITE;
/*!40000 ALTER TABLE `trd_desecon_convocatorias` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_convocatorias` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_docentregada`
--

DROP TABLE IF EXISTS `trd_desecon_docentregada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_docentregada` (
  `dee_id` int(11) DEFAULT NULL,
  `dee_documentacion` int(11) NOT NULL,
  `dee_emprendedor` varchar(10) NOT NULL,
  `dee_nombre` varchar(255) DEFAULT NULL,
  `dee_documento` varchar(255) DEFAULT NULL,
  `dee_vencimiento` date DEFAULT NULL,
  `dee_estado` enum('Pendiente','Rechazado','Aprobado','Vencido') DEFAULT NULL,
  KEY `fk_trd_desecon_docEntregada_trd_desecon_docRequerida1_idx` (`dee_documentacion`),
  KEY `fk_trd_desecon_docEntregada_trd_desecon_emprendimientos1_idx` (`dee_emprendedor`),
  CONSTRAINT `fk_trd_desecon_docEntregada_trd_desecon_docRequerida1` FOREIGN KEY (`dee_documentacion`) REFERENCES `trd_desecon_docrequerida` (`ded_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trd_desecon_docEntregada_trd_desecon_emprendimientos1` FOREIGN KEY (`dee_emprendedor`) REFERENCES `trd_desecon_emprendimientos` (`dee_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_docentregada`
--

LOCK TABLES `trd_desecon_docentregada` WRITE;
/*!40000 ALTER TABLE `trd_desecon_docentregada` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_docentregada` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_docrequerida`
--

DROP TABLE IF EXISTS `trd_desecon_docrequerida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_docrequerida` (
  `ded_id` int(11) NOT NULL,
  `ded_nombre` varchar(45) DEFAULT NULL,
  `ded_obligatorio` tinyblob DEFAULT NULL,
  `ded_rubro` int(11) NOT NULL,
  `ded_creacion` datetime DEFAULT NULL,
  `ded_borrado` int(11) DEFAULT NULL,
  PRIMARY KEY (`ded_id`),
  KEY `fk_trd_desecon_docRequerida_trd_desecon_rubro1_idx` (`ded_rubro`),
  CONSTRAINT `fk_trd_desecon_docRequerida_trd_desecon_rubro1` FOREIGN KEY (`ded_rubro`) REFERENCES `trd_desecon_rubro` (`rub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_docrequerida`
--

LOCK TABLES `trd_desecon_docrequerida` WRITE;
/*!40000 ALTER TABLE `trd_desecon_docrequerida` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_docrequerida` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_emprendimientos`
--

DROP TABLE IF EXISTS `trd_desecon_emprendimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_emprendimientos` (
  `dee_rut` varchar(10) NOT NULL,
  `dee_razon_social` varchar(255) DEFAULT NULL,
  `dee_fantasia` varchar(100) DEFAULT NULL,
  `dee_descripcion` text DEFAULT 0,
  `dee_img_portada` varchar(255) DEFAULT NULL,
  `dee_img_logo` varchar(255) DEFAULT NULL,
  `dee_rubro` int(11) NOT NULL,
  `dee_direccion` varchar(255) DEFAULT NULL COMMENT 'Dirección Tributaria',
  `dee_lat` float DEFAULT NULL,
  `dee_lon` float DEFAULT NULL,
  `dee_estado` enum('Por Validar','Activo','Suspendido','Inactivo') DEFAULT 'Por Validar',
  `dee_creacion` datetime DEFAULT current_timestamp(),
  `dee_borrado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`dee_rut`),
  KEY `fk_trd_desecon_emprendimientos_trd_desecon_rubro_idx` (`dee_rubro`),
  CONSTRAINT `fk_trd_desecon_emprendimientos_trd_desecon_rubro` FOREIGN KEY (`dee_rubro`) REFERENCES `trd_desecon_rubro` (`rub_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_emprendimientos`
--

LOCK TABLES `trd_desecon_emprendimientos` WRITE;
/*!40000 ALTER TABLE `trd_desecon_emprendimientos` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_emprendimientos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_espacios`
--

DROP TABLE IF EXISTS `trd_desecon_espacios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_espacios` (
  `des_id` int(11) NOT NULL AUTO_INCREMENT,
  `des_nombre` varchar(200) NOT NULL,
  `des_direccion` varchar(255) DEFAULT NULL,
  `des_lat` float DEFAULT NULL,
  `det_lon` float DEFAULT NULL,
  `des_tipo` enum('Sala','Plaza','Parque','Auditorio') DEFAULT 'Sala',
  `des_equipamiento` text DEFAULT NULL,
  `des_estado_actual` enum('Disponible','Reservado','Ocupado','Mantenimiento') DEFAULT 'Disponible',
  `des_es_reservable` tinyint(4) DEFAULT 1,
  `des_creacion` datetime DEFAULT current_timestamp(),
  `des_borrado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`des_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_espacios`
--

LOCK TABLES `trd_desecon_espacios` WRITE;
/*!40000 ALTER TABLE `trd_desecon_espacios` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_espacios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_fiscalizacion`
--

DROP TABLE IF EXISTS `trd_desecon_fiscalizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_fiscalizacion` (
  `def_id` int(11) NOT NULL AUTO_INCREMENT,
  `def_postulacion` int(11) NOT NULL,
  `def_funcionario_id` int(11) NOT NULL,
  `def_creacion` datetime DEFAULT current_timestamp(),
  `def_borrado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`def_id`),
  KEY `trd_desecon_fiscalizacion_trd_desecon_postulaciones_FK` (`def_postulacion`),
  CONSTRAINT `trd_desecon_fiscalizacion_trd_desecon_postulaciones_FK` FOREIGN KEY (`def_postulacion`) REFERENCES `trd_desecon_postulaciones` (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_fiscalizacion`
--

LOCK TABLES `trd_desecon_fiscalizacion` WRITE;
/*!40000 ALTER TABLE `trd_desecon_fiscalizacion` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_fiscalizacion` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_hojavida`
--

DROP TABLE IF EXISTS `trd_desecon_hojavida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_hojavida` (
  `deh_id` int(11) NOT NULL AUTO_INCREMENT,
  `deh_rut` varchar(10) NOT NULL,
  `deh_accion` enum('Observacion','Felicitación','Sanción') DEFAULT NULL,
  `deh_descripcion` text DEFAULT NULL,
  `deh_creacion` datetime DEFAULT NULL,
  `deh_borrado` int(11) DEFAULT NULL,
  PRIMARY KEY (`deh_id`),
  KEY `fk_trd_desecon_puntaje_trd_desecon_emprendimientos1_idx` (`deh_rut`),
  CONSTRAINT `fk_trd_desecon_puntaje_trd_desecon_emprendimientos10` FOREIGN KEY (`deh_rut`) REFERENCES `trd_desecon_emprendimientos` (`dee_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_hojavida`
--

LOCK TABLES `trd_desecon_hojavida` WRITE;
/*!40000 ALTER TABLE `trd_desecon_hojavida` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_hojavida` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_postulaciones`
--

DROP TABLE IF EXISTS `trd_desecon_postulaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_postulaciones` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_emprendimiento` varchar(10) NOT NULL,
  `dep_convocatoria` int(11) NOT NULL,
  `dep_estado` enum('Ingresada','En Evaluación','Aprobada','Rechazada','Finalizada') DEFAULT 'Ingresada',
  `dep_creacion` datetime DEFAULT current_timestamp(),
  `dep_borrado` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`dep_id`),
  KEY `fk_trd_desecon_postulaciones_trd_desecon_convocatorias1_idx` (`dep_convocatoria`),
  KEY `fk_trd_desecon_postulaciones_trd_desecon_emprendimientos1_idx` (`dep_emprendimiento`),
  CONSTRAINT `fk_trd_desecon_postulaciones_trd_desecon_convocatorias1` FOREIGN KEY (`dep_convocatoria`) REFERENCES `trd_desecon_convocatorias` (`dec_id`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_trd_desecon_postulaciones_trd_desecon_emprendimientos1` FOREIGN KEY (`dep_emprendimiento`) REFERENCES `trd_desecon_emprendimientos` (`dee_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_postulaciones`
--

LOCK TABLES `trd_desecon_postulaciones` WRITE;
/*!40000 ALTER TABLE `trd_desecon_postulaciones` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_postulaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_puntaje`
--

DROP TABLE IF EXISTS `trd_desecon_puntaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_puntaje` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_rut` varchar(10) NOT NULL,
  `dep_accion` enum('Cargo','Abono') DEFAULT NULL,
  `dep_motivo` varchar(45) DEFAULT NULL,
  `dep_valor` int(11) DEFAULT NULL,
  `dep_creacion` datetime DEFAULT NULL,
  `dep_borrado` int(11) DEFAULT NULL,
  PRIMARY KEY (`dep_id`),
  KEY `fk_trd_desecon_puntaje_trd_desecon_emprendimientos1_idx` (`dep_rut`),
  CONSTRAINT `fk_trd_desecon_puntaje_trd_desecon_emprendimientos1` FOREIGN KEY (`dep_rut`) REFERENCES `trd_desecon_emprendimientos` (`dee_rut`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_puntaje`
--

LOCK TABLES `trd_desecon_puntaje` WRITE;
/*!40000 ALTER TABLE `trd_desecon_puntaje` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_puntaje` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desecon_rubro`
--

DROP TABLE IF EXISTS `trd_desecon_rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desecon_rubro` (
  `rub_id` int(11) NOT NULL,
  `rub_nombre` varchar(45) DEFAULT NULL,
  `rub_creacion` datetime DEFAULT NULL,
  `rub_borrado` int(11) DEFAULT 0,
  PRIMARY KEY (`rub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desecon_rubro`
--

LOCK TABLES `trd_desecon_rubro` WRITE;
/*!40000 ALTER TABLE `trd_desecon_rubro` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desecon_rubro` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_destinos`
--

DROP TABLE IF EXISTS `trd_desve_destinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_destinos` (
  `tid_id` int(11) NOT NULL AUTO_INCREMENT,
  `tid_desve_solicitud` int(11) NOT NULL,
  `tid_destino` int(11) NOT NULL,
  `tid_responde` tinyint(1) DEFAULT NULL,
  `tid_fecha_respuesta` datetime DEFAULT NULL,
  `tid_borrado` tinyint(1) DEFAULT 0,
  `tid_creacion` datetime DEFAULT current_timestamp(),
  `tid_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tid_id`),
  KEY `ingresos_destinos` (`tid_desve_solicitud`) USING BTREE,
  KEY `trd_ingresos_destinos_trd_acceso_usuarios_FK` (`tid_destino`) USING BTREE,
  CONSTRAINT `trd_desve_destinos_trd_acceso_usuarios_FK` FOREIGN KEY (`tid_destino`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_desve_destinos_trd_desve_solicitudes_FK` FOREIGN KEY (`tid_desve_solicitud`) REFERENCES `trd_desve_solicitudes` (`sol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_destinos`
--

LOCK TABLES `trd_desve_destinos` WRITE;
/*!40000 ALTER TABLE `trd_desve_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_destinos` VALUES
(1,1,34,NULL,NULL,0,'2026-03-10 08:37:56','2026-03-10 08:37:56'),
(2,2,2,NULL,NULL,1,'2026-03-10 10:47:23','2026-03-10 10:53:53'),
(3,2,2,NULL,NULL,1,'2026-03-10 10:53:53','2026-03-10 10:57:57'),
(4,2,2,NULL,NULL,1,'2026-03-10 10:57:57','2026-03-10 10:58:39'),
(5,2,2,NULL,NULL,1,'2026-03-10 10:58:39','2026-03-10 11:03:25'),
(6,2,2,NULL,NULL,1,'2026-03-10 11:03:25','2026-03-10 11:04:21'),
(7,2,2,NULL,NULL,1,'2026-03-10 11:04:21','2026-03-10 11:11:23'),
(8,2,2,NULL,NULL,1,'2026-03-10 11:11:23','2026-03-10 11:19:03'),
(9,2,2,NULL,NULL,1,'2026-03-10 11:19:03','2026-03-10 11:30:38'),
(10,2,2,NULL,NULL,1,'2026-03-10 11:30:38','2026-03-10 11:37:46'),
(11,2,2,NULL,NULL,0,'2026-03-10 11:37:46','2026-03-10 11:37:46'),
(12,3,3,NULL,NULL,0,'2026-03-10 13:06:38','2026-03-10 13:06:38'),
(13,4,2,NULL,NULL,0,'2026-03-10 13:33:46','2026-03-10 13:33:46'),
(14,5,1,NULL,NULL,0,'2026-03-10 13:40:06','2026-03-10 13:40:06'),
(15,6,3,NULL,NULL,0,'2026-03-10 16:00:08','2026-03-10 16:00:08');
/*!40000 ALTER TABLE `trd_desve_destinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_organizaciones`
--

DROP TABLE IF EXISTS `trd_desve_organizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_organizaciones` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_nombre` varchar(255) DEFAULT NULL,
  `org_tipo_id` int(11) DEFAULT NULL,
  `org_direccion` varchar(255) DEFAULT NULL,
  `org_latitud` decimal(10,8) DEFAULT NULL,
  `org_longitud` decimal(11,8) DEFAULT NULL,
  `org_borrado` tinyint(1) DEFAULT 0,
  `org_creacion` datetime DEFAULT current_timestamp(),
  `org_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `org_direccion_completa` text DEFAULT NULL,
  PRIMARY KEY (`org_id`),
  KEY `org_tipo_id` (`org_tipo_id`),
  CONSTRAINT `fk_desve_org_tipo` FOREIGN KEY (`org_tipo_id`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_organizaciones`
--

LOCK TABLES `trd_desve_organizaciones` WRITE;
/*!40000 ALTER TABLE `trd_desve_organizaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_organizaciones` VALUES
(1,'Antonella Pecchenino Lobos',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(2,'Nancy Díaz Soto',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(3,'Carlos Williams Arriola',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(4,'Sandro Puebla Veas',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(5,'Nicolás López Pimentel',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(6,'Alejandro Aguilera Moya',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(7,'José Bartolucci Schapacasse',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(8,'Antonia Scarella Chamy',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(9,'Andrés Solar Miranda',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(10,'Francisco Mejías Díaz',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(11,'Ley De Tansparencia',5,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(12,'Contraloria General',6,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(13,'Congreso Nacional',7,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09',NULL),
(21,'CALAFATe',3,NULL,NULL,NULL,1,'2026-01-22 13:13:45','2026-01-22 13:14:04',NULL),
(22,'pruebaingresoorigenespecial',4,NULL,NULL,NULL,0,'2026-01-28 14:44:48','2026-01-28 14:44:48',NULL),
(23,'Juan Perez',4,NULL,NULL,NULL,0,'2026-02-03 10:28:36','2026-02-03 10:28:36',NULL);
/*!40000 ALTER TABLE `trd_desve_organizaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_prioridades`
--

DROP TABLE IF EXISTS `trd_desve_prioridades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_prioridades` (
  `pri_id` int(11) NOT NULL,
  `pri_nombre` varchar(50) DEFAULT NULL,
  `pri_tiempo_establecido` int(11) DEFAULT NULL,
  `pri_estado` tinyint(1) DEFAULT 1,
  `pri_borrado` tinyint(1) DEFAULT 0,
  `pri_creacion` datetime DEFAULT current_timestamp(),
  `pri_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_prioridades`
--

LOCK TABLES `trd_desve_prioridades` WRITE;
/*!40000 ALTER TABLE `trd_desve_prioridades` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_prioridades` VALUES
(1,'Alta',3,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,'Media',8,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'Baja',10,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
/*!40000 ALTER TABLE `trd_desve_prioridades` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_respuestas`
--

DROP TABLE IF EXISTS `trd_desve_respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_respuestas` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_solicitud_id` int(11) DEFAULT NULL,
  `res_texto` text DEFAULT NULL,
  `res_fecha` datetime DEFAULT current_timestamp(),
  `res_borrado` tinyint(1) DEFAULT 0,
  `res_creacion` datetime DEFAULT current_timestamp(),
  `res_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `res_tipo` varchar(100) DEFAULT 'Comentario',
  `res_funcionaio` int(11) NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `res_solicitud_id` (`res_solicitud_id`),
  CONSTRAINT `1_res` FOREIGN KEY (`res_solicitud_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desve_respuestas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_solicitudes`
--

DROP TABLE IF EXISTS `trd_desve_solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_solicitudes` (
  `sol_id` int(11) NOT NULL AUTO_INCREMENT,
  `sol_ingreso_desve` varchar(50) DEFAULT NULL,
  `sol_nombre_expediente` varchar(255) DEFAULT NULL,
  `sol_origen_id` int(11) DEFAULT NULL,
  `sol_origen_texto` text DEFAULT NULL,
  `sol_detalle` text DEFAULT NULL,
  `sol_fecha_recepcion` datetime DEFAULT NULL,
  `sol_prioridad_id` int(11) DEFAULT NULL,
  `sol_funcionario_id` int(11) DEFAULT NULL,
  `sol_sector_id` int(11) DEFAULT NULL,
  `sol_fecha_vencimiento` datetime DEFAULT NULL,
  `sol_entrego_coordinador` tinyint(1) DEFAULT 0,
  `sol_fecha_respuesta_coordinador` datetime DEFAULT NULL,
  `sol_estado_entrega` tinyint(1) DEFAULT 0,
  `sol_dias_vencimiento` int(11) DEFAULT NULL,
  `sol_observaciones` text DEFAULT NULL,
  `sol_dias_transcurridos` int(11) DEFAULT NULL,
  `sol_reingreso_id` int(11) DEFAULT NULL,
  `sol_direccion` varchar(255) DEFAULT NULL,
  `sol_latitud` decimal(10,8) DEFAULT NULL,
  `sol_longitud` decimal(11,8) DEFAULT NULL,
  `sol_borrado` tinyint(1) DEFAULT 0,
  `sol_creacion` datetime DEFAULT current_timestamp(),
  `sol_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sol_propietario` int(11) NOT NULL,
  `sol_registro_tramite` int(11) NOT NULL,
  `sol_origen_esp` tinyint(1) NOT NULL DEFAULT 0,
  `sol_direccion_completa` text DEFAULT NULL,
  PRIMARY KEY (`sol_id`),
  KEY `sol_origen_id` (`sol_origen_id`),
  KEY `sol_prioridad_id` (`sol_prioridad_id`),
  KEY `sol_sector_id` (`sol_sector_id`),
  KEY `sol_reingreso_id` (`sol_reingreso_id`),
  KEY `6` (`sol_registro_tramite`),
  KEY `3` (`sol_funcionario_id`),
  CONSTRAINT `2` FOREIGN KEY (`sol_prioridad_id`) REFERENCES `trd_desve_prioridades` (`pri_id`),
  CONSTRAINT `3` FOREIGN KEY (`sol_funcionario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `4` FOREIGN KEY (`sol_sector_id`) REFERENCES `trd_general_sectores` (`sec_id`),
  CONSTRAINT `5` FOREIGN KEY (`sol_reingreso_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`),
  CONSTRAINT `6` FOREIGN KEY (`sol_registro_tramite`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(1,'1','revisar documento',1,'','test 123','2026-03-10 00:00:00',2,NULL,14,'2026-03-19 00:00:00',0,NULL,0,NULL,'',NULL,NULL,'las magnolias 38, 2551470, viña del mar',-33.01044300,-71.50243100,0,'2026-03-10 08:37:56','2026-03-10 08:37:56',3,4,0,'las magnolias 38, 2551470, viña del mar'),
(2,'sdf','id encriptado 001',8,'','detalle 2 nuevo','2026-03-10 00:00:00',1,NULL,15,'2026-03-12 00:00:00',0,NULL,1,NULL,'comentario nuevo',NULL,1,'',-33.02404400,-71.55086300,0,'2026-03-10 10:47:23','2026-03-10 11:37:46',1,5,2,''),
(3,'111','ramon',3,'ASDDF','prueba ramon','2026-03-10 00:00:00',1,NULL,15,'2026-03-12 00:00:00',0,NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 13:06:38','2026-03-10 13:06:38',3,6,0,NULL),
(4,'999','ramon a territorial',5,'TERRITOIAL','organizacion territorial \nterritorial\n10-3-26\nreñaca alto\n999','2026-03-10 00:00:00',1,NULL,14,'2026-03-12 00:00:00',0,NULL,0,NULL,'',NULL,NULL,'las magnolias 38, 2551470',-33.01044300,-71.50243100,0,'2026-03-10 13:33:46','2026-03-10 13:33:46',3,7,0,'las magnolias 38, 2551470'),
(5,'888','ramon 2',4,'FUNCIONAL','funciona tiene màs tiempo que territorial, donde lo ngreso?','2026-03-10 00:00:00',2,NULL,14,'2026-03-19 00:00:00',0,NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 13:40:06','2026-03-10 13:40:06',3,8,0,NULL),
(6,'223','me pidieron que cargue',2,'RAMON ANDRES MARTINEZ VILLANUEVA','ramon me pidio que le cargue un desve','2026-03-10 00:00:00',1,NULL,13,'2026-03-12 00:00:00',0,NULL,0,NULL,'comentario',NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 16:00:08','2026-03-10 16:10:24',1,9,1,NULL);
/*!40000 ALTER TABLE `trd_desve_solicitudes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_acceso`
--

DROP TABLE IF EXISTS `trd_documentos_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_acceso` (
  `tda_id` int(11) NOT NULL AUTO_INCREMENT,
  `tda_capeta` int(11) NOT NULL,
  `tda_usuario` int(11) NOT NULL,
  `tda_permisos` tinyint(4) NOT NULL,
  `tda_requisito` tinyint(4) DEFAULT NULL,
  `tda_estado` varchar(100) NOT NULL,
  `tda_borrado` tinyint(1) DEFAULT 0,
  `tda_creacion` datetime DEFAULT current_timestamp(),
  `tda_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_acceso`
--

LOCK TABLES `trd_documentos_acceso` WRITE;
/*!40000 ALTER TABLE `trd_documentos_acceso` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_acceso` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_carpeta`
--

DROP TABLE IF EXISTS `trd_documentos_carpeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_carpeta` (
  `tdc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tdc_titulo` varchar(100) DEFAULT NULL,
  `tdc_doc_pincipal` int(11) NOT NULL,
  `tdc_estado` varchar(100) NOT NULL DEFAULT 'Ingresado',
  `tdc_responsable` int(11) DEFAULT NULL,
  `tdc_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tdc_registro_tramite` int(11) DEFAULT NULL,
  `tdc_fecha_limite` date NOT NULL,
  `tdc_borrado` tinyint(1) DEFAULT 0,
  `tdc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tdc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_carpeta`
--

LOCK TABLES `trd_documentos_carpeta` WRITE;
/*!40000 ALTER TABLE `trd_documentos_carpeta` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_carpeta` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_flujo`
--

DROP TABLE IF EXISTS `trd_documentos_flujo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_flujo` (
  `tdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `tdf_carpeta` int(11) NOT NULL,
  `tdf_acceso` int(11) NOT NULL,
  `tdf_turno` int(11) NOT NULL,
  `tdf_iteracion` int(11) NOT NULL,
  `tdf_estado` varchar(100) NOT NULL,
  `tdf_borrado` tinyint(1) DEFAULT 0,
  `tdf_creacion` datetime DEFAULT current_timestamp(),
  `tdf_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tdf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_flujo`
--

LOCK TABLES `trd_documentos_flujo` WRITE;
/*!40000 ALTER TABLE `trd_documentos_flujo` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_flujo` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_formvalue`
--

DROP TABLE IF EXISTS `trd_documentos_formvalue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_formvalue` (
  `tdfv_id` int(11) NOT NULL AUTO_INCREMENT,
  `tdfv_ttdd` int(11) NOT NULL,
  `tdfv_doc` int(11) NOT NULL,
  `tdfv_borrado` tinyint(1) DEFAULT 0,
  `tdfv_creacion` datetime DEFAULT current_timestamp(),
  `tdfv_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tdfv_id`),
  KEY `trd_documentos_formvalue_trd_general_documento_adjunto_FK` (`tdfv_doc`),
  KEY `trd_documentos_formvalue__descipcion_FK` (`tdfv_ttdd`),
  CONSTRAINT `trd_documentos_formvalue__descipcion_FK` FOREIGN KEY (`tdfv_ttdd`) REFERENCES `trd_documentos_tipo_documento_descipcion` (`ttdd_id`),
  CONSTRAINT `trd_documentos_formvalue_trd_general_documento_adjunto_FK` FOREIGN KEY (`tdfv_doc`) REFERENCES `trd_general_documento_adjunto` (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_formvalue`
--

LOCK TABLES `trd_documentos_formvalue` WRITE;
/*!40000 ALTER TABLE `trd_documentos_formvalue` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_formvalue` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_metadata`
--

DROP TABLE IF EXISTS `trd_documentos_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_metadata` (
  `tdm_id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `tdm_documento` int(11) NOT NULL,
  `tdm_dato` varchar(100) NOT NULL,
  `tdm_valor` varchar(100) NOT NULL,
  `tdm_borrado` tinyint(1) DEFAULT 0,
  `tdm_creacion` datetime DEFAULT current_timestamp(),
  `tdm_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tdm_id_meta`),
  KEY `trd_documentos_metadata_versiones_FK` (`tdm_documento`),
  CONSTRAINT `trd_documentos_metadata_versiones_FK` FOREIGN KEY (`tdm_documento`) REFERENCES `trd_general_documento_adjunto_versiones` (`docv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_metadata`
--

LOCK TABLES `trd_documentos_metadata` WRITE;
/*!40000 ALTER TABLE `trd_documentos_metadata` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_documentos_metadata` VALUES
(1,1,'Tamaño','1012736',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(2,1,'Tipo MIME','application/CDFV2',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(3,1,'Extensión','xls',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(4,1,'Hash SHA256','3ea6def89068d924ac0ad022c9a56c6f78d1c3f51851f0ce88f667e82bf6cbbb',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(5,1,'Sistema Origen','GesDoc',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(6,1,'Fecha Subida','2026-03-09 21:15:39',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(7,1,'Usuario','3',0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(8,2,'Tamaño','215813',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(9,2,'Tipo MIME','application/pdf',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(10,2,'Extensión','pdf',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(11,2,'Hash SHA256','be72a5a0bce64e17c4af7589e9dc64aa20175f4494b947ad078757be2ce4b26d',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(12,2,'Sistema Origen','GesDoc',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(13,2,'Fecha Subida','2026-03-10 21:40:01',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(14,2,'Usuario','1',0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(15,3,'Tamaño','156281',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(16,3,'Tipo MIME','application/pdf',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(17,3,'Extensión','pdf',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(18,3,'Hash SHA256','3f5cd3537096bcac2378a1ca400ca1aeb699479769f0712d81d04b26e49c6add',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(19,3,'Sistema Origen','GesDoc',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(20,3,'Fecha Subida','2026-03-11 15:59:36',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(21,3,'Usuario','3',0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(22,4,'Tamaño','215813',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(23,4,'Tipo MIME','application/pdf',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(24,4,'Extensión','pdf',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(25,4,'Hash SHA256','be72a5a0bce64e17c4af7589e9dc64aa20175f4494b947ad078757be2ce4b26d',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(26,4,'Sistema Origen','GesDoc',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(27,4,'Fecha Subida','2026-03-11 18:15:23',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(28,4,'Usuario','3',0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(29,5,'Tamaño','156281',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(30,5,'Tipo MIME','application/pdf',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(31,5,'Extensión','pdf',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(32,5,'Hash SHA256','3f5cd3537096bcac2378a1ca400ca1aeb699479769f0712d81d04b26e49c6add',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(33,5,'Sistema Origen','GesDoc',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(34,5,'Fecha Subida','2026-03-11 18:18:07',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(35,5,'Usuario','2',0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(36,6,'Tamaño','215813',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(37,6,'Tipo MIME','application/pdf',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(38,6,'Extensión','pdf',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(39,6,'Hash SHA256','be72a5a0bce64e17c4af7589e9dc64aa20175f4494b947ad078757be2ce4b26d',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(40,6,'Sistema Origen','GesDoc',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(41,6,'Fecha Subida','2026-03-11 22:10:46',0,'2026-03-11 18:10:46','2026-03-11 18:10:46'),
(42,6,'Usuario','1',0,'2026-03-11 18:10:46','2026-03-11 18:10:46');
/*!40000 ALTER TABLE `trd_documentos_metadata` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_tipo_documento`
--

DROP TABLE IF EXISTS `trd_documentos_tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_tipo_documento` (
  `ttd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttd_nombre` varchar(100) NOT NULL,
  `ttd_area` varchar(100) DEFAULT NULL,
  `ttd_formato` text NOT NULL,
  `ttd_borrado` tinyint(1) DEFAULT 0,
  `ttd_creacion` datetime DEFAULT current_timestamp(),
  `ttd_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ttd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_tipo_documento`
--

LOCK TABLES `trd_documentos_tipo_documento` WRITE;
/*!40000 ALTER TABLE `trd_documentos_tipo_documento` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_documentos_tipo_documento_descipcion`
--

DROP TABLE IF EXISTS `trd_documentos_tipo_documento_descipcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_documentos_tipo_documento_descipcion` (
  `ttdd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttdd_ttd` int(11) NOT NULL,
  `ttdd_nombre` varchar(100) NOT NULL,
  `ttdd_tipo` varchar(100) DEFAULT NULL,
  `ttdd_obligatorio` tinyint(4) DEFAULT 0,
  `ttdd_borrado` tinyint(1) DEFAULT 0,
  `ttdd_creacion` datetime DEFAULT current_timestamp(),
  `ttdd_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ttdd_id`),
  KEY `trd_documentos_tipo_documento_descipcion_FK` (`ttdd_ttd`),
  CONSTRAINT `trd_documentos_tipo_documento_descipcion_FK` FOREIGN KEY (`ttdd_ttd`) REFERENCES `trd_documentos_tipo_documento` (`ttd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_tipo_documento_descipcion`
--

LOCK TABLES `trd_documentos_tipo_documento_descipcion` WRITE;
/*!40000 ALTER TABLE `trd_documentos_tipo_documento_descipcion` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_documentos_tipo_documento_descipcion` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_areas`
--

DROP TABLE IF EXISTS `trd_general_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_areas` (
  `tga_id` int(11) NOT NULL AUTO_INCREMENT,
  `tga_codigo_area` varchar(100) NOT NULL,
  `tga_nombre` varchar(100) NOT NULL,
  `tga_borrado` tinyint(1) DEFAULT 0,
  `tga_creacion` datetime DEFAULT current_timestamp(),
  `tga_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_areas`
--

LOCK TABLES `trd_general_areas` WRITE;
/*!40000 ALTER TABLE `trd_general_areas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_areas` VALUES
(1,'trdig','transformacion digital',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'OIRS','oficina de Informaciones reclamos y sugerencias',0,'2026-02-19 19:44:53','2026-03-09 16:45:27'),
(3,'desve','desarollo vecinal',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,'ingr','ingresos',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,'CIU','CIU',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(6,'DIDECO','DIDECO',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(7,'DIUP','DIUP',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(8,'PYJ','PARQUES Y JARDINES',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(9,'MA','MEDIO AMBIENTE',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(10,'ASEO','ASEO',0,'2026-03-09 13:24:33','2026-03-09 13:24:33'),
(11,'TRANS','TRANSITO',0,'2026-03-09 13:24:33','2026-03-09 13:24:33');
/*!40000 ALTER TABLE `trd_general_areas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_areas_usuarios`
--

DROP TABLE IF EXISTS `trd_general_areas_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_areas_usuarios` (
  `tau_id` int(11) NOT NULL AUTO_INCREMENT,
  `tau_usuario_id` int(11) NOT NULL,
  `tau_area_id` int(11) NOT NULL,
  `tau_borrado` tinyint(1) DEFAULT 0,
  `tau_creacion` datetime DEFAULT current_timestamp(),
  `tau_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tau_id`),
  KEY `trd_general_areas_usuarios_trd_acceso_usuarios_FK` (`tau_usuario_id`) USING BTREE,
  KEY `trd_general_areas_usuarios_trd_general_areas_FK` (`tau_area_id`) USING BTREE,
  CONSTRAINT `trd_general_areas_usuarios_trd_acceso_usuarios_FK` FOREIGN KEY (`tau_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_areas_usuarios_trd_general_areas_FK` FOREIGN KEY (`tau_area_id`) REFERENCES `trd_general_areas` (`tga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_areas_usuarios`
--

LOCK TABLES `trd_general_areas_usuarios` WRITE;
/*!40000 ALTER TABLE `trd_general_areas_usuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_areas_usuarios` VALUES
(1,1,1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,2,1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,3,1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,4,1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,6,4,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(7,7,4,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(8,8,4,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(9,9,3,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(10,10,3,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(11,11,3,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(12,12,3,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(13,13,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(14,14,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(15,15,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(16,16,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(17,17,5,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(18,18,5,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(19,19,5,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(20,20,6,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(21,21,6,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(22,22,7,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(23,23,7,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(24,24,7,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(25,25,7,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(26,26,8,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(27,27,8,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(28,28,8,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(29,29,9,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(30,30,9,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(31,31,9,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(32,32,9,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(33,33,9,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(34,34,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(35,35,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(36,36,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(37,37,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(38,38,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(39,39,10,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(40,40,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(41,41,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(42,42,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(43,43,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(44,44,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41'),
(45,45,11,0,'2026-03-09 13:32:41','2026-03-09 13:32:41');
/*!40000 ALTER TABLE `trd_general_areas_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_bitacora`
--

DROP TABLE IF EXISTS `trd_general_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_bitacora` (
  `bit_id` int(11) NOT NULL AUTO_INCREMENT,
  `bit_tramite_registrado` int(11) NOT NULL,
  `bit_evento` text NOT NULL,
  `bit_responsable` int(11) NOT NULL,
  `bit_creacion` datetime NOT NULL,
  `bit_borrado` tinyint(1) DEFAULT 0,
  `bit_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`bit_id`),
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`bit_tramite_registrado`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`bit_responsable`),
  CONSTRAINT `trd_general_bitacora_trd_acceso_usuarios_FK` FOREIGN KEY (`bit_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_bitacora_trd_general_registro_general_tramites_FK` FOREIGN KEY (`bit_tramite_registrado`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(1,1,'Ingresa solicitud OIRS',1,'2026-03-09 12:08:18',0,'2026-03-09 12:08:18'),
(2,1,'Ingresa gestión OIRS (Respuesta inmediata)',1,'2026-03-09 12:08:18',0,'2026-03-09 12:08:18'),
(3,2,'Ingresa solicitud Ingresos',1,'2026-03-09 13:10:18',0,'2026-03-09 13:10:18'),
(4,2,'Consulta detalles de solicitud',1,'2026-03-09 13:10:26',0,'2026-03-09 13:10:26'),
(5,2,'Consulta detalles de solicitud',1,'2026-03-09 13:10:50',0,'2026-03-09 13:10:50'),
(6,3,'Ingresa solicitud OIRS',2,'2026-03-09 13:11:01',0,'2026-03-09 13:11:01'),
(7,3,'Ingresa respuesta preliminar OIRS',2,'2026-03-09 13:14:23',0,'2026-03-09 13:14:23'),
(8,3,'Ingresa respuesta técnica OIRS',2,'2026-03-09 13:16:35',0,'2026-03-09 13:16:35'),
(9,3,'Ingresa respuesta preliminar OIRS',2,'2026-03-09 13:17:14',0,'2026-03-09 13:17:14'),
(10,3,'Ingresa respuesta técnica OIRS',2,'2026-03-09 13:17:14',0,'2026-03-09 13:17:14'),
(11,3,'Notificación de ejecución OIRS enviada',2,'2026-03-09 13:17:14',0,'2026-03-09 13:17:14'),
(12,3,'Ingresa respuesta a aclaratoria',2,'2026-03-09 13:17:14',0,'2026-03-09 13:17:14'),
(13,3,'Asignación de OIRS (Funcionario ID: 1)',2,'2026-03-09 13:22:50',0,'2026-03-09 13:22:50'),
(14,3,'Asignación de OIRS (Funcionario ID: 3)',2,'2026-03-09 13:23:40',0,'2026-03-09 13:23:40'),
(15,2,'Consulta detalles de solicitud',1,'2026-03-09 15:06:44',0,'2026-03-09 15:06:44'),
(16,2,'Consulta detalles de solicitud',1,'2026-03-09 15:33:01',0,'2026-03-09 15:33:01'),
(17,2,'Consulta detalles de solicitud',1,'2026-03-09 15:34:20',0,'2026-03-09 15:34:20'),
(18,2,'Consulta detalles de solicitud',1,'2026-03-09 15:48:33',0,'2026-03-09 15:48:33'),
(19,2,'Consulta detalles de solicitud',1,'2026-03-09 15:52:39',0,'2026-03-09 15:52:39'),
(20,2,'Consulta detalles de solicitud',1,'2026-03-09 15:59:17',0,'2026-03-09 15:59:17'),
(22,3,'Carga de documento Interno: linfingre.xls',3,'2026-03-09 17:15:39',0,'2026-03-09 17:15:39'),
(23,3,'Asignación de OIRS (Funcionario ID: 21)',2,'2026-03-09 17:33:28',0,'2026-03-09 17:33:28'),
(24,3,'Asignación de OIRS (Funcionario ID: 1)',3,'2026-03-10 08:33:59',0,'2026-03-10 08:33:59'),
(25,4,'Ingresa solicitud: revisar documento',3,'2026-03-10 08:37:56',0,'2026-03-10 08:37:56'),
(26,4,'Consulta solicitud',3,'2026-03-10 08:38:10',0,'2026-03-10 08:38:10'),
(27,4,'Consulta solicitud',3,'2026-03-10 08:48:39',0,'2026-03-10 08:48:39'),
(28,4,'Consulta solicitud',3,'2026-03-10 08:49:31',0,'2026-03-10 08:49:31'),
(29,4,'Consulta solicitud',3,'2026-03-10 08:50:17',0,'2026-03-10 08:50:17'),
(30,4,'Consulta solicitud',3,'2026-03-10 08:50:51',0,'2026-03-10 08:50:51'),
(31,4,'Consulta solicitud',3,'2026-03-10 08:51:20',0,'2026-03-10 08:51:20'),
(32,4,'Consulta solicitud',3,'2026-03-10 08:54:35',0,'2026-03-10 08:54:35'),
(33,4,'Consulta solicitud',3,'2026-03-10 08:55:14',0,'2026-03-10 08:55:14'),
(34,4,'Consulta solicitud',3,'2026-03-10 08:57:02',0,'2026-03-10 08:57:02'),
(35,4,'Consulta solicitud',3,'2026-03-10 08:57:27',0,'2026-03-10 08:57:27'),
(36,4,'Consulta solicitud',3,'2026-03-10 08:57:52',0,'2026-03-10 08:57:52'),
(37,4,'Consulta solicitud',3,'2026-03-10 09:01:47',0,'2026-03-10 09:01:47'),
(38,4,'Consulta solicitud',3,'2026-03-10 09:02:02',0,'2026-03-10 09:02:02'),
(39,4,'Consulta solicitud',3,'2026-03-10 09:03:03',0,'2026-03-10 09:03:03'),
(40,4,'Consulta solicitud',3,'2026-03-10 09:03:09',0,'2026-03-10 09:03:09'),
(41,4,'Consulta solicitud',3,'2026-03-10 09:03:56',0,'2026-03-10 09:03:56'),
(42,4,'Consulta solicitud',3,'2026-03-10 09:05:49',0,'2026-03-10 09:05:49'),
(43,4,'Añade comentario al trámite',3,'2026-03-10 09:11:33',0,'2026-03-10 09:11:33'),
(44,4,'Consulta solicitud',3,'2026-03-10 09:11:34',0,'2026-03-10 09:11:34'),
(45,2,'Consulta detalles de solicitud',1,'2026-03-10 10:14:16',0,'2026-03-10 10:14:16'),
(46,2,'Consulta detalles de solicitud',1,'2026-03-10 10:14:22',0,'2026-03-10 10:14:22'),
(47,2,'Consulta detalles de solicitud',1,'2026-03-10 10:14:27',0,'2026-03-10 10:14:27'),
(48,2,'Añade comentario al trámite',1,'2026-03-10 10:14:36',0,'2026-03-10 10:14:36'),
(49,2,'Consulta detalles de solicitud',1,'2026-03-10 10:14:38',0,'2026-03-10 10:14:38'),
(50,2,'Consulta detalles de solicitud',1,'2026-03-10 10:14:43',0,'2026-03-10 10:14:43'),
(51,5,'Ingresa solicitud: id encriptado 001',1,'2026-03-10 10:47:23',0,'2026-03-10 10:47:23'),
(52,5,'Consulta solicitud',1,'2026-03-10 10:47:45',0,'2026-03-10 10:47:45'),
(53,5,'Consulta solicitud',1,'2026-03-10 10:47:50',0,'2026-03-10 10:47:50'),
(54,5,'Consulta solicitud',1,'2026-03-10 10:53:25',0,'2026-03-10 10:53:25'),
(55,5,'Consulta solicitud',1,'2026-03-10 10:53:39',0,'2026-03-10 10:53:39'),
(56,5,'Consulta solicitud',1,'2026-03-10 10:53:53',0,'2026-03-10 10:53:53'),
(57,5,'Consulta solicitud',1,'2026-03-10 10:53:53',0,'2026-03-10 10:53:53'),
(58,5,'Consulta solicitud',1,'2026-03-10 10:54:02',0,'2026-03-10 10:54:02'),
(59,5,'Consulta solicitud',1,'2026-03-10 10:57:53',0,'2026-03-10 10:57:53'),
(60,5,'Consulta solicitud',1,'2026-03-10 10:57:57',0,'2026-03-10 10:57:57'),
(61,5,'Consulta solicitud',1,'2026-03-10 10:57:57',0,'2026-03-10 10:57:57'),
(62,5,'Edita: Fecha de Vencimiento, Estado Entrega, Destinos',1,'2026-03-10 10:57:57',0,'2026-03-10 10:57:57'),
(63,5,'Consulta solicitud',1,'2026-03-10 10:58:05',0,'2026-03-10 10:58:05'),
(64,5,'Consulta solicitud',1,'2026-03-10 10:58:37',0,'2026-03-10 10:58:37'),
(65,5,'Consulta solicitud',1,'2026-03-10 10:58:39',0,'2026-03-10 10:58:39'),
(66,5,'Consulta solicitud',1,'2026-03-10 10:58:39',0,'2026-03-10 10:58:39'),
(67,5,'Edita: Fecha de Vencimiento, Estado Entrega, Destinos',1,'2026-03-10 10:58:39',0,'2026-03-10 10:58:39'),
(68,5,'Consulta solicitud',1,'2026-03-10 10:58:47',0,'2026-03-10 10:58:47'),
(69,5,'Consulta solicitud',1,'2026-03-10 11:00:52',0,'2026-03-10 11:00:52'),
(70,5,'Consulta solicitud',1,'2026-03-10 11:00:57',0,'2026-03-10 11:00:57'),
(71,5,'Consulta solicitud',1,'2026-03-10 11:01:01',0,'2026-03-10 11:01:01'),
(72,5,'Consulta solicitud',1,'2026-03-10 11:03:25',0,'2026-03-10 11:03:25'),
(73,5,'Consulta solicitud',1,'2026-03-10 11:03:25',0,'2026-03-10 11:03:25'),
(74,5,'Edita: Fecha de Vencimiento, Estado Entrega, Destinos',1,'2026-03-10 11:03:25',0,'2026-03-10 11:03:25'),
(75,5,'Consulta solicitud',1,'2026-03-10 11:03:35',0,'2026-03-10 11:03:35'),
(76,5,'Consulta solicitud',1,'2026-03-10 11:04:09',0,'2026-03-10 11:04:09'),
(77,5,'Consulta solicitud',1,'2026-03-10 11:04:18',0,'2026-03-10 11:04:18'),
(78,5,'Consulta solicitud',1,'2026-03-10 11:04:21',0,'2026-03-10 11:04:21'),
(79,5,'Consulta solicitud',1,'2026-03-10 11:04:21',0,'2026-03-10 11:04:21'),
(80,5,'Edita: Fecha de Vencimiento, Estado Entrega, Destinos',1,'2026-03-10 11:04:21',0,'2026-03-10 11:04:21'),
(81,5,'Consulta solicitud',1,'2026-03-10 11:04:31',0,'2026-03-10 11:04:31'),
(82,5,'Consulta solicitud',1,'2026-03-10 11:10:59',0,'2026-03-10 11:10:59'),
(83,5,'Consulta solicitud',1,'2026-03-10 11:11:11',0,'2026-03-10 11:11:11'),
(84,5,'Consulta solicitud',1,'2026-03-10 11:11:23',0,'2026-03-10 11:11:23'),
(85,5,'Consulta solicitud',1,'2026-03-10 11:11:23',0,'2026-03-10 11:11:23'),
(86,5,'Edita: Fecha de Vencimiento, Estado Entrega, Destinos',1,'2026-03-10 11:11:23',0,'2026-03-10 11:11:23'),
(87,5,'Consulta solicitud',1,'2026-03-10 11:18:54',0,'2026-03-10 11:18:54'),
(88,5,'Consulta solicitud',1,'2026-03-10 11:18:59',0,'2026-03-10 11:18:59'),
(89,5,'Consulta solicitud',1,'2026-03-10 11:19:03',0,'2026-03-10 11:19:03'),
(90,5,'Consulta solicitud',1,'2026-03-10 11:19:03',0,'2026-03-10 11:19:03'),
(91,5,'Edita: Estado Entrega',1,'2026-03-10 11:19:03',0,'2026-03-10 11:19:03'),
(92,5,'Consulta solicitud',1,'2026-03-10 11:19:19',0,'2026-03-10 11:19:19'),
(93,5,'Consulta solicitud',1,'2026-03-10 11:30:27',0,'2026-03-10 11:30:27'),
(94,5,'Consulta solicitud',1,'2026-03-10 11:30:38',0,'2026-03-10 11:30:38'),
(95,5,'Edita: N° Ingreso, Estado Entrega, Detalle',1,'2026-03-10 11:30:38',0,'2026-03-10 11:30:38'),
(96,5,'Consulta solicitud',1,'2026-03-10 11:30:46',0,'2026-03-10 11:30:46'),
(97,5,'Consulta solicitud',1,'2026-03-10 11:33:26',0,'2026-03-10 11:33:26'),
(98,5,'Consulta solicitud',1,'2026-03-10 11:34:05',0,'2026-03-10 11:34:05'),
(99,5,'Consulta solicitud',1,'2026-03-10 11:37:46',0,'2026-03-10 11:37:46'),
(100,5,'Edita: Estado Entrega de \"No\" a \"Sí\", Observaciones de \"comentario\" a \"comentario nuevo\", Detalle de \"detalle 2\" a \"detalle 2 nuevo\", ID Reingreso de \"Vacío\" a \"1\"',1,'2026-03-10 11:37:46',0,'2026-03-10 11:37:46'),
(101,5,'Consulta solicitud',1,'2026-03-10 11:37:54',0,'2026-03-10 11:37:54'),
(102,3,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-10 12:22:18',0,'2026-03-10 12:22:18'),
(103,3,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-10 12:23:38',0,'2026-03-10 12:23:38'),
(104,4,'Consulta solicitud',3,'2026-03-10 12:38:49',0,'2026-03-10 12:38:49'),
(105,4,'Consulta solicitud',3,'2026-03-10 12:39:09',0,'2026-03-10 12:39:09'),
(106,6,'Ingresa solicitud: ramon',3,'2026-03-10 13:06:38',0,'2026-03-10 13:06:38'),
(107,4,'Consulta solicitud',3,'2026-03-10 13:07:45',0,'2026-03-10 13:07:45'),
(108,6,'Consulta solicitud',3,'2026-03-10 13:08:01',0,'2026-03-10 13:08:01'),
(109,3,'Comentario en asignación OIRS',3,'2026-03-10 13:12:46',0,'2026-03-10 13:12:46'),
(110,3,'Comentario en asignación OIRS',2,'2026-03-10 13:15:06',0,'2026-03-10 13:15:06'),
(111,3,'Comentario en asignación OIRS',1,'2026-03-10 13:30:24',0,'2026-03-10 13:30:24'),
(112,7,'Ingresa solicitud: ramon a territorial',3,'2026-03-10 13:33:46',0,'2026-03-10 13:33:46'),
(113,7,'Consulta solicitud',3,'2026-03-10 13:34:19',0,'2026-03-10 13:34:19'),
(114,8,'Ingresa solicitud: ramon 2',3,'2026-03-10 13:40:06',0,'2026-03-10 13:40:06'),
(115,3,'Aprueba respuesta en asignación OIRS',2,'2026-03-10 13:46:22',0,'2026-03-10 13:46:22'),
(116,7,'Consulta solicitud',3,'2026-03-10 13:52:30',0,'2026-03-10 13:52:30'),
(117,7,'Consulta solicitud',3,'2026-03-10 13:53:07',0,'2026-03-10 13:53:07'),
(118,4,'Consulta solicitud',3,'2026-03-10 13:57:53',0,'2026-03-10 13:57:53'),
(119,4,'Consulta solicitud',3,'2026-03-10 13:58:06',0,'2026-03-10 13:58:06'),
(120,4,'Consulta solicitud',3,'2026-03-10 14:26:28',0,'2026-03-10 14:26:28'),
(121,4,'Consulta solicitud',3,'2026-03-10 14:26:36',0,'2026-03-10 14:26:36'),
(122,6,'Consulta solicitud',3,'2026-03-10 14:27:32',0,'2026-03-10 14:27:32'),
(123,4,'Consulta solicitud',3,'2026-03-10 15:25:56',0,'2026-03-10 15:25:56'),
(124,4,'Consulta solicitud',3,'2026-03-10 15:29:54',0,'2026-03-10 15:29:54'),
(125,9,'Ingresa solicitud: me pidieron que cargue',3,'2026-03-10 16:00:08',0,'2026-03-10 16:00:08'),
(126,9,'Consulta solicitud',3,'2026-03-10 16:10:58',0,'2026-03-10 16:10:58'),
(127,9,'Consulta solicitud',3,'2026-03-10 16:14:00',0,'2026-03-10 16:14:00'),
(128,9,'Consulta solicitud',1,'2026-03-10 16:48:27',0,'2026-03-10 16:48:27'),
(129,9,'Consulta solicitud',1,'2026-03-10 16:48:48',0,'2026-03-10 16:48:48'),
(130,7,'Consulta solicitud',3,'2026-03-10 16:56:21',0,'2026-03-10 16:56:21'),
(131,9,'Consulta solicitud',3,'2026-03-10 17:22:30',0,'2026-03-10 17:22:30'),
(132,9,'Consulta solicitud',3,'2026-03-10 17:23:18',0,'2026-03-10 17:23:18'),
(133,1,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-10 17:24:39',0,'2026-03-10 17:24:39'),
(134,1,'Comentario en asignación OIRS',3,'2026-03-10 17:25:06',0,'2026-03-10 17:25:06'),
(135,1,'Solicita corrección en asignación OIRS',2,'2026-03-10 17:25:24',0,'2026-03-10 17:25:24'),
(136,9,'Consulta solicitud',3,'2026-03-10 17:25:47',0,'2026-03-10 17:25:47'),
(137,9,'Consulta solicitud',3,'2026-03-10 17:27:06',0,'2026-03-10 17:27:06'),
(138,9,'Consulta solicitud',3,'2026-03-10 17:28:27',0,'2026-03-10 17:28:27'),
(139,10,'Ingresa solicitud OIRS',3,'2026-03-10 17:31:07',0,'2026-03-10 17:31:07'),
(140,10,'Ingresa respuesta preliminar OIRS',3,'2026-03-10 17:37:27',0,'2026-03-10 17:37:27'),
(141,10,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-10 17:37:56',0,'2026-03-10 17:37:56'),
(142,10,'Asignación de OIRS por Leticia meneses (Funcionario ID: 39)',2,'2026-03-10 17:38:59',0,'2026-03-10 17:38:59'),
(143,10,'Carga de documento Interno: ramon.pdf',1,'2026-03-10 17:40:01',0,'2026-03-10 17:40:01'),
(144,10,'Comentario en asignación OIRS',1,'2026-03-10 17:40:20',0,'2026-03-10 17:40:20'),
(145,10,'Aprueba respuesta en asignación OIRS',3,'2026-03-10 17:40:47',0,'2026-03-10 17:40:47'),
(146,11,'Ingresa solicitud OIRS',3,'2026-03-10 17:44:18',0,'2026-03-10 17:44:18'),
(147,11,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-10 17:47:53',0,'2026-03-10 17:47:53'),
(148,11,'Comentario en asignación OIRS',3,'2026-03-10 17:49:08',0,'2026-03-10 17:49:08'),
(149,11,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-10 17:49:23',0,'2026-03-10 17:49:23'),
(150,11,'Comentario en asignación OIRS',1,'2026-03-10 17:50:54',0,'2026-03-10 17:50:54'),
(151,11,'Aprueba respuesta en asignación OIRS',3,'2026-03-10 17:51:47',0,'2026-03-10 17:51:47'),
(152,11,'Ingresa respuesta preliminar OIRS',3,'2026-03-10 17:53:18',0,'2026-03-10 17:53:18'),
(153,12,'Ingresa solicitud OIRS',2,'2026-03-10 17:54:58',0,'2026-03-10 17:54:58'),
(154,12,'Ingresa respuesta preliminar OIRS',2,'2026-03-10 18:02:21',0,'2026-03-10 18:02:21'),
(155,13,'Ingresa solicitud OIRS',2,'2026-03-10 18:03:26',0,'2026-03-10 18:03:26'),
(156,13,'Ingresa respuesta preliminar OIRS',2,'2026-03-10 18:03:43',0,'2026-03-10 18:03:43'),
(157,2,'Consulta detalles de solicitud',2,'2026-03-10 18:08:43',0,'2026-03-10 18:08:43'),
(158,13,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-10 18:24:16',0,'2026-03-10 18:24:16'),
(159,13,'Asignación de OIRS por Leticia meneses (Funcionario ID: 39)',2,'2026-03-10 18:28:46',0,'2026-03-10 18:28:46'),
(160,13,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-10 18:35:11',0,'2026-03-10 18:35:11'),
(161,13,'Comentario en asignación OIRS',1,'2026-03-10 18:36:05',0,'2026-03-10 18:36:05'),
(162,3,'Aprueba respuesta en asignación OIRS',3,'2026-03-11 10:26:02',0,'2026-03-11 10:26:02'),
(163,14,'Ingresa solicitud OIRS',3,'2026-03-11 10:33:28',0,'2026-03-11 10:33:28'),
(164,14,'Ingresa respuesta preliminar OIRS',2,'2026-03-11 11:15:52',0,'2026-03-11 11:15:52'),
(165,14,'Carga de documento Interno: Comprobante_#OIRS-2602-4.pdf',3,'2026-03-11 11:59:36',0,'2026-03-11 11:59:36'),
(166,14,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-11 12:00:57',0,'2026-03-11 12:00:57'),
(167,14,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-11 12:02:11',0,'2026-03-11 12:02:11'),
(168,14,'Comentario en asignación OIRS',3,'2026-03-11 12:02:33',0,'2026-03-11 12:02:33'),
(169,14,'Comentario en asignación OIRS',1,'2026-03-11 12:06:12',0,'2026-03-11 12:06:12'),
(170,14,'Aprueba respuesta en asignación OIRS',3,'2026-03-11 12:06:51',0,'2026-03-11 12:06:51'),
(171,14,'Comentario en asignación OIRS',3,'2026-03-11 12:07:23',0,'2026-03-11 12:07:23'),
(172,14,'Ingresa respuesta técnica OIRS',3,'2026-03-11 12:07:48',0,'2026-03-11 12:07:48'),
(173,14,'Aprueba respuesta en asignación OIRS',2,'2026-03-11 12:08:31',0,'2026-03-11 12:08:31'),
(174,14,'Notificación de ejecución OIRS enviada',3,'2026-03-11 12:28:10',0,'2026-03-11 12:28:10'),
(175,15,'Ingresa solicitud Ingresos',3,'2026-03-11 14:15:23',0,'2026-03-11 14:15:23'),
(176,15,'Carga de documento Público: ramon.pdf',3,'2026-03-11 14:15:23',0,'2026-03-11 14:15:23'),
(177,15,'Consulta detalles de solicitud',3,'2026-03-11 14:17:05',0,'2026-03-11 14:17:05'),
(178,16,'Ingresa solicitud Ingresos',2,'2026-03-11 14:18:07',0,'2026-03-11 14:18:07'),
(179,16,'Carga de documento Público: Comprobante_#OIRS-2602-4.pdf',2,'2026-03-11 14:18:07',0,'2026-03-11 14:18:07'),
(180,15,'Consulta detalles de solicitud',3,'2026-03-11 14:23:10',0,'2026-03-11 14:23:10'),
(181,15,'Consulta detalles de solicitud',3,'2026-03-11 14:24:42',0,'2026-03-11 14:24:42'),
(182,15,'Consulta detalles de solicitud',3,'2026-03-11 14:24:59',0,'2026-03-11 14:24:59'),
(183,15,'Consulta detalles de solicitud',3,'2026-03-11 14:25:50',0,'2026-03-11 14:25:50'),
(184,15,'Consulta detalles de solicitud',3,'2026-03-11 14:26:24',0,'2026-03-11 14:26:24'),
(185,17,'Ingresa solicitud OIRS',3,'2026-03-11 14:28:10',0,'2026-03-11 14:28:10'),
(186,18,'Ingresa solicitud OIRS',3,'2026-03-11 14:30:30',0,'2026-03-11 14:30:30'),
(187,19,'Ingresa solicitud OIRS',2,'2026-03-11 14:31:50',0,'2026-03-11 14:31:50'),
(188,20,'Ingresa solicitud OIRS',3,'2026-03-11 14:34:10',0,'2026-03-11 14:34:10'),
(189,15,'Consulta detalles de solicitud',3,'2026-03-11 14:55:14',0,'2026-03-11 14:55:14'),
(190,17,'Ingresa respuesta preliminar OIRS',2,'2026-03-11 15:41:54',0,'2026-03-11 15:41:54'),
(191,17,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-11 15:42:24',0,'2026-03-11 15:42:24'),
(192,17,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-11 15:43:27',0,'2026-03-11 15:43:27'),
(193,21,'Ingresa solicitud Ingresos',3,'2026-03-11 16:11:53',0,'2026-03-11 16:11:53'),
(194,21,'Consulta detalles de solicitud',3,'2026-03-11 16:12:19',0,'2026-03-11 16:12:19'),
(195,21,'Consulta detalles de solicitud',3,'2026-03-11 16:12:29',0,'2026-03-11 16:12:29'),
(196,22,'Ingresa solicitud Ingresos',3,'2026-03-11 16:13:19',0,'2026-03-11 16:13:19'),
(197,22,'Consulta detalles de solicitud',3,'2026-03-11 16:14:16',0,'2026-03-11 16:14:16'),
(198,21,'Consulta detalles de solicitud',3,'2026-03-11 16:14:47',0,'2026-03-11 16:14:47'),
(199,22,'Consulta detalles de solicitud',3,'2026-03-11 16:15:41',0,'2026-03-11 16:15:41'),
(200,22,'Añade comentario al trámite',3,'2026-03-11 16:16:22',0,'2026-03-11 16:16:22'),
(201,22,'Consulta detalles de solicitud',3,'2026-03-11 16:16:23',0,'2026-03-11 16:16:23'),
(202,22,'Consulta detalles de solicitud',3,'2026-03-11 16:17:11',0,'2026-03-11 16:17:11'),
(203,22,'Consulta detalles de solicitud',3,'2026-03-11 16:17:17',0,'2026-03-11 16:17:17'),
(204,22,'Consulta detalles de solicitud',3,'2026-03-11 16:17:24',0,'2026-03-11 16:17:24'),
(205,22,'Consulta detalles de solicitud',3,'2026-03-11 16:17:32',0,'2026-03-11 16:17:32'),
(206,22,'Consulta detalles de solicitud',1,'2026-03-11 16:21:46',0,'2026-03-11 16:21:46'),
(207,22,'Funcionario responde a solicitud (Resuelto_Favorable)',1,'2026-03-11 16:23:11',0,'2026-03-11 16:23:11'),
(208,22,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-03-11 16:23:11',0,'2026-03-11 16:23:11'),
(209,22,'Consulta detalles de solicitud',1,'2026-03-11 16:23:13',0,'2026-03-11 16:23:13'),
(210,16,'Consulta detalles de solicitud',1,'2026-03-11 16:24:21',0,'2026-03-11 16:24:21'),
(211,21,'Consulta detalles de solicitud',3,'2026-03-11 16:25:03',0,'2026-03-11 16:25:03'),
(212,22,'Consulta detalles de solicitud',3,'2026-03-11 16:25:31',0,'2026-03-11 16:25:31'),
(213,23,'Ingresa solicitud OIRS',3,'2026-03-11 17:20:13',0,'2026-03-11 17:20:13'),
(214,23,'Ingresa respuesta preliminar OIRS',2,'2026-03-11 18:05:22',0,'2026-03-11 18:05:22'),
(215,23,'Asignación de OIRS por Leticia meneses (Funcionario ID: 3)',2,'2026-03-11 18:06:37',0,'2026-03-11 18:06:37'),
(216,23,'Asignación de OIRS por Ramon Martinez (Funcionario ID: 1)',3,'2026-03-11 18:08:01',0,'2026-03-11 18:08:01'),
(217,23,'Comentario en asignación OIRS',3,'2026-03-11 18:08:24',0,'2026-03-11 18:08:24'),
(218,23,'Carga de documento Interno: ramon.pdf',1,'2026-03-11 18:10:46',0,'2026-03-11 18:10:46'),
(219,23,'Comentario en asignación OIRS',1,'2026-03-11 18:11:01',0,'2026-03-11 18:11:01'),
(220,23,'Aprueba respuesta en asignación OIRS',3,'2026-03-11 18:12:03',0,'2026-03-11 18:12:03'),
(221,23,'Ingresa respuesta técnica OIRS',3,'2026-03-11 18:12:59',0,'2026-03-11 18:12:59'),
(222,23,'Notificación de ejecución OIRS enviada',3,'2026-03-11 18:13:37',0,'2026-03-11 18:13:37'),
(223,21,'Consulta detalles de solicitud',3,'2026-03-11 19:07:02',0,'2026-03-11 19:07:02'),
(224,15,'Consulta detalles de solicitud',2,'2026-03-12 09:39:17',0,'2026-03-12 09:39:17'),
(225,15,'Consulta detalles de solicitud',2,'2026-03-12 09:43:07',0,'2026-03-12 09:43:07'),
(226,21,'Consulta detalles de solicitud',2,'2026-03-12 09:57:22',0,'2026-03-12 09:57:22'),
(227,21,'Consulta detalles de solicitud',2,'2026-03-12 09:58:00',0,'2026-03-12 09:58:00'),
(228,21,'Funcionario responde a solicitud (Resuelto_Favorable)',2,'2026-03-12 10:03:27',0,'2026-03-12 10:03:27'),
(229,21,'Consulta detalles de solicitud',2,'2026-03-12 10:03:29',0,'2026-03-12 10:03:29'),
(230,21,'Añade comentario al trámite',2,'2026-03-12 10:06:27',0,'2026-03-12 10:06:27'),
(231,21,'Consulta detalles de solicitud',2,'2026-03-12 10:06:29',0,'2026-03-12 10:06:29'),
(232,21,'Consulta detalles de solicitud',2,'2026-03-12 10:07:47',0,'2026-03-12 10:07:47'),
(233,16,'Consulta detalles de solicitud',2,'2026-03-12 10:08:15',0,'2026-03-12 10:08:15'),
(234,15,'Consulta detalles de solicitud',2,'2026-03-12 10:08:34',0,'2026-03-12 10:08:34');
/*!40000 ALTER TABLE `trd_general_bitacora` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_cargos`
--

DROP TABLE IF EXISTS `trd_general_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_cargos` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_nombre` varchar(100) NOT NULL,
  `car_area` int(11) NOT NULL,
  `car_borrado` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`car_id`),
  KEY `fk_cargo_area` (`car_area`),
  CONSTRAINT `fk_cargo_area` FOREIGN KEY (`car_area`) REFERENCES `trd_general_areas` (`tga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_cargos`
--

LOCK TABLES `trd_general_cargos` WRITE;
/*!40000 ALTER TABLE `trd_general_cargos` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_cargos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_comentario`
--

DROP TABLE IF EXISTS `trd_general_comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_comentario` (
  `gco_id` int(11) NOT NULL AUTO_INCREMENT,
  `gco_comentador` int(11) NOT NULL,
  `gco_comentario` text DEFAULT NULL,
  `gco_documento` text DEFAULT NULL,
  `gco_tramite` int(11) NOT NULL,
  `gco_creacion` datetime NOT NULL,
  `gco_borrado` tinyint(1) DEFAULT 0,
  `gco_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`gco_id`),
  KEY `trd_geneal_comentario_trd_acceso_usuarios_FK` (`gco_comentador`),
  KEY `trd_geneal_comentario_trd_general_registro_general_tramites_FK` (`gco_tramite`),
  CONSTRAINT `trd_geneal_comentario_trd_acceso_usuarios_FK` FOREIGN KEY (`gco_comentador`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_geneal_comentario_trd_general_registro_general_tramites_FK` FOREIGN KEY (`gco_tramite`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,3,'prueba 123',NULL,4,'2026-03-10 13:11:33',0,'2026-03-10 09:11:33'),
(2,1,'todd',NULL,2,'2026-03-10 14:14:36',0,'2026-03-10 10:14:36'),
(3,3,'lo voy a ver estoy ocupado',NULL,22,'2026-03-11 20:16:22',0,'2026-03-11 16:16:22'),
(4,2,'se realiza visación sin observaciones',NULL,21,'2026-03-12 14:06:27',0,'2026-03-12 10:06:27');
/*!40000 ALTER TABLE `trd_general_comentario` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_contribuyente_direcciones`
--

DROP TABLE IF EXISTS `trd_general_contribuyente_direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_contribuyente_direcciones` (
  `tcd_id` int(11) NOT NULL AUTO_INCREMENT,
  `tcd_contribuyente` int(11) NOT NULL,
  `tcd_tipo_direccion` varchar(50) DEFAULT 'Particular',
  `tcd_calle` varchar(255) NOT NULL,
  `tcd_numero` varchar(20) DEFAULT NULL,
  `tcd_departamento` varchar(20) DEFAULT NULL,
  `tcd_casa` varchar(20) DEFAULT NULL,
  `tcd_aclaratoria` text DEFAULT NULL,
  `tcd_latitud` decimal(10,8) DEFAULT NULL,
  `tcd_longitud` decimal(11,8) DEFAULT NULL,
  `tcd_creacion` datetime DEFAULT current_timestamp(),
  `tcd_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tcd_borrado` tinyint(1) DEFAULT 0,
  `tcd_direccion_completa` text DEFAULT NULL,
  PRIMARY KEY (`tcd_id`),
  KEY `trd_cont_direcciones_trd_general_contribuyentes_FK` (`tcd_contribuyente`),
  CONSTRAINT `trd_cont_direcciones_trd_general_contribuyentes_FK` FOREIGN KEY (`tcd_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyente_direcciones`
--

LOCK TABLES `trd_general_contribuyente_direcciones` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyente_direcciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyente_direcciones` VALUES
(1,3,'OIRS','lebu 81',NULL,NULL,NULL,NULL,-33.02988040,-71.49612340,'2026-03-09 13:11:01','2026-03-09 13:11:01',0,'lebu 81'),
(2,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-10 17:31:07','2026-03-10 17:31:07',0,'las magnolias 38, 2551470'),
(3,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-10 17:44:18','2026-03-10 17:44:18',0,'las magnolias 38, 2551470'),
(4,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-10 17:54:58','2026-03-10 17:54:58',0,'las magnolias 38, 2551470'),
(5,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-10 18:03:26','2026-03-10 18:03:26',0,'las magnolias 38, 2551470'),
(6,3,'OIRS','lebu 81',NULL,NULL,NULL,NULL,-33.02988040,-71.49612340,'2026-03-11 10:33:28','2026-03-11 10:33:28',0,'lebu 81'),
(7,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-11 14:28:10','2026-03-11 14:28:10',0,'las magnolias 38, 2551470'),
(8,11,'OIRS','2 norte 162',NULL,NULL,NULL,NULL,-33.02095260,-71.55789920,'2026-03-11 14:30:30','2026-03-11 14:30:30',0,'2 norte 162'),
(9,3,'OIRS','lebu 81',NULL,NULL,NULL,NULL,-33.02988040,-71.49612340,'2026-03-11 14:31:50','2026-03-11 14:31:50',0,'lebu 81'),
(10,3,'OIRS','lebu 81',NULL,NULL,NULL,NULL,-33.02988040,-71.49612340,'2026-03-11 14:34:10','2026-03-11 14:34:10',0,'lebu 81'),
(11,2,'OIRS','las magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-11 17:20:13','2026-03-11 17:20:13',0,'las magnolias 38, 2551470');
/*!40000 ALTER TABLE `trd_general_contribuyente_direcciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_contribuyente_escolaridad`
--

DROP TABLE IF EXISTS `trd_general_contribuyente_escolaridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_contribuyente_escolaridad` (
  `esc_id` int(11) NOT NULL AUTO_INCREMENT,
  `esc_nombre` varchar(100) NOT NULL,
  `esc_borrado` tinyint(1) DEFAULT 0,
  `esc_creacion` datetime DEFAULT current_timestamp(),
  `esc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyente_escolaridad`
--

LOCK TABLES `trd_general_contribuyente_escolaridad` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyente_escolaridad` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyente_escolaridad` VALUES
(1,'Sin instrucción',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(2,'Básica Incompleta',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(3,'Básica Completa',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(4,'Media Incompleta',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(5,'Media Completa (Científico-Humanista)',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(6,'Media Completa (Técnico-Profesional)',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(7,'Superior Técnica Incompleta',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(8,'Superior Técnica Completa',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(9,'Superior Profesional Incompleta',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(10,'Superior Profesional Completa',0,'2026-02-19 19:44:52','2026-02-19 19:44:52'),
(11,'Postgrado (Magíster/Doctorado)',0,'2026-02-19 19:44:52','2026-02-19 19:44:52');
/*!40000 ALTER TABLE `trd_general_contribuyente_escolaridad` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_contribuyentes`
--

DROP TABLE IF EXISTS `trd_general_contribuyentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_contribuyentes` (
  `tgc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgc_rut` varchar(15) NOT NULL,
  `tgc_tipo` enum('natural','juridica') DEFAULT 'natural',
  `tgc_razon_social` varchar(255) DEFAULT NULL,
  `tgc_nombre_fantasia` varchar(255) DEFAULT NULL,
  `tgc_giro` text DEFAULT NULL,
  `tgc_rep_rut` varchar(15) DEFAULT NULL,
  `tgc_rep_nombre_completo` varchar(255) DEFAULT NULL,
  `tgc_nombre` varchar(100) NOT NULL,
  `tgc_apellido_paterno` varchar(100) DEFAULT NULL,
  `tgc_apellido_materno` varchar(100) NOT NULL,
  `tgc_sexo` varchar(10) DEFAULT NULL,
  `tgc_fecha_nacimiento` date DEFAULT NULL,
  `tgc_estado_civil` varchar(50) DEFAULT NULL,
  `tgc_escolaridad` int(11) DEFAULT NULL,
  `tgc_nacionalidad` varchar(50) DEFAULT NULL,
  `tgc_correo_electronico` varchar(150) DEFAULT NULL,
  `tgc_telefono_contacto` varchar(20) DEFAULT NULL,
  `tgc_clave_acceso` varchar(255) DEFAULT NULL,
  `tgc_acepta_privacidad` tinyint(1) DEFAULT 0,
  `tgc_fecha_acepta_privacidad` datetime DEFAULT NULL,
  `tgc_borrado` tinyint(1) DEFAULT 0,
  `tgc_creacion` datetime DEFAULT current_timestamp(),
  `tgc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tgc_id`),
  KEY `trd_general_contribuyentes_trd_cont_escolaridad_FK` (`tgc_escolaridad`),
  CONSTRAINT `trd_general_contribuyentes_trd_cont_escolaridad_FK` FOREIGN KEY (`tgc_escolaridad`) REFERENCES `trd_general_contribuyente_escolaridad` (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(1,'11111111-1','natural','',NULL,NULL,'','','1','1','1','Otro','1990-02-03','Divorciado/a',3,NULL,'juan.hervas@munivina.cl','+56944444444',NULL,0,NULL,0,'2026-02-19 19:44:53','2026-03-09 12:08:18'),
(2,'14037230-7','natural','',NULL,NULL,'','','ramon andres','martinez','villanueva','Masculino','1981-10-10','Casado/a',3,NULL,'rmartinezvcl@gmail.com','','$2y$10$4QNb5MaCnjdEQz3hxX40CevDUYOUpF/SwW1Y9Ulhpc3kM/RqRE612',1,'2026-03-09 15:54:30',0,'2026-02-19 19:44:53','2026-03-10 17:31:07'),
(3,'17619949-0','natural','',NULL,NULL,'','','prueba01','prueba01','prueba01','Femenino','1993-04-27','Soltero/a',10,NULL,'leticia.meneses@munivina.cl','+56999999999',NULL,0,NULL,0,'2026-02-23 10:38:48','2026-03-09 13:11:01'),
(4,'12123123-5','natural','',NULL,NULL,'',NULL,'cecilia','jara','jara','Femenino','1958-05-12','Casado/a',5,NULL,'notiene@gmail.com','+56995456123',NULL,0,NULL,0,'2026-02-26 17:12:42','2026-02-26 17:12:42'),
(5,'111111111-0','natural','',NULL,NULL,'',NULL,'prueba','prueba','prueba','Femenino','1990-03-04','Soltero/a',5,NULL,'correoprueba@gmaill.com','+56999999999',NULL,0,NULL,0,'2026-03-04 14:04:23','2026-03-04 14:04:23'),
(6,'99999999-9','natural','',NULL,NULL,'',NULL,'prueba3','prueba3','prueba3','Otro','1990-03-06','Soltero/a',5,NULL,'notienew@gmail.com','+56999999999',NULL,0,NULL,0,'2026-03-06 10:00:42','2026-03-06 10:00:42'),
(7,'17619949-0','natural','',NULL,NULL,'',NULL,'LEticia','Meneses','astorga','Femenino','1993-04-27','Soltero/a',10,NULL,'notiene@gmail.com','+56999999999',NULL,0,NULL,0,'2026-03-06 11:29:09','2026-03-06 11:29:09'),
(8,'11111111-1','natural','',NULL,NULL,'',NULL,'prueba07','prueba07','prueba07','Otro','1995-03-06','Casado/a',10,NULL,'notine@gmail.com','+56955555555',NULL,0,NULL,0,'2026-03-06 11:41:57','2026-03-06 11:41:57'),
(9,'12456789-5','natural','',NULL,NULL,'',NULL,'PRUEBA08','PRUEBA08','PRUEBA08','Masculino','1998-03-06','Soltero/a',11,NULL,'NOTIENE@GMAIL.COM','+56999999999',NULL,0,NULL,0,'2026-03-06 12:01:57','2026-03-06 12:01:57'),
(10,'14.711.939-9','natural',NULL,NULL,NULL,NULL,NULL,'Juan Francisco','Hervas','Farrú',NULL,NULL,NULL,NULL,NULL,'juan.hervas@munivina.cl','+56963008443',NULL,1,'2026-03-11 09:06:13',0,'2026-03-11 09:06:13','2026-03-11 09:06:13'),
(11,'156767228-2','natural','',NULL,NULL,'','','carolina','montoya','lopez','Femenino','1981-10-10','Soltero/a',2,NULL,'','',NULL,0,NULL,0,'2026-03-11 14:30:30','2026-03-11 14:30:30');
/*!40000 ALTER TABLE `trd_general_contribuyentes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_documento_adjunto`
--

DROP TABLE IF EXISTS `trd_general_documento_adjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_documento_adjunto` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_tramite_registrado` int(11) NOT NULL,
  `doc_creacion` datetime NOT NULL,
  `doc_version_actual` int(11) DEFAULT NULL,
  `doc_borrado` tinyint(1) DEFAULT 0,
  `doc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`doc_id`),
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`doc_tramite_registrado`) USING BTREE,
  KEY `trd_versiones_FK` (`doc_version_actual`),
  CONSTRAINT `trd_versiones_FK` FOREIGN KEY (`doc_version_actual`) REFERENCES `trd_general_documento_adjunto_versiones` (`docv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(1,3,'2026-03-09 17:15:39',1,0,'2026-03-09 17:15:39'),
(2,10,'2026-03-10 17:40:01',2,0,'2026-03-10 17:40:01'),
(3,14,'2026-03-11 11:59:36',3,0,'2026-03-11 11:59:36'),
(4,15,'2026-03-11 14:15:23',4,0,'2026-03-11 14:15:23'),
(5,16,'2026-03-11 14:18:07',5,0,'2026-03-11 14:18:07'),
(6,23,'2026-03-11 18:10:46',6,0,'2026-03-11 18:10:46');
/*!40000 ALTER TABLE `trd_general_documento_adjunto` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_documento_adjunto_versiones`
--

DROP TABLE IF EXISTS `trd_general_documento_adjunto_versiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_documento_adjunto_versiones` (
  `docv_id` int(11) NOT NULL AUTO_INCREMENT,
  `docv_doc_id` int(11) NOT NULL,
  `doc_fecha` datetime NOT NULL,
  `doc_enlace_documento` text NOT NULL,
  `doc_nombre_documento` varchar(100) NOT NULL,
  `docv_responsable` int(11) NOT NULL,
  `doc_docdigital` tinyint(1) NOT NULL,
  `doc_partner` varchar(100) DEFAULT NULL,
  `doc_privado` tinyint(4) NOT NULL DEFAULT 0,
  `docv_borrado` tinyint(1) DEFAULT 0,
  `docv_creacion` datetime DEFAULT current_timestamp(),
  `docv_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`docv_id`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`docv_responsable`) USING BTREE,
  KEY `trd_versiones_doc_FK` (`docv_doc_id`),
  CONSTRAINT `trd_versiones_doc_FK` FOREIGN KEY (`docv_doc_id`) REFERENCES `trd_general_documento_adjunto` (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto_versiones` VALUES
(1,1,'2026-03-09 17:15:39','gestordocumental/202603/2603092115GSMUb.imv','linfingre.xls',3,0,'202603/.ck',1,0,'2026-03-09 17:15:39','2026-03-09 17:15:39'),
(2,2,'2026-03-10 17:40:01','gestordocumental/202603/26031021406d84R.imv','ramon.pdf',1,0,'202603/.ck',1,0,'2026-03-10 17:40:01','2026-03-10 17:40:01'),
(3,3,'2026-03-11 11:59:36','gestordocumental/202603/2603111559j8kQp.imv','Comprobante_#OIRS-2602-4.pdf',3,0,'202603/.ck',1,0,'2026-03-11 11:59:36','2026-03-11 11:59:36'),
(4,4,'2026-03-11 14:15:23','gestordocumental/202603/2603111815w6NBB.imv','ramon.pdf',3,0,'202603/.ck',0,0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(5,5,'2026-03-11 14:18:07','gestordocumental/202603/2603111818VZNEL.imv','Comprobante_#OIRS-2602-4.pdf',2,0,'202603/.ck',0,0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(6,6,'2026-03-11 18:10:46','gestordocumental/202603/2603112210gWnYG.imv','ramon.pdf',1,0,'202603/.ck',1,0,'2026-03-11 18:10:46','2026-03-11 18:10:46');
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_enlaces`
--

DROP TABLE IF EXISTS `trd_general_enlaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_enlaces` (
  `tge_id` int(11) NOT NULL AUTO_INCREMENT,
  `tge_tramite` int(11) NOT NULL,
  `tge_enlace` text NOT NULL,
  `tge_responsable` int(11) NOT NULL,
  `tge_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tge_borrado` tinyint(1) DEFAULT 0,
  `tge_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tge_id`),
  KEY `trd_general_enlaces_trd_acceso_usuarios_FK` (`tge_responsable`) USING BTREE,
  KEY `trd_general_enlaces_trd_general_registro_general_tramites_FK` (`tge_tramite`) USING BTREE,
  CONSTRAINT `trd_general_enlaces_trd_acceso_usuarios_FK` FOREIGN KEY (`tge_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_enlaces_trd_general_registro_general_tramites_FK` FOREIGN KEY (`tge_tramite`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_enlaces` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_eventos_codigos`
--

DROP TABLE IF EXISTS `trd_general_eventos_codigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_eventos_codigos` (
  `evt_codigo` varchar(50) NOT NULL COMMENT 'Unique code for the event type (e.g. LOGIN_SUCCESS)',
  `evt_descripcion` varchar(255) NOT NULL COMMENT 'Human readable description of the event type',
  `evt_nivel_defecto` enum('info','warning','error','critical') DEFAULT 'info' COMMENT 'Default severity level',
  `evt_creacion` datetime DEFAULT current_timestamp(),
  `evt_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `evt_borrado` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`evt_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catalogo de codigos de eventos del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_eventos_codigos`
--

LOCK TABLES `trd_general_eventos_codigos` WRITE;
/*!40000 ALTER TABLE `trd_general_eventos_codigos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_eventos_codigos` VALUES
('CREATE','Creación de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('DB_ERROR','Error de base de datos','error','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('DELETE','Eliminación de registro','warning','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('LOGIN_FAILED','Intento de inicio de sesión fallido','warning','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('LOGIN_SUCCESS','Inicio de sesión exitoso','info','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('LOGOUT','Cierre de sesión','info','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('SYS_ERROR','Error del sistema','error','2026-02-03 14:19:23','2026-02-03 14:19:23',0),
('UPDATE','Actualización de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23',0);
/*!40000 ALTER TABLE `trd_general_eventos_codigos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_logs`
--

DROP TABLE IF EXISTS `trd_general_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_creacion` datetime DEFAULT current_timestamp(),
  `log_evento_codigo` varchar(50) DEFAULT NULL,
  `log_tipo` enum('info','warning','error','critical') DEFAULT 'info',
  `log_severidad` varchar(50) DEFAULT NULL,
  `log_modulo` varchar(100) DEFAULT NULL,
  `log_usuario_id` int(11) DEFAULT NULL,
  `log_accion` varchar(100) DEFAULT NULL,
  `log_descripcion` text DEFAULT NULL,
  `log_detalles` text DEFAULT NULL,
  `log_ip` varchar(45) DEFAULT NULL,
  `log_resultado` varchar(50) DEFAULT NULL,
  `log_borrado` tinyint(1) DEFAULT 0,
  `log_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`log_id`),
  KEY `log_usuario_id` (`log_usuario_id`),
  KEY `log_evento_codigo` (`log_evento_codigo`),
  CONSTRAINT `fk_logs_evento` FOREIGN KEY (`log_evento_codigo`) REFERENCES `trd_general_eventos_codigos` (`evt_codigo`),
  CONSTRAINT `fk_logs_usuario` FOREIGN KEY (`log_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(1,'2026-03-09 12:08:18','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 1','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"juan.hervas@munivina.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"\",\"cont_latitud\":\"\",\"cont_longitud\":\"\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-09 12:06\",\"oirs_tematica\":\"1\",\"oirs_subtematica\":\"1\",\"oirs_calle\":\"quinta 100\",\"oirs_sector\":\"13\",\"oirs_descripcion\":\"ventiladores\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0237755\",\"oirs_longitud\":\"-71.5539787\",\"oirs_respuesta\":\"se reqiiere aclaacion\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"1\",\"rgt_id\":\"1\"}}','192.168.0.169','Exitoso',0,'2026-03-09 12:08:18'),
(2,'2026-03-09 13:10:18','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 1','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Prueba 1 realizada con fecha limite ya pasada\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-09\",\"destinos\":[{\"usr_id\":\"13\",\"usr_nombre_completo\":\"USUARIO OIRS ADMIN\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Lector\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"0\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-09 13:10:18'),
(3,'2026-03-09 13:11:01','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 2','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"17619949-0\",\"cont_nombres\":\"prueba01\",\"cont_apellido_paterno\":\"prueba01\",\"cont_apellido_materno\":\"prueba01\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1993-04-27\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"leticia.meneses@munivina.cl\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"lebu 81\",\"cont_latitud\":\"-33.0298804\",\"cont_longitud\":\"-71.4961234\",\"oirs_tipo_atencion\":\"2\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"5\",\"oirs_creacion\":\"2026-03-09 12:56\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"Tamarugal 533, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"1\",\"oirs_descripcion\":\"favor ayuda con retiro de microbasurales\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02944631457041\",\"oirs_longitud\":\"-71.493526477771\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"2\",\"rgt_id\":\"3\"}}','192.168.0.168','Exitoso',0,'2026-03-09 13:11:01'),
(4,'2026-03-09 15:17:42','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-09 15:17:42'),
(5,'2026-03-09 15:18:03','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-09 15:18:03'),
(6,'2026-03-09 16:02:30','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-09 16:02:30'),
(7,'2026-03-09 17:12:40','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-09 17:12:40'),
(8,'2026-03-10 08:37:59','CREATE','info','Bajo','DESVE',3,'CREAR_SOLICITUD','Creación de solicitud DESVE: 1','{\"data\":{\"sol_nombre_expediente\":\"revisar documento\",\"sol_ingreso_desve\":\"1\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"test 123\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"2\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-03-19 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"3\",\"sol_origen_esp\":0,\"sol_latitud\":\"-33.010443\",\"sol_longitud\":\"-71.502431\",\"sol_direccion\":\"las magnolias 38, 2551470, vi\\u00f1a del mar\",\"destinos\":[{\"usr_id\":\"34\",\"usr_nombre_completo\":\"DANAI OLEA\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.112','Exitoso',0,'2026-03-10 08:37:59'),
(9,'2026-03-10 10:12:35','UPDATE','info','Bajo','INGRESOS',NULL,'ACTUALIZAR_INGRESO','Actualización de ingreso: 1','{\"id\":\"1\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"1\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Prueba 1 realizada con fecha limite ya pasada\",\"destinos\":[{\"usr_id\":\"13\",\"usr_nombre_completo\":\"usuario oirs admin\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Lector\",\"tid_tarea\":null,\"tid_requeido\":\"0\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_respuesta\":null},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"0\"}],\"enlaces\":[],\"documentos\":[],\"tis_fecha_limite\":null}}','192.168.0.169','Exitoso',0,'2026-03-10 10:12:35'),
(10,'2026-03-10 10:14:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-10 10:14:10'),
(11,'2026-03-10 10:14:25','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 1','{\"id\":\"1\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"1\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Prueba 1 realizada con fecha limite ya pasada\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"Leticia meneses\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_respuesta\":null}],\"enlaces\":[],\"documentos\":[],\"tis_fecha_limite\":null}}','192.168.0.169','Exitoso',0,'2026-03-10 10:14:25'),
(12,'2026-03-10 10:47:26','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 2','{\"data\":{\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12 00:00:00\",\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_origen_esp\":2,\"sol_latitud\":\"-33.024044\",\"sol_longitud\":\"-71.550863\",\"sol_direccion\":\"\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 10:47:26'),
(13,'2026-03-10 10:53:56','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"2\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 10:47:23\",\"tid_actualizacion\":\"2026-03-10 10:47:23\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 10:53:56'),
(14,'2026-03-10 10:58:00','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"3\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 10:53:53\",\"tid_actualizacion\":\"2026-03-10 10:53:53\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 10:58:00'),
(15,'2026-03-10 10:58:42','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"4\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 10:57:57\",\"tid_actualizacion\":\"2026-03-10 10:57:57\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 10:58:42'),
(16,'2026-03-10 11:03:28','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"5\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 10:58:39\",\"tid_actualizacion\":\"2026-03-10 10:58:39\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:03:28'),
(17,'2026-03-10 11:04:26','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"6\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 11:03:25\",\"tid_actualizacion\":\"2026-03-10 11:03:25\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:04:26'),
(18,'2026-03-10 11:11:26','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"7\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 11:04:21\",\"tid_actualizacion\":\"2026-03-10 11:04:21\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:11:26'),
(19,'2026-03-10 11:19:06','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"qqq\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"8\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 11:11:23\",\"tid_actualizacion\":\"2026-03-10 11:11:23\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:19:06'),
(20,'2026-03-10 11:30:41','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"sdf\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle 2\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"comentario\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"9\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 11:19:03\",\"tid_actualizacion\":\"2026-03-10 11:19:03\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:30:41'),
(21,'2026-03-10 11:37:49','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"sdf\",\"sol_reingreso_id\":\"1\",\"sol_nombre_expediente\":\"id encriptado 001\",\"sol_origen_id\":\"8\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"detalle 2 nuevo\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"comentario nuevo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02404400\",\"sol_longitud\":\"-71.55086300\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"10\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-03-10 11:30:38\",\"tid_actualizacion\":\"2026-03-10 11:30:38\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 11:37:49'),
(22,'2026-03-10 12:09:18','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 12:09:18'),
(23,'2026-03-10 13:00:19','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:00:19'),
(24,'2026-03-10 13:00:49','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:00:49'),
(25,'2026-03-10 13:06:41','CREATE','info','Bajo','DESVE',3,'CREAR_SOLICITUD','Creación de solicitud DESVE: 3','{\"data\":{\"sol_nombre_expediente\":\"ramon\",\"sol_ingreso_desve\":\"111\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"3\",\"sol_origen_texto\":\"ASDDF\",\"sol_detalle\":\"prueba ramon\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-12 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"3\",\"sol_origen_esp\":0,\"sol_latitud\":null,\"sol_longitud\":null,\"sol_direccion\":null,\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.112','Exitoso',0,'2026-03-10 13:06:41'),
(26,'2026-03-10 13:08:07','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 13:08:07'),
(27,'2026-03-10 13:08:16','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 13:08:16'),
(28,'2026-03-10 13:12:59','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:12:59'),
(29,'2026-03-10 13:15:20','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:15:20'),
(30,'2026-03-10 13:19:04','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 13:19:04'),
(31,'2026-03-10 13:28:08','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:28:08'),
(32,'2026-03-10 13:30:35','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:30:35'),
(33,'2026-03-10 13:33:49','CREATE','info','Bajo','DESVE',3,'CREAR_SOLICITUD','Creación de solicitud DESVE: 4','{\"data\":{\"sol_nombre_expediente\":\"ramon a territorial\",\"sol_ingreso_desve\":\"999\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"5\",\"sol_origen_texto\":\"TERRITOIAL\",\"sol_detalle\":\"organizacion territorial \\nterritorial\\n10-3-26\\nre\\u00f1aca alto\\n999\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-03-12 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"3\",\"sol_origen_esp\":0,\"sol_latitud\":\"-33.010443\",\"sol_longitud\":\"-71.502431\",\"sol_direccion\":\"las magnolias 38, 2551470\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.112','Exitoso',0,'2026-03-10 13:33:49'),
(34,'2026-03-10 13:40:09','CREATE','info','Bajo','DESVE',3,'CREAR_SOLICITUD','Creación de solicitud DESVE: 5','{\"data\":{\"sol_nombre_expediente\":\"ramon 2\",\"sol_ingreso_desve\":\"888\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"4\",\"sol_origen_texto\":\"FUNCIONAL\",\"sol_detalle\":\"funciona tiene m\\u00e0s tiempo que territorial, donde lo ngreso?\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"2\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-03-19 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"3\",\"sol_origen_esp\":0,\"sol_latitud\":null,\"sol_longitud\":null,\"sol_direccion\":null,\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.112','Exitoso',0,'2026-03-10 13:40:09'),
(35,'2026-03-10 13:46:07','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 13:46:07'),
(36,'2026-03-10 13:51:23','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-10 13:51:23'),
(37,'2026-03-10 13:51:58','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-10 13:51:58'),
(38,'2026-03-10 15:58:37','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 15:58:37'),
(39,'2026-03-10 16:00:11','CREATE','info','Bajo','DESVE',3,'CREAR_SOLICITUD','Creación de solicitud DESVE: 6','{\"data\":{\"sol_nombre_expediente\":\"me pidieron que cargue\",\"sol_ingreso_desve\":\"223\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"2\",\"sol_origen_texto\":\"RAMON ANDRES MARTINEZ VILLANUEVA\",\"sol_detalle\":\"ramon me pidio que le cargue un desve\",\"sol_fecha_recepcion\":\"2026-03-10 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-12 00:00:00\",\"sol_observaciones\":\"comentario\",\"sol_propietario\":\"3\",\"sol_origen_esp\":1,\"sol_latitud\":null,\"sol_longitud\":null,\"sol_direccion\":null,\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-03-10 16:00:11'),
(40,'2026-03-10 16:43:52','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 16:43:52'),
(41,'2026-03-10 16:45:30','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-10 16:45:30'),
(42,'2026-03-10 17:23:50','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 17:23:50'),
(43,'2026-03-10 17:24:49','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 17:24:49'),
(44,'2026-03-10 17:25:14','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-10 17:25:14'),
(45,'2026-03-10 17:31:07','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 3','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-10 17:28\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"2 norte 162\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"hay microbasurles\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0209526\",\"oirs_longitud\":\"-71.5578992\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"3\",\"rgt_id\":\"10\"}}','192.168.0.112','Exitoso',0,'2026-03-10 17:31:07'),
(46,'2026-03-10 17:38:13','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:38:13'),
(47,'2026-03-10 17:39:13','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:39:13'),
(48,'2026-03-10 17:40:29','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:40:29'),
(49,'2026-03-10 17:44:18','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 4','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-10 17:43\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"3\",\"oirs_calle\":\"alvarez 622\",\"oirs_sector\":null,\"oirs_descripcion\":\"revisar este caso\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.026478\",\"oirs_longitud\":\"-71.5539967\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"4\",\"rgt_id\":\"11\"}}','192.168.0.112','Exitoso',0,'2026-03-10 17:44:18'),
(50,'2026-03-10 17:46:57','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:46:57'),
(51,'2026-03-10 17:48:01','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:48:01'),
(52,'2026-03-10 17:49:39','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:49:39'),
(53,'2026-03-10 17:51:03','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:51:03'),
(54,'2026-03-10 17:53:37','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 17:53:37'),
(55,'2026-03-10 17:54:58','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 5','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-10 17:53\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"alvarez 622\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"necesito ayuda para pintar mi casa\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.026478\",\"oirs_longitud\":\"-71.5539967\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"5\",\"rgt_id\":\"12\"}}','192.168.0.112','Exitoso',0,'2026-03-10 17:54:58'),
(56,'2026-03-10 18:03:26','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 6','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-10 18:02\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"lebu 123\",\"oirs_sector\":\"1\",\"oirs_descripcion\":\"necesito ayuda para resolver esto\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0296564\",\"oirs_longitud\":\"-71.4960617\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"6\",\"rgt_id\":\"13\"}}','192.168.0.112','Exitoso',0,'2026-03-10 18:03:26'),
(57,'2026-03-10 18:07:54','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:07:54'),
(58,'2026-03-10 18:08:20','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:08:20'),
(59,'2026-03-10 18:08:38','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:08:38'),
(60,'2026-03-10 18:09:37','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:09:37'),
(61,'2026-03-10 18:09:58','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:09:58'),
(62,'2026-03-10 18:18:28','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:18:28'),
(63,'2026-03-10 18:23:24','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:23:24'),
(64,'2026-03-10 18:23:57','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:23:57'),
(65,'2026-03-10 18:24:25','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:24:25'),
(66,'2026-03-10 18:28:25','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:28:25'),
(67,'2026-03-10 18:28:53','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:28:53'),
(68,'2026-03-10 18:34:12','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:34:12'),
(69,'2026-03-10 18:34:57','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:34:57'),
(70,'2026-03-10 18:35:17','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-10 18:35:17'),
(71,'2026-03-11 09:22:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-11 09:22:04'),
(72,'2026-03-11 09:43:40','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 09:43:40'),
(73,'2026-03-11 10:25:38','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 10:25:38'),
(74,'2026-03-11 10:27:26','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 10:27:26'),
(75,'2026-03-11 10:33:28','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 7','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"17619949-0\",\"cont_nombres\":\"prueba01\",\"cont_apellido_paterno\":\"prueba01\",\"cont_apellido_materno\":\"prueba01\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1993-04-27\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"leticia.meneses@munivina.cl\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"lebu 81\",\"cont_latitud\":\"-33.0298804\",\"cont_longitud\":\"-71.4961234\",\"oirs_tipo_atencion\":\"5\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 10:31\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"Arlegui 839, 2520426 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"favor su ayuda para aumentar luminarias en el sector\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02421214482397\",\"oirs_longitud\":\"-71.54974006347656\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"7\",\"rgt_id\":\"14\"}}','192.168.0.168','Exitoso',0,'2026-03-11 10:33:28'),
(76,'2026-03-11 11:02:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:02:04'),
(77,'2026-03-11 11:02:22','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:02:22'),
(78,'2026-03-11 11:04:08','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:04:08'),
(79,'2026-03-11 11:14:20','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:14:20'),
(80,'2026-03-11 11:15:03','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:15:03'),
(81,'2026-03-11 11:15:19','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:15:19'),
(82,'2026-03-11 11:33:24','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:33:24'),
(83,'2026-03-11 11:33:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:33:51'),
(84,'2026-03-11 11:47:30','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:47:30'),
(85,'2026-03-11 11:52:48','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:52:48'),
(86,'2026-03-11 11:53:04','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 11:53:04'),
(87,'2026-03-11 12:00:06','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:00:06'),
(88,'2026-03-11 12:01:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:01:06'),
(89,'2026-03-11 12:01:35','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:01:35'),
(90,'2026-03-11 12:02:43','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:02:43'),
(91,'2026-03-11 12:04:41','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:04:41'),
(92,'2026-03-11 12:06:23','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:06:23'),
(93,'2026-03-11 12:08:06','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:08:06'),
(94,'2026-03-11 12:24:30','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:24:30'),
(95,'2026-03-11 12:27:21','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 12:27:21'),
(96,'2026-03-11 14:15:26','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 2','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"solicito contratacion de personas\",\"tis_tipo\":\"1\",\"tis_contenido\":\"solicito contrataci\\u00f3n de personal\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-11\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"ramon.pdf\"}]}}','192.168.0.112','Exitoso',0,'2026-03-11 14:15:26'),
(97,'2026-03-11 14:17:01','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 14:17:01'),
(98,'2026-03-11 14:18:10','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 3','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisa este oficio\",\"tis_tipo\":\"1\",\"tis_contenido\":\"revisael oficio adjunto \",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-11\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"Comprobante_#OIRS-2602-4.pdf\"}]}}','192.168.0.168','Exitoso',0,'2026-03-11 14:18:10'),
(99,'2026-03-11 14:28:10','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 8','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 14:26\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"alvarez 622\",\"oirs_sector\":null,\"oirs_descripcion\":\"necesito ayuda\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.026478\",\"oirs_longitud\":\"-71.5539967\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"8\",\"rgt_id\":\"17\"}}','192.168.0.112','Exitoso',0,'2026-03-11 14:28:10'),
(100,'2026-03-11 14:30:30','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 9','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"156767228-2\",\"cont_nombres\":\"carolina\",\"cont_apellido_paterno\":\"montoya\",\"cont_apellido_materno\":\"lopez\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"2\",\"cont_email\":\"\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"2 norte 162\",\"cont_latitud\":\"-33.0209526\",\"cont_longitud\":\"-71.5578992\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 14:29\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"2 norte 162\",\"oirs_sector\":null,\"oirs_descripcion\":\"perros\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0209526\",\"oirs_longitud\":\"-71.5578992\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"9\",\"rgt_id\":\"18\"}}','192.168.0.112','Exitoso',0,'2026-03-11 14:30:30'),
(101,'2026-03-11 14:31:50','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 10','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"17619949-0\",\"cont_nombres\":\"prueba01\",\"cont_apellido_paterno\":\"prueba01\",\"cont_apellido_materno\":\"prueba01\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1993-04-27\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"leticia.meneses@munivina.cl\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"lebu 81\",\"cont_latitud\":\"-33.0298804\",\"cont_longitud\":\"-71.4961234\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 14:31\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"libetad1410\",\"oirs_sector\":\"3\",\"oirs_descripcion\":\"retiro de microbasural\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0258123\",\"oirs_longitud\":\"-71.5070576\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"10\",\"rgt_id\":\"19\"}}','192.168.0.168','Exitoso',0,'2026-03-11 14:31:50'),
(102,'2026-03-11 14:34:10','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 11','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"17619949-0\",\"cont_nombres\":\"prueba01\",\"cont_apellido_paterno\":\"prueba01\",\"cont_apellido_materno\":\"prueba01\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1993-04-27\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"leticia.meneses@munivina.cl\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"lebu 81\",\"cont_latitud\":\"-33.0298804\",\"cont_longitud\":\"-71.4961234\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 14:33\",\"oirs_tematica\":\"4\",\"oirs_subtematica\":\"6\",\"oirs_calle\":\"2 norte 162\",\"oirs_sector\":null,\"oirs_descripcion\":\"caos\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0209526\",\"oirs_longitud\":\"-71.5578992\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"11\",\"rgt_id\":\"20\"}}','192.168.0.112','Exitoso',0,'2026-03-11 14:34:10'),
(103,'2026-03-11 15:42:35','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-11 15:42:35'),
(104,'2026-03-11 16:11:59','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 4','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"mas computadores\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor ejecutar lo requerido\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-11\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"4\",\"usr_nombre_completo\":\"DANIELA RUIZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-11 16:11:59'),
(105,'2026-03-11 16:13:22','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 5','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisar disponibilidad \",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor revisar lo solicitado e indicar disponibilidad \",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-11\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-11 16:13:22'),
(106,'2026-03-11 16:21:17','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 16:21:17'),
(107,'2026-03-11 16:24:50','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 16:24:50'),
(108,'2026-03-11 17:20:13','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 12','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"ramon andres\",\"cont_apellido_paterno\":\"martinez\",\"cont_apellido_materno\":\"villanueva\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"rmartinezvcl@gmail.com\",\"cont_telefono\":\"\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"las magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-11 17:15\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"alvarez 622\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"neceisto que retiren una basura\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.026478\",\"oirs_longitud\":\"-71.5539967\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"12\",\"rgt_id\":\"23\"}}','192.168.0.112','Exitoso',0,'2026-03-11 17:20:13'),
(109,'2026-03-11 17:31:11','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 17:31:11'),
(110,'2026-03-11 18:06:53','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 18:06:53'),
(111,'2026-03-11 18:09:18','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 18:09:18'),
(112,'2026-03-11 18:11:14','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-11 18:11:14'),
(113,'2026-03-12 09:19:13','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-12 09:19:13'),
(114,'2026-03-12 09:42:59','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-12 09:42:59');
/*!40000 ALTER TABLE `trd_general_logs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_mails_enviados`
--

DROP TABLE IF EXISTS `trd_general_mails_enviados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_mails_enviados` (
  `gme_id` int(11) NOT NULL AUTO_INCREMENT,
  `gme_expediente` int(11) NOT NULL,
  `gme_destinatario_funcionario` int(11) DEFAULT NULL,
  `gme_destinatario_no_funcionario` int(11) DEFAULT NULL,
  `gme_contenido` text DEFAULT NULL,
  `gme_borado` tinyint(4) DEFAULT NULL,
  `gme_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `gme_actualizacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`gme_id`),
  KEY `trd_general_mails_enviados_trd_acceso_usuarios_FK` (`gme_destinatario_funcionario`),
  KEY `trd_general_mails_enviados_trd_general_contribuyentes_FK` (`gme_destinatario_no_funcionario`),
  KEY `trd_general_mails_enviados_trd_expedientes_FK` (`gme_expediente`),
  CONSTRAINT `trd_general_mails_enviados_trd_acceso_usuarios_FK` FOREIGN KEY (`gme_destinatario_funcionario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_mails_enviados_trd_expedientes_FK` FOREIGN KEY (`gme_expediente`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`),
  CONSTRAINT `trd_general_mails_enviados_trd_general_contribuyentes_FK` FOREIGN KEY (`gme_destinatario_no_funcionario`) REFERENCES `trd_general_contribuyentes` (`tgc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_mails_enviados`
--

LOCK TABLES `trd_general_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_general_mails_enviados` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_mails_enviados` VALUES
(1,4,34,NULL,'{\"asunto\":\"DESVE - Solicitud creación: revisar documento\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>DANAI OLEA<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>1<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>revisar documento<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>test 123<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-19 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"danai.olea@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 08:37:59','2026-03-10 08:37:59'),
(2,2,2,NULL,'{\"asunto\":\"Ingresos - Solicitud actualización: prueba ingreso de ingreso 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>1<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ingreso de ingreso 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Prueba 1 realizada con fecha limite ya pasada<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>06-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:08:53','2026-03-10 10:08:53'),
(3,2,2,NULL,'{\"asunto\":\"Ingresos - Solicitud actualización: prueba ingreso de ingreso 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>1<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ingreso de ingreso 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Prueba 1 realizada con fecha limite ya pasada<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>06-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:12:35','2026-03-10 10:12:35'),
(4,2,2,NULL,'{\"asunto\":\"Ingresos - Solicitud actualización: prueba ingreso de ingreso 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>1<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ingreso de ingreso 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Prueba 1 realizada con fecha limite ya pasada<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>06-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:14:25','2026-03-10 10:14:25'),
(5,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud creación: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:47:26','2026-03-10 10:47:26'),
(6,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:53:56','2026-03-10 10:53:56'),
(7,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:58:00','2026-03-10 10:58:00'),
(8,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 10:58:42','2026-03-10 10:58:42'),
(9,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:03:28','2026-03-10 11:03:28'),
(10,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:04:26','2026-03-10 11:04:26'),
(11,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:11:26','2026-03-10 11:11:26'),
(12,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:19:06','2026-03-10 11:19:06'),
(13,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle 2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:30:41','2026-03-10 11:30:41'),
(14,5,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: id encriptado 001\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>id encriptado 001<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>detalle 2 nuevo<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario nuevo<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 11:37:49','2026-03-10 11:37:49'),
(15,6,3,NULL,'{\"asunto\":\"DESVE - Solicitud creación: ramon\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>RAMON MARTINEZ<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>3<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>ramon<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ramon<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 13:06:41','2026-03-10 13:06:41'),
(16,7,2,NULL,'{\"asunto\":\"DESVE - Solicitud creación: ramon a territorial\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>4<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>ramon a territorial<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>organizacion territorial \\nterritorial\\n10-3-26\\nreñaca alto\\n999<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 13:33:49','2026-03-10 13:33:49'),
(17,8,1,NULL,'{\"asunto\":\"DESVE - Solicitud creación: ramon 2\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>JUAN HERVAS<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>5<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>ramon 2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>funciona tiene màs tiempo que territorial, donde lo ngreso?<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-19 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 13:40:09','2026-03-10 13:40:09'),
(18,9,3,NULL,'{\"asunto\":\"DESVE - Solicitud creación: me pidieron que cargue\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>RAMON MARTINEZ<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>6<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>me pidieron que cargue<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>ramon me pidio que le cargue un desve<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-10 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-12 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>comentario<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-10 16:00:11','2026-03-10 16:00:11'),
(19,1,NULL,NULL,'{\"asunto\":\"Bienvenido al Portal de Vecinos - Municipalidad de Viña del Mar\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; color: #1e293b;\'>\\r\\n            <div style=\'background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%); padding: 30px; text-align: center;\'>\\r\\n                <h1 style=\'color: white; margin: 0; font-size: 24px;\'>¡Bienvenido\\/a, Juan Francisco Hervas!<\\/h1>\\r\\n            <\\/div>\\r\\n            <div style=\'padding: 30px; line-height: 1.6;\'>\\r\\n                <p>Nos complace darte la bienvenida al <strong>Portal de Vecinos de la Ilustre Municipalidad de Viña del Mar<\\/strong>.<\\/p>\\r\\n                <p>Tu cuenta ha sido creada exitosamente. Desde ahora podrás realizar trámites y gestiones municipales de forma digital.<\\/p>\\r\\n                \\r\\n                <div style=\'background-color: #f8fafc; border-radius: 8px; padding: 20px; margin: 25px 0;\'>\\r\\n                    <h3 style=\'margin-top: 0; color: #006FB3; font-size: 16px;\'>Tus credenciales de acceso:<\\/h3>\\r\\n                    <p style=\'margin: 5px 0;\'><strong>RUT:<\\/strong> 14.711.939-9<\\/p>\\r\\n                    <p style=\'margin: 5px 0;\'><strong>Clave:<\\/strong> Savotage4<\\/p>\\r\\n                    <p style=\'font-size: 12px; color: #64748b; margin-top: 10px;\'><em>Recuerda que puedes cambiar tu clave tras ingresar al portal.<\\/em><\\/p>\\r\\n                <\\/div>\\r\\n\\r\\n                <h3 style=\'color: #0f172a; font-size: 16px;\'>Protección de tus datos:<\\/h3>\\r\\n                <p style=\'font-size: 14px; color: #475569;\'>Te recordamos que tu información está protegida bajo la <strong>Ley N° 19.628 sobre Protección de la Vida Privada<\\/strong>. La Municipalidad trata tus datos con estricta confidencialidad y solo para fines de gestión municipal.<\\/p>\\r\\n                \\r\\n                <p style=\'margin-top: 30px; text-align: center;\'>\\r\\n                    <a href=\'http:\\/\\/192.168.0.169\\/Transformacion\\/acceso_vecinos.php\' style=\'background-color: #006FB3; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold;\'>Ingresar al Portal<\\/a>\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n            <div style=\'background-color: #f1f5f9; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8;\'>\\r\\n                Este es un mensaje automático, por favor no respondas.<br>\\r\\n                &copy; 2026 Ilustre Municipalidad de Viña del Mar\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 09:06:17','2026-03-11 09:06:17'),
(20,1,NULL,NULL,'{\"asunto\":\"⚠️ REPORTE DE PROBLEMA - Sistema Municipal\",\"cuerpo\":\"\\r\\n    <div style=\'font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 10px; overflow: hidden;\'>\\r\\n        <div style=\'background: #dc3545; color: white; padding: 20px; text-align: center;\'>\\r\\n            <h2 style=\'margin: 0;\'>Reporte de Problema<\\/h2>\\r\\n        <\\/div>\\r\\n        <div style=\'padding: 20px;\'>\\r\\n            <p>Se ha recibido un nuevo reporte de error desde el sistema municipal.<\\/p>\\r\\n            <table style=\'width: 100%; border-collapse: collapse;\'>\\r\\n                <tr>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; width: 30%;\'>Usuario:<\\/td>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee;\'>Usuario Desconocido (ID: 0)<\\/td>\\r\\n                <\\/tr>\\r\\n                <tr>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;\'>URL de Origen:<\\/td>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee;\'><a href=\'http:\\/\\/192.168.0.169\\/Transformacion\\/funcionarios\\/desve\\/index.php\' style=\'color: #004085;\'>http:\\/\\/192.168.0.169\\/Transformacion\\/funcionarios\\/desve\\/index.php<\\/a><\\/td>\\r\\n                <\\/tr>\\r\\n            <\\/table>\\r\\n            \\r\\n            <p style=\'font-weight: bold; margin-top: 20px;\'>Descripción del problema:<\\/p>\\r\\n            <div style=\'padding: 15px; background: #f8f9fa; border-left: 4px solid #dc3545; color: #555; font-style: italic; line-height: 1.6;\'>\\r\\n                no me carga la oirs #1234\\r\\n            <\\/div>\\r\\n            \\r\\n            <p style=\'font-size: 12px; color: #999; margin-top: 30px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;\'>\\r\\n                Este correo fue generado automáticamente desde la función \'Reportar un problema\' del footer.\\r\\n            <\\/p>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n    \",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 12:45:09','2026-03-11 12:45:09'),
(21,1,NULL,NULL,'{\"asunto\":\"⚠️ REPORTE DE PROBLEMA - Sistema Municipal\",\"cuerpo\":\"\\r\\n    <div style=\'font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 10px; overflow: hidden;\'>\\r\\n        <div style=\'background: #dc3545; color: white; padding: 20px; text-align: center;\'>\\r\\n            <h2 style=\'margin: 0;\'>Reporte de Problema<\\/h2>\\r\\n        <\\/div>\\r\\n        <div style=\'padding: 20px;\'>\\r\\n            <p>Se ha recibido un nuevo reporte de error desde el sistema municipal.<\\/p>\\r\\n            <table style=\'width: 100%; border-collapse: collapse;\'>\\r\\n                <tr>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; width: 30%;\'>Usuario:<\\/td>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee;\'>ramon.martinez@munivina.cl (ID: 3)<\\/td>\\r\\n                <\\/tr>\\r\\n                <tr>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;\'>URL de Origen:<\\/td>\\r\\n                    <td style=\'padding: 10px; border-bottom: 1px solid #eee;\'><a href=\'http:\\/\\/192.168.0.169\\/Transformacion\\/funcionarios\\/oirs\\/ver.php?id=7\' style=\'color: #004085;\'>http:\\/\\/192.168.0.169\\/Transformacion\\/funcionarios\\/oirs\\/ver.php?id=7<\\/a><\\/td>\\r\\n                <\\/tr>\\r\\n            <\\/table>\\r\\n            \\r\\n            <p style=\'font-weight: bold; margin-top: 20px;\'>Descripción del problema:<\\/p>\\r\\n            <div style=\'padding: 15px; background: #f8f9fa; border-left: 4px solid #dc3545; color: #555; font-style: italic; line-height: 1.6;\'>\\r\\n                no me funciona problema en dejar regsitro\\r\\n            <\\/div>\\r\\n            \\r\\n            <p style=\'font-size: 12px; color: #999; margin-top: 30px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;\'>\\r\\n                Este correo fue generado automáticamente desde la función \'Reportar un problema\' del footer.\\r\\n            <\\/p>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n    \",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 12:51:09','2026-03-11 12:51:09'),
(22,15,2,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: solicito contratacion de personas\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>solicito contratacion de personas<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>solicito contratación de personal<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>08-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 14:15:26','2026-03-11 14:15:26'),
(23,16,1,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: revisa este oficio\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Juan hervas<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>3<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>revisa este oficio<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>revisael oficio adjunto <\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>08-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 14:18:10','2026-03-11 14:18:10'),
(24,21,2,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: mas computadores\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>4<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>mas computadores<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>por favor ejecutar lo requerido<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>08-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 16:11:56','2026-03-11 16:11:56'),
(25,21,4,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: mas computadores\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Daniela Ruiz<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>4<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>mas computadores<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>por favor ejecutar lo requerido<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>08-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"daniela.ruiz@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 16:11:59','2026-03-11 16:11:59'),
(26,22,1,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: revisar disponibilidad \",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Juan hervas<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>5<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>revisar disponibilidad <\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>por favor revisar lo solicitado e indicar disponibilidad <\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>08-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-11 16:13:22','2026-03-11 16:13:22');
/*!40000 ALTER TABLE `trd_general_mails_enviados` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_multiancestro`
--

DROP TABLE IF EXISTS `trd_general_multiancestro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_multiancestro` (
  `gma_id` int(11) NOT NULL AUTO_INCREMENT,
  `gma_padre` int(11) DEFAULT NULL,
  `gma_hijo` int(11) DEFAULT NULL,
  `gma_borrado` tinyint(1) DEFAULT 0,
  `gma_creacion` datetime DEFAULT current_timestamp(),
  `gma_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`gma_id`),
  KEY `padres` (`gma_padre`),
  KEY `hijos` (`gma_hijo`),
  CONSTRAINT `hijos` FOREIGN KEY (`gma_hijo`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`),
  CONSTRAINT `padres` FOREIGN KEY (`gma_padre`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_multiancestro` VALUES
(1,21,22,0,'2026-03-11 16:13:22','2026-03-11 16:13:22');
/*!40000 ALTER TABLE `trd_general_multiancestro` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_organizaciones`
--

DROP TABLE IF EXISTS `trd_general_organizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_organizaciones` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_nombre` varchar(255) DEFAULT NULL,
  `org_tipo_id` int(11) DEFAULT NULL,
  `org_direccion` varchar(255) DEFAULT NULL,
  `org_latitud` decimal(10,8) DEFAULT NULL,
  `org_longitud` decimal(11,8) DEFAULT NULL,
  `org_borrado` tinyint(1) DEFAULT 0,
  `org_creacion` datetime DEFAULT current_timestamp(),
  `org_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`org_id`),
  KEY `org_tipo_id` (`org_tipo_id`),
  CONSTRAINT `fk_org_tipo` FOREIGN KEY (`org_tipo_id`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_organizaciones`
--

LOCK TABLES `trd_general_organizaciones` WRITE;
/*!40000 ALTER TABLE `trd_general_organizaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_organizaciones` VALUES
(1,'Juanta de Vecinos #1',2,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
/*!40000 ALTER TABLE `trd_general_organizaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_organizaciones_comunitarias`
--

DROP TABLE IF EXISTS `trd_general_organizaciones_comunitarias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_organizaciones_comunitarias` (
  `orgc_id` int(11) NOT NULL AUTO_INCREMENT,
  `orgc_rut` varchar(15) NOT NULL,
  `orgc_nombre` varchar(200) NOT NULL,
  `orgc_codigo` varchar(100) DEFAULT NULL,
  `orgc_rpj` varchar(100) DEFAULT NULL,
  `orgc_inscripcion` datetime NOT NULL,
  `orgc_vigencia` date DEFAULT NULL,
  `orgc_rep_legal` int(11) DEFAULT NULL,
  `orgc_unidad_vecinal` varchar(100) DEFAULT NULL,
  `orgc_tipo_organizacion` int(11) NOT NULL,
  `orgc_borrado` tinyint(1) DEFAULT 0,
  `orgc_creacion` datetime DEFAULT current_timestamp(),
  `orgc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`orgc_id`),
  KEY `trd_general_org_comu_trd_general_tipos_organizacion_FK` (`orgc_tipo_organizacion`),
  KEY `trd_general_org_comu_trd_general_contribuyentes_FK` (`orgc_rep_legal`),
  CONSTRAINT `trd_general_org_comu_trd_general_contribuyentes_FK` FOREIGN KEY (`orgc_rep_legal`) REFERENCES `trd_general_contribuyentes` (`tgc_id`),
  CONSTRAINT `trd_general_org_comu_trd_general_tipos_organizacion_FK` FOREIGN KEY (`orgc_tipo_organizacion`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_organizaciones_comunitarias`
--

LOCK TABLES `trd_general_organizaciones_comunitarias` WRITE;
/*!40000 ALTER TABLE `trd_general_organizaciones_comunitarias` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_organizaciones_comunitarias` VALUES
(1,'11111111-1','Organizacion de pueba 1','sdfsdf','aadsf43','2026-01-26 11:44:00','2036-01-26',3,'25',2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'1111555-6','asddf','codigo','rpj','2026-02-23 16:47:55',NULL,NULL,NULL,2,0,'2026-02-23 16:47:55','2026-02-23 16:47:55'),
(3,'1111555-7','asddf','codigo','rpj','2026-02-23 16:48:20',NULL,NULL,NULL,1,0,'2026-02-23 16:48:20','2026-02-23 16:48:20'),
(4,'1111555-8','FUNCIONAL','codigo','rpj','2026-02-23 16:49:19',NULL,NULL,NULL,2,0,'2026-02-23 16:49:19','2026-02-23 16:49:19'),
(5,'1111555-9','Territoial','codigo','rpj','2026-02-23 16:49:46',NULL,NULL,NULL,1,0,'2026-02-23 16:49:46','2026-02-23 16:49:46');
/*!40000 ALTER TABLE `trd_general_organizaciones_comunitarias` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_registro_general_expedientes`
--

DROP TABLE IF EXISTS `trd_general_registro_general_expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_registro_general_expedientes` (
  `rgt_id` int(11) NOT NULL AUTO_INCREMENT,
  `rgt_id_publica` varchar(100) DEFAULT NULL,
  `rgt_tramite` varchar(100) DEFAULT NULL,
  `rgt_tramite_padre` int(11) DEFAULT NULL,
  `rgt_creador` int(11) DEFAULT NULL,
  `rgt_contribuyente` int(11) DEFAULT NULL,
  `rgt_borrado` tinyint(1) DEFAULT 0,
  `rgt_creacion` datetime DEFAULT current_timestamp(),
  `rgt_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rgt_id`),
  KEY `trd_general_registro_general_tramites_SK` (`rgt_tramite_padre`) USING BTREE,
  KEY `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` (`rgt_creador`),
  KEY `trd_general_registro_general_tramites_contribuyente_FK` (`rgt_contribuyente`),
  CONSTRAINT `trd_general_registro_general_tramites_contribuyente_FK` FOREIGN KEY (`rgt_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`),
  CONSTRAINT `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` FOREIGN KEY (`rgt_creador`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_expedientes`
--

LOCK TABLES `trd_general_registro_general_expedientes` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_expedientes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_expedientes` VALUES
(1,'260309-1608-OIRS-AF','oirs',NULL,1,1,0,'2026-03-09 12:08:18','2026-03-09 12:08:18'),
(2,'260309-1710-Ingreso_ingresos-hQ','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-09 13:10:18','2026-03-09 13:10:18'),
(3,'260309-1711-OIRS-Ou','oirs',NULL,2,3,0,'2026-03-09 13:11:01','2026-03-09 13:11:01'),
(4,'260310-1237-desve_solicitud-om','desve_solicitud',NULL,3,NULL,0,'2026-03-10 08:37:56','2026-03-10 08:37:56'),
(5,'260310-1447-desve_solicitud-bt','desve_solicitud',NULL,1,NULL,0,'2026-03-10 10:47:23','2026-03-10 10:47:23'),
(6,'260310-1706-desve_solicitud-0Q','desve_solicitud',NULL,3,NULL,0,'2026-03-10 13:06:38','2026-03-10 13:06:38'),
(7,'260310-1733-desve_solicitud-yo','desve_solicitud',NULL,3,NULL,0,'2026-03-10 13:33:46','2026-03-10 13:33:46'),
(8,'260310-1740-desve_solicitud-qB','desve_solicitud',NULL,3,NULL,0,'2026-03-10 13:40:06','2026-03-10 13:40:06'),
(9,'260310-2000-desve_solicitud-dW','desve_solicitud',NULL,3,NULL,0,'2026-03-10 16:00:08','2026-03-10 16:00:08'),
(10,'260310-2131-OIRS-YV','oirs',NULL,3,2,0,'2026-03-10 17:31:07','2026-03-10 17:31:07'),
(11,'260310-2144-OIRS-fb','oirs',NULL,3,2,0,'2026-03-10 17:44:18','2026-03-10 17:44:18'),
(12,'260310-2154-OIRS-y3','oirs',NULL,2,2,0,'2026-03-10 17:54:58','2026-03-10 17:54:58'),
(13,'260310-2203-OIRS-Pz','oirs',NULL,2,2,0,'2026-03-10 18:03:26','2026-03-10 18:03:26'),
(14,'260311-1433-OIRS-im','oirs',NULL,3,3,0,'2026-03-11 10:33:28','2026-03-11 10:33:28'),
(15,'260311-1815-Ingreso_ingresos-zK','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(16,'260311-1818-Ingreso_ingresos-Q8','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(17,'260311-1828-OIRS-71','oirs',NULL,3,2,0,'2026-03-11 14:28:10','2026-03-11 14:28:10'),
(18,'260311-1830-OIRS-Bw','oirs',NULL,3,11,0,'2026-03-11 14:30:30','2026-03-11 14:30:30'),
(19,'260311-1831-OIRS-IW','oirs',NULL,2,3,0,'2026-03-11 14:31:50','2026-03-11 14:31:50'),
(20,'260311-1834-OIRS-7h','oirs',NULL,3,3,0,'2026-03-11 14:34:10','2026-03-11 14:34:10'),
(21,'260311-2011-Ingreso_ingresos-fR','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-11 16:11:53','2026-03-11 16:11:53'),
(22,'260311-2013-Ingreso_ingresos-kF','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-11 16:13:19','2026-03-11 16:13:19'),
(23,'260311-2120-OIRS-je','oirs',NULL,3,2,0,'2026-03-11 17:20:13','2026-03-11 17:20:13');
/*!40000 ALTER TABLE `trd_general_registro_general_expedientes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_sectores`
--

DROP TABLE IF EXISTS `trd_general_sectores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_sectores` (
  `sec_id` int(11) NOT NULL,
  `sec_nombre` varchar(100) DEFAULT NULL,
  `sec_borrado` tinyint(1) DEFAULT 0,
  `sec_creacion` datetime DEFAULT current_timestamp(),
  `sec_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_sectores`
--

LOCK TABLES `trd_general_sectores` WRITE;
/*!40000 ALTER TABLE `trd_general_sectores` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_sectores` VALUES
(1,'ACHUPALLAS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,'CHORRILLOS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'FORESTAL',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(4,'GÓMEZ CARREÑO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(5,'GRANADILLAS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'JARDÍN BOTÁNICO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(7,'MIRAFLORES',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(8,'NAVAL',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(9,'NUEVA AURORA',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(10,'PALMARES',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(11,'PLAN',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(12,'RECREO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(13,'REÑACA',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(14,'REÑACA ALTO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(15,'SANTA INÉS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(16,'VIÑA ORIENTE',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
/*!40000 ALTER TABLE `trd_general_sectores` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_tipos_organizacion`
--

DROP TABLE IF EXISTS `trd_general_tipos_organizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_tipos_organizacion` (
  `tor_id` int(11) NOT NULL,
  `tor_nombre` varchar(100) DEFAULT NULL,
  `tor_prioridad_id` int(11) DEFAULT NULL,
  `tor_borrado` tinyint(1) DEFAULT 0,
  `tor_creacion` datetime DEFAULT current_timestamp(),
  `tor_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tor_id`),
  KEY `tor_prioridad_id` (`tor_prioridad_id`),
  CONSTRAINT `1` FOREIGN KEY (`tor_prioridad_id`) REFERENCES `trd_desve_prioridades` (`pri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_tipos_organizacion`
--

LOCK TABLES `trd_general_tipos_organizacion` WRITE;
/*!40000 ALTER TABLE `trd_general_tipos_organizacion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_tipos_organizacion` VALUES
(1,'Organización Territorial',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,'Organización Funcional',2,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'Particular',3,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(4,'Concejales',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(5,'Ley de Transparencia',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'Contraloría General',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(7,'Congreso Nacional',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
/*!40000 ALTER TABLE `trd_general_tipos_organizacion` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_destinos`
--

DROP TABLE IF EXISTS `trd_ingresos_destinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_destinos` (
  `tid_id` int(11) NOT NULL AUTO_INCREMENT,
  `tid_ingreso_solicitud` int(11) NOT NULL,
  `tid_destino` int(11) NOT NULL,
  `tid_tipo` enum('Para','Copia') NOT NULL,
  `tid_respuesta` text DEFAULT NULL,
  `tid_tarea` varchar(100) DEFAULT NULL,
  `tid_facultad` enum('Firmante','Visador','Lector','Responsable') NOT NULL,
  `tid_requeido` tinyint(1) NOT NULL DEFAULT 0,
  `tid_responde` tinyint(1) DEFAULT NULL,
  `tid_fecha_respuesta` datetime DEFAULT NULL,
  `tid_borrado` tinyint(1) DEFAULT 0,
  `tid_creacion` datetime DEFAULT current_timestamp(),
  `tid_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tid_id`),
  KEY `ingresos_destinos_ing` (`tid_ingreso_solicitud`),
  KEY `trd_ingresos_destinos_trd_acceso_usuarios_FK` (`tid_destino`),
  CONSTRAINT `ingresos_destinos_ing` FOREIGN KEY (`tid_ingreso_solicitud`) REFERENCES `trd_ingresos_solicitudes` (`tis_id`),
  CONSTRAINT `trd_ingresos_destinos_trd_acceso_usuarios_FK` FOREIGN KEY (`tid_destino`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_destinos` VALUES
(1,1,13,'Para',NULL,NULL,'Lector',0,NULL,NULL,1,'2026-03-09 13:10:18','2026-03-10 10:08:49'),
(2,1,13,'Para',NULL,'tomar conocimiento','Lector',0,NULL,NULL,1,'2026-03-10 10:08:49','2026-03-10 10:12:31'),
(3,1,2,'Para',NULL,'ejecutar lo requerido','Responsable',1,NULL,NULL,1,'2026-03-10 10:08:49','2026-03-10 10:12:31'),
(4,1,13,'Para',NULL,'tomar conocimiento','Lector',0,NULL,NULL,1,'2026-03-10 10:12:31','2026-03-10 10:14:22'),
(5,1,2,'Para',NULL,'ejecutar lo requerido','Responsable',1,NULL,NULL,1,'2026-03-10 10:12:31','2026-03-10 10:14:22'),
(6,1,2,'Para',NULL,'ejecutar lo requerido','Responsable',1,NULL,NULL,0,'2026-03-10 10:14:22','2026-03-10 10:14:22'),
(7,2,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-11 14:15:23','2026-03-11 14:15:23'),
(8,3,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-11 14:18:07','2026-03-11 14:18:07'),
(9,4,2,'Para','Visación aprobada por responsable.',NULL,'Visador',1,1,'2026-03-12 10:03:27',0,'2026-03-11 16:11:53','2026-03-12 10:03:27'),
(10,4,4,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-11 16:11:53','2026-03-11 16:11:53'),
(11,5,1,'Para','tenemos computadores disponibles',NULL,'Responsable',1,1,'2026-03-11 16:23:11',0,'2026-03-11 16:13:19','2026-03-11 16:23:11');
/*!40000 ALTER TABLE `trd_ingresos_destinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_solicitudes`
--

DROP TABLE IF EXISTS `trd_ingresos_solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_solicitudes` (
  `tis_id` int(11) NOT NULL AUTO_INCREMENT,
  `tis_tipo` int(11) NOT NULL,
  `tis_titulo` varchar(100) DEFAULT NULL,
  `tis_contenido` text NOT NULL,
  `tis_estado` varchar(100) NOT NULL DEFAULT 'Ingresado',
  `tis_propietario` int(11) DEFAULT NULL,
  `tis_respuesta` text DEFAULT NULL,
  `tis_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tis_fecha_limite` date DEFAULT NULL,
  `tis_registro_tramite` int(11) NOT NULL,
  `tis_borrado` tinyint(1) DEFAULT 0,
  `tis_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tis_id`),
  KEY `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` (`tis_propietario`),
  KEY `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` (`tis_tipo`),
  KEY `trd_ingresos_registro_general_tramites_FK` (`tis_registro_tramite`),
  CONSTRAINT `trd_ingresos_registro_general_tramites_FK` FOREIGN KEY (`tis_registro_tramite`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` FOREIGN KEY (`tis_propietario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` FOREIGN KEY (`tis_tipo`) REFERENCES `trd_ingresos_tipos_ingreso` (`titi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(1,1,'prueba ingreso de ingreso 001','Prueba 1 realizada con fecha limite ya pasada','Ingresado',1,NULL,'2026-03-09 00:00:00','2026-04-06',2,0,'2026-03-09 13:10:18'),
(2,1,'solicito contratacion de personas','solicito contratación de personal','Ingresado',3,NULL,'2026-03-11 00:00:00','2026-04-08',15,0,'2026-03-11 14:15:23'),
(3,1,'revisa este oficio','revisael oficio adjunto ','Ingresado',2,NULL,'2026-03-11 00:00:00','2026-04-08',16,0,'2026-03-11 14:18:07'),
(4,1,'mas computadores','por favor ejecutar lo requerido','Visado',3,NULL,'2026-03-11 00:00:00','2026-04-08',21,0,'2026-03-12 10:03:27'),
(5,1,'revisar disponibilidad ','por favor revisar lo solicitado e indicar disponibilidad ','Resuelto_Favorable',3,NULL,'2026-03-11 00:00:00','2026-04-08',22,0,'2026-03-11 16:23:11');
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_tipos_ingreso`
--

DROP TABLE IF EXISTS `trd_ingresos_tipos_ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_tipos_ingreso` (
  `titi_id` int(11) NOT NULL AUTO_INCREMENT,
  `titi_nombre` varchar(100) NOT NULL,
  `titi_borrado` tinyint(1) DEFAULT 0,
  `titi_creacion` datetime DEFAULT current_timestamp(),
  `titi_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`titi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_tipos_ingreso`
--

LOCK TABLES `trd_ingresos_tipos_ingreso` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_tipos_ingreso` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_tipos_ingreso` VALUES
(1,'Administrativo',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'Municipal',0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
/*!40000 ALTER TABLE `trd_ingresos_tipos_ingreso` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_etapas`
--

DROP TABLE IF EXISTS `trd_licencias_etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_etapas` (
  `eta_id` int(11) NOT NULL AUTO_INCREMENT,
  `eta_nombre` varchar(100) NOT NULL,
  `eta_borrado` tinyint(1) DEFAULT 0,
  `eta_creacion` datetime DEFAULT current_timestamp(),
  `eta_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`eta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_etapas`
--

LOCK TABLES `trd_licencias_etapas` WRITE;
/*!40000 ALTER TABLE `trd_licencias_etapas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_etapas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_etapas_tramite`
--

DROP TABLE IF EXISTS `trd_licencias_etapas_tramite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_etapas_tramite` (
  `letr_id` int(11) NOT NULL AUTO_INCREMENT,
  `letr_tra_id` int(11) NOT NULL,
  `letr_eta_id` int(11) NOT NULL,
  `letr_orden` int(11) NOT NULL,
  `letr_borrado` tinyint(1) DEFAULT 0,
  `letr_creacion` datetime DEFAULT current_timestamp(),
  `letr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`letr_id`),
  KEY `fk_etr_eta` (`letr_eta_id`) USING BTREE,
  KEY `fk_etr_tra` (`letr_tra_id`) USING BTREE,
  CONSTRAINT `lic_etapas_tramite_trd_licencias_etapas_FK` FOREIGN KEY (`letr_eta_id`) REFERENCES `trd_licencias_etapas` (`eta_id`),
  CONSTRAINT `lic_etapas_tramite_trd_licencias_tramite_FK` FOREIGN KEY (`letr_tra_id`) REFERENCES `trd_licencias_tramite` (`tra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_etapas_tramite`
--

LOCK TABLES `trd_licencias_etapas_tramite` WRITE;
/*!40000 ALTER TABLE `trd_licencias_etapas_tramite` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_etapas_tramite` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_horas_disponibles`
--

DROP TABLE IF EXISTS `trd_licencias_horas_disponibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_horas_disponibles` (
  `tlh_id` int(11) NOT NULL AUTO_INCREMENT,
  `tlh_fecha` date NOT NULL,
  `tlh_bloque_horario` tinyint(4) NOT NULL,
  `tlh_prioidad` int(11) NOT NULL,
  `tlh_cupo` tinyint(4) DEFAULT NULL,
  `tlh_tramite` int(11) NOT NULL,
  `tlh_borrado` tinyint(4) DEFAULT 0,
  `tlh_creacion` datetime DEFAULT current_timestamp(),
  `tlh_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tlh_id`),
  KEY `trd_licencias_horas_disponibles_trd_licencias_tramite_FK` (`tlh_tramite`),
  KEY `trd_licencias_horas_disponibles_trd_licencias_vulnerable_FK` (`tlh_prioidad`),
  CONSTRAINT `trd_licencias_horas_disponibles_trd_licencias_tramite_FK` FOREIGN KEY (`tlh_tramite`) REFERENCES `trd_licencias_tramite` (`tra_id`),
  CONSTRAINT `trd_licencias_horas_disponibles_trd_licencias_vulnerable_FK` FOREIGN KEY (`tlh_prioidad`) REFERENCES `trd_licencias_prioidad` (`tlv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_horas_disponibles`
--

LOCK TABLES `trd_licencias_horas_disponibles` WRITE;
/*!40000 ALTER TABLE `trd_licencias_horas_disponibles` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_horas_disponibles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_modulos`
--

DROP TABLE IF EXISTS `trd_licencias_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_modulos` (
  `mod_id` int(11) NOT NULL,
  `mod_nombre` varchar(50) DEFAULT NULL,
  `mod_rol_nombre` varchar(50) DEFAULT NULL,
  `mod_estado_activo` tinyint(4) DEFAULT 1,
  `mod_borrado` tinyint(1) DEFAULT 0,
  `mod_creacion` datetime DEFAULT current_timestamp(),
  `mod_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_modulos`
--

LOCK TABLES `trd_licencias_modulos` WRITE;
/*!40000 ALTER TABLE `trd_licencias_modulos` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_modulos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_modulos_etapa`
--

DROP TABLE IF EXISTS `trd_licencias_modulos_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_modulos_etapa` (
  `met_id` int(11) NOT NULL AUTO_INCREMENT,
  `met_mod_id` int(11) NOT NULL,
  `met_eta_id` int(11) NOT NULL,
  `met_borrado` tinyint(1) DEFAULT 0,
  `met_creacion` datetime DEFAULT current_timestamp(),
  `met_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`met_id`),
  KEY `fk_met_eta` (`met_eta_id`) USING BTREE,
  KEY `fk_met_mod` (`met_mod_id`) USING BTREE,
  CONSTRAINT `trd_licencias_modulos_etapa_trd_licencias_etapas_FK` FOREIGN KEY (`met_eta_id`) REFERENCES `trd_licencias_etapas` (`eta_id`),
  CONSTRAINT `trd_licencias_modulos_etapa_trd_licencias_modulos_FK` FOREIGN KEY (`met_mod_id`) REFERENCES `trd_licencias_modulos` (`mod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_modulos_etapa`
--

LOCK TABLES `trd_licencias_modulos_etapa` WRITE;
/*!40000 ALTER TABLE `trd_licencias_modulos_etapa` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_modulos_etapa` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_prioidad`
--

DROP TABLE IF EXISTS `trd_licencias_prioidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_prioidad` (
  `tlv_id` int(11) NOT NULL AUTO_INCREMENT,
  `tlv_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tlv_orden` tinyint(1) DEFAULT NULL,
  `tlv_borrado` tinyint(1) DEFAULT 0,
  `tlv_creacion` datetime DEFAULT current_timestamp(),
  `tlv_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tlv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_prioidad`
--

LOCK TABLES `trd_licencias_prioidad` WRITE;
/*!40000 ALTER TABLE `trd_licencias_prioidad` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_licencias_prioidad` VALUES
(1,'Otros',4,0,'2026-03-03 11:21:02','2026-03-03 13:00:45'),
(2,'Tercera edad',1,0,'2026-03-03 11:21:02','2026-03-03 13:00:45'),
(3,'Prioritarios',2,0,'2026-03-03 12:59:32','2026-03-03 13:00:45'),
(4,'Vecinos',3,0,'2026-03-03 12:59:32','2026-03-03 13:00:45');
/*!40000 ALTER TABLE `trd_licencias_prioidad` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_ruta_ticket`
--

DROP TABLE IF EXISTS `trd_licencias_ruta_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_ruta_ticket` (
  `rut_id` int(11) NOT NULL AUTO_INCREMENT,
  `rut_eta_id` int(11) NOT NULL,
  `rut_tic_id` int(11) NOT NULL,
  `rut_estado` int(11) DEFAULT 0,
  `rut_funcionario_a_cargo` int(11) DEFAULT NULL,
  `rut_hora_ingreso` datetime DEFAULT NULL,
  `rut_hora_salida` datetime DEFAULT NULL,
  `rut_borrado` tinyint(1) DEFAULT 0,
  `rut_creacion` datetime DEFAULT current_timestamp(),
  `rut_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rut_id`),
  KEY `fk_rut_eta` (`rut_eta_id`) USING BTREE,
  KEY `fk_rut_tic` (`rut_tic_id`) USING BTREE,
  KEY `trd_licencias_ruta_ticket_trd_acceso_usuarios_FK` (`rut_funcionario_a_cargo`),
  CONSTRAINT `trd_licencias_ruta_ticket_trd_acceso_usuarios_FK` FOREIGN KEY (`rut_funcionario_a_cargo`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_licencias_ruta_ticket_trd_licencias_etapas_FK` FOREIGN KEY (`rut_eta_id`) REFERENCES `trd_licencias_etapas` (`eta_id`),
  CONSTRAINT `trd_licencias_ruta_ticket_trd_licencias_ticket_FK` FOREIGN KEY (`rut_tic_id`) REFERENCES `trd_licencias_ticket` (`tic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_ruta_ticket`
--

LOCK TABLES `trd_licencias_ruta_ticket` WRITE;
/*!40000 ALTER TABLE `trd_licencias_ruta_ticket` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_ruta_ticket` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_ticket`
--

DROP TABLE IF EXISTS `trd_licencias_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_ticket` (
  `tic_id` int(11) NOT NULL AUTO_INCREMENT,
  `tic_con_id` int(11) NOT NULL,
  `tic_tra_id` int(11) NOT NULL,
  `tic_sec_id` int(11) NOT NULL,
  `tic_turno` int(11) NOT NULL,
  `tic_retorno` tinyint(4) NOT NULL DEFAULT 0,
  `tic_fecha` date DEFAULT NULL,
  `tic_estado` varchar(100) DEFAULT NULL,
  `tic_borrado` tinyint(1) DEFAULT 0,
  `tic_creacion` datetime DEFAULT current_timestamp(),
  `tic_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tic_id`),
  KEY `fk_tic_con` (`tic_con_id`) USING BTREE,
  KEY `fk_tic_tra` (`tic_tra_id`) USING BTREE,
  KEY `trd_licencias_ticket_trd_licencias_horas_disponibles_FK` (`tic_turno`),
  CONSTRAINT `trd_licencias_ticket_trd_general_contribuyentes_FK` FOREIGN KEY (`tic_con_id`) REFERENCES `trd_general_contribuyentes` (`tgc_id`),
  CONSTRAINT `trd_licencias_ticket_trd_licencias_horas_disponibles_FK` FOREIGN KEY (`tic_turno`) REFERENCES `trd_licencias_horas_disponibles` (`tlh_id`),
  CONSTRAINT `trd_licencias_ticket_trd_licencias_tramite_FK` FOREIGN KEY (`tic_tra_id`) REFERENCES `trd_licencias_tramite` (`tra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_ticket`
--

LOCK TABLES `trd_licencias_ticket` WRITE;
/*!40000 ALTER TABLE `trd_licencias_ticket` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_ticket` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_tramite`
--

DROP TABLE IF EXISTS `trd_licencias_tramite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_tramite` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_nombre` varchar(100) DEFAULT NULL,
  `tra_borrado` tinyint(1) DEFAULT 0,
  `tra_creacion` datetime DEFAULT current_timestamp(),
  `tra_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_tramite`
--

LOCK TABLES `trd_licencias_tramite` WRITE;
/*!40000 ALTER TABLE `trd_licencias_tramite` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_licencias_tramite` VALUES
(1,'Renovación de licencia',0,'2026-03-03 10:08:58','2026-03-03 10:49:11'),
(2,'Obtención primera licencia',0,'2026-03-03 10:09:32','2026-03-03 10:49:11'),
(3,'Control 6 años',0,'2026-03-03 10:09:43','2026-03-03 10:49:11'),
(4,'Duplicado',0,'2026-03-03 10:09:53','2026-03-03 10:49:11'),
(5,'Cambio de clase',0,'2026-03-03 10:09:59','2026-03-03 10:49:11'),
(6,NULL,1,'2026-03-03 10:10:04','2026-03-03 10:10:08');
/*!40000 ALTER TABLE `trd_licencias_tramite` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_asignaciones`
--

DROP TABLE IF EXISTS `trd_oirs_asignaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_asignaciones` (
  `oia_id` int(11) NOT NULL AUTO_INCREMENT,
  `oia_solicitud` int(11) NOT NULL,
  `oia_asignador` int(11) NOT NULL,
  `oia_asignacion` int(11) NOT NULL,
  `oia_nivel_asignacion` tinyint(4) NOT NULL,
  `oia_Instruccion` text DEFAULT NULL,
  `oia_estado` tinyint(1) DEFAULT 0,
  `oia_borrado` tinyint(1) DEFAULT 0,
  `oia_creacion` datetime DEFAULT current_timestamp(),
  `oia_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`oia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones`
--

LOCK TABLES `trd_oirs_asignaciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_asignaciones` VALUES
(1,2,3,1,1,'Necesito que me revises si es factible retirar el basural de este sector',0,1,'2026-03-09 13:22:50','2026-03-10 12:25:53'),
(2,2,2,3,1,'necesito si puedes ver si corresponde a un terreno publico y no privado',0,1,'2026-03-09 13:23:40','2026-03-10 12:25:54'),
(3,2,2,21,1,'frfe',0,1,'2026-03-09 17:33:28','2026-03-10 12:25:54'),
(4,2,2,1,1,'revisa esto',0,1,'2026-03-10 08:33:59','2026-03-10 12:25:54'),
(5,2,2,3,1,'Revisame esta oirs y ver si es posible llevarla a cabo',2,0,'2026-03-10 12:22:18','2026-03-10 13:46:22'),
(6,2,3,1,1,'proceder',2,0,'2026-03-10 12:23:38','2026-03-11 10:26:02'),
(7,1,2,3,1,'revisar oirs y ver si se puede ejecutar',0,0,'2026-03-10 17:24:39','2026-03-10 17:24:39'),
(8,3,3,1,1,'por favor hacer estudio de esto',2,0,'2026-03-10 17:37:56','2026-03-10 17:40:47'),
(9,3,2,39,1,'por favor rodrigo, ver esto',0,0,'2026-03-10 17:38:59','2026-03-10 17:38:59'),
(10,4,2,3,1,'por favor ver este tema.',0,0,'2026-03-10 17:47:53','2026-03-10 17:47:53'),
(11,4,3,1,1,'por favor revisa esto.',2,0,'2026-03-10 17:49:23','2026-03-10 17:51:47'),
(12,6,2,3,1,'por favor revisar esto',0,0,'2026-03-10 18:24:16','2026-03-10 18:24:16'),
(13,6,2,39,1,'revisa',0,0,'2026-03-10 18:28:46','2026-03-10 18:28:46'),
(14,6,3,1,1,'favor revisa',0,0,'2026-03-10 18:35:11','2026-03-10 18:35:11'),
(15,7,2,3,1,'Estimado Ramón favor revisar esta solicitud',2,0,'2026-03-11 12:00:57','2026-03-11 12:08:31'),
(16,7,3,1,1,'juan revisa si corresponde a nuestra autoridad',2,0,'2026-03-11 12:02:11','2026-03-11 12:06:51'),
(17,8,2,3,1,'puedes revisar si es factible llevar a cabo este caso',0,0,'2026-03-11 15:42:24','2026-03-11 15:42:24'),
(18,8,3,1,1,'juan me confirmas si es posible llevar a cabo este caso',0,0,'2026-03-11 15:43:27','2026-03-11 15:43:27'),
(19,12,2,3,1,'',0,0,'2026-03-11 18:06:37','2026-03-11 18:06:37'),
(20,12,3,1,1,'DIME SI PODEMOS HACER ESTO ',2,0,'2026-03-11 18:08:01','2026-03-11 18:12:03');
/*!40000 ALTER TABLE `trd_oirs_asignaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_asignaciones_comentarios`
--

DROP TABLE IF EXISTS `trd_oirs_asignaciones_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_asignaciones_comentarios` (
  `oac_id` int(11) NOT NULL AUTO_INCREMENT,
  `oac_asignacion` int(11) NOT NULL,
  `oac_texto` text NOT NULL,
  `oac_autor` int(11) NOT NULL,
  `oac_marcado` tinyint(4) NOT NULL DEFAULT 0,
  `oac_borrado` tinyint(4) NOT NULL DEFAULT 0,
  `oac_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `oac_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`oac_id`),
  KEY `trd_oirs_asignaciones_comentarios_trd_oirs_asignaciones_FK` (`oac_asignacion`),
  KEY `trd_oirs_asignaciones_comentarios_trd_acceso_usuarios_FK` (`oac_autor`),
  CONSTRAINT `trd_oirs_asignaciones_comentarios_trd_acceso_usuarios_FK` FOREIGN KEY (`oac_autor`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_asignaciones_comentarios_trd_oirs_asignaciones_FK` FOREIGN KEY (`oac_asignacion`) REFERENCES `trd_oirs_asignaciones` (`oia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones_comentarios`
--

LOCK TABLES `trd_oirs_asignaciones_comentarios` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones_comentarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_asignaciones_comentarios` VALUES
(1,5,'confirmo que es posible llevarla a cabo',3,0,0,'2026-03-10 13:12:46',NULL),
(2,5,'me confrimas cuando se puede llevar a cabo',2,0,0,'2026-03-10 13:15:06',NULL),
(3,6,'procedo',1,0,0,'2026-03-10 13:30:24',NULL),
(4,5,'Aceptar',2,1,0,'2026-03-10 13:46:22',NULL),
(5,7,'no se puede ejecutar ',3,0,0,'2026-03-10 17:25:06',NULL),
(6,7,'Rechazar',2,2,0,'2026-03-10 17:25:24',NULL),
(7,8,'estimado cargué informe de viabilidad de trabajo a realizar.',1,0,0,'2026-03-10 17:40:20',NULL),
(8,8,'Aceptar',3,1,0,'2026-03-10 17:40:47',NULL),
(9,10,'estimada, lo veré con mi equipo.',3,0,0,'2026-03-10 17:49:08',NULL),
(10,11,'estimado, esto se realizarà según la planificación programada.',1,0,0,'2026-03-10 17:50:54',NULL),
(11,11,'muchas gracias por la información',3,1,0,'2026-03-10 17:51:47',NULL),
(12,14,'esta listo',1,0,0,'2026-03-10 18:36:05',NULL),
(13,6,'Aceptar',3,1,0,'2026-03-11 10:26:02',NULL),
(14,15,'Se deriva a encargado tematico para revisión',3,0,0,'2026-03-11 12:02:33',NULL),
(15,16,'Estimado ramón según la ley xxx es posible llevarla acabo tenemos que realizar la planificación para darte una fecha de ejecución',1,0,0,'2026-03-11 12:06:12',NULL),
(16,16,'Aceptar',3,1,0,'2026-03-11 12:06:51',NULL),
(17,15,'Según el encargado tematico es factible solo se debe planificar ',3,0,0,'2026-03-11 12:07:23',NULL),
(18,15,'tomo conocimiento proceso a cerrar la conversción',2,1,0,'2026-03-11 12:08:31',NULL),
(19,19,'LO ESTOY REVISANDO, ',3,0,0,'2026-03-11 18:08:24',NULL),
(20,20,'SE PUEDE ADJUNTO INFORME',1,0,0,'2026-03-11 18:11:01',NULL),
(21,20,'Aceptar',3,1,0,'2026-03-11 18:12:03',NULL);
/*!40000 ALTER TABLE `trd_oirs_asignaciones_comentarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_condiciones`
--

DROP TABLE IF EXISTS `trd_oirs_condiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_condiciones` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_nombre` varchar(100) NOT NULL,
  `con_borrado` tinyint(1) DEFAULT 0,
  `con_creacion` datetime DEFAULT current_timestamp(),
  `con_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_condiciones`
--

LOCK TABLES `trd_oirs_condiciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_condiciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_condiciones` VALUES
(1,'Ninguno',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(2,'Embarazada',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(3,'Persona con Discapacidad',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(4,'Dirigente Social / Comunitario',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(5,'Adulto Mayor',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(6,'Pueblos Originarios',0,'2026-02-19 19:44:53','2026-02-23 13:45:58'),
(7,'Cuidador/a',0,'2026-02-23 13:45:58','2026-02-23 13:45:58');
/*!40000 ALTER TABLE `trd_oirs_condiciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_funcionarios_areas`
--

DROP TABLE IF EXISTS `trd_oirs_funcionarios_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_funcionarios_areas` (
  `ofa_id` int(11) NOT NULL AUTO_INCREMENT,
  `ofa_funcionario` int(11) NOT NULL,
  `ofa_area` int(11) NOT NULL,
  `ofa_p` tinyint(4) NOT NULL DEFAULT 0,
  `ofa_borrado` tinyint(4) DEFAULT 0,
  `ofa_creacion` datetime DEFAULT NULL,
  `ofa_actualizacion` datetime DEFAULT NULL,
  `ofa_rol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ofa_id`),
  KEY `trd_oirs_funcionarios_areas_trd_acceso_usuarios_FK` (`ofa_funcionario`),
  KEY `trd_oirs_funcionarios_areas_trd_general_areas_FK` (`ofa_area`),
  CONSTRAINT `trd_oirs_funcionarios_areas_trd_acceso_usuarios_FK` FOREIGN KEY (`ofa_funcionario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_funcionarios_areas_trd_general_areas_FK` FOREIGN KEY (`ofa_area`) REFERENCES `trd_general_areas` (`tga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_funcionarios_areas`
--

LOCK TABLES `trd_oirs_funcionarios_areas` WRITE;
/*!40000 ALTER TABLE `trd_oirs_funcionarios_areas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_funcionarios_areas` VALUES
(1,1,1,0,1,NULL,NULL,'Encargado Temático'),
(2,2,2,0,0,NULL,NULL,'Encargado OIRS'),
(3,3,1,1,0,NULL,NULL,'Jefe/Director'),
(4,1,1,0,0,NULL,NULL,'Encargado Temático'),
(5,4,1,1,1,NULL,NULL,'Jefe/Director'),
(6,17,5,0,0,NULL,NULL,NULL),
(7,18,5,0,0,NULL,NULL,NULL),
(8,19,5,1,0,NULL,NULL,'Jefe/Director'),
(9,20,6,0,0,NULL,NULL,NULL),
(10,21,6,1,0,NULL,NULL,'Jefe/Director'),
(11,22,7,0,0,NULL,NULL,NULL),
(12,23,7,0,0,NULL,NULL,NULL),
(13,24,7,0,0,NULL,NULL,NULL),
(14,25,7,1,0,NULL,NULL,'Jefe/Director'),
(15,26,8,0,0,NULL,NULL,NULL),
(16,27,8,0,0,NULL,NULL,NULL),
(17,28,8,1,0,NULL,NULL,'Jefe/Director'),
(18,29,9,0,0,NULL,NULL,NULL),
(19,30,9,0,0,NULL,NULL,NULL),
(20,31,9,0,0,NULL,NULL,NULL),
(21,32,9,0,0,NULL,NULL,NULL),
(22,33,9,1,0,NULL,NULL,'Jefe/Director'),
(23,34,10,0,0,NULL,NULL,NULL),
(24,35,10,0,0,NULL,NULL,NULL),
(25,36,10,0,0,NULL,NULL,NULL),
(26,37,10,0,0,NULL,NULL,NULL),
(27,38,10,0,0,NULL,NULL,NULL),
(28,39,1,1,0,NULL,NULL,'Jefe/Director'),
(29,40,11,0,0,NULL,NULL,NULL),
(30,41,11,0,0,NULL,NULL,NULL),
(31,42,11,0,0,NULL,NULL,NULL),
(32,43,11,0,0,NULL,NULL,NULL),
(33,44,11,0,0,NULL,NULL,NULL),
(34,45,11,1,0,NULL,NULL,'Jefe/Director');
/*!40000 ALTER TABLE `trd_oirs_funcionarios_areas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_gestion`
--

DROP TABLE IF EXISTS `trd_oirs_gestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_gestion` (
  `oig_id` int(11) NOT NULL AUTO_INCREMENT,
  `oig_solicitud` int(11) NOT NULL,
  `oig_asignacion` int(11) DEFAULT NULL,
  `oig_respuesta_preliminar` text DEFAULT NULL,
  `oig_res_pre_origen` int(11) DEFAULT NULL,
  `oig_res_pre_fecha` datetime DEFAULT NULL,
  `oig_requiere_respuesta_tecnica` tinyint(1) DEFAULT NULL,
  `oig_respuesta_tecnica` text DEFAULT NULL,
  `oig_res_tec_origen` int(11) DEFAULT NULL,
  `oig_res_tec_fecha` datetime DEFAULT NULL,
  `oig_solicitud_ejecutada` tinyint(1) DEFAULT NULL,
  `oig_fuente_financiamiento` varchar(100) DEFAULT NULL,
  `oig_notificacion_ejecucion` text DEFAULT NULL,
  `oig_res_not_origen` int(11) DEFAULT NULL,
  `oig_res_not_fecha` datetime DEFAULT NULL,
  `oig_realizada_en_plazo` tinyint(1) DEFAULT NULL,
  `oig_aclaratoria_contribuyente` text DEFAULT NULL,
  `oig_respuesta_aclaratoria` text DEFAULT NULL,
  `oig_borrado` tinyint(1) DEFAULT 0,
  `oig_creacion` datetime DEFAULT current_timestamp(),
  `oig_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`oig_id`),
  KEY `fk_gestion_solicitud` (`oig_solicitud`),
  KEY `trd_oirs_gestion_trd_acceso_usuarios_FK` (`oig_res_pre_origen`),
  KEY `trd_oirs_gestion_trd_acceso_usuarios_FK_1` (`oig_res_tec_origen`),
  KEY `trd_oirs_gestion_trd_acceso_usuarios_FK_2` (`oig_res_not_origen`),
  CONSTRAINT `fk_gestion_solicitud` FOREIGN KEY (`oig_solicitud`) REFERENCES `trd_oirs_solicitud` (`oirs_id`) ON DELETE CASCADE,
  CONSTRAINT `trd_oirs_gestion_trd_acceso_usuarios_FK` FOREIGN KEY (`oig_res_pre_origen`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_gestion_trd_acceso_usuarios_FK_1` FOREIGN KEY (`oig_res_tec_origen`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_gestion_trd_acceso_usuarios_FK_2` FOREIGN KEY (`oig_res_not_origen`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_gestion`
--

LOCK TABLES `trd_oirs_gestion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_gestion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_gestion` VALUES
(1,1,NULL,'se reqiiere aclaacion',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-09 12:08:18','2026-03-09 12:08:18'),
(2,2,NULL,'estimada vecina acuso recibo será derivada al area tecnica para evaluación',2,'2026-03-09 17:17:14',1,'seaprueba retiro de basural se deriva a planificacion para dar fecha',2,'2026-03-09 17:17:14',1,'Recursos Propios','',2,'2026-03-09 17:17:14',NULL,NULL,'',0,'2026-03-09 13:11:01','2026-03-09 13:17:14'),
(3,3,NULL,'estimado vecino, lo veremos muchas gracias.\n\nserá derivado a unidad técnica',3,'2026-03-10 21:37:27',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 17:31:07','2026-03-10 17:37:27'),
(4,4,NULL,'estimado, esto se realizarà según la planificación programada.\n\nsaludos,',3,'2026-03-10 21:53:18',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 17:44:18','2026-03-10 17:53:18'),
(5,5,NULL,'estimado, esto no lo puede ver el municipio.',2,'2026-03-10 22:02:21',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 17:54:58','2026-03-10 18:02:21'),
(6,6,NULL,'estimado, revisarè esto con el equipo. ',2,'2026-03-10 22:03:43',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-10 18:03:26','2026-03-10 18:03:43'),
(7,7,NULL,'Estimado vecino se va a derivar al area tecnica correspondiente para que pueda evaluar su caso ',2,'2026-03-11 15:15:52',1,'Estimado vecino según la ley xxx es posible llevarla acabo tenemos que realizar la planificación para darte una fecha de ejecución',3,'2026-03-11 16:07:48',1,'Recursos Propios','Estimado vecino el cambio de luminarias fue llevado a cabo el 10 marzo saludos',3,'2026-03-11 16:28:10',1,NULL,NULL,0,'2026-03-11 10:33:28','2026-03-11 12:28:10'),
(8,8,NULL,'Estimado vecino su caso será derivado al area tecnica para evaluar la posibilidad de llevarlo a cabo',2,'2026-03-11 19:41:54',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-11 14:28:10','2026-03-11 15:41:54'),
(9,9,NULL,'',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-11 14:30:30','2026-03-11 14:30:30'),
(10,10,NULL,'',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-11 14:31:50','2026-03-11 14:31:50'),
(11,11,NULL,'',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-11 14:34:10','2026-03-11 14:34:10'),
(12,12,NULL,'ESTIMADO VECINO\nESTO LO VERÀ LA UNIDAD TÉCNICA',2,'2026-03-11 22:05:22',1,'SE PUEDE ADJUNTO INFORME',3,'2026-03-11 22:12:59',1,'Recursos Propios','LO HICIMOS AMIGO!!',3,'2026-03-11 22:13:37',1,NULL,NULL,0,'2026-03-11 17:20:13','2026-03-11 18:13:37');
/*!40000 ALTER TABLE `trd_oirs_gestion` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_solicitud`
--

DROP TABLE IF EXISTS `trd_oirs_solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_solicitud` (
  `oirs_id` int(11) NOT NULL AUTO_INCREMENT,
  `oirs_registro_tramite` int(11) NOT NULL,
  `oirs_tipo_atencion` int(11) NOT NULL,
  `oirs_origen_consulta` varchar(100) NOT NULL,
  `oirs_condicion` int(11) DEFAULT NULL,
  `oirs_prioridad_municipal` tinyint(4) NOT NULL,
  `oirs_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `oirs_tematica` int(11) NOT NULL,
  `oirs_subtematica` int(11) DEFAULT NULL,
  `oirs_calle` varchar(100) DEFAULT NULL,
  `oirs_numero` varchar(100) DEFAULT NULL,
  `oirs_aclaratoria` text DEFAULT NULL,
  `oirs_latitud` decimal(10,8) DEFAULT NULL,
  `oirs_longitud` decimal(10,8) DEFAULT NULL,
  `oirs_sector` int(11) DEFAULT NULL,
  `oirs_descripcion` text NOT NULL,
  `oirs_estado` tinyint(4) NOT NULL,
  `oirs_fecha_limite` date NOT NULL,
  `oirs_borrado` tinyint(1) DEFAULT 0,
  `oirs_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `oirs_direccion_completa` text DEFAULT NULL,
  `oirs_propietario` int(11) DEFAULT 1,
  PRIMARY KEY (`oirs_id`),
  KEY `trd_oirs_solicitud_trd_general_registro_general_tramites_FK` (`oirs_registro_tramite`),
  KEY `trd_oirs_solicitud_trd_oirs_condiciones_FK` (`oirs_condicion`),
  KEY `trd_oirs_solicitud_trd_oirs_tipo_atencion_FK` (`oirs_tipo_atencion`),
  KEY `trd_oirs_solicitud_trd_oirs_tematicas_FK` (`oirs_tematica`),
  KEY `trd_oirs_solicitud_trd_oirs_subtematicas_FK` (`oirs_subtematica`),
  KEY `trd_oirs_solicitud_trd_general_sectores_FK` (`oirs_sector`),
  KEY `trd_oirs_solicitud_trd_acceso_usuarios_FK` (`oirs_propietario`),
  CONSTRAINT `trd_oirs_solicitud_trd_acceso_usuarios_FK` FOREIGN KEY (`oirs_propietario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_general_registro_general_tramites_FK` FOREIGN KEY (`oirs_registro_tramite`) REFERENCES `trd_general_registro_general_expedientes` (`rgt_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_general_sectores_FK` FOREIGN KEY (`oirs_sector`) REFERENCES `trd_general_sectores` (`sec_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_oirs_condiciones_FK` FOREIGN KEY (`oirs_condicion`) REFERENCES `trd_oirs_condiciones` (`con_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_oirs_subtematicas_FK` FOREIGN KEY (`oirs_subtematica`) REFERENCES `trd_oirs_subtematicas` (`sub_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_oirs_tematicas_FK` FOREIGN KEY (`oirs_tematica`) REFERENCES `trd_oirs_tematicas` (`tem_id`),
  CONSTRAINT `trd_oirs_solicitud_trd_oirs_tipo_atencion_FK` FOREIGN KEY (`oirs_tipo_atencion`) REFERENCES `trd_oirs_tipo_atencion` (`tat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_solicitud`
--

LOCK TABLES `trd_oirs_solicitud` WRITE;
/*!40000 ALTER TABLE `trd_oirs_solicitud` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_solicitud` VALUES
(1,1,1,'Web',1,1,'2026-03-09 12:08:18',1,1,'quinta 100',NULL,NULL,-33.02377550,-71.55397870,13,'ventiladores',1,'2026-03-30',0,'2026-03-09 12:08:18','quinta 100',1),
(2,3,2,'Web',5,1,'2026-03-09 13:11:01',2,2,'Tamarugal 533, Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02944631,-71.49352648,1,'favor ayuda con retiro de microbasurales',0,'2026-03-30',0,'2026-03-09 13:11:01','Tamarugal 533, Viña del Mar, Valparaíso, Chile',2),
(3,10,1,'Presencial',1,1,'2026-03-10 17:31:07',2,2,'2 norte 162',NULL,NULL,-33.02095260,-71.55789920,11,'hay microbasurles',0,'2026-03-31',0,'2026-03-10 17:31:07','2 norte 162',3),
(4,11,1,'Presencial',1,1,'2026-03-10 17:44:18',2,3,'alvarez 622',NULL,NULL,-33.02647800,-71.55399670,NULL,'revisar este caso',0,'2026-03-31',0,'2026-03-10 17:44:18','alvarez 622',3),
(5,12,1,'Presencial',1,1,'2026-03-10 17:54:58',3,4,'alvarez 622',NULL,NULL,-33.02647800,-71.55399670,11,'necesito ayuda para pintar mi casa',0,'2026-03-31',0,'2026-03-10 17:54:58','alvarez 622',2),
(6,13,1,'Presencial',1,1,'2026-03-10 18:03:26',2,2,'lebu 123',NULL,NULL,-33.02965640,-71.49606170,1,'necesito ayuda para resolver esto',0,'2026-03-31',0,'2026-03-10 18:03:26','lebu 123',2),
(7,14,5,'Web',1,1,'2026-03-11 10:33:28',3,4,'Arlegui 839, 2520426 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02421214,-71.54974006,11,'favor su ayuda para aumentar luminarias en el sector',0,'2026-04-01',0,'2026-03-11 10:33:28','Arlegui 839, 2520426 Viña del Mar, Valparaíso, Chile',3),
(8,17,1,'Presencial',1,1,'2026-03-11 14:28:10',2,2,'alvarez 622',NULL,NULL,-33.02647800,-71.55399670,NULL,'necesito ayuda',0,'2026-04-01',0,'2026-03-11 14:28:10','alvarez 622',3),
(9,18,1,'Presencial',1,1,'2026-03-11 14:30:30',3,4,'2 norte 162',NULL,NULL,-33.02095260,-71.55789920,NULL,'perros',0,'2026-04-01',0,'2026-03-11 14:30:30','2 norte 162',3),
(10,19,1,'Web',1,1,'2026-03-11 14:31:50',2,2,'libetad1410',NULL,NULL,-33.02581230,-71.50705760,3,'retiro de microbasural',0,'2026-04-01',0,'2026-03-11 14:31:50','libetad1410',2),
(11,20,1,'Presencial',1,1,'2026-03-11 14:34:10',4,6,'2 norte 162',NULL,NULL,-33.02095260,-71.55789920,NULL,'caos',0,'2026-04-01',0,'2026-03-11 14:34:10','2 norte 162',3),
(12,23,1,'Presencial',1,1,'2026-03-11 17:20:13',2,2,'alvarez 622',NULL,NULL,-33.02647800,-71.55399670,11,'neceisto que retiren una basura',0,'2026-04-01',0,'2026-03-11 17:20:13','alvarez 622',3);
/*!40000 ALTER TABLE `trd_oirs_solicitud` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_subtematicas`
--

DROP TABLE IF EXISTS `trd_oirs_subtematicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_subtematicas` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_id` int(11) NOT NULL,
  `sub_nombre` varchar(100) NOT NULL,
  `sub_borrado` tinyint(1) DEFAULT 0,
  `sub_creacion` datetime DEFAULT current_timestamp(),
  `sub_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sub_id`),
  KEY `fk_sub_tematica` (`tem_id`),
  CONSTRAINT `fk_sub_tematica` FOREIGN KEY (`tem_id`) REFERENCES `trd_oirs_tematicas` (`tem_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_subtematicas`
--

LOCK TABLES `trd_oirs_subtematicas` WRITE;
/*!40000 ALTER TABLE `trd_oirs_subtematicas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_subtematicas` VALUES
(1,1,'otro',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,2,'Extracción de microbasurales',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,2,'Tenencia responsable de mascotas',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,3,'Iluminación pública deficiente',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,3,'Patrullaje preventivo',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,4,'Subsidios y Ayudas sociales',0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
/*!40000 ALTER TABLE `trd_oirs_subtematicas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_tematicas`
--

DROP TABLE IF EXISTS `trd_oirs_tematicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_tematicas` (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_nombre` varchar(100) NOT NULL,
  `tem_borrado` tinyint(1) DEFAULT 0,
  `tem_creacion` datetime DEFAULT current_timestamp(),
  `tem_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_tematicas`
--

LOCK TABLES `trd_oirs_tematicas` WRITE;
/*!40000 ALTER TABLE `trd_oirs_tematicas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_tematicas` VALUES
(1,'Otro',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'Medio Ambiente',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,'Seguridad',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,'Social',0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
/*!40000 ALTER TABLE `trd_oirs_tematicas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_oirs_tipo_atencion`
--

DROP TABLE IF EXISTS `trd_oirs_tipo_atencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_tipo_atencion` (
  `tat_id` int(11) NOT NULL AUTO_INCREMENT,
  `tat_nombre` varchar(50) NOT NULL,
  `tat_borrado` tinyint(1) DEFAULT 0,
  `tat_creacion` datetime DEFAULT current_timestamp(),
  `tat_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_tipo_atencion`
--

LOCK TABLES `trd_oirs_tipo_atencion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_tipo_atencion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_tipo_atencion` VALUES
(1,'Consulta',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'Reclamo',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,'Sugerencia',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,'Felicitación',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,'Denuncia',0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
/*!40000 ALTER TABLE `trd_oirs_tipo_atencion` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_soporte_feriados`
--

DROP TABLE IF EXISTS `trd_soporte_feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_soporte_feriados` (
  `fer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fer_creacion` date NOT NULL,
  `fer_motivo` varchar(100) DEFAULT NULL,
  `fer_tipo` varchar(20) DEFAULT 'Civil',
  `fer_borrado` tinyint(1) DEFAULT 0,
  `fer_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`fer_id`),
  UNIQUE KEY `fer_creacion` (`fer_creacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_soporte_feriados`
--

LOCK TABLES `trd_soporte_feriados` WRITE;
/*!40000 ALTER TABLE `trd_soporte_feriados` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_soporte_feriados` VALUES
(1,'2026-01-01','Año Nuevo','Civil',0,'2026-02-19 19:44:52'),
(2,'2026-04-03','Viernes Santo','Civil',0,'2026-02-19 19:44:52'),
(3,'2026-04-04','Sábado Santo','Civil',0,'2026-02-19 19:44:52'),
(4,'2026-05-01','Día del Trabajo','Civil',0,'2026-02-19 19:44:52'),
(5,'2026-05-21','Día de las Glorias Navales','Civil',0,'2026-02-19 19:44:52'),
(6,'2026-06-29','San Pedro y San Pablo','Civil',0,'2026-02-19 19:44:52'),
(7,'2026-07-16','Día de la Virgen del Carmen','Civil',0,'2026-02-19 19:44:52'),
(8,'2026-08-15','Asunción de la Virgen','Civil',0,'2026-02-19 19:44:52'),
(9,'2026-09-18','Fiestas Patrias','Civil',0,'2026-02-19 19:44:52'),
(10,'2026-09-19','Glorias del Ejército','Civil',0,'2026-02-19 19:44:52'),
(11,'2026-10-12','Encuentro de Dos Mundos','Civil',0,'2026-02-19 19:44:52'),
(12,'2026-10-31','Día de las Iglesias Evangélicas','Civil',0,'2026-02-19 19:44:52'),
(13,'2026-11-01','Día de Todos los Santos','Civil',0,'2026-02-19 19:44:52'),
(14,'2026-12-08','Inmaculada Concepción','Civil',0,'2026-02-19 19:44:52'),
(15,'2026-12-25','Navidad','Civil',0,'2026-02-19 19:44:52');
/*!40000 ALTER TABLE `trd_soporte_feriados` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_tareas`
--

DROP TABLE IF EXISTS `trd_tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_tareas` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_asignador` int(11) NOT NULL,
  `tar_asignado` int(11) NOT NULL,
  `tar_titulo` varchar(100) NOT NULL,
  `tar_detalle` text DEFAULT NULL,
  `tar_plazo` datetime DEFAULT NULL,
  `tar_estado` tinyint(4) NOT NULL,
  `tar_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tar_borrado` tinyint(1) DEFAULT 0,
  `tar_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_tareas`
--

LOCK TABLES `trd_tareas` WRITE;
/*!40000 ALTER TABLE `trd_tareas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_tareas` VALUES
(1,3,2,'consulta','preguntale a juan comofunciona su esperpento ','2026-03-16 08:00:00',0,'2026-03-10 16:17:13',0,'2026-03-10 16:17:13'),
(2,3,3,'IR AL PALACIO','IR A LA PALACIO','2026-03-16 15:30:00',0,'2026-03-11 19:08:03',0,'2026-03-11 19:08:03'),
(3,3,4,'REVISAR PLAZA MEXICO','TEST2','2026-04-15 08:00:00',0,'2026-03-11 19:10:10',0,'2026-03-11 19:10:10');
/*!40000 ALTER TABLE `trd_tareas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Dumping routines for database 'transformacion_digital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-03-12 10:15:58
