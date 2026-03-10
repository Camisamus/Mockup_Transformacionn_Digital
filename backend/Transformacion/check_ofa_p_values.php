<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Valores distintos de ofa_p:\n";
    $query = "SELECT DISTINCT ofa_p FROM trd_oirs_funcionarios_areas";
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
