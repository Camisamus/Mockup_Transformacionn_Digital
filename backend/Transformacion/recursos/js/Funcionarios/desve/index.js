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
    // Auth handled by PHP
    renderTable(allSolicitudes);

});

async function loadInitialData() {


    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [solRes, orgRes, tipoRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}sisadmin/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
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
    const tbody = document.getElementById('tbody_desve');
    tbody.innerHTML = '';
    data.forEach(item => {
        // Find related data using new API field names
        const org = organizaciones.find(o => o.org_id == item.sol_origen_id) || {};
        const tipoOrg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id) || {};
        const prio = prioridades.find(p => p.pri_id == item.sol_prioridad_id) || {};
        const func = funcionarios.find(f => f.fnc_id == item.sol_funcionario_id) || {};
        const sec = sectores.find(s => s.sec_id == item.sol_sector_id) || {};

        const mailsCount = item.sol_mails_count || 0;
        const lastMailDate = formatDate(item.sol_mail_enviado_fecha) || 'N/A';
        const diasRestantes = calcularDiasHabilesRestantes(item.sol_fecha_vencimiento);
        const row = document.createElement('tr');
        row.innerHTML = `

                        <td class="px-6 py-4 font-bold text-slate-700">${item.sol_id}</td>
                        <td class="px-6 py-4 text-slate-600 font-medium">${org.org_nombre || item.sol_origen_texto || '-'}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-rose-500 font-bold text-sm">
                                <span class="material-symbols-outlined text-sm">schedule</span>${diasRestantes} Días
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="badge-alta">${prio.pri_nombre || 'N/A'}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button
                                class="text-primary-blue font-bold hover:text-blue-800 transition-all text-sm"  onclick="verMantenedor(${item.sol_id})" >Gestionar</button>
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
    window.location.href = `consultar.php?id=${id}`;
}

