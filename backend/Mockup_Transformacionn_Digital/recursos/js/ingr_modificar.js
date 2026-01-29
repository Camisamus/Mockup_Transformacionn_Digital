document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        await checkAndRequestID();
        return;
    }

    await cargarListas();
    await cargarDatosExistentes(id);
    setupEventListeners();
});

let funcionarios = [];
let destinos = [];
let enlaces = [];
let documentosNuevos = [];
let documentosExistentes = [];

// Modals
let modalBusqueda = null;
let modalConfig = null;
let modalComentario = null;
let currentRgtId = null;

async function cargarListas() {
    try {
        const respTipos = await fetch(`${window.API_BASE_URL}/ingresos_tipos_ingreso.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultTipos = await respTipos.json();

        const selectTipo = document.getElementById('tis_tipo');
        selectTipo.innerHTML = '<option value="" selected disabled>Seleccione un tipo...</option>';

        if (resultTipos.status === 'success') {
            resultTipos.data.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t.titi_id;
                opt.textContent = t.titi_nombre;
                selectTipo.appendChild(opt);
            });
        }

        const respFunc = await fetch(`${window.API_BASE_URL}/funcionarios.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultFunc = await respFunc.json();
        if (resultFunc.status === 'success') {
            funcionarios = resultFunc.data;
        }

    } catch (error) {
        console.error('Error al cargar listas:', error);
    }
}

async function cargarDatosExistentes(id) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM', ing_id: id })
        });
        const result = await response.json();

        if (result.status === 'success') {
            const data = result.data;
            currentRgtId = data.tis_registro_tramite;

            // Check RBAC Permissions
            const perms = IngrPermissions.getPermissions(data.rol_usuario);
            if (!perms.editar) {
                Swal.fire({
                    title: 'Acceso Denegado',
                    text: 'Usted no tiene permisos para modificar esta solicitud.',
                    icon: 'error',
                    confirmButtonText: 'Ver Detalle',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = `ingr_consultar.html?id=${id}`;
                });
                return;
            }

            // Check Lock Status
            if (data.tis_estado && data.tis_estado !== 'Pendiente' && data.tis_estado !== 'Ingresado') {
                Swal.fire({
                    title: 'Solicitud Cerrada',
                    text: 'Esta solicitud ya fué resuelta o se encuentra en un estado que no permite modificaciones.',
                    icon: 'warning',
                    confirmButtonText: 'Ir a Consultar',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = `ingr_consultar.html?id=${id}`;
                });
                return;
            }

            document.getElementById('tis_titulo').value = data.tis_titulo || '';
            document.getElementById('tis_tipo').value = data.tis_tipo || '';
            document.getElementById('tis_contenido').value = data.tis_contenido || '';

            // Map Destinos
            if (data.destinos) {
                destinos = data.destinos.map(d => ({
                    usr_id: d.tid_destino,
                    usr_nombre_completo: `${d.usr_nombre} ${d.usr_apellido}`,
                    tid_tipo: d.tid_tipo,
                    tid_facultad: d.tid_facultad,
                    tid_requeido: d.tid_requeido,
                    tid_responde: d.tid_responde, // Store status
                    tid_fecha_respuesta: d.tid_fecha_respuesta
                }));
                renderizarDestinos();
            }

            // Map Enlaces
            if (data.enlaces) {
                enlaces = data.enlaces.map(e => e.tge_enlace);
                renderizarEnlaces();
            }

            // Map Documentos
            if (data.documentos) {
                documentosExistentes = data.documentos;
                renderizarDocumentosExistentes();
            }

            // Map Comentarios
            if (data.comentarios) {
                renderizarComentarios(data.comentarios);
            } else {
                renderizarComentarios([]);
            }
        } else {
            Swal.fire('Error', 'No se pudo cargar la información del ingreso.', 'error');
        }
    } catch (error) {
        console.error('Error al cargar datos:', error);
        Swal.fire('Error', 'Error de conexión al cargar datos.', 'error');
    }
}

