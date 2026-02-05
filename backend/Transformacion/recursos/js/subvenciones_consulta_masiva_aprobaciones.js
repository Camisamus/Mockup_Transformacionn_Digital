// subvenciones_consulta_masiva_aprobaciones.js
let aprobacionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosAprobaciones();
});

async function cargarDatosAprobaciones() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_aprobaciones_mock.json');
        aprobacionesData = await response.json();
        renderizarTablaAprobaciones(aprobacionesData);
    } catch (error) {
        console.error('Error cargando datos de aprobaciones:', error);
    }
}

function renderizarTablaAprobaciones(datos) {
    const tbody = document.querySelector('#tablaAprobaciones tbody');
    tbody.innerHTML = '';

    datos.forEach(aprobacion => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (aprobacion.estado_actual.includes('PENDIENTE')) badgeClass = 'bg-warning text-dark';
        if (aprobacion.estado_actual.includes('RECHAZADA')) badgeClass = 'bg-danger';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(aprobacion.monto);

        tr.innerHTML = `
            <td class="fw-bold">${aprobacion.numero}</td>
            <td>${aprobacion.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${aprobacion.estado_actual}</span></td>
            <td>${aprobacion.rut}</td>
            <td>${aprobacion.nombre}</td>
            <td class="fw-bold">${montoFormateado}</td>
            <td>${aprobacion.anio_decreto || '-'}</td>
            <td>${aprobacion.numero_decreto || '-'}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${aprobacion.numero}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarAprobaciones = function () {
    const filtros = {
        numero: document.getElementById('filtro_numero').value.toLowerCase(),
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase(),
        nombre: document.getElementById('filtro_nombre').value.toLowerCase()
    };

    const datosFiltrados = aprobacionesData.filter(aprobacion => {
        let cumple = true;
        if (filtros.numero && !aprobacion.numero.toLowerCase().includes(filtros.numero)) cumple = false;
        if (filtros.rut && !aprobacion.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        if (filtros.estado && !aprobacion.estado_actual.toLowerCase().includes(filtros.estado)) cumple = false;
        if (filtros.nombre && !aprobacion.nombre.toLowerCase().includes(filtros.nombre)) cumple = false;
        return cumple;
    });

    renderizarTablaAprobaciones(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaAprobaciones(aprobacionesData);
}

window.verDetalle = function (numero) {
    window.location.href = 'subvenciones_consulta_subvencion.php?id=' + numero;
}

