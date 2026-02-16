<?php
require_once 'cors.php';

require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\EscolaridadController;

$database = new Database();
$db = $database->getConnection();

$controller = new EscolaridadController($db);

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

$action = $data['ACCION'] ?? '';

switch ($action) {
    case 'CONSULTAM':
        echo json_encode($controller->getAll());
        break;

    case 'CREAR':
        echo json_encode($controller->create($data));
        break;

    case 'ACTUALIZAR':
        $id = $data['esc_id'] ?? null;
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID missing"]);
        } else {
            echo json_encode($controller->update($id, $data));
        }
        break;

    case 'BORRAR':
        $id = $data['esc_id'] ?? null;
        if (!$id) {
            echo json_encode(["status" => "error", "message" => "ID missing"]);
        } else {
            echo json_encode($controller->delete($id));
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Action not allowed"]);
        break;
}
