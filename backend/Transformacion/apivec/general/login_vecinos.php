<?php
require_once 'cors.php';
require_once 'app_autoload.php';

$autoload = __DIR__ . '/../../vendor/autoload.php';

if (!file_exists($autoload)) {
    http_response_code(500);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(['message' => 'Dependencies missing: run composer install']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\VecinosAuthController;

header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error de conexión a la base de datos'
    ]);
    exit;
}

// Obtener datos del request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['ACCION']) || $data['ACCION'] !== "LOGIN_VECINO") {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'ACCION LOGIN_VECINO requerida'], JSON_UNESCAPED_UNICODE);
    exit;
}

$authController = new VecinosAuthController($db);

if (isset($data['rut']) && isset($data['password'])) {
    $result = $authController->loginByRut($data['rut'], $data['password']);
} else if (isset($data['email'])) {
    $result = $authController->loginByEmail($data['email']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Email o RUT/Password requeridos'], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Login exitoso',
        'data' => [
            'vecino' => $result['vecino']
        ]
    ], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => $result['message']
    ], JSON_UNESCAPED_UNICODE);
}
exit;
