const OirsTable = {
    view: 'bandeja',
    containerId: '#tabla-resultados-oirs',
    dataTableInstance: null,

    init: function (viewName, containerId = '#tabla-resultados-oirs') {
        this.view = viewName;
        this.containerId = containerId;
        this.loadData();
    },

    loadData: function () {
        const $container = $(this.containerId);
        $container.html('<div class="flex justify-center p-10"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-blue"></div></div>');

        fetch(`../../api/oirs/search.php?view=por_revisar`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.renderTable(data.data);
                } else {
                    $container.html(`<div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 italic">Error al cargar datos: ${data.message}</div>`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                $container.html('<div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 italic">Error de conexión al cargar datos.</div>');
            });
    },

    renderTable: function (data) {
        const $container = $(this.containerId);

        if (this.dataTableInstance) {
            this.dataTableInstance.destroy();
        }

        let html = `
            <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">list_alt</span> Resultados encontrados
                        <span id="solicitudes-count" class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200">${data.length} SOLICITUDES</span>
                    </h3>
                </div>

                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left" id="table-oirs-render">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                                <th class="px-6 py-4">Folio / Fecha</th>
                                <th class="px-6 py-4">Contribuyente</th>
                                <th class="px-6 py-4">Temática</th>
                                <th class="px-6 py-4 text-center">Estado</th>
                                <th class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-[15px] text-slate-600">
        `;

        data.forEach(item => {
            const statusClass = this.getStatusClass(item.oirs_estado);
            const statusLabel = this.getStatusLabel(item.oirs_estado);
            const initials = item.nombre_contribuyente ?
                item.nombre_contribuyente.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase() : 'NN';

            html += `
                <tr class="hover:bg-slate-50/80 transition-all cursor-pointer oirs-row" data-id="${item.oirs_id}">

                    <td class="px-6 py-4 text-center font-bold text-slate-700">#${item.oirs_id}<br>${this.formatDate(item.oirs_fecha_ingreso)}</td>

                    <td class="px-6 py-4">
                        ${item.nombre_contribuyente || 'Anónimo'} <br>
                        <span class="text-slate-400 text-[10px] font-medium tracking-wide">${item.rut_contribuyente || ''}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-medium text-slate-700">${item.oirs_tematica_nombre}</span>
                            <span class="text-slate-400 text-[10px] font-medium tracking-wide">${item.oirs_subtematica_nombre}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="status-badge ${statusClass}">${statusLabel}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-1">
                            <button class="action-btn text-slate-400 hover:text-primary-blue btn-ver" title="Ver Detalles" data-id="${item.oirs_id}">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });

        html += `
                        </tbody>
                    </table>
                </div>
            </div>
        `;

        $container.html(html);

        // Inicializar DataTables
        this.dataTableInstance = $('#table-oirs-render').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            order: [[0, 'desc']],
            dom: 'rtip',
            drawCallback: () => {
                this.applyTailwindStyles();
            }
        });

        // Eventos
        this.initEvents();
    },

    initEvents: function () {
        // Redirección por fila
        $(document).off('click', '.oirs-row').on('click', '.oirs-row', function () {
            const id = $(this).data('id');
            window.location.href = `ver.php?id=${id}`;
        });

        // Botón de acción (evitar propagación)
        $(document).off('click', '.action-btn').on('click', '.action-btn', function (e) {
            e.stopPropagation();
            const id = $(this).data('id');
            window.location.href = `ver.php?id=${id}`;
        });
    },

    getStatusClass: function (status) {
        switch (parseInt(status)) {
            case 0: return 'badge-ingresada';
            case 1: case 2: case 3: return 'badge-proceso';
            case 4: case 5: return 'badge-resuelta';
            default: return 'badge-vencida';
        }
    },

    getStatusLabel: function (status) {
        const labels = {
            0: 'Recibida',
            1: 'Visada',
            2: 'Resp. Ejecutar',
            3: 'Respondida',
            4: 'Ejecutada',
            5: 'Notificada'
        };
        return labels[status] || 'Desconocido';
    },

    formatDate: function (dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('es-CL', { day: '2-digit', month: '2-digit', year: 'numeric' });
    },

    applyTailwindStyles: function () {
        $('.dataTables_info').addClass('text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-4');
        $('.dataTables_paginate').addClass('flex items-center gap-1 mt-4');
        $('.paginate_button').addClass('px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all cursor-pointer');
        $('.paginate_button.current').addClass('bg-primary-blue !text-white border-primary-blue');
        $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
    }
};

