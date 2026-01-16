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
    //document.getElementById('OrigenSolicitud').addEventListener('change', handleOrgChange);
    document.getElementById('ID_Organizacion').addEventListener('change', handleTipoOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleTipoOrgChange);

    // Status change listener - Using 'change' is more reliable for radio buttons
    document.getElementById('estadoPendiente').addEventListener('change', () => handleStatusChange(0));
    document.getElementById('estadoRespondido').addEventListener('change', () => handleStatusChange(1));

    // Comment modal handler
    document.getElementById('btn_abrir_comentario').onclick = () => {
        if (!solicitationId) {
            Swal.fire('Atención', 'Debe guardar la solicitud antes de añadir comentarios adicionales.', 'warning');
            return;
        }
        const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
        modal.show();
    };

    // Initialize Feather
    if (window.feather) feather.replace();
});

let organizaciones = [];
let organizacionesDESVE = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let Solicitudes = [];
let Sol = [];
let OrigenEspecial = false;
let selectedFiles = []; // For main solicitation
let responseFiles = []; // For response modal
let existingFiles = []; // Loaded from server

function handleFileSelect(type) {
    const inputId = type === 'solicitud' ? 'inputArchivosSolicitud' : 'inputArchivosRespuesta';
    const input = document.getElementById(inputId);
    const newFiles = Array.from(input.files);

    if (type === 'solicitud') {
        selectedFiles = [...selectedFiles, ...newFiles];
        renderFileList('solicitud');
    } else {
        responseFiles = [...responseFiles, ...newFiles];
        renderFileList('respuesta');
    }
    input.value = ''; // Reset input
}

function renderFileList(type) {
    const listId = type === 'solicitud' ? 'listaArchivosSolicitud' : 'listaArchivosRespuesta';
    const listContainer = document.getElementById(listId);
    listContainer.innerHTML = '';

    // 1. Render Existing Files (Server-side) - Only for Solicitud logic usually
    if (type === 'solicitud') {
        existingFiles.forEach(file => {
            const item = document.createElement('div');
            item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-light';

            item.innerHTML = `
                <div>
                   <i data-feather="file" style="width:16px;"></i>
                   <a href="http://localhost/api/miDocumento.php?archivo=${file.doc_id}" class="text-decoration-none text-dark ms-2 small">
                       ${file.doc_nombre_documento || 'Sin Nombre'}
                   </a>
                   <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">Guardado</span>
                </div>
                 <div>
                    <a class="btn btn-sm btn-link text-primary p-0 me-2" href="http://localhost/api/miDocumento.php?archivo=${file.doc_id}" title="Descargar">
                        <i data-feather="download" style="width:16px;"></i>
                    </a>
                </div>
            `;
            // No remove button for existing files
            listContainer.appendChild(item);
        });
    }

    // 2. Render New Selected Files
    const filesToRender = type === 'solicitud' ? selectedFiles : responseFiles;

    filesToRender.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';

        item.innerHTML = `
            <div>
               <i data-feather="file-plus" style="width:16px;" class="text-success"></i>
               <span class="ms-2">${file.name}</span>
               <span class="badge bg-info text-dark ms-2" style="font-size: 0.7rem;">Nuevo</span>
            </div>
            <button class="btn btn-sm btn-outline-danger border-0" onclick="removeFile('${type}', ${index})">
                <i data-feather="x" style="width:16px;"></i>
            </button>
        `;
        listContainer.appendChild(item);
    });

    if (window.feather) feather.replace();
}

function removeFile(type, index) {
    if (type === 'solicitud') {
        selectedFiles.splice(index, 1);
    } else {
        responseFiles.splice(index, 1);
    }
    renderFileList(type);
}

