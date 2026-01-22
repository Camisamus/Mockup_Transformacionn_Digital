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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(6,'Contribuyente',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(7,'Subvenciones',0,'2026-01-19 13:35:49','2026-01-19 13:35:49'),
(8,'Ingresos',0,'2026-01-19 13:35:49','2026-01-19 13:35:49');
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
(6,'6',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2.1',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2.1.1',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'7',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.1',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.2',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(6,'7.3',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(8,'8',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.1',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.2',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.3',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.4',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.5',0,'2026-01-19 13:37:08','2026-01-19 13:37:08'),
(8,'8.6',0,'2026-01-19 13:37:08','2026-01-19 13:37:08');
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
('6','Administracion sistema',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-14 09:33:54'),
('6.1','Logs del Sistema',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.1.1','Consulta de Log','paginas/logs_consulta_log.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.1.2','Listado de Logs','paginas/logs_listado_logs.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
('6.2','Mantenedores',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-14 09:33:54'),
('6.2.1','desve',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-14 09:33:54'),
('6.2.1.1','Oigenes especiales','paginas/sisadmin_mantenedo_desve_oigenesespeciales.html','Pagina',0,'2026-01-14 09:33:54','2026-01-14 11:05:15'),
('7','DESVE',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-12 10:43:01'),
('7.1','Ingreso DESVE','paginas/desve_nuevo_ingreso.html','Pagina',0,'2025-12-29 12:53:09','2026-01-12 10:43:01'),
('7.2','Listado DESVE','paginas/desve_listado_ingresos.html','Pagina',0,'2025-12-29 12:53:09','2026-01-12 10:43:01'),
('7.3','Responder DESVE','paginas/desve_responder.html','Pagina',0,'2026-01-05 18:06:03','2026-01-12 10:43:01'),
('8','Ingresos',NULL,'categoria',0,'2026-01-19 10:44:56','2026-01-19 11:14:39'),
('8.1','Bandeja','paginas/ingr_bandeja.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.2','Crear ','paginas/ingr_crear.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.3','Consultar ','paginas/ingr_consultar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.4','Moificar ','paginas/ingr_modificar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.5','Respoder','paginas/ingr_responder.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39'),
('8.6','Preparar','paginas/ingr_peparar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
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
(1,2,NULL,NULL,NULL,1,'2026-01-06 18:28:37','2026-01-19 13:32:10'),
(1,3,NULL,NULL,NULL,1,'2026-01-06 16:51:57','2026-01-19 13:32:18'),
(1,6,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2026-01-19 13:33:02'),
(1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
(2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00'),
(3,6,NULL,NULL,NULL,0,'2026-01-09 10:15:40','2026-01-09 10:15:40');
/*!40000 ALTER TABLE `trd_acceso_usuarios_perfiles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trd_desve_mails_enviados`
--

DROP TABLE IF EXISTS `trd_desve_mails_enviados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trd_desve_mails_enviados` (
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
  CONSTRAINT `1` FOREIGN KEY (`men_solicitud_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_mails_enviados`
--

LOCK TABLES `trd_desve_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_desve_mails_enviados` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desve_mails_enviados` ENABLE KEYS */;
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
  KEY `org_tipo_id` (`org_tipo_id`) USING BTREE,
  CONSTRAINT `1_copy` FOREIGN KEY (`org_tipo_id`) REFERENCES `trd_general_tipos_organizacion` (`tor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(13,'Congreso Nacional',7,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
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
  CONSTRAINT `1` FOREIGN KEY (`res_solicitud_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(57,'Test001','prueba ',6,'','guardarAtencion()guardarAtencion()','2026-01-22 00:00:00',NULL,1,16,NULL,0,NULL,0,0,'guardarAtencion()guardarAtencion()',0,NULL,NULL,NULL,NULL,0,'2026-01-22 11:12:46','2026-01-22 11:12:46',2,96,1),
(58,'Test001','prueba ',6,'','adfgsdfg','2026-01-22 00:00:00',NULL,1,7,NULL,0,NULL,0,0,'sdfgsdfg',1,NULL,NULL,NULL,NULL,0,'2026-01-22 11:13:20','2026-01-22 11:15:27',2,97,1);
/*!40000 ALTER TABLE `trd_desve_solicitudes` ENABLE KEYS */;
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
  `tgau_id` int(11) NOT NULL AUTO_INCREMENT,
  `tgau_usuario` int(11) NOT NULL,
  `tgau_area` int(11) NOT NULL,
  `tgau_estado` enum('Activo','Inactivo','Pendiente') DEFAULT NULL,
  PRIMARY KEY (`tgau_id`),
  KEY `trd_general_areas_usuarios_trd_general_areas_FK` (`tgau_area`),
  KEY `trd_general_areas_usuarios_trd_acceso_usuarios_FK` (`tgau_usuario`),
  CONSTRAINT `trd_general_areas_usuarios_trd_acceso_usuarios_FK` FOREIGN KEY (`tgau_usuario`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_areas_usuarios_trd_general_areas_FK` FOREIGN KEY (`tgau_area`) REFERENCES `trd_general_areas` (`tga_id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES
(1,80,'Ingresa solicitud Ingresos',2,'2026-01-22 08:50:30'),
(3,82,'Ingresa solicitud Ingresos',2,'2026-01-22 08:55:44'),
(4,83,'Ingresa solicitud Ingresos',2,'2026-01-22 09:00:24'),
(5,84,'Ingresa solicitud Ingresos',2,'2026-01-22 09:01:31'),
(6,85,'Ingresa solicitud Ingresos',2,'2026-01-22 09:02:37'),
(7,86,'Ingresa solicitud Ingresos',2,'2026-01-22 09:03:30'),
(8,80,'Añade comentario al trámite',2,'2026-01-22 09:05:27'),
(9,96,'Ingresa solicitud: prueba ',2,'2026-01-22 11:12:46'),
(10,97,'Ingresa solicitud: prueba ',2,'2026-01-22 11:13:20'),
(11,96,'Consulta solicitud',2,'2026-01-22 11:13:38'),
(12,97,'Consulta solicitud',2,'2026-01-22 11:14:31'),
(13,97,'Consulta solicitud',2,'2026-01-22 11:15:07'),
(14,97,'Consulta solicitud',2,'2026-01-22 11:15:27'),
(15,97,'Consulta solicitud',2,'2026-01-22 11:15:34'),
(16,97,'Consulta solicitud',2,'2026-01-22 11:16:47');
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
(1,2,'comentario de prueba consultar 01',NULL,80,'2026-01-22 13:05:27');
/*!40000 ALTER TABLE `trd_general_comentario` ENABLE KEYS */;
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
  `doc_enlace_documento` text NOT NULL,
  `doc_nombre_documento` varchar(100) NOT NULL,
  `doc-responsable` int(11) NOT NULL,
  `doc_docdigital` tinyint(1) NOT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`doc-responsable`) USING BTREE,
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`doc_tramite_registrado`) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`doc-responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `2` FOREIGN KEY (`doc_tramite_registrado`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(1,80,'2026-01-22 08:50:30','/uploads/documentos/7a7d798dbb5de54d881c2525c07a89eb80bf9b74.php','test_auth.php',2,0),
(2,80,'2026-01-22 08:50:30','/uploads/documentos/e69fb7735284e84ad93bd20510e832c16b4d0cf6.php','test_auth - copia.php',2,0),
(3,82,'2026-01-22 08:55:44','/uploads/documentos/fa01b4d9ba654da2a930770b7d2634a7621dae8e.md','endpoints_docs.md',2,0),
(4,82,'2026-01-22 08:55:44','/uploads/documentos/782e0bcbe365cd16aed332a569c608e8c48fef97.php','test_auth.php',2,0),
(5,82,'2026-01-22 08:55:44','/uploads/documentos/80f5bd299ebb571000c024ff99b149093093e2ca.sql','transformacion_digital.sql',2,0),
(6,83,'2026-01-22 09:00:24','/uploads/documentos/6cd6396a6f47034c73baa1566724e7357ac2f633.sql','transformacion_digital_20260107.sql',2,0);
/*!40000 ALTER TABLE `trd_general_documento_adjunto` ENABLE KEYS */;
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
  KEY `trd_general_enlaces_trd_acceso_usuarios_FK` (`tge_responsable`),
  KEY `trd_general_enlaces_trd_general_registro_general_tramites_FK` (`tge_tramite`),
  CONSTRAINT `trd_general_enlaces_trd_acceso_usuarios_FK` FOREIGN KEY (`tge_responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `trd_general_enlaces_trd_general_registro_general_tramites_FK` FOREIGN KEY (`tge_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES
(1,80,'https://www.php.net/',2,'2026-01-22 08:50:30'),
(2,80,'https://www.google.com/',2,'2026-01-22 08:50:30'),
(4,82,'https://www.php.net/manual/es/function.gettype.php',2,'2026-01-22 08:55:44'),
(5,82,'https://www.google.com/search?q=comodefinir+el+tipo+dedartoa+revolvera+php&sca_esv=fb6ec2c420ab31bb&rlz=1C1GCEU_esCL1191CL1191&ei=nIdvabjnJazZ1sQPmt7u6Aw&oq=comodefinir+el+tipo+dedartoa+revolvera&gs_lp=Egxnd3Mtd2l6LXNlcnAiJmNvbW9kZWZpbmlyIGVsIHRpcG8gZGVkYXJ0b2EgcmV2b2x2ZXJhKgIIADIHECEYChigAUiFNVAAWKYrcAF4AZABAJgBnQGgAZscqgEFMjQuMTW4AQPIAQD4AQGYAiigAsodwgINEAAYgAQYigUYQxixA8ICChAAGIAEGIoFGEPCAg4QLhiABBixAxjHARjRA8ICBRAAGIAEwgILEAAYgAQYsQMYgwHCAggQLhiABBixA8ICCBAAGIAEGLEDwgIKEC4YgAQYigUYQ8ICBRAuGIAEwgIOEAAYgAQYsQMYgwEYyQPCAgsQABiABBiKBRiSA8ICEBAuGIAEGIoFGEMYsQMYgwHCAg4QLhiABBiKBRixAxiDAcICDhAAGIAEGIoFGLEDGIMBwgIQEAAYgAQYigUYQxixAxiDAcICDRAuGIAEGIoFGEMYsQPCAgsQLhiDARixAxiABMICBxAAGIAEGArCAgkQABiABBgKGAvCAgcQABiABBgNwgIJEAAYgAQYExgKwgIIEAAYgAQYogTCAgUQABjvBcICBhAAGB4YDcICBhAAGBYYHsICBBAhGBWYAwCSBwUyMy4xN6AHz-MBsgcFMjIuMTe4B8UdwgcJMi4xOC4xOS4xyAd0gAgB&sclient=gws-wiz-serp',2,'2026-01-22 08:55:44'),
(6,84,'https://www.google.com/search?q=comodefinir+el+tipo+dedartoa+revolvera+php&sca_esv=fb6ec2c420ab31bb&rlz=1C1GCEU_esCL1191CL1191&ei=nIdvabjnJazZ1sQPmt7u6Aw&oq=comodefinir+el+tipo+dedartoa+revolvera&gs_lp=Egxnd3Mtd2l6LXNlcnAiJmNvbW9kZWZpbmlyIGVsIHRpcG8gZGVkYXJ0b2EgcmV2b2x2ZXJhKgIIADIHECEYChigAUiFNVAAWKYrcAF4AZABAJgBnQGgAZscqgEFMjQuMTW4AQPIAQD4AQGYAiigAsodwgINEAAYgAQYigUYQxixA8ICChAAGIAEGIoFGEPCAg4QLhiABBixAxjHARjRA8ICBRAAGIAEwgILEAAYgAQYsQMYgwHCAggQLhiABBixA8ICCBAAGIAEGLEDwgIKEC4YgAQYigUYQ8ICBRAuGIAEwgIOEAAYgAQYsQMYgwEYyQPCAgsQABiABBiKBRiSA8ICEBAuGIAEGIoFGEMYsQMYgwHCAg4QLhiABBiKBRixAxiDAcICDhAAGIAEGIoFGLEDGIMBwgIQEAAYgAQYigUYQxixAxiDAcICDRAuGIAEGIoFGEMYsQPCAgsQLhiDARixAxiABMICBxAAGIAEGArCAgkQABiABBgKGAvCAgcQABiABBgNwgIJEAAYgAQYExgKwgIIEAAYgAQYogTCAgUQABjvBcICBhAAGB4YDcICBhAAGBYYHsICBBAhGBWYAwCSBwUyMy4xN6AHz-MBsgcFMjIuMTe4B8UdwgcJMi4xOC4xOS4xyAd0gAgB&sclient=gws-wiz-serp',2,'2026-01-22 09:01:31'),
(7,84,'https://www.php.net/manual/es/function.gettype.php',2,'2026-01-22 09:01:31');
/*!40000 ALTER TABLE `trd_general_enlaces` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(97,'07910eaa3158da71ee6383840ae4e5208328f7cd8f5f71c3dc487b801da340e3','desve_solicitud',NULL,2);
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
  KEY `ingresos_destinos` (`tid_ingreso_solicitud`),
  KEY `trd_ingresos_destinos_trd_acceso_usuarios_FK` (`tid_destino`),
  CONSTRAINT `ingresos_destinos` FOREIGN KEY (`tid_ingreso_solicitud`) REFERENCES `trd_ingresos_solicitudes` (`tis_id`),
  CONSTRAINT `trd_ingresos_destinos_trd_acceso_usuarios_FK` FOREIGN KEY (`tid_destino`) REFERENCES `trd_acceso_usuarios` (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(28,23,1,'Para','Firmante',1,NULL,NULL),
(29,23,2,'Para','Consultor',1,NULL,NULL),
(30,23,3,'Para','Consultor',1,NULL,NULL),
(31,24,1,'Para','Visador',1,NULL,NULL),
(32,24,2,'Para','Visador',0,NULL,NULL),
(33,25,1,'Para','Visador',0,NULL,NULL),
(34,25,2,'Para','Visador',0,NULL,NULL),
(35,25,3,'Para','Consultor',0,NULL,NULL),
(36,26,1,'Para','Consultor',1,NULL,NULL),
(37,27,1,'Para','Visador',1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_solicitudes`
--

LOCK TABLES `trd_ingresos_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_solicitudes` VALUES
(21,1,'prueba ingreso de ingreso 001','Prueba 001\ningreso completo','Ingresado',2,NULL,'2026-01-22 00:00:00',80),
(23,1,'prueba ingreso de ingreso 002','prueba 2, ingresar muchos documentos','Ingresado',2,NULL,'2026-01-22 00:00:00',82),
(24,1,'prueba ingreso de ingreso 003','crear solicitud sin enlaces','Ingresado',2,NULL,'2026-01-22 00:00:00',83),
(25,1,'prueba ingreso de ingreso 004','crea solicitud sin documentos','Ingresado',2,NULL,'2026-01-22 00:00:00',84),
(26,2,'prueba ingreso de ingreso 005','crear solicitud sin tipo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',85),
(27,1,'prueba ingreso de ingreso 007','solicitud sin titulo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',86);
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

-- Dump completed on 2026-01-22 11:29:44
