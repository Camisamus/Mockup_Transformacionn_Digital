<?php

namespace App\Controllers;

use App\Models\Ingresos_Destinos;
use App\Models\Ingresos_ingreso;
use App\Models\Bitacora; // Assuming Bitacora is used
use App\Helpers\SimpleSMTP;
use App\Helpers\ConfigLoader;
use App\Helpers\MailService;

require_once __DIR__ . '/../Helpers/SimpleSMTP.php';
require_once __DIR__ . '/../Helpers/ConfigLoader.php';
require_once __DIR__ . '/../Helpers/MailService.php';

class Ingresos_SolicitudControler
{
    private $db;
    private $solicitud;
    private $mailService;
    private $destinos;

    public function __construct($db)
    {
        $this->db = $db;
        $this->solicitud = new Ingresos_ingreso($this->db);
        $this->destinos = new Ingresos_Destinos($this->db);
        $this->mailService = new MailService($this->db);
    }

    public function getAllMine($filters = [], $current_user_id = null)
    {
        $result = $this->solicitud->getAllMine($filters, $current_user_id);
        return ["status" => "success", "data" => $result];
    }

    public function getAll($filters = [], $current_user_id = null)
    {
        $result = $this->solicitud->getAll($filters, $current_user_id);
        return ["status" => "success", "data" => $result[0]];
    }

