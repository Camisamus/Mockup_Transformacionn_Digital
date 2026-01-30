let currentSol = null;
let currentUser = null;

let organizaciones = [];
let organizacionesDESVE = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let responseFiles = [];
let existingFiles = [];

document.addEventListener('DOMContentLoaded', async function () {
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
        return;
    }

    try {
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

        // Load Lookups
        await loadLookups();

        // 2. Load Solicitud Data
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM", ver_clave: true })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            currentSol = result.data;
            let aux = false;
            currentSol.destinos.forEach(destino => {
                if (destino.tid_destino == String(currentUser.id)) {
                    aux = true;
                }
            });
            // 3. Security Check (Only assigned official can respond)
            if (!aux) {
                await Swal.fire({
                    title: 'Acceso Denegado',
                    text: `Esta solicitud está asignada a otro funcionario.`,
                    icon: 'error',
                    confirmButtonText: 'Volver a Bandeja'
                });
                window.location.href = 'desve_listado_ingresos.html';
                return;
            }

            document.getElementById('loading-check').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');

            renderSolicitationInfo();
            renderResponseBitacora(currentSol.respuestas || []);
            renderComments(currentSol.comentarios || []);

            // Drag and Drop
            const dropZone = document.getElementById('drop_zone');
            const fileInput = document.getElementById('inputArchivosRespuesta');
            dropZone.onclick = () => fileInput.click();
            dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('active'); };
            dropZone.ondragleave = () => dropZone.classList.remove('active');
            dropZone.ondrop = (e) => {
                e.preventDefault();
                dropZone.classList.remove('active');
                handleFiles(e.dataTransfer.files);
            };
            fileInput.onchange = (e) => handleFiles(e.target.files);

            // Save Response
            document.getElementById('btn-save-response').onclick = saveResponse;

            if (window.feather) feather.replace();

        } else {
            Swal.fire('Error', 'No se encontró la solicitud.', 'error').then(() => solicitarID());
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
    } catch (e) { console.error(e); }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

function renderSolicitationInfo() {
    if (!currentSol) return;

    document.getElementById('header_public_id').innerText = `Responder DESVE: ${currentSol.sol_ingreso_desve || currentSol.sol_id}`;
    document.getElementById('header_expediente').innerText = currentSol.sol_nombre_expediente || '';

    document.getElementById('display-id').innerText = currentSol.sol_id;
    document.getElementById('display-desve').innerText = currentSol.sol_ingreso_desve || 'N/A';
    document.getElementById('display-expediente').innerText = currentSol.sol_nombre_expediente || '-';
    document.getElementById('display-recepcion').innerText = currentSol.sol_fecha_recepcion?.split(' ')[0] || '-';
    document.getElementById('display-detalle').innerText = currentSol.sol_detalle || 'Sin detalle';

    // Resolve Organization Type and Origen
    let orgList = [];
    let org = {};
    switch (parseInt(currentSol.sol_origen_esp)) {
        case 0:
            orgList = organizaciones;
            org = orgList.find(o => o.org_id == currentSol.sol_origen_id);
            break;
        case 1:
            orgList = organizacionesDESVE;
            org = orgList.find(o => o.org_id == currentSol.sol_origen_id);
            break;
        case 2:
            orgList = organizacionesDESVE;
            org = orgList.find(o => o.org_id == currentSol.sol_origen_id);
            break;
        default:
            OrigenEspecial = false;
    }
    let tiporg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id);
    if (org) {
        document.getElementById('display-org-tipo').innerText = tiporg.tor_nombre;
        //handleTipoOrgChange(); // Populate OrigenSolicitud based on Type
        document.getElementById('display-org-nombre').innerText = org.org_nombre;
    }

    const prio = prioridades.find(p => p.pri_id == currentSol.sol_prioridad_id);
    document.getElementById('display-prioridad').innerText = prio ? prio.pri_nombre : '-';

    const sec = sectores.find(s => s.sec_id == currentSol.sol_sector_id);
    document.getElementById('display-sector').innerText = sec ? sec.sec_nombre : '-';
    const calcularTranscurridos = () => {
        if (!currentSol.sol_fecha_recepcion) return 0;
        const fecha_recep = new Date(currentSol.sol_fecha_recepcion.replace(/-/g, '/')); // replace para mejor compatibilidad
        const hoy = new Date();
        // Normalizamos a medianoche para comparar solo días
        const inicio = new Date(fecha_recep.getFullYear(), fecha_recep.getMonth(), fecha_recep.getDate());
        const fin = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

        const diff = fin - inicio;
        return Math.max(0, Math.floor(diff / (1000 * 60 * 60 * 24)));
    };

    // 2. Lógica para Días de Vencimiento (desde hoy hasta el vencimiento)
    const calcularVencimiento = () => {
        if (!currentSol.sol_fecha_vencimiento) return 0;
        const fecha_vence = new Date(currentSol.sol_fecha_vencimiento.replace(/-/g, '/'));
        const hoy = new Date();

        const fin = new Date(fecha_vence.getFullYear(), fecha_vence.getMonth(), fecha_vence.getDate());
        const inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

        const diff = fin - inicio;
        // Aquí no usamos Math.max porque si es negativo significa que YA ESTÁ VENCIDO
        return Math.floor(diff / (1000 * 60 * 60 * 24));
    };
    // Metrics
    // 3. Asignación al DOM
    // Usamos el cálculo solo si el valor del JSON es "0" o null
    document.getElementById('display-dias-ingreso').innerText =
        (currentSol.sol_dias_transcurridos && currentSol.sol_dias_transcurridos !== "0")
            ? currentSol.sol_dias_transcurridos
            : calcularTranscurridos();

    document.getElementById('display-dias-vencimiento').innerText =
        (currentSol.sol_dias_vencimiento && currentSol.sol_dias_vencimiento !== "0")
            ? currentSol.sol_dias_vencimiento
            : calcularVencimiento();
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            responseFiles.push({ nombre: file.name, base64: e.target.result });
            renderFileList();
        };
        reader.readAsDataURL(file);
    });
}

