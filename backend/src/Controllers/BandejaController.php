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

        // 3. Query 1: Ingresos Assiged to this Official
        // We select key fields and add 'origen'
        $ingresosSql = "SELECT 
                            sol_id as id, 
                            sol_nombre_expediente as asunto, 
                            sol_fecha_recepcion as fecha,
                            'DESVE' as origen,
                            sol_estado_entrega as estado -- Placeholder, derived from logic if needed
                        FROM trd_desve_solicitudes 
                        WHERE sol_funcionario_id = :fid AND sol_borrado = 0 AND sol_estado_entrega = 0";

        $stmt = $this->db->prepare($ingresosSql);
        $stmt->bindParam(':fid', $funcionarioId);
        $stmt->execute();
        $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Merge Ingresos
        $results = array_merge($results, $ingresos);

        // 4. Query 2: Patentes (Placeholder / Future Implementation)
        // logic similar to above, querying patentes table
        /*
        $patentesSql = "SELECT ... FROM trd_desve_solicitudes ...";
        ...
        $results = array_merge($results, $patentes);
        */

        // 5. Query X: Future modules...

        return $results;
    }
}