    public function getById($id, $current_user_id = null)
    {
        $result = $this->solicitud->getById($id, $current_user_id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Solicitud not found"];
    }

    public function getByRgtId($rgtId, $current_user_id = null)
    {
        $result = $this->solicitud->getByRgtId($rgtId, $current_user_id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Solicitud with RGT ID not found"];
    }

    public function create($data)
    {
        $result = $this->solicitud->create($data);
        if ($result[0]) {
            // Notificar por email a los destinatarios asignados
            $this->notificarDestinatarios($result[1], $data, 'creación');

            return ["status" => "success", "message" => "Solicitud created successfully", "id" => $result[1]];
        }
        return [
            "status" => "error",
            "message" => "Unable to create solicitud",
            "error" => $this->solicitud->lastError
        ];
    }

    public function update($id, $data, $current_user_id = null)
    {
        if ($this->solicitud->update($id, $data, $current_user_id)) {
            // Notificar por email a los destinatarios asignados
            $this->notificarDestinatarios($id, $data, 'actualización');

            return ["status" => "success", "message" => "Solicitud updated successfully"];
        }
        return [
            "status" => "error",
            "message" => "Unable to update solicitud",
            "error" => $this->solicitud->lastError ?? "Unknown error"
        ];
    }

    public function delete($id)
    {
        if ($this->solicitud->delete($id)) {
            return ["status" => "success", "message" => "Solicitud deleted successfully"];
        }
        return ["status" => "error", "message" => "Unable to delete solicitud"];
    }

    public function getDetallesVarios(array $rgt_ids)
    {
        return $this->solicitud->obtenerDetallesVarios($rgt_ids);
    }

    public function responder($id, $data)
    {
        // Get user from session for security
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $usuario_id = $_SESSION['user_id'] ?? null;

        if (!$usuario_id)
            return ["status" => "error", "message" => "Session user not found"];

        $estado = $data['tis_estado'] ?? null;
        $respuesta = $data['tis_respuesta'] ?? null;
        $otpCode = $data['otp'] ?? null;
        $accionLabel = $data['accion_label'] ?? '';

        if (!$estado)
            return ["status" => "error", "message" => "Estado resolution required"];

        // OTP Verification for Signing
        if ($estado === 'Resuelto_Favorable' && strpos(strtolower($accionLabel), 'firmar') !== false) {
            if (
                !isset($_SESSION['otp_firma']) ||
                $_SESSION['otp_firma']['code'] != $otpCode ||
                $_SESSION['otp_firma']['ing_id'] != $id ||
                time() > $_SESSION['otp_firma']['expires']
            ) {
                return ["status" => "error", "message" => "Código de verificación inválido o expirado."];
            }
            // Clear OTP on success
            unset($_SESSION['otp_firma']);
        }

        if ($this->solicitud->responder($id, $usuario_id, $estado, $respuesta)) {
            return ["status" => "success", "message" => "Respuesta registrada correctamente"];
        }
        return ["status" => "error", "message" => "Error al registrar respuesta"];
    }

    public function iniciarFirma($id, $data)
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $usuario_id = $_SESSION['user_id'] ?? null;
        $usuario_email = $_SESSION['email'] ?? null;

        if (!$usuario_id)
            return ["status" => "error", "message" => "Usuario no autenticado"];

        if (!$usuario_email) {
            // Ideally fetch from DB if session is missing email
            return ["status" => "error", "message" => "Email no encontrado para el usuario"];
        }

        $code = rand(100000, 999999);
        $_SESSION['otp_firma'] = [
            'code' => $code,
            'expires' => time() + 300, // 5 minutes
            'ing_id' => $id
        ];

        // Send Email using Variable.txt
        ConfigLoader::load(__DIR__ . '/../../../cron/Variables.txt');
        $smtp = new SimpleSMTP(
            ConfigLoader::get('HOST_EMAIL'),
            ConfigLoader::get('PUERTO_EMAIL'),
            ConfigLoader::get('USUARIO_EMAIL'),
            ConfigLoader::get('PASSWORD_EMAIL')
        );

        $subject = "Codigo de Verificacion de Firma - Transformacion Digital";
        $body = "
            <h3>Codigo de Verificacion</h3>
            <p>Su codigo para firmar la solicitud ID: <b>$id</b> es:</p>
            <h1 style='color: #0d6efd;'>$code</h1>
            <p>Este codigo es valido por 5 minutos.</p>
        ";

        if ($smtp->send($usuario_email, $subject, $body)) {
            return ["status" => "success", "message" => "Código enviado"];
        } else {
            return ["status" => "error", "message" => "No se pudo enviar el correo de verificación"];
        }
    }

    public function getMetrics()
    {
        return ["status" => "success", "data" => $this->solicitud->getMetrics()];
    }

    public function getChartData()
    {
        return ["status" => "success", "data" => $this->solicitud->getChartData()];
    }
    ////RAMON LEE AQUI
    public function getDestinatarios($solicitudId)
    {
        $destinatarios = $this->destinos->obtenerPorIngresoId($solicitudId);
        $destinatarios = [];
        foreach ($destinatarios as $destino) {
            $email = $destino['usr_email'] ?? null;
            if (!$email) {
                continue;
            }

            $destinatarios[] = [
                'email' => $email,
                'Facultad' => $destino['tid_facultad'] ?? null,
                'nombre' => ($destino['usr_nombre'] ?? '') . ' ' . ($destino['usr_apellido'] ?? ''),
                'funcionario_id' => $destino['tid_destino'] ?? null,
                'contribuyente_id' => null
            ];
        }
        return $destinatarios;
    }

    /**
     * Notifica por email a todos los destinatarios (destinos) asignados a una solicitud.
     */
    private function notificarDestinatarios(int $solicitudId, array $data, string $accion): void
    {
        try {
            // Obtener los datos completos de la solicitud para tener el rgt_id y los destinos actuales
            $solicitudCompleta = $this->solicitud->getById($solicitudId);

            if (!$solicitudCompleta || empty($solicitudCompleta['destinos'])) {
                return;
            }

            $expedienteId = $solicitudCompleta['tis_registro_tramite'] ?? null;
            if (!$expedienteId) {
                return;
            }

            $titulo = $data['tis_titulo'] ?? $solicitudCompleta['tis_titulo'] ?? 'Sin título';
            $asunto = "Ingresos - Solicitud {$accion}: {$titulo}";

            $cuerpo = $this->construirCuerpoEmail($solicitudCompleta, $accion, $solicitudId);

            // Preparar array de destinatarios para enviarMasivo
            $destinatarios = [];
            foreach ($solicitudCompleta['destinos'] as $destino) {
                $email = $destino['usr_email'] ?? null;
                if (!$email) {
                    continue;
                }

                $destinatarios[] = [
                    'email' => $email,
                    'nombre' => ($destino['usr_nombre'] ?? '') . ' ' . ($destino['usr_apellido'] ?? ''),
                    'funcionario_id' => $destino['tid_destino'] ?? null,
                    'contribuyente_id' => null
                ];
            }

            if (!empty($destinatarios)) {
                $resultado = $this->mailService->enviarMasivo($destinatarios, $expedienteId, $asunto, $cuerpo);
                error_log("Ingresos Mail - {$accion} solicitud #{$solicitudId}: enviados={$resultado['enviados']}, fallidos={$resultado['fallidos']}");
            }
        } catch (\Exception $e) {
            error_log("Ingresos Mail Error en notificarDestinatarios: " . $e->getMessage());
        }
    }

    /**
     * Construye el cuerpo HTML del email de notificación.
     */
    private function construirCuerpoEmail(array $solicitud, string $accion, int $solicitudId): string
    {
        $titulo = htmlspecialchars($solicitud['tis_titulo'] ?? 'Sin título');
        $contenido = htmlspecialchars($solicitud['tis_contenido'] ?? 'Sin contenido');
        $fechaLimite = $solicitud['tis_fecha_limite'] ?? 'No especificada';
        $accionTitulo = ucfirst($accion);

        $cuerpo = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <div style='background-color: #2c3e50; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;'>
                <h2 style='margin: 0;'>Ingresos - {$accionTitulo} de Solicitud</h2>
            </div>
            <div style='border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;'>
                <p>Estimado/a <strong>{nombre}</strong>,</p>
                <p>Se le informa que se ha realizado la <strong>{$accion}</strong> de la siguiente solicitud en el módulo de Ingresos:</p>
                <table style='width: 100%; border-collapse: collapse; margin: 15px 0;'>
                    <tr style='border-bottom: 1px solid #eee;'>
                        <td style='padding: 8px; font-weight: bold; width: 40%; color: #555;'>N° Solicitud:</td>
                        <td style='padding: 8px;'>{$solicitudId}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee; background-color: #f9f9f9;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Título:</td>
                        <td style='padding: 8px;'>{$titulo}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Contenido:</td>
                        <td style='padding: 8px;'>{$contenido}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee; background-color: #f9f9f9;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Fecha Límite:</td>
                        <td style='padding: 8px;'>{$fechaLimite}</td>
                    </tr>
                </table>
                <p style='color: #777; font-size: 12px; margin-top: 20px;'>
                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.
                </p>
            </div>
        </div>";

        return $cuerpo;
    }
}
