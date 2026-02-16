<?php
// config_general.php - API para obtener configuraciones generales
require_once 'cors.php';
require_once '../vendor/autoload.php';

use App\Config\AppConfig;

$config = [
    "status" => "success",
    "data" => [
        "google_maps_key" => AppConfig::getGoogleMapsKey()
    ]
];

echo json_encode($config);
