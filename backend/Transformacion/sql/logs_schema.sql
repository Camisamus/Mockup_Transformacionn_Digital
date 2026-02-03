-- 
-- Table structure for table `trd_general_eventos_codigos`
--
DROP TABLE IF EXISTS `trd_general_eventos_codigos`;
CREATE TABLE `trd_general_eventos_codigos` (
  `evt_codigo` varchar(50) NOT NULL COMMENT 'Unique code for the event type (e.g. LOGIN_SUCCESS)',
  `evt_descripcion` varchar(255) NOT NULL COMMENT 'Human readable description of the event type',
  `evt_nivel_defecto` enum('info','warning','error','critical') DEFAULT 'info' COMMENT 'Default severity level',
  `evt_creacion` datetime DEFAULT current_timestamp(),
  `evt_actualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`evt_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catalogo de codigos de eventos del sistema';

--
-- Dumping data for table `trd_general_eventos_codigos`
-- (Ejemplos iniciales)
--
INSERT INTO `trd_general_eventos_codigos` (`evt_codigo`, `evt_descripcion`, `evt_nivel_defecto`) VALUES
('LOGIN_SUCCESS', 'Inicio de sesión exitoso', 'info'),
('LOGIN_FAILED', 'Intento de inicio de sesión fallido', 'warning'),
('LOGOUT', 'Cierre de sesión', 'info'),
('CREATE', 'Creación de registro', 'info'),
('UPDATE', 'Actualización de registro', 'info'),
('DELETE', 'Eliminación de registro', 'warning'),
('SYS_ERROR', 'Error del sistema', 'error'),
('DB_ERROR', 'Error de base de datos', 'error');

-- 
-- Table structure for table `trd_general_logs`
--
DROP TABLE IF EXISTS `trd_general_logs`;
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
  CONSTRAINT `fk_logs_usuario` FOREIGN KEY (`log_usuario_id`) REFERENCES `trd_acceso_usuarios` (`usr_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_logs_evento` FOREIGN KEY (`log_evento_codigo`) REFERENCES `trd_general_eventos_codigos` (`evt_codigo`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Registro de logs y auditoria del sistema';