async function uploadFiles(solicitationId, fileList, isDocDigital = 0) {
    if (fileList.length === 0) return true;

    // We process sequentially to avoid overwhelming or complex race conditions
    // In a more advanced setup, Promise.all could be used if backend handles concurrency well.
    let errors = 0;

    for (const file of fileList) {
        const formData = new FormData();
        formData.append('ACCION', 'Subir');
        formData.append('tramite_id', solicitationId);
        formData.append('responsable_id', document.getElementById('Responsable').getAttribute('data-user-id') || 1); // Fallback
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

async function descargarDocumento(Id) {
    // 1. Verificamos si la respuesta es correcta
    const res = await fetch(`${window.API_BASE_URL}/documentos.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ACCION: 'Bajar', ID: Id })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la descarga');
            }
            return response.blob(); // Convierte la respuesta a un Blob
        })
        .then(blob => {
            // Crea un URL temporal para el blob
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = nombreArchivo; // Nombre del archivo a descargar
            document.body.appendChild(a);
            a.click(); // Simula un clic para iniciar la descarga
            window.URL.revokeObjectURL(url); // Libera el URL
        })
        .catch(error => console.error('Hubo un problema:', error));

}

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, tipoRes, prioRes, funcRes, secRes, solRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
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

    // Organizations Select
    const IDorgSelect = document.getElementById('ID_Organizacion');
    IDorgSelect.innerHTML = '<option value="">Seleccione organización...</option>';
    tiposOrganizacion.forEach(o => {
        const option = document.createElement('option');
        option.value = o.tor_id;
        option.innerText = o.tor_nombre;
        IDorgSelect.appendChild(option);
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

function handleTipoOrgChange() {
    const idOrgId = document.getElementById('ID_Organizacion').value;
    //const org = organizaciones.find(o => o.org_id == orgId);
    let idEsp = ["3", "4", "5", "6", "7"]
    // Organizations Select
    const orgSelect = document.getElementById('OrigenSolicitud');
    orgSelect.innerHTML = '<option value="">Seleccione organización...</option>';
    if (!idEsp.includes(idOrgId)) {//debo validar si idesp incluye idorigin
        OrigenEspecial = false;
        document.getElementById('btn_nuevo_origen').disabled = true;
        organizaciones.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else {
        OrigenEspecial = true;
        document.getElementById('btn_nuevo_origen').disabled = false;
        organizacionesDESVE.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    }
    const prio = prioridades.find(p => p.pri_id == idOrgId);
    if (prio) {
        document.getElementById('Prioridad').value = prio.pri_nombre;
        calculateVencimiento(parseInt(prio.pri_tiempo_establecido) || 0);
    }

    //if (org) {
    //    const tipo = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id);
    //    if (tipo) {
    //        document.getElementById('ID_Organizacion').value = tipo.tor_nombre;
    //        const prio = prioridades.find(p => p.pri_id == tipo.tor_prioridad_id);
    //        if (prio) {
    //            document.getElementById('Prioridad').value = prio.pri_nombre;
    //            calculateVencimiento(parseInt(prio.pri_tiempo_establecido) || 0);
    //        }
    //    }
    //} else {
    //    document.getElementById('ID_Organizacion').value = '';
    //    document.getElementById('Prioridad').value = '';
    //}
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

    document.getElementById('FechaVecimiento').value = `${year}-${month}-${day}`;
    calculateElapsedDays();
}

function calculateElapsedDays() {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const fieldCreacion = document.getElementById('FechaCreacion').value;
    const fieldVencimiento = document.getElementById('FechaVecimiento').value;

    if (fieldCreacion) {
        const creationDate = new Date(fieldCreacion);
        creationDate.setHours(0, 0, 0, 0);
        // Elapsed = Today - Creation
        const diffIng = Math.floor((today - creationDate) / (1000 * 60 * 60 * 24));
        document.getElementById('DiasIngreso').value = Math.max(0, diffIng);
    }

    if (fieldVencimiento) {
        // Remaining = Vencimiento - Today (Business days)
        const vencDate = new Date(fieldVencimiento);
        vencDate.setHours(0, 0, 0, 0);

        const businessDays = getBusinessDaysDifference(today, vencDate);
        document.getElementById('DiasVencimiento').value = businessDays;
    }
}

function getBusinessDaysDifference(startDate, endDate) {
    let count = 0;
    let curDate = new Date(startDate.getTime());
    const targetDate = new Date(endDate.getTime());

    const isForward = targetDate >= curDate;

    // Direct difference if same day
    if (curDate.getTime() === targetDate.getTime()) return 0;

    while (isForward ? curDate < targetDate : curDate > targetDate) {
        if (isForward) {
            curDate.setDate(curDate.getDate() + 1);
        } else {
            curDate.setDate(curDate.getDate() - 1);
        }

        const day = curDate.getDay();
        if (day !== 0 && day !== 6) { // Not Sat/Sun
            count += (isForward ? 1 : -1);
        }
    }
    return count;
}

async function handleStatusChange(newStatus) {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    if (!solicitationId) return;

    const label = newStatus === 1 ? "RESPONDIDO" : "PENDIENTE";
    const currentStatus = newStatus === 1 ? 0 : 1; // Since it just changed

    const result_swal = await Swal.fire({
        title: '¿Está seguro?',
        text: `¿Desea cambiar el estado a ${label}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    });

    if (result_swal.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    sol_id: solicitationId,
                    sol_estado_entrega: newStatus === 1,
                    sol_entrego_coordinador: newStatus === 1,
                    ACCION: "ACTUALIZAR_ESTADO"
                }),
                credentials: 'include'
            });
            const result = await response.json();

            if (result.status === 'success') {
                // Update conformity field visually
                document.getElementById('EntregadoEnConformidad').value = (newStatus === 1 ? 'Sí' : 'No');
                // Refresh details to update bitácora and everything else
                loadSolicitationDetails(solicitationId);
            } else {
                Swal.fire('Error', "Error al actualizar estado: " + result.message, 'error');
                // Revert UI
                revertStatusUI(currentStatus);
            }
        } catch (e) {
            console.error("Status Update Error:", e);
            Swal.fire('Error', "Error de conexión al actualizar estado.", 'error');
            revertStatusUI(currentStatus);
        }
    } else {
        // Revert UI if cancelled
        revertStatusUI(currentStatus);
    }
}

