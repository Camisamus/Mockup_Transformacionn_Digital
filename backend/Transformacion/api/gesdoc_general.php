<?php

require_once '../api/cors.php';
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\GesDocController;
use App\Config\Database;

$database = new Database();
$db = $database->getConnection();

$gesdocController = new GesDocController($db);

// Asumimos que $data viene de cors.php (decodificación de JSON)
$accion = $data['ACCION'] ?? $_POST['ACCION'] ?? '';

switch ($accion) {
    case 'Subir':
        // Handle file upload with encryption
        if (isset($_FILES['archivos']) || isset($_FILES['archivo'])) {
            // Support both 'archivos' (multiple) and 'archivo' (single)
            $files = $_FILES['archivos'] ?? $_FILES['archivo'];

            // Get tramite_id from request data
            $tramiteId = $data['tramite_id'] ?? $_POST['tramite_id'] ?? null;

            // Get user_id from session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $userId = $_SESSION['user_id'] ?? null;

            // Prepare data for controller
            $requestData = [
                'tramite_id' => $tramiteId,
                'user_id' => $userId
            ];

            $resultado = $gesdocController->subirArchivo($files, $requestData);
            echo json_encode($resultado);
        } else {
            echo json_encode(["status" => "error", "message" => "No se recibieron archivos"]);
        }
        break;

    case 'NuevaVersion':
        // TODO: Implementar lógica de nueva versión de documento
        echo json_encode(["status" => "pending", "message" => "Acción 'NuevaVersion' pendiente de implementación"]);
        break;

    case 'Bajar':
        // Handle file download with decryption (latest version)
        $docId = $data['doc_id'] ?? $_POST['doc_id'] ?? null;

        if ($docId) {
            // This function contains headers and exit
            $gesdocController->bajarArchivo($docId);
        } else {
            echo json_encode(["status" => "error", "message" => "ID de documento requerido"]);
        }
        break;

    case 'BuscarporTramite':
        $tramiteId = $data['tramite_id'] ?? $_POST['tramite_id'] ?? null;

        if ($tramiteId) {
            $resultado = $gesdocController->buscarPorTramite($tramiteId);
            echo json_encode($resultado);
        } else {
            echo json_encode(["status" => "error", "message" => "ID de trámite requerido"]);
        }
        break;

    case 'ListarVersiones':
        // TODO: Implementar lógica de listado de versiones
        echo json_encode(["status" => "pending", "message" => "Acción 'ListarVersiones' pendiente de implementación"]);
        break;

    // ⚠️ WARNING: DESTRUCTIVE OPERATION
    // This permanently deletes files from server and database
    // DO NOT USE IN OTHER WORKFLOWS
    case 'Borrar':
        $docId = $data['doc_id'] ?? $_POST['doc_id'] ?? null;

        if ($docId) {
            $resultado = $gesdocController->borrarArchivo($docId);
            echo json_encode($resultado);
        } else {
            echo json_encode(["status" => "error", "message" => "ID de documento requerido"]);
        }
        break;

    case 'ValidarDocumento':
        // TODO: Implementar lógica de validación de documento
        echo json_encode(["status" => "pending", "message" => "Acción 'ValidarDocumento' pendiente de implementación"]);
        break;

    case 'ConsultarMetadata':
        // TODO: Implementar lógica de consulta de metadata
        echo json_encode(["status" => "pending", "message" => "Acción 'ConsultarMetadata' pendiente de implementación"]);
        break;

    case 'ListarDocumentosCarpeta':
        // TODO: Implementar lógica de listado de documentos de carpeta
        echo json_encode(["status" => "pending", "message" => "Acción 'ListarDocumentosCarpeta' pendiente de implementación"]);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
