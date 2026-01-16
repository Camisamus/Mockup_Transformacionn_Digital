<?php
require_once 'cors.php';

// API Endpoint: Respuestas
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\DESVE_RespuestaController;

$database = new Database();
$db = $database->getConnection();

$controller = new DESVE_RespuestaController($db);

switch ($data['ACCION']) {
    case 'CREAR':
        if ($data) {
            $response = $controller->create($data);
        } else {
            $response = ["status" => "error", "message" => "Entrada inválida"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Acción no válida."]);
        break;
}
?>