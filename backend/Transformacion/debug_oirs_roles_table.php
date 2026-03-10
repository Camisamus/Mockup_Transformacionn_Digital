<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Estructura de trd_oirs_funcionarios_areas:\n";
    $cols = $db->query("DESCRIBE trd_oirs_funcionarios_areas")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
    
    echo "\nDatos de la tabla (primeros 10):\n";
    $data = $db->query("SELECT * FROM trd_oirs_funcionarios_areas LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