function revertStatusUI(oldStatus) {
    if (oldStatus === 1) {
        document.getElementById('estadoRespondido').checked = true;
    } else {
        document.getElementById('estadoPendiente').checked = true;
    }
}

async function loadSolicitationDetails(id) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM", ver_clave: true })
        });
        const result = await response.json();

        Sol = null;
        if (result.status === 'success' && result.data) {
            Sol = result.data;
            currentSolRegistroId = Sol.sol_registro_tramite;
        } else {
            console.error("Solicitud not found or API error", result);
            return;
        }
        ocultos = document.querySelectorAll('.solo_consulta');
        ocultos.forEach(oculto => {
            oculto.classList.remove('solo_consulta');
        });
        document.getElementById('idIngreso').value = Sol.sol_id || '';
        document.getElementById('IngresoDesve').value = Sol.sol_ingreso_desve || '';
        document.getElementById('Reingresado').value = Sol.sol_reingreso_id || '-';
        if (Sol.sol_reingreso_id) {
            const func = Solicitudes.find(f => f.sol_id == Sol.sol_reingreso_id);
            if (func) {
                const nombreCompleto = `${func.sol_nombre_expediente || ''}`.trim();
                document.getElementById('ReingresadoNombre').value = nombreCompleto || 'Sin Nombre';
            } else {
                document.getElementById('ReingresadoNombre').value = 'ID: ' + Sol.sol_reingreso_id;
            }
        } else {
            document.getElementById('ReingresadoNombre').value = '';
        }
        document.getElementById('NombreExpediente').value = Sol.sol_nombre_expediente || '';

        // OrigenSolicitud is now a select mapping to sol_origen_id
        //handleOrgChange(); // Populate ID_Organizacion and Prioridad automatically
        for (let i = 0; i < organizaciones.length; i++) {
            if (organizaciones[i].org_id == Sol.sol_origen_id) {
                document.getElementById('ID_Organizacion').value = organizaciones[i].org_tipo_id || '';
                handleTipoOrgChange();
                break;
            }
        }
        document.getElementById('OrigenSolicitud').value = Sol.sol_origen_id || '';

        document.getElementById('FechaUltimaRecepcion').value = formatDateTimeForInput(Sol.sol_fecha_recepcion);
        document.getElementById('FechaCreacion').value = formatDateTimeForInput(Sol.sol_creacion);

        // Map priority if it was manually set or if it differs from the calculated one but it's likely better to let handleOrgChange do its thing 
        // unless the solicitation had an override. 
        // If solicitation has a specific priority, we can set it:
        if (Sol.sol_prioridad_id) {
            const prio = prioridades.find(p => p.pri_id == Sol.sol_prioridad_id);
            if (prio) document.getElementById('Prioridad').value = prio.pri_nombre;
        }

        document.getElementById('FuncionarioInternoId').value = Sol.sol_funcionario_id || '';
        if (Sol.sol_funcionario_id) {
            const func = funcionarios.find(f => f.fnc_id == Sol.sol_funcionario_id);
            if (func) {
                const nombreCompleto = `${func.fnc_nombre || ''} ${func.fnc_apellido || ''}`.trim();
                document.getElementById('FuncionarioInternoNombre').value = nombreCompleto || 'Sin Nombre';
            } else {
                document.getElementById('FuncionarioInternoNombre').value = 'ID: ' + Sol.sol_funcionario_id;
            }
        } else {
            document.getElementById('FuncionarioInternoNombre').value = '';
        }

        document.getElementById('Sector').value = Sol.sol_sector_id || '';

        // Show Responsable - look up the name from funcionarios using the ID
        if (Sol.sol_responsable) {
            document.getElementById('Responsable').setAttribute('data-user-id', Sol.sol_responsable);

            // Try to find the user in funcionarios list
            const responsableFunc = funcionarios.find(f => f.fnc_id == Sol.sol_responsable);
            if (responsableFunc) {
                const nombreCompleto = `${responsableFunc.fnc_nombre || ''} ${responsableFunc.fnc_apellido || ''}`.trim();
                document.getElementById('Responsable').value = nombreCompleto || `ID: ${Sol.sol_responsable}`;
            } else {
                // If not found in funcionarios, just show the ID
                document.getElementById('Responsable').value = `ID: ${Sol.sol_responsable}`;
            }
        } else {
            document.getElementById('Responsable').value = 'N/A';
            document.getElementById('Responsable').setAttribute('data-user-id', '');
        }

        document.getElementById('FechaVecimiento').value = formatDateTimeForInput(Sol.sol_fecha_vencimiento);
        document.getElementById('FechaRespuesta').value = formatDateTimeForInput(Sol.sol_fecha_respuesta_coordinador);

        document.getElementById('EntregadoEnConformidad').value = (Sol.sol_entrego_coordinador == 1 || Sol.sol_entrego_coordinador === true) ? 'Sí' : 'No';

        // Estado de entrega (Radio buttons)
        if (Sol.sol_estado_entrega == 1 || Sol.sol_estado_entrega === true) {
            document.getElementById('estadoRespondido').checked = true;
        } else {
            document.getElementById('estadoPendiente').checked = true;
        }

        document.getElementById('DiasIngreso').value = Sol.sol_dias_transcurridos || 0;
        document.getElementById('DiasVencimiento').value = Sol.sol_dias_vencimiento || 0;

        document.getElementById('DetalleIngreso').value = Sol.sol_detalle || '';
        document.getElementById('Observaciones').value = Sol.sol_observaciones || '';

        renderResponseBitacora(Sol.respuestas || []);
        renderAuditBitacora(Sol.bitacora || []);
        renderComments(Sol.comentarios || []);
        calculateElapsedDays();
        toggleFields(false, false);

        // Fetch Documents
        try {
            const docResponse = await fetch(`${window.API_BASE_URL}/documentos.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: id }),
                credentials: 'include'
            });
            const docResult = await docResponse.json();
            if (docResult.status === 'success') {
                existingFiles = docResult.data || [];
                renderFileList('solicitud');
            }
        } catch (e) {
            console.error("Error fetching documents:", e);
        }

        const btnOriginal = document.getElementById('btn_ingreso_original');
        if (Sol.sol_reingreso_id) {
            btnOriginal.classList.remove('d-none');
            btnOriginal.onclick = () => window.location.href = `?id=${Sol.sol_reingreso_id}`;
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
    return dateStr.split(' ')[0] || '';
}

function renderResponseBitacora(respuestasArray) {
    const tbody = document.querySelector('#tablaBitacora tbody');
    tbody.innerHTML = '';
    respuestasArray.forEach(r => {
        const fechaStr = r.res_fecha ? new Date(r.res_fecha).toLocaleString() : 'N/A';
        const tipoLabel = `<span class="badge ${r.res_tipo === 'Respuesta Final' ? 'bg-success' : 'bg-info'}">${r.res_tipo || 'Comentario'}</span>`;

        // Look up funcionario name
        let funcionarioNombre = 'N/A';
        if (r.res_funcionario) {
            // Try to find by fnc_id first, then by usr_id (in case the mapping is different)
            const func = funcionarios.find(f => f.fnc_id == r.res_funcionario || f.usr_id == r.res_funcionario);
            if (func) {
                const nombre = func.fnc_nombre || func.usr_nombre || '';
                const apellido = func.fnc_apellido || func.usr_apellido || '';
                funcionarioNombre = `${nombre} ${apellido}`.trim() || `ID: ${r.res_funcionario}`;
            } else {
                // Debug: log if not found
                console.warn(`Funcionario ID ${r.res_funcionario} not found in funcionarios array`, funcionarios);
                funcionarioNombre = `ID: ${r.res_funcionario}`;
            }
        }

        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${r.res_id}</td>
                <td>${funcionarioNombre}</td>
                <td>${fechaStr}</td>
                <td>${tipoLabel}</td>
                <td>${r.res_texto}</td>
            </tr>
        `);
    });
}

