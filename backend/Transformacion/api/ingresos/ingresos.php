<?php
require_once '../general/cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\Ingresos_SolicitudControler;
use App\Helpers\Encode;

$database = new Database();
$db = $database->getConnection();

$controller = new Ingresos_SolicitudControler($db);
$encoder = new Encode();

// Función auxiliar para descifrar IDs si vienen cifrados y validar seguridad (ACCESO DIRECTO)
$descifrarSeguro = function ($valor, $campo = 'ID') {
    global $encoder;
    if (empty($valor))
        return $valor;

    if (is_string($valor) && strpos($valor, 'L$U') === 0) {
        return $encoder->descifrar($valor);
    }

    // Si es un número o una cadena numérica sin el prefijo L$U, es un intento de acceso no autorizado con ID real
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

// Descifrar IDs de ACCESO DIRECTO (Estricto)
if (isset($data['ing_id']))
    $data['ing_id'] = $descifrarSeguro($data['ing_id'], 'ing_id');
if (isset($data['id']))
    $data['id'] = $descifrarSeguro($data['id'], 'id');
if (isset($data['rgt_id']))
    $data['rgt_id'] = $descifrarSeguro($data['rgt_id'], 'rgt_id');

// Descifrar IDs de FILTRADO o VÍNCULOS (Flexible)
if (isset($data['tis_id']))
    $data['tis_id'] = $descifrarSiAplica($data['tis_id']);
if (isset($data['padre_id']))
    $data['padre_id'] = $descifrarSiAplica($data['padre_id']);
if (isset($data['hijo_id']))
    $data['hijo_id'] = $descifrarSiAplica($data['hijo_id']);

if (isset($data['rgt_ids']) && is_array($data['rgt_ids'])) {
    foreach ($data['rgt_ids'] as &$rid) {
        $rid = $descifrarSiAplica($rid);
    }
}

$id = $data['ing_id'] ?? $data['id'] ?? null;
$rgt_id = $data['rgt_id'] ?? null;

// Función para cifrar IDs en la respuesta
$cifrarRespuesta = function (&$item) use ($encoder) {
    if (!is_array($item))
        return;
    if (isset($item['tis_id'])) {
        $item['tis_id_raw'] = $item['tis_id'];
        $item['tis_id'] = $encoder->cifrar($item['tis_id']);
    }
    if (isset($item['rgt_id'])) {
        $item['rgt_id_raw'] = $item['rgt_id'];
        $item['rgt_id'] = $encoder->cifrar($item['rgt_id']);
    }
    if (isset($item['ing_id'])) {
        $item['ing_id_raw'] = $item['ing_id'];
        $item['ing_id'] = $encoder->cifrar($item['ing_id']);
    }
    if (isset($item['tis_registro_tramite'])) {
        $item['tis_registro_tramite_raw'] = $item['tis_registro_tramite'];
        // tis_registro_tramite NO se cifra aquí porque se usa como ID de vinculación interna 
        // y para el mapa vis.js que requiere IDs deterministas.
    }
    if (isset($item['padre_id'])) {
        $item['padre_id_raw'] = $item['padre_id'];
        $item['padre_id'] = $encoder->cifrar($item['padre_id']);
    }
    if (isset($item['hijo_id'])) {
        $item['hijo_id_raw'] = $item['hijo_id'];
        $item['hijo_id'] = $encoder->cifrar($item['hijo_id']);
    }

    if (isset($item['destinos']) && is_array($item['destinos'])) {
        foreach ($item['destinos'] as &$d) {
            if (isset($d['tid_ingreso_solicitud'])) {
                $d['tid_ingreso_solicitud_raw'] = $d['tid_ingreso_solicitud'];
                $d['tid_ingreso_solicitud'] = $encoder->cifrar($d['tid_ingreso_solicitud']);
            }
        }
    }
    // IMPORTANTE: multiancestro NO se cifra aquí para que el mapa vis.js pueda vincular nodos
    // Usaremos los IDs numéricos originales como claves de vinculación interna
    if (isset($item['multiancestro']) && is_array($item['multiancestro'])) {
        foreach ($item['multiancestro'] as &$m) {
            $m['gma_padre_raw'] = $m['gma_padre'];
            $m['gma_hijo_raw'] = $m['gma_hijo'];
            // Opcional: cifrar para enlaces, pero por ahora los mantendremos crudos para el mapa
        }
    }
};

$response = null;

switch ($data['ACCION']) {
    case 'CONSULTAM':
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $current_user_id = $_SESSION['user_id'] ?? null;

        if ($id) {
            $response = $controller->getById($id, $current_user_id);
        } elseif ($rgt_id) {
            $response = $controller->getByRgtId($rgt_id, $current_user_id);
        } else {
            $response = $controller->getAllMine($data, $current_user_id);
        }
        break;

    case 'CONSULTAMALL':
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $current_user_id = $_SESSION['user_id'] ?? null;
        $response = $controller->getAll($data, $current_user_id);
        break;

    case 'CREAR':
        if ($data) {
            $response = $controller->create($data);
            if (($response['status'] ?? '') === 'success') {
                require_once '../../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $tempData = $data;
                if (isset($tempData['documentos']) && is_array($tempData['documentos'])) {
                    $tempData['documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['documentos']);
                }
                $logModel->crear([
                    'evento' => 'CREATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'INGRESOS',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'CREAR_INGRESO',
                    'descripcion' => "Creación de ingreso: " . ($response['id'] ?? 'N/A'),
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
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $current_user_id = $_SESSION['user_id'] ?? null;
        if ($id && $data) {
            $response = $controller->update($id, $data, $current_user_id);
            if (($response['status'] ?? '') === 'success') {
                require_once '../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $tempData = $data;
                if (isset($tempData['documentos']) && is_array($tempData['documentos'])) {
                    $tempData['documentos'] = array_map(function ($d) {
                        return ['nombre' => $d['nombre'] ?? 'Sin nombre'];
                    }, $tempData['documentos']);
                }
                $logModel->crear([
                    'evento' => 'UPDATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'INGRESOS',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'ACTUALIZAR_INGRESO',
                    'descripcion' => "Actualización de ingreso: $id",
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
        if ($id && isset($data['ing_estado_entrega'])) {
            $solicitudModel = new \App\Models\Ingresos_ingreso($db);
            if ($solicitudModel->updateStatus($id, $data['ing_estado_entrega'])) {
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
            if (($response['status'] ?? '') === 'success') {
                require_once '../src/Models/SystemLog.php';
                $logModel = new \App\Models\SystemLog($db);
                $logModel->crear([
                    'evento' => 'DELETE',
                    'tipo' => 'warning',
                    'severidad' => 'Medio',
                    'modulo' => 'INGRESOS',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'BORRAR_INGRESO',
                    'descripcion' => "Eliminación de ingreso: $id",
                    'detalles' => json_encode(['id' => $id]),
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'resultado' => 'Exitoso'
                ]);
            }
        } else {
            $response = ["status" => "error", "message" => "ID required for delete"];
        }
        break;

    case 'VINCULAR_HIJO':
        $padre = $data['padre_id'] ?? null;
        $hijo = $data['hijo_id'] ?? null;
        if ($padre && $hijo) {
            $multiancestro = new \App\Models\Multiancestro($db);
            [$valido, $mensaje] = $multiancestro->validarVinculo($padre, $hijo);
            if (!$valido) {
                $response = ["status" => "error", "message" => $mensaje];
            } else if ($multiancestro->crear($padre, $hijo)) {
                $response = ["status" => "success", "message" => "Vínculo creado correctamente"];
            } else {
                $response = ["status" => "error", "message" => "No se pudo crear el vínculo"];
            }
        } else {
            $response = ["status" => "error", "message" => "Padre e Hijo IDs requeridos"];
        }
        break;

    case 'DETALLES_ARBOL':
        $rgt_ids = $data['rgt_ids'] ?? [];
        // Los rgt_ids ya fueron descifrados al inicio del script si venían en $data
        if (!empty($rgt_ids)) {
            $detalles = $controller->getDetallesVarios($rgt_ids);
            $response = ["status" => "success", "data" => $detalles];
        } else {
            $response = ["status" => "error", "message" => "Array de rgt_ids requerido"];
        }
        break;

    case 'ELIMINAR_VINCULO':
        $padre = $data['padre_id'] ?? null;
        $hijo = $data['hijo_id'] ?? null;
        if ($padre && $hijo) {
            $solicitudModel = new \App\Models\Ingresos_ingreso($db);
            if ($solicitudModel->eliminarVinculo($padre, $hijo)) {
                $response = ["status" => "success", "message" => "Vínculo eliminado"];
            } else {
                $response = ["status" => "error", "message" => "Error al eliminar vínculo"];
            }
        } else {
            $response = ["status" => "error", "message" => "Padre e Hijo IDs requeridos"];
        }
        break;

    case 'RESPONDER':
        if ($id) {
            $response = $controller->responder($id, $data);
        } else {
            $response = ["status" => "error", "message" => "Ingreso ID required"];
        }
        break;

    case 'INIT_FIRMA':
        if ($id) {
            $response = $controller->iniciarFirma($id, $data);
        } else {
            $response = ["status" => "error", "message" => "Ingreso ID required for INIT_FIRMA"];
        }
        break;

    case 'METRICAS':
        $response = $controller->getMetrics();
        break;
    case 'GRAFICOS':
        $response = $controller->getChartData();
        break;

    default:
        http_response_code(400);
        $response = ["status" => "error", "message" => "Action not allowed"];
        break;
}

// Cifrar IDs en la respuesta
if ($response && isset($response['data'])) {
    if (is_array($response['data'])) {
        if (isset($response['data'][0]) && is_array($response['data'][0])) {
            foreach ($response['data'] as &$item)
                $cifrarRespuesta($item);
        } else {
            $cifrarRespuesta($response['data']);
        }
    }
}
if ($response && isset($response['id']))
    $response['id'] = $encoder->cifrar($response['id']);

echo json_encode($response);
?>