document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    if (!solicitationId) {
        solicitarID();
        return;
    }

    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';
    // 1. Verify Session
    const sessionRes = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
        method: 'POST',
        credentials: 'include',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ACCION: "" })
    });
    const sessionData = await sessionRes.json();

    if (!sessionData.isAuthenticated || !sessionData.user) {
        await Swal.fire({
            title: "Sesión Requerida",
            text: "Debe iniciar sesión para acceder a esta página.",
            icon: "warning",
            confirmButtonText: "Ir al Login"
        });
        window.location.href = 'index.html'; // Assuming index is login
        return;
    }
    currentUser = sessionData.user;


    await loadInitialData();
    populateSelects();
    loadSolicitationDetails(solicitationId, currentUser);
    // Initialize modal
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalFuncionarios'));

    // Event Listeners
    document.getElementById('ID_Organizacion').addEventListener('change', handleTipoOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleTipoOrgChange);

    document.getElementById('btn_nuevo_origen').onclick = () => {
        const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
        modal.show();
    };

    document.getElementById('form_modificar_desve').onsubmit = (e) => {
        e.preventDefault();
        actualizarSolicitud();
    };

    document.getElementById('btn_cancelar').onclick = () => {
        window.location.href = `desve_consultar.html?id=${solicitationId}`;
    };

    // Drag and Drop for new files
    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('inputArchivosSolicitud');

    dropZone.onclick = () => fileInput.click();
    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('active'); };
    dropZone.ondragleave = () => dropZone.classList.remove('active');
    dropZone.ondrop = (e) => {
        e.preventDefault();
        dropZone.classList.remove('active');
        handleFiles(e.dataTransfer.files);
    };
    fileInput.onchange = (e) => handleFiles(e.target.files);

    if (window.feather) feather.replace();
});

let organizaciones = [];
let organizacionesDESVE = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let currentSolRegistroId = null;
let selectedFiles = []; // New files to add
let OrigenEspecial = false;
let destinos = []; // Array for multiple destinations
let modalBusqueda = null;
let contribuyentes = [];
let Solicitudes = [];

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, contribRes, tipoRes, prioRes, funcRes, secRes, solRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        contribuyentes = extractData(contribRes);
        organizacionesDESVE = extractData(orgResDESVE);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);
        Solicitudes = extractData(solRes);
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
    const IDorgSelect = document.getElementById('ID_Organizacion');
    IDorgSelect.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
    tiposOrganizacion.forEach(o => {
        const option = document.createElement('option');
        option.value = o.tor_id;
        option.innerText = o.tor_nombre;
        IDorgSelect.appendChild(option);
    });
    const ReingresoSelect = document.getElementById('Reingreso');
    ReingresoSelect.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
    Solicitudes.forEach(o => {
        const option = document.createElement('option');
        option.value = o.sol_id;
        option.innerText = o.sol_ingreso_desve + " - " + o.sol_nombre_expediente;
        ReingresoSelect.appendChild(option);
    });

    const secSelect = document.getElementById('Sector');
    secSelect.innerHTML = '<option value="" selected disabled>Seleccione sector...</option>';
    sectores.forEach(s => {
        const option = document.createElement('option');
        option.value = s.sec_id;
        option.innerText = s.sec_nombre;
        secSelect.appendChild(option);
    });
}

