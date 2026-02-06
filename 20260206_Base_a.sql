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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(9,'Abogado_DESVE',0,'2026-02-02 15:42:11','2026-02-02 15:42:11');
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
(1,'1.2.1.3',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(1,'1.2.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55'),
(1,'1.2.2.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.2',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56'),
(1,'1.2.3.4',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(1,'1.2.3.5',0,'2026-02-02 08:34:57','2026-02-02 08:34:57'),
(1,'0',0,'2026-02-02 08:40:58','2026-02-02 08:40:58'),
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
(9,'4',0,'2026-02-02 15:52:03','2026-02-02 15:52:03');
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
('0','Bandeja','paginas/Bandeja.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1','Administracion sistema',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-30 15:46:31'),
('1.1','Logs del Sistema',NULL,'subcategoria',0,'2025-12-29 12:53:09','2026-01-30 15:46:31'),
('1.1.1','Consulta de Log','paginas/logs_consulta_log.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:46:31'),
('1.1.2','Listado de Logs','paginas/logs_listado_logs.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:46:31'),
('1.1.3','Acceso','','subcategoria',1,'2026-01-30 11:29:05','2026-01-30 15:46:31'),
('1.2','Mantenedores',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-30 15:46:31'),
('1.2.1','General',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-30 15:46:31'),
('1.2.1.1','Contribuyentes','paginas/sisadmin_mantenedor_general_contribuyentes.html','Pagina',0,'2026-01-14 09:33:54','2026-01-30 15:46:31'),
('1.2.1.2','Organizaciones Comunitarias','paginas/sisadmin_mantenedor_general_org_comunitarias.html','Pagina',0,'2026-01-26 10:30:51','2026-01-30 15:46:31'),
('1.2.1.3','Roles','sisadmin_mantenedor_acceso_roles.html','Pagina',1,'2026-01-30 11:27:02','2026-02-03 16:45:09'),
('1.2.2','DESVE','','subcategoria',0,'2026-01-26 10:28:30','2026-01-30 15:46:31'),
('1.2.2.1','Oigenes especiales','paginas/sisadmin_mantenedor_desve_oigenesespeciales.html','Pagina',0,'2026-01-26 10:30:51','2026-01-30 15:46:31'),
('1.2.3','Acceso','','subcategoria',0,'2026-01-30 11:30:27','2026-01-30 15:46:31'),
('1.2.3.1','Usuaios','paginas/sisadmin_mantenedor_acceso_usuarios.html','Pagina',0,'2026-01-30 11:33:12','2026-01-30 15:46:31'),
('1.2.3.2','Usuarios por Perfil','paginas/sisadmin_mantenedor_acceso_usuarios_perfiles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31'),
('1.2.3.3','Perfiles','paginas/sisadmin_mantenedor_acceso_perfiles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31'),
('1.2.3.4','Perfiles por Rol','paginas/sisadmin_mantenedor_acceso_perfiles_roles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31'),
('1.2.3.5','Roles','paginas/sisadmin_mantenedor_acceso_roles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31'),
('11','Patentes',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('11.1','Mis Solicitudes','paginas/patentes_mis_solicitudes.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('11.2','Pagos','paginas/pagos.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('11.3','Solicitud Única de Patentes','paginas/patentes_solicitud_unica.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('11.4','Consulta de Solicitud','paginas/patentes_consulta_solicitud.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('11.c','Gestión de Empresas','paginas/contribuyente_empresas.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41'),
('2','Organizaciones Comunitarias',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1','Organizaciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1.1','Consulta Organizacion','paginas/organizaciones_consulta_organizacion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1.2','Consulta Masiva Organizaciones','paginas/organizaciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3','Subvenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1','Subvenciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.1','Consulta de Subvención','paginas/subvenciones_consulta_subvencion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.2','Consulta Masiva de Subvenciones','paginas/subvenciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.7','Consulta Masiva de Pagos','paginas/subvenciones_consulta_masiva_pagos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.2','Postulaciones',NULL,NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13'),
('3.2.1','Consulta de Postulación','paginas/postulaciones_consulta_postulacion.html',NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13'),
('3.2.2','Consulta Masiva de Postulaciones','paginas/postulaciones_consulta_masiva.html',NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13'),
('4','DESVE',NULL,'categoria',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.1','Nuevo Ingreso ','paginas/desve_nuevo.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.2','Listado ','paginas/desve_listado_ingresos.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.3','Historial ','paginas/desve_historial.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.4','Edicion ','paginas/desve_modificar.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.5','Responder ','paginas/desve_responder.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('4.6','Consulta ','paginas/desve_consultar.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42'),
('5','Atenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1','Lista de espera','paginas/atenciones_lista_espera.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05'),
('5.2','Historial','paginas/atenciones_listado_atenciones.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05'),
('5.3','Nueva','paginas/atenciones_nueva_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05'),
('5.4','Tomar Atención','paginas/atenciones_tomar_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05'),
('5.5','Consultar','paginas/atenciones_consulta_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05'),
('8','Ingresos',NULL,'categoria',0,'2026-01-19 10:44:56','2026-01-19 11:14:39'),
('8.1','Bandeja','paginas/ingr_bandeja.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.2','Crear ','paginas/ingr_crear.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.3','Consultar ','paginas/ingr_consultar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.4','Moificar ','paginas/ingr_modificar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.5','Respoder','paginas/ingr_responder.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.6','Preparar','paginas/ingr_preparar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-26 08:06:32'),
('8.7','Historial ','paginas/ingr_historial.html','Pagina',0,'2026-01-26 07:52:09','2026-01-26 07:52:09');
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
  `usr_borrado` tinyint(1) DEFAULT 0,
  `usr_creacion` datetime DEFAULT current_timestamp(),
  `usr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_rut` (`usr_rut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_usuarios`
--

LOCK TABLES `trd_acceso_usuarios` WRITE;
/*!40000 ALTER TABLE `trd_acceso_usuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_usuarios` VALUES
(1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',0,'2025-12-29 12:53:09','2026-01-07 13:43:55'),
(2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',0,'2026-01-06 11:47:58','2026-01-06 11:48:23'),
(3,'Ramon','Evil Guy','14037230-7','ramon.martinez@munivina.cl',0,'2026-01-09 10:13:01','2026-01-09 10:13:01');
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
(1,2,NULL,NULL,NULL,1,'2026-01-06 18:28:37','2026-01-19 13:32:10'),
(1,3,NULL,NULL,NULL,1,'2026-01-06 16:51:57','2026-01-19 13:32:18'),
(1,4,NULL,NULL,NULL,0,'2026-01-30 13:48:40','2026-01-30 13:48:40'),
(1,5,NULL,NULL,NULL,1,'2026-01-29 12:49:37','2026-01-29 13:12:46'),
(1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(3,4,NULL,NULL,NULL,1,'2026-02-02 15:40:43','2026-02-02 15:43:08'),
(3,6,NULL,NULL,NULL,1,'2026-01-09 10:15:40','2026-01-28 16:45:06'),
(3,9,NULL,'2026-02-03 15:43:00',NULL,0,'2026-02-02 15:43:23','2026-02-02 15:43:23');
/*!40000 ALTER TABLE `trd_acceso_usuarios_perfiles` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_destinos`
--

LOCK TABLES `trd_desve_destinos` WRITE;
/*!40000 ALTER TABLE `trd_desve_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_destinos` VALUES
(26,62,2,NULL,NULL),
(27,61,1,NULL,NULL),
(28,61,2,NULL,NULL),
(29,61,3,NULL,NULL),
(30,69,1,NULL,NULL),
(31,60,2,NULL,NULL),
(32,70,1,NULL,NULL),
(33,70,2,NULL,NULL),
(34,70,3,NULL,NULL),
(35,66,1,NULL,NULL),
(36,66,2,NULL,NULL),
(37,71,1,NULL,NULL),
(43,72,2,NULL,NULL),
(45,73,2,NULL,NULL),
(46,74,3,NULL,NULL),
(47,75,2,NULL,NULL),
(48,76,2,NULL,NULL),
(49,77,2,NULL,NULL),
(50,78,2,NULL,NULL),
(51,79,2,NULL,NULL),
(52,80,2,NULL,NULL),
(53,81,2,NULL,NULL),
(54,82,2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_organizaciones`
--

LOCK TABLES `trd_desve_organizaciones` WRITE;
/*!40000 ALTER TABLE `trd_desve_organizaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_organizaciones` VALUES
(3,'Oganizacion de prueba 01',1,'calle 1 numero 2',-33.00334810,-71.50379200,0,'2026-01-14 11:24:26','2026-01-14 11:24:26'),
(4,'Oganizacion de prueba 02',1,'Prueba',-32.99849200,-71.51731100,0,'2026-01-14 11:27:01','2026-01-14 11:27:01'),
(5,'Juan fg Hervas',1,'calle 1 numero 2',-33.00334810,-71.50379200,0,'2026-02-03 13:38:32','2026-02-05 16:58:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_respuestas` VALUES
(1,57,'sdf','2026-01-22 12:11:11',0,'2026-01-22 12:11:11','2026-01-22 12:11:11','Comentario',1),
(2,57,'utyu','2026-01-22 12:17:30',0,'2026-01-22 12:17:30','2026-01-22 12:17:30','Comentario',1),
(3,57,'qweqwerwerwerw','2026-01-22 12:42:12',0,'2026-01-22 12:42:12','2026-01-22 12:42:12','Comentario',1),
(4,59,'aedfdg','2026-01-22 13:21:29',0,'2026-01-22 13:21:29','2026-01-22 13:21:29','Respuesta Final',1),
(5,69,'asdddasdasdasdasdasdasd','2026-01-28 13:00:32',0,'2026-01-28 13:00:32','2026-01-28 13:00:32','Comentario',1),
(6,69,'sdfsdf','2026-01-28 13:04:12',0,'2026-01-28 13:04:12','2026-01-28 13:04:12','Comentario',1),
(7,69,'dfgh','2026-01-28 13:04:49',0,'2026-01-28 13:04:49','2026-01-28 13:04:49','Comentario',1),
(8,74,'holo','2026-01-30 09:10:05',0,'2026-01-30 09:10:05','2026-01-30 09:10:05','Respuesta Final',3),
(9,74,'cert','2026-01-30 09:10:36',0,'2026-01-30 09:10:36','2026-01-30 09:10:36','Comentario',3);
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
  `sol_sector_id?` int(11) DEFAULT NULL,
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
  KEY `sol_sector_id` (`sol_sector_id?`),
  KEY `sol_reingreso_id` (`sol_reingreso_id`),
  KEY `6` (`sol_registro_tramite`),
  KEY `3` (`sol_funcionario_id`),
  CONSTRAINT `2` FOREIGN KEY (`sol_prioridad_id`) REFERENCES `trd_desve_prioridades` (`pri_id`),
  CONSTRAINT `3` FOREIGN KEY (`sol_funcionario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `4` FOREIGN KEY (`sol_sector_id?`) REFERENCES `trd_general_sectores` (`sec_id`),
  CONSTRAINT `5` FOREIGN KEY (`sol_reingreso_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`),
  CONSTRAINT `6` FOREIGN KEY (`sol_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(57,'Test001','prueba ',1,'','guardarAtencion()guardarAtencion()','2026-01-22 00:00:00',NULL,1,16,NULL,0,NULL,0,0,'guardarAtencion()guardarAtencion()',1,NULL,NULL,NULL,NULL,0,'2026-01-22 11:12:46','2026-01-22 12:28:26',2,96,1),
(58,'Test001','prueba ',6,'','adfgsdfg','2026-01-22 00:00:00',NULL,1,7,NULL,0,NULL,0,0,'sdfgsdfg',1,NULL,NULL,NULL,NULL,0,'2026-01-22 11:13:20','2026-01-26 15:22:18',2,97,2),
(59,'Test003','prueba ',6,'','DESVE_Solicitud',NULL,NULL,1,13,NULL,0,NULL,0,0,'DESVE_Solicitud',0,NULL,NULL,NULL,NULL,0,'2026-01-22 12:01:34','2026-01-26 15:22:18',2,98,3),
(60,'PRUEBA4','dsfg',3,NULL,'azdfgb','2026-01-15 00:00:00',1,1,14,'2026-01-19 00:00:00',NULL,NULL,0,NULL,'sdfg',NULL,59,NULL,NULL,NULL,0,'2026-01-22 13:17:03','2026-01-28 09:58:53',1,99,2),
(61,'DES-0001','Expediente Ramon',4,NULL,'esta es una prueba de ingreso','2026-01-21 00:00:00',1,2,13,'2025-01-25 00:00:00',NULL,NULL,1,NULL,'por favor revisar los puntos señalados',NULL,NULL,NULL,NULL,NULL,0,'2026-01-22 15:58:42','2026-01-27 13:54:06',1,102,2),
(62,'LT-02','REFUERZO DE EXPEDIENTE',2,NULL,'TEST','2026-01-21 00:00:00',1,1,16,'2026-02-05 00:00:00',NULL,NULL,0,NULL,'TEST2',NULL,61,NULL,NULL,NULL,0,'2026-01-22 16:04:41','2026-01-27 13:35:54',1,103,2),
(66,'','prueba ',9,NULL,'ASD','2026-01-26 00:00:00',1,NULL,15,'2026-01-28 00:00:00',NULL,NULL,1,NULL,'ASD',NULL,NULL,NULL,NULL,NULL,0,'2026-01-26 15:32:02','2026-01-28 14:51:47',1,110,2),
(67,'','prueba ',1,NULL,'rtyiuyui','2026-01-27 00:00:00',1,NULL,3,'2026-01-29 00:00:00',NULL,NULL,1,NULL,'ryuityui',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 08:48:46','2026-01-27 09:42:12',1,111,0),
(68,'','asdd',3,NULL,'asd','2026-01-27 00:00:00',3,NULL,3,'2026-02-09 00:00:00',NULL,NULL,0,NULL,'asd',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 09:51:41','2026-01-27 12:09:57',1,112,1),
(69,'','asd',4,NULL,'asdasd','2026-01-27 00:00:00',3,NULL,2,'2026-02-09 00:00:00',NULL,NULL,0,NULL,'asdasd',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 12:38:19','2026-01-27 12:48:05',1,113,2),
(70,NULL,'Prueba TC-06 002',22,'','TC-06\n','2026-01-21 00:00:00',1,NULL,11,'2026-01-30 00:00:00',0,NULL,0,NULL,'TC-06',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 14:49:11','2026-01-28 14:49:11',1,114,2),
(71,'70','Prueba TC-06 003 reingreso',9,'','reingreso','2026-01-28 00:00:00',1,NULL,13,'2026-01-30 00:00:00',0,NULL,0,NULL,'reingreso',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 15:11:11','2026-01-28 15:11:11',1,115,2),
(72,'dfgdddddddddddddd','prueba TC-06 004',9,NULL,'sol_reingreso_id','2026-01-28 00:00:00',1,NULL,15,'2026-01-30 00:00:00',NULL,NULL,0,NULL,'sol_reingreso_id',NULL,71,NULL,NULL,NULL,0,'2026-01-28 15:35:23','2026-01-28 15:53:46',1,116,2),
(73,'codigo 005','Prueba TC-06 005 codigo desve',6,NULL,'        sol_ingreso_desve: document.getElementById(\'Codigo_DESVE\').value,\n','2026-01-28 00:00:00',1,NULL,15,'2026-01-30 00:00:00',NULL,NULL,0,NULL,'        sol_ingreso_desve: document.getElementById(\'Codigo_DESVE\').value,\n',NULL,72,NULL,NULL,NULL,0,'2026-01-28 15:55:03','2026-01-28 15:55:23',1,117,2),
(74,'','TC-08 001',13,'','info_tipo_org','2026-01-28 00:00:00',1,NULL,16,'2026-01-30 00:00:00',0,NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 16:20:23','2026-01-28 16:20:23',1,118,2),
(75,'1','INGRESO RMV',23,'','este es un detalle de un ingreso.','2026-02-03 00:00:00',1,NULL,6,'2026-02-05 00:00:00',0,NULL,0,NULL,'observaciones adicionales',NULL,NULL,NULL,NULL,NULL,0,'2026-02-03 10:30:55','2026-02-03 10:30:55',3,122,2),
(76,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:20:58','2026-02-03 16:20:58',1,123,1),
(77,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:28:18','2026-02-03 16:28:18',1,124,1),
(78,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:34:18','2026-02-03 16:34:18',1,125,1),
(79,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:34:30','2026-02-03 16:34:30',1,126,1),
(80,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:38:32','2026-02-03 16:38:32',1,127,1),
(81,'--php2','prueba php2',5,'Juan fg Hervas','2','2026-02-03 00:00:00',3,NULL,14,'2026-02-16 00:00:00',0,NULL,0,NULL,'2',NULL,80,NULL,NULL,NULL,0,'2026-02-03 16:42:23','2026-02-03 16:42:23',1,128,1),
(82,'--php2','prueba php2',5,'Juan fg Hervas','2','2026-02-03 00:00:00',3,NULL,14,'2026-02-16 00:00:00',0,NULL,0,NULL,'2',NULL,80,NULL,NULL,NULL,0,'2026-02-03 16:43:34','2026-02-03 16:43:34',1,129,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,2,'comentario de prueba consultar 01',NULL,80,'2026-01-22 13:05:27'),
(2,1,'hola',NULL,100,'2026-01-22 19:47:17'),
(15,1,'prueba comentario',NULL,113,'2026-01-28 12:43:21');
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
  `tgc_nombre` varchar(100) NOT NULL,
  `tgc_apellido_paterno` varchar(100) DEFAULT NULL,
  `tgc_apellido_materno` varchar(100) NOT NULL,
  PRIMARY KEY (`tgc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_contribuyentes`
--

LOCK TABLES `trd_general_contribuyentes` WRITE;
/*!40000 ALTER TABLE `trd_general_contribuyentes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_contribuyentes` VALUES
(3,'14.711.939-9','Juan Francisco','Hervas ','Farru'),
(4,'232.321.321-3','6565','','1111'),
(5,'232.321.321-3','Juan','fg','Hervas');
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
  `doc_version_actual` int(11) NOT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`doc_tramite_registrado`) USING BTREE,
  KEY `trd_versiones_FK` (`doc_version_actual`),
  CONSTRAINT `trd_versiones_FK` FOREIGN KEY (`doc_version_actual`) REFERENCES `trd_general_documento_adjunto_versiones` (`docv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(1,80,'2026-01-22 08:50:30',1),
(2,80,'2026-01-22 08:50:30',1),
(3,82,'2026-01-22 08:55:44',1),
(4,82,'2026-01-22 08:55:44',1),
(5,82,'2026-01-22 08:55:44',1),
(6,83,'2026-01-22 09:00:24',1),
(7,86,'2026-01-22 11:48:57',1),
(8,97,'2026-01-22 12:00:51',1),
(9,98,'2026-01-22 12:01:34',1),
(11,96,'2026-01-22 12:14:01',1),
(13,96,'2026-01-22 12:28:26',1),
(14,96,'2026-01-22 12:42:12',1),
(15,99,'2026-01-22 13:17:03',1),
(16,100,'2026-01-22 15:46:58',1),
(17,102,'2026-01-22 15:58:42',1),
(18,110,'2026-01-26 15:32:02',1),
(19,103,'2026-01-27 13:52:10',1),
(20,113,'2026-01-28 13:00:32',1),
(21,113,'2026-01-28 13:04:12',1),
(22,113,'2026-01-28 13:04:49',1),
(23,114,'2026-01-28 14:49:11',1),
(24,118,'2026-01-30 09:10:36',1),
(25,121,'2026-02-02 12:11:08',1),
(26,122,'2026-02-03 10:30:55',1),
(27,123,'2026-02-03 16:20:58',1),
(28,124,'2026-02-03 16:28:18',1),
(29,125,'2026-02-03 16:34:18',1),
(30,126,'2026-02-03 16:34:30',1),
(31,127,'2026-02-03 16:38:32',1),
(32,128,'2026-02-03 16:42:23',1),
(33,129,'2026-02-03 16:43:34',1);
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
  `doc_fecha` datetime NOT NULL,
  `doc_enlace_documento` text NOT NULL,
  `doc_nombre_documento` varchar(100) NOT NULL,
  `doc-responsable` int(11) NOT NULL,
  `doc_docdigital` tinyint(1) NOT NULL,
  `doc_partner` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`docv_id`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`doc-responsable`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto_versiones`
--

LOCK TABLES `trd_general_documento_adjunto_versiones` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto_versiones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto_versiones` VALUES
(1,'2026-01-22 08:50:30','/uploads/documentos/7a7d798dbb5de54d881c2525c07a89eb80bf9b74.php','test_auth.php',2,0,NULL),
(2,'2026-01-22 08:50:30','/uploads/documentos/e69fb7735284e84ad93bd20510e832c16b4d0cf6.php','test_auth - copia.php',2,0,NULL),
(3,'2026-01-22 08:55:44','/uploads/documentos/fa01b4d9ba654da2a930770b7d2634a7621dae8e.md','endpoints_docs.md',2,0,NULL),
(4,'2026-01-22 08:55:44','/uploads/documentos/782e0bcbe365cd16aed332a569c608e8c48fef97.php','test_auth.php',2,0,NULL),
(5,'2026-01-22 08:55:44','/uploads/documentos/80f5bd299ebb571000c024ff99b149093093e2ca.sql','transformacion_digital.sql',2,0,NULL),
(6,'2026-01-22 09:00:24','/uploads/documentos/6cd6396a6f47034c73baa1566724e7357ac2f633.sql','transformacion_digital_20260107.sql',2,0,NULL),
(7,'2026-01-22 11:48:57','/uploads/documentos/ad9a376f0d1cde79e003769df51a09c46e6d6580.pdf','2512012877.pdf',2,0,NULL),
(8,'2026-01-22 12:00:51','/uploads/documentos/9b866de1ff9ea89be61a598a2b2702a6c4505318.pdf','2512012877.pdf',2,0,NULL),
(9,'2026-01-22 12:01:34','/uploads/documentos/ff0923161dd51c58458780729b4fdbada34b9244.pdf','2512012877.pdf',2,0,NULL),
(11,'2026-01-22 12:14:01','/uploads/documentos/93b99197bad69a0d979bafaec9011f2e17e6b41e.sql','dump-transformacion_digital-202512291044.sql',2,0,NULL),
(13,'2026-01-22 12:28:26','/uploads/documentos/128fd0efc18c88ba8f938e5bea1f79d8c061ffb7.json','categoria_patentes_mapeo_completo.json',2,0,NULL),
(33,'2026-02-03 16:43:34','/uploads/documentos/2b88eb8e5dbcf0ca98626767dc5aa5b9885b6110.pdf','6. Sistema Permisos Precarios Municipales.pdf',1,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES
(1,80,'https://www.php.net/',2,'2026-01-22 08:50:30'),
(9,121,'http://192.168.0.169/Transformacion',1,'2026-02-02 12:11:08');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES
(1,'2026-02-03 14:26:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario inició sesión correctamente','{}','::1','Exitoso'),
(10,'2026-02-03 17:08:21','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario inició sesión correctamente','{}','::1','Exitoso');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_multiancestro` VALUES
(1,86,101),
(2,100,86),
(3,104,120);
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
  PRIMARY KEY (`rgt_id`),
  KEY `trd_general_registro_general_tramites_SK` (`rgt_tramite_padre`) USING BTREE,
  KEY `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` (`rgt_creador`),
  CONSTRAINT `trd_general_registro_general_tramites_trd_acceso_usuarios_FK` FOREIGN KEY (`rgt_creador`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_tramites`
--

LOCK TABLES `trd_general_registro_general_tramites` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_tramites` VALUES
(80,'03251c0aa1c601548feddbab21348fd4b0f66201472a0d2bf919cf433c1ee244','Ingreso_ingresos',NULL,2),
(82,'f2fe233a4a0dd2a6306d44ff9f3cc945373f18d27bf963fff19a9e74fe37dfa6','Ingreso_ingresos',NULL,2),
(83,'02cf5e73c1bd5f613fca6363f23daa0fc0e0407679ca64fc9a4759f8924ed106','Ingreso_ingresos',NULL,2),
(84,'41fd8ba88d315ab5f5b3eea03bc39b2fa31c30a16fc6d8ffd77f794369a0e219','Ingreso_ingresos',NULL,2),
(85,'269083ccc574176afa9e01be76ecb6256a2a78665a4566dd0d3145fb99680551','Ingreso_ingresos',NULL,2),
(86,'5e32afd23a4063e93e4ac0888055038bc0b96ba5c7f09cf7d8131ec144563bc6','Ingreso_ingresos',NULL,2),
(96,'9be1ab57f069a6a8458dc0d6440bfd910903ffbc18101bbee208ccddbb536025','desve_solicitud',NULL,2),
(97,'07910eaa3158da71ee6383840ae4e5208328f7cd8f5f71c3dc487b801da340e3','desve_solicitud',NULL,2),
(98,'61f18235300737b5b9bcd8b7d17c4a3dd2970d83acafb51cd241f42e183e4932','desve_solicitud',NULL,2),
(99,'f0f155a9ddd8f23f3cd3ef30ae72c15096f131d0feab5d1a2e7374a6a9b49f86','desve_solicitud',NULL,1),
(100,'9bea1f1ebe432f84c6c7dfc36d6b0f937515966ce0f25b627a6d4c55d69dd98e','Ingreso_ingresos',NULL,1),
(101,'4d982af3a36877ebd265254ad91577cf7d64efe5fd6bbc2da270fdba09ac94c9','Ingreso_ingresos',NULL,1),
(102,'079ac139684253c74b36f8fadfe90f18cc84785c33a4e0768fc599b1f2d7fcaa','desve_solicitud',NULL,1),
(103,'d0cd0fc7887a003ae4868a88745f74d02e17bacfcda1d0318a7f04af7c792641','desve_solicitud',NULL,1),
(104,'8bfea3221d337621ce4e1be1168a1a852afb60f3cbb95017321ccb6693fbf1fb','Ingreso_ingresos',NULL,1),
(110,'260126-1932-desve_solicitud-bD','desve_solicitud',NULL,1),
(111,'260127-1248-desve_solicitud-yM','desve_solicitud',NULL,1),
(112,'260127-1351-desve_solicitud-H6','desve_solicitud',NULL,1),
(113,'260127-1638-desve_solicitud-DF','desve_solicitud',NULL,1),
(114,'260128-1849-desve_solicitud-1E','desve_solicitud',NULL,1),
(115,'260128-1911-desve_solicitud-dS','desve_solicitud',NULL,1),
(116,'260128-1935-desve_solicitud-uV','desve_solicitud',NULL,1),
(117,'260128-1955-desve_solicitud-5Q','desve_solicitud',NULL,1),
(118,'260128-2020-desve_solicitud-1J','desve_solicitud',NULL,1),
(119,'260129-2020-Ingreso_ingresos-Ur','Ingreso_ingresos',NULL,3),
(120,'260129-2021-Ingreso_ingresos-K9','Ingreso_ingresos',NULL,3),
(121,'260202-1611-Ingreso_ingresos-R7','Ingreso_ingresos',NULL,1),
(122,'260203-1430-desve_solicitud-3X','desve_solicitud',NULL,3),
(123,'260203-2020-desve_solicitud-0W','desve_solicitud',NULL,1),
(124,'260203-2028-desve_solicitud-Qv','desve_solicitud',NULL,1),
(125,'260203-2034-desve_solicitud-HF','desve_solicitud',NULL,1),
(126,'260203-2034-desve_solicitud-9d','desve_solicitud',NULL,1),
(127,'260203-2038-desve_solicitud-MO','desve_solicitud',NULL,1),
(128,'260203-2042-desve_solicitud-0h','desve_solicitud',NULL,1),
(129,'260203-2043-desve_solicitud-EH','desve_solicitud',NULL,1);
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
  `tid_facultad` enum('Firmante','Visador','Consultor') NOT NULL,
  `tid_requeido` tinyint(1) NOT NULL DEFAULT 0,
  `tid_responde` tinyint(1) DEFAULT NULL,
  `tid_fecha_respuesta` datetime DEFAULT NULL,
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
(22,21,1,'Para','Firmante',1,NULL,NULL),
(23,21,2,'Para','Visador',1,NULL,NULL),
(24,21,3,'Para','Firmante',1,NULL,NULL),
(28,23,1,'Para','Firmante',1,1,'2026-01-22 14:53:09'),
(29,23,2,'Para','Consultor',1,NULL,NULL),
(30,23,3,'Para','Consultor',1,NULL,NULL),
(31,24,1,'Para','Visador',1,NULL,NULL),
(32,24,2,'Para','Visador',0,NULL,NULL),
(33,25,1,'Para','Visador',0,NULL,NULL),
(34,25,2,'Para','Visador',0,NULL,NULL),
(35,25,3,'Para','Consultor',0,NULL,NULL),
(36,26,1,'Para','Consultor',1,NULL,NULL),
(38,27,1,'Para','Visador',1,NULL,NULL),
(39,28,2,'Para','Firmante',1,NULL,NULL),
(40,28,2,'Para','Firmante',1,NULL,NULL),
(41,30,2,'Para','Visador',1,NULL,NULL),
(42,30,3,'Para','Firmante',1,NULL,NULL),
(43,33,3,'Para','Firmante',1,NULL,NULL);
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
  `tis_registro_tramite` int(11) NOT NULL,
  PRIMARY KEY (`tis_id`),
  KEY `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` (`tis_responsable`),
  KEY `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` (`tis_tipo`),
  KEY `trd_ingresos_registro_general_tramites_FK` (`tis_registro_tramite`),
  CONSTRAINT `trd_ingresos_registro_general_tramites_FK` FOREIGN KEY (`tis_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_acceso_usuarios_FK` FOREIGN KEY (`tis_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_ingresos_solicitudes_trd_ingresos_tipos_ingreso_FK` FOREIGN KEY (`tis_tipo`) REFERENCES `trd_ingresos_tipos_ingreso` (`titi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(21,1,'prueba ingreso de ingreso 001','Prueba 001\ningreso completo','Ingresado',2,NULL,'2026-01-22 00:00:00',80),
(23,1,'prueba ingreso de ingreso 002','prueba 2, ingresar muchos documentos','Ingresado',2,'sdfg','2026-01-22 00:00:00',82),
(24,1,'prueba ingreso de ingreso 003','crear solicitud sin enlaces','Ingresado',2,NULL,'2026-01-22 00:00:00',83),
(25,1,'prueba ingreso de ingreso 004','crea solicitud sin documentos','Ingresado',2,NULL,'2026-01-22 00:00:00',84),
(26,2,'prueba ingreso de ingreso 005','crear solicitud sin tipo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',85),
(27,1,'prueba ingreso de ingreso 007','solicitud sin titulo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',86),
(28,1,'prueba ingreso de ingreso 010','prueba','Ingresado',1,NULL,'2026-01-22 00:00:00',100),
(29,1,'prueba grafico 001','1234','Ingresado',1,NULL,'2026-01-22 00:00:00',101),
(30,1,'dia libre','queremos un dìa libre para ramòn, para estar en paz','Ingresado',1,NULL,'2026-01-22 00:00:00',104),
(31,1,'prueba flujo especial 001','sdf','Ingresado',3,NULL,'2026-01-29 00:00:00',119),
(32,1,'prueba flujo especial 002','asd','Ingresado',3,NULL,'2026-01-29 00:00:00',120),
(33,1,'Revisar sistemas ingresos','Se necesita revisare sistema ingresos del SMU para verificar funcionalidad completa ','Ingresado',1,NULL,'2026-02-02 00:00:00',121);
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

-- Dump completed on 2026-02-06 10:39:17
