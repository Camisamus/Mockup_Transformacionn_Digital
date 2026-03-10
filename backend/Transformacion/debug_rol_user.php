<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Estructura de trd_acceso_rol_usuario:\n";
    $cols = $db->query("DESCRIBE trd_acceso_rol_usuario")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
