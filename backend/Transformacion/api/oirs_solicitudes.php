<?php
require_once 'cors.php';

// API Endpoint: OIRS Solicitudes
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\OirsSolicitudController;

$database = new Database();
$db = $database->getConnection();

$controller = new OirsSolicitudController($db);

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['ACCION'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Acción no especificada"]);
    exit;
}

switch ($data['ACCION']) {
    case 'CONSULTAM':
        $response = $controller->getAll();
        echo json_encode($response);
        break;

    case 'CONSULTA_ID':
        $response = $controller->getById($data['id'] ?? null);
        echo json_encode($response);
        break;

    case 'CREAR':
        $data = json_decode(file_get_contents("php://input"), true); // Re-decode to ensure consistency if needed, or just use $data
        $response = $controller->create($data);

        // Audit log (SystemLog)
        if (($response['status'] ?? '') === 'success') {
            require_once '../src/Models/SystemLog.php';
            $logModel = new \App\Models\SystemLog($db);

            // Clean data for logging (remove base64)
            $logData = $data;
            if (isset($logData['documentos'])) {
                $logData['documentos'] = array_map(function ($d) {
                    return ['nombre' => $d['nombre']];
                }, $logData['documentos']);
            }

            $logModel->crear([
                'evento' => 'CREATE',
                'tipo' => 'info',
                'severidad' => 'Medio',
                'modulo' => 'OIRS',
                'usuario_id' => $_SESSION['user_id'] ?? 1,
                'accion' => 'CREAR_OIRS',
                'descripcion' => "Creación de solicitud OIRS: " . ($response['id'] ?? 'N/A'),
                'detalles' => json_encode(['data' => $logData, 'response' => $response]),
                'ip' => $_SERVER['REMOTE_ADDR'],
                'resultado' => 'Exitoso'
            ]);
        }

        echo json_encode($response);
        break;

    case 'BUSCAR':
        $response = $controller->search($data);
        echo json_encode($response);
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
