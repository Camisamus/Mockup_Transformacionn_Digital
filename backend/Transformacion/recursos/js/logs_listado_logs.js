// logs_listado_logs.js
let logsData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarLogs();
});

async function cargarLogs() {
    try {
        const response = await fetch('../recursos/jsons/logs_listado_mock.json');
        logsData = await response.json();
        renderizarTablaLogs(logsData);
    } catch (error) {
        console.error('Error cargando logs:', error);
    }
}

function renderizarTablaLogs(datos) {
    const tbody = document.querySelector('#tablaLogs tbody');
    if (!tbody) return;
    tbody.innerHTML = '';

    datos.forEach(log => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-info text-dark';
        if (log.tipo === 'WARNING') badgeClass = 'bg-warning text-dark';
        if (log.tipo === 'ERROR') badgeClass = 'bg-danger';
        if (log.tipo === 'CRITICAL') badgeClass = 'bg-dark';

        tr.innerHTML = `
            <td class="fw-bold">${log.id}</td>
            <td>${log.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${log.tipo}</span></td>
            <td>${log.modulo}</td>
            <td class="text-primary">${log.usuario}</td>
            <td>${log.accion}</td>
            <td class="text-muted">${log.descripcion}</td>
            <td>${log.ip}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${log.id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarLogs = function () {
    const filtros = {
        tipo: document.getElementById('filtro_tipo').value,
        modulo: document.getElementById('filtro_modulo').value,
        usuario: document.getElementById('filtro_usuario').value.toLowerCase()
    };

    const datosFiltrados = logsData.filter(log => {
        let cumple = true;
        if (filtros.tipo && log.tipo !== filtros.tipo.toUpperCase()) cumple = false;
        if (filtros.modulo && !log.modulo.toLowerCase().includes(filtros.modulo.toLowerCase())) cumple = false;
        if (filtros.usuario && !log.usuario.toLowerCase().includes(filtros.usuario)) cumple = false;
        return cumple;
    });

    renderizarTablaLogs(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaLogs(logsData);
}

window.verDetalle = function (logId) {
    window.location.href = `logs_consulta_log.html?id=${logId}`;
}
