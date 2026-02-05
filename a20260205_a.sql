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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_acceso_perfiles`
--

LOCK TABLES `trd_acceso_perfiles` WRITE;
/*!40000 ALTER TABLE `trd_acceso_perfiles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_acceso_perfiles` VALUES (1,'Administrador de Sistema',0,'2025-12-29 12:53:09','2026-01-30 15:46:54');
INSERT INTO `trd_acceso_perfiles` VALUES (2,'Patentes Comerciales',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_perfiles` VALUES (3,'Organizaciones_comunitarias',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_perfiles` VALUES (4,'Desarollo_Vecinal',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_perfiles` VALUES (5,'Atenciones',0,'2025-12-29 12:53:09','2026-01-29 12:44:01');
INSERT INTO `trd_acceso_perfiles` VALUES (6,'6',0,'2025-12-29 12:53:09','2026-02-02 08:34:42');
INSERT INTO `trd_acceso_perfiles` VALUES (7,'Subvenciones',0,'2026-01-19 13:35:49','2026-01-19 13:35:49');
INSERT INTO `trd_acceso_perfiles` VALUES (8,'Ingresos',0,'2026-01-19 13:35:49','2026-01-19 13:35:49');
INSERT INTO `trd_acceso_perfiles` VALUES (9,'Abogado_DESVE',0,'2026-02-02 15:42:11','2026-02-02 15:42:11');
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
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1',0,'2026-02-02 08:34:53','2026-02-02 08:34:53');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.1.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2',0,'2026-02-02 08:34:54','2026-02-02 08:34:54');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.1',0,'2026-02-02 08:34:54','2026-02-02 08:34:54');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.1.1',0,'2026-02-02 08:34:55','2026-02-02 08:34:55');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.1.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.1.3',0,'2026-02-02 08:34:55','2026-02-02 08:34:55');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.2',0,'2026-02-02 08:34:55','2026-02-02 08:34:55');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.2.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3.1',0,'2026-02-02 08:34:56','2026-02-02 08:34:56');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3.2',0,'2026-02-02 08:34:56','2026-02-02 08:34:56');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3.3',0,'2026-02-02 08:34:56','2026-02-02 08:34:56');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3.4',0,'2026-02-02 08:34:57','2026-02-02 08:34:57');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'1.2.3.5',0,'2026-02-02 08:34:57','2026-02-02 08:34:57');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (1,'0',0,'2026-02-02 08:40:58','2026-02-02 08:40:58');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4',0,'2026-02-02 08:41:16','2026-02-02 08:41:16');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.1',0,'2026-02-02 08:41:16','2026-02-02 08:41:16');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.2',0,'2026-02-02 08:41:16','2026-02-02 08:41:16');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.3',0,'2026-02-02 08:41:16','2026-02-02 08:41:16');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.4',0,'2026-02-02 08:41:17','2026-02-02 08:41:17');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.5',0,'2026-02-02 08:41:17','2026-02-02 08:41:17');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (4,'4.6',0,'2026-02-02 08:41:17','2026-02-02 08:41:17');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8',0,'2026-02-02 08:41:42','2026-02-02 08:41:42');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.1',0,'2026-02-02 08:41:42','2026-02-02 08:41:42');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.2',0,'2026-02-02 08:41:42','2026-02-02 08:41:42');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.3',0,'2026-02-02 08:41:42','2026-02-02 08:41:42');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.4',0,'2026-02-02 08:41:43','2026-02-02 08:41:43');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.5',0,'2026-02-02 08:41:43','2026-02-02 08:41:43');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.6',0,'2026-02-02 08:41:43','2026-02-02 08:41:43');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (8,'8.7',0,'2026-02-02 08:41:43','2026-02-02 08:41:43');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (9,'4.3',0,'2026-02-02 15:42:38','2026-02-02 15:42:38');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (9,'4.6',0,'2026-02-02 15:42:38','2026-02-02 15:42:38');
INSERT INTO `trd_acceso_perfiles_roles` VALUES (9,'4',0,'2026-02-02 15:52:03','2026-02-02 15:52:03');
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
INSERT INTO `trd_acceso_roles` VALUES ('0','Bandeja','paginas/Bandeja.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('1','Administracion sistema',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.1','Logs del Sistema',NULL,'subcategoria',0,'2025-12-29 12:53:09','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.1.1','Consulta de Log','paginas/logs_consulta_log.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.1.2','Listado de Logs','paginas/logs_listado_logs.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.1.3','Acceso','','subcategoria',1,'2026-01-30 11:29:05','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2','Mantenedores',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.1','General',NULL,'subcategoria',0,'2026-01-14 09:33:54','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.1.1','Contribuyentes','paginas/sisadmin_mantenedor_general_contribuyentes.html','Pagina',0,'2026-01-14 09:33:54','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.1.2','Organizaciones Comunitarias','paginas/sisadmin_mantenedor_general_org_comunitarias.html','Pagina',0,'2026-01-26 10:30:51','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.1.3','Roles','sisadmin_mantenedor_acceso_roles.html','Pagina',1,'2026-01-30 11:27:02','2026-02-03 16:45:09');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.2','DESVE','','subcategoria',0,'2026-01-26 10:28:30','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.2.1','Oigenes especiales','paginas/sisadmin_mantenedor_desve_oigenesespeciales.html','Pagina',0,'2026-01-26 10:30:51','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3','Acceso','','subcategoria',0,'2026-01-30 11:30:27','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3.1','Usuaios','paginas/sisadmin_mantenedor_acceso_usuarios.html','Pagina',0,'2026-01-30 11:33:12','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3.2','Usuarios por Perfil','paginas/sisadmin_mantenedor_acceso_usuarios_perfiles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3.3','Perfiles','paginas/sisadmin_mantenedor_acceso_perfiles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3.4','Perfiles por Rol','paginas/sisadmin_mantenedor_acceso_perfiles_roles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('1.2.3.5','Roles','paginas/sisadmin_mantenedor_acceso_roles.html','Pagina',0,'2026-01-30 13:22:26','2026-01-30 15:46:31');
INSERT INTO `trd_acceso_roles` VALUES ('11','Patentes',NULL,'categoria',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('11.1','Mis Solicitudes','paginas/patentes_mis_solicitudes.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('11.2','Pagos','paginas/pagos.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('11.3','Solicitud Única de Patentes','paginas/patentes_solicitud_unica.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('11.4','Consulta de Solicitud','paginas/patentes_consulta_solicitud.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('11.c','Gestión de Empresas','paginas/contribuyente_empresas.html','Pagina',0,'2025-12-29 12:53:09','2026-01-30 15:45:41');
INSERT INTO `trd_acceso_roles` VALUES ('2','Organizaciones Comunitarias',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('2.1','Organizaciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('2.1.1','Consulta Organizacion','paginas/organizaciones_consulta_organizacion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('2.1.2','Consulta Masiva Organizaciones','paginas/organizaciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3','Subvenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3.1','Subvenciones',NULL,'subcategoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3.1.1','Consulta de Subvención','paginas/subvenciones_consulta_subvencion.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3.1.2','Consulta Masiva de Subvenciones','paginas/subvenciones_consulta_masiva.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3.1.7','Consulta Masiva de Pagos','paginas/subvenciones_consulta_masiva_pagos.html','Pagina',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('3.2','Postulaciones',NULL,NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13');
INSERT INTO `trd_acceso_roles` VALUES ('3.2.1','Consulta de Postulación','paginas/postulaciones_consulta_postulacion.html',NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13');
INSERT INTO `trd_acceso_roles` VALUES ('3.2.2','Consulta Masiva de Postulaciones','paginas/postulaciones_consulta_masiva.html',NULL,0,'2026-01-30 13:37:13','2026-01-30 13:37:13');
INSERT INTO `trd_acceso_roles` VALUES ('4','DESVE',NULL,'categoria',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.1','Nuevo Ingreso ','paginas/desve_nuevo.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.2','Listado ','paginas/desve_listado_ingresos.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.3','Historial ','paginas/desve_historial.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.4','Edicion ','paginas/desve_modificar.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.5','Responder ','paginas/desve_responder.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('4.6','Consulta ','paginas/desve_consultar.html','Pagina',0,'2026-01-30 13:45:50','2026-01-30 15:44:42');
INSERT INTO `trd_acceso_roles` VALUES ('5','Atenciones',NULL,'categoria',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_acceso_roles` VALUES ('5.1','Lista de espera','paginas/atenciones_lista_espera.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05');
INSERT INTO `trd_acceso_roles` VALUES ('5.2','Historial','paginas/atenciones_listado_atenciones.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05');
INSERT INTO `trd_acceso_roles` VALUES ('5.3','Nueva','paginas/atenciones_nueva_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05');
INSERT INTO `trd_acceso_roles` VALUES ('5.4','Tomar Atención','paginas/atenciones_tomar_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05');
INSERT INTO `trd_acceso_roles` VALUES ('5.5','Consultar','paginas/atenciones_consulta_atencion.html','Pagina',0,'2025-12-29 12:53:09','2026-01-29 12:49:05');
INSERT INTO `trd_acceso_roles` VALUES ('8','Ingresos',NULL,'categoria',0,'2026-01-19 10:44:56','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.1','Bandeja','paginas/ingr_bandeja.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.2','Crear ','paginas/ingr_crear.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.3','Consultar ','paginas/ingr_consultar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.4','Moificar ','paginas/ingr_modificar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.5','Respoder','paginas/ingr_responder.html','Pagina',0,'2026-01-19 10:54:34','2026-01-19 11:14:39');
INSERT INTO `trd_acceso_roles` VALUES ('8.6','Preparar','paginas/ingr_preparar.html','Pagina',0,'2026-01-19 10:54:34','2026-01-26 08:06:32');
INSERT INTO `trd_acceso_roles` VALUES ('8.7','Historial ','paginas/ingr_historial.html','Pagina',0,'2026-01-26 07:52:09','2026-01-26 07:52:09');
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
INSERT INTO `trd_acceso_usuarios` VALUES (1,'Juan','hervas','14711939-9','juan.hervas@munivina.cl',0,'2025-12-29 12:53:09','2026-01-07 13:43:55');
INSERT INTO `trd_acceso_usuarios` VALUES (2,'Leticia','meneses','17619949-0','leticia.meneses@munivina.cl',0,'2026-01-06 11:47:58','2026-01-06 11:48:23');
INSERT INTO `trd_acceso_usuarios` VALUES (3,'Ramon','Evil Guy','14037230-7','ramon.martinez@munivina.cl',0,'2026-01-09 10:13:01','2026-01-09 10:13:01');
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
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,1,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2026-01-30 15:48:51');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,2,NULL,NULL,NULL,1,'2026-01-06 18:28:37','2026-01-19 13:32:10');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,3,NULL,NULL,NULL,1,'2026-01-06 16:51:57','2026-01-19 13:32:18');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,4,NULL,NULL,NULL,0,'2026-01-30 13:48:40','2026-01-30 13:48:40');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,5,NULL,NULL,NULL,1,'2026-01-29 12:49:37','2026-01-29 13:12:46');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (1,8,NULL,NULL,NULL,0,'2026-01-19 13:37:24','2026-01-19 13:37:24');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (2,6,NULL,NULL,NULL,0,'2026-01-06 12:29:03','2026-01-06 12:29:03');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (2,8,NULL,NULL,NULL,0,'2026-01-21 16:21:00','2026-01-21 16:21:00');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (3,4,NULL,NULL,NULL,1,'2026-02-02 15:40:43','2026-02-02 15:43:08');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (3,6,NULL,NULL,NULL,1,'2026-01-09 10:15:40','2026-01-28 16:45:06');
INSERT INTO `trd_acceso_usuarios_perfiles` VALUES (3,9,NULL,'2026-02-03 15:43:00',NULL,0,'2026-02-02 15:43:23','2026-02-02 15:43:23');
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
INSERT INTO `trd_desve_destinos` VALUES (26,62,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (27,61,1,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (28,61,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (29,61,3,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (30,69,1,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (31,60,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (32,70,1,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (33,70,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (34,70,3,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (35,66,1,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (36,66,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (37,71,1,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (43,72,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (45,73,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (46,74,3,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (47,75,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (48,76,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (49,77,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (50,78,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (51,79,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (52,80,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (53,81,2,NULL,NULL);
INSERT INTO `trd_desve_destinos` VALUES (54,82,2,NULL,NULL);
/*!40000 ALTER TABLE `trd_desve_destinos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_organizaciones`
--

LOCK TABLES `trd_desve_organizaciones` WRITE;
/*!40000 ALTER TABLE `trd_desve_organizaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_organizaciones` VALUES (1,'Antonella Pecchenino Lobos',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (2,'Nancy Díaz Soto',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (3,'Carlos Williams Arriola',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (4,'Sandro Puebla Veas',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (5,'Nicolás López Pimentel',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (6,'Alejandro Aguilera Moya',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (7,'José Bartolucci Schapacasse',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (8,'Antonia Scarella Chamy',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (9,'Andrés Solar Miranda',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (10,'Francisco Mejías Díaz',4,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (11,'Ley De Tansparencia',5,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (12,'Contraloria General',6,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (13,'Congreso Nacional',7,NULL,NULL,NULL,0,'2026-01-12 15:33:09','2026-01-12 15:33:09');
INSERT INTO `trd_desve_organizaciones` VALUES (21,'CALAFATe',3,NULL,NULL,NULL,1,'2026-01-22 13:13:45','2026-01-22 13:14:04');
INSERT INTO `trd_desve_organizaciones` VALUES (22,'pruebaingresoorigenespecial',4,NULL,NULL,NULL,0,'2026-01-28 14:44:48','2026-01-28 14:44:48');
INSERT INTO `trd_desve_organizaciones` VALUES (23,'Juan Perez',4,NULL,NULL,NULL,0,'2026-02-03 10:28:36','2026-02-03 10:28:36');
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
INSERT INTO `trd_desve_prioridades` VALUES (1,'Alta',3,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_desve_prioridades` VALUES (2,'Media',8,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_desve_prioridades` VALUES (3,'Baja',10,1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_respuestas` VALUES (1,57,'sdf','2026-01-22 12:11:11',0,'2026-01-22 12:11:11','2026-01-22 12:11:11','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (2,57,'utyu','2026-01-22 12:17:30',0,'2026-01-22 12:17:30','2026-01-22 12:17:30','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (3,57,'qweqwerwerwerw','2026-01-22 12:42:12',0,'2026-01-22 12:42:12','2026-01-22 12:42:12','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (4,59,'aedfdg','2026-01-22 13:21:29',0,'2026-01-22 13:21:29','2026-01-22 13:21:29','Respuesta Final',1);
INSERT INTO `trd_desve_respuestas` VALUES (5,69,'asdddasdasdasdasdasdasd','2026-01-28 13:00:32',0,'2026-01-28 13:00:32','2026-01-28 13:00:32','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (6,69,'sdfsdf','2026-01-28 13:04:12',0,'2026-01-28 13:04:12','2026-01-28 13:04:12','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (7,69,'dfgh','2026-01-28 13:04:49',0,'2026-01-28 13:04:49','2026-01-28 13:04:49','Comentario',1);
INSERT INTO `trd_desve_respuestas` VALUES (8,74,'holo','2026-01-30 09:10:05',0,'2026-01-30 09:10:05','2026-01-30 09:10:05','Respuesta Final',3);
INSERT INTO `trd_desve_respuestas` VALUES (9,74,'cert','2026-01-30 09:10:36',0,'2026-01-30 09:10:36','2026-01-30 09:10:36','Comentario',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_desve_solicitudes`
--

LOCK TABLES `trd_desve_solicitudes` WRITE;
/*!40000 ALTER TABLE `trd_desve_solicitudes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_desve_solicitudes` VALUES (57,'Test001','prueba ',1,'','guardarAtencion()guardarAtencion()','2026-01-22 00:00:00',NULL,1,16,NULL,0,NULL,0,0,'guardarAtencion()guardarAtencion()',1,NULL,NULL,NULL,NULL,0,'2026-01-22 11:12:46','2026-01-22 12:28:26',2,96,1);
INSERT INTO `trd_desve_solicitudes` VALUES (58,'Test001','prueba ',6,'','adfgsdfg','2026-01-22 00:00:00',NULL,1,7,NULL,0,NULL,0,0,'sdfgsdfg',1,NULL,NULL,NULL,NULL,0,'2026-01-22 11:13:20','2026-01-26 15:22:18',2,97,2);
INSERT INTO `trd_desve_solicitudes` VALUES (59,'Test003','prueba ',6,'','DESVE_Solicitud',NULL,NULL,1,13,NULL,0,NULL,0,0,'DESVE_Solicitud',0,NULL,NULL,NULL,NULL,0,'2026-01-22 12:01:34','2026-01-26 15:22:18',2,98,3);
INSERT INTO `trd_desve_solicitudes` VALUES (60,'PRUEBA4','dsfg',3,NULL,'azdfgb','2026-01-15 00:00:00',1,1,14,'2026-01-19 00:00:00',NULL,NULL,0,NULL,'sdfg',NULL,59,NULL,NULL,NULL,0,'2026-01-22 13:17:03','2026-01-28 09:58:53',1,99,2);
INSERT INTO `trd_desve_solicitudes` VALUES (61,'DES-0001','Expediente Ramon',4,NULL,'esta es una prueba de ingreso','2026-01-21 00:00:00',1,2,13,'2025-01-25 00:00:00',NULL,NULL,1,NULL,'por favor revisar los puntos señalados',NULL,NULL,NULL,NULL,NULL,0,'2026-01-22 15:58:42','2026-01-27 13:54:06',1,102,2);
INSERT INTO `trd_desve_solicitudes` VALUES (62,'LT-02','REFUERZO DE EXPEDIENTE',2,NULL,'TEST','2026-01-21 00:00:00',1,1,16,'2026-02-05 00:00:00',NULL,NULL,0,NULL,'TEST2',NULL,61,NULL,NULL,NULL,0,'2026-01-22 16:04:41','2026-01-27 13:35:54',1,103,2);
INSERT INTO `trd_desve_solicitudes` VALUES (66,'','prueba ',9,NULL,'ASD','2026-01-26 00:00:00',1,NULL,15,'2026-01-28 00:00:00',NULL,NULL,1,NULL,'ASD',NULL,NULL,NULL,NULL,NULL,0,'2026-01-26 15:32:02','2026-01-28 14:51:47',1,110,2);
INSERT INTO `trd_desve_solicitudes` VALUES (67,'','prueba ',1,NULL,'rtyiuyui','2026-01-27 00:00:00',1,NULL,3,'2026-01-29 00:00:00',NULL,NULL,1,NULL,'ryuityui',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 08:48:46','2026-01-27 09:42:12',1,111,0);
INSERT INTO `trd_desve_solicitudes` VALUES (68,'','asdd',3,NULL,'asd','2026-01-27 00:00:00',3,NULL,3,'2026-02-09 00:00:00',NULL,NULL,0,NULL,'asd',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 09:51:41','2026-01-27 12:09:57',1,112,1);
INSERT INTO `trd_desve_solicitudes` VALUES (69,'','asd',4,NULL,'asdasd','2026-01-27 00:00:00',3,NULL,2,'2026-02-09 00:00:00',NULL,NULL,0,NULL,'asdasd',NULL,NULL,NULL,NULL,NULL,0,'2026-01-27 12:38:19','2026-01-27 12:48:05',1,113,2);
INSERT INTO `trd_desve_solicitudes` VALUES (70,NULL,'Prueba TC-06 002',22,'','TC-06\n','2026-01-21 00:00:00',1,NULL,11,'2026-01-30 00:00:00',0,NULL,0,NULL,'TC-06',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 14:49:11','2026-01-28 14:49:11',1,114,2);
INSERT INTO `trd_desve_solicitudes` VALUES (71,'70','Prueba TC-06 003 reingreso',9,'','reingreso','2026-01-28 00:00:00',1,NULL,13,'2026-01-30 00:00:00',0,NULL,0,NULL,'reingreso',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 15:11:11','2026-01-28 15:11:11',1,115,2);
INSERT INTO `trd_desve_solicitudes` VALUES (72,'dfgdddddddddddddd','prueba TC-06 004',9,NULL,'sol_reingreso_id','2026-01-28 00:00:00',1,NULL,15,'2026-01-30 00:00:00',NULL,NULL,0,NULL,'sol_reingreso_id',NULL,71,NULL,NULL,NULL,0,'2026-01-28 15:35:23','2026-01-28 15:53:46',1,116,2);
INSERT INTO `trd_desve_solicitudes` VALUES (73,'codigo 005','Prueba TC-06 005 codigo desve',6,NULL,'        sol_ingreso_desve: document.getElementById(\'Codigo_DESVE\').value,\n','2026-01-28 00:00:00',1,NULL,15,'2026-01-30 00:00:00',NULL,NULL,0,NULL,'        sol_ingreso_desve: document.getElementById(\'Codigo_DESVE\').value,\n',NULL,72,NULL,NULL,NULL,0,'2026-01-28 15:55:03','2026-01-28 15:55:23',1,117,2);
INSERT INTO `trd_desve_solicitudes` VALUES (74,'','TC-08 001',13,'','info_tipo_org','2026-01-28 00:00:00',1,NULL,16,'2026-01-30 00:00:00',0,NULL,0,NULL,'',NULL,NULL,NULL,NULL,NULL,0,'2026-01-28 16:20:23','2026-01-28 16:20:23',1,118,2);
INSERT INTO `trd_desve_solicitudes` VALUES (75,'1','INGRESO RMV',23,'','este es un detalle de un ingreso.','2026-02-03 00:00:00',1,NULL,6,'2026-02-05 00:00:00',0,NULL,0,NULL,'observaciones adicionales',NULL,NULL,NULL,NULL,NULL,0,'2026-02-03 10:30:55','2026-02-03 10:30:55',3,122,2);
INSERT INTO `trd_desve_solicitudes` VALUES (76,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:20:58','2026-02-03 16:20:58',1,123,1);
INSERT INTO `trd_desve_solicitudes` VALUES (77,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:28:18','2026-02-03 16:28:18',1,124,1);
INSERT INTO `trd_desve_solicitudes` VALUES (78,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:34:18','2026-02-03 16:34:18',1,125,1);
INSERT INTO `trd_desve_solicitudes` VALUES (79,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:34:30','2026-02-03 16:34:30',1,126,1);
INSERT INTO `trd_desve_solicitudes` VALUES (80,'--php','prueba php',5,'Juan fg Hervas','ingreso php','2026-02-03 00:00:00',3,NULL,3,'2026-02-16 00:00:00',0,NULL,0,NULL,'1234',NULL,57,NULL,NULL,NULL,0,'2026-02-03 16:38:32','2026-02-03 16:38:32',1,127,1);
INSERT INTO `trd_desve_solicitudes` VALUES (81,'--php2','prueba php2',5,'Juan fg Hervas','2','2026-02-03 00:00:00',3,NULL,14,'2026-02-16 00:00:00',0,NULL,0,NULL,'2',NULL,80,NULL,NULL,NULL,0,'2026-02-03 16:42:23','2026-02-03 16:42:23',1,128,1);
INSERT INTO `trd_desve_solicitudes` VALUES (82,'--php2','prueba php2',5,'Juan fg Hervas','2','2026-02-03 00:00:00',3,NULL,14,'2026-02-16 00:00:00',0,NULL,0,NULL,'2',NULL,80,NULL,NULL,NULL,0,'2026-02-03 16:43:34','2026-02-03 16:43:34',1,129,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_bitacora` VALUES (1,80,'Ingresa solicitud Ingresos',2,'2026-01-22 08:50:30');
INSERT INTO `trd_general_bitacora` VALUES (3,82,'Ingresa solicitud Ingresos',2,'2026-01-22 08:55:44');
INSERT INTO `trd_general_bitacora` VALUES (4,83,'Ingresa solicitud Ingresos',2,'2026-01-22 09:00:24');
INSERT INTO `trd_general_bitacora` VALUES (5,84,'Ingresa solicitud Ingresos',2,'2026-01-22 09:01:31');
INSERT INTO `trd_general_bitacora` VALUES (6,85,'Ingresa solicitud Ingresos',2,'2026-01-22 09:02:37');
INSERT INTO `trd_general_bitacora` VALUES (7,86,'Ingresa solicitud Ingresos',2,'2026-01-22 09:03:30');
INSERT INTO `trd_general_bitacora` VALUES (8,80,'Añade comentario al trámite',2,'2026-01-22 09:05:27');
INSERT INTO `trd_general_bitacora` VALUES (9,96,'Ingresa solicitud: prueba ',2,'2026-01-22 11:12:46');
INSERT INTO `trd_general_bitacora` VALUES (10,97,'Ingresa solicitud: prueba ',2,'2026-01-22 11:13:20');
INSERT INTO `trd_general_bitacora` VALUES (11,96,'Consulta solicitud',2,'2026-01-22 11:13:38');
INSERT INTO `trd_general_bitacora` VALUES (12,97,'Consulta solicitud',2,'2026-01-22 11:14:31');
INSERT INTO `trd_general_bitacora` VALUES (13,97,'Consulta solicitud',2,'2026-01-22 11:15:07');
INSERT INTO `trd_general_bitacora` VALUES (14,97,'Consulta solicitud',2,'2026-01-22 11:15:27');
INSERT INTO `trd_general_bitacora` VALUES (15,97,'Consulta solicitud',2,'2026-01-22 11:15:34');
INSERT INTO `trd_general_bitacora` VALUES (16,97,'Consulta solicitud',2,'2026-01-22 11:16:47');
INSERT INTO `trd_general_bitacora` VALUES (17,97,'Consulta solicitud',2,'2026-01-22 11:45:27');
INSERT INTO `trd_general_bitacora` VALUES (18,97,'Consulta solicitud',2,'2026-01-22 11:45:50');
INSERT INTO `trd_general_bitacora` VALUES (19,97,'Consulta solicitud',2,'2026-01-22 11:59:51');
INSERT INTO `trd_general_bitacora` VALUES (20,97,'Consulta solicitud',2,'2026-01-22 12:00:29');
INSERT INTO `trd_general_bitacora` VALUES (21,97,'Consulta solicitud',2,'2026-01-22 12:00:51');
INSERT INTO `trd_general_bitacora` VALUES (22,97,'Consulta solicitud',2,'2026-01-22 12:00:58');
INSERT INTO `trd_general_bitacora` VALUES (23,98,'Ingresa solicitud: prueba ',2,'2026-01-22 12:01:34');
INSERT INTO `trd_general_bitacora` VALUES (24,98,'Consulta solicitud',2,'2026-01-22 12:01:43');
INSERT INTO `trd_general_bitacora` VALUES (25,98,'Consulta solicitud',2,'2026-01-22 12:01:52');
INSERT INTO `trd_general_bitacora` VALUES (26,98,'Consulta solicitud',2,'2026-01-22 12:02:22');
INSERT INTO `trd_general_bitacora` VALUES (27,96,'Consulta solicitud',1,'2026-01-22 12:10:43');
INSERT INTO `trd_general_bitacora` VALUES (28,96,'Responde solicitud',1,'2026-01-22 12:11:11');
INSERT INTO `trd_general_bitacora` VALUES (29,96,'Consulta solicitud',1,'2026-01-22 12:11:54');
INSERT INTO `trd_general_bitacora` VALUES (30,96,'Consulta solicitud',1,'2026-01-22 12:12:10');
INSERT INTO `trd_general_bitacora` VALUES (31,96,'Consulta solicitud',1,'2026-01-22 12:13:42');
INSERT INTO `trd_general_bitacora` VALUES (32,96,'Consulta solicitud',1,'2026-01-22 12:14:01');
INSERT INTO `trd_general_bitacora` VALUES (33,96,'Consulta solicitud',1,'2026-01-22 12:14:08');
INSERT INTO `trd_general_bitacora` VALUES (34,96,'Consulta solicitud',1,'2026-01-22 12:14:28');
INSERT INTO `trd_general_bitacora` VALUES (35,96,'Consulta solicitud',1,'2026-01-22 12:15:37');
INSERT INTO `trd_general_bitacora` VALUES (36,96,'Consulta solicitud',1,'2026-01-22 12:17:20');
INSERT INTO `trd_general_bitacora` VALUES (37,96,'Responde solicitud',1,'2026-01-22 12:17:30');
INSERT INTO `trd_general_bitacora` VALUES (38,97,'Consulta solicitud',1,'2026-01-22 12:17:39');
INSERT INTO `trd_general_bitacora` VALUES (39,96,'Consulta solicitud',1,'2026-01-22 12:17:50');
INSERT INTO `trd_general_bitacora` VALUES (40,96,'Consulta solicitud',1,'2026-01-22 12:27:47');
INSERT INTO `trd_general_bitacora` VALUES (41,96,'Consulta solicitud',1,'2026-01-22 12:28:26');
INSERT INTO `trd_general_bitacora` VALUES (42,96,'Consulta solicitud',1,'2026-01-22 12:40:23');
INSERT INTO `trd_general_bitacora` VALUES (43,97,'Consulta solicitud',1,'2026-01-22 12:40:46');
INSERT INTO `trd_general_bitacora` VALUES (44,96,'Consulta solicitud',1,'2026-01-22 12:41:56');
INSERT INTO `trd_general_bitacora` VALUES (45,96,'Responde solicitud',1,'2026-01-22 12:42:12');
INSERT INTO `trd_general_bitacora` VALUES (46,96,'Consulta solicitud',1,'2026-01-22 12:42:24');
INSERT INTO `trd_general_bitacora` VALUES (47,97,'Consulta solicitud',1,'2026-01-22 12:42:45');
INSERT INTO `trd_general_bitacora` VALUES (48,98,'Consulta solicitud',1,'2026-01-22 12:50:08');
INSERT INTO `trd_general_bitacora` VALUES (49,98,'Consulta solicitud',1,'2026-01-22 12:52:08');
INSERT INTO `trd_general_bitacora` VALUES (50,96,'Consulta solicitud',1,'2026-01-22 12:52:29');
INSERT INTO `trd_general_bitacora` VALUES (51,96,'Consulta solicitud',1,'2026-01-22 12:55:28');
INSERT INTO `trd_general_bitacora` VALUES (52,96,'Consulta solicitud',1,'2026-01-22 12:55:40');
INSERT INTO `trd_general_bitacora` VALUES (53,96,'Consulta solicitud',1,'2026-01-22 12:59:53');
INSERT INTO `trd_general_bitacora` VALUES (54,99,'Ingresa solicitud: dsfg',1,'2026-01-22 13:17:03');
INSERT INTO `trd_general_bitacora` VALUES (55,99,'Consulta solicitud',1,'2026-01-22 13:17:11');
INSERT INTO `trd_general_bitacora` VALUES (56,98,'Consulta solicitud',1,'2026-01-22 13:17:17');
INSERT INTO `trd_general_bitacora` VALUES (57,99,'Consulta solicitud',1,'2026-01-22 13:17:21');
INSERT INTO `trd_general_bitacora` VALUES (58,99,'Consulta solicitud',1,'2026-01-22 13:19:16');
INSERT INTO `trd_general_bitacora` VALUES (59,99,'Consulta solicitud',1,'2026-01-22 13:19:43');
INSERT INTO `trd_general_bitacora` VALUES (60,99,'Consulta solicitud',1,'2026-01-22 13:19:57');
INSERT INTO `trd_general_bitacora` VALUES (61,99,'Cambio de estado a RESPONDIDO (Entregado: Sí)',1,'2026-01-22 13:19:57');
INSERT INTO `trd_general_bitacora` VALUES (62,99,'Consulta solicitud',1,'2026-01-22 13:19:57');
INSERT INTO `trd_general_bitacora` VALUES (63,99,'Consulta solicitud',1,'2026-01-22 13:20:16');
INSERT INTO `trd_general_bitacora` VALUES (64,99,'Consulta solicitud',1,'2026-01-22 13:20:19');
INSERT INTO `trd_general_bitacora` VALUES (65,99,'Cambio de estado a PENDIENTE (Entregado: No)',1,'2026-01-22 13:20:19');
INSERT INTO `trd_general_bitacora` VALUES (66,99,'Consulta solicitud',1,'2026-01-22 13:20:19');
INSERT INTO `trd_general_bitacora` VALUES (67,99,'Consulta solicitud',1,'2026-01-22 13:20:25');
INSERT INTO `trd_general_bitacora` VALUES (68,99,'Consulta solicitud',1,'2026-01-22 13:21:08');
INSERT INTO `trd_general_bitacora` VALUES (69,99,'Responde solicitud',1,'2026-01-22 13:21:29');
INSERT INTO `trd_general_bitacora` VALUES (70,99,'Consulta solicitud',1,'2026-01-22 13:21:39');
INSERT INTO `trd_general_bitacora` VALUES (71,99,'Consulta solicitud',1,'2026-01-22 13:21:47');
INSERT INTO `trd_general_bitacora` VALUES (72,99,'Cambio de estado a RESPONDIDO (Entregado: Sí)',1,'2026-01-22 13:21:47');
INSERT INTO `trd_general_bitacora` VALUES (73,99,'Consulta solicitud',1,'2026-01-22 13:21:48');
INSERT INTO `trd_general_bitacora` VALUES (74,99,'Consulta solicitud',1,'2026-01-22 13:26:39');
INSERT INTO `trd_general_bitacora` VALUES (75,99,'Consulta solicitud',1,'2026-01-22 13:28:58');
INSERT INTO `trd_general_bitacora` VALUES (76,99,'Consulta solicitud',1,'2026-01-22 13:29:57');
INSERT INTO `trd_general_bitacora` VALUES (77,99,'Consulta solicitud',1,'2026-01-22 13:30:36');
INSERT INTO `trd_general_bitacora` VALUES (78,99,'Consulta solicitud',1,'2026-01-22 13:31:37');
INSERT INTO `trd_general_bitacora` VALUES (79,99,'Consulta solicitud',1,'2026-01-22 13:34:53');
INSERT INTO `trd_general_bitacora` VALUES (80,99,'Consulta solicitud',1,'2026-01-22 13:35:17');
INSERT INTO `trd_general_bitacora` VALUES (81,99,'Consulta solicitud',1,'2026-01-22 13:37:22');
INSERT INTO `trd_general_bitacora` VALUES (82,99,'Consulta solicitud',1,'2026-01-22 13:39:33');
INSERT INTO `trd_general_bitacora` VALUES (83,99,'Consulta solicitud',1,'2026-01-22 13:41:48');
INSERT INTO `trd_general_bitacora` VALUES (84,99,'Consulta solicitud',1,'2026-01-22 13:41:53');
INSERT INTO `trd_general_bitacora` VALUES (85,99,'Consulta solicitud',1,'2026-01-22 13:42:21');
INSERT INTO `trd_general_bitacora` VALUES (86,99,'Consulta solicitud',1,'2026-01-22 13:42:37');
INSERT INTO `trd_general_bitacora` VALUES (87,100,'Ingresa solicitud Ingresos',1,'2026-01-22 15:46:58');
INSERT INTO `trd_general_bitacora` VALUES (88,100,'Añade comentario al trámite',1,'2026-01-22 15:47:17');
INSERT INTO `trd_general_bitacora` VALUES (89,101,'Ingresa solicitud Ingresos',1,'2026-01-22 15:54:55');
INSERT INTO `trd_general_bitacora` VALUES (90,102,'Ingresa solicitud: Expediente Ramon',1,'2026-01-22 15:58:42');
INSERT INTO `trd_general_bitacora` VALUES (91,103,'Ingresa solicitud: REFUERZO DE EXPEDIENTE',1,'2026-01-22 16:04:41');
INSERT INTO `trd_general_bitacora` VALUES (92,103,'Consulta solicitud',1,'2026-01-22 16:24:04');
INSERT INTO `trd_general_bitacora` VALUES (93,103,'Consulta solicitud',1,'2026-01-22 16:26:26');
INSERT INTO `trd_general_bitacora` VALUES (94,96,'Consulta solicitud',1,'2026-01-22 16:26:51');
INSERT INTO `trd_general_bitacora` VALUES (95,103,'Consulta solicitud',1,'2026-01-22 16:27:21');
INSERT INTO `trd_general_bitacora` VALUES (96,96,'Consulta solicitud',1,'2026-01-22 16:35:33');
INSERT INTO `trd_general_bitacora` VALUES (97,104,'Ingresa solicitud Ingresos',1,'2026-01-22 16:55:41');
INSERT INTO `trd_general_bitacora` VALUES (98,102,'Consulta solicitud',2,'2026-01-23 16:10:51');
INSERT INTO `trd_general_bitacora` VALUES (99,103,'Consulta solicitud',1,'2026-01-26 08:20:41');
INSERT INTO `trd_general_bitacora` VALUES (100,103,'Consulta solicitud',1,'2026-01-26 13:02:00');
INSERT INTO `trd_general_bitacora` VALUES (101,110,'Ingresa solicitud: prueba ',1,'2026-01-26 15:32:02');
INSERT INTO `trd_general_bitacora` VALUES (102,110,'Consulta solicitud',1,'2026-01-26 15:32:18');
INSERT INTO `trd_general_bitacora` VALUES (103,110,'Consulta solicitud',1,'2026-01-26 15:36:03');
INSERT INTO `trd_general_bitacora` VALUES (104,110,'Consulta solicitud',1,'2026-01-26 15:36:30');
INSERT INTO `trd_general_bitacora` VALUES (105,110,'Consulta solicitud',1,'2026-01-26 15:40:21');
INSERT INTO `trd_general_bitacora` VALUES (106,110,'Consulta solicitud',1,'2026-01-26 15:59:49');
INSERT INTO `trd_general_bitacora` VALUES (107,110,'Consulta solicitud',1,'2026-01-26 16:00:08');
INSERT INTO `trd_general_bitacora` VALUES (108,110,'Consulta solicitud',1,'2026-01-26 16:02:08');
INSERT INTO `trd_general_bitacora` VALUES (109,110,'Consulta solicitud',1,'2026-01-26 16:02:16');
INSERT INTO `trd_general_bitacora` VALUES (110,110,'Consulta solicitud',1,'2026-01-26 16:02:26');
INSERT INTO `trd_general_bitacora` VALUES (111,110,'Consulta solicitud',1,'2026-01-26 16:03:33');
INSERT INTO `trd_general_bitacora` VALUES (112,110,'Consulta solicitud',1,'2026-01-26 16:03:43');
INSERT INTO `trd_general_bitacora` VALUES (113,110,'Consulta solicitud',1,'2026-01-26 16:05:19');
INSERT INTO `trd_general_bitacora` VALUES (114,110,'Consulta solicitud',1,'2026-01-26 16:05:28');
INSERT INTO `trd_general_bitacora` VALUES (115,110,'Consulta solicitud',1,'2026-01-26 16:05:57');
INSERT INTO `trd_general_bitacora` VALUES (116,110,'Consulta solicitud',1,'2026-01-26 16:06:02');
INSERT INTO `trd_general_bitacora` VALUES (117,110,'Consulta solicitud',1,'2026-01-26 16:06:52');
INSERT INTO `trd_general_bitacora` VALUES (118,110,'Consulta solicitud',1,'2026-01-26 16:06:58');
INSERT INTO `trd_general_bitacora` VALUES (119,110,'Consulta solicitud',1,'2026-01-26 16:16:29');
INSERT INTO `trd_general_bitacora` VALUES (120,110,'Consulta solicitud',1,'2026-01-26 16:17:17');
INSERT INTO `trd_general_bitacora` VALUES (121,110,'Consulta solicitud',1,'2026-01-26 16:18:38');
INSERT INTO `trd_general_bitacora` VALUES (122,110,'Consulta solicitud',1,'2026-01-27 08:47:01');
INSERT INTO `trd_general_bitacora` VALUES (123,110,'Consulta solicitud',1,'2026-01-27 08:47:04');
INSERT INTO `trd_general_bitacora` VALUES (124,110,'Consulta solicitud',1,'2026-01-27 08:47:21');
INSERT INTO `trd_general_bitacora` VALUES (125,103,'Consulta solicitud',1,'2026-01-27 08:47:26');
INSERT INTO `trd_general_bitacora` VALUES (126,103,'Consulta solicitud',1,'2026-01-27 08:47:41');
INSERT INTO `trd_general_bitacora` VALUES (127,103,'Consulta solicitud',1,'2026-01-27 08:48:00');
INSERT INTO `trd_general_bitacora` VALUES (128,102,'Consulta solicitud',1,'2026-01-27 08:48:08');
INSERT INTO `trd_general_bitacora` VALUES (129,111,'Ingresa solicitud: prueba ',1,'2026-01-27 08:48:46');
INSERT INTO `trd_general_bitacora` VALUES (130,111,'Consulta solicitud',1,'2026-01-27 08:48:53');
INSERT INTO `trd_general_bitacora` VALUES (131,110,'Consulta solicitud',1,'2026-01-27 08:50:11');
INSERT INTO `trd_general_bitacora` VALUES (132,110,'Consulta solicitud',1,'2026-01-27 08:50:30');
INSERT INTO `trd_general_bitacora` VALUES (133,110,'Consulta solicitud',1,'2026-01-27 08:50:44');
INSERT INTO `trd_general_bitacora` VALUES (134,110,'Consulta solicitud',1,'2026-01-27 08:52:20');
INSERT INTO `trd_general_bitacora` VALUES (135,110,'Consulta solicitud',1,'2026-01-27 08:52:40');
INSERT INTO `trd_general_bitacora` VALUES (136,110,'Consulta solicitud',1,'2026-01-27 08:53:00');
INSERT INTO `trd_general_bitacora` VALUES (137,110,'Consulta solicitud',1,'2026-01-27 08:53:28');
INSERT INTO `trd_general_bitacora` VALUES (138,110,'Consulta solicitud',1,'2026-01-27 08:53:51');
INSERT INTO `trd_general_bitacora` VALUES (139,110,'Consulta solicitud',1,'2026-01-27 08:54:17');
INSERT INTO `trd_general_bitacora` VALUES (140,110,'Consulta solicitud',1,'2026-01-27 08:55:31');
INSERT INTO `trd_general_bitacora` VALUES (141,110,'Consulta solicitud',1,'2026-01-27 08:58:39');
INSERT INTO `trd_general_bitacora` VALUES (142,110,'Consulta solicitud',1,'2026-01-27 08:58:53');
INSERT INTO `trd_general_bitacora` VALUES (143,110,'Consulta solicitud',1,'2026-01-27 09:00:16');
INSERT INTO `trd_general_bitacora` VALUES (144,110,'Consulta solicitud',1,'2026-01-27 09:00:30');
INSERT INTO `trd_general_bitacora` VALUES (145,110,'Consulta solicitud',1,'2026-01-27 09:02:37');
INSERT INTO `trd_general_bitacora` VALUES (146,110,'Consulta solicitud',1,'2026-01-27 09:04:40');
INSERT INTO `trd_general_bitacora` VALUES (147,110,'Consulta solicitud',1,'2026-01-27 09:05:25');
INSERT INTO `trd_general_bitacora` VALUES (148,110,'Consulta solicitud',1,'2026-01-27 09:06:01');
INSERT INTO `trd_general_bitacora` VALUES (149,110,'Consulta solicitud',1,'2026-01-27 09:07:41');
INSERT INTO `trd_general_bitacora` VALUES (150,110,'Consulta solicitud',1,'2026-01-27 09:08:25');
INSERT INTO `trd_general_bitacora` VALUES (151,110,'Consulta solicitud',1,'2026-01-27 09:08:45');
INSERT INTO `trd_general_bitacora` VALUES (152,110,'Consulta solicitud',1,'2026-01-27 09:09:42');
INSERT INTO `trd_general_bitacora` VALUES (153,110,'Consulta solicitud',1,'2026-01-27 09:11:04');
INSERT INTO `trd_general_bitacora` VALUES (154,110,'Consulta solicitud',1,'2026-01-27 09:13:17');
INSERT INTO `trd_general_bitacora` VALUES (155,110,'Consulta solicitud',1,'2026-01-27 09:14:11');
INSERT INTO `trd_general_bitacora` VALUES (156,111,'Consulta solicitud',1,'2026-01-27 09:17:48');
INSERT INTO `trd_general_bitacora` VALUES (157,111,'Consulta solicitud',1,'2026-01-27 09:17:55');
INSERT INTO `trd_general_bitacora` VALUES (158,111,'Consulta solicitud',1,'2026-01-27 09:18:38');
INSERT INTO `trd_general_bitacora` VALUES (159,111,'Consulta solicitud',1,'2026-01-27 09:18:42');
INSERT INTO `trd_general_bitacora` VALUES (160,111,'Consulta solicitud',1,'2026-01-27 09:19:05');
INSERT INTO `trd_general_bitacora` VALUES (161,111,'Consulta solicitud',1,'2026-01-27 09:19:14');
INSERT INTO `trd_general_bitacora` VALUES (162,111,'Consulta solicitud',1,'2026-01-27 09:19:47');
INSERT INTO `trd_general_bitacora` VALUES (163,111,'Consulta solicitud',1,'2026-01-27 09:22:32');
INSERT INTO `trd_general_bitacora` VALUES (164,111,'Consulta solicitud',1,'2026-01-27 09:24:10');
INSERT INTO `trd_general_bitacora` VALUES (165,111,'Consulta solicitud',1,'2026-01-27 09:42:12');
INSERT INTO `trd_general_bitacora` VALUES (166,111,'Consulta solicitud',1,'2026-01-27 09:47:11');
INSERT INTO `trd_general_bitacora` VALUES (167,111,'Consulta solicitud',1,'2026-01-27 09:47:18');
INSERT INTO `trd_general_bitacora` VALUES (168,111,'Consulta solicitud',1,'2026-01-27 09:47:22');
INSERT INTO `trd_general_bitacora` VALUES (169,111,'Consulta solicitud',1,'2026-01-27 09:47:37');
INSERT INTO `trd_general_bitacora` VALUES (170,111,'Consulta solicitud',1,'2026-01-27 09:47:54');
INSERT INTO `trd_general_bitacora` VALUES (171,111,'Consulta solicitud',1,'2026-01-27 09:50:20');
INSERT INTO `trd_general_bitacora` VALUES (172,111,'Consulta solicitud',1,'2026-01-27 09:50:25');
INSERT INTO `trd_general_bitacora` VALUES (173,111,'Consulta solicitud',1,'2026-01-27 09:50:32');
INSERT INTO `trd_general_bitacora` VALUES (174,111,'Consulta solicitud',1,'2026-01-27 09:50:35');
INSERT INTO `trd_general_bitacora` VALUES (175,112,'Ingresa solicitud: asdd',1,'2026-01-27 09:51:41');
INSERT INTO `trd_general_bitacora` VALUES (176,112,'Consulta solicitud',1,'2026-01-27 09:51:47');
INSERT INTO `trd_general_bitacora` VALUES (177,112,'Consulta solicitud',1,'2026-01-27 09:52:03');
INSERT INTO `trd_general_bitacora` VALUES (178,112,'Consulta solicitud',1,'2026-01-27 09:53:05');
INSERT INTO `trd_general_bitacora` VALUES (179,112,'Consulta solicitud',1,'2026-01-27 11:42:11');
INSERT INTO `trd_general_bitacora` VALUES (180,112,'Consulta solicitud',1,'2026-01-27 11:43:16');
INSERT INTO `trd_general_bitacora` VALUES (181,112,'Consulta solicitud',1,'2026-01-27 11:46:23');
INSERT INTO `trd_general_bitacora` VALUES (182,112,'Consulta solicitud',1,'2026-01-27 11:47:15');
INSERT INTO `trd_general_bitacora` VALUES (183,112,'Consulta solicitud',1,'2026-01-27 11:47:18');
INSERT INTO `trd_general_bitacora` VALUES (184,112,'Consulta solicitud',1,'2026-01-27 11:47:23');
INSERT INTO `trd_general_bitacora` VALUES (185,112,'Consulta solicitud',1,'2026-01-27 11:52:56');
INSERT INTO `trd_general_bitacora` VALUES (186,112,'Consulta solicitud',1,'2026-01-27 11:53:57');
INSERT INTO `trd_general_bitacora` VALUES (187,112,'Consulta solicitud',1,'2026-01-27 11:55:13');
INSERT INTO `trd_general_bitacora` VALUES (188,112,'Consulta solicitud',1,'2026-01-27 11:56:30');
INSERT INTO `trd_general_bitacora` VALUES (189,112,'Consulta solicitud',1,'2026-01-27 11:56:47');
INSERT INTO `trd_general_bitacora` VALUES (190,112,'Consulta solicitud',1,'2026-01-27 11:56:59');
INSERT INTO `trd_general_bitacora` VALUES (191,112,'Consulta solicitud',1,'2026-01-27 12:06:18');
INSERT INTO `trd_general_bitacora` VALUES (192,112,'Consulta solicitud',1,'2026-01-27 12:06:37');
INSERT INTO `trd_general_bitacora` VALUES (193,112,'Consulta solicitud',1,'2026-01-27 12:09:49');
INSERT INTO `trd_general_bitacora` VALUES (194,112,'Consulta solicitud',1,'2026-01-27 12:09:57');
INSERT INTO `trd_general_bitacora` VALUES (195,112,'Edita: prioridad de \"1\" a \"3\"',1,'2026-01-27 12:09:57');
INSERT INTO `trd_general_bitacora` VALUES (196,112,'Consulta solicitud',1,'2026-01-27 12:10:00');
INSERT INTO `trd_general_bitacora` VALUES (197,112,'Consulta solicitud',1,'2026-01-27 12:10:37');
INSERT INTO `trd_general_bitacora` VALUES (198,111,'Consulta solicitud',1,'2026-01-27 12:10:49');
INSERT INTO `trd_general_bitacora` VALUES (199,102,'Consulta solicitud',1,'2026-01-27 12:10:59');
INSERT INTO `trd_general_bitacora` VALUES (200,102,'Consulta solicitud',1,'2026-01-27 12:14:00');
INSERT INTO `trd_general_bitacora` VALUES (201,102,'Consulta solicitud',1,'2026-01-27 12:20:31');
INSERT INTO `trd_general_bitacora` VALUES (202,102,'Consulta solicitud',1,'2026-01-27 12:23:27');
INSERT INTO `trd_general_bitacora` VALUES (203,102,'Consulta solicitud',1,'2026-01-27 12:23:49');
INSERT INTO `trd_general_bitacora` VALUES (204,102,'Consulta solicitud',1,'2026-01-27 12:23:57');
INSERT INTO `trd_general_bitacora` VALUES (205,102,'Consulta solicitud',1,'2026-01-27 12:26:11');
INSERT INTO `trd_general_bitacora` VALUES (206,102,'Consulta solicitud',1,'2026-01-27 12:26:15');
INSERT INTO `trd_general_bitacora` VALUES (207,102,'Consulta solicitud',1,'2026-01-27 12:28:11');
INSERT INTO `trd_general_bitacora` VALUES (208,102,'Consulta solicitud',1,'2026-01-27 12:29:06');
INSERT INTO `trd_general_bitacora` VALUES (209,102,'Consulta solicitud',1,'2026-01-27 12:29:21');
INSERT INTO `trd_general_bitacora` VALUES (210,102,'Consulta solicitud',1,'2026-01-27 12:31:31');
INSERT INTO `trd_general_bitacora` VALUES (211,102,'Consulta solicitud',1,'2026-01-27 12:36:07');
INSERT INTO `trd_general_bitacora` VALUES (212,102,'Consulta solicitud',1,'2026-01-27 12:37:43');
INSERT INTO `trd_general_bitacora` VALUES (213,113,'Ingresa solicitud: asd',1,'2026-01-27 12:38:19');
INSERT INTO `trd_general_bitacora` VALUES (214,113,'Consulta solicitud',1,'2026-01-27 12:38:25');
INSERT INTO `trd_general_bitacora` VALUES (215,113,'Consulta solicitud',1,'2026-01-27 12:38:31');
INSERT INTO `trd_general_bitacora` VALUES (216,113,'Consulta solicitud',1,'2026-01-27 12:48:05');
INSERT INTO `trd_general_bitacora` VALUES (217,113,'Consulta solicitud',1,'2026-01-27 12:48:08');
INSERT INTO `trd_general_bitacora` VALUES (218,113,'Consulta solicitud',1,'2026-01-27 12:48:13');
INSERT INTO `trd_general_bitacora` VALUES (219,113,'Consulta solicitud',1,'2026-01-27 12:50:36');
INSERT INTO `trd_general_bitacora` VALUES (220,113,'Consulta solicitud',1,'2026-01-27 12:51:20');
INSERT INTO `trd_general_bitacora` VALUES (221,113,'Consulta solicitud',1,'2026-01-27 12:51:38');
INSERT INTO `trd_general_bitacora` VALUES (222,113,'Consulta solicitud',1,'2026-01-27 12:54:19');
INSERT INTO `trd_general_bitacora` VALUES (223,113,'Consulta solicitud',1,'2026-01-27 12:56:43');
INSERT INTO `trd_general_bitacora` VALUES (224,113,'Consulta solicitud',1,'2026-01-27 12:56:47');
INSERT INTO `trd_general_bitacora` VALUES (225,113,'Consulta solicitud',1,'2026-01-27 12:56:51');
INSERT INTO `trd_general_bitacora` VALUES (226,113,'Consulta solicitud',1,'2026-01-27 12:56:55');
INSERT INTO `trd_general_bitacora` VALUES (227,113,'Consulta solicitud',1,'2026-01-27 12:57:05');
INSERT INTO `trd_general_bitacora` VALUES (228,113,'Consulta solicitud',1,'2026-01-27 12:57:10');
INSERT INTO `trd_general_bitacora` VALUES (229,113,'Consulta solicitud',1,'2026-01-27 12:59:04');
INSERT INTO `trd_general_bitacora` VALUES (230,113,'Consulta solicitud',1,'2026-01-27 13:06:05');
INSERT INTO `trd_general_bitacora` VALUES (231,113,'Consulta solicitud',1,'2026-01-27 13:06:08');
INSERT INTO `trd_general_bitacora` VALUES (232,113,'Consulta solicitud',1,'2026-01-27 13:06:12');
INSERT INTO `trd_general_bitacora` VALUES (233,113,'Consulta solicitud',1,'2026-01-27 13:06:20');
INSERT INTO `trd_general_bitacora` VALUES (234,113,'Consulta solicitud',1,'2026-01-27 13:06:23');
INSERT INTO `trd_general_bitacora` VALUES (235,113,'Consulta solicitud',1,'2026-01-27 13:06:27');
INSERT INTO `trd_general_bitacora` VALUES (236,113,'Consulta solicitud',1,'2026-01-27 13:13:10');
INSERT INTO `trd_general_bitacora` VALUES (237,113,'Consulta solicitud',1,'2026-01-27 13:13:20');
INSERT INTO `trd_general_bitacora` VALUES (238,113,'Consulta solicitud',1,'2026-01-27 13:13:30');
INSERT INTO `trd_general_bitacora` VALUES (239,113,'Consulta solicitud',1,'2026-01-27 13:13:35');
INSERT INTO `trd_general_bitacora` VALUES (240,113,'Consulta solicitud',1,'2026-01-27 13:15:01');
INSERT INTO `trd_general_bitacora` VALUES (241,113,'Consulta solicitud',1,'2026-01-27 13:15:13');
INSERT INTO `trd_general_bitacora` VALUES (242,113,'Consulta solicitud',1,'2026-01-27 13:15:51');
INSERT INTO `trd_general_bitacora` VALUES (243,113,'Consulta solicitud',1,'2026-01-27 13:17:32');
INSERT INTO `trd_general_bitacora` VALUES (244,113,'Consulta solicitud',1,'2026-01-27 13:21:28');
INSERT INTO `trd_general_bitacora` VALUES (245,113,'Consulta solicitud',1,'2026-01-27 13:26:44');
INSERT INTO `trd_general_bitacora` VALUES (246,113,'Consulta solicitud',1,'2026-01-27 13:26:56');
INSERT INTO `trd_general_bitacora` VALUES (247,113,'Consulta solicitud',1,'2026-01-27 13:27:21');
INSERT INTO `trd_general_bitacora` VALUES (248,113,'Consulta solicitud',1,'2026-01-27 13:27:55');
INSERT INTO `trd_general_bitacora` VALUES (249,113,'Consulta solicitud',1,'2026-01-27 13:28:26');
INSERT INTO `trd_general_bitacora` VALUES (250,113,'Consulta solicitud',1,'2026-01-27 13:29:05');
INSERT INTO `trd_general_bitacora` VALUES (251,113,'Consulta solicitud',1,'2026-01-27 13:32:40');
INSERT INTO `trd_general_bitacora` VALUES (252,112,'Consulta solicitud',1,'2026-01-27 13:33:00');
INSERT INTO `trd_general_bitacora` VALUES (253,103,'Consulta solicitud',1,'2026-01-27 13:33:23');
INSERT INTO `trd_general_bitacora` VALUES (254,103,'Consulta solicitud',1,'2026-01-27 13:35:53');
INSERT INTO `trd_general_bitacora` VALUES (255,103,'Consulta solicitud',1,'2026-01-27 13:36:26');
INSERT INTO `trd_general_bitacora` VALUES (256,103,'Consulta solicitud',1,'2026-01-27 13:36:34');
INSERT INTO `trd_general_bitacora` VALUES (257,103,'Consulta solicitud',1,'2026-01-27 13:37:12');
INSERT INTO `trd_general_bitacora` VALUES (258,103,'Consulta solicitud',1,'2026-01-27 13:37:16');
INSERT INTO `trd_general_bitacora` VALUES (259,103,'Consulta solicitud',1,'2026-01-27 13:37:18');
INSERT INTO `trd_general_bitacora` VALUES (260,103,'Consulta solicitud',1,'2026-01-27 13:37:27');
INSERT INTO `trd_general_bitacora` VALUES (261,103,'Consulta solicitud',1,'2026-01-27 13:37:35');
INSERT INTO `trd_general_bitacora` VALUES (262,103,'Consulta solicitud',1,'2026-01-27 13:39:24');
INSERT INTO `trd_general_bitacora` VALUES (263,103,'Consulta solicitud',1,'2026-01-27 13:39:27');
INSERT INTO `trd_general_bitacora` VALUES (264,103,'Consulta solicitud',1,'2026-01-27 13:39:31');
INSERT INTO `trd_general_bitacora` VALUES (265,103,'Consulta solicitud',1,'2026-01-27 13:39:35');
INSERT INTO `trd_general_bitacora` VALUES (266,103,'Consulta solicitud',1,'2026-01-27 13:39:38');
INSERT INTO `trd_general_bitacora` VALUES (267,103,'Consulta solicitud',1,'2026-01-27 13:39:43');
INSERT INTO `trd_general_bitacora` VALUES (268,103,'Consulta solicitud',1,'2026-01-27 13:42:15');
INSERT INTO `trd_general_bitacora` VALUES (269,103,'Consulta solicitud',1,'2026-01-27 13:42:20');
INSERT INTO `trd_general_bitacora` VALUES (270,103,'Consulta solicitud',1,'2026-01-27 13:42:24');
INSERT INTO `trd_general_bitacora` VALUES (271,103,'Consulta solicitud',1,'2026-01-27 13:42:29');
INSERT INTO `trd_general_bitacora` VALUES (272,103,'Consulta solicitud',1,'2026-01-27 13:42:33');
INSERT INTO `trd_general_bitacora` VALUES (273,103,'Consulta solicitud',1,'2026-01-27 13:42:35');
INSERT INTO `trd_general_bitacora` VALUES (274,103,'Consulta solicitud',1,'2026-01-27 13:46:56');
INSERT INTO `trd_general_bitacora` VALUES (275,103,'Consulta solicitud',1,'2026-01-27 13:47:46');
INSERT INTO `trd_general_bitacora` VALUES (276,103,'Consulta solicitud',1,'2026-01-27 13:47:51');
INSERT INTO `trd_general_bitacora` VALUES (277,103,'Consulta solicitud',1,'2026-01-27 13:48:12');
INSERT INTO `trd_general_bitacora` VALUES (278,103,'Consulta solicitud',1,'2026-01-27 13:48:18');
INSERT INTO `trd_general_bitacora` VALUES (279,103,'Consulta solicitud',1,'2026-01-27 13:48:35');
INSERT INTO `trd_general_bitacora` VALUES (280,103,'Consulta solicitud',1,'2026-01-27 13:50:18');
INSERT INTO `trd_general_bitacora` VALUES (281,103,'Consulta solicitud',1,'2026-01-27 13:50:22');
INSERT INTO `trd_general_bitacora` VALUES (282,103,'Consulta solicitud',1,'2026-01-27 13:50:31');
INSERT INTO `trd_general_bitacora` VALUES (283,103,'Consulta solicitud',1,'2026-01-27 13:50:35');
INSERT INTO `trd_general_bitacora` VALUES (284,103,'Consulta solicitud',1,'2026-01-27 13:50:38');
INSERT INTO `trd_general_bitacora` VALUES (285,103,'Consulta solicitud',1,'2026-01-27 13:52:10');
INSERT INTO `trd_general_bitacora` VALUES (286,103,'Consulta solicitud',1,'2026-01-27 13:52:12');
INSERT INTO `trd_general_bitacora` VALUES (287,103,'Añade comentario al trámite',1,'2026-01-27 13:52:19');
INSERT INTO `trd_general_bitacora` VALUES (288,103,'Consulta solicitud',1,'2026-01-27 13:52:20');
INSERT INTO `trd_general_bitacora` VALUES (289,103,'Añade comentario al trámite',1,'2026-01-27 13:52:26');
INSERT INTO `trd_general_bitacora` VALUES (290,103,'Añade comentario al trámite',1,'2026-01-27 13:52:26');
INSERT INTO `trd_general_bitacora` VALUES (291,103,'Consulta solicitud',1,'2026-01-27 13:52:26');
INSERT INTO `trd_general_bitacora` VALUES (292,103,'Consulta solicitud',1,'2026-01-27 13:52:26');
INSERT INTO `trd_general_bitacora` VALUES (293,103,'Consulta solicitud',1,'2026-01-27 13:52:32');
INSERT INTO `trd_general_bitacora` VALUES (294,103,'Añade comentario al trámite',1,'2026-01-27 13:52:37');
INSERT INTO `trd_general_bitacora` VALUES (295,103,'Consulta solicitud',1,'2026-01-27 13:52:37');
INSERT INTO `trd_general_bitacora` VALUES (296,103,'Añade comentario al trámite',1,'2026-01-27 13:52:43');
INSERT INTO `trd_general_bitacora` VALUES (297,103,'Consulta solicitud',1,'2026-01-27 13:52:44');
INSERT INTO `trd_general_bitacora` VALUES (298,103,'Añade comentario al trámite',1,'2026-01-27 13:52:53');
INSERT INTO `trd_general_bitacora` VALUES (299,103,'Consulta solicitud',1,'2026-01-27 13:52:53');
INSERT INTO `trd_general_bitacora` VALUES (300,103,'Consulta solicitud',1,'2026-01-27 13:53:32');
INSERT INTO `trd_general_bitacora` VALUES (301,102,'Consulta solicitud',1,'2026-01-27 13:53:37');
INSERT INTO `trd_general_bitacora` VALUES (302,102,'Añade comentario al trámite',1,'2026-01-27 13:53:41');
INSERT INTO `trd_general_bitacora` VALUES (303,102,'Consulta solicitud',1,'2026-01-27 13:53:42');
INSERT INTO `trd_general_bitacora` VALUES (304,102,'Añade comentario al trámite',1,'2026-01-27 13:53:44');
INSERT INTO `trd_general_bitacora` VALUES (305,102,'Consulta solicitud',1,'2026-01-27 13:53:45');
INSERT INTO `trd_general_bitacora` VALUES (306,102,'Añade comentario al trámite',1,'2026-01-27 13:53:47');
INSERT INTO `trd_general_bitacora` VALUES (307,102,'Consulta solicitud',1,'2026-01-27 13:53:48');
INSERT INTO `trd_general_bitacora` VALUES (308,102,'Añade comentario al trámite',1,'2026-01-27 13:53:50');
INSERT INTO `trd_general_bitacora` VALUES (309,102,'Consulta solicitud',1,'2026-01-27 13:53:51');
INSERT INTO `trd_general_bitacora` VALUES (310,102,'Añade comentario al trámite',1,'2026-01-27 13:53:53');
INSERT INTO `trd_general_bitacora` VALUES (311,102,'Añade comentario al trámite',1,'2026-01-27 13:53:53');
INSERT INTO `trd_general_bitacora` VALUES (312,102,'Consulta solicitud',1,'2026-01-27 13:53:53');
INSERT INTO `trd_general_bitacora` VALUES (313,102,'Consulta solicitud',1,'2026-01-27 13:53:53');
INSERT INTO `trd_general_bitacora` VALUES (314,102,'Consulta solicitud',1,'2026-01-27 13:53:58');
INSERT INTO `trd_general_bitacora` VALUES (315,102,'Consulta solicitud',1,'2026-01-27 13:54:06');
INSERT INTO `trd_general_bitacora` VALUES (316,102,'Consulta solicitud',1,'2026-01-27 13:54:08');
INSERT INTO `trd_general_bitacora` VALUES (317,102,'Consulta solicitud',1,'2026-01-27 14:51:06');
INSERT INTO `trd_general_bitacora` VALUES (318,102,'Consulta solicitud',1,'2026-01-27 14:51:25');
INSERT INTO `trd_general_bitacora` VALUES (319,102,'Consulta solicitud',1,'2026-01-27 14:51:28');
INSERT INTO `trd_general_bitacora` VALUES (320,113,'Consulta solicitud',1,'2026-01-27 14:52:01');
INSERT INTO `trd_general_bitacora` VALUES (321,113,'Consulta solicitud',1,'2026-01-27 14:57:32');
INSERT INTO `trd_general_bitacora` VALUES (322,113,'Consulta solicitud',1,'2026-01-28 08:41:03');
INSERT INTO `trd_general_bitacora` VALUES (323,113,'Consulta solicitud',1,'2026-01-28 08:42:29');
INSERT INTO `trd_general_bitacora` VALUES (324,113,'Consulta solicitud',1,'2026-01-28 08:42:42');
INSERT INTO `trd_general_bitacora` VALUES (325,113,'Consulta solicitud',1,'2026-01-28 08:42:53');
INSERT INTO `trd_general_bitacora` VALUES (326,113,'Consulta solicitud',1,'2026-01-28 08:42:56');
INSERT INTO `trd_general_bitacora` VALUES (327,113,'Añade comentario al trámite',1,'2026-01-28 08:43:21');
INSERT INTO `trd_general_bitacora` VALUES (328,113,'Consulta solicitud',1,'2026-01-28 08:43:21');
INSERT INTO `trd_general_bitacora` VALUES (329,113,'Consulta solicitud',1,'2026-01-28 08:43:33');
INSERT INTO `trd_general_bitacora` VALUES (330,113,'Consulta solicitud',1,'2026-01-28 08:44:11');
INSERT INTO `trd_general_bitacora` VALUES (331,113,'Consulta solicitud',1,'2026-01-28 08:45:32');
INSERT INTO `trd_general_bitacora` VALUES (332,113,'Consulta solicitud',1,'2026-01-28 08:45:41');
INSERT INTO `trd_general_bitacora` VALUES (333,113,'Consulta solicitud',1,'2026-01-28 08:47:41');
INSERT INTO `trd_general_bitacora` VALUES (334,113,'Consulta solicitud',1,'2026-01-28 08:52:35');
INSERT INTO `trd_general_bitacora` VALUES (335,113,'Consulta solicitud',1,'2026-01-28 09:54:48');
INSERT INTO `trd_general_bitacora` VALUES (336,99,'Consulta solicitud',1,'2026-01-28 09:58:24');
INSERT INTO `trd_general_bitacora` VALUES (337,99,'Consulta solicitud',1,'2026-01-28 09:58:32');
INSERT INTO `trd_general_bitacora` VALUES (338,99,'Consulta solicitud',1,'2026-01-28 09:58:53');
INSERT INTO `trd_general_bitacora` VALUES (339,99,'Edita: prioridad de \"\" a \"1\"',1,'2026-01-28 09:58:53');
INSERT INTO `trd_general_bitacora` VALUES (340,99,'Consulta solicitud',1,'2026-01-28 09:58:55');
INSERT INTO `trd_general_bitacora` VALUES (341,111,'Consulta solicitud',2,'2026-01-28 09:59:45');
INSERT INTO `trd_general_bitacora` VALUES (342,103,'Consulta solicitud',1,'2026-01-28 10:06:11');
INSERT INTO `trd_general_bitacora` VALUES (343,110,'Consulta solicitud',1,'2026-01-28 10:06:24');
INSERT INTO `trd_general_bitacora` VALUES (344,110,'Consulta solicitud',1,'2026-01-28 10:06:39');
INSERT INTO `trd_general_bitacora` VALUES (345,113,'Consulta solicitud',1,'2026-01-28 10:08:19');
INSERT INTO `trd_general_bitacora` VALUES (346,113,'Consulta solicitud',1,'2026-01-28 10:08:28');
INSERT INTO `trd_general_bitacora` VALUES (347,113,'Consulta solicitud',1,'2026-01-28 10:21:08');
INSERT INTO `trd_general_bitacora` VALUES (348,113,'Consulta solicitud',1,'2026-01-28 10:27:01');
INSERT INTO `trd_general_bitacora` VALUES (349,113,'Consulta solicitud',1,'2026-01-28 10:27:25');
INSERT INTO `trd_general_bitacora` VALUES (350,113,'Consulta solicitud',1,'2026-01-28 10:27:58');
INSERT INTO `trd_general_bitacora` VALUES (351,113,'Consulta solicitud',1,'2026-01-28 10:30:58');
INSERT INTO `trd_general_bitacora` VALUES (352,113,'Consulta solicitud',1,'2026-01-28 10:31:55');
INSERT INTO `trd_general_bitacora` VALUES (353,113,'Responde solicitud',1,'2026-01-28 13:00:32');
INSERT INTO `trd_general_bitacora` VALUES (354,113,'Consulta solicitud',1,'2026-01-28 13:00:38');
INSERT INTO `trd_general_bitacora` VALUES (355,113,'Consulta solicitud',1,'2026-01-28 13:01:05');
INSERT INTO `trd_general_bitacora` VALUES (356,113,'Consulta solicitud',1,'2026-01-28 13:01:10');
INSERT INTO `trd_general_bitacora` VALUES (357,112,'Consulta solicitud',1,'2026-01-28 13:01:53');
INSERT INTO `trd_general_bitacora` VALUES (358,102,'Consulta solicitud',1,'2026-01-28 13:02:20');
INSERT INTO `trd_general_bitacora` VALUES (359,110,'Consulta solicitud',1,'2026-01-28 13:02:28');
INSERT INTO `trd_general_bitacora` VALUES (360,113,'Consulta solicitud',1,'2026-01-28 13:02:38');
INSERT INTO `trd_general_bitacora` VALUES (361,113,'Consulta solicitud',1,'2026-01-28 13:04:01');
INSERT INTO `trd_general_bitacora` VALUES (362,113,'Responde solicitud',1,'2026-01-28 13:04:12');
INSERT INTO `trd_general_bitacora` VALUES (363,113,'Consulta solicitud',1,'2026-01-28 13:04:23');
INSERT INTO `trd_general_bitacora` VALUES (364,113,'Consulta solicitud',1,'2026-01-28 13:04:24');
INSERT INTO `trd_general_bitacora` VALUES (365,113,'Responde solicitud',1,'2026-01-28 13:04:49');
INSERT INTO `trd_general_bitacora` VALUES (366,113,'Consulta solicitud',1,'2026-01-28 13:04:57');
INSERT INTO `trd_general_bitacora` VALUES (367,113,'Consulta solicitud',1,'2026-01-28 13:05:13');
INSERT INTO `trd_general_bitacora` VALUES (368,113,'Consulta solicitud',1,'2026-01-28 13:05:14');
INSERT INTO `trd_general_bitacora` VALUES (369,113,'Consulta solicitud',1,'2026-01-28 13:06:14');
INSERT INTO `trd_general_bitacora` VALUES (370,113,'Consulta solicitud',1,'2026-01-28 13:06:15');
INSERT INTO `trd_general_bitacora` VALUES (371,113,'Consulta solicitud',1,'2026-01-28 13:08:05');
INSERT INTO `trd_general_bitacora` VALUES (372,113,'Consulta solicitud',1,'2026-01-28 13:08:57');
INSERT INTO `trd_general_bitacora` VALUES (373,113,'Consulta solicitud',1,'2026-01-28 13:09:32');
INSERT INTO `trd_general_bitacora` VALUES (374,113,'Consulta solicitud',1,'2026-01-28 13:10:01');
INSERT INTO `trd_general_bitacora` VALUES (375,113,'Consulta solicitud',1,'2026-01-28 13:11:03');
INSERT INTO `trd_general_bitacora` VALUES (376,113,'Consulta solicitud',1,'2026-01-28 13:11:56');
INSERT INTO `trd_general_bitacora` VALUES (377,113,'Consulta solicitud',1,'2026-01-28 13:12:18');
INSERT INTO `trd_general_bitacora` VALUES (378,113,'Consulta solicitud',1,'2026-01-28 14:32:53');
INSERT INTO `trd_general_bitacora` VALUES (379,113,'Consulta solicitud',1,'2026-01-28 14:32:54');
INSERT INTO `trd_general_bitacora` VALUES (380,113,'Consulta solicitud',1,'2026-01-28 14:33:31');
INSERT INTO `trd_general_bitacora` VALUES (381,113,'Consulta solicitud',1,'2026-01-28 14:33:32');
INSERT INTO `trd_general_bitacora` VALUES (382,113,'Consulta solicitud',1,'2026-01-28 14:34:12');
INSERT INTO `trd_general_bitacora` VALUES (383,113,'Consulta solicitud',1,'2026-01-28 14:34:12');
INSERT INTO `trd_general_bitacora` VALUES (384,114,'Ingresa solicitud: Prueba TC-06 002',1,'2026-01-28 14:49:11');
INSERT INTO `trd_general_bitacora` VALUES (385,114,'Consulta solicitud',1,'2026-01-28 14:50:19');
INSERT INTO `trd_general_bitacora` VALUES (386,114,'Consulta solicitud',1,'2026-01-28 14:50:48');
INSERT INTO `trd_general_bitacora` VALUES (387,110,'Consulta solicitud',1,'2026-01-28 14:51:29');
INSERT INTO `trd_general_bitacora` VALUES (388,110,'Consulta solicitud',1,'2026-01-28 14:51:29');
INSERT INTO `trd_general_bitacora` VALUES (389,110,'Consulta solicitud',1,'2026-01-28 14:51:47');
INSERT INTO `trd_general_bitacora` VALUES (390,110,'Consulta solicitud',1,'2026-01-28 14:51:49');
INSERT INTO `trd_general_bitacora` VALUES (391,115,'Ingresa solicitud: Prueba TC-06 003 reingreso',1,'2026-01-28 15:11:11');
INSERT INTO `trd_general_bitacora` VALUES (392,115,'Consulta solicitud',1,'2026-01-28 15:11:25');
INSERT INTO `trd_general_bitacora` VALUES (393,115,'Consulta solicitud',1,'2026-01-28 15:11:37');
INSERT INTO `trd_general_bitacora` VALUES (394,115,'Consulta solicitud',1,'2026-01-28 15:11:58');
INSERT INTO `trd_general_bitacora` VALUES (395,115,'Consulta solicitud',1,'2026-01-28 15:15:56');
INSERT INTO `trd_general_bitacora` VALUES (396,115,'Consulta solicitud',1,'2026-01-28 15:16:17');
INSERT INTO `trd_general_bitacora` VALUES (397,115,'Consulta solicitud',1,'2026-01-28 15:17:00');
INSERT INTO `trd_general_bitacora` VALUES (398,115,'Consulta solicitud',1,'2026-01-28 15:18:10');
INSERT INTO `trd_general_bitacora` VALUES (399,114,'Consulta solicitud',1,'2026-01-28 15:18:34');
INSERT INTO `trd_general_bitacora` VALUES (400,114,'Consulta solicitud',1,'2026-01-28 15:18:35');
INSERT INTO `trd_general_bitacora` VALUES (401,114,'Consulta solicitud',1,'2026-01-28 15:18:46');
INSERT INTO `trd_general_bitacora` VALUES (402,114,'Consulta solicitud',1,'2026-01-28 15:21:49');
INSERT INTO `trd_general_bitacora` VALUES (403,115,'Consulta solicitud',1,'2026-01-28 15:23:39');
INSERT INTO `trd_general_bitacora` VALUES (404,115,'Consulta solicitud',1,'2026-01-28 15:28:31');
INSERT INTO `trd_general_bitacora` VALUES (405,116,'Ingresa solicitud: prueba TC-06 004',1,'2026-01-28 15:35:23');
INSERT INTO `trd_general_bitacora` VALUES (406,116,'Consulta solicitud',1,'2026-01-28 15:35:28');
INSERT INTO `trd_general_bitacora` VALUES (407,116,'Consulta solicitud',1,'2026-01-28 15:35:33');
INSERT INTO `trd_general_bitacora` VALUES (408,116,'Consulta solicitud',1,'2026-01-28 15:36:27');
INSERT INTO `trd_general_bitacora` VALUES (409,116,'Consulta solicitud',1,'2026-01-28 15:39:16');
INSERT INTO `trd_general_bitacora` VALUES (410,116,'Consulta solicitud',1,'2026-01-28 15:40:03');
INSERT INTO `trd_general_bitacora` VALUES (411,116,'Consulta solicitud',1,'2026-01-28 15:40:39');
INSERT INTO `trd_general_bitacora` VALUES (412,116,'Consulta solicitud',1,'2026-01-28 15:43:19');
INSERT INTO `trd_general_bitacora` VALUES (413,116,'Consulta solicitud',1,'2026-01-28 15:47:13');
INSERT INTO `trd_general_bitacora` VALUES (414,116,'Consulta solicitud',1,'2026-01-28 15:47:19');
INSERT INTO `trd_general_bitacora` VALUES (415,116,'Consulta solicitud',1,'2026-01-28 15:47:22');
INSERT INTO `trd_general_bitacora` VALUES (416,116,'Consulta solicitud',1,'2026-01-28 15:49:02');
INSERT INTO `trd_general_bitacora` VALUES (417,116,'Consulta solicitud',1,'2026-01-28 15:49:09');
INSERT INTO `trd_general_bitacora` VALUES (418,116,'Consulta solicitud',1,'2026-01-28 15:49:11');
INSERT INTO `trd_general_bitacora` VALUES (419,116,'Consulta solicitud',1,'2026-01-28 15:49:54');
INSERT INTO `trd_general_bitacora` VALUES (420,116,'Consulta solicitud',1,'2026-01-28 15:50:16');
INSERT INTO `trd_general_bitacora` VALUES (421,116,'Consulta solicitud',1,'2026-01-28 15:50:23');
INSERT INTO `trd_general_bitacora` VALUES (422,116,'Consulta solicitud',1,'2026-01-28 15:50:28');
INSERT INTO `trd_general_bitacora` VALUES (423,116,'Consulta solicitud',1,'2026-01-28 15:50:31');
INSERT INTO `trd_general_bitacora` VALUES (424,116,'Consulta solicitud',1,'2026-01-28 15:51:41');
INSERT INTO `trd_general_bitacora` VALUES (425,116,'Consulta solicitud',1,'2026-01-28 15:52:07');
INSERT INTO `trd_general_bitacora` VALUES (426,116,'Consulta solicitud',1,'2026-01-28 15:52:09');
INSERT INTO `trd_general_bitacora` VALUES (427,116,'Consulta solicitud',1,'2026-01-28 15:52:22');
INSERT INTO `trd_general_bitacora` VALUES (428,116,'Consulta solicitud',1,'2026-01-28 15:53:05');
INSERT INTO `trd_general_bitacora` VALUES (429,116,'Consulta solicitud',1,'2026-01-28 15:53:41');
INSERT INTO `trd_general_bitacora` VALUES (430,116,'Consulta solicitud',1,'2026-01-28 15:53:46');
INSERT INTO `trd_general_bitacora` VALUES (431,116,'Consulta solicitud',1,'2026-01-28 15:53:48');
INSERT INTO `trd_general_bitacora` VALUES (432,116,'Consulta solicitud',1,'2026-01-28 15:53:57');
INSERT INTO `trd_general_bitacora` VALUES (433,117,'Ingresa solicitud: Prueba TC-06 005 codigo desve',1,'2026-01-28 15:55:03');
INSERT INTO `trd_general_bitacora` VALUES (434,117,'Consulta solicitud',1,'2026-01-28 15:55:08');
INSERT INTO `trd_general_bitacora` VALUES (435,117,'Consulta solicitud',1,'2026-01-28 15:55:15');
INSERT INTO `trd_general_bitacora` VALUES (436,117,'Consulta solicitud',1,'2026-01-28 15:55:23');
INSERT INTO `trd_general_bitacora` VALUES (437,117,'Consulta solicitud',1,'2026-01-28 15:55:25');
INSERT INTO `trd_general_bitacora` VALUES (438,117,'Consulta solicitud',1,'2026-01-28 15:55:37');
INSERT INTO `trd_general_bitacora` VALUES (439,116,'Consulta solicitud',1,'2026-01-28 15:58:03');
INSERT INTO `trd_general_bitacora` VALUES (440,116,'Consulta solicitud',1,'2026-01-28 15:58:05');
INSERT INTO `trd_general_bitacora` VALUES (441,116,'Consulta solicitud',1,'2026-01-28 15:59:17');
INSERT INTO `trd_general_bitacora` VALUES (442,116,'Consulta solicitud',1,'2026-01-28 15:59:18');
INSERT INTO `trd_general_bitacora` VALUES (443,116,'Consulta solicitud',1,'2026-01-28 16:00:48');
INSERT INTO `trd_general_bitacora` VALUES (444,116,'Consulta solicitud',1,'2026-01-28 16:01:21');
INSERT INTO `trd_general_bitacora` VALUES (445,116,'Consulta solicitud',1,'2026-01-28 16:01:37');
INSERT INTO `trd_general_bitacora` VALUES (446,116,'Consulta solicitud',1,'2026-01-28 16:04:17');
INSERT INTO `trd_general_bitacora` VALUES (447,116,'Consulta solicitud',1,'2026-01-28 16:04:31');
INSERT INTO `trd_general_bitacora` VALUES (448,116,'Consulta solicitud',1,'2026-01-28 16:05:20');
INSERT INTO `trd_general_bitacora` VALUES (449,116,'Consulta solicitud',1,'2026-01-28 16:05:28');
INSERT INTO `trd_general_bitacora` VALUES (450,116,'Consulta solicitud',1,'2026-01-28 16:05:42');
INSERT INTO `trd_general_bitacora` VALUES (451,116,'Consulta solicitud',1,'2026-01-28 16:05:51');
INSERT INTO `trd_general_bitacora` VALUES (452,116,'Consulta solicitud',1,'2026-01-28 16:06:25');
INSERT INTO `trd_general_bitacora` VALUES (453,116,'Consulta solicitud',1,'2026-01-28 16:06:43');
INSERT INTO `trd_general_bitacora` VALUES (454,115,'Consulta solicitud',1,'2026-01-28 16:07:51');
INSERT INTO `trd_general_bitacora` VALUES (455,115,'Consulta solicitud',2,'2026-01-28 16:15:14');
INSERT INTO `trd_general_bitacora` VALUES (456,115,'Consulta solicitud',2,'2026-01-28 16:15:16');
INSERT INTO `trd_general_bitacora` VALUES (457,115,'Consulta solicitud',2,'2026-01-28 16:15:30');
INSERT INTO `trd_general_bitacora` VALUES (458,118,'Ingresa solicitud: TC-08 001',1,'2026-01-28 16:20:23');
INSERT INTO `trd_general_bitacora` VALUES (459,118,'Consulta solicitud',1,'2026-01-28 16:20:30');
INSERT INTO `trd_general_bitacora` VALUES (460,118,'Consulta solicitud',2,'2026-01-28 16:20:56');
INSERT INTO `trd_general_bitacora` VALUES (461,118,'Consulta solicitud',2,'2026-01-28 16:21:29');
INSERT INTO `trd_general_bitacora` VALUES (462,118,'Consulta solicitud',2,'2026-01-28 16:23:41');
INSERT INTO `trd_general_bitacora` VALUES (463,118,'Consulta solicitud',2,'2026-01-28 16:23:43');
INSERT INTO `trd_general_bitacora` VALUES (464,118,'Consulta solicitud',2,'2026-01-28 16:24:06');
INSERT INTO `trd_general_bitacora` VALUES (465,118,'Consulta solicitud',2,'2026-01-28 16:25:43');
INSERT INTO `trd_general_bitacora` VALUES (466,118,'Consulta solicitud',2,'2026-01-28 16:26:25');
INSERT INTO `trd_general_bitacora` VALUES (467,118,'Consulta solicitud',3,'2026-01-28 16:26:59');
INSERT INTO `trd_general_bitacora` VALUES (468,118,'Consulta solicitud',3,'2026-01-28 16:27:00');
INSERT INTO `trd_general_bitacora` VALUES (469,118,'Consulta solicitud',3,'2026-01-28 16:33:27');
INSERT INTO `trd_general_bitacora` VALUES (470,118,'Consulta solicitud',3,'2026-01-28 16:34:31');
INSERT INTO `trd_general_bitacora` VALUES (471,118,'Consulta solicitud',3,'2026-01-28 16:34:51');
INSERT INTO `trd_general_bitacora` VALUES (472,118,'Consulta solicitud',3,'2026-01-28 16:35:21');
INSERT INTO `trd_general_bitacora` VALUES (473,118,'Consulta solicitud',3,'2026-01-28 16:35:40');
INSERT INTO `trd_general_bitacora` VALUES (474,118,'Consulta solicitud',3,'2026-01-28 16:38:21');
INSERT INTO `trd_general_bitacora` VALUES (475,118,'Consulta solicitud',3,'2026-01-28 16:38:50');
INSERT INTO `trd_general_bitacora` VALUES (476,118,'Consulta solicitud',3,'2026-01-28 16:39:25');
INSERT INTO `trd_general_bitacora` VALUES (477,118,'Consulta solicitud',3,'2026-01-28 16:39:53');
INSERT INTO `trd_general_bitacora` VALUES (478,118,'Consulta solicitud',3,'2026-01-28 16:40:29');
INSERT INTO `trd_general_bitacora` VALUES (479,118,'Consulta solicitud',2,'2026-01-28 16:43:35');
INSERT INTO `trd_general_bitacora` VALUES (480,118,'Consulta solicitud',3,'2026-01-28 16:43:51');
INSERT INTO `trd_general_bitacora` VALUES (481,118,'Consulta solicitud',3,'2026-01-28 16:45:17');
INSERT INTO `trd_general_bitacora` VALUES (482,118,'Consulta solicitud',3,'2026-01-28 16:45:34');
INSERT INTO `trd_general_bitacora` VALUES (483,118,'Consulta solicitud',3,'2026-01-28 16:45:42');
INSERT INTO `trd_general_bitacora` VALUES (484,118,'Consulta solicitud',3,'2026-01-28 16:52:57');
INSERT INTO `trd_general_bitacora` VALUES (485,118,'Consulta solicitud',3,'2026-01-28 16:53:22');
INSERT INTO `trd_general_bitacora` VALUES (486,118,'Consulta solicitud',3,'2026-01-28 16:54:01');
INSERT INTO `trd_general_bitacora` VALUES (487,118,'Consulta solicitud',3,'2026-01-28 16:55:11');
INSERT INTO `trd_general_bitacora` VALUES (488,118,'Consulta solicitud',2,'2026-01-28 16:56:22');
INSERT INTO `trd_general_bitacora` VALUES (489,118,'Consulta solicitud',2,'2026-01-29 09:04:28');
INSERT INTO `trd_general_bitacora` VALUES (490,117,'Consulta solicitud',2,'2026-01-29 09:12:24');
INSERT INTO `trd_general_bitacora` VALUES (491,117,'Consulta solicitud',3,'2026-01-29 09:39:40');
INSERT INTO `trd_general_bitacora` VALUES (492,117,'Consulta solicitud',3,'2026-01-29 09:43:31');
INSERT INTO `trd_general_bitacora` VALUES (493,117,'Consulta solicitud',2,'2026-01-29 09:51:56');
INSERT INTO `trd_general_bitacora` VALUES (494,117,'Consulta solicitud',3,'2026-01-29 10:02:53');
INSERT INTO `trd_general_bitacora` VALUES (495,116,'Consulta solicitud',2,'2026-01-29 10:03:12');
INSERT INTO `trd_general_bitacora` VALUES (496,114,'Consulta solicitud',2,'2026-01-29 10:03:17');
INSERT INTO `trd_general_bitacora` VALUES (497,114,'Consulta solicitud',3,'2026-01-29 10:03:23');
INSERT INTO `trd_general_bitacora` VALUES (498,118,'Consulta solicitud',3,'2026-01-29 10:16:07');
INSERT INTO `trd_general_bitacora` VALUES (499,118,'Consulta solicitud',1,'2026-01-29 14:44:59');
INSERT INTO `trd_general_bitacora` VALUES (500,118,'Consulta solicitud',1,'2026-01-29 14:45:18');
INSERT INTO `trd_general_bitacora` VALUES (501,118,'Consulta solicitud',1,'2026-01-29 14:45:27');
INSERT INTO `trd_general_bitacora` VALUES (502,118,'Consulta solicitud',1,'2026-01-29 14:45:47');
INSERT INTO `trd_general_bitacora` VALUES (503,118,'Consulta solicitud',1,'2026-01-29 14:46:56');
INSERT INTO `trd_general_bitacora` VALUES (504,98,'Consulta solicitud',2,'2026-01-29 14:47:37');
INSERT INTO `trd_general_bitacora` VALUES (505,118,'Consulta solicitud',2,'2026-01-29 14:47:51');
INSERT INTO `trd_general_bitacora` VALUES (506,118,'Consulta solicitud',2,'2026-01-29 14:51:44');
INSERT INTO `trd_general_bitacora` VALUES (507,118,'Consulta solicitud',1,'2026-01-29 14:51:49');
INSERT INTO `trd_general_bitacora` VALUES (508,118,'Consulta solicitud',1,'2026-01-29 15:00:42');
INSERT INTO `trd_general_bitacora` VALUES (509,118,'Consulta solicitud',1,'2026-01-29 15:03:53');
INSERT INTO `trd_general_bitacora` VALUES (510,118,'Consulta solicitud',1,'2026-01-29 15:04:10');
INSERT INTO `trd_general_bitacora` VALUES (511,118,'Consulta solicitud',1,'2026-01-29 15:04:44');
INSERT INTO `trd_general_bitacora` VALUES (512,118,'Consulta solicitud',1,'2026-01-29 15:05:21');
INSERT INTO `trd_general_bitacora` VALUES (513,118,'Consulta solicitud',1,'2026-01-29 15:05:48');
INSERT INTO `trd_general_bitacora` VALUES (514,118,'Consulta solicitud',1,'2026-01-29 15:05:56');
INSERT INTO `trd_general_bitacora` VALUES (515,118,'Consulta solicitud',1,'2026-01-29 15:06:12');
INSERT INTO `trd_general_bitacora` VALUES (516,118,'Consulta solicitud',1,'2026-01-29 15:06:27');
INSERT INTO `trd_general_bitacora` VALUES (517,118,'Consulta solicitud',1,'2026-01-29 15:06:36');
INSERT INTO `trd_general_bitacora` VALUES (518,118,'Consulta solicitud',1,'2026-01-29 15:07:23');
INSERT INTO `trd_general_bitacora` VALUES (519,118,'Consulta solicitud',1,'2026-01-29 15:09:24');
INSERT INTO `trd_general_bitacora` VALUES (520,118,'Consulta solicitud',1,'2026-01-29 15:09:50');
INSERT INTO `trd_general_bitacora` VALUES (521,118,'Consulta solicitud',1,'2026-01-29 15:10:02');
INSERT INTO `trd_general_bitacora` VALUES (522,118,'Consulta solicitud',1,'2026-01-29 15:10:20');
INSERT INTO `trd_general_bitacora` VALUES (523,118,'Consulta solicitud',1,'2026-01-29 15:11:25');
INSERT INTO `trd_general_bitacora` VALUES (524,118,'Consulta solicitud',1,'2026-01-29 15:11:42');
INSERT INTO `trd_general_bitacora` VALUES (525,118,'Consulta solicitud',1,'2026-01-29 15:12:50');
INSERT INTO `trd_general_bitacora` VALUES (526,118,'Consulta solicitud',1,'2026-01-29 15:13:36');
INSERT INTO `trd_general_bitacora` VALUES (527,118,'Consulta solicitud',1,'2026-01-29 15:15:00');
INSERT INTO `trd_general_bitacora` VALUES (528,115,'Consulta solicitud',2,'2026-01-29 15:15:55');
INSERT INTO `trd_general_bitacora` VALUES (529,115,'Consulta solicitud',2,'2026-01-29 15:16:56');
INSERT INTO `trd_general_bitacora` VALUES (530,115,'Consulta solicitud',2,'2026-01-29 15:17:56');
INSERT INTO `trd_general_bitacora` VALUES (531,118,'Consulta solicitud',2,'2026-01-29 15:23:20');
INSERT INTO `trd_general_bitacora` VALUES (532,118,'Consulta solicitud',2,'2026-01-29 15:23:22');
INSERT INTO `trd_general_bitacora` VALUES (533,118,'Consulta solicitud',2,'2026-01-29 15:26:03');
INSERT INTO `trd_general_bitacora` VALUES (534,118,'Consulta solicitud',2,'2026-01-29 15:26:21');
INSERT INTO `trd_general_bitacora` VALUES (535,118,'Consulta solicitud',2,'2026-01-29 15:26:33');
INSERT INTO `trd_general_bitacora` VALUES (536,118,'Consulta solicitud',2,'2026-01-29 15:27:08');
INSERT INTO `trd_general_bitacora` VALUES (537,118,'Consulta solicitud',2,'2026-01-29 15:27:48');
INSERT INTO `trd_general_bitacora` VALUES (538,118,'Consulta solicitud',2,'2026-01-29 15:28:05');
INSERT INTO `trd_general_bitacora` VALUES (539,118,'Consulta solicitud',2,'2026-01-29 15:29:15');
INSERT INTO `trd_general_bitacora` VALUES (540,118,'Consulta solicitud',1,'2026-01-29 15:29:55');
INSERT INTO `trd_general_bitacora` VALUES (541,118,'Consulta solicitud',1,'2026-01-29 15:30:26');
INSERT INTO `trd_general_bitacora` VALUES (542,114,'Consulta solicitud',1,'2026-01-29 15:30:35');
INSERT INTO `trd_general_bitacora` VALUES (543,114,'Consulta solicitud',1,'2026-01-29 15:30:47');
INSERT INTO `trd_general_bitacora` VALUES (544,118,'Consulta solicitud',1,'2026-01-29 15:58:36');
INSERT INTO `trd_general_bitacora` VALUES (545,118,'Consulta solicitud',1,'2026-01-29 15:58:40');
INSERT INTO `trd_general_bitacora` VALUES (546,119,'Ingresa solicitud Ingresos',3,'2026-01-29 16:20:27');
INSERT INTO `trd_general_bitacora` VALUES (547,120,'Ingresa solicitud Ingresos',3,'2026-01-29 16:21:10');
INSERT INTO `trd_general_bitacora` VALUES (548,118,'Consulta solicitud',3,'2026-01-30 09:09:34');
INSERT INTO `trd_general_bitacora` VALUES (549,118,'Responde solicitud',3,'2026-01-30 09:10:05');
INSERT INTO `trd_general_bitacora` VALUES (550,118,'Consulta solicitud',3,'2026-01-30 09:10:15');
INSERT INTO `trd_general_bitacora` VALUES (551,118,'Responde solicitud',3,'2026-01-30 09:10:36');
INSERT INTO `trd_general_bitacora` VALUES (552,118,'Consulta solicitud',3,'2026-01-30 09:10:41');
INSERT INTO `trd_general_bitacora` VALUES (553,118,'Consulta solicitud',1,'2026-01-30 09:11:27');
INSERT INTO `trd_general_bitacora` VALUES (554,118,'Consulta solicitud',1,'2026-01-30 09:11:34');
INSERT INTO `trd_general_bitacora` VALUES (555,118,'Consulta solicitud',3,'2026-01-30 09:11:58');
INSERT INTO `trd_general_bitacora` VALUES (556,118,'Consulta solicitud',1,'2026-01-30 09:12:17');
INSERT INTO `trd_general_bitacora` VALUES (557,118,'Consulta solicitud',1,'2026-01-30 09:16:56');
INSERT INTO `trd_general_bitacora` VALUES (558,118,'Consulta solicitud',3,'2026-01-30 09:17:04');
INSERT INTO `trd_general_bitacora` VALUES (559,118,'Consulta solicitud',3,'2026-01-30 09:28:25');
INSERT INTO `trd_general_bitacora` VALUES (560,118,'Consulta solicitud',3,'2026-01-30 09:31:47');
INSERT INTO `trd_general_bitacora` VALUES (561,118,'Consulta solicitud',3,'2026-01-30 09:32:08');
INSERT INTO `trd_general_bitacora` VALUES (562,118,'Consulta solicitud',3,'2026-01-30 09:32:12');
INSERT INTO `trd_general_bitacora` VALUES (563,118,'Consulta solicitud',3,'2026-01-30 09:32:29');
INSERT INTO `trd_general_bitacora` VALUES (564,118,'Consulta solicitud',3,'2026-01-30 09:32:48');
INSERT INTO `trd_general_bitacora` VALUES (565,118,'Consulta solicitud',1,'2026-01-30 09:33:30');
INSERT INTO `trd_general_bitacora` VALUES (566,118,'Consulta solicitud',1,'2026-01-30 09:33:44');
INSERT INTO `trd_general_bitacora` VALUES (567,118,'Consulta solicitud',1,'2026-01-30 09:37:42');
INSERT INTO `trd_general_bitacora` VALUES (568,118,'Consulta solicitud',1,'2026-01-30 10:58:26');
INSERT INTO `trd_general_bitacora` VALUES (569,118,'Consulta solicitud',1,'2026-02-02 07:53:20');
INSERT INTO `trd_general_bitacora` VALUES (570,117,'Consulta solicitud',1,'2026-02-02 10:22:54');
INSERT INTO `trd_general_bitacora` VALUES (571,117,'Consulta solicitud',1,'2026-02-02 10:27:02');
INSERT INTO `trd_general_bitacora` VALUES (572,117,'Consulta solicitud',1,'2026-02-02 10:28:32');
INSERT INTO `trd_general_bitacora` VALUES (573,117,'Consulta solicitud',1,'2026-02-02 10:34:50');
INSERT INTO `trd_general_bitacora` VALUES (574,117,'Consulta solicitud',1,'2026-02-02 10:35:15');
INSERT INTO `trd_general_bitacora` VALUES (575,117,'Consulta solicitud',1,'2026-02-02 10:35:19');
INSERT INTO `trd_general_bitacora` VALUES (576,121,'Ingresa solicitud Ingresos',1,'2026-02-02 12:11:08');
INSERT INTO `trd_general_bitacora` VALUES (577,118,'Consulta solicitud',2,'2026-02-02 15:33:41');
INSERT INTO `trd_general_bitacora` VALUES (578,118,'Consulta solicitud',1,'2026-02-02 15:34:14');
INSERT INTO `trd_general_bitacora` VALUES (579,118,'Consulta solicitud',3,'2026-02-02 15:34:23');
INSERT INTO `trd_general_bitacora` VALUES (580,118,'Consulta solicitud',3,'2026-02-02 15:34:52');
INSERT INTO `trd_general_bitacora` VALUES (581,122,'Ingresa solicitud: INGRESO RMV',3,'2026-02-03 10:30:55');
INSERT INTO `trd_general_bitacora` VALUES (582,122,'Consulta solicitud',3,'2026-02-03 10:31:06');
INSERT INTO `trd_general_bitacora` VALUES (583,122,'Consulta solicitud',3,'2026-02-03 10:32:26');
INSERT INTO `trd_general_bitacora` VALUES (584,122,'Consulta solicitud',3,'2026-02-03 10:32:45');
INSERT INTO `trd_general_bitacora` VALUES (585,112,'Consulta solicitud',3,'2026-02-03 10:33:09');
INSERT INTO `trd_general_bitacora` VALUES (586,118,'Consulta solicitud',3,'2026-02-03 10:45:22');
INSERT INTO `trd_general_bitacora` VALUES (587,122,'Consulta solicitud',3,'2026-02-03 10:45:42');
INSERT INTO `trd_general_bitacora` VALUES (588,118,'Consulta solicitud',3,'2026-02-03 10:47:25');
INSERT INTO `trd_general_bitacora` VALUES (589,123,'Ingresa solicitud: prueba php',1,'2026-02-03 16:20:58');
INSERT INTO `trd_general_bitacora` VALUES (590,124,'Ingresa solicitud: prueba php',1,'2026-02-03 16:28:18');
INSERT INTO `trd_general_bitacora` VALUES (591,125,'Ingresa solicitud: prueba php',1,'2026-02-03 16:34:18');
INSERT INTO `trd_general_bitacora` VALUES (592,126,'Ingresa solicitud: prueba php',1,'2026-02-03 16:34:30');
INSERT INTO `trd_general_bitacora` VALUES (593,127,'Ingresa solicitud: prueba php',1,'2026-02-03 16:38:32');
INSERT INTO `trd_general_bitacora` VALUES (594,128,'Ingresa solicitud: prueba php2',1,'2026-02-03 16:42:23');
INSERT INTO `trd_general_bitacora` VALUES (595,129,'Ingresa solicitud: prueba php2',1,'2026-02-03 16:43:34');
INSERT INTO `trd_general_bitacora` VALUES (596,113,'Consulta solicitud',1,'2026-02-03 17:00:42');
INSERT INTO `trd_general_bitacora` VALUES (597,113,'Consulta solicitud',1,'2026-02-03 17:01:01');
INSERT INTO `trd_general_bitacora` VALUES (598,113,'Consulta solicitud',1,'2026-02-03 17:05:08');
INSERT INTO `trd_general_bitacora` VALUES (599,129,'Consulta solicitud',1,'2026-02-03 17:05:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_comentario`
--

LOCK TABLES `trd_general_comentario` WRITE;
/*!40000 ALTER TABLE `trd_general_comentario` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_comentario` VALUES (1,2,'comentario de prueba consultar 01',NULL,80,'2026-01-22 13:05:27');
INSERT INTO `trd_general_comentario` VALUES (2,1,'hola',NULL,100,'2026-01-22 19:47:17');
INSERT INTO `trd_general_comentario` VALUES (3,1,'asdasdasd',NULL,103,'2026-01-27 17:52:19');
INSERT INTO `trd_general_comentario` VALUES (4,1,'asdasdasd',NULL,103,'2026-01-27 17:52:26');
INSERT INTO `trd_general_comentario` VALUES (5,1,'asdasdasd',NULL,103,'2026-01-27 17:52:26');
INSERT INTO `trd_general_comentario` VALUES (6,1,'etyertyrt',NULL,103,'2026-01-27 17:52:37');
INSERT INTO `trd_general_comentario` VALUES (7,1,'yyy',NULL,103,'2026-01-27 17:52:43');
INSERT INTO `trd_general_comentario` VALUES (8,1,'rrrrrttttt',NULL,103,'2026-01-27 17:52:53');
INSERT INTO `trd_general_comentario` VALUES (9,1,'1',NULL,102,'2026-01-27 17:53:41');
INSERT INTO `trd_general_comentario` VALUES (10,1,'2',NULL,102,'2026-01-27 17:53:44');
INSERT INTO `trd_general_comentario` VALUES (11,1,'3',NULL,102,'2026-01-27 17:53:47');
INSERT INTO `trd_general_comentario` VALUES (12,1,'4',NULL,102,'2026-01-27 17:53:50');
INSERT INTO `trd_general_comentario` VALUES (13,1,'5',NULL,102,'2026-01-27 17:53:53');
INSERT INTO `trd_general_comentario` VALUES (14,1,'5',NULL,102,'2026-01-27 17:53:53');
INSERT INTO `trd_general_comentario` VALUES (15,1,'prueba comentario',NULL,113,'2026-01-28 12:43:21');
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
INSERT INTO `trd_general_contribuyentes` VALUES (3,'14.711.939-9','Juan Francisco','Hervas ','Farru');
INSERT INTO `trd_general_contribuyentes` VALUES (4,'232.321.321-3','6565','','1111');
INSERT INTO `trd_general_contribuyentes` VALUES (5,'232.321.321-3','Juan','fg','Hervas');
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
  `doc_enlace_documento` text NOT NULL,
  `doc_nombre_documento` varchar(100) NOT NULL,
  `doc-responsable` int(11) NOT NULL,
  `doc_docdigital` tinyint(1) NOT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `trd_general_bitacora_trd_acceso_usuarios_FK` (`doc-responsable`) USING BTREE,
  KEY `trd_general_bitacora_trd_general_registro_general_tramites_FK` (`doc_tramite_registrado`) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`doc-responsable`) REFERENCES `trd_acceso_usuarios` (`usr_id`),
  CONSTRAINT `2` FOREIGN KEY (`doc_tramite_registrado`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_documento_adjunto` VALUES (1,80,'2026-01-22 08:50:30','/uploads/documentos/7a7d798dbb5de54d881c2525c07a89eb80bf9b74.php','test_auth.php',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (2,80,'2026-01-22 08:50:30','/uploads/documentos/e69fb7735284e84ad93bd20510e832c16b4d0cf6.php','test_auth - copia.php',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (3,82,'2026-01-22 08:55:44','/uploads/documentos/fa01b4d9ba654da2a930770b7d2634a7621dae8e.md','endpoints_docs.md',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (4,82,'2026-01-22 08:55:44','/uploads/documentos/782e0bcbe365cd16aed332a569c608e8c48fef97.php','test_auth.php',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (5,82,'2026-01-22 08:55:44','/uploads/documentos/80f5bd299ebb571000c024ff99b149093093e2ca.sql','transformacion_digital.sql',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (6,83,'2026-01-22 09:00:24','/uploads/documentos/6cd6396a6f47034c73baa1566724e7357ac2f633.sql','transformacion_digital_20260107.sql',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (7,86,'2026-01-22 11:48:57','/uploads/documentos/ad9a376f0d1cde79e003769df51a09c46e6d6580.pdf','2512012877.pdf',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (8,97,'2026-01-22 12:00:51','/uploads/documentos/9b866de1ff9ea89be61a598a2b2702a6c4505318.pdf','2512012877.pdf',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (9,98,'2026-01-22 12:01:34','/uploads/documentos/ff0923161dd51c58458780729b4fdbada34b9244.pdf','2512012877.pdf',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (11,96,'2026-01-22 12:14:01','/uploads/documentos/93b99197bad69a0d979bafaec9011f2e17e6b41e.sql','dump-transformacion_digital-202512291044.sql',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (13,96,'2026-01-22 12:28:26','/uploads/documentos/128fd0efc18c88ba8f938e5bea1f79d8c061ffb7.json','categoria_patentes_mapeo_completo.json',2,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (14,96,'2026-01-22 12:42:12','/uploads/documentos/d66d0134f5ab5ddcc13c0c30ac52c5692724ae1c.txt','Funcionalidades.txt',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (15,99,'2026-01-22 13:17:03','/uploads/documentos/14e8a6824a05eeed6e6bcb195da1c08090118869.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (16,100,'2026-01-22 15:46:58','/uploads/documentos/af24ce609eb4447ca9520d2b1a20346239353278.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (17,102,'2026-01-22 15:58:42','/uploads/documentos/32232df0f68075616e7eaa7af0cf59576ee4aad2.pdf','diagrama v1.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (18,110,'2026-01-26 15:32:02','/uploads/documentos/a6861d63c401b8a3f5c4ce97464e2109d4a602a5.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (19,103,'2026-01-27 13:52:10','/uploads/documentos/35df58dfa639663139272072f842a04d180e871f.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (20,113,'2026-01-28 13:00:32','/uploads/documentos/41958da6a68457a11e5dfc4cdd85c0a5ef3e8fb0.pdf','20140729223740-pagina2011051422575611.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (21,113,'2026-01-28 13:04:12','/uploads/documentos/386df25c80ae06d375f4e33c100ffc500d25be89.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (22,113,'2026-01-28 13:04:49','/uploads/documentos/ffa4b76d72d9d6328d7f8f21d0624e54bd307217.pdf','documento.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (23,114,'2026-01-28 14:49:11','/uploads/documentos/80009c9a175b0ccbbad3485d94a0e18af6ec1e59.txt','LineamientosGenerales.txt',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (24,118,'2026-01-30 09:10:36','/uploads/documentos/65bafc2bdb4b6c6f8e29981757a31423b23a4081.pdf','certificado pisee1.pdf',3,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (25,121,'2026-02-02 12:11:08','/uploads/documentos/c14e78251a797e552d19f839d1978eb725601f23.pdf','Listado_Ingresos_DESVE (2).pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (26,122,'2026-02-03 10:30:55','/uploads/documentos/d479e9c1d2226e83a7b97f6a4101899a3850e62c.pdf','Listado_Ingresos_DESVE.pdf',3,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (27,123,'2026-02-03 16:20:58','/uploads/documentos/853fcfe8754e0adec91853543f3ba9e41203cd59.pdf','13. Sistema Personal.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (28,124,'2026-02-03 16:28:18','/uploads/documentos/743a8e18b777f148facf740d86c6e8c404a28eb1.pdf','13. Sistema Personal.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (29,125,'2026-02-03 16:34:18','/uploads/documentos/59890789cc8a5dd48fb08ca1d07c4a3bab688888.pdf','13. Sistema Personal.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (30,126,'2026-02-03 16:34:30','/uploads/documentos/4ef5e47074f97299c2b34733d9bca7065c3fea3a.pdf','13. Sistema Personal.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (31,127,'2026-02-03 16:38:32','/uploads/documentos/10559b03def54bbc52112a6e33535f72235266a4.pdf','13. Sistema Personal.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (32,128,'2026-02-03 16:42:23','/uploads/documentos/58bba2df4b67fc38f8c0259ba3e7fac36cbd13dc.pdf','6. Sistema Permisos Precarios Municipales.pdf',1,0);
INSERT INTO `trd_general_documento_adjunto` VALUES (33,129,'2026-02-03 16:43:34','/uploads/documentos/2b88eb8e5dbcf0ca98626767dc5aa5b9885b6110.pdf','6. Sistema Permisos Precarios Municipales.pdf',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_enlaces`
--

LOCK TABLES `trd_general_enlaces` WRITE;
/*!40000 ALTER TABLE `trd_general_enlaces` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_enlaces` VALUES (1,80,'https://www.php.net/',2,'2026-01-22 08:50:30');
INSERT INTO `trd_general_enlaces` VALUES (2,80,'https://www.google.com/',2,'2026-01-22 08:50:30');
INSERT INTO `trd_general_enlaces` VALUES (4,82,'https://www.php.net/manual/es/function.gettype.php',2,'2026-01-22 08:55:44');
INSERT INTO `trd_general_enlaces` VALUES (5,82,'https://www.google.com/search?q=comodefinir+el+tipo+dedartoa+revolvera+php&sca_esv=fb6ec2c420ab31bb&rlz=1C1GCEU_esCL1191CL1191&ei=nIdvabjnJazZ1sQPmt7u6Aw&oq=comodefinir+el+tipo+dedartoa+revolvera&gs_lp=Egxnd3Mtd2l6LXNlcnAiJmNvbW9kZWZpbmlyIGVsIHRpcG8gZGVkYXJ0b2EgcmV2b2x2ZXJhKgIIADIHECEYChigAUiFNVAAWKYrcAF4AZABAJgBnQGgAZscqgEFMjQuMTW4AQPIAQD4AQGYAiigAsodwgINEAAYgAQYigUYQxixA8ICChAAGIAEGIoFGEPCAg4QLhiABBixAxjHARjRA8ICBRAAGIAEwgILEAAYgAQYsQMYgwHCAggQLhiABBixA8ICCBAAGIAEGLEDwgIKEC4YgAQYigUYQ8ICBRAuGIAEwgIOEAAYgAQYsQMYgwEYyQPCAgsQABiABBiKBRiSA8ICEBAuGIAEGIoFGEMYsQMYgwHCAg4QLhiABBiKBRixAxiDAcICDhAAGIAEGIoFGLEDGIMBwgIQEAAYgAQYigUYQxixAxiDAcICDRAuGIAEGIoFGEMYsQPCAgsQLhiDARixAxiABMICBxAAGIAEGArCAgkQABiABBgKGAvCAgcQABiABBgNwgIJEAAYgAQYExgKwgIIEAAYgAQYogTCAgUQABjvBcICBhAAGB4YDcICBhAAGBYYHsICBBAhGBWYAwCSBwUyMy4xN6AHz-MBsgcFMjIuMTe4B8UdwgcJMi4xOC4xOS4xyAd0gAgB&sclient=gws-wiz-serp',2,'2026-01-22 08:55:44');
INSERT INTO `trd_general_enlaces` VALUES (6,84,'https://www.google.com/search?q=comodefinir+el+tipo+dedartoa+revolvera+php&sca_esv=fb6ec2c420ab31bb&rlz=1C1GCEU_esCL1191CL1191&ei=nIdvabjnJazZ1sQPmt7u6Aw&oq=comodefinir+el+tipo+dedartoa+revolvera&gs_lp=Egxnd3Mtd2l6LXNlcnAiJmNvbW9kZWZpbmlyIGVsIHRpcG8gZGVkYXJ0b2EgcmV2b2x2ZXJhKgIIADIHECEYChigAUiFNVAAWKYrcAF4AZABAJgBnQGgAZscqgEFMjQuMTW4AQPIAQD4AQGYAiigAsodwgINEAAYgAQYigUYQxixA8ICChAAGIAEGIoFGEPCAg4QLhiABBixAxjHARjRA8ICBRAAGIAEwgILEAAYgAQYsQMYgwHCAggQLhiABBixA8ICCBAAGIAEGLEDwgIKEC4YgAQYigUYQ8ICBRAuGIAEwgIOEAAYgAQYsQMYgwEYyQPCAgsQABiABBiKBRiSA8ICEBAuGIAEGIoFGEMYsQMYgwHCAg4QLhiABBiKBRixAxiDAcICDhAAGIAEGIoFGLEDGIMBwgIQEAAYgAQYigUYQxixAxiDAcICDRAuGIAEGIoFGEMYsQPCAgsQLhiDARixAxiABMICBxAAGIAEGArCAgkQABiABBgKGAvCAgcQABiABBgNwgIJEAAYgAQYExgKwgIIEAAYgAQYogTCAgUQABjvBcICBhAAGB4YDcICBhAAGBYYHsICBBAhGBWYAwCSBwUyMy4xN6AHz-MBsgcFMjIuMTe4B8UdwgcJMi4xOC4xOS4xyAd0gAgB&sclient=gws-wiz-serp',2,'2026-01-22 09:01:31');
INSERT INTO `trd_general_enlaces` VALUES (7,84,'https://www.php.net/manual/es/function.gettype.php',2,'2026-01-22 09:01:31');
INSERT INTO `trd_general_enlaces` VALUES (8,100,'https://www.google.com/search?q=comodefinir+el+tipo+dedartoa+revolvera+php&sca_esv=fb6ec2c420ab31bb&rlz=1C1GCEU_esCL1191CL1191&ei=nIdvabjnJazZ1sQPmt7u6Aw&oq=comodefinir+el+tipo+dedartoa+revolvera&gs_lp=Egxnd3Mtd2l6LXNlcnAiJmNvbW9kZWZpbmlyIGVsIHRpcG8gZGVkYXJ0b2EgcmV2b2x2ZXJhKgIIADIHECEYChigAUiFNVAAWKYrcAF4AZABAJgBnQGgAZscqgEFMjQuMTW4AQPIAQD4AQGYAiigAsodwgINEAAYgAQYigUYQxixA8ICChAAGIAEGIoFGEPCAg4QLhiABBixAxjHARjRA8ICBRAAGIAEwgILEAAYgAQYsQMYgwHCAggQLhiABBixA8ICCBAAGIAEGLEDwgIKEC4YgAQYigUYQ8ICBRAuGIAEwgIOEAAYgAQYsQMYgwEYyQPCAgsQABiABBiKBRiSA8ICEBAuGIAEGIoFGEMYsQMYgwHCAg4QLhiABBiKBRixAxiDAcICDhAAGIAEGIoFGLEDGIMBwgIQEAAYgAQYigUYQxixAxiDAcICDRAuGIAEGIoFGEMYsQPCAgsQLhiDARixAxiABMICBxAAGIAEGArCAgkQABiABBgKGAvCAgcQABiABBgNwgIJEAAYgAQYExgKwgIIEAAYgAQYogTCAgUQABjvBcICBhAAGB4YDcICBhAAGBYYHsICBBAhGBWYAwCSBwUyMy4xN6AHz-MBsgcFMjIuMTe4B8UdwgcJMi4xOC4xOS4xyAd0gAgB&sclient=gws-wiz-serp',1,'2026-01-22 15:46:58');
INSERT INTO `trd_general_enlaces` VALUES (9,121,'http://192.168.0.169/Transformacion',1,'2026-02-02 12:11:08');
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
INSERT INTO `trd_general_eventos_codigos` VALUES ('CREATE','Creación de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('DB_ERROR','Error de base de datos','error','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('DELETE','Eliminación de registro','warning','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('LOGIN_FAILED','Intento de inicio de sesión fallido','warning','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('LOGIN_SUCCESS','Inicio de sesión exitoso','info','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('LOGOUT','Cierre de sesión','info','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('SYS_ERROR','Error del sistema','error','2026-02-03 14:19:23','2026-02-03 14:19:23');
INSERT INTO `trd_general_eventos_codigos` VALUES ('UPDATE','Actualización de registro','info','2026-02-03 14:19:23','2026-02-03 14:19:23');
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
  `log_evento_codigo` varchar(50) DEFAULT NULL COMMENT 'Reference to known event code',
  `log_tipo` enum('info','warning','error','critical') DEFAULT 'info' COMMENT 'Event type/severity (can override default)',
  `log_severidad` varchar(50) DEFAULT NULL COMMENT 'Additional severity descriptor if needed (e.g. Alto, Medio)',
  `log_modulo` varchar(100) DEFAULT NULL COMMENT 'System module (e.g. Patentes, Organizaciones)',
  `log_usuario_id` int(11) DEFAULT NULL COMMENT 'User responsible for the action',
  `log_accion` varchar(100) DEFAULT NULL COMMENT 'Short action name',
  `log_descripcion` text DEFAULT NULL COMMENT 'Detailed description',
  `log_detalles` text DEFAULT NULL COMMENT 'Technical details, stack trace, or JSON data',
  `log_ip` varchar(45) DEFAULT NULL COMMENT 'IP Address',
  `log_resultado` varchar(50) DEFAULT NULL COMMENT 'Outcome of the operation',
  PRIMARY KEY (`log_id`),
  KEY `log_usuario_id` (`log_usuario_id`),
  KEY `log_evento_codigo` (`log_evento_codigo`),
  KEY `log_fecha` (`log_fecha`),
  KEY `log_modulo` (`log_modulo`),
  CONSTRAINT `fk_logs_evento` FOREIGN KEY (`log_evento_codigo`) REFERENCES `trd_general_eventos_codigos` (`evt_codigo`) ON DELETE SET NULL,
  CONSTRAINT `fk_logs_usuario` FOREIGN KEY (`log_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Registro de logs y auditoria del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_logs`
--

LOCK TABLES `trd_general_logs` WRITE;
/*!40000 ALTER TABLE `trd_general_logs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_logs` VALUES (1,'2026-02-03 14:26:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (2,'2026-02-03 14:37:28','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (3,'2026-02-03 14:38:47','LOGIN_SUCCESS','info','Bajo','Autenticación',2,'LOGIN','Usuario leticia.meneses@munivina.cl inició sesión correctamente','{\"email\":\"leticia.meneses@munivina.cl\",\"ip\":\"192.168.0.168\"}','192.168.0.168','Exitoso');
INSERT INTO `trd_general_logs` VALUES (4,'2026-02-03 15:00:10','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (5,'2026-02-03 15:16:54','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (6,'2026-02-03 15:17:06','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (7,'2026-02-03 15:22:22','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (8,'2026-02-03 16:38:32','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 80','{\"data\":{\"sol_nombre_expediente\":\"prueba php\",\"sol_ingreso_desve\":\"--php\",\"sol_reingreso_id\":\"57\",\"sol_origen_id\":\"5\",\"sol_origen_texto\":\"Juan fg Hervas\",\"sol_detalle\":\"ingreso php\",\"sol_fecha_recepcion\":\"2026-02-03 00:00:00\",\"sol_prioridad_id\":\"3\",\"sol_sector_id\":\"3\",\"sol_fecha_vencimiento\":\"2026-02-16 00:00:00\",\"sol_observaciones\":\"1234\",\"sol_responsable\":null,\"sol_origen_esp\":1,\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"Leticia meneses\"}],\"ACCION\":\"CREAR\"}}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (9,'2026-02-03 16:43:34','CREATE','info','Bajo','DESVE',1,'CREAR_SOLICITUD','Creación de solicitud DESVE: 82','{\"data\":{\"sol_nombre_expediente\":\"prueba php2\",\"sol_ingreso_desve\":\"--php2\",\"sol_reingreso_id\":\"80\",\"sol_origen_id\":\"5\",\"sol_origen_texto\":\"Juan fg Hervas\",\"sol_detalle\":\"2\",\"sol_fecha_recepcion\":\"2026-02-03 00:00:00\",\"sol_prioridad_id\":\"3\",\"sol_sector_id\":\"14\",\"sol_fecha_vencimiento\":\"2026-02-16 00:00:00\",\"sol_observaciones\":\"2\",\"sol_responsable\":null,\"sol_origen_esp\":1,\"destinos\":[{\"usr_id\":\"2\",\"usr_nombre_completo\":\"Leticia meneses\"}],\"documentos\":[{\"nombre\":\"6. Sistema Permisos Precarios Municipales.pdf\"}],\"ACCION\":\"CREAR\"}}','::1','Exitoso');
INSERT INTO `trd_general_logs` VALUES (10,'2026-02-03 17:08:21','LOGIN_SUCCESS','info','Bajo','Autenticación',1,'LOGIN','Usuario juan.hervas@munivina.cl inició sesión correctamente','{\"email\":\"juan.hervas@munivina.cl\",\"ip\":\"::1\"}','::1','Exitoso');
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
INSERT INTO `trd_general_multiancestro` VALUES (1,86,101);
INSERT INTO `trd_general_multiancestro` VALUES (2,100,86);
INSERT INTO `trd_general_multiancestro` VALUES (3,104,120);
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
INSERT INTO `trd_general_organizaciones` VALUES (1,'Juanta de Vecinos #1',2,NULL,NULL,NULL,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
INSERT INTO `trd_general_organizaciones_comunitarias` VALUES (1,'11.111.111-1','Organizacion de pueba 1','sdfsdf','aadsf43','2026-01-26 11:44:00','2036-01-26',3,'25',2);
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
  KEY `trd_general_registro_general_tramites_SK` (`rgt_tramite_padre`),
  CONSTRAINT `trd_general_registro_general_tramites_SK` FOREIGN KEY (`rgt_tramite_padre`) REFERENCES `trd_general_registro_general_tramites` (`rgt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_general_registro_general_tramites`
--

LOCK TABLES `trd_general_registro_general_tramites` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_general_registro_general_tramites` VALUES (80,'03251c0aa1c601548feddbab21348fd4b0f66201472a0d2bf919cf433c1ee244','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (82,'f2fe233a4a0dd2a6306d44ff9f3cc945373f18d27bf963fff19a9e74fe37dfa6','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (83,'02cf5e73c1bd5f613fca6363f23daa0fc0e0407679ca64fc9a4759f8924ed106','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (84,'41fd8ba88d315ab5f5b3eea03bc39b2fa31c30a16fc6d8ffd77f794369a0e219','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (85,'269083ccc574176afa9e01be76ecb6256a2a78665a4566dd0d3145fb99680551','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (86,'5e32afd23a4063e93e4ac0888055038bc0b96ba5c7f09cf7d8131ec144563bc6','Ingreso_ingresos',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (96,'9be1ab57f069a6a8458dc0d6440bfd910903ffbc18101bbee208ccddbb536025','desve_solicitud',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (97,'07910eaa3158da71ee6383840ae4e5208328f7cd8f5f71c3dc487b801da340e3','desve_solicitud',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (98,'61f18235300737b5b9bcd8b7d17c4a3dd2970d83acafb51cd241f42e183e4932','desve_solicitud',NULL,2);
INSERT INTO `trd_general_registro_general_tramites` VALUES (99,'f0f155a9ddd8f23f3cd3ef30ae72c15096f131d0feab5d1a2e7374a6a9b49f86','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (100,'9bea1f1ebe432f84c6c7dfc36d6b0f937515966ce0f25b627a6d4c55d69dd98e','Ingreso_ingresos',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (101,'4d982af3a36877ebd265254ad91577cf7d64efe5fd6bbc2da270fdba09ac94c9','Ingreso_ingresos',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (102,'079ac139684253c74b36f8fadfe90f18cc84785c33a4e0768fc599b1f2d7fcaa','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (103,'d0cd0fc7887a003ae4868a88745f74d02e17bacfcda1d0318a7f04af7c792641','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (104,'8bfea3221d337621ce4e1be1168a1a852afb60f3cbb95017321ccb6693fbf1fb','Ingreso_ingresos',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (110,'260126-1932-desve_solicitud-bD','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (111,'260127-1248-desve_solicitud-yM','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (112,'260127-1351-desve_solicitud-H6','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (113,'260127-1638-desve_solicitud-DF','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (114,'260128-1849-desve_solicitud-1E','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (115,'260128-1911-desve_solicitud-dS','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (116,'260128-1935-desve_solicitud-uV','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (117,'260128-1955-desve_solicitud-5Q','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (118,'260128-2020-desve_solicitud-1J','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (119,'260129-2020-Ingreso_ingresos-Ur','Ingreso_ingresos',NULL,3);
INSERT INTO `trd_general_registro_general_tramites` VALUES (120,'260129-2021-Ingreso_ingresos-K9','Ingreso_ingresos',NULL,3);
INSERT INTO `trd_general_registro_general_tramites` VALUES (121,'260202-1611-Ingreso_ingresos-R7','Ingreso_ingresos',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (122,'260203-1430-desve_solicitud-3X','desve_solicitud',NULL,3);
INSERT INTO `trd_general_registro_general_tramites` VALUES (123,'260203-2020-desve_solicitud-0W','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (124,'260203-2028-desve_solicitud-Qv','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (125,'260203-2034-desve_solicitud-HF','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (126,'260203-2034-desve_solicitud-9d','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (127,'260203-2038-desve_solicitud-MO','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (128,'260203-2042-desve_solicitud-0h','desve_solicitud',NULL,1);
INSERT INTO `trd_general_registro_general_tramites` VALUES (129,'260203-2043-desve_solicitud-EH','desve_solicitud',NULL,1);
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
INSERT INTO `trd_general_sectores` VALUES (1,'ACHUPALLAS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (2,'CHORRILLOS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (3,'FORESTAL',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (4,'GÓMEZ CARREÑO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (5,'GRANADILLAS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (6,'JARDÍN BOTÁNICO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (7,'MIRAFLORES',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (8,'NAVAL',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (9,'NUEVA AURORA',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (10,'PALMARES',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (11,'PLAN',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (12,'RECREO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (13,'REÑACA',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (14,'REÑACA ALTO',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (15,'SANTA INÉS',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_sectores` VALUES (16,'VIÑA ORIENTE',0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
INSERT INTO `trd_general_tipos_organizacion` VALUES (1,'Organización Territorial',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (2,'Organización Funcional',2,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (3,'Particular',3,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (4,'Concejales',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (5,'Ley de Transparencia',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (6,'Contraloría General',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
INSERT INTO `trd_general_tipos_organizacion` VALUES (7,'Congreso Nacional',1,0,'2025-12-29 12:53:09','2025-12-29 12:53:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trd_ingresos_destinos` VALUES (22,21,1,'Para','Firmante',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (23,21,2,'Para','Visador',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (24,21,3,'Para','Firmante',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (28,23,1,'Para','Firmante',1,1,'2026-01-22 14:53:09');
INSERT INTO `trd_ingresos_destinos` VALUES (29,23,2,'Para','Consultor',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (30,23,3,'Para','Consultor',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (31,24,1,'Para','Visador',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (32,24,2,'Para','Visador',0,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (33,25,1,'Para','Visador',0,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (34,25,2,'Para','Visador',0,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (35,25,3,'Para','Consultor',0,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (36,26,1,'Para','Consultor',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (38,27,1,'Para','Visador',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (39,28,2,'Para','Firmante',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (40,28,2,'Para','Firmante',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (41,30,2,'Para','Visador',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (42,30,3,'Para','Firmante',1,NULL,NULL);
INSERT INTO `trd_ingresos_destinos` VALUES (43,33,3,'Para','Firmante',1,NULL,NULL);
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
INSERT INTO `trd_ingresos_solicitudes` VALUES (21,1,'prueba ingreso de ingreso 001','Prueba 001\ningreso completo','Ingresado',2,NULL,'2026-01-22 00:00:00',80);
INSERT INTO `trd_ingresos_solicitudes` VALUES (23,1,'prueba ingreso de ingreso 002','prueba 2, ingresar muchos documentos','Ingresado',2,'sdfg','2026-01-22 00:00:00',82);
INSERT INTO `trd_ingresos_solicitudes` VALUES (24,1,'prueba ingreso de ingreso 003','crear solicitud sin enlaces','Ingresado',2,NULL,'2026-01-22 00:00:00',83);
INSERT INTO `trd_ingresos_solicitudes` VALUES (25,1,'prueba ingreso de ingreso 004','crea solicitud sin documentos','Ingresado',2,NULL,'2026-01-22 00:00:00',84);
INSERT INTO `trd_ingresos_solicitudes` VALUES (26,2,'prueba ingreso de ingreso 005','crear solicitud sin tipo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',85);
INSERT INTO `trd_ingresos_solicitudes` VALUES (27,1,'prueba ingreso de ingreso 007','solicitud sin titulo no se puede','Ingresado',2,NULL,'2026-01-22 00:00:00',86);
INSERT INTO `trd_ingresos_solicitudes` VALUES (28,1,'prueba ingreso de ingreso 010','prueba','Ingresado',1,NULL,'2026-01-22 00:00:00',100);
INSERT INTO `trd_ingresos_solicitudes` VALUES (29,1,'prueba grafico 001','1234','Ingresado',1,NULL,'2026-01-22 00:00:00',101);
INSERT INTO `trd_ingresos_solicitudes` VALUES (30,1,'dia libre','queremos un dìa libre para ramòn, para estar en paz','Ingresado',1,NULL,'2026-01-22 00:00:00',104);
INSERT INTO `trd_ingresos_solicitudes` VALUES (31,1,'prueba flujo especial 001','sdf','Ingresado',3,NULL,'2026-01-29 00:00:00',119);
INSERT INTO `trd_ingresos_solicitudes` VALUES (32,1,'prueba flujo especial 002','asd','Ingresado',3,NULL,'2026-01-29 00:00:00',120);
INSERT INTO `trd_ingresos_solicitudes` VALUES (33,1,'Revisar sistemas ingresos','Se necesita revisare sistema ingresos del SMU para verificar funcionalidad completa ','Ingresado',1,NULL,'2026-02-02 00:00:00',121);
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
INSERT INTO `trd_ingresos_tipos_ingreso` VALUES (1,'Administrativo');
INSERT INTO `trd_ingresos_tipos_ingreso` VALUES (2,'Municipal');
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

-- Dump completed on 2026-02-05 16:15:32
