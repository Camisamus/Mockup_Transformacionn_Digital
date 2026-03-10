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
        $query = "SELECT * FROM " . $this->table_name . " WHERE sol_borrado = 0 AND sol_estado_entrega = 0 ORDER BY sol_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTodos()
    {

        $yo = $_SESSION['user_id'];

        $query = "SELECT 
                        desve.*,
                        usu.usr_nombre as Propietario_nombre,
                        usu.usr_apellido as Propietario_apellido,
                        ex.rgt_id_publica, 
                        sol_propietario,  
                        :usu as yo, 
                        CASE 
                            WHEN desve.sol_propietario = :usu THEN 'Autor'
                            WHEN EXISTS (
                                SELECT 1 FROM transformacion_digital.trd_desve_destinos 
                                WHERE tid_desve_solicitud = desve.sol_id 
                                AND tid_destino = :usu 
                                AND tid_borrado = 0
                            ) THEN 'Responsable'
                            ELSE 'Ninguno'
                        END as mi_rol,

                        CASE 
                            WHEN desve.sol_origen_esp = 0 THEN oc.orgc_nombre
                            WHEN desve.sol_origen_esp = 3 THEN og.org_nombre
                            WHEN desve.sol_origen_esp = 1 THEN CONCAT(c.tgc_nombre, ' ', c.tgc_apellido_paterno)
                            WHEN desve.sol_origen_esp = 2 THEN od.org_nombre
                            ELSE desve.sol_origen_texto
                        END as sol_origen_nombre,
                        CASE 
                            WHEN desve.sol_origen_esp = 0 THEN toc.tor_nombre
                            WHEN desve.sol_origen_esp = 3 THEN tog.tor_nombre
                            WHEN desve.sol_origen_esp = 1 THEN 'Particular / Contribuyente'
                            WHEN desve.sol_origen_esp = 2 THEN tod.tor_nombre
                            ELSE 'N/A'
                        END as sol_origen_tipo_nombre
                    FROM trd_desve_solicitudes desve
                    INNER JOIN trd_general_registro_general_expedientes ex ON desve.sol_registro_tramite = ex.rgt_id
                    LEFT JOIN trd_general_organizaciones_comunitarias oc ON desve.sol_origen_esp = 0 AND desve.sol_origen_id = oc.orgc_id
                    LEFT JOIN trd_general_tipos_organizacion toc ON oc.orgc_tipo_organizacion = toc.tor_id
                    LEFT JOIN trd_general_organizaciones og ON desve.sol_origen_esp = 3 AND desve.sol_origen_id = og.org_id
                    LEFT JOIN trd_general_tipos_organizacion tog ON og.org_tipo_id = tog.tor_id
                    LEFT JOIN trd_general_contribuyentes c ON desve.sol_origen_esp = 1 AND desve.sol_origen_id = c.tgc_id
                    LEFT JOIN trd_desve_organizaciones od ON desve.sol_origen_esp = 2 AND desve.sol_origen_id = od.org_id
                    LEFT JOIN trd_general_tipos_organizacion tod ON od.org_tipo_id = tod.tor_id
                    LEFT JOIN trd_acceso_usuarios usu ON desve.sol_propietario = usu.usr_id
                    WHERE ex.rgt_tramite = 'desve_solicitud' 
                    AND desve.sol_borrado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $yo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getHistorial()
    {
        $yo = $_SESSION['user_id'];
        $query = "SELECT 
                    desve.*,
                    usu.usr_nombre as Propietario_nombre,
                    usu.usr_apellido as Propietario_apellido,
                    ex.rgt_id_publica, sol_propietario,  $yo yo,
                    CASE 
                        WHEN desve.sol_origen_esp = 0 THEN oc.orgc_nombre
                        WHEN desve.sol_origen_esp = 3 THEN og.org_nombre
                        WHEN desve.sol_origen_esp = 1 THEN CONCAT(c.tgc_nombre, ' ', c.tgc_apellido_paterno)
                        WHEN desve.sol_origen_esp = 2 THEN od.org_nombre
                        ELSE desve.sol_origen_texto
                    END as sol_origen_nombre,
                    CASE 
                        WHEN desve.sol_origen_esp = 0 THEN toc.tor_nombre
                        WHEN desve.sol_origen_esp = 3 THEN tog.tor_nombre
                        WHEN desve.sol_origen_esp = 1 THEN 'Particular / Contribuyente'
                        WHEN desve.sol_origen_esp = 2 THEN tod.tor_nombre
                        ELSE 'N/A'
                    END as sol_origen_tipo_nombre
                  FROM trd_desve_solicitudes desve
                  INNER JOIN trd_general_registro_general_expedientes ex ON desve.sol_registro_tramite = ex.rgt_id
                  LEFT JOIN trd_general_organizaciones_comunitarias oc ON desve.sol_origen_esp = 0 AND desve.sol_origen_id = oc.orgc_id
                  LEFT JOIN trd_general_tipos_organizacion toc ON oc.orgc_tipo_organizacion = toc.tor_id
                  LEFT JOIN trd_general_organizaciones og ON desve.sol_origen_esp = 3 AND desve.sol_origen_id = og.org_id
                  LEFT JOIN trd_general_tipos_organizacion tog ON og.org_tipo_id = tog.tor_id
                  LEFT JOIN trd_general_contribuyentes c ON desve.sol_origen_esp = 1 AND desve.sol_origen_id = c.tgc_id
                  LEFT JOIN trd_desve_organizaciones od ON desve.sol_origen_esp = 2 AND desve.sol_origen_id = od.org_id
                  LEFT JOIN trd_general_tipos_organizacion tod ON od.org_tipo_id = tod.tor_id
                  LEFT JOIN trd_acceso_usuarios usu ON desve.sol_propietario = usu.usr_id
                  WHERE ex.rgt_tramite = 'desve_solicitud' 
                  AND (desve.sol_propietario = :usu or sol_id in ( SELECT tid_desve_solicitud FROM transformacion_digital.trd_desve_destinos where tid_destino=:usu  and tid_borrado=0 )) 
                  AND desve.sol_borrado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $yo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllPendientesDetailed()
    {
        $yo = $_SESSION['user_id'];
        $query = "SELECT 
                    desve.*,
                    usu.usr_nombre as Propietario_nombre,
                    usu.usr_apellido as Propietario_apellido,
                    ex.rgt_id_publica, sol_propietario, $yo yo, 
                    CASE 
                        WHEN desve.sol_origen_esp = 0 THEN oc.orgc_nombre
                        WHEN desve.sol_origen_esp = 3 THEN og.org_nombre
                        WHEN desve.sol_origen_esp = 1 THEN CONCAT(c.tgc_nombre, ' ', c.tgc_apellido_paterno)
                        WHEN desve.sol_origen_esp = 2 THEN od.org_nombre
                        ELSE desve.sol_origen_texto
                    END as sol_origen_nombre,
                    CASE 
                        WHEN desve.sol_origen_esp = 0 THEN toc.tor_nombre
                        WHEN desve.sol_origen_esp = 3 THEN tog.tor_nombre
                        WHEN desve.sol_origen_esp = 1 THEN 'Particular / Contribuyente'
                        WHEN desve.sol_origen_esp = 2 THEN tod.tor_nombre
                        ELSE 'N/A'
                    END as sol_origen_tipo_nombre
                  FROM trd_desve_solicitudes desve
                  INNER JOIN trd_general_registro_general_expedientes ex ON desve.sol_registro_tramite = ex.rgt_id
                  LEFT JOIN trd_general_organizaciones_comunitarias oc ON desve.sol_origen_esp = 0 AND desve.sol_origen_id = oc.orgc_id
                  LEFT JOIN trd_general_tipos_organizacion toc ON oc.orgc_tipo_organizacion = toc.tor_id
                  LEFT JOIN trd_general_organizaciones og ON desve.sol_origen_esp = 3 AND desve.sol_origen_id = og.org_id
                  LEFT JOIN trd_general_tipos_organizacion tog ON og.org_tipo_id = tog.tor_id
                  LEFT JOIN trd_general_contribuyentes c ON desve.sol_origen_esp = 1 AND desve.sol_origen_id = c.tgc_id
                  LEFT JOIN trd_desve_organizaciones od ON desve.sol_origen_esp = 2 AND desve.sol_origen_id = od.org_id
                  LEFT JOIN trd_general_tipos_organizacion tod ON od.org_tipo_id = tod.tor_id
                  LEFT JOIN trd_acceso_usuarios usu ON desve.sol_propietario = usu.usr_id
                  WHERE ex.rgt_tramite = 'desve_solicitud' 
                  AND (desve.sol_propietario = :usu or sol_id in ( SELECT tid_desve_solicitud FROM transformacion_digital.trd_desve_destinos where tid_destino=:usu  and tid_borrado=0 )) 
                  AND desve.sol_estado_entrega = 0 
                  AND desve.sol_borrado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $yo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPendientes()
    {
        $yo = $_SESSION['user_id'];
        $query = "SELECT desve.* FROM  trd_general_registro_general_expedientes ex,
                trd_desve_solicitudes desve
                where ex.rgt_tramite='desve_solicitud' and sol_registro_tramite=rgt_id  
                and (sol_propietario=:usu or ex.rgt_creador=:usu) and sol_estado_entrega=0 ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $yo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllForReingreso()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sol_borrado = 0 ORDER BY sol_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllNL()
    {
        $query = "SELECT DISTINCT tds.* FROM " . $this->table_name . " tds 
INNER JOIN trd_desve_destinos tdd ON tds.sol_id = tdd.tid_desve_solicitud 
WHERE tds.sol_borrado = 0 
AND tdd.tid_borrado = 0
AND tds.sol_estado_entrega = 0
AND tdd.tid_destino = :usu
OR tds.sol_propietario = :usu
ORDER BY tds.sol_id DESC;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $_SESSION['user_id']);
        $stmt->execute();
        $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $solicitudes;
    }

    public function getAllCompletedNL()
    {
        $query = "SELECT DISTINCT tds.* FROM " . $this->table_name . " tds 
LEFT JOIN trd_desve_destinos tdd ON tds.sol_id = tdd.tid_desve_solicitud AND tdd.tid_destino = :usu
WHERE tds.sol_borrado = 0 
AND tdd.tid_borrado = 0
AND tds.sol_estado_entrega = 1
AND (tdd.tid_destino IS NOT NULL OR tds.sol_propietario = :usu)
OR tds.sol_propietario = :usu
ORDER BY tds.sol_id DESC;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $_SESSION['user_id']);
        $stmt->execute();
        $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $solicitudes;
    }

    public function getAllCompletedNLWithDateFilter($fechaInicio = null, $fechaFin = null)
    {
        // Default to last 30 days if no dates provided
        if (!$fechaInicio) {
            $fechaInicio = date('Y-m-d', strtotime('-30 days'));
        }
        if (!$fechaFin) {
            $fechaFin = date('Y-m-d');
        }

        $query = "SELECT DISTINCT tds.* FROM " . $this->table_name . " tds 
LEFT JOIN trd_desve_destinos tdd ON tds.sol_id = tdd.tid_desve_solicitud AND tdd.tid_destino = :usu
WHERE tds.sol_borrado = 0 
AND tds.sol_estado_entrega = 1
AND (tdd.tid_destino IS NOT NULL OR tds.sol_propietario = :usu)
AND DATE(tds.sol_fecha_recepcion) >= :fecha_inicio
AND DATE(tds.sol_fecha_recepcion) <= :fecha_fin
ORDER BY tds.sol_id DESC;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usu', $_SESSION['user_id']);
        $stmt->bindParam(':fecha_inicio', $fechaInicio);
        $stmt->bindParam(':fecha_fin', $fechaFin);
        $stmt->execute();
        $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $solicitudes;
    }

    public function getById(int $id, bool $log_access = true): array|null
    {
        $query = "SELECT tds.*, rgt.rgt_id_publica 
                  FROM " . $this->table_name . " tds
                  LEFT JOIN trd_general_registro_general_expedientes rgt ON tds.sol_registro_tramite = rgt.rgt_id
                  WHERE tds.sol_id = :id AND tds.sol_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($solicitud) {
            // ID para buscar respuestas
            $id_para_respuestas = $solicitud['sol_reingreso_id'] ?: $id;

            // Obtener respuestas relacionadas
            $query_respuestas = "SELECT * FROM trd_desve_respuestas WHERE res_solicitud_id = ? AND res_borrado = 0 ORDER BY res_creacion ASC";
            $stmt_respuestas = $this->conn->prepare($query_respuestas);
            $stmt_respuestas->bindParam(1, $id_para_respuestas);
            $stmt_respuestas->execute();
            $solicitud['respuestas'] = $stmt_respuestas->fetchAll(PDO::FETCH_ASSOC);

            // Obtener destinos
            $solicitud['destinos'] = $this->getDestinosBySolicitud($id);

            // Registrar consulta en bitácora (si hay sesión de usuario y se solicita)
            if ($log_access && isset($_SESSION['user_id'])) {
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
        $query = "SELECT d.*, 
                         UPPER(u.usr_nombre) as usr_nombre, 
                         UPPER(u.usr_apellido) as usr_apellido, 
                         u.usr_id, 
                         u.usr_email, 
                         UPPER(CONCAT(u.usr_nombre, ' ', u.usr_apellido)) as usr_nombre_completo,
                         ga.tga_nombre as usr_area_nombre
                  FROM trd_desve_destinos d
                  LEFT JOIN trd_acceso_usuarios u ON d.tid_destino = u.usr_id
                  LEFT JOIN trd_general_areas_usuarios gau ON u.usr_id = gau.tau_usuario_id
                  LEFT JOIN trd_general_areas ga ON gau.tau_area_id = ga.tga_id
                  WHERE d.tid_desve_solicitud = ? AND d.tid_borrado = 0";
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
                continue;
            }

            $stmt->bindValue(':sol_id', $solId);
            $stmt->bindValue(':destino', $destinoId);
            $stmt->execute();
        }
    }

    public function deleteDestinosBySolicitud($solId)
    {
        $query = "UPDATE trd_desve_destinos SET tid_borrado = 1 WHERE tid_desve_solicitud = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $solId);
        $stmt->execute();
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            // Fallback for responsible user from session if not provided
            $responsable_id = $data['sol_propietario'] ?? ($_SESSION['user_id'] ?? 1);

            // 1. Crear registro general de trámite
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $fecha_yymmdd = date('ymd-Hi');
            $id_publica = $fecha_yymmdd . "-" . $this->sysname . "-" . $random_str;

            $query_rgt = "INSERT INTO trd_general_registro_general_expedientes 
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
                sol_propietario=:sol_propietario,
                sol_registro_tramite=:sol_registro_tramite,
                sol_origen_esp=:sol_origen_esp,
                sol_direccion_completa=:sol_direccion_completa";

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
            $stmt->bindValue(":sol_propietario", $responsable_id);
            $stmt->bindValue(":sol_registro_tramite", $rgt_id);
            // Cast to int directly to preserve 0, 1, 2 values
            $stmt->bindValue(":sol_origen_esp", (int) ($data['sol_origen_esp'] ?? 0), PDO::PARAM_INT);
            $stmt->bindValue(":sol_direccion_completa", $data['sol_direccion'] ?? null);

            if ($stmt->execute()) {
                $data_id = $this->conn->lastInsertId();

                // 3. Crear destinos
                if (isset($data['destinos'])) {
                    //print_r($data['destinos']);
                    $this->createDestinos($data_id, $data['destinos']);
                }

                // 4. Registrar en bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud: " . ($data['sol_nombre_expediente'] ?? 'Sin nombre'), $responsable_id);

                // 5. Registrar documentos adjuntos (Base64)
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\GesDocController($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        try {
                            $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                            $result = $docController->subirArchivo(
                                [$fileInfo['array']],
                                [
                                    'tramite_id' => $rgt_id,
                                    'user_id' => $data['sol_propietario'] ?? ($_SESSION['user_id'] ?? 1)
                                ]
                            );
                            fclose($fileInfo['file']);
                            if ($result['status'] !== 'success') {
                                error_log("Error uploading document {$doc['nombre']}: " . ($result['message'] ?? 'Unknown error'));
                            }
                        } catch (\Exception $e) {
                            error_log("Exception uploading document: " . $e->getMessage());
                        }
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
        // 1. Obtener estado actual para comparación (sin registrar "Consulta solicitud" en bitácora)
        $current = $this->getById($id, false);
        if (!$current) {
            $this->lastError = "Solicitud not found or access denied for ID: $id";
            return false;
        }

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
            sol_propietario=:sol_propietario,
            sol_funcionario_id=:sol_funcionario_id,
            sol_origen_esp=:sol_origen_esp,
            sol_direccion_completa=:sol_direccion_completa
            WHERE sol_id = :id";

        $stmt = $this->conn->prepare($query);

        // Helper to handle empty strings as null for IDs/numbers
        $toNull = function ($val) {
            return ($val === '' || $val === null) ? null : $val;
        };

        $stmt->bindValue(":sol_ingreso_desve", $data['sol_ingreso_desve'] ?? $current['sol_ingreso_desve']);
        $stmt->bindValue(":sol_nombre_expediente", $data['sol_nombre_expediente'] ?? $current['sol_nombre_expediente']);
        $stmt->bindValue(":sol_origen_id", $toNull($data['sol_origen_id'] ?? $current['sol_origen_id']));
        $stmt->bindValue(":sol_origen_texto", $data['sol_origen_texto'] ?? $current['sol_origen_texto']);
        $stmt->bindValue(":sol_detalle", $data['sol_detalle'] ?? $current['sol_detalle']);
        $stmt->bindValue(":sol_fecha_recepcion", $toNull($data['sol_fecha_recepcion'] ?? $current['sol_fecha_recepcion']));
        $stmt->bindValue(":sol_prioridad_id", $toNull($data['sol_prioridad_id'] ?? $current['sol_prioridad_id']));
        $stmt->bindValue(":sol_sector_id", $toNull($data['sol_sector_id'] ?? $current['sol_sector_id']));
        $stmt->bindValue(":sol_fecha_vencimiento", $toNull($data['sol_fecha_vencimiento'] ?? $current['sol_fecha_vencimiento']));
        $stmt->bindValue(":sol_entrego_coordinador", (bool) ($data['sol_entrego_coordinador'] ?? $current['sol_entrego_coordinador']), PDO::PARAM_BOOL);
        $stmt->bindValue(":sol_fecha_respuesta_coordinador", $toNull($data['sol_fecha_respuesta_coordinador'] ?? $current['sol_fecha_respuesta_coordinador']));
        $stmt->bindValue(":sol_estado_entrega", (bool) ($data['sol_estado_entrega'] ?? $current['sol_estado_entrega']), PDO::PARAM_BOOL);
        $stmt->bindValue(":sol_dias_vencimiento", $data['sol_dias_vencimiento'] ?? $current['sol_dias_vencimiento']);
        $stmt->bindValue(":sol_observaciones", $data['sol_observaciones'] ?? $current['sol_observaciones']);
        $stmt->bindValue(":sol_dias_transcurridos", $data['sol_dias_transcurridos'] ?? $current['sol_dias_transcurridos']);
        $stmt->bindValue(":sol_reingreso_id", $toNull($data['sol_reingreso_id'] ?? $current['sol_reingreso_id']));
        $stmt->bindValue(":sol_direccion", $data['sol_direccion'] ?? $current['sol_direccion']);
        $stmt->bindValue(":sol_latitud", $data['sol_latitud'] ?? $current['sol_latitud']);
        $stmt->bindValue(":sol_longitud", $data['sol_longitud'] ?? $current['sol_longitud']);
        $stmt->bindValue(":sol_propietario", $data['sol_propietario'] ?? $current['sol_propietario']);
        $stmt->bindValue(":sol_funcionario_id", $toNull($data['sol_funcionario_id'] ?? $current['sol_funcionario_id']));
        $stmt->bindValue(":sol_origen_esp", (int) ($data['sol_origen_esp'] ?? $current['sol_origen_esp']), PDO::PARAM_INT);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":sol_direccion_completa", $data['sol_direccion'] ?? $current['sol_direccion']);

        try {
            if ($stmt->execute()) {
                // ... same detected changes logic ...
                // 2. Detectar cambios y registrar en bitácora
                $cambios = [];
                $campos_seguimiento = [
                    'sol_ingreso_desve' => 'N° Ingreso',
                    'sol_nombre_expediente' => 'Nombre Expediente',
                    'sol_funcionario_id' => 'Funcionario',
                    'sol_sector_id' => 'Sector',
                    'sol_prioridad_id' => 'Prioridad',
                    'sol_origen_id' => 'Origen',
                    'sol_fecha_recepcion' => 'Fecha de Recepción',
                    'sol_fecha_vencimiento' => 'Fecha de Vencimiento',
                    'sol_estado_entrega' => 'Estado Entrega',
                    'sol_entrego_coordinador' => 'Entregado a Coordinador',
                    'sol_observaciones' => 'Observaciones',
                    'sol_detalle' => 'Detalle',
                    'sol_direccion' => 'Dirección',
                    'sol_reingreso_id' => 'ID Reingreso'
                ];

                foreach ($campos_seguimiento as $campo => $label) {
                    if (array_key_exists($campo, $data)) {
                        $vData = $data[$campo];
                        $vCurr = $current[$campo] ?? null;

                        // Normalización de datos para comparación justa
                        if ($vData === '' || $vData === 'null')
                            $vData = null;
                        if ($vCurr === '' || $vCurr === 'null')
                            $vCurr = null;

                        // Comparación booleana
                        if ($campo === 'sol_estado_entrega' || $campo === 'sol_entrego_coordinador') {
                            $vData = filter_var($vData, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
                            $vCurr = filter_var($vCurr, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
                        }
                        // Comparación de fechas
                        elseif ((strpos($campo, 'fecha') !== false) && $vData && $vCurr) {
                            $vData = date('Y-m-d', strtotime($vData));
                            $vCurr = date('Y-m-d', strtotime($vCurr));
                        }

                        // Solo registrar si realmente hay un cambio tras la limpieza
                        if ($vData != $vCurr) {

                            $strViejo = $vCurr;
                            $strNuevo = $vData;

                            if ($campo === 'sol_estado_entrega' || $campo === 'sol_entrego_coordinador') {
                                $strViejo = $vCurr ? 'Sí' : 'No';
                                $strNuevo = $vData ? 'Sí' : 'No';
                            }
                            // Si los valores originales eran nulos (no mapeados booleanos) mostrar como "Vacío"
                            if (is_null($vCurr) || $vCurr === '')
                                $strViejo = 'Vacío';
                            if (is_null($vData) || $vData === '')
                                $strNuevo = 'Vacío';

                            // Asegurarnos que no son objetos o arrays antes de concatenar (no debería, pero por sanidad)
                            if (!is_array($strViejo) && !is_object($strViejo) && !is_array($strNuevo) && !is_object($strNuevo)) {
                                $cambios[] = "$label de \"$strViejo\" a \"$strNuevo\"";
                            } else {
                                $cambios[] = $label;
                            }
                        }
                    }
                }

                if (isset($data['destinos']) && is_array($data['destinos'])) {
                    $newDestIds = array_map(function ($d) {
                        return is_array($d) ? ($d['usr_id'] ?? null) : $d;
                    }, $data['destinos']);
                    $currDestIds = array_map(function ($d) {
                        return $d['tid_destino'] ?? null;
                    }, $current['destinos'] ?? []);

                    // Filtrar nulos y ordenar
                    $newDestIds = array_filter($newDestIds);
                    $currDestIds = array_filter($currDestIds);
                    sort($newDestIds);
                    sort($currDestIds);

                    if ($newDestIds != $currDestIds) {
                        $cambios[] = 'Destinos';
                    }
                }

                if (isset($data['documentos']) && !empty($data['documentos'])) {
                    $cambios[] = 'Documentos';
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
                    $docController = new \App\Controllers\GesDocController($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        try {
                            $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                            $result = $docController->subirArchivo(
                                [$fileInfo['array']],
                                [
                                    'tramite_id' => $current['sol_registro_tramite'],
                                    'user_id' => $data['sol_propietario'] ?? ($_SESSION['user_id'] ?? 1)
                                ]
                            );
                            fclose($fileInfo['file']);
                            if ($result['status'] !== 'success') {
                                error_log("Error uploading document {$doc['nombre']}: " . ($result['message'] ?? 'Unknown error'));
                            }
                        } catch (\Exception $e) {
                            error_log("Exception uploading document: " . $e->getMessage());
                        }
                    }
                }

                $this->conn->commit();
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                $this->lastError = "Execute failed: " . ($errorInfo[2] ?? "Unknown database error");
                $this->conn->rollBack();
                return false;
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
        $current = $this->getById($id, false);
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
