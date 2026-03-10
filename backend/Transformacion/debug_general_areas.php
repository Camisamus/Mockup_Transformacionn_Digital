<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Estructura de trd_general_areas:\n";
    $cols = $db->query("DESCRIBE trd_general_areas")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
    
    echo "\nDatos de la tabla (primeros 5):\n";
    $data = $db->query("SELECT * FROM trd_general_areas LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
