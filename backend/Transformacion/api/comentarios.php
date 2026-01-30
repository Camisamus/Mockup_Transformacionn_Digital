<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../src/Config/Database.php';
require_once '../src/Models/Comentario.php';
require_once '../api/cors.php'; // Decodes $data automatically

use App\Config\Database;
use App\Models\Comentario;

$database = new Database();
$db = $database->getConnection();
$comentario = new Comentario($db);

$accion = $data['ACCION'] ?? '';

switch ($accion) {
    case 'CREAR':
        if (empty($data['rgt_id']) || empty($data['gco_texto'])) {
            echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
            break;
        }

        // Use session user if available, fallback to provided user
        $usuario_id = $_SESSION['user_id'] ?? $data['gco_usuario'] ?? null;

        $saveData = [
            'rgt_id' => $data['rgt_id'],
            'gco_texto' => $data['gco_texto'],
            'gco_usuario' => $usuario_id
        ];

        if ($comentario->create($saveData)) {
            echo json_encode(["status" => "success", "message" => "Comentario guardado"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo guardar el comentario"]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
