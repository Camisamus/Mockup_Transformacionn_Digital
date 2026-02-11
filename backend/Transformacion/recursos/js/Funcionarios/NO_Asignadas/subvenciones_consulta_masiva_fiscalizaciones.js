// subvenciones_consulta_masiva_fiscalizaciones.js
let fiscalizacionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosFiscalizaciones();
});

async function cargarDatosFiscalizaciones() {
    try {
        const response = await fetch('../../recursos/jsons/subvenciones_consulta_masiva_fiscalizaciones_mock.json');
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

        let badgeClass = 'bg-success';
        if (fisc.estado.includes('PENDIENTE')) badgeClass = 'bg-warning text-dark';
        if (fisc.estado.includes('OBSERVADA')) badgeClass = 'bg-danger';
        if (fisc.estado.includes('CERRADA')) badgeClass = 'bg-secondary';

        tr.innerHTML = `
            <td class="fw-bold">${fisc.subvencion}</td>
            <td class="text-primary fw-medium">${fisc.fiscalizacion}</td>
            <td>${fisc.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${fisc.estado}</span></td>
            <td>${fisc.fecha_de_estado}</td>
            <td>${fisc.numero_de_ingreso || '-'}</td>
            <td>${fisc.rut_fiscalizador}</td>
            <td>${fisc.resultado || '-'}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${fisc.subvencion}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarFiscalizaciones = function () {
    const filtros = {
        subvencion: document.getElementById('filtro_subvencion').value.toLowerCase(),
        fiscalizacion: document.getElementById('filtro_fiscalizacion').value.toLowerCase(),
        rut: document.getElementById('filtro_rut_fiscalizador').value.toLowerCase()
    };

    const datosFiltrados = fiscalizacionesData.filter(f => {
        let cumple = true;
        if (filtros.subvencion && !f.subvencion.toLowerCase().includes(filtros.subvencion)) cumple = false;
        if (filtros.fiscalizacion && !f.fiscalizacion.toLowerCase().includes(filtros.fiscalizacion)) cumple = false;
        if (filtros.rut && !f.rut_fiscalizador.toLowerCase().includes(filtros.rut)) cumple = false;
        return cumple;
    });

    renderizarTablaFiscalizaciones(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaFiscalizaciones(fiscalizacionesData);
}

window.verDetalle = function (numero) {
    window.location.href = 'subvenciones_consulta_subvencion.php?id=' + numero;
}

