<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Config\Database;
use App\Controllers\general_contribuyentecontroller;

$database = new Database();
$db = $database->getConnection();
$controller = new general_contribuyentecontroller($db);

$response = $controller->getAll();
echo json_encode($response);
?>