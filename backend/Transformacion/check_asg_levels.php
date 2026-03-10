<?php
require 'src/Config/Database.php';
require 'vendor/autoload.php';
use App\Config\Database;

try {
    $db = (new Database())->getConnection();
    echo "Valores de oia_nivel_asignacion:\n";
    $query = "SELECT oia_nivel_asignacion, COUNT(*) as total FROM trd_oirs_asignaciones GROUP BY oia_nivel_asignacion";
    $data = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    print_r($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
