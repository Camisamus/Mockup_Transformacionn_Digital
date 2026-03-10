<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Buscando tablas de vinculo:\n";
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $cols = $db->query("DESCRIBE $table")->fetchAll(PDO::FETCH_COLUMN);
        $hasUser = false;
        $hasTematica = false;
        foreach ($cols as $col) {
            if (stripos($col, 'usr') !== false || stripos($col, 'usuario') !== false || stripos($col, 'fnc') !== false || stripos($col, 'funcionario') !== false) $hasUser = true;
            if (stripos($col, 'tematica') !== false || stripos($col, 'tem_') !== false) $hasTematica = true;
        }
        if ($hasUser && $hasTematica) {
            echo "Posible tabla encontrada: $table\n";
            print_r($cols);
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
