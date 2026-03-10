<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Valores de ofa_p y conteo:\n";
    $query = "SELECT ofa_p, COUNT(*) as total FROM trd_oirs_funcionarios_areas GROUP BY ofa_p";
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
    
    echo "\nEjemplo de cada valor:\n";
    foreach ($data as $row) {
        $p = $row['ofa_p'];
        $example = $db->query("SELECT fa.*, u.usr_nombre FROM trd_oirs_funcionarios_areas fa JOIN trd_acceso_usuarios u ON fa.ofa_funcionario = u.usr_id WHERE ofa_p = $p LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        print_r($example);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
