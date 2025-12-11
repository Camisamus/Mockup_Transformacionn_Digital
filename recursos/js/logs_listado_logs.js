// logs_listado_logs.js
// Handles system logs listing functionality

let logsData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarLogs();
});

async function cargarLogs() {
    try {
        const response = await fetch('../recursos/jsons/logs_listado_mock.json');
        logsData = await response.json();
        renderizarTabla(logsData);
    } catch (error) {
        console.error('Error cargando logs:', error);
    }
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaLogs tbody');
    if (!tbody) return;
    tbody.innerHTML = '';

    datos.forEach(log => {
        const tr = document.createElement('tr');

        let badgeClass = 'badge-info';
        if (log.tipo === 'WARNING') badgeClass = 'badge-warning';
        if (log.tipo === 'ERROR') badgeClass = 'badge-error';
        if (log.tipo === 'CRITICAL') badgeClass = 'badge-critical';

        tr.innerHTML = `
            <td>${log.id}</td>
            <td>${log.fecha}</td>
            <td><span class="badge ${badgeClass}">${log.tipo}</span></td>
            <td>${log.modulo}</td>
            <td>${log.usuario}</td>
            <td>${log.accion}</td>
            <td>${log.descripcion}</td>
            <td>${log.ip}</td>
            <td><button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${log.id}')">👁️</button></td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

function buscarLogs() {
    // Implement filtering logic here based on logsData
    console.log('Buscando logs');
    alert('Búsqueda simulada aplicada.');
}

function limpiarFiltros() {
    document.getElementById('filtro_fecha_desde').value = '';
    document.getElementById('filtro_fecha_hasta').value = '';
    document.getElementById('filtro_tipo').value = '';
    document.getElementById('filtro_modulo').value = '';
    document.getElementById('filtro_usuario').value = '';

    renderizarTabla(logsData);
}

function verDetalle(logId) {
    window.location.href = 'logs_consulta_log.html?id=' + logId;
}
