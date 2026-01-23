// logs_consulta_log.js
document.addEventListener('DOMContentLoaded', async function () {
    const urlParams = new URLSearchParams(window.location.search);
    const logId = urlParams.get('id');

    if (logId) {
        cargarLog(logId);
    } else {
        solicitarID();
    }
});

async function solicitarID() {
    const { value: id } = await Swal.fire({
        title: 'Consultar Log',
        text: 'Ingrese el ID del Log a consultar',
        input: 'text',
        inputPlaceholder: 'LOG-XXXXX',
        showCancelButton: true,
        confirmButtonColor: '#212529',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Consultar',
        inputValidator: (value) => {
            if (!value) return 'Debe ingresar un ID';
        }
    });

    if (id) {
        window.location.search = `?id=${id}`;
    }
}

function cargarLog(id) {
    // In production, fetch from API
    console.log('Cargando log:', id);

    // Mock data population
    document.getElementById('log_id').value = id;
    document.getElementById('log_fecha').value = '2024-12-11T10:30';
    document.getElementById('log_tipo').value = 'Información';
    document.getElementById('log_severidad').value = 'Bajo';
    document.getElementById('log_usuario').value = 'admin';
    document.getElementById('log_modulo').value = 'Subvenciones';
    document.getElementById('log_accion').value = 'Creación de subvención';
    document.getElementById('log_ip').value = '192.168.1.100';
    document.getElementById('log_descripcion').value = 'Usuario creó nueva subvención SUB-2024-001';
    document.getElementById('log_detalles').value = 'Operación completada exitosamente. Tiempo de ejecución: 245ms\nPayload: {"monto": 5000000, "destinatario": "Org ABC"}';
    document.getElementById('log_resultado').value = 'Exitoso';
}

window.buscarLog = function () {
    solicitarID();
}
