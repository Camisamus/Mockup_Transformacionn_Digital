<?php
require_once 'cors.php';

require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\OrganizacionComunitariaControllerGeneral;

$database = new Database();
$db = $database->getConnection();

$controller = new OrganizacionComunitariaControllerGeneral($db);

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
        if ($data) {
            $response = $controller->create($data);
        } else {
            $response = ["status" => "error", "message" => "Entrada inválida"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR':
        if ($data && isset($data['orgc_id'])) {
            $id = $data['orgc_id'];
            $response = $controller->update($id, $data);
        } else {
            $response = ["status" => "error", "message" => "ID requerido"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if ($data && isset($data['orgc_id'])) {
            $id = $data['orgc_id'];
            $response = $controller->delete($id);
        } else {
            $response = ["status" => "error", "message" => "ID requerido"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
?>