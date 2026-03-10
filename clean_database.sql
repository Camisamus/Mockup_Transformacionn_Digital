SET FOREIGN_KEY_CHECKS = 0;

-- Desarrollo Vecinal (DESVE)
TRUNCATE TABLE `trd_desve_destinos`;
TRUNCATE TABLE `trd_desve_respuestas`;
TRUNCATE TABLE `trd_desve_solicitudes`;

-- Documentos
TRUNCATE TABLE `trd_documentos_acceso`;
TRUNCATE TABLE `trd_documentos_carpeta`;
TRUNCATE TABLE `trd_documentos_flujo`;
TRUNCATE TABLE `trd_documentos_formvalue`;
TRUNCATE TABLE `trd_documentos_metadata`;

-- General y Sistema
TRUNCATE TABLE `trd_general_bitacora`;
TRUNCATE TABLE `trd_general_comentario`;
TRUNCATE TABLE `trd_general_documento_adjunto`;
TRUNCATE TABLE `trd_general_documento_adjunto_versiones`;
TRUNCATE TABLE `trd_general_enlaces`;
TRUNCATE TABLE `trd_general_logs`;
TRUNCATE TABLE `trd_general_mails_enviados`;
TRUNCATE TABLE `trd_general_multiancestro`;
TRUNCATE TABLE `trd_general_registro_general_expedientes`;
TRUNCATE TABLE `trd_general_registro_general_tramites`;

-- Ingresos
TRUNCATE TABLE `trd_ingresos_destinos`;
TRUNCATE TABLE `trd_ingresos_solicitudes`;

-- Licencias de Conducir
TRUNCATE TABLE `trd_licencias_horas_disponibles`;
TRUNCATE TABLE `trd_licencias_ruta_ticket`;
TRUNCATE TABLE `trd_licencias_ticket`;

-- OIRS
TRUNCATE TABLE `trd_oirs_asignaciones`;
TRUNCATE TABLE `trd_oirs_gestion`;
TRUNCATE TABLE `trd_oirs_solicitud`;

-- Otros
TRUNCATE TABLE `trd_tareas`;
TRUNCATE TABLE `trd_general_contribuyente_direcciones`;

SET FOREIGN_KEY_CHECKS = 1;
