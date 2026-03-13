<?php
namespace App\Controllers;

use App\Models\general_acceso_vecinos;

class general_vecinocontroller
{
    private $db;
    private $vecino;

    public function __construct($db)
    {
        $this->db = $db;
        $this->vecino = new general_acceso_vecinos($this->db);
    }

    public function getAll()
    {
        $result = $this->vecino->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function create($data)
    {
        if (empty($data['usr_nombre']) || empty($data['usr_rut'])) {
            return ["status" => "error", "message" => "Nombre y RUT son obligatorios"];
        }

        try {
            if ($this->vecino->create($data)) {
                return ["status" => "success", "message" => "Vecino registrado y perfil asignado exitosamente"];
            }
        } catch (\PDOException $e) {
            return ["status" => "error", "message" => "Error al registrar vecino: " . $e->getMessage()];
        }
        return ["status" => "error", "message" => "No se pudo registrar el vecino"];
    }

    public function update($id, $data)
    {
        if ($this->vecino->update($id, $data)) {
            return ["status" => "success", "message" => "Datos de vecino actualizados"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el vecino"];
    }

    public function delete($id)
    {
        if ($this->vecino->delete($id)) {
            return ["status" => "success", "message" => "Vecino eliminado"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el vecino"];
    }
}
