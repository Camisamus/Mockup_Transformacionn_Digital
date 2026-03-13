<?php
require_once '../general/cors.php';
require_once '../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\oirs_roloirscontroller;

$database = new Database();
$db = $database->getConnection();

$controller = new oirs_roloirscontroller($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['ACCION'])) {
    echo json_encode(["status" => "error", "message" => "No data received or Action not specified"]);
    exit;
}

switch ($data['ACCION']) {
    case 'CONSULTAM':
        $response = $controller->getAll();
        echo json_encode($response);
        break;

    case 'CREAR':
        $response = $controller->create($data);
        echo json_encode($response);
        break;

    case 'BORRAR':
        if (isset($data['ofa_funcionario']) && isset($data['ofa_area'])) {
            $response = $controller->delete($data['ofa_funcionario'], $data['ofa_area']);
        } else {
            $response = ["status" => "error", "message" => "IDs de funcionario y área requeridos"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
