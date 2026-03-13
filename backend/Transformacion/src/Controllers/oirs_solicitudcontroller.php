<?php
namespace App\Controllers;

use App\Models\oirs_solicitudes;
use App\Models\general_contribuyentes;
use App\Models\general_contribuyente_direcciones;

class oirs_solicitudcontroller
{
    private $db;
    private $oirsModel;
    private $contModel;
    private $dirModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->oirsModel = new oirs_solicitudes($db);
        $this->contModel = new general_contribuyentes($db);
        $this->dirModel = new general_contribuyente_direcciones($db);
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
            $gestController = new \App\Controllers\oirs_gestioncontroller($this->db);
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
        if (isset($result['status']) && $result['status'] === 'error') {
            return $result;
        }
        return ["status" => "success", "data" => $result];
    }

    public function getById($id)
    {
        $oirs = $this->oirsModel->getById($id);
        if (!$oirs) {
            return ["status" => "error", "message" => "Solicitud no encontrada"];
        }

        // Obtener gestión
        $gestController = new \App\Controllers\oirs_gestioncontroller($this->db);
        $gestion = $gestController->getBySolicitud($id);
        $oirs['gestion'] = $gestion['data'] ?? null;

        // Obtener Historial (Bitacora)
        if (!empty($oirs['oirs_registro_tramite'])) {
            $bitacoraModel = new \App\Models\general_bitacora($this->db);
            $oirs['historial'] = $bitacoraModel->obtenerPorTramite($oirs['oirs_registro_tramite']);

            // Obtener Adjuntos (GesDoc)
            $gesDocModel = new \App\Models\gesdoc_documentos_carpeta($this->db);
            $oirs['adjuntos'] = $gesDocModel->getDocumentosByTramite($oirs['oirs_registro_tramite']);
        } else {
            $oirs['historial'] = [];
            $oirs['adjuntos'] = [];
        }

        // Obtener Gestión (trd_oirs_gestion)
        $gestionModel = new \App\Models\oirs_gestiones($this->db);
        $oirs['gestion'] = $gestionModel->getBySolicitudId($id);

        // Obtener Asignaciones (trd_oirs_asignaciones)
        $asignacionModel = new \App\Models\oirs_asignaciones($this->db);
        $oirs['asignaciones'] = $asignacionModel->getBySolicitud($id);

        return ["status" => "success", "data" => $oirs];
    }

    public function search($data)
    {
        $criteria = [];
        $criteria['id'] = $data['id'] ?? null;
        $criteria['folio'] = $data['folio'] ?? null;
        $criteria['rut'] = $data['rut'] ?? null;
        $criteria['fecha'] = $data['fecha'] ?? null;
        $criteria['estado'] = $data['estado'] ?? null;
        $criteria['sector'] = $data['sector'] ?? null;
        $criteria['tematica'] = $data['tematica'] ?? null;
        $criteria['subtematica'] = $data['subtematica'] ?? null;
        $criteria['prioridad'] = $data['prioridad'] ?? null;
        $criteria['search'] = $data['search'] ?? null;

        $result = $this->oirsModel->search($criteria);
        
        if (isset($result['status']) && $result['status'] === 'error') {
            return $result;
        }

        return ["status" => "success", "data" => $result];
    }

    public function getMetrics()
    {
        $metrics = $this->oirsModel->getMetrics();
        return ["status" => "success", "data" => $metrics];
    }

    public function getChartData()
    {
        $data = $this->oirsModel->getChartData();
        return ["status" => "success", "data" => $data];
    }

    public function getByContribuyente($contribuyente_id)
    {
        if (!$contribuyente_id) {
            return ["status" => "error", "message" => "ID de contribuyente es requerido"];
        }
        $data = $this->oirsModel->getByContribuyente($contribuyente_id);
        return ["status" => "success", "data" => $data];
    }

    public function getSummaryByContribuyente($contribuyente_id)
    {
        if (!$contribuyente_id) {
            return ["status" => "error", "message" => "ID de contribuyente es requerido"];
        }
        $data = $this->oirsModel->getSummaryByContribuyente($contribuyente_id);
        return ["status" => "success", "data" => $data];
    }
}
