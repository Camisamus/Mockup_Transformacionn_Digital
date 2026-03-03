<?php
require_once 'cors.php';
require_once 'app_autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");

use App\Config\Database;
use App\Controllers\VecinosAuthController;

$database = new Database();
$db = $database->getConnection();

// 1. Verify Authentication
$authController = new VecinosAuthController($db);
if (!$authController->isAuthenticated()) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$accion = $input['ACCION'] ?? '';

if ($accion === 'LISTAR') {
    // Mock de tareas asignadas por el vecino
    $tareas = [
        [
            "tar_id" => 501,
            "tar_titulo" => "Revisión de solicitud",
            "tar_asignado" => 1,
            "tar_creacion" => date('Y-m-d'),
            "tar_plazo" => date('Y-m-d', strtotime('+3 days')),
            "tar_estado" => 0,
            "tar_detalle" => "Revisar la solicitud de luminaria enviada."
        ]
    ];

    echo json_encode([
        "status" => "success",
        "data" => $tareas
    ]);
} else if ($accion === 'CREAR') {
    echo json_encode(["success" => true, "message" => "Tarea creada correctamente (Simulado)"]);
} else {
    echo json_encode(["status" => "error", "message" => "Acción no reconocida"]);
}
?>