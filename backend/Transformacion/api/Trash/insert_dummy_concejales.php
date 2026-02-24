<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

// Insert Dummy Concejales (Type 4)
$sql = "INSERT INTO trd_desve_organizaciones (org_nombre, org_tipo_id, org_borrado) VALUES 
('Concejal Juan Pérez', 4, 0),
('Concejal María González', 4, 0),
('Concejal Pedro Soto', 4, 0)";

try {
    $db->exec($sql);
    echo "Dummy Concejales inserted successfully.\n";
} catch (PDOException $e) {
    echo "Error inserting data: " . $e->getMessage() . "\n";
}
?>