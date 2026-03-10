<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Conteo de funcionarios por area y ofa_p:\n";
    $query = "SELECT ofa_area, a.tga_nombre, ofa_p, COUNT(*) as total 
              FROM trd_oirs_funcionarios_areas fa
              JOIN trd_general_areas a ON fa.ofa_area = a.tga_id
              WHERE ofa_borrado = 0 OR ofa_borrado IS NULL
              GROUP BY ofa_area, ofa_p";
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
