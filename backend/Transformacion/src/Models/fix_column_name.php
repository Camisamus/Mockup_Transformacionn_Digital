<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$sql = "ALTER TABLE trd_desve_solicitudes CHANGE `sol_sector_id?` `sol_sector_id` int(11) DEFAULT NULL";

try {
    $db->exec($sql);
    echo "Column renamed successfully.\n";
} catch (PDOException $e) {
    echo "Error renaming column: " . $e->getMessage() . "\n";
}
?>