function renderFileList() {
    const listContainer = document.getElementById('listaArchivosRespuesta');
    listContainer.innerHTML = '';
    responseFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-1 border rounded';
        item.innerHTML = `
            <div><i data-feather="file-plus" class="text-success me-2" style="width:14px;"></i><span class="small">${file.nombre}</span></div>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFile(${index})"><i data-feather="trash-2" style="width:14px;"></i></button>
        `;
        listContainer.appendChild(item);
    });
    if (window.feather) feather.replace();
}

window.removeFile = (index) => {
    responseFiles.splice(index, 1);
    renderFileList();
};

function renderResponseBitacora(respuestas) {
    const tbody = document.getElementById('bitacora-respuestas-body');
    tbody.innerHTML = '';
    if (!respuestas || respuestas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-3 text-muted small">No hay respuestas registradas</td></tr>';
        return;
    }
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

function renderComments(comments) {
    const container = document.getElementById('comentarios-container');
    container.innerHTML = '';
    if (!comments || comments.length === 0) {
        container.innerHTML = '<div class="text-muted p-2 small">No hay comentarios.</div>';
        return;
    }
    comments.forEach(c => {
        const item = `
            <div class="list-group-item px-0 border-0 border-bottom">
                <div class="d-flex justify-content-between x-small text-muted mb-1">
                    <strong>${c.usr_nombre} ${c.usr_apellido}</strong>
                    <span>${c.gco_fecha.substring(0, 10)}</span>
                </div>
                <div class="small">${c.gco_comentario}</div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', item);
    });
}

async function saveResponse() {
    const responseText = document.getElementById('input-respuesta').value.trim();
    const isDefinitiva = document.getElementById('check-respuesta-definitiva').checked;

    if (!responseText) {
        return Swal.fire('Atención', 'Por favor ingrese un contenido para la respuesta.', 'warning');
    }

    const { isConfirmed } = await Swal.fire({
        title: "¿Desea guardar esta respuesta?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar"
    });

    if (!isConfirmed) return;

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const payload = {
            ACCION: "CREAR",
            res_solicitud_id: currentSol.sol_id,
            sol_reingreso_id: currentSol.sol_reingreso_id || null,
            res_texto: responseText,
            res_tipo: isDefinitiva ? 'Respuesta Final' : 'Comentario',
            res_funcionario: currentUser.id,
            documentos: responseFiles
        };

        const response = await fetch(`${window.API_BASE_URL}/respuestas_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        if (result.status === 'success') {
            await Swal.fire("Éxito", "Respuesta guardada correctamente.", "success");
            window.location.href = 'desve_listado_ingresos.html';
        } else {
            Swal.fire("Error", result.message || "Error al guardar.", "error");
        }
    } catch (e) {
        console.error(e);
        Swal.fire("Error", "Error de conexión.", "error");
    }
}

window.guardarComentario = async function () {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) return;

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
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario')).hide();
            location.reload();
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
