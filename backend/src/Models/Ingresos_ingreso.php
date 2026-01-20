<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Models\Bitacora;
use App\Models\Comentario;
use App\Models\Enlace;
use App\Models\Ingresos_Destinos;
use App\Models\Documento;
class Ingresos_ingreso
{
    private $conn;
    private $table_name_parent = "trd_general_registro_general_tramites";
    private $table_name = "trd_ingresos_solicitudes";
    private $bitacora;
    private $comentario;
    private $Destinos;
    private $Enlace;
    private $Documentos;
    private $Multiancestro;
    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
        $this->comentario = new Comentario($db);
        $this->Documentos = new Documento($db);
        $this->Enlace = new Enlace($db);
        $this->Destinos = new Ingresos_Destinos($db);
        $this->Multiancestro = new Multiancestro($db);
    }

    public function getAll(array $filters = [])
    {
        $query = "SELECT sol.*, rgt.*, usr.usr_nombre as resp_nombre, usr.usr_apellido as resp_apellido 
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  WHERE 1=1";

        $params = [];

        if (!empty($filters['tis_titulo'])) {
            $query .= " AND sol.tis_titulo LIKE :tis_titulo";
            $params[':tis_titulo'] = '%' . $filters['tis_titulo'] . '%';
        }

        if (!empty($filters['rgt_id_publica'])) {
            $query .= " AND rgt.rgt_id_publica LIKE :rgt_id_publica";
            $params[':rgt_id_publica'] = '%' . $filters['rgt_id_publica'] . '%';
        }

        if (!empty($filters['tis_id'])) {
            $query .= " AND sol.tis_id = :tis_id";
            $params[':tis_id'] = $filters['tis_id'];
        }

        $query .= " ORDER BY sol.tis_id DESC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|null
    {
        $query = "SELECT sol.*, rgt.*, usr.usr_nombre as resp_nombre, usr.usr_apellido as resp_apellido 
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  WHERE sol.tis_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->Documentos->obtenerPorTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);
        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function getByRgtId(int $rgtId): array|null
    {
        $query = "SELECT sol.*, rgt.*, usr.usr_nombre as resp_nombre, usr.usr_apellido as resp_apellido 
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  WHERE rgt.rgt_id = :rgtId LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rgtId', $rgtId);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->Documentos->obtenerPorTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);
        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            // 1. Crear registro general de trámite
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            $fecha_yymmdd = date('ymd');
            $id_publica = hash('sha256', $random_str . $fecha_yymmdd);

            $query_rgt = "INSERT INTO " . $this->table_name_parent . " 
                          (rgt_id_publica, rgt_tramite, rgt_creador) 
                          VALUES (:id_publica, 'Ingreso_ingresos', :creador)";
            $stmt_rgt = $this->conn->prepare($query_rgt);
            $stmt_rgt->bindValue(":id_publica", $id_publica);
            $stmt_rgt->bindValue(":creador", $data['sol_responsable']);
            $stmt_rgt->execute();
            $rgt_id = $this->conn->lastInsertId();

            // 2. Crear solicitud vinculada
            $query = "INSERT INTO " . $this->table_name . " SET
                tis_id = :tis_id,
                tis_tipo = :tis_tipo,
                tis_titulo = :tis_titulo,
                tis_contenido = :tis_contenido,
                tis_estado = :tis_estado,
                tis_responsable = :tis_responsable,
                tis_respuesta = :tis_respuesta,
                tis_tramite = :tis_tramite,
                tis_fecha = :tis_fecha,
                tis_borrado = 0";
            $stmt = $this->conn->prepare($query);

            // Helper to handle empty strings as null for IDs/numbers
            $toNull = function ($val) {
                return ($val === '' || $val === null) ? null : $val;
            };

            $stmt->bindValue(":tis_id", $data['tis_id'] ?? null);
            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? null);
            $stmt->bindValue(":tis_titulo", $data['tis_titulo'] ?? null);
            $stmt->bindValue(":tis_contenido", $data['tis_contenido'] ?? null);
            $stmt->bindValue(":tis_estado", $data['tis_estado'] ?? null);
            $stmt->bindValue(":tis_responsable", $data['tis_responsable'] ?? null);
            $stmt->bindValue(":tis_respuesta", $data['tis_respuesta'] ?? null);
            $stmt->bindValue(":tis_tramite", $data['tis_tramite'] ?? null);
            $stmt->bindValue(":tis_fecha", $data['tis_fecha'] ?? null);

            $stmt->execute();

            $stmt->bindValue(":tis_id", $data['tis_id'] ?? null);
            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? null);
            $stmt->bindValue(":tis_titulo", $toNull($data['tis_origen_id'] ?? null));
            $stmt->bindValue(":tis_contenido", $data['tis_origen_texto'] ?? null);
            $stmt->bindValue(":tis_estado", $data['tis_detalle'] ?? null);
            $stmt->bindValue(":tis_responsable", $toNull($data['tis_fecha_recepcion'] ?? null));
            $stmt->bindValue(":tis_respuesta", $toNull($data['tis_prioridad_id'] ?? null));
            $stmt->bindValue(":tis_tramite", $toNull($data['tis_funcionario_id'] ?? null));
            $stmt->bindValue(":tis_fecha", $toNull($data['tis_fecha_vencimiento'] ?? null));
            $stmt->bindValue(":tis_registro_tramite", $rgt_id);

            if ($stmt->execute()) {
                $data_id = $this->conn->lastInsertId();
                // 3. Registrar en bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud Ingresos: " . $data['tis_responsable'] ?? null);
                $this->conn->commit();
                return [true, $data_id];
            }

            $this->conn->rollBack();
            // Log error if execute fails but no exception thrown
            error_log("SQL Error in Ingresos_ingreso::create: " . implode(" - ", $stmt->errorInfo()));
            return [false, null];
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in Ingresos_ingreso::create: " . $e->getMessage());
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

        $query = "UPDATE " . $this->table_name . " SET
                tis_id = :tis_id,
                tis_tipo = :tis_tipo,
                tis_titulo = :tis_titulo,
                tis_contenido = :tis_contenido,
                tis_estado = :tis_estado,
                tis_responsable = :tis_responsable,
                tis_respuesta = :tis_respuesta,
                tis_tramite = :tis_tramite,
                tis_fecha = :tis_fecha,
                tis_borrado = 0
                WHERE tis_id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tis_id", $data['tis_id']);
        $stmt->bindParam(":tis_tipo", $data['tis_tipo']);
        $stmt->bindParam(":tis_titulo", $data['tis_titulo']);
        $stmt->bindParam(":tis_contenido", $data['tis_contenido']);
        $stmt->bindParam(":tis_estado", $data['tis_estado']);
        $stmt->bindParam(":tis_responsable", $data['tis_responsable']);
        $stmt->bindParam(":tis_respuesta", $data['tis_respuesta']);
        $stmt->bindParam(":tis_tramite", $data['tis_tramite']);
        $stmt->bindParam(":tis_fecha", $data['tis_fecha']);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            // 2. Detectar cambios y registrar en bitácora
            $cambios = [];
            $campos_seguimiento = [
                'tis_titulo' => 'titulo',
                'tis_contenido' => 'contenido',
                'tis_respuesta' => 'respuesta',
            ];

            foreach ($campos_seguimiento as $campo => $label) {
                if (isset($data[$campo]) && $data[$campo] != $current[$campo]) {
                    $cambios[] = "$label";
                }
            }

            if (!empty($cambios)) {
                $mensaje = "Edita: " . implode(", ", $cambios);
                $this->bitacora->registrar($current['tis_tramite'], $mensaje);
            }

            return true;
        }
        return false;
    }

    public function delete($id)
    {
        // Logical delete
        $query = "UPDATE " . $this->table_name . " SET tis_borrado = 1 WHERE tis_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateStatus($id, $status)
    {
        $current = $this->getById($id);
        if (!$current)
            return false;

        $query = "UPDATE " . $this->table_name . " SET 
            tis_estado = :status
            WHERE tis_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":status", (bool) $status, PDO::PARAM_BOOL);
        $stmt->bindValue(":id", $id);

        return false;
    }
}
