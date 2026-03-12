<?php
header("Content-Type: application/json");

require_once __DIR__ . '/app_autoload.php';
require_once __DIR__ . '/session_start.php';

use App\Config\Database;
use App\Helpers\MailService;

// Obtener datos del POST
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['problema']) || empty($data['url'])) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    exit;
}

try {
    $db = (new Database())->getConnection();
    $mailService = new MailService($db);

    $problema = $data['problema'];
    $url = $data['url'];
    $usuario = $_SESSION['email'] ?? 'Usuario Desconocido';
    $usuarioId = $_SESSION['user_id'] ?? 0;

    $asunto = "⚠️ REPORTE DE PROBLEMA - Sistema Municipal";
    
    $cuerpo = "
    <div style='font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #eee; border-radius: 10px; overflow: hidden;'>
        <div style='background: #dc3545; color: white; padding: 20px; text-align: center;'>
            <h2 style='margin: 0;'>Reporte de Problema</h2>
        </div>
        <div style='padding: 20px;'>
            <p>Se ha recibido un nuevo reporte de error desde el sistema municipal.</p>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; width: 30%;'>Usuario:</td>
                    <td style='padding: 10px; border-bottom: 1px solid #eee;'>$usuario (ID: $usuarioId)</td>
                </tr>
                <tr>
                    <td style='padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;'>URL de Origen:</td>
                    <td style='padding: 10px; border-bottom: 1px solid #eee;'><a href='$url' style='color: #004085;'>$url</a></td>
                </tr>
            </table>
            
            <p style='font-weight: bold; margin-top: 20px;'>Descripción del problema:</p>
            <div style='padding: 15px; background: #f8f9fa; border-left: 4px solid #dc3545; color: #555; font-style: italic; line-height: 1.6;'>
                " . nl2br(htmlspecialchars($problema)) . "
            </div>
            
            <p style='font-size: 12px; color: #999; margin-top: 30px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;'>
                Este correo fue generado automáticamente desde la función 'Reportar un problema' del footer.
            </p>
        </div>
    </div>
    ";

    // Enviamos el correo. Usamos expediente_id 1 alternativamente si no tenemos uno real, 
    // pero MailService lo requiere para el log.
    $resultado = $mailService->enviar([
        'expediente_id' => 1, 
        'destinatario_email' => 'ramon.martinez@munivina.cl',
        'asunto' => $asunto,
        'cuerpo' => $cuerpo,
        'from_name' => 'Soporte Sistema Municipal'
    ]);

    echo json_encode($resultado);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
