let allSolicitudes = [];
let organizaciones = [];
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
});

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [solRes, orgRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/solicitudes.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json())
        ]);

        allSolicitudes = extractData(solRes);
        organizaciones = extractData(orgRes);
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

function renderTable(data) {
    const tbody = document.querySelector('#tablaAtenciones tbody');
    const resultsCount = document.getElementById('resultados_count');
    tbody.innerHTML = '';

    const filteredData = aplicarFiltros(data);
    resultsCount.innerText = filteredData.length;

    filteredData.forEach(item => {
        // Find related data using new API field names
        const org = organizaciones.find(o => o.org_id == item.sol_origen_id) || {};
        const prio = prioridades.find(p => p.pri_id == item.sol_prioridad_id) || {};
        const func = funcionarios.find(f => f.fnc_id == item.sol_funcionario_id) || {};
        const sec = sectores.find(s => s.sec_id == item.sol_sector_id) || {};

        // Mails count and last mail potentially handled differently or not available in mass consultation
        // depending on what solicitudes.php returns. If it doesn't return count, we use 0.
        const mailsCount = item.sol_mails_count || 0;
        const lastMailDate = item.sol_mail_enviado_fecha || 'N/A';

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <button class="btn btn-sm btn-primary" onclick="verMantenedor(${item.sol_id})">
                    Ver
                </button>
            </td>
            <td>${item.sol_id}</td>
            <td>${item.sol_ingreso_desve || ''}</td>
            <td class="text-nowrap">${item.sol_nombre_expediente || ''}</td>
            <td>${org.org_nombre || 'N/A'}</td>
            <td>${item.sol_origen_texto || '-'}</td>
            <td>${item.sol_fecha_recepcion || ''}</td>
            <td><span class="badge bg-info text-dark">${prio.pri_nombre || 'N/A'}</span></td>
            <td>${func.fnc_nombre || 'N/A'}</td>
            <td>${sec.sec_nombre || 'N/A'}</td>
            <td>${lastMailDate}</td>
            <td>${mailsCount}</td>
            <td>${item.sol_fecha_vencimiento || ''}</td>
            <td>${(item.sol_entrego_coordinador == 1 || item.sol_entrego_coordinador === true) ? 'Sí' : 'No'}</td>
            <td>${item.sol_fecha_respuesta_coordinador || '-'}</td>
            <td>${(item.sol_estado_entrega == 1 || item.sol_estado_entrega === true) ? 'Entregado' : 'Pendiente'}</td>
            <td>${item.sol_dias_vencimiento || 0}</td>
            <td>${item.sol_observaciones || ''}</td>
            <td>${item.sol_dias_transcurridos || 0}</td>
            <td>${item.sol_reingreso_id || '-'}</td>
        `;
        tbody.appendChild(row);
    });

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

function verMantenedor(id) {
    window.location.href = `ingresos_ingreso_ingresos.html?id=${id}`;
}
