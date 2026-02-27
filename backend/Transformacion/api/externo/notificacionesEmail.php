<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/Database.php';
require_once __DIR__ . '/../src/Helpers/MailService.php';
require_once __DIR__ . '/../src/Helpers/SimpleSMTP.php';
require_once __DIR__ . '/../src/Helpers/ConfigLoader.php';

use App\Config\Database;
use App\Helpers\MailService;
use App\Helpers\ConfigLoader;

// Load Config from Variables.txt
ConfigLoader::load(__DIR__ . '/../../cron/Variables.txt');

$dbObj = new Database();
$db = $dbObj->getConnection();

if (!$db) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Crear instancia del MailService (carga SMTP automáticamente desde Variables.txt)
$mailService = new MailService($db);
$servidor = ConfigLoader::get("SERVIDORPAGINA");

$results = [
    "DESVE" => [],
    "Ingresos" => []
];

// 1. Process DESVE
try {
    $queryDesve = "SELECT 
                    s.sol_id,
                    s.sol_registro_tramite,
                    u.usr_id,
                    u.usr_nombre as nombre, 
                    u.usr_email as email, 
                    s.sol_fecha_vencimiento 
                  FROM trd_desve_solicitudes s
                  JOIN trd_desve_destinos d ON s.sol_id = d.tid_desve_solicitud AND d.tid_borrado = 0
                  JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  WHERE s.sol_estado_entrega = 0 
                    AND s.sol_borrado = 0
                    AND s.sol_fecha_vencimiento IS NOT NULL
                  ORDER BY s.sol_id";

    $stmtDesve = $db->prepare($queryDesve);
    $stmtDesve->execute();
    $rowsDesve = $stmtDesve->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar por solicitud
    $tasksDesve = [];
    foreach ($rowsDesve as $row) {
        $tasksDesve[$row['sol_id']][] = $row;
    }

    foreach ($tasksDesve as $sol_id => $destinations) {
        $emailsSent = [];
        foreach ($destinations as $dest) {
            // Calcular días para personalizar el mensaje
            $vencimiento = new DateTime($dest['sol_fecha_vencimiento']);
            $hoy = new DateTime();
            $interval = $hoy->diff($vencimiento);
            $dias = (int) $interval->format('%r%a');

            if ($dias >= 0) {
                $subject = "Recordatorio Fecha Limite";
                $body = "Hola {$dest['nombre']},<br><br>Te quedan $dias dias para la fecha limite de tu solicitud pendiente.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/Funcionarios/desve_responder.html?id=$sol_id<br><br>Atte,<br>Sistema";
            } else {
                $abs_dias = abs($dias);
                $subject = "Alerta de Expiracion";
                $body = "Hola {$dest['nombre']},<br><br>Tu solicitud expiro hace $abs_dias dias.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/Funcionarios/desve_responder.html?id=$sol_id<br><br>Atte,<br>Sistema";
            }

            // Enviar usando MailService (envía + registra en trd_general_mails_enviados)
            $resultado = $mailService->enviar([
                'expediente_id' => $dest['sol_registro_tramite'],
                'destinatario_email' => $dest['email'],
                'asunto' => $subject,
                'cuerpo' => $body,
                'funcionario_id' => $dest['usr_id'],
            ]);

            $emailsSent[] = "DESVE-$sol_id-" . $resultado['status'] . "-" . $dest['email'];
        }
        if (!empty($emailsSent)) {
            $results["DESVE"][] = $emailsSent;
        }
    }
} catch (Exception $e) {
    error_log("Error in notificacionesEmail.php (DESVE): " . $e->getMessage());
}

// 2. Process Ingresos
try {
    $queryIngr = "SELECT 
                    s.tis_id,
                    s.tis_registro_tramite,
                    u.usr_id,
                    u.usr_nombre as nombre, 
                    u.usr_email as email, 
                    s.tis_fecha
                  FROM trd_ingresos_solicitudes s
                  JOIN trd_ingresos_destinos d ON s.tis_id = d.tid_ingreso_solicitud AND d.tid_borrado = 0
                  JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  WHERE s.tis_estado NOT IN ('Resuelto_Favorable', 'Resuelto_NO_Favorable')
                  ORDER BY s.tis_id";

    $stmtIngr = $db->prepare($queryIngr);
    $stmtIngr->execute();
    $rowsIngr = $stmtIngr->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar por solicitud
    $tasksIngr = [];
    foreach ($rowsIngr as $row) {
        $tasksIngr[$row['tis_id']][] = $row;
    }

    foreach ($tasksIngr as $sol_id => $destinations) {
        $emailsSent = [];
        foreach ($destinations as $dest) {
            $subject = "Notificación de Ingreso Pendiente";
            $body = "Hola {$dest['nombre']},<br><br>Tienes un ingreso pendiente que requiere tu atención.<br><br>Responda Aqui:<br><br>http://$servidor/Transformacion/Funcionarios/ingr_responder.html?id=$sol_id<br><br>Atte,<br>Sistema";

            // Enviar usando MailService (envía + registra en trd_general_mails_enviados)
            $resultado = $mailService->enviar([
                'expediente_id' => $dest['tis_registro_tramite'],
                'destinatario_email' => $dest['email'],
                'asunto' => $subject,
                'cuerpo' => $body,
                'funcionario_id' => $dest['usr_id'],
            ]);

            $emailsSent[] = "Ingresos-$sol_id-" . $resultado['status'] . "-" . $dest['email'];
        }
        if (!empty($emailsSent)) {
            $results["Ingresos"][] = $emailsSent;
        }
    }
} catch (Exception $e) {
    error_log("Error in notificacionesEmail.php (Ingresos): " . $e->getMessage());
}

// Prepare final output
$finalOutput = [];
foreach ($results as $category => $tasks) {
    $finalOutput[] = [$category => $tasks];
}
echo json_encode($finalOutput, JSON_PRETTY_PRINT);