async function loadSolicitationDetails(id, currentUser) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM" })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            const sol = result.data;
            currentSolRegistroId = sol.sol_registro_tramite;
            let aux = sol.sol_responsable != String(currentUser.id) || sol.sol_responsable == null;
            if (aux) {
                aux = !Permisos.some(navlink => navlink === "paginas/desve_listado_ingresos.html");
            }
            if (aux) {
                await Swal.fire({
                    title: 'Acceso Denegado',
                    text: `Usted no es el funcionario responsable de esta solicitud.`,
                    icon: 'error',
                    confirmButtonText: 'Volver a Bandeja'
                });
                window.location.href = 'desve_listado_ingresos.html';
                return;
            }


            document.getElementById('header_public_id').innerText = `Modificar DESVE: ${sol.sol_ingreso_desve || sol.sol_id}`;
            document.getElementById('header_expediente').innerText = sol.sol_nombre_expediente || '';

            // Map Fields
            document.getElementById('idIngreso').value = sol.sol_id;
            document.getElementById('Codigo_DESVE').value = sol.sol_ingreso_desve || '';
            document.getElementById('Reingreso').value = sol.sol_reingreso_id || '';
            //document.getElementById('IngresoDesve').value = sol.sol_ingreso_desve || '';
            document.getElementById('NombreExpediente').value = sol.sol_nombre_expediente || '';

            // Resolve Organization Type and Origen
            let orgList = [];
            let org = {};
            switch (parseInt(sol.sol_origen_esp)) {
                case 0:
                    orgList = organizaciones;
                    org = orgList.find(o => o.org_id == sol.sol_origen_id);
                    break;
                case 1:
                    orgList = organizacionesDESVE;
                    org = orgList.find(o => o.org_id == sol.sol_origen_id);
                    break;
                case 2:
                    orgList = organizacionesDESVE;
                    org = orgList.find(o => o.org_id == sol.sol_origen_id);
                    break;
                default:
                    OrigenEspecial = false;
            }

            if (org) {
                document.getElementById('ID_Organizacion').value = org.org_tipo_id;
                handleTipoOrgChange(); // Populate OrigenSolicitud based on Type
                document.getElementById('OrigenSolicitud').value = sol.sol_origen_id;
            }

            document.getElementById('FechaUltimaRecepcion').value = sol.sol_fecha_recepcion?.split(' ')[0] || '';
            document.getElementById('Sector').value = sol.sol_sector_id || '';

            document.getElementById('DetalleIngreso').value = sol.sol_detalle || '';
            document.getElementById('Observaciones').value = sol.sol_observaciones || '';

            // Status
            if (sol.sol_estado_entrega == 1) {
                document.getElementById('estadoRespondido').checked = true;
            } else {
                document.getElementById('estadoPendiente').checked = true;
            }// 1. Lógica para Días Transcurridos (desde la recepción hasta hoy)
            const calcularTranscurridos = () => {
                if (!sol.sol_fecha_recepcion) return 0;
                const fecha_recep = new Date(sol.sol_fecha_recepcion.replace(/-/g, '/')); // replace para mejor compatibilidad
                const hoy = new Date();
                // Normalizamos a medianoche para comparar solo días
                const inicio = new Date(fecha_recep.getFullYear(), fecha_recep.getMonth(), fecha_recep.getDate());
                const fin = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

                const diff = fin - inicio;
                return Math.max(0, Math.floor(diff / (1000 * 60 * 60 * 24)));
            };

            // 2. Lógica para Días de Vencimiento (desde hoy hasta el vencimiento)
            const calcularVencimiento = () => {
                if (!sol.sol_fecha_vencimiento) return 0;
                const fecha_vence = new Date(sol.sol_fecha_vencimiento.replace(/-/g, '/'));
                const hoy = new Date();

                const fin = new Date(fecha_vence.getFullYear(), fecha_vence.getMonth(), fecha_vence.getDate());
                const inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

                const diff = fin - inicio;
                // Aquí no usamos Math.max porque si es negativo significa que YA ESTÁ VENCIDO
                return Math.floor(diff / (1000 * 60 * 60 * 24));
            };

            // 3. Asignación al DOM
            // Usamos el cálculo solo si el valor del JSON es "0" o null
            document.getElementById('info_dias_ingreso').value =
                (sol.sol_dias_transcurridos && sol.sol_dias_transcurridos !== "0")
                    ? sol.sol_dias_transcurridos
                    : calcularTranscurridos();

            document.getElementById('info_dias_vencimiento').value =
                (sol.sol_dias_vencimiento && sol.sol_dias_vencimiento !== "0")
                    ? sol.sol_dias_vencimiento
                    : calcularVencimiento();
            document.getElementById('Prioridad').value = sol.sol_prioridad_id;
            document.getElementById('FechaVecimiento').value = sol.sol_fecha_vencimiento;
            document.getElementById('Responsable').value = sol.sol_responsable;
            document.getElementById('Reingresado').value = sol.sol_reingreso_id;
            destinos = sol.destinos || [];
            renderDestinos();
            renderResponseBitacora(sol.respuestas || []);
            loadExistingDocuments();

        }
    } catch (e) {
        console.error("Load Details Error:", e);
    }
}


