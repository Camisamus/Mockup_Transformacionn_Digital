<?php
require_once 'apivec/general/app_autoload.php';
require_once 'vendor/autoload.php';
use App\Config\Database;
$db = (new Database())->getConnection();

try {
    $db->exec("ALTER TABLE trd_general_contribuyentes ADD COLUMN IF NOT EXISTS tgc_clave_acceso VARCHAR(255) DEFAULT NULL AFTER tgc_telefono_contacto");
    echo "Columna tgc_clave_acceso agregada o ya existía.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
