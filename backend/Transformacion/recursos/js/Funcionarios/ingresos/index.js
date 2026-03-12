let allData = [];
let dataTable = null;

document.addEventListener('DOMContentLoaded', async () => {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';
    }

    await cargarMetricas();
    await cargarGraficos();
    await cargarBandeja();
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

async function cargarBandeja() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'CONSULTAM',
                tis_estado: 'Ingresado' // Traemos solo los pendientes para la vista rápida
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            allData = result.data;
            renderTabla(allData);
        }
    } catch (error) {
        console.error('Error loading bandeja:', error);
    }
}

function renderTabla(data) {
    const table = $('#tablaPrincipal');
    const tbody = $('#tabla_ingresos');

    if ($.fn.DataTable.isDataTable('#tablaPrincipal')) {
        dataTable.destroy();
    }

    tbody.empty();

    data.forEach(item => {
        const statusColors = getStatusColors(item.tis_estado);
        const tr = `
            <tr class="hover:bg-slate-50 transition-all">
                <td class="text-center font-bold text-slate-700">${item.tis_id_raw || item.tis_id}</td>
                <td class="text-center">
                    ${getRolBadge(item.rol_usuario)}
                </td>
                <td>
                    <div class="flex flex-col">
                        <span class="font-bold text-slate-800">${item.tis_titulo || 'Sin título'}</span>
                        <span class="text-slate-400 text-[10px] truncate max-w-[300px]">${item.tis_contenido || ''}</span>
                    </div>
                </td>
                <td class="text-center">${(item.tis_creacion || '').substring(0, 10)}</td>
                <td class="text-center">${getDeadlineBadge(item.tis_fecha_limite)}</td>
                <td class="text-center">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusColors}">
                        ${item.tis_estado || '-'}
                    </span>
                </td>
                <td class="text-center">
                    <button class="p-1 hover:bg-slate-100 rounded-full transition-colors text-primary-blue" onclick="verRegistro('${item.tis_id}')">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                    <button class="p-1 hover:bg-slate-100 rounded-full transition-colors text-slate-400" onclick="verRGT('${item.rgt_id_publica || '-'}')">
                        <span class="material-symbols-outlined">qr_code_2</span>
                    </button>
                </td>
            </tr>
        `;
        tbody.append(tr);
    });

    dataTable = table.DataTable({
        responsive: true,
        order: [[3, 'desc']],
        pageLength: 5,
        lengthChange: false,
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

function verRegistro(id) {
    window.location.href = `ver.php?id=${id}`;
}

function verRGT(code) {
    Swal.fire({
        title: 'Código Público (RGT)',
        html: `<div class="p-8 bg-slate-50 rounded-3xl border border-slate-100">
                <code class="text-4xl font-black text-slate-800 tracking-widest">${code}</code>
               </div>`,
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#1a5f9c'
    });
}
