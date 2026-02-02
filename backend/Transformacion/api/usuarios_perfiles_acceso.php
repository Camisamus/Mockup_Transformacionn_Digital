<?php
require_once 'cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\UsuarioPerfilControllerAcceso;

$database = new Database();
$db = $database->getConnection();

$controller = new UsuarioPerfilControllerAcceso($db);

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
        if (isset($data['usp_usuario_id']) && isset($data['usp_perfil_id'])) {
            $response = $controller->update($data['usp_usuario_id'], $data['usp_perfil_id'], $data);
        } else {
            $response = ["status" => "error", "message" => "IDs de usuario y perfil requeridos"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if (isset($data['usp_usuario_id']) && isset($data['usp_perfil_id'])) {
            $response = $controller->delete($data['usp_usuario_id'], $data['usp_perfil_id']);
        } else {
            $response = ["status" => "error", "message" => "IDs de usuario y perfil requeridos"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
