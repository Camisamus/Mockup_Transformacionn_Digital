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
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
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
        tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-10 text-center text-slate-400 italic">No se encontraron registros.</td></tr>';
        document.getElementById('resultados_count').textContent = '0';
        return;
    }

    datos.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50/80 transition-all cursor-pointer group';
        tr.onclick = () => window.location.href = `consultar.php?id=${item.tis_id}`;

        const statusColors = getStatusColors(item.tis_estado);

        tr.innerHTML = `
            <td class="px-6 py-4 text-xs font-black text-slate-400 tracking-tight">#${item.tis_id}</td>
            <td class="px-6 py-4">
                <button type="button" class="text-primary-blue hover:text-blue-800 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                </button>
            </td>
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span class="font-bold text-slate-700 text-sm group-hover:text-primary-blue transition-colors truncate max-w-[250px]">
                        ${item.tis_titulo || 'Sin título'}
                    </span>
                    <span class="text-slate-400 text-[10px] truncate max-w-[250px]">
                        ${item.tis_contenido || ''}
                    </span>
                </div>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="text-xs font-medium text-slate-500">${(item.tis_creacion || '').substring(0, 10)}</span>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusColors}">
                    ${item.tis_estado || '-'}
                </span>
            </td>
            <td class="px-6 py-4">
                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border bg-blue-50 text-primary-blue border-blue-100">
                    ${item.tis_tipo || '-'}
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="font-bold text-slate-700 text-sm">${item.resp_nombre || ''} ${item.resp_apellido || ''}</div>
                <div class="text-[10px] text-slate-400 uppercase tracking-widest">ID: ${item.tis_responsable}</div>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = allData.length;
}

function getStatusColors(estado) {
    if (!estado) return 'bg-blue-50 text-blue-600 border-blue-100';
    estado = estado.toLowerCase();
    if (estado.includes('favorable') && !estado.includes('no_favorable')) return 'bg-emerald-50 text-emerald-600 border-emerald-100';
    if (estado.includes('rechazado') || estado.includes('no_favorable')) return 'bg-rose-50 text-rose-600 border-rose-100';
    return 'bg-blue-50 text-blue-600 border-blue-100';
}

function renderPagination() {
    const totalPages = Math.ceil(allData.length / pageSize);
    const paginationContainer = document.getElementById('pagination_container');
    if (!paginationContainer) return;

    paginationContainer.innerHTML = '';
    if (allData.length === 0) return;

    // Info text at left
    const infoText = document.createElement('div');
    infoText.className = 'pagination-info text-xs font-semibold text-slate-400';
    infoText.innerText = `Página ${currentPage} de ${totalPages || 1}`;
    paginationContainer.appendChild(infoText);

    const nav = document.createElement('div');
    nav.className = 'flex gap-2';

    // Anterior
    const btnAnt = document.createElement('button');
    btnAnt.className = 'flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all';
    btnAnt.disabled = currentPage === 1;
    btnAnt.innerHTML = '<span class="material-symbols-outlined text-sm">chevron_left</span> Anterior';
    btnAnt.onclick = (e) => {
        e.preventDefault();
        changePage(currentPage - 1);
    };

    // Siguiente
    const btnSig = document.createElement('button');
    btnSig.className = 'flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all';
    btnSig.disabled = currentPage === totalPages || totalPages === 0;
    btnSig.innerHTML = 'Siguiente <span class="material-symbols-outlined text-sm">chevron_right</span>';
    btnSig.onclick = (e) => {
        e.preventDefault();
        changePage(currentPage + 1);
    };

    nav.appendChild(btnAnt);
    nav.appendChild(btnSig);
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

