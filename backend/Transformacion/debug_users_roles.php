<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Estructura de trd_acceso_usuarios:\n";
    $cols = $db->query("DESCRIBE trd_acceso_usuarios")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
    
    echo "\nEstructura de trd_acceso_roles:\n";
    $colsRoles = $db->query("DESCRIBE trd_acceso_roles")->fetchAll(PDO::FETCH_ASSOC);
    print_r($colsRoles);
    
    echo "\nLista de roles:\n";
    $roles = $db->query("SELECT * FROM trd_acceso_roles")->fetchAll(PDO::FETCH_ASSOC);
    print_r($roles);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
