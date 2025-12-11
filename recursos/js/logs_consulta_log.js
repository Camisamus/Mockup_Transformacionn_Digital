// logs_consulta_log.js
// Handles system log consultation functionality

function buscarLog() {
    console.log('Buscando log');
    alert('Funcionalidad de búsqueda en desarrollo.');
}

function imprimirPDF() {
    console.log('Imprimiendo PDF del log');
    alert('Generando PDF del log del sistema...');
}

// Load log data from URL parameter if present
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const logId = urlParams.get('id');

    if (logId) {
        cargarLog(logId);
    }
});

function cargarLog(id) {
    // In production, this would fetch from API
    console.log('Cargando log:', id);

    // Sample data
    document.getElementById('log_id').value = id;
    document.getElementById('log_fecha').value = '2024-12-11T10:30';
    document.getElementById('log_tipo').value = 'info';
    document.getElementById('log_severidad').value = 'bajo';
    document.getElementById('log_usuario').value = 'admin';
    document.getElementById('log_modulo').value = 'Subvenciones';
    document.getElementById('log_accion').value = 'Creación de subvención';
    document.getElementById('log_ip').value = '192.168.1.100';
    document.getElementById('log_descripcion').value = 'Usuario creó nueva subvención SUB-2024-001';
    document.getElementById('log_detalles').value = 'Operación completada exitosamente. Tiempo de ejecución: 245ms';
    document.getElementById('log_resultado').value = 'Exitoso';
}
