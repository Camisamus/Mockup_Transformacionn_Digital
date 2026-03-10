<?php
// Script de diagnóstico de tablas
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    $found = [];
    foreach ($tables as $table) {
        if (stripos($table, 'oirs') !== false || stripos($table, 'asignacion') !== false) {
            $found[] = $table;
        }
    }
    
    echo "Tablas encontradas:\n";
    print_r($found);
    
    foreach ($found as $table) {
        if (stripos($table, 'comentario') !== false) {
            echo "\nEstructura de $table:\n";
            $cols = $db->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
            print_r($cols);
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
