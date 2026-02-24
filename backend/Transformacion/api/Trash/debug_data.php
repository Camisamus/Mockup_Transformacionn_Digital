<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

echo "--- Tipos de Organización ---\n";
$stmt = $db->query("SELECT * FROM trd_general_tipos_organizacion");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $row['tor_id'] . " - Name: " . $row['tor_nombre'] . "\n";
}

echo "\n--- Organizaciones DESVE (Top 20) ---\n";
$stmt = $db->query("SELECT org_id, org_nombre, org_tipo_id FROM trd_desve_organizaciones LIMIT 20");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $row['org_id'] . " - Name: " . $row['org_nombre'] . " - TypeID: " . $row['org_tipo_id'] . "\n";
}
?>