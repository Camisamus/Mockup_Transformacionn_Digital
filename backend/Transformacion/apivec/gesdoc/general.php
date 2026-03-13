<?php
/**
 * API Proxy de Gestión Documental para Vecinos
 * Proporciona acceso controlado a gesdoc_controller usando la sesión de vecinos.
 */

require_once __DIR__ . '/../general/cors.php';
require_once __DIR__ . '/../general/app_autoload.php';

// Verificar sesión de vecino
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['vecino_id']) || $_SESSION['user_type'] !== 'vecino') {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Sesión no válida o expirada']);
    exit;
}

$autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Dependencies missing']);
    exit;
}
require_once $autoload;

use App\Controllers\gesdoc_controller;
use App\Config\Database;

// La cabecera JSON se enviará solo en las acciones que lo requieran

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
    exit;
}

$gesdocController = new gesdoc_controller($db);

// Obtener datos de la petición (JSON, POST o GET)
$input = file_get_contents("php://input");
$jsonData = json_decode($input, true) ?? [];
$data = array_merge($_GET, $_POST, $jsonData);
$files = $_FILES;

$accion = $data['ACCION'] ?? '';

switch ($accion) {
    case 'Subir':
        if (isset($files['archivos']) || isset($files['archivo'])) {
            $uploadedFiles = $files['archivos'] ?? $files['archivo'];
            $tramiteId = $data['tramite_id'] ?? null;
            $docPrivado = $data['doc_privado'] ?? 0;

            $requestData = [
                'tramite_id' => $tramiteId,
                'user_id' => $_SESSION['vecino_id'], // Forzado a id de vecino
                'doc_privado' => $docPrivado
            ];

            $resultado = $gesdocController->subirArchivo($uploadedFiles, $requestData);
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode($resultado);
        } else {
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode(["status" => "error", "message" => "No se recibieron archivos"]);
        }
        break;

    case 'Bajar':
        $docId = $data['doc_id'] ?? null;
        if ($docId) {
            if (is_numeric($docId)) {
                // El controlador maneja los headers y el exit de Gesdoc
                $gesdocController->bajarArchivo((int)$docId);
            } else {
                // Soporte para archivos Legacy (strings)
                // Sanitizar para evitar Directory Traversal
                $filename = basename($docId);
                $legacyPath = __DIR__ . '/../../recursos/uploads/desecon/' . $filename;

                if (file_exists($legacyPath)) {
                    $mimeType = mime_content_type($legacyPath) ?: 'application/octet-stream';
                    header('Content-Type: ' . $mimeType);
                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                    header('Content-Length: ' . filesize($legacyPath));
                    readfile($legacyPath);
                    exit;
                } else {
                    header("Content-Type: application/json; charset=UTF-8");
                    echo json_encode(["status" => "error", "message" => "Archivo legacy no encontrado: " . $filename]);
                }
            }
        } else {
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode(["status" => "error", "message" => "ID de documento requerido"]);
        }
        break;

    case 'BuscarporTramite':
        $tramiteId = $data['tramite_id'] ?? null;
        if ($tramiteId) {
            $resultado = $gesdocController->buscarPorTramite($tramiteId);
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode($resultado);
        } else {
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode(["status" => "error", "message" => "ID de trámite requerido"]);
        }
        break;

    default:
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Acción no permitida o no reconocida"]);
        break;
}
