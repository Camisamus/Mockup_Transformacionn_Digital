let allData = [];
let dataTable = null;

document.addEventListener('DOMContentLoaded', async function () {
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';
    }

    await cargarDatos();

    document.getElementById('btn_exportar_excel').addEventListener('click', exportarExcel);
    document.getElementById('btn_exportar_pdf').addEventListener('click', exportarPDF);
});

async function cargarDatos(filters = {}) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'CONSULTAMALL',
                ...filters
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            allData = result.data;
            renderzarTabla(allData);
        }
    } catch (error) {
        console.error('Error loading data:', error);
    }
}

function renderzarTabla(data) {
    const table = $('#tablaResultados');
    const tbody = $('#tbody_ingresos');

    if ($.fn.DataTable.isDataTable('#tablaResultados')) {
        dataTable.destroy();
    }

    tbody.empty();

    data.forEach(item => {
        const statusColors = getStatusColors(item.tis_estado);
        const detailsData = JSON.stringify({
            id: item.tis_id,
            titulo: item.tis_titulo,
            contenido: item.tis_contenido,
            fecha: item.tis_creacion,
            vencimiento: item.tis_fecha_limite,
            tipo: item.tis_tipo,
            responsable: `${item.resp_nombre || ''} ${item.resp_apellido || ''}`,
            rgt: item.rgt_id_publica || '-',
            estado: item.tis_estado
        }).replace(/'/g, "&apos;");

        const tr = `
            <tr data-details='${detailsData}' class="hover:bg-slate-50 transition-all">
                <td class="px-6 py-4 text-center font-bold text-slate-700">${item.tis_id_raw || item.tis_id}</td>
                <td class="px-6 py-4 text-center">${getRolBadge(item.rol_usuario)}</td>
                <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800">${item.tis_titulo || 'Sin título'}</span>
                        <span class="text-slate-400 text-[10px] truncate max-w-[250px]">${item.tis_contenido || ''}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">${(item.tis_creacion || '').substring(0, 10)}</td>
                <td class="px-6 py-4 text-center">${getDeadlineBadge(item.tis_fecha_limite)}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusColors}">
                        ${item.tis_estado || '-'}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button class="p-1 hover:bg-slate-100 rounded-full transition-colors text-primary-blue" onclick="verRegistro('${item.tis_id}')">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                        <button class="btn-toggle-details p-1 hover:bg-slate-100 rounded-full transition-colors text-slate-400">
                            <span class="material-symbols-outlined">add_circle</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(tr);
    });

    dataTable = table.DataTable({
        responsive: true,
        order: [[0, 'desc']],
        pageLength: 10,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        columnDefs: [
            { orderable: false, targets: [6] }
        ],
        drawCallback: function () {
            if (window.feather) window.feather.replace();
        }
    });

    // Toggle details
    $('#tablaResultados tbody').on('click', '.btn-toggle-details', function (e) {
        e.stopPropagation();
        const tr = $(this).closest('tr');
        const row = dataTable.row(tr);
        const icon = $(this).find('.material-symbols-outlined');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            icon.text('add_circle').removeClass('text-primary-blue');
        } else {
            const data = JSON.parse(tr.attr('data-details'));
            row.child(formatDetails(data)).show();
            tr.addClass('shown');
            icon.text('cancel').addClass('text-primary-blue');
        }
    });
}

function formatDetails(d) {
    return `
        <div class="p-4 bg-slate-50/50 rounded-xl border border-slate-100 m-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Contenido Completo</p>
                    <p class="text-sm text-slate-700">${d.contenido || 'Sin contenido'}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tipo</p>
                        <p class="text-sm text-slate-700 font-medium">${d.tipo}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Responsable</p>
                        <p class="text-sm text-slate-700 font-medium">${d.responsable}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Código RGT</p>
                        <p class="text-sm text-slate-700 font-medium">${d.rgt}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Estado</p>
                        <p class="text-sm text-slate-700 font-medium">${d.estado}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getStatusColors(estado) {
    if (!estado) return 'bg-blue-50 text-blue-600 border-blue-100';
    estado = estado.toLowerCase();
    if (estado.includes('favorable') && !estado.includes('no_favorable')) return 'bg-emerald-50 text-emerald-600 border-emerald-100';
    if (estado.includes('rechazado') || estado.includes('no_favorable')) return 'bg-rose-50 text-rose-600 border-rose-100';
    return 'bg-blue-50 text-blue-600 border-blue-100';
}

function getRolBadge(rol) {
    let classes = 'bg-slate-100 text-slate-500 border-slate-200';
    if (!rol) rol = 'Lector';
    switch (rol) {
        case 'Propietario': classes = 'bg-blue-50 text-blue-600 border-blue-100'; break;
        case 'Responsable': classes = 'bg-indigo-50 text-indigo-600 border-indigo-100'; break;
        case 'Firmante': classes = 'bg-amber-50 text-amber-600 border-amber-100'; break;
        case 'Visador': classes = 'bg-purple-50 text-purple-600 border-purple-100'; break;
    }
    return `<span class="px-2 py-1 rounded-md text-[10px] font-bold border ${classes}">${rol}</span>`;
}

function getDeadlineBadge(fecha) {
    if (!fecha) return '<span class="text-slate-300">-</span>';
    const d = new Date(fecha);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const diff = d.getTime() - today.getTime();
    const diffDays = Math.ceil(diff / (1000 * 3600 * 24));
    let colorClass = 'text-slate-500';
    if (diffDays < 0) colorClass = 'text-rose-500 font-bold';
    else if (diffDays <= 3) colorClass = 'text-amber-500 font-bold';
    return `<span class="text-xs ${colorClass}">${fecha.substring(0, 10)}</span>`;
}

window.buscarIngresos = function () {
    const filters = {
        tis_id: document.getElementById('filtro_id').value,
        fecha_inicio: document.getElementById('filtro_fecha_inicio').value,
        fecha_fin: document.getElementById('filtro_fecha_fin').value,
        tis_estado: document.getElementById('filtro_estado').value
    };
    cargarDatos(filters);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    cargarDatos();
}

function verRegistro(id) {
    window.location.href = `ver.php?id=${id}`;
}

async function exportarExcel() {
    exportToExcel('tablaResultados', 'Consulta_Ingresos');
}

async function exportarPDF() {
    exportElementToPDF('tablaResultados', 'Consulta_Ingresos');
}
