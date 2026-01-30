<?php
namespace App\Controllers;

use App\Models\Enlace;

class EnlaceController
{
    private $db;
    private $enlace;

    public function __construct($db)
    {
        $this->db = $db;
        $this->enlace = new Enlace($this->db);
    }

    public function getAll($data)
    {
        $result = $this->enlace->obtenerPorRegistroId($data);
        return ["status" => "success", "data" => $result];
    }

    public function getByIDAndDownload($id) // Recibe el ID directamente
    {
        $result = $this->enlace->obtenerId($id);

        if (!$result) {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "No se encontró el registro"]);
            exit;
        }

        return ["status" => "success", "data" => $result];
    }
    public function create($data)
    {
        $tramite_id = $data['tramite_id'];
        $responsable_id = $data['responsable_id'];
        $enlace = $data['enlace'];

        if ($this->enlace->subir($tramite_id, $enlace, $responsable_id)) {
            return ["status" => "success", "message" => "Enlace guardado exitosamente"];
        }
        return ["status" => "error", "message" => "Enlace no guardado, falló el registro en BD"];
    }
    public function delete($id)
    {
        $result = $this->enlace->borrar($id);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Error al borrar el archivo"];
    }
}
