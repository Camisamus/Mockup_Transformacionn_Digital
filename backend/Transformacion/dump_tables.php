<?php
require 'src/Config/Database.php';
use App\Config\Database;
try {
    $db = (new Database())->getConnection();
    $cols1 = $db->query("DESCRIBE trd_oirs_funcionarios_areas")->fetchAll(PDO::FETCH_ASSOC);
    $cols2 = $db->query("DESCRIBE trd_acceso_roles")->fetchAll(PDO::FETCH_ASSOC);
    $data = "trd_oirs_funcionarios_areas:\n" . print_r($cols1, true) . "\ntrd_acceso_roles:\n" . print_r($cols2, true);
    file_put_contents('output.txt', $data);
} catch (Exception $e) {
    file_put_contents('output.txt', $e->getMessage());
}
?>
