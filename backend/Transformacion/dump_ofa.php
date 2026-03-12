<?php
require 'src/Config/Database.php';
use App\Config\Database;
try {
    $db = (new Database())->getConnection();
    $rows = $db->query("SELECT ofa_funcionario, ofa_p, ofa_rol FROM trd_oirs_funcionarios_areas LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    $data = print_r($rows, true);
    
    $roles = $db->query("SELECT prf_id, prf_nombre FROM trd_acceso_roles LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    $data .= "\nRoles:\n" . print_r($roles, true);
    
    file_put_contents('output_ofa.txt', $data);
} catch (Exception $e) {
    file_put_contents('output_ofa.txt', $e->getMessage());
}
?>
