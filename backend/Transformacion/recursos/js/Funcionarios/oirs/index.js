/**
 * OIRS Bandeja Component Logic
 */
$(document).ready(function () {
    // Cargar solicitudes urgentes al iniciar
    loadUrgentSolicitudes();
    cargarMetricas();
    cargarGraficos();

    function loadUrgentSolicitudes() {
        const payload = {
            ACCION: 'CONSULTAM'
        };

        fetch('../../api/oirs/solicitudes.php', {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success' && Array.isArray(res.data)) {
                    renderUrgentTable(res.data);
                } else {
                    console.error("Error al cargar solicitudes:", res.message);
                    $('#tbody_desve').html('<tr><td colspan="5" class="px-6 py-4 text-center text-slate-400">No se pudieron cargar las solicitudes</td></tr>');
                }
            })
            .catch(error => {
                console.error("Error de conexión:", error);
                $('#tbody_desve').html('<tr><td colspan="5" class="px-6 py-4 text-center text-slate-400">Error de conexión con el servidor</td></tr>');
            });
    }

    function renderUrgentTable(data) {
        const tbody = $('#tbody_desve');
        tbody.empty();

        // Filtrar y ordenar: prioridad Urgente (supongamos 1 es urgente) o según fecha_limite
        // Tomamos el top 5
        const urgentItems = data
            .sort((a, b) => new Date(a.oirs_fecha_limite) - new Date(b.oirs_fecha_limite))
            .slice(0, 5);

        if (urgentItems.length === 0) {
            tbody.html('<tr><td colspan="5" class="px-6 py-4 text-center text-slate-400">No hay solicitudes urgentes pendientes</td></tr>');
            return;
        }

        urgentItems.forEach(item => {
            const daysLeft = calculateDaysLeft(item.oirs_fecha_limite);
            const priorityLabel = getPriorityLabel(item.oirs_prioridad_municipal);
            const priorityClass = getPriorityClass(item.oirs_prioridad_municipal);

            const row = `
                <tr class="hover:bg-slate-50/80 transition-all cursor-pointer oirs-row" onclick="window.location.href='ver.php?id=${item.oirs_id}'">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-black text-slate-800 tracking-tight">#${item.rgt_id_publica || item.oirs_id}</span>
                            <span class="text-slate-400 text-xs mt-0.5 italic">${formatDate(item.oirs_fecha_ingreso || item.created_at)}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-700 text-sm truncate max-w-[200px]">${item.oirs_descripcion}</span>
                            <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">${item.tem_nombre || 'Sin temática'}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold ${daysLeft <= 2 ? 'text-rose-500' : 'text-slate-600'}">${daysLeft} días</span>
                            ${daysLeft <= 1 ? '<span class="flex h-2 w-2 rounded-full bg-rose-500 animate-pulse"></span>' : ''}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider ${priorityClass}">
                            ${priorityLabel}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-primary-blue hover:text-blue-800 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    function calculateDaysLeft(deadline) {
        if (!deadline) return 0;
        const diff = new Date(deadline) - new Date();
        return Math.max(0, Math.ceil(diff / (1000 * 60 * 60 * 24)));
    }

    function getPriorityLabel(priority) {
        switch (parseInt(priority)) {
            case 1: return 'Urgente';
            case 2: return 'Alta';
            case 3: return 'Media';
            default: return 'Baja';
        }
    }

    function getPriorityClass(priority) {
        switch (parseInt(priority)) {
            case 1: return 'bg-rose-50 text-rose-600 border border-rose-100';
            case 2: return 'bg-amber-50 text-amber-600 border border-amber-100';
            case 3: return 'bg-blue-50 text-blue-600 border border-blue-100';
            default: return 'bg-slate-50 text-slate-600 border border-slate-100';
        }
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        return date.toLocaleDateString('es-CL', { day: '2-digit', month: '2-digit', year: 'numeric' });
    }

    // Filter simulation
    $('input[placeholder="Buscar folio o RUT..."]').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $(".oirs-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    function cargarMetricas() {
        const payload = {
            ACCION: 'METRICAS'
        };

        fetch('../../api/oirs/solicitudes.php', {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success' && res.data) {
                    const d = res.data;
                    $('#oirs-total-count').text(d.total.toLocaleString());
                    $('#oirs-pending-count').text(d.pending.toLocaleString());
                    $('#oirs-avg-time').text(d.avgTime + 'd');
                    $('#oirs-resolved-month').text(d.resolvedMonth.toLocaleString());
                }
            })
            .catch(error => {
                console.error("Error cargando métricas:", error);
            });
    }

    function cargarGraficos() {
        const payload = {
            ACCION: 'GRAFICOS'
        };

        fetch('../../api/oirs/solicitudes.php', {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success' && res.data) {
                    renderChartEstado(res.data.estados);
                    renderChartTipo(res.data.tipos);
                }
            })
            .catch(error => {
                console.error("Error cargando gráficos:", error);
            });
    }

    function renderChartEstado(data) {
        const ctx = document.getElementById('chartEstado').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => d.label),
                datasets: [{
                    label: 'Solicitudes',
                    data: data.map(d => d.value),
                    backgroundColor: '#1e40af', // primary-blue
                    borderRadius: 6,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    function renderChartTipo(data) {
        const ctx = document.getElementById('chartTipo').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: data.map(d => d.label),
                datasets: [{
                    data: data.map(d => d.value),
                    backgroundColor: [
                        '#1e40af', '#3b82f6', '#93c5fd', '#bfdbfe', '#dbeafe'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            font: { size: 10, weight: 'bold' }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    }
});
