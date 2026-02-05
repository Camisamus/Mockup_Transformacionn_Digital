document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const rgtId = urlParams.get('rgt_id');

    if (id || rgtId) {
        cargarDatosIngreso({ ing_id: id, rgt_id: rgtId });
    } else {
        checkAndRequestID();
    }

    // Search Form in Consultation
    const formFiltros = document.getElementById('form_filtros_consulta');
    if (formFiltros) {
        const inputTitulo = document.getElementById('filtro_titulo');
        const inputRgt = document.getElementById('filtro_rgt');
        const inputId = document.getElementById('filtro_id');

        const limpiarOtros = (actual) => {
            if (actual !== inputTitulo) inputTitulo.value = '';
            if (actual !== inputRgt) inputRgt.value = '';
            if (actual !== inputId) inputId.value = '';
        };

        if (inputTitulo) inputTitulo.addEventListener('input', () => limpiarOtros(inputTitulo));
        if (inputRgt) inputRgt.addEventListener('input', () => limpiarOtros(inputRgt));
        if (inputId) inputId.addEventListener('input', () => limpiarOtros(inputId));

        formFiltros.addEventListener('submit', (e) => {
            e.preventDefault();
            const filters = {
                tis_titulo: document.getElementById('filtro_titulo').value,
                rgt_id_publica: document.getElementById('filtro_rgt').value,
                tis_id: document.getElementById('filtro_id').value
            };
            buscarYConsultar(filters);
        });
    }
});

async function buscarYConsultar(filters) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'CONSULTAM',
                ...filters
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            const data = result.data;
            if (Array.isArray(data)) {
                if (data.length === 0) {
                    Swal.fire('No encontrado', 'No se encontraron registros con esos criterios.', 'warning');
                } else if (data.length === 1) {
                    // One result: redirect to detail
                    window.location.href = `ingr_consultar.php?id=${data[0].tis_id}`;
                } else {
                    // Multiple: Ask user? or just pick first. Let's redirect to first one (most recent)
                    window.location.href = `ingr_consultar.php?id=${data[0].tis_id}`;
                }
            } else {
                renderizarIngreso(data);
            }
        } else {
            Swal.fire('Error', result.message || 'Error en la búsqueda.', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error al conectar con el servidor.', 'error');
    }
}

let currentRgtId = null;

