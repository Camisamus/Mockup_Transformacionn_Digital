let allSolicitudes = [];
let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let dataTable = null;

document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';
    }

    await loadInitialData();
    renderTable(allSolicitudes);

    document.getElementById('btn_buscar').addEventListener('click', buscarAtenciones);
    document.getElementById('btn_limpiar').addEventListener('click', limpiarFiltros);

    // Export Listeners
    document.getElementById('btn_exportar_excel').addEventListener('click', async () => {
        try {
            // Recopilar filtros activos del frontend
            const filtros = { ACCION: 'REPORTE' };

            const elEstado = document.getElementById('filtro_estado');
            const elFechaDesde = document.getElementById('filtro_fecha_desde');
            const elFechaHasta = document.getElementById('filtro_fecha_hasta');
            const elReingresos = document.getElementById('filtro_ocultar_reingresos');
            const elFuncionario = document.getElementById('filtro_funcionario');

            if (elEstado && elEstado.value !== '') filtros.ESTADO = elEstado.value;
            if (elFechaDesde && elFechaDesde.value) filtros.FECHA_INICIO = elFechaDesde.value;
            if (elFechaHasta && elFechaHasta.value) filtros.FECHA_FIN = elFechaHasta.value;
            if (elReingresos && elReingresos.checked) filtros.REINGRESOS = 'NO';
            if (elFuncionario && elFuncionario.value) filtros.FUNCIONARIO_ID = elFuncionario.value;

            const response = await fetch(`${window.API_BASE_URL}/reportes/historial_desve.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(filtros),
                credentials: 'include'
            });

            if (!response.ok) throw new Error('Error en descarga');

            const hexStr = await response.text();
            // Convertir hex a blob
            const bytes = new Uint8Array(hexStr.match(/.{1,2}/g).map(byte => parseInt(byte, 16)));
            const blob = new Blob([bytes], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Historial_DESVE_' + Date.now() + '.xlsx';
            a.click();
            window.URL.revokeObjectURL(url);
        } catch (e) {
            console.error('Error exportando Excel:', e);
            Swal.fire('Error', 'No se pudo descargar el archivo.', 'error');
        }
    });
    document.getElementById('btn_exportar_pdf').addEventListener('click', () => {
        // Hide elements we don't want in PDF temporarily if needed, or just export body/container
        // For simplicity, exporting the results card
        const card = document.querySelector('.card.shadow-sm.border-0:last-child'); // The table card
        exportElementToPDF(card.id || 'tablaAtenciones', 'Listado_Ingresos_DESVE');
    });
});

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM", S: "TODOS" })
        };
        const [solRes, orgRes, tipoRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/sectores.php`, fetchOptions).then(r => r.json())
        ]);

        allSolicitudes = extractData(solRes);
        organizaciones = extractData(orgRes);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);

    } catch (error) {
        console.error('Error loading data:', error);
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

/* renderTable replacement */


/* renderTable replacement */
function renderTable(data) {
    const table = $('#tablaAtenciones');
    const tbody = $('#tbody_desve');

    // Destruir instancia previa si existe
    if ($.fn.DataTable.isDataTable('#tablaAtenciones')) {
        dataTable.destroy();
    }

    tbody.empty();

    const filteredData = aplicarFiltros(data);

    filteredData.forEach(item => {
        // Resolve Origen and TipoOrg using backend data
        const resolvedOrigen = item.sol_origen_nombre || item.sol_origen_texto || '-';
        const resolvedTipoOrg = item.sol_origen_tipo_nombre || 'N/A';

        const prio = prioridades.find(p => p.pri_id == item.sol_prioridad_id) || {};
        const func = funcionarios.find(f => f.fnc_id == item.sol_funcionario_id) || {};
        const sec = sectores.find(s => s.sec_id == item.sol_sector_id) || {};

        const mailsCount = item.sol_mails_count || 0;
        const lastMailDate = formatDate(item.sol_mail_enviado_fecha) || 'N/A';

        // Almacenamos los detalles en un atributo data para usarlos en la fila expandible
        const detailsData = JSON.stringify({
            rgt: item.sol_ingreso_desve || '-',
            expediente: item.sol_nombre_expediente || '-',
            organizacion: resolvedTipoOrg,
            origen: resolvedOrigen,
            funcionario: func.fnc_nombre || 'N/A',
            sector: sec.sec_nombre || 'N/A',
            mails: mailsCount,
            lastMail: lastMailDate,
            coordinador: (item.sol_entrego_coordinador == 1) ? 'Sí (' + (formatDate(item.sol_fecha_respuesta_coordinador) || '') + ')' : 'No',
            vencimientoDays: item.sol_dias_vencimiento || 0,
            transcurridosDays: item.sol_dias_transcurridos || 0,
            observaciones: item.sol_observaciones || '',
            reingresoId: item.sol_reingreso_id || '-'
        }).replace(/'/g, "&apos;");

        const tr = `
            <tr data-details='${detailsData}'>
                <td class="text-center font-bold text-slate-700">${item.sol_ingreso_desve || '-'}</td>
                <td>
                    ${item.mi_rol == 'Autor'
                ? '<span class="px-2 py-1 rounded-md bg-amber-50 text-green-600 text-[12px] font-bold">Autor</span>'
                : item.mi_rol == 'Responsable' ? '<span class="px-2 py-1 rounded-md bg-amber-50 text-amber-600 text-[12px] font-bold">Responsable</span>' : '<span class="px-2 py-1 rounded-md bg-amber-50 text-white-600 text-[12px] font-bold">Ninguno</span>'}
                </td>
                <td><b>${item.sol_nombre_expediente.toUpperCase() || '-'}</b><br>${resolvedOrigen.toUpperCase()}</td>
                <td class="text-center">${formatDate(item.sol_fecha_recepcion) || ''}</td>
                <td class="text-center">${formatDate(item.sol_fecha_vencimiento) || ''}</td>
                <td class="text-center">
                    <span class="px-2 py-1 rounded-md text-[10px] font-bold ${item.sol_prioridad_id == 3 ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600'}">
                        ${prio.pri_nombre || 'N/A'}
                    </span>
                </td>
                <td class="text-center">
                    ${(item.sol_estado_entrega == 1 || item.sol_estado_entrega === true)
                ? '<span class="px-2 py-1 rounded-md bg-emerald-50 text-emerald-600 text-[10px] font-bold">Entregado</span>'
                : '<span class="px-2 py-1 rounded-md bg-amber-50 text-amber-600 text-[10px] font-bold">Pendiente</span>'}
                </td>
                <td class="text-center">
                    <button class="btn btn-sm bg-slate-800 text-white hover:bg-slate-700" onclick="verMantenedor('${item.sol_id}')" title="Ver Registro">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                    </button>
                </td>
            </tr>
        `;
        tbody.append(tr);
    });

    // Inicializar DataTable
    dataTable = table.DataTable({
        responsive: true,
        order: [[1, 'desc']],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },
        columnDefs: [
            { orderable: false, targets: [7] }
        ],
        drawCallback: function () {
            if (window.feather) window.feather.replace();
        }
    });

    // Manejo de filas expandibles
    $('#tablaAtenciones tbody').on('click', '.btn-toggle-details', function () {
        const tr = $(this).closest('tr');
        const row = dataTable.row(tr);
        const icon = $(this).find('.material-symbols-outlined');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            icon.text('add_circle').addClass('text-slate-400').removeClass('text-primary-blue');
        } else {
            const data = JSON.parse(tr.attr('data-details'));
            row.child(formatDetails(data)).show();
            tr.addClass('shown');
            icon.text('cancel').removeClass('text-slate-400').addClass('text-primary-blue');
        }
    });
}

