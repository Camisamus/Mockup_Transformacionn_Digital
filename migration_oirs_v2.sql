-- SQL Migration for OIRS v2 Functionality

-- 1. Add contributor link to general procedures
ALTER TABLE `trd_general_registro_general_tramites` 
ADD COLUMN `rgt_contribuyente` INT(11) NULL AFTER `rgt_creador`,
ADD CONSTRAINT `trd_general_registro_general_tramites_contribuyente_FK` 
FOREIGN KEY (`rgt_contribuyente`) REFERENCES `trd_general_contribuyentes` (`tgc_id`);

-- 2. Expand contributor table for Juridical Persons and extra fields
ALTER TABLE `trd_general_contribuyentes`
ADD COLUMN `tgc_tipo` ENUM('natural', 'juridica') DEFAULT 'natural' AFTER `tgc_rut`,
ADD COLUMN `tgc_razon_social` VARCHAR(255) NULL AFTER `tgc_tipo`,
ADD COLUMN `tgc_nombre_fantasia` VARCHAR(255) NULL AFTER `tgc_razon_social`,
ADD COLUMN `tgc_giro` TEXT NULL AFTER `tgc_nombre_fantasia`,
ADD COLUMN `tgc_rep_rut` VARCHAR(15) NULL AFTER `tgc_giro`,
ADD COLUMN `tgc_rep_nombre_completo` VARCHAR(255) NULL AFTER `tgc_rep_rut`;

-- 3. Ensure lat/lng in oirs_solicitud (already exists but for verification)
-- DESCRIBE trd_oirs_solicitud;