function handleTipoOrgChange() {
    const idOrgId = document.getElementById('ID_Organizacion').value;
    if (!idOrgId) return;

    const orgSelect = document.getElementById('OrigenSolicitud');
    const btnNuevoOrigen = document.getElementById('btn_nuevo_origen');
    orgSelect.innerHTML = '<option value="" selected disabled>Seleccione organización...</option>';

    // Determine priority
    const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
    const ORG_PRIO = selectedTipo ? selectedTipo.tor_prioridad_id : "";

    // Conditional logic based on organization type
    if (idOrgId == "1" || idOrgId == "2") {
        // Territorial (1) or Funcional (2) -> Use Organizaciones Comunitarias
        OrigenEspecial = 0; // Normal
        btnNuevoOrigen.disabled = true;
        btnNuevoOrigen.onclick = null;
        orgSelect.disabled = false; // Enable dropdown

        organizacionesComunitarias.forEach(o => {
            if (o.orgc_tipo_organizacion == idOrgId) {
                const option = document.createElement('option');
                option.value = `OC_${o.orgc_id}`; // Prefix to identify source
                option.innerText = o.orgc_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else if (idOrgId == "3" || idOrgId == "5") {
        // Particular (3) or Ley Transparencia (5) -> Use Contributor Search
        OrigenEspecial = 1; // Special/Transparency
        btnNuevoOrigen.disabled = false;
        btnNuevoOrigen.onclick = () => abrirModalBuscarContribuyente();
        orgSelect.disabled = true; // Disable dropdown, use search instead
    } else if (["4", "6", "7"].includes(idOrgId)) {
        // Special Origins (Concejales, Contraloría, Congreso)
        OrigenEspecial = 2; // Super Special
        btnNuevoOrigen.disabled = false;
        btnNuevoOrigen.onclick = () => {
            const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
            modal.show();
        };
        orgSelect.disabled = false;

        organizacionesDESVE.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else {
        // Default: Use general organizations
        OrigenEspecial = 0;
        btnNuevoOrigen.disabled = true;
        btnNuevoOrigen.onclick = null;
        orgSelect.disabled = false;

        organizaciones.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    }

    // Set priority and calculate expiration
    const prio = prioridades.find(p => p.pri_id == ORG_PRIO);
    if (prio) {
        document.getElementById('Prioridad').value = prio.pri_id;
        calculateVencimiento(parseInt(prio.pri_tiempo_establecido) || 0);
    }
}

// Update Priority based on Tipo
const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
if (selectedTipo) {
    const prio = prioridades.find(p => p.pri_id == selectedTipo.tor_prioridad_id);
    if (prio) {
        document.getElementById('Prioridad').value = prio.pri_id;
        // Note: Recalculating vencimiento on edit might or might not be desired. 
        // In DESVE it seems we allow it if date or org changes.
        if (prio.pri_tiempo_establecido) calculateVencimiento(parseInt(prio.pri_tiempo_establecido));
    }
}


function calculateVencimiento(days) {
    const fechaIngresoValue = document.getElementById('FechaUltimaRecepcion').value;
    if (!fechaIngresoValue) return;

    let date = new Date(fechaIngresoValue);
    let count = 0;
    while (count < days) {
        date.setDate(date.getDate() + 1);
        if (date.getDay() !== 0 && date.getDay() !== 6) count++;
    }
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    document.getElementById('FechaVecimiento').value = `${year}-${month}-${day} 00:00:00`;
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedFiles.push({ nombre: file.name, base64: e.target.result });
            renderFileList();
        };
        reader.readAsDataURL(file);
    });
}

function renderFileList() {
    const listContainer = document.getElementById('listaArchivosSolicitud');
    listContainer.innerHTML = '';
    selectedFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-1 border rounded';
        item.innerHTML = `
            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus text-success me-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="14 2 14 9 20 9"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
            <span class="small">${file.nombre}</span></div>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFile(${index})"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
        `;
        listContainer.appendChild(item);
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    renderFileList();
}

async function loadExistingDocuments() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/documentos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: currentSolRegistroId }),
            credentials: 'include'
        });
        const result = await response.json();
        const container = document.getElementById('lista_documentos_guardados');
        container.innerHTML = '';
        if (result.status === 'success' && result.data) {
            result.data.forEach(doc => {
                const item = `
                    <div class="list-group-item d-flex justify-content-between align-items-center bg-light mb-1 border rounded">
                        <span class="small text-truncate" style="max-width: 80%;">${doc.doc_nombre_documento}</span>
                        <span class="badge bg-secondary">En server</span>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', item);
            });
        }
    } catch (e) {
        console.error(e);
    }
}

function renderResponseBitacora(respuestas) {
    const tbody = document.getElementById('tbody_respuestas');
    tbody.innerHTML = '';
    respuestas.forEach(r => {
        const func = funcionarios.find(f => f.fnc_id == r.res_funcionario || f.usr_id == r.res_funcionario);
        const name = func ? `${func.fnc_nombre} ${func.fnc_apellido}` : (r.res_funcionario || 'N/A');
        const row = `
            <tr>
                <td>${r.res_fecha.substring(0, 10)}</td>
                <td>${name}</td>
                <td><span class="badge ${r.res_tipo === 'Respuesta Final' ? 'bg-success' : 'bg-info'}">${r.res_tipo}</span></td>
                <td class="small">${r.res_texto}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

async function actualizarSolicitud() {
    const body = {
        sol_id: document.getElementById('idIngreso').value,
        sol_ingreso_desve: document.getElementById('Codigo_DESVE').value,
        sol_reingreso_id: document.getElementById('Reingreso').value,
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_origen_id: document.getElementById('OrigenSolicitud').value,
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: document.getElementById('FechaUltimaRecepcion').value + ' 00:00:00',
        sol_prioridad_id: document.getElementById('Prioridad').value,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: document.getElementById('FechaVecimiento').value,
        sol_estado_entrega: document.getElementById('estadoRespondido').checked,
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_responsable: document.getElementById('Responsable').value || null,
        destinos: destinos,
        sol_origen_esp: OrigenEspecial,
        documentos: selectedFiles,
        ACCION: "ACTUALIZAR"
    };

    try {
        Swal.fire({ title: 'Actualizando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
            credentials: 'include'
        });
        const result = await response.json();
        if (result.status === 'success') {
            await Swal.fire('Éxito', "Actualizado con éxito", 'success');
            window.location.href = `desve_consultar.html?id=${body.sol_id}`;
        } else {
            Swal.fire('Error', result.message || "Error al actualizar", 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', "Error de conexión.", 'error');
    }
}

window.guardarOrigenEspecial = async function () {
    const texto = document.getElementById('textoNuevoOrigenEspecial').value.trim();
    const idTipo = document.getElementById('ID_Organizacion').value;
    if (!texto) return;
    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CREAR", org_tipo_id: idTipo, org_nombre: texto })
        });
        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoOrigenEspecial').value = '';
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoOrigenEspecial')).hide();
            // Reload organizations
            const orgResDESVE = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: "CONSULTAM" })
            }).then(r => r.json());
            organizacionesDESVE = extractData(orgResDESVE);
            handleTipoOrgChange();
            Swal.fire('Éxito', 'Origen especial guardado.', 'success');
        }
    } catch (e) { console.error(e); }
};

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="sol_id">ID Interno (DESVE)</option>
                    <option value="rgt_id_publica" selected>Cód. Público (Ej: 260123-1349-D4)</option>
                    <option value="rgt_id">ID Trámite (RGT)</option>
                </select>
            </div>
            <div class="mb-2 text-start">
                <label class="form-label small fw-bold">Valor:</label>
                <input id="swal-id-value" class="form-control" placeholder="Ingrese el valor...">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Volver a Bandeja',
        allowOutsideClick: false,
        preConfirm: () => {
            const type = document.getElementById('swal-id-type').value;
            const value = document.getElementById('swal-id-value').value.trim();
            if (!value) {
                Swal.showValidationMessage('¡Debe ingresar un valor!');
                return false;
            }
            return { type, value };
        }
    });

    if (!formValues) {
        window.location.href = 'desve_listado_ingresos.html';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        const payload = { ACCION: 'CONSULTAM' };
        if (type === 'sol_id') payload.sol_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];

            if (results.length > 0 && results[0].sol_id) {
                const foundId = results[0].sol_id;
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('id', foundId);
                window.location.href = newUrl.toString();
            } else {
                Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                    solicitarID();
                });
            }
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                solicitarID();
            });
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}