function formatDetails(d) {
    return `
        <div class="p-4 bg-slate-50/50 rounded-xl border border-slate-100 m-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">RGT/Expediente</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.rgt} / ${d.expediente}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Organización</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.organizacion}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Origen</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.origen}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Funcionario</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.funcionario}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Cant. Mails</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.mails} (Último: ${d.lastMail})</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Días Transcurridos</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.transcurridosDays} días</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Observaciones</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.observaciones}</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Reingreso ID</span>
                        <span class="text-[12px] font-medium text-slate-700">${d.reingresoId}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function formatDate(dateString) {
    if (!dateString) return '';
    if (dateString === 'N/A' || dateString === '-') return dateString;

    // Check if it's already DD-MM-YYYY
    if (dateString.match(/^\d{2}-\d{2}-\d{4}/)) return dateString;

    try {
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString;

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        return `${day}-${month}-${year}`;
    } catch (e) {
        return dateString;
    }
}

function toggleDetails(id) {
    const details = document.getElementById(`details-${id}`);
    const button = document.querySelector(`button[onclick="toggleDetails('${id}')"]`);

    if (details.classList.contains('d-none')) {
        details.classList.remove('d-none');
        button.innerHTML = '<i data-feather="minus" style="width: 14px;"></i>';
    } else {
        details.classList.add('d-none');
        button.innerHTML = '<i data-feather="plus" style="width: 14px;"></i>';
    }

    if (window.feather) window.feather.replace();
}

function aplicarFiltros(data) {
    const hideReingresos = document.getElementById('filtro_ocultar_reingresos').checked;
    const fechaDesde = document.getElementById('filtro_fecha_desde').value;
    const fechaHasta = document.getElementById('filtro_fecha_hasta').value;

    return data.filter(item => {
        // Filtro de reingresos
        if (hideReingresos && item.sol_reingreso_id) return false;

        // Limpiar fechas para comparación (solo YYYY-MM-DD)
        const itemFecha = (item.sol_fecha_recepcion || '').substring(0, 10);

        if (fechaDesde && itemFecha < fechaDesde) return false;
        if (fechaHasta && itemFecha > fechaHasta) return false;

        return true;
    });
}

function buscarAtenciones() {
    renderTable(allSolicitudes);
}

function limpiarFiltros() {
    document.getElementById('filtro_fecha_desde').value = '';
    document.getElementById('filtro_fecha_hasta').value = '';
    document.getElementById('filtro_ocultar_reingresos').checked = false;
    renderTable(allSolicitudes);
}

function consultar(id) {
    window.location.href = `consultar.php?id=${id}`;
}

function verMantenedor(id) {
    window.location.href = `consultar.php?id=${id}`;
}
