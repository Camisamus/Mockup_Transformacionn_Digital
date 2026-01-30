<?php
require_once __DIR__ . '/cors.php';
header("Content-Type: application/json");
echo json_encode(["status" => "success", "message" => "CORS Test works", "origin" => $_SERVER['HTTP_ORIGIN'] ?? 'none']);
