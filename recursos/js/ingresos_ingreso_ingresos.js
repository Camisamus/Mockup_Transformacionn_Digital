document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    // Ensure API_BASE_URL is available (from layout_manager.js)
    if (!window.API_BASE_URL) {
        console.warn("API_BASE_URL not defined, defaulting.");
        window.API_BASE_URL = 'http://127.0.0.1/api';
    }

    await loadInitialData();
    populateSelects();

    // Default to current date/time if it's a new entry
    if (!solicitationId) {
        document.getElementById('FechaUltimaRecepcion').value = getCurrentDateTimeLocal();
    }

    if (solicitationId) {
        loadSolicitationDetails(solicitationId);
    } else {
        // If new entry, enable fields including Desve/Detalle
        document.getElementById('FechaUltimaRecepcion').value = getCurrentDateTimeLocal();

        // Populate Responsible from session
        const userData = JSON.parse(localStorage.getItem('user_data') || '{}');
        const userId = userData.user ? userData.user.id : null;

        // Store the ID for saving, but display the name
        if (userId) {
            // Store ID in a data attribute for later use
            document.getElementById('Responsable').setAttribute('data-user-id', userId);

            // Display the name
            const nombre = userData.user.nombre || '';
            const apellido = userData.user.apellido || '';
            const fullName = `${nombre} ${apellido}`.trim();

            if (fullName) {
                document.getElementById('Responsable').value = fullName;
            } else if (userData.user.email) {
                document.getElementById('Responsable').value = userData.user.email;
            } else {
                document.getElementById('Responsable').value = `ID: ${userId}`;
            }
        } else {
            document.getElementById('Responsable').value = 'Admin';
            document.getElementById('Responsable').setAttribute('data-user-id', '');
        }

        toggleFields(true, true);
    }

    // Listen for organization change to update priority/vencimiento
    document.getElementById('OrigenSolicitud').addEventListener('change', handleOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleOrgChange);

    // Initialize Feather
    if (window.feather) feather.replace();
});

