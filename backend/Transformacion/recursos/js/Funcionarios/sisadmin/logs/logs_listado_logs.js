// logs_listado_logs.js
let logsData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarLogs();
});

async function cargarLogs() {
    try {
        // Fetch from the new API
        const response = await fetch(`${window.API_BASE_URL}/logs.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                ACCION: 'LIST',
            }),
        });
        if (!response.ok) throw new Error('Error en la respuesta del servidor');

        logsData = await response.json();
        renderizarTablaLogs(logsData);
    } catch (error) {
        console.error('Error cargando logs:', error);
        Swal.fire('Error', 'No se pudieron cargar los logs del sistema', 'error');
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

window.buscarLogs = async function () {
    const tipo = document.getElementById('filtro_tipo').value;
    const modulo = document.getElementById('filtro_modulo').value;
    const usuario = document.getElementById('filtro_usuario').value;
    const fechaDesde = document.getElementById('filtro_fecha_desde').value;
    const fechaHasta = document.getElementById('filtro_fecha_hasta').value;

    const params = new URLSearchParams();
    params.append('action', 'LIST');
    if (tipo) params.append('tipo', tipo);
    if (modulo) params.append('modulo', modulo);
    if (usuario) params.append('usuario', usuario);
    if (fechaDesde) params.append('fecha_desde', fechaDesde);
    if (fechaHasta) params.append('fecha_hasta', fechaHasta);

    try {
        const response = await fetch(`${window.API_BASE_URL}/logs.php?${params.toString()}`);
        if (!response.ok) throw new Error('Error filtrando logs');

        logsData = await response.json();
        renderizarTablaLogs(logsData);
    } catch (error) {
        console.error('Error buscando logs:', error);
        Swal.fire('Error', 'No se pudieron filtrar los logs', 'error');
    }
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaLogs(logsData);
}

window.verDetalle = function (logId) {
    window.location.href = `logs_consulta_log.php?id=${logId}`;
}

