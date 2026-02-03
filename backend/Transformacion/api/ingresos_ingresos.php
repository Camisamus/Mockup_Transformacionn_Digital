<?php
require_once 'cors.php';

// API Endpoint: Solicitudes
require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");
use App\Config\Database;
use App\Controllers\Ingresos_SolicitudControler;

$database = new Database();
$db = $database->getConnection();

$controller = new Ingresos_SolicitudControler($db);

$id = $data['ing_id'] ?? null;
$rgt_id = $data['rgt_id'] ?? null;

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
            // Support for Bandeja Search Filters
            $filters = [
                'tis_titulo' => $data['tis_titulo'] ?? null,
                'rgt_id_publica' => $data['rgt_id_publica'] ?? null,
                'tis_id' => $data['tis_id'] ?? null
            ];
            $response = $controller->getAll($filters, $current_user_id);
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
                $logModel->crear([
                    'evento' => 'CREATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'INGRESOS',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'CREAR_INGRESO',
                    'descripcion' => "Creación de ingreso: " . ($response['id'] ?? 'N/A'),
                    'detalles' => json_encode(['data' => $data]),
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
                $logModel->crear([
                    'evento' => 'UPDATE',
                    'tipo' => 'info',
                    'severidad' => 'Bajo',
                    'modulo' => 'INGRESOS',
                    'usuario_id' => $_SESSION['user_id'] ?? null,
                    'accion' => 'ACTUALIZAR_INGRESO',
                    'descripcion' => "Actualización de ingreso: $id",
                    'detalles' => json_encode(['id' => $id, 'cambios' => $data]),
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
        if ($id && isset($data['ing_estado_entrega'])) {
            // Simplified call - we can either update Controller or call Model directly if Controller is thin
            // For consistency, let's assume we might need a controller method or just use the model if it's simpler
            $solicitudModel = new \App\Models\Ingresos_ingreso($db);
            if ($solicitudModel->updateStatus($id, $data['ing_estado_entrega'])) {
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
        echo json_encode($response);
        break;

    case 'VINCULAR_HIJO':
        $padre = $data['padre_id'] ?? null;
        $hijo = $data['hijo_id'] ?? null;
        if ($padre && $hijo) {
            $multiancestro = new \App\Models\Multiancestro($db);

            // Validar reglas de dependencia
            [$valido, $mensaje] = $multiancestro->validarVinculo($padre, $hijo);
            if (!$valido) {
                $response = ["status" => "error", "message" => $mensaje];
                echo json_encode($response);
                break;
            }

            if ($multiancestro->crear($padre, $hijo)) {
                $response = ["status" => "success", "message" => "Vínculo creado correctamente"];
            } else {
                $response = ["status" => "error", "message" => "No se pudo crear el vínculo"];
            }
        } else {
            $response = ["status" => "error", "message" => "Padre e Hijo IDs requeridos"];
        }
        echo json_encode($response);
        break;

    case 'DETALLES_ARBOL':
        $rgt_ids = $data['rgt_ids'] ?? [];
        if (!empty($rgt_ids)) {
            $detalles = $controller->getDetallesVarios($rgt_ids);
            $response = ["status" => "success", "data" => $detalles];
        } else {
            $response = ["status" => "error", "message" => "Array de rgt_ids requerido"];
        }
        echo json_encode($response);
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
        echo json_encode($response);
        break;

    case 'RESPONDER':
        if ($id) {
            $response = $controller->responder($id, $data);
        } else {
            $response = ["status" => "error", "message" => "Ingreso ID required"];
        }
        echo json_encode($response);
        break;

    case 'INIT_FIRMA':
        if ($id) {
            $response = $controller->iniciarFirma($id, $data);
        } else {
            $response = ["status" => "error", "message" => "Ingreso ID required for INIT_FIRMA"];
        }
        echo json_encode($response);
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Action not allowed"]);
        break;
}
?>