let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, tipoRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);

    } catch (e) {
        console.error("Error loading initial data:", e);
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

function populateSelects() {
    // Organizations Select
    const orgSelect = document.getElementById('OrigenSolicitud');
    orgSelect.innerHTML = '<option value="">Seleccione organización...</option>';
    organizaciones.forEach(o => {
        const option = document.createElement('option');
        option.value = o.org_id;
        option.innerText = o.org_nombre;
        orgSelect.appendChild(option);
    });

    // Sectors Select
    const secSelect = document.getElementById('Sector');
    secSelect.innerHTML = '<option value="">Seleccione sector...</option>';
    sectores.forEach(s => {
        const option = document.createElement('option');
        option.value = s.sec_id;
        option.innerText = s.sec_nombre;
        secSelect.appendChild(option);
    });
}

function handleOrgChange() {
    const orgId = document.getElementById('OrigenSolicitud').value;
    const org = organizaciones.find(o => o.org_id == orgId);

    if (org) {
        const tipo = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id);
        if (tipo) {
            document.getElementById('ID_Organizacion').value = tipo.tor_nombre;
            const prio = prioridades.find(p => p.pri_id == tipo.tor_prioridad_id);
            if (prio) {
                document.getElementById('Prioridad').value = prio.pri_nombre;
                calculateVencimiento(parseInt(prio.pri_tiempo_establecido) || 0);
            }
        }
    } else {
        document.getElementById('ID_Organizacion').value = '';
        document.getElementById('Prioridad').value = '';
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
    const fieldCreacion = document.getElementById('FechaCreacion').value;
    const fieldVencimiento = document.getElementById('FechaVecimiento').value;

    if (fieldCreacion) {
        const diffIng = Math.floor((today - new Date(fieldCreacion)) / (1000 * 60 * 60 * 24));
        document.getElementById('DiasIngreso').value = Math.max(0, diffIng);
    }

    if (fieldVencimiento) {
        const diffVenc = Math.floor((today - new Date(fieldVencimiento)) / (1000 * 60 * 60 * 24));
        document.getElementById('DiasVencimiento').value = diffVenc;
    }
}

async function loadSolicitationDetails(id) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/solicitudes.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM", ver_clave: true })
        });
        const result = await response.json();

        let sol = null;
        if (result.status === 'success' && result.data) {
            sol = result.data;
        } else {
            console.error("Solicitud not found or API error", result);
            return;
        }

        document.getElementById('idIngreso').value = sol.sol_id || '';
        document.getElementById('IngresoDesve').value = sol.sol_ingreso_desve || '';
        document.getElementById('Reingresado').value = sol.sol_reingreso_id || '-';
        document.getElementById('NombreExpediente').value = sol.sol_nombre_expediente || '';

        // OrigenSolicitud is now a select mapping to sol_origen_id
        document.getElementById('OrigenSolicitud').value = sol.sol_origen_id || '';
        handleOrgChange(); // Populate ID_Organizacion and Prioridad automatically

        document.getElementById('FechaUltimaRecepcion').value = formatDateTimeForInput(sol.sol_fecha_recepcion);
        document.getElementById('FechaCreacion').value = formatDateTimeForInput(sol.sol_creacion);

        // Map priority if it was manually set or if it differs from the calculated one but it's likely better to let handleOrgChange do its thing 
        // unless the solicitation had an override. 
        // If solicitation has a specific priority, we can set it:
        if (sol.sol_prioridad_id) {
            const prio = prioridades.find(p => p.pri_id == sol.sol_prioridad_id);
            if (prio) document.getElementById('Prioridad').value = prio.pri_nombre;
        }

        document.getElementById('FuncionarioInternoId').value = sol.sol_funcionario_id || '';
        if (sol.sol_funcionario_id) {
            const func = funcionarios.find(f => f.fnc_id == sol.sol_funcionario_id);
            if (func) {
                const nombreCompleto = `${func.fnc_nombre || ''} ${func.fnc_apellido || ''}`.trim();
                document.getElementById('FuncionarioInternoNombre').value = nombreCompleto || 'Sin Nombre';
            } else {
                document.getElementById('FuncionarioInternoNombre').value = 'ID: ' + sol.sol_funcionario_id;
            }
        } else {
            document.getElementById('FuncionarioInternoNombre').value = '';
        }

        document.getElementById('Sector').value = sol.sol_sector_id || '';

        // Show Responsable - look up the name from funcionarios using the ID
        if (sol.sol_responsable) {
            document.getElementById('Responsable').setAttribute('data-user-id', sol.sol_responsable);

            // Try to find the user in funcionarios list
            const responsableFunc = funcionarios.find(f => f.fnc_id == sol.sol_responsable);
            if (responsableFunc) {
                const nombreCompleto = `${responsableFunc.fnc_nombre || ''} ${responsableFunc.fnc_apellido || ''}`.trim();
                document.getElementById('Responsable').value = nombreCompleto || `ID: ${sol.sol_responsable}`;
            } else {
                // If not found in funcionarios, just show the ID
                document.getElementById('Responsable').value = `ID: ${sol.sol_responsable}`;
            }
        } else {
            document.getElementById('Responsable').value = 'N/A';
            document.getElementById('Responsable').setAttribute('data-user-id', '');
        }

        document.getElementById('FechaVecimiento').value = formatDateTimeForInput(sol.sol_fecha_vencimiento);
        document.getElementById('FechaRespuesta').value = formatDateTimeForInput(sol.sol_fecha_respuesta_coordinador);

        document.getElementById('EntregadoEnConformidad').value = (sol.sol_entrego_coordinador == 1 || sol.sol_entrego_coordinador === true) ? 'Sí' : 'No';

        // Estado de entrega (Radio buttons)
        if (sol.sol_estado_entrega == 1 || sol.sol_estado_entrega === true) {
            document.getElementById('estadoRespondido').checked = true;
        } else {
            document.getElementById('estadoPendiente').checked = true;
        }

        document.getElementById('DiasIngreso').value = sol.sol_dias_transcurridos || 0;
        document.getElementById('DiasVencimiento').value = sol.sol_dias_vencimiento || 0;

        document.getElementById('DetalleIngreso').value = sol.sol_detalle || '';
        document.getElementById('Observaciones').value = sol.sol_observaciones || '';

        renderBitacora(sol.respuestas || []);
        calculateElapsedDays();

        const btnOriginal = document.getElementById('btn_ingreso_original');
        if (sol.sol_reingreso_id) {
            btnOriginal.classList.remove('d-none');
            btnOriginal.onclick = () => window.location.href = `?id=${sol.sol_reingreso_id}`;
        } else {
            btnOriginal.classList.add('d-none');
        }

        const btnResp = document.getElementById('btn_ingresar_respuesta');
        if (btnResp) {
            btnResp.onclick = () => {
                const modal = new bootstrap.Modal(document.getElementById('modalRespuesta'));
                modal.show();
            };
        }
    } catch (e) {
        console.error("Detailed Fetch Error:", e);
    }
}

