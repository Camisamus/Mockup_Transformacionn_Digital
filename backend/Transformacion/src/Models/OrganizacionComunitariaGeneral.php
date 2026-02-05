<?php
namespace App\Models;

use PDO;

class OrganizacionComunitariaGeneral
{
    private $conn;
    private $table_name = "trd_general_organizaciones_comunitarias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        // Join with types and contribuyentes for readability
        $query = "SELECT 
                    UPPER(oc.orgc_nombre) as orgc_nombre,
                    t.tor_nombre as tipo_nombre,
                    UPPER(c.tgc_nombre) as tgc_nombre, UPPER(c.tgc_apellido_paterno) as tgc_apellido_paterno, UPPER(c.tgc_apellido_materno) as tgc_apellido_materno, c.tgc_rut as rep_rut
                  FROM " . $this->table_name . " oc
                  LEFT JOIN trd_general_tipos_organizacion t ON oc.orgc_tipo_organizacion = t.tor_id
                  LEFT JOIN trd_general_contribuyentes c ON oc.ogc_rep_legal = c.tgc_id
                  ORDER BY oc.orgc_nombre ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE orgc_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " SET
            orgc_rut=:orgc_rut,
            orgc_nombre=:orgc_nombre,
            orgc_codigo=:orgc_codigo,
            orgc_rpj=:orgc_rpj,
            ogc_inscripcion=:ogc_inscripcion,
            orgc_vigencia=:orgc_vigencia,
            ogc_rep_legal=:ogc_rep_legal,
            orgc_unidad_vecinal=:orgc_unidad_vecinal,
            orgc_tipo_organizacion=:orgc_tipo_organizacion";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":orgc_rut", $data['orgc_rut']);
        $stmt->bindParam(":orgc_nombre", $data['orgc_nombre']);
        $stmt->bindParam(":orgc_codigo", $data['orgc_codigo']);
        $stmt->bindParam(":orgc_rpj", $data['orgc_rpj']);
        $stmt->bindParam(":ogc_inscripcion", $data['ogc_inscripcion']);
        $stmt->bindParam(":orgc_vigencia", $data['orgc_vigencia']);
        $stmt->bindParam(":ogc_rep_legal", $data['ogc_rep_legal']);
        $stmt->bindParam(":orgc_unidad_vecinal", $data['orgc_unidad_vecinal']);
        $stmt->bindParam(":orgc_tipo_organizacion", $data['orgc_tipo_organizacion']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " SET
            orgc_rut=:orgc_rut,
            orgc_nombre=:orgc_nombre,
            orgc_codigo=:orgc_codigo,
            orgc_rpj=:orgc_rpj,
            ogc_inscripcion=:ogc_inscripcion,
            orgc_vigencia=:orgc_vigencia,
            ogc_rep_legal=:ogc_rep_legal,
            orgc_unidad_vecinal=:orgc_unidad_vecinal,
            orgc_tipo_organizacion=:orgc_tipo_organizacion
            WHERE orgc_id=:orgc_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":orgc_id", $id);
        $stmt->bindParam(":orgc_rut", $data['orgc_rut']);
        $stmt->bindParam(":orgc_nombre", $data['orgc_nombre']);
        $stmt->bindParam(":orgc_codigo", $data['orgc_codigo']);
        $stmt->bindParam(":orgc_rpj", $data['orgc_rpj']);
        $stmt->bindParam(":ogc_inscripcion", $data['ogc_inscripcion']);
        $stmt->bindParam(":orgc_vigencia", $data['orgc_vigencia']);
        $stmt->bindParam(":ogc_rep_legal", $data['ogc_rep_legal']);
        $stmt->bindParam(":orgc_unidad_vecinal", $data['orgc_unidad_vecinal']);
        $stmt->bindParam(":orgc_tipo_organizacion", $data['orgc_tipo_organizacion']);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }

    public function delete($id)
    {
        // Physical delete
        $query = "DELETE FROM " . $this->table_name . " WHERE orgc_id = :orgc_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":orgc_id", $id);

        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
        return false;
    }
}
