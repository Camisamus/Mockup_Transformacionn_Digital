<?php

namespace App\Controllers;

use App\Models\Ingresos_ingreso;
use App\Models\Bitacora; // Assuming Bitacora is used
use App\Helpers\SimpleSMTP;
use App\Helpers\ConfigLoader;

require_once __DIR__ . '/../Helpers/SimpleSMTP.php';
require_once __DIR__ . '/../Helpers/ConfigLoader.php';

class Ingresos_SolicitudControler
{
    private $db;
    private $solicitud;

    public function __construct($db)
    {
        $this->db = $db;
        $this->solicitud = new Ingresos_ingreso($this->db);
    }

    public function getAll($filters = [], $current_user_id = null)
    {
        $result = $this->solicitud->getAll($filters, $current_user_id);
        return ["status" => "success", "data" => $result];
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
            return ["status" => "success", "message" => "Solicitud created successfully", "id" => $result[1]];
        }
        return [
            "status" => "error",
            "message" => "Unable to create solicitud",
            "error" => $this->solicitud->lastError
        ];
    }

    public function update($id, $data)
    {
        if ($this->solicitud->update($id, $data)) {
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
}
