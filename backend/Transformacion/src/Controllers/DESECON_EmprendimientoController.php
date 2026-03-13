<?php

namespace App\Controllers;

use PDO;

use App\Models\desecon_emprendimientos;
use App\Models\general_registro_general_expedientes;
use App\Models\desecon_docentregada;
use App\Controllers\gesdoc_controller;

class desecon_emprendimientocontroller
{
    private $db;
    private $emprendimiento;
    private $expediente;
    private $docEntregada;
    private $gesdoc;

    public function __construct($db)
    {
        $this->db = $db;
        $this->emprendimiento = new desecon_emprendimientos($this->db);
        $this->expediente = new general_registro_general_expedientes($this->db);
        $this->docEntregada = new desecon_docentregada($this->db);
        $this->gesdoc = new gesdoc_controller($this->db);
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
        $rut = $this->cleanRut($rut); // Normalizar
        $query = "SELECT e.*, g.rgt_id 
                  FROM trd_desecon_emprendimientos e
                  LEFT JOIN trd_general_registro_general_expedientes g ON e.dee_registro_general_de_expedientes = g.rgt_id_publica
                  WHERE e.dee_rut = :rut AND e.dee_borrado = 0 LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            // Obtener documentos entregados
            $result['delivered_docs'] = $this->docEntregada->getByRut($rut);
            return ["status" => "success", "data" => $result];
        }
        return ["status" => "error", "message" => "No se encontró el emprendimiento"];
    }

    /**
     * Obtiene todos los emprendimientos de un RUT.
     */
    public function getAllByRut($rut)
    {
        $rut = $this->cleanRut($rut); // Normalizar para que coincida con la DB
        $query = "SELECT e.*, r.rub_nombre, r.rub_icono, g.rgt_id 
                  FROM trd_desecon_emprendimientos e
                  LEFT JOIN trd_desecon_rubro r ON e.dee_rubro = r.rub_id
                  LEFT JOIN trd_general_registro_general_expedientes g ON e.dee_registro_general_de_expedientes = g.rgt_id_publica
                  WHERE e.dee_rut = :rut AND e.dee_borrado = 0";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':rut', $rut);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return ["status" => "success", "data" => $result];
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

    /**
     * Registro completo: Expediente + Emprendimiento + Documentos
     */
    public function createFull($data, $files)
    {
        try {
            $data['dee_rut'] = $this->cleanRut($data['dee_rut'] ?? ''); // Normalizar RUT
            $this->db->beginTransaction();

            // 1. Crear Expediente con formato estándar
            $random_str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
            $fecha_yymmdd = date('ymd-Hi');
            $id_publica = $fecha_yymmdd . "-deseconemp-" . $random_str;

            $expData = [
                'rgt_id_publica' => $id_publica,
                'rgt_tramite' => 'Inscripción Emprendimiento',
                'rgt_creador' => null,
                'rgt_contribuyente' => $_SESSION['vecino_id'] ?? null
            ];
            $expId = $this->expediente->create($expData);
            if (!$expId)
                throw new \Exception("Error al crear expediente");

            // 2. Procesar Archivos Multimedia (Portada/Logo) vía Gesdoc
            $resPortada = $this->uploadToGesdoc($files['file_portada'] ?? null, $expId);
            $resLogo = $this->uploadToGesdoc($files['file_logo'] ?? null, $expId);

            $data['dee_img_portada'] = $resPortada['doc_id'] ?? null;
            $data['dee_img_logo'] = $resLogo['doc_id'] ?? null;
            $data['dee_registro_general_de_expedientes'] = $expData['rgt_id_publica'];

            // 3. Crear Emprendimiento
            if (!$this->emprendimiento->create($data)) {
                throw new \Exception("Error al registrar emprendimiento");
            }

            // 4. Registrar Documentos (Identidad/Estatutos y Dinámicos) vía Gesdoc
            $this->processDocuments($data['dee_rut'], $files, $data['docs_meta'] ?? '[]', $expId);

            $this->db->commit();
            return ["status" => "success", "message" => "Registro procesado correctamente con expediente " . $expData['rgt_id_publica']];

        } catch (\Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Error en createFull: " . $e->getMessage());
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }

    /**
     * Actualización completa: Emprendimiento + Documentos Adicionales
     */
    public function updateFull($data, $files)
    {
        try {
            $rut = $this->cleanRut($data['dee_rut'] ?? '');
            if (!$rut)
                throw new \Exception("RUT no proporcionado");

            // Verificar si el emprendimiento existe
            $existing = $this->emprendimiento->getByRut($rut);
            if (!$existing)
                throw new \Exception("Emprendimiento no encontrado");

            // Solo permitir editar si está 'Por Reparar'
            if ($existing['dee_estado'] !== 'Por Reparar') {
                throw new \Exception("Este registro no se puede editar en su estado actual: " . $existing['dee_estado']);
            }

            $this->db->beginTransaction();

            // 1. Procesar Archivos Multimedia (Solo si se suben nuevos) vía Gesdoc
            $resPortada = $this->uploadToGesdoc($files['file_portada'] ?? null, $existing['rgt_id'] ?? null); // Necesitamos el id de la tabla rgt
            $resLogo = $this->uploadToGesdoc($files['file_logo'] ?? null, $existing['rgt_id'] ?? null);

            if ($resPortada)
                $data['dee_img_portada'] = $resPortada['doc_id'];
            else
                $data['dee_img_portada'] = $existing['dee_img_portada'];

            if ($resLogo)
                $data['dee_img_logo'] = $resLogo['doc_id'];
            else
                $data['dee_img_logo'] = $existing['dee_img_logo'];

            // 2. Actualizar Emprendimiento
            $data['dee_estado'] = 'Por Validar'; // Al editar vuelve a validación
            if (!$this->emprendimiento->update($rut, $data)) {
                throw new \Exception("Error al actualizar datos del emprendimiento");
            }

            // 3. Registrar Documentos Adicionales vía Gesdoc
            $this->processDocuments($rut, $files, $data['docs_meta'] ?? '[]', $existing['rgt_id'] ?? null);

            $this->db->commit();
            return ["status" => "success", "message" => "Empredimiento actualizado correctamente. Volverá a ser revisado."];

        } catch (\Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Error en updateFull: " . $e->getMessage());
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }

    private function processDocuments($rut, $files, $docsMetaJson, $tramiteId)
    {
        // Documentos de Identidad/Estatutos
        if (isset($files['file_cedula'])) {
            $res = $this->uploadToGesdoc($files['file_cedula'], $tramiteId);
            if ($res) {
                $this->docEntregada->create([
                    'dee_documentacion' => 0,
                    'dee_emprendedor' => $rut,
                    'dee_nombre' => 'Cédula de Identidad',
                    'dee_documento' => $res['doc_id']
                ]);
            }
        }

        if (isset($files['file_estatutos'])) {
            $res = $this->uploadToGesdoc($files['file_estatutos'], $tramiteId);
            if ($res) {
                $this->docEntregada->create([
                    'dee_documentacion' => 0,
                    'dee_emprendedor' => $rut,
                    'dee_nombre' => 'Estatutos Empresa',
                    'dee_documento' => $res['doc_id']
                ]);
            }
        }

        // Documentos Dinámicos
        $docsMeta = json_decode($docsMetaJson, true);
        foreach ($docsMeta as $meta) {
            $fileKey = 'dynamic_file_' . $meta['index'];
            if (isset($files[$fileKey])) {
                $res = $this->uploadToGesdoc($files[$fileKey], $tramiteId);
                if ($res) {
                    $this->docEntregada->create([
                        'dee_documentacion' => $meta['id_requerida'],
                        'dee_emprendedor' => $rut,
                        'dee_nombre' => $meta['nombre'],
                        'dee_documento' => $res['doc_id']
                    ]);
                }
            }
        }
    }

    private function uploadToGesdoc($file, $tramiteId)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK)
            return null;

        $requestData = [
            'tramite_id' => $tramiteId,
            'user_id' => $_SESSION['vecino_id'] ?? 1, // 1 por defecto si no hay sesión
            'doc_privado' => 0
        ];

        $result = $this->gesdoc->subirArchivo($file, $requestData);

        if ($result['status'] === 'success' && !empty($result['uploaded'])) {
            return $result['uploaded'][0]; // Retorna info del primer (y único) archivo
        }
        return null;
    }

    private function cleanRut($rut)
    {
        // Quitar puntos y dejar guion (o limpiar todo excepto números y K)
        // El formato en la DB parece ser XXXXXXXX-X (sin puntos)
        return str_replace('.', '', strtoupper(trim($rut)));
    }

    private function handleUpload($file, $prefix)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK)
            return null;

        $uploadDir = __DIR__ . '/../../recursos/uploads/desecon/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0777, true);

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $prefix . uniqid() . '.' . $ext;
        $target = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $filename;
        }
        return null;
    }
}