function renderAuditBitacora(bitacoraArray) {
    const body = document.getElementById('bitacora-body');
    if (!body) return;
    body.innerHTML = '';

    bitacoraArray.forEach(entry => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${new Date(entry.bit_fecha).toLocaleString()}</td>
            <td>${entry.usr_nombre} ${entry.usr_apellido}</td>
            <td>${entry.bit_evento}</td>
        `;
        body.appendChild(row);
    });
}

function renderComments(commentsArray) {
    const container = document.getElementById('comentarios-container');
    if (!container) return;

    if (commentsArray.length === 0) {
        container.innerHTML = '<div class="alert alert-info py-2 small mt-3"><i data-feather="info" class="me-2" style="width: 14px;"></i> No hay comentarios registrados.</div>';
        if (window.feather) feather.replace();
        return;
    }

    let html = '<div class="list-group list-group-flush mt-3">';
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
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    const texto = document.getElementById('textoNuevoComentario').value.trim();

    // We need the rgt_id from the current solicitation
    // In loadSolicitationDetails we should store it or use what's returned
    // currentSol.sol_registro_tramite

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
                rgt_id: currentSolRegistroId,
                gco_texto: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario'));
            modal.hide();
            // Refresh details to see new comment
            loadSolicitationDetails(solicitationId);
        } else {
            Swal.fire('Error', result.message || 'Error al guardar el comentario', 'error');
        }
    } catch (e) {
        console.error("Error saving comment:", e);
    }
}

async function guardarOrigenEspecial() {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    const texto = document.getElementById('textoNuevoOrigenEspecial').value;
    const ID_Organizacion = document.getElementById('ID_Organizacion').value;
    // We need the rgt_id from the current solicitation
    // In loadSolicitationDetails we should store it or use what's returned
    // currentSol.sol_registro_tramite

    if (!texto) {
        Swal.fire('Atención', 'Por favor ingrese un origen especial.', 'warning');
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                org_tipo_id: ID_Organizacion,
                org_nombre: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoOrigenEspecial').value = '';
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalNuevoOrigenEspecial'));

            const fetchOptions = {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: "CONSULTAM" })
            };
            const [orgResDESVE] = await Promise.all([
                fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json())
            ]);
            organizacionesDESVE = extractData(orgResDESVE);
            handleTipoOrgChange();
            modal.hide();
            // Refresh details to see new comment
            //loadSolicitationDetails(solicitationId);
        } else {
            Swal.fire('Error', result.message || 'Error al guardar el origen especial', 'error');
        }
    } catch (e) {
        console.error("Error saving comment:", e);
    }
}

function formatDateTimeForBackend(val) {
    if (!val) return null;
    // If it's just YYYY-MM-DD, append time
    if (val.length === 10) return val + ' 00:00:00';
    return val.replace('T', ' ') + ':00';
}

function getCurrentDateTimeLocal() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    return `${day}-${month}-${year}`;
}

async function guardarAtencion() {
    if (!validarFormularioAtencion()) {

        return;
    }
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
        sol_entrego_coordinador: document.getElementById('EntregadoEnConformidad').value === 'Sí',
        sol_fecha_respuesta_coordinador: formatDateTimeForBackend(document.getElementById('FechaRespuesta').value),
        sol_estado_entrega: document.getElementById('estadoRespondido').checked,
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_dias_transcurridos: parseInt(document.getElementById('DiasIngreso').value) || 0,
        sol_dias_vencimiento: parseInt(document.getElementById('DiasVencimiento').value) || 0,
        sol_reingreso_id: toNull(document.getElementById('Reingresado').value),
        sol_responsable: document.getElementById('Responsable').getAttribute('data-user-id') || null,
        sol_oigen_esp: OrigenEspecial,
        ACCION: isUpdate ? "ACTUALIZAR" : "CREAR"
    };

    const url = isUpdate ? `${window.API_BASE_URL}/solicitudes_desve.php?id=${solicitationId}` : `${window.API_BASE_URL}/solicitudes_desve.php`;

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

            // Upload Files
            const targetId = isUpdate ? solicitationId : result.id;
            if (selectedFiles.length > 0) {
                // Swal.fire({ title: 'Subiendo archivos...', didOpen: () => Swal.showLoading() });
                const uploadSuccess = await uploadFiles(targetId, selectedFiles);
                if (!uploadSuccess) {
                    await Swal.fire('Atención', 'Se guardó la solicitud pero hubo errores al subir algunos archivos.', 'warning');
                } else {
                    selectedFiles = []; // Clear on success
                }
            }

            await Swal.fire('Éxito', isUpdate ? "Actualizado con éxito" : "Creado con éxito", 'success');

            // Reload page to show the saved/updated record
            if (isUpdate) {
                window.location.href = `?id=${solicitationId}`;
            } else if (result.id !== 'undefined') {
                window.location.href = `?id=${result.id}`;
            }
        } else {
            Swal.fire('Error', "Error al guardar: " + (result.message || "Error desconocido"), 'error');
        }
    } catch (e) {
        console.error("Save Error:", e);
        Swal.fire('Error', "Error de conexión al guardar.", 'error');
    }
}

async function eliminarAtencion() {
    if (!solicitationId) {
        Swal.fire('Atención', "No hay una solicitud cargada para eliminar.", 'warning');
        return;
    }

    const result_del = await Swal.fire({
        title: '¿Está seguro?',
        text: "¿Está seguro de eliminar esta solicitud?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (!result_del.isConfirmed) return;

    try {
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: solicitationId, ACCION: "BORRAR" })
        });
        const result = await response.json();

        if (result.status === 'success') {
            await Swal.fire('Eliminado', "Eliminado con éxito", 'success');
            window.location.href = 'desve_nuevo_ingreso.html';
        } else {
            Swal.fire('Error', "Error al eliminar: " + (result.message || "Error desconocido"), 'error');
        }
    } catch (e) {
        console.error("Delete Error:", e);
        Swal.fire('Error', "Error de conexión al eliminar.", 'error');
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


function abrirModalReingresado() {
    const tbody = document.querySelector('#tablaReingresados tbody');
    tbody.innerHTML = '';
    Solicitudes.forEach(f => {
        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td>${f.sol_id || '-'}</td>
                <td>${f.sol_nombre_expediente || '-'}</td>
                <td><button class="btn btn-sm btn-success" onclick="seleccionarReingresado('${f.sol_id}')">Seleccionar</button></td>
            </tr>
        `);
    });

    // Add search filter listener
    const filtroInput = document.getElementById('filtroReingresados');
    if (filtroInput) {
        filtroInput.addEventListener('keyup', filtrarReingresados);
    }

    const modal = new bootstrap.Modal(document.getElementById('modalReingresados'));
    modal.show();
}


