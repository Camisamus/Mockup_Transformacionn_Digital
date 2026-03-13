<?php
require_once '../general/cors.php';

require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\ingresos_tiposdeingresoscontroller;

$database = new Database();
$db = $database->getConnection();

$controller = new ingresos_tiposdeingresoscontroller($db);

$accion = $data['ACCION'] ?? '';

switch ($accion) {
    case 'CONSULTAM':
        $response = $controller->getAll();
        echo json_encode($response);
        break;

    case 'CONSULTA_ID':
        $id = $data['id'] ?? '';
        $response = $controller->getById($id);
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
?>