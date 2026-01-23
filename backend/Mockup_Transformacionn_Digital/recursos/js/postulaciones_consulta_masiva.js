// postulaciones_consulta_masiva.js
let postulacionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosPostulaciones();
});

async function cargarDatosPostulaciones() {
    try {
        const response = await fetch('../recursos/jsons/postulaciones_consulta_masiva_mock.json');
        postulacionesData = await response.json();
        renderizarTablaPostulaciones(postulacionesData);
    } catch (error) {
        console.error('Error cargando datos de postulaciones:', error);
    }
}

function renderizarTablaPostulaciones(datos) {
    const tbody = document.querySelector('#tablaPostulaciones tbody');
    tbody.innerHTML = '';

    datos.forEach(post => {
        const tr = document.createElement('tr');

        // Estado badge logic
        let badgeClass = 'bg-success';
        if (post.estado === 'En Evaluación') badgeClass = 'bg-warning text-dark';
        if (post.estado === 'Pendiente') badgeClass = 'bg-secondary';

        tr.innerHTML = `
            <td class="fw-bold">${post.rut}</td>
            <td class="text-primary fw-medium">${post.nombre_organizacion}</td>
            <td class="fw-bold">${post.numero_ingreso}</td>
            <td>${post.nombre_proyecto}</td>
            <td>${post.tipo_fondo}</td>
            <td>${post.fecha_ingreso}</td>
            <td>$${new Intl.NumberFormat('es-CL').format(post.monto)}</td>
            <td><span class="badge ${badgeClass} fw-normal">${post.estado}</span></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${post.numero_ingreso}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarPostulaciones = function () {
    const filtros = {
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        nombre_org: document.getElementById('filtro_nombre_org').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase()
    };

    const datosFiltrados = postulacionesData.filter(post => {
        let cumple = true;
        if (filtros.rut && !post.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        if (filtros.nombre_org && !post.nombre_organizacion.toLowerCase().includes(filtros.nombre_org)) cumple = false;
        if (filtros.estado && !post.estado.toLowerCase().includes(filtros.estado)) cumple = false;
        return cumple;
    });

    renderizarTablaPostulaciones(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaPostulaciones(postulacionesData);
}

window.verDetalle = function (id) {
    window.location.href = `postulaciones_consulta_postulacion.html?id=${id}`;
}

window.crearNueva = function () {
    window.location.href = 'postulaciones_consulta_postulacion.html';
}
