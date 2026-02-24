<?php
require_once __DIR__ . '/../vendor/autoload.php';
header('Content-Type: application/json');

$exists = class_exists('Dotenv\\Dotenv');
$declared = array_filter(get_declared_classes(), function ($c) {
    return strpos($c, 'Dotenv') !== false; });

echo json_encode([
    'class_exists' => $exists,
    'declared_dotenv_classes' => array_values($declared),
    'vendor_path' => realpath(__DIR__ . '/../vendor/autoload.php'),
    'dotenv_path' => realpath(__DIR__ . '/../vendor/vlucas/phpdotenv/src/Dotenv.php')
]);
