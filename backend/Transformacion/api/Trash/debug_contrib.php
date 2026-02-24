<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

echo "--- Contribuyentes Count ---\n";
$stmt = $db->query("SELECT COUNT(*) as count FROM trd_general_contribuyentes");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Total Records: " . $row['count'] . "\n";

echo "\n--- Top 5 Contribuyentes ---\n";
$stmt = $db->query("SELECT * FROM trd_general_contribuyentes LIMIT 5");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
?>