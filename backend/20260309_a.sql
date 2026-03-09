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
  `pfr_perfil_id` int(11) DEFAULT NULL,
  `pfr_rol_id` varchar(20) DEFAULT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `trd_acceso_perfiles_roles_trd_acceso_roles_FK` (`pfr_rol_id`),
  KEY `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` (`pfr_perfil_id`),
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` FOREIGN KEY (`pfr_perfil_id`) REFERENCES `trd_acceso_roles` (`prf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_roles_FK` FOREIGN KEY (`pfr_rol_id`) REFERENCES `trd_acceso_permisos` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permiso_rol`
--

LOCK TABLES `trd_acceso_permiso_rol` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permiso_rol` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permiso_rol` VALUES
(1,'1',1,'2026-02-02 08:34:53','2026-02-24 09:59:56'),
(1,'1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(1,'1.1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(1,'1.1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(1,'1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(1,'1.2.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54'),
(1,'1.2.1.1',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(1,'1.2.1.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(1,'1.2.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(1,'1.2.2.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.2',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.4',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(1,'1.2.3.5',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(1,'A.0',0,'2026-02-02 08:40:58','2026-02-02 08:40:58'),
(4,'4',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(4,'4.1',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(4,'4.2',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(4,'4.3',0,'2026-02-02 08:41:16','2026-02-02 08:41:16'),
(4,'4.4',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(4,'4.5',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(4,'4.6',0,'2026-02-02 08:41:17','2026-02-02 08:41:17'),
(8,'8',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(8,'8.1',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(8,'8.2',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(8,'8.3',0,'2026-02-02 08:41:42','2026-02-02 08:41:42'),
(8,'8.4',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(8,'8.5',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(8,'8.6',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(8,'8.7',0,'2026-02-02 08:41:43','2026-02-02 08:41:43'),
(9,'4.3',1,'2026-02-02 15:42:38','2026-02-24 10:00:21'),
(9,'4.6',1,'2026-02-02 15:42:38','2026-02-24 10:00:29'),
(9,'4',1,'2026-02-02 15:52:03','2026-02-24 10:00:06'),
(2,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(7,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(8,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(9,'A.0',1,'2026-02-06 13:45:20','2026-02-24 09:59:51'),
(3,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(4,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(5,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(6,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(10,'10',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(10,'10.1',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(10,'10.2',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.3',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.4',1,'2026-02-10 16:35:46','2026-02-26 13:34:46'),
(10,'10.5',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.6',0,'2026-02-10 16:35:47','2026-02-10 16:35:47'),
(10,'10',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(10,'10.7',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(10,'A.0',0,'2026-02-11 11:40:33','2026-02-11 11:40:33'),
(11,'8',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.1',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.2',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.7',0,'2026-02-12 15:51:35','2026-02-12 15:51:35'),
(9,'4',1,'2026-02-12 15:53:08','2026-02-24 10:00:06'),
(9,'4.1',1,'2026-02-12 15:53:08','2026-02-24 10:00:11'),
(9,'4.2',1,'2026-02-12 15:53:08','2026-02-24 10:00:17'),
(9,'4.3',1,'2026-02-12 15:53:09','2026-02-24 10:00:21'),
(12,'10',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(12,'10.1',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(12,'10.2',0,'2026-02-12 15:54:22','2026-02-12 15:54:22'),
(12,'10.3',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(12,'10.5',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(12,'10.7',0,'2026-02-12 15:54:23','2026-02-12 15:54:23'),
(14,'4',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(14,'4.2',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(14,'4.3',0,'2026-02-12 15:59:13','2026-02-12 15:59:13'),
(13,'8',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(13,'8.1',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(13,'8.7',0,'2026-02-12 15:59:32','2026-02-12 15:59:32'),
(15,'10',0,'2026-02-12 15:59:59','2026-02-12 15:59:59'),
(15,'10.1',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(15,'10.3',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(15,'10.5',0,'2026-02-12 16:00:00','2026-02-12 16:00:00'),
(13,'8',0,'2026-02-13 10:56:26','2026-02-13 10:56:26'),
(13,'8.2',0,'2026-02-13 10:56:26','2026-02-13 10:56:26'),
(14,'4',0,'2026-02-13 12:53:30','2026-02-13 12:53:30'),
(14,'4.1',0,'2026-02-13 12:53:31','2026-02-13 12:53:31'),
(12,'1',0,'2026-02-16 15:04:06','2026-02-16 15:04:06'),
(12,'1.2.4',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(12,'1.2.4.1',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(12,'1.2.4.2',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(12,'1.2.4.3',0,'2026-02-16 15:04:07','2026-02-16 15:04:07'),
(12,'1.2.4.4',0,'2026-02-16 15:04:08','2026-02-16 15:04:08'),
(1,'1',1,'2026-02-16 15:04:24','2026-02-24 09:59:56'),
(1,'1.1',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(1,'1.1.1',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(1,'1.1.2',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(1,'1.2',0,'2026-02-16 15:04:25','2026-02-16 15:04:25'),
(1,'1.2.1',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(1,'1.2.1.1',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(1,'1.2.1.2',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(1,'1.2.2',0,'2026-02-16 15:04:26','2026-02-16 15:04:26'),
(1,'1.2.2.1',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(1,'1.2.3',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(1,'1.2.3.1',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(1,'1.2.3.2',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(1,'1.2.3.3',0,'2026-02-16 15:04:27','2026-02-16 15:04:27'),
(1,'1.2.3.4',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(1,'1.2.3.5',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(1,'1.2.4',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(1,'1.2.4.1',0,'2026-02-16 15:04:28','2026-02-16 15:04:28'),
(1,'1.2.4.2',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(1,'1.2.4.3',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(1,'1.2.4.4',0,'2026-02-16 15:04:29','2026-02-16 15:04:29'),
(1,'1.2.2.5',0,'2026-02-16 15:14:51','2026-02-16 15:14:51'),
(9,'4',1,'2026-02-24 09:51:07','2026-02-24 10:00:06'),
(9,'4.2',1,'2026-02-24 09:51:07','2026-02-24 10:00:17'),
(9,'4.3',1,'2026-02-24 09:51:08','2026-02-24 10:00:21'),
(9,'4.6',1,'2026-02-24 09:51:08','2026-02-24 10:00:29'),
(9,'4.7',1,'2026-02-24 09:51:08','2026-02-24 10:00:35'),
(9,'4',0,'2026-02-24 10:01:13','2026-02-24 10:01:13'),
(9,'4.1',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(9,'4.2',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(9,'4.3',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(9,'4.6',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(9,'4.7',0,'2026-02-24 10:01:14','2026-02-24 10:01:14'),
(12,'10',0,'2026-02-26 14:52:47','2026-02-26 14:52:47'),
(12,'10.4',0,'2026-02-26 14:52:47','2026-02-26 14:52:47'),
(12,'10',0,'2026-02-26 15:07:40','2026-02-26 15:07:40'),
(12,'10.8',0,'2026-02-26 15:07:40','2026-02-26 15:07:40'),
(1,'10',0,'2026-02-26 15:07:56','2026-02-26 15:07:56'),
(1,'10.1',0,'2026-02-26 15:07:56','2026-02-26 15:07:56'),
(1,'10.2',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(1,'10.4',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(1,'10.5',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(1,'10.6',0,'2026-02-26 15:07:57','2026-02-26 15:07:57'),
(1,'10.7',0,'2026-02-26 15:07:58','2026-02-26 15:07:58'),
(1,'10.8',0,'2026-02-26 15:07:58','2026-02-26 15:07:58'),
(8,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(11,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(13,'8.8',0,'2026-03-02 12:45:21','2026-03-02 12:45:21'),
(16,'9',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(16,'9.1',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(16,'9.2',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(16,'9.3',0,'2026-03-02 15:45:32','2026-03-02 15:45:32'),
(16,'9.4',0,'2026-03-02 15:45:33','2026-03-02 15:45:33'),
(18,'12',0,'2026-03-02 16:12:07','2026-03-02 16:12:07'),
(18,'12.2',0,'2026-03-02 16:12:07','2026-03-02 16:12:07'),
(18,'12.2.1',0,'2026-03-02 16:12:08','2026-03-02 16:12:08'),
(17,'12',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(17,'12.1',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(17,'12.1.1',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(17,'12.1.2',0,'2026-03-02 16:12:20','2026-03-02 16:12:20'),
(17,'12.1.3',0,'2026-03-02 16:12:21','2026-03-02 16:12:21'),
(17,'12.1.4',0,'2026-03-02 16:12:21','2026-03-02 16:12:21'),
(19,'13',1,'2026-03-02 17:37:25','2026-03-02 18:23:26'),
(19,'13.1',0,'2026-03-02 17:37:25','2026-03-02 17:37:25'),
(19,'13.2',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(19,'13.3',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(19,'13.4',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(19,'13.5',0,'2026-03-02 17:37:26','2026-03-02 17:37:26'),
(19,'13',1,'2026-03-02 17:54:34','2026-03-02 18:23:26'),
(19,'13.6',0,'2026-03-02 17:54:35','2026-03-02 17:54:35'),
(19,'13.7',0,'2026-03-02 17:54:35','2026-03-02 17:54:35'),
(19,'13',1,'2026-03-02 18:06:26','2026-03-02 18:23:26'),
(19,'13.8',0,'2026-03-02 18:06:26','2026-03-02 18:06:26'),
(19,'13',0,'2026-03-02 18:23:43','2026-03-02 18:23:43'),
(19,'13.9',0,'2026-03-02 18:23:43','2026-03-02 18:23:43'),
(12,'10',0,'2026-03-09 10:40:18','2026-03-09 10:40:18'),
(12,'10.9',0,'2026-03-09 10:40:18','2026-03-09 10:40:18'),
(10,'10',0,'2026-03-09 10:41:49','2026-03-09 10:41:49'),
(10,'10.9',0,'2026-03-09 10:41:50','2026-03-09 10:41:50');
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
  `pfr_perfil_id` int(11) DEFAULT NULL,
  `pfr_rol_id` varchar(20) DEFAULT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` (`pfr_perfil_id`) USING BTREE,
  KEY `trd_acceso_perfiles_roles_trd_acceso_roles_FK` (`pfr_rol_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_permiso_rol_vecinos`
--

LOCK TABLES `trd_acceso_permiso_rol_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_permiso_rol_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_permiso_rol_vecinos` VALUES
(1,'1',0,'2026-03-03 15:56:14','2026-03-03 15:56:14'),
(1,'2',0,'2026-03-03 16:26:50','2026-03-03 16:26:50'),
(1,'2.1',0,'2026-03-03 16:26:50','2026-03-03 16:26:50');
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
('10.3',3,'Listar OIRS','funcionarios/oirs/listar.php','menu','Pagina','map',1,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.4',0,'Ver','funcionarios/oirs/ver.php','vista','Pagina','search',0,'2026-02-10 16:23:11','2026-02-26 13:55:21','oirs'),
('10.5',5,'Solicitudes por Revisar','funcionarios/oirs/revisar.php','menu','Pagina','message-square',0,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.6',6,'Visación de  Solicitudes','funcionarios/oirs/visacion.php','menu','Pagina','edit',0,'2026-02-10 16:23:11','2026-02-26 13:45:17','oirs'),
('10.7',7,'Historial de Solicitudes','funcionarios/oirs/historial.php','menu','Pagina','archive',0,'2026-02-11 09:42:08','2026-02-26 15:16:31','oirs'),
('10.8',4,'Consultar','funcionarios/oirs/consultar.php','menu','Pagina','search',0,'2026-02-26 15:06:40','2026-02-26 15:16:31','oirs'),
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
('4.3',4,'Historial ','funcionarios/desve/historial.php','menu','Pagina','archive',0,'2026-01-30 13:45:50','2026-02-26 14:54:19','desve'),
('4.4',6,'Edicion ','funcionarios/desve/modificar.php','vista','Pagina','edit',0,'2026-01-30 13:45:50','2026-02-26 14:58:36','desve'),
('4.5',7,'Responder ','funcionarios/desve/responder.php','vista','Pagina','message-square',0,'2026-01-30 13:45:50','2026-02-26 14:58:36','desve'),
('4.6',5,'Consulta ','funcionarios/desve/consultar.php','vista','Pagina','search',0,'2026-01-30 13:45:50','2026-02-26 14:58:36','desve'),
('4.7',3,'Pendiente','funcionarios/desve/pendientes.php','menu','Pagina','dashboard',0,'2026-02-24 09:42:40','2026-02-26 14:54:19','desve'),
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
('8.7',3,'Historial de Ingresos','funcionarios/ingresos/historial.php','menu','Pagina','archive',0,'2026-01-26 07:52:09','2026-02-27 14:02:37','ingresos'),
('8.8',4,'Consultar','funcionarios/ingresos/consultar.php','menu','Pagina','search',0,'2026-03-02 12:44:04','2026-03-02 12:44:29','ingresos'),
('9',10,'Blanco',NULL,'menu','categoria','dashboard',0,'2026-03-02 15:45:01','2026-03-02 16:18:44','principal'),
('9.1',1,'Dashboard','funcionarios/blanco/index.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.2',2,'Consultar','funcionarios/blanco/consultar.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.3',3,'Ver','funcionarios/blanco/ver.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('9.4',4,'Editar Maestro','funcionarios/blanco/maestro.php','menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 16:04:00','blanco'),
('A.0',NULL,'Bandeja','funcionarios/index.php','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19',NULL),
('A.1',NULL,'Bandeja Historial','funcionarios/bandeja_historial.php','menu','Pagina','clock',0,'2026-02-11 16:34:04','2026-02-26 14:54:19',NULL);
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
('2.1',2,'Oirs','index.php','menu','pagina','menu',0,'2026-03-03 16:26:34','2026-03-03 16:26:34','oirs');
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
  `usp_usuario_id` int(11) NOT NULL,
  `usp_perfil_id` int(11) NOT NULL,
  `usp_fecha_inicio` datetime DEFAULT current_timestamp(),
  `usp_fecha_termino` datetime DEFAULT NULL,
  `usp_usuario_subrogante_id` int(11) DEFAULT NULL,
  `usp_borrado` tinyint(1) DEFAULT 0,
  `usp_creacion` datetime DEFAULT current_timestamp(),
  `usp_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usp_usuario_id`,`usp_perfil_id`),
  KEY `usp_perfil_id` (`usp_perfil_id`),
  KEY `usp_usuario_subrogante_id` (`usp_usuario_subrogante_id`),
  CONSTRAINT `1` FOREIGN KEY (`usp_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `2` FOREIGN KEY (`usp_perfil_id`) REFERENCES `trd_acceso_roles` (`prf_id`),
  CONSTRAINT `3` FOREIGN KEY (`usp_usuario_subrogante_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_rol_usuario`
--

LOCK TABLES `trd_acceso_rol_usuario` WRITE;
/*!40000 ALTER TABLE `trd_acceso_rol_usuario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_rol_usuario` VALUES
(1,1,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2026-01-30 15:48:51'),
(1,4,NULL,NULL,NULL,0,'2026-01-30 13:48:40','2026-01-30 13:48:40'),
(1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24'),
(1,10,NULL,NULL,NULL,0,'2026-02-10 16:36:13','2026-02-10 16:36:13'),
(1,16,NULL,NULL,NULL,0,'2026-03-02 16:05:04','2026-03-02 16:05:04'),
(1,17,NULL,NULL,NULL,0,'2026-03-02 16:12:36','2026-03-02 16:12:36'),
(1,18,NULL,NULL,NULL,0,'2026-03-02 16:12:51','2026-03-02 16:12:51'),
(1,19,NULL,NULL,NULL,0,'2026-03-02 17:41:42','2026-03-02 17:41:42'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(2,12,NULL,NULL,NULL,0,'2026-03-05 13:26:04','2026-03-05 13:26:04'),
(3,8,'2026-02-05 13:39:00','2027-06-12 13:39:00',NULL,0,'2026-02-06 13:39:31','2026-02-06 13:52:29'),
(3,9,NULL,NULL,NULL,0,'2026-02-26 15:44:27','2026-02-26 15:44:27'),
(3,12,NULL,NULL,NULL,0,'2026-03-05 12:57:53','2026-03-05 12:57:53'),
(4,11,NULL,NULL,NULL,0,'2026-02-12 16:00:50','2026-02-12 16:00:50'),
(6,13,NULL,NULL,NULL,0,'2026-02-12 16:01:44','2026-02-12 16:01:44'),
(9,9,NULL,NULL,NULL,0,'2026-02-12 16:00:29','2026-02-24 14:36:34'),
(10,14,NULL,NULL,NULL,0,'2026-02-12 16:01:31','2026-02-12 16:01:31'),
(13,12,NULL,NULL,NULL,0,'2026-02-12 16:01:06','2026-02-12 16:01:06'),
(15,15,NULL,NULL,NULL,0,'2026-02-12 16:02:10','2026-02-12 16:02:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(16,'usuario oirs','exteno','11111113-4','oirs.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-17 11:17:14');
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
  `usr_email` varchar(255) DEFAULT NULL,
  `usr_borrado` tinyint(1) DEFAULT 0,
  `usr_creacion` datetime DEFAULT current_timestamp(),
  `usr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_rut` (`usr_rut`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_vecinos`
--

LOCK TABLES `trd_acceso_vecinos` WRITE;
/*!40000 ALTER TABLE `trd_acceso_vecinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_vecinos` VALUES
(1,'acceso_vecinos','test','11111111-1','vecino@test.cl',0,'2026-03-03 13:55:16','2026-03-03 13:55:16'),
(2,'maria','vecina','99999999-9','maria.vecina@test.cl',0,'2026-03-03 13:55:16','2026-03-03 13:55:16');
/*!40000 ALTER TABLE `trd_acceso_vecinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_cont_direcciones`
--

DROP TABLE IF EXISTS `trd_cont_direcciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_cont_direcciones` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_cont_direcciones`
--

LOCK TABLES `trd_cont_direcciones` WRITE;
/*!40000 ALTER TABLE `trd_cont_direcciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_cont_direcciones` VALUES
(1,5,'OIRS','Habana 414, 2580329 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.02885369,-71.56879448,'2026-03-04 14:04:23','2026-03-04 14:04:23',0,'Habana 414, 2580329 Viña del Mar, Valparaíso, Chile'),
(2,2,'OIRS','Las Magnolias 38, 2551470',NULL,NULL,NULL,NULL,-33.01044300,-71.50243120,'2026-03-05 13:14:00','2026-03-05 13:14:00',0,'Las Magnolias 38, 2551470'),
(3,6,'OIRS','Quilpué 200, 2520477 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.02568739,-71.54763721,'2026-03-06 10:00:42','2026-03-06 10:00:42',0,'Quilpué 200, 2520477 Viña del Mar, Valparaíso, Chile'),
(4,1,'OIRS','Timalchaca 75, 2561949 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.02987912,-71.49596714,'2026-03-06 10:26:49','2026-03-06 10:26:49',0,'Timalchaca 75, 2561949 Viña del Mar, Valparaíso, Chile'),
(5,7,'OIRS','Av. Valparaíso 1367, 2520520 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.02644300,-71.54291652,'2026-03-06 11:29:09','2026-03-06 11:29:09',0,'Av. Valparaíso 1367, 2520520 Viña del Mar, Valparaíso, Chile'),
(6,8,'OIRS','Padre Hurtado 400, 2520000 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.03608539,-71.56278633,'2026-03-06 11:41:57','2026-03-06 11:41:57',0,'Padre Hurtado 400, 2520000 Viña del Mar, Valparaíso, Chile'),
(7,9,'OIRS','Las Maravillas / Cancha, 2552748 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-32.99930912,-71.49862789,'2026-03-06 12:01:57','2026-03-06 12:01:57',0,'Las Maravillas / Cancha, 2552748 Viña del Mar, Valparaíso, Chile');
/*!40000 ALTER TABLE `trd_cont_direcciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_cont_escolaridad`
--

DROP TABLE IF EXISTS `trd_cont_escolaridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_cont_escolaridad` (
  `esc_id` int(11) NOT NULL AUTO_INCREMENT,
  `esc_nombre` varchar(100) NOT NULL,
  `esc_borrado` tinyint(1) DEFAULT 0,
  `esc_creacion` datetime DEFAULT current_timestamp(),
  `esc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_cont_escolaridad`
--

LOCK TABLES `trd_cont_escolaridad` WRITE;
/*!40000 ALTER TABLE `trd_cont_escolaridad` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_cont_escolaridad` VALUES
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
/*!40000 ALTER TABLE `trd_cont_escolaridad` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_destinos`
--

LOCK TABLES `trd_desve_destinos` WRITE;
/*!40000 ALTER TABLE `trd_desve_destinos` DISABLE KEYS */;
set autocommit=0;
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
  `sol_responsable` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_metadata`
--

LOCK TABLES `trd_documentos_metadata` WRITE;
/*!40000 ALTER TABLE `trd_documentos_metadata` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_documentos_metadata` VALUES
(1,1,'Tamaño','70679',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(2,1,'Tipo MIME','application/pdf',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(3,1,'Extensión','pdf',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(4,1,'Hash SHA256','b00aa4169ef9686c6b56ba30273519cc93b8073c911e00b15694202a0d13d9f1',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(5,1,'Sistema Origen','GesDoc',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(6,1,'Fecha Subida','2026-03-03 21:25:16',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(7,1,'Usuario','2',0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(8,2,'Tamaño','47818',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(9,2,'Tipo MIME','application/pdf',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(10,2,'Extensión','pdf',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(11,2,'Hash SHA256','fbca61a8dd111f5b5100fbd4ae676b5b83dda428e34b876be19f31d19648ba38',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(12,2,'Sistema Origen','GesDoc',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(13,2,'Fecha Subida','2026-03-04 13:54:02',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(14,2,'Usuario','2',0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(15,3,'Tamaño','47818',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(16,3,'Tipo MIME','application/pdf',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(17,3,'Extensión','pdf',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(18,3,'Hash SHA256','fbca61a8dd111f5b5100fbd4ae676b5b83dda428e34b876be19f31d19648ba38',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(19,3,'Sistema Origen','GesDoc',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(20,3,'Fecha Subida','2026-03-04 20:35:10',0,'2026-03-04 16:35:10','2026-03-04 16:35:10'),
(21,3,'Usuario','1',0,'2026-03-04 16:35:10','2026-03-04 16:35:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_areas`
--

LOCK TABLES `trd_general_areas` WRITE;
/*!40000 ALTER TABLE `trd_general_areas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_areas` VALUES
(1,'trdig','transformacion digital',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,'oirs','oficina de Informaciones reclamos y sugerencias',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,'desve','desarollo vecinal',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,'ingr','ingresos',0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(16,16,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(1,1,'Ingresa solicitud Ingresos',2,'2026-03-03 17:25:16',0,'2026-03-03 17:25:16'),
(2,1,'Carga de documento Público: LeyTransformaciónDigital_Leticia.pdf',2,'2026-03-03 17:25:16',0,'2026-03-03 17:25:16'),
(3,1,'Consulta detalles de solicitud',2,'2026-03-03 17:25:24',0,'2026-03-03 17:25:24'),
(4,1,'Consulta detalles de solicitud',2,'2026-03-03 17:25:39',0,'2026-03-03 17:25:39'),
(5,1,'Consulta detalles de solicitud',2,'2026-03-03 17:28:21',0,'2026-03-03 17:28:21'),
(6,1,'Consulta detalles de solicitud',2,'2026-03-03 17:29:40',0,'2026-03-03 17:29:40'),
(7,1,'Consulta detalles de solicitud',2,'2026-03-03 17:33:30',0,'2026-03-03 17:33:30'),
(8,1,'Consulta detalles de solicitud',2,'2026-03-03 17:37:55',0,'2026-03-03 17:37:55'),
(9,1,'Consulta detalles de solicitud',2,'2026-03-03 17:45:39',0,'2026-03-03 17:45:39'),
(10,1,'Consulta detalles de solicitud',1,'2026-03-04 09:28:59',0,'2026-03-04 09:28:59'),
(11,1,'Consulta detalles de solicitud',1,'2026-03-04 09:34:09',0,'2026-03-04 09:34:09'),
(12,1,'Consulta detalles de solicitud',2,'2026-03-04 09:34:39',0,'2026-03-04 09:34:39'),
(13,1,'Consulta detalles de solicitud',2,'2026-03-04 09:34:52',0,'2026-03-04 09:34:52'),
(14,1,'Consulta detalles de solicitud',2,'2026-03-04 09:35:00',0,'2026-03-04 09:35:00'),
(15,1,'Consulta detalles de solicitud',2,'2026-03-04 09:35:19',0,'2026-03-04 09:35:19'),
(16,1,'Consulta detalles de solicitud',2,'2026-03-04 09:38:50',0,'2026-03-04 09:38:50'),
(17,1,'Consulta detalles de solicitud',2,'2026-03-04 09:39:01',0,'2026-03-04 09:39:01'),
(18,1,'Consulta detalles de solicitud',3,'2026-03-04 09:39:32',0,'2026-03-04 09:39:32'),
(19,1,'Consulta detalles de solicitud',2,'2026-03-04 09:39:56',0,'2026-03-04 09:39:56'),
(20,1,'Consulta detalles de solicitud',3,'2026-03-04 09:41:49',0,'2026-03-04 09:41:49'),
(21,2,'Ingresa solicitud Ingresos',2,'2026-03-04 09:54:02',0,'2026-03-04 09:54:02'),
(22,2,'Carga de documento Público: Listado_Ingresos_DESVE.pdf',2,'2026-03-04 09:54:02',0,'2026-03-04 09:54:02'),
(23,2,'Consulta detalles de solicitud',3,'2026-03-04 10:03:15',0,'2026-03-04 10:03:15'),
(24,2,'Funcionario responde a solicitud (Resuelto_Favorable)',3,'2026-03-04 10:03:36',0,'2026-03-04 10:03:36'),
(25,2,'Consulta detalles de solicitud',3,'2026-03-04 10:03:40',0,'2026-03-04 10:03:40'),
(26,2,'Consulta detalles de solicitud',1,'2026-03-04 10:10:24',0,'2026-03-04 10:10:24'),
(27,1,'Consulta detalles de solicitud',2,'2026-03-04 10:14:11',0,'2026-03-04 10:14:11'),
(28,1,'Consulta detalles de solicitud',3,'2026-03-04 10:14:21',0,'2026-03-04 10:14:21'),
(29,1,'Funcionario responde a solicitud (Resuelto_Favorable)',3,'2026-03-04 10:14:29',0,'2026-03-04 10:14:29'),
(30,1,'Consulta detalles de solicitud',3,'2026-03-04 10:14:31',0,'2026-03-04 10:14:31'),
(31,3,'Ingresa solicitud Ingresos',1,'2026-03-04 10:56:10',0,'2026-03-04 10:56:10'),
(32,4,'Ingresa solicitud Ingresos',1,'2026-03-04 10:57:42',0,'2026-03-04 10:57:42'),
(33,4,'Consulta detalles de solicitud',1,'2026-03-04 10:58:54',0,'2026-03-04 10:58:54'),
(34,4,'Consulta detalles de solicitud',1,'2026-03-04 11:00:12',0,'2026-03-04 11:00:12'),
(35,4,'Consulta detalles de solicitud',1,'2026-03-04 11:00:49',0,'2026-03-04 11:00:49'),
(36,4,'Consulta detalles de solicitud',1,'2026-03-04 11:01:22',0,'2026-03-04 11:01:22'),
(37,3,'Consulta detalles de solicitud',1,'2026-03-04 11:01:35',0,'2026-03-04 11:01:35'),
(38,3,'Consulta detalles de solicitud',1,'2026-03-04 11:03:28',0,'2026-03-04 11:03:28'),
(39,3,'Consulta detalles de solicitud',1,'2026-03-04 11:03:45',0,'2026-03-04 11:03:45'),
(40,3,'Consulta detalles de solicitud',1,'2026-03-04 11:04:01',0,'2026-03-04 11:04:01'),
(41,3,'Consulta detalles de solicitud',1,'2026-03-04 11:04:18',0,'2026-03-04 11:04:18'),
(42,3,'Consulta detalles de solicitud',1,'2026-03-04 11:04:43',0,'2026-03-04 11:04:43'),
(43,3,'Consulta detalles de solicitud',1,'2026-03-04 11:05:46',0,'2026-03-04 11:05:46'),
(44,3,'Consulta detalles de solicitud',1,'2026-03-04 11:06:04',0,'2026-03-04 11:06:04'),
(45,3,'Consulta detalles de solicitud',1,'2026-03-04 11:39:40',0,'2026-03-04 11:39:40'),
(46,3,'Consulta detalles de solicitud',1,'2026-03-04 11:41:00',0,'2026-03-04 11:41:00'),
(47,3,'Consulta detalles de solicitud',1,'2026-03-04 11:46:18',0,'2026-03-04 11:46:18'),
(48,3,'Consulta detalles de solicitud',1,'2026-03-04 11:46:52',0,'2026-03-04 11:46:52'),
(49,3,'Consulta detalles de solicitud',1,'2026-03-04 11:47:37',0,'2026-03-04 11:47:37'),
(50,1,'Consulta detalles de solicitud',2,'2026-03-04 11:48:00',0,'2026-03-04 11:48:00'),
(51,1,'Consulta detalles de solicitud',2,'2026-03-04 11:48:10',0,'2026-03-04 11:48:10'),
(52,1,'Consulta detalles de solicitud',2,'2026-03-04 11:48:14',0,'2026-03-04 11:48:14'),
(53,3,'Consulta detalles de solicitud',1,'2026-03-04 11:48:57',0,'2026-03-04 11:48:57'),
(54,3,'Consulta detalles de solicitud',1,'2026-03-04 11:50:23',0,'2026-03-04 11:50:23'),
(55,3,'Consulta detalles de solicitud',1,'2026-03-04 11:51:03',0,'2026-03-04 11:51:03'),
(56,4,'Consulta detalles de solicitud',1,'2026-03-04 11:52:57',0,'2026-03-04 11:52:57'),
(57,4,'Consulta detalles de solicitud',1,'2026-03-04 11:53:02',0,'2026-03-04 11:53:02'),
(58,4,'Consulta detalles de solicitud',1,'2026-03-04 11:54:29',0,'2026-03-04 11:54:29'),
(59,4,'Consulta detalles de solicitud',1,'2026-03-04 11:55:27',0,'2026-03-04 11:55:27'),
(60,5,'Ingresa solicitud Ingresos',1,'2026-03-04 11:57:48',0,'2026-03-04 11:57:48'),
(61,4,'Consulta detalles de solicitud',1,'2026-03-04 11:57:59',0,'2026-03-04 11:57:59'),
(62,4,'Consulta detalles de solicitud',1,'2026-03-04 11:58:16',0,'2026-03-04 11:58:16'),
(63,4,'Consulta detalles de solicitud',1,'2026-03-04 11:58:33',0,'2026-03-04 11:58:33'),
(64,4,'Consulta detalles de solicitud',1,'2026-03-04 11:58:36',0,'2026-03-04 11:58:36'),
(65,5,'Consulta detalles de solicitud',1,'2026-03-04 11:59:16',0,'2026-03-04 11:59:16'),
(66,4,'Consulta detalles de solicitud',1,'2026-03-04 12:07:52',0,'2026-03-04 12:07:52'),
(67,4,'Consulta detalles de solicitud',1,'2026-03-04 12:07:53',0,'2026-03-04 12:07:53'),
(68,4,'Consulta detalles de solicitud',1,'2026-03-04 12:24:40',0,'2026-03-04 12:24:40'),
(69,4,'Consulta detalles de solicitud',1,'2026-03-04 12:24:43',0,'2026-03-04 12:24:43'),
(70,4,'Consulta detalles de solicitud',1,'2026-03-04 12:28:53',0,'2026-03-04 12:28:53'),
(71,4,'Consulta detalles de solicitud',1,'2026-03-04 12:29:43',0,'2026-03-04 12:29:43'),
(72,4,'Consulta detalles de solicitud',1,'2026-03-04 12:31:10',0,'2026-03-04 12:31:10'),
(73,6,'Ingresa solicitud Ingresos',1,'2026-03-04 12:31:41',0,'2026-03-04 12:31:41'),
(74,4,'Consulta detalles de solicitud',1,'2026-03-04 12:31:49',0,'2026-03-04 12:31:49'),
(75,7,'Ingresa solicitud Ingresos',1,'2026-03-04 12:40:46',0,'2026-03-04 12:40:46'),
(76,7,'Consulta detalles de solicitud',1,'2026-03-04 12:40:46',0,'2026-03-04 12:40:46'),
(77,8,'Ingresa solicitud Ingresos',1,'2026-03-04 12:40:54',0,'2026-03-04 12:40:54'),
(78,8,'Consulta detalles de solicitud',1,'2026-03-04 12:40:54',0,'2026-03-04 12:40:54'),
(79,9,'Ingresa solicitud Ingresos',1,'2026-03-04 12:41:13',0,'2026-03-04 12:41:13'),
(80,9,'Consulta detalles de solicitud',1,'2026-03-04 12:41:14',0,'2026-03-04 12:41:14'),
(81,4,'Consulta detalles de solicitud',1,'2026-03-04 12:41:26',0,'2026-03-04 12:41:26'),
(82,4,'Consulta detalles de solicitud',1,'2026-03-04 12:41:42',0,'2026-03-04 12:41:42'),
(83,10,'Ingresa solicitud Ingresos',1,'2026-03-04 12:42:56',0,'2026-03-04 12:42:56'),
(84,10,'Consulta detalles de solicitud',1,'2026-03-04 12:42:56',0,'2026-03-04 12:42:56'),
(85,11,'Ingresa solicitud Ingresos',1,'2026-03-04 12:44:41',0,'2026-03-04 12:44:41'),
(86,11,'Consulta detalles de solicitud',1,'2026-03-04 12:44:41',0,'2026-03-04 12:44:41'),
(87,11,'Consulta detalles de solicitud',1,'2026-03-04 12:45:28',0,'2026-03-04 12:45:28'),
(88,11,'Consulta detalles de solicitud',1,'2026-03-04 13:32:13',0,'2026-03-04 13:32:13'),
(89,11,'Consulta detalles de solicitud',1,'2026-03-04 13:32:15',0,'2026-03-04 13:32:15'),
(90,11,'Consulta detalles de solicitud',1,'2026-03-04 13:33:44',0,'2026-03-04 13:33:44'),
(91,11,'Consulta detalles de solicitud',1,'2026-03-04 13:35:31',0,'2026-03-04 13:35:31'),
(92,4,'Consulta detalles de solicitud',1,'2026-03-04 13:35:43',0,'2026-03-04 13:35:43'),
(93,8,'Consulta detalles de solicitud',1,'2026-03-04 13:39:42',0,'2026-03-04 13:39:42'),
(94,8,'Consulta detalles de solicitud',1,'2026-03-04 13:41:11',0,'2026-03-04 13:41:11'),
(95,8,'Consulta detalles de solicitud',1,'2026-03-04 13:42:33',0,'2026-03-04 13:42:33'),
(96,4,'Consulta detalles de solicitud',1,'2026-03-04 13:43:28',0,'2026-03-04 13:43:28'),
(97,8,'Consulta detalles de solicitud',1,'2026-03-04 13:43:30',0,'2026-03-04 13:43:30'),
(98,8,'Consulta detalles de solicitud',1,'2026-03-04 13:44:29',0,'2026-03-04 13:44:29'),
(99,8,'Consulta detalles de solicitud',1,'2026-03-04 13:44:41',0,'2026-03-04 13:44:41'),
(100,11,'Consulta detalles de solicitud',1,'2026-03-04 13:44:52',0,'2026-03-04 13:44:52'),
(101,11,'Consulta detalles de solicitud',1,'2026-03-04 13:45:23',0,'2026-03-04 13:45:23'),
(102,11,'Consulta detalles de solicitud',1,'2026-03-04 13:46:02',0,'2026-03-04 13:46:02'),
(103,11,'Consulta detalles de solicitud',1,'2026-03-04 13:47:45',0,'2026-03-04 13:47:45'),
(104,11,'Consulta detalles de solicitud',1,'2026-03-04 13:51:08',0,'2026-03-04 13:51:08'),
(105,11,'Consulta detalles de solicitud',1,'2026-03-04 13:51:34',0,'2026-03-04 13:51:34'),
(106,11,'Consulta detalles de solicitud',1,'2026-03-04 13:52:38',0,'2026-03-04 13:52:38'),
(107,11,'Consulta detalles de solicitud',1,'2026-03-04 13:52:56',0,'2026-03-04 13:52:56'),
(108,11,'Consulta detalles de solicitud',1,'2026-03-04 13:53:19',0,'2026-03-04 13:53:19'),
(109,11,'Consulta detalles de solicitud',1,'2026-03-04 13:53:34',0,'2026-03-04 13:53:34'),
(110,11,'Consulta detalles de solicitud',1,'2026-03-04 13:53:46',0,'2026-03-04 13:53:46'),
(111,11,'Consulta detalles de solicitud',1,'2026-03-04 13:54:06',0,'2026-03-04 13:54:06'),
(112,11,'Consulta detalles de solicitud',1,'2026-03-04 13:54:18',0,'2026-03-04 13:54:18'),
(113,11,'Consulta detalles de solicitud',1,'2026-03-04 13:54:56',0,'2026-03-04 13:54:56'),
(114,11,'Consulta detalles de solicitud',1,'2026-03-04 13:55:10',0,'2026-03-04 13:55:10'),
(115,11,'Consulta detalles de solicitud',1,'2026-03-04 13:55:22',0,'2026-03-04 13:55:22'),
(116,11,'Consulta detalles de solicitud',1,'2026-03-04 14:01:46',0,'2026-03-04 14:01:46'),
(117,11,'Consulta detalles de solicitud',1,'2026-03-04 14:02:08',0,'2026-03-04 14:02:08'),
(118,11,'Consulta detalles de solicitud',1,'2026-03-04 14:02:16',0,'2026-03-04 14:02:16'),
(119,9,'Consulta detalles de solicitud',1,'2026-03-04 14:02:38',0,'2026-03-04 14:02:38'),
(120,12,'Ingresa solicitud OIRS',1,'2026-03-04 14:04:23',0,'2026-03-04 14:04:23'),
(121,9,'Consulta detalles de solicitud',1,'2026-03-04 14:31:06',0,'2026-03-04 14:31:06'),
(122,4,'Consulta detalles de solicitud',1,'2026-03-04 14:31:19',0,'2026-03-04 14:31:19'),
(123,8,'Consulta detalles de solicitud',1,'2026-03-04 14:33:43',0,'2026-03-04 14:33:43'),
(124,4,'Consulta detalles de solicitud',1,'2026-03-04 14:41:18',0,'2026-03-04 14:41:18'),
(125,10,'Consulta detalles de solicitud',2,'2026-03-04 14:43:55',0,'2026-03-04 14:43:55'),
(126,10,'Consulta detalles de solicitud',2,'2026-03-04 14:44:22',0,'2026-03-04 14:44:22'),
(127,4,'Consulta detalles de solicitud',1,'2026-03-04 14:44:40',0,'2026-03-04 14:44:40'),
(128,4,'Consulta detalles de solicitud',1,'2026-03-04 14:45:06',0,'2026-03-04 14:45:06'),
(129,13,'Ingresa solicitud Ingresos',3,'2026-03-04 14:50:45',0,'2026-03-04 14:50:45'),
(130,2,'Consulta detalles de solicitud',3,'2026-03-04 15:15:48',0,'2026-03-04 15:15:48'),
(131,14,'Ingresa solicitud Ingresos',3,'2026-03-04 16:25:22',0,'2026-03-04 16:25:22'),
(132,14,'Consulta detalles de solicitud',3,'2026-03-04 16:25:39',0,'2026-03-04 16:25:39'),
(133,14,'Consulta detalles de solicitud',2,'2026-03-04 16:25:40',0,'2026-03-04 16:25:40'),
(134,14,'Consulta detalles de solicitud',3,'2026-03-04 16:26:50',0,'2026-03-04 16:26:50'),
(135,14,'Consulta detalles de solicitud',3,'2026-03-04 16:26:54',0,'2026-03-04 16:26:54'),
(136,14,'Funcionario responde a solicitud (Resuelto_Favorable)',2,'2026-03-04 16:27:03',0,'2026-03-04 16:27:03'),
(137,14,'Consulta detalles de solicitud',2,'2026-03-04 16:27:05',0,'2026-03-04 16:27:05'),
(138,14,'Funcionario responde a solicitud (Resuelto_Favorable)',3,'2026-03-04 16:27:27',0,'2026-03-04 16:27:27'),
(139,14,'Consulta detalles de solicitud',3,'2026-03-04 16:27:30',0,'2026-03-04 16:27:30'),
(140,14,'Consulta detalles de solicitud',2,'2026-03-04 16:28:17',0,'2026-03-04 16:28:17'),
(141,14,'Funcionario responde a solicitud (Resuelto_Favorable)',2,'2026-03-04 16:28:27',0,'2026-03-04 16:28:27'),
(142,14,'Consulta detalles de solicitud',2,'2026-03-04 16:28:30',0,'2026-03-04 16:28:30'),
(143,14,'Consulta detalles de solicitud',3,'2026-03-04 16:29:06',0,'2026-03-04 16:29:06'),
(144,14,'Consulta detalles de solicitud',3,'2026-03-04 16:29:11',0,'2026-03-04 16:29:11'),
(145,14,'Funcionario responde a solicitud (Resuelto_Favorable)',3,'2026-03-04 16:29:28',0,'2026-03-04 16:29:28'),
(146,14,'Consulta detalles de solicitud',3,'2026-03-04 16:29:31',0,'2026-03-04 16:29:31'),
(147,15,'Ingresa solicitud Ingresos',2,'2026-03-04 16:32:34',0,'2026-03-04 16:32:34'),
(148,12,'Carga de documento Interno: Listado_Ingresos_DESVE.pdf',1,'2026-03-04 16:35:10',0,'2026-03-04 16:35:10'),
(149,16,'Ingresa solicitud Ingresos',2,'2026-03-04 16:50:56',0,'2026-03-04 16:50:56'),
(150,16,'Consulta detalles de solicitud',2,'2026-03-04 16:51:08',0,'2026-03-04 16:51:08'),
(151,12,'Ingresa respuesta preliminar OIRS',1,'2026-03-04 17:33:14',0,'2026-03-04 17:33:14'),
(152,12,'Ingresa respuesta técnica OIRS',1,'2026-03-05 09:05:43',0,'2026-03-05 09:05:43'),
(153,12,'Ingresa respuesta técnica OIRS',1,'2026-03-05 09:06:11',0,'2026-03-05 09:06:11'),
(154,12,'Notificación de ejecución OIRS enviada',1,'2026-03-05 09:06:30',0,'2026-03-05 09:06:30'),
(155,12,'Ingresa respuesta preliminar OIRS',1,'2026-03-05 09:06:35',0,'2026-03-05 09:06:35'),
(156,12,'Ingresa respuesta técnica OIRS',1,'2026-03-05 09:06:35',0,'2026-03-05 09:06:35'),
(157,12,'Notificación de ejecución OIRS enviada',1,'2026-03-05 09:06:35',0,'2026-03-05 09:06:35'),
(158,12,'Ingresa respuesta preliminar OIRS',1,'2026-03-05 09:19:11',0,'2026-03-05 09:19:11'),
(159,12,'Ingresa respuesta técnica OIRS',1,'2026-03-05 09:19:11',0,'2026-03-05 09:19:11'),
(160,12,'Notificación de ejecución OIRS enviada',1,'2026-03-05 09:19:11',0,'2026-03-05 09:19:11'),
(161,12,'Ingresa respuesta a aclaratoria',1,'2026-03-05 09:19:11',0,'2026-03-05 09:19:11'),
(162,14,'Consulta detalles de solicitud',1,'2026-03-05 09:26:46',0,'2026-03-05 09:26:46'),
(163,12,'Asignación de OIRS (Funcionario ID: 3)',1,'2026-03-05 09:28:58',0,'2026-03-05 09:28:58'),
(164,10,'Consulta detalles de solicitud',1,'2026-03-05 09:37:09',0,'2026-03-05 09:37:09'),
(165,4,'Consulta detalles de solicitud',1,'2026-03-05 09:37:14',0,'2026-03-05 09:37:14'),
(166,11,'Consulta detalles de solicitud',1,'2026-03-05 09:38:18',0,'2026-03-05 09:38:18'),
(167,11,'Consulta detalles de solicitud',1,'2026-03-05 09:38:28',0,'2026-03-05 09:38:28'),
(168,14,'Consulta detalles de solicitud',1,'2026-03-05 10:00:38',0,'2026-03-05 10:00:38'),
(169,14,'Consulta detalles de solicitud',1,'2026-03-05 10:00:51',0,'2026-03-05 10:00:51'),
(170,1,'Consulta detalles de solicitud',1,'2026-03-05 10:01:07',0,'2026-03-05 10:01:07'),
(171,14,'Consulta detalles de solicitud',1,'2026-03-05 10:01:18',0,'2026-03-05 10:01:18'),
(172,14,'Consulta detalles de solicitud',1,'2026-03-05 10:01:53',0,'2026-03-05 10:01:53'),
(173,14,'Consulta detalles de solicitud',1,'2026-03-05 10:02:31',0,'2026-03-05 10:02:31'),
(174,10,'Consulta detalles de solicitud',1,'2026-03-05 10:02:44',0,'2026-03-05 10:02:44'),
(175,11,'Consulta detalles de solicitud',1,'2026-03-05 10:03:03',0,'2026-03-05 10:03:03'),
(176,14,'Consulta detalles de solicitud',1,'2026-03-05 10:03:14',0,'2026-03-05 10:03:14'),
(177,11,'Consulta detalles de solicitud',1,'2026-03-05 10:03:28',0,'2026-03-05 10:03:28'),
(178,11,'Consulta detalles de solicitud',1,'2026-03-05 10:04:36',0,'2026-03-05 10:04:36'),
(179,11,'Consulta detalles de solicitud',1,'2026-03-05 10:08:48',0,'2026-03-05 10:08:48'),
(180,14,'Consulta detalles de solicitud',1,'2026-03-05 10:09:00',0,'2026-03-05 10:09:00'),
(181,14,'Consulta detalles de solicitud',1,'2026-03-05 10:10:16',0,'2026-03-05 10:10:16'),
(182,14,'Consulta detalles de solicitud',1,'2026-03-05 10:12:36',0,'2026-03-05 10:12:36'),
(183,3,'Consulta detalles de solicitud',1,'2026-03-05 10:33:46',0,'2026-03-05 10:33:46'),
(184,14,'Consulta detalles de solicitud',1,'2026-03-05 10:34:05',0,'2026-03-05 10:34:05'),
(185,12,'Asignación de OIRS (Funcionario ID: 1)',1,'2026-03-05 11:27:45',0,'2026-03-05 11:27:45'),
(186,9,'Consulta detalles de solicitud',1,'2026-03-05 11:33:55',0,'2026-03-05 11:33:55'),
(187,11,'Consulta detalles de solicitud',1,'2026-03-05 11:36:00',0,'2026-03-05 11:36:00'),
(188,9,'Consulta detalles de solicitud',1,'2026-03-05 11:36:45',0,'2026-03-05 11:36:45'),
(189,9,'Consulta detalles de solicitud',1,'2026-03-05 11:37:13',0,'2026-03-05 11:37:13'),
(190,9,'Consulta detalles de solicitud',1,'2026-03-05 11:40:56',0,'2026-03-05 11:40:56'),
(191,9,'Consulta detalles de solicitud',1,'2026-03-05 11:43:25',0,'2026-03-05 11:43:25'),
(192,9,'Consulta detalles de solicitud',1,'2026-03-05 11:44:53',0,'2026-03-05 11:44:53'),
(193,4,'Consulta detalles de solicitud',1,'2026-03-05 11:45:10',0,'2026-03-05 11:45:10'),
(194,4,'Consulta detalles de solicitud',1,'2026-03-05 11:52:47',0,'2026-03-05 11:52:47'),
(195,9,'Consulta detalles de solicitud',1,'2026-03-05 11:52:56',0,'2026-03-05 11:52:56'),
(196,9,'Consulta detalles de solicitud',1,'2026-03-05 12:02:47',0,'2026-03-05 12:02:47'),
(197,9,'Consulta detalles de solicitud',1,'2026-03-05 12:07:18',0,'2026-03-05 12:07:18'),
(198,12,'Ingresa respuesta preliminar OIRS',1,'2026-03-05 12:34:46',0,'2026-03-05 12:34:46'),
(199,12,'Ingresa respuesta técnica OIRS',1,'2026-03-05 12:34:46',0,'2026-03-05 12:34:46'),
(200,12,'Notificación de ejecución OIRS enviada',1,'2026-03-05 12:34:46',0,'2026-03-05 12:34:46'),
(201,12,'Ingresa respuesta a aclaratoria',1,'2026-03-05 12:34:46',0,'2026-03-05 12:34:46'),
(202,17,'Ingresa solicitud OIRS',3,'2026-03-05 13:14:00',0,'2026-03-05 13:14:00'),
(203,17,'Ingresa respuesta preliminar OIRS',3,'2026-03-05 13:21:16',0,'2026-03-05 13:21:16'),
(204,17,'Asignación de OIRS (Funcionario ID: 1)',3,'2026-03-05 13:22:27',0,'2026-03-05 13:22:27'),
(205,17,'Asignación de OIRS (Funcionario ID: 2)',1,'2026-03-05 13:24:50',0,'2026-03-05 13:24:50'),
(206,16,'Consulta detalles de solicitud',3,'2026-03-05 13:33:10',0,'2026-03-05 13:33:10'),
(207,16,'Consulta detalles de solicitud',3,'2026-03-05 13:33:34',0,'2026-03-05 13:33:34'),
(208,16,'Consulta detalles de solicitud',3,'2026-03-05 13:36:45',0,'2026-03-05 13:36:45'),
(209,16,'Consulta detalles de solicitud',2,'2026-03-05 14:03:06',0,'2026-03-05 14:03:06'),
(210,16,'Consulta detalles de solicitud',2,'2026-03-05 14:03:12',0,'2026-03-05 14:03:12'),
(213,16,'Consulta detalles de solicitud',2,'2026-03-05 14:03:57',0,'2026-03-05 14:03:57'),
(214,13,'Consulta detalles de solicitud',2,'2026-03-05 14:05:28',0,'2026-03-05 14:05:28'),
(215,16,'Consulta detalles de solicitud',2,'2026-03-05 14:40:28',0,'2026-03-05 14:40:28'),
(216,16,'Consulta detalles de solicitud',2,'2026-03-05 14:42:34',0,'2026-03-05 14:42:34'),
(217,9,'Consulta detalles de solicitud',2,'2026-03-05 14:43:27',0,'2026-03-05 14:43:27'),
(218,14,'Consulta detalles de solicitud',3,'2026-03-05 15:35:20',0,'2026-03-05 15:35:20'),
(219,14,'Consulta detalles de solicitud',3,'2026-03-05 16:03:47',0,'2026-03-05 16:03:47'),
(220,14,'Consulta detalles de solicitud',3,'2026-03-05 16:11:15',0,'2026-03-05 16:11:15'),
(221,14,'Consulta detalles de solicitud',3,'2026-03-05 16:14:39',0,'2026-03-05 16:14:39'),
(222,14,'Consulta detalles de solicitud',3,'2026-03-05 16:24:47',0,'2026-03-05 16:24:47'),
(223,14,'Consulta detalles de solicitud',3,'2026-03-05 16:31:44',0,'2026-03-05 16:31:44'),
(224,5,'Consulta detalles de solicitud',1,'2026-03-05 16:34:18',0,'2026-03-05 16:34:18'),
(225,14,'Consulta detalles de solicitud',3,'2026-03-05 16:51:54',0,'2026-03-05 16:51:54'),
(226,14,'Consulta detalles de solicitud',3,'2026-03-05 16:54:43',0,'2026-03-05 16:54:43'),
(227,5,'Consulta detalles de solicitud',1,'2026-03-05 16:54:53',0,'2026-03-05 16:54:53'),
(228,14,'Consulta detalles de solicitud',3,'2026-03-05 16:54:59',0,'2026-03-05 16:54:59'),
(229,14,'Consulta detalles de solicitud',3,'2026-03-05 16:56:08',0,'2026-03-05 16:56:08'),
(230,5,'Consulta detalles de solicitud',1,'2026-03-05 16:59:37',0,'2026-03-05 16:59:37'),
(231,14,'Consulta detalles de solicitud',3,'2026-03-05 17:00:15',0,'2026-03-05 17:00:15'),
(232,14,'Consulta detalles de solicitud',3,'2026-03-05 17:00:59',0,'2026-03-05 17:00:59'),
(233,5,'Consulta detalles de solicitud',1,'2026-03-05 17:02:10',0,'2026-03-05 17:02:10'),
(234,5,'Consulta detalles de solicitud',1,'2026-03-05 17:02:30',0,'2026-03-05 17:02:30'),
(235,5,'Consulta detalles de solicitud',1,'2026-03-05 17:06:33',0,'2026-03-05 17:06:33'),
(236,14,'Consulta detalles de solicitud',3,'2026-03-05 17:07:16',0,'2026-03-05 17:07:16'),
(237,14,'Consulta detalles de solicitud',3,'2026-03-05 17:39:02',0,'2026-03-05 17:39:02'),
(238,14,'Consulta detalles de solicitud',3,'2026-03-05 17:43:19',0,'2026-03-05 17:43:19'),
(239,14,'Consulta detalles de solicitud',3,'2026-03-05 17:43:49',0,'2026-03-05 17:43:49'),
(240,14,'Consulta detalles de solicitud',3,'2026-03-05 17:47:26',0,'2026-03-05 17:47:26'),
(241,14,'Consulta detalles de solicitud',3,'2026-03-05 17:47:30',0,'2026-03-05 17:47:30'),
(242,14,'Consulta detalles de solicitud',3,'2026-03-05 17:48:58',0,'2026-03-05 17:48:58'),
(243,14,'Consulta detalles de solicitud',3,'2026-03-05 17:51:24',0,'2026-03-05 17:51:24'),
(244,14,'Consulta detalles de solicitud',3,'2026-03-05 17:52:06',0,'2026-03-05 17:52:06'),
(245,14,'Consulta detalles de solicitud',3,'2026-03-05 17:52:51',0,'2026-03-05 17:52:51'),
(246,14,'Consulta detalles de solicitud',3,'2026-03-05 17:53:02',0,'2026-03-05 17:53:02'),
(247,14,'Consulta detalles de solicitud',3,'2026-03-05 17:53:47',0,'2026-03-05 17:53:47'),
(248,14,'Consulta detalles de solicitud',3,'2026-03-05 17:55:01',0,'2026-03-05 17:55:01'),
(249,14,'Consulta detalles de solicitud',3,'2026-03-05 17:55:21',0,'2026-03-05 17:55:21'),
(250,14,'Consulta detalles de solicitud',3,'2026-03-05 17:55:38',0,'2026-03-05 17:55:38'),
(251,14,'Consulta detalles de solicitud',3,'2026-03-05 17:56:12',0,'2026-03-05 17:56:12'),
(252,14,'Consulta detalles de solicitud',3,'2026-03-05 17:56:57',0,'2026-03-05 17:56:57'),
(253,14,'Consulta detalles de solicitud',3,'2026-03-05 17:58:07',0,'2026-03-05 17:58:07'),
(254,14,'Consulta detalles de solicitud',3,'2026-03-05 17:58:39',0,'2026-03-05 17:58:39'),
(255,14,'Consulta detalles de solicitud',3,'2026-03-05 17:59:24',0,'2026-03-05 17:59:24'),
(256,14,'Consulta detalles de solicitud',3,'2026-03-05 18:00:21',0,'2026-03-05 18:00:21'),
(257,14,'Consulta detalles de solicitud',3,'2026-03-05 18:00:30',0,'2026-03-05 18:00:30'),
(258,14,'Consulta detalles de solicitud',3,'2026-03-05 18:00:49',0,'2026-03-05 18:00:49'),
(259,14,'Consulta detalles de solicitud',3,'2026-03-05 18:01:10',0,'2026-03-05 18:01:10'),
(260,14,'Consulta detalles de solicitud',3,'2026-03-05 18:03:59',0,'2026-03-05 18:03:59'),
(261,14,'Consulta detalles de solicitud',3,'2026-03-05 18:05:06',0,'2026-03-05 18:05:06'),
(262,14,'Consulta detalles de solicitud',3,'2026-03-05 18:05:27',0,'2026-03-05 18:05:27'),
(263,14,'Consulta detalles de solicitud',3,'2026-03-05 18:07:04',0,'2026-03-05 18:07:04'),
(264,14,'Consulta detalles de solicitud',3,'2026-03-06 08:39:11',0,'2026-03-06 08:39:11'),
(265,18,'Ingresa solicitud Ingresos',3,'2026-03-06 08:41:42',0,'2026-03-06 08:41:42'),
(266,18,'Consulta detalles de solicitud',3,'2026-03-06 08:41:45',0,'2026-03-06 08:41:45'),
(267,14,'Consulta detalles de solicitud',3,'2026-03-06 08:41:52',0,'2026-03-06 08:41:52'),
(268,18,'Consulta detalles de solicitud',3,'2026-03-06 08:42:09',0,'2026-03-06 08:42:09'),
(269,14,'Consulta detalles de solicitud',1,'2026-03-06 08:45:33',0,'2026-03-06 08:45:33'),
(270,14,'Consulta detalles de solicitud',3,'2026-03-06 08:45:38',0,'2026-03-06 08:45:38'),
(271,14,'Consulta detalles de solicitud',3,'2026-03-06 08:52:03',0,'2026-03-06 08:52:03'),
(272,14,'Consulta detalles de solicitud',1,'2026-03-06 08:53:27',0,'2026-03-06 08:53:27'),
(273,14,'Consulta detalles de solicitud',3,'2026-03-06 08:53:34',0,'2026-03-06 08:53:34'),
(274,14,'Consulta detalles de solicitud',1,'2026-03-06 09:23:43',0,'2026-03-06 09:23:43'),
(275,14,'Consulta detalles de solicitud',1,'2026-03-06 09:24:11',0,'2026-03-06 09:24:11'),
(276,14,'Consulta detalles de solicitud',1,'2026-03-06 09:29:39',0,'2026-03-06 09:29:39'),
(277,14,'Consulta detalles de solicitud',1,'2026-03-06 09:31:19',0,'2026-03-06 09:31:19'),
(278,14,'Consulta detalles de solicitud',1,'2026-03-06 09:32:07',0,'2026-03-06 09:32:07'),
(279,19,'Ingresa solicitud Ingresos',2,'2026-03-06 09:32:16',0,'2026-03-06 09:32:16'),
(280,14,'Consulta detalles de solicitud',1,'2026-03-06 09:32:53',0,'2026-03-06 09:32:53'),
(281,20,'Ingresa solicitud Ingresos',2,'2026-03-06 09:32:54',0,'2026-03-06 09:32:54'),
(282,14,'Consulta detalles de solicitud',1,'2026-03-06 09:33:13',0,'2026-03-06 09:33:13'),
(283,14,'Consulta detalles de solicitud',3,'2026-03-06 09:33:30',0,'2026-03-06 09:33:30'),
(284,14,'Consulta detalles de solicitud',1,'2026-03-06 09:34:28',0,'2026-03-06 09:34:28'),
(285,14,'Consulta detalles de solicitud',3,'2026-03-06 09:34:31',0,'2026-03-06 09:34:31'),
(286,14,'Consulta detalles de solicitud',3,'2026-03-06 09:34:48',0,'2026-03-06 09:34:48'),
(287,14,'Consulta detalles de solicitud',1,'2026-03-06 09:36:02',0,'2026-03-06 09:36:02'),
(288,14,'Consulta detalles de solicitud',3,'2026-03-06 09:36:46',0,'2026-03-06 09:36:46'),
(289,14,'Consulta detalles de solicitud',1,'2026-03-06 09:37:33',0,'2026-03-06 09:37:33'),
(290,14,'Consulta detalles de solicitud',1,'2026-03-06 09:40:09',0,'2026-03-06 09:40:09'),
(291,14,'Consulta detalles de solicitud',3,'2026-03-06 09:40:25',0,'2026-03-06 09:40:25'),
(292,14,'Consulta detalles de solicitud',1,'2026-03-06 09:41:12',0,'2026-03-06 09:41:12'),
(293,14,'Consulta detalles de solicitud',3,'2026-03-06 09:43:53',0,'2026-03-06 09:43:53'),
(294,14,'Consulta detalles de solicitud',3,'2026-03-06 09:44:27',0,'2026-03-06 09:44:27'),
(295,14,'Consulta detalles de solicitud',1,'2026-03-06 09:44:57',0,'2026-03-06 09:44:57'),
(296,14,'Consulta detalles de solicitud',1,'2026-03-06 09:45:52',0,'2026-03-06 09:45:52'),
(297,14,'Consulta detalles de solicitud',1,'2026-03-06 09:46:49',0,'2026-03-06 09:46:49'),
(298,14,'Consulta detalles de solicitud',1,'2026-03-06 09:46:59',0,'2026-03-06 09:46:59'),
(299,14,'Consulta detalles de solicitud',1,'2026-03-06 09:47:20',0,'2026-03-06 09:47:20'),
(300,14,'Consulta detalles de solicitud',1,'2026-03-06 09:47:52',0,'2026-03-06 09:47:52'),
(301,14,'Consulta detalles de solicitud',1,'2026-03-06 09:49:12',0,'2026-03-06 09:49:12'),
(302,14,'Consulta detalles de solicitud',1,'2026-03-06 09:51:49',0,'2026-03-06 09:51:49'),
(303,14,'Consulta detalles de solicitud',1,'2026-03-06 09:52:06',0,'2026-03-06 09:52:06'),
(304,14,'Consulta detalles de solicitud',1,'2026-03-06 09:52:27',0,'2026-03-06 09:52:27'),
(305,14,'Consulta detalles de solicitud',1,'2026-03-06 09:53:01',0,'2026-03-06 09:53:01'),
(306,14,'Consulta detalles de solicitud',1,'2026-03-06 09:53:27',0,'2026-03-06 09:53:27'),
(307,14,'Consulta detalles de solicitud',1,'2026-03-06 09:53:39',0,'2026-03-06 09:53:39'),
(308,14,'Consulta detalles de solicitud',1,'2026-03-06 09:53:47',0,'2026-03-06 09:53:47'),
(309,14,'Consulta detalles de solicitud',1,'2026-03-06 09:53:55',0,'2026-03-06 09:53:55'),
(310,14,'Consulta detalles de solicitud',1,'2026-03-06 09:54:20',0,'2026-03-06 09:54:20'),
(311,14,'Consulta detalles de solicitud',1,'2026-03-06 09:54:27',0,'2026-03-06 09:54:27'),
(312,21,'Ingresa solicitud OIRS',2,'2026-03-06 10:00:42',0,'2026-03-06 10:00:42'),
(313,14,'Consulta detalles de solicitud',1,'2026-03-06 10:01:18',0,'2026-03-06 10:01:18'),
(314,14,'Consulta detalles de solicitud',1,'2026-03-06 10:02:54',0,'2026-03-06 10:02:54'),
(315,14,'Consulta detalles de solicitud',1,'2026-03-06 10:03:27',0,'2026-03-06 10:03:27'),
(316,14,'Consulta detalles de solicitud',1,'2026-03-06 10:05:30',0,'2026-03-06 10:05:30'),
(317,14,'Consulta detalles de solicitud',1,'2026-03-06 10:05:56',0,'2026-03-06 10:05:56'),
(318,14,'Consulta detalles de solicitud',1,'2026-03-06 10:06:16',0,'2026-03-06 10:06:16'),
(319,14,'Consulta detalles de solicitud',1,'2026-03-06 10:07:45',0,'2026-03-06 10:07:45'),
(320,14,'Consulta detalles de solicitud',1,'2026-03-06 10:10:18',0,'2026-03-06 10:10:18'),
(321,14,'Consulta detalles de solicitud',1,'2026-03-06 10:16:38',0,'2026-03-06 10:16:38'),
(322,14,'Consulta detalles de solicitud',1,'2026-03-06 10:24:03',0,'2026-03-06 10:24:03'),
(323,22,'Ingresa solicitud Ingresos',1,'2026-03-06 10:25:00',0,'2026-03-06 10:25:00'),
(324,22,'Consulta detalles de solicitud',1,'2026-03-06 10:25:03',0,'2026-03-06 10:25:03'),
(325,14,'Consulta detalles de solicitud',1,'2026-03-06 10:25:27',0,'2026-03-06 10:25:27'),
(326,14,'Consulta detalles de solicitud',1,'2026-03-06 10:25:59',0,'2026-03-06 10:25:59'),
(327,23,'Ingresa solicitud OIRS',2,'2026-03-06 10:26:49',0,'2026-03-06 10:26:49'),
(328,14,'Consulta detalles de solicitud',1,'2026-03-06 10:31:22',0,'2026-03-06 10:31:22'),
(329,14,'Consulta detalles de solicitud',1,'2026-03-06 10:40:11',0,'2026-03-06 10:40:11'),
(330,14,'Consulta detalles de solicitud',1,'2026-03-06 10:40:44',0,'2026-03-06 10:40:44'),
(331,14,'Consulta detalles de solicitud',1,'2026-03-06 10:41:21',0,'2026-03-06 10:41:21'),
(332,4,'Consulta detalles de solicitud',1,'2026-03-06 10:41:45',0,'2026-03-06 10:41:45'),
(333,9,'Consulta detalles de solicitud',1,'2026-03-06 10:42:13',0,'2026-03-06 10:42:13'),
(334,11,'Consulta detalles de solicitud',1,'2026-03-06 10:42:59',0,'2026-03-06 10:42:59'),
(335,11,'Consulta detalles de solicitud',1,'2026-03-06 10:43:25',0,'2026-03-06 10:43:25'),
(336,11,'Consulta detalles de solicitud',1,'2026-03-06 10:46:21',0,'2026-03-06 10:46:21'),
(337,11,'Consulta detalles de solicitud',1,'2026-03-06 10:46:53',0,'2026-03-06 10:46:53'),
(338,11,'Consulta detalles de solicitud',1,'2026-03-06 10:48:41',0,'2026-03-06 10:48:41'),
(339,10,'Consulta detalles de solicitud',1,'2026-03-06 10:49:09',0,'2026-03-06 10:49:09'),
(340,24,'Ingresa solicitud Ingresos',1,'2026-03-06 10:50:08',0,'2026-03-06 10:50:08'),
(341,24,'Consulta detalles de solicitud',1,'2026-03-06 10:50:11',0,'2026-03-06 10:50:11'),
(342,24,'Consulta detalles de solicitud',1,'2026-03-06 10:50:32',0,'2026-03-06 10:50:32'),
(343,10,'Consulta detalles de solicitud',1,'2026-03-06 10:50:49',0,'2026-03-06 10:50:49'),
(344,14,'Consulta detalles de solicitud',3,'2026-03-06 10:52:52',0,'2026-03-06 10:52:52'),
(345,14,'Consulta detalles de solicitud',3,'2026-03-06 10:53:07',0,'2026-03-06 10:53:07'),
(346,14,'Consulta detalles de solicitud',3,'2026-03-06 10:53:42',0,'2026-03-06 10:53:42'),
(347,14,'Consulta detalles de solicitud',3,'2026-03-06 10:54:30',0,'2026-03-06 10:54:30'),
(348,25,'Ingresa solicitud Ingresos',3,'2026-03-06 10:55:05',0,'2026-03-06 10:55:05'),
(349,25,'Consulta detalles de solicitud',3,'2026-03-06 10:55:09',0,'2026-03-06 10:55:09'),
(350,14,'Consulta detalles de solicitud',3,'2026-03-06 10:55:17',0,'2026-03-06 10:55:17'),
(351,14,'Consulta detalles de solicitud',3,'2026-03-06 10:56:39',0,'2026-03-06 10:56:39'),
(352,26,'Ingresa solicitud OIRS',2,'2026-03-06 11:29:09',0,'2026-03-06 11:29:09'),
(353,14,'Consulta detalles de solicitud',1,'2026-03-06 11:31:44',0,'2026-03-06 11:31:44'),
(354,10,'Consulta detalles de solicitud',1,'2026-03-06 11:31:53',0,'2026-03-06 11:31:53'),
(355,10,'Consulta detalles de solicitud',1,'2026-03-06 11:33:15',0,'2026-03-06 11:33:15'),
(356,10,'Consulta detalles de solicitud',1,'2026-03-06 11:36:39',0,'2026-03-06 11:36:39'),
(357,10,'Consulta detalles de solicitud',1,'2026-03-06 11:37:27',0,'2026-03-06 11:37:27'),
(358,14,'Consulta detalles de solicitud',1,'2026-03-06 11:37:32',0,'2026-03-06 11:37:32'),
(359,27,'Ingresa solicitud OIRS',2,'2026-03-06 11:41:57',0,'2026-03-06 11:41:57'),
(360,14,'Consulta detalles de solicitud',3,'2026-03-06 11:43:08',0,'2026-03-06 11:43:08'),
(361,25,'Consulta detalles de solicitud',3,'2026-03-06 11:43:33',0,'2026-03-06 11:43:33'),
(362,14,'Consulta detalles de solicitud',3,'2026-03-06 11:43:37',0,'2026-03-06 11:43:37'),
(363,14,'Consulta detalles de solicitud',3,'2026-03-06 11:43:41',0,'2026-03-06 11:43:41'),
(364,14,'Consulta detalles de solicitud',3,'2026-03-06 11:43:45',0,'2026-03-06 11:43:45'),
(365,18,'Consulta detalles de solicitud',3,'2026-03-06 11:49:15',0,'2026-03-06 11:49:15'),
(366,14,'Consulta detalles de solicitud',1,'2026-03-06 11:52:50',0,'2026-03-06 11:52:50'),
(367,28,'Ingresa solicitud Ingresos',3,'2026-03-06 11:53:35',0,'2026-03-06 11:53:35'),
(368,14,'Consulta detalles de solicitud',1,'2026-03-06 11:53:44',0,'2026-03-06 11:53:44'),
(369,28,'Consulta detalles de solicitud',3,'2026-03-06 11:53:52',0,'2026-03-06 11:53:52'),
(370,28,'Consulta detalles de solicitud',2,'2026-03-06 11:54:29',0,'2026-03-06 11:54:29'),
(371,28,'Consulta detalles de solicitud',1,'2026-03-06 11:55:13',0,'2026-03-06 11:55:13'),
(372,28,'Consulta detalles de solicitud',2,'2026-03-06 11:56:42',0,'2026-03-06 11:56:42'),
(373,28,'Consulta detalles de solicitud',3,'2026-03-06 11:58:13',0,'2026-03-06 11:58:13'),
(374,28,'Consulta detalles de solicitud',1,'2026-03-06 11:59:16',0,'2026-03-06 11:59:16'),
(375,28,'Consulta detalles de solicitud',1,'2026-03-06 12:00:36',0,'2026-03-06 12:00:36'),
(376,29,'Ingresa solicitud Ingresos',1,'2026-03-06 12:01:17',0,'2026-03-06 12:01:17'),
(377,29,'Consulta detalles de solicitud',1,'2026-03-06 12:01:21',0,'2026-03-06 12:01:21'),
(378,28,'Consulta detalles de solicitud',1,'2026-03-06 12:01:30',0,'2026-03-06 12:01:30'),
(379,30,'Ingresa solicitud OIRS',2,'2026-03-06 12:01:57',0,'2026-03-06 12:01:57'),
(380,31,'Ingresa solicitud Ingresos',1,'2026-03-06 12:02:44',0,'2026-03-06 12:02:44'),
(381,31,'Consulta detalles de solicitud',1,'2026-03-06 12:02:52',0,'2026-03-06 12:02:52'),
(382,31,'Consulta detalles de solicitud',1,'2026-03-06 12:03:12',0,'2026-03-06 12:03:12'),
(383,32,'Ingresa solicitud Ingresos',1,'2026-03-06 12:04:32',0,'2026-03-06 12:04:32'),
(384,32,'Consulta detalles de solicitud',1,'2026-03-06 12:05:02',0,'2026-03-06 12:05:02'),
(385,1,'Consulta detalles de solicitud',1,'2026-03-06 12:13:56',0,'2026-03-06 12:13:56'),
(386,33,'Ingresa solicitud Ingresos',1,'2026-03-06 12:14:45',0,'2026-03-06 12:14:45'),
(387,33,'Consulta detalles de solicitud',1,'2026-03-06 12:14:49',0,'2026-03-06 12:14:49'),
(388,1,'Consulta detalles de solicitud',1,'2026-03-06 12:14:54',0,'2026-03-06 12:14:54'),
(389,14,'Consulta detalles de solicitud',1,'2026-03-06 12:20:59',0,'2026-03-06 12:20:59'),
(390,29,'Consulta detalles de solicitud',3,'2026-03-06 12:22:42',0,'2026-03-06 12:22:42'),
(391,28,'Consulta detalles de solicitud',1,'2026-03-06 12:25:04',0,'2026-03-06 12:25:04'),
(392,28,'Consulta detalles de solicitud',1,'2026-03-06 12:25:22',0,'2026-03-06 12:25:22'),
(393,28,'Consulta detalles de solicitud',1,'2026-03-06 13:50:07',0,'2026-03-06 13:50:07'),
(394,16,'Consulta detalles de solicitud',2,'2026-03-06 14:35:26',0,'2026-03-06 14:35:26'),
(395,16,'Consulta detalles de solicitud',2,'2026-03-06 14:39:23',0,'2026-03-06 14:39:23'),
(396,28,'Consulta detalles de solicitud',1,'2026-03-06 15:02:15',0,'2026-03-06 15:02:15'),
(397,28,'Consulta detalles de solicitud',1,'2026-03-06 15:02:45',0,'2026-03-06 15:02:45'),
(398,28,'Consulta detalles de solicitud',1,'2026-03-06 15:02:59',0,'2026-03-06 15:02:59'),
(399,28,'Consulta detalles de solicitud',1,'2026-03-06 15:03:16',0,'2026-03-06 15:03:16'),
(400,16,'Consulta detalles de solicitud',3,'2026-03-06 15:03:25',0,'2026-03-06 15:03:25'),
(401,28,'Consulta detalles de solicitud',1,'2026-03-06 15:03:41',0,'2026-03-06 15:03:41'),
(402,15,'Consulta detalles de solicitud',2,'2026-03-06 15:03:45',0,'2026-03-06 15:03:45'),
(403,28,'Consulta detalles de solicitud',1,'2026-03-06 15:03:50',0,'2026-03-06 15:03:50'),
(404,28,'Consulta detalles de solicitud',1,'2026-03-06 15:03:55',0,'2026-03-06 15:03:55'),
(405,15,'Consulta detalles de solicitud',2,'2026-03-06 15:04:00',0,'2026-03-06 15:04:00'),
(406,24,'Consulta detalles de solicitud',1,'2026-03-06 15:05:07',0,'2026-03-06 15:05:07'),
(407,24,'Consulta detalles de solicitud',1,'2026-03-06 15:05:14',0,'2026-03-06 15:05:14'),
(408,25,'Consulta detalles de solicitud',1,'2026-03-06 15:05:40',0,'2026-03-06 15:05:40'),
(409,25,'Consulta detalles de solicitud',1,'2026-03-06 15:19:12',0,'2026-03-06 15:19:12'),
(410,25,'Consulta detalles de solicitud',1,'2026-03-06 15:36:36',0,'2026-03-06 15:36:36'),
(411,25,'Consulta detalles de solicitud',1,'2026-03-06 15:37:11',0,'2026-03-06 15:37:11'),
(412,16,'Consulta detalles de solicitud',2,'2026-03-06 15:39:24',0,'2026-03-06 15:39:24'),
(413,25,'Consulta detalles de solicitud',1,'2026-03-06 15:57:29',0,'2026-03-06 15:57:29'),
(414,25,'Funcionario responde a solicitud (Resuelto_Favorable)',1,'2026-03-06 15:58:07',0,'2026-03-06 15:58:07'),
(415,25,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-03-06 15:58:07',0,'2026-03-06 15:58:07'),
(416,25,'Consulta detalles de solicitud',1,'2026-03-06 15:58:10',0,'2026-03-06 15:58:10'),
(417,34,'Ingresa solicitud Ingresos',2,'2026-03-06 16:00:05',0,'2026-03-06 16:00:05'),
(418,34,'Consulta detalles de solicitud',1,'2026-03-06 16:00:28',0,'2026-03-06 16:00:28'),
(419,34,'Funcionario responde a solicitud (Resuelto_Favorable)',1,'2026-03-06 16:00:37',0,'2026-03-06 16:00:37'),
(420,34,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-03-06 16:00:37',0,'2026-03-06 16:00:37'),
(421,34,'Consulta detalles de solicitud',1,'2026-03-06 16:00:39',0,'2026-03-06 16:00:39'),
(422,11,'Consulta detalles de solicitud',1,'2026-03-06 16:01:48',0,'2026-03-06 16:01:48'),
(423,23,'Ingresa respuesta técnica OIRS',2,'2026-03-09 10:18:03',0,'2026-03-09 10:18:03');
/*!40000 ALTER TABLE `trd_general_bitacora` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_comentario` ENABLE KEYS */;
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
  `tgc_acepta_privacidad` tinyint(1) DEFAULT 0,
  `tgc_fecha_acepta_privacidad` datetime DEFAULT NULL,
  `tgc_borrado` tinyint(1) DEFAULT 0,
  `tgc_creacion` datetime DEFAULT current_timestamp(),
  `tgc_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tgc_id`),
  KEY `trd_general_contribuyentes_trd_cont_escolaridad_FK` (`tgc_escolaridad`),
  CONSTRAINT `trd_general_contribuyentes_trd_cont_escolaridad_FK` FOREIGN KEY (`tgc_escolaridad`) REFERENCES `trd_cont_escolaridad` (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(1,'11111111-1','natural','',NULL,NULL,'',NULL,'1','1','1','Otro','1990-02-03','Divorciado/a',3,NULL,'centrib@test.cl','+56944444444',0,NULL,0,'2026-02-19 19:44:53','2026-02-26 12:07:30'),
(2,'14037230-7','natural','',NULL,NULL,'',NULL,'RAMON ANDRES','MARTÍNEZ','VILLANUEVA','Masculino','1981-10-10','Casado/a',3,NULL,'RMARTINEZVCL@GMAIL.COM','+56993201821',0,NULL,0,'2026-02-19 19:44:53','2026-03-05 13:14:00'),
(3,'17619949-0','natural',NULL,NULL,NULL,NULL,NULL,'Leticia ','meneses','astorga',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,'2026-02-23 10:38:48','2026-02-23 10:38:48'),
(4,'12123123-5','natural','',NULL,NULL,'',NULL,'cecilia','jara','jara','Femenino','1958-05-12','Casado/a',5,NULL,'notiene@gmail.com','+56995456123',0,NULL,0,'2026-02-26 17:12:42','2026-02-26 17:12:42'),
(5,'111111111-0','natural','',NULL,NULL,'',NULL,'prueba','prueba','prueba','Femenino','1990-03-04','Soltero/a',5,NULL,'correoprueba@gmaill.com','+56999999999',0,NULL,0,'2026-03-04 14:04:23','2026-03-04 14:04:23'),
(6,'99999999-9','natural','',NULL,NULL,'',NULL,'prueba3','prueba3','prueba3','Otro','1990-03-06','Soltero/a',5,NULL,'notienew@gmail.com','+56999999999',0,NULL,0,'2026-03-06 10:00:42','2026-03-06 10:00:42'),
(7,'17619949-0','natural','',NULL,NULL,'',NULL,'LEticia','Meneses','astorga','Femenino','1993-04-27','Soltero/a',10,NULL,'notiene@gmail.com','+56999999999',0,NULL,0,'2026-03-06 11:29:09','2026-03-06 11:29:09'),
(8,'11111111-1','natural','',NULL,NULL,'',NULL,'prueba07','prueba07','prueba07','Otro','1995-03-06','Casado/a',10,NULL,'notine@gmail.com','+56955555555',0,NULL,0,'2026-03-06 11:41:57','2026-03-06 11:41:57'),
(9,'12456789-5','natural','',NULL,NULL,'',NULL,'PRUEBA08','PRUEBA08','PRUEBA08','Masculino','1998-03-06','Soltero/a',11,NULL,'NOTIENE@GMAIL.COM','+56999999999',0,NULL,0,'2026-03-06 12:01:57','2026-03-06 12:01:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(1,1,'2026-03-03 17:25:16',1,0,'2026-03-03 17:25:16'),
(2,2,'2026-03-04 09:54:02',2,0,'2026-03-04 09:54:02'),
(3,12,'2026-03-04 16:35:10',3,0,'2026-03-04 16:35:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto_versiones` VALUES
(1,1,'2026-03-03 17:25:16','gestordocumental/202603/2603032125ddreT.imv','LeyTransformaciónDigital_Leticia.pdf',2,0,'202603/.ck',0,0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(2,2,'2026-03-04 09:54:02','gestordocumental/202603/2603041354xTl8B.imv','Listado_Ingresos_DESVE.pdf',2,0,'202603/.ck',0,0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(3,3,'2026-03-04 16:35:10','gestordocumental/202603/2603042035xMYO1.imv','Listado_Ingresos_DESVE.pdf',1,0,'202603/.ck',1,0,'2026-03-04 16:35:10','2026-03-04 16:35:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES
(1,1,'https://www.lenovo.com/cl/es/p/notebooks/yoga/yoga-serie-slim/lenovo-yoga-slim-7i-aura-edition-gen-10-14-inch-intel/83jxcto1wwcl1?cid=cl:sem:pmax|se|google|pmax+top+roas|||83JXCTO1WWCL1|23437901494|||pmax|mixed|all&gad_source=4&gad_campaignid=23428340292&gbraid=0AAAAAC6Zm9KbuWQI2H24-enfbJobai0zn&gclid=CjwKCAiAqprNBhB6EiwAMe3yhufbuh5E-kjAtxn0mNX4vh4RACSoyjBBSobvqxXgoBEFVulLHDviDBoCbTsQAvD_BwE',2,'2026-03-03 17:25:16',0,'2026-03-03 17:25:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(1,'2026-03-03 17:25:16','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 1','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Prueba01\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Realizar solicitud de compra computadores\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-03\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"},{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/www.lenovo.com\\/cl\\/es\\/p\\/notebooks\\/yoga\\/yoga-serie-slim\\/lenovo-yoga-slim-7i-aura-edition-gen-10-14-inch-intel\\/83jxcto1wwcl1?cid=cl:sem:pmax|se|google|pmax+top+roas|||83JXCTO1WWCL1|23437901494|||pmax|mixed|all&gad_source=4&gad_campaignid=23428340292&gbraid=0AAAAAC6Zm9KbuWQI2H24-enfbJobai0zn&gclid=CjwKCAiAqprNBhB6EiwAMe3yhufbuh5E-kjAtxn0mNX4vh4RACSoyjBBSobvqxXgoBEFVulLHDviDBoCbTsQAvD_BwE\"],\"documentos\":[{\"nombre\":\"LeyTransformaci\\u00f3nDigital_Leticia.pdf\"}]}}','192.168.0.168','Exitoso',0,'2026-03-03 17:25:16'),
(2,'2026-03-03 17:50:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-03 17:50:55'),
(3,'2026-03-04 09:34:32','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 09:34:32'),
(4,'2026-03-04 09:39:19','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 09:39:19'),
(5,'2026-03-04 09:39:48','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 09:39:48'),
(6,'2026-03-04 09:41:45','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 09:41:45'),
(7,'2026-03-04 09:52:32','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 09:52:32'),
(8,'2026-03-04 09:54:02','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 2','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Prueba02\",\"tis_tipo\":\"1\",\"tis_contenido\":\"revisi\\u00f3n de pesta\\u00f1as sistema\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"},{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"Listado_Ingresos_DESVE.pdf\"}]}}','192.168.0.168','Exitoso',0,'2026-03-04 09:54:02'),
(9,'2026-03-04 10:02:48','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-04 10:02:48'),
(10,'2026-03-04 10:03:47','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-04 10:03:47'),
(11,'2026-03-04 10:04:49','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-04 10:04:49'),
(12,'2026-03-04 10:05:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-04 10:05:01'),
(13,'2026-03-04 10:14:14','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 10:14:14'),
(14,'2026-03-04 10:56:10','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 3','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asd\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 10:56:10'),
(15,'2026-03-04 10:57:26','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 10:57:26'),
(16,'2026-03-04 10:57:42','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 4','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 002\",\"tis_tipo\":\"1\",\"tis_contenido\":\"qwe\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 10:57:42'),
(17,'2026-03-04 11:57:48','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 5','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004b\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba para verificar crearhija\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 11:57:48'),
(18,'2026-03-04 12:21:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 12:21:04'),
(19,'2026-03-04 12:31:41','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 6','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.4\",\"tis_tipo\":\"1\",\"tis_contenido\":\"preba de crear hija\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:31:41'),
(20,'2026-03-04 12:40:46','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 7','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.5\",\"tis_tipo\":\"1\",\"tis_contenido\":\"PRUEBA DE CREWAR HIJA 5\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:40:46'),
(21,'2026-03-04 12:40:54','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 8','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.5\",\"tis_tipo\":\"1\",\"tis_contenido\":\"PRUEBA DE CREWAR HIJA 5\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:40:54'),
(22,'2026-03-04 12:41:13','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 9','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.5\",\"tis_tipo\":\"1\",\"tis_contenido\":\"PRUEBA DE CREWAR HIJA 5\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:41:13'),
(23,'2026-03-04 12:42:56','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 10','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.5\",\"tis_tipo\":\"1\",\"tis_contenido\":\"PRUEBA DE CREWAR HIJA 5\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:42:56'),
(24,'2026-03-04 12:44:41','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 11','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004.6\",\"tis_tipo\":\"1\",\"tis_contenido\":\"PRUEBA 6\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-04 12:44:41'),
(25,'2026-03-04 14:04:23','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 1','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"111111111-0\",\"cont_nombres\":\"prueba\",\"cont_apellido_paterno\":\"prueba\",\"cont_apellido_materno\":\"prueba\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1990-03-04\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"5\",\"cont_email\":\"correoprueba@gmaill.com\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Habana 414, 2580329 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.02885369490097\",\"cont_longitud\":\"-71.56879447631836\",\"oirs_tipo_atencion\":\"2\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"2\",\"oirs_creacion\":\"2026-03-04 18:01\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"Viena 423, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":null,\"oirs_descripcion\":\"necesito retirar basura acumulada\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02881771483269\",\"oirs_longitud\":\"-71.56746410064697\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"1\",\"rgt_id\":\"12\"}}','192.168.0.168','Exitoso',0,'2026-03-04 14:04:23'),
(26,'2026-03-04 14:43:45','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 14:43:45'),
(27,'2026-03-04 14:49:46','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-04 14:49:46'),
(28,'2026-03-04 14:49:49','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 14:49:49'),
(29,'2026-03-04 14:50:45','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 12','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"SOLICITO ENV\\u00ccO DE CORREO INVITANDO A DOCDIGITAL\",\"tis_tipo\":\"1\",\"tis_contenido\":\"POR SU INTERMEDIO SOLICITO INVITAR A LOS FUNCIONARIOS\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-04 14:50:45'),
(30,'2026-03-04 16:25:22','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 13','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Revisi\\u00f3n de ingreso\",\"tis_tipo\":\"1\",\"tis_contenido\":\"favor revisar ingreso\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-04 16:25:22'),
(31,'2026-03-04 16:25:31','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 16:25:31'),
(32,'2026-03-04 16:32:34','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 14','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba 6\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba 6\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-04 16:32:34'),
(33,'2026-03-04 16:33:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 16:33:51'),
(34,'2026-03-04 16:50:20','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 16:50:20'),
(35,'2026-03-04 16:51:00','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 15','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba 10\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba 10\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-04\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-04 16:51:00'),
(36,'2026-03-04 16:53:17','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-04 16:53:17'),
(37,'2026-03-04 16:55:57','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario daniela.ruiz@munivina.cl inició sesión correctamente','{\"email\":\"daniela.ruiz@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-04 16:55:57'),
(38,'2026-03-05 09:26:23','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-05 09:26:23'),
(39,'2026-03-05 11:26:46','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-05 11:26:46'),
(40,'2026-03-05 12:16:59','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-05 12:16:59'),
(41,'2026-03-05 12:56:58','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-05 12:56:58'),
(42,'2026-03-05 12:57:09','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-05 12:57:09'),
(43,'2026-03-05 13:14:00','CREATE','info','Medio','OIRS',3,'CREAR_OIRS','Creación de solicitud OIRS: 2','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"RAMON ANDRES\",\"cont_apellido_paterno\":\"MART\\u00cdNEZ\",\"cont_apellido_materno\":\"VILLANUEVA\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"RMARTINEZVCL@GMAIL.COM\",\"cont_telefono\":\"+56993201821\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Las Magnolias 38, 2551470\",\"cont_latitud\":\"-33.010443\",\"cont_longitud\":\"-71.5024312\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-05 12:00\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"alvarez 140\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"necesito una casa para un perrito\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0253521\",\"oirs_longitud\":\"-71.5608063\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"2\",\"rgt_id\":\"17\"}}','192.168.0.112','Exitoso',0,'2026-03-05 13:14:00'),
(44,'2026-03-05 13:24:59','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-05 13:24:59'),
(45,'2026-03-05 15:34:57','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-05 15:34:57'),
(46,'2026-03-05 16:34:15','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-05 16:34:15'),
(47,'2026-03-06 08:41:45','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 16','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"favor revisar pantallas\",\"tis_tipo\":\"1\",\"tis_contenido\":\"pantallas\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-06 08:41:45'),
(48,'2026-03-06 09:31:32','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-06 09:31:32'),
(49,'2026-03-06 09:32:19','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 17','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Prueba011\",\"tis_tipo\":\"1\",\"tis_contenido\":\"favor leer documento\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-06 09:32:19'),
(50,'2026-03-06 09:32:57','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 18','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba012\",\"tis_tipo\":\"1\",\"tis_contenido\":\"favor visar este documento\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-06 09:32:57'),
(51,'2026-03-06 10:00:42','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 3','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"99999999-9\",\"cont_nombres\":\"prueba3\",\"cont_apellido_paterno\":\"prueba3\",\"cont_apellido_materno\":\"prueba3\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-03-06\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"5\",\"cont_email\":\"notienew@gmail.com\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Quilpu\\u00e9 200, 2520477 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.025687392664466\",\"cont_longitud\":\"-71.54763721160889\",\"oirs_tipo_atencion\":\"4\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"3\",\"oirs_creacion\":\"2026-03-06 10:00\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"Arlegui 947, 2520434 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"ayuda con corte de \\u00e1rbol\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02449999999999\",\"oirs_longitud\":\"-71.54834531478882\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"3\",\"rgt_id\":\"21\"}}','192.168.0.168','Exitoso',0,'2026-03-06 10:00:42'),
(52,'2026-03-06 10:25:03','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 19','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso hija\",\"tis_tipo\":\"2\",\"tis_contenido\":\"fgh\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 10:25:03'),
(53,'2026-03-06 10:26:49','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 4','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"centrib@test.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Timalchaca 75, 2561949 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.02987912067151\",\"cont_longitud\":\"-71.495967137146\",\"oirs_tipo_atencion\":\"2\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"5\",\"oirs_creacion\":\"2026-03-06 10:25\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"Tamarugal 545, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"1\",\"oirs_descripcion\":\"falta iluminaci\\u00f3n\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.030077008481825\",\"oirs_longitud\":\"-71.4947440498352\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"4\",\"rgt_id\":\"23\"}}','192.168.0.168','Exitoso',0,'2026-03-06 10:26:49'),
(54,'2026-03-06 10:50:11','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 20','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 007 hija \",\"tis_tipo\":\"1\",\"tis_contenido\":\"asd\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 10:50:11'),
(55,'2026-03-06 10:55:09','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 21','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"hijo de la 13 mia\",\"tis_tipo\":\"1\",\"tis_contenido\":\"test\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-06 10:55:09'),
(56,'2026-03-06 11:29:09','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 5','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"17.619.949-0\",\"cont_nombres\":\"LEticia\",\"cont_apellido_paterno\":\"Meneses\",\"cont_apellido_materno\":\"astorga\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1993-04-27\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"notiene@gmail.com\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Av. Valpara\\u00edso 1367, 2520520 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.026442997849884\",\"cont_longitud\":\"-71.54291652374268\",\"oirs_tipo_atencion\":\"4\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-06 11:27\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"5\",\"oirs_calle\":\"Arlegui 736, 2520450 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"felicidades por la seguridad del sector\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02421214482397\",\"oirs_longitud\":\"-71.55053399734497\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"5\",\"rgt_id\":\"26\"}}','192.168.0.168','Exitoso',0,'2026-03-06 11:29:09'),
(57,'2026-03-06 11:41:57','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 6','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11.111.111-1\",\"cont_nombres\":\"prueba07\",\"cont_apellido_paterno\":\"prueba07\",\"cont_apellido_materno\":\"prueba07\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1995-03-06\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"10\",\"cont_email\":\"notine@gmail.com\",\"cont_telefono\":\"+56955555555\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Padre Hurtado 400, 2520000 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.03608539040625\",\"cont_longitud\":\"-71.562786328125\",\"oirs_tipo_atencion\":\"5\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"3\",\"oirs_creacion\":\"2026-03-06 11:39\",\"oirs_tematica\":\"1\",\"oirs_subtematica\":\"1\",\"oirs_calle\":\"1 Nte. 1481, 2560564 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"Necesito una piscina en ese sector\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02424812677238\",\"oirs_longitud\":\"-71.54081367187503\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"6\",\"rgt_id\":\"27\"}}','192.168.0.168','Exitoso',0,'2026-03-06 11:41:57'),
(58,'2026-03-06 11:53:41','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 22','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"implementar docdigital\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Estimado, \\n\\nSolicito crear su cuenta en doc digital.\\n\\nsaludos,\\n\\nram\\u00f3n mart\\u00ednez\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-03-06 11:53:41'),
(59,'2026-03-06 12:01:20','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 23','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"queremos implementar docdigital\",\"tis_tipo\":\"2\",\"tis_contenido\":\"impolementaaar\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 12:01:20'),
(60,'2026-03-06 12:01:57','CREATE','info','Medio','OIRS',2,'CREAR_OIRS','Creación de solicitud OIRS: 7','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"12.456.789-5\",\"cont_nombres\":\"PRUEBA08\",\"cont_apellido_paterno\":\"PRUEBA08\",\"cont_apellido_materno\":\"PRUEBA08\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1998-03-06\",\"cont_estado_civil\":\"Soltero\\/a\",\"cont_escolaridad\":\"11\",\"cont_email\":\"NOTIENE@GMAIL.COM\",\"cont_telefono\":\"+56999999999\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Las Maravillas \\/ Cancha, 2552748 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-32.99930911509057\",\"cont_longitud\":\"-71.49862788848877\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-06 12:00\",\"oirs_tematica\":\"4\",\"oirs_subtematica\":\"6\",\"oirs_calle\":\"Av. Sta. Julia 3, 2551403 Valpara\\u00edso, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"14\",\"oirs_descripcion\":\"NECESITO AYUDA CON POSTULACI\\u00d3N A BECA DE ESTUDIOS\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.00816273182837\",\"oirs_longitud\":\"-71.50064490966797\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"7\",\"rgt_id\":\"30\"}}','192.168.0.168','Exitoso',0,'2026-03-06 12:01:57'),
(61,'2026-03-06 12:02:47','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 24','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"aun queremos\",\"tis_tipo\":\"1\",\"tis_contenido\":\"docdigital\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 12:02:47'),
(62,'2026-03-06 12:04:35','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 25','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"33333333\",\"tis_tipo\":\"2\",\"tis_contenido\":\"aun queremos\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 12:04:35'),
(63,'2026-03-06 12:14:48','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 26','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"lola\",\"tis_tipo\":\"2\",\"tis_contenido\":\"lula\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-06 12:14:48'),
(64,'2026-03-06 15:04:52','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-06 15:04:52'),
(65,'2026-03-06 15:05:14','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-06 15:05:14'),
(66,'2026-03-06 15:05:30','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-06 15:05:30'),
(67,'2026-03-06 16:00:09','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 27','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba 20\",\"tis_tipo\":\"1\",\"tis_contenido\":\"revisa el decreto y verifica que se cumpla\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-06 16:00:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_mails_enviados`
--

LOCK TABLES `trd_general_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_general_mails_enviados` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_mails_enviados` VALUES
(1,16,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: prueba 10\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>15<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba 10<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba 10<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>01-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-04 16:51:00','2026-03-04 16:51:00'),
(2,18,2,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: favor revisar pantallas\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>16<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>favor revisar pantallas<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>pantallas<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 08:41:45','2026-03-06 08:41:45'),
(3,19,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: Prueba011\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>17<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Prueba011<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>favor leer documento<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 09:32:19','2026-03-06 09:32:19'),
(4,20,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: prueba012\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>18<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba012<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>favor visar este documento<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 09:32:57','2026-03-06 09:32:57'),
(5,22,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: prueba ingreso de ingreso hija\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>19<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ingreso de ingreso hija<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>fgh<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 10:25:03','2026-03-06 10:25:03'),
(6,24,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: prueba ingreso de ingreso 007 hija \",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>20<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba ingreso de ingreso 007 hija <\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>asd<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 10:50:11','2026-03-06 10:50:11'),
(7,25,1,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: hijo de la 13 mia\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Juan hervas<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>21<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>hijo de la 13 mia<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>test<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 10:55:09','2026-03-06 10:55:09'),
(8,28,1,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: implementar docdigital\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Juan hervas<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>22<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>implementar docdigital<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Estimado, \\n\\nSolicito crear su cuenta en doc digital.\\n\\nsaludos,\\n\\nramón martínez<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 11:53:38','2026-03-06 11:53:38'),
(9,28,2,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: implementar docdigital\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Leticia meneses<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>22<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>implementar docdigital<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>Estimado, \\n\\nSolicito crear su cuenta en doc digital.\\n\\nsaludos,\\n\\nramón martínez<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 11:53:41','2026-03-06 11:53:41'),
(10,29,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: queremos implementar docdigital\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>23<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>queremos implementar docdigital<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>impolementaaar<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 12:01:20','2026-03-06 12:01:20'),
(11,31,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: aun queremos\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>24<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>aun queremos<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>docdigital<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 12:02:47','2026-03-06 12:02:47'),
(12,32,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: 33333333\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>25<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>33333333<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>aun queremos<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 12:04:35','2026-03-06 12:04:35'),
(13,33,3,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: lola\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Ramon Martinez<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>26<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>lola<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>lula<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 12:14:48','2026-03-06 12:14:48'),
(14,34,1,NULL,'{\"asunto\":\"Ingresos - Solicitud creación: prueba 20\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>Ingresos - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>Juan hervas<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud en el módulo de Ingresos:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>27<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Título:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba 20<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Contenido:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>revisa el decreto y verifica que se cumpla<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Límite:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>03-04-2026<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"juan.hervas@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-03-06 16:00:09','2026-03-06 16:00:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_multiancestro` VALUES
(1,4,7,0,'2026-03-04 12:40:46','2026-03-04 12:40:46'),
(2,4,8,0,'2026-03-04 12:40:54','2026-03-04 12:40:54'),
(3,4,9,0,'2026-03-04 12:41:14','2026-03-04 12:41:14'),
(4,4,10,0,'2026-03-04 12:42:56','2026-03-04 12:42:56'),
(5,4,11,0,'2026-03-04 12:44:41','2026-03-04 12:44:41'),
(6,9,11,0,'2026-03-04 14:02:06','2026-03-04 14:02:06'),
(7,13,18,0,'2026-03-06 08:41:46','2026-03-06 08:41:46'),
(8,13,22,0,'2026-03-06 10:25:04','2026-03-06 10:25:04'),
(9,11,14,0,'2026-03-06 10:41:19','2026-03-06 10:41:19'),
(10,8,11,0,'2026-03-06 10:43:25','2026-03-06 10:43:25'),
(11,10,24,0,'2026-03-06 10:50:11','2026-03-06 10:50:11'),
(12,14,25,0,'2026-03-06 10:55:09','2026-03-06 10:56:35'),
(13,1,33,0,'2026-03-06 12:14:49','2026-03-06 12:14:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_expedientes`
--

LOCK TABLES `trd_general_registro_general_expedientes` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_expedientes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_expedientes` VALUES
(1,'260303-2125-Ingreso_ingresos-5V','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(2,'260304-1354-Ingreso_ingresos-Vg','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(3,'260304-1456-Ingreso_ingresos-y2','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 10:56:10','2026-03-04 10:56:10'),
(4,'260304-1457-Ingreso_ingresos-4z','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 10:57:42','2026-03-04 10:57:42'),
(5,'260304-1557-Ingreso_ingresos-Ei','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 11:57:48','2026-03-04 11:57:48'),
(6,'260304-1631-Ingreso_ingresos-Gs','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:31:41','2026-03-04 12:31:41'),
(7,'260304-1640-Ingreso_ingresos-dz','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:40:46','2026-03-04 12:40:46'),
(8,'260304-1640-Ingreso_ingresos-iV','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:40:54','2026-03-04 12:40:54'),
(9,'260304-1641-Ingreso_ingresos-uB','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:41:13','2026-03-04 12:41:13'),
(10,'260304-1642-Ingreso_ingresos-If','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:42:56','2026-03-04 12:42:56'),
(11,'260304-1644-Ingreso_ingresos-Wb','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-04 12:44:41','2026-03-04 12:44:41'),
(12,'260304-1804-OIRS-Xj','oirs',NULL,1,5,0,'2026-03-04 14:04:23','2026-03-04 14:04:23'),
(13,'260304-1850-Ingreso_ingresos-2B','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-04 14:50:45','2026-03-04 14:50:45'),
(14,'260304-2025-Ingreso_ingresos-mX','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-04 16:25:22','2026-03-04 16:25:22'),
(15,'260304-2032-Ingreso_ingresos-C6','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-04 16:32:34','2026-03-04 16:32:34'),
(16,'260304-2050-Ingreso_ingresos-Zo','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-04 16:50:56','2026-03-04 16:50:56'),
(17,'260305-1714-OIRS-XW','oirs',NULL,3,2,0,'2026-03-05 13:14:00','2026-03-05 13:14:00'),
(18,'260306-1241-Ingreso_ingresos-H4','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-06 08:41:42','2026-03-06 08:41:42'),
(19,'260306-1332-Ingreso_ingresos-Ak','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-06 09:32:16','2026-03-06 09:32:16'),
(20,'260306-1332-Ingreso_ingresos-vT','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-06 09:32:54','2026-03-06 09:32:54'),
(21,'260306-1400-OIRS-RB','oirs',NULL,2,6,0,'2026-03-06 10:00:42','2026-03-06 10:00:42'),
(22,'260306-1425-Ingreso_ingresos-Zm','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 10:25:00','2026-03-06 10:25:00'),
(23,'260306-1426-OIRS-gT','oirs',NULL,2,1,0,'2026-03-06 10:26:49','2026-03-06 10:26:49'),
(24,'260306-1450-Ingreso_ingresos-rF','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 10:50:08','2026-03-06 10:50:08'),
(25,'260306-1455-Ingreso_ingresos-dq','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-06 10:55:05','2026-03-06 10:55:05'),
(26,'260306-1529-OIRS-is','oirs',NULL,2,7,0,'2026-03-06 11:29:09','2026-03-06 11:29:09'),
(27,'260306-1541-OIRS-WP','oirs',NULL,2,8,0,'2026-03-06 11:41:57','2026-03-06 11:41:57'),
(28,'260306-1553-Ingreso_ingresos-z5','Ingreso_ingresos',NULL,3,NULL,0,'2026-03-06 11:53:35','2026-03-06 11:53:35'),
(29,'260306-1601-Ingreso_ingresos-if','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 12:01:17','2026-03-06 12:01:17'),
(30,'260306-1601-OIRS-GX','oirs',NULL,2,9,0,'2026-03-06 12:01:57','2026-03-06 12:01:57'),
(31,'260306-1602-Ingreso_ingresos-Fb','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 12:02:44','2026-03-06 12:02:44'),
(32,'260306-1604-Ingreso_ingresos-WK','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 12:04:32','2026-03-06 12:04:32'),
(33,'260306-1614-Ingreso_ingresos-WF','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-06 12:14:45','2026-03-06 12:14:45'),
(34,'260306-2000-Ingreso_ingresos-CN','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-06 16:00:05','2026-03-06 16:00:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_destinos` VALUES
(1,1,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-03 17:25:16','2026-03-03 17:25:16'),
(2,1,3,'Para','Visación aprobada por responsable.',NULL,'Visador',1,1,'2026-03-04 10:14:29',0,'2026-03-03 17:25:16','2026-03-04 10:14:29'),
(3,2,1,'Para',NULL,NULL,'Firmante',1,NULL,NULL,0,'2026-03-04 09:54:02','2026-03-04 09:54:02'),
(4,2,3,'Para','Visación aprobada por responsable.',NULL,'Visador',1,1,'2026-03-04 10:03:36',0,'2026-03-04 09:54:02','2026-03-04 10:03:36'),
(5,3,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 10:56:10','2026-03-04 10:56:10'),
(6,4,2,'Para',NULL,NULL,'Visador',1,NULL,NULL,0,'2026-03-04 10:57:42','2026-03-04 10:57:42'),
(7,5,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 11:57:48','2026-03-04 11:57:48'),
(8,6,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:31:41','2026-03-04 12:31:41'),
(9,7,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:40:46','2026-03-04 12:40:46'),
(10,8,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:40:54','2026-03-04 12:40:54'),
(11,9,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:41:13','2026-03-04 12:41:13'),
(12,10,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:42:56','2026-03-04 12:42:56'),
(13,11,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 12:44:41','2026-03-04 12:44:41'),
(14,12,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 14:50:45','2026-03-04 14:50:45'),
(15,13,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 16:25:22','2026-03-04 16:25:22'),
(16,13,2,'Para','Visación aprobada por responsable.',NULL,'Visador',1,1,'2026-03-04 16:28:27',0,'2026-03-04 16:25:22','2026-03-04 16:28:27'),
(17,14,3,'Para',NULL,NULL,'Firmante',1,NULL,NULL,0,'2026-03-04 16:32:34','2026-03-04 16:32:34'),
(18,15,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-04 16:50:56','2026-03-04 16:50:56'),
(19,16,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 08:41:42','2026-03-06 08:41:42'),
(20,17,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 09:32:16','2026-03-06 09:32:16'),
(21,18,3,'Para',NULL,NULL,'Visador',1,NULL,NULL,0,'2026-03-06 09:32:54','2026-03-06 09:32:54'),
(22,19,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 10:25:00','2026-03-06 10:25:00'),
(23,20,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 10:50:08','2026-03-06 10:50:08'),
(24,21,1,'Para','asd',NULL,'Responsable',1,1,'2026-03-06 15:58:07',0,'2026-03-06 10:55:05','2026-03-06 15:58:07'),
(25,22,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 11:53:35','2026-03-06 11:53:35'),
(26,22,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 11:53:35','2026-03-06 11:53:35'),
(27,23,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 12:01:17','2026-03-06 12:01:17'),
(28,24,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 12:02:44','2026-03-06 12:02:44'),
(29,25,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 12:04:32','2026-03-06 12:04:32'),
(30,26,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-06 12:14:45','2026-03-06 12:14:45'),
(31,27,1,'Para','Visación aprobada por responsable.',NULL,'Visador',1,1,'2026-03-06 16:00:37',0,'2026-03-06 16:00:05','2026-03-06 16:00:37');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(1,1,'Prueba01','Realizar solicitud de compra computadores','Visado',2,NULL,'2026-03-03 00:00:00','2026-03-31',1,0,'2026-03-04 10:14:29'),
(2,1,'Prueba02','revisión de pestañas sistema','Visado',2,NULL,'2026-03-04 00:00:00','2026-04-01',2,0,'2026-03-04 10:03:36'),
(3,1,'prueba ingreso de ingreso 001','asd','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',3,0,'2026-03-04 10:56:10'),
(4,1,'prueba ingreso de ingreso 002','qwe','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',4,0,'2026-03-04 10:57:42'),
(5,1,'prueba ingreso de ingreso 004b','prueba para verificar crearhija','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',5,0,'2026-03-04 11:57:48'),
(6,1,'prueba ingreso de ingreso 004.4','preba de crear hija','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',6,0,'2026-03-04 12:31:41'),
(7,1,'prueba ingreso de ingreso 004.5','PRUEBA DE CREWAR HIJA 5','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',7,0,'2026-03-04 12:40:46'),
(8,1,'prueba ingreso de ingreso 004.5','PRUEBA DE CREWAR HIJA 5','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',8,0,'2026-03-04 12:40:54'),
(9,1,'prueba ingreso de ingreso 004.5','PRUEBA DE CREWAR HIJA 5','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',9,0,'2026-03-04 12:41:13'),
(10,1,'prueba ingreso de ingreso 004.5','PRUEBA DE CREWAR HIJA 5','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',10,0,'2026-03-04 12:42:56'),
(11,1,'prueba ingreso de ingreso 004.6','PRUEBA 6','Ingresado',1,NULL,'2026-03-04 00:00:00','2026-04-01',11,0,'2026-03-04 12:44:41'),
(12,1,'SOLICITO ENVÌO DE CORREO INVITANDO A DOCDIGITAL','POR SU INTERMEDIO SOLICITO INVITAR A LOS FUNCIONARIOS','Ingresado',3,NULL,'2026-03-04 00:00:00','2026-04-01',13,0,'2026-03-04 14:50:45'),
(13,1,'Revisión de ingreso','favor revisar ingreso','Visado',3,NULL,'2026-03-04 00:00:00','2026-04-01',14,0,'2026-03-04 16:27:03'),
(14,1,'prueba 6','prueba 6','Ingresado',2,NULL,'2026-03-04 00:00:00','2026-04-01',15,0,'2026-03-04 16:32:34'),
(15,1,'prueba 10','prueba 10','Ingresado',2,NULL,'2026-03-04 00:00:00','2026-04-01',16,0,'2026-03-04 16:50:56'),
(16,1,'favor revisar pantallas','pantallas','Ingresado',3,NULL,'2026-03-06 00:00:00','2026-04-03',18,0,'2026-03-06 08:41:42'),
(17,1,'Prueba011','favor leer documento','Ingresado',2,NULL,'2026-03-06 00:00:00','2026-04-03',19,0,'2026-03-06 09:32:16'),
(18,1,'prueba012','favor visar este documento','Ingresado',2,NULL,'2026-03-06 00:00:00','2026-04-03',20,0,'2026-03-06 09:32:54'),
(19,2,'prueba ingreso de ingreso hija','fgh','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',22,0,'2026-03-06 10:25:00'),
(20,1,'prueba ingreso de ingreso 007 hija ','asd','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',24,0,'2026-03-06 10:50:08'),
(21,1,'hijo de la 13 mia','test','Resuelto_Favorable',3,NULL,'2026-03-06 00:00:00','2026-04-03',25,0,'2026-03-06 15:58:07'),
(22,1,'implementar docdigital','Estimado, \n\nSolicito crear su cuenta en doc digital.\n\nsaludos,\n\nramón martínez','Ingresado',3,NULL,'2026-03-06 00:00:00','2026-04-03',28,0,'2026-03-06 11:53:35'),
(23,2,'queremos implementar docdigital','impolementaaar','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',29,0,'2026-03-06 12:01:17'),
(24,1,'aun queremos','docdigital','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',31,0,'2026-03-06 12:02:44'),
(25,2,'33333333','aun queremos','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',32,0,'2026-03-06 12:04:32'),
(26,2,'lola','lula','Ingresado',1,NULL,'2026-03-06 00:00:00','2026-04-03',33,0,'2026-03-06 12:14:45'),
(27,1,'prueba 20','revisa el decreto y verifica que se cumpla','Visado',2,NULL,'2026-03-06 00:00:00','2026-04-03',34,0,'2026-03-06 16:00:37');
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
  `oia_asignacion` int(11) NOT NULL,
  `oia_nivel_asignacion` tinyint(4) NOT NULL,
  `oia_Instruccion` text DEFAULT NULL,
  `oia_borrado` tinyint(1) DEFAULT 0,
  `oia_creacion` datetime DEFAULT current_timestamp(),
  `oia_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`oia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones`
--

LOCK TABLES `trd_oirs_asignaciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_asignaciones` VALUES
(1,1,3,1,'revisar oirs',0,'2026-03-05 09:28:58','2026-03-05 09:28:58'),
(2,1,1,1,'necesito que revises los decretos xx y veas si se puede realizar',0,'2026-03-05 11:27:45','2026-03-05 11:27:45'),
(3,2,1,1,'por favor evaluar la entrega de esto',0,'2026-03-05 13:22:27','2026-03-05 13:22:27'),
(4,2,2,1,'tenemos casitas',0,'2026-03-05 13:24:50','2026-03-05 13:24:50');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones_comentarios`
--

LOCK TABLES `trd_oirs_asignaciones_comentarios` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones_comentarios` DISABLE KEYS */;
set autocommit=0;
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
  `ofa_borrado` tinyint(4) DEFAULT NULL,
  `ofa_creacion` datetime DEFAULT NULL,
  `ofa_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ofa_id`),
  KEY `trd_oirs_funcionarios_areas_trd_acceso_usuarios_FK` (`ofa_funcionario`),
  KEY `trd_oirs_funcionarios_areas_trd_general_areas_FK` (`ofa_area`),
  CONSTRAINT `trd_oirs_funcionarios_areas_trd_acceso_usuarios_FK` FOREIGN KEY (`ofa_funcionario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_oirs_funcionarios_areas_trd_general_areas_FK` FOREIGN KEY (`ofa_area`) REFERENCES `trd_general_areas` (`tga_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_funcionarios_areas`
--

LOCK TABLES `trd_oirs_funcionarios_areas` WRITE;
/*!40000 ALTER TABLE `trd_oirs_funcionarios_areas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_funcionarios_areas` VALUES
(1,1,1,0,NULL,NULL,NULL),
(2,2,2,0,NULL,NULL,NULL),
(3,3,1,1,NULL,NULL,NULL),
(4,1,1,0,NULL,NULL,NULL);
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
  `oig_requiere_respuesta_tecnica` tinyint(1) DEFAULT NULL,
  `oig_respuesta_tecnica` text DEFAULT NULL,
  `oig_solicitud_ejecutada` tinyint(1) DEFAULT NULL,
  `oig_fuente_financiamiento` varchar(100) DEFAULT NULL,
  `oig_notificacion_ejecucion` text DEFAULT NULL,
  `oig_realizada_en_plazo` tinyint(1) DEFAULT NULL,
  `oig_aclaratoria_contribuyente` text DEFAULT NULL,
  `oig_respuesta_aclaratoria` text DEFAULT NULL,
  `oig_borrado` tinyint(1) DEFAULT 0,
  `oig_creacion` datetime DEFAULT current_timestamp(),
  `oig_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`oig_id`),
  KEY `fk_gestion_solicitud` (`oig_solicitud`),
  CONSTRAINT `fk_gestion_solicitud` FOREIGN KEY (`oig_solicitud`) REFERENCES `trd_oirs_solicitud` (`oirs_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_gestion`
--

LOCK TABLES `trd_oirs_gestion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_gestion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_gestion` VALUES
(1,1,NULL,'estimado vecino se retirara el próximo mes',1,'Vecino efectivamente podremos llevar a cabo su solicitud ',1,'Recursos Propios','se puede llevar a cabo',1,NULL,'',0,'2026-03-04 14:04:23','2026-03-05 09:19:11'),
(2,2,NULL,'analizaremos el caso vecino',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-05 13:14:00','2026-03-05 13:21:16'),
(3,3,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-06 10:00:42','2026-03-06 10:00:42'),
(4,4,NULL,'',1,'',1,'',NULL,NULL,NULL,NULL,0,'2026-03-06 10:26:49','2026-03-09 10:18:03'),
(5,5,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-06 11:29:09','2026-03-06 11:29:09'),
(6,6,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-06 11:41:57','2026-03-06 11:41:57'),
(7,7,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-06 12:01:57','2026-03-06 12:01:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_solicitud`
--

LOCK TABLES `trd_oirs_solicitud` WRITE;
/*!40000 ALTER TABLE `trd_oirs_solicitud` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_solicitud` VALUES
(1,12,2,'Presencial',2,1,'2026-03-04 14:04:23',2,2,'Viena 423, Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02881771,-71.56746410,NULL,'necesito retirar basura acumulada',0,'2026-03-25',0,'2026-03-04 14:04:23','Viena 423, Viña del Mar, Valparaíso, Chile',1),
(2,17,1,'Presencial',1,1,'2026-03-05 13:14:00',2,2,'alvarez 140',NULL,NULL,-33.02535210,-71.56080630,11,'necesito una casa para un perrito',0,'2026-03-26',0,'2026-03-05 13:14:00','alvarez 140',3),
(3,21,4,'Web',3,1,'2026-03-06 10:00:42',3,4,'Arlegui 947, 2520434 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02450000,-71.54834531,11,'ayuda con corte de árbol',0,'2026-03-27',0,'2026-03-06 10:00:42','Arlegui 947, 2520434 Viña del Mar, Valparaíso, Chile',2),
(4,23,2,'Web',5,1,'2026-03-06 10:26:49',3,4,'Tamarugal 545, Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.03007701,-71.49474405,1,'falta iluminación',0,'2026-03-27',0,'2026-03-06 10:26:49','Tamarugal 545, Viña del Mar, Valparaíso, Chile',2),
(5,26,4,'Web',1,1,'2026-03-06 11:29:09',3,5,'Arlegui 736, 2520450 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02421214,-71.55053400,11,'felicidades por la seguridad del sector',0,'2026-03-27',0,'2026-03-06 11:29:09','Arlegui 736, 2520450 Viña del Mar, Valparaíso, Chile',2),
(6,27,5,'Web',3,1,'2026-03-06 11:41:57',1,1,'1 Nte. 1481, 2560564 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02424813,-71.54081367,11,'Necesito una piscina en ese sector',0,'2026-03-27',0,'2026-03-06 11:41:57','1 Nte. 1481, 2560564 Viña del Mar, Valparaíso, Chile',2),
(7,30,1,'Web',1,1,'2026-03-06 12:01:57',4,6,'Av. Sta. Julia 3, 2551403 Valparaíso, Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.00816273,-71.50064491,14,'NECESITO AYUDA CON POSTULACIÓN A BECA DE ESTUDIOS',0,'2026-03-27',0,'2026-03-06 12:01:57','Av. Sta. Julia 3, 2551403 Valparaíso, Viña del Mar, Valparaíso, Chile',2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_tareas`
--

LOCK TABLES `trd_tareas` WRITE;
/*!40000 ALTER TABLE `trd_tareas` DISABLE KEYS */;
set autocommit=0;
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

-- Dump completed on 2026-03-09 10:52:16
