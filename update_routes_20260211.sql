-- Script de actualización de rutas tras reorganización de carpetas
-- Fecha: 2026-02-11

-- 1. Actualizar todas las rutas de 'Funcionarios/' a 'Funcionarios/NO_Asignadas/' como base
UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'Funcionarios/', 'Funcionarios/NO_Asignadas/') 
WHERE rol_enlace LIKE 'Funcionarios/%';

-- 2. Refinar rutas para carpetas específicas basadas en el prefijo del archivo
-- DESVE
UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'NO_Asignadas/desve_', 'DESVE/desve_') 
WHERE rol_enlace LIKE 'Funcionarios/NO_Asignadas/desve_%';

-- INGRESOS
UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'NO_Asignadas/ingr_', 'INGRESOS/ingr_') 
WHERE rol_enlace LIKE 'Funcionarios/NO_Asignadas/ingr_%';

-- OIRS
UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'NO_Asignadas/oirs_', 'OIRS/oirs_') 
WHERE rol_enlace LIKE 'Funcionarios/NO_Asignadas/oirs_%';

-- SISADMIN / Logs
UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'NO_Asignadas/logs_', 'SISADMIN/logs_') 
WHERE rol_enlace LIKE 'Funcionarios/NO_Asignadas/logs_%';

UPDATE trd_acceso_roles 
SET rol_enlace = REPLACE(rol_enlace, 'NO_Asignadas/sisadmin_', 'SISADMIN/sisadmin_') 
WHERE rol_enlace LIKE 'Funcionarios/NO_Asignadas/sisadmin_%';

-- 3. Caso especial: Bandeja (está en la raíz de Funcionarios)
UPDATE trd_acceso_roles 
SET rol_enlace = 'Funcionarios/bandeja.php' 
WHERE rol_enlace IN ('Funcionarios/NO_Asignadas/Bandeja.php', 'Funcionarios/NO_Asignadas/bandeja.php');

UPDATE trd_acceso_roles 
SET rol_enlace = 'Funcionarios/bandeja_historial.php' 
WHERE rol_enlace IN ('Funcionarios/NO_Asignadas/bandeja_historial.php', 'Funcionarios/bandeja_historial.php');

-- Verificar cambios
SELECT rol_nombre, rol_enlace FROM trd_acceso_roles WHERE rol_enlace LIKE 'Funcionarios/%';
