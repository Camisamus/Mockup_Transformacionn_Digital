@echo off
:inicio
cls
echo ---------------------------------------
echo Abrir pagina web: %date% %time%
echo ---------------------------------------

:: 1. Abre la URL (cambia la dirección por la que necesites)
start "" "http://localhost/Transformacion/api/notificacionesEmail.php"

echo La pagina se ha abierto. 
echo Esperando 24 horas para la proxima ejecucion...
echo No cierres esta ventana.

:: 2. Espera 86400 segundos (24 horas)
:: El comando timeout cuenta en segundos
::timeout /t 86400 /nobreak
timeout /t 60 /nobreak

:: 3. Regresa al inicio del bucle
goto inicio