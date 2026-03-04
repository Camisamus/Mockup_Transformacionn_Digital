// historial.js - Migrado a DataTables
let allData = [];
let tableInstance = null;

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos(filters = {}) {
    const tbody = document.querySelector('#tablaResultados tbody');

    // History statuses
    const searchFilters = {
        tis_estado: ['Resuelto_Favorable', 'Resuelto_NO_Favorable', 'Visado'],
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
            renderizarTabla(allData);
        } else {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }
    } catch (error) {
        console.error('Error:', error);
        tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error de conexión con el servidor.</td></tr>`;
    }
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');

    // 1. Destruir instancia previa si existe
    if (tableInstance) {
        tableInstance.destroy();
    }

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
                <div class="text-[10px] text-slate-400 uppercase tracking-widest">ID: ${item.tis_propietario}</div>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = allData.length;

    // 2. Inicializar DataTable
    tableInstance = $('#tablaResultados').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        "pageLength": 5,
        "lengthChange": false,
        "order": [[0, 'desc']], // Ordenar por ID descendente (más recientes primero)
        "dom": 'rt<"p-4 border-t flex justify-between items-center"ip>',
        "columnDefs": [
            { "orderable": false, "targets": [1] } // Botón ver no ordenable
        ],
        "pagingType": "simple_numbers",
        "drawCallback": function () {
            if (window.feather) feather.replace();
        }
    });

    // 3. Ocultamos tu paginación vieja ya que DT usará la suya
    const pagOld = document.getElementById('pagination_container');
    if (pagOld) pagOld.style.display = 'none';
}

function getStatusColors(estado) {
    if (!estado) return 'bg-blue-50 text-blue-600 border-blue-100';
    estado = estado.toLowerCase();
    if (estado.includes('favorable') && !estado.includes('no_favorable')) return 'bg-emerald-50 text-emerald-600 border-emerald-100';
    if (estado.includes('rechazado') || estado.includes('no_favorable')) return 'bg-rose-50 text-rose-600 border-rose-100';
    return 'bg-blue-50 text-blue-600 border-blue-100';
}

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
