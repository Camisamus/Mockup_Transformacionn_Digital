<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

echo "--- Columns in trd_desve_solicitudes ---\n";
try {
    $stmt = $db->query("DESCRIBE trd_desve_solicitudes");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>