<?php
namespace App\Controllers;

use App\Models\OirsSolicitud;
use App\Models\ContribuyenteGeneral;
use App\Models\ContribuyenteDireccion;

class OirsSolicitudController
{
    private $db;
    private $oirsModel;
    private $contModel;
    private $dirModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->oirsModel = new OirsSolicitud($db);
        $this->contModel = new ContribuyenteGeneral($db);
        $this->dirModel = new ContribuyenteDireccion($db);
    }

    public function create($data)
    {
        // 1. Manejar Contribuyente
        $rut = $data['cont_rut'] ?? null;
        if (!$rut) {
            return ["status" => "error", "message" => "RUT del contribuyente es requerido"];
        }

        $existingCont = $this->contModel->getByRut($rut);
        $contId = null;

        // Mapear datos del contribuyente desde el formulario
        $contData = [
            'tgc_rut' => $rut,
            'tgc_tipo' => $data['cont_tipo_persona'] ?? 'natural',
            'tgc_nombre' => $data['cont_nombres'] ?? null,
            'tgc_apellido_paterno' => $data['cont_apellido_paterno'] ?? null,
            'tgc_apellido_materno' => $data['cont_apellido_materno'] ?? null,
            'tgc_sexo' => $data['cont_sexo'] ?? null,
            'tgc_fecha_nacimiento' => $data['cont_fecha_nacimiento'] ?? null,
            'tgc_estado_civil' => $data['cont_estado_civil'] ?? null,
            'tgc_escolaridad' => $data['cont_escolaridad'] ?? null,
            'tgc_nacionalidad' => $data['cont_nacionalidad'] ?? null,
            'tgc_correo_electronico' => $data['cont_email'] ?? null,
            'tgc_telefono_contacto' => $data['cont_telefono'] ?? null,
            'tgc_razon_social' => $data['cont_razon_social'] ?? null,
            'tgc_nombre_fantasia' => $data['cont_nombre_fantasia'] ?? null,
            'tgc_giro' => $data['cont_giro'] ?? null,
            'tgc_rep_rut' => $data['cont_rep_rut'] ?? null,
            'tgc_rep_nombre_completo' => $data['cont_rep_nombre_completo'] ?? null
        ];

        if ($existingCont) {
            $contId = $existingCont['tgc_id'];
            $this->contModel->update($contId, $contData);
        } else {
            $contId = $this->contModel->create($contData);
        }

        if (!$contId) {
            return ["status" => "error", "message" => "Error al procesar contribuyente"];
        }

        // 2. Manejar Dirección (si cambió o es nueva)
        // Por simplicidad, siempre insertamos si se provee calle y es distinta a la anterior (o siempre insertamos como historial)
        if (!empty($data['cont_direccion'])) {
            $this->dirModel->create([
                'tcd_contribuyente' => $contId,
                'tcd_calle' => $data['cont_direccion'],
                'tcd_numero' => $data['cont_numero'] ?? null,
                'tcd_aclaratoria' => $data['cont_aclaratoria'] ?? null,
                'tcd_latitud' => $data['cont_latitud'] ?? null,
                'tcd_longitud' => $data['cont_longitud'] ?? null,
                'tcd_tipo_direccion' => 'OIRS'
            ]);
        }

        // DETERMINAR ESTADO Y REQUERIMIENTO TÉCNICO
        $tieneRespuesta = !empty($data['oirs_respuesta']);
        $data['oirs_estado'] = $tieneRespuesta ? 1 : 0;

        // 3. Crear OIRS
        $data['rgt_contribuyente'] = $contId;
        $result = $this->oirsModel->create($data);

        // 4. SIEMPRE crear registro de gestión
        if ($result['status'] === 'success') {
            $gestController = new \App\Controllers\OIRS_GestionController($this->db);
            $gestController->create([
                'oig_solicitud' => $result['id'],
                'oig_respuesta_preliminar' => $data['oirs_respuesta'] ?? null,
                'oig_requiere_respuesta_tecnica' => $tieneRespuesta ? 0 : 1,
                'creador_id' => $data['rgt_creador'] ?? $_SESSION['user_id'] ?? 1
            ]);
        }

        return $result;
    }

    public function getAll()
    {
        $result = $this->oirsModel->getAll();
        return ["status" => "success", "data" => $result];
    }

    public function getById($id)
    {
        $oirs = $this->oirsModel->getById($id);
        if (!$oirs) {
            return ["status" => "error", "message" => "Solicitud no encontrada"];
        }

        // Obtener gestión
        $gestController = new \App\Controllers\OIRS_GestionController($this->db);
        $gestion = $gestController->getBySolicitud($id);
        $oirs['gestion'] = $gestion['data'] ?? null;

        // Obtener Historial (Bitacora)
        if (!empty($oirs['oirs_registro_tramite'])) {
            require_once __DIR__ . '/../Models/Bitacora.php';
            $bitacoraModel = new \App\Models\Bitacora($this->db);
            $oirs['historial'] = $bitacoraModel->obtenerPorTramite($oirs['oirs_registro_tramite']);

            // Obtener Adjuntos (GesDoc)
            require_once __DIR__ . '/../Models/GesDoc.php';
            $gesDocModel = new \App\Models\GesDoc($this->db);
            $oirs['adjuntos'] = $gesDocModel->getDocumentosByTramite($oirs['oirs_registro_tramite']);
        } else {
            $oirs['historial'] = [];
            $oirs['adjuntos'] = [];
        }

        // Obtener Asignaciones (trd_oirs_asignaciones)
        require_once __DIR__ . '/../Models/OirsAsignacion.php';
        $asignacionModel = new \App\Models\OirsAsignacion($this->db);
        $oirs['asignaciones'] = $asignacionModel->getBySolicitud($id);

        return ["status" => "success", "data" => $oirs];
    }

    public function search($data)
    {
        $criteria = [];
        if (!empty($data['id']))
            $criteria['oirs_id'] = $data['id'];
        if (!empty($data['folio']))
            $criteria['folio'] = $data['folio'];
        if (!empty($data['rut']))
            $criteria['rut'] = $data['rut'];

        if (empty($criteria)) {
            return ["status" => "error", "message" => "Debe proporcionar al menos un criterio de búsqueda"];
        }

        $result = $this->oirsModel->search($criteria);

        if (empty($result)) {
            return ["status" => "error", "message" => "No se encontraron resultados"];
        }

        return ["status" => "success", "data" => $result];
    }
}
