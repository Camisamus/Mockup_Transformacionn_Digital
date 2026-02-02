<?php
require_once 'cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\PerfilControllerAcceso;

$database = new Database();
$db = $database->getConnection();

$controller = new PerfilControllerAcceso($db);

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

    case 'ACTUALIZAR':
        if (isset($data['prf_id'])) {
            $response = $controller->update($data['prf_id'], $data);
        } else {
            $response = ["status" => "error", "message" => "ID de perfil requerido"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if (isset($data['prf_id'])) {
            $response = $controller->delete($data['prf_id']);
        } else {
            $response = ["status" => "error", "message" => "ID de perfil requerido"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
