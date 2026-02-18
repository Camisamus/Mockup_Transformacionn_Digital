<?php
namespace App\Models;

use PDO;
use App\Models\Bitacora;

class OirsAsignacion
{
    private $conn;
    private $table_name = "trd_oirs_asignaciones"; // Corrected prefix to typical 'trd_'

    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    public function getBySolicitud($id)
    {
        // Assumed schema: asg_id, asg_solicitud, asg_funcionario, asg_instruccion, asg_fecha_creacion
        // Joining with funcionarios to get names
        $query = "SELECT a.*, f.usr_nombre, f.usr_apellido 
                          FROM " . $this->table_name . " a
                  LEFT JOIN trd_acceso_usuarios f ON a.oia_asignacion = f.usr_id
                  WHERE a.oia_solicitud = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            oia_solicitud = :solicitud,
            oia_asignacion = :funcionario,
            oia_instruccion = :instruccion,
            oia_nivel_asignacion = 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":solicitud", $data['solicitud']);
        $stmt->bindValue(":funcionario", $data['funcionario']);
        $stmt->bindValue(":instruccion", $data['instruccion'] ?? null);

        if ($stmt->execute()) {
            // Log to Bitacora
            try {
                $query_sol = "SELECT oirs_registro_tramite FROM trd_oirs_solicitud WHERE oirs_id = :id LIMIT 1";
                $stmt_sol = $this->conn->prepare($query_sol);
                $stmt_sol->bindParam(":id", $data['solicitud']);
                $stmt_sol->execute();
                $solicitud = $stmt_sol->fetch(PDO::FETCH_ASSOC);

                if ($solicitud && $solicitud['oirs_registro_tramite']) {
                    $funcionarioId = $data['funcionario'];
                    // Get funcionario name for better log? Or just ID. 
                    // Let's use ID for simplicity as Bitacora text usually is simple.
                    $this->bitacora->registrar($solicitud['oirs_registro_tramite'], "Asignación de OIRS (Funcionario ID: $funcionarioId)", $_SESSION['user_id'] ?? 1);
                }
            } catch (\Exception $e) {
                error_log("Error logging OIRS assignment: " . $e->getMessage());
            }

            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function checkDuplicate($solicitudId, $funcionarioId)
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                  WHERE oia_solicitud = :solicitud AND oia_asignacion = :funcionario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":solicitud", $solicitudId);
        $stmt->bindValue(":funcionario", $funcionarioId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }
}
