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
require_once '../src/Models/Tarea.php';
require_once '../api/cors.php'; // Decodes $data automatically

use App\Config\Database;
use App\Models\Tarea;

$database = new Database();
$db = $database->getConnection();
$tarea = new Tarea($db);

$accion = $data['ACCION'] ?? '';

switch ($accion) {
    case 'CREAR':

        // Use session user if available, fallback to provided user
        $usuario_id = $_SESSION['user_id'] ?? $data['gco_usuario'] ?? null;

        $saveData = [
            'tar_titulo' => $data['tar_titulo'],
            'usr_id' => $data['usr_id'],
            'tar_detalle' => $data['tar_detalle'],
            'tar_plazo' => $data['tar_plazo'],
        ];

        if ($tarea->create($saveData, $usuario_id)) {
            echo json_encode(["success" => true, "message" => "Tarea guardada"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo guardar la tarea"]);
        }
        break;

    case 'BUSCAR':
        // Use session user if available, fallback to provided user
        $usuario_id = $_SESSION['user_id'] ?? $data['gco_usuario'] ?? null;
        $lista = $tarea->buscar($usuario_id);
        echo json_encode([
            "status" => "success",
            "data" => $lista
        ]);
        break;
    case 'LISTAR':
        // Use session user if available, fallback to provided user
        $usuario_id = $_SESSION['user_id'] ?? $data['gco_usuario'] ?? null;
        $lista = $tarea->listar($usuario_id);
        echo json_encode([
            "status" => "success",
            "data" => $lista
        ]);
        break;
    case 'TERMINAR':
        $lista = $tarea->terminar($data);
        if ($lista) {
            echo json_encode(["success" => true, "message" => "Tarea terminada correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo terminar la tarea"]);
        }
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
