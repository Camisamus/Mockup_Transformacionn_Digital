<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$stmt = $db->query("SELECT tis_estado, COUNT(*) as total FROM trd_ingresos_solicitudes GROUP BY tis_estado");
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($stats, JSON_PRETTY_PRINT);
?>
