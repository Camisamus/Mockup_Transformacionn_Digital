<?php
require_once __DIR__ . '/src/Config/Database.php';
use App\Config\Database;
$db = (new Database())->getConnection();
try {
    $db->query("SELECT 1 FROM trd_general_registro_general_expedientes LIMIT 1");
    echo "Tabla expedientes: OK<br>";
} catch (Exception $e) {
    echo "Tabla expedientes: ERROR - " . $e->getMessage() . "<br>";
}

try {
    $db->query("SELECT 1 FROM trd_general_registro_general_tramites LIMIT 1");
    echo "Tabla tramites: OK<br>";
} catch (Exception $e) {
    echo "Tabla tramites: ERROR - " . $e->getMessage() . "<br>";
}
?>
