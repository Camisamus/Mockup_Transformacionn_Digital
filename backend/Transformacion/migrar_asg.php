<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    // Añadir oia_estado si no existe
    $db->exec("ALTER TABLE trd_oirs_asignaciones ADD COLUMN IF NOT EXISTS oia_estado TINYINT(1) DEFAULT 0 AFTER oia_Instruccion");
    echo "Columna oia_estado añadida correctamente o ya existe.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
