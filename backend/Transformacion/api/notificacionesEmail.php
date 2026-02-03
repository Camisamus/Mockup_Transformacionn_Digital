<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/Database.php';
require_once __DIR__ . '/../src/Helpers/SimpleSMTP.php';
require_once __DIR__ . '/../src/Helpers/ConfigLoader.php';

use App\Config\Database;
use App\Helpers\SimpleSMTP;
use App\Helpers\ConfigLoader;

// Load Config from Variables.txt
ConfigLoader::load(__DIR__ . '/../../cron/Variables.txt');

$dbObj = new Database();
$db = $dbObj->getConnection();

if (!$db) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

$results = [
    "DESVE" => [],
    "Ingresos" => []
];

// Helper to send email and collect results
$sendNotification = function ($db, $smtp, $solId, $nombre, $email, $vencimientoStr, $templateType) {
    $servidor = ConfigLoader::get("SERVIDORPAGINA");
    $subject = "";
    $body = "";

    switch ($templateType) {
        case 'DESVE':
            $vencimiento = new DateTime($vencimientoStr);
            $hoy = new DateTime();
            $interval = $hoy->diff($vencimiento);
            $dias = (int) $interval->format('%r%a');

            if ($dias >= 0) {
                $subject = "Recordatorio Fecha Limite";
                $body = "Hola $nombre,<br><br>Te quedan $dias dias para la fecha limite de tu solicitud pendiente.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/paginas/desve_responder.html?id=$solId<br><br>Atte,<br>Sistema";
            } else {
                $abs_dias = abs($dias);
                $subject = "Alerta de Expiracion";
                $body = "Hola $nombre,<br><br>Tu solicitud expiro hace $abs_dias dias.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/paginas/desve_responder.html?id=$solId<br><br>Atte,<br>Sistema";
            }
            break;
        case 'Ingresos':
            $subject = "Notificación de Ingreso Pendiente";
            $body = "Hola $nombre,<br><br>Tienes un ingreso pendiente que requiere tu atención.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/paginas/ingr_responder.html?id=$solId<br><br>Atte,<br>Sistema";
            break;
        default:
            $subject = "Notificación Pendiente";
            $body = "Hola $nombre,<br><br>Tienes una solicitud pendiente que requiere tu atención.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/paginas/ingr_responder.html?id=$solId<br><br>Atte,<br>Sistema";
            break;
    }
    $smtp->send($email, $subject, $body);
    return $templateType . "-" . $solId . "-Notificado a: " . $email;
};

$smtp = new SimpleSMTP(
    ConfigLoader::get('HOST_EMAIL'),
    ConfigLoader::get('PUERTO_EMAIL'),
    ConfigLoader::get('USUARIO_EMAIL'),
    ConfigLoader::get('PASSWORD_EMAIL')
);

// 1. Process DESVE
try {
    $queryDesve = "SELECT 
                    s.sol_id,
                    u.usr_nombre as nombre, 
                    u.usr_email as email, 
                    s.sol_fecha_vencimiento 
                  FROM trd_desve_solicitudes s
                  JOIN trd_desve_destinos d ON s.sol_id = d.tid_desve_solicitud
                  JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  WHERE s.sol_estado_entrega = 0 
                    AND s.sol_borrado = 0
                    AND s.sol_fecha_vencimiento IS NOT NULL
                  ORDER BY s.sol_id";

    $stmtDesve = $db->prepare($queryDesve);
    $stmtDesve->execute();
    $rowsDesve = $stmtDesve->fetchAll(PDO::FETCH_ASSOC);

    $tasksDesve = [];
    foreach ($rowsDesve as $row) {
        $tasksDesve[$row['sol_id']][] = $row;
    }

    foreach ($tasksDesve as $sol_id => $destinations) {
        $emailsSent = [];
        foreach ($destinations as $dest) {
            if ($i = $sendNotification($db, $smtp, $sol_id, $dest['nombre'], $dest['email'], $dest['sol_fecha_vencimiento'], 'DESVE')) {
                $emailsSent[] = $i;
            }
        }
        if (!empty($emailsSent)) {
            $results["DESVE"][] = $emailsSent;
        }
    }
} catch (Exception $e) {
    error_log("Error in notificacionesEmail.php (DESVE): " . $e->getMessage());
}

// 2. Process Ingresos (Placeholder logic based on BandejaController)
try {
    $queryIngr = "SELECT 
                    s.tis_id,
                    u.usr_nombre as nombre, 
                    u.usr_email as email, 
                    s.tis_fecha
                  FROM trd_ingresos_solicitudes s
                  JOIN trd_ingresos_destinos d ON s.tis_id = d.tid_ingreso_solicitud
                  JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  WHERE s.tis_estado NOT IN ('Resuelto_Favorable', 'Resuelto_NO_Favorable')
                  ORDER BY s.tis_id";

    $stmtIngr = $db->prepare($queryIngr);
    $stmtIngr->execute();
    $rowsIngr = $stmtIngr->fetchAll(PDO::FETCH_ASSOC);

    $tasksIngr = [];
    foreach ($rowsIngr as $row) {
        $tasksIngr[$row['tis_id']][] = $row;
    }

    foreach ($tasksIngr as $sol_id => $destinations) {
        $emailsSent = [];
        foreach ($destinations as $dest) {
            if ($i = $sendNotification($db, $smtp, $sol_id, $dest['nombre'], $dest['email'], $dest['tis_fecha'], 'Ingresos')) {
                $emailsSent[] = $i;
            }
        }
        if (!empty($emailsSent)) {
            $results["Ingresos"][] = $emailsSent;
        }
    }
} catch (Exception $e) {
    error_log("Error in notificacionesEmail.php (Ingresos): " . $e->getMessage());
}

// Prepare final output: "un array con un elemento por cada categoria"
$finalOutput = [];
foreach ($results as $category => $tasks) {
    $finalOutput[] = [$category => $tasks];
}
echo json_encode($finalOutput, JSON_PRETTY_PRINT);
