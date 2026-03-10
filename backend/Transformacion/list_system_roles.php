<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Lista de todos los roles (trd_acceso_roles):\n";
    $roles = $db->query("SELECT prf_id, prf_nombre FROM trd_acceso_roles WHERE prf_borrado = 0")->fetchAll(PDO::FETCH_ASSOC);
    print_r($roles);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
