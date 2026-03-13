$(document).ready(function () {
    const tableOirs = $('#table-oirs-consulta');
    const tbodyOirs = $('#tbody-oirs-consulta');
    let dataTableInstance = null;

    // 1. Cargar Datos Iniciales (Filtros)
    loadFiltros();

    // 2. Cargar Datos de la Tabla
    loadTableData();

    // Toggle filtros avanzados
    $('#btnAdvanced').click(function () {
        $('#advancedPanel').toggleClass('show');
        const isActive = $('#advancedPanel').hasClass('show');
        $(this).toggleClass('bg-primary-blue text-white border-primary-blue');
        $(this).html(isActive ?
            '<span class="material-symbols-outlined text-lg">expand_less</span> MENOS FILTROS' :
            '<span class="material-symbols-outlined text-lg">tune</span> MÁS FILTROS');
    });

    // Acción botones (Previsualización)
    $(document).on('click', '.action-btn', function (e) {
        e.stopPropagation();
        const id = $(this).data('id');
        // Aquí podrías abrir un modal, por ahora redirigimos o avisamos
        Swal.fire({
            title: 'Detalles de la Solicitud',
            text: 'Redirigiendo a la vista detallada...',
            icon: 'info',
            timer: 1000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = `ver.php?id=${id}`;
        });
    });

    // 3. Exportar Excel
    $('#btn_exportar_excel').click(async function () {
        try {
            const filters = {
                ACCION: 'REPORTE',
                fecha: $('#filter-fecha').val(),
                estado: $('#filter-estado').val(),
                sector: $('#filter-sector').val(),
                tematica: $('#filter-tematica').val(),
                subtematica: $('#filter-subtematica').val(),
                prioridad: $('#filter-prioridad').val(),
                search: $('#filter-search').val()
            };

            const response = await fetch(`../../api/reportes/excel_oirs.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(filters)
            });

            if (!response.ok) throw new Error('Error de red al exportar');

            const hexStr = await response.text();

            // Decodificar cadena hexadecimal validando cada par (2 caracteres)
            const byteRegex = /.{1,2}/g;
            const matches = hexStr.match(byteRegex);
            if (!matches) {
                Swal.fire('Error', 'El formato de archivo recibido no es válido', 'error');
                return;
            }
            const bytes = new Uint8Array(matches.map(byte => parseInt(byte, 16)));
            const blob = new Blob([bytes], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            // Iniciar Descarga
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Resultados_Consulta_OIRS_' + new Date().getTime() + '.xlsx';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        } catch (error) {
            console.error("Error al exportar a Excel:", error);
            Swal.fire('Error', 'No se pudo generar el documento Excel.', 'error');
        }
    });

    async function loadFiltros() {
        try {
            // Cargar Sectores
            /*
            const resSectores = await $.ajax({
                url: '../../api/sisadmin/mantenedores/general/sectores.php',
                method: 'POST',
                data: JSON.stringify({ ACCION: 'CONSULTAM' }),
                contentType: 'application/json'
            });
            if (resSectores.status === 'success') {
                resSectores.data.forEach(sec => {
                    $('#filter-sector').append(`<option value="${sec.sec_id}">${sec.sec_nombre}</option>`);
                });
            }*/

            // Cargar Temáticas
            const resTematicas = await $.ajax({
                url: '../../api/oirs/tematicas.php',
                method: 'POST',
                data: JSON.stringify({ ACCION: 'CONSULTAM' }),
                contentType: 'application/json'
            });
            if (resTematicas.status === 'success') {
                resTematicas.data.forEach(tem => {
                    $('#filter-tematica').append(`<option value="${tem.tem_id}">${tem.tem_nombre}</option>`);
                });
            }
        } catch (error) {
            console.error("Error al cargar filtros:", error);
        }
    }

    // Cargar Subtemáticas al cambiar Temática
    $('#filter-tematica').change(async function () {
        const temId = $(this).val();
        const subSelect = $('#filter-subtematica');
        subSelect.html('<option value="">Todas las subtemáticas</option>');

        if (!temId) return;

        try {
            const res = await $.ajax({
                url: '../../api/oirs/subtematicas.php',
                method: 'POST',
                data: JSON.stringify({ ACCION: 'CONSULTA_TEMATICA', tem_id: temId }),
                contentType: 'application/json'
            });
            if (res.status === 'success') {
                res.data.forEach(sub => {
                    subSelect.append(`<option value="${sub.sub_id}">${sub.sub_nombre}</option>`);
                });
            }
            // Auto aplicar filtros al cambiar temática (para cargar todo de esa temática)
            applyAdvancedFilters();
        } catch (error) {
            console.error("Error al cargar subtemáticas:", error);
        }
    });

    // Auto aplicar filtros al cambiar subtemática
    $('#filter-subtematica').change(function () {
        applyAdvancedFilters();
    });

    async function loadTableData() {
        try {
            const response = await $.ajax({
                url: '../../api/oirs/solicitudes.php',
                method: 'POST',
                data: JSON.stringify({ ACCION: 'CONSULTAM' }),
                contentType: 'application/json'
            });

            if (response.status === 'success') {
                renderTable(response.data);
            } else {
                Swal.fire('Error', 'No se pudieron cargar las solicitudes', 'error');
            }
        } catch (error) {
            console.error("Error AJAX:", error);
        }
    }

    function renderTable(data) {
        if (dataTableInstance) {
            dataTableInstance.destroy();
        }
        tbodyOirs.empty();

        data.forEach(item => {
            const statusClass = getStatusClass(item.oirs_estado);
            const statusLabel = getStatusLabel(item.oirs_estado);
            let name = item.tgc_nombre ? (item.tgc_nombre + ' ' + (item.tgc_apellido_paterno || '')) : 'Anónimo';
            let rut = item.tgc_rut || 'Sin RUT';
            const iniciales = name !== 'Anónimo' ? name.substring(0, 1) + (item.tgc_apellido_paterno ? item.tgc_apellido_paterno.substring(0, 1) : '') : 'NN';

            const materia = item.tem_nombre || 'Sin temática';
            const rol = item.ofa_rol ? item.ofa_rol : '<span class="text-slate-400 italic">Sin Asignar</span>';

            const fechaRec = formatDate(item.oirs_creacion);
            const fechaVenc = formatDate(item.oirs_fecha_limite);

            const paramPrioridad = item.oirs_prioridad_municipal || 1;
            let prioridadBadge = '';
            if (paramPrioridad == 3) prioridadBadge = '<span class="status-badge bg-red-100 text-red-600 border border-red-200" title="Urgente"><span class="material-symbols-outlined text-[10px] mr-1">keyboard_double_arrow_up</span>Urgente</span>';
            else if (paramPrioridad == 2) prioridadBadge = '<span class="status-badge bg-orange-100 text-orange-600 border border-orange-200" title="Alta"><span class="material-symbols-outlined text-[10px] mr-1">keyboard_arrow_up</span>Alta</span>';
            else prioridadBadge = '<span class="status-badge bg-slate-100 text-slate-600 border border-slate-200" title="Normal">Normal</span>';

            const row = `
                <tr class="hover:bg-slate-50/80 transition-all cursor-pointer oirs-row" data-id="${item.oirs_id}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-black text-slate-800 tracking-tight">#${item.oirs_id}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${item.ofa_rol ? `<span class="text-[10px] font-bold text-slate-700 bg-blue-50 px-2 py-1 rounded border border-blue-100 uppercase">${rol}</span>` : rol}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-[10px] border border-slate-200 shrink-0">${iniciales.toUpperCase()}</div>
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-700 leading-tight block w-[200px] truncate" title="${materia}">${materia}</span>
                                <span class="text-slate-400 text-[10px] font-medium mt-0.5">${name} &bull; ${rut}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-slate-600 text-[11px] font-medium flex items-center gap-1"><i class="material-symbols-outlined text-[14px] text-slate-400">calendar_today</i>${fechaRec}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-slate-600 text-[11px] font-medium flex items-center gap-1"><i class="material-symbols-outlined text-[14px] text-slate-400">event_busy</i>${fechaVenc}</span>
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        ${prioridadBadge}
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <span class="status-badge ${statusClass}">${statusLabel}</span>
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <button class="action-btn text-slate-400 hover:text-primary-blue transition-colors p-2 rounded-lg hover:bg-blue-50" title="Ver Detalles" data-id="${item.oirs_id}">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </td>
                </tr>
            `;
            tbodyOirs.append(row);
        });

        $('#solicitudes-count').text(`${data.length} SOLICITUDES`);

        // Inicializar DataTables
        dataTableInstance = tableOirs.DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            order: [[0, 'desc']],
            dom: 'rtip', // Ocultamos el buscador nativo porque usaremos los filtros personalizados
            drawCallback: function () {
                applyTailwindStyles();
            }
        });
    }

    // Filtros Personalizados
    $('#filter-search').on('keyup', function () {
        if (dataTableInstance) dataTableInstance.search(this.value).draw();
    });

    $('#filter-sector, #filter-estado, #filter-prioridad, #filter-fecha').change(function () {
        applyAdvancedFilters();
    });

    $('#btnAplicarFiltros').click(function () {
        applyAdvancedFilters();
    });

    async function applyAdvancedFilters() {
        const filters = {
            ACCION: 'BUSCAR',
            fecha: $('#filter-fecha').val(),
            estado: $('#filter-estado').val(),
            sector: $('#filter-sector').val(),
            tematica: $('#filter-tematica').val(),
            subtematica: $('#filter-subtematica').val(),
            prioridad: $('#filter-prioridad').val(),
            search: $('#filter-search').val()
        };

        try {
            const response = await $.ajax({
                url: '../../api/oirs/solicitudes.php',
                method: 'POST',
                data: JSON.stringify(filters),
                contentType: 'application/json'
            });

            if (response.status === 'success') {
                renderTable(response.data);
            }
        } catch (error) {
            console.error("Error al filtrar:", error);
        }
    }

    $('#btnReset').click(function () {
        $('input, select').val('');
        $('#filter-subtematica').html('<option value="">Todas las subtemáticas</option>');
        loadTableData();
    });

    // Eventos Click
    $(document).on('click', '.oirs-row', function () {
        const id = $(this).data('id');
        window.location.href = `ver.php?id=${id}`;
    });

    $(document).on('click', '.action-btn', function (e) {
        e.stopPropagation();
        const id = $(this).data('id');
        if ($(this).hasClass('btn-ver')) {
            window.location.href = `ver.php?id=${id}`;
        } else {
            // Lógica para responder
            window.location.href = `ver.php?id=${id}#responder`;
        }
    });

    function getStatusClass(status) {
        switch (parseInt(status)) {
            case 0: return 'badge-ingresada';
            case 1: case 2: case 3: return 'badge-proceso';
            case 4: case 5: return 'badge-resuelta';
            default: return 'badge-vencida';
        }
    }

    function getStatusLabel(status) {
        const labels = {
            0: 'Pendiente',
            1: 'Respondida',
            2: 'Derivada a Unidad Técnica',
            3: 'Respondida por U. Técnica',
            4: 'Planificada',
            5: 'Ejecutada',
            6: 'No Ejecutada',
            7: 'Con Observación',
            8: 'Cerrada'
        };
        return labels[status] || 'Desconocido';
    }

    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('es-CL', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    }

    function applyTailwindStyles() {
        $('.dataTables_info').addClass('text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-4');
        $('.dataTables_paginate').addClass('flex items-center gap-1 mt-4');
        $('.paginate_button').addClass('px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all cursor-pointer');
        $('.paginate_button.current').addClass('bg-primary-blue !text-white border-primary-blue');
        $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
    }
});
