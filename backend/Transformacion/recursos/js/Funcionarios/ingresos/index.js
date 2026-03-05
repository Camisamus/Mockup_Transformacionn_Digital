let currentPage = 1;
const pageSize = 5;
let allData = [];

document.addEventListener('DOMContentLoaded', () => {
    cargarBandeja();
    cargarMetricas();
    cargarGraficos();

    const formFiltros = document.getElementById('form_filtros');
    if (formFiltros) {
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
    }

    const btnLimpiar = document.getElementById('btn_limpiar');
    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', () => {
            setTimeout(() => cargarBandeja(), 10);
        });
    }
});

async function cargarMetricas() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'METRICAS' })
        });
        const result = await response.json();
        if (result.status === 'success') {
            const data = result.data;
            document.getElementById('metricTotal').innerText = data.total;
            document.getElementById('metricPendientes').innerText = data.pendientes;
            document.getElementById('metricPromedio').innerText = data.tiempo_promedio;
            document.getElementById('metricMes').innerText = data.resueltas_mes;
        }
    } catch (error) {
        console.error('Error al cargar métricas:', error);
    }
}

async function cargarGraficos() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'GRAFICOS' })
        });
        const result = await response.json();
        if (result.status === 'success') {
            renderChartEstado(result.data.estados);
            renderChartTipo(result.data.tipos);
        }
    } catch (error) {
        console.error('Error al cargar gráficos:', error);
    }
}

function renderChartEstado(datos) {
    const ctx = document.getElementById('chartEstado');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datos.map(i => i.label),
            datasets: [{
                label: 'Solicitudes',
                data: datos.map(i => i.value),
                backgroundColor: '#1a5f9c',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });
}

function renderChartTipo(datos) {
    const ctx = document.getElementById('chartTipo');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: datos.map(i => i.label),
            datasets: [{
                data: datos.map(i => i.value),
                backgroundColor: ['#1a5f9c', '#f59e0b', '#10b981', '#6366f1', '#ec4899', '#f43f5e'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { size: 10 } } }
            },
            cutout: '70%'
        }
    });
}

