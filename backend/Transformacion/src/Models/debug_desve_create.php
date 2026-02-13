<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

try {
    $stmt = $db->query("SHOW CREATE TABLE trd_desve_solicitudes");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['Create Table'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>