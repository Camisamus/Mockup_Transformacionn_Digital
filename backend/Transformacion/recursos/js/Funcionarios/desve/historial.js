let allSolicitudes = [];
let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];

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
    document.getElementById('btn_exportar_excel').addEventListener('click', () => {
        const dataToExport = allSolicitudes.map(item => {
            const org = organizaciones.find(o => o.org_id == item.sol_origen_id) || {};
            const tipoOrg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id) || {};
            const prio = prioridades.find(p => p.pri_id == item.sol_prioridad_id) || {};
            const func = funcionarios.find(f => f.fnc_id == item.sol_funcionario_id) || {};
            const sec = sectores.find(s => s.sec_id == item.sol_sector_id) || {};

            return {
                "ID": item.sol_id,
                "RGT": item.sol_ingreso_desve,
                "Expediente": item.sol_nombre_expediente,
                "Tipo Organización": tipoOrg.tor_nombre || 'N/A',
                "Origen": item.sol_origen_texto || org.org_nombre || 'N/A',
                "Fecha Recepción": formatDate(item.sol_fecha_recepcion),
                "Prioridad": prio.pri_nombre || 'N/A',
                "Funcionario": func.fnc_nombre || 'N/A',
                "Sector": sec.sec_nombre || 'N/A',
                "Vencimiento": formatDate(item.sol_fecha_vencimiento),
                "Estado Entrega": (item.sol_estado_entrega == 1 || item.sol_estado_entrega === true) ? 'Entregado' : 'Pendiente',
                "Entrega Coordinador": (item.sol_entrego_coordinador == 1) ? 'Sí (' + (formatDate(item.sol_fecha_respuesta_coordinador) || '') + ')' : 'No',
                "Días Vencimiento": item.sol_dias_vencimiento || 0,
                "Días Transcurridos": item.sol_dias_transcurridos || 0,
                "Cant. Mails": item.sol_mails_count || 0,
                "Último Mail": formatDate(item.sol_mail_enviado_fecha),
                "Observaciones": item.sol_observaciones || '',
                "Reingreso ID": item.sol_reingreso_id || '-'
            };
        });
        exportJsonToExcel(dataToExport, 'Listado_Ingresos_DESVE');
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
            body: JSON.stringify({ ACCION: "CONSULTAM", S: "HISTORIAL" })
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
function renderTable(data) {
    const tbody = document.getElementById('tbody_desve');
    const resultsCount = document.getElementById('resultados_count');
    if (!tbody) return;
    tbody.innerHTML = '';

    const filteredData = aplicarFiltros(data);
    resultsCount.innerText = filteredData.length;

    if (filteredData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">No se encontraron solicitudes con los filtros aplicados.</td></tr>';
        return;
    }

    filteredData.forEach(item => {
        const row = document.createElement('tr');
        row.className = "hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0";
        row.innerHTML = `
            <td class="px-6 py-4 text-center">
                <button class="flex items-center justify-center w-8 h-8 mx-auto rounded-lg text-slate-400 hover:text-primary-blue hover:bg-blue-50 transition-all font-bold" 
                    onclick="consultar(${item.sol_id})" title="Consultar Registro">
                    <span class="material-symbols-outlined text-xl">visibility</span>
                </button>
            </td>
            <td class="px-6 py-4 font-bold text-slate-700">#${item.sol_id}</td>
            <td class="px-6 py-4 text-slate-500">${formatDate(item.sol_mail_enviado_fecha) || 'N/A'}</td>
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span class="font-semibold text-slate-700 text-sm line-clamp-1">${item.sol_nombre_expediente || 'Sin Nombre'}</span>
                    <span class="text-[10px] text-slate-400 uppercase tracking-wider font-medium">${item.sol_ingreso_desve || '-'}</span>
                </div>
            </td>
            <td class="px-6 py-4 text-center">
                ${(item.sol_estado_entrega == 1 || item.sol_estado_entrega === true)
                ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wider">Entregado</span>'
                : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 uppercase tracking-wider">Pendiente</span>'}
            </td>
        `;
        tbody.appendChild(row);
    });

    if (window.feather) window.feather.replace();
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
    const button = document.querySelector(`button[onclick="toggleDetails(${id})"]`);

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

