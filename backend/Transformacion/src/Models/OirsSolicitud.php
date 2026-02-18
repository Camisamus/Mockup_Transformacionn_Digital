<?php
namespace App\Models;

use PDO;
use PDOException;
use App\Models\Bitacora;
use App\Models\GesDoc;

class OirsSolicitud
{
    private $conn;
    private $table_name = "trd_oirs_solicitud";
    private $table_name_parent = "trd_general_registro_general_tramites";
    private $sysname = "oirs";
    private $bitacora;
    private $GesDoc;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
        $this->GesDoc = new GesDoc($db);
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
                oirs_aclaratoia = :aclaratoria,
                oirs_latitud = :latitud,
                oirs_longitud = :longitud,
                oirs_sector = :sector,
                oirs_descripcion = :descripcion,
                oirs_estado = :estado,
                oirs_fecha_limite = :fecha_limite";

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

            // Default deadline: 15 working days
            if (empty($data['oirs_fecha_limite'])) {
                if (!class_exists('App\Helpers\Fechas')) {
                    require_once __DIR__ . '/../Helpers/Fechas.php';
                }
                $data['oirs_fecha_limite'] = \App\Helpers\Fechas::sumarDiasHabiles(date('Y-m-d'), 15, $this->conn);
            }
            $stmt->bindValue(":fecha_limite", $data['oirs_fecha_limite']);

            if ($stmt->execute()) {
                $oirs_id = $this->conn->lastInsertId();

                // 3. Bitácora
                $this->bitacora->registrar($rgt_id, "Ingresa solicitud OIRS", $creador_id);

                // 4. Documentos
                if (isset($data['documentos']) && is_array($data['documentos'])) {
                    $docController = new \App\Controllers\GesDocController($this->conn);
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
                  tgc.tgc_razon_social, tgc.tgc_tipo
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
                  LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  WHERE 1=1";

        // basic filtering could go here
        $query .= " ORDER BY o.oirs_id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT o.*, r.*, t.tem_nombre, s.sub_nombre, 
                  tgc.tgc_nombre, tgc.tgc_apellido_paterno, tgc.tgc_apellido_materno, tgc.tgc_rut,
                  tgc.tgc_razon_social, tgc.tgc_tipo, tgc.tgc_correo_electronico, tgc.tgc_telefono_contacto, tgc.tgc_fecha_nacimiento,
                  tgc.tgc_sexo, tgc.tgc_estado_civil, tgc.tgc_nacionalidad, tgc.tgc_escolaridad,
                  tgc.tgc_nombre_fantasia, tgc.tgc_giro, tgc.tgc_rep_rut, tgc.tgc_rep_nombre_completo,
                  d.tcd_calle as cont_calle, d.tcd_numero as cont_numero, d.tcd_latitud as cont_lat, d.tcd_longitud as cont_lng
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_oirs_tematicas t ON o.oirs_tematica = t.tem_id
                  LEFT JOIN trd_oirs_subtematicas s ON o.oirs_subtematica = s.sub_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  LEFT JOIN trd_cont_direcciones d ON tgc.tgc_id = d.tcd_contribuyente
                  WHERE o.oirs_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function search($criteria)
    {
        $query = "SELECT o.oirs_id 
                  FROM " . $this->table_name . " o
                  JOIN " . $this->table_name_parent . " r ON o.oirs_registro_tramite = r.rgt_id
                  LEFT JOIN trd_general_contribuyentes tgc ON r.rgt_contribuyente = tgc.tgc_id
                  WHERE 1=1";

        $params = [];

        if (!empty($criteria['oirs_id'])) {
            $query .= " AND o.oirs_id = :oirs_id";
            $params[':oirs_id'] = $criteria['oirs_id'];
        }

        if (!empty($criteria['folio'])) {
            $query .= " AND r.rgt_id_publica LIKE :folio";
            $params[':folio'] = '%' . $criteria['folio'] . '%';
        }

        if (!empty($criteria['rut'])) {
            $query .= " AND tgc.tgc_rut = :rut";
            $params[':rut'] = $criteria['rut'];
        }

        $query .= " ORDER BY o.oirs_id DESC LIMIT 10"; // Limit results

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
