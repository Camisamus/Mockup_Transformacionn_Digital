<?php
namespace App\Models;

use PDO;
use Exception;

class DESVE_Respuesta
{
    private $conn;
    private $table_name = "trd_desve_respuestas";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    public function create($data)
    {
        // ID para buscar respuestas: puede ser el actual o el original si es un re-ingreso
        if (isset($data['sol_reingreso_id'])) {
            $id_para_respuestas = $data['sol_reingreso_id'];
        } else {
            $id_para_respuestas = $data['res_solicitud_id'];
        }
        $query = "INSERT INTO " . $this->table_name . " SET
            res_solicitud_id=:res_solicitud_id,
            res_texto=:res_texto,
            res_tipo=:res_tipo,
            res_funcionaio=:res_funcionario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":res_solicitud_id", $id_para_respuestas);
        $stmt->bindParam(":res_texto", $data['res_texto']);
        $stmt->bindValue(":res_tipo", $data['res_tipo'] ?? 'Comentario');

        // Get user ID from session 
        $funcionarioId = $_SESSION['user_id'];
        $stmt->bindValue(":res_funcionario", $funcionarioId);

        if ($stmt->execute()) {
            // Log in Bitacora
            $this->conn->beginTransaction();
            try {
                // Get the registro_tramite ID from the solicitud
                $query_sol = "SELECT sol_registro_tramite FROM trd_desve_solicitudes WHERE sol_id = :id LIMIT 1";
                $stmt_sol = $this->conn->prepare($query_sol);
                $stmt_sol->bindParam(":id", $data['res_solicitud_id']);
                $stmt_sol->execute();
                $solicitud = $stmt_sol->fetch(PDO::FETCH_ASSOC);

                if ($solicitud && $solicitud['sol_registro_tramite']) {
                    $this->bitacora->registrar($solicitud['sol_registro_tramite'], "Responde solicitud", $funcionarioId);
                }
                $this->conn->commit();
            } catch (Exception $e) {
                $this->conn->rollBack();
                error_log("Error logging response in Bitacora: " . $e->getMessage());
            }

            return true;
        }
        return false;
    }
}
