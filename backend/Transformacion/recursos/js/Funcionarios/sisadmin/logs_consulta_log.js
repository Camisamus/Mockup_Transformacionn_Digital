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

async function cargarLog(id) {
    try {
        const response = await fetch(`../api/logs.php`,
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ACCION: 'GET',
                    id: id,
                }),
            }
        );
        if (!response.ok) throw new Error('Log no encontrado');

        const log = await response.json();

        // Populate fields
        document.getElementById('log_id').value = log.id;
        document.getElementById('log_fecha').value = log.fecha;
        document.getElementById('log_tipo').value = log.tipo;
        document.getElementById('log_severidad').value = log.severidad || 'N/A';
        document.getElementById('log_usuario').value = log.usuario;
        document.getElementById('log_modulo').value = log.modulo;
        document.getElementById('log_accion').value = log.accion;
        document.getElementById('log_ip').value = log.ip || '0.0.0.0';
        document.getElementById('log_descripcion').value = log.descripcion;
        document.getElementById('log_detalles').value = log.detalles || 'Sin detalles técnicos registrados.';
        document.getElementById('log_resultado').value = log.resultado || 'Desconocido';

    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo cargar la información del log: ' + error.message,
            confirmButtonText: 'Volver',
            confirmButtonColor: '#212529'
        }).then(() => {
            window.location.href = 'logs_listado_logs.php';
        });
    }
}

window.buscarLog = function () {
    solicitarID();
}

