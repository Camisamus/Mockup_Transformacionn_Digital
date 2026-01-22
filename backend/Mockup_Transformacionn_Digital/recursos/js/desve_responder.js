let currentSol = null;
let currentUser = null;

let organizaciones = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let responseFiles = [];
let existingFiles = [];

function handleFileSelect(type) {
    const inputId = 'inputArchivosRespuesta';
    const input = document.getElementById(inputId);
    const files = Array.from(input.files);

    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const fileData = {
                nombre: file.name,
                base64: e.target.result
            };
            responseFiles.push(fileData);
            renderFileList();
        };
        reader.readAsDataURL(file);
    });
    input.value = ''; // Reset input
}

function removeFile(index) {
    responseFiles.splice(index, 1);
    renderFileList();
}

function renderFileList() {
    const listId = 'listaArchivosRespuesta';
    const listContainer = document.getElementById(listId);
    listContainer.innerHTML = '';

    // Render Existing Files (Saved)
    if (existingFiles.length > 0) {
        existingFiles.forEach(file => {
            const item = document.createElement('div');
            item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-light';
            item.innerHTML = `
                <div>
                <i data-feather="file" style="width:16px;"></i>
                <span class="ms-2 small">${file.doc_nombre_documento || 'Sin Nombre'}</span>
                <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">Guardado</span>
                </div>
                <div>
                     <button class="btn btn-sm btn-link text-primary p-0 me-2" onclick="descargarDocumento('${file.doc_id}', '${file.doc_nombre_documento}')" title="Descargar">
                        <i data-feather="download" style="width:16px;"></i>
                    </button>
                </div>
            `;
            if (file.doc_docdigital == 1) {
                item.innerHTML = `
                <div>
                <i data-feather="file" style="width:16px;"></i>
                <span class="ms-2 small">${file.doc_nombre_documento || 'Sin Nombre'}</span>
                <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">Guardado</span>
                </div>
                <div>
                     <a href="${file.doc_enlace_documento}" target="_blank" title="Ver">
                        <i data-feather="download" style="width:16px;"></i>
                    </a>
                </div>
            `;

            }
            listContainer.appendChild(item);
        });
    }

    // Render New Response Files
    responseFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';

        item.innerHTML = `
            <div>
               <i data-feather="file-plus" style="width:16px;" class="text-success"></i>
               <span class="ms-2">${file.nombre || file.name}</span>
               <span class="badge bg-info text-dark ms-2" style="font-size: 0.7rem;">Nuevo</span>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removeFile(${index})">
                <i data-feather="x" style="width:16px;"></i>
            </button>
        `;
        listContainer.appendChild(item);
    });

    if (window.feather) feather.replace();
}

async function uploadFiles(solicitationId, fileList, isDocDigital = 0) {
    if (fileList.length === 0) return true;

    let errors = 0;

    for (const file of fileList) {
        const formData = new FormData();
        formData.append('ACCION', 'Subir');
        formData.append('tramite_id', solicitationId);
        formData.append('responsable_id', currentUser.id);
        formData.append('es_docdigital', isDocDigital);
        formData.append('doc_nombre_documento', file.name);
        formData.append('archivo', file);

        try {
            const response = await fetch(`${window.API_BASE_URL}/documentos.php`, {
                method: 'POST',
                body: formData,
                credentials: 'include',
            });
            const result = await response.json();
            if (result.status !== 'success') {
                console.error("Error uploading file:", file.name, result);
                errors++;
            }
        } catch (e) {
            console.error("Network error uploading file:", file.name, e);
            errors++;
        }
    }

    return errors === 0;
}