function abrirModalOrigenEspecial() {
    //const tbody = document.querySelector('#tablaOrigenEspecial tbody');//OrigenSolicitud
    //tbody.innerHTML = '';
    //Solicitudes.forEach(f => {
    //    tbody.insertAdjacentHTML('beforeend', `
    //    <tr>
    //        <td>${f.sol_id || '-'}</td>
    //        <td>${f.sol_nombre_expediente || '-'}</td>
    //        <td><button class="btn btn-sm btn-success" onclick="seleccionarReingresado('${f.sol_id}')">Seleccionar</button></td>
    //    </tr>
    //`);
    //});

    // Add search filter listener
    const filtroInput = document.getElementById('filtroReingresados');
    if (filtroInput) {
        filtroInput.addEventListener('keyup', filtrarReingresados);
    }

    const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
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


function filtrarReingresados() {
    const filtro = document.getElementById('filtroReingresados').value.toLowerCase();
    const tbody = document.querySelector('#tablaReingresados tbody');
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

function seleccionarReingresado(id) {
    const func = Solicitudes.find(f => f.sol_id == id);
    if (func) {
        document.getElementById('Reingresado').value = id;
        const nombreCompleto = `${func.sol_nombre_expediente || ''}`.trim();
        document.getElementById('ReingresadoNombre').value = nombreCompleto || 'Sin Nombre';
    }
    const modal = bootstrap.Modal.getInstance(document.getElementById('modalReingresados'));
    modal.hide();
}

async function buscarAtencion() {
    const { value: id } = await Swal.fire({
        title: 'Buscar Solicitud',
        input: 'text',
        inputLabel: 'Ingrese ID de Solicitud:',
        inputPlaceholder: 'Ej: 123',
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Cancelar'
    });
    if (id) window.location.href = `?id=${id}`;
}
function nuevaAtencion() { window.location.href = 'desve_nuevo_ingreso.html'; }
function modificarAtencion() {
    toggleFields(true, false);
    Swal.fire('Modo Edición', "Modo edición activado: ya puede cambiar los campos y presionar Guardar.", 'info');
}

function toggleFields(enabled, isNew = false) {
    let restricted = [
        'idIngreso', 'IngresoDesve', 'DetalleIngreso',
        'FuncionarioInternoId', 'FuncionarioInternoNombre', 'ReingresadoNombre', 'DiasIngreso',
        'DiasVencimiento', 'Responsable', 'ClaveRespuesta', 'FechaCreacion'
    ];

    // If it's a new entry, we allow editing these two
    if (isNew) {
        restricted = restricted.filter(id => id !== 'IngresoDesve' && id !== 'DetalleIngreso');
    }

    // Always enable status buttons if we have a solicitation ID
    const hasId = !!(new URLSearchParams(window.location.search).get('id'));
    if (hasId) {
        restricted.push('estadoPendiente', 'estadoRespondido');
    }

    // Toggle Radio buttons
    if (hasId) {
        document.getElementById('estadoPendiente').disabled = false;
        document.getElementById('estadoRespondido').disabled = false;
    } else {
        document.getElementById('estadoPendiente').disabled = !enabled;
        document.getElementById('estadoRespondido').disabled = !enabled;
    }

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
    // Also enable/disable the search button for officer
    const btnBuscaReingresado = document.getElementById('btn_buscar_reingresado');
    if (btnBuscaReingresado) btnBuscaReingresado.disabled = !enabled;
}

async function enviarRespuesta() {
    const solicitationId = new URLSearchParams(window.location.search).get('id');
    const texto = document.getElementById('textoRespuesta').value.trim();
    const tipo = document.getElementById('inputTipoRespuesta').value;

    // Si la solicitud es un re-ingreso, vinculamos la respuesta al ID original
    const reingresoId = document.getElementById('Reingresado').value;
    const targetSolicitationId = (reingresoId && reingresoId !== '-') ? reingresoId : solicitationId;

    if (!solicitationId) {
        Swal.fire('Atención', "Debe cargar una solicitud antes de ingresar una respuesta.", 'warning');
        return;
    }
    if (!texto) {
        Swal.fire('Atención', "Por favor, escriba el contenido de la respuesta.", 'warning');
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/respuestas_desve.php`, {
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

            // Upload Files for Response
            if (responseFiles.length > 0) {
                const uploadSuccess = await uploadFiles(targetSolicitationId, responseFiles);
                if (!uploadSuccess) {
                    await Swal.fire('Atención', 'Respuesta guardada pero hubo errores al subir archivos adjuntos.', 'warning');
                } else {
                    responseFiles = [];
                }
            }

            await Swal.fire('Éxito', "Respuesta guardada con éxito.", 'success');
            document.getElementById('textoRespuesta').value = '';
            document.getElementById('inputArchivosRespuesta').value = ''; // Reset file input
            document.getElementById('listaArchivosRespuesta').innerHTML = ''; // Clear visual list

            // Close modal
            const modalEl = document.getElementById('modalRespuesta');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Refresh solicitation details to show new record in bitacora
            loadSolicitationDetails(solicitationId);
        } else {
            Swal.fire('Error', "Error al guardar: " + (result.message || "Error desconocido"), 'error');
        }
    } catch (e) {
        console.error("Error saving response:", e);
        Swal.fire('Error', "Error de conexión al guardar la respuesta.", 'error');
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

function validarFormularioAtencion() {
    // 1. Definir los campos y sus reglas
    const campos = [
        { id: 'IngresoDesve', nombre: 'Ingreso Desve', tipo: 'texto' },
        { id: 'FuncionarioInternoId', nombre: 'Funcionario Interno', tipo: 'numero' },
        { id: 'NombreExpediente', nombre: 'Nombre del expediente', tipo: 'texto' },
        { id: 'OrigenSolicitud', nombre: 'Origen de solicitud', tipo: 'select' },
        { id: 'ID_Organizacion', nombre: 'Tipo de Origen de solicitud', tipo: 'select' },
        { id: 'Sector', nombre: 'Sector', tipo: 'select' },
        { id: 'DetalleIngreso', nombre: 'Detalle de ingreso', tipo: 'texto' }
        // 'Observaciones' no suele ser obligatorio, pero puedes añadirlo aquí si gustas
    ];

    // 2. Iterar y validar
    for (const campo of campos) {
        const elemento = document.getElementById(campo.id);
        const valor = elemento.value.trim();

        // Validar si está vacío
        if (valor === "") {
            Swal.fire('Error', "El campo " + campo.nombre + " es obligatorio", 'error');
            elemento.focus();
            return false;
        }

        // Validar si es numérico (para Reingresado)
        if (campo.tipo === 'numero' && isNaN(valor)) {
            Swal.fire('Error', "El campo " + campo.nombre + " debe ser un valor numérico", 'error');
            elemento.focus();
            return false;
        }

        // Validar select (suponiendo que la opción por defecto tiene valor "")
        if (campo.tipo === 'select' && valor === "") {
            Swal.fire('Error', "Por favor, seleccione una opción en " + campo.nombre + "", 'error');
            elemento.focus();
            return false;
        }
    }

    // Si llega aquí, todo es válido
    return true;
}
function cargarBitacora() {

}