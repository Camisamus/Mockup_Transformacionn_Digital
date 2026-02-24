<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Config\Database;
use App\Controllers\ContribuyenteControllerGeneral;

$database = new Database();
$db = $database->getConnection();
$controller = new ContribuyenteControllerGeneral($db);

$response = $controller->getAll();
echo json_encode($response);
?>