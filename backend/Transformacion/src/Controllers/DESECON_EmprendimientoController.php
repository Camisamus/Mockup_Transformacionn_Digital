<?php

namespace App\Controllers;

use App\Models\DESECON_EMPRENDIMIENTOS;

class desecon_emprendimientocontroller
{
    private $db;
    private $emprendimiento;

    public function __construct($db)
    {
        $this->db = $db;
        $this->emprendimiento = new desecon_emprendimientos($this->db);
    }

    /**
     * Obtiene todos los emprendimientos.
     */
    public function getAll()
    {
        $result = $this->emprendimiento->getAll();
        return ["status" => "success", "data" => $result];
    }

    /**
     * Obtiene un emprendimiento por su RUT.
     */
    public function getByRut($rut)
    {
        $result = $this->emprendimiento->getByRut($rut);
        if ($result) {
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "Emprendimiento no encontrado"];
    }

    /**
     * Crea un nuevo registro de emprendimiento.
     */
    public function create($data)
    {
        // Validaciones básicas
        if (empty($data['dee_rut']) || empty($data['dee_rubro'])) {
            return ["status" => "error", "message" => "El RUT y el Rubro son obligatorios"];
        }

        // Verificar si ya existe
        $existing = $this->emprendimiento->getByRut($data['dee_rut']);
        if ($existing) {
            return ["status" => "error", "message" => "Un emprendimiento con este RUT ya existe"];
        }

        if ($this->emprendimiento->create($data)) {
            return ["status" => "success", "message" => "Emprendimiento registrado exitosamente"];
        }
        return ["status" => "error", "message" => "Error al registrar el emprendimiento"];
    }

    /**
     * Actualiza un emprendimiento.
     */
    public function update($rut, $data)
    {
        if ($this->emprendimiento->update($rut, $data)) {
            return ["status" => "success", "message" => "Emprendimiento actualizado correctamente"];
        }
        return ["status" => "error", "message" => "No se pudo actualizar el emprendimiento"];
    }

    /**
     * Elimina un emprendimiento.
     */
    public function delete($rut)
    {
        if ($this->emprendimiento->delete($rut)) {
            return ["status" => "success", "message" => "Emprendimiento eliminado correctamente"];
        }
        return ["status" => "error", "message" => "No se pudo eliminar el emprendimiento"];
    }
}
