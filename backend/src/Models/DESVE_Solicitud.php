<?php

namespace App\Models;

use PDO;
use PDOException;

class DESVE_Solicitud
{
    private $conn;
    private $table_name = "trd_desve_solicitudes";
    private $sysname = "desve_solicitud";
    private $bitacora;
    private $comentario;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
        $this->comentario = new Comentario($db);
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sol_borrado = 0 ORDER BY sol_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|null
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sol_id = :id AND sol_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solicitud) {
            // ID para buscar respuestas
            $id_para_respuestas = $solicitud['sol_reingreso_id'] ?: $id;

            // Obtener respuestas relacionadas
            $query_respuestas = "SELECT * FROM trd_desve_respuestas WHERE res_solicitud_id = ? AND res_borrado = 0 ORDER BY res_fecha ASC";
            $stmt_respuestas = $this->conn->prepare($query_respuestas);
            $stmt_respuestas->bindParam(1, $id_para_respuestas);
            $stmt_respuestas->execute();
            $solicitud['respuestas'] = $stmt_respuestas->fetchAll(PDO::FETCH_ASSOC);

            // Obtener destinos
            $solicitud['destinos'] = $this->getDestinosBySolicitud($id);

            // Registrar consulta en bitácora (si hay sesión de usuario)
            if (isset($_SESSION['user_id'])) {
                $this->bitacora->registrar($solicitud['sol_registro_tramite'], "Consulta solicitud");
            }
            // Obtener bitácora
            $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['sol_registro_tramite']);

            // Obtener comentarios generales
            $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['sol_registro_tramite']);
        }

        return $solicitud;
    }

    public function getDestinosBySolicitud($solId)
    {
        $query = "SELECT d.*, u.usr_nombre, u.usr_apellido, u.usr_email, CONCAT(u.usr_nombre, ' ', u.usr_apellido) as usr_nombre_completo 
                  FROM trd_desve_destinos d
                  LEFT JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  WHERE d.tid_desve_solicitud = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $solId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDestinos($solId, $destinos)
    {
        if (!is_array($destinos) || empty($destinos))
            return;

        $query = "INSERT INTO trd_desve_destinos 
                  (tid_desve_solicitud, tid_destino, tid_responde) 
                  VALUES (:sol_id, :destino, null)";
        $stmt = $this->conn->prepare($query);

        foreach ($destinos as $d) {
            $destinoId = is_array($d) ? ($d['usr_id'] ?? null) : $d;
            if (!$destinoId) {
                echo ("entro :(");
                continue;
            }

            $stmt->bindValue(':sol_id', $solId);
            $stmt->bindValue(':destino', $destinoId);
            $stmt->execute();
        }
    }

    public function deleteDestinosBySolicitud($solId)
    {
        $query = "DELETE FROM trd_desve_destinos WHERE tid_desve_solicitud = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $solId);
        $stmt->execute();
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            // Fallback for responsible user from session if not provided
            $responsable_id = $data['sol_responsable'] ?? ($_SESSION['user_id'] ?? 1);

            // 1. Crear registro general de trámite
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $fecha_yymmdd = date('ymd-Hi');
            $id_publica = $fecha_yymmdd . "-" . $this->sysname . "-" . $random_str;

            $query_rgt = "INSERT INTO trd_general_registro_general_tramites 
                          (rgt_id_publica, rgt_tramite, rgt_creador) 
                          VALUES (:id_publica, '{$this->sysname}', :creador)";
            $stmt_rgt = $this->conn->prepare($query_rgt);
            $stmt_rgt->bindValue(":id_publica", $id_publica);
            $stmt_rgt->bindValue(":creador", $responsable_id);
            $stmt_rgt->execute();
            $rgt_id = $this->conn->lastInsertId();

            // 2. Crear solicitud vinculada
            $query = "INSERT INTO " . $this->table_name . " SET
                sol_ingreso_desve=:sol_ingreso_desve,
                sol_nombre_expediente=:sol_nombre_expediente,
                sol_origen_id=:sol_origen_id,
                sol_origen_texto=:sol_origen_texto,
                sol_detalle=:sol_detalle,
                sol_fecha_recepcion=:sol_fecha_recepcion,
                sol_prioridad_id=:sol_prioridad_id,
                sol_funcionario_id=:sol_funcionario_id,
                sol_sector_id=:sol_sector_id,
                sol_fecha_vencimiento=:sol_fecha_vencimiento,
                sol_entrego_coordinador=:sol_entrego_coordinador,
                sol_fecha_respuesta_coordinador=:sol_fecha_respuesta_coordinador,
                sol_estado_entrega=:sol_estado_entrega,
                sol_dias_vencimiento=:sol_dias_vencimiento,
                sol_observaciones=:sol_observaciones,
                sol_dias_transcurridos=:sol_dias_transcurridos,
                sol_reingreso_id=:sol_reingreso_id,
                sol_direccion=:sol_direccion,
                sol_latitud=:sol_latitud,
                sol_longitud=:sol_longitud,
                sol_responsable=:sol_responsable,
                sol_registro_tramite=:sol_registro_tramite,
                sol_origen_esp=:sol_origen_esp";

            $stmt = $this->conn->prepare($query);

            // Helper to handle empty strings as null for IDs/numbers
            $toNull = function ($val) {
                return ($val === '' || $val === null) ? null : $val;
            };

            $stmt->bindValue(":sol_ingreso_desve", $data['sol_ingreso_desve'] ?? null);
            $stmt->bindValue(":sol_nombre_expediente", $data['sol_nombre_expediente'] ?? null);
            $stmt->bindValue(":sol_origen_id", $toNull($data['sol_origen_id'] ?? null));
            $stmt->bindValue(":sol_origen_texto", $data['sol_origen_texto'] ?? null);
            $stmt->bindValue(":sol_detalle", $data['sol_detalle'] ?? null);
            $stmt->bindValue(":sol_fecha_recepcion", $toNull($data['sol_fecha_recepcion'] ?? null));
            $stmt->bindValue(":sol_prioridad_id", $toNull($data['sol_prioridad_id'] ?? null));
            $stmt->bindValue(":sol_funcionario_id", $toNull($data['sol_funcionario_id'] ?? null));
            $stmt->bindValue(":sol_sector_id", $toNull($data['sol_sector_id'] ?? null));
            $stmt->bindValue(":sol_fecha_vencimiento", $toNull($data['sol_fecha_vencimiento'] ?? null));
            $stmt->bindValue(":sol_entrego_coordinador", (bool) ($data['sol_entrego_coordinador'] ?? false), PDO::PARAM_BOOL);
            $stmt->bindValue(":sol_fecha_respuesta_coordinador", $toNull($data['sol_fecha_respuesta_coordinador'] ?? null));
            $stmt->bindValue(":sol_estado_entrega", (bool) ($data['sol_estado_entrega'] ?? false), PDO::PARAM_BOOL);
            $stmt->bindValue(":sol_dias_vencimiento", $data['sol_dias_vencimiento'] ?? null);
            $stmt->bindValue(":sol_observaciones", $data['sol_observaciones'] ?? null);
            $stmt->bindValue(":sol_dias_transcurridos", $data['sol_dias_transcurridos'] ?? null);
            $stmt->bindValue(":sol_reingreso_id", $toNull($data['sol_reingreso_id'] ?? null));
            $stmt->bindValue(":sol_direccion", $data['sol_direccion'] ?? null);
            $stmt->bindValue(":sol_latitud", $data['sol_latitud'] ?? null);
            $stmt->bindValue(":sol_longitud", $data['sol_longitud'] ?? null);
            $stmt->bindValue(":sol_responsable", $responsable_id);
            $stmt->bindValue(":sol_registro_tramite", $rgt_id);
            // Cast to int directly to preserve 0, 1, 2 values
            $stmt->bindValue(":sol_origen_esp", (int) ($data['sol_origen_esp'] ?? 0), PDO::PARAM_INT);

            if ($stmt->execute()) {
                $data_id = $this->conn->lastInsertId();

                // 3. Crear destinos
                if (isset($data['destinos'])) {
                    $this->createDestinos($data_id, $data['destinos']);
                }

                // 4. Registrar en bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud: " . ($data['sol_nombre_expediente'] ?? 'Sin nombre'), $responsable_id);

                // 5. Registrar documentos adjuntos (Base64)
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\DocumentoController($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        $docData = [
                            'tramite_id' => $rgt_id,
                            'responsable_id' => $data['sol_responsable'] ?? ($_SESSION['user_id'] ?? 1),
                            'es_docdigital' => 0,
                            'nombre' => $doc['nombre'],
                            'base64' => $doc['base64']
                        ];
                        $docController->createFromBase64($docData);
                    }
                }

                $this->conn->commit();
                return [true, $data_id, $rgt_id];
            }

            $this->conn->rollBack();
            // Log error if execute fails but no exception thrown
            error_log("SQL Error in Solicitud::create: " . implode(" - ", $stmt->errorInfo()));
            return [false, null];
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in Solicitud::create: " . $e->getMessage());
            // Store error in the object to be fetched by controller
            $this->lastError = $e->getMessage();
            return [false, null];
        }
    }

    public $lastError = "";


    public function update($id, $data)
    {
        // 1. Obtener estado actual para comparación
        $current = $this->getById($id);
        if (!$current)
            return false;

        $this->conn->beginTransaction();
        $query = "UPDATE " . $this->table_name . " SET
            sol_ingreso_desve=:sol_ingreso_desve,
            sol_nombre_expediente=:sol_nombre_expediente,
            sol_origen_id=:sol_origen_id,
            sol_origen_texto=:sol_origen_texto,
            sol_detalle=:sol_detalle,
            sol_fecha_recepcion=:sol_fecha_recepcion,
            sol_prioridad_id=:sol_prioridad_id,
            sol_sector_id=:sol_sector_id,
            sol_fecha_vencimiento=:sol_fecha_vencimiento,
            sol_entrego_coordinador=:sol_entrego_coordinador,
            sol_fecha_respuesta_coordinador=:sol_fecha_respuesta_coordinador,
            sol_estado_entrega=:sol_estado_entrega,
            sol_dias_vencimiento=:sol_dias_vencimiento,
            sol_observaciones=:sol_observaciones,
            sol_dias_transcurridos=:sol_dias_transcurridos,
            sol_reingreso_id=:sol_reingreso_id,
            sol_direccion=:sol_direccion,
            sol_latitud=:sol_latitud,
            sol_longitud=:sol_longitud,
            sol_responsable=:sol_responsable,
            sol_origen_esp=:sol_origen_esp
            WHERE sol_id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":sol_ingreso_desve", $data['sol_ingreso_desve']);
        $stmt->bindParam(":sol_nombre_expediente", $data['sol_nombre_expediente']);
        $stmt->bindParam(":sol_origen_id", $data['sol_origen_id']);
        $stmt->bindParam(":sol_origen_texto", $data['sol_origen_texto']);
        $stmt->bindParam(":sol_detalle", $data['sol_detalle']);
        $stmt->bindParam(":sol_fecha_recepcion", $data['sol_fecha_recepcion']);
        $stmt->bindParam(":sol_prioridad_id", $data['sol_prioridad_id']);
        $stmt->bindParam(":sol_sector_id", $data['sol_sector_id']);
        $stmt->bindParam(":sol_fecha_vencimiento", $data['sol_fecha_vencimiento']);
        $stmt->bindParam(":sol_entrego_coordinador", $data['sol_entrego_coordinador'], PDO::PARAM_BOOL);
        $stmt->bindParam(":sol_fecha_respuesta_coordinador", $data['sol_fecha_respuesta_coordinador']);
        $stmt->bindParam(":sol_estado_entrega", $data['sol_estado_entrega'], PDO::PARAM_BOOL);
        $stmt->bindParam(":sol_dias_vencimiento", $data['sol_dias_vencimiento']);
        $stmt->bindParam(":sol_observaciones", $data['sol_observaciones']);
        $stmt->bindParam(":sol_dias_transcurridos", $data['sol_dias_transcurridos']);
        $stmt->bindParam(":sol_reingreso_id", $data['sol_reingreso_id']);
        $stmt->bindParam(":sol_direccion", $data['sol_direccion']);
        $stmt->bindParam(":sol_latitud", $data['sol_latitud']);
        $stmt->bindParam(":sol_longitud", $data['sol_longitud']);
        $stmt->bindParam(":sol_responsable", $data['sol_responsable']);
        $stmt->bindValue(":sol_origen_esp", (int) ($data['sol_origen_esp'] ?? 0), PDO::PARAM_INT);
        $stmt->bindParam(":id", $id);

        try {
            if ($stmt->execute()) {
                // ... same detected changes logic ...
                // 2. Detectar cambios y registrar en bitácora
                $cambios = [];
                $campos_seguimiento = [
                    'sol_funcionario_id' => 'funcionario asignado',
                    'sol_sector_id' => 'sector',
                    'sol_prioridad_id' => 'prioridad'
                ];

                foreach ($campos_seguimiento as $campo => $label) {
                    if (isset($data[$campo]) && $data[$campo] != $current[$campo]) {
                        $cambios[] = "$label de \"{$current[$campo]}\" a \"{$data[$campo]}\"";
                    }
                }

                if (!empty($cambios)) {
                    $mensaje = "Edita: " . implode(", ", $cambios);
                    $this->bitacora->registrar($current['sol_registro_tramite'], $mensaje);
                }

                // Manejar destinos en actualización
                if (isset($data['destinos'])) {
                    $this->deleteDestinosBySolicitud($id);
                    $this->createDestinos($id, $data['destinos']);
                }

                // Manejar nuevos documentos adjuntos (Base64)
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\DocumentoController($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        $docData = [
                            'tramite_id' => $current['sol_registro_tramite'],
                            'responsable_id' => $data['sol_responsable'] ?? ($_SESSION['user_id'] ?? 1),
                            'es_docdigital' => 0,
                            'nombre' => $doc['nombre'],
                            'base64' => $doc['base64']
                        ];
                        $docController->createFromBase64($docData);
                    }
                }

                $this->conn->commit();
                return true;
            }
        } catch (PDOException $e) {
            error_log("Database Exception in Solicitud::update: " . $e->getMessage());
            $this->lastError = $e->getMessage();
            return false;
        }
        return false;
    }

    public function delete($id)
    {
        // Logical delete
        $query = "UPDATE " . $this->table_name . " SET sol_borrado = 1 WHERE sol_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateStatus($id, $status, $entrega)
    {
        $current = $this->getById($id);
        if (!$current)
            return false;

        $fecha_respuesta = $status ? date('Y-m-d H:i:s') : null;

        $query = "UPDATE " . $this->table_name . " SET 
            sol_estado_entrega = :status, 
            sol_entrego_coordinador = :entrega,
            sol_fecha_respuesta_coordinador = :fecha
            WHERE sol_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":status", (bool) $status, PDO::PARAM_BOOL);
        $stmt->bindValue(":entrega", (bool) $entrega, PDO::PARAM_BOOL);
        $stmt->bindValue(":fecha", $fecha_respuesta);
        $stmt->bindValue(":id", $id);

        if ($stmt->execute()) {
            $estado_txt = $status ? "RESPONDIDO" : "PENDIENTE";
            $entrega_txt = $entrega ? "Sí" : "No";
            $mensaje = "Cambio de estado a $estado_txt (Entregado: $entrega_txt)";
            $this->bitacora->registrar($current['sol_registro_tramite'], $mensaje);
            return true;
        }
        return false;
    }
}
