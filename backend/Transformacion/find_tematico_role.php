<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Buscando 'tematico' en roles:\n";
    $roles = $db->query("SELECT * FROM trd_acceso_roles WHERE prf_nombre LIKE '%tematico%' OR prf_nombre LIKE '%encargado%'")->fetchAll(PDO::FETCH_ASSOC);
    print_r($roles);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