function setupEventListeners() {
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalBusquedaFuncionario'));
    modalConfig = new bootstrap.Modal(document.getElementById('modalConfigurarFactores') || document.getElementById('modalConfigurarDestino')); // Compatible with both
    modalComentario = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));

    document.getElementById('btn_abrir_comentario').onclick = () => modalComentario.show();

    document.getElementById('buscar_fnc_input').addEventListener('input', (e) => {
        renderizarBusquedaFuncionarios(e.target.value);
    });

    // Control de requerido según facultad
    const selectFacultad = document.getElementById('m_destino_facultad');
    if (selectFacultad) {
        selectFacultad.addEventListener('change', (e) => {
            const checkReq = document.getElementById('m_destino_requerido');
            if (e.target.value === 'Consultor') {
                checkReq.checked = false;
                checkReq.disabled = true;
            } else {
                checkReq.disabled = false;
            }
        });
    }

    document.getElementById('btn_confirmar_destino').onclick = () => {
        const id = document.getElementById('fnc_id_config').value;
        const nombre = document.getElementById('fnc_nombre_config').textContent;
        const tipo = document.getElementById('m_destino_tipo').value;
        const facultad = document.getElementById('m_destino_facultad').value || '-';
        const requerido = document.getElementById('m_destino_requerido').checked;

        destinos.push({
            usr_id: id,
            usr_nombre_completo: nombre,
            tid_tipo: tipo,
            tid_facultad: facultad,
            tid_requeido: requerido ? '1' : '0'
        });

        renderizarDestinos();
        modalConfig.hide();
    };

    document.getElementById('btn_agregar_enlace').onclick = () => {
        const input = document.getElementById('input_enlace');
        const url = input.value.trim();
        if (url) {
            enlaces.push(url);
            input.value = '';
            renderizarEnlaces();
        }
    };

    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('input_archivo');
    dropZone.onclick = () => fileInput.click();
    fileInput.onchange = (e) => handleFiles(e.target.files);
    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('active'); };
    dropZone.ondragleave = () => dropZone.classList.remove('active');
    dropZone.ondrop = (e) => { e.preventDefault(); dropZone.classList.remove('active'); handleFiles(e.dataTransfer.files); };

    document.getElementById('form_modificar_ingreso').onsubmit = (e) => {
        e.preventDefault();
        actualizarIngreso();
    };

    document.getElementById('btn_cancelar').onclick = () => {
        window.location.href = 'ingr_bandeja.html';
    };
}

function renderizarBusquedaFuncionarios(filtro) {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    const term = filtro.toLowerCase();
    const filtrados = funcionarios.filter(f =>
        f.fnc_nombre.toLowerCase().includes(term) ||
        f.fnc_apellido.toLowerCase().includes(term) ||
        (f.fnc_email && f.fnc_email.toLowerCase().includes(term))
    );

    filtrados.forEach(f => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>${f.fnc_nombre}</td>
            <td>${f.fnc_apellido}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="seleccionarFuncionario(${f.fnc_id}, '${f.fnc_nombre} ${f.fnc_apellido}')">
                    <i data-feather="plus"></i> Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

function abrirModalBuscarFuncionario() {
    document.getElementById('buscar_fnc_input').value = '';
    renderizarBusquedaFuncionarios('');
    modalBusqueda.show();
}

function seleccionarFuncionario(id, nombre) {
    document.getElementById('fnc_id_config').value = id;
    document.getElementById('fnc_nombre_config').textContent = nombre;
    document.getElementById('m_destino_tipo').value = 'Para';
    document.getElementById('m_destino_facultad').value = 'Firmante';
    const checkReq = document.getElementById('m_destino_requerido');
    checkReq.checked = true;
    checkReq.disabled = false;

    modalBusqueda.hide();
    modalConfig.show();
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            documentosNuevos.push({
                nombre: file.name,
                base64: e.target.result
            });
            renderizarDocumentosNuevos();
        };
        reader.readAsDataURL(file);
    });
}

