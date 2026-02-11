let currentPage = 1;
const pageSize = 5;
let allData = [];

document.addEventListener('DOMContentLoaded', () => {
    cargarBandeja();

    const formFiltros = document.getElementById('form_filtros');
    const inputTitulo = document.getElementById('filtro_titulo');
    const inputRgt = document.getElementById('filtro_rgt');
    const inputId = document.getElementById('filtro_id');

    const limpiarOtros = (actual) => {
        if (actual !== inputTitulo) inputTitulo.value = '';
        if (actual !== inputRgt) inputRgt.value = '';
        if (actual !== inputId) inputId.value = '';
    };

    inputTitulo.addEventListener('input', () => limpiarOtros(inputTitulo));
    inputRgt.addEventListener('input', () => limpiarOtros(inputRgt));
    inputId.addEventListener('input', () => limpiarOtros(inputId));

    formFiltros.addEventListener('submit', (e) => {
        e.preventDefault();
        const filters = {
            tis_titulo: document.getElementById('filtro_titulo').value,
            rgt_id_publica: document.getElementById('filtro_rgt').value,
            tis_id: document.getElementById('filtro_id').value
        };
        cargarBandeja(filters);
    });

    document.getElementById('btn_limpiar').addEventListener('click', () => {
        setTimeout(() => cargarBandeja(), 10); // Wait for reset
    });
});

async function cargarBandeja(filters = {}) {
    const tabla = document.getElementById('tabla_ingresos');

    // Default status if not searching by specific IDs
    const searchFilters = { ...filters };
    if (!searchFilters.tis_id && !searchFilters.rgt_id_publica && !searchFilters.tis_estado) {
        searchFilters.tis_estado = 'Ingresado';
    }

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

    // Pages numbers (optional, but requested "botones de desplazamiento", usually includes numbers or just prev/next)
    // Let's show simple info and buttons
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

function renderizarTabla(data) {
    const tabla = document.getElementById('tabla_ingresos');
    tabla.innerHTML = '';

    if (data.length === 0) {
        tabla.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No se encontraron registros.</td></tr>';
        return;
    }

    data.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'cursor-pointer';
        tr.onclick = () => {
            window.location.href = `ingr_consultar.php?id=${item.tis_id}`;
        };

        const rgtCode = item.rgt_id_publica || '-';

        tr.innerHTML = `
            <td class="ps-4 text-muted small">${item.tis_id}</td>
            <td class="text-end pe-4">
                <button type="button" class="btn btn-lg btn-outline-dark p-1" title="Consultar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
            <td>
                <div class="fw-bold">${item.tis_titulo || 'Sin título'}</div>
                <div class="small text-muted text-truncate" style="max-width: 300px;">${item.tis_contenido || ''}</div>
            </td>
            <td><span class="small">${(item.tis_fecha || '').substring(0, 10)}</span></td>
            <td><span class="badge ${item.tis_estado === 'Ingresado' ? 'bg-success' : 'bg-primary'}">${item.tis_estado || '-'}</span></td>
            <td>${getRolBadge(item.rol_usuario)}</td>
            <td class="rgt-container text-end">
                <button type="button" class="btn btn- btn-outline-secondary p-1 btn-show-code" title="Ver Código">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
                <code class="d-none">${rgtCode}</code>
            </td>
            `;

        // Attach click to the show button
        const btnShow = tr.querySelector('.btn-show-code');
        btnShow.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent tr.onclick
            Swal.fire({
                title: 'Código Público (RGT)',
                html: `<div class="p-3 bg-light rounded shadow-sm">
                        <code style="font-size: 2rem; letter-spacing: 2px;">${rgtCode}</code>
                       </div>`,
                confirmButtonText: 'Cerrar',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        });

        tabla.appendChild(tr);
    });

    if (window.feather) window.feather.replace();
}

function getRolBadge(rol) {
    if (!rol) return '<span class="badge bg-secondary">Consultor</span>';

    switch (rol) {
        case 'Responsable':
            return '<span class="badge bg-info text-dark">Responsable</span>';
        case 'Firmante':
            return '<span class="badge bg-warning text-dark">Firmante</span>';
        case 'Visador':
            return '<span class="badge bg-primary">Visador</span>';
        default:
            return `<span class="badge bg-secondary">${rol}</span>`;
    }
}

