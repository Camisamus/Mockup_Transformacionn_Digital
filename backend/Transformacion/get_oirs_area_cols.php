<?php
require 'src/Config/Database.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Estructura de tdr_oirs_funcionario_areas:\n";
    $cols = $db->query("DESCRIBE tdr_oirs_funcionario_areas")->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
} catch (Exception $e) {
    try {
        echo "Intentando oirs_funcionarios_area:\n";
        $cols = $db->query("DESCRIBE tdr_oirs_funcionarios_area")->fetchAll(PDO::FETCH_ASSOC);
        print_r($cols);
    } catch (Exception $e2) {
        echo "Error: " . $e2->getMessage();
    }
}
?>
