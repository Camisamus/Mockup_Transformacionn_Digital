// subvenciones_consulta_masiva_rendiciones.js
let rendicionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosRendiciones();
});

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

    datos.forEach(ren => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (ren.estado.includes('PENDIENTE')) badgeClass = 'bg-info ';
        if (ren.estado.includes('OBSERVADA')) badgeClass = 'bg-warning text-dark';
        if (ren.estado.includes('CERRADA')) badgeClass = 'bg-secondary';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(ren.monto_rendido);

        tr.innerHTML = `
            <td class="fw-bold">${ren.subvencion}</td>
            <td class="text-primary fw-medium">${ren.rendicion}</td>
            <td>${ren.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${ren.estado}</span></td>
            <td class="small">${ren.informe_juridico || '-'}</td>
            <td>${ren.numero_de_ingreso || '-'}</td>
            <td>${ren.rut}</td>
            <td>${ren.fiscalizador}</td>
            <td class="fw-bold">${montoFormateado}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${ren.subvencion}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarRendiciones = function () {
    const filtros = {
        subvencion: document.getElementById('filtro_subvencion').value.toLowerCase(),
        rendicion: document.getElementById('filtro_rendicion').value.toLowerCase(),
        rut: document.getElementById('filtro_rut').value.toLowerCase()
    };

    const datosFiltrados = rendicionesData.filter(r => {
        let cumple = true;
        if (filtros.subvencion && !r.subvencion.toLowerCase().includes(filtros.subvencion)) cumple = false;
        if (filtros.rendicion && !r.rendicion.toLowerCase().includes(filtros.rendicion)) cumple = false;
        if (filtros.rut && !r.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        return cumple;
    });

    renderizarTablaRendiciones(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaRendiciones(rendicionesData);
}

window.verDetalle = function (numero) {
    window.location.href = 'subvenciones_consulta_subvencion.php?id=' + numero;
}