async function cargarDatosIngreso(params) {
    try {
        const body = { ACCION: 'CONSULTAM', ...params };

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (result.status === 'success' || (result.data && !result.status)) {
            const data = result.data;
            const sessionUser = await checkSession();
            if (!sessionUser) return; // checkSession handles redirect
            if (sessionUser.id != data.tis_responsable) {
                const destinos = data.destinos || [];
                // Convert both to strings or integers for safe comparison
                const MiRelacion = destinos.find(d => parseInt(d.tid_destino) === parseInt(sessionUser.id));

                if (!MiRelacion) {
                    Swal.fire({
                        title: 'Acceso Restringido',
                        text: 'Usted no tiene autorización para consultar esta solicitud.',
                        icon: 'warning',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        confirmButtonText: 'Volver a Bandeja'
                    }).then(() => {
                        window.location.href = 'ingr_bandeja.php';
                    });
                    return;
                }
            }

            currentRgtId = data.tis_registro_tramite;
            renderizarIngreso(data);

            // Modal handler initialization
            const btnComent = document.getElementById('btn_abrir_comentario');
            if (btnComent) {
                btnComent.onclick = () => {
                    const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
                    modal.show();
                };
            }

            // RBAC Enforcement
            const perms = IngrPermissions.applyToUI(data.rol_usuario);

            // Button Event Handlers
            const id = data.tis_id;

            const btnResponder = document.getElementById('btn_ir_responder');
            if (btnResponder && id) {
                btnResponder.onclick = () => {
                    window.location.href = `ingr_responder.php?id=${id}`;
                };
            }

            const btnModificar = document.getElementById('btn_ir_modificar');
            if (btnModificar && id) {
                btnModificar.onclick = () => {
                    window.location.href = `ingr_modificar.php?id=${id}`;
                };
            }

            const btnPreparar = document.getElementById('btn_ir_preparar');
            if (btnPreparar && id) {
                btnPreparar.onclick = () => {
                    window.location.href = `ingr_preparar.php?id=${id}`;
                };
            }
        } else {
            Swal.fire('Error', result.message || 'No se pudo cargar la información.', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire('Error', 'Ocurrió un error al conectar con el servidor.', 'error');
    }
}

function renderizarIngreso(data) {
    // Basic Info
    document.getElementById('info_titulo').innerText = data.tis_titulo || '-';
    document.getElementById('info_rgt_id').innerText = data.rgt_id || '-';
    document.getElementById('info_id_publica').innerText = data.rgt_id_publica || '-';
    document.getElementById('info_fecha').innerText = data.tis_fecha.substring(0, 10) || '-';
    const responsable = data.resp_nombre ? `${data.resp_nombre} ${data.resp_apellido}` : `ID: ${data.tis_responsable}`;
    document.getElementById('info_responsable').innerText = responsable;
    document.getElementById('info_contenido').innerHTML = data.tis_contenido ? data.tis_contenido.replace(/\n/g, '<br>') : 'Sin contenido';

    const badgeEstado = document.getElementById('badge_estado');
    badgeEstado.innerText = data.tis_estado || 'Pendiente';
    badgeEstado.className = `badge ${data.tis_estado === 'Ingresado' ? 'bg-success' : 'bg-primary'}`;

    document.getElementById('subtitulo_ingreso').innerText = `Expediente: ${data.tis_titulo} (Cód. ${data.rgt_id_publica})`;

    // Destinos
    const tablaDestinos = document.getElementById('tabla_destinos');
    tablaDestinos.innerHTML = '';

    // HEADER UPDATE: Add 'Estado' column if not exists
    // Use closest table or previous element sibling if we are in tbody
    const table = tablaDestinos.closest('table');
    const thead = table ? table.querySelector('thead') : null;
    const theadRow = thead ? thead.firstElementChild : null;

    if (theadRow && theadRow.children.length === 4) { // Assuming initial cols: Funcionario, Rol, Fac., Req.
        const th = document.createElement('th');
        th.className = 'text-end';
        th.innerText = 'Estado';
        theadRow.appendChild(th);
    }

    if (data.destinos && data.destinos.length > 0) {
        data.destinos.forEach(dest => {
            let estadoBadge = '<span class="badge bg-secondary">Pendiente</span>';
            if (dest.tid_responde == 1) {
                estadoBadge = '<span class="badge bg-success">Aprobado</span>';
            } else if (dest.tid_responde == 0 && dest.tid_fecha_respuesta.substring(0, 10)) {
                estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
            } else if (dest.tid_responde === '0') {
                estadoBadge = '<span class="badge bg-danger">Rechazado</span>';
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="fw-bold">${dest.usr_nombre} ${dest.usr_apellido}</div>
                    <div class="small text-muted">${dest.usr_email}</div>
                </td>
                <td><span class="badge bg-light text-dark border">${dest.tid_tipo}</span></td>
                <td><span class="small">${dest.tid_facultad}</span></td>
                <td class="text-center">
                    ${dest.tid_requeido === '1' ? '<i data-feather="check-circle" class="text-success" style="width:16px"></i>' : '<i data-feather="circle" class="text-muted" style="width:16px"></i>'}
                </td>
                <td class="text-end">${estadoBadge}</td>
            `;
            tablaDestinos.appendChild(row);
        });
    } else {
        tablaDestinos.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No hay destinatarios asignados.</td></tr>';
    }

    // Bitácora
    const listaBitacora = document.getElementById('lista_bitacora');
    listaBitacora.innerHTML = '';
    if (data.bitacora && data.bitacora.length > 0) {
        data.bitacora.forEach(entry => {
            const item = document.createElement('div');
            item.className = 'mb-3 pb-2 border-bottom';
            item.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div class="fw-bold small">${entry.bit_evento}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">${entry.bit_fecha.substring(0, 10)}</div>
                </div>
                <div class="small text-secondary">Por: ${entry.usr_nombre} ${entry.usr_apellido}</div>
            `;
            listaBitacora.appendChild(item);
        });
    } else {
        listaBitacora.innerHTML = '<p class="text-muted small">No hay registros de bitácora.</p>';
    }

    // Enlaces
    const listaEnlaces = document.getElementById('lista_enlaces');
    listaEnlaces.innerHTML = '';
    if (data.enlaces && data.enlaces.length > 0) {
        data.enlaces.forEach(link => {
            const a = document.createElement('a');
            a.href = link.tge_enlace.startsWith('http') ? link.tge_enlace : `https://${link.tge_enlace}`;
            a.target = '_blank';
            a.className = 'list-group-item list-group-item-action d-flex align-items-center gap-2 py-2';
            a.innerHTML = `
                <i data-feather="link" style="width:14px"></i>
                <div class="overflow-hidden text-nowrap text-truncate small">${link.tge_enlace}</div>
            `;
            listaEnlaces.appendChild(a);
        });
    } else {
        listaEnlaces.innerHTML = '<div class="list-group-item text-muted small">Sin enlaces adjuntos.</div>';
    }

    // Documentos
    const listaDocumentos = document.getElementById('lista_documentos');
    listaDocumentos.innerHTML = '';
    if (data.documentos && data.documentos.length > 0) {
        data.documentos.forEach(doc => {
            const div = document.createElement('div');
            div.className = 'list-group-item list-group-item-action d-flex align-items-center justify-content-between py-2';
            div.innerHTML = `
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <i data-feather="file" style="width:14px" class="text-primary"></i>
                    <div class="text-truncate small" title="${doc.doc_nombre_documento}">${doc.doc_nombre_documento}</div>
                </div>
                <button class="btn btn-sm btn-link p-0 text-primary" onclick="descargarDocumento('${doc.doc_id}', '${doc.doc_nombre_documento}')">
                    <i data-feather="download" style="width:14px"></i>
                </button>
            `;
            listaDocumentos.appendChild(div);
        });
    } else {
        listaDocumentos.innerHTML = '<div class="list-group-item text-muted small">Sin documentos adjuntos.</div>';
    }

    // Comentarios
    const listaComentarios = document.getElementById('lista_comentarios');
    listaComentarios.innerHTML = '';
    if (data.comentarios && data.comentarios.length > 0) {
        data.comentarios.forEach(com => {
            const div = document.createElement('div');
            div.className = 'list-group-item py-3';
            div.innerHTML = `
                <div class="d-flex justify-content-between mb-1">
                    <span class="fw-bold small text-primary">${com.usr_nombre} ${com.usr_apellido}</span>
                    <span class="text-muted" style="font-size: 0.7rem;">${com.gco_fecha.substring(0, 10)}</span>
                </div>
                <div class="small text-dark">${com.gco_comentario}</div>
            `;
            listaComentarios.appendChild(div);
        });
    } else {
        listaComentarios.innerHTML = '<div class="list-group-item text-muted small">Sin comentarios.</div>';
    }

    // Multiancestro (Ancestry)
    const listaMulti = document.getElementById('lista_multiancestro');
    listaMulti.style.display = 'none';
    const graphBtn = document.getElementById('btn_ver_mapa');

    listaMulti.innerHTML = '';
    if (data.multiancestro && Object.keys(data.multiancestro).length > 0) {
        Object.values(data.multiancestro).forEach(rel => {
            const li = document.createElement('li');
            li.className = 'list-group-item py-2 bg-transparent border-0 d-flex align-items-center gap-2';
            li.style.cursor = 'pointer';

            let label = '';
            let targetId = '';
            let icon = 'corner-down-right';

            // El ID de comparación para multiancestro es el RGT ID (tis_registro_tramite)
            if (rel.gma_hijo == data.tis_registro_tramite) {
                label = `<span class="badge bg-light text-dark me-1">Antecesor</span> ID: ${rel.gma_padre}`;
                targetId = rel.gma_padre;
                icon = 'arrow-up-circle';
            } else if (rel.gma_padre == data.tis_registro_tramite) {
                label = `<span class="badge bg-light text-primary me-1">Descendiente</span> ID: ${rel.gma_hijo}`;
                targetId = rel.gma_hijo;
                icon = 'arrow-down-circle';
            } else {
                label = `Relación: ${rel.gma_padre} â†’ ${rel.gma_hijo}`;
                targetId = rel.gma_hijo;
            }

            li.innerHTML = `
                <i data-feather="${icon}" style="width:14px"></i>
                <span class="small">${label}</span>
            `;
            li.onclick = () => window.location.search = `?rgt_id=${targetId}`;
            listaMulti.appendChild(li);
        });

        graphBtn.disabled = false;
        graphBtn.onclick = () => {
            const modal = new bootstrap.Modal(document.getElementById('modalMapa'));
            modal.show();
            // Usamos tis_registro_tramite como el ID actual para el mapa
            setTimeout(() => renderizarMapaRelaciones(data.multiancestro, data.tis_registro_tramite), 300);
        };
    } else {
        listaMulti.innerHTML = '<li class="list-group-item text-muted small">No hay relaciones registradas.</li>';
        graphBtn.disabled = true;
    }

    if (window.feather) window.feather.replace();
}

function renderizarMapaRelaciones(multiancestro, currentId) {
    const container = document.getElementById('network-container');
    const nodesMap = new Map();
    const edges = [];

    Object.values(multiancestro).forEach(rel => {
        if (!nodesMap.has(rel.gma_padre)) {
            nodesMap.set(rel.gma_padre, {
                id: rel.gma_padre,
                label: `ID: ${rel.gma_padre}`,
                color: { background: '#ffffff', border: '#005cab' }
            });
        }
        if (!nodesMap.has(rel.gma_hijo)) {
            nodesMap.set(rel.gma_hijo, {
                id: rel.gma_hijo,
                label: `ID: ${rel.gma_hijo}`,
                color: { background: '#ffffff', border: '#005cab' }
            });
        }
        edges.push({ from: rel.gma_padre, to: rel.gma_hijo, arrows: 'from', color: '#005cab' });
    });

    if (nodesMap.has(currentId)) {
        const node = nodesMap.get(currentId);
        node.color = { background: '#005cab', border: '#005cab' };
        node.font = { color: '#ffffff', size: 14, bold: true };
        node.label = `ESTE: ${currentId}`;
    }

    const networkData = { nodes: Array.from(nodesMap.values()), edges: edges };
    const options = {
        nodes: { shape: 'box', margin: 10, shadow: true },
        edges: { smooth: { type: 'cubicBezier', forceDirection: 'vertical' } },
        layout: { hierarchical: { direction: 'UD', sortMethod: 'directed' } },
        interaction: { hover: true, navigationButtons: true }
    };

    const network = new vis.Network(container, networkData, options);

    network.on("doubleClick", (params) => {
        if (params.nodes.length > 0 && params.nodes[0] != currentId) {
            window.location.search = `?rgt_id=${params.nodes[0]}`;
        }
    });

    if (window.feather) window.feather.replace();
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
            // SI NO ES JSON, ES EL ARCHIVO BINARIO (PDF, IMAGE, ETC)
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);

            // Creamos el enlace de descarga temporal
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = nombre;
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

async function guardarComentario() {
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
                rgt_id: currentRgtId,
                gco_texto: texto
            })
        });

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            const modalEl = document.getElementById('modalNuevoComentario');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            Swal.fire({
                icon: 'success',
                title: '¡Guardado!',
                text: 'El comentario ha sido guardado correctamente.',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                // Relanzar carga de datos
                location.reload();
            });
        } else {
            Swal.fire('Error', result.message || 'No se pudo guardar el comentario.', 'error');
        }
    } catch (e) {
        console.error("Error saving comment:", e);
        Swal.fire('Error', 'Error de conexión al guardar.', 'error');
    }
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
        window.location.href = 'ingr_bandeja.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        let foundId = null;
        const payload = { ACCION: 'CONSULTAM' };

        if (type === 'tis_id') payload.tis_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];
            if (results.length > 0 && results[0].tis_id) {
                foundId = results[0].tis_id;
            }
        }

        if (foundId) {
            Swal.close();
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('id', foundId);
            window.location.href = newUrl.toString();
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                checkAndRequestID();
            });
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}

async function checkSession() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "" })
        });
        const data = await response.json();
        if (data.isAuthenticated) {
            return data.user;
        } else {
            window.location.href = '../index.php';
            return null;
        }
    } catch (e) {
        console.error("Session check failed", e);
        return null;
    }
}
