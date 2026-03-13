<?php

namespace App\Models;

use PDO;
use PDOException;

class desecon_emprendimientos
{
    private $conn;
    private $table_name = "trd_desecon_emprendimientos";
    private $sysname = "desecon_emprendimiento";
    private $bitacora;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->bitacora = new general_bitacora($db);
    }

    /**
     * Obtiene todos los emprendimientos no borrados.
     */
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE dee_borrado = 0 ORDER BY dee_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un emprendimiento por su RUT.
     */
    public function getByRut($rut)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE dee_rut = :rut AND dee_borrado = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crea un nuevo emprendimiento.
     */
    public function create($data)
    {
        try {
            $query = "INSERT INTO " . $this->table_name . " SET
                dee_rut = :rut,
                dee_razon_social = :razon_social,
                dee_fantasia = :fantasia,
                dee_descripcion = :descripcion,
                dee_img_portada = :img_portada,
                dee_img_logo = :img_logo,
                dee_rubro = :rubro,
                dee_direccion = :direccion,
                dee_lat = :lat,
                dee_lon = :lon,
                dee_estado = :estado";

            $stmt = $this->conn->prepare($query);

            // Sanitize and bind
            $stmt->bindValue(':rut', $data['dee_rut']);
            $stmt->bindValue(':razon_social', $data['dee_razon_social'] ?? null);
            $stmt->bindValue(':fantasia', $data['dee_fantasia'] ?? null);
            $stmt->bindValue(':descripcion', $data['dee_descripcion'] ?? '0');
            $stmt->bindValue(':img_portada', $data['dee_img_portada'] ?? null);
            $stmt->bindValue(':img_logo', $data['dee_img_logo'] ?? null);
            $stmt->bindValue(':rubro', (int) $data['dee_rubro']);
            $stmt->bindValue(':direccion', $data['dee_direccion'] ?? null);
            $stmt->bindValue(':lat', isset($data['dee_lat']) ? (float) $data['dee_lat'] : null);
            $stmt->bindValue(':lon', isset($data['dee_lon']) ? (float) $data['dee_lon'] : null);
            $stmt->bindValue(':estado', $data['dee_estado'] ?? 'Por Validar');

            if ($stmt->execute()) {
                // Registrar en bitácora si es posible (asumiendo que hay un registro de trámite si se requiere)
                // Por ahora, solo insertamos. Si necesitamos bitácora por RUT, usaríamos GENERAL_BITACORA adecuadamente.
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error en DESECON_EMPRENDIMIENTOS::create: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza un emprendimiento existente.
     */
    public function update($rut, $data)
    {
        try {
            $query = "UPDATE " . $this->table_name . " SET
                dee_razon_social = :razon_social,
                dee_fantasia = :fantasia,
                dee_descripcion = :descripcion,
                dee_img_portada = :img_portada,
                dee_img_logo = :img_logo,
                dee_rubro = :rubro,
                dee_direccion = :direccion,
                dee_lat = :lat,
                dee_lon = :lon,
                dee_estado = :estado
                WHERE dee_rut = :rut";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':rut', $rut);
            $stmt->bindValue(':razon_social', $data['dee_razon_social'] ?? null);
            $stmt->bindValue(':fantasia', $data['dee_fantasia'] ?? null);
            $stmt->bindValue(':descripcion', $data['dee_descripcion'] ?? '0');
            $stmt->bindValue(':img_portada', $data['dee_img_portada'] ?? null);
            $stmt->bindValue(':img_logo', $data['dee_img_logo'] ?? null);
            $stmt->bindValue(':rubro', (int) $data['dee_rubro']);
            $stmt->bindValue(':direccion', $data['dee_direccion'] ?? null);
            $stmt->bindValue(':lat', isset($data['dee_lat']) ? (float) $data['dee_lat'] : null);
            $stmt->bindValue(':lon', isset($data['dee_lon']) ? (float) $data['dee_lon'] : null);
            $stmt->bindValue(':estado', $data['dee_estado'] ?? 'Por Validar');

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en DESECON_EMPRENDIMIENTOS::update: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Borrado lógico de un emprendimiento.
     */
    public function delete($rut)
    {
        $query = "UPDATE " . $this->table_name . " SET dee_borrado = 1 WHERE dee_rut = :rut";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':rut', $rut);
        return $stmt->execute();
    }
}
