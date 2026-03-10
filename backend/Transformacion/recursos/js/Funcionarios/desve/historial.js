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
                    onclick="consultar('${item.sol_id}')" title="Consultar Registro">
                    <span class="material-symbols-outlined text-xl">visibility</span>
                </button>
            </td>
            <td class="px-6 py-4 font-bold text-slate-700">#${item.sol_id_raw || item.sol_id}</td>
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

