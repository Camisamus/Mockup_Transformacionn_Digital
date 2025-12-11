// Load approvals data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatosAprobaciones();
});

let aprobacionesData = [];

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

        let badgeClass = 'badge-aprobada';
        if (aprobacion.estado_actual.includes('PENDIENTE')) badgeClass = 'badge-pendiente';
        if (aprobacion.estado_actual.includes('RECHAZADA')) badgeClass = 'badge-rechazada';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(aprobacion.monto);

        const anioDecreto = aprobacion.anio_decreto || '-';
        const numeroDecreto = aprobacion.numero_decreto || '-';

        tr.innerHTML = `
            <td>${aprobacion.numero}</td>
            <td>${aprobacion.fecha}</td>
            <td><span class="badge ${badgeClass}">${aprobacion.estado_actual}</span></td>
            <td>${aprobacion.rut}</td>
            <td>${aprobacion.nombre}</td>
            <td>${montoFormateado}</td>
            <td>${anioDecreto}</td>
            <td>${numeroDecreto}</td>
        `;

        tbody.appendChild(tr);
    });
}

function buscarAprobaciones() {
    console.log('Buscando aprobaciones');
}

function limpiarFiltros() {
    document.getElementById('filtro_numero').value = '';
    document.getElementById('filtro_fecha_inicio').value = '';
    document.getElementById('filtro_fecha_fin').value = '';
    document.getElementById('filtro_estado').value = '';
    document.getElementById('filtro_rut').value = '';
    document.getElementById('filtro_nombre').value = '';
    document.getElementById('filtro_monto_maximo').value = '';
    document.getElementById('filtro_anio_decreto').value = '';
    document.getElementById('filtro_numero_decreto').value = '';

    renderizarTablaAprobaciones(aprobacionesData);
}
