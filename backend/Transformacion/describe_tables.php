<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

function describeTable($db, $table) {
    echo "\nTable: $table\n";
    $stmt = $db->query("DESCRIBE $table");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }
}

describeTable($db, 'trd_ingresos_solicitudes');
describeTable($db, 'trd_ingresos_registros');
describeTable($db, 'trd_ingresos_destinos');
