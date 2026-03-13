<?php
require_once '../general/cors.php';
require_once '../general/app_autoload.php';

$autoload = __DIR__ . '/../../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\DESECON_EmprendimientoController;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
    exit;
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Cuerpo JSON inválido o vacío'], JSON_UNESCAPED_UNICODE);
    exit;
}

$controller = new DESECON_EmprendimientoController($db);

// Determinamos la acción (por defecto asumo CREATE si no viene ACCION)
$accion = $data['ACCION'] ?? 'CREATE';

if ($accion === 'CREATE') {
    $result = $controller->create($data);
    if ($result['status'] === 'success') {
        http_response_code(201);
    } else {
        http_response_code(400);
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($accion === 'GET_BY_RUT') {
    $rut = $data['rut'] ?? '';
    $result = $controller->getByRut($rut);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida'], JSON_UNESCAPED_UNICODE);
exit;
