// ingr_historial.js
let currentPage = 1;
const pageSize = 5;
let allData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos(filters = {}) {
    const tabla = document.querySelector('#tablaResultados tbody');

    // History statuses
    const searchFilters = {
        tis_estado: ['Resuelto_Favorable', 'Resuelto_NO_Favorable'],
        ...filters
    };

    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'CONSULTAM',
                ...searchFilters
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            allData = result.data;
            currentPage = 1;
            renderTablaPaginada();
        } else {
            tabla.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }
    } catch (error) {
        console.error('Error:', error);
        tabla.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error de conexión con el servidor.</td></tr>`;
    }
}

function renderTablaPaginada() {
    const start = (currentPage - 1) * pageSize;
    const end = start + pageSize;
    const paginatedData = allData.slice(start, end);

    renderizarTabla(paginatedData);
    renderPagination();
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    if (datos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No se encontraron registros.</td></tr>';
        document.getElementById('resultados_count').textContent = '0';
        return;
    }

    datos.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'cursor-pointer';
        tr.onclick = () => window.location.href = `ingr_consultar.php?id=${item.tis_id}`;

        let badgeClass = 'bg-success';
        if (item.tis_estado === 'Resuelto_Favorable') badgeClass = 'bg-success';
        if (item.tis_estado === 'Resuelto_NO_Favorable') badgeClass = 'bg-danger';

        tr.innerHTML = `
            <td class="fw-bold">${item.tis_id}</td>
            <td>${(item.tis_fecha || '').substring(0, 10)}</td>
            <td><span class="badge ${badgeClass} fw-normal">${item.tis_estado}</span></td>
            <td>${item.tis_tipo || '-'}</td>
            <td>${item.resp_nombre || ''} ${item.resp_apellido || ''}</td>
            <td class="fw-bold">-</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-dark" onclick="event.stopPropagation(); window.location.href='ingr_consultar.php?id=${item.tis_id}'" title="Ver Detalle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = allData.length;
    if (window.feather) window.feather.replace();
}

function renderPagination() {
    const totalPages = Math.ceil(allData.length / pageSize);
    const paginationContainer = document.getElementById('pagination_container');
    if (!paginationContainer) return;

    paginationContainer.innerHTML = '';

    if (allData.length === 0) return;

    const nav = document.createElement('nav');
    const ul = document.createElement('ul');
    ul.className = 'pagination pagination-sm justify-content-center mb-0';

    // Anterior
    ul.innerHTML += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPage - 1})">Anterior</a>
        </li>
    `;

    ul.innerHTML += `
        <li class="page-item disabled">
            <span class="page-link text-dark">Página ${currentPage} de ${totalPages || 1}</span>
        </li>
    `;

    // Siguiente
    ul.innerHTML += `
        <li class="page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="event.preventDefault(); changePage(${currentPage + 1})">Siguiente</a>
        </li>
    `;

    nav.appendChild(ul);
    paginationContainer.appendChild(nav);
}

window.changePage = function (page) {
    const totalPages = Math.ceil(allData.length / pageSize);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderTablaPaginada();
};

window.buscarIngresos = function () {
    const filtros = {
        tis_id: document.getElementById('filtro_id').value,
        fecha_inicio: document.getElementById('filtro_fecha_inicio').value,
        fecha_fin: document.getElementById('filtro_fecha_fin').value,
        responsable_nombre: document.getElementById('filtro_responsable').value,
        tis_estado: document.getElementById('filtro_estado').value
    };

    cargarDatos(filtros);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    cargarDatos();
}

