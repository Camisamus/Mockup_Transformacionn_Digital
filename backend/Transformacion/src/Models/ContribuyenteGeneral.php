<?php
namespace App\Models;

use PDO;

class ContribuyenteGeneral
{
    private $conn;
    private $table_name = "trd_general_contribuyentes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT tgc_id, tgc_rut, UPPER(tgc_nombre) as tgc_nombre, UPPER(tgc_apellido_paterno) as tgc_apellido_paterno, UPPER(tgc_apellido_materno) as tgc_apellido_materno FROM " . $this->table_name . " ORDER BY tgc_nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tgc_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            tgc_rut=:tgc_rut,
            tgc_nombre=:tgc_nombre,
            tgc_apellido_paterno=:tgc_apellido_paterno,
            tgc_apellido_materno=:tgc_apellido_materno,
            tgc_sexo=:tgc_sexo,
            tgc_fecha_nacimiento=:tgc_fecha_nacimiento,
            tgc_estado_civil=:tgc_estado_civil,
            tgc_escolaridad=:tgc_escolaridad,
            tgc_nacionalidad=:tgc_nacionalidad,
            tgc_correo_electronico=:tgc_correo_electronico,
            tgc_telefono_contacto=:tgc_telefono_contacto,
            tgc_tipo=:tgc_tipo,
            tgc_razon_social=:tgc_razon_social,
            tgc_nombre_fantasia=:tgc_nombre_fantasia,
            tgc_giro=:tgc_giro,
            tgc_rep_rut=:tgc_rep_rut,
            tgc_rep_nombre_completo=:tgc_rep_nombre_completo";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":tgc_rut", $data['tgc_rut'] ?? null);
        $stmt->bindValue(":tgc_nombre", $data['tgc_nombre'] ?? null);
        $stmt->bindValue(":tgc_apellido_paterno", $data['tgc_apellido_paterno'] ?? null);
        $stmt->bindValue(":tgc_apellido_materno", $data['tgc_apellido_materno'] ?? null);
        $stmt->bindValue(":tgc_sexo", $data['tgc_sexo'] ?? null);
        $stmt->bindValue(":tgc_fecha_nacimiento", $data['tgc_fecha_nacimiento'] ?? null);
        $stmt->bindValue(":tgc_estado_civil", $data['tgc_estado_civil'] ?? null);
        $stmt->bindValue(":tgc_escolaridad", $data['tgc_escolaridad'] ?? null);
        $stmt->bindValue(":tgc_nacionalidad", $data['tgc_nacionalidad'] ?? null);
        $stmt->bindValue(":tgc_correo_electronico", $data['tgc_correo_electronico'] ?? null);
        $stmt->bindValue(":tgc_telefono_contacto", $data['tgc_telefono_contacto'] ?? null);
        $stmt->bindValue(":tgc_tipo", $data['tgc_tipo'] ?? 'natural');
        $stmt->bindValue(":tgc_razon_social", $data['tgc_razon_social'] ?? null);
        $stmt->bindValue(":tgc_nombre_fantasia", $data['tgc_nombre_fantasia'] ?? null);
        $stmt->bindValue(":tgc_giro", $data['tgc_giro'] ?? null);
        $stmt->bindValue(":tgc_rep_rut", $data['tgc_rep_rut'] ?? null);
        $stmt->bindValue(":tgc_rep_nombre_completo", $data['tgc_rep_nombre_completo'] ?? null);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            tgc_rut=:tgc_rut,
            tgc_nombre=:tgc_nombre,
            tgc_apellido_paterno=:tgc_apellido_paterno,
            tgc_apellido_materno=:tgc_apellido_materno,
            tgc_sexo=:tgc_sexo,
            tgc_fecha_nacimiento=:tgc_fecha_nacimiento,
            tgc_estado_civil=:tgc_estado_civil,
            tgc_escolaridad=:tgc_escolaridad,
            tgc_nacionalidad=:tgc_nacionalidad,
            tgc_correo_electronico=:tgc_correo_electronico,
            tgc_telefono_contacto=:tgc_telefono_contacto,
            tgc_tipo=:tgc_tipo,
            tgc_razon_social=:tgc_razon_social,
            tgc_nombre_fantasia=:tgc_nombre_fantasia,
            tgc_giro=:tgc_giro,
            tgc_rep_rut=:tgc_rep_rut,
            tgc_rep_nombre_completo=:tgc_rep_nombre_completo
            WHERE tgc_id=:tgc_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":tgc_id", $id);
        $stmt->bindValue(":tgc_rut", $data['tgc_rut'] ?? null);
        $stmt->bindValue(":tgc_nombre", $data['tgc_nombre'] ?? null);
        $stmt->bindValue(":tgc_apellido_paterno", $data['tgc_apellido_paterno'] ?? null);
        $stmt->bindValue(":tgc_apellido_materno", $data['tgc_apellido_materno'] ?? null);
        $stmt->bindValue(":tgc_sexo", $data['tgc_sexo'] ?? null);
        $stmt->bindValue(":tgc_fecha_nacimiento", $data['tgc_fecha_nacimiento'] ?? null);
        $stmt->bindValue(":tgc_estado_civil", $data['tgc_estado_civil'] ?? null);
        $stmt->bindValue(":tgc_escolaridad", $data['tgc_escolaridad'] ?? null);
        $stmt->bindValue(":tgc_nacionalidad", $data['tgc_nacionalidad'] ?? null);
        $stmt->bindValue(":tgc_correo_electronico", $data['tgc_correo_electronico'] ?? null);
        $stmt->bindValue(":tgc_telefono_contacto", $data['tgc_telefono_contacto'] ?? null);
        $stmt->bindValue(":tgc_tipo", $data['tgc_tipo'] ?? 'natural');
        $stmt->bindValue(":tgc_razon_social", $data['tgc_razon_social'] ?? null);
        $stmt->bindValue(":tgc_nombre_fantasia", $data['tgc_nombre_fantasia'] ?? null);
        $stmt->bindValue(":tgc_giro", $data['tgc_giro'] ?? null);
        $stmt->bindValue(":tgc_rep_rut", $data['tgc_rep_rut'] ?? null);
        $stmt->bindValue(":tgc_rep_nombre_completo", $data['tgc_rep_nombre_completo'] ?? null);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getDetailsByRut($rut)
    {
        $query = "SELECT c.*, 
                         d.tcd_calle, d.tcd_numero, d.tcd_departamento, d.tcd_casa, d.tcd_aclaratoria,
                         d.tcd_latitud, d.tcd_longitud
                  FROM " . $this->table_name . " c
                  LEFT JOIN (
                      SELECT * FROM trd_cont_direcciones 
                      WHERE (tcd_contribuyente, tcd_dir_creacion) IN (
                          SELECT tcd_contribuyente, MAX(tcd_dir_creacion)
                          FROM trd_cont_direcciones
                          GROUP BY tcd_contribuyente
                      )
                  ) d ON c.tgc_id = d.tcd_contribuyente
                  WHERE c.tgc_rut = :tgc_rut
                  LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tgc_rut", $rut);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByRut($rut)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tgc_rut = :tgc_rut LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tgc_rut", $rut);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        // Physical delete as there is no 'borrado' column
        $query = "DELETE FROM " . $this->table_name . " WHERE tgc_id = :tgc_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tgc_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
