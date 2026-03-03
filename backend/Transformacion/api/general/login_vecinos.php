<?php
require_once 'cors.php';

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

if (!isset($data['email']) || !isset($data['ACCION']) || $data['ACCION'] !== "LOGIN_VECINO") {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Email y ACCION LOGIN_VECINO requeridos'
    ]);
    exit;
}

$authController = new VecinosAuthController($db);
$result = $authController->loginByEmail($data['email']);

// Logging logic (opcional para vecinos, pero recomendado)
require_once '../../src/Models/SystemLog.php';
$logModel = new \App\Models\SystemLog($db);
$logData = [
    'evento' => $result['success'] ? 'LOGIN_VECINO_SUCCESS' : 'LOGIN_VECINO_FAILED',
    'tipo' => $result['success'] ? 'info' : 'warning',
    'severidad' => 'Bajo',
    'modulo' => 'Autenticación Vecinos',
    'usuario_id' => null, // O usar el ID del vecino si se prefiere mapear a logs de sistema
    'accion' => 'LOGIN_VECINO',
    'descripcion' => $result['success'] ? "Vecino {$data['email']} inició sesión" : "Fallo inicio de sesión para vecino {$data['email']}",
    'detalles' => json_encode(['email' => $data['email'], 'ip' => $_SERVER['REMOTE_ADDR']]),
    'ip' => $_SERVER['REMOTE_ADDR'],
    'resultado' => $result['success'] ? 'Exitoso' : 'Fallido'
];
$logModel->crear($logData);

if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Login exitoso',
        'data' => [
            'vecino' => $result['vecino']
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => $result['message']
    ]);
}
exit;
