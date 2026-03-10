<?php
require_once 'cors.php';
require_once 'app_autoload.php';

$autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Config\Database;
use App\Controllers\VecinosAuthController;

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

if (!isset($data['ACCION']) || $data['ACCION'] !== "REGISTRO_VECINO") {
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Acción no permitida',
        'recibido' => $data['ACCION'] ?? 'nulo'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Asegurar que la columna existe (Auto-migración simple para asegurar el requerimiento)
try {
    $db->exec("ALTER TABLE trd_general_contribuyentes ADD COLUMN IF NOT EXISTS tgc_clave_acceso VARCHAR(255) DEFAULT NULL AFTER tgc_telefono_contacto");
} catch (Exception $e) { /* Ignore if fails */ }

$authController = new VecinosAuthController($db);
$result = $authController->registerContribuyente([
    'tgc_rut' => $data['rut'] ?? '',
    'tgc_tipo' => $data['tipo'] ?? 'natural',
    'tgc_nombre' => $data['nombre'] ?? '',
    'tgc_apellido_paterno' => $data['paterno'] ?? '',
    'tgc_apellido_materno' => $data['materno'] ?? '',
    'tgc_correo_electronico' => $data['email'] ?? '',
    'tgc_telefono_contacto' => $data['telefono'] ?? '',
    'tgc_clave_acceso' => $data['password'] ?? '',
    'tgc_acepta_privacidad' => $data['privacidad'] ?? 1
]);

if ($result['success']) {
    http_response_code(200);
    echo json_encode(['status' => 'success', 'message' => $result['message']], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $result['message']], JSON_UNESCAPED_UNICODE);
}
exit;
