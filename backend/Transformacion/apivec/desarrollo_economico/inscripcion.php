<?php
require_once '../general/cors.php';
require_once '../general/app_autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

$autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\desecon_emprendimientocontroller;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
    exit;
}

$controller = new desecon_emprendimientocontroller($db);

// Verificamos si es una petición con FormData o JSON simple
if (!empty($_POST['ACCION'])) {
    $data = $_POST;
    $files = $_FILES;
} else {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    $files = [];
}

if (!$data) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos o vacíos'], JSON_UNESCAPED_UNICODE);
    exit;
}

$accion = $data['ACCION'] ?? 'CREATE';

if ($accion === 'CREATE_FULL') {
    $result = $controller->createFull($data, $files);
    if ($result['status'] === 'success') {
        http_response_code(201);
    } else {
        http_response_code(400);
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($accion === 'UPDATE_FULL') {
    $result = $controller->updateFull($data, $files);
    if ($result['status'] === 'success') {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

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

if ($accion === 'GET_MY_RECORDS') {
    $rut = $_SESSION['vecino_rut'] ?? '';
    if (!$rut) {
        echo json_encode(['status' => 'error', 'message' => 'Sesión no válida'], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $result = $controller->getAllByRut($rut);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Acción no reconocida: ' . $accion], JSON_UNESCAPED_UNICODE);
exit;
