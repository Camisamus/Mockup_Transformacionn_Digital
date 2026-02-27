<?php

namespace App\Helpers;

use App\Config\Database;
use PDO;

/**
 * MailService - Helper general para envío de mails con registro en BD.
 * 
 * Utiliza SimpleSMTP internamente para el envío y registra cada mail
 * enviado en la tabla trd_general_mails_enviados.
 * 
 * Uso:
 *   $db = (new Database())->getConnection();
 *   $mail = new MailService($db);
 *   $mail->enviar([
 *       'expediente_id'       => 31,                        // REQUERIDO: ID del expediente (rgt_id)
 *       'destinatario_email'  => 'juan@ejemplo.cl',         // REQUERIDO: email destino
 *       'asunto'              => 'Recordatorio',            // REQUERIDO: asunto del mail
 *       'cuerpo'              => '<p>Hola Juan...</p>',     // REQUERIDO: cuerpo del mail (acepta HTML)
 *       'funcionario_id'      => 10,                        // Opcional: ID del usuario destinatario (trd_acceso_usuarios)
 *       'contribuyente_id'    => null,                      // Opcional: ID del contribuyente destinatario (trd_general_contribuyentes)
 *       'from_name'           => 'Sistema Municipal',       // Opcional: nombre del remitente
 *   ]);
 */
class MailService
{
    private $db;
    private $smtp;
    private $table = 'trd_general_mails_enviados';

    /**
     * @param PDO $db Conexión PDO a la base de datos
     * @param SimpleSMTP|null $smtp Instancia de SimpleSMTP (si es null, se crea automáticamente desde Variables.txt)
     */
    public function __construct($db, $smtp = null)
    {
        $this->db = $db;

        if ($smtp) {
            $this->smtp = $smtp;
        } else {
            // Cargar config desde Variables.txt (mismo que usa el cron Go)
            $configPath = __DIR__ . '/../../../cron/Variables.txt';
            ConfigLoader::load($configPath);

            $this->smtp = new SimpleSMTP(
                ConfigLoader::get('HOST_EMAIL', 'smtp.gmail.com'),
                ConfigLoader::get('PUERTO_EMAIL', 587),
                ConfigLoader::get('USUARIO_EMAIL', ''),
                ConfigLoader::get('PASSWORD_EMAIL', '')
            );
        }
    }

