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
(6,'6',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2.1',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
(6,'6.2.1.1',0,'2026-01-14 09:35:53','2026-01-14 09:35:53'),
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
('7.3','Responder DESVE','paginas/desve_responder.html','Pagina',0,'2026-01-05 18:06:03','2026-01-12 10:43:01');
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
(1,2,NULL,NULL,NULL,0,'2026-01-06 18:28:37','2026-01-06 18:28:37'),
(1,3,NULL,NULL,NULL,0,'2026-01-06 16:51:57','2026-01-06 16:51:57'),
(1,6,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2025-12-29 12:53:09'),
(2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03'),
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
(13,'Congreso Nacional',7,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09'),
(14,NULL,3,NULL,NULL,NULL,1,'2026-01-12 16:18:01','2026-01-14 11:02:41'),
(16,'1234555',3,NULL,NULL,NULL,0,'2026-01-12 16:23:02','2026-01-14 11:31:27'),
(17,'2345',3,NULL,NULL,NULL,0,'2026-01-12 16:30:09','2026-01-12 16:30:09'),
(18,'3456',3,NULL,NULL,NULL,0,'2026-01-12 16:30:15','2026-01-12 16:30:15'),
(19,'nullllll',NULL,NULL,NULL,NULL,1,'2026-01-14 11:02:55','2026-01-14 11:15:48'),
(20,'sdfsdfsdf',4,NULL,NULL,NULL,1,'2026-01-14 11:15:40','2026-01-14 11:15:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_respuestas` VALUES
(1,1,'asd','2026-01-07 14:34:53',0,'2026-01-07 14:34:53','2026-01-07 14:34:53','Comentario',1),
(2,1,'adasda','2026-01-07 14:36:37',0,'2026-01-07 14:36:37','2026-01-07 14:36:37','Observación',1),
(3,2,'oh encontré un error.','2026-01-07 15:00:43',0,'2026-01-07 15:00:43','2026-01-07 15:00:43','Comentario',1),
(4,2,'esta es una prueba','2026-01-07 15:07:17',0,'2026-01-07 15:07:17','2026-01-07 15:07:17','Observación',2),
(5,2,'aaaaaaaqui','2026-01-08 11:45:23',0,'2026-01-08 11:45:23','2026-01-08 11:45:23','Comentario',2),
(6,1,'asdf','2026-01-09 08:50:29',0,'2026-01-09 08:50:29','2026-01-09 08:50:29','Comentario',1),
(7,1,'sdfsdfsdf','2026-01-09 08:53:26',0,'2026-01-09 08:53:26','2026-01-09 08:53:26','Comentario',1),
(8,1,'asdasd','2026-01-09 09:00:10',0,'2026-01-09 09:00:10','2026-01-09 09:00:10','Comentario',1),
(9,2,'qwe','2026-01-09 09:17:29',0,'2026-01-09 09:17:29','2026-01-09 09:17:29','Respuesta Final',1),
(10,41,'tes 2','2026-01-09 13:51:52',0,'2026-01-09 13:51:52','2026-01-09 13:51:52','Comentario',3),
(11,41,'tes3 ramon','2026-01-09 13:53:01',0,'2026-01-09 13:53:01','2026-01-09 13:53:01','Comentario',3),
(12,41,'ramon','2026-01-09 13:53:46',0,'2026-01-09 13:53:46','2026-01-09 13:53:46','Comentario',3),
(13,41,'14037230-7','2026-01-09 13:58:40',0,'2026-01-09 13:58:40','2026-01-09 13:58:40','Comentario',3),
(14,41,'14037230-7','2026-01-09 13:59:02',0,'2026-01-09 13:59:02','2026-01-09 13:59:02','Comentario',3),
(15,2,'dfgdfgdfg','2026-01-09 16:30:12',0,'2026-01-09 16:30:12','2026-01-09 16:30:12','Comentario',2),
(16,2,'fffffffffffffffffffffsdfsdfsdfsdf','2026-01-09 16:30:39',0,'2026-01-09 16:30:39','2026-01-09 16:30:39','Comentario',2),
(17,2,'dfgdfgdfgdfgdfgdfgdfg','2026-01-09 16:31:15',0,'2026-01-09 16:31:15','2026-01-09 16:31:15','Respuesta Final',2),
(18,2,'dfgdfg','2026-01-09 16:31:31',0,'2026-01-09 16:31:31','2026-01-09 16:31:31','Comentario',2),
(19,2,'sdfsdfsdf','2026-01-09 16:32:02',0,'2026-01-09 16:32:02','2026-01-09 16:32:02','Comentario',2),
(20,2,'vhgkghjkfhjkgvhjkl','2026-01-09 16:50:55',0,'2026-01-09 16:50:55','2026-01-09 16:50:55','Comentario',2),
(21,41,'ahora si deberia aparecer vinvulado a la 41','2026-01-09 16:54:11',0,'2026-01-09 16:54:11','2026-01-09 16:54:11','Comentario',2),
(22,3,'asdf','2026-01-09 16:54:42',0,'2026-01-09 16:54:42','2026-01-09 16:54:42','Comentario',2),
(23,12,'DERRTE','2026-01-12 16:44:37',0,'2026-01-12 16:44:37','2026-01-12 16:44:37','Comentario',1),
(24,12,'QWE','2026-01-12 16:49:24',0,'2026-01-12 16:49:24','2026-01-12 16:49:24','Comentario',1),
(25,12,'sadfc','2026-01-15 08:11:13',0,'2026-01-15 08:11:13','2026-01-15 08:11:13','Comentario',1),
(26,12,'asdasd','2026-01-15 08:32:14',0,'2026-01-15 08:32:14','2026-01-15 08:32:14','Comentario',1),
(27,12,'asdasd','2026-01-15 08:33:27',0,'2026-01-15 08:33:27','2026-01-15 08:33:27','Comentario',1),
(28,13,'sdfssdf','2026-01-15 08:36:16',0,'2026-01-15 08:36:16','2026-01-15 08:36:16','Comentario',1),
(29,13,'sdfg','2026-01-15 08:37:33',0,'2026-01-15 08:37:33','2026-01-15 08:37:33','Comentario',1),
(30,13,'sdfg','2026-01-15 08:48:37',0,'2026-01-15 08:48:37','2026-01-15 08:48:37','Comentario',1),
(31,13,'adsdfgasdfg','2026-01-15 09:30:31',0,'2026-01-15 09:30:31','2026-01-15 09:30:31','Comentario',1),
(32,13,'ddddddd','2026-01-15 09:33:49',0,'2026-01-15 09:33:49','2026-01-15 09:33:49','Comentario',1),
(33,13,'asdasdasdasdasdasd','2026-01-15 09:39:29',0,'2026-01-15 09:39:29','2026-01-15 09:39:29','Comentario',1),
(34,13,'prueba 555','2026-01-15 09:46:01',0,'2026-01-15 09:46:01','2026-01-15 09:46:01','Comentario',1),
(35,13,'prueba 172','2026-01-15 09:51:32',0,'2026-01-15 09:51:32','2026-01-15 09:51:32','Comentario',1),
(36,13,'prueba 173','2026-01-15 09:53:13',0,'2026-01-15 09:53:13','2026-01-15 09:53:13','Comentario',1),
(37,13,'aaas','2026-01-15 10:06:48',0,'2026-01-15 10:06:48','2026-01-15 10:06:48','Comentario',1),
(38,13,'ptueba 175','2026-01-15 10:07:48',0,'2026-01-15 10:07:48','2026-01-15 10:07:48','Comentario',1),
(39,13,'prueba 176','2026-01-15 10:11:43',0,'2026-01-15 10:11:43','2026-01-15 10:11:43','Comentario',1),
(40,13,'pruebq 178','2026-01-15 10:15:18',0,'2026-01-15 10:15:18','2026-01-15 10:15:18','Comentario',1);
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
  CONSTRAINT `1` FOREIGN KEY (`sol_origen_id`) REFERENCES `trd_general_organizaciones` (`org_id`),
  CONSTRAINT `2` FOREIGN KEY (`sol_prioridad_id`) REFERENCES `trd_desve_prioridades` (`pri_id`),
  CONSTRAINT `3` FOREIGN KEY (`sol_funcionario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `4` FOREIGN KEY (`sol_sector_id`) REFERENCES `trd_general_sectores` (`sec_id`),
  CONSTRAINT `5` FOREIGN KEY (`sol_reingreso_id`) REFERENCES `trd_desve_solicitudes` (`sol_id`),
  CONSTRAINT `6` FOREIGN KEY (`sol_registro_tramite`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES
(1,'Test001','prueba ',1,'','testt','2026-01-07 13:46:00',2,1,15,'2026-01-19 13:46:00',0,NULL,1,-12,'testt',0,NULL,NULL,NULL,NULL,0,'2026-01-07 13:47:05','2026-01-12 11:10:45',1,1,0),
(2,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 00:00:00',2,2,1,'2026-01-20 00:00:00',0,NULL,0,6,'esta es una prueba.',3,41,NULL,NULL,NULL,0,'2026-01-07 14:58:42','2026-01-09 15:40:01',1,2,0),
(3,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 14:51:00',NULL,2,1,'2026-01-20 16:00:00',0,NULL,0,-12,'esta es una prueba.',0,NULL,NULL,NULL,NULL,0,'2026-01-07 14:59:32','2026-01-07 14:59:32',1,3,0),
(4,'INFORME-01/2026','LA QUE INDICA',1,'','solicita lo que indica','2026-01-07 14:51:00',2,2,1,'2026-01-20 16:00:00',0,NULL,1,-14,'esta es una prueba.',0,NULL,NULL,NULL,NULL,0,'2026-01-07 14:59:37','2026-01-07 15:10:04',1,4,0),
(5,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 08:18:57','2026-01-09 08:18:57',1,5,0),
(6,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 08:20:00','2026-01-09 08:20:00',1,6,0),
(7,'01/2026','informe de informàtica',NULL,'','','2026-01-09 00:00:00',NULL,NULL,7,'2026-01-23 00:00:00',0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 10:21:13','2026-01-09 10:21:13',3,8,0),
(8,'Test001','prueba ',NULL,'','dd','2026-01-09 00:00:00',NULL,NULL,8,NULL,0,NULL,0,0,'dd',0,NULL,NULL,NULL,NULL,0,'2026-01-09 10:37:02','2026-01-09 10:37:02',1,9,0),
(9,'Test001','prueba ',1,'',' hhhhhh','2026-01-09 00:00:00',2,2,NULL,'2026-01-20 00:00:00',0,NULL,0,6,'hhhhhhhh',0,NULL,NULL,NULL,NULL,0,'2026-01-09 11:59:51','2026-01-09 11:59:51',1,10,0),
(10,'test  solo_consulta',' solo_consulta',1,'',' solo_consulta solo_consulta solo_consulta','2026-01-09 00:00:00',2,1,12,'2026-01-20 00:00:00',0,NULL,0,6,' solo_consulta solo_consulta solo_consulta',0,NULL,NULL,NULL,NULL,0,'2026-01-09 12:55:51','2026-01-09 12:55:51',1,11,0),
(11,'test  solo_consulta',' solo_consulta',1,'',' solo_consulta solo_consulta solo_consulta','2026-01-09 00:00:00',2,1,12,'2026-01-20 00:00:00',0,NULL,0,6,' solo_consulta solo_consulta solo_consulta',0,NULL,NULL,NULL,NULL,0,'2026-01-09 12:59:16','2026-01-09 12:59:16',1,12,0),
(12,'test  solo_consulta',' solo_consulta',1,'',' solo_consulta solo_consulta solo_consulta','2026-01-09 00:00:00',2,1,12,'2026-01-20 00:00:00',0,NULL,0,6,' solo_consulta solo_consulta solo_consulta',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:06:46','2026-01-09 13:06:46',1,13,0),
(13,'test  solo_consulta',' solo_consulta',1,'',' solo_consulta solo_consulta solo_consulta','2026-01-09 00:00:00',2,1,12,'2026-01-20 00:00:00',0,NULL,0,2,' solo_consulta solo_consulta solo_consulta',7,NULL,NULL,NULL,NULL,0,'2026-01-09 13:06:46','2026-01-15 10:14:47',1,14,0),
(14,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:09:18','2026-01-09 13:09:18',1,17,0),
(15,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:09:18','2026-01-09 13:09:18',1,18,0),
(16,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:10:36','2026-01-09 13:10:36',1,19,0),
(17,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:10:36','2026-01-09 13:10:36',1,20,0),
(18,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:10:58','2026-01-09 13:10:58',1,21,0),
(19,'Test001','idid',1,'','idid','2026-01-09 00:00:00',2,1,15,'2026-01-20 00:00:00',0,NULL,0,6,'idididid',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:10:58','2026-01-09 13:10:58',1,22,0),
(20,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:11','2026-01-09 13:14:11',1,23,0),
(21,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:11','2026-01-09 13:14:11',1,24,0),
(22,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:38','2026-01-09 13:14:38',1,25,0),
(23,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:38','2026-01-09 13:14:38',1,26,0),
(24,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:48','2026-01-09 13:14:48',1,27,0),
(25,'Test001','     visibility: hidden;',1,'','\n    visibility: hidden;\n    visibility: hidden;','2026-01-09 00:00:00',2,2,16,'2026-01-20 00:00:00',0,NULL,0,6,'\n    visibility: hidden;\n    visibility: hidden;',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:14:48','2026-01-09 13:14:48',1,28,0),
(26,' !== \'undefined\'',' !== \'undefined\'',NULL,'',' !== \'undefined\'','2026-01-09 00:00:00',NULL,1,3,NULL,0,NULL,0,0,' !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:16:38','2026-01-09 13:16:38',1,29,0),
(27,' !== \'undefined\'',' !== \'undefined\'',NULL,'',' !== \'undefined\'','2026-01-09 00:00:00',NULL,1,3,NULL,0,NULL,0,0,' !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:16:38','2026-01-09 13:16:38',1,30,0),
(28,' !== \'undefined\'',' !== \'undefined\'',NULL,'',' !== \'undefined\'','2026-01-09 00:00:00',NULL,1,3,NULL,0,NULL,0,0,' !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:17:44','2026-01-09 13:17:44',1,31,0),
(29,' !== \'undefined\'',' !== \'undefined\'',NULL,'',' !== \'undefined\'','2026-01-09 00:00:00',NULL,1,3,NULL,0,NULL,0,0,' !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:17:44','2026-01-09 13:17:44',1,32,0),
(30,'result.data.id !== \'undefined\'','prueba SSSSSSSSSSS',1,'','result.data.id !== \'undefined\'','2026-01-09 00:00:00',2,NULL,12,'2026-01-20 00:00:00',0,NULL,0,6,'result.data.id !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:18:05','2026-01-09 13:18:05',1,33,0),
(31,'result.data.id !== \'undefined\'','prueba SSSSSSSSSSS',1,'','result.data.id !== \'undefined\'','2026-01-09 00:00:00',2,NULL,12,'2026-01-20 00:00:00',0,NULL,0,6,'result.data.id !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:18:05','2026-01-09 13:18:05',1,34,0),
(32,'result.data.id !== \'undefined\'','prueba SSSSSSSSSSS',1,'','result.data.id !== \'undefined\'','2026-01-09 00:00:00',2,NULL,12,'2026-01-20 00:00:00',0,NULL,0,6,'result.data.id !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:18:31','2026-01-09 13:18:31',1,35,0),
(33,'result.data.id !== \'undefined\'','prueba SSSSSSSSSSS',1,'','result.data.id !== \'undefined\'','2026-01-09 00:00:00',2,NULL,12,'2026-01-20 00:00:00',0,NULL,0,6,'result.data.id !== \'undefined\'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:18:31','2026-01-09 13:18:31',1,36,0),
(34,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:19:15','2026-01-09 13:19:15',1,37,0),
(35,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:19:15','2026-01-09 13:19:15',1,38,0),
(36,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:19:25','2026-01-09 13:19:25',1,39,0),
(37,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:19:25','2026-01-09 13:19:25',1,40,0),
(38,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:20:13','2026-01-09 13:20:13',1,42,0),
(39,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:20:13','2026-01-09 13:20:13',1,43,0),
(40,'Test001','Test001',1,'','Test001Test001Test001Test001','2026-01-09 00:00:00',2,3,13,'2026-01-20 00:00:00',0,NULL,0,6,'Test001Test001Test001Test001Test001',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:49:10','2026-01-09 13:49:10',1,45,0),
(41,'Test001','Test001',1,'','Test001Test001Test001Test001','2026-01-09 00:00:00',2,3,13,'2026-01-20 00:00:00',0,NULL,0,6,'Test001Test001Test001Test001Test001',0,NULL,NULL,NULL,NULL,0,'2026-01-09 13:49:10','2026-01-09 13:49:10',1,46,0),
(42,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 15:01:32','2026-01-09 15:01:32',1,47,0),
(43,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 15:01:32','2026-01-09 15:01:32',1,48,0),
(44,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 15:03:45','2026-01-09 15:03:45',1,49,0),
(45,'','',NULL,'','','2026-01-09 00:00:00',NULL,NULL,NULL,NULL,0,NULL,0,0,'',0,NULL,NULL,NULL,NULL,0,'2026-01-09 15:03:45','2026-01-09 15:03:45',1,50,0),
(46,'1','ingreso ramon',1,'','esta es una prueba','2026-01-12 00:00:00',2,NULL,4,'2026-01-21 00:00:00',0,NULL,0,6,'este es fin de prueba',0,45,NULL,NULL,NULL,0,'2026-01-12 10:01:28','2026-01-12 10:01:28',3,51,0),
(47,'1','ingreso ramon',1,'','esta es una prueba','2026-01-12 00:00:00',2,NULL,4,'2026-01-21 00:00:00',0,NULL,0,6,'este es fin de prueba',0,45,NULL,NULL,NULL,0,'2026-01-12 10:01:28','2026-01-12 10:01:28',3,52,0),
(48,'abc123','123',1,'','aqwsde','2026-01-12 00:00:00',2,2,16,'2026-01-21 00:00:00',0,NULL,0,6,'',0,NULL,NULL,NULL,NULL,0,'2026-01-12 11:13:33','2026-01-12 11:13:33',1,53,0),
(49,'abc123','123',1,'','aqwsde','2026-01-12 00:00:00',2,2,16,'2026-01-21 00:00:00',0,NULL,0,6,'',0,NULL,NULL,NULL,NULL,0,'2026-01-12 11:13:33','2026-01-12 11:13:33',1,54,0);
/*!40000 ALTER TABLE `trd_desve_solicitudes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=455 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(117,2,'Consulta solicitud',2,'2026-01-08 17:35:10'),
(118,5,'Ingresa solicitud: ',1,'2026-01-09 08:18:57'),
(119,6,'Ingresa solicitud: ',1,'2026-01-09 08:20:00'),
(120,1,'Consulta solicitud',1,'2026-01-09 08:35:49'),
(121,1,'Consulta solicitud',1,'2026-01-09 08:39:02'),
(122,1,'Consulta solicitud',1,'2026-01-09 08:42:57'),
(123,1,'Consulta solicitud',1,'2026-01-09 08:43:16'),
(124,1,'Consulta solicitud',1,'2026-01-09 08:49:33'),
(125,1,'Consulta solicitud',1,'2026-01-09 08:50:24'),
(126,1,'Responde solicitud',1,'2026-01-09 08:50:29'),
(127,1,'Consulta solicitud',1,'2026-01-09 08:50:33'),
(128,1,'Consulta solicitud',1,'2026-01-09 08:53:19'),
(129,1,'Responde solicitud',1,'2026-01-09 08:53:26'),
(130,2,'Consulta solicitud',1,'2026-01-09 08:55:02'),
(131,1,'Consulta solicitud',1,'2026-01-09 09:00:05'),
(132,1,'Responde solicitud',1,'2026-01-09 09:00:10'),
(133,2,'Consulta solicitud',1,'2026-01-09 09:17:18'),
(134,2,'Responde solicitud',1,'2026-01-09 09:17:29'),
(135,2,'Consulta solicitud',1,'2026-01-09 09:17:30'),
(136,2,'Consulta solicitud',1,'2026-01-09 09:17:42'),
(137,2,'Consulta solicitud',1,'2026-01-09 09:17:50'),
(138,2,'Añade comentario al trámite',1,'2026-01-09 09:20:59'),
(139,2,'Consulta solicitud',1,'2026-01-09 09:20:59'),
(140,8,'Ingresa solicitud: informe de informàtica',3,'2026-01-09 10:21:13'),
(141,8,'Consulta solicitud',3,'2026-01-09 10:21:21'),
(142,9,'Ingresa solicitud: prueba ',1,'2026-01-09 10:37:02'),
(143,2,'Consulta solicitud',1,'2026-01-09 11:46:55'),
(144,2,'Consulta solicitud',1,'2026-01-09 11:58:28'),
(145,1,'Consulta solicitud',1,'2026-01-09 11:58:40'),
(146,10,'Ingresa solicitud: prueba ',1,'2026-01-09 11:59:51'),
(147,5,'Consulta solicitud',1,'2026-01-09 12:19:45'),
(148,1,'Consulta solicitud',1,'2026-01-09 12:20:21'),
(149,10,'Consulta solicitud',1,'2026-01-09 12:21:17'),
(150,10,'Consulta solicitud',1,'2026-01-09 12:54:53'),
(151,11,'Ingresa solicitud:  solo_consulta',1,'2026-01-09 12:55:51'),
(152,12,'Ingresa solicitud:  solo_consulta',1,'2026-01-09 12:59:16'),
(153,13,'Ingresa solicitud:  solo_consulta',1,'2026-01-09 13:06:46'),
(154,14,'Ingresa solicitud:  solo_consulta',1,'2026-01-09 13:06:46'),
(155,17,'Ingresa solicitud: idid',1,'2026-01-09 13:09:18'),
(156,18,'Ingresa solicitud: idid',1,'2026-01-09 13:09:18'),
(157,19,'Ingresa solicitud: idid',1,'2026-01-09 13:10:36'),
(158,20,'Ingresa solicitud: idid',1,'2026-01-09 13:10:36'),
(159,21,'Ingresa solicitud: idid',1,'2026-01-09 13:10:58'),
(160,22,'Ingresa solicitud: idid',1,'2026-01-09 13:10:58'),
(161,23,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:11'),
(162,24,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:11'),
(163,25,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:38'),
(164,26,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:38'),
(165,27,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:48'),
(166,28,'Ingresa solicitud:      visibility: hidden;',1,'2026-01-09 13:14:48'),
(167,29,'Ingresa solicitud:  !== \'undefined\'',1,'2026-01-09 13:16:38'),
(168,30,'Ingresa solicitud:  !== \'undefined\'',1,'2026-01-09 13:16:38'),
(169,31,'Ingresa solicitud:  !== \'undefined\'',1,'2026-01-09 13:17:44'),
(170,32,'Ingresa solicitud:  !== \'undefined\'',1,'2026-01-09 13:17:44'),
(171,33,'Ingresa solicitud: prueba SSSSSSSSSSS',1,'2026-01-09 13:18:05'),
(172,34,'Ingresa solicitud: prueba SSSSSSSSSSS',1,'2026-01-09 13:18:05'),
(173,35,'Ingresa solicitud: prueba SSSSSSSSSSS',1,'2026-01-09 13:18:31'),
(174,36,'Ingresa solicitud: prueba SSSSSSSSSSS',1,'2026-01-09 13:18:31'),
(175,37,'Ingresa solicitud: ',1,'2026-01-09 13:19:15'),
(176,38,'Ingresa solicitud: ',1,'2026-01-09 13:19:15'),
(177,39,'Ingresa solicitud: ',1,'2026-01-09 13:19:25'),
(178,40,'Ingresa solicitud: ',1,'2026-01-09 13:19:25'),
(179,42,'Ingresa solicitud: ',1,'2026-01-09 13:20:13'),
(180,43,'Ingresa solicitud: ',1,'2026-01-09 13:20:13'),
(181,43,'Consulta solicitud',1,'2026-01-09 13:20:18'),
(182,43,'Consulta solicitud',1,'2026-01-09 13:20:25'),
(183,43,'Consulta solicitud',1,'2026-01-09 13:32:31'),
(184,43,'Consulta solicitud',1,'2026-01-09 13:32:50'),
(185,43,'Consulta solicitud',1,'2026-01-09 13:33:55'),
(186,43,'Consulta solicitud',1,'2026-01-09 13:34:27'),
(187,43,'Consulta solicitud',1,'2026-01-09 13:35:08'),
(188,43,'Consulta solicitud',1,'2026-01-09 13:35:54'),
(189,43,'Consulta solicitud',1,'2026-01-09 13:36:12'),
(190,43,'Consulta solicitud',1,'2026-01-09 13:37:18'),
(191,2,'Consulta solicitud',1,'2026-01-09 13:37:46'),
(192,8,'Consulta solicitud',3,'2026-01-09 13:41:17'),
(193,1,'Consulta solicitud',3,'2026-01-09 13:44:06'),
(194,45,'Ingresa solicitud: Test001',1,'2026-01-09 13:49:10'),
(195,46,'Ingresa solicitud: Test001',1,'2026-01-09 13:49:10'),
(196,8,'Consulta solicitud',3,'2026-01-09 13:49:12'),
(197,46,'Consulta solicitud',1,'2026-01-09 13:49:13'),
(198,46,'Consulta solicitud',3,'2026-01-09 13:49:27'),
(199,46,'Responde solicitud',3,'2026-01-09 13:51:52'),
(200,46,'Consulta solicitud',3,'2026-01-09 13:51:58'),
(201,45,'Consulta solicitud',3,'2026-01-09 13:52:11'),
(202,46,'Consulta solicitud',3,'2026-01-09 13:52:19'),
(203,46,'Añade comentario al trámite',1,'2026-01-09 13:52:20'),
(204,46,'Consulta solicitud',1,'2026-01-09 13:52:20'),
(205,46,'Responde solicitud',3,'2026-01-09 13:53:01'),
(206,45,'Consulta solicitud',3,'2026-01-09 13:53:06'),
(207,46,'Consulta solicitud',3,'2026-01-09 13:53:13'),
(208,46,'Responde solicitud',3,'2026-01-09 13:53:46'),
(209,45,'Consulta solicitud',3,'2026-01-09 13:53:51'),
(210,46,'Consulta solicitud',3,'2026-01-09 13:53:59'),
(211,46,'Añade comentario al trámite',3,'2026-01-09 13:54:18'),
(212,46,'Consulta solicitud',3,'2026-01-09 13:54:19'),
(213,46,'Consulta solicitud',1,'2026-01-09 13:55:02'),
(214,46,'Responde solicitud',3,'2026-01-09 13:58:40'),
(215,46,'Consulta solicitud',3,'2026-01-09 13:58:44'),
(216,46,'Responde solicitud',3,'2026-01-09 13:59:02'),
(217,46,'Consulta solicitud',3,'2026-01-09 13:59:07'),
(218,46,'Consulta solicitud',1,'2026-01-09 14:03:22'),
(219,46,'Consulta solicitud',1,'2026-01-09 14:46:45'),
(220,46,'Consulta solicitud',1,'2026-01-09 15:01:23'),
(221,47,'Ingresa solicitud: ',1,'2026-01-09 15:01:32'),
(222,48,'Ingresa solicitud: ',1,'2026-01-09 15:01:32'),
(223,48,'Consulta solicitud',1,'2026-01-09 15:01:37'),
(224,48,'Consulta solicitud',1,'2026-01-09 15:01:45'),
(225,48,'Consulta solicitud',1,'2026-01-09 15:01:48'),
(226,49,'Ingresa solicitud: ',1,'2026-01-09 15:03:45'),
(227,50,'Ingresa solicitud: ',1,'2026-01-09 15:03:45'),
(228,2,'Consulta solicitud',1,'2026-01-09 15:35:39'),
(229,2,'Consulta solicitud',1,'2026-01-09 15:36:47'),
(230,2,'Consulta solicitud',1,'2026-01-09 15:38:45'),
(231,2,'Consulta solicitud',1,'2026-01-09 15:39:49'),
(232,2,'Consulta solicitud',1,'2026-01-09 15:40:00'),
(233,2,'Edita: prioridad de \"\" a \"2\"',1,'2026-01-09 15:40:01'),
(234,2,'Consulta solicitud',1,'2026-01-09 15:40:04'),
(235,2,'Consulta solicitud',1,'2026-01-09 15:44:13'),
(236,2,'Consulta solicitud',1,'2026-01-09 15:45:55'),
(237,2,'Consulta solicitud',1,'2026-01-09 15:50:23'),
(238,2,'Consulta solicitud',1,'2026-01-09 16:00:03'),
(239,2,'Consulta solicitud',1,'2026-01-09 16:00:25'),
(240,2,'Consulta solicitud',1,'2026-01-09 16:03:54'),
(241,2,'Consulta solicitud',1,'2026-01-09 16:28:28'),
(242,2,'Consulta solicitud',1,'2026-01-09 16:29:06'),
(243,1,'Consulta solicitud',1,'2026-01-09 16:29:20'),
(244,1,'Añade comentario al trámite',1,'2026-01-09 16:29:40'),
(245,1,'Consulta solicitud',1,'2026-01-09 16:29:43'),
(246,2,'Consulta solicitud',2,'2026-01-09 16:30:02'),
(247,2,'Responde solicitud',2,'2026-01-09 16:30:12'),
(248,2,'Consulta solicitud',2,'2026-01-09 16:30:24'),
(249,2,'Responde solicitud',2,'2026-01-09 16:30:39'),
(250,28,'Consulta solicitud',2,'2026-01-09 16:30:55'),
(251,2,'Consulta solicitud',2,'2026-01-09 16:31:01'),
(252,2,'Responde solicitud',2,'2026-01-09 16:31:15'),
(253,2,'Consulta solicitud',2,'2026-01-09 16:31:24'),
(254,2,'Responde solicitud',2,'2026-01-09 16:31:31'),
(255,2,'Consulta solicitud',2,'2026-01-09 16:31:47'),
(256,2,'Responde solicitud',2,'2026-01-09 16:32:02'),
(257,2,'Consulta solicitud',2,'2026-01-09 16:35:09'),
(258,2,'Consulta solicitud',2,'2026-01-09 16:43:52'),
(259,2,'Consulta solicitud',2,'2026-01-09 16:45:05'),
(260,2,'Consulta solicitud',2,'2026-01-09 16:46:30'),
(261,2,'Consulta solicitud',2,'2026-01-09 16:49:13'),
(262,2,'Consulta solicitud',2,'2026-01-09 16:50:50'),
(263,2,'Responde solicitud',2,'2026-01-09 16:50:55'),
(264,2,'Consulta solicitud',2,'2026-01-09 16:51:04'),
(265,2,'Consulta solicitud',2,'2026-01-09 16:53:59'),
(266,2,'Responde solicitud',2,'2026-01-09 16:54:11'),
(267,2,'Consulta solicitud',2,'2026-01-09 16:54:21'),
(268,3,'Consulta solicitud',2,'2026-01-09 16:54:34'),
(269,3,'Responde solicitud',2,'2026-01-09 16:54:42'),
(270,3,'Consulta solicitud',2,'2026-01-09 16:54:48'),
(271,4,'Consulta solicitud',2,'2026-01-09 16:59:12'),
(272,2,'Consulta solicitud',1,'2026-01-12 09:07:28'),
(273,46,'Consulta solicitud',3,'2026-01-12 09:50:08'),
(274,51,'Ingresa solicitud: ingreso ramon',3,'2026-01-12 10:01:28'),
(275,52,'Ingresa solicitud: ingreso ramon',3,'2026-01-12 10:01:28'),
(276,52,'Consulta solicitud',3,'2026-01-12 10:01:33'),
(277,45,'Consulta solicitud',3,'2026-01-12 10:24:59'),
(278,1,'Consulta solicitud',1,'2026-01-12 11:10:09'),
(279,53,'Ingresa solicitud: 123',1,'2026-01-12 11:13:33'),
(280,54,'Ingresa solicitud: 123',1,'2026-01-12 11:13:33'),
(281,54,'Consulta solicitud',1,'2026-01-12 11:13:35'),
(282,2,'Consulta solicitud',1,'2026-01-12 11:15:32'),
(283,2,'Consulta solicitud',1,'2026-01-12 11:21:08'),
(284,3,'Consulta solicitud',1,'2026-01-12 11:49:49'),
(285,3,'Consulta solicitud',1,'2026-01-12 11:51:01'),
(286,3,'Consulta solicitud',1,'2026-01-12 11:52:28'),
(287,3,'Consulta solicitud',1,'2026-01-12 11:54:09'),
(288,3,'Consulta solicitud',1,'2026-01-12 11:54:47'),
(289,3,'Consulta solicitud',1,'2026-01-12 11:58:18'),
(290,3,'Consulta solicitud',1,'2026-01-12 11:59:06'),
(291,3,'Consulta solicitud',1,'2026-01-12 12:04:06'),
(292,3,'Consulta solicitud',1,'2026-01-12 12:04:41'),
(293,3,'Consulta solicitud',1,'2026-01-12 12:04:50'),
(294,3,'Consulta solicitud',1,'2026-01-12 12:06:18'),
(295,3,'Consulta solicitud',1,'2026-01-12 12:08:21'),
(296,3,'Consulta solicitud',1,'2026-01-12 12:08:43'),
(297,3,'Consulta solicitud',1,'2026-01-12 12:10:28'),
(298,3,'Consulta solicitud',1,'2026-01-12 12:10:35'),
(299,3,'Consulta solicitud',1,'2026-01-12 12:13:58'),
(300,3,'Consulta solicitud',1,'2026-01-12 12:15:00'),
(301,2,'Consulta solicitud',1,'2026-01-12 12:21:02'),
(302,2,'Consulta solicitud',1,'2026-01-12 12:25:09'),
(303,2,'Consulta solicitud',1,'2026-01-12 12:25:52'),
(304,2,'Consulta solicitud',1,'2026-01-12 13:40:36'),
(305,2,'Consulta solicitud',1,'2026-01-12 13:41:31'),
(306,2,'Consulta solicitud',1,'2026-01-12 13:45:56'),
(307,2,'Consulta solicitud',1,'2026-01-12 13:46:22'),
(308,2,'Consulta solicitud',1,'2026-01-12 13:46:37'),
(309,2,'Consulta solicitud',1,'2026-01-12 13:48:06'),
(310,2,'Consulta solicitud',1,'2026-01-12 13:50:44'),
(311,2,'Consulta solicitud',1,'2026-01-12 13:50:52'),
(312,2,'Consulta solicitud',1,'2026-01-12 13:51:38'),
(313,2,'Consulta solicitud',1,'2026-01-12 13:52:34'),
(314,2,'Consulta solicitud',1,'2026-01-12 13:53:18'),
(315,2,'Consulta solicitud',1,'2026-01-12 14:18:50'),
(316,53,'Consulta solicitud',1,'2026-01-12 16:41:45'),
(317,2,'Consulta solicitud',1,'2026-01-12 16:43:29'),
(318,13,'Consulta solicitud',1,'2026-01-12 16:43:36'),
(319,13,'Añade comentario al trámite',1,'2026-01-12 16:43:47'),
(320,13,'Consulta solicitud',1,'2026-01-12 16:43:48'),
(321,13,'Consulta solicitud',1,'2026-01-12 16:44:30'),
(322,13,'Responde solicitud',1,'2026-01-12 16:44:37'),
(323,13,'Consulta solicitud',1,'2026-01-12 16:44:47'),
(324,13,'Consulta solicitud',1,'2026-01-12 16:49:15'),
(325,13,'Responde solicitud',1,'2026-01-12 16:49:24'),
(326,21,'Consulta solicitud',1,'2026-01-12 16:52:05'),
(327,13,'Consulta solicitud',1,'2026-01-12 17:14:00'),
(328,3,'Consulta solicitud',1,'2026-01-12 17:28:53'),
(329,3,'Consulta solicitud',1,'2026-01-12 17:45:11'),
(330,14,'Consulta solicitud',1,'2026-01-14 17:49:36'),
(331,14,'Consulta solicitud',1,'2026-01-14 17:52:09'),
(332,14,'Consulta solicitud',1,'2026-01-14 17:52:54'),
(333,13,'Consulta solicitud',1,'2026-01-15 08:10:29'),
(334,13,'Responde solicitud',1,'2026-01-15 08:11:13'),
(335,13,'Consulta solicitud',1,'2026-01-15 08:31:52'),
(336,13,'Responde solicitud',1,'2026-01-15 08:32:14'),
(337,13,'Consulta solicitud',1,'2026-01-15 08:33:19'),
(338,13,'Responde solicitud',1,'2026-01-15 08:33:27'),
(339,14,'Consulta solicitud',1,'2026-01-15 08:35:52'),
(340,14,'Responde solicitud',1,'2026-01-15 08:36:16'),
(341,14,'Consulta solicitud',1,'2026-01-15 08:37:21'),
(342,14,'Responde solicitud',1,'2026-01-15 08:37:33'),
(343,14,'Consulta solicitud',1,'2026-01-15 08:45:25'),
(344,14,'Responde solicitud',1,'2026-01-15 08:48:37'),
(345,14,'Consulta solicitud',1,'2026-01-15 09:30:23'),
(346,14,'Responde solicitud',1,'2026-01-15 09:30:31'),
(347,14,'Consulta solicitud',1,'2026-01-15 09:33:41'),
(348,14,'Responde solicitud',1,'2026-01-15 09:33:49'),
(349,14,'Consulta solicitud',1,'2026-01-15 09:39:19'),
(350,14,'Responde solicitud',1,'2026-01-15 09:39:29'),
(351,14,'Consulta solicitud',1,'2026-01-15 09:42:12'),
(352,14,'Responde solicitud',1,'2026-01-15 09:46:01'),
(353,14,'Consulta solicitud',1,'2026-01-15 09:51:14'),
(354,14,'Responde solicitud',1,'2026-01-15 09:51:32'),
(355,14,'Consulta solicitud',1,'2026-01-15 09:52:57'),
(356,14,'Responde solicitud',1,'2026-01-15 09:53:13'),
(357,14,'Consulta solicitud',1,'2026-01-15 10:06:39'),
(358,14,'Responde solicitud',1,'2026-01-15 10:06:48'),
(359,14,'Consulta solicitud',1,'2026-01-15 10:07:30'),
(360,14,'Responde solicitud',1,'2026-01-15 10:07:48'),
(361,14,'Consulta solicitud',1,'2026-01-15 10:11:29'),
(362,14,'Responde solicitud',1,'2026-01-15 10:11:43'),
(363,14,'Consulta solicitud',1,'2026-01-15 10:12:06'),
(364,14,'Consulta solicitud',1,'2026-01-15 10:12:23'),
(365,14,'Consulta solicitud',1,'2026-01-15 10:14:23'),
(366,14,'Consulta solicitud',1,'2026-01-15 10:14:47'),
(367,14,'Consulta solicitud',1,'2026-01-15 10:14:58'),
(368,14,'Responde solicitud',1,'2026-01-15 10:15:18'),
(369,14,'Consulta solicitud',1,'2026-01-15 10:15:33'),
(370,14,'Consulta solicitud',1,'2026-01-15 10:15:44'),
(371,14,'Consulta solicitud',1,'2026-01-15 10:17:21'),
(372,14,'Consulta solicitud',1,'2026-01-15 10:19:00'),
(373,14,'Consulta solicitud',1,'2026-01-15 10:20:11'),
(374,14,'Consulta solicitud',1,'2026-01-15 10:21:24'),
(375,14,'Consulta solicitud',1,'2026-01-15 10:24:38'),
(376,14,'Consulta solicitud',1,'2026-01-15 10:25:19'),
(377,14,'Consulta solicitud',1,'2026-01-15 10:25:36'),
(378,14,'Consulta solicitud',1,'2026-01-15 10:26:08'),
(379,14,'Consulta solicitud',1,'2026-01-15 10:52:40'),
(380,14,'Consulta solicitud',1,'2026-01-15 10:55:13'),
(381,14,'Consulta solicitud',1,'2026-01-15 10:56:09'),
(382,14,'Consulta solicitud',1,'2026-01-15 10:59:43'),
(383,14,'Consulta solicitud',1,'2026-01-15 11:05:19'),
(384,14,'Consulta solicitud',1,'2026-01-15 11:16:03'),
(385,14,'Consulta solicitud',1,'2026-01-15 11:18:03'),
(386,14,'Consulta solicitud',1,'2026-01-15 11:20:31'),
(387,14,'Consulta solicitud',1,'2026-01-15 11:31:23'),
(388,14,'Consulta solicitud',1,'2026-01-15 11:41:50'),
(389,14,'Consulta solicitud',1,'2026-01-15 11:42:05'),
(390,14,'Consulta solicitud',1,'2026-01-15 11:44:45'),
(391,14,'Consulta solicitud',1,'2026-01-15 11:51:28'),
(392,14,'Consulta solicitud',1,'2026-01-15 11:53:39'),
(393,14,'Consulta solicitud',1,'2026-01-15 11:53:42'),
(394,14,'Consulta solicitud',1,'2026-01-15 11:56:49'),
(395,14,'Consulta solicitud',1,'2026-01-15 12:12:22'),
(396,14,'Consulta solicitud',1,'2026-01-15 12:18:20'),
(397,14,'Consulta solicitud',1,'2026-01-15 12:19:51'),
(398,14,'Consulta solicitud',1,'2026-01-15 12:21:16'),
(399,14,'Consulta solicitud',1,'2026-01-15 12:52:42'),
(400,14,'Consulta solicitud',1,'2026-01-15 12:53:14'),
(401,14,'Consulta solicitud',1,'2026-01-15 12:55:19'),
(402,14,'Consulta solicitud',1,'2026-01-15 12:56:11'),
(403,14,'Consulta solicitud',1,'2026-01-15 13:23:06'),
(404,14,'Consulta solicitud',1,'2026-01-15 13:23:24'),
(405,14,'Consulta solicitud',1,'2026-01-15 13:34:09'),
(406,14,'Consulta solicitud',1,'2026-01-15 13:36:14'),
(407,14,'Consulta solicitud',1,'2026-01-15 13:37:40'),
(408,14,'Consulta solicitud',1,'2026-01-15 13:41:45'),
(409,14,'Consulta solicitud',1,'2026-01-15 14:04:56'),
(410,14,'Consulta solicitud',1,'2026-01-15 14:07:35'),
(411,14,'Consulta solicitud',1,'2026-01-15 14:09:46'),
(412,14,'Consulta solicitud',1,'2026-01-15 14:10:46'),
(413,14,'Consulta solicitud',1,'2026-01-15 14:11:14'),
(414,14,'Consulta solicitud',1,'2026-01-15 14:11:49'),
(415,14,'Consulta solicitud',1,'2026-01-15 14:14:04'),
(416,14,'Consulta solicitud',1,'2026-01-15 14:16:05'),
(417,14,'Consulta solicitud',1,'2026-01-15 14:16:17'),
(418,14,'Consulta solicitud',1,'2026-01-15 14:18:28'),
(419,14,'Consulta solicitud',1,'2026-01-15 14:19:00'),
(420,14,'Consulta solicitud',1,'2026-01-15 14:19:01'),
(421,14,'Consulta solicitud',1,'2026-01-15 14:19:02'),
(422,14,'Consulta solicitud',1,'2026-01-15 14:21:09'),
(423,14,'Consulta solicitud',1,'2026-01-15 14:21:48'),
(424,14,'Consulta solicitud',1,'2026-01-15 14:23:44'),
(425,14,'Consulta solicitud',1,'2026-01-15 14:24:23'),
(426,14,'Consulta solicitud',1,'2026-01-15 14:28:31'),
(427,14,'Consulta solicitud',1,'2026-01-15 14:29:56'),
(428,14,'Consulta solicitud',1,'2026-01-15 14:32:12'),
(429,14,'Consulta solicitud',1,'2026-01-15 14:32:49'),
(430,14,'Consulta solicitud',1,'2026-01-15 14:34:07'),
(431,14,'Consulta solicitud',1,'2026-01-15 14:34:47'),
(432,14,'Consulta solicitud',1,'2026-01-15 14:35:15'),
(433,14,'Consulta solicitud',1,'2026-01-15 14:37:01'),
(434,14,'Consulta solicitud',1,'2026-01-15 14:37:35'),
(435,14,'Consulta solicitud',1,'2026-01-15 14:38:17'),
(436,14,'Consulta solicitud',1,'2026-01-15 14:38:40'),
(437,14,'Consulta solicitud',1,'2026-01-15 14:39:42'),
(438,14,'Consulta solicitud',1,'2026-01-15 14:39:52'),
(439,14,'Consulta solicitud',1,'2026-01-15 14:40:27'),
(440,14,'Consulta solicitud',1,'2026-01-15 14:41:31'),
(441,14,'Consulta solicitud',1,'2026-01-15 14:42:08'),
(442,14,'Consulta solicitud',1,'2026-01-15 14:42:35'),
(443,14,'Consulta solicitud',1,'2026-01-15 14:45:19'),
(444,14,'Consulta solicitud',1,'2026-01-15 14:47:21'),
(445,14,'Consulta solicitud',1,'2026-01-15 14:48:01'),
(446,14,'Consulta solicitud',1,'2026-01-15 14:48:10'),
(447,14,'Consulta solicitud',1,'2026-01-15 14:48:17'),
(448,14,'Consulta solicitud',1,'2026-01-15 14:50:07'),
(449,14,'Consulta solicitud',1,'2026-01-15 14:51:11'),
(450,14,'Consulta solicitud',1,'2026-01-15 14:52:40'),
(451,14,'Consulta solicitud',1,'2026-01-15 14:53:26'),
(452,14,'Consulta solicitud',1,'2026-01-15 14:53:50'),
(453,14,'Consulta solicitud',1,'2026-01-15 15:07:42'),
(454,14,'Consulta solicitud',1,'2026-01-15 16:07:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES
(1,2,'asdasd',NULL,2,'2026-01-08 16:39:14'),
(2,1,'aaaaaaaa',NULL,2,'2026-01-09 13:17:41'),
(3,1,'dddd',NULL,2,'2026-01-09 13:20:59'),
(4,1,'as',NULL,46,'2026-01-09 17:52:20'),
(5,3,'21231',NULL,46,'2026-01-09 17:54:18'),
(6,1,'eee',NULL,1,'2026-01-09 20:29:40'),
(7,1,'2',NULL,13,'2026-01-12 20:43:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES
(1,13,'2026-01-15 10:11:44','/uploads/documentos/d29d03722b156c15c74f07baef789b5ed266e454.pdf','2512012877.pdf',1,0),
(2,13,'2026-01-15 10:15:18','/uploads/documentos/487387025b17996c6c709eaf0e7dd8f62e6cd152.pdf','20140729223740-pagina2011051422575611.pdf',1,0);
/*!40000 ALTER TABLE `trd_general_documento_adjunto` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(4,'02a70dce3476641106c5d532b4df4ca061ebc3dfaa726afce756f721102bebc9','ingresos_solicitud',NULL,1),
(5,'e8ff6e28beb385b9323cfa33ec37a331c7298cec1f0f1e88fc42dc496d470be3','ingresos_solicitud',NULL,1),
(6,'4afd473a9032a4810913fc80c6fda97bcc2c4585e5146061f9d5597a38a5ed7f','ingresos_solicitud',NULL,1),
(8,'d1819c9ae308f8b1a65f269cd37441e1726026eaec7cbbf008cf29a21799ebcf','ingresos_solicitud',NULL,3),
(9,'9a6f876a162b785cb6d81e7e7a23ffa61bc17916743a54d503711da4b2e2fed0','ingresos_solicitud',NULL,1),
(10,'d8de1a2a18aad11195c0f548ec37a5a1e5952d44cf234caf998a51fb3a2b7b19','ingresos_solicitud',NULL,1),
(11,'cb99ce56a10e25f7151c96306c9d416d5677d6260aed08b0b96b7e52e7100640','ingresos_solicitud',NULL,1),
(12,'cf47758975c9ec9b3cb0a86487b8c4a4e152704aaf1811c85383467adcc2d396','ingresos_solicitud',NULL,1),
(13,'019b96d523e87c0a0c6d2b93046515266facefd0b5e781986fe6328331532201','ingresos_solicitud',NULL,1),
(14,'95b4f1ef8d2e46bbde9215aa5c9ffd28857b65743aabd9108b1a3d2ac17a5d96','ingresos_solicitud',NULL,1),
(17,'634de1b2daf2f97ce5f1ee2dcb6588fec9d357ac6d00909622fcc12d6e22fd6a','ingresos_solicitud',NULL,1),
(18,'3ac47ea502e12be880461349aa6cb27e22e310c1ca33a700fea734a5311b5a88','ingresos_solicitud',NULL,1),
(19,'a1494e0148fc3e1c7491c57dd62b48fd4ef969486e69eb45ad1160ebc3fbac17','ingresos_solicitud',NULL,1),
(20,'2e01255cf230f9229e4e153f8627be0735e2ddf17fa410e39d6f318d5c8da939','ingresos_solicitud',NULL,1),
(21,'69efebfb48229d55d6ef2ec58732ebc48f1fbe8e1c35801a1e62490af7f03bc8','ingresos_solicitud',NULL,1),
(22,'bb48f64b8bb9a77227210c738bcac544669ca1467073c5404d2c1f2e9a632d56','ingresos_solicitud',NULL,1),
(23,'d82f7da515c1d94f8e45692233cce73eafd7eb487022de47879189619a956177','ingresos_solicitud',NULL,1),
(24,'a96a8dd58dea803fdf858681d34821187256614ca96e5393a5ccd346d15ad0eb','ingresos_solicitud',NULL,1),
(25,'1ecb6a279f128f07ca0c9397641a0bbe5490b8cc198293a931ee6f9f65403e30','ingresos_solicitud',NULL,1),
(26,'65aba106459ca21798cda7e352340925c68fbe40995233744644d3fa77b862e9','ingresos_solicitud',NULL,1),
(27,'f7a3d2b8aa747fcea8726df89d748fb5b6b59d504422703d02836ae3a51342d2','ingresos_solicitud',NULL,1),
(28,'5c741062a7a6476cd912d434db9d54102018db12b910d7f312facbea9dd9728e','ingresos_solicitud',NULL,1),
(29,'950add82c9b156c070770a3d847c3bb9fadabe3ca9f0f6489db7d67b7db4774f','ingresos_solicitud',NULL,1),
(30,'b214f21dd66bb2614bc0e8f5a90655c4738616de2b0594e9caeb65edc0b27bf2','ingresos_solicitud',NULL,1),
(31,'d07e325403c18eb832106f77f8e9f50c8914e2a85a8a650b7a9401e77f27d67d','ingresos_solicitud',NULL,1),
(32,'c62ddb59729586c36b4d7b015cc97040c7fa292a043789162385c721ab0bbd76','ingresos_solicitud',NULL,1),
(33,'5e251b3872f0668f4e88f32f46204b5c7e287fefd76b1774c8a489dd851e4517','ingresos_solicitud',NULL,1),
(34,'47924e0a5dfb3dc06f719d960ea7a7742feb8f30fbeb6175f1e51aefc5b8f12e','ingresos_solicitud',NULL,1),
(35,'d86aa8d83f86875ee46844efb73fddc58a78c841f7dcbcb02fd5fcd963aa7838','ingresos_solicitud',NULL,1),
(36,'4e0121e99a1a14254de8beec63bf56dabb4e57eea61150ebbf94bff4fc4956fe','ingresos_solicitud',NULL,1),
(37,'637a51610651b25af27a73e15f97498c4834e00abef30ea337282d0551a5fa97','ingresos_solicitud',NULL,1),
(38,'479f01e0ee2eb69d4153ab8047c2ae8914f07898e30e7364fd0359e75e1f1820','ingresos_solicitud',NULL,1),
(39,'9d1fb09b1daca75d8abf5854ef4a5708f57b97a5978cb0c98bcecd1775a8a38c','ingresos_solicitud',NULL,1),
(40,'3b2190b3e76e9fd93aa9292689fd8cda05b8da65041cfb974d7b053e4e4718e8','ingresos_solicitud',NULL,1),
(42,'ddef2beccea4c47b210218278b2128e6dcc32c4df0dac27c579990caa5de77db','ingresos_solicitud',NULL,1),
(43,'94ef8c988124403674452e0c9c804287438cf10c54d4ec71c0b6210f68d0fe9a','ingresos_solicitud',NULL,1),
(45,'b2b501e542ee6ccd4e8a8bee871c62dffb710b216f3ac396526a741d37a2cc79','ingresos_solicitud',NULL,1),
(46,'422a54320972cbfc73cefb507ddb40c6b22475479cbcd06c71456c2be0b4986e','ingresos_solicitud',NULL,1),
(47,'491640d7b214870b5f667d2fed73b0472ead7f2d5f871d9eaebc7f78d2da6e1d','ingresos_solicitud',NULL,1),
(48,'0ad3540275ab5ab86359b68af7bb949020bb16ac53290c2d2f66f17e04e3cfc5','ingresos_solicitud',NULL,1),
(49,'b06241a8b96ee48d81523fb74cbc19cceca9118421cfc9558cb57c1af6e2e849','ingresos_solicitud',NULL,1),
(50,'16f00f2d88546c1b920c4c3f811e4eaad47c55182da2c00ef646e002798b2fb0','ingresos_solicitud',NULL,1),
(51,'95a379879477bdad522b7b8c237090c0a7cc970444a5702e861e9ba4a2315d86','ingresos_solicitud',NULL,3),
(52,'82ce1cae7f900d31d6582bc2023cf4ef93e58c51ae9809b90b4e998a07d2a0ee','ingresos_solicitud',NULL,3),
(53,'3c36f699c7cca24183f3a137485385a70f6cc0f79f1aa3aceb234c1be5e102d8','desve_solicitud',NULL,1),
(54,'94ec5baf88417839072d80211643c275e7ed0d1210c10404514921232b183b19','desve_solicitud',NULL,1);
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

-- Dump completed on 2026-01-15 16:22:45
