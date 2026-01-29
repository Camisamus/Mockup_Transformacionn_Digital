let allSolicitudes = [];
let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];

document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/api';
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
            body: JSON.stringify({ ACCION: "CONSULTAM", S: "NL" })
        };
        const [solRes, orgRes, tipoRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/solicitudes_DESVE.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_DESVE.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json())
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
    const tbody = document.querySelector('#tablaAtenciones tbody');
    const resultsCount = document.getElementById('resultados_count');
    tbody.innerHTML = '';

    const filteredData = aplicarFiltros(data);
    resultsCount.innerText = filteredData.length;

    filteredData.forEach(item => {
        // Find related data using new API field names
        const org = organizaciones.find(o => o.org_id == item.sol_origen_id) || {};
        const tipoOrg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id) || {};
        const prio = prioridades.find(p => p.pri_id == item.sol_prioridad_id) || {};
        const func = funcionarios.find(f => f.fnc_id == item.sol_funcionario_id) || {};
        const sec = sectores.find(s => s.sec_id == item.sol_sector_id) || {};

        const mailsCount = item.sol_mails_count || 0;
        const lastMailDate = formatDate(item.sol_mail_enviado_fecha) || 'N/A';

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <button class="btn btn-sm btn-dark" onclick="responder(${item.sol_id})" title="Responder Registro">
                    <i data-feather="eye" style="width: 14px;"></i>
                </button>
            </td>
            <td>${item.sol_id}</td>
            <td class="d-none d-md-table-cell">${formatDate(item.sol_fecha_recepcion) || ''}</td>
            <td class="d-none d-md-table-cell">${formatDate(item.sol_fecha_vencimiento) || ''}</td>
            <td class="d-none d-md-table-cell"><span class="badge bg-info text-dark">${prio.pri_nombre || 'N/A'}</span></td>
            <td class="d-none d-md-table-cell text-center">${(item.sol_estado_entrega == 1 || item.sol_estado_entrega === true) ? '<span class="badge bg-success">Entregado</span>' : '<span class="badge bg-warning text-dark">Pendiente</span>'}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-outline-secondary" onclick="toggleDetails(${item.sol_id})">
                    <i data-feather="plus" id="icon-details-${item.sol_id}" style="width: 14px;"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);

        // Add the collapsible details row
        const detailRow = document.createElement('tr');
        detailRow.id = `details-${item.sol_id}`;
        detailRow.className = 'd-none row-details';
        detailRow.innerHTML = `
            <td colspan="7">
                <div class="p-3">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item"><span class="detail-label">RGT/Expediente:</span> ${item.sol_ingreso_desve || '-'} / ${item.sol_nombre_expediente || '-'}</div>
                            <div class="detail-item"><span class="detail-label">Organización:</span> ${tipoOrg.tor_nombre || 'N/A'}</div>
                            <div class="detail-item"><span class="detail-label">Origen:</span> ${org.org_nombre || item.sol_origen_texto || '-'}</div>
                            <div class="detail-item"><span class="detail-label">Funcionario:</span> ${func.fnc_nombre || 'N/A'}</div>
                            <div class="detail-item"><span class="detail-label">Sector:</span> ${sec.sec_nombre || 'N/A'}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item"><span class="detail-label">Cant. Mails:</span> ${mailsCount} (Último: ${lastMailDate})</div>
                             <div class="detail-item"><span class="detail-label">Entrega Coordinador:</span> ${(item.sol_entrego_coordinador == 1) ? 'Sí (' + (formatDate(item.sol_fecha_respuesta_coordinador) || '') + ')' : 'No'}</div>
                            <div class="detail-item"><span class="detail-label">Días Vencimiento:</span> ${item.sol_dias_vencimiento || 0}</div>
                            <div class="detail-item"><span class="detail-label">Días Transcurridos:</span> ${item.sol_dias_transcurridos || 0}</div>
                             <div class="detail-item"><span class="detail-label">Observaciones:</span> ${item.sol_observaciones || ''}</div>
                             <div class="detail-item"><span class="detail-label">Reingreso ID:</span> ${item.sol_reingreso_id || '-'}</div>
                        </div>
                     </div>
                </div>
            </td>
        `;
        tbody.appendChild(detailRow);
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
        if (hideReingresos && item.sol_reingreso_id) return false;

        if (fechaDesde && item.sol_fecha_recepcion < fechaDesde) return false;
        if (fechaHasta && item.sol_fecha_recepcion > fechaHasta) return false;

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

function responder(id) {
    window.location.href = `desve_responder.html?id=${id}`;
}