function renderizarDestinos() {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    // HEADER UPDATE: Add 'Estado' column if not exists
    const table = tbody.closest('table');
    const thead = table ? table.querySelector('thead') : null;
    const theadRow = thead ? thead.firstElementChild : null;

    // Check if header exists by content
    const headerExists = theadRow ? Array.from(theadRow.children).some(th => th.innerText === 'Estado') : false;

    if (theadRow && !headerExists) {
        // We know structure: Names, Tipo, Facultad, Requerido, Actions
        // Let's insert before Actions (last one)
        const actionsTh = theadRow.lastElementChild;
        const th = document.createElement('th');
        th.innerText = 'Estado';
        theadRow.insertBefore(th, actionsTh);
    }

    if (destinos.length === 0) {
        // Adjust colspan based on if we added a header or not (assuming 6 col if status exists)
        tbody.innerHTML = '<tr id="placeholder_destinos"><td colspan="6" class="text-center text-muted py-3 small">No hay destinatarios agregados.</td></tr>';
        return;
    }

    destinos.forEach((d, index) => {
        let estadoBadge = '<span class="badge bg-secondary">Pendiente</span>';
        if (d.tid_responde == 1) {
            estadoBadge = '<span class="badge bg-success">Aprobado</span>';
        } else if (d.tid_responde == 0 && d.tid_fecha_respuesta) {
            estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
        } else if (d.tid_responde === '0') {
            estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
        }

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="small">${d.usr_nombre_completo}</td>
            <td><span class="badge bg-light text-dark border small">${d.tid_tipo}</span></td>
            <td class="small">${d.tid_facultad}</td>
            <td class="text-center">
                ${d.tid_requeido === '1' || d.tid_requeido === true ? '<i data-feather="check-circle" class="text-success" style="width:14px"></i>' : '<i data-feather="circle" class="text-muted" style="width:14px"></i>'}
            </td>
            <td>${estadoBadge}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="eliminarDestino(${index})">
                    <i data-feather="trash-2" style="width:14px"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

function renderizarEnlaces() {
    const list = document.getElementById('lista_enlaces');
    list.innerHTML = '';
    enlaces.forEach((url, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center py-2';
        item.innerHTML = `
            <div class="text-truncate" style="max-width: 80%">${url}</div>
            <i data-feather="x-circle" class="btn-remove" onclick="eliminarEnlace(${index})" style="width:14px"></i>
        `;
        list.appendChild(item);
    });
    if (window.feather) window.feather.replace();
}

function renderizarDocumentosExistentes() {
    const list = document.getElementById('lista_documentos_guardados');
    list.innerHTML = '';
    documentosExistentes.forEach((doc, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center py-2 bg-light';
        item.innerHTML = `
            <div class="text-truncate" style="max-width: 80%"><i data-feather="file" style="width:14px" class="me-1"></i> ${doc.doc_nombre_documento}</div>
            <div>
                 <button type="button" class="btn btn-sm btn-link text-primary p-0 me-2" onclick="descargarDocumento('${doc.doc_id}', '${doc.doc_nombre_documento}')">
                    <i data-feather="download" style="width:14px"></i>
                </button>
            </div>
        `;
        list.appendChild(item);
    });
    if (window.feather) window.feather.replace();
}

function renderizarDocumentosNuevos() {
    const list = document.getElementById('lista_documentos_nuevos');
    list.innerHTML = '';
    documentosNuevos.forEach((doc, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center py-2';
        item.innerHTML = `
            <div class="text-truncate" style="max-width: 80%"><i data-feather="file-plus" style="width:14px" class="me-1 text-success"></i> ${doc.nombre}</div>
            <i data-feather="x-circle" class="btn-remove" onclick="eliminarDocumentoNuevo(${index})" style="width:14px"></i>
        `;
        list.appendChild(item);
    });
    if (window.feather) window.feather.replace();
}

function eliminarDestino(index) { destinos.splice(index, 1); renderizarDestinos(); }
function eliminarEnlace(index) { enlaces.splice(index, 1); renderizarEnlaces(); }
function eliminarDocumentoNuevo(index) { documentosNuevos.splice(index, 1); renderizarDocumentosNuevos(); }

async function descargarDocumento(Id, nombre) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/documentos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'Bajar', ID: Id }),
            credentials: 'include'
        });
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            const result = await response.json();
            Swal.fire('Error', result.message || 'No se pudo descargar.', 'error');
        } else {
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = nombre;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            a.remove();
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de red o de procesamiento.', 'error');
    }
}

