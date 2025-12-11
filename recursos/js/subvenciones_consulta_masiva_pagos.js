// Load payment data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatosPagos();
});

let pagosData = [];

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

        let badgeClass = pago.estado_evento === 'TERMINADA' ? 'badge-terminada' : 'badge-pendiente';
        let fechaDigit = pago.fecha_digitalizacion || '-';

        tr.innerHTML = `
            <td>${pago.numero_subvencion}</td>
            <td>${pago.fecha_evento}</td>
            <td><span class="badge ${badgeClass}">${pago.estado_evento}</span></td>
            <td>${fechaDigit}</td>
            <td>${pago.responsable_evento}</td>
            <td>${pago.glosa_evento}</td>
            <td>${pago.observaciones}</td>
        `;

        tbody.appendChild(tr);
    });
}

function buscarPagos() {
    console.log('Buscando pagos');
    // Implement filtering logic here
}

function limpiarFiltros() {
    document.getElementById('filtro_numero_subvencion').value = '';
    document.getElementById('filtro_fecha_evento_inicio').value = '';
    document.getElementById('filtro_fecha_evento_fin').value = '';
    document.getElementById('filtro_estado_evento').value = '';
    document.getElementById('filtro_fecha_digitalizacion_inicio').value = '';
    document.getElementById('filtro_fecha_digitalizacion_fin').value = '';
    document.getElementById('filtro_responsable').value = '';
    document.getElementById('filtro_glosa').value = '';
    document.getElementById('filtro_observaciones').value = '';

    renderizarTablaPagos(pagosData);
}
