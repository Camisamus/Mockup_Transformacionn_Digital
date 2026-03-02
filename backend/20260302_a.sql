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
(16,'9.4',0,'2026-03-02 15:45:33','2026-03-02 15:45:33');
/*!40000 ALTER TABLE `trd_acceso_permiso_rol` ENABLE KEYS */;
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
('11',3,'Patentes',NULL,'menu','categoria','command',0,'2025-12-29 12:53:09','2026-02-26 14:55:38','principal'),
('11.1',NULL,'Mis Solicitudes','funcionarios/no_asignadas/patentes_mis_solicitudes.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.2',NULL,'Pagos','funcionarios/no_asignadas/pagos.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.3',NULL,'Solicitud Única de Patentes','funcionarios/no_asignadas/patentes_solicitud_unica.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.4',NULL,'Consulta de Solicitud','funcionarios/no_asignadas/patentes_consulta_solicitud.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
('11.c',NULL,'Gestión de Empresas','funcionarios/no_asignadas/contribuyente_empresas.html','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 15:16:31',NULL),
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
('9',0,'Blanco',NULL,'menu','categoria','dashboard',0,'2026-03-02 15:45:01','2026-03-02 15:45:01','principal'),
('9.1',1,'Dashboard',NULL,'menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 15:45:01','blanco'),
('9.2',2,'Consultar',NULL,'menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 15:45:01','blanco'),
('9.3',3,'Ver',NULL,'menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 15:45:01','blanco'),
('9.4',4,'Editar Maestro',NULL,'menu','Pagina','dashboard',0,'2026-03-02 15:39:15','2026-03-02 15:45:01','blanco'),
('A.0',NULL,'Bandeja','funcionarios/index.php','menu','Pagina','menu',0,'2025-12-29 12:53:09','2026-02-26 14:54:19',NULL),
('A.1',NULL,'Bandeja Historial','funcionarios/bandeja_historial.php','menu','Pagina','clock',0,'2026-02-11 16:34:04','2026-02-26 14:54:19',NULL);
/*!40000 ALTER TABLE `trd_acceso_permisos` ENABLE KEYS */;
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
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(3,8,'2026-02-05 13:39:00','2027-06-12 13:39:00',NULL,0,'2026-02-06 13:39:31','2026-02-06 13:52:29'),
(3,9,NULL,NULL,NULL,0,'2026-02-26 15:44:27','2026-02-26 15:44:27'),
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(16,'Blanco',0,'2026-03-02 15:40:39','2026-03-02 15:40:57');
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
(1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',1,0,'2025-12-29 12:53:09','2026-02-17 11:17:14'),
(2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',1,0,'2026-01-06 11:47:58','2026-02-17 11:17:14'),
(3,'Ramon','Martinez','14037230-7','ramon.martinez@munivina.cl',1,0,'2026-01-09 10:13:01','2026-02-17 16:19:59'),
(4,'usuario ingresos','admin','11111111-1','ingresos.admin@test.cl',5,0,'2026-02-12 15:11:13','2026-02-17 11:17:14'),
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
(1,1,'Particular','las verbenas','55','4','5','condominio las peras',NULL,NULL,'2026-02-16 15:53:36','2026-02-16 15:53:36',0,NULL),
(2,1,'OIRS','las verbenas 55 Casa 5 Depto 4 (condominio las peras)',NULL,NULL,NULL,NULL,-33.04079080,-71.53548640,'2026-02-17 09:52:14','2026-02-17 09:52:14',0,NULL),
(3,2,'OIRS','Las Magnolias 38, Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.01046386,-71.50242944,'2026-02-17 16:04:44','2026-02-17 16:04:44',0,NULL),
(4,1,'OIRS','las verbenas 55 Casa 5 Depto 4 (condominio las peras)',NULL,NULL,NULL,NULL,-33.04079080,-71.53548640,'2026-02-23 13:57:05','2026-02-23 13:57:05',0,'las verbenas 55 Casa 5 Depto 4 (condominio las peras)'),
(5,1,'OIRS','las verbenas 55 Casa 5 Depto 4 (condominio las peras)',NULL,NULL,NULL,NULL,-33.04079080,-71.53548640,'2026-02-26 12:07:30','2026-02-26 12:07:30',0,'las verbenas 55 Casa 5 Depto 4 (condominio las peras)'),
(6,1,'OIRS','las verbenas 55 Casa 5 Depto 4 (condominio las peras)',NULL,NULL,NULL,NULL,-33.04079080,-71.53548640,'2026-02-26 12:08:28','2026-02-26 12:08:28',0,'las verbenas 55 Casa 5 Depto 4 (condominio las peras)'),
(7,4,'OIRS','Jose M. Carrera 402, 2540187 Viña del Mar, Valparaíso, Chile',NULL,NULL,NULL,NULL,-33.03005902,-71.57125138,'2026-02-26 17:12:42','2026-02-26 17:12:42',0,'Jose M. Carrera 402, 2540187 Viña del Mar, Valparaíso, Chile');
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_destinos`
--

LOCK TABLES `trd_desve_destinos` WRITE;
/*!40000 ALTER TABLE `trd_desve_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_destinos` VALUES
(19,7,10,NULL,NULL,0,'2026-02-26 09:49:43','2026-02-26 09:49:43'),
(20,8,2,NULL,NULL,1,'2026-02-26 09:56:42','2026-02-26 10:00:31'),
(21,8,11,NULL,NULL,1,'2026-02-26 09:56:42','2026-02-26 10:00:31'),
(22,8,2,NULL,NULL,1,'2026-02-26 10:06:43','2026-02-26 10:28:19'),
(23,8,11,NULL,NULL,1,'2026-02-26 10:06:43','2026-02-26 10:28:19'),
(24,8,10,NULL,NULL,1,'2026-02-26 10:28:19','2026-02-26 10:54:48'),
(25,9,2,NULL,NULL,1,'2026-02-26 10:30:44','2026-02-26 12:50:51'),
(26,9,11,NULL,NULL,1,'2026-02-26 10:30:44','2026-02-26 12:50:51'),
(27,9,10,NULL,NULL,1,'2026-02-26 10:30:44','2026-02-26 12:50:51'),
(28,8,10,NULL,NULL,1,'2026-02-26 10:54:48','2026-02-26 10:55:20'),
(29,8,10,NULL,NULL,0,'2026-02-26 10:55:20','2026-02-26 10:55:20'),
(30,8,2,NULL,NULL,0,'2026-02-26 10:55:20','2026-02-26 10:55:20'),
(31,9,2,NULL,NULL,1,'2026-02-26 12:50:51','2026-02-26 12:51:17'),
(32,9,11,NULL,NULL,1,'2026-02-26 12:50:51','2026-02-26 12:51:17'),
(33,9,10,NULL,NULL,1,'2026-02-26 12:50:51','2026-02-26 12:51:17'),
(34,9,2,NULL,NULL,1,'2026-02-26 12:51:17','2026-02-26 13:01:22'),
(35,9,11,NULL,NULL,1,'2026-02-26 12:51:17','2026-02-26 13:01:22'),
(36,9,10,NULL,NULL,1,'2026-02-26 12:51:17','2026-02-26 13:01:22'),
(37,9,2,NULL,NULL,1,'2026-02-26 13:01:22','2026-02-26 15:16:40'),
(38,9,11,NULL,NULL,1,'2026-02-26 13:01:22','2026-02-26 15:16:40'),
(39,9,10,NULL,NULL,1,'2026-02-26 13:01:22','2026-02-26 15:16:40'),
(40,10,3,NULL,NULL,0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(41,9,2,NULL,NULL,0,'2026-02-26 15:16:40','2026-02-26 15:16:40'),
(42,9,11,NULL,NULL,0,'2026-02-26 15:16:40','2026-02-26 15:16:40'),
(43,9,10,NULL,NULL,0,'2026-02-26 15:16:40','2026-02-26 15:16:40'),
(44,11,2,NULL,NULL,1,'2026-02-27 15:49:05','2026-02-27 15:50:03'),
(45,11,2,NULL,NULL,0,'2026-02-27 15:50:03','2026-02-27 15:50:03'),
(46,11,3,NULL,NULL,0,'2026-02-27 15:50:03','2026-02-27 15:50:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_respuestas` VALUES
(5,9,'respuesta simple funcionario','2026-02-26 13:06:52',0,'2026-02-26 13:06:52','2026-02-26 13:06:52','Comentario',11),
(6,9,'respuesta definitiva funcionario','2026-02-26 13:07:53',0,'2026-02-26 13:07:53','2026-02-26 13:07:53','Respuesta Final',11);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(7,'a1','Prueba admin 1',13,'','prueba #1','2026-02-26 00:00:00',1,NULL,13,'2026-03-02 00:00:00',0,NULL,0,NULL,'',NULL,NULL,'13 norte, 2025',-33.01124900,-71.54054600,0,'2026-02-26 09:49:43','2026-02-26 09:49:43',1,31,2,'13 norte, 2025'),
(8,'a2','prueba admin 2',12,'','pueba #2','2026-02-26 00:00:00',1,NULL,15,'2026-03-02 00:00:00',0,NULL,0,NULL,'actualizo',NULL,NULL,'aguasanta, 30',-33.02129090,-71.55610010,0,'2026-02-26 09:56:42','2026-02-26 10:07:16',1,32,2,'aguasanta, 30'),
(9,'','prueba admin 3',5,'','pueba de creacion diferenciacion','2026-02-26 00:00:00',1,NULL,13,'2026-03-02 00:00:00',0,NULL,0,NULL,'',NULL,8,'avedmundoeluchans 560',-32.96904600,-71.54052300,0,'2026-02-26 10:30:44','2026-02-26 15:16:40',1,33,0,'avedmundoeluchans 560'),
(10,'123','ramon 123',2,'','este es un plan','2026-02-26 00:00:00',1,NULL,11,'2026-03-02 00:00:00',0,NULL,0,NULL,'este es un comentario',NULL,NULL,NULL,NULL,NULL,0,'2026-02-26 14:57:21','2026-02-26 14:57:21',1,36,2,NULL),
(11,'','prueba mail',1,'','pryeba email','2026-02-27 00:00:00',1,NULL,15,'2026-03-03 00:00:00',0,NULL,0,NULL,'aaa',NULL,NULL,'ecuador , 644',-33.02707300,-71.56066500,0,'2026-02-27 15:49:05','2026-02-27 15:50:03',1,40,1,'ecuador , 644');
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
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_documentos_metadata`
--

LOCK TABLES `trd_documentos_metadata` WRITE;
/*!40000 ALTER TABLE `trd_documentos_metadata` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_documentos_metadata` VALUES
(1,1,'Tamaño','118801',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,1,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,1,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,1,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,1,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,1,'Fecha Subida','2026-02-06 16:47:02',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(7,1,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(8,2,'Tamaño','118801',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(9,2,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(10,2,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(11,2,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(12,2,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(13,2,'Fecha Subida','2026-02-06 17:00:46',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(14,2,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(15,3,'Tamaño','145329',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(16,3,'Tipo MIME','application/vnd.openxmlformats-officedocument.wordprocessingml.document',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(17,3,'Extensión','docx',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(18,3,'Hash SHA256','e8646b2dbbcf0ab4f6c99b23bee910339d7b93ad3082ba6b4082df3b617f8297',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(19,3,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(20,3,'Fecha Subida','2026-02-06 17:05:20',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(21,3,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(22,4,'Tamaño','145329',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(23,4,'Tipo MIME','application/vnd.openxmlformats-officedocument.wordprocessingml.document',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(24,4,'Extensión','docx',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(25,4,'Hash SHA256','e8646b2dbbcf0ab4f6c99b23bee910339d7b93ad3082ba6b4082df3b617f8297',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(26,4,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(27,4,'Fecha Subida','2026-02-06 17:06:43',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(28,4,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(29,5,'Tamaño','118801',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(30,5,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(31,5,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(32,5,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(33,5,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(34,5,'Fecha Subida','2026-02-06 17:11:17',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(35,5,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(36,6,'Tamaño','118801',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(37,6,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(38,6,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(39,6,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(40,6,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(41,6,'Fecha Subida','2026-02-06 17:12:52',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(42,6,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(43,7,'Tamaño','706583',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(44,7,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(45,7,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(46,7,'Hash SHA256','bf405cfbcd6963fe497f426c19d81bb471f9663931c68777711f7debf8f2e245',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(47,7,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(48,7,'Fecha Subida','2026-02-06 17:58:38',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(49,7,'Usuario','3',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(50,8,'Tamaño','118801',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(51,8,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(52,8,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(53,8,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(54,8,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(55,8,'Fecha Subida','2026-02-06 18:00:47',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(56,8,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(57,9,'Tamaño','220367',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(58,9,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(59,9,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(60,9,'Hash SHA256','38e46ea9ef04ab1bdd5e5b21ab8d007fa35508a4e6ced256addc4e9b006d854b',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(61,9,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(62,9,'Fecha Subida','2026-02-10 21:03:40',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(63,9,'Usuario','3',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(64,10,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(65,10,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(66,10,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(67,10,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(68,10,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(69,10,'Fecha Subida','2026-02-13 15:31:59',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(70,10,'Usuario','3',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(71,11,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(72,11,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(73,11,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(74,11,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(75,11,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(76,11,'Fecha Subida','2026-02-13 17:49:37',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(77,11,'Usuario','10',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(78,12,'Tamaño','638796',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(79,12,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(80,12,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(81,12,'Hash SHA256','3c61ac37dffc994cfec493718bf0def0874beec274a74c5605e8de7ce8be276d',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(82,12,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(83,12,'Fecha Subida','2026-02-16 13:55:36',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(84,12,'Usuario','12',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(85,13,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(86,13,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(87,13,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(88,13,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(89,13,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(90,13,'Fecha Subida','2026-02-17 13:52:14',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(91,13,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(92,14,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(93,14,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(94,14,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(95,14,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(96,14,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(97,14,'Fecha Subida','2026-02-17 18:02:08',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(98,14,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(99,15,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(100,15,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(101,15,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(102,15,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(103,15,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(104,15,'Fecha Subida','2026-02-17 18:02:08',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(105,15,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(106,16,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(107,16,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(108,16,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(109,16,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(110,16,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(111,16,'Fecha Subida','2026-02-17 18:04:46',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(112,16,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(113,17,'Tamaño','242586',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(114,17,'Tipo MIME','application/pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(115,17,'Extensión','pdf',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(116,17,'Hash SHA256','36fcf1e047ccbbe00014b9b62696e9d4db27e3e2eb7760197f7eca3637b50d05',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(117,17,'Sistema Origen','GesDoc',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(118,17,'Fecha Subida','2026-02-17 20:04:44',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(119,17,'Usuario','1',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(120,18,'Tamaño','118801',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(121,18,'Tipo MIME','application/pdf',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(122,18,'Extensión','pdf',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(123,18,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(124,18,'Sistema Origen','GesDoc',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(125,18,'Fecha Subida','2026-02-25 15:35:48',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(126,18,'Usuario','1',0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(127,19,'Tamaño','118801',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(128,19,'Tipo MIME','application/pdf',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(129,19,'Extensión','pdf',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(130,19,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(131,19,'Sistema Origen','GesDoc',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(132,19,'Fecha Subida','2026-02-25 15:36:08',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(133,19,'Usuario','1',0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(134,20,'Tamaño','118801',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(135,20,'Tipo MIME','application/pdf',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(136,20,'Extensión','pdf',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(137,20,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(138,20,'Sistema Origen','GesDoc',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(139,20,'Fecha Subida','2026-02-25 15:37:02',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(140,20,'Usuario','1',0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(141,21,'Tamaño','118801',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(142,21,'Tipo MIME','application/pdf',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(143,21,'Extensión','pdf',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(144,21,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(145,21,'Sistema Origen','GesDoc',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(146,21,'Fecha Subida','2026-02-26 13:56:42',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(147,21,'Usuario','1',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(148,22,'Tamaño','145329',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(149,22,'Tipo MIME','application/vnd.openxmlformats-officedocument.wordprocessingml.document',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(150,22,'Extensión','docx',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(151,22,'Hash SHA256','e8646b2dbbcf0ab4f6c99b23bee910339d7b93ad3082ba6b4082df3b617f8297',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(152,22,'Sistema Origen','GesDoc',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(153,22,'Fecha Subida','2026-02-26 13:56:42',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(154,22,'Usuario','1',0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(155,23,'Tamaño','118801',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(156,23,'Tipo MIME','application/pdf',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(157,23,'Extensión','pdf',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(158,23,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(159,23,'Sistema Origen','GesDoc',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(160,23,'Fecha Subida','2026-02-26 17:07:54',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(161,23,'Usuario','11',0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(162,24,'Tamaño','133389',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(163,24,'Tipo MIME','application/pdf',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(164,24,'Extensión','pdf',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(165,24,'Hash SHA256','96a1ab231ca00435da6a144cf33b34e2255287a53ad84f999d23cf8289e6d8af',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(166,24,'Sistema Origen','GesDoc',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(167,24,'Fecha Subida','2026-02-26 18:57:21',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(168,24,'Usuario','1',0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(169,25,'Tamaño','118801',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(170,25,'Tipo MIME','application/pdf',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(171,25,'Extensión','pdf',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(172,25,'Hash SHA256','4569238b6f29cef6ac0e5a0ed52ec6dc6bde3f847197e45b8b476c390537001b',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(173,25,'Sistema Origen','GesDoc',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(174,25,'Fecha Subida','2026-02-27 19:49:05',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(175,25,'Usuario','1',0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(176,26,'Tamaño','47818',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(177,26,'Tipo MIME','application/pdf',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(178,26,'Extensión','pdf',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(179,26,'Hash SHA256','fbca61a8dd111f5b5100fbd4ae676b5b83dda428e34b876be19f31d19648ba38',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(180,26,'Sistema Origen','GesDoc',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(181,26,'Fecha Subida','2026-03-02 19:28:40',0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(182,26,'Usuario','2',0,'2026-03-02 15:28:40','2026-03-02 15:28:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=1177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(602,4,'Ingresa solicitud Ingresos',1,'2026-02-06 11:58:46',0,'2026-02-19 19:44:53'),
(603,4,'Añade comentario al trámite',1,'2026-02-06 12:14:48',0,'2026-02-19 19:44:53'),
(604,4,'Edita: contenido',1,'2026-02-06 12:18:23',0,'2026-02-19 19:44:53'),
(605,4,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-06 13:05:20',0,'2026-02-19 19:44:53'),
(606,5,'Ingresa solicitud Ingresos',1,'2026-02-06 13:06:42',0,'2026-02-19 19:44:53'),
(607,5,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-02-06 13:11:18',0,'2026-02-19 19:44:53'),
(608,6,'Ingresa solicitud Ingresos',1,'2026-02-06 13:12:19',0,'2026-02-19 19:44:53'),
(609,6,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-06 13:12:52',0,'2026-02-19 19:44:53'),
(610,7,'Ingresa solicitud Ingresos',1,'2026-02-06 13:13:41',0,'2026-02-19 19:44:53'),
(611,8,'Ingresa solicitud Ingresos',1,'2026-02-06 13:21:12',0,'2026-02-19 19:44:53'),
(612,9,'Ingresa solicitud Ingresos',3,'2026-02-06 13:58:38',0,'2026-02-19 19:44:53'),
(613,10,'Ingresa solicitud Ingresos',1,'2026-02-06 14:19:15',0,'2026-02-19 19:44:53'),
(614,10,'Solicitud finalizada con estado: Resuelto_Favorable',3,'2026-02-06 15:11:30',0,'2026-02-19 19:44:53'),
(616,11,'Ingresa solicitud Ingresos',3,'2026-02-10 17:03:39',0,'2026-02-19 19:44:53'),
(617,12,'Ingresa solicitud Ingresos',4,'2026-02-12 16:29:57',0,'2026-02-19 19:44:53'),
(618,12,'Añade comentario al trámite',6,'2026-02-12 16:42:48',0,'2026-02-19 19:44:53'),
(619,13,'Ingresa solicitud Ingresos',6,'2026-02-12 16:53:46',0,'2026-02-19 19:44:53'),
(620,13,'Añade comentario al trámite',8,'2026-02-12 17:25:21',0,'2026-02-19 19:44:53'),
(621,12,'Solicitud finalizada con estado: Resuelto_NO_Favorable',6,'2026-02-13 09:55:48',0,'2026-02-19 19:44:53'),
(622,13,'Solicitud finalizada con estado: Resuelto_NO_Favorable',8,'2026-02-13 09:57:55',0,'2026-02-19 19:44:53'),
(623,14,'Ingresa solicitud Ingresos',6,'2026-02-13 10:58:35',0,'2026-02-19 19:44:53'),
(624,14,'Solicitud finalizada con estado: Resuelto_Favorable',1,'2026-02-13 11:01:40',0,'2026-02-19 19:44:53'),
(625,7,'Solicitud finalizada con estado: Resuelto_NO_Favorable',1,'2026-02-13 11:06:36',0,'2026-02-19 19:44:53'),
(626,15,'Ingresa solicitud Ingresos',3,'2026-02-13 11:31:59',0,'2026-02-19 19:44:53'),
(627,16,'Ingresa solicitud Ingresos',6,'2026-02-13 12:08:22',0,'2026-02-19 19:44:53'),
(628,18,'Ingresa solicitud: prueba  perfiles 001',10,'2026-02-13 13:49:37',0,'2026-02-19 19:44:53'),
(629,18,'Consulta solicitud',10,'2026-02-13 13:49:51',0,'2026-02-19 19:44:53'),
(630,18,'Consulta solicitud',10,'2026-02-13 13:50:03',0,'2026-02-19 19:44:53'),
(631,18,'Consulta solicitud',10,'2026-02-13 13:50:33',0,'2026-02-19 19:44:53'),
(632,18,'Consulta solicitud',1,'2026-02-13 13:51:34',0,'2026-02-19 19:44:53'),
(633,18,'Consulta solicitud',10,'2026-02-13 14:11:28',0,'2026-02-19 19:44:53'),
(634,18,'Consulta solicitud',10,'2026-02-13 14:12:09',0,'2026-02-19 19:44:53'),
(635,18,'Consulta solicitud',10,'2026-02-13 14:13:25',0,'2026-02-19 19:44:53'),
(636,18,'Consulta solicitud',10,'2026-02-13 14:20:22',0,'2026-02-19 19:44:53'),
(637,18,'Consulta solicitud',10,'2026-02-13 14:20:47',0,'2026-02-19 19:44:53'),
(638,18,'Consulta solicitud',10,'2026-02-13 14:20:55',0,'2026-02-19 19:44:53'),
(639,18,'Consulta solicitud',10,'2026-02-13 14:21:02',0,'2026-02-19 19:44:53'),
(640,18,'Consulta solicitud',10,'2026-02-13 14:22:01',0,'2026-02-19 19:44:53'),
(641,18,'Consulta solicitud',10,'2026-02-13 14:25:37',0,'2026-02-19 19:44:53'),
(642,18,'Consulta solicitud',10,'2026-02-13 14:26:53',0,'2026-02-19 19:44:53'),
(643,18,'Consulta solicitud',10,'2026-02-13 14:27:14',0,'2026-02-19 19:44:53'),
(644,18,'Consulta solicitud',10,'2026-02-13 14:27:55',0,'2026-02-19 19:44:53'),
(645,18,'Consulta solicitud',10,'2026-02-13 14:29:01',0,'2026-02-19 19:44:53'),
(646,18,'Consulta solicitud',10,'2026-02-13 14:29:18',0,'2026-02-19 19:44:53'),
(647,18,'Consulta solicitud',10,'2026-02-13 14:31:57',0,'2026-02-19 19:44:53'),
(648,18,'Consulta solicitud',10,'2026-02-13 14:34:02',0,'2026-02-19 19:44:53'),
(649,18,'Añade comentario al trámite',10,'2026-02-13 14:36:53',0,'2026-02-19 19:44:53'),
(650,18,'Consulta solicitud',10,'2026-02-13 14:36:54',0,'2026-02-19 19:44:53'),
(651,18,'Consulta solicitud',10,'2026-02-13 15:04:58',0,'2026-02-19 19:44:53'),
(652,18,'Consulta solicitud',10,'2026-02-13 15:07:27',0,'2026-02-19 19:44:53'),
(653,18,'Consulta solicitud',10,'2026-02-13 15:14:34',0,'2026-02-19 19:44:53'),
(654,18,'Consulta solicitud',10,'2026-02-13 15:14:59',0,'2026-02-19 19:44:53'),
(655,18,'Consulta solicitud',10,'2026-02-13 15:16:06',0,'2026-02-19 19:44:53'),
(656,18,'Consulta solicitud',10,'2026-02-13 15:18:40',0,'2026-02-19 19:44:53'),
(657,18,'Consulta solicitud',10,'2026-02-13 15:19:09',0,'2026-02-19 19:44:53'),
(658,18,'Consulta solicitud',10,'2026-02-13 15:22:53',0,'2026-02-19 19:44:53'),
(659,18,'Consulta solicitud',1,'2026-02-13 15:23:10',0,'2026-02-19 19:44:53'),
(660,18,'Consulta solicitud',1,'2026-02-13 15:23:15',0,'2026-02-19 19:44:53'),
(661,18,'Consulta solicitud',1,'2026-02-13 15:23:28',0,'2026-02-19 19:44:53'),
(662,18,'Consulta solicitud',1,'2026-02-13 15:24:23',0,'2026-02-19 19:44:53'),
(663,18,'Consulta solicitud',1,'2026-02-13 15:25:29',0,'2026-02-19 19:44:53'),
(664,18,'Consulta solicitud',1,'2026-02-13 15:28:31',0,'2026-02-19 19:44:53'),
(665,18,'Añade comentario al trámite',1,'2026-02-13 15:28:36',0,'2026-02-19 19:44:53'),
(666,18,'Consulta solicitud',1,'2026-02-13 15:28:39',0,'2026-02-19 19:44:53'),
(667,18,'Consulta solicitud',1,'2026-02-13 15:28:48',0,'2026-02-19 19:44:53'),
(668,18,'Añade comentario al trámite',1,'2026-02-13 15:28:52',0,'2026-02-19 19:44:53'),
(669,18,'Consulta solicitud',1,'2026-02-13 15:28:53',0,'2026-02-19 19:44:53'),
(670,18,'Consulta solicitud',10,'2026-02-13 15:30:15',0,'2026-02-19 19:44:53'),
(671,18,'Consulta solicitud',10,'2026-02-13 15:30:24',0,'2026-02-19 19:44:53'),
(672,18,'Consulta solicitud',1,'2026-02-13 15:30:39',0,'2026-02-19 19:44:53'),
(673,18,'Consulta solicitud',1,'2026-02-13 15:30:47',0,'2026-02-19 19:44:53'),
(674,18,'Consulta solicitud',10,'2026-02-13 15:30:54',0,'2026-02-19 19:44:53'),
(675,18,'Consulta solicitud',10,'2026-02-13 15:33:07',0,'2026-02-19 19:44:53'),
(676,18,'Consulta solicitud',1,'2026-02-13 15:33:18',0,'2026-02-19 19:44:53'),
(677,18,'Consulta solicitud',1,'2026-02-13 15:34:30',0,'2026-02-19 19:44:53'),
(678,18,'Consulta solicitud',10,'2026-02-13 15:34:41',0,'2026-02-19 19:44:53'),
(679,18,'Consulta solicitud',1,'2026-02-13 15:35:23',0,'2026-02-19 19:44:53'),
(680,18,'Consulta solicitud',1,'2026-02-13 15:37:16',0,'2026-02-19 19:44:53'),
(681,18,'Consulta solicitud',1,'2026-02-13 15:37:25',0,'2026-02-19 19:44:53'),
(682,18,'Consulta solicitud',1,'2026-02-13 15:37:35',0,'2026-02-19 19:44:53'),
(683,18,'Consulta solicitud',10,'2026-02-13 15:37:43',0,'2026-02-19 19:44:53'),
(684,18,'Consulta solicitud',1,'2026-02-13 15:39:17',0,'2026-02-19 19:44:53'),
(685,18,'Consulta solicitud',10,'2026-02-13 15:39:41',0,'2026-02-19 19:44:53'),
(686,18,'Consulta solicitud',10,'2026-02-13 15:39:44',0,'2026-02-19 19:44:53'),
(687,18,'Consulta solicitud',10,'2026-02-13 15:40:21',0,'2026-02-19 19:44:53'),
(688,18,'Consulta solicitud',1,'2026-02-13 15:40:29',0,'2026-02-19 19:44:53'),
(689,18,'Consulta solicitud',10,'2026-02-13 15:41:05',0,'2026-02-19 19:44:53'),
(690,18,'Consulta solicitud',10,'2026-02-13 15:41:32',0,'2026-02-19 19:44:53'),
(691,18,'Consulta solicitud',1,'2026-02-13 15:41:41',0,'2026-02-19 19:44:53'),
(692,18,'Consulta solicitud',1,'2026-02-13 15:41:43',0,'2026-02-19 19:44:53'),
(693,18,'Consulta solicitud',1,'2026-02-13 15:41:49',0,'2026-02-19 19:44:53'),
(694,18,'Consulta solicitud',1,'2026-02-13 15:41:51',0,'2026-02-19 19:44:53'),
(695,18,'Responde solicitud',1,'2026-02-13 15:42:00',0,'2026-02-19 19:44:53'),
(696,18,'Consulta solicitud',10,'2026-02-13 15:42:12',0,'2026-02-19 19:44:53'),
(697,18,'Consulta solicitud',10,'2026-02-13 15:42:19',0,'2026-02-19 19:44:53'),
(698,18,'Consulta solicitud',10,'2026-02-13 15:42:23',0,'2026-02-19 19:44:53'),
(699,18,'Consulta solicitud',10,'2026-02-13 15:42:48',0,'2026-02-19 19:44:53'),
(700,18,'Consulta solicitud',10,'2026-02-13 15:44:48',0,'2026-02-19 19:44:53'),
(701,18,'Consulta solicitud',10,'2026-02-13 15:44:53',0,'2026-02-19 19:44:53'),
(702,18,'Consulta solicitud',1,'2026-02-13 15:59:43',0,'2026-02-19 19:44:53'),
(703,18,'Consulta solicitud',10,'2026-02-13 15:59:59',0,'2026-02-19 19:44:53'),
(704,18,'Consulta solicitud',10,'2026-02-13 16:00:12',0,'2026-02-19 19:44:53'),
(705,18,'Consulta solicitud',1,'2026-02-13 16:01:14',0,'2026-02-19 19:44:53'),
(706,18,'Consulta solicitud',1,'2026-02-13 16:05:32',0,'2026-02-19 19:44:53'),
(707,18,'Consulta solicitud',1,'2026-02-13 16:05:51',0,'2026-02-19 19:44:53'),
(708,18,'Consulta solicitud',1,'2026-02-13 16:06:04',0,'2026-02-19 19:44:53'),
(709,18,'Consulta solicitud',10,'2026-02-13 16:10:28',0,'2026-02-19 19:44:53'),
(710,18,'Consulta solicitud',10,'2026-02-13 16:10:58',0,'2026-02-19 19:44:53'),
(711,18,'Consulta solicitud',10,'2026-02-13 16:12:23',0,'2026-02-19 19:44:53'),
(712,18,'Consulta solicitud',10,'2026-02-13 16:18:28',0,'2026-02-19 19:44:53'),
(713,18,'Consulta solicitud',10,'2026-02-13 16:18:32',0,'2026-02-19 19:44:53'),
(714,18,'Consulta solicitud',10,'2026-02-13 16:20:41',0,'2026-02-19 19:44:53'),
(715,18,'Consulta solicitud',10,'2026-02-13 16:21:08',0,'2026-02-19 19:44:53'),
(716,18,'Consulta solicitud',10,'2026-02-13 16:21:18',0,'2026-02-19 19:44:53'),
(717,18,'Consulta solicitud',10,'2026-02-13 16:21:43',0,'2026-02-19 19:44:53'),
(718,18,'Consulta solicitud',10,'2026-02-13 16:21:49',0,'2026-02-19 19:44:53'),
(719,18,'Consulta solicitud',10,'2026-02-16 09:13:39',0,'2026-02-19 19:44:53'),
(720,19,'Ingresa solicitud: PRUEBA DESVE 001',1,'2026-02-16 09:53:15',0,'2026-02-19 19:44:53'),
(721,19,'Consulta solicitud',12,'2026-02-16 09:53:27',0,'2026-02-19 19:44:53'),
(722,19,'Consulta solicitud',12,'2026-02-16 09:54:03',0,'2026-02-19 19:44:53'),
(723,19,'Consulta solicitud',12,'2026-02-16 09:54:06',0,'2026-02-19 19:44:53'),
(724,19,'Consulta solicitud',12,'2026-02-16 09:54:08',0,'2026-02-19 19:44:53'),
(725,19,'Consulta solicitud',12,'2026-02-16 09:54:16',0,'2026-02-19 19:44:53'),
(726,19,'Consulta solicitud',12,'2026-02-16 09:54:18',0,'2026-02-19 19:44:53'),
(727,19,'Consulta solicitud',12,'2026-02-16 09:54:20',0,'2026-02-19 19:44:53'),
(728,19,'Consulta solicitud',12,'2026-02-16 09:54:28',0,'2026-02-19 19:44:53'),
(729,19,'Consulta solicitud',12,'2026-02-16 09:54:30',0,'2026-02-19 19:44:53'),
(730,19,'Añade comentario al trámite',12,'2026-02-16 09:54:58',0,'2026-02-19 19:44:53'),
(731,19,'Consulta solicitud',12,'2026-02-16 09:54:59',0,'2026-02-19 19:44:53'),
(732,19,'Responde solicitud',12,'2026-02-16 09:55:36',0,'2026-02-19 19:44:53'),
(733,19,'Consulta solicitud',1,'2026-02-16 09:55:46',0,'2026-02-19 19:44:53'),
(734,19,'Añade comentario al trámite',1,'2026-02-16 09:56:04',0,'2026-02-19 19:44:53'),
(735,19,'Consulta solicitud',1,'2026-02-16 09:56:04',0,'2026-02-19 19:44:53'),
(736,19,'Consulta solicitud',12,'2026-02-16 09:56:12',0,'2026-02-19 19:44:53'),
(737,19,'Consulta solicitud',12,'2026-02-16 09:56:19',0,'2026-02-19 19:44:53'),
(738,19,'Responde solicitud',12,'2026-02-16 09:56:27',0,'2026-02-19 19:44:53'),
(739,19,'Consulta solicitud',1,'2026-02-16 09:56:37',0,'2026-02-19 19:44:53'),
(740,19,'Consulta solicitud',1,'2026-02-16 09:56:52',0,'2026-02-19 19:44:53'),
(741,19,'Consulta solicitud',1,'2026-02-16 09:57:07',0,'2026-02-19 19:44:53'),
(742,19,'Consulta solicitud',1,'2026-02-16 09:57:17',0,'2026-02-19 19:44:53'),
(743,19,'Consulta solicitud',1,'2026-02-16 10:02:14',0,'2026-02-19 19:44:53'),
(744,19,'Consulta solicitud',1,'2026-02-16 10:02:19',0,'2026-02-19 19:44:53'),
(745,19,'Consulta solicitud',1,'2026-02-16 10:04:23',0,'2026-02-19 19:44:53'),
(746,19,'Consulta solicitud',1,'2026-02-16 10:06:48',0,'2026-02-19 19:44:53'),
(747,19,'Consulta solicitud',1,'2026-02-16 10:08:01',0,'2026-02-19 19:44:53'),
(748,19,'Consulta solicitud',1,'2026-02-16 10:08:12',0,'2026-02-19 19:44:53'),
(749,19,'Consulta solicitud',1,'2026-02-16 10:11:44',0,'2026-02-19 19:44:53'),
(750,19,'Consulta solicitud',1,'2026-02-16 10:17:28',0,'2026-02-19 19:44:53'),
(751,19,'Consulta solicitud',1,'2026-02-16 10:19:43',0,'2026-02-19 19:44:53'),
(752,19,'Consulta solicitud',1,'2026-02-16 10:20:01',0,'2026-02-19 19:44:53'),
(753,19,'Consulta solicitud',1,'2026-02-16 10:20:06',0,'2026-02-19 19:44:53'),
(754,19,'Consulta solicitud',1,'2026-02-16 13:04:03',0,'2026-02-19 19:44:53'),
(755,20,'Ingresa solicitud OIRS',1,'2026-02-17 09:52:14',0,'2026-02-19 19:44:53'),
(756,20,'Ingresa respuesta técnica OIRS',1,'2026-02-17 15:01:49',0,'2026-02-19 19:44:53'),
(757,20,'Asignación de OIRS (Funcionario ID: 2)',1,'2026-02-17 15:12:34',0,'2026-02-19 19:44:53'),
(758,20,'Ingresa respuesta técnica OIRS',1,'2026-02-17 15:13:03',0,'2026-02-19 19:44:53'),
(759,21,'Ingresa solicitud OIRS',1,'2026-02-17 16:04:44',0,'2026-02-19 19:44:53'),
(760,21,'Carga de documento Público: 2512012877.pdf',1,'2026-02-17 16:04:44',0,'2026-02-19 19:44:53'),
(761,21,'Ingresa respuesta preliminar OIRS',1,'2026-02-17 16:07:14',0,'2026-02-19 19:44:53'),
(762,22,'Ingresa solicitud Ingresos',1,'2026-02-18 10:16:07',0,'2026-02-19 19:44:53'),
(763,23,'Ingresa solicitud Ingresos',1,'2026-02-18 10:16:17',0,'2026-02-19 19:44:53'),
(764,24,'Ingresa solicitud Ingresos',1,'2026-02-18 10:16:24',0,'2026-02-19 19:44:53'),
(765,25,'Ingresa solicitud Ingresos',1,'2026-02-18 10:18:52',0,'2026-02-19 19:44:53'),
(766,25,'Consulta detalles de solicitud',1,'2026-02-20 11:16:29',0,'2026-02-20 11:16:29'),
(767,25,'Consulta detalles de solicitud',1,'2026-02-23 08:51:15',0,'2026-02-23 08:51:15'),
(768,25,'Consulta detalles de solicitud',1,'2026-02-23 08:51:35',0,'2026-02-23 08:51:35'),
(769,25,'Consulta detalles de solicitud',1,'2026-02-23 09:09:14',0,'2026-02-23 09:09:14'),
(770,25,'Consulta detalles de solicitud',1,'2026-02-23 09:09:31',0,'2026-02-23 09:09:31'),
(771,15,'Consulta detalles de solicitud',1,'2026-02-23 09:09:48',0,'2026-02-23 09:09:48'),
(772,15,'Consulta detalles de solicitud',1,'2026-02-23 09:10:02',0,'2026-02-23 09:10:02'),
(773,15,'Consulta detalles de solicitud',1,'2026-02-23 09:10:05',0,'2026-02-23 09:10:05'),
(774,21,'Ingresa respuesta preliminar OIRS',1,'2026-02-23 12:29:57',0,'2026-02-23 12:29:57'),
(775,26,'Ingresa solicitud OIRS',1,'2026-02-23 13:57:05',0,'2026-02-23 13:57:05'),
(776,26,'Ingresa respuesta técnica OIRS',1,'2026-02-23 14:37:39',0,'2026-02-23 14:37:39'),
(777,26,'Asignación de OIRS (Funcionario ID: 10)',1,'2026-02-23 14:54:54',0,'2026-02-23 14:54:54'),
(778,27,'Ingresa solicitud: REFUERZO DE EXPEDIENTE',10,'2026-02-23 16:30:24',0,'2026-02-23 16:30:24'),
(779,27,'Consulta solicitud',10,'2026-02-23 16:35:28',0,'2026-02-23 16:35:28'),
(780,27,'Consulta solicitud',10,'2026-02-23 16:35:41',0,'2026-02-23 16:35:41'),
(781,27,'Consulta solicitud',10,'2026-02-23 16:36:21',0,'2026-02-23 16:36:21'),
(782,27,'Consulta solicitud',10,'2026-02-23 17:44:18',0,'2026-02-23 17:44:18'),
(783,27,'Consulta solicitud',10,'2026-02-24 09:10:01',0,'2026-02-24 09:10:01'),
(784,27,'Consulta solicitud',10,'2026-02-24 09:42:05',0,'2026-02-24 09:42:05'),
(785,27,'Consulta solicitud',9,'2026-02-24 09:46:13',0,'2026-02-24 09:46:13'),
(786,27,'Consulta solicitud',9,'2026-02-24 09:46:14',0,'2026-02-24 09:46:14'),
(787,27,'Consulta solicitud',9,'2026-02-24 11:42:39',0,'2026-02-24 11:42:39'),
(788,27,'Consulta solicitud',9,'2026-02-24 16:31:29',0,'2026-02-24 16:31:29'),
(789,27,'Consulta solicitud',9,'2026-02-25 09:35:22',0,'2026-02-25 09:35:22'),
(790,27,'Consulta solicitud',9,'2026-02-25 09:36:45',0,'2026-02-25 09:36:45'),
(791,27,'Consulta solicitud',9,'2026-02-25 09:36:54',0,'2026-02-25 09:36:54'),
(792,27,'Consulta solicitud',9,'2026-02-25 09:46:07',0,'2026-02-25 09:46:07'),
(793,27,'Consulta solicitud',9,'2026-02-25 09:47:11',0,'2026-02-25 09:47:11'),
(794,27,'Consulta solicitud',9,'2026-02-25 09:47:20',0,'2026-02-25 09:47:20'),
(795,27,'Consulta solicitud',9,'2026-02-25 09:47:33',0,'2026-02-25 09:47:33'),
(796,27,'Consulta solicitud',9,'2026-02-25 09:51:41',0,'2026-02-25 09:51:41'),
(797,27,'Consulta solicitud',9,'2026-02-25 09:52:41',0,'2026-02-25 09:52:41'),
(798,27,'Consulta solicitud',10,'2026-02-25 09:55:00',0,'2026-02-25 09:55:00'),
(799,27,'Consulta solicitud',10,'2026-02-25 09:55:16',0,'2026-02-25 09:55:16'),
(800,27,'Consulta solicitud',10,'2026-02-25 09:55:22',0,'2026-02-25 09:55:22'),
(801,27,'Consulta solicitud',10,'2026-02-25 09:55:23',0,'2026-02-25 09:55:23'),
(802,27,'Consulta solicitud',3,'2026-02-25 10:09:28',0,'2026-02-25 10:09:28'),
(803,27,'Consulta solicitud',3,'2026-02-25 10:13:02',0,'2026-02-25 10:13:02'),
(804,27,'Consulta solicitud',9,'2026-02-25 11:25:38',0,'2026-02-25 11:25:38'),
(805,27,'Consulta solicitud',9,'2026-02-25 11:25:58',0,'2026-02-25 11:25:58'),
(806,27,'Consulta solicitud',9,'2026-02-25 11:25:59',0,'2026-02-25 11:25:59'),
(807,27,'Consulta solicitud',9,'2026-02-25 11:28:21',0,'2026-02-25 11:28:21'),
(808,27,'Consulta solicitud',3,'2026-02-25 11:29:12',0,'2026-02-25 11:29:12'),
(809,27,'Consulta solicitud',3,'2026-02-25 11:29:16',0,'2026-02-25 11:29:16'),
(810,27,'Consulta solicitud',3,'2026-02-25 11:29:33',0,'2026-02-25 11:29:33'),
(811,27,'Consulta solicitud',3,'2026-02-25 11:29:42',0,'2026-02-25 11:29:42'),
(812,27,'Consulta solicitud',3,'2026-02-25 11:32:53',0,'2026-02-25 11:32:53'),
(813,27,'Consulta solicitud',3,'2026-02-25 11:33:20',0,'2026-02-25 11:33:20'),
(814,27,'Consulta solicitud',3,'2026-02-25 11:33:21',0,'2026-02-25 11:33:21'),
(815,28,'Ingresa solicitud: REFUERZO DE EXPEDIENTE',1,'2026-02-25 11:35:48',0,'2026-02-25 11:35:48'),
(816,28,'Carga de documento Público: certificado pisee1.pdf',1,'2026-02-25 11:35:48',0,'2026-02-25 11:35:48'),
(817,28,'Consulta solicitud',3,'2026-02-25 11:36:06',0,'2026-02-25 11:36:06'),
(818,29,'Ingresa solicitud: REFUERZO DE EXPEDIENTE',1,'2026-02-25 11:36:08',0,'2026-02-25 11:36:08'),
(819,29,'Carga de documento Público: certificado pisee1.pdf',1,'2026-02-25 11:36:08',0,'2026-02-25 11:36:08'),
(820,30,'Ingresa solicitud: REFUERZO DE EXPEDIENTE',1,'2026-02-25 11:37:02',0,'2026-02-25 11:37:02'),
(821,30,'Carga de documento Público: certificado pisee1.pdf',1,'2026-02-25 11:37:02',0,'2026-02-25 11:37:02'),
(822,28,'Consulta solicitud',1,'2026-02-25 11:37:26',0,'2026-02-25 11:37:26'),
(823,28,'Consulta solicitud',1,'2026-02-25 11:37:28',0,'2026-02-25 11:37:28'),
(824,28,'Consulta solicitud',1,'2026-02-25 11:37:56',0,'2026-02-25 11:37:56'),
(825,30,'Consulta solicitud',1,'2026-02-25 11:38:35',0,'2026-02-25 11:38:35'),
(826,28,'Consulta solicitud',1,'2026-02-25 11:38:49',0,'2026-02-25 11:38:49'),
(827,28,'Consulta solicitud',1,'2026-02-25 11:46:39',0,'2026-02-25 11:46:39'),
(828,28,'Consulta solicitud',1,'2026-02-25 11:46:41',0,'2026-02-25 11:46:41'),
(829,28,'Consulta solicitud',1,'2026-02-25 11:49:40',0,'2026-02-25 11:49:40'),
(830,28,'Consulta solicitud',1,'2026-02-25 11:56:12',0,'2026-02-25 11:56:12'),
(831,28,'Consulta solicitud',1,'2026-02-25 11:58:37',0,'2026-02-25 11:58:37'),
(832,28,'Añade comentario al trámite',1,'2026-02-25 11:58:55',0,'2026-02-25 11:58:55'),
(833,28,'Consulta solicitud',1,'2026-02-25 11:58:56',0,'2026-02-25 11:58:56'),
(834,28,'Consulta solicitud',1,'2026-02-25 11:59:49',0,'2026-02-25 11:59:49'),
(835,28,'Consulta solicitud',1,'2026-02-25 12:00:54',0,'2026-02-25 12:00:54'),
(836,28,'Consulta solicitud',1,'2026-02-25 12:03:10',0,'2026-02-25 12:03:10'),
(837,28,'Consulta solicitud',1,'2026-02-25 12:03:52',0,'2026-02-25 12:03:52'),
(838,28,'Consulta solicitud',1,'2026-02-25 12:07:40',0,'2026-02-25 12:07:40'),
(839,28,'Consulta solicitud',1,'2026-02-25 12:09:19',0,'2026-02-25 12:09:19'),
(840,28,'Consulta solicitud',1,'2026-02-25 12:10:30',0,'2026-02-25 12:10:30'),
(841,28,'Consulta solicitud',1,'2026-02-25 12:10:47',0,'2026-02-25 12:10:47'),
(842,28,'Consulta solicitud',1,'2026-02-25 12:11:27',0,'2026-02-25 12:11:27'),
(843,28,'Consulta solicitud',1,'2026-02-25 12:11:55',0,'2026-02-25 12:11:55'),
(844,28,'Consulta solicitud',1,'2026-02-25 12:11:59',0,'2026-02-25 12:11:59'),
(845,28,'Consulta solicitud',1,'2026-02-25 12:12:15',0,'2026-02-25 12:12:15'),
(846,28,'Consulta solicitud',1,'2026-02-25 12:14:10',0,'2026-02-25 12:14:10'),
(847,30,'Consulta solicitud',9,'2026-02-25 12:17:23',0,'2026-02-25 12:17:23'),
(848,30,'Consulta solicitud',1,'2026-02-25 12:17:54',0,'2026-02-25 12:17:54'),
(849,30,'Consulta solicitud',1,'2026-02-25 12:19:33',0,'2026-02-25 12:19:33'),
(850,30,'Consulta solicitud',1,'2026-02-25 12:19:50',0,'2026-02-25 12:19:50'),
(851,30,'Consulta solicitud',1,'2026-02-25 12:27:00',0,'2026-02-25 12:27:00'),
(852,30,'Consulta solicitud',1,'2026-02-25 12:27:24',0,'2026-02-25 12:27:24'),
(853,30,'Consulta solicitud',1,'2026-02-25 12:28:24',0,'2026-02-25 12:28:24'),
(854,30,'Consulta solicitud',1,'2026-02-25 12:28:38',0,'2026-02-25 12:28:38'),
(855,30,'Consulta solicitud',1,'2026-02-25 12:28:47',0,'2026-02-25 12:28:47'),
(856,30,'Consulta solicitud',1,'2026-02-25 12:30:55',0,'2026-02-25 12:30:55'),
(857,30,'Consulta solicitud',1,'2026-02-25 12:34:58',0,'2026-02-25 12:34:58'),
(858,30,'Consulta solicitud',1,'2026-02-25 12:38:24',0,'2026-02-25 12:38:24'),
(859,30,'Consulta solicitud',1,'2026-02-25 12:38:37',0,'2026-02-25 12:38:37'),
(860,30,'Consulta solicitud',1,'2026-02-25 12:39:11',0,'2026-02-25 12:39:11'),
(861,30,'Consulta solicitud',1,'2026-02-25 12:39:31',0,'2026-02-25 12:39:31'),
(862,30,'Consulta solicitud',1,'2026-02-25 12:39:43',0,'2026-02-25 12:39:43'),
(863,30,'Consulta solicitud',1,'2026-02-25 12:39:58',0,'2026-02-25 12:39:58'),
(864,30,'Consulta solicitud',1,'2026-02-25 12:43:41',0,'2026-02-25 12:43:41'),
(865,30,'Consulta solicitud',1,'2026-02-25 12:44:45',0,'2026-02-25 12:44:45'),
(866,30,'Consulta solicitud',1,'2026-02-25 12:45:32',0,'2026-02-25 12:45:32'),
(867,30,'Consulta solicitud',1,'2026-02-25 12:47:56',0,'2026-02-25 12:47:56'),
(868,30,'Consulta solicitud',1,'2026-02-25 12:49:10',0,'2026-02-25 12:49:10'),
(869,30,'Consulta solicitud',1,'2026-02-25 12:49:29',0,'2026-02-25 12:49:29'),
(870,30,'Consulta solicitud',1,'2026-02-25 12:49:34',0,'2026-02-25 12:49:34'),
(871,30,'Consulta solicitud',1,'2026-02-25 12:49:50',0,'2026-02-25 12:49:50'),
(872,30,'Consulta solicitud',1,'2026-02-25 12:53:49',0,'2026-02-25 12:53:49'),
(873,30,'Consulta solicitud',1,'2026-02-25 12:59:28',0,'2026-02-25 12:59:28'),
(874,30,'Consulta solicitud',1,'2026-02-25 13:00:14',0,'2026-02-25 13:00:14'),
(875,30,'Consulta solicitud',1,'2026-02-25 13:03:49',0,'2026-02-25 13:03:49'),
(876,28,'Consulta solicitud',1,'2026-02-25 13:04:08',0,'2026-02-25 13:04:08'),
(877,30,'Consulta solicitud',1,'2026-02-25 13:04:28',0,'2026-02-25 13:04:28'),
(878,28,'Consulta solicitud',1,'2026-02-25 13:07:44',0,'2026-02-25 13:07:44'),
(879,28,'Consulta solicitud',1,'2026-02-25 13:08:09',0,'2026-02-25 13:08:09'),
(880,28,'Consulta solicitud',1,'2026-02-25 13:08:18',0,'2026-02-25 13:08:18'),
(881,28,'Consulta solicitud',1,'2026-02-25 13:08:33',0,'2026-02-25 13:08:33'),
(882,28,'Consulta solicitud',1,'2026-02-25 13:12:53',0,'2026-02-25 13:12:53'),
(883,28,'Consulta solicitud',1,'2026-02-25 13:14:41',0,'2026-02-25 13:14:41'),
(884,28,'Consulta solicitud',1,'2026-02-25 13:16:26',0,'2026-02-25 13:16:26'),
(885,28,'Consulta solicitud',1,'2026-02-25 13:17:04',0,'2026-02-25 13:17:04'),
(886,28,'Consulta solicitud',1,'2026-02-25 13:19:51',0,'2026-02-25 13:19:51'),
(887,28,'Consulta solicitud',1,'2026-02-25 13:23:36',0,'2026-02-25 13:23:36'),
(888,28,'Consulta solicitud',1,'2026-02-25 13:26:32',0,'2026-02-25 13:26:32'),
(889,28,'Consulta solicitud',1,'2026-02-25 13:27:15',0,'2026-02-25 13:27:15'),
(890,28,'Consulta solicitud',1,'2026-02-25 13:35:34',0,'2026-02-25 13:35:34'),
(891,28,'Consulta solicitud',1,'2026-02-25 13:36:51',0,'2026-02-25 13:36:51'),
(892,28,'Consulta solicitud',1,'2026-02-25 13:40:08',0,'2026-02-25 13:40:08'),
(893,28,'Consulta solicitud',1,'2026-02-25 13:41:39',0,'2026-02-25 13:41:39'),
(894,28,'Consulta solicitud',1,'2026-02-25 13:43:18',0,'2026-02-25 13:43:18'),
(895,28,'Consulta solicitud',1,'2026-02-25 13:47:46',0,'2026-02-25 13:47:46'),
(896,28,'Consulta solicitud',1,'2026-02-25 13:47:54',0,'2026-02-25 13:47:54'),
(897,28,'Consulta solicitud',1,'2026-02-25 13:51:02',0,'2026-02-25 13:51:02'),
(898,28,'Consulta solicitud',1,'2026-02-25 13:51:16',0,'2026-02-25 13:51:16'),
(899,28,'Consulta solicitud',1,'2026-02-25 13:51:51',0,'2026-02-25 13:51:51'),
(900,28,'Consulta solicitud',1,'2026-02-25 13:52:34',0,'2026-02-25 13:52:34'),
(901,28,'Consulta solicitud',1,'2026-02-25 13:52:58',0,'2026-02-25 13:52:58'),
(902,28,'Consulta solicitud',1,'2026-02-25 13:53:38',0,'2026-02-25 13:53:38'),
(903,28,'Consulta solicitud',1,'2026-02-25 13:53:40',0,'2026-02-25 13:53:40'),
(904,28,'Consulta solicitud',1,'2026-02-25 13:54:20',0,'2026-02-25 13:54:20'),
(905,28,'Consulta solicitud',1,'2026-02-25 13:54:27',0,'2026-02-25 13:54:27'),
(906,28,'Consulta solicitud',1,'2026-02-25 13:55:25',0,'2026-02-25 13:55:25'),
(907,28,'Consulta solicitud',1,'2026-02-25 13:55:27',0,'2026-02-25 13:55:27'),
(908,28,'Consulta solicitud',1,'2026-02-25 13:55:41',0,'2026-02-25 13:55:41'),
(909,28,'Consulta solicitud',1,'2026-02-25 13:55:45',0,'2026-02-25 13:55:45'),
(910,28,'Consulta solicitud',1,'2026-02-25 14:20:48',0,'2026-02-25 14:20:48'),
(911,28,'Consulta solicitud',1,'2026-02-25 14:29:39',0,'2026-02-25 14:29:39'),
(912,28,'Consulta solicitud',1,'2026-02-25 14:59:21',0,'2026-02-25 14:59:21'),
(913,28,'Consulta solicitud',1,'2026-02-25 14:59:50',0,'2026-02-25 14:59:50'),
(914,28,'Consulta solicitud',1,'2026-02-25 15:04:16',0,'2026-02-25 15:04:16'),
(915,28,'Consulta solicitud',1,'2026-02-25 15:04:21',0,'2026-02-25 15:04:21'),
(916,28,'Consulta solicitud',1,'2026-02-25 15:04:30',0,'2026-02-25 15:04:30'),
(917,28,'Consulta solicitud',1,'2026-02-25 15:05:21',0,'2026-02-25 15:05:21'),
(918,28,'Consulta solicitud',1,'2026-02-25 15:05:26',0,'2026-02-25 15:05:26'),
(919,28,'Consulta solicitud',1,'2026-02-25 15:05:32',0,'2026-02-25 15:05:32'),
(920,28,'Consulta solicitud',1,'2026-02-25 15:13:47',0,'2026-02-25 15:13:47'),
(921,19,'Consulta solicitud',1,'2026-02-25 15:52:48',0,'2026-02-25 15:52:48'),
(922,19,'Consulta solicitud',1,'2026-02-25 15:53:01',0,'2026-02-25 15:53:01'),
(923,19,'Consulta solicitud',1,'2026-02-25 15:53:03',0,'2026-02-25 15:53:03'),
(924,19,'Consulta solicitud',1,'2026-02-25 15:53:07',0,'2026-02-25 15:53:07'),
(925,28,'Consulta solicitud',1,'2026-02-25 15:55:27',0,'2026-02-25 15:55:27'),
(926,28,'Consulta solicitud',1,'2026-02-25 15:55:30',0,'2026-02-25 15:55:30'),
(927,28,'Consulta solicitud',2,'2026-02-25 15:56:20',0,'2026-02-25 15:56:20'),
(928,28,'Consulta solicitud',2,'2026-02-25 15:56:28',0,'2026-02-25 15:56:28'),
(929,28,'Consulta solicitud',1,'2026-02-25 15:58:03',0,'2026-02-25 15:58:03'),
(930,28,'Consulta solicitud',1,'2026-02-25 15:58:10',0,'2026-02-25 15:58:10'),
(931,28,'Consulta solicitud',1,'2026-02-25 16:02:47',0,'2026-02-25 16:02:47'),
(932,28,'Consulta solicitud',2,'2026-02-25 16:03:03',0,'2026-02-25 16:03:03'),
(933,28,'Consulta solicitud',1,'2026-02-25 16:04:05',0,'2026-02-25 16:04:05'),
(934,28,'Consulta solicitud',2,'2026-02-25 16:05:33',0,'2026-02-25 16:05:33'),
(935,28,'Responde solicitud',2,'2026-02-25 16:06:17',0,'2026-02-25 16:06:17'),
(936,28,'Consulta solicitud',1,'2026-02-25 16:06:37',0,'2026-02-25 16:06:37'),
(937,28,'Consulta solicitud',1,'2026-02-25 16:09:59',0,'2026-02-25 16:09:59'),
(938,28,'Consulta solicitud',1,'2026-02-26 09:32:34',0,'2026-02-26 09:32:34'),
(939,28,'Consulta solicitud',1,'2026-02-26 09:32:36',0,'2026-02-26 09:32:36'),
(940,28,'Consulta solicitud',1,'2026-02-26 09:33:00',0,'2026-02-26 09:33:00'),
(941,28,'Consulta solicitud',1,'2026-02-26 09:33:17',0,'2026-02-26 09:33:17'),
(942,28,'Consulta solicitud',1,'2026-02-26 09:33:22',0,'2026-02-26 09:33:22'),
(943,28,'Consulta solicitud',1,'2026-02-26 09:33:25',0,'2026-02-26 09:33:25'),
(944,28,'Consulta solicitud',1,'2026-02-26 09:43:46',0,'2026-02-26 09:43:46'),
(945,31,'Ingresa solicitud: Prueba admin 1',1,'2026-02-26 09:49:43',0,'2026-02-26 09:49:43'),
(946,31,'Consulta solicitud',1,'2026-02-26 09:52:40',0,'2026-02-26 09:52:40'),
(947,32,'Ingresa solicitud: prueba admin 2',1,'2026-02-26 09:56:42',0,'2026-02-26 09:56:42'),
(948,32,'Carga de documento Público: certificado pisee1.pdf',1,'2026-02-26 09:56:42',0,'2026-02-26 09:56:42'),
(949,32,'Carga de documento Público: Doc1.docx',1,'2026-02-26 09:56:42',0,'2026-02-26 09:56:42'),
(950,32,'Consulta solicitud',2,'2026-02-26 09:59:48',0,'2026-02-26 09:59:48'),
(951,32,'Consulta solicitud',2,'2026-02-26 10:00:21',0,'2026-02-26 10:00:21'),
(952,32,'Consulta solicitud',2,'2026-02-26 10:00:31',0,'2026-02-26 10:00:31'),
(953,32,'Consulta solicitud',2,'2026-02-26 10:00:34',0,'2026-02-26 10:00:34'),
(954,32,'Consulta solicitud',2,'2026-02-26 10:00:47',0,'2026-02-26 10:00:47'),
(955,32,'Consulta solicitud',2,'2026-02-26 10:02:54',0,'2026-02-26 10:02:54'),
(956,32,'Consulta solicitud',2,'2026-02-26 10:02:59',0,'2026-02-26 10:02:59'),
(957,32,'Consulta solicitud',1,'2026-02-26 10:06:20',0,'2026-02-26 10:06:20'),
(958,32,'Consulta solicitud',1,'2026-02-26 10:06:32',0,'2026-02-26 10:06:32'),
(959,32,'Consulta solicitud',1,'2026-02-26 10:06:43',0,'2026-02-26 10:06:43'),
(960,32,'Consulta solicitud',1,'2026-02-26 10:06:48',0,'2026-02-26 10:06:48'),
(961,32,'Consulta solicitud',1,'2026-02-26 10:06:58',0,'2026-02-26 10:06:58'),
(962,32,'Consulta solicitud',1,'2026-02-26 10:07:16',0,'2026-02-26 10:07:16'),
(963,32,'Consulta solicitud',1,'2026-02-26 10:07:42',0,'2026-02-26 10:07:42'),
(964,32,'Consulta solicitud',1,'2026-02-26 10:08:34',0,'2026-02-26 10:08:34'),
(965,32,'Consulta solicitud',1,'2026-02-26 10:08:51',0,'2026-02-26 10:08:51'),
(966,32,'Consulta solicitud',1,'2026-02-26 10:09:06',0,'2026-02-26 10:09:06'),
(967,32,'Consulta solicitud',1,'2026-02-26 10:24:10',0,'2026-02-26 10:24:10'),
(968,32,'Consulta solicitud',1,'2026-02-26 10:25:51',0,'2026-02-26 10:25:51'),
(969,32,'Consulta solicitud',1,'2026-02-26 10:26:01',0,'2026-02-26 10:26:01'),
(970,32,'Consulta solicitud',1,'2026-02-26 10:27:01',0,'2026-02-26 10:27:01'),
(971,32,'Consulta solicitud',1,'2026-02-26 10:28:19',0,'2026-02-26 10:28:19'),
(972,33,'Ingresa solicitud: prueba #3',1,'2026-02-26 10:30:44',0,'2026-02-26 10:30:44'),
(973,32,'Consulta solicitud',1,'2026-02-26 10:39:55',0,'2026-02-26 10:39:55'),
(974,32,'Consulta solicitud',1,'2026-02-26 10:52:24',0,'2026-02-26 10:52:24'),
(975,32,'Consulta solicitud',1,'2026-02-26 10:54:26',0,'2026-02-26 10:54:26'),
(976,32,'Consulta solicitud',1,'2026-02-26 10:54:48',0,'2026-02-26 10:54:48'),
(977,32,'Consulta solicitud',1,'2026-02-26 10:54:52',0,'2026-02-26 10:54:52'),
(978,32,'Consulta solicitud',1,'2026-02-26 10:55:01',0,'2026-02-26 10:55:01'),
(979,32,'Consulta solicitud',1,'2026-02-26 10:55:20',0,'2026-02-26 10:55:20'),
(980,32,'Consulta solicitud',1,'2026-02-26 10:55:25',0,'2026-02-26 10:55:25'),
(981,32,'Consulta solicitud',1,'2026-02-26 11:29:42',0,'2026-02-26 11:29:42'),
(982,32,'Consulta solicitud',15,'2026-02-26 11:29:49',0,'2026-02-26 11:29:49'),
(983,32,'Consulta solicitud',1,'2026-02-26 11:35:17',0,'2026-02-26 11:35:17'),
(984,32,'Consulta solicitud',15,'2026-02-26 11:35:33',0,'2026-02-26 11:35:33'),
(985,32,'Consulta solicitud',15,'2026-02-26 11:35:37',0,'2026-02-26 11:35:37'),
(986,32,'Consulta solicitud',15,'2026-02-26 11:35:46',0,'2026-02-26 11:35:46'),
(987,32,'Consulta solicitud',15,'2026-02-26 11:35:54',0,'2026-02-26 11:35:54'),
(988,34,'Ingresa solicitud OIRS',1,'2026-02-26 12:07:30',0,'2026-02-26 12:07:30'),
(989,35,'Ingresa solicitud OIRS',1,'2026-02-26 12:08:28',0,'2026-02-26 12:08:28'),
(990,33,'Consulta solicitud',1,'2026-02-26 12:50:37',0,'2026-02-26 12:50:37'),
(991,33,'Consulta solicitud',1,'2026-02-26 12:50:44',0,'2026-02-26 12:50:44'),
(992,33,'Consulta solicitud',1,'2026-02-26 12:50:51',0,'2026-02-26 12:50:51'),
(993,33,'Consulta solicitud',1,'2026-02-26 12:50:55',0,'2026-02-26 12:50:55'),
(994,33,'Consulta solicitud',1,'2026-02-26 12:51:07',0,'2026-02-26 12:51:07'),
(995,33,'Consulta solicitud',1,'2026-02-26 12:51:12',0,'2026-02-26 12:51:12'),
(996,33,'Consulta solicitud',1,'2026-02-26 12:51:17',0,'2026-02-26 12:51:17'),
(997,33,'Consulta solicitud',1,'2026-02-26 12:51:20',0,'2026-02-26 12:51:20'),
(998,33,'Consulta solicitud',11,'2026-02-26 12:52:27',0,'2026-02-26 12:52:27'),
(999,33,'Añade comentario al trámite',11,'2026-02-26 12:52:39',0,'2026-02-26 12:52:39'),
(1000,33,'Consulta solicitud',11,'2026-02-26 12:52:40',0,'2026-02-26 12:52:40'),
(1001,33,'Consulta solicitud',1,'2026-02-26 12:52:48',0,'2026-02-26 12:52:48'),
(1002,33,'Consulta solicitud',11,'2026-02-26 12:53:14',0,'2026-02-26 12:53:14'),
(1003,33,'Consulta solicitud',1,'2026-02-26 12:54:33',0,'2026-02-26 12:54:33'),
(1004,33,'Consulta solicitud',1,'2026-02-26 12:54:40',0,'2026-02-26 12:54:40'),
(1005,33,'Consulta solicitud',11,'2026-02-26 12:55:21',0,'2026-02-26 12:55:21'),
(1006,33,'Consulta solicitud',1,'2026-02-26 12:57:18',0,'2026-02-26 12:57:18'),
(1007,33,'Consulta solicitud',1,'2026-02-26 12:57:36',0,'2026-02-26 12:57:36'),
(1008,33,'Consulta solicitud',1,'2026-02-26 13:01:09',0,'2026-02-26 13:01:09'),
(1009,33,'Consulta solicitud',1,'2026-02-26 13:01:22',0,'2026-02-26 13:01:22'),
(1010,33,'Consulta solicitud',1,'2026-02-26 13:01:26',0,'2026-02-26 13:01:26'),
(1011,33,'Consulta solicitud',1,'2026-02-26 13:01:31',0,'2026-02-26 13:01:31'),
(1012,33,'Consulta solicitud',11,'2026-02-26 13:01:45',0,'2026-02-26 13:01:45'),
(1013,33,'Consulta solicitud',11,'2026-02-26 13:01:53',0,'2026-02-26 13:01:53'),
(1014,33,'Consulta solicitud',11,'2026-02-26 13:06:03',0,'2026-02-26 13:06:03'),
(1015,33,'Añade comentario al trámite',11,'2026-02-26 13:06:30',0,'2026-02-26 13:06:30'),
(1016,33,'Consulta solicitud',11,'2026-02-26 13:06:32',0,'2026-02-26 13:06:32'),
(1017,33,'Responde solicitud',11,'2026-02-26 13:06:52',0,'2026-02-26 13:06:52'),
(1018,33,'Consulta solicitud',11,'2026-02-26 13:07:01',0,'2026-02-26 13:07:01'),
(1019,33,'Consulta solicitud',11,'2026-02-26 13:07:04',0,'2026-02-26 13:07:04'),
(1020,33,'Consulta solicitud',11,'2026-02-26 13:07:30',0,'2026-02-26 13:07:30'),
(1021,33,'Responde solicitud',11,'2026-02-26 13:07:53',0,'2026-02-26 13:07:53'),
(1022,33,'Carga de documento Público: certificado pisee1.pdf',11,'2026-02-26 13:07:54',0,'2026-02-26 13:07:54'),
(1023,33,'Consulta solicitud',11,'2026-02-26 13:08:03',0,'2026-02-26 13:08:03'),
(1024,33,'Consulta solicitud',11,'2026-02-26 13:14:05',0,'2026-02-26 13:14:05'),
(1025,36,'Ingresa solicitud: ramon 123',1,'2026-02-26 14:57:21',0,'2026-02-26 14:57:21'),
(1026,36,'Carga de documento Público: 2. Sistema Giro Electrónico.pdf',1,'2026-02-26 14:57:21',0,'2026-02-26 14:57:21'),
(1027,33,'Consulta solicitud',1,'2026-02-26 14:58:33',0,'2026-02-26 14:58:33'),
(1028,33,'Consulta solicitud',1,'2026-02-26 14:58:50',0,'2026-02-26 14:58:50'),
(1029,33,'Consulta solicitud',1,'2026-02-26 15:08:46',0,'2026-02-26 15:08:46'),
(1030,33,'Consulta solicitud',1,'2026-02-26 15:09:06',0,'2026-02-26 15:09:06'),
(1031,33,'Consulta solicitud',1,'2026-02-26 15:09:19',0,'2026-02-26 15:09:19'),
(1032,33,'Consulta solicitud',1,'2026-02-26 15:09:35',0,'2026-02-26 15:09:35'),
(1033,33,'Consulta solicitud',1,'2026-02-26 15:09:48',0,'2026-02-26 15:09:48'),
(1034,33,'Consulta solicitud',1,'2026-02-26 15:09:58',0,'2026-02-26 15:09:58'),
(1035,33,'Consulta solicitud',1,'2026-02-26 15:15:59',0,'2026-02-26 15:15:59'),
(1036,33,'Consulta solicitud',1,'2026-02-26 15:16:23',0,'2026-02-26 15:16:23'),
(1037,33,'Consulta solicitud',1,'2026-02-26 15:16:40',0,'2026-02-26 15:16:40'),
(1038,33,'Consulta solicitud',1,'2026-02-26 15:16:45',0,'2026-02-26 15:16:45'),
(1039,32,'Consulta solicitud',1,'2026-02-26 15:17:05',0,'2026-02-26 15:17:05'),
(1040,31,'Consulta solicitud',1,'2026-02-26 15:17:26',0,'2026-02-26 15:17:26'),
(1041,33,'Consulta solicitud',1,'2026-02-26 15:17:36',0,'2026-02-26 15:17:36'),
(1042,33,'Consulta solicitud',1,'2026-02-26 15:19:49',0,'2026-02-26 15:19:49'),
(1043,33,'Consulta solicitud',1,'2026-02-26 15:19:55',0,'2026-02-26 15:19:55'),
(1044,33,'Consulta solicitud',1,'2026-02-26 15:20:55',0,'2026-02-26 15:20:55'),
(1045,32,'Consulta solicitud',1,'2026-02-26 15:21:01',0,'2026-02-26 15:21:01'),
(1046,32,'Consulta solicitud',1,'2026-02-26 15:22:31',0,'2026-02-26 15:22:31'),
(1047,33,'Consulta solicitud',1,'2026-02-26 15:22:47',0,'2026-02-26 15:22:47'),
(1048,37,'Ingresa solicitud OIRS',13,'2026-02-26 17:12:42',0,'2026-02-26 17:12:42'),
(1049,37,'Ingresa gestión OIRS (Respuesta inmediata)',13,'2026-02-26 17:12:42',0,'2026-02-26 17:12:42'),
(1050,38,'Ingresa solicitud Ingresos',1,'2026-02-27 13:55:00',0,'2026-02-27 13:55:00'),
(1051,39,'Ingresa solicitud Ingresos',1,'2026-02-27 13:56:38',0,'2026-02-27 13:56:38'),
(1052,39,'Consulta detalles de solicitud',1,'2026-02-27 13:57:35',0,'2026-02-27 13:57:35'),
(1053,15,'Consulta detalles de solicitud',1,'2026-02-27 14:00:28',0,'2026-02-27 14:00:28'),
(1054,15,'Consulta detalles de solicitud',1,'2026-02-27 14:00:48',0,'2026-02-27 14:00:48'),
(1055,25,'Consulta detalles de solicitud',1,'2026-02-27 15:23:24',0,'2026-02-27 15:23:24'),
(1056,39,'Consulta detalles de solicitud',1,'2026-02-27 15:25:00',0,'2026-02-27 15:25:00'),
(1057,39,'Consulta detalles de solicitud',1,'2026-02-27 15:41:58',0,'2026-02-27 15:41:58'),
(1058,40,'Ingresa solicitud: prueba mail',1,'2026-02-27 15:49:05',0,'2026-02-27 15:49:05'),
(1059,40,'Carga de documento Público: certificado pisee1.pdf',1,'2026-02-27 15:49:05',0,'2026-02-27 15:49:05'),
(1060,40,'Consulta solicitud',1,'2026-02-27 15:49:46',0,'2026-02-27 15:49:46'),
(1061,40,'Consulta solicitud',1,'2026-02-27 15:49:49',0,'2026-02-27 15:49:49'),
(1062,40,'Consulta solicitud',1,'2026-02-27 15:50:03',0,'2026-02-27 15:50:03'),
(1063,40,'Consulta solicitud',1,'2026-02-27 15:50:03',0,'2026-02-27 15:50:03'),
(1064,15,'Consulta detalles de solicitud',1,'2026-02-27 15:52:14',0,'2026-02-27 15:52:14'),
(1065,15,'Consulta detalles de solicitud',1,'2026-02-27 15:52:53',0,'2026-02-27 15:52:53'),
(1066,39,'Consulta detalles de solicitud',1,'2026-02-27 15:53:42',0,'2026-02-27 15:53:42'),
(1067,15,'Consulta detalles de solicitud',1,'2026-02-27 15:54:01',0,'2026-02-27 15:54:01'),
(1068,39,'Consulta detalles de solicitud',1,'2026-02-27 15:56:44',0,'2026-02-27 15:56:44'),
(1069,39,'Consulta detalles de solicitud',1,'2026-02-27 16:09:58',0,'2026-02-27 16:09:58'),
(1070,38,'Consulta detalles de solicitud',1,'2026-02-27 16:10:07',0,'2026-02-27 16:10:07'),
(1071,38,'Consulta detalles de solicitud',2,'2026-02-27 16:12:46',0,'2026-02-27 16:12:46'),
(1072,38,'Consulta detalles de solicitud',2,'2026-02-27 16:13:03',0,'2026-02-27 16:13:03'),
(1073,38,'Consulta detalles de solicitud',2,'2026-02-27 16:14:30',0,'2026-02-27 16:14:30'),
(1074,38,'Consulta detalles de solicitud',2,'2026-02-27 16:14:49',0,'2026-02-27 16:14:49'),
(1075,38,'Consulta detalles de solicitud',2,'2026-02-27 16:15:36',0,'2026-02-27 16:15:36'),
(1076,38,'Consulta detalles de solicitud',2,'2026-02-27 16:18:46',0,'2026-02-27 16:18:46'),
(1077,39,'Consulta detalles de solicitud',1,'2026-02-27 16:23:38',0,'2026-02-27 16:23:38'),
(1078,38,'Consulta detalles de solicitud',1,'2026-02-27 16:29:23',0,'2026-02-27 16:29:23'),
(1079,39,'Consulta detalles de solicitud',1,'2026-03-02 09:09:48',0,'2026-03-02 09:09:48'),
(1080,39,'Consulta detalles de solicitud',1,'2026-03-02 09:13:25',0,'2026-03-02 09:13:25'),
(1081,25,'Consulta detalles de solicitud',1,'2026-03-02 09:13:59',0,'2026-03-02 09:13:59'),
(1082,25,'Consulta detalles de solicitud',1,'2026-03-02 09:15:17',0,'2026-03-02 09:15:17'),
(1083,41,'Ingresa solicitud Ingresos',1,'2026-03-02 09:25:47',0,'2026-03-02 09:25:47'),
(1084,25,'Consulta detalles de solicitud',1,'2026-03-02 09:29:50',0,'2026-03-02 09:29:50'),
(1085,39,'Consulta detalles de solicitud',1,'2026-03-02 09:32:52',0,'2026-03-02 09:32:52'),
(1086,41,'Consulta detalles de solicitud',1,'2026-03-02 09:33:16',0,'2026-03-02 09:33:16'),
(1087,25,'Consulta detalles de solicitud',1,'2026-03-02 09:41:59',0,'2026-03-02 09:41:59'),
(1088,25,'Consulta detalles de solicitud',1,'2026-03-02 09:43:06',0,'2026-03-02 09:43:06'),
(1089,41,'Consulta detalles de solicitud',1,'2026-03-02 10:04:40',0,'2026-03-02 10:04:40'),
(1090,41,'Consulta detalles de solicitud',1,'2026-03-02 10:05:40',0,'2026-03-02 10:05:40'),
(1091,41,'Consulta detalles de solicitud',1,'2026-03-02 10:10:06',0,'2026-03-02 10:10:06'),
(1092,41,'Consulta detalles de solicitud',1,'2026-03-02 10:15:29',0,'2026-03-02 10:15:29'),
(1093,41,'Consulta detalles de solicitud',1,'2026-03-02 10:24:02',0,'2026-03-02 10:24:02'),
(1094,23,'Consulta detalles de solicitud',1,'2026-03-02 10:24:14',0,'2026-03-02 10:24:14'),
(1095,22,'Consulta detalles de solicitud',1,'2026-03-02 10:24:20',0,'2026-03-02 10:24:20'),
(1096,8,'Consulta detalles de solicitud',1,'2026-03-02 10:24:32',0,'2026-03-02 10:24:32'),
(1097,23,'Consulta detalles de solicitud',1,'2026-03-02 10:24:41',0,'2026-03-02 10:24:41'),
(1098,24,'Consulta detalles de solicitud',1,'2026-03-02 10:24:55',0,'2026-03-02 10:24:55'),
(1099,41,'Consulta detalles de solicitud',1,'2026-03-02 10:25:41',0,'2026-03-02 10:25:41'),
(1100,41,'Consulta detalles de solicitud',1,'2026-03-02 10:31:03',0,'2026-03-02 10:31:03'),
(1101,41,'Consulta detalles de solicitud',1,'2026-03-02 10:31:28',0,'2026-03-02 10:31:28'),
(1102,41,'Consulta detalles de solicitud',1,'2026-03-02 10:31:49',0,'2026-03-02 10:31:49'),
(1103,41,'Consulta detalles de solicitud',1,'2026-03-02 10:31:55',0,'2026-03-02 10:31:55'),
(1104,41,'Consulta detalles de solicitud',1,'2026-03-02 10:35:55',0,'2026-03-02 10:35:55'),
(1105,14,'Consulta detalles de solicitud',1,'2026-03-02 10:40:44',0,'2026-03-02 10:40:44'),
(1106,14,'Consulta detalles de solicitud',1,'2026-03-02 10:42:05',0,'2026-03-02 10:42:05'),
(1107,14,'Consulta detalles de solicitud',1,'2026-03-02 10:42:14',0,'2026-03-02 10:42:14'),
(1108,14,'Consulta detalles de solicitud',1,'2026-03-02 10:42:17',0,'2026-03-02 10:42:17'),
(1109,41,'Consulta detalles de solicitud',1,'2026-03-02 10:42:33',0,'2026-03-02 10:42:33'),
(1110,41,'Consulta detalles de solicitud',2,'2026-03-02 10:44:10',0,'2026-03-02 10:44:10'),
(1111,41,'Consulta detalles de solicitud',2,'2026-03-02 10:44:52',0,'2026-03-02 10:44:52'),
(1112,41,'Consulta detalles de solicitud',2,'2026-03-02 10:45:06',0,'2026-03-02 10:45:06'),
(1113,41,'Consulta detalles de solicitud',2,'2026-03-02 10:45:56',0,'2026-03-02 10:45:56'),
(1114,41,'Consulta detalles de solicitud',2,'2026-03-02 10:46:09',0,'2026-03-02 10:46:09'),
(1115,41,'Consulta detalles de solicitud',2,'2026-03-02 10:46:18',0,'2026-03-02 10:46:18'),
(1116,41,'Consulta detalles de solicitud',1,'2026-03-02 10:58:18',0,'2026-03-02 10:58:18'),
(1117,41,'Consulta detalles de solicitud',1,'2026-03-02 10:58:31',0,'2026-03-02 10:58:31'),
(1118,41,'Consulta detalles de solicitud',1,'2026-03-02 11:00:01',0,'2026-03-02 11:00:01'),
(1119,41,'Consulta detalles de solicitud',1,'2026-03-02 11:02:26',0,'2026-03-02 11:02:26'),
(1120,41,'Consulta detalles de solicitud',1,'2026-03-02 11:02:49',0,'2026-03-02 11:02:49'),
(1121,41,'Consulta detalles de solicitud',1,'2026-03-02 11:04:38',0,'2026-03-02 11:04:38'),
(1122,41,'Consulta detalles de solicitud',1,'2026-03-02 11:04:50',0,'2026-03-02 11:04:50'),
(1123,41,'Consulta detalles de solicitud',2,'2026-03-02 11:05:08',0,'2026-03-02 11:05:08'),
(1124,41,'Consulta detalles de solicitud',1,'2026-03-02 11:05:14',0,'2026-03-02 11:05:14'),
(1125,41,'Consulta detalles de solicitud',1,'2026-03-02 11:05:43',0,'2026-03-02 11:05:43'),
(1126,41,'Consulta detalles de solicitud',1,'2026-03-02 11:07:27',0,'2026-03-02 11:07:27'),
(1127,41,'Consulta detalles de solicitud',2,'2026-03-02 11:08:07',0,'2026-03-02 11:08:07'),
(1128,39,'Consulta detalles de solicitud',2,'2026-03-02 11:09:13',0,'2026-03-02 11:09:13'),
(1129,41,'Consulta detalles de solicitud',2,'2026-03-02 11:09:43',0,'2026-03-02 11:09:43'),
(1130,41,'Consulta detalles de solicitud',1,'2026-03-02 11:25:12',0,'2026-03-02 11:25:12'),
(1131,41,'Consulta detalles de solicitud',1,'2026-03-02 11:25:19',0,'2026-03-02 11:25:19'),
(1132,41,'Consulta detalles de solicitud',1,'2026-03-02 11:26:18',0,'2026-03-02 11:26:18'),
(1133,41,'Consulta detalles de solicitud',1,'2026-03-02 11:27:24',0,'2026-03-02 11:27:24'),
(1134,41,'Consulta detalles de solicitud',2,'2026-03-02 11:27:54',0,'2026-03-02 11:27:54'),
(1135,41,'Consulta detalles de solicitud',2,'2026-03-02 11:28:56',0,'2026-03-02 11:28:56'),
(1136,41,'Consulta detalles de solicitud',1,'2026-03-02 11:34:31',0,'2026-03-02 11:34:31'),
(1137,41,'Consulta detalles de solicitud',1,'2026-03-02 11:37:55',0,'2026-03-02 11:37:55'),
(1138,41,'Consulta detalles de solicitud',1,'2026-03-02 11:38:02',0,'2026-03-02 11:38:02'),
(1139,41,'Consulta detalles de solicitud',1,'2026-03-02 11:40:11',0,'2026-03-02 11:40:11'),
(1140,41,'Consulta detalles de solicitud',2,'2026-03-02 11:40:56',0,'2026-03-02 11:40:56'),
(1141,39,'Consulta detalles de solicitud',2,'2026-03-02 11:42:21',0,'2026-03-02 11:42:21'),
(1142,41,'Consulta detalles de solicitud',2,'2026-03-02 11:46:02',0,'2026-03-02 11:46:02'),
(1143,41,'Consulta detalles de solicitud',2,'2026-03-02 12:46:03',0,'2026-03-02 12:46:03'),
(1144,41,'Consulta detalles de solicitud',1,'2026-03-02 14:24:26',0,'2026-03-02 14:24:26'),
(1145,41,'Consulta detalles de solicitud',1,'2026-03-02 14:25:27',0,'2026-03-02 14:25:27'),
(1146,41,'Consulta detalles de solicitud',1,'2026-03-02 14:29:36',0,'2026-03-02 14:29:36'),
(1147,41,'Consulta detalles de solicitud',1,'2026-03-02 14:32:03',0,'2026-03-02 14:32:03'),
(1148,25,'Consulta detalles de solicitud',1,'2026-03-02 14:33:18',0,'2026-03-02 14:33:18'),
(1149,41,'Consulta detalles de solicitud',1,'2026-03-02 14:39:25',0,'2026-03-02 14:39:25'),
(1150,41,'Consulta detalles de solicitud',1,'2026-03-02 14:43:10',0,'2026-03-02 14:43:10'),
(1151,41,'Consulta detalles de solicitud',1,'2026-03-02 14:51:24',0,'2026-03-02 14:51:24'),
(1152,41,'Añade comentario al trámite',1,'2026-03-02 14:52:23',0,'2026-03-02 14:52:23'),
(1153,41,'Consulta detalles de solicitud',1,'2026-03-02 14:52:25',0,'2026-03-02 14:52:25'),
(1154,41,'Consulta detalles de solicitud',1,'2026-03-02 14:56:10',0,'2026-03-02 14:56:10'),
(1155,41,'Consulta detalles de solicitud',1,'2026-03-02 14:56:24',0,'2026-03-02 14:56:24'),
(1156,41,'Consulta detalles de solicitud',1,'2026-03-02 15:00:56',0,'2026-03-02 15:00:56'),
(1157,25,'Consulta detalles de solicitud',1,'2026-03-02 15:01:33',0,'2026-03-02 15:01:33'),
(1158,25,'Consulta detalles de solicitud',1,'2026-03-02 15:05:22',0,'2026-03-02 15:05:22'),
(1159,41,'Consulta detalles de solicitud',1,'2026-03-02 15:06:38',0,'2026-03-02 15:06:38'),
(1160,41,'Consulta detalles de solicitud',1,'2026-03-02 15:11:02',0,'2026-03-02 15:11:02'),
(1161,41,'Consulta detalles de solicitud',1,'2026-03-02 15:13:52',0,'2026-03-02 15:13:52'),
(1162,41,'Consulta detalles de solicitud',1,'2026-03-02 15:19:17',0,'2026-03-02 15:19:17'),
(1163,41,'Consulta detalles de solicitud',1,'2026-03-02 15:24:47',0,'2026-03-02 15:24:47'),
(1164,41,'Consulta detalles de solicitud',1,'2026-03-02 15:25:23',0,'2026-03-02 15:25:23'),
(1165,14,'Consulta detalles de solicitud',1,'2026-03-02 15:26:24',0,'2026-03-02 15:26:24'),
(1166,41,'Consulta detalles de solicitud',1,'2026-03-02 15:26:43',0,'2026-03-02 15:26:43'),
(1167,14,'Consulta detalles de solicitud',1,'2026-03-02 15:26:53',0,'2026-03-02 15:26:53'),
(1168,41,'Consulta detalles de solicitud',1,'2026-03-02 15:27:04',0,'2026-03-02 15:27:04'),
(1169,42,'Ingresa solicitud Ingresos',2,'2026-03-02 15:28:40',0,'2026-03-02 15:28:40'),
(1170,42,'Carga de documento Público: Listado_Ingresos_DESVE.pdf',2,'2026-03-02 15:28:40',0,'2026-03-02 15:28:40'),
(1171,42,'Consulta detalles de solicitud',2,'2026-03-02 15:28:48',0,'2026-03-02 15:28:48'),
(1172,42,'Consulta detalles de solicitud',2,'2026-03-02 15:29:01',0,'2026-03-02 15:29:01'),
(1173,42,'Consulta detalles de solicitud',2,'2026-03-02 15:29:43',0,'2026-03-02 15:29:43'),
(1174,43,'Ingresa solicitud Ingresos',4,'2026-03-02 15:47:58',0,'2026-03-02 15:47:58'),
(1175,41,'Consulta detalles de solicitud',2,'2026-03-02 15:54:54',0,'2026-03-02 15:54:54'),
(1176,42,'Consulta detalles de solicitud',2,'2026-03-02 15:55:05',0,'2026-03-02 15:55:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,1,'comentario',NULL,4,'2026-02-06 16:14:48',0,'2026-02-19 19:44:53'),
(2,6,'comentario de operador',NULL,12,'2026-02-12 20:42:48',0,'2026-02-19 19:44:53'),
(3,8,'asd',NULL,13,'2026-02-12 21:25:21',0,'2026-02-19 19:44:53'),
(4,10,'asd',NULL,18,'2026-02-13 18:36:53',0,'2026-02-19 19:44:53'),
(5,1,'sdf',NULL,18,'2026-02-13 19:28:36',0,'2026-02-19 19:44:53'),
(6,1,'dfg',NULL,18,'2026-02-13 19:28:52',0,'2026-02-19 19:44:53'),
(7,12,'revisar información',NULL,19,'2026-02-16 13:54:58',0,'2026-02-19 19:44:53'),
(8,1,'rESOPONDE CON UN NUMERO',NULL,19,'2026-02-16 13:56:04',0,'2026-02-19 19:44:53'),
(9,1,'asd',NULL,28,'2026-02-25 15:58:55',0,'2026-02-25 11:58:55'),
(10,11,'comentario funcionaio desve',NULL,33,'2026-02-26 16:52:39',0,'2026-02-26 12:52:39'),
(11,11,'comentario desde responder',NULL,33,'2026-02-26 17:06:30',0,'2026-02-26 13:06:30'),
(12,1,'quiero dejar un registro',NULL,41,'2026-03-02 18:52:23',0,'2026-03-02 14:52:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(1,'11111111-1','natural','',NULL,NULL,'',NULL,'1','1','1','Otro','1990-02-03','Divorciado/a',3,NULL,'centrib@test.cl','+56944444444',0,NULL,0,'2026-02-19 19:44:53','2026-02-26 12:07:30'),
(2,'14037230-7','natural','',NULL,NULL,'',NULL,'RAMON ANDRES','MARTÍNEZ','VILLANUEVA','Masculino','1981-10-10','Casado/a',3,'CHILENO','RMARTINEZVCL@GMAIL.COM','+56993201821',0,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,'17619949-0','natural',NULL,NULL,NULL,NULL,NULL,'Leticia ','meneses','astorga',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,'2026-02-23 10:38:48','2026-02-23 10:38:48'),
(4,'12123123-5','natural','',NULL,NULL,'',NULL,'cecilia','jara','jara','Femenino','1958-05-12','Casado/a',5,NULL,'notiene@gmail.com','+56995456123',0,NULL,0,'2026-02-26 17:12:42','2026-02-26 17:12:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(4,4,'2026-02-06 12:47:02',1,0,'2026-02-19 19:44:53'),
(5,4,'2026-02-06 13:00:46',2,0,'2026-02-19 19:44:53'),
(6,4,'2026-02-06 13:05:20',3,0,'2026-02-19 19:44:53'),
(7,5,'2026-02-06 13:06:43',4,0,'2026-02-19 19:44:53'),
(8,5,'2026-02-06 13:11:17',5,0,'2026-02-19 19:44:53'),
(9,6,'2026-02-06 13:12:52',6,0,'2026-02-19 19:44:53'),
(10,9,'2026-02-06 13:58:38',7,0,'2026-02-19 19:44:53'),
(11,9,'2026-02-06 14:00:47',8,0,'2026-02-19 19:44:53'),
(12,11,'2026-02-10 17:03:40',9,0,'2026-02-19 19:44:53'),
(13,15,'2026-02-13 11:31:59',10,0,'2026-02-19 19:44:53'),
(14,18,'2026-02-13 13:49:37',11,0,'2026-02-19 19:44:53'),
(15,19,'2026-02-16 09:55:36',12,0,'2026-02-19 19:44:53'),
(16,20,'2026-02-17 09:52:14',13,0,'2026-02-19 19:44:53'),
(17,20,'2026-02-17 14:02:08',14,0,'2026-02-19 19:44:53'),
(18,20,'2026-02-17 14:02:08',15,0,'2026-02-19 19:44:53'),
(19,20,'2026-02-17 14:04:46',16,0,'2026-02-19 19:44:53'),
(20,21,'2026-02-17 16:04:44',17,0,'2026-02-19 19:44:53'),
(21,28,'2026-02-25 11:35:48',18,0,'2026-02-25 11:35:48'),
(22,29,'2026-02-25 11:36:08',19,0,'2026-02-25 11:36:08'),
(23,30,'2026-02-25 11:37:02',20,0,'2026-02-25 11:37:02'),
(24,32,'2026-02-26 09:56:42',21,0,'2026-02-26 09:56:42'),
(25,32,'2026-02-26 09:56:42',22,0,'2026-02-26 09:56:42'),
(26,33,'2026-02-26 13:07:54',23,0,'2026-02-26 13:07:54'),
(27,36,'2026-02-26 14:57:21',24,0,'2026-02-26 14:57:21'),
(28,40,'2026-02-27 15:49:05',25,0,'2026-02-27 15:49:05'),
(29,42,'2026-03-02 15:28:40',26,0,'2026-03-02 15:28:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto_versiones` VALUES
(1,4,'2026-02-06 12:47:02','gestordocumental/202602/2602061647T4jrQ.mvm','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,5,'2026-02-06 13:00:46','gestordocumental/202602/2602061700rIAs9.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,6,'2026-02-06 13:05:20','gestordocumental/202602/2602061705nhSWF.imv','Decreto - Doc1.docx',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,7,'2026-02-06 13:06:43','gestordocumental/202602/2602061706L6Lum.imv','Doc1.docx',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,8,'2026-02-06 13:11:17','gestordocumental/202602/2602061711SiubZ.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,9,'2026-02-06 13:12:52','gestordocumental/202602/26020617127hkGn.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(7,10,'2026-02-06 13:58:38','gestordocumental/202602/2602061758pK21C.imv','System BPMN - MODELO NUEVO DE FERIAS.pdf',3,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(8,11,'2026-02-06 14:00:47','gestordocumental/202602/2602061800kqYoZ.imv','Decreto - certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(9,12,'2026-02-10 17:03:40','gestordocumental/202602/2602102103yzmRv.imv','27. Sistema Tramites y Solicitudes.pdf',3,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(10,13,'2026-02-13 11:31:59','gestordocumental/202602/2602131531TlxjP.imv','2512012877.pdf',3,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(11,14,'2026-02-13 13:49:37','gestordocumental/202602/2602131749FJAQm.imv','2512012877.pdf',10,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(12,15,'2026-02-16 09:55:36','gestordocumental/202602/2602161355JbOLp.imv','CPAT Interno.pdf',12,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(13,16,'2026-02-17 09:52:14','gestordocumental/202602/2602171352MWYYw.imv','2512012877.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(14,17,'2026-02-17 14:02:08','gestordocumental/202602/2602171802J2egR.imv','2512012877.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(15,18,'2026-02-17 14:02:08','gestordocumental/202602/2602171802xAdfg.imv','2512012877 (1).pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(16,19,'2026-02-17 14:04:46','gestordocumental/202602/2602171804MOE46.imv','documento.pdf',1,0,'202602/.ck',1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(17,20,'2026-02-17 16:04:44','gestordocumental/202602/2602172004qv1DM.imv','2512012877.pdf',1,0,'202602/.ck',0,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(18,21,'2026-02-25 11:35:48','gestordocumental/202602/2602251535LDH32.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(19,22,'2026-02-25 11:36:08','gestordocumental/202602/2602251536yEy9h.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(20,23,'2026-02-25 11:37:02','gestordocumental/202602/2602251537nVcqa.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(21,24,'2026-02-26 09:56:42','gestordocumental/202602/2602261356n6xI3.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(22,25,'2026-02-26 09:56:42','gestordocumental/202602/2602261356sEcuw.imv','Doc1.docx',1,0,'202602/.ck',0,0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(23,26,'2026-02-26 13:07:54','gestordocumental/202602/2602261707MOKe4.imv','certificado pisee1.pdf',11,0,'202602/.ck',0,0,'2026-02-26 13:07:54','2026-02-26 13:07:54'),
(24,27,'2026-02-26 14:57:21','gestordocumental/202602/26022618572ucLO.imv','2. Sistema Giro Electrónico.pdf',1,0,'202602/.ck',0,0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(25,28,'2026-02-27 15:49:05','gestordocumental/202602/2602271949m6hJU.imv','certificado pisee1.pdf',1,0,'202602/.ck',0,0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(26,29,'2026-03-02 15:28:40','gestordocumental/202603/2603021928EYd0Y.imv','Listado_Ingresos_DESVE.pdf',2,0,'202603/.ck',0,0,'2026-03-02 15:28:40','2026-03-02 15:28:40');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES
(14,4,'https://mail.google.com/',1,'2026-02-06 13:00:45',0,'2026-02-19 19:44:53'),
(15,9,'https://docs.google.com/document/d/1nhTv63CyxT5HSdPSthsRbeRXbdm7QzroCH_yw7TNE-s/edit?usp=sharing',3,'2026-02-06 13:58:38',0,'2026-02-19 19:44:53'),
(16,15,'https://www.google.cl',3,'2026-02-13 11:31:59',0,'2026-02-19 19:44:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(2,'2026-02-06 11:36:00','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(3,'2026-02-06 11:58:46','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 4','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(4,'2026-02-06 12:18:23','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(5,'2026-02-06 12:18:41','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(6,'2026-02-06 12:22:07','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(7,'2026-02-06 12:47:02','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(8,'2026-02-06 13:00:46','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 4','{\"id\":\"4\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"4\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"detalle de solicitud 3\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"Juan hervas\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null}],\"enlaces\":[\"https:\\/\\/mail.google.com\\/\"],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(9,'2026-02-06 13:06:43','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 5','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 002\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba 2 \",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"Doc1.docx\"}]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(10,'2026-02-06 13:12:19','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 6','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 003\",\"tis_tipo\":\"1\",\"tis_contenido\":\"ASD\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(11,'2026-02-06 13:13:41','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 7','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 004\",\"tis_tipo\":\"2\",\"tis_contenido\":\"\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(12,'2026-02-06 13:21:12','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 8','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"comprar papel hijenico\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favorelpapel\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(13,'2026-02-06 13:40:31','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(14,'2026-02-06 13:46:29','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(15,'2026-02-06 13:46:36','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(16,'2026-02-06 13:52:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(17,'2026-02-06 13:52:55','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(18,'2026-02-06 13:54:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(19,'2026-02-06 13:58:38','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 9','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Revisi\\u00f3n de ingreso\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor revisar esta informaci\\u00f3n\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Copia\",\"tid_facultad\":\"Visador\",\"tid_requeido\":\"1\"},{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/docs.google.com\\/document\\/d\\/1nhTv63CyxT5HSdPSthsRbeRXbdm7QzroCH_yw7TNE-s\\/edit?usp=sharing\"],\"documentos\":[{\"nombre\":\"System BPMN - MODELO NUEVO DE FERIAS.pdf\"}]}}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(20,'2026-02-06 14:17:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(21,'2026-02-06 14:19:15','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 10','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revision 1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"test 1\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-06\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON EVIL GUY\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(22,'2026-02-06 14:19:23','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(23,'2026-02-06 14:45:56','UPDATE','info','Bajo','INGRESOS',1,'ACTUALIZAR_INGRESO','Actualización de ingreso: 10','{\"id\":\"10\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"10\",\"tis_titulo\":\"revision 1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"test 1\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON EVIL GUY\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(24,'2026-02-06 14:46:28','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(25,'2026-02-06 14:46:34','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(26,'2026-02-09 09:59:46','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(27,'2026-02-09 12:25:30','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(28,'2026-02-09 12:25:49','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(29,'2026-02-10 16:36:22','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(30,'2026-02-10 17:02:28','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(31,'2026-02-10 17:03:40','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 11','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisi\\u00f3n de muchas cosas\",\"tis_tipo\":\"1\",\"tis_contenido\":\"por favor revisar documento atendido\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-10\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"27. Sistema Tramites y Solicitudes.pdf\"}]}}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(32,'2026-02-10 17:04:07','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(33,'2026-02-10 17:04:45','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(34,'2026-02-10 17:05:59','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(35,'2026-02-11 08:47:51','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(36,'2026-02-11 10:34:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(37,'2026-02-11 13:12:48','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(38,'2026-02-11 13:14:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(39,'2026-02-11 13:27:55','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(40,'2026-02-11 13:42:19','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(41,'2026-02-11 14:01:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(42,'2026-02-11 16:26:31','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(43,'2026-02-11 16:29:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(44,'2026-02-12 16:04:38','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(45,'2026-02-12 16:07:34','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(46,'2026-02-12 16:07:41','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(47,'2026-02-12 16:29:57','CREATE','info','Bajo','INGRESOS',4,'CREAR_INGRESO','Creación de ingreso: 12','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asd\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-12\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Consultor\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"0\"},{\"usr_id\":\"6\",\"usr_nombre_completo\":\"USUARIO INGRESOS OPERADOR\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(48,'2026-02-12 16:32:07','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(49,'2026-02-12 16:32:59','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(50,'2026-02-12 16:43:09','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(51,'2026-02-12 16:53:46','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 13','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-12\",\"destinos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(52,'2026-02-12 17:01:57','UPDATE','info','Bajo','INGRESOS',6,'ACTUALIZAR_INGRESO','Actualización de ingreso: 13','{\"id\":\"13\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"13\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"destinos\":[{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(53,'2026-02-12 17:02:40','UPDATE','info','Bajo','INGRESOS',6,'ACTUALIZAR_INGRESO','Actualización de ingreso: 13','{\"id\":\"13\",\"cambios\":{\"ACCION\":\"ACTUALIZAR\",\"ing_id\":\"13\",\"tis_titulo\":\"solicitud hija1\",\"tis_tipo\":\"1\",\"tis_contenido\":\"asdf2\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(54,'2026-02-13 09:54:25','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(55,'2026-02-13 09:56:55','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(56,'2026-02-13 10:07:00','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(57,'2026-02-13 10:55:44','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(58,'2026-02-13 10:58:35','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 14','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba ingreso de ingreso 002\",\"tis_tipo\":\"1\",\"tis_contenido\":\"qwe\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(59,'2026-02-13 10:59:57','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(60,'2026-02-13 11:25:12','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(61,'2026-02-13 11:30:23','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(62,'2026-02-13 11:31:59','CREATE','info','Bajo','INGRESOS',3,'CREAR_INGRESO','Creación de ingreso: 15','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisi\\u00f3n de plataforma\",\"tis_tipo\":\"1\",\"tis_contenido\":\"solicito revisar la informaci\\u00f3n contenida en el documento\\n\\n\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"generar informe\",\"tid_requeido\":\"1\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[\"https:\\/\\/www.google.cl\"],\"documentos\":[{\"nombre\":\"2512012877.pdf\"}]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(63,'2026-02-13 11:32:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(64,'2026-02-13 11:33:03','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(65,'2026-02-13 11:35:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(66,'2026-02-13 11:47:31','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(67,'2026-02-13 12:04:34','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(68,'2026-02-13 12:05:06','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(69,'2026-02-13 12:08:08','LOGIN_SUCCESS','info','Bajo','Autenticación',8,'LOGIN','Usuario ingresos.externo@test.cl inició sesión correctamente','{\"email\":\"ingresos.externo@test.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(70,'2026-02-13 12:08:22','CREATE','info','Bajo','INGRESOS',6,'CREAR_INGRESO','Creación de ingreso: 16','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"testo\",\"tis_tipo\":\"1\",\"tis_contenido\":\"sadc\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-13\",\"destinos\":[{\"usr_id\":\"8\",\"usr_nombre_completo\":\"USUARIO INGRESOS EXTENO\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"tomar conocimiento\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(71,'2026-02-13 12:10:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(72,'2026-02-13 12:27:59','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(73,'2026-02-13 12:28:10','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(74,'2026-02-13 12:52:23','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"::1\"}','::1','Exitoso',0,'2026-02-19 19:44:53'),
(75,'2026-02-13 12:53:55','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(76,'2026-02-13 12:54:06','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(77,'2026-02-13 13:49:37','CREATE','info','Bajo','DESVE',10,'CREAR_SOLICITUD','Creación de solicitud DESVE: 1','{\"data\":{\"sol_nombre_expediente\":\"prueba  perfiles 001\",\"sol_ingreso_desve\":\"php01\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"contenido desve\",\"sol_fecha_recepcion\":\"2026-02-13 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"12\",\"sol_fecha_vencimiento\":\"2026-02-17 00:00:00\",\"sol_observaciones\":\"no c\",\"sol_responsable\":null,\"sol_origen_esp\":2,\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\"},{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\"}],\"documentos\":[{\"nombre\":\"2512012877.pdf\"}],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(78,'2026-02-13 15:44:48','UPDATE','info','Bajo','DESVE',10,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 1','{\"id\":\"1\",\"cambios\":{\"sol_id\":\"1\",\"sol_ingreso_desve\":\"php01\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba  perfiles 001\",\"sol_origen_id\":\"1\",\"sol_detalle\":\"contenido desve\",\"sol_fecha_recepcion\":\"2026-02-13 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"12\",\"sol_fecha_vencimiento\":\"2026-02-17 00:00:00\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"no c\",\"sol_responsable\":\"10\",\"destinos\":[{\"tid_id\":\"1\",\"tid_desve_solicitud\":\"1\",\"tid_destino\":\"1\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"JUAN\",\"usr_apellido\":\"HERVAS\",\"usr_email\":\"juan.hervas@munivina.cl\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"usr_id\":\"1\"},{\"tid_id\":\"2\",\"tid_desve_solicitud\":\"1\",\"tid_destino\":\"12\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"EXTENO\",\"usr_email\":\"desve.externo@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"usr_id\":\"12\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(79,'2026-02-13 16:10:19','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(80,'2026-02-13 16:10:49','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(81,'2026-02-16 09:13:55','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(82,'2026-02-16 09:14:33','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(83,'2026-02-16 09:52:19','LOGIN_SUCCESS','info','Bajo','Autenticación',12,'LOGIN','Usuario desve.externo@test.cl inició sesión correctamente','{\"email\":\"desve.externo@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-19 19:44:53'),
(84,'2026-02-16 09:53:15','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 2','{\"data\":{\"sol_nombre_expediente\":\"PRUEBA DESVE 001\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"1 1 1\",\"sol_detalle\":\"HOLA LETI\",\"sol_fecha_recepcion\":\"2026-02-16 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-18 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":null,\"sol_origen_esp\":1,\"destinos\":[{\"usr_id\":\"12\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(85,'2026-02-16 10:20:02','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"PRUEBA DESVE 001\",\"sol_origen_id\":\"1\",\"sol_detalle\":\"HOLA LETI\",\"sol_fecha_recepcion\":\"2026-02-16 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-18 00:00:00\",\"sol_estado_entrega\":true,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"destinos\":[{\"tid_id\":\"5\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"12\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"EXTENO\",\"usr_email\":\"desve.externo@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"usr_id\":\"12\"}],\"sol_origen_esp\":1,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(86,'2026-02-16 10:50:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(87,'2026-02-16 11:02:27','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(88,'2026-02-16 11:29:32','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(89,'2026-02-16 11:29:44','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(90,'2026-02-16 11:38:39','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(91,'2026-02-16 15:25:05','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(92,'2026-02-16 15:33:26','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(93,'2026-02-16 15:34:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(94,'2026-02-16 16:30:39','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(95,'2026-02-16 16:31:02','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(96,'2026-02-16 16:31:29','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(97,'2026-02-17 09:52:14','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 1','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_nacionalidad\":\"Chilena\",\"cont_email\":\"centrib@test.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"las verbenas 55 Casa 5 Depto 4 (condominio las peras)\",\"cont_latitud\":\"-33.0407908\",\"cont_longitud\":\"-71.5354864\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"1\",\"oirs_fecha_hora\":\"2026-02-17 13:39\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"Av. Los Casta\\u00f1os 333, 2530711 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":null,\"oirs_descripcion\":\"hay un basual cerca de la unab\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.018814686224125\",\"oirs_longitud\":\"-71.54004119567871\",\"oirs_respuesta\":\"\",\"documentos\":[{\"nombre\":\"2512012877.pdf\"}]},\"response\":{\"status\":\"success\",\"id\":\"1\",\"rgt_id\":\"20\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(98,'2026-02-17 09:59:54','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(99,'2026-02-17 16:04:44','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 2','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"14037230-7\",\"cont_nombres\":\"RAMON ANDRES\",\"cont_apellido_paterno\":\"MART\\u00cdNEZ\",\"cont_apellido_materno\":\"VILLANUEVA\",\"cont_sexo\":\"Masculino\",\"cont_fecha_nacimiento\":\"1981-10-10\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"3\",\"cont_nacionalidad\":\"CHILENO\",\"cont_email\":\"RMARTINEZVCL@GMAIL.COM\",\"cont_telefono\":\"+56993201821\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Las Magnolias 38, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.010463857095544\",\"cont_longitud\":\"-71.50242944498291\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Presencial\",\"oirs_condicion\":\"6\",\"oirs_fecha_hora\":\"2026-02-17 16:00\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"3\",\"oirs_calle\":\"Las Magnolias 35, 2551469 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"1\",\"oirs_descripcion\":\"TENGO UN PROBLEMA\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.01050348820447\",\"oirs_longitud\":\"-71.5022470217041\",\"oirs_respuesta\":\"\",\"documentos\":[{\"nombre\":\"2512012877.pdf\"}]},\"response\":{\"status\":\"success\",\"id\":\"2\",\"rgt_id\":\"21\"}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(100,'2026-02-17 17:54:54','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-19 19:44:53'),
(101,'2026-02-18 09:30:07','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(102,'2026-02-18 09:32:39','LOGIN_SUCCESS','info','Bajo','Autenticación',15,'LOGIN','Usuario oirs.funcionario@test.cl inició sesión correctamente','{\"email\":\"oirs.funcionario@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(103,'2026-02-18 09:58:59','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(104,'2026-02-18 10:08:21','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(105,'2026-02-18 10:10:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(106,'2026-02-18 10:16:07','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 17','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"as\",\"tis_tipo\":\"1\",\"tis_contenido\":\"as\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-18\",\"destinos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(107,'2026-02-18 10:16:17','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 18','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba grafico2\",\"tis_tipo\":\"1\",\"tis_contenido\":\"as\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-18\",\"destinos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(108,'2026-02-18 10:16:24','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 19','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"ss\",\"tis_tipo\":\"2\",\"tis_contenido\":\"as\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-18\",\"destinos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(109,'2026-02-18 10:18:52','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 20','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"ff\",\"tis_tipo\":\"1\",\"tis_contenido\":\"sd\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-18\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-02-19 19:44:53'),
(110,'2026-02-20 12:32:39','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-20 12:32:39'),
(111,'2026-02-20 13:56:17','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-20 13:56:17'),
(112,'2026-02-20 13:56:28','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-20 13:56:28'),
(113,'2026-02-20 13:57:42','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-20 13:57:42'),
(114,'2026-02-20 15:06:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-20 15:06:01'),
(115,'2026-02-23 10:27:07','LOGIN_SUCCESS','info','Bajo','Autenticación',12,'LOGIN','Usuario desve.externo@test.cl inició sesión correctamente','{\"email\":\"desve.externo@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-23 10:27:07'),
(116,'2026-02-23 10:28:24','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-23 10:28:24'),
(117,'2026-02-23 10:56:30','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-23 10:56:30'),
(118,'2026-02-23 13:57:05','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 3','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_nacionalidad\":\"Chilena\",\"cont_email\":\"centrib@test.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"las verbenas 55 Casa 5 Depto 4 (condominio las peras)\",\"cont_latitud\":\"-33.0407908\",\"cont_longitud\":\"-71.5354864\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Tel\\u00e9fono\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-02-23 17:49\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"3\",\"oirs_calle\":\"Av. Libertad 1040, Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"16\",\"oirs_descripcion\":\"un perogigante llamadocliffor\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.011760372148515\",\"oirs_longitud\":\"-71.5490917220093\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"3\",\"rgt_id\":\"26\"}}','192.168.0.169','Exitoso',0,'2026-02-23 13:57:05'),
(119,'2026-02-23 16:03:24','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-23 16:03:24'),
(120,'2026-02-23 16:30:24','CREATE','info','Bajo','DESVE',10,'CREAR_SOLICITUD','Creación de solicitud DESVE: 3','{\"data\":{\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTE\",\"sol_ingreso_desve\":\"258\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"ORGANIZACION DE PUEBA 1\",\"sol_detalle\":\"\\u00f1lk,\\u00f1l\",\"sol_fecha_recepcion\":\"2026-02-23 00:00:00\",\"sol_prioridad_id\":\"2\",\"sol_sector_id\":\"2\",\"sol_fecha_vencimiento\":\"2026-03-04 00:00:00\",\"sol_observaciones\":\"{\\u00f1.{\\u00f1\",\"sol_responsable\":null,\"sol_origen_esp\":0,\"sol_latitud\":\"-33.023657\",\"sol_longitud\":\"-71.555372\",\"sol_direccion\":\"\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-23 16:30:24'),
(121,'2026-02-23 16:37:24','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-23 16:37:24'),
(122,'2026-02-24 09:44:34','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-24 09:44:34'),
(123,'2026-02-24 15:00:44','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-24 15:00:44'),
(124,'2026-02-24 15:01:10','LOGIN_SUCCESS','info','Bajo','Autenticación',11,'LOGIN','Usuario desve.funcionario@test.cl inició sesión correctamente','{\"email\":\"desve.funcionario@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-24 15:01:10'),
(125,'2026-02-24 15:01:36','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-24 15:01:36'),
(126,'2026-02-24 15:02:24','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:02:24'),
(127,'2026-02-24 15:02:55','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:02:55'),
(128,'2026-02-24 15:04:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:04:04'),
(129,'2026-02-24 15:04:15','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:04:15'),
(130,'2026-02-24 15:04:57','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:04:57'),
(131,'2026-02-24 15:07:04','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:07:04'),
(132,'2026-02-24 15:09:00','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-24 15:09:00'),
(133,'2026-02-25 09:48:02','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:48:02'),
(134,'2026-02-25 09:51:09','LOGIN_SUCCESS','info','Bajo','Autenticación',11,'LOGIN','Usuario desve.funcionario@test.cl inició sesión correctamente','{\"email\":\"desve.funcionario@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:51:09'),
(135,'2026-02-25 09:51:22','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:51:22'),
(136,'2026-02-25 09:54:18','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:54:18'),
(137,'2026-02-25 09:54:34','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:54:34'),
(138,'2026-02-25 09:54:46','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 09:54:46'),
(139,'2026-02-25 10:09:06','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-25 10:09:06'),
(140,'2026-02-25 10:11:14','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 10:11:14'),
(141,'2026-02-25 10:11:19','LOGIN_SUCCESS','info','Bajo','Autenticación',7,'LOGIN','Usuario ingresos.funcionario@test.cl inició sesión correctamente','{\"email\":\"ingresos.funcionario@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-25 10:11:19'),
(142,'2026-02-25 10:12:32','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 10:12:32'),
(143,'2026-02-25 10:13:43','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 10:13:43'),
(144,'2026-02-25 10:27:07','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-25 10:27:07'),
(145,'2026-02-25 10:48:32','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 10:48:32'),
(146,'2026-02-25 11:04:35','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 11:04:35'),
(147,'2026-02-25 11:24:53','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 11:24:53'),
(148,'2026-02-25 11:25:50','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-25 11:25:50'),
(149,'2026-02-25 11:28:38','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 11:28:38'),
(150,'2026-02-25 11:34:19','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-25 11:34:19'),
(151,'2026-02-25 11:37:02','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 6','{\"data\":{\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTE\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"3\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"2444\",\"sol_fecha_recepcion\":\"2026-02-25 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"16\",\"sol_fecha_vencimiento\":\"2026-02-27 00:00:00\",\"sol_observaciones\":\"1234\",\"sol_responsable\":\"1\",\"sol_origen_esp\":2,\"sol_latitud\":\"-33.022965\",\"sol_longitud\":\"-71.559446\",\"sol_direccion\":\"\",\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"},{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"},{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-25 11:37:02'),
(152,'2026-02-25 11:37:03','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 11:37:03'),
(153,'2026-02-25 11:47:48','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 11:47:48'),
(154,'2026-02-25 12:17:35','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 12:17:35'),
(155,'2026-02-25 12:17:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 12:17:43'),
(156,'2026-02-25 13:05:05','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 13:05:05'),
(157,'2026-02-25 13:17:15','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 13:17:15'),
(158,'2026-02-25 14:59:50','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 4','{\"id\":\"4\",\"cambios\":{\"sol_id\":\"4\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"3\",\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTE\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"2444s\",\"sol_fecha_recepcion\":\"2026-02-25 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"16\",\"sol_fecha_vencimiento\":\"2026-02-27\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"1234\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02296500\",\"sol_longitud\":\"-71.55944600\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"8\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"3\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"RAMON\",\"usr_apellido\":\"MARTINEZ\",\"usr_email\":\"ramon.martinez@munivina.cl\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"9\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"3\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"RAMON\",\"usr_apellido\":\"MARTINEZ\",\"usr_email\":\"ramon.martinez@munivina.cl\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"10\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-25 14:59:50'),
(159,'2026-02-25 15:04:16','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 4','{\"id\":\"4\",\"cambios\":{\"sol_id\":\"4\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"3\",\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTE\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"2444sd\",\"sol_fecha_recepcion\":\"2026-02-25 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"16\",\"sol_fecha_vencimiento\":\"2026-02-27\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"1234\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02296500\",\"sol_longitud\":\"-71.55944600\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"8\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"3\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"RAMON\",\"usr_apellido\":\"MARTINEZ\",\"usr_email\":\"ramon.martinez@munivina.cl\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"9\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"3\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"RAMON\",\"usr_apellido\":\"MARTINEZ\",\"usr_email\":\"ramon.martinez@munivina.cl\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"10\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 11:35:48\",\"tid_actualizacion\":\"2026-02-25 11:35:48\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-25 15:04:16'),
(160,'2026-02-25 15:05:21','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 4','{\"id\":\"4\",\"cambios\":{\"sol_id\":\"4\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"3\",\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTEv\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"2444sd\",\"sol_fecha_recepcion\":\"2026-02-25 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"16\",\"sol_fecha_vencimiento\":\"2026-02-27\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"1234\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02296500\",\"sol_longitud\":\"-71.55944600\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_destino\":\"2\",\"tid_solicitud\":\"2\",\"tid_fecha_respuesta\":null,\"tid_id\":\"2\",\"tid_responde\":null,\"usr_id\":\"2\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre\":\"LETICIA\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-25 15:05:21'),
(161,'2026-02-25 15:20:43','LOGIN_SUCCESS','info','Bajo','Autenticación',9,'LOGIN','Usuario desve.admin@test.cl inició sesión correctamente','{\"email\":\"desve.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 15:20:43'),
(162,'2026-02-25 15:53:03','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 2','{\"id\":\"2\",\"cambios\":{\"sol_id\":\"2\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"PRUEBA DESVE 001\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"HOLA LETI\",\"sol_fecha_recepcion\":\"2026-02-16 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-18\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_latitud\":null,\"sol_longitud\":null,\"sol_direccion\":null,\"destinos\":[{\"tid_id\":\"6\",\"tid_desve_solicitud\":\"2\",\"tid_destino\":\"12\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-19 19:44:52\",\"tid_actualizacion\":\"2026-02-19 19:44:52\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"EXTENO\",\"usr_email\":\"desve.externo@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE EXTENO\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":1,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-25 15:53:03'),
(163,'2026-02-25 15:55:49','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 15:55:49'),
(164,'2026-02-25 17:10:57','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-25 17:10:57'),
(165,'2026-02-26 09:33:17','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 4','{\"id\":\"4\",\"cambios\":{\"sol_id\":\"4\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"3\",\"sol_nombre_expediente\":\"REFUERZO DE EXPEDIENTEv\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"2444sd\",\"sol_fecha_recepcion\":\"2026-02-25 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"16\",\"sol_fecha_vencimiento\":\"2026-02-27\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"1234\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02296500\",\"sol_longitud\":\"-71.55944600\",\"sol_direccion\":\"\",\"destinos\":[{\"tid_id\":\"17\",\"tid_desve_solicitud\":\"4\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-25 15:05:21\",\"tid_actualizacion\":\"2026-02-25 15:05:21\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_destino\":\"1\",\"tid_solicitud\":\"1\",\"tid_fecha_respuesta\":null,\"tid_id\":\"1\",\"tid_responde\":null,\"usr_id\":\"1\",\"usr_apellido\":\"HERVAS\",\"usr_email\":\"juan.hervas@munivina.cl\",\"usr_nombre\":\"JUAN\",\"usr_nombre_completo\":\"JUAN HERVAS\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 09:33:17'),
(166,'2026-02-26 09:49:43','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 7','{\"data\":{\"sol_nombre_expediente\":\"Prueba admin 1\",\"sol_ingreso_desve\":\"a1\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"13\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"prueba #1\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_origen_esp\":2,\"sol_latitud\":\"-33.011249\",\"sol_longitud\":\"-71.540546\",\"sol_direccion\":\"13 norte, 2025\",\"destinos\":[{\"usr_id\":\"10\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 09:49:43'),
(167,'2026-02-26 09:53:07','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 09:53:07'),
(168,'2026-02-26 09:56:42','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 8','{\"data\":{\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba 2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02 00:00:00\",\"sol_observaciones\":\"no\",\"sol_responsable\":\"1\",\"sol_origen_esp\":2,\"sol_latitud\":\"-33.025213\",\"sol_longitud\":\"-71.562752\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"},{\"usr_id\":\"11\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\"}],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"},{\"nombre\":\"Doc1.docx\"}],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 09:56:42'),
(169,'2026-02-26 10:00:31','UPDATE','info','Bajo','DESVE',2,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba 2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"no\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.0212909\",\"sol_longitud\":\"-71.5561001\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"20\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 09:56:42\",\"tid_actualizacion\":\"2026-02-26 09:56:42\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"21\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 09:56:42\",\"tid_actualizacion\":\"2026-02-26 09:56:42\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.168','Exitoso',0,'2026-02-26 10:00:31'),
(170,'2026-02-26 10:06:43','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"no\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_destino\":\"2\",\"tid_solicitud\":\"2\",\"tid_fecha_respuesta\":null,\"tid_id\":\"2\",\"tid_responde\":null,\"usr_id\":\"2\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre\":\"LETICIA\",\"usr_nombre_completo\":\"LETICIA MENESES\"},{\"tid_destino\":\"11\",\"tid_solicitud\":\"11\",\"tid_fecha_respuesta\":null,\"tid_id\":\"11\",\"tid_responde\":null,\"usr_id\":\"11\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:06:43'),
(171,'2026-02-26 10:07:16','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"actualizo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"22\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:06:43\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"23\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:06:43\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:07:16'),
(172,'2026-02-26 10:09:06','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"actualizo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"22\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:08:46\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"23\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:08:46\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:09:06'),
(173,'2026-02-26 10:23:41','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 10:23:41'),
(174,'2026-02-26 10:28:19','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"actualizo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"22\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:23:33\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"23\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:06:43\",\"tid_actualizacion\":\"2026-02-26 10:23:33\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_destino\":\"10\",\"tid_solicitud\":\"10\",\"tid_fecha_respuesta\":null,\"tid_id\":\"10\",\"tid_responde\":null,\"usr_id\":\"10\",\"usr_apellido\":\"OPERADOR\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:28:19'),
(175,'2026-02-26 10:30:44','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 9','{\"data\":{\"sol_nombre_expediente\":\"prueba #3\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"3\",\"sol_origen_texto\":\"ASDDF\",\"sol_detalle\":\"pueba de creacion diferenciacion\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02 00:00:00\",\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_origen_esp\":0,\"sol_latitud\":\"-32.969046\",\"sol_longitud\":\"-71.540523\",\"sol_direccion\":\"avedmundoeluchans 560\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"},{\"usr_id\":\"11\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\"},{\"usr_id\":\"10\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\"}],\"documentos\":[],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:30:44'),
(176,'2026-02-26 10:54:48','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"actualizo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"24\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:28:19\",\"tid_actualizacion\":\"2026-02-26 10:28:19\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:54:48'),
(177,'2026-02-26 10:55:20','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 8','{\"id\":\"8\",\"cambios\":{\"sol_id\":\"8\",\"sol_ingreso_desve\":\"a2\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 2\",\"sol_origen_id\":\"12\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba #2\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"actualizo\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02129090\",\"sol_longitud\":\"-71.55610010\",\"sol_direccion\":\"aguasanta, 30\",\"destinos\":[{\"tid_id\":\"28\",\"tid_desve_solicitud\":\"8\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:54:48\",\"tid_actualizacion\":\"2026-02-26 10:54:48\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_destino\":\"2\",\"tid_solicitud\":\"2\",\"tid_fecha_respuesta\":null,\"tid_id\":\"2\",\"tid_responde\":null,\"usr_id\":\"2\",\"usr_apellido\":\"MENESES\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre\":\"LETICIA\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"sol_origen_esp\":2,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 10:55:20'),
(178,'2026-02-26 11:13:46','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:13:46'),
(179,'2026-02-26 11:14:47','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:14:47'),
(180,'2026-02-26 11:14:54','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:14:54'),
(181,'2026-02-26 11:18:40','LOGIN_SUCCESS','info','Bajo','Autenticación',10,'LOGIN','Usuario desve.operador@test.cl inició sesión correctamente','{\"email\":\"desve.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:18:40'),
(182,'2026-02-26 11:29:31','LOGIN_SUCCESS','info','Bajo','Autenticación',15,'LOGIN','Usuario oirs.funcionario@test.cl inició sesión correctamente','{\"email\":\"oirs.funcionario@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 11:29:31'),
(183,'2026-02-26 11:34:15','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:34:15'),
(184,'2026-02-26 11:45:01','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 11:45:01'),
(185,'2026-02-26 12:08:28','CREATE','info','Medio','OIRS',1,'CREAR_OIRS','Creación de solicitud OIRS: 5','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"11111111-1\",\"cont_nombres\":\"1\",\"cont_apellido_paterno\":\"1\",\"cont_apellido_materno\":\"1\",\"cont_sexo\":\"Otro\",\"cont_fecha_nacimiento\":\"1990-02-03\",\"cont_estado_civil\":\"Divorciado\\/a\",\"cont_escolaridad\":\"3\",\"cont_email\":\"centrib@test.cl\",\"cont_telefono\":\"+56944444444\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"las verbenas 55 Casa 5 Depto 4 (condominio las peras)\",\"cont_latitud\":\"-33.0407908\",\"cont_longitud\":\"-71.5354864\",\"oirs_tipo_atencion\":\"1\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"1\",\"oirs_creacion\":\"2026-02-26 16:06\",\"oirs_tematica\":\"2\",\"oirs_subtematica\":\"2\",\"oirs_calle\":\"plata ancha 20\",\"oirs_sector\":\"1\",\"oirs_descripcion\":\"aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.0153481\",\"oirs_longitud\":\"-71.55002759999999\",\"oirs_respuesta\":\"\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"5\",\"rgt_id\":\"35\"}}','192.168.0.169','Exitoso',0,'2026-02-26 12:08:28'),
(186,'2026-02-26 12:35:43','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 12:35:43'),
(187,'2026-02-26 12:50:51','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 9','{\"id\":\"9\",\"cambios\":{\"sol_id\":\"9\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin #3\",\"sol_origen_id\":\"3\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba de creacion diferenciacion\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-32.96904600\",\"sol_longitud\":\"-71.54052300\",\"sol_direccion\":\"avedmundoeluchans 560\",\"destinos\":[{\"tid_id\":\"25\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:30:44\",\"tid_actualizacion\":\"2026-02-26 10:30:44\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"26\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:30:44\",\"tid_actualizacion\":\"2026-02-26 10:30:44\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_id\":\"11\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_id\":\"27\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 10:30:44\",\"tid_actualizacion\":\"2026-02-26 10:30:44\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":0,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 12:50:51'),
(188,'2026-02-26 12:51:17','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 9','{\"id\":\"9\",\"cambios\":{\"sol_id\":\"9\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 3\",\"sol_origen_id\":\"3\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba de creacion diferenciacion\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-32.96904600\",\"sol_longitud\":\"-71.54052300\",\"sol_direccion\":\"avedmundoeluchans 560\",\"destinos\":[{\"tid_id\":\"31\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:50:51\",\"tid_actualizacion\":\"2026-02-26 12:50:51\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"32\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:50:51\",\"tid_actualizacion\":\"2026-02-26 12:50:51\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_id\":\"11\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_id\":\"33\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:50:51\",\"tid_actualizacion\":\"2026-02-26 12:50:51\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":0,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 12:51:17'),
(189,'2026-02-26 12:51:56','LOGIN_SUCCESS','info','Bajo','Autenticación',7,'LOGIN','Usuario ingresos.funcionario@test.cl inició sesión correctamente','{\"email\":\"ingresos.funcionario@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 12:51:56'),
(190,'2026-02-26 12:52:19','LOGIN_SUCCESS','info','Bajo','Autenticación',11,'LOGIN','Usuario desve.funcionario@test.cl inició sesión correctamente','{\"email\":\"desve.funcionario@test.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 12:52:19'),
(191,'2026-02-26 13:01:22','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 9','{\"id\":\"9\",\"cambios\":{\"sol_id\":\"9\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba admin 3\",\"sol_origen_id\":\"5\",\"sol_origen_texto\":\"TERRITOIAL\",\"sol_detalle\":\"pueba de creacion diferenciacion\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-32.96904600\",\"sol_longitud\":\"-71.54052300\",\"sol_direccion\":\"avedmundoeluchans 560\",\"destinos\":[{\"tid_id\":\"34\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:51:17\",\"tid_actualizacion\":\"2026-02-26 12:51:17\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"35\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:51:17\",\"tid_actualizacion\":\"2026-02-26 12:51:17\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_id\":\"11\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_id\":\"36\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 12:51:17\",\"tid_actualizacion\":\"2026-02-26 12:51:17\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":0,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 13:01:22'),
(192,'2026-02-26 13:22:47','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-26 13:22:47'),
(193,'2026-02-26 14:54:32','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-26 14:54:32'),
(194,'2026-02-26 14:57:21','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 10','{\"data\":{\"sol_nombre_expediente\":\"ramon 123\",\"sol_ingreso_desve\":\"123\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"2\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"este es un plan\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"11\",\"sol_fecha_vencimiento\":\"2026-03-02 00:00:00\",\"sol_observaciones\":\"este es un comentario\",\"sol_responsable\":\"1\",\"sol_origen_esp\":2,\"sol_latitud\":null,\"sol_longitud\":null,\"sol_direccion\":null,\"destinos\":[{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"}],\"documentos\":[{\"nombre\":\"2. Sistema Giro Electr\\u00f3nico.pdf\"}],\"ACCION\":\"CREAR\"}}','192.168.0.112','Exitoso',0,'2026-02-26 14:57:21'),
(195,'2026-02-26 14:59:41','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-26 14:59:41'),
(196,'2026-02-26 15:00:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-02-26 15:00:06'),
(197,'2026-02-26 15:16:40','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 9','{\"id\":\"9\",\"cambios\":{\"sol_id\":\"9\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"8\",\"sol_nombre_expediente\":\"prueba admin 3\",\"sol_origen_id\":\"5\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pueba de creacion diferenciacion\",\"sol_fecha_recepcion\":\"2026-02-26 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"13\",\"sol_fecha_vencimiento\":\"2026-03-02\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-32.96904600\",\"sol_longitud\":\"-71.54052300\",\"sol_direccion\":\"avedmundoeluchans 560\",\"destinos\":[{\"tid_id\":\"37\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 13:01:22\",\"tid_actualizacion\":\"2026-02-26 13:01:22\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_id\":\"38\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"11\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 13:01:22\",\"tid_actualizacion\":\"2026-02-26 13:01:22\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"FUNCIONAIO\",\"usr_id\":\"11\",\"usr_email\":\"desve.funcionario@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE FUNCIONAIO\",\"usr_area_nombre\":\"desarollo vecinal\"},{\"tid_id\":\"39\",\"tid_desve_solicitud\":\"9\",\"tid_destino\":\"10\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-26 13:01:22\",\"tid_actualizacion\":\"2026-02-26 13:01:22\",\"usr_nombre\":\"USUARIO DESVE\",\"usr_apellido\":\"OPERADOR\",\"usr_id\":\"10\",\"usr_email\":\"desve.operador@test.cl\",\"usr_nombre_completo\":\"USUARIO DESVE OPERADOR\",\"usr_area_nombre\":\"desarollo vecinal\"}],\"sol_origen_esp\":0,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-26 15:16:40'),
(198,'2026-02-26 15:28:29','LOGIN_SUCCESS','info','Bajo','Autenticación',3,'LOGIN','Usuario ramon.martinez@munivina.cl inició sesión correctamente','{\"email\":\"ramon.martinez@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 15:28:29'),
(199,'2026-02-26 15:28:39','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-26 15:28:39'),
(200,'2026-02-26 17:12:42','CREATE','info','Medio','OIRS',13,'CREAR_OIRS','Creación de solicitud OIRS: 6','{\"data\":{\"ACCION\":\"CREAR\",\"cont_tipo_persona\":\"natural\",\"cont_rut\":\"12123123-5\",\"cont_nombres\":\"cecilia\",\"cont_apellido_paterno\":\"jara\",\"cont_apellido_materno\":\"jara\",\"cont_sexo\":\"Femenino\",\"cont_fecha_nacimiento\":\"1958-05-12\",\"cont_estado_civil\":\"Casado\\/a\",\"cont_escolaridad\":\"5\",\"cont_email\":\"notiene@gmail.com\",\"cont_telefono\":\"+56995456123\",\"cont_razon_social\":\"\",\"cont_rep_rut\":\"\",\"cont_direccion\":\"Jose M. Carrera 402, 2540187 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"cont_latitud\":\"-33.03005901869927\",\"cont_longitud\":\"-71.571251379776\",\"oirs_tipo_atencion\":\"4\",\"oirs_origen_consulta\":\"Web\",\"oirs_condicion\":\"3\",\"oirs_creacion\":\"2026-02-26 17:11\",\"oirs_tematica\":\"3\",\"oirs_subtematica\":\"4\",\"oirs_calle\":\"Etchevers 309, 2571542 Vi\\u00f1a del Mar, Valpara\\u00edso, Chile\",\"oirs_sector\":\"11\",\"oirs_descripcion\":\"felicitaci\\u00f3n\",\"oirs_estado\":1,\"oirs_latitud\":\"-33.02559743923472\",\"oirs_longitud\":\"-71.5558340423584\",\"oirs_respuesta\":\"muchas gracias por lasfelicitaciones\",\"documentos\":[]},\"response\":{\"status\":\"success\",\"id\":\"6\",\"rgt_id\":\"37\"}}','192.168.0.168','Exitoso',0,'2026-02-26 17:12:42'),
(201,'2026-02-27 10:50:46','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-27 10:50:46'),
(202,'2026-02-27 11:09:48','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 11:09:48'),
(203,'2026-02-27 13:18:20','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 13:18:20'),
(204,'2026-02-27 13:56:38','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 22','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"revisi\\u00f3n decreto 5254\",\"tis_tipo\":\"2\",\"tis_contenido\":\"favor revisar decreto dentro de la fecha estipulada\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-02-27\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Firmante\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-02-27 13:56:38'),
(205,'2026-02-27 14:01:15','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 14:01:15'),
(206,'2026-02-27 14:47:07','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 14:47:07'),
(207,'2026-02-27 15:42:48','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-02-27 15:42:48'),
(208,'2026-02-27 15:49:08','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 11','{\"data\":{\"sol_nombre_expediente\":\"prueba mail\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"1 1 1\",\"sol_detalle\":\"pryeba email\",\"sol_fecha_recepcion\":\"2026-02-27 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-03 00:00:00\",\"sol_observaciones\":\"aaa\",\"sol_responsable\":\"1\",\"sol_origen_esp\":1,\"sol_latitud\":\"-33.027073\",\"sol_longitud\":\"-71.560665\",\"sol_direccion\":\"ecuador , 644\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\"}],\"documentos\":[{\"nombre\":\"certificado pisee1.pdf\"}],\"ACCION\":\"CREAR\"}}','192.168.0.169','Exitoso',0,'2026-02-27 15:49:08'),
(209,'2026-02-27 15:50:09','UPDATE','info','Bajo','DESVE',1,'ACTUALIZAR_SOLICITUD','Actualización de solicitud DESVE: 11','{\"id\":\"11\",\"cambios\":{\"sol_id\":\"11\",\"sol_ingreso_desve\":\"\",\"sol_reingreso_id\":\"\",\"sol_nombre_expediente\":\"prueba mail\",\"sol_origen_id\":\"1\",\"sol_origen_texto\":\"\",\"sol_detalle\":\"pryeba email\",\"sol_fecha_recepcion\":\"2026-02-27 00:00:00\",\"sol_prioridad_id\":\"1\",\"sol_sector_id\":\"15\",\"sol_fecha_vencimiento\":\"2026-03-03\",\"sol_estado_entrega\":false,\"sol_observaciones\":\"aaa\",\"sol_responsable\":\"1\",\"sol_latitud\":\"-33.02707300\",\"sol_longitud\":\"-71.56066500\",\"sol_direccion\":\"ecuador , 644\",\"destinos\":[{\"tid_id\":\"44\",\"tid_desve_solicitud\":\"11\",\"tid_destino\":\"2\",\"tid_responde\":null,\"tid_fecha_respuesta\":null,\"tid_borrado\":\"0\",\"tid_creacion\":\"2026-02-27 15:49:05\",\"tid_actualizacion\":\"2026-02-27 15:49:05\",\"usr_nombre\":\"LETICIA\",\"usr_apellido\":\"MENESES\",\"usr_id\":\"2\",\"usr_email\":\"leticia.meneses@munivina.cl\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"usr_area_nombre\":\"transformacion digital\"},{\"tid_destino\":\"3\",\"tid_solicitud\":\"3\",\"tid_fecha_respuesta\":null,\"tid_id\":\"3\",\"tid_responde\":null,\"usr_id\":\"3\",\"usr_apellido\":\"MARTINEZ\",\"usr_email\":\"ramon.martinez@munivina.cl\",\"usr_nombre\":\"RAMON\",\"usr_nombre_completo\":\"RAMON MARTINEZ\"}],\"sol_origen_esp\":1,\"documentos\":[],\"ACCION\":\"ACTUALIZAR\"}}','192.168.0.169','Exitoso',0,'2026-02-27 15:50:09'),
(210,'2026-02-27 16:12:31','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 16:12:31'),
(211,'2026-02-27 16:22:23','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-02-27 16:22:23'),
(212,'2026-03-02 09:09:25','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-02 09:09:25'),
(213,'2026-03-02 09:25:47','CREATE','info','Bajo','INGRESOS',1,'CREAR_INGRESO','Creación de ingreso: 23','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba dise\\u00f1o001\",\"tis_tipo\":\"1\",\"tis_contenido\":\"pobar dise\\u00f1o\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-02\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.169','Exitoso',0,'2026-03-02 09:25:47'),
(214,'2026-03-02 09:57:05','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 09:57:05'),
(215,'2026-03-02 09:59:43','LOGIN_FAILED','warning','Medio','Autenticación',NULL,'LOGIN','Fallo inicio de sesión para ingresos.admin@teingresos.admin@test.clst.cl: Usuario no encontrado con el email proporcionado','{\"email\":\"ingresos.admin@teingresos.admin@test.clst.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Fallido',0,'2026-03-02 09:59:43'),
(216,'2026-03-02 10:00:37','LOGIN_SUCCESS','info','Bajo','Autenticación',6,'LOGIN','Usuario ingresos.operador@test.cl inició sesión correctamente','{\"email\":\"ingresos.operador@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:00:37'),
(217,'2026-03-02 10:04:29','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:04:29'),
(218,'2026-03-02 10:43:58','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:43:58'),
(219,'2026-03-02 10:46:38','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:46:38'),
(220,'2026-03-02 10:58:31','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:58:31'),
(221,'2026-03-02 10:58:42','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 10:58:42'),
(222,'2026-03-02 11:04:32','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:04:32'),
(223,'2026-03-02 11:05:00','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:05:00'),
(224,'2026-03-02 11:10:35','LOGIN_SUCCESS','info','Bajo','Autenticación',13,'LOGIN','Usuario oirs.admin@test.cl inició sesión correctamente','{\"email\":\"oirs.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:10:35'),
(225,'2026-03-02 11:10:42','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:10:42'),
(226,'2026-03-02 11:26:56','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:26:56'),
(227,'2026-03-02 11:27:17','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:27:17'),
(228,'2026-03-02 11:27:44','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.169\"}','192.168.0.169','Exitoso',0,'2026-03-02 11:27:44'),
(229,'2026-03-02 11:31:01','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 11:31:01'),
(230,'2026-03-02 15:27:25','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 15:27:25'),
(231,'2026-03-02 15:28:40','CREATE','info','Bajo','INGRESOS',2,'CREAR_INGRESO','Creación de ingreso: 24','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"prueba responder\",\"tis_tipo\":\"1\",\"tis_contenido\":\"prueba archivo responder\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-02\",\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"LETICIA MENESES\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Visador\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[{\"nombre\":\"Listado_Ingresos_DESVE.pdf\"}]}}','192.168.0.168','Exitoso',0,'2026-03-02 15:28:40'),
(232,'2026-03-02 15:30:17','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"192.168.0.112\"}','192.168.0.112','Exitoso',0,'2026-03-02 15:30:17'),
(233,'2026-03-02 15:38:45','LOGIN_SUCCESS','info','Bajo','Autenticación',4,'LOGIN','Usuario ingresos.admin@test.cl inició sesión correctamente','{\"email\":\"ingresos.admin@test.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso',0,'2026-03-02 15:38:45'),
(234,'2026-03-02 15:47:58','CREATE','info','Bajo','INGRESOS',4,'CREAR_INGRESO','Creación de ingreso: 25','{\"data\":{\"ACCION\":\"CREAR\",\"tis_titulo\":\"Test Debug Ver\",\"tis_tipo\":\"1\",\"tis_contenido\":\"Test content for debugging the ver.php page error.\",\"tis_estado\":\"Ingresado\",\"tis_fecha\":\"2026-03-02\",\"destinos\":[{\"usr_id\":\"1\",\"usr_nombre_completo\":\"JUAN HERVAS\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"},{\"usr_id\":\"3\",\"usr_nombre_completo\":\"RAMON MARTINEZ\",\"tid_tipo\":\"Para\",\"tid_facultad\":\"Responsable\",\"tid_tarea\":\"ejecutar lo requerido\",\"tid_requeido\":\"1\"}],\"enlaces\":[],\"documentos\":[]}}','192.168.0.168','Exitoso',0,'2026-03-02 15:47:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_mails_enviados`
--

LOCK TABLES `trd_general_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_general_mails_enviados` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_mails_enviados` VALUES
(1,40,2,NULL,'{\"asunto\":\"DESVE - Solicitud creación: prueba mail\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Creación de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>creación<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>11<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba mail<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>pryeba email<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-02-27 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-03 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>aaa<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-02-27 15:49:08','2026-02-27 15:49:08'),
(2,40,2,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: prueba mail\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>LETICIA MENESES<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>11<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba mail<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>pryeba email<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-02-27 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-03<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>aaa<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"leticia.meneses@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-02-27 15:50:07','2026-02-27 15:50:07'),
(3,40,3,NULL,'{\"asunto\":\"DESVE - Solicitud actualización: prueba mail\",\"cuerpo\":\"\\r\\n        <div style=\'font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;\'>\\r\\n            <div style=\'background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;\'>\\r\\n                <h2 style=\'margin: 0;\'>DESVE - Actualización de Solicitud<\\/h2>\\r\\n            <\\/div>\\r\\n            <div style=\'border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;\'>\\r\\n                <p>Estimado\\/a <strong>RAMON MARTINEZ<\\/strong>,<\\/p>\\r\\n                <p>Se le informa que se ha realizado la <strong>actualización<\\/strong> de la siguiente solicitud DESVE:<\\/p>\\r\\n                <table style=\'width: 100%; border-collapse: collapse; margin: 15px 0;\'>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; width: 40%; color: #555;\'>N° Solicitud:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>11<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Nombre Expediente:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>prueba mail<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Detalle:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>pryeba email<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Recepción:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-02-27 00:00:00<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Fecha Vencimiento:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>2026-03-03<\\/td>\\r\\n                    <\\/tr>\\r\\n                    <tr style=\'border-bottom: 1px solid #eee; background-color: #f9f9f9;\'>\\r\\n                        <td style=\'padding: 8px; font-weight: bold; color: #555;\'>Observaciones:<\\/td>\\r\\n                        <td style=\'padding: 8px;\'>aaa<\\/td>\\r\\n                    <\\/tr>\\r\\n                <\\/table>\\r\\n                <p style=\'color: #777; font-size: 12px; margin-top: 20px;\'>\\r\\n                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.\\r\\n                <\\/p>\\r\\n            <\\/div>\\r\\n        <\\/div>\",\"email\":\"ramon.martinez@munivina.cl\",\"enviado\":true,\"error\":null}',0,'2026-02-27 15:50:09','2026-02-27 15:50:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_multiancestro` VALUES
(1,7,8,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,12,13,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,8,22,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(4,8,23,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,8,24,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,25,8,0,'2026-02-19 19:44:53','2026-02-19 19:44:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_expedientes`
--

LOCK TABLES `trd_general_registro_general_expedientes` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_expedientes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_expedientes` VALUES
(4,'260206-1558-Ingreso_ingresos-wp','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(5,'260206-1706-Ingreso_ingresos-Ze','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(6,'260206-1712-Ingreso_ingresos-cF','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(7,'260206-1713-Ingreso_ingresos-kB','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(8,'260206-1721-Ingreso_ingresos-hB','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(9,'260206-1758-Ingreso_ingresos-zh','Ingreso_ingresos',NULL,3,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(10,'260206-1819-Ingreso_ingresos-dO','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(11,'260210-2103-Ingreso_ingresos-hz','Ingreso_ingresos',NULL,3,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(12,'260212-2029-Ingreso_ingresos-7j','Ingreso_ingresos',NULL,4,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(13,'260212-2053-Ingreso_ingresos-ap','Ingreso_ingresos',NULL,6,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(14,'260213-1458-Ingreso_ingresos-5n','Ingreso_ingresos',NULL,6,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(15,'260213-1531-Ingreso_ingresos-Ve','Ingreso_ingresos',NULL,3,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(16,'260213-1608-Ingreso_ingresos-1u','Ingreso_ingresos',NULL,6,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(18,'260213-1749-desve_solicitud-Rz','desve_solicitud',NULL,10,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(19,'260216-1353-desve_solicitud-J1','desve_solicitud',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(20,'260217-1352-OIRS-Dm','oirs',NULL,1,1,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(21,'260217-2004-OIRS-GO','oirs',NULL,1,2,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(22,'260218-1416-Ingreso_ingresos-YP','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(23,'260218-1416-Ingreso_ingresos-2w','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(24,'260218-1416-Ingreso_ingresos-xo','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(25,'260218-1418-Ingreso_ingresos-bJ','Ingreso_ingresos',NULL,1,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(26,'260223-1757-OIRS-IO','oirs',NULL,1,1,0,'2026-02-23 13:57:05','2026-02-23 13:57:05'),
(27,'260223-2030-desve_solicitud-XY','desve_solicitud',NULL,10,NULL,0,'2026-02-23 16:30:24','2026-02-23 16:30:24'),
(28,'260225-1535-desve_solicitud-C2','desve_solicitud',NULL,1,NULL,0,'2026-02-25 11:35:48','2026-02-25 11:35:48'),
(29,'260225-1536-desve_solicitud-SN','desve_solicitud',NULL,1,NULL,0,'2026-02-25 11:36:08','2026-02-25 11:36:08'),
(30,'260225-1537-desve_solicitud-IC','desve_solicitud',NULL,1,NULL,0,'2026-02-25 11:37:02','2026-02-25 11:37:02'),
(31,'260226-1349-desve_solicitud-MG','desve_solicitud',NULL,1,NULL,0,'2026-02-26 09:49:43','2026-02-26 09:49:43'),
(32,'260226-1356-desve_solicitud-sa','desve_solicitud',NULL,1,NULL,0,'2026-02-26 09:56:42','2026-02-26 09:56:42'),
(33,'260226-1430-desve_solicitud-4V','desve_solicitud',NULL,1,NULL,0,'2026-02-26 10:30:44','2026-02-26 10:30:44'),
(34,'260226-1607-OIRS-mB','oirs',NULL,1,1,0,'2026-02-26 12:07:30','2026-02-26 12:07:30'),
(35,'260226-1608-OIRS-uS','oirs',NULL,1,1,0,'2026-02-26 12:08:28','2026-02-26 12:08:28'),
(36,'260226-1857-desve_solicitud-YD','desve_solicitud',NULL,1,NULL,0,'2026-02-26 14:57:21','2026-02-26 14:57:21'),
(37,'260226-2112-OIRS-Hl','oirs',NULL,13,4,0,'2026-02-26 17:12:42','2026-02-26 17:12:42'),
(38,'260227-1755-Ingreso_ingresos-vK','Ingreso_ingresos',NULL,3,NULL,0,'2026-02-27 13:55:00','2026-03-02 10:08:49'),
(39,'260227-1756-Ingreso_ingresos-Ro','Ingreso_ingresos',NULL,3,NULL,0,'2026-02-27 13:56:38','2026-03-02 10:08:49'),
(40,'260227-1949-desve_solicitud-4d','desve_solicitud',NULL,1,NULL,0,'2026-02-27 15:49:05','2026-02-27 15:49:05'),
(41,'260302-1325-Ingreso_ingresos-YD','Ingreso_ingresos',NULL,1,NULL,0,'2026-03-02 09:25:47','2026-03-02 09:25:47'),
(42,'260302-1928-Ingreso_ingresos-Ef','Ingreso_ingresos',NULL,2,NULL,0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(43,'260302-1947-Ingreso_ingresos-iS','Ingreso_ingresos',NULL,4,NULL,0,'2026-03-02 15:47:58','2026-03-02 15:47:58');
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
  `tid_facultad` enum('Firmante','Visador','Consultor','Responsable') NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_destinos` VALUES
(18,4,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 13:05:20',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(19,5,1,'Para',NULL,NULL,'Firmante',1,1,'2026-02-06 13:11:18',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(20,6,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 13:12:52',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(21,7,1,'Para','',NULL,'Firmante',1,0,'2026-02-13 11:06:36',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(22,9,2,'Copia',NULL,NULL,'Visador',1,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(23,9,1,'Para',NULL,NULL,'Firmante',1,0,'2026-02-06 14:00:47',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(25,10,3,'Para','ingrewso de respuesta con texto 01',NULL,'Responsable',1,1,'2026-02-06 15:11:30',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(26,11,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(27,11,2,'Para','',NULL,'Visador',1,1,'2026-02-10 17:05:13',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(28,12,8,'Para',NULL,NULL,'Consultor',0,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(29,12,6,'Para','no por que no quiero',NULL,'Firmante',1,0,'2026-02-13 09:55:48',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(31,13,8,'Para','','ejecutar lo requerido','Firmante',1,0,'2026-02-13 09:57:55',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(32,14,1,'Para','siiii',NULL,'Firmante',1,1,'2026-02-13 11:01:40',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(33,14,8,'Para','',NULL,'Visador',1,1,'2026-02-13 11:00:31',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(34,15,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(35,15,2,'Para','',NULL,'Visador',1,1,'2026-02-13 11:34:59',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(36,16,8,'Para',NULL,NULL,'Visador',1,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(37,20,2,'Para',NULL,NULL,'Firmante',1,NULL,NULL,0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(38,21,2,'Para',NULL,NULL,'Firmante',1,NULL,NULL,0,'2026-02-27 13:55:00','2026-02-27 13:55:00'),
(39,22,2,'Para',NULL,NULL,'Firmante',1,NULL,NULL,0,'2026-02-27 13:56:38','2026-02-27 13:56:38'),
(40,23,2,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-02 09:25:47','2026-03-02 09:25:47'),
(41,24,2,'Para',NULL,NULL,'Visador',1,NULL,NULL,0,'2026-03-02 15:28:40','2026-03-02 15:28:40'),
(42,25,1,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-02 15:47:58','2026-03-02 15:47:58'),
(43,25,3,'Para',NULL,NULL,'Responsable',1,NULL,NULL,0,'2026-03-02 15:47:58','2026-03-02 15:47:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(4,1,'prueba ingreso de ingreso 001','detalle de solicitud 3','Resuelto_NO_Favorable',1,'halo','2026-02-06 00:00:00',NULL,4,0,'2026-02-19 19:44:53'),
(5,1,'prueba ingreso de ingreso 002','prueba 2 ','Resuelto_Favorable',1,'.','2026-02-06 00:00:00',NULL,5,0,'2026-02-19 19:44:53'),
(6,1,'prueba ingreso de ingreso 003','ASD','Resuelto_NO_Favorable',1,'.','2026-02-06 00:00:00',NULL,6,0,'2026-02-19 19:44:53'),
(7,2,'prueba ingreso de ingreso 004','','Resuelto_NO_Favorable',1,NULL,'2026-02-06 00:00:00',NULL,7,0,'2026-02-19 19:44:53'),
(8,1,'comprar papel hijenico','por favorelpapel','Ingresado',1,NULL,'2026-02-06 00:00:00',NULL,8,0,'2026-02-19 19:44:53'),
(9,1,'Revisión de ingreso','por favor revisar esta información','Ingresado',3,'cualquier cosa','2026-02-06 00:00:00',NULL,9,0,'2026-02-19 19:44:53'),
(10,1,'revision 1','test 1','Resuelto_Favorable',1,NULL,'2026-02-06 00:00:00',NULL,10,0,'2026-02-19 19:44:53'),
(11,1,'revisión de muchas cosas','por favor revisar documento atendido','Ingresado',3,NULL,'2026-02-10 00:00:00',NULL,11,0,'2026-02-19 19:44:53'),
(12,1,'prueba ingreso de ingreso 001','asd','Resuelto_NO_Favorable',4,NULL,'2026-02-12 00:00:00',NULL,12,0,'2026-02-19 19:44:53'),
(13,1,'solicitud hija1','asdf2','Resuelto_NO_Favorable',6,NULL,'2026-02-12 00:00:00',NULL,13,0,'2026-02-19 19:44:53'),
(14,1,'prueba ingreso de ingreso 002','qwe','Resuelto_Favorable',6,NULL,'2026-02-13 00:00:00','2026-03-13',14,0,'2026-02-19 19:44:53'),
(15,1,'revisión de plataforma','solicito revisar la información contenida en el documento\n\n','Ingresado',3,NULL,'2026-02-13 00:00:00','2026-03-13',15,0,'2026-02-19 19:44:53'),
(16,1,'testo','sadc','Ingresado',6,NULL,'2026-02-13 00:00:00','2026-03-13',16,0,'2026-02-19 19:44:53'),
(17,1,'as','as','Ingresado',1,NULL,'2026-02-18 00:00:00','2026-03-18',22,0,'2026-02-19 19:44:53'),
(18,1,'prueba grafico2','as','Ingresado',1,NULL,'2026-02-18 00:00:00','2026-03-18',23,0,'2026-02-19 19:44:53'),
(19,2,'ss','as','Ingresado',1,NULL,'2026-02-18 00:00:00','2026-03-18',24,0,'2026-02-19 19:44:53'),
(20,1,'ff','sd','Ingresado',1,NULL,'2026-02-18 00:00:00','2026-03-18',25,0,'2026-02-19 19:44:53'),
(21,2,'revisión decreto 5254','favor revisar decreto dentro de la fecha estipulada','Ingresado',3,NULL,'2026-02-27 00:00:00','2026-03-27',38,0,'2026-03-02 09:47:48'),
(22,2,'revisión decreto 5254','favor revisar decreto dentro de la fecha estipulada','Ingresado',3,NULL,'2026-02-27 00:00:00','2026-03-27',39,0,'2026-03-02 09:47:48'),
(23,1,'prueba diseño001','pobar diseño','Ingresado',1,NULL,'2026-03-02 00:00:00','2026-03-30',41,0,'2026-03-02 09:25:47'),
(24,1,'prueba responder','prueba archivo responder','Ingresado',2,NULL,'2026-03-02 00:00:00','2026-03-30',42,0,'2026-03-02 15:28:40'),
(25,1,'Test Debug Ver','Test content for debugging the ver.php page error.','Ingresado',4,NULL,'2026-03-02 00:00:00','2026-03-30',43,0,'2026-03-02 15:47:58');
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
  `tlh_vulnerable` int(11) NOT NULL,
  `tlh_cupo` tinyint(4) DEFAULT NULL,
  `tlh_creacion` datetime DEFAULT current_timestamp(),
  `tlh_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tlh_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_tramite`
--

LOCK TABLES `trd_licencias_tramite` WRITE;
/*!40000 ALTER TABLE `trd_licencias_tramite` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_tramite` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_licencias_vulnerable`
--

DROP TABLE IF EXISTS `trd_licencias_vulnerable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_licencias_vulnerable` (
  `tlv_id` int(11) NOT NULL AUTO_INCREMENT,
  `tlv_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tlv_borrado` tinyint(1) DEFAULT 0,
  `tlv_creacion` datetime DEFAULT current_timestamp(),
  `tlv_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`tlv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_licencias_vulnerable`
--

LOCK TABLES `trd_licencias_vulnerable` WRITE;
/*!40000 ALTER TABLE `trd_licencias_vulnerable` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_licencias_vulnerable` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_asignaciones`
--

LOCK TABLES `trd_oirs_asignaciones` WRITE;
/*!40000 ALTER TABLE `trd_oirs_asignaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_asignaciones` VALUES
(1,1,1,1,'asdasd',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(2,1,2,1,'',0,'2026-02-19 19:44:53','2026-02-19 19:44:53'),
(3,3,10,1,'',0,'2026-02-23 14:54:54','2026-02-23 14:54:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_gestion`
--

LOCK TABLES `trd_oirs_gestion` WRITE;
/*!40000 ALTER TABLE `trd_oirs_gestion` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_gestion` VALUES
(3,3,NULL,'',1,'',0,NULL,NULL,NULL,NULL,NULL,0,'2026-02-23 13:57:05','2026-02-23 14:37:39'),
(4,4,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-02-26 12:07:30','2026-02-26 12:07:30'),
(5,5,NULL,'',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-02-26 12:08:28','2026-02-26 12:08:28'),
(6,6,NULL,'muchas gracias por lasfelicitaciones',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2026-02-26 17:12:42','2026-02-26 17:12:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_oirs_solicitud`
--

LOCK TABLES `trd_oirs_solicitud` WRITE;
/*!40000 ALTER TABLE `trd_oirs_solicitud` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_oirs_solicitud` VALUES
(3,26,1,'Teléfono',1,1,'2026-02-23 13:57:05',2,3,'Av. Libertad 1040, Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.01176037,-71.54909172,16,'un perogigante llamadocliffor',0,'2026-03-16',0,'2026-02-23 13:57:05','Av. Libertad 1040, Viña del Mar, Valparaíso, Chile',1),
(4,34,1,'Web',1,1,'2026-02-26 12:07:30',2,2,'plata ancha 20',NULL,NULL,-33.01534810,-71.55002760,1,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',0,'2026-03-19',0,'2026-02-26 12:07:30','plata ancha 20',1),
(5,35,1,'Web',1,1,'2026-02-26 12:08:28',2,2,'plata ancha 20',NULL,NULL,-33.01534810,-71.55002760,1,'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',0,'2026-03-19',0,'2026-02-26 12:08:28','plata ancha 20',1),
(6,37,4,'Web',3,1,'2026-02-26 17:12:42',3,4,'Etchevers 309, 2571542 Viña del Mar, Valparaíso, Chile',NULL,NULL,-33.02559744,-71.55583404,11,'felicitación',1,'2026-03-19',0,'2026-02-26 17:12:42','Etchevers 309, 2571542 Viña del Mar, Valparaíso, Chile',13);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_tareas`
--

LOCK TABLES `trd_tareas` WRITE;
/*!40000 ALTER TABLE `trd_tareas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_tareas` VALUES
(1,1,1,'1','2','2026-02-16 08:00:00',1,'2026-02-09 11:40:36',0,'2026-02-19 19:44:53'),
(2,1,1,'2','2','2026-02-16 08:00:00',1,'2026-02-09 11:40:36',0,'2026-02-19 19:44:53'),
(3,1,1,'3','3','2026-02-16 08:00:00',1,'2026-02-09 11:40:36',0,'2026-02-19 19:44:53'),
(4,1,1,'4','4','2026-02-16 08:00:00',1,'2026-02-09 11:51:34',0,'2026-02-19 19:44:53'),
(5,1,1,'5','5','2026-02-16 08:00:00',1,'2026-02-09 11:52:18',0,'2026-02-19 19:44:53'),
(6,1,3,'revisart ingresos','hay que revisar todo el sistema d ingresos','2026-02-16 08:00:00',0,'2026-02-09 12:25:18',0,'2026-02-19 19:44:53'),
(7,1,3,'6','6','2026-02-16 08:00:00',0,'2026-02-09 12:48:16',0,'2026-02-19 19:44:53'),
(8,10,3,'revisión de deforestación','supervisar la poda de arboles del sector plan - centro','2026-03-23 08:00:00',0,'2026-02-20 12:55:19',0,'2026-02-20 12:55:19'),
(9,10,10,'revisar contratos sistema oirs','realizar la revisión de las clausulas 1 y 2 del sistema oirs','2026-02-23 08:00:00',1,'2026-02-20 13:02:14',0,'2026-02-20 13:02:44');
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

-- Dump completed on 2026-03-02 15:57:04
