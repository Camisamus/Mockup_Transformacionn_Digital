<?php
require_once '../general/cors.php';

// API Endpoint: Respuestas
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\DESVE_RespuestaController;
use App\Helpers\Encode;

$database = new Database();
$db = $database->getConnection();

$controller = new DESVE_RespuestaController($db);

$encoder = new Encode();
if (isset($data['sol_id']) && is_string($data['sol_id']) && strpos($data['sol_id'], 'L$U') === 0) {
    $data['sol_id'] = $encoder->descifrar($data['sol_id']);
}
if (isset($data['res_id']) && is_string($data['res_id']) && strpos($data['res_id'], 'L$U') === 0) {
    $data['res_id'] = $encoder->descifrar($data['res_id']);
}

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