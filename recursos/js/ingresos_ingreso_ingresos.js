document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    await loadInitialData();
    populateSelects();

    if (solicitationId) {
        loadSolicitationDetails(parseInt(solicitationId));
    }

    // Listen for organization change to update priority/vencimiento
    document.getElementById('ID_Organizacion').addEventListener('input', handleOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleOrgChange);

    // Initialize Feather
    if (window.feather) feather.replace();
});

let allSolicitudes = [];
let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let respuestas = [];

async function loadInitialData() {
    try {
        const [sol, org, tipo, prio, func, sec, resp] = await Promise.all([
            fetch('../recursos/jsons/ingresos_solicitudes.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_organizaciones.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_tipos_organizacion.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_prioridades.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_funcionarios.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_sectores.json').then(r => r.json()),
            fetch('../recursos/jsons/ingresos_respuestas.json').then(r => r.json())
        ]);

        allSolicitudes = sol;
        organizaciones = org;
        tiposOrganizacion = tipo;
        prioridades = prio;
        funcionarios = func;
        sectores = sec;
        respuestas = resp;
    } catch (e) {
        console.error("Error loading data:", e);
    }
}

function populateSelects() {
    // Organizations Datalist
    const orgDatalist = document.getElementById('lista_organizaciones');
    orgDatalist.innerHTML = '';
    organizaciones.forEach(o => {
        const option = document.createElement('option');
        option.value = o.Nombre_organizacion;
        orgDatalist.appendChild(option);
    });

    // Sectors Select
    const secSelect = document.getElementById('Sector');
    secSelect.innerHTML = '<option value="">Seleccione sector...</option>';
    sectores.forEach(s => {
        const option = document.createElement('option');
        option.value = s.ID_Sector;
        option.innerText = s.Nombre_Sector;
        secSelect.appendChild(option);
    });
}

function handleOrgChange() {
    const orgName = document.getElementById('ID_Organizacion').value;
    const org = organizaciones.find(o => o.Nombre_organizacion === orgName);

    if (org) {
        const tipo = tiposOrganizacion.find(t => t.ID_Tipo_de_organizacion === org.Tipo_organizacion);
        if (tipo) {
            const prio = prioridades.find(p => p.ID_Prioridad === tipo.Prioridad);
            if (prio) {
                document.getElementById('Prioridad').value = prio.Nombre_Prioridad;
                calculateVencimiento(prio.Tiempo_establecido);
            }
        }
    }
}

function calculateVencimiento(days) {
    const fechaIngresoField = document.getElementById('FechaUltimaRecepcion');
    const fechaIngresoValue = fechaIngresoField.value;
    if (!fechaIngresoValue) return;

    let date = new Date(fechaIngresoValue);
    let count = 0;
    while (count < days) {
        date.setDate(date.getDate() + 1);
        if (date.getDay() !== 0 && date.getDay() !== 6) { // Skip Sat/Sun
            count++;
        }
    }

    // Format to datetime-local string (YYYY-MM-DDTHH:mm)
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const mins = String(date.getMinutes()).padStart(2, '0');

    document.getElementById('FechaVecimiento').value = `${year}-${month}-${day}T${hours}:${mins}`;
    calculateElapsedDays();
}

function calculateElapsedDays() {
    const today = new Date();
    const fieldIngreso = document.getElementById('FechaUltimaRecepcion').value;
    const fieldVencimiento = document.getElementById('FechaVecimiento').value;

    if (fieldIngreso) {
        const diffIng = Math.floor((today - new Date(fieldIngreso)) / (1000 * 60 * 60 * 24));
        document.getElementById('DiasIngreso').value = Math.max(0, diffIng);
    }

    if (fieldVencimiento) {
        const diffVenc = Math.floor((today - new Date(fieldVencimiento)) / (1000 * 60 * 60 * 24));
        document.getElementById('DiasVencimiento').value = diffVenc; // Can be negative if not yet expired
    }
}