async function cargarBandeja(filters = {}) {
    const tablaContainer = document.getElementById('tabla_ingresos');

    const searchFilters = { ...filters };
    // Eliminamos el filtro forzado de "Ingresado" para que traiga todos los estados correspondientes (incluyendo los visados para los firmantes)

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

            // 1. Primero renderizamos el HTML de las filas
            renderizarTabla(allData);

            // 2. Si ya existe un DataTable, lo destruimos para recrearlo con nuevos datos
            if ($.fn.DataTable.isDataTable('#tablaPrincipal')) {
                $('#tablaPrincipal').DataTable().destroy();
            }

            // Dentro de cargarBandeja, cuando inicializas el DataTable:
            $('#tablaPrincipal').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                },
                "pageLength": 5,          // Solo 5 registros por página
                "lengthChange": false,    // Oculta el selector de cantidad
                "searching": false,        // Desactivamos búsqueda interna de DT si usas filtros propios
                "order": [[4, 'asc']],    // Fecha Límite ascendente (más próximos primero)
                "dom": 'rt<"p-4 border-t flex justify-between items-center"ip>', // 'p' para paginación, 'i' para info
                "columnDefs": [
                    { "orderable": false, "targets": [1, 7] }
                ],
                "pagingType": "simple_numbers", // Botones elegantes
                "drawCallback": function () {
                    // Re-sustituir los iconos de feather si es necesario
                    if (window.feather) feather.replace();
                }
            });

            // 4. Ocultamos tu paginación vieja ya que DT usará la suya
            const oldPagination = document.getElementById('pagination_container');
            if (oldPagination) oldPagination.style.display = 'none';

        } else {
            tablaContainer.innerHTML = `<tr><td colspan="8" class="px-6 py-10 text-center text-rose-500 italic">Error: ${result.message}</td></tr>`;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

//function renderTablaPaginada() {
// const start = (currentPage - 1) * pageSize;
//const end = start + pageSize;
//const paginatedData = allData.slice(start, end);

//renderizarTabla(paginatedData);
// renderPagination();
//}

//function renderPagination() {
//const totalPages = Math.ceil(allData.length / pageSize);
//const paginationContainer = document.getElementById('pagination_container');
//if (!paginationContainer) return;

//paginationContainer.innerHTML = '';
//if (allData.length === 0) return;

// Info text at left
//const infoText = document.createElement('div');
//infoText.className = 'pagination-info text-xs font-semibold text-slate-400';
//infoText.innerText = `Página ${currentPage} de ${totalPages || 1}`;
//paginationContainer.appendChild(infoText);

//const nav = document.createElement('div');
//nav.className = 'flex gap-2';

// Anterior
//const btnAnt = document.createElement('button');
//btnAnt.className = 'flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all';
//btnAnt.disabled = currentPage === 1;
//btnAnt.innerHTML = '<span class="material-symbols-outlined text-sm">chevron_left</span> Anterior';
//btnAnt.onclick = (e) => {
//   e.preventDefault();
//   changePage(currentPage - 1);
//};

// Siguiente
//const btnSig = document.createElement('button');
//btnSig.className = 'flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all';
//btnSig.disabled = currentPage === totalPages || totalPages === 0;
//btnSig.innerHTML = 'Siguiente <span class="material-symbols-outlined text-sm">chevron_right</span>';
//btnSig.onclick = (e) => {
//    e.preventDefault();
//   changePage(currentPage + 1);
//};

//nav.appendChild(btnAnt);
//nav.appendChild(btnSig);
//paginationContainer.appendChild(nav);
//}

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
        // Dejamos el contenido vacío. DataTables mostrará su mensaje inteligente de "Sin registros" automáticamente
        return;
    }

    data.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50/80 transition-all cursor-pointer group';
        tr.onclick = () => {
            window.location.href = `ver.php?id=${item.tis_id}`;
        };

        const rgtCode = item.rgt_id_publica || '-';
        const statusColors = getStatusColors(item.tis_estado);

        tr.innerHTML = `
            <td class="px-6 py-4">
                <span class="font-black text-slate-400 tracking-tight">#${item.tis_id_raw || item.tis_id}</span>
            </td>
            <td class="px-6 py-4">
                <button type="button" class="text-primary-blue hover:text-blue-800 transition-colors" title="Consultar">
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
                <span class="text-sm font-medium text-slate-500">${(item.tis_creacion || '').substring(0, 10)}</span>
            </td>
            <td class="px-6 py-4 text-center">
                ${getDeadlineBadge(item.tis_fecha_limite)}
            </td>
            <td class="px-6 py-4 text-center">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusColors}">
                    ${item.tis_estado || '-'}
                </span>
            </td>
            <td class="px-6 py-4">
                ${getRolBadge(item.rol_usuario)}
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end gap-2 group/code">
                    <button type="button" class="text-slate-300 hover:text-slate-600 btn-show-code transition-colors">
                        <span class="material-symbols-outlined text-[16px]">qr_code_2</span>
                    </button>
                </div>
            </td>
            `;

        const btnShow = tr.querySelector('.btn-show-code');
        btnShow.addEventListener('click', (e) => {
            e.stopPropagation();
            Swal.fire({
                title: 'Código Público (RGT)',
                html: `<div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                        <code class="text-4xl font-black text-slate-800 tracking-widest">${rgtCode}</code>
                       </div>`,
                confirmButtonText: 'Cerrar',
                confirmButtonColor: '#1a5f9c',
                customClass: {
                    confirmButton: 'rounded-xl font-bold px-8 py-3 uppercase text-xs tracking-widest'
                }
            });
        });

        tabla.appendChild(tr);
    });
}

function getStatusColors(estado) {
    if (!estado) return 'bg-blue-50 text-blue-600 border-blue-100';
    estado = estado.toLowerCase();

    if (estado.includes('favorable')) return 'bg-emerald-50 text-emerald-600 border-emerald-100';
    if (estado.includes('rechazado') || estado.includes('no_favorable')) return 'bg-rose-50 text-rose-600 border-rose-100';
    if (estado.includes('pendiente') || estado.includes('ingresado')) return 'bg-amber-50 text-amber-600 border-amber-100';

    return 'bg-blue-50 text-blue-600 border-blue-100';
}

function getRolBadge(rol) {
    let classes = 'bg-slate-50 text-slate-400 border-slate-100';
    if (!rol) rol = 'Lector';

    switch (rol) {
        case 'Propietario':
            classes = 'bg-blue-50 text-blue-600 border-blue-100';
            break;
        case 'Responsable':
            classes = 'bg-blue-50 text-blue-600 border-blue-100';
            break;
        case 'Firmante':
            classes = 'bg-amber-50 text-amber-600 border-amber-100';
            break;
        case 'Visador':
            classes = 'bg-indigo-50 text-indigo-600 border-indigo-100';
            break;
    }

    return `<span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border ${classes}">${rol}</span>`;
}

function getDeadlineBadge(fecha) {
    if (!fecha) return '<span class="text-slate-300 text-xs">-</span>';

    const d = new Date(fecha);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const diff = d.getTime() - today.getTime();
    const diffDays = Math.ceil(diff / (1000 * 3600 * 24));

    let colorClass = 'text-slate-500';
    if (diffDays < 0) colorClass = 'text-rose-500 font-bold';
    else if (diffDays <= 3) colorClass = 'text-amber-500 font-bold';

    return `<span class="text-sm ${colorClass}">${fecha.substring(0, 10)}</span>`;
}
