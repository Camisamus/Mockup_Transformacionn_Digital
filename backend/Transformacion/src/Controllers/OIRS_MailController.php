<?php

namespace App\Controllers;

use App\Helpers\MailService;

class oirs_mailcontroller
{
    private $db;
    private $mailService;
    private $solicitudModel;

    public function __construct($db, $solicitudModel)
    {
        $this->db = $db;
        $this->mailService = new MailService($this->db);
        $this->solicitudModel = $solicitudModel;
    }

    /**
     * BOTÓN 1: btn_toma_conocimiento (Encargado OIRS)
     * Indica que la solicitud ha sido recibida y está en proceso de derivación.
     */
    public function notificarTomaConocimiento(int $solicitudId, int $expedienteId, array $data): void
    {
        $asunto = "OIRS - Toma de conocimiento Solicitud #{$solicitudId}";
        $this->procesarEnvioGeneral($solicitudId, $expedienteId, $data, $asunto, 'TOMA_CONOCIMIENTO');
    }

    /**
     * BOTÓN 2: btn_responder_tecnico (Jefe/Director)
     * Respuesta formal tras evaluación. Puede ser positiva o negativa.
     */
    public function notificarRespuestaTecnica(int $solicitudId, int $expedienteId, array $data, bool $esPositiva): void
    {
        $unidad = $data['unidad_tecnica'] ?? 'Dirección Técnica';
        $asunto = $esPositiva 
            ? "Resolución de su Solicitud OIRS #{$solicitudId} - {$unidad}"
            : "Respuesta Técnica OIRS #{$solicitudId} - {$unidad}";

        $plantilla = $esPositiva ? 'TECNICA_POSITIVA' : 'TECNICA_NEGATIVA';
        $this->procesarEnvioGeneral($solicitudId, $expedienteId, $data, $asunto, $plantilla);
    }

    /**
     * BOTÓN 3: btn_ejecutar_ejecucion (Operaciones)
     * Solo se gatilla si el paso anterior fue positivo para programar fecha.
     */
    public function notificarProgramacionEjecucion(int $solicitudId, int $expedienteId, array $data): void
    {
        $asunto = "Programación de trabajos - OIRS #{$solicitudId}";
        $this->procesarEnvioGeneral($solicitudId, $expedienteId, $data, $asunto, 'EJECUCION');
    }

    /**
     * MOTOR DE ENVÍO
     */
    private function procesarEnvioGeneral(int $solicitudId, int $expedienteId, array $data, string $asunto, string $plantilla): void
    {
        try {
            $destinos = $this->solicitudModel->getDestinosBySolicitud($solicitudId);
            if (empty($destinos)) return;

            $cuerpo = $this->generarHtmlPorPlantilla($data, $solicitudId, $plantilla);

            $destinatarios = [];
            foreach ($destinos as $destino) {
                if (empty($destino['usr_email'])) continue;
                $destinatarios[] = [
                    'email' => $destino['usr_email'],
                    'nombre' => $destino['usr_nombre_completo'] ?? 'Vecino/a',
                    'funcionario_id' => $destino['usr_id'] ?? null,
                    'contribuyente_id' => null
                ];
            }

            if (!empty($destinatarios)) {
                $this->mailService->enviarMasivo($destinatarios, $expedienteId, $asunto, $cuerpo);
            }
        } catch (\Exception $e) {
            error_log("Error en MailController [{$plantilla}]: " . $e->getMessage());
        }
    }

