<?php
require_once 'cors.php';
require_once 'app_autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");

use App\Config\Database;
use App\Controllers\general_vecinosauthcontroller;

$database = new Database();
$db = $database->getConnection();

// 1. Verify Authentication for Vecinos
$authController = new general_vecinosauthcontroller($db);
if (!$authController->isAuthenticated()) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

// 2. Handle Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vecinoId = $_SESSION['vecino_id'] ?? null;

    if (!$vecinoId) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Sesión de vecino inválida"]);
        exit;
    }

    // Por ahora devolvemos un mock de la bandeja de vecinos
    // En el futuro, esto usará un controlador específico para trámites de vecinos
    $inbox = [
        [
            "id" => 101,
            "asunto" => "Solicitud de Luminaria",
            "origen" => "VECINOS",
            "fecha" => date('d/m/Y'),
            "fecha_limite" => date('d/m/Y', strtotime('+5 days')),
            "estado" => "Pendiente",
            "detalle" => "Solicitud ingresada por el portal de vecinos."
        ],
        [
            "id" => 102,
            "asunto" => "Consulta de Aseo",
            "origen" => "VECINOS",
            "fecha" => date('d/m/Y', strtotime('-1 day')),
            "fecha_limite" => date('d/m/Y', strtotime('+2 days')),
            "estado" => "En Progreso",
            "detalle" => "Consulta en revisión por el departamento correspondiente."
        ]
    ];

    echo json_encode([
        "status" => "success",
        "data" => $inbox
    ]);

} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
}
?>