    /**
     * Envía un mail y registra el envío en la base de datos.
     *
     * @param array $params Parámetros del mail (ver docblock de la clase)
     * @return array ['status' => 'success'|'error', 'message' => string, 'registro_id' => int|null]
     */
    public function enviar(array $params): array
    {
        // Validar campos requeridos
        $requeridos = ['expediente_id', 'destinatario_email', 'asunto', 'cuerpo'];
        foreach ($requeridos as $campo) {
            if (empty($params[$campo])) {
                return [
                    'status' => 'error',
                    'message' => "El campo '$campo' es requerido para enviar el mail.",
                    'registro_id' => null
                ];
            }
        }

        $expedienteId = (int) $params['expediente_id'];
        $destinatarioEmail = $params['destinatario_email'];
        $asunto = $params['asunto'];
        $cuerpo = $params['cuerpo'];
        $funcionarioId = $params['funcionario_id'] ?? null;
        $contribuyenteId = $params['contribuyente_id'] ?? null;
        $fromName = $params['from_name'] ?? 'Sistema Transformación Digital';

        // 1. Intentar enviar el mail via SMTP
        $enviado = false;
        $errorMsg = '';

        try {
            $enviado = $this->smtp->send($destinatarioEmail, $asunto, $cuerpo, $fromName);
            if (!$enviado) {
                $errorMsg = 'SimpleSMTP retornó false al enviar el mail.';
            }
        } catch (\Exception $e) {
            $errorMsg = 'Excepción al enviar mail: ' . $e->getMessage();
            error_log("MailService Error: " . $errorMsg);
        }

        // 2. Registrar en la base de datos (se registra incluso si falla el envío, para tener traza)
        $registroId = null;
        try {
            // Preparar contenido para registro (incluye asunto + cuerpo + estado)
            $contenidoRegistro = json_encode([
                'asunto' => $asunto,
                'cuerpo' => $cuerpo,
                'email' => $destinatarioEmail,
                'enviado' => $enviado,
                'error' => $errorMsg ?: null
            ], JSON_UNESCAPED_UNICODE);

            $query = "INSERT INTO {$this->table} 
                (gme_expediente, gme_destinatario_funcionario, gme_destinatario_no_funcionario, gme_contenido, gme_borado) 
                VALUES (:expediente, :funcionario, :contribuyente, :contenido, 0)";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':expediente', $expedienteId, PDO::PARAM_INT);
            $stmt->bindValue(':funcionario', $funcionarioId, $funcionarioId ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $stmt->bindValue(':contribuyente', $contribuyenteId, $contribuyenteId ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $stmt->bindValue(':contenido', $contenidoRegistro);
            $stmt->execute();

            $registroId = (int) $this->db->lastInsertId();
        } catch (\Exception $e) {
            error_log("MailService DB Error: " . $e->getMessage());
        }

        if ($enviado) {
            return [
                'status' => 'success',
                'message' => "Mail enviado correctamente a $destinatarioEmail",
                'registro_id' => $registroId
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $errorMsg ?: 'Error desconocido al enviar el mail.',
                'registro_id' => $registroId
            ];
        }
    }

    /**
     * Envía mails a múltiples destinatarios y registra cada uno.
     *
     * @param array $destinatarios Array de arrays con datos de cada destinatario
     * @param int $expedienteId ID del expediente compartido
     * @param string $asunto Asunto compartido para todos
     * @param string $cuerpo Cuerpo compartido (se puede personalizar con {nombre} placeholder)
     * @return array ['total' => int, 'enviados' => int, 'fallidos' => int, 'detalle' => array]
     */
    public function enviarMasivo(array $destinatarios, int $expedienteId, string $asunto, string $cuerpo): array
    {
        $resultados = [
            'total' => count($destinatarios),
            'enviados' => 0,
            'fallidos' => 0,
            'detalle' => []
        ];

        foreach ($destinatarios as $dest) {
            $email = $dest['email'] ?? null;
            $nombre = $dest['nombre'] ?? '';
            $funcionarioId = $dest['funcionario_id'] ?? null;
            $contribuyenteId = $dest['contribuyente_id'] ?? null;

            if (!$email) {
                $resultados['fallidos']++;
                $resultados['detalle'][] = [
                    'email' => 'N/A',
                    'status' => 'error',
                    'message' => 'Email no proporcionado'
                ];
                continue;
            }

            // Personalizar cuerpo reemplazando {nombre}
            $cuerpoPersonalizado = str_replace('{nombre}', $nombre, $cuerpo);

            $resultado = $this->enviar([
                'expediente_id' => $expedienteId,
                'destinatario_email' => $email,
                'asunto' => $asunto,
                'cuerpo' => $cuerpoPersonalizado,
                'funcionario_id' => $funcionarioId,
                'contribuyente_id' => $contribuyenteId
            ]);

            if ($resultado['status'] === 'success') {
                $resultados['enviados']++;
            } else {
                $resultados['fallidos']++;
            }

            $resultados['detalle'][] = array_merge(['email' => $email], $resultado);
        }

        return $resultados;
    }

    /**
     * Obtiene el historial de mails enviados para un expediente.
     * Devuelve datos del destinatario (funcionario o contribuyente) con rut y nombre.
     *
     * @param int $expedienteId ID del expediente
     * @return array Lista de registros de mail
     */
    public function obtenerHistorialPorExpediente(int $expedienteId): array
    {
        $query = "SELECT gme.*, 
                    -- Datos del funcionario destinatario
                    u.usr_rut AS funcionario_rut,
                    UPPER(CONCAT(u.usr_nombre, ' ', u.usr_apellido)) AS funcionario_nombre,
                    u.usr_email AS funcionario_email,
                    -- Datos del contribuyente destinatario
                    c.tgc_rut AS contribuyente_rut,
                    c.tgc_tipo AS contribuyente_tipo,
                    CASE 
                        WHEN c.tgc_tipo = 'juridica' THEN UPPER(c.tgc_razon_social)
                        ELSE UPPER(CONCAT(c.tgc_nombre, ' ', IFNULL(c.tgc_apellido_paterno, ''), ' ', IFNULL(c.tgc_apellido_materno, '')))
                    END AS contribuyente_nombre,
                    c.tgc_correo_electronico AS contribuyente_email,
                    -- Campos unificados (funcionario O contribuyente)
                    CASE 
                        WHEN gme.gme_destinatario_funcionario IS NOT NULL THEN u.usr_rut
                        ELSE c.tgc_rut
                    END AS destinatario_rut,
                    CASE 
                        WHEN gme.gme_destinatario_funcionario IS NOT NULL THEN UPPER(CONCAT(u.usr_nombre, ' ', u.usr_apellido))
                        WHEN c.tgc_tipo = 'juridica' THEN UPPER(c.tgc_razon_social)
                        ELSE UPPER(CONCAT(c.tgc_nombre, ' ', IFNULL(c.tgc_apellido_paterno, ''), ' ', IFNULL(c.tgc_apellido_materno, '')))
                    END AS destinatario_nombre_completo,
                    CASE 
                        WHEN gme.gme_destinatario_funcionario IS NOT NULL THEN u.usr_email
                        ELSE c.tgc_correo_electronico
                    END AS destinatario_email
                  FROM {$this->table} gme
                  LEFT JOIN trd_acceso_usuarios u ON gme.gme_destinatario_funcionario = u.usr_id
                  LEFT JOIN trd_general_contribuyentes c ON gme.gme_destinatario_no_funcionario = c.tgc_id
                  WHERE gme.gme_expediente = :expediente AND (gme.gme_borado = 0 OR gme.gme_borado IS NULL)
                  ORDER BY gme.gme_creacion DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':expediente', $expedienteId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene el historial de mails enviados buscando por código público de expediente.
     * Primero resuelve el código a ID en trd_general_registro_general_expedientes,
     * luego consulta el historial con datos de funcionario o contribuyente.
     *
     * @param string $codigoExpediente Código público del expediente (rgt_id_publica)
     * @return array Lista de registros de mail
     */
    public function obtenerHistorialPorCodigoExpediente(string $codigoExpediente): array
    {
        // 1. Buscar el ID del expediente por su código público
        $queryExp = "SELECT rgt_id FROM trd_general_registro_general_expedientes 
                     WHERE rgt_id_publica = :codigo AND rgt_borrado = 0 LIMIT 1";
        $stmtExp = $this->db->prepare($queryExp);
        $stmtExp->bindValue(':codigo', $codigoExpediente, PDO::PARAM_STR);
        $stmtExp->execute();
        $expediente = $stmtExp->fetch(PDO::FETCH_ASSOC);

        if (!$expediente) {
            return [];
        }

        // 2. Reutilizar el método con JOINs completos (funcionarios + contribuyentes)
        return $this->obtenerHistorialPorExpediente((int) $expediente['rgt_id']);
    }
}

