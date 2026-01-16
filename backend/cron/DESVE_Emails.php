<?php
$fecha = date("Y-m-d H:i:s");
file_put_contents("log.txt", "Ejecutado a las: $fecha\n", FILE_APPEND);

echo "Tarea completada.";
?>