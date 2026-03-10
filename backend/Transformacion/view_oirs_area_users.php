<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Usuarios en el area OIRS (id=2):\n";
    $query = "SELECT fa.*, u.usr_nombre, u.usr_apellido 
              FROM trd_oirs_funcionarios_areas fa
              JOIN trd_acceso_usuarios u ON fa.ofa_funcionario = u.usr_id
              WHERE ofa_area = 2 AND (ofa_borrado = 0 OR ofa_borrado IS NULL)";
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
