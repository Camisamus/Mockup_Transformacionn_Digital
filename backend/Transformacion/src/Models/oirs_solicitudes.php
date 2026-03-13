<?php
namespace App\Models;

use PDO;
use PDOException;
use App\Models\general_bitacora;
use App\Models\gesdoc_documentos_carpeta;

class oirs_solicitudes
{
    private $conn;
    private $table_name = "trd_oirs_solicitud";
    private $table_name_parent = "trd_general_registro_general_expedientes";
    private $sysname = "oirs";
    private $bitacora;
    private $GesDoc;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new general_bitacora($db);
        $this->GesDoc = new gesdoc_documentos_carpeta($db);
    }

    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            $creador_id = $data['rgt_creador'] ?? $_SESSION['user_id'] ?? 1;
            $contribuyente_id = $data['rgt_contribuyente'] ?? null;

            // 1. Crear registro general de trámite
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $fecha_yymmdd = date('ymd-Hi');
            $id_publica = $fecha_yymmdd . "-OIRS-" . $random_str;

            $query_rgt = "INSERT INTO " . $this->table_name_parent . " 
                          (rgt_id_publica, rgt_tramite, rgt_creador, rgt_contribuyente) 
                          VALUES (:id_publica, :sysname, :creador, :contribuyente)";

            $stmt_rgt = $this->conn->prepare($query_rgt);
            $stmt_rgt->bindValue(":id_publica", $id_publica);
            $stmt_rgt->bindValue(":creador", $creador_id);
            $stmt_rgt->bindValue(":sysname", $this->sysname);
            $stmt_rgt->bindValue(":contribuyente", $contribuyente_id);
            $stmt_rgt->execute();
            $rgt_id = $this->conn->lastInsertId();

            // 2. Crear solicitud OIRS
            $query = "INSERT INTO " . $this->table_name . " SET
                oirs_registro_tramite = :rgt_id,
                oirs_tipo_atencion = :tipo_atencion,
                oirs_origen_consulta = :origen,
                oirs_condicion = :condicion,
                oirs_prioridad_municipal = :prioridad,
                oirs_tematica = :tematica,
                oirs_subtematica = :subtematica,
                oirs_calle = :calle,
                oirs_numero = :numero,
                oirs_aclaratoria = :aclaratoria,
                oirs_latitud = :latitud,
                oirs_longitud = :longitud,
                oirs_sector = :sector,
                oirs_descripcion = :descripcion,
                oirs_estado = :estado,
                oirs_fecha_limite = :fecha_limite,
                oirs_direccion_completa = :direccion_completa,
                oirs_propietario = :propietario";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(":rgt_id", $rgt_id);
            $stmt->bindValue(":tipo_atencion", $data['oirs_tipo_atencion']);
            $stmt->bindValue(":origen", $data['oirs_origen_consulta'] ?? 'Presencial');
            $stmt->bindValue(":condicion", $data['oirs_condicion'] ?? null);
            $stmt->bindValue(":prioridad", $data['oirs_prioridad_municipal'] ?? 1);
            $stmt->bindValue(":tematica", $data['oirs_tematica']);
            $stmt->bindValue(":subtematica", $data['oirs_subtematica'] ?? null);
            $stmt->bindValue(":calle", $data['oirs_calle'] ?? null);
            $stmt->bindValue(":numero", $data['oirs_numero'] ?? null);
            $stmt->bindValue(":aclaratoria", $data['oirs_aclaratoria'] ?? null);
            $stmt->bindValue(":latitud", $data['oirs_latitud'] ?? null);
            $stmt->bindValue(":longitud", $data['oirs_longitud'] ?? null);
            $stmt->bindValue(":sector", $data['oirs_sector'] ?? null);
            $stmt->bindValue(":descripcion", $data['oirs_descripcion']);
            $stmt->bindValue(":estado", $data['oirs_estado'] ?? 1); // 1 = Recibida
            $stmt->bindValue(":propietario", $creador_id);

            // Default deadline: 15 working days
            if (empty($data['oirs_fecha_limite'])) {
                if (!class_exists('App\Helpers\Fechas')) {
                    require_once __DIR__ . '/../Helpers/Fechas.php';
                }
                $data['oirs_fecha_limite'] = \App\Helpers\Fechas::sumarDiasHabiles(date('Y-m-d'), 15, $this->conn);
            }
            $stmt->bindValue(":fecha_limite", $data['oirs_fecha_limite']);

            // Build full address
            $full = ($data['oirs_calle'] ?? '');
            if (!empty($data['oirs_numero']))
                $full .= " " . $data['oirs_numero'];
            if (!empty($data['oirs_aclaratoria']))
                $full .= " (" . $data['oirs_aclaratoria'] . ")";

            $stmt->bindValue(":direccion_completa", trim($full));

            if ($stmt->execute()) {
                $oirs_id = $this->conn->lastInsertId();

                // 3. Bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud OIRS", $creador_id);

                // 4. Documentos
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\gesdoc_controller($this->conn);
                    foreach ($data['documentos'] as $doc) {
                        try {
                            $fileInfo = $docController->base64ToFileArray($doc['base64'], $doc['nombre']);
                            $docController->subirArchivo(
                                [$fileInfo['array']],
                                [
                                    'tramite_id' => $rgt_id,
                                    'user_id' => $creador_id
                                ]
                            );
                            fclose($fileInfo['file']);
                        } catch (\Exception $e) {
                            error_log("OirsSolicitud Error Doc: " . $e->getMessage());
                        }
                    }
                }

                $this->conn->commit();
                return ["status" => "success", "id" => $oirs_id, "rgt_id" => $rgt_id];
            }

            $this->conn->rollBack();
            return ["status" => "error", "message" => "Error al ejecutar query OIRS"];

        } catch (PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }

    public function getAll($filters = [])
    {
        $query = "SELECT o.*, r.*, t.tem_nombre, s.sub_nombre, 
                  tgc.tgc_nombre, tgc.tgc_apellido_paterno, tgc.tgc_apellido_materno, tgc.tgc_rut,
                  tgc.tgc_razon_social, tgc.tgc_tipo,
                  (SELECT ofa.ofa_rol FROM trd_oirs_asignaciones oia 
                   JOIN trd_oirs_funcionarios_areas ofa ON oia.oia_asignacion = ofa.ofa_funcionario 
                   WHERE oia.oia_solicitud = o.oirs_id AND oia.oia_borrado = 0 
                   ORDER BY oia.oia_id DESC LIMIT 1) as ofa_rol
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
                  LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  WHERE o.oirs_borrado = 0 AND r.rgt_borrado = 0";

        // basic filtering could go here
        $query .= " ORDER BY o.oirs_id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT o.*, r.*, t.tem_nombre, s.sub_nombre, sec.sec_nombre as sector_nombre,
                  tgc.tgc_nombre, tgc.tgc_apellido_paterno, tgc.tgc_apellido_materno, tgc.tgc_rut,
                  tgc.tgc_razon_social, tgc.tgc_tipo, tgc.tgc_correo_electronico, tgc.tgc_telefono_contacto, tgc.tgc_fecha_nacimiento,
                  tgc.tgc_sexo, tgc.tgc_estado_civil, tgc.tgc_nacionalidad, tgc.tgc_escolaridad,
                  tgc.tgc_nombre_fantasia, tgc.tgc_giro, tgc.tgc_rep_rut, tgc.tgc_rep_nombre_completo,
                  d.tcd_calle as cont_calle, d.tcd_numero as cont_numero, d.tcd_latitud as cont_lat, d.tcd_longitud as cont_lng
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
                  LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
                  LEFT JOIN trd_general_sectores sec ON o.oirs_sector = sec.sec_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  LEFT JOIN trd_general_contribuyente_direcciones d ON tgc.tgc_id = d.tcd_contribuyente
                  WHERE o.oirs_id = :id AND o.oirs_borrado = 0 AND r.rgt_borrado = 0";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($criteria)
    {
        $query = "SELECT o.*, r.*, t.tem_nombre, s.sub_nombre, 
                  tgc.tgc_nombre, tgc.tgc_apellido_paterno, tgc.tgc_apellido_materno, tgc.tgc_rut,
                  tgc.tgc_razon_social, tgc.tgc_tipo,
                  (SELECT ofa.ofa_rol FROM trd_oirs_asignaciones oia 
                   JOIN trd_oirs_funcionarios_areas ofa ON oia.oia_asignacion = ofa.ofa_funcionario 
                   WHERE oia.oia_solicitud = o.oirs_id AND oia.oia_borrado = 0 
                   ORDER BY oia.oia_id DESC LIMIT 1) as ofa_rol
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
                  LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  WHERE o.oirs_borrado = 0 AND r.rgt_borrado = 0";

        $params = [];

        if (!empty($criteria['id'])) {
            $query .= " AND o.oirs_id = :id";
            $params[':id'] = $criteria['id'];
        }

        if (!empty($criteria['folio'])) {
            $query .= " AND r.rgt_id_publica LIKE :folio";
            $params[':folio'] = '%' . $criteria['folio'] . '%';
        }

        if (!empty($criteria['rut'])) {
            $query .= " AND tgc.tgc_rut = :rut";
            $params[':rut'] = $criteria['rut'];
        }

        if (!empty($criteria['fecha'])) {
            $query .= " AND DATE(o.oirs_creacion) = :fecha";
            $params[':fecha'] = $criteria['fecha'];
        }

        if (isset($criteria['estado']) && $criteria['estado'] !== '' && $criteria['estado'] !== null) {
            $query .= " AND o.oirs_estado = :estado";
            $params[':estado'] = $criteria['estado'];
        }

        if (!empty($criteria['sector'])) {
            $query .= " AND o.oirs_sector = :sector";
            $params[':sector'] = $criteria['sector'];
        }

        if (!empty($criteria['tematica'])) {
            $query .= " AND o.oirs_tematica = :tematica";
            $params[':tematica'] = $criteria['tematica'];
        }

        if (!empty($criteria['subtematica'])) {
            $query .= " AND o.oirs_subtematica = :subtematica";
            $params[':subtematica'] = $criteria['subtematica'];
        }

        if (!empty($criteria['prioridad'])) {
            $query .= " AND o.oirs_prioridad_municipal = :prioridad";
            $params[':prioridad'] = $criteria['prioridad'];
        }

        if (!empty($criteria['search'])) {
            $query .= " AND (r.rgt_id_publica LIKE :search OR tgc.tgc_nombre LIKE :search OR tgc.tgc_rut LIKE :search OR tgc.tgc_apellido_paterno LIKE :search)";
            $params[':search'] = '%' . $criteria['search'] . '%';
        }

        $query .= " ORDER BY o.oirs_id DESC";

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMetrics()
    {
        try {
            // 1. Total de solicitudes (no borradas)
            $queryTotal = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE oirs_borrado = 0";
            $total = $this->conn->query($queryTotal)->fetchColumn();

            // 2. Pendientes (Estado < 4: Recibida, En Revisión, Visación, En Gestión)
            $queryPending = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE oirs_borrado = 0 AND oirs_estado < 4";
            $pending = $this->conn->query($queryPending)->fetchColumn();

            // 3. Resueltas este mes (Estado >= 4, considerando la fecha del último evento de resolución)
            $queryResolvedMonth = "SELECT COUNT(*) FROM (
                                    SELECT o.oirs_id
                                    FROM " . $this->table_name . " o
                                    JOIN trd_general_bitacora b ON o.oirs_registro_tramite = b.bit_tramite_registrado
                                    WHERE o.oirs_borrado = 0 AND o.oirs_estado >= 4
                                    GROUP BY o.oirs_id
                                    HAVING MONTH(MAX(b.bit_creacion)) = MONTH(CURRENT_DATE())
                                    AND YEAR(MAX(b.bit_creacion)) = YEAR(CURRENT_DATE())
                                ) as resolved_this_month";
            $resolvedMonth = $this->conn->query($queryResolvedMonth)->fetchColumn();

            // 4. Tiempo Promedio de Resolución (Días)
            // Calculamos la diferencia entre creación y el último evento de bitácora para los casos cerrados/terminados
            $queryAvgTime = "SELECT AVG(DATEDIFF(last_event, oirs_creacion)) as avg_days
                             FROM (
                                SELECT o.oirs_creacion, MAX(b.bit_creacion) as last_event
                                FROM trd_oirs_solicitud o
                                JOIN trd_general_bitacora b ON o.oirs_registro_tramite = b.bit_tramite_registrado
                                WHERE o.oirs_borrado = 0 AND o.oirs_estado >= 4
                                GROUP BY o.oirs_id
                             ) as resolution_times";
            $avgTime = $this->conn->query($queryAvgTime)->fetchColumn();

            return [
                "total" => (int) $total,
                "pending" => (int) $pending,
                "resolvedMonth" => (int) $resolvedMonth,
                "avgTime" => round((float) $avgTime, 1)
            ];
        } catch (PDOException $e) {
            error_log("Error in OirsSolicitud::getMetrics: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }

    public function getChartData()
    {
        try {
            // 1. Datos por Estado (Últimos 30 días)
            $queryEstado = "SELECT oirs_estado, COUNT(*) as count 
                            FROM " . $this->table_name . " 
                            WHERE oirs_borrado = 0 
                            AND oirs_creacion >= DATE_SUB(NOW(), INTERVAL 30 DAY) 
                            GROUP BY oirs_estado";
            $resEstado = $this->conn->query($queryEstado)->fetchAll(PDO::FETCH_ASSOC);

            // Mapping states to labels
            $stateLabels = [
                0 => 'Creada',
                1 => 'Visada',
                2 => 'Resp. Ejecutar',
                3 => 'Respondida',
                4 => 'Ejecutada',
                5 => 'Notificada'
            ];

            $dataEstado = [];
            foreach ($resEstado as $row) {
                $label = $stateLabels[$row['oirs_estado']] ?? 'Otro';
                $dataEstado[] = [
                    "label" => $label,
                    "value" => (int) $row['count']
                ];
            }

            // 2. Datos por Tipo de Solicitud (Atención)
            $queryTipo = "SELECT t.tat_nombre as label, COUNT(s.oirs_id) as value 
                          FROM trd_oirs_tipo_atencion t 
                          LEFT JOIN " . $this->table_name . " s ON t.tat_id = s.oirs_tipo_atencion AND s.oirs_borrado = 0 
                          WHERE t.tat_borrado = 0 
                          GROUP BY t.tat_id";
            $dataTipo = $this->conn->query($queryTipo)->fetchAll(PDO::FETCH_ASSOC);

            return [
                "estados" => $dataEstado,
                "tipos" => $dataTipo
            ];
        } catch (PDOException $e) {
            error_log("Error in OirsSolicitud::getChartData: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
}
