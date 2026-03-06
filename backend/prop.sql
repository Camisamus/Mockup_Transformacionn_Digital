-- Perfil de Emprendedor
CREATE TABLE trd_de_emprendedores (
    dee_id INT AUTO_INCREMENT PRIMARY KEY,
    dee_contribuyente_id INT NOT NULL,
    dee_nombre_negocio VARCHAR(255),
    dee_rubro VARCHAR(100),
    dee_puntos_saldo INT DEFAULT 0,
    dee_estado ENUM('Activo', 'Suspendido', 'Inactivo') DEFAULT 'Activo',
    dee_nota_interna TEXT,
    dee_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    dee_borrado TINYINT DEFAULT 0
);

-- Convocatorias
CREATE TABLE trd_de_convocatorias (
    dec_id INT AUTO_INCREMENT PRIMARY KEY,
    dec_folio VARCHAR(50) UNIQUE,
    dec_titulo VARCHAR(255) NOT NULL,
    dec_tipo ENUM('Feria', 'Taller', 'Fondo', 'Capacitación'),
    dec_fecha_inicio DATE,
    dec_fecha_fin DATE,
    dec_estado ENUM('Borrador', 'Abierta', 'Cerrada', 'Finalizada') DEFAULT 'Borrador',
    dec_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    dec_borrado TINYINT DEFAULT 0
);

-- Postulaciones
CREATE TABLE trd_de_postulaciones (
    dep_id INT AUTO_INCREMENT PRIMARY KEY,
    dep_folio VARCHAR(50) UNIQUE,
    dep_convocatoria_id INT NOT NULL,
    dep_emprendedor_id INT NOT NULL,
    dep_estado ENUM('Ingresada', 'En Evaluación', 'Aprobada', 'Rechazada', 'Finalizada') DEFAULT 'Ingresada',
    dep_asistencia TINYINT DEFAULT NULL,
    dep_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    dep_borrado TINYINT DEFAULT 0
);

-- Tabla Maestro de Espacios
CREATE TABLE trd_de_espacios (
    des_id INT AUTO_INCREMENT PRIMARY KEY,
    des_nombre VARCHAR(200) NOT NULL,
    des_ubicacion VARCHAR(255),
    des_capacidad INT DEFAULT 0,
    des_tipo ENUM('Plaza', 'Parque', 'Auditorio') DEFAULT 'Sala',
    des_equipamiento TEXT,
    des_estado_actual ENUM('Disponible', 'Reservado', 'Ocupado', 'Mantenimiento') DEFAULT 'Disponible',
    des_es_reservable TINYINT DEFAULT 1,
    des_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    des_borrado TINYINT DEFAULT 0
);

-- Tabla de Reservas (Agenda)
CREATE TABLE trd_de_reservas (
    der_id INT AUTO_INCREMENT PRIMARY KEY,
    der_espacio_id INT NOT NULL,
    der_emprendedor_id INT NOT NULL,
    der_fecha DATE NOT NULL,
    der_hora_inicio TIME NOT NULL,
    der_hora_fin TIME NOT NULL,
    der_estado ENUM('Pendiente', 'Confirmada', 'Cancelada', 'Finalizada', 'No_Asistio') DEFAULT 'Pendiente',
    der_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reserva_espacio FOREIGN KEY (der_espacio_id) REFERENCES trd_de_espacios(des_id)
);


