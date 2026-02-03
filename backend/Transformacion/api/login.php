<?php
require_once 'cors.php';


$autoload = __DIR__ . '/../vendor/autoload.php';


if (!file_exists($autoload)) {
    http_response_code(500);
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(['message' => 'Dependencies missing: run composer install']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\AuthController;

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

$authController = new AuthController($db);

if (!isset($data['email']) || !isset($data['ACCION']) || $data['ACCION'] !== "LOGIN") {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Email y ACCION LOGIN requeridos'
    ]);
    exit;
}

$result = $authController->loginByEmail($data['email']);

// Logging logic
require_once '../src/Models/SystemLog.php';
$logModel = new \App\Models\SystemLog($db);
$logData = [
    'evento' => $result['success'] ? 'LOGIN_SUCCESS' : 'LOGIN_FAILED',
    'tipo' => $result['success'] ? 'info' : 'warning',
    'severidad' => $result['success'] ? 'Bajo' : 'Medio',
    'modulo' => 'Autenticación',
    'usuario_id' => $result['success'] ? $result['user']['id'] : null,
    'accion' => 'LOGIN',
    'descripcion' => $result['success'] ? "Usuario {$data['email']} inició sesión correctamente" : "Fallo inicio de sesión para {$data['email']}: " . ($result['message'] ?? 'Razón desconocida'),
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
            'user' => $result['user']
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

// $result = $authController->login($data['usuario'], $data['password']);
// if ($result['success']) {
//     http_response_code(200);
//     // DEBUG: Add session info to response
//     $result['debug_session_id'] = session_id();
//     $result['debug_session_data'] = $_SESSION;
// } else {
//     http_response_code(401);
// }

// echo json_encode($result);

