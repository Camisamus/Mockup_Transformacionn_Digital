<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Tablas de Roles/Perfiles:\n";
    $tables = $db->query("SHOW TABLES LIKE '%acceso%'")->fetchAll(PDO::FETCH_COLUMN);
    print_r($tables);
    
    echo "\nTablas OIRS Rol:\n";
    $tablesOirs = $db->query("SHOW TABLES LIKE '%oirs_rol%'")->fetchAll(PDO::FETCH_COLUMN);
    print_r($tablesOirs);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
