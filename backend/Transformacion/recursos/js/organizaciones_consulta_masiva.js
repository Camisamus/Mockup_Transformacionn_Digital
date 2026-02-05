// organizaciones_consulta_masiva.js
let organizacionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatosOrganizaciones();
});

async function cargarDatosOrganizaciones() {
    try {
        const response = await fetch('../recursos/jsons/organizaciones_consulta_masiva_mock.json');
        organizacionesData = await response.json();
        renderizarTablaOrganizaciones(organizacionesData);
    } catch (error) {
        console.error('Error cargando datos de organizaciones:', error);
    }
}

function renderizarTablaOrganizaciones(datos) {
    const tbody = document.querySelector('#tablaOrganizaciones tbody');
    tbody.innerHTML = '';

    datos.forEach(org => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td class="fw-bold">${org.rut}</td>
            <td class="text-primary fw-medium">${org.nombre}</td>
            <td>${org.codigo}</td>
            <td>${org.rpj}</td>
            <td>${org.fechaInscripcion}</td>
            <td>${org.fechaTerminoVigencia}</td>
            <td>${org.representanteLegal}</td>
            <td>${org.unidadVecinal}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${org.codigo}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    const countEl = document.getElementById('resultados_count');
    if (countEl) countEl.textContent = datos.length;
}

window.buscarOrganizaciones = function () {
    const filtros = {
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        nombre: document.getElementById('filtro_nombre').value.toLowerCase(),
        codigo: document.getElementById('filtro_codigo').value.toLowerCase()
    };

    const datosFiltrados = organizacionesData.filter(org => {
        let cumple = true;
        if (filtros.rut && !org.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        if (filtros.nombre && !org.nombre.toLowerCase().includes(filtros.nombre)) cumple = false;
        if (filtros.codigo && !org.codigo.toLowerCase().includes(filtros.codigo)) cumple = false;
        return cumple;
    });

    renderizarTablaOrganizaciones(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTablaOrganizaciones(organizacionesData);
}

window.verDetalle = function (codigo) {
    window.location.href = `organizaciones_consulta_organizacion.php?id=${codigo}`;
}

window.nuevaOrganizacion = function () {
    window.location.href = 'organizaciones_consulta_organizacion.php';
}

