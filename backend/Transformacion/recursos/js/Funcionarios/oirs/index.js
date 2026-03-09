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
        const table = $('#table_oirs_urgentes');
        const tbody = $('#tbody_desve');

        // Destruir instance previa si existe
        if ($.fn.DataTable.isDataTable('#table_oirs_urgentes')) {
            table.DataTable().destroy();
        }

        tbody.empty();

        // Filtrar solo pendientes (estado < 4) y ordenar por fecha límite
        const urgentItems = data
            .filter(item => parseInt(item.oirs_estado) < 4)
            .sort((a, b) => new Date(a.oirs_fecha_limite) - new Date(b.oirs_fecha_limite));

        // Actualizar subtítulo en index.php si es necesario, o solo mostrar todos.
        // El usuario pidió "mostrar todas las oirs pendientes".

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
                            <span class="font-black text-slate-800 tracking-tight">#${item.o_id || item.oirs_id}</span>
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

        // Inicializar DataTable
        table.DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            order: [[2, 'asc']], // Ordenar por días restantes (columna 2)
            responsive: true,
            dom: '<"flex flex-col sm:flex-row justify-between gap-4 mb-4"f>rt<"flex flex-col sm:flex-row justify-between items-center gap-4 mt-4"ip>',
            drawCallback: function () {
                // Ajustar clases de los elementos generados por DataTables para que coincidan con Tailwind
                $('.dataTables_filter input').addClass('h-9 rounded-lg border-slate-200 text-sm px-3 focus:ring-primary-blue focus:border-primary-blue transition-all');
                $('.dataTables_length select').addClass('h-9 rounded-lg border-slate-200 text-sm px-2 focus:ring-primary-blue focus:border-primary-blue transition-all');
                $('.dataTables_info').addClass('text-xs font-semibold text-slate-500 uppercase tracking-widest');
                $('.dataTables_paginate').addClass('flex gap-1');
                $('.paginate_button').addClass('px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all cursor-pointer');
                $('.paginate_button.current').addClass('bg-primary-blue !text-white border-primary-blue');
                $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
            }
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
