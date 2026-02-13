<?php
require_once 'cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\DESVE_SolicitudController;

$database = new Database();
$db = $database->getConnection();

$controller = new DESVE_SolicitudController($db);

$id = $data['sol_id'] ?? null;
$S = $data['S'] ?? null;

switch ($data['ACCION']) {
    case 'CONSULTAM':
        if ($id) {
            $response = $controller->getById($id);
        } else {
            if ($S == 'NL') {
                $response = $controller->getAllNL();
            } elseif ($S == 'HISTORIAL') {
                $response = $controller->getAllCompletedNL();
            } elseif ($S == 'REINGRESO') {
                $response = $controller->getAllForReingreso();
            } else {
                $response = $controller->getAll();
            }
        }
        echo json_encode($response);
        break;

    case 'CREAR':
        if ($data) {
            $response = $controller->create($data);

            // Log CREAR
            if (($response['status'] ?? '') === 'success') {
                require_once '../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $tempData = $data;
                if (isset($tempData['sol_documentos']) && is_array($tempData['sol_documentos'])) {
                    $tempData['sol_documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['sol_documentos']);
                }
                if (isset($tempData['documentos']) && is_array($tempData['documentos'])) {
                    $tempData['documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['documentos']);
                }
                $logModel->crear([
                    'evento' => 'CREATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'DESVE',
                    'usuario_id' => $data['sol_responsable'] ?? $_SESSION['user_id'] ?? null,
                    'accion' => 'CREAR_SOLICITUD',
                    'descripcion' => "Creación de solicitud DESVE: " . ($response['id'] ?? 'N/A'),
                    'detalles' => json_encode(['data' => $tempData]),
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'resultado' => 'Exitoso'
                ]);
            }
        } else {
            $response = ["status" => "error", "message" => "Invalid input"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR':
        if ($id && $data) {
            $response = $controller->update($id, $data);
            // Log ACTUALIZAR
            if (($response['status'] ?? '') === 'success') {
                require_once '../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $tempData = $data;
                if (isset($tempData['sol_documentos']) && is_array($tempData['sol_documentos'])) {
                    $tempData['sol_documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['sol_documentos']);
                }
                if (isset($tempData['documentos']) && is_array($tempData['documentos'])) {
                    $tempData['documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['documentos']);
                }
                $logModel->crear([
                    'evento' => 'UPDATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'DESVE',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'ACTUALIZAR_SOLICITUD',
                    'descripcion' => "Actualización de solicitud DESVE: $id",
                    'detalles' => json_encode(['id' => $id, 'cambios' => $tempData]),
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'resultado' => 'Exitoso'
                ]);
            }
        } else {
            $response = ["status" => "error", "message" => "ID and Data required for update"];
        }
        echo json_encode($response);
        break;

    case 'ACTUALIZAR_ESTADO':
        if ($id && isset($data['sol_estado_entrega'])) {
            // Simplified call - we can either update Controller or call Model directly if Controller is thin
            // For consistency, let's assume we might need a controller method or just use the model if it's simpler
            $solicitudModel = new \App\Models\DESVE_Solicitud($db);
            if ($solicitudModel->updateStatus($id, $data['sol_estado_entrega'], $data['sol_entrego_coordinador'] ?? false)) {
                $response = ["status" => "success", "message" => "Estado actualizado"];
            } else {
                $response = ["status" => "error", "message" => "Error al actualizar estado"];
            }
        } else {
            $response = ["status" => "error", "message" => "ID and Estado required"];
        }
        echo json_encode($response);
        break;

    case 'BORRAR':
        if ($id) {
            $response = $controller->delete($id);

            // Log BORRAR
            if (($response['status'] ?? '') === 'success') {
                require_once '../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $logModel->crear([
                    'evento' => 'DELETE',
                    'tipo' => 'warning',
                    'severidad' => 'Medio',
                    'modulo' => 'DESVE',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'BORRAR_SOLICITUD',
                    'descripcion' => "Eliminación de solicitud DESVE: $id",
                    'detalles' => json_encode(['id' => $id]),
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'resultado' => 'Exitoso'
                ]);
            }
        } else {
            $response = ["status" => "error", "message" => "ID required for delete"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Action not allowed"]);
        break;
}
?>