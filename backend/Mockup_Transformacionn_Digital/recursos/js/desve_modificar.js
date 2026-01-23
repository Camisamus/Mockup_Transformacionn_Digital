document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    if (!solicitationId) {
        solicitarID();
        return;
    }

    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1/api';

    await loadInitialData();
    populateSelects();
    loadSolicitationDetails(solicitationId);

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

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, tipoRes, prioRes, funcRes, secRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        organizacionesDESVE = extractData(orgResDESVE);
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
    const IDorgSelect = document.getElementById('ID_Organizacion');
    IDorgSelect.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
    tiposOrganizacion.forEach(o => {
        const option = document.createElement('option');
        option.value = o.tor_id;
        option.innerText = o.tor_nombre;
        IDorgSelect.appendChild(option);
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

async function loadSolicitationDetails(id) {
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

            document.getElementById('header_public_id').innerText = `Modificar DESVE: ${sol.sol_ingreso_desve || sol.sol_id}`;
            document.getElementById('header_expediente').innerText = sol.sol_nombre_expediente || '';

            // Map Fields
            document.getElementById('idIngreso').value = sol.sol_id;
            document.getElementById('IngresoDesve').value = sol.sol_ingreso_desve || '';
            document.getElementById('NombreExpediente').value = sol.sol_nombre_expediente || '';

            // Resolve Organization Type and Origen
            OrigenEspecial = sol.sol_origen_esp == 1;
            const orgList = OrigenEspecial ? organizacionesDESVE : organizaciones;
            const org = orgList.find(o => o.org_id == sol.sol_origen_id);
            if (org) {
                document.getElementById('ID_Organizacion').value = org.org_tipo_id;
                handleTipoOrgChange(); // Populate OrigenSolicitud based on Type
                document.getElementById('OrigenSolicitud').value = sol.sol_origen_id;
            }

            document.getElementById('FechaUltimaRecepcion').value = sol.sol_fecha_recepcion?.split(' ')[0] || '';
            document.getElementById('Sector').value = sol.sol_sector_id || '';

            const func = funcionarios.find(f => f.fnc_id == sol.sol_funcionario_id);
            document.getElementById('FuncionarioInternoNombre').value = func ? `${func.fnc_nombre} ${func.fnc_apellido}` : (sol.sol_funcionario_id || '');
            document.getElementById('FuncionarioInternoId').value = sol.sol_funcionario_id || '';

            document.getElementById('DetalleIngreso').value = sol.sol_detalle || '';
            document.getElementById('Observaciones').value = sol.sol_observaciones || '';

            // Status
            if (sol.sol_estado_entrega == 1) {
                document.getElementById('estadoRespondido').checked = true;
            } else {
                document.getElementById('estadoPendiente').checked = true;
            }

            // Hidden / Read-only metrics
            document.getElementById('info_dias_ingreso').value = sol.sol_dias_transcurridos || 0;
            document.getElementById('info_dias_vencimiento').value = sol.sol_dias_vencimiento || 0;
            document.getElementById('Prioridad').value = sol.sol_prioridad_id;
            document.getElementById('FechaVecimiento').value = sol.sol_fecha_vencimiento;
            document.getElementById('Responsable').value = sol.sol_responsable;
            document.getElementById('Reingresado').value = sol.sol_reingreso_id;

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

    let idEsp = ["3", "4", "5", "6", "7"];
    const orgSelect = document.getElementById('OrigenSolicitud');
    orgSelect.innerHTML = '<option value="" selected disabled>Seleccione organización...</option>';

    // We determine OrigenEspecial based on the selected organization type in REAL TIME during change
    // but the initial state comes from the record. 
    // If user changes type, we might change the OrigenEspecial flag.
    const isNowSpecial = idEsp.includes(idOrgId);
    OrigenEspecial = isNowSpecial; // IMPORTANT: This updates the flag based on user choice

    const listToUse = isNowSpecial ? organizacionesDESVE : organizaciones;
    listToUse.forEach(o => {
        if (o.org_tipo_id == idOrgId) {
            const option = document.createElement('option');
            option.value = o.org_id;
            option.innerText = o.org_nombre;
            orgSelect.appendChild(option);
        }
    });

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
                <td>${r.res_fecha}</td>
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
        sol_ingreso_desve: document.getElementById('IngresoDesve').value,
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_origen_id: document.getElementById('OrigenSolicitud').value,
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: document.getElementById('FechaUltimaRecepcion').value + ' 00:00:00',
        sol_prioridad_id: document.getElementById('Prioridad').value,
        sol_funcionario_id: document.getElementById('FuncionarioInternoId').value,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: document.getElementById('FechaVecimiento').value,
        sol_estado_entrega: document.getElementById('estadoRespondido').checked,
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_reingreso_id: document.getElementById('Reingresado').value || null,
        sol_responsable: document.getElementById('Responsable').value || null,
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
