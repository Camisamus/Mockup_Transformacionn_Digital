/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: transformacion_digital_beta
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
-- Table structure for table `sup_feriados`
--

DROP TABLE IF EXISTS `sup_feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sup_feriados` (
  `fer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fer_fecha` date NOT NULL,
  `fer_motivo` varchar(100) DEFAULT NULL,
  `fer_tipo` varchar(20) DEFAULT 'Civil',
  PRIMARY KEY (`fer_id`),
  UNIQUE KEY `fer_fecha` (`fer_fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_feriados`
--

LOCK TABLES `sup_feriados` WRITE;
/*!40000 ALTER TABLE `sup_feriados` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sup_feriados` VALUES
(1,'2026-01-01','Año Nuevo','Civil'),
(2,'2026-04-03','Viernes Santo','Civil'),
(3,'2026-04-04','Sábado Santo','Civil'),
(4,'2026-05-01','Día del Trabajo','Civil'),
(5,'2026-05-21','Día de las Glorias Navales','Civil'),
(6,'2026-06-29','San Pedro y San Pablo','Civil'),
(7,'2026-07-16','Día de la Virgen del Carmen','Civil'),
(8,'2026-08-15','Asunción de la Virgen','Civil'),
(9,'2026-09-18','Fiestas Patrias','Civil'),
(10,'2026-09-19','Glorias del Ejército','Civil'),
(11,'2026-10-12','Encuentro de Dos Mundos','Civil'),
(12,'2026-10-31','Día de las Iglesias Evangélicas','Civil'),
(13,'2026-11-01','Día de Todos los Santos','Civil'),
(14,'2026-12-08','Inmaculada Concepción','Civil'),
(15,'2026-12-25','Navidad','Civil');
/*!40000 ALTER TABLE `sup_feriados` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_perfiles`
--

DROP TABLE IF EXISTS `trd_acceso_perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_perfiles` (
  `prf_id` int(11) NOT NULL AUTO_INCREMENT,
  `prf_nombre` varchar(100) NOT NULL,
  `prf_borrado` tinyint(1) DEFAULT 0,
  `prf_creacion` datetime DEFAULT current_timestamp(),
  `prf_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_perfiles`
--

LOCK TABLES `trd_acceso_perfiles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_perfiles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_perfiles` VALUES
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
(15,'operador oirs',0,'2026-02-12 15:57:51','2026-02-12 15:57:51');
/*!40000 ALTER TABLE `trd_acceso_perfiles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_perfiles_roles`
--

DROP TABLE IF EXISTS `trd_acceso_perfiles_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_perfiles_roles` (
  `pfr_perfil_id` int(11) DEFAULT NULL,
  `pfr_rol_id` varchar(20) DEFAULT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `trd_acceso_perfiles_roles_trd_acceso_roles_FK` (`pfr_rol_id`),
  KEY `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` (`pfr_perfil_id`),
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_perfiles_FK` FOREIGN KEY (`pfr_perfil_id`) REFERENCES `trd_acceso_perfiles` (`prf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trd_acceso_perfiles_roles_trd_acceso_roles_FK` FOREIGN KEY (`pfr_rol_id`) REFERENCES `trd_acceso_roles` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_perfiles_roles`
--

LOCK TABLES `trd_acceso_perfiles_roles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_perfiles_roles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_perfiles_roles` VALUES
(1,'1',0,'2026-02-02 08:34:53','2026-02-02 08:34:53'),
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
(9,'4.3',0,'2026-02-02 15:42:38','2026-02-02 15:42:38'),
(9,'4.6',0,'2026-02-02 15:42:38','2026-02-02 15:42:38'),
(9,'4',0,'2026-02-02 15:52:03','2026-02-02 15:52:03'),
(2,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(7,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(8,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(9,'A.0',0,'2026-02-06 13:45:20','2026-02-06 13:45:20'),
(3,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(4,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(5,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(6,'A.0',0,'2026-02-06 13:45:29','2026-02-06 13:45:29'),
(10,'10',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(10,'10.1',0,'2026-02-10 16:35:45','2026-02-10 16:35:45'),
(10,'10.2',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.3',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.4',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.5',0,'2026-02-10 16:35:46','2026-02-10 16:35:46'),
(10,'10.6',0,'2026-02-10 16:35:47','2026-02-10 16:35:47'),
(10,'10',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(10,'10.7',0,'2026-02-11 09:42:39','2026-02-11 09:42:39'),
(10,'A.0',0,'2026-02-11 11:40:33','2026-02-11 11:40:33'),
(11,'8',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.1',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.2',0,'2026-02-12 15:51:34','2026-02-12 15:51:34'),
(11,'8.7',0,'2026-02-12 15:51:35','2026-02-12 15:51:35'),
(9,'4',0,'2026-02-12 15:53:08','2026-02-12 15:53:08'),
(9,'4.1',0,'2026-02-12 15:53:08','2026-02-12 15:53:08'),
(9,'4.2',0,'2026-02-12 15:53:08','2026-02-12 15:53:08'),
(9,'4.3',0,'2026-02-12 15:53:09','2026-02-12 15:53:09'),
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
(1,'1',0,'2026-02-16 15:04:24','2026-02-16 15:04:24'),
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
(1,'1.2.2.5',0,'2026-02-16 15:14:51','2026-02-16 15:14:51');
/*!40000 ALTER TABLE `trd_acceso_perfiles_roles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_roles`
--

DROP TABLE IF EXISTS `trd_acceso_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_roles` (
  `rol_id` varchar(20) NOT NULL,
  `rol_nombre` varchar(255) NOT NULL,
  `rol_enlace` varchar(255) DEFAULT NULL,
  `rol_tipo` varchar(50) DEFAULT NULL,
  `rol_simbolo` varchar(100) DEFAULT 'dashboard',
  `rol_borrado` tinyint(1) DEFAULT 0,
  `rol_creacion` datetime DEFAULT current_timestamp(),
  `rol_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_roles`
--

LOCK TABLES `trd_acceso_roles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_roles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_roles` VALUES
('1','Administracion sistema',NULL,'categoria','settings',0,'2025-12-29 12:53:09','2026-02-11 15:28:33'),
('1.1','Logs del Sistema',NULL,'subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('1.1.1','Consulta de Log','funcionarios/sisadmin/logs/logs_consulta_log.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-16 14:30:02'),
('1.1.2','Listado de Logs','funcionarios/sisadmin/logs/logs_listado_logs.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-16 14:30:02'),
('1.1.3','Acceso','','subcategoria','menu',1,'2026-01-30 11:29:05','2026-02-11 15:16:37'),
('1.2','Mantenedores',NULL,'subcategoria','menu',0,'2026-01-14 09:33:54','2026-02-11 15:16:37'),
('1.2.1','General',NULL,'subcategoria','menu',0,'2026-01-14 09:33:54','2026-02-11 15:16:37'),
('1.2.1.1','Contribuyentes','funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_contribuyentes.html','Pagina','menu',0,'2026-01-14 09:33:54','2026-02-16 14:30:02'),
('1.2.1.2','Organizaciones Comunitarias','funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_org_comunitarias.html','Pagina','menu',0,'2026-01-26 10:30:51','2026-02-16 14:30:02'),
('1.2.2','DESVE','','subcategoria','menu',0,'2026-01-26 10:28:30','2026-02-11 15:16:37'),
('1.2.2.1','Oigenes especiales','funcionarios/sisadmin/mantenedores/desve/sisadmin_mantenedor_desve_oigenesespeciales.html','Pagina','menu',0,'2026-01-26 10:30:51','2026-02-16 14:30:02'),
('1.2.2.5','General - Escolaridad','Funcionarios/sisadmin/mantenedores/general/sisadmin_mantenedor_general_escolaridad.php','Pagina','book',0,'2026-02-16 15:13:53','2026-02-16 15:13:53'),
('1.2.3','Acceso','','subcategoria','menu',0,'2026-01-30 11:30:27','2026-02-11 15:16:37'),
('1.2.3.1','Usuaios','funcionarios/sisadmin/mantenedores/acceso/sisadmin_mantenedor_acceso_usuarios.html','Pagina','menu',0,'2026-01-30 11:33:12','2026-02-16 14:30:02'),
('1.2.3.2','Usuarios por Perfil','funcionarios/sisadmin/mantenedores/acceso/sisadmin_mantenedor_acceso_usuarios_perfiles.html','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-16 14:30:02'),
('1.2.3.3','Perfiles','funcionarios/sisadmin/mantenedores/acceso/sisadmin_mantenedor_acceso_perfiles.html','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-16 14:30:02'),
('1.2.3.4','Perfiles por Rol','funcionarios/sisadmin/mantenedores/acceso/sisadmin_mantenedor_acceso_perfiles_roles.html','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-16 14:30:02'),
('1.2.3.5','Roles','funcionarios/sisadmin/mantenedores/acceso/sisadmin_mantenedor_acceso_roles.html','Pagina','menu',0,'2026-01-30 13:22:26','2026-02-16 14:30:02'),
('1.2.4','OIRS',NULL,'subcategoria','menu',0,'2026-02-16 13:59:53','2026-02-16 13:59:53'),
('1.2.4.1','OIRS - Temáticas','Funcionarios/sisadmin/mantenedores/oirs/oirs_tematicas.php','Pagina','list',0,'2026-02-16 15:03:29','2026-02-16 15:03:29'),
('1.2.4.2','OIRS - Subtemáticas','Funcionarios/sisadmin/mantenedores/oirs/oirs_subtematicas.php','Pagina','layers',0,'2026-02-16 15:03:29','2026-02-16 15:03:29'),
('1.2.4.3','OIRS - Tipos de Atención','Funcionarios/sisadmin/mantenedores/oirs/oirs_tipo_atencion.php','Pagina','user-check',0,'2026-02-16 15:03:29','2026-02-16 15:03:29'),
('1.2.4.4','OIRS - Condiciones Especiales','Funcionarios/sisadmin/mantenedores/oirs/oirs_condiciones.php','Pagina','award',0,'2026-02-16 15:03:29','2026-02-16 15:03:29'),
('10','OIRS',NULL,'categoria','command',0,'2026-02-10 16:23:11','2026-02-11 15:22:19'),
('10.1','Bandeja OIRS','funcionarios/oirs/oirs_bandeja.php','Pagina','list',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.2','Ingresar OIRS','funcionarios/oirs/oirs_ingresar.php','Pagina','plus',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.3','Listar OIRS','funcionarios/oirs/oirs_listar.php','Pagina','map',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.4','Consulta OIRS','funcionarios/oirs/oirs_consulta.php','Pagina','search',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.5','Solicitudes por Revisar','funcionarios/oirs/oirs_revisar.php','Pagina','message-square',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.6','Visación de Solicitudes','funcionarios/oirs/oirs_visacion.php','Pagina','edit',0,'2026-02-10 16:23:11','2026-02-12 14:56:08'),
('10.7','Historial de Solicitudes','Funcionarios/oirs/oirs_historial.php','Pagina','archive',0,'2026-02-11 09:42:08','2026-02-12 14:56:08'),
('11','Patentes',NULL,'categoria','command',0,'2025-12-29 12:53:09','2026-02-11 15:22:19'),
('11.1','Mis Solicitudes','funcionarios/NO_Asignadas/patentes_mis_solicitudes.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('11.2','Pagos','funcionarios/NO_Asignadas/pagos.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('11.3','Solicitud Única de Patentes','funcionarios/NO_Asignadas/patentes_solicitud_unica.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('11.4','Consulta de Solicitud','funcionarios/NO_Asignadas/patentes_consulta_solicitud.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('11.c','Gestión de Empresas','funcionarios/NO_Asignadas/contribuyente_empresas.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('2','Organizaciones Comunitarias',NULL,'categoria','command',0,'2025-12-29 12:53:09','2026-02-11 15:22:19'),
('2.1','Organizaciones',NULL,'subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('2.1.1','Consulta Organizacion','Funcionarios/NO_Asignadas/organizaciones_consulta_organizacion.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('2.1.2','Consulta Masiva Organizaciones','Funcionarios/NO_Asignadas/organizaciones_consulta_masiva.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('3','Subvenciones',NULL,'categoria','command',0,'2025-12-29 12:53:09','2026-02-11 15:22:19'),
('3.1','Subvenciones',NULL,'subcategoria','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('3.1.1','Consulta de Subvención','Funcionarios/NO_Asignadas/subvenciones_consulta_subvencion.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('3.1.2','Consulta Masiva de Subvenciones','Funcionarios/NO_Asignadas/subvenciones_consulta_masiva.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('3.1.7','Consulta Masiva de Pagos','Funcionarios/NO_Asignadas/subvenciones_consulta_masiva_pagos.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('3.2','Postulaciones',NULL,NULL,'menu',0,'2026-01-30 13:37:13','2026-02-11 15:16:37'),
('3.2.1','Consulta de Postulación','Funcionarios/NO_Asignadas/postulaciones_consulta_postulacion.html',NULL,'menu',0,'2026-01-30 13:37:13','2026-02-11 15:16:37'),
('3.2.2','Consulta Masiva de Postulaciones','Funcionarios/NO_Asignadas/postulaciones_consulta_masiva.html',NULL,'menu',0,'2026-01-30 13:37:13','2026-02-11 15:16:37'),
('4','DESVE',NULL,'categoria','command',0,'2026-01-30 13:45:50','2026-02-11 15:22:19'),
('4.1','Nuevo Ingreso ','funcionarios/desve/desve_nuevo.html','Pagina','plus',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('4.2','Listado ','funcionarios/desve/desve_listado_ingresos.html','Pagina','list',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('4.3','Historial ','funcionarios/desve/desve_historial.html','Pagina','archive',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('4.4','Edicion ','funcionarios/desve/desve_modificar.html','Pagina','edit',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('4.5','Responder ','funcionarios/desve/desve_responder.html','Pagina','message-square',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('4.6','Consulta ','funcionarios/desve/desve_consultar.html','Pagina','search',0,'2026-01-30 13:45:50','2026-02-12 14:56:08'),
('5','Atenciones',NULL,'categoria','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('5.1','Lista de espera','Funcionarios/NO_Asignadas/atenciones_lista_espera.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('5.2','Historial','Funcionarios/NO_Asignadas/atenciones_listado_atenciones.html','Pagina','archive',0,'2025-12-29 12:53:09','2026-02-11 15:33:00'),
('5.3','Nueva','Funcionarios/NO_Asignadas/atenciones_nueva_atencion.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('5.4','Tomar Atención','Funcionarios/NO_Asignadas/atenciones_tomar_atencion.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('5.5','Consultar','Funcionarios/NO_Asignadas/atenciones_consulta_atencion.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-11 15:16:37'),
('8','Ingresos',NULL,'categoria','command',0,'2026-01-19 10:44:56','2026-02-11 15:22:19'),
('8.0','Dashboard','NOEXSTEAUN.php','Pagina','dashboard',0,'2026-02-13 12:02:06','2026-02-13 12:02:06'),
('8.1','Bandeja de entrada','funcionarios/ingresos/ingr_bandeja.html','Pagina','list',0,'2026-01-19 10:54:34','2026-02-13 12:04:18'),
('8.2','Nuevo Ingreso','funcionarios/ingresos/ingr_crear.html','Pagina','plus',0,'2026-01-19 10:54:34','2026-02-13 12:04:18'),
('8.3','Ver Ingreso','funcionarios/ingresos/ingr_consultar.html','Pagina','menu',0,'2026-01-19 10:54:34','2026-02-13 12:04:18'),
('8.4','Moificar ','funcionarios/ingresos/ingr_modificar.html','Pagina','edit',0,'2026-01-19 10:54:34','2026-02-12 14:56:08'),
('8.5','Respoder','funcionarios/ingresos/ingr_responder.html','Pagina','message-square',0,'2026-01-19 10:54:34','2026-02-12 14:56:08'),
('8.6','Fraccionar','funcionarios/ingresos/ingr_preparar.html','Pagina','menu',0,'2026-01-19 10:54:34','2026-02-13 12:04:18'),
('8.7','Historial de Ingresos','funcionarios/ingresos/ingr_historial.html','Pagina','archive',0,'2026-01-26 07:52:09','2026-02-13 12:04:18'),
('A.0','Bandeja','funcionarios/bandeja.html','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-12 14:56:08'),
('A.1','Bandeja Historial','funcionarios/bandeja_historial.php','Pagina','clock',0,'2026-02-11 16:34:04','2026-02-12 14:56:08');
/*!40000 ALTER TABLE `trd_acceso_roles` ENABLE KEYS */;
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
(1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',1,0,'2025-12-29 12:53:09','2026-01-07 13:43:55'),
(2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',1,0,'2026-01-06 11:47:58','2026-01-06 11:48:23'),
(3,'Ramon','Evil Guy','14037230-7','ramon.martinez@munivina.cl',1,0,'2026-01-09 10:13:01','2026-01-09 10:13:01'),
(4,'usuario ingresos','admin','11111111-1','ingresos.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-12 15:11:52'),
(6,'usuario ingresos','operador','11111111-2','ingresos.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(7,'usuario ingresos','funcionaio','11111111-3','ingresos.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(8,'usuario ingresos','exteno','11111111-4','ingresos.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-12 15:11:33'),
(9,'usuario desve','admin','11111112-1','desve.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-12 15:11:52'),
(10,'usuario desve','operador','11111112-2','desve.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(11,'usuario desve','funcionaio','11111112-3','desve.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(12,'usuario desve','exteno','11111112-4','desve.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-12 15:11:33'),
(13,'usuario oirs','admin','11111113-1','oirs.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-12 15:11:52'),
(14,'usuario desve','operador','11111113-2','oirs.operador@test.cl',4,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(15,'usuario oirs','funcionaio','11111113-3','oirs.funcionario@test.cl',2,0,'2026-02-12 15:11:33','2026-02-12 15:11:52'),
(16,'usuario oirs','exteno','11111113-4','oirs.externo@test.cl',1,0,'2026-02-12 15:11:33','2026-02-12 15:11:33');
/*!40000 ALTER TABLE `trd_acceso_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_acceso_usuarios_perfiles`
--

DROP TABLE IF EXISTS `trd_acceso_usuarios_perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_acceso_usuarios_perfiles` (
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
  CONSTRAINT `2` FOREIGN KEY (`usp_perfil_id`) REFERENCES `trd_acceso_perfiles` (`prf_id`),
  CONSTRAINT `3` FOREIGN KEY (`usp_usuario_subrogante_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_usuarios_perfiles`
--

LOCK TABLES `trd_acceso_usuarios_perfiles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_usuarios_perfiles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES
(1,1,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2026-01-30 15:48:51'),
(1,4,NULL,NULL,NULL,0,'2026-01-30 13:48:40','2026-01-30 13:48:40'),
(1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24'),
(1,10,NULL,NULL,NULL,0,'2026-02-10 16:36:13','2026-02-10 16:36:13'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(3,8,'2026-02-05 13:39:00','2027-06-12 13:39:00',NULL,0,'2026-02-06 13:39:31','2026-02-06 13:52:29'),
(4,11,NULL,NULL,NULL,0,'2026-02-12 16:00:50','2026-02-12 16:00:50'),
(6,13,NULL,NULL,NULL,0,'2026-02-12 16:01:44','2026-02-12 16:01:44'),
(9,9,NULL,NULL,NULL,0,'2026-02-12 16:00:29','2026-02-12 16:00:29'),
(10,14,NULL,NULL,NULL,0,'2026-02-12 16:01:31','2026-02-12 16:01:31'),
(13,12,NULL,NULL,NULL,0,'2026-02-12 16:01:06','2026-02-12 16:01:06'),
(15,15,NULL,NULL,NULL,0,'2026-02-12 16:02:10','2026-02-12 16:02:10');
/*!40000 ALTER TABLE `trd_acceso_usuarios_perfiles` ENABLE KEYS */;
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
  `tcd_dir_creacion` datetime DEFAULT current_timestamp(),
  `tcd_dir_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tcd_id`),
  KEY `trd_cont_direcciones_trd_general_contribuyentes_FK` (`tcd_contribuyente`),
  CONSTRAINT `trd_cont_direcciones_trd_general_contribuyentes_FK` FOREIGN KEY (`tcd_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_cont_direcciones`
--

LOCK TABLES `trd_cont_direcciones` WRITE;
/*!40000 ALTER TABLE `trd_cont_direcciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_cont_direcciones` VALUES
(1,1,'Particular','las verbenas','55','4','5','condominio las peras',NULL,NULL,'2026-02-16 15:53:36','2026-02-16 15:53:36'),
(2,1,'OIRS','las verbenas 55 Casa 5 Depto 4 (condominio las peras)',NULL,NULL,NULL,NULL,-33.04079080,-71.53548640,'2026-02-17 09:52:14','2026-02-17 09:52:14');
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
(1,'Sin instrucción'),
(2,'Básica Incompleta'),
(3,'Básica Completa'),
(4,'Media Incompleta'),
(5,'Media Completa (Científico-Humanista)'),
(6,'Media Completa (Técnico-Profesional)'),
(7,'Superior Técnica Incompleta'),
(8,'Superior Técnica Completa'),
(9,'Superior Profesional Incompleta'),
(10,'Superior Profesional Completa'),
(11,'Postgrado (Magíster/Doctorado)');
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
  PRIMARY KEY (`tid_id`),
  KEY `ingresos_destinos` (`tid_desve_solicitud`) USING BTREE,
  KEY `trd_ingresos_destinos_trd_acceso_usuarios_FK` (`tid_destino`) USING BTREE,
  CONSTRAINT `trd_desve_destinos_trd_acceso_usuarios_FK` FOREIGN KEY (`tid_destino`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_desve_destinos_trd_desve_solicitudes_FK` FOREIGN KEY (`tid_desve_solicitud`) REFERENCES `trd_desve_solicitudes` (`sol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_destinos`
--

LOCK TABLES `trd_desve_destinos` WRITE;
/*!40000 ALTER TABLE `trd_desve_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_destinos` VALUES
(3,1,1,NULL,NULL),
(4,1,12,NULL,NULL),
(6,2,12,NULL,NULL);
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
(1,'Antonella Pecchenino Lobos',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(2,'Nancy Díaz Soto',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(3,'Carlos Williams Arriola',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(4,'Sandro Puebla Veas',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(5,'Nicolás López Pimentel',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(6,'Alejandro Aguilera Moya',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(7,'José Bartolucci Schapacasse',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(8,'Antonia Scarella Chamy',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(9,'Andrés Solar Miranda',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(10,'Francisco Mejías Díaz',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(11,'Ley De Tansparencia',5,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(12,'Contraloria General',6,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(13,'Congreso Nacional',7,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(21,'CALAFATe',3,NULL,NULL,NULL,1,'2026-01-22 13:13:45','2026-01-22 13:14:04'),
(22,'pruebaingresoorigenespecial',4,NULL,NULL,NULL,0,'2026-01-28 14:44:48','2026-01-28 14:44:48'),
(23,'Juan Perez',4,NULL,NULL,NULL,0,'2026-02-03 10:28:36','2026-02-03 10:28:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_respuestas` VALUES
(1,1,'asdasd','2026-02-13 15:42:00',0,'2026-02-13 15:42:00','2026-02-13 15:42:00','Respuesta Final',1),
(2,2,'acuso recibo','2026-02-16 09:55:36',0,'2026-02-16 09:55:36','2026-02-16 09:55:36','Respuesta Final',12),
(3,2,'123456','2026-02-16 09:56:27',0,'2026-02-16 09:56:27','2026-02-16 09:56:27','Respuesta Final',12);
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
  CONSTRAINT `6` FOREIGN KEY (`sol_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(1,'php01','prueba  perfiles 001',1,NULL,'contenido desve','2026-02-13 00:00:00',1,NULL,12,'2026-02-17 00:00:00',0,NULL,1,NULL,'no c',NULL,NULL,NULL,NULL,NULL,0,'2026-02-13 13:49:37','2026-02-13 15:44:48',10,18,2),
(2,'','PRUEBA DESVE 001',1,NULL,'HOLA LETI','2026-02-16 00:00:00',1,NULL,14,'2026-02-18 00:00:00',0,NULL,1,NULL,'',NULL,NULL,NULL,NULL,NULL,0,'2026-02-16 09:53:15','2026-02-16 10:20:01',1,19,1);
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
  `tdc_fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `tdc_registro_tramite` int(11) DEFAULT NULL,
  `tdc_fecha_limite` date NOT NULL,
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
  PRIMARY KEY (`tdm_id_meta`),
  KEY `trd_documentos_metadata_versiones_FK` (`tdm_documento`),
  CONSTRAINT `trd_documentos_metadata_versiones_FK` FOREIGN KEY (`tdm_documento`) REFERENCES `trd_general_documento_adjunto_versiones` (`docv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_metadata`
--

LOCK TABLES `trd_documentos_metadata` WRITE;
/*!40000 ALTER TABLE `trd_documentos_metadata` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_documentos_metadata` VALUES
(1,1,'Tamaño','118801'),
(2,1,'Tipo MIME','application/pdf'),
(3,1,'Extensión','pdf'),
(4,1,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b'),
(5,1,'Sistema Origen','GesDoc'),
(6,1,'Fecha Subida','2026-02-06 16:47:02'),
(7,1,'Usuario','1'),
(8,2,'Tamaño','118801'),
(9,2,'Tipo MIME','application/pdf'),
(10,2,'Extensión','pdf'),
(11,2,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b'),
(12,2,'Sistema Origen','GesDoc'),
(13,2,'Fecha Subida','2026-02-06 17:00:46'),
(14,2,'Usuario','1'),
(15,3,'Tamaño','145329'),
(16,3,'Tipo MIME','application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
(17,3,'Extensión','docx'),
(18,3,'Hash SHA256','e8646b2dbbcf0ab4f6c99b23bee910339d7b93ad3082ba6b4082df3b617f8297'),
(19,3,'Sistema Origen','GesDoc'),
(20,3,'Fecha Subida','2026-02-06 17:05:20'),
(21,3,'Usuario','1'),
(22,4,'Tamaño','145329'),
(23,4,'Tipo MIME','application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
(24,4,'Extensión','docx'),
(25,4,'Hash SHA256','e8646b2dbbcf0ab4f6c99b23bee910339d7b93ad3082ba6b4082df3b617f8297'),
(26,4,'Sistema Origen','GesDoc'),
(27,4,'Fecha Subida','2026-02-06 17:06:43'),
(28,4,'Usuario','1'),
(29,5,'Tamaño','118801'),
(30,5,'Tipo MIME','application/pdf'),
(31,5,'Extensión','pdf'),
(32,5,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b'),
(33,5,'Sistema Origen','GesDoc'),
(34,5,'Fecha Subida','2026-02-06 17:11:17'),
(35,5,'Usuario','1'),
(36,6,'Tamaño','118801'),
(37,6,'Tipo MIME','application/pdf'),
(38,6,'Extensión','pdf'),
(39,6,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b'),
(40,6,'Sistema Origen','GesDoc'),
(41,6,'Fecha Subida','2026-02-06 17:12:52'),
(42,6,'Usuario','1'),
(43,7,'Tamaño','706583'),
(44,7,'Tipo MIME','application/pdf'),
(45,7,'Extensión','pdf'),
(46,7,'Hash SHA256','bf405cfbcd6963fe497f426c19d81bb471f9663931c68777711f7debf8f2e245'),
(47,7,'Sistema Origen','GesDoc'),
(48,7,'Fecha Subida','2026-02-06 17:58:38'),
(49,7,'Usuario','3'),
(50,8,'Tamaño','118801'),
(51,8,'Tipo MIME','application/pdf'),
(52,8,'Extensión','pdf'),
(53,8,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b'),
(54,8,'Sistema Origen','GesDoc'),
(55,8,'Fecha Subida','2026-02-06 18:00:47'),
(56,8,'Usuario','1'),
(57,9,'Tamaño','220367'),
(58,9,'Tipo MIME','application/pdf'),
(59,9,'Extensión','pdf'),
(60,9,'Hash SHA256','38e46ea9ef04ab1bdd5e5b21ab8d007fa35508a4e6ced256addc4e9b006d854b'),
(61,9,'Sistema Origen','GesDoc'),
(62,9,'Fecha Subida','2026-02-10 21:03:40'),
(63,9,'Usuario','3'),
(64,10,'Tamaño','242586'),
(65,10,'Tipo MIME','application/pdf'),
(66,10,'Extensión','pdf'),
(67,10,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05'),
(68,10,'Sistema Origen','GesDoc'),
(69,10,'Fecha Subida','2026-02-13 15:31:59'),
(70,10,'Usuario','3'),
(71,11,'Tamaño','242586'),
(72,11,'Tipo MIME','application/pdf'),
(73,11,'Extensión','pdf'),
(74,11,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05'),
(75,11,'Sistema Origen','GesDoc'),
(76,11,'Fecha Subida','2026-02-13 17:49:37'),
(77,11,'Usuario','10'),
(78,12,'Tamaño','638796'),
(79,12,'Tipo MIME','application/pdf'),
(80,12,'Extensión','pdf'),
(81,12,'Hash SHA256','3c61ac37dffc994cfec493718bf0def0874beec274a74c5605e8de7ce8be276d'),
(82,12,'Sistema Origen','GesDoc'),
(83,12,'Fecha Subida','2026-02-16 13:55:36'),
(84,12,'Usuario','12'),
(85,13,'Tamaño','242586'),
(86,13,'Tipo MIME','application/pdf'),
(87,13,'Extensión','pdf'),
(88,13,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05'),
(89,13,'Sistema Origen','GesDoc'),
(90,13,'Fecha Subida','2026-02-17 13:52:14'),
(91,13,'Usuario','1');
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
  PRIMARY KEY (`tga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_areas`
--

LOCK TABLES `trd_general_areas` WRITE;
/*!40000 ALTER TABLE `trd_general_areas` DISABLE KEYS */;
set autocommit=0;
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
  PRIMARY KEY (`tau_id`),
  KEY `trd_general_areas_usuarios_trd_acceso_usuarios_FK` (`tau_usuario_id`) USING BTREE,
  KEY `trd_general_areas_usuarios_trd_general_areas_FK` (`tau_area_id`) USING BTREE,
  CONSTRAINT `trd_general_areas_usuarios_trd_acceso_usuarios_FK` FOREIGN KEY (`tau_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_areas_usuarios_trd_general_areas_FK` FOREIGN KEY (`tau_area_id`) REFERENCES `trd_general_areas` (`tga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_areas_usuarios`
--

LOCK TABLES `trd_general_areas_usuarios` WRITE;
/*!40000 ALTER TABLE `trd_general_areas_usuarios` DISABLE KEYS */;
set autocommit=0;
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
  `bit-responsable` int(11) NOT NULL,
  `bit_fecha` datetime NOT NULL,
  PRIMARY KEY (`bit_id`),
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`bit_tramite_registrado`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`bit-responsable`),
  CONSTRAINT `trd_general_bitacora_trd_acceso_usuarios_FK` FOREIGN KEY (`bit-responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_bitacora_trd_general_registro_general_tramites_FK` FOREIGN KEY (`bit_tramite_registrado`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=756 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(602,4,'Ingresa solicitud Ingresos',1,'2026-02-06 11:58:46'),
(603,4,'Añade comentario al trámite',1,'2026-02-06 12:14:48'),
(604,4,'Edita: contenido',1,'2026-02-06 12:18:23'),
(605,4,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-06 13:05:20'),
(606,5,'Ingresa solicitud Ingresos',1,'2026-02-06 13:06:42'),
(607,5,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-02-06 13:11:18'),
(608,6,'Ingresa solicitud Ingresos',1,'2026-02-06 13:12:19'),
(609,6,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-06 13:12:52'),
(610,7,'Ingresa solicitud Ingresos',1,'2026-02-06 13:13:41'),
(611,8,'Ingresa solicitud Ingresos',1,'2026-02-06 13:21:12'),
(612,9,'Ingresa solicitud Ingresos',3,'2026-02-06 13:58:38'),
(613,10,'Ingresa solicitud Ingresos',1,'2026-02-06 14:19:15'),
(614,10,'Solicitud finalizada con estado: Resuelto_Favorable',3,'2026-02-06 15:11:30'),
(616,11,'Ingresa solicitud Ingresos',3,'2026-02-10 17:03:39'),
(617,12,'Ingresa solicitud Ingresos',4,'2026-02-12 16:29:57'),
(618,12,'Añade comentario al trámite',6,'2026-02-12 16:42:48'),
(619,13,'Ingresa solicitud Ingresos',6,'2026-02-12 16:53:46'),
(620,13,'Añade comentario al trámite',8,'2026-02-12 17:25:21'),
(621,12,'Solicitud finalizada con estado: Resuelto_NO_Favorable',6,'2026-02-13 09:55:48'),
(622,13,'Solicitud finalizada con estado: Resuelto_NO_Favorable',8,'2026-02-13 09:57:55'),
(623,14,'Ingresa solicitud Ingresos',6,'2026-02-13 10:58:35'),
(624,14,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-02-13 11:01:40'),
(625,7,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-13 11:06:36'),
(626,15,'Ingresa solicitud Ingresos',3,'2026-02-13 11:31:59'),
(627,16,'Ingresa solicitud Ingresos',6,'2026-02-13 12:08:22'),
(628,18,'Ingresa solicitud: prueba  perfiles 001',10,'2026-02-13 13:49:37'),
(629,18,'Consulta solicitud',10,'2026-02-13 13:49:51'),
(630,18,'Consulta solicitud',10,'2026-02-13 13:50:03'),
(631,18,'Consulta solicitud',10,'2026-02-13 13:50:33'),
(632,18,'Consulta solicitud',1,'2026-02-13 13:51:34'),
(633,18,'Consulta solicitud',10,'2026-02-13 14:11:28'),
(634,18,'Consulta solicitud',10,'2026-02-13 14:12:09'),
(635,18,'Consulta solicitud',10,'2026-02-13 14:13:25'),
(636,18,'Consulta solicitud',10,'2026-02-13 14:20:22'),
(637,18,'Consulta solicitud',10,'2026-02-13 14:20:47'),
(638,18,'Consulta solicitud',10,'2026-02-13 14:20:55'),
(639,18,'Consulta solicitud',10,'2026-02-13 14:21:02'),
(640,18,'Consulta solicitud',10,'2026-02-13 14:22:01'),
(641,18,'Consulta solicitud',10,'2026-02-13 14:25:37'),
(642,18,'Consulta solicitud',10,'2026-02-13 14:26:53'),
(643,18,'Consulta solicitud',10,'2026-02-13 14:27:14'),
(644,18,'Consulta solicitud',10,'2026-02-13 14:27:55'),
(645,18,'Consulta solicitud',10,'2026-02-13 14:29:01'),
(646,18,'Consulta solicitud',10,'2026-02-13 14:29:18'),
(647,18,'Consulta solicitud',10,'2026-02-13 14:31:57'),
(648,18,'Consulta solicitud',10,'2026-02-13 14:34:02'),
(649,18,'Añade comentario al trámite',10,'2026-02-13 14:36:53'),
(650,18,'Consulta solicitud',10,'2026-02-13 14:36:54'),
(651,18,'Consulta solicitud',10,'2026-02-13 15:04:58'),
(652,18,'Consulta solicitud',10,'2026-02-13 15:07:27'),
(653,18,'Consulta solicitud',10,'2026-02-13 15:14:34'),
(654,18,'Consulta solicitud',10,'2026-02-13 15:14:59'),
(655,18,'Consulta solicitud',10,'2026-02-13 15:16:06'),
(656,18,'Consulta solicitud',10,'2026-02-13 15:18:40'),
(657,18,'Consulta solicitud',10,'2026-02-13 15:19:09'),
(658,18,'Consulta solicitud',10,'2026-02-13 15:22:53'),
(659,18,'Consulta solicitud',1,'2026-02-13 15:23:10'),
(660,18,'Consulta solicitud',1,'2026-02-13 15:23:15'),
(661,18,'Consulta solicitud',1,'2026-02-13 15:23:28'),
(662,18,'Consulta solicitud',1,'2026-02-13 15:24:23'),
(663,18,'Consulta solicitud',1,'2026-02-13 15:25:29'),
(664,18,'Consulta solicitud',1,'2026-02-13 15:28:31'),
(665,18,'Añade comentario al trámite',1,'2026-02-13 15:28:36'),
(666,18,'Consulta solicitud',1,'2026-02-13 15:28:39'),
(667,18,'Consulta solicitud',1,'2026-02-13 15:28:48'),
(668,18,'Añade comentario al trámite',1,'2026-02-13 15:28:52'),
(669,18,'Consulta solicitud',1,'2026-02-13 15:28:53'),
(670,18,'Consulta solicitud',10,'2026-02-13 15:30:15'),
(671,18,'Consulta solicitud',10,'2026-02-13 15:30:24'),
(672,18,'Consulta solicitud',1,'2026-02-13 15:30:39'),
(673,18,'Consulta solicitud',1,'2026-02-13 15:30:47'),
(674,18,'Consulta solicitud',10,'2026-02-13 15:30:54'),
(675,18,'Consulta solicitud',10,'2026-02-13 15:33:07'),
(676,18,'Consulta solicitud',1,'2026-02-13 15:33:18'),
(677,18,'Consulta solicitud',1,'2026-02-13 15:34:30'),
(678,18,'Consulta solicitud',10,'2026-02-13 15:34:41'),
(679,18,'Consulta solicitud',1,'2026-02-13 15:35:23'),
(680,18,'Consulta solicitud',1,'2026-02-13 15:37:16'),
(681,18,'Consulta solicitud',1,'2026-02-13 15:37:25'),
(682,18,'Consulta solicitud',1,'2026-02-13 15:37:35'),
(683,18,'Consulta solicitud',10,'2026-02-13 15:37:43'),
(684,18,'Consulta solicitud',1,'2026-02-13 15:39:17'),
(685,18,'Consulta solicitud',10,'2026-02-13 15:39:41'),
(686,18,'Consulta solicitud',10,'2026-02-13 15:39:44'),
(687,18,'Consulta solicitud',10,'2026-02-13 15:40:21'),
(688,18,'Consulta solicitud',1,'2026-02-13 15:40:29'),
(689,18,'Consulta solicitud',10,'2026-02-13 15:41:05'),
(690,18,'Consulta solicitud',10,'2026-02-13 15:41:32'),
(691,18,'Consulta solicitud',1,'2026-02-13 15:41:41'),
(692,18,'Consulta solicitud',1,'2026-02-13 15:41:43'),
(693,18,'Consulta solicitud',1,'2026-02-13 15:41:49'),
(694,18,'Consulta solicitud',1,'2026-02-13 15:41:51'),
(695,18,'Responde solicitud',1,'2026-02-13 15:42:00'),
(696,18,'Consulta solicitud',10,'2026-02-13 15:42:12'),
(697,18,'Consulta solicitud',10,'2026-02-13 15:42:19'),
(698,18,'Consulta solicitud',10,'2026-02-13 15:42:23'),
(699,18,'Consulta solicitud',10,'2026-02-13 15:42:48'),
(700,18,'Consulta solicitud',10,'2026-02-13 15:44:48'),
(701,18,'Consulta solicitud',10,'2026-02-13 15:44:53'),
(702,18,'Consulta solicitud',1,'2026-02-13 15:59:43'),
(703,18,'Consulta solicitud',10,'2026-02-13 15:59:59'),
(704,18,'Consulta solicitud',10,'2026-02-13 16:00:12'),
(705,18,'Consulta solicitud',1,'2026-02-13 16:01:14'),
(706,18,'Consulta solicitud',1,'2026-02-13 16:05:32'),
(707,18,'Consulta solicitud',1,'2026-02-13 16:05:51'),
(708,18,'Consulta solicitud',1,'2026-02-13 16:06:04'),
(709,18,'Consulta solicitud',10,'2026-02-13 16:10:28'),
(710,18,'Consulta solicitud',10,'2026-02-13 16:10:58'),
(711,18,'Consulta solicitud',10,'2026-02-13 16:12:23'),
(712,18,'Consulta solicitud',10,'2026-02-13 16:18:28'),
(713,18,'Consulta solicitud',10,'2026-02-13 16:18:32'),
(714,18,'Consulta solicitud',10,'2026-02-13 16:20:41'),
(715,18,'Consulta solicitud',10,'2026-02-13 16:21:08'),
(716,18,'Consulta solicitud',10,'2026-02-13 16:21:18'),
(717,18,'Consulta solicitud',10,'2026-02-13 16:21:43'),
(718,18,'Consulta solicitud',10,'2026-02-13 16:21:49'),
(719,18,'Consulta solicitud',10,'2026-02-16 09:13:39'),
(720,19,'Ingresa solicitud: PRUEBA DESVE 001',1,'2026-02-16 09:53:15'),
(721,19,'Consulta solicitud',12,'2026-02-16 09:53:27'),
(722,19,'Consulta solicitud',12,'2026-02-16 09:54:03'),
(723,19,'Consulta solicitud',12,'2026-02-16 09:54:06'),
(724,19,'Consulta solicitud',12,'2026-02-16 09:54:08'),
(725,19,'Consulta solicitud',12,'2026-02-16 09:54:16'),
(726,19,'Consulta solicitud',12,'2026-02-16 09:54:18'),
(727,19,'Consulta solicitud',12,'2026-02-16 09:54:20'),
(728,19,'Consulta solicitud',12,'2026-02-16 09:54:28'),
(729,19,'Consulta solicitud',12,'2026-02-16 09:54:30'),
(730,19,'Añade comentario al trámite',12,'2026-02-16 09:54:58'),
(731,19,'Consulta solicitud',12,'2026-02-16 09:54:59'),
(732,19,'Responde solicitud',12,'2026-02-16 09:55:36'),
(733,19,'Consulta solicitud',1,'2026-02-16 09:55:46'),
(734,19,'Añade comentario al trámite',1,'2026-02-16 09:56:04'),
(735,19,'Consulta solicitud',1,'2026-02-16 09:56:04'),
(736,19,'Consulta solicitud',12,'2026-02-16 09:56:12'),
(737,19,'Consulta solicitud',12,'2026-02-16 09:56:19'),
(738,19,'Responde solicitud',12,'2026-02-16 09:56:27'),
(739,19,'Consulta solicitud',1,'2026-02-16 09:56:37'),
(740,19,'Consulta solicitud',1,'2026-02-16 09:56:52'),
(741,19,'Consulta solicitud',1,'2026-02-16 09:57:07'),
(742,19,'Consulta solicitud',1,'2026-02-16 09:57:17'),
(743,19,'Consulta solicitud',1,'2026-02-16 10:02:14'),
(744,19,'Consulta solicitud',1,'2026-02-16 10:02:19'),
(745,19,'Consulta solicitud',1,'2026-02-16 10:04:23'),
(746,19,'Consulta solicitud',1,'2026-02-16 10:06:48'),
(747,19,'Consulta solicitud',1,'2026-02-16 10:08:01'),
(748,19,'Consulta solicitud',1,'2026-02-16 10:08:12'),
(749,19,'Consulta solicitud',1,'2026-02-16 10:11:44'),
(750,19,'Consulta solicitud',1,'2026-02-16 10:17:28'),
(751,19,'Consulta solicitud',1,'2026-02-16 10:19:43'),
(752,19,'Consulta solicitud',1,'2026-02-16 10:20:01'),
(753,19,'Consulta solicitud',1,'2026-02-16 10:20:06'),
(754,19,'Consulta solicitud',1,'2026-02-16 13:04:03'),
(755,20,'Ingresa solicitud OIRS',1,'2026-02-17 09:52:14');
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
  `gco_fecha` datetime NOT NULL,
  PRIMARY KEY (`gco_id`),
  KEY `trd_geneal_comentario_trd_acceso_usuarios_FK` (`gco_comentador`),
  KEY `trd_geneal_comentario_trd_general_registro_general_tramites_FK` (`gco_tramite`),
  CONSTRAINT `trd_geneal_comentario_trd_acceso_usuarios_FK` FOREIGN KEY (`gco_comentador`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_geneal_comentario_trd_general_registro_general_tramites_FK` FOREIGN KEY (`gco_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,1,'comentario',NULL,4,'2026-02-06 16:14:48'),
(2,6,'comentario de operador',NULL,12,'2026-02-12 20:42:48'),
(3,8,'asd',NULL,13,'2026-02-12 21:25:21'),
(4,10,'asd',NULL,18,'2026-02-13 18:36:53'),
(5,1,'sdf',NULL,18,'2026-02-13 19:28:36'),
(6,1,'dfg',NULL,18,'2026-02-13 19:28:52'),
(7,12,'revisar información',NULL,19,'2026-02-16 13:54:58'),
(8,1,'rESOPONDE CON UN NUMERO',NULL,19,'2026-02-16 13:56:04');
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
  PRIMARY KEY (`tgc_id`),
  KEY `trd_general_contribuyentes_trd_cont_escolaridad_FK` (`tgc_escolaridad`),
  CONSTRAINT `trd_general_contribuyentes_trd_cont_escolaridad_FK` FOREIGN KEY (`tgc_escolaridad`) REFERENCES `trd_cont_escolaridad` (`esc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(1,'11.111.111-1','natural','',NULL,NULL,'',NULL,'1','1','1','Otro','1990-02-03','Divorciado/a',3,'Chilena','centrib@test.cl','+56944444444',0,NULL);
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
  `doc_fecha` datetime NOT NULL,
  `doc_version_actual` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`doc_tramite_registrado`) USING BTREE,
  KEY `trd_versiones_FK` (`doc_version_actual`),
  CONSTRAINT `trd_versiones_FK` FOREIGN KEY (`doc_version_actual`) REFERENCES `trd_general_documento_adjunto_versiones` (`docv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(4,4,'2026-02-06 12:47:02',1),
(5,4,'2026-02-06 13:00:46',2),
(6,4,'2026-02-06 13:05:20',3),
(7,5,'2026-02-06 13:06:43',4),
(8,5,'2026-02-06 13:11:17',5),
(9,6,'2026-02-06 13:12:52',6),
(10,9,'2026-02-06 13:58:38',7),
(11,9,'2026-02-06 14:00:47',8),
(12,11,'2026-02-10 17:03:40',9),
(13,15,'2026-02-13 11:31:59',10),
(14,18,'2026-02-13 13:49:37',11),
(15,19,'2026-02-16 09:55:36',12),
(16,20,'2026-02-17 09:52:14',13);
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
  `doc-responsable` int(11) NOT NULL,
  `doc_docdigital` tinyint(1) NOT NULL,
  `doc_partner` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`docv_id`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`doc-responsable`) USING BTREE,
  KEY `trd_versiones_doc_FK` (`docv_doc_id`),
  CONSTRAINT `trd_versiones_doc_FK` FOREIGN KEY (`docv_doc_id`) REFERENCES `trd_general_documento_adjunto` (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto_versiones` VALUES
(1,4,'2026-02-06 12:47:02','gestordocumental/202602/2602061647T4jrQ.mvm','certificado pisee1.pdf',1,0,'202602/.ck'),
(2,5,'2026-02-06 13:00:46','gestordocumental/202602/2602061700rIAs9.imv','certificado pisee1.pdf',1,0,'202602/.ck'),
(3,6,'2026-02-06 13:05:20','gestordocumental/202602/2602061705nhSWF.imv','Decreto - Doc1.docx',1,0,'202602/.ck'),
(4,7,'2026-02-06 13:06:43','gestordocumental/202602/2602061706L6Lum.imv','Doc1.docx',1,0,'202602/.ck'),
(5,8,'2026-02-06 13:11:17','gestordocumental/202602/2602061711SiubZ.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck'),
(6,9,'2026-02-06 13:12:52','gestordocumental/202602/26020617127hkGn.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck'),
(7,10,'2026-02-06 13:58:38','gestordocumental/202602/2602061758pK21C.imv','System BPMN - MODELO NUEVO DE FERIAS.pdf',3,0,'202602/.ck'),
(8,11,'2026-02-06 14:00:47','gestordocumental/202602/2602061800kqYoZ.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck'),
(9,12,'2026-02-10 17:03:40','gestordocumental/202602/2602102103yzmRv.imv','27. Sistema Tramites y Solicitudes.pdf',3,0,'202602/.ck'),
(10,13,'2026-02-13 11:31:59','gestordocumental/202602/2602131531TlxjP.imv','2512012877.pdf',3,0,'202602/.ck'),
(11,14,'2026-02-13 13:49:37','gestordocumental/202602/2602131749FJAQm.imv','2512012877.pdf',10,0,'202602/.ck'),
(12,15,'2026-02-16 09:55:36','gestordocumental/202602/2602161355JbOLp.imv','CPAT Interno.pdf',12,0,'202602/.ck'),
(13,16,'2026-02-17 09:52:14','gestordocumental/202602/2602171352MWYYw.imv','2512012877.pdf',1,0,'202602/.ck');
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
  `tge_fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tge_id`),
  KEY `trd_general_enlaces_trd_acceso_usuarios_FK` (`tge_responsable`) USING BTREE,
  KEY `trd_general_enlaces_trd_general_registro_general_tramites_FK` (`tge_tramite`) USING BTREE,
  CONSTRAINT `trd_general_enlaces_trd_acceso_usuarios_FK` FOREIGN KEY (`tge_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_enlaces_trd_general_registro_general_tramites_FK` FOREIGN KEY (`tge_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES
(14,4,'https://mail.google.com/',1,'2026-02-06 13:00:45'),
(15,9,'https://docs.google.com/document/d/1nhTv63CyxT5HSdPSthsRbeRXbdm7QzroCH_yw7TNE-s/edit?usp=sharing',3,'2026-02-06 13:58:38'),
(16,15,'https://www.google.cl',3,'2026-02-13 11:31:59');
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
('CREATE','Creación de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('DB_ERROR','Error de base de datos','error','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('DELETE','Eliminación de registro','warning','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('LOGIN_FAILED','Intento de inicio de sesión fallido','warning','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('LOGIN_SUCCESS','Inicio de sesión exitoso','info','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('LOGOUT','Cierre de sesión','info','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('SYS_ERROR','Error del sistema','error','2026-02-03 14:19:23','2026-02-03 14:19:23'),
('UPDATE','Actualización de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23');
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
  `log_fecha` datetime DEFAULT current_timestamp(),
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
  PRIMARY KEY (`log_id`),
  KEY `log_usuario_id` (`log_usuario_id`),
  KEY `log_evento_codigo` (`log_evento_codigo`),
  CONSTRAINT `fk_logs_evento` FOREIGN KEY (`log_evento_codigo`) REFERENCES `trd_general_eventos_codigos` (`evt_codigo`),
  CONSTRAINT `fk_logs_usuario` FOREIGN KEY (`log_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(2,'2026-02-06 11:36:00','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(3,'2026-02-06 11:58:46','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 4','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(4,'2026-02-06 12:18:23','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(5,'2026-02-06 12:18:41','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(6,'2026-02-06 12:22:07','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso'),
(7,'2026-02-06 12:47:02','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso'),
(8,'2026-02-06 13:00:46','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso'),
(9,'2026-02-06 13:06:43','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 5','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 002\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba 2 \",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"Doc1.docx\"}]}}','192.168.0.169','Exitoso'),
(10,'2026-02-06 13:12:19','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 6','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 003\",\"tis_tipo\":\"1\",\"tis_contenido\":\"ASD\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(11,'2026-02-06 13:13:41','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 7','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004\",\"tis_tipo\":\"2\",\"tis_contenido\":\"\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(12,'2026-02-06 13:21:12','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 8','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"comprar papel hijenico\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favorelpapel\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[]}}','192.168.0.169','Exitoso'),
(13,'2026-02-06 13:40:31','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(14,'2026-02-06 13:46:29','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(15,'2026-02-06 13:46:36','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(16,'2026-02-06 13:52:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(17,'2026-02-06 13:52:55','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(18,'2026-02-06 13:54:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(19,'2026-02-06 13:58:38','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 9','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Revisi\\u00f3n de ingreso\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor revisar esta informaci\\u00f3n\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Copia\",\"tid_facultad\":\"Visador\",\"tid_requeido\":\"1\"},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/docs.google.com\\/document\\/d\\/1nhTv63CyxT5HSdPSthsRbeRXbdm7QzroCH_yw7TNE-s\\/edit?usp=sharing\"],\"documentos\":[{\"nombre\":\"System BPMN - MODELO NUEVO DE FERIAS.pdf\"}]}}','192.168.0.112','Exitoso'),
(20,'2026-02-06 14:17:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(21,'2026-02-06 14:19:15','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 10','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revision 1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"test 1\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON EVIL GUY\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso'),
(22,'2026-02-06 14:19:23','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(23,'2026-02-06 14:45:56','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 10','{\"id\":\"10\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"10\",\"tis_titulo\":\"revision 1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"test 1\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON EVIL GUY\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(24,'2026-02-06 14:46:28','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(25,'2026-02-06 14:46:34','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(26,'2026-02-09 09:59:46','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(27,'2026-02-09 12:25:30','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(28,'2026-02-09 12:25:49','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(29,'2026-02-10 16:36:22','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(30,'2026-02-10 17:02:28','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(31,'2026-02-10 17:03:40','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 11','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisi\\u00f3n de muchas cosas\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor revisar documento atendido\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-10\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"27. Sistema Tramites y Solicitudes.pdf\"}]}}','192.168.0.112','Exitoso'),
(32,'2026-02-10 17:04:07','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(33,'2026-02-10 17:04:45','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(34,'2026-02-10 17:05:59','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(35,'2026-02-11 08:47:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(36,'2026-02-11 10:34:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(37,'2026-02-11 13:12:48','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(38,'2026-02-11 13:14:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(39,'2026-02-11 13:27:55','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(40,'2026-02-11 13:42:19','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(41,'2026-02-11 14:01:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(42,'2026-02-11 16:26:31','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(43,'2026-02-11 16:29:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(44,'2026-02-12 16:04:38','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(45,'2026-02-12 16:07:34','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(46,'2026-02-12 16:07:41','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(47,'2026-02-12 16:29:57','CREATE','info','Bajo','INGRESOS',4,'CREAR_INGRESO','Creación de ingreso: 12','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asd\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-12\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Consultor\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"0\"},{\"usr_id\":\"6\",\"usr_nombre_completo\":\"USUARIO INGRESOS OPERADOR\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(48,'2026-02-12 16:32:07','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(49,'2026-02-12 16:32:59','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(50,'2026-02-12 16:43:09','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(51,'2026-02-12 16:53:46','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 13','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-12\",\"destinos\":[]}}','192.168.0.169','Exitoso'),
(52,'2026-02-12 17:01:57','UPDATE','info','Bajo','INGRESOS',6,'ACTUALIZAR_INGRESO','Actualización de ingreso: 13','{\"id\":\"13\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"13\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"destinos\":[{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(53,'2026-02-12 17:02:40','UPDATE','info','Bajo','INGRESOS',6,'ACTUALIZAR_INGRESO','Actualización de ingreso: 13','{\"id\":\"13\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"13\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(54,'2026-02-13 09:54:25','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(55,'2026-02-13 09:56:55','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(56,'2026-02-13 10:07:00','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(57,'2026-02-13 10:55:44','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(58,'2026-02-13 10:58:35','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 14','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 002\",\"tis_tipo\":\"1\",\"tis_contenido\":\"qwe\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso'),
(59,'2026-02-13 10:59:57','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(60,'2026-02-13 11:25:12','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(61,'2026-02-13 11:30:23','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(62,'2026-02-13 11:31:59','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 15','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisi\\u00f3n de plataforma\",\"tis_tipo\":\"1\",\"tis_contenido\":\"solicito revisar la informaci\\u00f3n contenida en el documento\\n\\n\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/www.google.cl\"],\"documentos\":[{\"nombre\":\"2512012877.pdf\"}]}}','192.168.0.169','Exitoso'),
(63,'2026-02-13 11:32:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(64,'2026-02-13 11:33:03','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(65,'2026-02-13 11:35:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(66,'2026-02-13 11:47:31','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(67,'2026-02-13 12:04:34','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(68,'2026-02-13 12:05:06','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(69,'2026-02-13 12:08:08','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(70,'2026-02-13 12:08:22','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 16','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"testo\",\"tis_tipo\":\"1\",\"tis_contenido\":\"sadc\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','::1','Exitoso'),
(71,'2026-02-13 12:10:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(72,'2026-02-13 12:27:59','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(73,'2026-02-13 12:28:10','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(74,'2026-02-13 12:52:23','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso'),
(75,'2026-02-13 12:53:55','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(76,'2026-02-13 12:54:06','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(77,'2026-02-13 13:49:37','CREATE','info','Bajo','DESVE',10,'CREAR_SOLICITUD','Creación de solicitud DESVE: 1','{\"data\":{\"sol_nombre_expediente\":\"prueba  perfiles 001\",\"sol_ingreso_desve\":\"php01\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"contenido desve\",\"sol_fecha_recepcion\":\"2026-02-13 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"12\",\"sol_fecha_vencimiento\":\"2026-02-17 00:00:00\",\"sol_observaciones\":\"no c\",\"sol_responsable\":null,\"sol_origen_esp\":2,\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\"},{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\"}],\"documentos\":[{\"nombre\":\"2512012877.pdf\"}],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso'),
(78,'2026-02-13 15:44:48','UPDATE','info','Bajo','DESVE',10,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 1','{\"id\":\"1\",\"cambios\":{\"sol_id\":\"1\",\"sol_ingreso_desve\":\"php01\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba  perfiles 001\",\"sol_origen_id\":\"1\",\"sol_detalle\":\"contenido desve\",\"sol_fecha_recepcion\":\"2026-02-13 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"12\",\"sol_fecha_vencimiento\":\"2026-02-17 00:00:00\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"no c\",\"sol_responsable\":\"10\",\"destinos\":[{\"tid_id\":\"1\",\"tid_desve_solicitud\":\"1\",\"tid_destino\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"JUAN\",\"usr_apellido\":\"HERVAS\",\"usr_email\":\"juan.hervas@munivina.cl\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"usr_id\":\"1\"},{\"tid_id\":\"2\",\"tid_desve_solicitud\":\"1\",\"tid_destino\":\"12\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"EXTENO\",\"usr_email\":\"desve.externo@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"usr_id\":\"12\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso'),
(79,'2026-02-13 16:10:19','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(80,'2026-02-13 16:10:49','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(81,'2026-02-16 09:13:55','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(82,'2026-02-16 09:14:33','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(83,'2026-02-16 09:52:19','LOGIN_SUCCESS','info','Bajo','Autenticación',12,'LOGIN','Usuario desve.externo@test.cl inició sesión correctamente','{\"email\":\"desve.externo@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso'),
(84,'2026-02-16 09:53:15','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 2','{\"data\":{\"sol_nombre_expediente\":\"PRUEBA DESVE 001\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"1 1 1\",\"sol_detalle\":\"HOLA LETI\",\"sol_fecha_recepcion\":\"2026-02-16 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-18 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":null,\"sol_origen_esp\":1,\"destinos\":[{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso'),
(85,'2026-02-16 10:20:02','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"PRUEBA DESVE 001\",\"sol_origen_id\":\"1\",\"sol_detalle\":\"HOLA LETI\",\"sol_fecha_recepcion\":\"2026-02-16 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-18 00:00:00\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"destinos\":[{\"tid_id\":\"5\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"12\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"EXTENO\",\"usr_email\":\"desve.externo@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"usr_id\":\"12\"}],\"sol_origen_esp\":1,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso'),
(86,'2026-02-16 10:50:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(87,'2026-02-16 11:02:27','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(88,'2026-02-16 11:29:32','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(89,'2026-02-16 11:29:44','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(90,'2026-02-16 11:38:39','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(91,'2026-02-16 15:25:05','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso'),
(92,'2026-02-16 15:33:26','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(93,'2026-02-16 15:34:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(94,'2026-02-16 16:30:39','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(95,'2026-02-16 16:31:02','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(96,'2026-02-16 16:31:29','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso'),
(97,'2026-02-17 09:52:14','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 1','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11.111.111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_nacionalidad\":\"Chilena\",\"cont_email\":\"centrib@test.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"las verbenas 55 Casa 5 Depto 4 (condominio las peras)\",\"cont_latitud\":\"-33.0407908\",\"cont_longitud\":\"-71.5354864\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_fecha_hora\":\"2026-02-17 13:39\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"Av. Los Casta\\u00f1os 333, 2530711 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":null,\"oirs_descripcion\":\"hay un basual cerca de la unab\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.018814686224125\",\"oirs_longitud\":\"-71.54004119567871\",\"oirs_respuesta\":\"\",\"documentos\":[{\"nombre\":\"2512012877.pdf\"}]},\"response\":{\"status\":\"success\",\"id\":\"1\",\"rgt_id\":\"20\"}}','192.168.0.169','Exitoso'),
(98,'2026-02-17 09:59:54','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso');
/*!40000 ALTER TABLE `trd_general_logs` ENABLE KEYS */;
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
  PRIMARY KEY (`gma_id`),
  KEY `padres` (`gma_padre`),
  KEY `hijos` (`gma_hijo`),
  CONSTRAINT `hijos` FOREIGN KEY (`gma_hijo`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`),
  CONSTRAINT `padres` FOREIGN KEY (`gma_padre`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_multiancestro` VALUES
(1,7,8),
(2,12,13);
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
  `ogc_inscripcion` datetime NOT NULL,
  `orgc_vigencia` date DEFAULT NULL,
  `ogc_rep_legal` int(11) NOT NULL,
  `orgc_unidad_vecinal` varchar(100) DEFAULT NULL,
  `orgc_tipo_organizacion` int(11) NOT NULL,
  PRIMARY KEY (`orgc_id`),
  KEY `trd_general_org_comu_trd_general_tipos_organizacion_FK` (`orgc_tipo_organizacion`),
  KEY `trd_general_org_comu_trd_general_contribuyentes_FK` (`ogc_rep_legal`),
  CONSTRAINT `trd_general_org_comu_trd_general_contribuyentes_FK` FOREIGN KEY (`ogc_rep_legal`) REFERENCES `trd_general_contribuyentes` (`tgc_id`),
  CONSTRAINT `trd_general_org_comu_trd_general_tipos_organizacion_FK` FOREIGN KEY (`orgc_tipo_organizacion`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_organizaciones_comunitarias`
--

LOCK TABLES `trd_general_organizaciones_comunitarias` WRITE;
/*!40000 ALTER TABLE `trd_general_organizaciones_comunitarias` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_organizaciones_comunitarias` VALUES
(1,'11.111.111-1','Organizacion de pueba 1','sdfsdf','aadsf43','2026-01-26 11:44:00','2036-01-26',3,'25',2);
/*!40000 ALTER TABLE `trd_general_organizaciones_comunitarias` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_general_registro_general_tramites`
--

DROP TABLE IF EXISTS `trd_general_registro_general_tramites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_general_registro_general_tramites` (
  `rgt_id` int(11) NOT NULL AUTO_INCREMENT,
  `rgt_id_publica` varchar(100) DEFAULT NULL,
  `rgt_tramite` varchar(100) DEFAULT NULL,
  `rgt_tramite_padre` int(11) DEFAULT NULL,
  `rgt_creador` int(11) DEFAULT NULL,
  `rgt_contribuyente` int(11) DEFAULT NULL,
  PRIMARY KEY (`rgt_id`),
  KEY `trd_general_registro_general_tramites_SK` (`rgt_tramite_padre`) USING BTREE,
  KEY `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` (`rgt_creador`),
  KEY `trd_general_registro_general_tramites_contribuyente_FK` (`rgt_contribuyente`),
  CONSTRAINT `trd_general_registro_general_tramites_contribuyente_FK` FOREIGN KEY (`rgt_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`),
  CONSTRAINT `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` FOREIGN KEY (`rgt_creador`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_tramites`
--

LOCK TABLES `trd_general_registro_general_tramites` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_tramites` VALUES
(4,'260206-1558-Ingreso_ingresos-wp','Ingreso_ingresos',NULL,1,NULL),
(5,'260206-1706-Ingreso_ingresos-Ze','Ingreso_ingresos',NULL,1,NULL),
(6,'260206-1712-Ingreso_ingresos-cF','Ingreso_ingresos',NULL,1,NULL),
(7,'260206-1713-Ingreso_ingresos-kB','Ingreso_ingresos',NULL,1,NULL),
(8,'260206-1721-Ingreso_ingresos-hB','Ingreso_ingresos',NULL,1,NULL),
(9,'260206-1758-Ingreso_ingresos-zh','Ingreso_ingresos',NULL,3,NULL),
(10,'260206-1819-Ingreso_ingresos-dO','Ingreso_ingresos',NULL,1,NULL),
(11,'260210-2103-Ingreso_ingresos-hz','Ingreso_ingresos',NULL,3,NULL),
(12,'260212-2029-Ingreso_ingresos-7j','Ingreso_ingresos',NULL,4,NULL),
(13,'260212-2053-Ingreso_ingresos-ap','Ingreso_ingresos',NULL,6,NULL),
(14,'260213-1458-Ingreso_ingresos-5n','Ingreso_ingresos',NULL,6,NULL),
(15,'260213-1531-Ingreso_ingresos-Ve','Ingreso_ingresos',NULL,3,NULL),
(16,'260213-1608-Ingreso_ingresos-1u','Ingreso_ingresos',NULL,6,NULL),
(18,'260213-1749-desve_solicitud-Rz','desve_solicitud',NULL,10,NULL),
(19,'260216-1353-desve_solicitud-J1','desve_solicitud',NULL,1,NULL),
(20,'260217-1352-OIRS-Dm','oirs',NULL,1,1);
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` ENABLE KEYS */;
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
  `tid_facultad` enum('Firmante','Visador','Consultor','Responsable') NOT NULL,
  `tid_requeido` tinyint(1) NOT NULL DEFAULT 0,
  `tid_responde` tinyint(1) DEFAULT NULL,
  `tid_fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`tid_id`),
  KEY `ingresos_destinos_ing` (`tid_ingreso_solicitud`),
  KEY `trd_ingresos_destinos_trd_acceso_usuarios_FK` (`tid_destino`),
  CONSTRAINT `ingresos_destinos_ing` FOREIGN KEY (`tid_ingreso_solicitud`) REFERENCES `trd_ingresos_solicitudes` (`tis_id`),
  CONSTRAINT `trd_ingresos_destinos_trd_acceso_usuarios_FK` FOREIGN KEY (`tid_destino`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_destinos` VALUES
(18,4,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 13:05:20'),
(19,5,1,'Para',NULL,NULL,'Firmante',1,1,'2026-02-06 13:11:18'),
(20,6,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 13:12:52'),
(21,7,1,'Para','',NULL,'Firmante',1,0,'2026-02-13 11:06:36'),
(22,9,2,'Copia',NULL,NULL,'Visador',1,NULL,NULL),
(23,9,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 14:00:47'),
(25,10,3,'Para','ingrewso de respuesta con texto 01',NULL,'Responsable',1,1,'2026-02-06 15:11:30'),
(26,11,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL),
(27,11,2,'Para','',NULL,'Visador',1,1,'2026-02-10 17:05:13'),
(28,12,8,'Para',NULL,NULL,'Consultor',0,NULL,NULL),
(29,12,6,'Para','no por que no quiero',NULL,'Firmante',1,0,'2026-02-13 09:55:48'),
(31,13,8,'Para','','ejecutar lo requerido','Firmante',1,0,'2026-02-13 09:57:55'),
(32,14,1,'Para','siiii',NULL,'Firmante',1,1,'2026-02-13 11:01:40'),
(33,14,8,'Para','',NULL,'Visador',1,1,'2026-02-13 11:00:31'),
(34,15,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL),
(35,15,2,'Para','',NULL,'Visador',1,1,'2026-02-13 11:34:59'),
(36,16,8,'Para',NULL,NULL,'Visador',1,NULL,NULL);
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
  `tis_responsable` int(11) DEFAULT NULL,
  `tis_respuesta` text DEFAULT NULL,
  `tis_fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `tis_fecha_limite` date DEFAULT NULL,
  `tis_registro_tramite` int(11) NOT NULL,
  PRIMARY KEY (`tis_id`),
  KEY `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` (`tis_responsable`),
  KEY `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` (`tis_tipo`),
  KEY `trd_ingresos_registro_general_tramites_FK` (`tis_registro_tramite`),
  CONSTRAINT `trd_ingresos_registro_general_tramites_FK` FOREIGN KEY (`tis_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` FOREIGN KEY (`tis_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` FOREIGN KEY (`tis_tipo`) REFERENCES `trd_ingresos_tipos_ingreso` (`titi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(4,1,'prueba ingreso de ingreso 001','detalle de solicitud 3','Resuelto_NO_Favorable',1,'halo','2026-02-06 00:00:00',NULL,4),
(5,1,'prueba ingreso de ingreso 002','prueba 2 ','Resuelto_Favorable',1,'.','2026-02-06 00:00:00',NULL,5),
(6,1,'prueba ingreso de ingreso 003','ASD','Resuelto_NO_Favorable',1,'.','2026-02-06 00:00:00',NULL,6),
(7,2,'prueba ingreso de ingreso 004','','Resuelto_NO_Favorable',1,NULL,'2026-02-06 00:00:00',NULL,7),
(8,1,'comprar papel hijenico','por favorelpapel','Ingresado',1,NULL,'2026-02-06 00:00:00',NULL,8),
(9,1,'Revisión de ingreso','por favor revisar esta información','Ingresado',3,'cualquier cosa','2026-02-06 00:00:00',NULL,9),
(10,1,'revision 1','test 1','Resuelto_Favorable',1,NULL,'2026-02-06 00:00:00',NULL,10),
(11,1,'revisión de muchas cosas','por favor revisar documento atendido','Ingresado',3,NULL,'2026-02-10 00:00:00',NULL,11),
(12,1,'prueba ingreso de ingreso 001','asd','Resuelto_NO_Favorable',4,NULL,'2026-02-12 00:00:00',NULL,12),
(13,1,'solicitud hija1','asdf2','Resuelto_NO_Favorable',6,NULL,'2026-02-12 00:00:00',NULL,13),
(14,1,'prueba ingreso de ingreso 002','qwe','Resuelto_Favorable',6,NULL,'2026-02-13 00:00:00','2026-03-13',14),
(15,1,'revisión de plataforma','solicito revisar la información contenida en el documento\n\n','Ingresado',3,NULL,'2026-02-13 00:00:00','2026-03-13',15),
(16,1,'testo','sadc','Ingresado',6,NULL,'2026-02-13 00:00:00','2026-03-13',16);
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
(1,'Administrativo'),
(2,'Municipal');
/*!40000 ALTER TABLE `trd_ingresos_tipos_ingreso` ENABLE KEYS */;
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
-- Table structure for table `trd_oirs_condiciones`
--

DROP TABLE IF EXISTS `trd_oirs_condiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_oirs_condiciones` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_condiciones`
--

LOCK TABLES `trd_oirs_condiciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_condiciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_condiciones` VALUES
(1,'Embarazada'),
(2,'Persona con Discapacidad'),
(3,'Dirigente Social / Comunitario'),
(4,'Adulto Mayor'),
(5,'Pueblos Originarios'),
(6,'Cuidador/a');
/*!40000 ALTER TABLE `trd_oirs_condiciones` ENABLE KEYS */;
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
  PRIMARY KEY (`oig_id`),
  KEY `fk_gestion_solicitud` (`oig_solicitud`),
  CONSTRAINT `fk_gestion_solicitud` FOREIGN KEY (`oig_solicitud`) REFERENCES `trd_oirs_solicitud` (`oirs_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_gestion`
--

LOCK TABLES `trd_oirs_gestion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_gestion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_gestion` VALUES
(1,1,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `oirs_fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `oirs_tematica` int(11) NOT NULL,
  `oirs_subtematica` int(11) DEFAULT NULL,
  `oirs_calle` varchar(100) DEFAULT NULL,
  `oirs_numero` varchar(100) DEFAULT NULL,
  `oirs_aclaratoia` text DEFAULT NULL,
  `oirs_latitud` decimal(10,8) DEFAULT NULL,
  `oirs_longitud` decimal(10,8) DEFAULT NULL,
  `oirs_descripcion` text NOT NULL,
  `oirs_estado` tinyint(4) NOT NULL,
  `oirs_fecha_limite` date NOT NULL,
  PRIMARY KEY (`oirs_id`),
  KEY `trd_oirs_solicitud_trd_general_registro_general_tramites_FK` (`oirs_registro_tramite`),
  KEY `trd_oirs_solicitud_trd_oirs_condiciones_FK` (`oirs_condicion`),
  KEY `trd_oirs_solicitud_trd_oirs_tipo_atencion_FK` (`oirs_tipo_atencion`),
  KEY `trd_oirs_solicitud_trd_oirs_tematicas_FK` (`oirs_tematica`),
  KEY `trd_oirs_solicitud_trd_oirs_subtematicas_FK` (`oirs_subtematica`),
  CONSTRAINT `trd_oirs_solicitud_trd_general_registro_general_tramites_FK` FOREIGN KEY (`oirs_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`),
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
(1,20,1,'Presencial',1,1,'2026-02-17 09:52:14',2,2,'Av. Los Castaños 333, 2530711 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.01881469,-71.54004120,'hay un basual cerca de la unab',0,'2026-03-10');
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
(1,1,'otro'),
(2,2,'Extracción de microbasurales'),
(3,2,'Tenencia responsable de mascotas'),
(4,3,'Iluminación pública deficiente'),
(5,3,'Patrullaje preventivo'),
(6,4,'Subsidios y Ayudas sociales');
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
(1,'Otro'),
(2,'Medio Ambiente'),
(3,'Seguridad'),
(4,'Social');
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
(1,'Consulta'),
(2,'Reclamo'),
(3,'Sugerencia'),
(4,'Felicitación'),
(5,'Denuncia');
/*!40000 ALTER TABLE `trd_oirs_tipo_atencion` ENABLE KEYS */;
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
  `tar_fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_tareas`
--

LOCK TABLES `trd_tareas` WRITE;
/*!40000 ALTER TABLE `trd_tareas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_tareas` VALUES
(1,1,1,'1','2','2026-02-16 08:00:00',1,'2026-02-09 11:40:36'),
(2,1,1,'2','2','2026-02-16 08:00:00',1,'2026-02-09 11:40:36'),
(3,1,1,'3','3','2026-02-16 08:00:00',1,'2026-02-09 11:40:36'),
(4,1,1,'4','4','2026-02-16 08:00:00',1,'2026-02-09 11:51:34'),
(5,1,1,'5','5','2026-02-16 08:00:00',1,'2026-02-09 11:52:18'),
(6,1,3,'revisart ingresos','hay que revisar todo el sistema d ingresos','2026-02-16 08:00:00',0,'2026-02-09 12:25:18'),
(7,1,3,'6','6','2026-02-16 08:00:00',0,'2026-02-09 12:48:16');
/*!40000 ALTER TABLE `trd_tareas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Dumping routines for database 'transformacion_digital_beta'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-02-17 10:20:15
