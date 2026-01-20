<?php

namespace App\Models;

use PDO;
use Exception;

class Multiancestro
{
    private $conn;
    private $table_name = "trd_general_multiancestro";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * gma_id
     * gma_padre
     * gma_hijo
     * Registra un evento en la bitácora
     * 
     * @param int $org_id ID del trámite en trd_general_registro_general_tramites
     * @param string $evento Descripción del evento
     * @param int|null $responsable_id ID del usuario responsable
     * @return bool
     */
    public function crear($padre, $hijo)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (`gma_padre`, `gma_hijo`) 
                  VALUES (:padre, :hijo)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':padre', $padre);
        $stmt->bindParam(':hijo', $hijo);

        return $stmt->execute();
    }

    /**
     * Obtiene la bitácora completa de un trámite
     * 
     * @param int $tramite_id
     * @return array
     */
    public function obtenerPorPadre($padre)
    {
        $query = "SELECT b.* 
                  FROM " . $this->table_name . " b
                  WHERE b.gma_padre = :padre 
                  ORDER BY b.gma_hijo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':padre', $padre);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorHijo($hijo)
    {
        $query = "SELECT b.* 
                  FROM " . $this->table_name . " b
                  WHERE b.gma_hijo = :hijo 
                  ORDER BY b.gma_padre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hijo', $hijo);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerId($id)
    {
        $query = "SELECT b.* 
                  FROM " . $this->table_name . " b
                  WHERE b.gma_id = :id ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerAbolFamiliar($id)
    {
        // Este será nuestro contenedor plano final
        $listaPlana = array();

        // Iniciamos la búsqueda recursiva
        $this->obtenerAbolFamiliar2($id, $listaPlana);

        return $listaPlana;
    }
    public function obtenerAbolFamiliar2($id, &$acumulador)
    {// 1. Buscamos registros donde el ID sea el HIJO (para subir a los padres)
        $queryPadres = "SELECT * FROM " . $this->table_name . " WHERE gma_hijo = :id";
        $stmtP = $this->conn->prepare($queryPadres);
        $stmtP->bindParam(':id', $id);
        $stmtP->execute();
        $padres = $stmtP->fetchAll(PDO::FETCH_ASSOC);

        foreach ($padres as $row) {
            // El truco del 'isset': usamos el ID de la tabla como llave para evitar duplicados
            if (!isset($acumulador[$row['gma_id']])) {
                $acumulador[$row['gma_id']] = $row;

                // Llamada recursiva hacia el padre
                $this->obtenerAbolFamiliar2($row['gma_padre'], $acumulador);
            }
        }

        // 2. Buscamos registros donde el ID sea el PADRE (para bajar a los hijos)
        $queryHijos = "SELECT * FROM " . $this->table_name . " WHERE gma_padre = :id";
        $stmtH = $this->conn->prepare($queryHijos);
        $stmtH->bindParam(':id', $id);
        $stmtH->execute();
        $hijos = $stmtH->fetchAll(PDO::FETCH_ASSOC);

        foreach ($hijos as $row) {
            if (!isset($acumulador[$row['gma_id']])) {
                $acumulador[$row['gma_id']] = $row;

                // Llamada recursiva hacia el hijo
                $this->obtenerAbolFamiliar2($row['gma_hijo'], $acumulador);
            }
        }
    }
    public function borrar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE gma_id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