async function descargarDocumento(Id, nombre) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/documentos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'Bajar', ID: Id }),
            credentials: 'include'
        });

        // Verificamos si la respuesta es exitosa
        if (!response.ok) throw new Error('Error en la respuesta del servidor');

        // REVISAMOS EL TIPO DE CONTENIDO
        const contentType = response.headers.get("content-type");

        if (contentType && contentType.includes("application/json")) {
            // Si es JSON, es porque el PHP mandó un error (ej. Archivo no encontrado)
            const result = await response.json();
            Swal.fire('Error', result.message || 'No se pudo descargar.', 'error');
        } else {
            // SI NO ES JSON, ES EL ARCHIVO BINARIO (PDF)
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);

            // Creamos el enlace de descarga temporal
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = nombre;// El nombre se puede mejorar capturando headers
            document.body.appendChild(a);
            a.click();

            // Limpieza
            window.URL.revokeObjectURL(url);
            a.remove();
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de red o de procesamiento.', 'error');
    }
}


document.addEventListener('DOMContentLoaded', async function () {
    // Detect API_BASE_URL (logic from layout_manager or fallback)
    if (!window.API_BASE_URL) {
        const path = window.location.pathname;
        const backendIdx = path.indexOf('/backend/');
        if (backendIdx !== -1) {
            window.API_BASE_URL = window.location.origin + path.substring(0, backendIdx) + '/backend/api';
        } else {
            window.API_BASE_URL = window.location.origin + '/api';
        }
    }

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const loadingDiv = document.getElementById('loading-check');
    const containerDiv = document.getElementById('step-2');

    if (!id) {
        setTimeout(async () => {
            const { value: manualId } = await Swal.fire({
                title: 'ID de Solicitud Requerido',
                text: 'Por favor ingrese el ID de la solicitud para continuar:',
                input: 'text',
                inputPlaceholder: 'Ej: 123',
                showCancelButton: true,
                confirmButtonText: 'Continuar',
                cancelButtonText: 'Ir a Bandeja',
                allowOutsideClick: false,
                inputValidator: (value) => {
                    if (!value) {
                        return '¡Debe ingresar un ID!';
                    }
                }
            });

            if (manualId) {
                window.location.search = `?id=${manualId}`;
                return;
            } else {
                window.location.href = 'desve_listado_ingresos.html';
                return;
            }
        }, 120);
        return;
    }

    try {
        // 1. Verify Session & Load Initial Data
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
            window.location.href = 'desve_listado_ingresos.html';
            return;
        }
        currentUser = sessionData.user;

        // Load Lookups
        await loadLookups();

        // 2. Load Solicitud Data
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_DESVE.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM", ver_clave: true })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            currentSol = result.data;

            // 3. Security Check
            if (String(currentSol.sol_funcionario_id) !== String(currentUser.id)) {
                await Swal.fire({
                    title: 'ACCESO DENEGADO',
                    text: `Esta solicitud está asignada al funcionario #${currentSol.sol_funcionario_id}.`,
                    icon: 'error',
                    confirmButtonText: 'Volver a Bandeja'
                });
                window.location.href = 'desve_listado_ingresos.html';
                return;
            }

            loadingDiv.classList.add('d-none');
            containerDiv.classList.remove('d-none');
            renderSolicitationInfo();
            renderResponseBitacora(currentSol.respuestas || []);
            renderComments(currentSol.comentarios || []);

            // Comment modal handler
            document.getElementById('btn_abrir_comentario').onclick = () => {
                const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
                modal.show();
            };

            if (window.feather) feather.replace();

            // Fetch Existing Documents
            try {
                const docResponse = await fetch(`${window.API_BASE_URL}/documentos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: currentSol.sol_registro_tramite }),
                    credentials: 'include'
                });
                const docResult = await docResponse.json();
                if (docResult.status === 'success') {
                    existingFiles = docResult.data || [];
                    renderFileList();
                }
            } catch (e) {
                console.error("Error fetching documents:", e);
            }

            // Attach Save Response listener
            const btnSave = document.getElementById('btn-save-response');
            if (btnSave) {
                btnSave.onclick = saveResponse;
            } else {
                console.error("No se encontró el botón #btn-save-response");
            }

        } else {
            await Swal.fire({
                title: 'Error',
                text: 'No se encontró la solicitud o hubo un error.',
                icon: 'error',
                confirmButtonText: 'Volver'
            });
        }

    } catch (e) {
        console.error("Error loading data:", e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
});


async function loadLookups() {
    const fetchOptions = {
        method: 'POST',
        credentials: 'include',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ACCION: "CONSULTAM" })
    };
    try {
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
        console.error("Error loading lookups:", e);
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

function renderSolicitationInfo() {
    if (!currentSol) return;

    document.getElementById('display-id').innerText = currentSol.sol_id;
    document.getElementById('display-desve').innerText = currentSol.sol_ingreso_desve || 'N/A';
    document.getElementById('display-expediente').innerText = currentSol.sol_nombre_expediente;
    document.getElementById('display-recepcion').innerText = currentSol.sol_fecha_recepcion ? currentSol.sol_fecha_recepcion.split(' ')[0] : '-';
    document.getElementById('display-detalle').innerText = currentSol.sol_detalle || 'Sin detalle';

    // Map Names
    const org = organizaciones.find(o => o.org_id == currentSol.sol_origen_id);
    document.getElementById('display-org-nombre').innerText = org ? org.org_nombre : '-';

    if (org) {
        const tipo = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id);
        document.getElementById('display-org-tipo').innerText = tipo ? tipo.tor_nombre : '-';
    }

    const prio = prioridades.find(p => p.pri_id == currentSol.sol_prioridad_id);
    document.getElementById('display-prioridad').innerText = prio ? prio.pri_nombre : '-';

    const sec = sectores.find(s => s.sec_id == currentSol.sol_sector_id);
    document.getElementById('display-sector').innerText = sec ? sec.sec_nombre : '-';

    // Days calculation (Calendar for elapsed, Business for remaining)
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // Elapsed
    if (currentSol.sol_creacion) {
        const creationDate = new Date(currentSol.sol_creacion);
        creationDate.setHours(0, 0, 0, 0);
        const diffIng = Math.floor((today - creationDate) / (1000 * 60 * 60 * 24));
        document.getElementById('display-dias-ingreso').innerText = `${Math.max(0, diffIng)} días`;
    }

    // Remaining (Business)
    if (currentSol.sol_fecha_vencimiento) {
        const vencDate = new Date(currentSol.sol_fecha_vencimiento);
        vencDate.setHours(0, 0, 0, 0);
        const businessDays = getBusinessDaysDifference(today, vencDate);
        const displayVenc = document.getElementById('display-dias-vencimiento');
        displayVenc.innerText = `${businessDays} días hábiles`;
        if (businessDays < 0) displayVenc.classList.add('text-danger');
        else if (businessDays <= 2) displayVenc.classList.add('text-warning');
        else displayVenc.classList.add('text-success');
    }
}

function getBusinessDaysDifference(startDate, endDate) {
    let count = 0;
    let curDate = new Date(startDate.getTime());
    const targetDate = new Date(endDate.getTime());
    const isForward = targetDate >= curDate;

    if (curDate.getTime() === targetDate.getTime()) return 0;

    while (isForward ? curDate < targetDate : curDate > targetDate) {
        if (isForward) curDate.setDate(curDate.getDate() + 1);
        else curDate.setDate(curDate.getDate() - 1);

        const day = curDate.getDay();
        if (day !== 0 && day !== 6) { // Not Sat/Sun
            count += (isForward ? 1 : -1);
        }
    }
    return count;
}

function renderResponseBitacora(respuestas) {
    const tbody = document.getElementById('bitacora-respuestas-body');
    if (!tbody) return;

    if (!respuestas || respuestas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-3 text-muted">No hay respuestas registradas</td></tr>';
        return;
    }

    tbody.innerHTML = '';
    respuestas.forEach(r => {
        const fecha = new Date(r.res_fecha).toLocaleString();
        const func = funcionarios.find(f => f.fnc_id == r.res_funcionario || f.usr_id == r.res_funcionario);
        const nombreFunc = func ? `${func.fnc_nombre} ${func.fnc_apellido}` : `Usuario #${r.res_funcionario}`;
        const tipoBadge = `<span class="badge ${r.res_tipo === 'Respuesta Final' || r.res_tipo === 'Definitiva' ? 'bg-success' : 'bg-info'}">${r.res_tipo}</span>`;

        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${fecha}</td>
                <td>${nombreFunc}</td>
                <td>${tipoBadge}</td>
                <td class="small">${r.res_texto}</td>
            </tr>
        `);
    });
}

function renderComments(commentsArray) {
    const container = document.getElementById('comentarios-container');
    if (!container) return;

    if (!commentsArray || commentsArray.length === 0) {
        container.innerHTML = '<div class="alert alert-info py-2 small"><i data-feather="info" class="me-2" style="width: 14px;"></i> No hay comentarios registrados.</div>';
        if (window.feather) feather.replace();
        return;
    }

    let html = '<div class="list-group list-group-flush mb-4">';
    commentsArray.forEach(c => {
        const fecha = new Date(c.gco_fecha).toLocaleString();
        html += `
            <div class="list-group-item px-0 py-2 border-0 border-bottom">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <strong>${c.usr_nombre} ${c.usr_apellido}</strong>
                    <span>${fecha}</span>
                </div>
                <div class="small">${c.gco_comentario}</div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
}

async function guardarComentario() {
    console.log("guardarComentario() triggered");
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) {
        Swal.fire('Atención', 'Por favor escriba un comentario.', 'warning');
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                rgt_id: currentSol.sol_registro_tramite,
                gco_texto: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario'));
            modal.hide();

            // Refresh page data (cheap way) or just fetch again
            location.reload();
        } else {
            Swal.fire('Error', result.message || 'No se pudo guardar el comentario.', 'error');
        }
    } catch (e) {
        console.error("Error saving comment:", e);
    }
}

// Expose globally
window.guardarComentario = guardarComentario;

async function saveResponse(e) {
    if (e) e.preventDefault();
    console.log("saveResponse() triggered", e ? "with event" : "without event");

    console.log("State - currentUser:", currentUser);
    console.log("State - currentSol:", currentSol);

    if (!currentUser) {
        Swal.fire('Error', 'No se ha detectado la sesión del usuario. Intente recargar la página.', 'error');
        return;
    }
    const responseText = document.getElementById('input-respuesta').value.trim();
    const isDefinitiva = document.getElementById('check-respuesta-definitiva').checked;

    console.log("Input - responseText length:", responseText.length);
    console.log("Input - isDefinitiva:", isDefinitiva);

    if (!responseText) {
        Swal.fire('Atención', 'Por favor ingrese un contenido para la respuesta.', 'warning');
        return;
    }

    if (!currentSol) {
        Swal.fire("Error", "No hay solicitud activa.", "error");
        return;
    }

    const { isConfirmed } = await Swal.fire({
        title: "¿Está seguro?",
        text: "¿Desea guardar esta respuesta?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        cancelButtonColor: "#6c757d"
    });

    if (!isConfirmed) {
        console.log("Save cancelled by user.");
        return;
    }

    console.log("Proceeding to save with SweetAlert2...");

    try {
        // Show loading
        Swal.fire({
            title: 'Guardando...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const payload = {
            ACCION: "CREAR",
            res_solicitud_id: currentSol.sol_id,
            sol_reingreso_id: currentSol.sol_reingreso_id,
            res_texto: responseText,
            res_tipo: isDefinitiva ? 'Respuesta Final' : 'Comentario',
            res_funcionario: currentUser.id,
            documentos: responseFiles
        };

        console.log("Sending payload:", payload);

        const response = await fetch(`${window.API_BASE_URL}/respuestas_DESVE.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        console.log("API Result:", result);

        if (result.status === 'success' || result.success) {
            responseFiles = []; // Clear on success

            await Swal.fire("Guardado", "Respuesta guardada correctamente.", "success");
            window.location.href = 'desve_listado_ingresos.html';
        } else {
            Swal.fire("Error", `No se pudo guardar: ${result.message}`, "error");
        }
    } catch (e) {
        console.error("Error saving response:", e);
        Swal.fire("Error", "Error de conexión al guardar la respuesta.", "error");
    }
}

// Expose globally
window.saveResponse = saveResponse;
