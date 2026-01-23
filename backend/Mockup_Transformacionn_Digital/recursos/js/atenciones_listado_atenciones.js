// atenciones_listado_atenciones.js
let atencionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos() {
    try {
        const response = await fetch('../recursos/jsons/atenciones_listado_mock.json');
        atencionesData = await response.json();
        renderizarTabla(atencionesData);
    } catch (error) {
        console.error('Error cargando datos de atenciones:', error);
    }
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaAtenciones tbody');
    tbody.innerHTML = '';

    datos.forEach(atencion => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (atencion.estado === 'En Proceso') badgeClass = 'bg-info text-dark';
        if (atencion.estado === 'Pendiente') badgeClass = 'bg-warning text-dark';

        tr.innerHTML = `
            <td class="fw-bold">${atencion.numero_atencion}</td>
            <td>${atencion.fecha}</td>
            <td><span class="badge bg-white text-dark border fw-normal px-2">${atencion.tipo}</span></td>
            <td>${atencion.organizacion}</td>
            <td>${atencion.proyecto}</td>
            <td><span class="badge ${badgeClass} fw-normal">${atencion.estado}</span></td>
            <td>${atencion.usuario}</td>
            <td>${atencion.area}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${atencion.numero_atencion}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

window.buscarAtenciones = function () {
    const filtros = {
        estado: document.getElementById('filtro_estado').value.toLowerCase(),
        tipo: document.getElementById('filtro_tipo').value.toLowerCase(),
        organizacion: document.getElementById('filtro_organizacion').value.toLowerCase()
    };

    const datosFiltrados = atencionesData.filter(atencion => {
        let cumple = true;

        if (filtros.estado && !atencion.estado.toLowerCase().includes(filtros.estado)) cumple = false;
        if (filtros.tipo && !atencion.tipo.toLowerCase().includes(filtros.tipo)) cumple = false;
        if (filtros.organizacion && !atencion.organizacion.toLowerCase().includes(filtros.organizacion)) cumple = false;

        return cumple;
    });

    renderizarTabla(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTabla(atencionesData);
}

window.verDetalle = function (numero) {
    window.location.href = 'atenciones_consulta_atencion.html?id=' + numero;
}
