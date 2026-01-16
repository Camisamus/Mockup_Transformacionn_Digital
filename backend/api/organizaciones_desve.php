<?php
require_once 'cors.php';

// API Endpoint: Organizaciones
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\OrganizacionControllerDESVE;

$database = new Database();
$db = $database->getConnection();

$controllerDESVE = new OrganizacionControllerDESVE($db);

switch ($data['ACCION']) {
    case 'CONSULTAM':
        $response = $controllerDESVE->getAll();
        echo json_encode($response);
        break;

    case 'CREAR':
        if ($data) {
            $response = $controllerDESVE->create($data);
        } else {
            $response = ["status" => "error", "message" => "Entrada inválida"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR':
        if ($data && isset($data['org_id'])) {
            $id = $data['org_id'];
            $response = $controllerDESVE->update($id, $data);
        } else {
            $response = ["status" => "error", "message" => "ID de organización requerido"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if ($data && isset($data['org_id'])) {
            $id = $data['org_id'];
            $response = $controllerDESVE->delete($id);
        } else {
            $response = ["status" => "error", "message" => "ID de organización requerido"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Método no permitido"]);
        break;
}
?>