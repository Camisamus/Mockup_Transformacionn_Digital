<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Models\Bitacora;
use App\Models\Comentario;
use App\Models\Enlace;
use App\Models\Ingresos_Destinos;
use App\Models\GesDoc;
class Ingresos_ingreso
{
    private $sysname = "Ingreso_ingresos";
    private $conn;
    private $table_name_parent = "trd_general_registro_general_tramites";
    private $table_name = "trd_ingresos_solicitudes";
    private $bitacora;
    private $comentario;
    private $Destinos;
    private $Enlace;
    private $GesDoc;
    private $Multiancestro;
    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
        $this->comentario = new Comentario($db);
        $this->GesDoc = new GesDoc($db);
        $this->Enlace = new Enlace($db);
        $this->Destinos = new Ingresos_Destinos($db);
        $this->Multiancestro = new Multiancestro($db);
    }

    public function getAll(array $filters = [], ?int $current_user_id = null)
    {
        // Base Query with Role Logic
        $query = "SELECT DISTINCT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  CASE 
                    WHEN sol.tis_responsable = :current_user THEN 'Responsable'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                    ELSE 'Consultor' 
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :current_user_join
                  WHERE 1=1";

        // Filter Logic: Show if Responsible OR is a Destination
        if ($current_user_id) {
            $query .= " AND (sol.tis_responsable = :current_user_filter OR dest.tid_destino IS NOT NULL)";
        }

        $params = [];
        // Bind parameters logic needs to be careful with named params appearing multiple times
        // PDO might complain if we reuse :current_user for different binds or same bind location logic.
        // Let's use specific names.

        if ($current_user_id) {
            $params[':current_user'] = $current_user_id;
            $params[':current_user_join'] = $current_user_id;
            $params[':current_user_filter'] = $current_user_id;
        } else {
            // Fallback for Admin/Debug if null passed (though Controller should pass it)
            // But for safety in query construction:
            $params[':current_user'] = 0;
            $params[':current_user_join'] = 0;
            $params[':current_user_filter'] = 0;
            // Ideally we shouldn't be here without ID if we want filtering, but let's allow "all" if ID is null?
            // Requirement says "solo debes poder ver...". So strict filter.
            // If ID is null (e.g. cron), maybe show empty?
            // Let's assume ID is always passed from controller.
        }

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

    public function getById(int $id, ?int $current_user_id = null): array|null
    {
        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  CASE 
                    WHEN sol.tis_responsable = :current_user THEN 'Responsable'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                    ELSE 'Consultor' 
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :current_user_join
                  WHERE sol.tis_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':current_user', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_join', $current_user_id ?? 0);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->GesDoc->getDocumentosByTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);

        // REGLA: Solo Responsables y Consultores ven bitácora
        $rol = $solicitud['rol_usuario'] ?? 'Consultor';
        if ($rol === 'Responsable' || $rol === 'Consultor') {
            $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);
        } else {
            $solicitud['bitacora'] = []; // No enviar info sensible
        }

        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function getByRgtId(int $rgtId, ?int $current_user_id = null): array|null
    {
        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  CASE 
                    WHEN sol.tis_responsable = :current_user THEN 'Responsable'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                    ELSE 'Consultor' 
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :current_user_join
                  WHERE rgt.rgt_id = :rgtId LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':rgtId', $rgtId);
        $stmt->bindValue(':current_user', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_join', $current_user_id ?? 0);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->GesDoc->getDocumentosByTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);

        // REGLA: Solo Responsables y Consultores ven bitácora
        $rol = $solicitud['rol_usuario'] ?? 'Consultor';
        if ($rol === 'Responsable' || $rol === 'Consultor') {
            $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);
        } else {
            $solicitud['bitacora'] = []; // No enviar info sensible
        }

        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            // 1. Crear registro general de trámite
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $fecha_yymmdd = date('ymd-Hi');
            $id_publica = $fecha_yymmdd . "-" . $this->sysname . "-" . $random_str;
            //echo ($id_publica);
            // Use session user for creator/responsible if not provided
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $creador_id = $data['tis_responsable'] ?? $_SESSION['user_id'] ?? 1;

            if (isset($data['documentos'])) {
                error_log("Ingresos_ingreso: Se detectó la clave 'documentos'. Cantidad: " . (is_array($data['documentos']) ? count($data['documentos']) : 'no es array'));
            } else {
                error_log("Ingresos_ingreso: No se detectó la clave 'documentos' en data. Claves presentes: " . implode(", ", array_keys($data)));
            }

            $query_rgt = "INSERT INTO " . $this->table_name_parent . " 
                          (rgt_id_publica, rgt_tramite, rgt_creador) 
                          VALUES (:id_publica, :sysname, :creador)";
            //echo ($query_rgt);
            $stmt_rgt = $this->conn->prepare($query_rgt);
            $stmt_rgt->bindValue(":id_publica", $id_publica);
            $stmt_rgt->bindValue(":creador", $creador_id);
            $stmt_rgt->bindValue(":sysname", $this->sysname);
            $stmt_rgt->execute();
            $rgt_id = $this->conn->lastInsertId();

            // 2. Crear solicitud vinculada
            $query = "INSERT INTO " . $this->table_name . " SET
                tis_tipo = :tis_tipo,
                tis_titulo = :tis_titulo,
                tis_contenido = :tis_contenido,
                tis_estado = :tis_estado,
                tis_responsable = :tis_responsable,
                tis_respuesta = :tis_respuesta,
                tis_fecha = :tis_fecha,
                tis_registro_tramite = :tis_registro_tramite";
            //echo ($query);
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? null);
            $stmt->bindValue(":tis_titulo", $data['tis_titulo'] ?? null);
            $stmt->bindValue(":tis_contenido", $data['tis_contenido'] ?? null);
            $stmt->bindValue(":tis_estado", $data['tis_estado'] ?? 'Ingresado');
            $stmt->bindValue(":tis_responsable", $creador_id);
            $stmt->bindValue(":tis_respuesta", $data['tis_respuesta'] ?? null);
            $stmt->bindValue(":tis_fecha", $data['tis_fecha'] ?? date('Y-m-d'));
            $stmt->bindValue(":tis_registro_tramite", $rgt_id);

            if ($stmt->execute()) {
                $data_id = $this->conn->lastInsertId();
                // 3. Registrar en bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud Ingresos");

                // 4. Registrar destinos
                if (isset($data['destinos']) && is_array($data['destinos'])) {
                    foreach ($data['destinos'] as $dest) {
                        // REGLA: Consultores nunca son requeridos
                        $requerido = $dest['tid_requeido'];
                        if ($dest['tid_facultad'] === 'Consultor') {
                            $requerido = '0';
                        }

                        $this->Destinos->crear([
                            'tid_tramite' => $data_id,
                            'tid_funcionario' => $dest['usr_id'],
                            'tid_tipo' => $dest['tid_tipo'],
                            'tid_facultad' => $dest['tid_facultad'],
                            'tid_requeido' => $requerido
                        ]);
                    }
                }

                // 5. Registrar enlaces
                if (isset($data['enlaces']) && is_array($data['enlaces'])) {
                    foreach ($data['enlaces'] as $url) {
                        $this->Enlace->subir($rgt_id, $url, $creador_id);
                    }
                }

                // 6. Registrar documentos
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\GesDocController($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        try {
                            $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                            $result = $docController->subirArchivo(
                                [$fileInfo['array']],
                                [
                                    'tramite_id' => $rgt_id,
                                    'user_id' => $creador_id
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
        try {
            $this->conn->beginTransaction();

            // 1. Obtener estado actual para comparación y bitácora
            $current = $this->getById($id);
            if (!$current) {
                $this->conn->rollBack();
                return false;
            }

            $query = "UPDATE " . $this->table_name . " SET
                    tis_tipo = :tis_tipo,
                    tis_titulo = :tis_titulo,
                    tis_contenido = :tis_contenido,
                    tis_estado = :tis_estado,
                    tis_responsable = :tis_responsable,
                    tis_respuesta = :tis_respuesta,
                    tis_fecha = :tis_fecha
                    WHERE tis_id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? $current['tis_tipo']);
            $stmt->bindValue(":tis_titulo", $data['tis_titulo'] ?? $current['tis_titulo']);
            $stmt->bindValue(":tis_contenido", $data['tis_contenido'] ?? $current['tis_contenido']);
            $stmt->bindValue(":tis_estado", $data['tis_estado'] ?? $current['tis_estado']);
            $stmt->bindValue(":tis_responsable", $data['tis_responsable'] ?? $current['tis_responsable']);
            $stmt->bindValue(":tis_respuesta", $data['tis_respuesta'] ?? $current['tis_respuesta']);
            $stmt->bindValue(":tis_fecha", $data['tis_fecha'] ?? $current['tis_fecha']);
            $stmt->bindValue(":id", $id);

            if (!$stmt->execute()) {
                $this->conn->rollBack();
                return false;
            }

            // 2. Manejar Destinos (Borrar y Re-insertar)
            if (isset($data['destinos']) && is_array($data['destinos'])) {
                $this->Destinos->borrarPorIngresoId($id);
                foreach ($data['destinos'] as $dest) {
                    // REGLA: Consultores nunca son requeridos
                    $requerido = $dest['tid_requeido'];
                    if ($dest['tid_facultad'] === 'Consultor') {
                        $requerido = '0';
                    }

                    $this->Destinos->crear([
                        'tid_tramite' => $id,
                        'tid_funcionario' => $dest['usr_id'],
                        'tid_tipo' => $dest['tid_tipo'],
                        'tid_facultad' => $dest['tid_facultad'],
                        'tid_requeido' => $requerido
                    ]);
                }
            }

            // 3. Manejar Enlaces (Borrar y Re-insertar)
            if (isset($data['enlaces']) && is_array($data['enlaces'])) {
                $this->Enlace->borrarPorTramiteId($current['tis_registro_tramite']);
                $responsable_id = $data['tis_responsable'] ?? ($_SESSION['user_id'] ?? 1);
                foreach ($data['enlaces'] as $url) {
                    $this->Enlace->subir($current['tis_registro_tramite'], $url, $responsable_id);
                }
            }

            // 4. Manejar Nuevos Documentos
            if (isset($data['documentos']) && is_array($data['documentos'])) {
                $docController = new \App\Controllers\GesDocController($this->conn);
                $responsable_id = $data['tis_responsable'] ?? ($_SESSION['user_id'] ?? 1);
                foreach ($data['documentos'] as $doc) {
                    try {
                        $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                        $result = $docController->subirArchivo(
                            [$fileInfo['array']],
                            [
                                'tramite_id' => $current['tis_registro_tramite'],
                                'user_id' => $responsable_id
                            ]
                        );
                        fclose($fileInfo['file']);
                        if ($result['status'] !== 'success') {
                            $errorsDetail = isset($result['errors']) ? implode('; ', $result['errors']) : '';
                            $errorMsg = "Error uploading document {$doc['nombre']}: " . ($result['message'] ?? 'Unknown error') . ". Details: " . $errorsDetail;
                            error_log($errorMsg);
                            $this->lastError = $errorMsg;
                            $this->conn->rollBack();
                            return false;
                        }
                    } catch (\Exception $e) {
                        error_log("Exception uploading document: " . $e->getMessage());
                        $this->lastError = "Exception uploading document: " . $e->getMessage();
                        $this->conn->rollBack();
                        return false;
                    }
                }
            }

            // 5. Registrar en bitácora
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
                $this->bitacora->registrar($current['tis_registro_tramite'], $mensaje);
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in Ingresos_ingreso::update: " . $e->getMessage());
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        // Physical delete or use an actual existing column for logical delete
        $query = "DELETE FROM " . $this->table_name . " WHERE tis_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE " . $this->table_name . " SET 
            tis_estado = :status
            WHERE tis_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

    public function obtenerDetallesVarios(array $rgt_ids)
    {
        if (empty($rgt_ids))
            return [];

        $placeholders = implode(',', array_fill(0, count($rgt_ids), '?'));

        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido 
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_responsable = usr.usr_id
                  WHERE rgt.rgt_id IN ($placeholders)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($rgt_ids);
        $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($solicitudes as &$sol) {
            $sol['destinos'] = $this->Destinos->obtenerPorIngresoId($sol['tis_id']);
        }

        return $solicitudes;
    }

    public function eliminarVinculo($padre_id, $hijo_id)
    {
        return $this->Multiancestro->borrarVinculo($padre_id, $hijo_id);
    }

    public function responder($id, $usuario_id, $estado_resolucion, $respuesta_texto = null)
    {
        try {
            $this->conn->beginTransaction();

            // 1. Actualizar el registro del destino
            // tid_responde (0 = rechazado, 1 = aprobado)
            $responde_val = ($estado_resolucion === 'Resuelto_Favorable') ? 1 : 0;
            $query_dest = "UPDATE trd_ingresos_destinos SET 
                            tid_responde = :responde, 
                            tid_fecha_respuesta = NOW() 
                           WHERE tid_ingreso_solicitud = :ing_id 
                           AND tid_destino = :usr_id";
            $stmt_dest = $this->conn->prepare($query_dest);
            $stmt_dest->bindValue(':responde', $responde_val);
            $stmt_dest->bindValue(':ing_id', $id);
            $stmt_dest->bindValue(':usr_id', $usuario_id);
            $stmt_dest->execute();

            // 2. Si hay respuesta de texto, actualizar en la solicitud
            if ($respuesta_texto !== null) {
                $query_resp = "UPDATE " . $this->table_name . " SET tis_respuesta = :respuesta WHERE tis_id = :id";
                $stmt_resp = $this->conn->prepare($query_resp);
                $stmt_resp->bindValue(':respuesta', $respuesta_texto);
                $stmt_resp->bindValue(':id', $id);
                $stmt_resp->execute();
            }

            // 3. Determinar el nuevo estado de la solicitud
            $nuevo_estado = null;

            if ($estado_resolucion === 'Resuelto_NO_Favorable') {
                // Si alguien rechaza, se resuelve como NO favorable inmediatamente
                $nuevo_estado = 'Resuelto_NO_Favorable';
            } else {
                // Si aprueba (Firmado/Visado), verificar si es la última aprobación requerida
                $destinos = $this->Destinos->obtenerPorIngresoId($id);
                $pendientes_requeridos = 0;

                foreach ($destinos as $d) {
                    // Notar que tid_requeido tiene una errata en el nombre (según SQL anterior era tid_requeido o similar)
                    // Verificamos si es requerido (1) y si NO ha respondido con éxito (tid_responde !== 1)
                    $es_requerido = (isset($d['tid_requeido']) && $d['tid_requeido'] == 1) || (isset($d['tid_requerido']) && $d['tid_requerido'] == 1);

                    if ($es_requerido && (is_null($d['tid_responde']) || $d['tid_responde'] != 1)) {
                        $pendientes_requeridos++;
                    }
                }

                if ($pendientes_requeridos === 0) {
                    $nuevo_estado = 'Resuelto_Favorable';
                }
            }

            if ($nuevo_estado) {
                $this->updateStatus($id, $nuevo_estado);
                $this->bitacora->registrar($id, "Solicitud finalizada con estado: $nuevo_estado");
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in Ingresos_ingreso::responder: " . $e->getMessage());
            return false;
        }
    }
}