function formatDateTimeForInput(dateStr) {
    if (!dateStr) return '';
    if (dateStr.includes('T')) return dateStr.slice(0, 16);
    return dateStr.replace(' ', 'T').slice(0, 16);
}

function renderBitacora(respuestasArray) {
    const tbody = document.querySelector('#tablaBitacora tbody');
    tbody.innerHTML = '';
    respuestasArray.forEach(r => {
        const fechaStr = r.res_fecha ? new Date(r.res_fecha).toLocaleString() : 'N/A';
        const tipoLabel = `<span class="badge ${r.res_tipo === 'Respuesta Final' ? 'bg-success' : 'bg-info'}">${r.res_tipo || 'Comentario'}</span>`;
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${r.res_id}</td>
                <td>${fechaStr}</td>
                <td>${tipoLabel}</td>
                <td>${r.res_texto}</td>
            </tr>
        `);
    });
}

function formatDateTimeForBackend(val) {
    if (!val) return null;
    return val.replace('T', ' ') + ':00';
}

function getCurrentDateTimeLocal() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const mins = String(now.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day}T${hours}:${mins}`;
}

async function guardarAtencion() {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    const isUpdate = !!solicitationId;

    const orgId = document.getElementById('OrigenSolicitud').value;

    const prioName = document.getElementById('Prioridad').value;
    const prio = prioridades.find(p => p.pri_nombre === prioName);
    const prioId = prio ? prio.pri_id : null;

    const body = {
        sol_id: document.getElementById('idIngreso').value || null,
        sol_ingreso_desve: document.getElementById('IngresoDesve').value,
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_origen_id: orgId,
        sol_origen_texto: '', // Origen texto deprecated as we use ID now 
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: formatDateTimeForBackend(document.getElementById('FechaUltimaRecepcion').value),
        sol_prioridad_id: prioId,
        sol_funcionario_id: document.getElementById('FuncionarioInternoId').value,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: formatDateTimeForBackend(document.getElementById('FechaVecimiento').value),
        sol_entrego_coordinador: document.getElementById('EntregadoEnConformidad').value === 'Si',
        sol_fecha_respuesta_coordinador: formatDateTimeForBackend(document.getElementById('FechaRespuesta').value),
        sol_estado_entrega: document.getElementById('estadoRespondido').checked,
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_dias_transcurridos: parseInt(document.getElementById('DiasIngreso').value) || 0,
        sol_dias_vencimiento: parseInt(document.getElementById('DiasVencimiento').value) || 0,
        sol_reingreso_id: toNull(document.getElementById('Reingresado').value),
        sol_responsable: document.getElementById('Responsable').getAttribute('data-user-id') || null,
        ACCION: isUpdate ? "ACTUALIZAR" : "CREAR"
    };

    const url = isUpdate ? `${window.API_BASE_URL}/solicitudes.php?id=${solicitationId}` : `${window.API_BASE_URL}/solicitudes.php`;

    try {

        console.log(url);
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
            credentials: 'include'
        });
        const result = await response.json();

        if (result.status === 'success') {
            alert(isUpdate ? "Actualizado con éxito" : "Creado con éxito");
            if (!isUpdate && result.data && result.data.sol_id) {
                window.location.href = `?id=${result.data.sol_id}`;
            }
        } else {
            alert("Error al guardar: " + (result.message || "Error desconocido"));
        }
    } catch (e) {
        console.error("Save Error:", e);
        alert("Error de conexión al guardar.");
    }
}

async function eliminarAtencion() {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    if (!solicitationId) {
        alert("No hay una solicitud cargada para eliminar.");
        return;
    }

    if (!confirm("¿Está seguro de eliminar esta solicitud?")) return;

    try {
        const response = await fetch(`${window.API_BASE_URL}/solicitudes.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: solicitationId, ACCION: "BORRAR" })
        });
        const result = await response.json();

        if (result.status === 'success') {
            alert("Eliminado con éxito");
            window.location.href = 'ingresos_ingreso_ingresos.html';
        } else {
            alert("Error al eliminar: " + (result.message || "Error desconocido"));
        }
    } catch (e) {
        console.error("Delete Error:", e);
        alert("Error de conexión al eliminar.");
    }
}

function abrirModalFuncionarios() {
    const tbody = document.querySelector('#tablaFuncionarios tbody');
    tbody.innerHTML = '';
    funcionarios.forEach(f => {
        const nombreCompleto = `${f.fnc_nombre || ''} ${f.fnc_apellido || ''}`.trim() || 'Sin Nombre';
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${f.fnc_rut || '-'}</td>
                <td>${nombreCompleto}</td>
                <td>${f.fnc_cargo || '-'}</td>
                <td><button class="btn btn-sm btn-success" onclick="seleccionarFuncionario('${f.fnc_id}')">Seleccionar</button></td>
            </tr>
        `);
    });

    // Add search filter listener
    const filtroInput = document.getElementById('filtroFuncionario');
    if (filtroInput) {
        filtroInput.addEventListener('keyup', filtrarFuncionarios);
    }

    const modal = new bootstrap.Modal(document.getElementById('modalFuncionarios'));
    modal.show();
}

