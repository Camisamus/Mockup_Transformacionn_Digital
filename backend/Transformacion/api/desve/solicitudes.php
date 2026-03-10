<?php
require_once '../general/cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\DESVE_SolicitudController;
use App\Helpers\Encode;

$database = new Database();
$db = $database->getConnection();

$controller = new DESVE_SolicitudController($db);
$encoder = new Encode();

// Función auxiliar para descifrar IDs si vienen cifrados y validar seguridad (ACCESO DIRECTO)
$descifrarSeguro = function ($valor, $campo = 'ID') {
    global $encoder;
    if (empty($valor))
        return $valor;

    if (is_string($valor) && strpos($valor, 'L$U') === 0) {
        return $encoder->descifrar($valor);
    }

    if (is_numeric($valor) || (is_string($valor) && ctype_digit($valor))) {
        http_response_code(403);
        echo json_encode(["status" => "error", "message" => "Acceso no autorizado: El $campo no es válido o no está cifrado para acceso directo."]);
        exit;
    }

    return $valor;
};

// Función para descifrado opcional (FILTROS DE BÚSQUEDA)
$descifrarSiAplica = function ($valor) use ($encoder) {
    if (empty($valor))
        return $valor;
    if (is_string($valor) && strpos($valor, 'L$U') === 0) {
        return $encoder->descifrar($valor);
    }
    return $valor;
};

if (isset($data['sol_id'])) {
    $data['sol_id'] = $descifrarSeguro($data['sol_id'], 'sol_id');
}
if (isset($data['id'])) {
    $data['id'] = $descifrarSeguro($data['id'], 'id');
}
if (isset($data['sol_reingreso_id'])) {
    $data['sol_reingreso_id'] = $descifrarSeguro($data['sol_reingreso_id'], 'sol_reingreso_id');
}

$id = $data['sol_id'] ?? $data['id'] ?? null;
$S = $data['S'] ?? null;

// Función para cifrar IDs en la respuesta
$cifrarRespuesta = function (&$item) use ($encoder) {
    if (!is_array($item))
        return;
    if (isset($item['sol_id'])) {
        $item['sol_id_raw'] = $item['sol_id'];
        $item['sol_id'] = $encoder->cifrar($item['sol_id']);
    }
    if (isset($item['id'])) {
        $item['id_raw'] = $item['id'];
        $item['id'] = $encoder->cifrar($item['id']);
    }
};

switch ($data['ACCION']) {
    case 'CONSULTAM':
        if ($id) {
            $response = $controller->getById($id);
        } else {
            if ($S == 'NL') {
                $response = $controller->getAllNL();
            } elseif ($S == 'HISTORIAL') {
                $response = $controller->getHistorial();
            } elseif ($S == 'TODOS') {
                $response = $controller->getTodos();
            } elseif ($S == 'REINGRESO') {
                $response = $controller->getAllForReingreso();
            } elseif ($S == 'PENDIENTES_DETAILED') {
                $response = $controller->getAllPendientesDetailed();
            } else {
                $response = $controller->getAll();
            }
        }
        break;

    case 'CREAR':
        if ($data) {
            $response = $controller->create($data);

            // Log CREAR
            if (($response['status'] ?? '') === 'success') {
                require_once __DIR__ . '/../../src/Models/SystemLog.php';
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
                    'usuario_id' => $data['sol_propietario'] ?? $_SESSION['user_id'] ?? null,
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
        break;

    case 'ACTUALIZAR':
        if ($id && $data) {
            $response = $controller->update($id, $data);
            // Log ACTUALIZAR
            if (($response['status'] ?? '') === 'success') {
                require_once __DIR__ . '/../../src/Models/SystemLog.php';
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
        break;

    default:
        http_response_code(400);
        $response = ["status" => "error", "message" => "Action not allowed"];
        break;
}

// Cifrar IDs en la respuesta
if (isset($response['data'])) {
    if (is_array($response['data'])) {
        if (isset($response['data'][0]) && is_array($response['data'][0])) {
            foreach ($response['data'] as &$item) {
                $cifrarRespuesta($item);
            }
        } else {
            $cifrarRespuesta($response['data']);
        }
    }
} else if ($response !== null) {
    $cifrarRespuesta($response);
}

if (isset($response['id'])) {
    $response['id'] = $encoder->cifrar($response['id']);
}
if (isset($response['sol_id'])) {
    $response['sol_id'] = $encoder->cifrar($response['sol_id']);
}

echo json_encode($response);
?>