    /**
     * GENERADOR DE CONTENIDO SEGÚN EL FLUJO
     */
    private function generarHtmlPorPlantilla(array $data, int $solicitudId, string $plantilla): string
    {
        $resumen = htmlspecialchars($data['sol_detalle'] ?? 'su requerimiento');
        $unidad = htmlspecialchars($data['unidad_tecnica'] ?? 'Departamento Municipal');
        $cargo = htmlspecialchars($data['cargo_responsable'] ?? "Encargado de área");
        
        $contenidoPrincipal = "";
        $colorHeader = "#1a5276";
        $tituloVisible = "Notificación OIRS";

        switch ($plantilla) {
            case 'TOMA_CONOCIMIENTO':
                $tituloVisible = "SOLICITUD INGRESADA";
                $contenidoPrincipal = "
                    <p>Se le informa que se ha tomado conocimiento de su solicitud con folio <strong>#{$solicitudId}</strong>.</p>
                    <p>Nuestro equipo técnico ya ha sido notificado y comenzará el análisis. Recibirá una respuesta formal en un plazo máximo de 10 días hábiles.</p>";
                break;

            case 'TECNICA_POSITIVA':
                $colorHeader = "#229954";
                $tituloVisible = "SOLICITUD APROBADA";
                $detalleSolucion = htmlspecialchars($data['detalle_tecnico_de_la_solucion'] ?? 'Información por definir');
                $contenidoPrincipal = "
                    <p>En relación a su requerimiento sobre <em>{$resumen}</em>, tras la evaluación realizada por el equipo de <strong>{$unidad}</strong>, le informamos que su solicitud ha sido <strong>APROBADA</strong>.</p>
                    <p><strong>Acción a realizar:</strong> {$detalleSolucion}</p>
                    <p>Agradecemos su compromiso con la comuna. Una vez programados los trabajos se notificará la fecha de ejecución.</p>";
                break;

            case 'TECNICA_NEGATIVA':
                $colorHeader = "#a93226";
                $tituloVisible = "RESPUESTA TÉCNICA";
                $motivo = htmlspecialchars($data['motivos_rechazo'] ?? 'No cumple con marcos regulatorios vigentes.');
                $contenidoPrincipal = "
                    <p>En respuesta a su solicitud <strong>#{$solicitudId}</strong>, la unidad de <strong>{$unidad}</strong> ha finalizado el análisis.</p>
                    <p>Lamentamos informarle que no es posible acceder a lo solicitado por lo siguiente:</p>
                    <blockquote style='background: #f9f9f9; padding: 10px; border-left: 4px solid #a93226;'>{$motivo}</blockquote>
                    <p style='font-size: 12px; color: #666;'>Nos vemos en la obligación de cumplir con la normativa para asegurar la equidad en el servicio.</p>";
                break;

            case 'EJECUCION':
                $colorHeader = "#d4ac0d";
                $tituloVisible = "PROGRAMACIÓN DE TRABAJOS";
                $f_inicio = $data['fecha_inicio'] ?? 'Por confirmar';
                $duracion = $data['duracion_estimada'] ?? 'Por definir';
                $detalle_corto = htmlspecialchars($data['detalle_corto'] ?? 'Trabajos en terreno');
                $contenidoPrincipal = "
                    <p>Tras la aprobación técnica (Folio #{$solicitudId}), el equipo de <strong>{$unidad}</strong> ha programado las labores:</p>
                    <ul>
                        <li><strong>Fecha estimada:</strong> {$f_inicio}</li>
                        <li><strong>Plazo de ejecución:</strong> {$duracion}</li>
                        <li><strong>Tipo de intervención:</strong> {$detalle_corto}</li>
                    </ul>
                    <p style='font-size: 11px; color: #888;'>Nota: La fecha podría alterarse por condiciones climáticas o fuerza mayor.</p>";
                break;
        }

        // Retorna el cascarón HTML común para todos los correos
        return "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;'>
            <div style='background-color: {$colorHeader}; color: white; padding: 15px; text-align: center;'>
                <h2 style='margin: 0;'>{$tituloVisible}</h2>
            </div>
            <div style='padding: 20px; line-height: 1.5; color: #333;'>
                <p>Estimado/a <strong>{nombre}</strong>,</p>
                {$contenidoPrincipal}
                <div style='margin-top: 25px; border-top: 1px solid #eee; padding-top: 15px;'>
                    <p style='margin: 0;'>Atentamente,</p>
                    <strong>{$cargo}</strong><br>{$unidad}
                </div>
            </div>
        </div>";
    }
}