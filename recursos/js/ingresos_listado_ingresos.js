let allSolicitudes = [];
let organizaciones = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let mails_enviados = [];

document.addEventListener('DOMContentLoaded', async function () {
    await loadInitialData();
    renderTable(allSolicitudes);

    document.getElementById('btn_buscar').addEventListener('click', buscarAtenciones);
    document.getElementById('btn_limpiar').addEventListener('click', limpiarFiltros);
});

async function loadInitialData() {
    try {
        const [solData, orgData, prioData, funcData, secData, mailData] = await Promise.all([
            fetch('../recursos/jsons/ingresos_solicitudes.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_organizaciones.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_prioridades.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_funcionarios.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_sectores.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_mails_enviados.json').then(r => r.json())
        ]);

        allSolicitudes = solData;
        organizaciones = orgData;
        prioridades = prioData;
        funcionarios = funcData;
        sectores = secData;
        mails_enviados = mailData;
    } catch (error) {
        console.error('Error loading data:', error);
    }
}

function renderTable(data) {
    const tbody = document.querySelector('#tablaAtenciones tbody');
    const resultsCount = document.getElementById('resultados_count');
    tbody.innerHTML = '';

    const filteredData = aplicarFiltros(data);
    resultsCount.innerText = filteredData.length;

    filteredData.forEach(item => {
        const org = organizaciones.find(o => o.ID_Organizacion === item.Origen_solicitud) || {};
        const prio = prioridades.find(p => p.ID_Prioridad === item.Prioridad) || {};
        const func = funcionarios.find(f => f.ID_Funcionarios === item.Funcionario_Interno) || {};
        const sec = sectores.find(s => s.ID_Sector === item.Sector) || {};
        const mails = mails_enviados.filter(m => m.Assunto === item.ID_Solicitud);
        const lastMail = mails.length > 0 ? mails[mails.length - 1] : {};

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <button class="btn btn-sm btn-primary" onclick="verMantenedor(${item.ID_Solicitud})">
                    Ver
                </button>
            </td>
            <td>${item.ID_Solicitud}</td>
            <td>${item.Ingreso_Desve}</td>
            <td class="text-nowrap">${item.Nombre_expediente}</td>
            <td>${org.Nombre_organizacion || 'N/A'}</td>
            <td>${item.Origen_solicitud}</td>
            <td>${item.Fecha_ultima_recepcion_Erwin}</td>
            <td><span class="badge bg-info text-dark">${prio.Nombre_Prioridad || 'N/A'}</span></td>
            <td>${func.Nombre || 'N/A'}</td>
            <td>${sec.Nombre_Sector || 'N/A'}</td>
            <td>${lastMail.Fecha || 'N/A'}</td>
            <td>${mails.length}</td>
            <td>${item.Fecha_vecimiento}</td>
            <td>${item.Entrego_Coordinador ? 'Sí' : 'No'}</td>
            <td>${item.Fecha_respuesta_coordinador || '-'}</td>
            <td>${item.Estado_de_entrega ? 'Entregado' : 'Pendiente'}</td>
            <td>${item.Dias_transcurridos_vencimiento}</td>
            <td>${item.OBSERVACIONES || ''}</td>
            <td>${item.Dias_transcurridos}</td>
            <td>${item.Reingreso || '-'}</td>
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
        if (hideReingresos && item.Reingreso) return false;

        if (fechaDesde && item.Fecha_ultima_recepcion_Erwin < fechaDesde) return false;
        if (fechaHasta && item.Fecha_ultima_recepcion_Erwin > fechaHasta) return false;

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
