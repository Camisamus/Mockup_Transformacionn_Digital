<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Todos los datos de trd_oirs_funcionarios_areas:\n";
    $data = $db->query("SELECT fa.*, u.usr_nombre, u.usr_apellido, a.tga_nombre 
                        FROM trd_oirs_funcionarios_areas fa
                        JOIN trd_acceso_usuarios u ON fa.ofa_funcionario = u.usr_id
                        JOIN trd_general_areas a ON fa.ofa_area = a.tga_id
                        WHERE ofa_borrado = 0 OR ofa_borrado IS NULL")->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
