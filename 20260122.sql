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
-- Dumping data for table `trd_desve_mails_enviados`
--

LOCK TABLES `trd_desve_mails_enviados` WRITE;
/*!40000 ALTER TABLE `trd_desve_mails_enviados` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desve_mails_enviados` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_desve_respuestas`
--

LOCK TABLES `trd_desve_respuestas` WRITE;
/*!40000 ALTER TABLE `trd_desve_respuestas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_desve_respuestas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_general_areas`
--

LOCK TABLES `trd_general_areas` WRITE;
/*!40000 ALTER TABLE `trd_general_areas` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_areas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_general_bitacora`
--

LOCK TABLES `trd_general_bitacora` WRITE;
/*!40000 ALTER TABLE `trd_general_bitacora` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_bitacora` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_general_documento_adjunto`
--

LOCK TABLES `trd_general_documento_adjunto` WRITE;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_documento_adjunto` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_general_multiancestro`
--

LOCK TABLES `trd_general_multiancestro` WRITE;
/*!40000 ALTER TABLE `trd_general_multiancestro` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_multiancestro` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_general_registro_general_tramites`
--

LOCK TABLES `trd_general_registro_general_tramites` WRITE;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_general_registro_general_tramites` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
-- Dumping data for table `trd_ingresos_destinos`
--

LOCK TABLES `trd_ingresos_destinos` WRITE;
/*!40000 ALTER TABLE `trd_ingresos_destinos` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `trd_ingresos_destinos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-01-22  8:28:09
