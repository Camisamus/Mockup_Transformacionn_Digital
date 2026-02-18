const OirsTable = {
    view: 'bandeja', // Default view
    containerId: '#tabla-resultados-oirs',

    init: function (viewName, containerId = '#tabla-resultados-oirs') {
        this.view = viewName;
        this.containerId = containerId;
        this.loadData();
    },

    loadData: function () {
        // Show loading state
        const $container = $(this.containerId);
        $container.html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="sr-only">Cargando...</span></div></div>');

        fetch(`../../api/oirs_search.php?view=${this.view}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.renderTable(data.data);
                } else {
                    $container.html(`<div class="alert alert-danger">Error al cargar datos: ${data.message}</div>`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                $container.html('<div class="alert alert-danger">Error de conexión al cargar datos.</div>');
            });
    },

    renderTable: function (rows) {
        const $container = $(this.containerId);

        if (rows.length === 0) {
            $container.html(`
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.5;">inbox</span>
                        <h5 class="mt-3 text-muted">No se encontraron solicitudes</h5>
                        <p class="text-muted small">No hay registros que coincidan con los filtros actuales.</p>
                    </div>
                </div>
            `);
            return;
        }

        let html = `
            <div class="card search-card border-0 mb-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                    <h3 class="h6 font-weight-bold text-dark mb-0">Resultados encontrados <span class="badge badge-light border ml-2">${rows.length} Solicitudes</span></h3>
                    <div class="d-flex align-items-center" style="gap: 15px;">
                        <span class="small text-muted">Ordenar por: <span class="text-dark font-weight-bold">Más recientes</span></span>
                        <span class="material-symbols-outlined text-muted icon-md">sort</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light text-muted table-header">
                                <tr>
                                    <th class="px-4 py-3 border-0">FOLIO / FECHA</th>
                                    <th class="px-4 py-3 border-0">CONTRIBUYENTE</th>
                                    <th class="px-4 py-3 border-0">TEMÁTICA</th>
                                    <th class="px-4 py-3 border-0">ESTADO</th>
                                    <th class="px-4 py-3 border-0 text-right">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
        `;

        rows.forEach(row => {
            const estado = this.getEstadoLabel(row.oirs_estado);
            const fecha = new Date(row.oirs_fecha_ingreso).toLocaleDateString('es-CL', { day: '2-digit', month: 'short', year: 'numeric' });
            // Initials for avatar
            const initials = row.nombre_contribuyente ? row.nombre_contribuyente.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase() : 'NN';

            html += `
                <tr class="oirs-row" onclick="window.location.href='oirs_consulta.php?id=${row.oirs_id}'" style="cursor: pointer;">
                    <td class="px-4 py-4 align-middle">
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark mb-1">#${row.oirs_folio || 'S/F'}</span>
                            <span class="text-muted small">${fecha}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 align-middle">
                        <div class="d-flex align-items-center">
                            <div class="text-primary rounded-circle d-flex align-items-center justify-content-center mr-3 user-avatar user-avatar-primary" style="width: 32px; height: 32px; background-color: #e3f2fd; font-weight: bold; font-size: 12px;">
                                ${initials}
                            </div>
                            <div class="d-flex flex-column">
                                <span class="font-weight-bold">${row.nombre_contribuyente || 'Anónimo'}</span>
                                <span class="text-muted text-xxs" style="font-size: 10px;">${row.rut_contribuyente || ''}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 align-middle">
                        <div class="d-flex flex-column">
                            <span class="text-dark mb-1">${row.oirs_tematica || 'General'}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 align-middle">
                        ${estado}
                    </td>
                    <td class="px-4 py-4 align-middle text-right">
                        <button class="btn btn-link action-btn text-muted p-0" title="Ver Detalles">
                            <span class="material-symbols-outlined icon-md">visibility</span>
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination (Static for now) -->
                <div class="card-footer bg-white border-top p-4">
                    <nav class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted font-weight-bold">Mostrando ${rows.length} registros</span>
                    </nav>
                </div>
            </div>
        `;

        $container.html(html);
    },

    getEstadoLabel: function (estado) {
        const badges = {
            '0': '<span class="badge badge-info status-badge">Creada</span>',
            '1': '<span class="badge badge-warning status-badge">Visada</span>',
            '2': '<span class="badge badge-warning status-badge">Resp. Ejecutar</span>',
            '3': '<span class="badge badge-primary status-badge">Respondida</span>',
            '4': '<span class="badge badge-success status-badge">Ejecutada</span>',
            '5': '<span class="badge badge-success status-badge">Notificada</span>'
        };
        return badges[estado] || '<span class="badge badge-secondary status-badge">Desconocido</span>';
    }
};
