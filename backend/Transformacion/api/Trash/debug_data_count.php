<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

echo "--- Conteo por Tipo de Organización ---\n";
$stmt = $db->query("SELECT org_tipo_id, COUNT(*) as count FROM trd_desve_organizaciones WHERE org_borrado = 0 GROUP BY org_tipo_id");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "TypeID: " . $row['org_tipo_id'] . " - Count: " . $row['count'] . "\n";
}
?>