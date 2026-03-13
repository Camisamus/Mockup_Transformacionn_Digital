<?php

namespace App\Controllers;

use App\Models\DESVE_SOLICITUDES;
use App\Helpers\MailService;

class DESVE_SolicitudController
{
    private $db;
    private $solicitud;
    private $mailService;

    public function __construct($db)
    {
        $this->db = $db;
        $this->solicitud = new desve_solicitudes($this->db);
        $this->mailService = new MailService($this->db);
    }

    public function getAll()
    {
        $result = $this->solicitud->getAll();
        return ["status" => "success", "data" => $result];
    }
    public function getTodos()
    {
        $result = $this->solicitud->getTodos();
        return ["status" => "success", "data" => $result];
    }
    public function getAllPendientesDetailed()
    {
        $result = $this->solicitud->getAllPendientesDetailed();

        return ["status" => "success", "data" => $result];
    }

    public function getHistorial()
    {
        $result = $this->solicitud->getHistorial();

        return ["status" => "success", "data" => $result];
    }

    public function getAllNL()
    {
        $result = $this->solicitud->getAllNL();

        return ["status" => "success", "data" => $result];
    }
    public function getAllCompletedNL()
    {
        $result = $this->solicitud->getAllCompletedNL();

        return ["status" => "success", "data" => $result];
    }

    public function getAllCompletedNLWithDateFilter($fechaInicio = null, $fechaFin = null)
    {
        $result = $this->solicitud->getAllCompletedNLWithDateFilter($fechaInicio, $fechaFin);

        return ["status" => "success", "data" => $result];
    }

    public function getAllForReingreso()
    {
        $result = $this->solicitud->getAllForReingreso();
        return ["status" => "success", "data" => $result];
    }

