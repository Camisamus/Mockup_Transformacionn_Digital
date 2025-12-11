// Load rendiciones data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatosRendiciones();
});

let rendicionesData = [];

async function cargarDatosRendiciones() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_rendiciones_mock.json');
        rendicionesData = await response.json();
        renderizarTablaRendiciones(rendicionesData);
    } catch (error) {
        console.error('Error cargando datos de rendiciones:', error);
    }
}

function renderizarTablaRendiciones(datos) {
    const tbody = document.querySelector('#tablaRendiciones tbody');
    tbody.innerHTML = '';

    datos.forEach(rendicion => {
        const tr = document.createElement('tr');

        let badgeClass = 'badge-aprobada';
        if (rendicion.estado === 'OBSERVADA') badgeClass = 'badge-observada';
        if (rendicion.estado === 'CERRADA') badgeClass = 'badge-cerrada';
        if (rendicion.estado === 'PENDIENTE') badgeClass = 'badge-pendiente';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(rendicion.monto_rendido);

        tr.innerHTML = `
            <td>${rendicion.subvencion}</td>
            <td>${rendicion.rendicion}</td>
            <td>${rendicion.fecha}</td>
            <td><span class="badge ${badgeClass}">${rendicion.estado}</span></td>
            <td>${rendicion.informe_juridico}</td>
            <td>${rendicion.numero_ingreso}</td>
            <td>${rendicion.fecha_ingreso}</td>
            <td>${rendicion.rut}</td>
            <td>${rendicion.fiscalizador}</td>
            <td>${montoFormateado}</td>
        `;

        tbody.appendChild(tr);
    });
}

function buscarRendiciones() {
    console.log('Buscando rendiciones');
}

function limpiarFiltros() {
    document.getElementById('filtro_subvencion').value = '';
    document.getElementById('filtro_rendicion').value = '';
    document.getElementById('filtro_fecha_inicio').value = '';
    document.getElementById('filtro_fecha_fin').value = '';
    document.getElementById('filtro_estado').value = '';
    document.getElementById('filtro_informe_juridico').value = '';
    document.getElementById('filtro_numero_ingreso').value = '';
    document.getElementById('filtro_fecha_ingreso_inicio').value = '';
    document.getElementById('filtro_fecha_ingreso_fin').value = '';
    document.getElementById('filtro_rut').value = '';
    document.getElementById('filtro_fiscalizador').value = '';
    document.getElementById('filtro_monto_minimo').value = '';

    renderizarTablaRendiciones(rendicionesData);
}
