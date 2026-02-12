<?php
include_once(__DIR__ . '/layout/layout.php');

// Título de la página y referencia al archivo de contenido
$page_title = "Dashboard Principal";
$content_php = __DIR__ . '/content_index.php';

// Renderizar Layout con el contenido (el archivo ya ha sido creado físicamente)
renderLayout($page_title, $content_php);
?>