    public function getById($id)
    {
        $result = $this->solicitud->getById($id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Solicitud not found"];
    }

    public function create($data)
    {
        $result = $this->solicitud->create($data);
        if ($result[0]) {
            // Notificar por email a los destinatarios asignados
            $this->notificarDestinatarios($result[1], $result[2], $data, 'creación');

            return [
                "status" => "success",
                "message" => "Solicitud created successfully",
                "id" => $result[1],
                "rgt_id" => $result[2]
            ];
        }
        return [
            "status" => "error",
            "message" => "Unable to create solicitud",
            "error" => $this->solicitud->lastError
        ];
    }

    public function update($id, $data)
    {
        // Obtener datos actuales antes de actualizar (para el expediente_id)
        $current = $this->solicitud->getById($id);

        if ($this->solicitud->update($id, $data)) {
            // Notificar por email a los destinatarios asignados
            $rgtId = $current['sol_registro_tramite'] ?? null;
            if ($rgtId) {
                $this->notificarDestinatarios($id, $rgtId, $data, 'actualización');
            }

            return ["status" => "success", "message" => "Solicitud updated successfully"];
        }
        return [
            "status" => "error",
            "message" => "Unable to update solicitud",
            "error" => $this->solicitud->lastError,
            "data" => $data
        ];
    }

    public function delete($id)
    {
        if ($this->solicitud->delete($id)) {
            return ["status" => "success", "message" => "Solicitud deleted successfully"];
        }
        return [
            "status" => "error",
            "message" => "Unable to delete solicitud",
            "error" => $this->solicitud->lastError
        ];
    }

    /**
     * Notifica por email a todos los destinatarios (destinos) asignados a una solicitud.
     *
     * @param int $solicitudId ID de la solicitud
     * @param int $expedienteId ID del expediente (rgt_id)
     * @param array $data Datos de la solicitud
     * @param string $accion 'creación' o 'actualización'
     */
    private function notificarDestinatarios(int $solicitudId, int $expedienteId, array $data, string $accion): void
    {
        try {
            // Obtener los destinos asignados a la solicitud
            $destinos = $this->solicitud->getDestinosBySolicitud($solicitudId);

            if (empty($destinos)) {
                return;
            }

            $nombreExpediente = $data['sol_nombre_expediente'] ?? 'Sin nombre';
            $asunto = "DESVE - Solicitud {$accion}: {$nombreExpediente}";

            $cuerpo = $this->construirCuerpoEmail($data, $accion, $solicitudId);

            // Preparar array de destinatarios para enviarMasivo
            $destinatarios = [];
            foreach ($destinos as $destino) {
                $email = $destino['usr_email'] ?? null;
                if (!$email) {
                    continue;
                }

                $destinatarios[] = [
                    'email' => $email,
                    'nombre' => $destino['usr_nombre_completo'] ?? '',
                    'funcionario_id' => $destino['usr_id'] ?? null,
                    'contribuyente_id' => null
                ];
            }

            if (!empty($destinatarios)) {
                $resultado = $this->mailService->enviarMasivo($destinatarios, $expedienteId, $asunto, $cuerpo);
                error_log("DESVE Mail - {$accion} solicitud #{$solicitudId}: enviados={$resultado['enviados']}, fallidos={$resultado['fallidos']}");
            }
        } catch (\Exception $e) {
            // No bloquear la operación principal si falla el envío de mail
            error_log("DESVE Mail Error en notificarDestinatarios: " . $e->getMessage());
        }
    }

    /**
     * Construye el cuerpo HTML del email de notificación.
     */
    private function construirCuerpoEmail(array $data, string $accion, int $solicitudId): string
    {
        $nombreExpediente = htmlspecialchars($data['sol_nombre_expediente'] ?? 'Sin nombre');
        $detalle = htmlspecialchars($data['sol_detalle'] ?? 'Sin detalle');
        $fechaRecepcion = $data['sol_fecha_recepcion'] ?? 'No especificada';
        $fechaVencimiento = $data['sol_fecha_vencimiento'] ?? 'No especificada';
        $observaciones = htmlspecialchars($data['sol_observaciones'] ?? '');
        $accionTitulo = ucfirst($accion);

        $cuerpo = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <div style='background-color: #1a5276; color: white; padding: 15px 20px; border-radius: 5px 5px 0 0;'>
                <h2 style='margin: 0;'>DESVE - {$accionTitulo} de Solicitud</h2>
            </div>
            <div style='border: 1px solid #ddd; border-top: none; padding: 20px; border-radius: 0 0 5px 5px;'>
                <p>Estimado/a <strong>{nombre}</strong>,</p>
                <p>Se le informa que se ha realizado la <strong>{$accion}</strong> de la siguiente solicitud DESVE:</p>
                <table style='width: 100%; border-collapse: collapse; margin: 15px 0;'>
                    <tr style='border-bottom: 1px solid #eee;'>
                        <td style='padding: 8px; font-weight: bold; width: 40%; color: #555;'>N° Solicitud:</td>
                        <td style='padding: 8px;'>{$solicitudId}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee; background-color: #f9f9f9;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Nombre Expediente:</td>
                        <td style='padding: 8px;'>{$nombreExpediente}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Detalle:</td>
                        <td style='padding: 8px;'>{$detalle}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee; background-color: #f9f9f9;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Fecha Recepción:</td>
                        <td style='padding: 8px;'>{$fechaRecepcion}</td>
                    </tr>
                    <tr style='border-bottom: 1px solid #eee;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Fecha Vencimiento:</td>
                        <td style='padding: 8px;'>{$fechaVencimiento}</td>
                    </tr>";

        if (!empty($observaciones)) {
            $cuerpo .= "
                    <tr style='border-bottom: 1px solid #eee; background-color: #f9f9f9;'>
                        <td style='padding: 8px; font-weight: bold; color: #555;'>Observaciones:</td>
                        <td style='padding: 8px;'>{$observaciones}</td>
                    </tr>";
        }

        $cuerpo .= "
                </table>
                <p style='color: #777; font-size: 12px; margin-top: 20px;'>
                    Este es un mensaje automático del Sistema de Transformación Digital. Por favor, ingrese al sistema para más detalles.
                </p>
            </div>
        </div>";

        return $cuerpo;
    }
}
