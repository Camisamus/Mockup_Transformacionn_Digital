<?php
require_once '../general/cors.php';
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");

use App\Config\Database;
use App\Controllers\LicenciaTramiteController;

$database = new Database();
$db = $database->getConnection();

$controller = new LicenciaTramiteController($db);

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

if (!isset($data['ACCION'])) {
    echo json_encode(["status" => "error", "message" => "Acción no especificada"]);
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
        if (isset($data['tra_id'])) {
            $id = $data['tra_id'];
            $response = $controller->delete($id);
        } else {
            $response = ["status" => "error", "message" => "ID de trámite requerido"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Acción no reconocida"]);
        break;
}
?>