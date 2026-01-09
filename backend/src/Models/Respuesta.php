<?php
namespace App\Models;

use PDO;
use Exception;

class Respuesta
{
    private $conn;
    private $table_name = "trd_ingresos_respuestas";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new Bitacora($db);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            res_solicitud_id=:res_solicitud_id,
            res_texto=:res_texto,
            res_tipo=:res_tipo,
            res_funcionaio=:res_funcionario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":res_solicitud_id", $data['res_solicitud_id']);
        $stmt->bindParam(":res_texto", $data['res_texto']);
        $stmt->bindValue(":res_tipo", $data['res_tipo'] ?? 'Comentario');

        // Get user ID from session if not provided
        $funcionarioId = $data['res_funcionario'] ?? $_SESSION['user_id'] ?? null;
        $stmt->bindValue(":res_funcionario", $funcionarioId);

        if ($stmt->execute()) {
            // Log in Bitacora
            $this->conn->beginTransaction();
            try {
                // Get the registro_tramite ID from the solicitud
                $query_sol = "SELECT sol_registro_tramite FROM trd_ingresos_solicitudes WHERE sol_id = :id LIMIT 1";
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
