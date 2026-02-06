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
    case 'CrearCarpeta':
        // TODO: Implementar lógica de creación de carpeta
        echo json_encode(["status" => "pending", "message" => "Acción 'CrearCarpeta' pendiente de implementación"]);
        break;

    case 'IngresarNuevaIteracion':
        // TODO: Implementar lógica de nueva iteración
        echo json_encode(["status" => "pending", "message" => "Acción 'IngresarNuevaIteracion' pendiente de implementación"]);
        break;

    case 'FirmarDocumento':
        // TODO: Implementar lógica de firma de documento
        echo json_encode(["status" => "pending", "message" => "Acción 'FirmarDocumento' pendiente de implementación"]);
        break;

    case 'BusquedaMeta':
        // TODO: Implementar lógica de búsqueda por metadata
        echo json_encode(["status" => "pending", "message" => "Acción 'BusquedaMeta' pendiente de implementación"]);
        break;

    case 'ActualizarEstadoCarpeta':
        // TODO: Implementar lógica de actualización de estado de carpeta
        echo json_encode(["status" => "pending", "message" => "Acción 'ActualizarEstadoCarpeta' pendiente de implementación"]);
        break;

    case 'GestionarPlantilla':
        // TODO: Implementar lógica de gestión de plantillas
        echo json_encode(["status" => "pending", "message" => "Acción 'GestionarPlantilla' pendiente de implementación"]);
        break;

    case 'SetearFechaLimite':
        // TODO: Implementar lógica de configuración de fecha límite
        echo json_encode(["status" => "pending", "message" => "Acción 'SetearFechaLimite' pendiente de implementación"]);
        break;

    case 'VincularDocDigital':
        // TODO: Implementar lógica de vinculación de documento digital
        echo json_encode(["status" => "pending", "message" => "Acción 'VincularDocDigital' pendiente de implementación"]);
        break;

    case 'SincronizarAcceso':
        // TODO: Implementar lógica de sincronización de acceso
        echo json_encode(["status" => "pending", "message" => "Acción 'SincronizarAcceso' pendiente de implementación"]);
        break;

    case 'AsignarFolioMunicipal':
        // TODO: Implementar lógica de asignación de folio municipal
        echo json_encode(["status" => "pending", "message" => "Acción 'AsignarFolioMunicipal' pendiente de implementación"]);
        break;

    case 'ValidarMallaEnvio':
        // TODO: Implementar lógica de validación de malla de envío
        echo json_encode(["status" => "pending", "message" => "Acción 'ValidarMallaEnvio' pendiente de implementación"]);
        break;

    case 'CerrarExpediente':
        // TODO: Implementar lógica de cierre de expediente
        echo json_encode(["status" => "pending", "message" => "Acción 'CerrarExpediente' pendiente de implementación"]);
        break;

    case 'GenerarCopiaCertificada':
        // TODO: Implementar lógica de generación de copia certificada
        echo json_encode(["status" => "pending", "message" => "Acción 'GenerarCopiaCertificada' pendiente de implementación"]);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Acción no permitida"]);
        break;
}
