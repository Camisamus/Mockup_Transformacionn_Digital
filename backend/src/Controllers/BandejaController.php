<?php
namespace App\Controllers;

use PDO;

class BandejaController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getInbox(int $userId): array
    {
        // 1. We no longer need to map Rut to a different table. 
        // The userId (usr_id) is the same as sol_funcionario_id now.
        $funcionarioId = $userId;

        $results = [];

        // 3. Query 1: DESVE Solicitudes
        $desveSql = "SELECT 
                            sol_id as id, 
                            sol_nombre_expediente as asunto, 
                            sol_fecha_recepcion as fecha,
                            'DESVE' as origen,
                            'Pendiente' as estado -- Hardcoded since WHERE filters for 0
                        FROM trd_desve_solicitudes sol
                        JOIN trd_desve_destinos dest ON sol.sol_id = dest.tid_desve_solicitud 
                        WHERE dest.tid_destino = :fid 
                        AND sol.sol_borrado = 0 
                        AND sol.sol_estado_entrega = 0";

        $stmt1 = $this->db->prepare($desveSql);
        $stmt1->bindParam(':fid', $funcionarioId);
        $stmt1->execute();
        $desve = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // 4. Query 2: Ingresos Solicitudes (where user is a destination)
        $ingresosSql = "SELECT 
                            sol.tis_id as id, 
                            sol.tis_titulo as asunto, 
                            sol.tis_fecha as fecha,
                            'Ingresos' as origen,
                            sol.tis_estado as estado
                        FROM trd_ingresos_solicitudes sol
                        JOIN trd_ingresos_destinos dest ON sol.tis_id = dest.tid_ingreso_solicitud
                        WHERE dest.tid_destino = :fid AND sol.tis_estado NOT IN ('Resuelto_Favorable', 'Resuelto_NO_Favorable')";

        $stmt2 = $this->db->prepare($ingresosSql);
        $stmt2->bindParam(':fid', $funcionarioId);
        $stmt2->execute();
        $ingresos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // Merge results
        $results = array_merge($desve, $ingresos);

        // Sort by date descending
        usort($results, function ($a, $b) {
            return strcmp($b['fecha'], $a['fecha']);
        });

        return $results;
    }
}