function loadSolicitationDetails(id) {
    const sol = allSolicitudes.find(s => s.ID_Solicitud === id);
    if (!sol) return;

    document.getElementById('idIngreso').value = sol.ID_Solicitud;
    document.getElementById('IngresoDesve').value = sol.Ingreso_Desve;
    document.getElementById('Reingresado').value = sol.Reingreso || '-';
    document.getElementById('NombreExpediente').value = sol.Nombre_expediente;

    const org = organizaciones.find(o => o.ID_Organizacion === sol.Origen_solicitud);
    if (org) document.getElementById('ID_Organizacion').value = org.Nombre_organizacion;

    document.getElementById('OrigenSolicitud').value = sol.Origen_solicitud_texto || 'Particular';
    document.getElementById('FechaUltimaRecepcion').value = sol.Fecha_ultima_recepcion_Erwin;

    const prio = prioridades.find(p => p.ID_Prioridad === sol.Prioridad);
    if (prio) document.getElementById('Prioridad').value = prio.Nombre_Prioridad;

    document.getElementById('FuncionarioInterno').value = sol.Funcionario_Interno;
    document.getElementById('Sector').value = sol.Sector;

    document.getElementById('FechaVecimiento').value = sol.Fecha_vecimiento;
    document.getElementById('FechaRespuesta').value = sol.Fecha_respuesta_coordinador || '';
    document.getElementById('EntregadoEnConformidad').value = sol.Entrego_Coordinador ? 'Sí' : 'No';
    document.getElementById('EstadoDeEntrega').value = sol.Estado_de_entrega ? 'Entregado' : 'Pendiente';
    document.getElementById('MailEnviadoFecha').value = sol.Mail_Enviado_Fecha || '';
    document.getElementById('NumeroMailEnviado').value = sol.Mails_Count || 0;

    document.getElementById('Observaciones').value = sol.OBSERVACIONES || '';

    calculateElapsedDays();

    renderBitacora(id);
    renderReingresos(id);

    const btnOriginal = document.getElementById('btn_ingreso_original');
    if (sol.Reingreso) {
        btnOriginal.classList.remove('d-none');
        btnOriginal.onclick = () => window.location.href = `?id=${sol.Reingreso}`;
    } else {
        btnOriginal.classList.add('d-none');
    }

    const btnResp = document.getElementById('btn_ingresar_respuesta');
    if (btnResp) {
        btnResp.onclick = () => window.location.href = `ingresos_ingresar_respuesta.html?id=${id}`;
    }
}

function renderBitacora(id) {
    const bitacora = respuestas.filter(r => r.Solicitud_res === id);
    const tbody = document.querySelector('#tablaBitacora tbody');
    tbody.innerHTML = '';
    bitacora.forEach(r => {
        tbody.insertAdjacentHTML('beforeend', `<tr><td>${r.ID_Respuesta}</td><td>${r.respuesta}</td></tr>`);
    });
}

function renderReingresos(id) {
    const children = allSolicitudes.filter(s => s.Reingreso === id);
    const tbody = document.querySelector('#tablaReingresos tbody');
    tbody.innerHTML = '';
    children.forEach(c => {
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${c.ID_Solicitud}</td>
                <td>${c.Nombre_expediente}</td>
                <td><button class="btn btn-sm btn-outline-primary" onclick="window.location.href='?id=${c.ID_Solicitud}'">Ver</button></td>
            </tr>
        `);
    });
}

function abrirModalFuncionarios() {
    const tbody = document.querySelector('#tablaFuncionarios tbody');
    tbody.innerHTML = '';
    funcionarios.forEach(f => {
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${f.RUT}</td>
                <td>${f.Nombre}</td>
                <td>${f.Cargo}</td>
                <td><button class="btn btn-sm btn-success" onclick="seleccionarFuncionario('${f.ID_Funcionarios}')">Seleccionar</button></td>
            </tr>
        `);
    });
    const modal = new bootstrap.Modal(document.getElementById('modalFuncionarios'));
    modal.show();
}

function seleccionarFuncionario(id) {
    document.getElementById('FuncionarioInterno').value = id;
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalFuncionarios'));
    modal.hide();
}

function buscarAtencion() {
    const id = prompt("Ingrese ID de Solicitud:");
    if (id) window.location.href = `?id=${id}`;
}
function nuevaAtencion() { window.location.href = 'ingresos_ingreso_ingresos.html'; }
function modificarAtencion() { alert("Modo edición activado"); }
function guardarAtencion() { alert("Guardado con éxito"); }
