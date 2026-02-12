<?php
include_once(__DIR__ . '/../layout/layout.php');

// Título de la página y referencia al archivo de contenido
$page_title = "Reserva de Plazas - Emprendimiento";
$content_php = __DIR__ . '/content_reservar.php';

// Renderizar Layout con el contenido
renderLayout($page_title, $content_php);
?>