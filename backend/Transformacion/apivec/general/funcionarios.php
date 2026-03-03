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

if ($accion === 'CONSULTAM') {
    // Listar funcionarios (para que los vecinos puedan ver a quién asignar o consultar)
    $query = "SELECT fnc_id, fnc_nombre, fnc_apellido, fnc_email FROM trd_acceso_usuarios WHERE fnc_borrado = 0 LIMIT 100";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "status" => "success",
        "data" => $funcionarios
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Acción no reconocida"]);
}
?>