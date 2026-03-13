<?php
require_once __DIR__ . '/cors.php';

// API Endpoint: Sectores
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\general_sectorcontroller;

$database = new Database();
$db = $database->getConnection();

$controller = new general_sectorcontroller($db);

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['ACCION'])) {
    echo json_encode(["status" => "error", "message" => "Acción no especificada"]);
    exit;
}

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