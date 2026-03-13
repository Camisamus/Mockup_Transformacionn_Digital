<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Models\general_bitacora;
use App\Models\general_comentarios;
use App\Models\general_enlaces;
use App\Models\ingresos_destinos;
use App\Models\gesdoc_documentos_carpeta;
use App\Models\general_multiancestro;
class ingresos_solicitudes
{
    private $sysname = "Ingreso_ingresos";
    private $conn;
    private $table_name_parent = "trd_general_registro_general_expedientes";
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
        $this->bitacora = new general_bitacora($db);
        $this->comentario = new general_comentarios($db);
        $this->GesDoc = new gesdoc_documentos_carpeta($db);
        $this->Enlace = new general_enlaces($db);
        $this->Destinos = new ingresos_destinos($db);
        $this->Multiancestro = new general_multiancestro($db);
    }

    public function getAll(array $filters = [], ?int $current_user_id = null)
    {
        // 1. Mantenemos el JOIN para saber si el usuario es destino en esa fila específica
        // Solo traemos registros donde el usuario es el destino actual
        $query = "SELECT DISTINCT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  sol.tis_fecha_limite, titi.titi_nombre as tipo_nombre,
                  CASE 
                    WHEN sol.tis_propietario = :current_user THEN 'Propietario'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_propietario = usr.usr_id
                  LEFT JOIN trd_ingresos_tipos_ingreso titi ON sol.tis_tipo = titi.titi_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud 
                                                       AND dest.tid_borrado = 0
                                                       AND dest.tid_destino = :current_user_join
                  WHERE sol.tis_borrado = 0 AND rgt.rgt_borrado = 0";


        $params = [];
        $params[':current_user'] = $current_user_id ?? 0;
        $params[':current_user_join'] = $current_user_id ?? 0;

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
        if (!empty($filters['fecha_inicio'])) {
            $query .= " AND sol.tis_creacion >= :fecha_inicio";
            $params[':fecha_inicio'] = $filters['fecha_inicio'];
        }
        if (!empty($filters['fecha_fin'])) {
            $query .= " AND sol.tis_creacion <= :fecha_fin";
            $params[':fecha_fin'] = $filters['fecha_fin'];
        }

        if (!empty($filters['tis_estado'])) {
            if (is_array($filters['tis_estado'])) {
                $statusPlaceholders = [];
                foreach ($filters['tis_estado'] as $i => $status) {
                    $key = ":tis_estado_" . $i;
                    $statusPlaceholders[] = $key;
                    $params[$key] = $status;
                }
                $query .= " AND sol.tis_estado IN (" . implode(',', $statusPlaceholders) . ")";
            } else {
                $query .= " AND sol.tis_estado = :tis_estado";
                $params[':tis_estado'] = $filters['tis_estado'];
            }
        }

        $query .= " ORDER BY sol.tis_id DESC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!class_exists('App\Helpers\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        foreach ($results as &$item) {
            if (isset($item['tis_creacion']))
                $item['tis_creacion'] = \App\Helpers\Fechas::formatearFecha($item['tis_creacion']);
            if (isset($item['tis_fecha_limite']))
                $item['tis_fecha_limite'] = \App\Helpers\Fechas::formatearFecha($item['tis_fecha_limite']);
            if (isset($item['rgt_creacion']))
                $item['rgt_creacion'] = \App\Helpers\Fechas::formatearFecha($item['rgt_creacion']);
        }
        return [$results, $query];
    }
    public function getAllMine(array $filters = [], ?int $current_user_id = null)
    {
        // 1. Mantenemos el JOIN para saber si el usuario es destino en esa fila específica
        // Solo traemos registros donde el usuario es el destino actual
        $query = "SELECT DISTINCT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  sol.tis_fecha_limite, titi.titi_nombre as tipo_nombre,
                  CASE 
                    WHEN sol.tis_propietario = :current_user THEN 'Propietario'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_propietario = usr.usr_id
                  LEFT JOIN trd_ingresos_tipos_ingreso titi ON sol.tis_tipo = titi.titi_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud 
                                                       AND dest.tid_destino = :current_user_join 
                                                       AND dest.tid_borrado = 0
                  WHERE sol.tis_borrado = 0 AND rgt.rgt_borrado = 0";

        // 2. Filtro estricto: Solo ver si es dueño o si existe un registro en destinos para él
        if ($current_user_id) {
            // Si explícitamente están pidiendo "Visado" (o resueltos), no aplicar el filtro de ocultar al Visador
            $is_history_query = false;

            if (($filters['S'] ?? '') === 'HISTORIAL') {
                $is_history_query = true;
            }

            if (!empty($filters['tis_estado'])) {
                $estados_solicitados = is_array($filters['tis_estado']) ? $filters['tis_estado'] : [$filters['tis_estado']];
                $resolved_states = ['Visado', 'Resuelto_Favorable', 'Resuelto_NO_Favorable'];

                // Si cualquiera de los estados buscados es un estado final/resuelto, es una consulta de historial
                foreach ($estados_solicitados as $est) {
                    if (in_array($est, $resolved_states)) {
                        $is_history_query = true;
                        break;
                    }
                }
            }

            if ($is_history_query) {
                // Para historial, solo verificar propiedad o destino (sin restricciones adicionales)
                $query .= " AND (
                            sol.tis_propietario = :current_user_filter 
                            OR dest.tid_id IS NOT NULL
                        )";
            } else {
                // Para la bandeja normal (pendientes), ocultar lo que el visador ya respondió
                $query .= " AND (
                            sol.tis_propietario = :current_user_filter 
                            OR (
                                dest.tid_id IS NOT NULL 
                                AND NOT (
                                    dest.tid_facultad = 'Visador' 
                                    AND dest.tid_responde IS NOT NULL
                                )
                                AND NOT (
                                    (dest.tid_facultad = 'Firmante' OR dest.tid_facultad = 'Responsable') 
                                    AND EXISTS (
                                        SELECT 1 FROM trd_ingresos_destinos d2 
                                        WHERE d2.tid_ingreso_solicitud = sol.tis_id 
                                        AND d2.tid_facultad = 'Visador' 
                                        AND d2.tid_requeido = 1 
                                        AND (d2.tid_responde IS NULL OR d2.tid_responde != 1)
                                    )
                                )
                            )
                        )";
            }
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
            // Ideally we shouldn't be here without ID if we want filtering, but let's allow "all" if ID is null?
            // Requirement says "solo debes poder ver...". So strict filter.
            // If ID is null (e.g. cron), maybe show empty?
            // Let's assume ID is always passed from controller.
            $params[':current_user_filter'] = 0;
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
        if (!empty($filters['fecha_inicio'])) {
            $query .= " AND sol.tis_creacion >= :fecha_inicio";
            $params[':fecha_inicio'] = $filters['fecha_inicio'];
        }
        if (!empty($filters['fecha_fin'])) {
            $query .= " AND sol.tis_creacion <= :fecha_fin";
            $params[':fecha_fin'] = $filters['fecha_fin'];
        }

        if (!empty($filters['tis_estado'])) {
            if (is_array($filters['tis_estado'])) {
                $statusPlaceholders = [];
                foreach ($filters['tis_estado'] as $i => $status) {
                    $key = ":tis_estado_" . $i;
                    $statusPlaceholders[] = $key;
                    $params[$key] = $status;
                }
                $query .= " AND sol.tis_estado IN (" . implode(',', $statusPlaceholders) . ")";
            } else {
                $query .= " AND sol.tis_estado = :tis_estado";
                $params[':tis_estado'] = $filters['tis_estado'];
            }
        }

        $query .= " ORDER BY sol.tis_id DESC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug: Log the search and result count
        error_log("Ingresos Search: " . $query);
        error_log("Params: " . json_encode($params));
        error_log("Count in Model: " . count($results));

        if (!class_exists('App\Helpers\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        foreach ($results as &$item) {
            if (isset($item['tis_creacion']))
                $item['tis_creacion'] = \App\Helpers\Fechas::formatearFecha($item['tis_creacion']);
            if (isset($item['tis_fecha_limite']))
                $item['tis_fecha_limite'] = \App\Helpers\Fechas::formatearFecha($item['tis_fecha_limite']);
            if (isset($item['rgt_creacion']))
                $item['rgt_creacion'] = \App\Helpers\Fechas::formatearFecha($item['rgt_creacion']);
        }

        return $results;
    }

    public function getById(int $id, ?int $current_user_id = null): array|null
    {
        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  sol.tis_fecha_limite, titi.titi_nombre as tipo_nombre,
                  CASE 
                    WHEN sol.tis_propietario = :current_user THEN 'Propietario'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                    ELSE 'Lector' 
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_propietario = usr.usr_id
                  LEFT JOIN trd_ingresos_tipos_ingreso titi ON sol.tis_tipo = titi.titi_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :current_user_join
                  WHERE sol.tis_id = :id AND sol.tis_borrado = 0 AND rgt.rgt_borrado = 0
                  AND (
                    :ignore_perms = 1
                    OR sol.tis_propietario = :current_user_filter 
                    OR (
                        dest.tid_destino IS NOT NULL 
                        AND NOT (
                            (dest.tid_facultad = 'Firmante' OR dest.tid_facultad = 'Responsable')
                            AND EXISTS (
                                SELECT 1 FROM trd_ingresos_destinos d2 
                                WHERE d2.tid_ingreso_solicitud = sol.tis_id 
                                AND d2.tid_facultad = 'Visador' 
                                AND d2.tid_requeido = 1 
                                AND (d2.tid_responde IS NULL OR d2.tid_responde != 1)
                            )
                        )
                    )
                  )
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':ignore_perms', $current_user_id === null ? 1 : 0);
        $stmt->bindValue(':current_user', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_join', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_filter', $current_user_id ?? 0);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->GesDoc->getDocumentosByTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);

        // REMOVED REGLA: Relaxed visibility so all authorized users see bitacora
        if ($current_user_id) {
            $this->bitacora->registrar($solicitud['tis_registro_tramite'], "Consulta detalles de solicitud", $current_user_id);
        }
        $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);

        if (!class_exists('App\Helpers\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        // Stop formatting tis_creacion/rgt_creacion to keep time info for the frontend
        if (isset($solicitud['tis_fecha_limite']))
            $solicitud['tis_fecha_limite'] = \App\Helpers\Fechas::formatearFecha($solicitud['tis_fecha_limite']);

        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function getByRgtId(int $rgtId, ?int $current_user_id = null): array|null
    {
        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido,
                  sol.tis_fecha_limite, titi.titi_nombre as tipo_nombre,
                  CASE 
                    WHEN sol.tis_propietario = :current_user THEN 'Propietario'
                    WHEN dest.tid_facultad IS NOT NULL THEN dest.tid_facultad
                    ELSE 'Lector' 
                  END as rol_usuario
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_propietario = usr.usr_id
                  LEFT JOIN trd_ingresos_tipos_ingreso titi ON sol.tis_tipo = titi.titi_id
                  LEFT JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud AND dest.tid_destino = :current_user_join
                  WHERE rgt.rgt_id = :rgtId AND sol.tis_borrado = 0 AND rgt.rgt_borrado = 0
                  AND (
                    sol.tis_propietario = :current_user_filter 
                    OR (
                        dest.tid_destino IS NOT NULL 
                        AND NOT (
                            (dest.tid_facultad = 'Firmante' OR dest.tid_facultad = 'Responsable')
                            AND EXISTS (
                                SELECT 1 FROM trd_ingresos_destinos d2 
                                WHERE d2.tid_ingreso_solicitud = sol.tis_id 
                                AND d2.tid_facultad = 'Visador' 
                                AND d2.tid_requeido = 1 
                                AND (d2.tid_responde IS NULL OR d2.tid_responde != 1)
                            )
                        )
                    )
                  )
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':rgtId', $rgtId);
        $stmt->bindValue(':current_user', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_join', $current_user_id ?? 0);
        $stmt->bindValue(':current_user_filter', $current_user_id ?? 0);
        $stmt->execute();
        $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$solicitud)
            return null;

        $solicitud['destinos'] = $this->Destinos->obtenerPorIngresoId($solicitud['tis_id']);
        $solicitud['documentos'] = $this->GesDoc->getDocumentosByTramite($solicitud['tis_registro_tramite']);
        $solicitud['comentarios'] = $this->comentario->getByRegistroId($solicitud['tis_registro_tramite']);
        $solicitud['enlaces'] = $this->Enlace->obtenerPorRegistroId($solicitud['tis_registro_tramite']);

        // REMOVED REGLA: Relaxed visibility so all authorized users see bitacora
        if ($current_user_id) {
            $this->bitacora->registrar($solicitud['tis_registro_tramite'], "Consulta detalles de solicitud", $current_user_id);
        }
        $solicitud['bitacora'] = $this->bitacora->obtenerPorTramite($solicitud['tis_registro_tramite']);

        if (!class_exists('App\Helpers\Fechas')) {
            require_once __DIR__ . '/../Helpers/Fechas.php';
        }

        // Stop formatting tis_creacion/rgt_creacion to keep time info for the frontend
        if (isset($solicitud['tis_fecha_limite']))
            $solicitud['tis_fecha_limite'] = \App\Helpers\Fechas::formatearFecha($solicitud['tis_fecha_limite']);

        $solicitud['multiancestro'] = $this->Multiancestro->obtenerAbolFamiliar($solicitud['tis_registro_tramite']);
        return $solicitud;
    }

    public function create($data)
    {
        try {
            // Calculate deadline if not provided
            if (empty($data['tis_fecha_limite'])) {
                if (!class_exists('App\Helpers\Fechas')) {
                    require_once __DIR__ . '/../Helpers/Fechas.php';
                }
                $data['tis_fecha_limite'] = \App\Helpers\Fechas::sumarDiasHabiles(date('Y-m-d'), 20, $this->conn);
            }

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
            $creador_id = $data['tis_propietario'] ?? $_SESSION['user_id'] ?? 1;

            if (isset($data['documentos'])) {
                error_log("INGRESOS_SOLICITUDES: Se detectó la clave 'documentos'. Cantidad: " . (is_array($data['documentos']) ? count($data['documentos']) : 'no es array'));
            } else {
                error_log("INGRESOS_SOLICITUDES: No se detectó la clave 'documentos' en data. Claves presentes: " . implode(", ", array_keys($data)));
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
                tis_propietario = :tis_propietario,
                tis_respuesta = :tis_respuesta,
                tis_creacion = :tis_creacion,
                tis_fecha_limite = :tis_fecha_limite,
                tis_registro_tramite = :tis_registro_tramite";
            //echo ($query);
            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? null);
            $stmt->bindValue(":tis_titulo", $data['tis_titulo'] ?? null);
            $stmt->bindValue(":tis_contenido", $data['tis_contenido'] ?? null);
            $stmt->bindValue(":tis_estado", $data['tis_estado'] ?? 'Ingresado');
            $stmt->bindValue(":tis_propietario", $creador_id);
            $stmt->bindValue(":tis_respuesta", $data['tis_respuesta'] ?? null);
            $stmt->bindValue(":tis_creacion", \App\Helpers\Fechas::desformatearFecha($data['tis_creacion'] ?? date('Y-m-d')));
            $stmt->bindValue(":tis_fecha_limite", \App\Helpers\Fechas::desformatearFecha($data['tis_fecha_limite']));
            $stmt->bindValue(":tis_registro_tramite", $rgt_id);

            if ($stmt->execute()) {
                $data_id = $this->conn->lastInsertId();
                // 3. Registrar en bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud Ingresos");

                // 4. Registrar destinos
                if (isset($data['destinos']) && is_array($data['destinos'])) {
                    foreach ($data['destinos'] as $dest) {
                        // REGLA: Lectores nunca son requeridos
                        $requerido = $dest['tid_requeido'];
                        if ($dest['tid_facultad'] === 'Lector') {
                            $requerido = '0';
                        }
                        if ($dest['tid_facultad'] === 'Responsable') {
                            $requerido = '1';
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
                return [true, $data_id, $rgt_id];
            }

            $this->conn->rollBack();
            // Log error if execute fails but no exception thrown
            error_log("SQL Error in INGRESOS_SOLICITUDES::create: " . implode(" - ", $stmt->errorInfo()));
            return [false, null];
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in INGRESOS_SOLICITUDES::create: " . $e->getMessage());
            // Store error in the object to be fetched by controller
            $this->lastError = $e->getMessage();
            return [false, null];
        }
    }

    public $lastError = "";


    public function update($id, $data, ?int $current_user_id = null)
    {
        try {
            $this->conn->beginTransaction();

            // 1. Obtener estado actual para comparación y bitácora
            $current = $this->getById($id, $current_user_id);
            if (!$current) {
                $this->lastError = "Solicitud not found or access denied for ID: $id";
                $this->conn->rollBack();
                return false;
            }

            $query = "UPDATE " . $this->table_name . " SET
                    tis_tipo = :tis_tipo,
                    tis_titulo = :tis_titulo,
                    tis_contenido = :tis_contenido,
                    tis_estado = :tis_estado,
                    tis_propietario = :tis_propietario,
                    tis_respuesta = :tis_respuesta,
                    tis_creacion = :tis_creacion,
                    tis_fecha_limite = :tis_fecha_limite
                    WHERE tis_id = :id";

            $stmt = $this->conn->prepare($query);

            if (!class_exists('App\Helpers\Fechas')) {
                require_once __DIR__ . '/../Helpers/Fechas.php';
            }

            $stmt->bindValue(":tis_tipo", $data['tis_tipo'] ?? $current['tis_tipo']);
            $stmt->bindValue(":tis_titulo", $data['tis_titulo'] ?? $current['tis_titulo']);
            $stmt->bindValue(":tis_contenido", $data['tis_contenido'] ?? $current['tis_contenido']);
            $stmt->bindValue(":tis_estado", $data['tis_estado'] ?? $current['tis_estado']);
            $stmt->bindValue(":tis_propietario", $data['tis_propietario'] ?? $current['tis_propietario']);
            $stmt->bindValue(":tis_respuesta", $data['tis_respuesta'] ?? $current['tis_respuesta']);
            $stmt->bindValue(":tis_creacion", \App\Helpers\Fechas::desformatearFecha($data['tis_creacion'] ?? $current['tis_creacion']));
            $stmt->bindValue(":tis_fecha_limite", \App\Helpers\Fechas::desformatearFecha($data['tis_fecha_limite'] ?? $current['tis_fecha_limite']));
            $stmt->bindValue(":id", $id);

            if (!$stmt->execute()) {
                $errorInfo = $stmt->errorInfo();
                $this->lastError = "Execute failed: " . ($errorInfo[2] ?? "Unknown database error");
                $this->conn->rollBack();
                return false;
            }

            // 2. Manejar Destinos (Borrar y Re-insertar)
            if (isset($data['destinos']) && is_array($data['destinos'])) {
                $this->Destinos->borrarPorIngresoId($id);
                foreach ($data['destinos'] as $dest) {
                    // REGLA: Lectores nunca son requeridos
                    $requerido = $dest['tid_requeido'];
                    if ($dest['tid_facultad'] === 'Lector') {
                        $requerido = '0';
                    }
                    if ($dest['tid_facultad'] === 'Responsable') {
                        $requerido = '1';
                    }

                    $this->Destinos->crear([
                        'tid_tramite' => $id,
                        'tid_funcionario' => $dest['usr_id'],
                        'tid_tipo' => $dest['tid_tipo'],
                        'tid_facultad' => $dest['tid_facultad'],
                        'tid_requeido' => $requerido,
                        'tid_tarea' => $dest['tid_tarea'] ?? 'tomar conocimiento'
                    ]);
                }
            }

            // 3. Manejar Enlaces (Borrar y Re-insertar)
            if (isset($data['enlaces']) && is_array($data['enlaces'])) {
                $this->Enlace->borrarPorTramiteId($current['tis_registro_tramite']);
                $propietario_id = $data['tis_propietario'] ?? ($_SESSION['user_id'] ?? 1);
                foreach ($data['enlaces'] as $url) {
                    $this->Enlace->subir($current['tis_registro_tramite'], $url, $propietario_id);
                }
            }

            // 4. Manejar Nuevos Documentos
            if (isset($data['documentos']) && is_array($data['documentos'])) {
                $docController = new \App\Controllers\GesDocController($this->conn);
                $propietario_id = $data['tis_propietario'] ?? ($_SESSION['user_id'] ?? 1);
                foreach ($data['documentos'] as $doc) {
                    try {
                        $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                        $result = $docController->subirArchivo(
                            [$fileInfo['array']],
                            [
                                'tramite_id' => $current['tis_registro_tramite'],
                                'user_id' => $propietario_id
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
            error_log("Database Exception in INGRESOS_SOLICITUDES::update: " . $e->getMessage());
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        $query = "UPDATE " . $this->table_name . " SET tis_borrado = 1 WHERE tis_id = ?";
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

        $query = "SELECT sol.*, rgt.*, UPPER(usr.usr_nombre) as resp_nombre, UPPER(usr.usr_apellido) as resp_apellido, sol.tis_fecha_limite 
                  FROM " . $this->table_name . " sol 
                  JOIN " . $this->table_name_parent . " rgt ON sol.tis_registro_tramite = rgt.rgt_id 
                  LEFT JOIN trd_acceso_usuarios usr ON sol.tis_propietario = usr.usr_id
                  WHERE rgt.rgt_id IN ($placeholders) AND sol.tis_borrado = 0 AND rgt.rgt_borrado = 0";

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
                            tid_fecha_respuesta = NOW(),
                            tid_respuesta = :respuesta 
                           WHERE tid_ingreso_solicitud = :ing_id 
                           AND tid_destino = :usr_id";
            $stmt_dest = $this->conn->prepare($query_dest);
            $stmt_dest->bindValue(':responde', $responde_val);
            $stmt_dest->bindValue(':ing_id', $id);
            $stmt_dest->bindValue(':usr_id', $usuario_id);
            $stmt_dest->bindValue(':respuesta', $respuesta_texto);
            $stmt_dest->execute();

            // 2. Obtener el RGT ID para la bitácora antes de proceder
            $query_rgt = "SELECT tis_registro_tramite FROM " . $this->table_name . " WHERE tis_id = :id";
            $stmt_rgt = $this->conn->prepare($query_rgt);
            $stmt_rgt->bindValue(':id', $id);
            $stmt_rgt->execute();
            $rgt_id = $stmt_rgt->fetchColumn();

            if ($rgt_id) {
                $this->bitacora->registrar($rgt_id, "Funcionario responde a solicitud ($estado_resolucion)");
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
                if ($rgt_id) {
                    $this->bitacora->registrar($rgt_id, "Solicitud finalizada con estado: $nuevo_estado");
                }
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log("Database Exception in INGRESOS_SOLICITUDES::responder: " . $e->getMessage());
            return false;
        }
    }

    public function getMetrics()
    {
        $metrics = [
            'total' => 0,
            'pendientes' => 0,
            'resueltas_mes' => 0,
            'tiempo_promedio' => '0d'
        ];

        try {
            // Totales
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM " . $this->table_name . " WHERE tis_borrado = 0");
            $stmt->execute();
            $metrics['total'] = $stmt->fetchColumn();

            // Pendientes
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM " . $this->table_name . " WHERE tis_borrado = 0 AND tis_estado NOT LIKE 'Resuelto%'");
            $stmt->execute();
            $metrics['pendientes'] = $stmt->fetchColumn();

            // Resueltas este mes
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM " . $this->table_name . " WHERE tis_borrado = 0 AND tis_estado LIKE 'Resuelto%' AND MONTH(tis_creacion) = MONTH(CURRENT_DATE()) AND YEAR(tis_creacion) = YEAR(CURRENT_DATE())");
            $stmt->execute();
            $metrics['resueltas_mes'] = $stmt->fetchColumn();

            // Tiempo Promedio
            $stmt = $this->conn->prepare("
                SELECT AVG(DATEDIFF(b.bit_fecha, s.tis_creacion)) as promedio
                FROM " . $this->table_name . " s
                JOIN trd_general_bitacora b ON s.tis_registro_tramite = b.bit_registro
                WHERE s.tis_estado LIKE 'Resuelto%' 
                AND b.bit_descripcion LIKE '%finalizada%'
            ");
            $stmt->execute();
            $avg = $stmt->fetchColumn();
            $metrics['tiempo_promedio'] = ($avg ? round($avg, 1) : '0') . 'd';

        } catch (PDOException $e) {
            error_log("Error getting Ingresos metrics: " . $e->getMessage());
        }

        return $metrics;
    }

    public function getChartData()
    {
        $data = [
            'estados' => [],
            'tipos' => []
        ];

        try {
            // Estados últimos 30 días
            $stmt = $this->conn->prepare("
                SELECT tis_estado as label, COUNT(*) as value 
                FROM " . $this->table_name . " 
                WHERE tis_borrado = 0 AND tis_creacion >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                GROUP BY tis_estado
            ");
            $stmt->execute();
            $data['estados'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Tipos de Ingreso 
            $stmt = $this->conn->prepare("
                SELECT tis_tipo as label, COUNT(*) as value 
                FROM " . $this->table_name . " 
                WHERE tis_borrado = 0 
                GROUP BY tis_tipo
            ");
            $stmt->execute();
            $data['tipos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error getting Ingresos chart data: " . $e->getMessage());
        }

        return $data;
    }
}
