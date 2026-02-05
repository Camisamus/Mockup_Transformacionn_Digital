// subvenciones_consulta_masiva.js
let subvencionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_mock.json');
        subvencionesData = await response.json();
        renderizarTabla(subvencionesData);
    } catch (error) {
        console.error('Error cargando datos de subvenciones:', error);
    }
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    datos.forEach(subvencion => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (subvencion.estado_actual === 'PENDIENTE') badgeClass = 'bg-warning text-dark';
        if (subvencion.estado_actual === 'CERRADA') badgeClass = 'bg-secondary';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(subvencion.monto);

        tr.innerHTML = `
            <td class="fw-bold">${subvencion.numero}</td>
            <td>${subvencion.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${subvencion.estado_actual}</span></td>
            <td>${subvencion.rut}</td>
            <td>${subvencion.nombre}</td>
            <td class="fw-bold">${montoFormateado}</td>
            <td>${subvencion.anio_decreto || '-'}</td>
            <td>${subvencion.numero_decreto || '-'}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${subvencion.numero}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

window.buscarSubvenciones = function () {
    const filtros = {
        numero: document.getElementById('filtro_numero').value.toLowerCase(),
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase()
    };

    const datosFiltrados = subvencionesData.filter(subvencion => {
        let cumple = true;

        if (filtros.numero && !subvencion.numero.toLowerCase().includes(filtros.numero)) cumple = false;
        if (filtros.rut && !subvencion.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        if (filtros.estado && subvencion.estado_actual.toLowerCase() !== filtros.estado) cumple = false;

        return cumple;
    });

    renderizarTabla(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTabla(subvencionesData);
}

window.verDetalle = function (numero) {
    window.location.href = 'subvenciones_consulta_subvencion.php?id=' + numero;
}

