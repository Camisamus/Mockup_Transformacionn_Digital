<?php
require_once 'cors.php';

// API Endpoint: Prioridades
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\PrioridadController;

$database = new Database();
$db = $database->getConnection();

$controller = new PrioridadController($db);

switch ($data['ACCION']) {
    case 'CONSULTAM':
        $response = $controller->getAll();
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
?>