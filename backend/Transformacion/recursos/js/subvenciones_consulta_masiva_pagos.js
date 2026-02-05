// subvenciones_consulta_masiva_pagos.js
let pagosData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosPagos();
});

async function cargarDatosPagos() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_pagos_mock.json');
        pagosData = await response.json();
        renderizarTablaPagos(pagosData);
    } catch (error) {
        console.error('Error cargando datos de pagos:', error);
    }
}

function renderizarTablaPagos(datos) {
    const tbody = document.querySelector('#tablaPagos tbody');
    tbody.innerHTML = '';

    datos.forEach(pago => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (pago.estado_evento.includes('PENDIENTE')) badgeClass = 'bg-warning text-dark';

        tr.innerHTML = `
            <td class="fw-bold">${pago.numero_subvencion}</td>
            <td>${pago.fecha_evento}</td>
            <td><span class="badge ${badgeClass} fw-normal">${pago.estado_evento}</span></td>
            <td>${pago.fecha_digitalizacion || '-'}</td>
            <td>${pago.responsable_evento}</td>
            <td class="small text-muted">${pago.glosa_evento}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${pago.numero_subvencion}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarPagos = function () {
    const filtros = {
        subvencion: document.getElementById('filtro_numero_subvencion').value.toLowerCase(),
        responsable: document.getElementById('filtro_responsable').value.toLowerCase(),
        glosa: document.getElementById('filtro_glosa').value.toLowerCase()
    };

    const datosFiltrados = pagosData.filter(p => {
        let cumple = true;
        if (filtros.subvencion && !p.numero_subvencion.toLowerCase().includes(filtros.subvencion)) cumple = false;
        if (filtros.responsable && !p.responsable_evento.toLowerCase().includes(filtros.responsable)) cumple = false;
        if (filtros.glosa && !p.glosa_evento.toLowerCase().includes(filtros.glosa) && !p.observaciones.toLowerCase().includes(filtros.glosa)) cumple = false;
        return cumple;
    });

    renderizarTablaPagos(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaPagos(pagosData);
}

window.verDetalle = function (numero) {
    window.location.href = 'subvenciones_consulta_subvencion.php?id=' + numero;
}

