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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_perfiles`
--

LOCK TABLES `trd_acceso_perfiles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_perfiles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_perfiles` VALUES
(1,'Administrador',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,'Patentes Comerciales',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'Organizaciones_comunitarias',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(4,'Desarollo_Vecinal',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(5,'Externo',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'Contribuyente',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
  `pfr_perfil_id` int(11) NOT NULL,
  `pfr_rol_id` varchar(20) NOT NULL,
  `pfr_borrado` tinyint(1) DEFAULT 0,
  `pfr_creacion` datetime DEFAULT current_timestamp(),
  `pfr_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pfr_perfil_id`,`pfr_rol_id`),
  KEY `pfr_rol_id` (`pfr_rol_id`),
  CONSTRAINT `1` FOREIGN KEY (`pfr_perfil_id`) REFERENCES `trd_acceso_perfiles` (`prf_id`),
  CONSTRAINT `2` FOREIGN KEY (`pfr_rol_id`) REFERENCES `trd_acceso_roles` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_perfiles_roles`
--

LOCK TABLES `trd_acceso_perfiles_roles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_perfiles_roles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_perfiles_roles` VALUES
(2,'1',0,'2026-01-06 18:28:23','2026-01-06 18:28:23'),
(2,'1.1',0,'2026-01-06 18:28:23','2026-01-06 18:28:23'),
(2,'1.2',0,'2026-01-06 18:28:23','2026-01-06 18:28:23'),
(2,'1.3',0,'2026-01-06 18:28:23','2026-01-06 18:28:23'),
(2,'1.4',0,'2026-01-06 18:28:23','2026-01-06 18:28:23'),
(3,'0',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'2',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'2.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'2.1.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'2.1.2',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'3',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'3.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'3.1.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'3.1.2',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'3.1.7',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'4',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'4.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'4.1.1',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(3,'4.1.2',0,'2026-01-06 16:51:10','2026-01-06 16:51:10'),
(6,'0',0,'2026-01-05 18:06:30','2026-01-05 18:06:30'),
(6,'7',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.1',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.2',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.3',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
('1','Patentes',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1.1','Mis Solicitudes','paginas/patentes_mis_solicitudes.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1.2','Pagos','paginas/pagos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1.3','Solicitud Única de Patentes','paginas/patentes_solicitud_unica.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1.4','Consulta de Solicitud','paginas/patentes_consulta_solicitud.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('1.c','Gestión de Empresas','paginas/contribuyente_empresas.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2','Organizaciones Comunitarias',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1','Organizaciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1.1','Consulta Organizacion','paginas/organizaciones_consulta_organizacion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('2.1.2','Consulta Masiva Organizaciones','paginas/organizaciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3','Subvenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1','Subvenciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.1','Consulta de Subvención','paginas/subvenciones_consulta_subvencion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.2','Consulta Masiva de Subvenciones','paginas/subvenciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('3.1.7','Consulta Masiva de Pagos','paginas/subvenciones_consulta_masiva_pagos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('4','Postulaciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('4.1','Postulaciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('4.1.1','Consulta de Postulación','paginas/postulaciones_consulta_postulacion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('4.1.2','Consulta Masiva de Postulaciones','paginas/postulaciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5','Atenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1','Atenciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1.1','Consulta de Atención','paginas/atenciones_consulta_atencion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1.2','Lista de Espera','paginas/atenciones_lista_espera.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1.3','Tomar Atención','paginas/atenciones_tomar_atencion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('5.1.4','Listado de Atenciones','paginas/atenciones_listado_atenciones.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6','Logs del Sistema',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.1','Logs del Sistema',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.1.1','Consulta de Log','paginas/logs_consulta_log.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.1.2','Listado de Logs','paginas/logs_listado_logs.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('7','Ingresos',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('7.1','Ingreso de Ingresos','paginas/ingresos_ingreso_ingresos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('7.2','Listado de Ingresos','paginas/ingresos_listado_ingresos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('7.3','Responder','paginas/ingresos_ingresar_respuesta.html','Pagina',0,'2026-01-05 18:06:03','2026-01-05 18:06:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_usuarios`
--

LOCK TABLES `trd_acceso_usuarios` WRITE;
/*!40000 ALTER TABLE `trd_acceso_usuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_usuarios` VALUES
(1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',0,'2025-12-29 12:53:09','2026-01-07 13:43:55'),
(2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',0,'2026-01-06 11:47:58','2026-01-06 11:48:23');
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
  `usp_fecha_inicio` datetime DEFAULT NULL,
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
(1,2,NULL,NULL,NULL,0,'2026-01-06 18:28:37','2026-01-06 18:28:37'),
(1,3,NULL,NULL,NULL,0,'2026-01-06 16:51:57','2026-01-06 16:51:57'),
(1,6,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03');
/*!40000 ALTER TABLE `trd_acceso_usuarios_perfiles` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(1,1,'Ingresa solicitud: prueba ',1,'2026-01-07 13:47:05'),
(2,1,'Consulta solicitud',1,'2026-01-07 13:47:13'),
(3,1,'Consulta solicitud',1,'2026-01-07 13:49:03'),
(4,1,'Consulta solicitud',1,'2026-01-07 13:49:07'),
(5,1,'Consulta solicitud',1,'2026-01-07 14:29:17'),
(6,1,'Consulta solicitud',1,'2026-01-07 14:33:23'),
(7,1,'Consulta solicitud',1,'2026-01-07 14:33:37'),
(8,1,'Consulta solicitud',1,'2026-01-07 14:33:42'),
(9,1,'Responde solicitud',1,'2026-01-07 14:34:53'),
(10,1,'Consulta solicitud',1,'2026-01-07 14:34:54'),
(11,1,'Consulta solicitud',1,'2026-01-07 14:35:14'),
(12,1,'Edita: funcionario asignado de \"2\" a \"1\"',1,'2026-01-07 14:35:14'),
(13,1,'Consulta solicitud',1,'2026-01-07 14:35:24'),
(14,1,'Consulta solicitud',1,'2026-01-07 14:36:27'),
(15,1,'Consulta solicitud',1,'2026-01-07 14:36:33'),
(16,1,'Responde solicitud',1,'2026-01-07 14:36:37'),
(17,1,'Consulta solicitud',1,'2026-01-07 14:36:47'),
(18,1,'Consulta solicitud',1,'2026-01-07 14:48:44'),
(19,2,'Ingresa solicitud: LA QUE INDICA',1,'2026-01-07 14:58:42'),
(20,3,'Ingresa solicitud: LA QUE INDICA',1,'2026-01-07 14:59:32'),
(21,4,'Ingresa solicitud: LA QUE INDICA',1,'2026-01-07 14:59:37'),
(22,2,'Consulta solicitud',1,'2026-01-07 14:59:49'),
(23,2,'Consulta solicitud',1,'2026-01-07 15:00:14'),
(24,2,'Consulta solicitud',1,'2026-01-07 15:00:23'),
(25,2,'Responde solicitud',1,'2026-01-07 15:00:43'),
(26,2,'Consulta solicitud',1,'2026-01-07 15:00:45'),
(27,2,'Consulta solicitud',1,'2026-01-07 15:02:02'),
(28,4,'Consulta solicitud',1,'2026-01-07 15:02:14'),
(29,2,'Consulta solicitud',1,'2026-01-07 15:03:03'),
(30,4,'Consulta solicitud',1,'2026-01-07 15:03:14'),
(31,3,'Consulta solicitud',1,'2026-01-07 15:03:30'),
(32,4,'Consulta solicitud',2,'2026-01-07 15:05:10'),
(33,4,'Consulta solicitud',2,'2026-01-07 15:05:33'),
(34,4,'Consulta solicitud',2,'2026-01-07 15:06:45'),
(35,2,'Consulta solicitud',2,'2026-01-07 15:07:07'),
(36,2,'Responde solicitud',2,'2026-01-07 15:07:17'),
(37,2,'Consulta solicitud',2,'2026-01-07 15:07:26'),
(38,2,'Consulta solicitud',2,'2026-01-07 15:08:36'),
(39,4,'Consulta solicitud',2,'2026-01-07 15:09:26'),
(40,4,'Consulta solicitud',2,'2026-01-07 15:10:04'),
(41,4,'Edita: prioridad de \"\" a \"2\"',2,'2026-01-07 15:10:04'),
(42,3,'Consulta solicitud',2,'2026-01-07 15:12:54'),
(43,2,'Consulta solicitud',2,'2026-01-07 15:13:10'),
(44,2,'Consulta solicitud',2,'2026-01-07 15:13:27'),
(45,3,'Consulta solicitud',2,'2026-01-07 15:13:41'),
(46,2,'Consulta solicitud',2,'2026-01-07 15:14:06'),
(47,1,'Consulta solicitud',2,'2026-01-07 15:14:12'),
(48,1,'Consulta solicitud',2,'2026-01-07 15:14:38'),
(49,2,'Consulta solicitud',2,'2026-01-07 15:14:50'),
(50,1,'Consulta solicitud',2,'2026-01-07 15:14:54'),
(51,1,'Consulta solicitud',2,'2026-01-07 15:15:13'),
(52,2,'Consulta solicitud',2,'2026-01-07 15:15:16'),
(53,3,'Consulta solicitud',2,'2026-01-07 15:15:22'),
(54,3,'Consulta solicitud',2,'2026-01-07 15:17:52'),
(55,3,'Consulta solicitud',2,'2026-01-07 15:19:40'),
(56,2,'Consulta solicitud',2,'2026-01-07 15:21:03'),
(57,2,'Consulta solicitud',2,'2026-01-07 15:21:22'),
(58,2,'Consulta solicitud',2,'2026-01-07 15:21:50'),
(59,2,'Consulta solicitud',2,'2026-01-07 15:21:55'),
(60,2,'Consulta solicitud',2,'2026-01-07 15:22:19'),
(61,2,'Consulta solicitud',2,'2026-01-07 15:22:50'),
(62,3,'Consulta solicitud',2,'2026-01-07 15:22:58'),
(63,3,'Consulta solicitud',2,'2026-01-07 15:24:47'),
(64,2,'Consulta solicitud',2,'2026-01-07 17:42:29'),
(65,2,'Consulta solicitud',2,'2026-01-07 17:42:47'),
(66,2,'Consulta solicitud',2,'2026-01-07 17:45:28'),
(67,2,'Consulta solicitud',2,'2026-01-07 17:45:41'),
(68,2,'Cambio de estado a RESPONDIDO (Entregado: Sí)',2,'2026-01-07 17:45:41'),
(69,2,'Consulta solicitud',2,'2026-01-07 17:45:41'),
(70,2,'Consulta solicitud',2,'2026-01-07 17:45:53'),
(71,2,'Consulta solicitud',2,'2026-01-07 17:46:01'),
(72,2,'Cambio de estado a PENDIENTE (Entregado: No)',2,'2026-01-07 17:46:01'),
(73,2,'Consulta solicitud',2,'2026-01-07 17:46:02'),
(74,2,'Consulta solicitud',2,'2026-01-07 17:46:09'),
(75,2,'Consulta solicitud',2,'2026-01-07 17:47:00'),
(76,2,'Consulta solicitud',2,'2026-01-07 17:47:06'),
(77,2,'Consulta solicitud',2,'2026-01-07 17:48:27'),
(78,2,'Consulta solicitud',2,'2026-01-07 17:48:30'),
(79,2,'Cambio de estado a RESPONDIDO (Entregado: Sí)',2,'2026-01-07 17:48:30'),
(80,2,'Consulta solicitud',2,'2026-01-07 17:48:31'),
(81,2,'Consulta solicitud',2,'2026-01-07 17:48:32'),
(82,2,'Cambio de estado a PENDIENTE (Entregado: No)',2,'2026-01-07 17:48:32'),
(83,2,'Consulta solicitud',2,'2026-01-07 17:48:33'),
(84,2,'Consulta solicitud',2,'2026-01-07 17:48:36'),
(85,2,'Consulta solicitud',2,'2026-01-07 17:48:39'),
(86,2,'Cambio de estado a RESPONDIDO (Entregado: Sí)',2,'2026-01-07 17:48:39'),
(87,2,'Consulta solicitud',2,'2026-01-07 17:48:39'),
(88,2,'Consulta solicitud',2,'2026-01-07 17:48:41'),
(89,2,'Consulta solicitud',2,'2026-01-07 17:48:44'),
(90,2,'Cambio de estado a PENDIENTE (Entregado: No)',2,'2026-01-07 17:48:44'),
(91,2,'Consulta solicitud',2,'2026-01-07 17:48:44'),
(92,2,'Consulta solicitud',2,'2026-01-07 17:48:48'),
(93,2,'Cambio de estado a RESPONDIDO (Entregado: Sí)',2,'2026-01-07 17:48:48'),
(94,2,'Consulta solicitud',2,'2026-01-07 17:48:49'),
(95,2,'Consulta solicitud',2,'2026-01-07 17:48:52'),
(96,2,'Cambio de estado a PENDIENTE (Entregado: No)',2,'2026-01-07 17:48:52'),
(97,2,'Consulta solicitud',2,'2026-01-07 17:48:52'),
(98,2,'Consulta solicitud',2,'2026-01-08 11:44:58'),
(99,2,'Responde solicitud',2,'2026-01-08 11:45:23'),
(100,2,'Consulta solicitud',2,'2026-01-08 11:45:28'),
(101,2,'Consulta solicitud',2,'2026-01-08 11:55:45'),
(102,2,'Consulta solicitud',2,'2026-01-08 11:57:56'),
(103,2,'Consulta solicitud',2,'2026-01-08 12:01:07'),
(104,4,'Consulta solicitud',2,'2026-01-08 12:02:07'),
(105,2,'Consulta solicitud',2,'2026-01-08 12:32:43'),
(106,2,'Consulta solicitud',2,'2026-01-08 12:33:55'),
(107,2,'Consulta solicitud',2,'2026-01-08 12:34:11'),
(108,2,'Consulta solicitud',2,'2026-01-08 12:36:38'),
(109,2,'Consulta solicitud',2,'2026-01-08 12:37:41'),
(110,2,'Consulta solicitud',2,'2026-01-08 12:38:48'),
(111,2,'Consulta solicitud',2,'2026-01-08 12:39:15'),
(112,2,'Consulta solicitud',2,'2026-01-08 12:43:56'),
(113,2,'Consulta solicitud',2,'2026-01-08 12:45:17'),
(114,2,'Consulta solicitud',2,'2026-01-08 12:52:53'),
(115,4,'Consulta solicitud',2,'2026-01-08 14:34:04'),
(116,2,'Consulta solicitud',2,'2026-01-08 14:34:29'),
(117,2,'Consulta solicitud',2,'2026-01-08 17:35:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,2,'asdasd',NULL,2,'2026-01-08 16:39:14');
/*!40000 ALTER TABLE `trd_general_comentario` ENABLE KEYS */;
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
  CONSTRAINT `1` FOREIGN KEY (`org_tipo_id`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
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
  KEY `trd_general_registro_general_tramites_SK` (`rgt_tramite_padre`),
  CONSTRAINT `trd_general_registro_general_tramites_SK` FOREIGN KEY (`rgt_tramite_padre`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_tramites`
--

LOCK TABLES `trd_general_registro_general_tramites` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_tramites` VALUES
(1,'1f8a264ec5e4209047f4c93c73c69a72b525a71abf5a975b66ca60d563454754','ingresos_solicitud',NULL,1),
(2,'d0280c6f55068e4b422d91a52d29781fea6951bafc8321542043d0349dc2e62b','ingresos_solicitud',NULL,1),
(3,'c1dff21a55e5535ec6eea0ec49e4eff9ca588fcea037e3b420cd5f2cff9bdf34','ingresos_solicitud',NULL,1),
(4,'02a70dce3476641106c5d532b4df4ca061ebc3dfaa726afce756f721102bebc9','ingresos_solicitud',NULL,1);
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
  CONSTRAINT `1` FOREIGN KEY (`tor_prioridad_id`) REFERENCES `trd_ingresos_prioridades` (`pri_id`)
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
-- Table structure for table `trd_ingresos_mails_enviados`
--

DROP TABLE IF EXISTS `trd_ingresos_mails_enviados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_mails_enviados` (
  `men_id` int(11) NOT NULL AUTO_INCREMENT,
  `men_solicitud_id` int(11) DEFAULT NULL,
  `men_fecha` datetime DEFAULT current_timestamp(),
  `men_destinatario` varchar(255) DEFAULT NULL,
  `men_asunto` varchar(255) DEFAULT NULL,
  `men_borrado` tinyint(1) DEFAULT 0,
  `men_creacion` datetime DEFAULT current_timestamp(),
  `men_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`men_id`),
  KEY `men_solicitud_id` (`men_solicitud_id`),
  CONSTRAINT `1` FOREIGN KEY (`men_solicitud_id`) REFERENCES `trd_ingresos_solicitudes` (`sol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_mails_enviados`
--

LOCK TABLES `trd_ingresos_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_mails_enviados` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_ingresos_mails_enviados` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_prioridades`
--

DROP TABLE IF EXISTS `trd_ingresos_prioridades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_prioridades` (
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
-- Dumping data for table `trd_ingresos_prioridades`
--

LOCK TABLES `trd_ingresos_prioridades` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_prioridades` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_prioridades` VALUES
(1,'Alta',3,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,'Media',8,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(3,'Baja',10,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
/*!40000 ALTER TABLE `trd_ingresos_prioridades` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_respuestas`
--

DROP TABLE IF EXISTS `trd_ingresos_respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_respuestas` (
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
  CONSTRAINT `1` FOREIGN KEY (`res_solicitud_id`) REFERENCES `trd_ingresos_solicitudes` (`sol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_respuestas`
--

LOCK TABLES `trd_ingresos_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_respuestas` VALUES
(1,1,'asd','2026-01-07 14:34:53',0,'2026-01-07 14:34:53','2026-01-07 14:34:53','Comentario',1),
(2,1,'adasda','2026-01-07 14:36:37',0,'2026-01-07 14:36:37','2026-01-07 14:36:37','Observación',1),
(3,2,'oh encontré un error.','2026-01-07 15:00:43',0,'2026-01-07 15:00:43','2026-01-07 15:00:43','Comentario',1),
(4,2,'esta es una prueba','2026-01-07 15:07:17',0,'2026-01-07 15:07:17','2026-01-07 15:07:17','Observación',2),
(5,2,'aaaaaaaqui','2026-01-08 11:45:23',0,'2026-01-08 11:45:23','2026-01-08 11:45:23','Comentario',2);
/*!40000 ALTER TABLE `trd_ingresos_respuestas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_ingresos_solicitudes`
--

DROP TABLE IF EXISTS `trd_ingresos_solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_ingresos_solicitudes` (
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
  PRIMARY KEY (`sol_id`),
  KEY `sol_origen_id` (`sol_origen_id`),
  KEY `sol_prioridad_id` (`sol_prioridad_id`),
  KEY `sol_sector_id` (`sol_sector_id`),
  KEY `sol_reingreso_id` (`sol_reingreso_id`),
  KEY `6` (`sol_registro_tramite`),
  KEY `3` (`sol_funcionario_id`),
  CONSTRAINT `1` FOREIGN KEY (`sol_origen_id`) REFERENCES `trd_general_organizaciones` (`org_id`),
  CONSTRAINT `2` FOREIGN KEY (`sol_prioridad_id`) REFERENCES `trd_ingresos_prioridades` (`pri_id`),
  CONSTRAINT `3` FOREIGN KEY (`sol_funcionario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `4` FOREIGN KEY (`sol_sector_id`) REFERENCES `trd_general_sectores` (`sec_id`),
  CONSTRAINT `5` FOREIGN KEY (`sol_reingreso_id`) REFERENCES `trd_ingresos_solicitudes` (`sol_id`),
  CONSTRAINT `6` FOREIGN KEY (`sol_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(1,'Test001','prueba ',1,'','testt','2026-01-07 13:46:00',2,1,15,'2026-01-19 13:46:00',0,NULL,0,-12,'testt',0,NULL,NULL,NULL,NULL,0,'2026-01-07 13:47:05','2026-01-07 14:35:14',1,1),
(2,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 14:51:00',NULL,2,1,'2026-01-20 16:00:00',0,NULL,0,-12,'esta es una prueba.',0,NULL,NULL,NULL,NULL,0,'2026-01-07 14:58:42','2026-01-07 17:48:52',1,2),
(3,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 14:51:00',NULL,2,1,'2026-01-20 16:00:00',0,NULL,0,-12,'esta es una prueba.',0,NULL,NULL,NULL,NULL,0,'2026-01-07 14:59:32','2026-01-07 14:59:32',1,3),
(4,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 14:51:00',2,2,1,'2026-01-20 16:00:00',0,NULL,1,-14,'esta es una prueba.',0,NULL,NULL,NULL,NULL,0,'2026-01-07 14:59:37','2026-01-07 15:10:04',1,4);
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` ENABLE KEYS */;
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

-- Dump completed on 2026-01-09  8:01:12
