<?php
namespace App\Controllers;

use App\Models\Documento;

class DocumentoController
{
    private $db;
    private $documento;

    public function __construct($db)
    {
        $this->db = $db;
        $this->documento = new Documento($this->db);
    }

    public function getAll($data)
    {
        $result = $this->documento->obtenerPorTramite($data);
        return ["status" => "success", "data" => $result];
    }
    public function getByIDAndDownload($id) // Recibe el ID directamente
    {
        $result = $this->documento->obtenerId($id);

        if (!$result) {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "No se encontró el registro"]);
            exit;
        }

        // Si es un documento docdigital 
        if (isset($result[0]['es_docdigital']) && $result[0]['es_docdigital'] == 1) {

        } else {
            // Si es un archivo físico en disco
            $this->download($result[0]);
        }
        exit;
    }
    public function download($data)
    {
        $ruta = $data['doc_enlace_documento'];
        $nombre = $data['doc_nombre_documento'] ?: basename($ruta);

        if (file_exists($ruta)) {
            // Limpiar cualquier búfer de salida para evitar archivos corruptos
            if (ob_get_level())
                ob_end_clean();

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $nombre . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($ruta));

            readfile($ruta);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "El archivo físico no existe en: " . $ruta]);
            exit;
        }
    }
    public function create($data, $file)
    {
        $tramite_id = $data['tramite_id'];
        $responsable_id = $data['responsable_id'];
        $es_docdigital = $data['es_docdigital'];
        $doc_nombre_original = $data['doc_nombre_documento'];

        // 1. Configuración de la ruta y nombre aleatorio
        $folder = "C:/Uploads/documentos/"; // Asegúrate de que esta carpeta tenga permisos de escritura

        // Obtenemos la extensión original del archivo
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Generamos un nombre único usando bin2hex o uniqid
        $nuevo_nombre = bin2hex(random_bytes(20)) . "." . $extension;
        $ruta_destino = $folder . $nuevo_nombre;

        // 2. Intentar mover el archivo al servidor
        if (move_uploaded_file($file['tmp_name'], $ruta_destino)) {

            // 3. Si el archivo se subió, guardamos la ruta en la base de datos
            // Usamos $ruta_destino como el 'enlace' del documento
            if ($this->documento->subir($tramite_id, $ruta_destino, $doc_nombre_original, $responsable_id, $es_docdigital)) {
                return ["status" => "success", "message" => "Documento guardado y registrado exitosamente"];
            } else {
                // Si falla la BD, opcionalmente podrías borrar el archivo recién subido
                return ["status" => "error", "message" => "Archivo subido, pero falló el registro en BD"];
            }
        }

        return ["status" => "error", "message" => "Error al subir el archivo físico al servidor"];
    }
    public function delete($id)
    {

        // 1. Configuración de la ruta y nombre aleatorio
        $result = $this->documento->obtenerId($id);
        if ($result['es_docdigital'] == 1) {
            $result = $this->documento->borrar($id);
            if ($result) {
                return ["status" => "success", "data" => $result];
            }
        } else {
            $folder = "uploads/documentos/"; // Asegúrate de que esta carpeta tenga permisos de escritura
            $ruta_destino = $folder . $result['doc_nombre_documento'];
            if (file_exists($ruta_destino)) {
                unlink($ruta_destino);
            }
            $result = $this->documento->borrar($id);
            if ($result) {
                return ["status" => "success", "data" => $result];
            }
        }
        return ["status" => "error", "message" => "Error al borrar el archivo"];
    }
}