async function actualizarIngreso() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    try {
        const payload = {
            ACCION: 'ACTUALIZAR',
            ing_id: id,
            tis_titulo: document.getElementById('tis_titulo').value,
            tis_tipo: document.getElementById('tis_tipo').value,
            tis_contenido: document.getElementById('tis_contenido').value,
            destinos: destinos,
            enlaces: enlaces,
            documentos: documentosNuevos
        };

        if (destinos.length === 0) {
            Swal.fire('Atención', 'Debe agregar al menos un destinatario', 'warning');
            return;
        }

        Swal.fire({
            title: 'Actualizando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: 'El ingreso ha sido actualizado correctamente.',
                confirmButtonText: 'Ver Detalle'
            }).then(() => {
                window.location.href = `ingr_consultar.html?id=${id}`;
            });
        } else {
            Swal.fire('Error', result.message || 'No se pudo actualizar el ingreso', 'error');
        }

    } catch (error) {
        console.error('Error al actualizar:', error);
        Swal.fire('Error', 'Ocurrió un error al conectar con el servidor', 'error');
    }
}

function renderizarComentarios(array) {
    const container = document.getElementById('lista_comentarios');
    if (!container) return;
    container.innerHTML = '';

    if (!array || array.length === 0) {
        container.innerHTML = '<div class="text-center py-3 text-muted small">Sin comentarios.</div>';
        return;
    }

    array.forEach(com => {
        const div = document.createElement('div');
        div.className = 'list-group-item py-2 px-0 border-0 border-bottom';
        div.innerHTML = `
            <div class="d-flex justify-content-between mb-1">
                <span class="fw-bold small text-primary">${com.usr_nombre} ${com.usr_apellido}</span>
                <span class="text-muted" style="font-size: 0.7rem;">${com.gco_fecha.substring(0, 10)}</span>
            </div>
            <div class="small text-dark">${com.gco_comentario}</div>
        `;
        container.appendChild(div);
    });
}

async function guardarComentario() {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) {
        Swal.fire('Atención', 'Escriba un comentario.', 'warning');
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                rgt_id: currentRgtId,
                gco_texto: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            modalComentario.hide();
            Swal.fire({
                icon: 'success',
                title: 'Guardado',
                timer: 1000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        }
    } catch (e) { console.error(e); }
}
window.guardarComentario = guardarComentario;

async function checkAndRequestID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="tis_id">ID Interno (Solicitud)</option>
                    <option value="rgt_id_publica" selected>Cód. Público (Ej: H3k9L2p1)</option>
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
        window.location.href = 'ingr_bandeja.html';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        let foundId = null;
        const payload = { ACCION: 'CONSULTAM' };

        // Match payload field to selected type
        if (type === 'tis_id') payload.tis_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            // response.data might be a single object or an array
            const results = Array.isArray(response.data) ? response.data : [response.data];

            if (results.length > 0 && results[0].tis_id) {
                foundId = results[0].tis_id;
            }
        }

        if (foundId) {
            Swal.close();
            // Reload with correct ID
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('id', foundId);
            window.location.href = newUrl.toString();
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                checkAndRequestID(); // Retry
            });
        }

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}
