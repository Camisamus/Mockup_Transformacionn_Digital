<?php

namespace App\Controllers;

use App\Models\SystemLog;
use PDO;

class SystemLogController
{
    private $logModel;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->logModel = new SystemLog($db);
    }

    public function handleRequest($method)
    {
        // Use global $data from cors.php
        global $data;

        // $data should be populated by cors.php from php://input or $_POST
        $action = $data['ACCION'] ?? 'LIST';

        switch ($method) {
            case 'POST':
                if ($action === 'LIST') {
                    $this->listarLogs();
                } elseif ($action === 'GET') {
                    $this->obtenerLog();
                } else {
                    $this->jsonResponse(['error' => 'Accion no valida: ' . $action], 400);
                }
                break;

            default:
                $this->jsonResponse(['error' => 'Metodo no permitido'], 405);
                break;
        }
    }

    private function listarLogs()
    {
        global $data;
        $filtros = [
            'tipo' => $data['tipo'] ?? null,
            'modulo' => $data['modulo'] ?? null,
            'usuario' => $data['usuario'] ?? null,
            'fecha_desde' => $data['fecha_desde'] ?? null,
            'fecha_hasta' => $data['fecha_hasta'] ?? null
        ];

        $logs = $this->logModel->obtenerTodos($filtros);

        // Formatear respuesta para el frontend
        $responseData = array_map(function ($log) {
            return [
                'id' => $log['log_id'],
                'fecha' => $log['log_fecha'],
                'tipo' => strtoupper($log['log_tipo']), // Ensure uppercase for badges
                'modulo' => $log['log_modulo'],
                'usuario' => $log['usr_nombre'] ? ($log['usr_nombre'] . ' ' . $log['usr_apellido']) : 'Sistema/Desconocido',
                'accion' => $log['log_accion'],
                'descripcion' => $log['log_descripcion'],
                'ip' => $log['log_ip'],
                'resultado' => $log['log_resultado']
            ];
        }, $logs);

        $this->jsonResponse($responseData);
    }

    private function obtenerLog()
    {
        global $data;
        $id = $data['id'] ?? null;
        if (!$id) {
            $this->jsonResponse(['error' => 'ID requerido'], 400);
            return;
        }

        $log = $this->logModel->obtenerPorId($id);

        if (!$log) {
            $this->jsonResponse(['error' => 'Log no encontrado'], 404);
            return;
        }

        $this->jsonResponse([
            'id' => $log['log_id'],
            'fecha' => $log['log_fecha'],
            'tipo' => ucfirst($log['log_tipo']),
            'severidad' => $log['log_severidad'],
            'modulo' => $log['log_modulo'],
            'usuario' => $log['usr_nombre'] ? ($log['usr_nombre'] . ' ' . $log['usr_apellido']) : 'Sistema',
            'accion' => $log['log_accion'],
            'ip' => $log['log_ip'],
            'descripcion' => $log['log_descripcion'],
            'detalles' => $log['log_detalles'],
            'resultado' => $log['log_resultado']
        ]);
    }

    private function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
