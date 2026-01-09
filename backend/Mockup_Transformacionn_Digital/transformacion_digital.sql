-- Database: transformacion_digital
CREATE DATABASE IF NOT EXISTS transformacion_digital;
USE transformacion_digital;

-- 1. Tablas del módulo Ingresos (Basadas en JSON)

CREATE TABLE IF NOT EXISTS ingresos_prioridades (
    ID_Prioridad INT PRIMARY KEY,
    Nombre_Prioridad VARCHAR(50),
    Tiempo_establecido INT,
    Estado BOOLEAN DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS ingresos_tipos_organizacion (
    ID_Tipo_de_organizacion INT PRIMARY KEY,
    Tipo_de_organizacion VARCHAR(100),
    Prioridad INT,
    FOREIGN KEY (Prioridad) REFERENCES ingresos_prioridades(ID_Prioridad)
);

CREATE TABLE IF NOT EXISTS ingresos_organizaciones (
    ID_Organizacion INT PRIMARY KEY,
    Nombre_organizacion VARCHAR(255),
    Tipo_organizacion INT,
    FOREIGN KEY (Tipo_organizacion) REFERENCES ingresos_tipos_organizacion(ID_Tipo_de_organizacion)
);

CREATE TABLE IF NOT EXISTS ingresos_sectores (
    ID_Sector INT PRIMARY KEY,
    Nombre_Sector VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS ingresos_funcionarios (
    ID_Funcionarios INT PRIMARY KEY,
    RUT VARCHAR(12),
    Nombre VARCHAR(255),
    Cargo VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS ingresos_solicitudes (
    ID_Solicitud INT PRIMARY KEY,
    Ingreso_Desve VARCHAR(50),
    Nombre_expediente VARCHAR(255),
    Origen_solicitud INT,
    Origen_solicitud_texto TEXT,
    Detalle_ingreso TEXT,
    Fecha_ultima_recepcion_Erwin DATETIME,
    Prioridad INT,
    Funcionario_Interno INT,
    Sector INT,
    Fecha_vecimiento DATETIME,
    Entrego_Coordinador BOOLEAN DEFAULT FALSE,
    Fecha_respuesta_coordinador DATETIME,
    Estado_de_entrega BOOLEAN DEFAULT FALSE,
    Dias_transcurridos_vencimiento INT,
    OBSERVACIONES TEXT,
    Dias_transcurridos INT,
    Reingreso INT NULL,
    FOREIGN KEY (Origen_solicitud) REFERENCES ingresos_organizaciones(ID_Organizacion),
    FOREIGN KEY (Prioridad) REFERENCES ingresos_prioridades(ID_Prioridad),
    FOREIGN KEY (Funcionario_Interno) REFERENCES ingresos_funcionarios(ID_Funcionarios),
    FOREIGN KEY (Sector) REFERENCES ingresos_sectores(ID_Sector),
    FOREIGN KEY (Reingreso) REFERENCES ingresos_solicitudes(ID_Solicitud)
);

CREATE TABLE IF NOT EXISTS ingresos_respuestas (
    ID_Respuesta INT PRIMARY KEY AUTO_INCREMENT,
    Solicitud_res INT,
    respuesta TEXT,
    Fecha_respuesta DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Solicitud_res) REFERENCES ingresos_solicitudes(ID_Solicitud)
);

CREATE TABLE IF NOT EXISTS ingresos_mails_enviados (
    ID_Mail INT PRIMARY KEY AUTO_INCREMENT,
    Solicitud_mail INT,
    Fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    Destinatario VARCHAR(255),
    Asunto VARCHAR(255),
    FOREIGN KEY (Solicitud_mail) REFERENCES ingresos_solicitudes(ID_Solicitud)
);

-- 2. Tablas de Control de Acceso (RBAC)

CREATE TABLE IF NOT EXISTS acceso_usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    rut VARCHAR(12) UNIQUE NOT NULL,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS acceso_perfiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_perfil VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS acceso_roles (
    id VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    enlace VARCHAR(255),
    tipo VARCHAR(50) -- Pagina, categoria, subcategoria
);

-- Tablas de Relación
CREATE TABLE IF NOT EXISTS acceso_perfiles_roles (
    perfil_id INT,
    rol_id VARCHAR(20),
    PRIMARY KEY (perfil_id, rol_id),
    FOREIGN KEY (perfil_id) REFERENCES acceso_perfiles(id),
    FOREIGN KEY (rol_id) REFERENCES acceso_roles(id)
);

CREATE TABLE IF NOT EXISTS acceso_usuarios_perfiles (
    usuario_id INT,
    perfil_id INT,
    PRIMARY KEY (usuario_id, perfil_id),
    FOREIGN KEY (usuario_id) REFERENCES acceso_usuarios(id),
    FOREIGN KEY (perfil_id) REFERENCES acceso_perfiles(id)
);

-- 3. Datos Iniciales para acceso_roles (Extraídos de menu_data.json)

INSERT INTO acceso_roles (id, nombre, enlace, tipo) VALUES
('0', 'Bandeja', 'paginas/Bandeja.html', 'Pagina'),
('1.c', 'Gestión de Empresas', 'paginas/contribuyente_empresas.html', 'Pagina'),
('1', 'Patentes', NULL, 'categoria'),
('1.1', 'Mis Solicitudes', 'paginas/patentes_mis_solicitudes.html', 'Pagina'),
('1.2', 'Pagos', 'paginas/pagos.html', 'Pagina'),
('1.3', 'Solicitud Única de Patentes', 'paginas/patentes_solicitud_unica.html', 'Pagina'),
('1.4', 'Consulta de Solicitud', 'paginas/patentes_consulta_solicitud.html', 'Pagina'),
('2', 'Organizaciones Comunitarias', NULL, 'categoria'),
('2.1', 'Organizaciones', NULL, 'subcategoria'),
('2.1.1', 'Consulta Organizacion', 'paginas/organizaciones_consulta_organizacion.html', 'Pagina'),
('2.1.2', 'Consulta Masiva Organizaciones', 'paginas/organizaciones_consulta_masiva.html', 'Pagina'),
('3', 'Subvenciones', NULL, 'categoria'),
('3.1', 'Subvenciones', NULL, 'subcategoria'),
('3.1.1', 'Consulta de Subvención', 'paginas/subvenciones_consulta_subvencion.html', 'Pagina'),
('3.1.2', 'Consulta Masiva de Subvenciones', 'paginas/subvenciones_consulta_masiva.html', 'Pagina'),
('3.1.7', 'Consulta Masiva de Pagos', 'paginas/subvenciones_consulta_masiva_pagos.html', 'Pagina'),
('4', 'Postulaciones', NULL, 'categoria'),
('4.1', 'Postulaciones', NULL, 'subcategoria'),
('4.1.1', 'Consulta de Postulación', 'paginas/postulaciones_consulta_postulacion.html', 'Pagina'),
('4.1.2', 'Consulta Masiva de Postulaciones', 'paginas/postulaciones_consulta_masiva.html', 'Pagina'),
('5', 'Atenciones', NULL, 'categoria'),
('5.1', 'Atenciones', NULL, 'subcategoria'),
('5.1.1', 'Consulta de Atención', 'paginas/atenciones_consulta_atencion.html', 'Pagina'),
('5.1.2', 'Lista de Espera', 'paginas/atenciones_lista_espera.html', 'Pagina'),
('5.1.3', 'Tomar Atención', 'paginas/atenciones_tomar_atencion.html', 'Pagina'),
('5.1.4', 'Listado de Atenciones', 'paginas/atenciones_listado_atenciones.html', 'Pagina'),
('6', 'Logs del Sistema', NULL, 'categoria'),
('6.1', 'Logs del Sistema', NULL, 'subcategoria'),
('6.1.1', 'Consulta de Log', 'paginas/logs_consulta_log.html', 'Pagina'),
('6.1.2', 'Listado de Logs', 'paginas/logs_listado_logs.html', 'Pagina'),
('7', 'Ingresos', NULL, 'categoria'),
('7.1', 'Ingreso de Ingresos', 'paginas/ingresos_ingreso_ingresos.html', 'Pagina'),
('7.2', 'Listado de Ingresos', 'paginas/ingresos_listado_ingresos.html', 'Pagina');