function renderDestinos() {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    if (!destinos || destinos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted small">Sin destinatarios.</td></tr>';
        return;
    }

    destinos.forEach(d => {

        // Fallback if joined fields are missing (should be present from backend query)
        const name = d.usr_nombre_completo || 'Desconocido';
        // const email = d.usr_email || '-'; // Assuming email might be available in future or via join

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${name}</td>
            <td>${d.usr_email || '-'}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeDestino(${d.tid_destino})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather 
                    feather-trash-2" style="width:14px">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        if (!d.usr_id) {
            d.usr_id = d.tid_destino;
        }
    });
}
async function removeDestino(id) {
    aux = [];
    destinos.forEach(d => {
        if (d.tid_destino != id) {
            aux.push(d);
        }
    });
    destinos = aux;
    renderDestinos();
}


// Modal & Officials logic
function abrirModalBuscarFuncionario() {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    funcionarios.forEach(f => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>${f.fnc_nombre || '-'}</td>
            <td>${f.fnc_apellido || '-'}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarFuncionario('${f.fnc_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroFuncionario').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    modalBusqueda.show();
}

window.seleccionarFuncionario = function (id) {
    const f = funcionarios.find(x => x.fnc_id == id);
    if (f) {
        const nombreCompleto = `${f.fnc_nombre || ''} ${f.fnc_apellido || ''}`.trim();

        // Add directly to destinos array
        destinos.push({
            tid_destino: f.fnc_id,
            tid_desve_solicitud: f.fnc_id,
            tid_fecha_respuesta: null,
            tid_id: f.fnc_id,
            tid_responde: null,
            usr_id: f.fnc_id,
            usr_apellido: f.fnc_apellido,
            usr_email: f.fnc_email,
            usr_nombre: f.fnc_nombre,
            usr_nombre_completo: nombreCompleto
        });

        renderDestinos();
    }
    modalBusqueda.hide();
};

// Contributor Search and Creation Functions
window.abrirModalBuscarContribuyente = function () {
    const tbody = document.getElementById('lista_busqueda_contrib');
    tbody.innerHTML = '';

    contribuyentes.forEach(c => {
        const nombreCompleto = `${c.tgc_nombre || ''} ${c.tgc_apellido_paterno || ''} ${c.tgc_apellido_materno || ''}`.trim();
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${c.tgc_rut || '-'}</td>
            <td>${nombreCompleto}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarContribuyente('${c.tgc_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroContribuyente').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    const modal = new bootstrap.Modal(document.getElementById('modalBuscarContribuyente'));
    modal.show();
};

window.seleccionarContribuyente = function (id) {
    const c = contribuyentes.find(x => x.tgc_id == id);
    if (c) {
        const orgSelect = document.getElementById('OrigenSolicitud');
        orgSelect.disabled = false;
        orgSelect.innerHTML = `<option value="${c.tgc_id}" selected>${c.tgc_nombre} ${c.tgc_apellido_paterno} ${c.tgc_apellido_materno} (${c.tgc_rut})</option>`;
    }
    bootstrap.Modal.getInstance(document.getElementById('modalBuscarContribuyente')).hide();
};

window.abrirModalNuevoContribuyente = function () {
    // Close search modal first
    const searchModal = bootstrap.Modal.getInstance(document.getElementById('modalBuscarContribuyente'));
    if (searchModal) searchModal.hide();

    // Reset form
    document.getElementById('form_nuevo_contribuyente').reset();

    // Add RUT formatting
    const rutInput = document.getElementById('nc_rut');
    rutInput.onchange = function () {
        this.value = formatRut(this.value);
    };

    const modal = new bootstrap.Modal(document.getElementById('modalNuevoContribuyente'));
    modal.show();
};

window.guardarNuevoContribuyente = async function () {
    const form = document.getElementById('form_nuevo_contribuyente');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const payload = {
        ACCION: 'CREAR',
        tgc_rut: document.getElementById('nc_rut').value,
        tgc_nombre: document.getElementById('nc_nombre').value,
        tgc_apellido_paterno: document.getElementById('nc_paterno').value,
        tgc_apellido_materno: document.getElementById('nc_materno').value
    };

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const result = await response.json();

        if (result.status === 'success') {
            // Reload contributors
            const contribRes = await fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }).then(r => r.json());

            contribuyentes = extractData(contribRes);

            bootstrap.Modal.getInstance(document.getElementById('modalNuevoContribuyente')).hide();
            Swal.fire('Éxito', 'Contribuyente creado correctamente.', 'success');

            // Reopen search modal
            setTimeout(() => abrirModalBuscarContribuyente(), 300);
        } else {
            Swal.fire('Error', result.message || 'Error al guardar', 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
};