function filtrarFuncionarios() {
    const filtro = document.getElementById('filtroFuncionario').value.toLowerCase();
    const tbody = document.querySelector('#tablaFuncionarios tbody');
    const rows = tbody.querySelectorAll('tr');

    rows.forEach(row => {
        const rut = row.cells[0].textContent.toLowerCase();
        const nombre = row.cells[1].textContent.toLowerCase();
        const cargo = row.cells[2].textContent.toLowerCase();

        if (rut.includes(filtro) || nombre.includes(filtro) || cargo.includes(filtro)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function seleccionarFuncionario(id) {
    const func = funcionarios.find(f => f.fnc_id == id);
    if (func) {
        document.getElementById('FuncionarioInternoId').value = id;
        const nombreCompleto = `${func.fnc_nombre || ''} ${func.fnc_apellido || ''}`.trim();
        document.getElementById('FuncionarioInternoNombre').value = nombreCompleto || 'Sin Nombre';
    }
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalFuncionarios'));
    modal.hide();
}

function buscarAtencion() {
    const id = prompt("Ingrese ID de Solicitud:");
    if (id) window.location.href = `?id=${id}`;
}
function nuevaAtencion() { window.location.href = 'ingresos_ingreso_ingresos.html'; }
function modificarAtencion() {
    toggleFields(true, false);
    alert("Modo edición activado: ya puede cambiar los campos y presionar Guardar.");
}

function toggleFields(enabled, isNew = false) {
    let restricted = [
        'idIngreso', 'IngresoDesve', 'DetalleIngreso', 'ID_Organizacion',
        'FuncionarioInternoId', 'FuncionarioInternoNombre', 'DiasIngreso',
        'DiasVencimiento', 'Responsable', 'ClaveRespuesta', 'FechaCreacion'
    ];

    // If it's a new entry, we allow editing these two
    if (isNew) {
        restricted = restricted.filter(id => id !== 'IngresoDesve' && id !== 'DetalleIngreso');
    }

    // Toggle Radio buttons
    document.getElementById('estadoPendiente').disabled = !enabled;
    document.getElementById('estadoRespondido').disabled = !enabled;

    const form = document.getElementById('formConsultaAtencion');
    const elements = form.querySelectorAll('input, select, textarea');

    elements.forEach(el => {
        if (!restricted.includes(el.id)) {
            el.disabled = !enabled;
        }
    });

    // Also enable/disable the search button for officer
    const btnBuscaFunc = document.getElementById('btn_buscar_funcionario');
    if (btnBuscaFunc) btnBuscaFunc.disabled = !enabled;
}

async function enviarRespuesta() {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    const texto = document.getElementById('textoRespuesta').value.trim();
    const tipo = document.getElementById('inputTipoRespuesta').value;

    // Si la solicitud es un re-ingreso, vinculamos la respuesta al ID original
    const reingresoId = document.getElementById('Reingresado').value;
    const targetSolicitationId = (reingresoId && reingresoId !== '-') ? reingresoId : solicitationId;

    if (!solicitationId) {
        alert("Debe cargar una solicitud antes de ingresar una respuesta.");
        return;
    }
    if (!texto) {
        alert("Por favor, escriba el contenido de la respuesta.");
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/respuestas.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                res_solicitud_id: targetSolicitationId,
                res_texto: texto,
                res_tipo: tipo
            })
        });
        const result = await response.json();

        if (result.status === 'success') {
            alert("Respuesta guardada con éxito.");
            document.getElementById('textoRespuesta').value = '';

            // Close modal
            const modalEl = document.getElementById('modalRespuesta');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Refresh solicitation details to show new record in bitacora
            loadSolicitationDetails(solicitationId);
        } else {
            alert("Error al guardar: " + (result.message || "Error desconocido"));
        }
    } catch (e) {
        console.error("Error saving response:", e);
        alert("Error de conexión al guardar la respuesta.");
    }
}

/**
 * Helpers
 */
function toNull(val) {
    if (val === '' || val === '-' || val === null || val === undefined) return null;
    return val;
}

function generateRandomString(length) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}
