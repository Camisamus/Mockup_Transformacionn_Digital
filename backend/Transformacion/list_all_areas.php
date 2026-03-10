<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Lista completa de areas:\n";
    $areas = $db->query("SELECT tga_id, tga_nombre, tga_codigo_area FROM trd_general_areas WHERE tga_borrado = 0")->fetchAll(PDO::FETCH_ASSOC);
    print_r($areas);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
