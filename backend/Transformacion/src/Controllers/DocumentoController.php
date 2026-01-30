<?php
namespace App\Controllers;

use App\Models\Documento;

class DocumentoController
{
    private $db;
    private $documento;

    private $folder = "/uploads/documentos/"; // Asegúrate de que esta carpeta tenga permisos de escritura
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
        if (isset($result[0]['doc_docdigital']) && $result[0]['doc_docdigital'] == 1) {
            // Aquí iría la lógica para docdigital si existiera
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

        // En Windows, a veces / al inicio no se resuelve bien a la raíz del disco si no especificamos
        $realPath = $ruta;
        if (strpos($ruta, '/') === 0 && !file_exists($ruta)) {
            // Intentamos prefijar con la unidad actual si estamos en Windows
            $drive = substr(__DIR__, 0, 2);
            if (ctype_alpha($drive[0]) && $drive[1] === ':') {
                $realPath = $drive . $ruta;
            }
        }

        if (file_exists($realPath)) {
            $ruta = $realPath;
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

        // Obtenemos la extensión original del archivo
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Generamos un nombre único usando bin2hex o uniqid
        $nuevo_nombre = bin2hex(random_bytes(20)) . "." . $extension;
        $ruta_destino = $this->folder . $nuevo_nombre;

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

    public function createFromBase64($data)
    {
        error_log("DocumentoController: Iniciando createFromBase64 para " . ($data['nombre'] ?? 'sin nombre'));

        $tramite_id = $data['tramite_id'];
        $responsable_id = $data['responsable_id'] ?? ($_SESSION['user_id'] ?? 1);
        $es_docdigital = $data['es_docdigital'] ?? 0;
        $doc_nombre_original = $data['nombre'];
        $base64_content = $data['base64'];

        // 1. Configuración de la ruta
        if (!file_exists($this->folder)) {
            if (!mkdir($this->folder, 0777, true)) {
                error_log("DocumentoController: Error FATAL al crear directorio " . $this->folder);
                return ["status" => "error", "message" => "No se pudo crear la carpeta de destino"];
            }
        }

        // 2. Extraer datos del base64 - Regex mucho más flexible
        if (strpos($base64_content, ';base64,') !== false) {
            $base64_content = explode(';base64,', $base64_content)[1];
        }

        $file_data = base64_decode($base64_content);
        if ($file_data === false || empty($file_data)) {
            error_log("DocumentoController: Base64 decodificado está vacío o es inválido para $doc_nombre_original");
            return ["status" => "error", "message" => "Contenido del archivo vacío o inválido"];
        }

        // 3. Generar nombre único
        $extension = pathinfo($doc_nombre_original, PATHINFO_EXTENSION) ?: 'bin';
        $nuevo_nombre = bin2hex(random_bytes(20)) . "." . $extension;
        $ruta_destino = $this->folder . $nuevo_nombre;

        // 4. Guardar archivo en disco
        if (file_put_contents($ruta_destino, $file_data) !== false) {
            error_log("DocumentoController: Archivo guardado físicamente en $ruta_destino (" . strlen($file_data) . " bytes)");

            // 5. Registrar en BD con la RUTA como enlace
            if ($this->documento->subir($tramite_id, $ruta_destino, $doc_nombre_original, $responsable_id, $es_docdigital)) {
                error_log("DocumentoController: Registro en BD exitoso para $ruta_destino");
                return ["status" => "success", "message" => "Documento guardado y registrado", "file_path" => $ruta_destino];
            } else {
                error_log("DocumentoController: Falló el INSERT en BD para $ruta_destino");
                unlink($ruta_destino);
                return ["status" => "error", "message" => "Registro en BD falló"];
            }
        }

        error_log("DocumentoController: Falló file_put_contents en $ruta_destino");
        return ["status" => "error", "message" => "No se pudo escribir el archivo en el servidor"];
    }

    public function delete($id)
    {

        // 1. Configuración de la ruta y nombre aleatorio
        $result = $this->documento->obtenerId($id);
        if (isset($result[0]['es_docdigital']) && $result[0]['es_docdigital'] == 1) {
            $result = $this->documento->borrar($id);
            if ($result) {
                return ["status" => "success", "data" => $result];
            }
        } else {
            $ruta_destino = $result[0]['doc_enlace_documento'] ?? '';
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
