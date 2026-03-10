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
  `usp_id` int(11) auto_increment NOT NULL,
  `usp_rol_id` int(11)  NOT NULL,
  `usp_usuario_id` int(11) NOT NULL,
  `usp_rol_id` int(11) NOT NULL,
  `usp_fecha_inicio` datetime DEFAULT current_timestamp(),
  `usp_fecha_termino` datetime DEFAULT NULL,
  `usp_usuario_subrogante_id` int(11) DEFAULT NULL,
  `usp_borrado` tinyint(1) DEFAULT 0,
  `usp_creacion` datetime DEFAULT current_timestamp(),
  `usp_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usp_id`),
  CONSTRAINT `1` FOREIGN KEY (`usp_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `2` FOREIGN KEY (`usp_rol_id`) REFERENCES `trd_acceso_roles` (`prf_id`),
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
  `usp_rol_id` int(11) NOT NULL,
  `usp_fecha_inicio` datetime DEFAULT current_timestamp(),
  `usp_fecha_termino` datetime DEFAULT NULL,
  `usp_usuario_subrogante_id` int(11) DEFAULT NULL,
  `usp_borrado` tinyint(1) DEFAULT 0,
  `usp_creacion` datetime DEFAULT current_timestamp(),
  `usp_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usp_usuario_id`,`usp_rol_id`),
  KEY `usp_rol_id` (`usp_rol_id`) USING BTREE,
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
  KEY `trd_general_contribuyente_direcciones_trd_general_contribuyentes_FK` (`tcd_contribuyente`),
  CONSTRAINT `trd_general_contribuyente_direcciones_trd_general_contribuyentes_FK` FOREIGN KEY (`tcd_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyente_direcciones`
--

LOCK TABLES `trd_general_contribuyente_direcciones` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyente_direcciones` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_metadata`
--

LOCK TABLES `trd_documentos_metadata` WRITE;
/*!40000 ALTER TABLE `trd_documentos_metadata` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(1,1,'Ingresa solicitud OIRS',1,'2026-03-09 12:08:18',0,'2026-03-09 12:08:18'),
(2,1,'Ingresa gestión OIRS (Respuesta inmediata)',1,'2026-03-09 12:08:18',0,'2026-03-09 12:08:18');
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
  KEY `trd_general_contribuyentes_trd_general_contribuyente_escolaridad_FK` (`tgc_escolaridad`),
  CONSTRAINT `trd_general_contribuyentes_trd_general_contribuyente_escolaridad_FK` FOREIGN KEY (`tgc_escolaridad`) REFERENCES `trd_general_contribuyente_escolaridad` (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(1,'11111111-1','natural','',NULL,NULL,'','','1','1','1','Otro','1990-02-03','Divorciado/a',3,NULL,'juan.hervas@munivina.cl','+56944444444',0,NULL,0,'2026-02-19 19:44:53','2026-03-09 12:08:18'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(1,'2026-03-09 12:08:18','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 1','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"juan.hervas@munivina.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_rep_nombre_completo\":\"\",\"cont_direccion\":\"\",\"cont_latitud\":\"\",\"cont_longitud\":\"\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-03-09 12:06\",\"oirs_tematica\":\"1\",\"oirs_subtematica\":\"1\",\"oirs_calle\":\"quinta 100\",\"oirs_sector\":\"13\",\"oirs_descripcion\":\"ventiladores\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0237755\",\"oirs_longitud\":\"-71.5539787\",\"oirs_respuesta\":\"se reqiiere aclaacion\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"1\",\"rgt_id\":\"1\"}}','192.168.0.169','Exitoso',0,'2026-03-09 12:08:18');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_mails_enviados`
--

LOCK TABLES `trd_general_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_general_mails_enviados` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_expedientes`
--

LOCK TABLES `trd_general_registro_general_expedientes` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_expedientes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_expedientes` VALUES
(1,'260309-1608-OIRS-AF','oirs',NULL,1,1,0,'2026-03-09 12:08:18','2026-03-09 12:08:18');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones`
--

LOCK TABLES `trd_oirs_asignaciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones` DISABLE KEYS */;
set autocommit=0;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_funcionarios_areas`
--

LOCK TABLES `trd_oirs_funcionarios_areas` WRITE;
/*!40000 ALTER TABLE `trd_oirs_funcionarios_areas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_funcionarios_areas` VALUES
(1,1,1,0,1,NULL,NULL),
(2,2,2,0,NULL,NULL,NULL),
(3,3,1,1,NULL,NULL,NULL),
(4,1,1,0,NULL,NULL,NULL),
(5,4,1,1,1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_gestion`
--

LOCK TABLES `trd_oirs_gestion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_gestion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_gestion` VALUES
(1,1,NULL,'se reqiiere aclaacion',NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-03-09 12:08:18','2026-03-09 12:08:18');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_solicitud`
--

LOCK TABLES `trd_oirs_solicitud` WRITE;
/*!40000 ALTER TABLE `trd_oirs_solicitud` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_solicitud` VALUES
(1,1,1,'Web',1,1,'2026-03-09 12:08:18',1,1,'quinta 100',NULL,NULL,-33.02377550,-71.55397870,13,'ventiladores',1,'2026-03-30',0,'2026-03-09 12:08:18','quinta 100',1);
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

-- Dump completed on 2026-03-09 12:39:30
