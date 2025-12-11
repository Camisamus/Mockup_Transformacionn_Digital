// Load fiscalizaciones data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatosFiscalizaciones();
});

let fiscalizacionesData = [];

async function cargarDatosFiscalizaciones() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_fiscalizaciones_mock.json');
        fiscalizacionesData = await response.json();
        renderizarTablaFiscalizaciones(fiscalizacionesData);
    } catch (error) {
        console.error('Error cargando datos de fiscalizaciones:', error);
    }
}

function renderizarTablaFiscalizaciones(datos) {
    const tbody = document.querySelector('#tablaFiscalizaciones tbody');
    tbody.innerHTML = '';

    datos.forEach(fisc => {
        const tr = document.createElement('tr');

        let badgeClass = 'badge-cerrada';
        if (fisc.estado === 'PENDIENTE') badgeClass = 'badge-pendiente';
        if (fisc.estado === 'OBSERVADA') badgeClass = 'badge-observada';
        if (fisc.estado === 'APROBADA') badgeClass = 'badge-aprobada';

        tr.innerHTML = `
            <td>${fisc.subvencion}</td>
            <td>${fisc.fiscalizacion}</td>
            <td>${fisc.fecha}</td>
            <td><span class="badge ${badgeClass}">${fisc.estado}</span></td>
            <td>${fisc.fecha_estado}</td>
            <td>${fisc.numero_ingreso}</td>
            <td>${fisc.fecha_ingreso}</td>
            <td>${fisc.rut_fiscalizador}</td>
            <td>${fisc.fiscalizador}</td>
            <td>${fisc.resultado}</td>
        `;

        tbody.appendChild(tr);
    });
}

function buscarFiscalizaciones() {
    console.log('Buscando fiscalizaciones');
}

function limpiarFiltros() {
    document.getElementById('filtro_subvencion').value = '';
    document.getElementById('filtro_fiscalizacion').value = '';
    document.getElementById('filtro_fecha_inicio').value = '';
    document.getElementById('filtro_fecha_fin_inicio').value = '';
    document.getElementById('filtro_fecha_ingreso').value = '';
    document.getElementById('filtro_fecha_ingreso_inicio').value = '';
    document.getElementById('filtro_fecha_ingreso_fin').value = '';
    document.getElementById('filtro_rut_fiscalizador').value = '';
    document.getElementById('filtro_fiscalizacion2').value = '';
    document.getElementById('filtro_resultado').value = '';

    renderizarTablaFiscalizaciones(fiscalizacionesData);
}
