document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const rgtId = urlParams.get('rgt_id');

    if (id || rgtId) {
        cargarDatosIngreso({ ing_id: id, rgt_id: rgtId });
    } else {
        checkAndRequestID();
    }

    // Inicialización de pestañas de Bootstrap
    const triggerTabList = [].slice.call(document.querySelectorAll('#ingresosTabs button'));
    triggerTabList.forEach(function (triggerEl) {
        const tabTrigger = new bootstrap.Tab(triggerEl);
        triggerEl.addEventListener('click', function (event) {
            event.preventDefault();
            tabTrigger.show();
        });
    });

    // Manejador para inicializar el mapa cuando se muestra la pestaña correspondiente
    const mapaTab = document.querySelector('button[data-bs-target="#tab-mapa"]');
    if (mapaTab) {
        mapaTab.addEventListener('shown.bs.tab', function () {
            if (window.currentDataForMap) {
                // Pequeño delay para asegurar que el contenedor sea visible
                setTimeout(() => {
                    renderizarMapa(
                        window.currentDataForMap.multiancestro,
                        window.currentDataForMap.detallesArbol || [],
                        window.currentDataForMap.tis_registro_tramite,
                        window.currentUserId
                    );
                }, 100);
            }
        });
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
        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
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
                } else {
                    window.location.href = `ver.php?id=${data[0].tis_id}`;
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

        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });

        const result = await response.json();

        if (result.status === 'success' || (result.data && !result.status)) {
            const data = result.data;
            const sessionUser = await checkSession();
            if (!sessionUser) return; // checkSession handles redirect
            if (sessionUser.id != data.tis_propietario) {
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
                        window.location.href = 'index.php';
                    });
                    return;
                }
            }

            currentRgtId = data.tis_registro_tramite;
            const btnHija = document.getElementById('btn_crear_hija');
            if (btnHija) {
                btnHija.href = `../ingresos/crear.php?rgt_id_padre=${currentRgtId}`;
            }

            // Mapeamos los campos del formulario con los IDs del DOM
            window.currentDataForMap = {
                multiancestro: data.multiancestro,
                tis_registro_tramite: data.tis_registro_tramite,
                detallesArbol: [] // Se llenará al cargar
            };
            window.currentUserId = sessionUser.id;

            // Cargar detalles del árbol preventivamente para el mapa
            const rgtIds = new Set();
            rgtIds.add(data.tis_registro_tramite);
            if (data.multiancestro) {
                Object.values(data.multiancestro).forEach(rel => {
                    rgtIds.add(rel.gma_padre);
                    rgtIds.add(rel.gma_hijo);
                });
            }

            try {
                const respDetalles = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ACCION: 'DETALLES_ARBOL', rgt_ids: Array.from(rgtIds) })
                });
                const resDetalles = await respDetalles.json();
                window.currentDataForMap.detallesArbol = resDetalles.data || [];
            } catch (e) {
                console.error("Error pre-loading tree details:", e);
            }

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
                    window.location.href = `responder.php?id=${id}`;
                };
            }

            const btnModificar = document.getElementById('btn_ir_modificar');
            if (btnModificar && id) {
                btnModificar.onclick = () => {
                    window.location.href = `modificar.php?id=${id}`;
                };
            }

            const btnPreparar = document.getElementById('btn_ir_preparar');
            if (btnPreparar && id) {
                btnPreparar.onclick = () => {
                    window.location.href = `preparar.php?id=${id}`;
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
    if (document.getElementById('info_tis_id')) {
        document.getElementById('info_tis_id').innerText = data.tis_id_raw || '-';
    }
    document.getElementById('info_rgt_id').innerText = data.rgt_id_raw || data.rgt_id || '-';
    document.getElementById('info_id_publica').innerText = data.rgt_id_publica || '-';
    document.getElementById('info_fecha').innerText = (data.tis_creacion && data.tis_creacion.length >= 10) ? data.tis_creacion.substring(0, 10) : '-';
    const responsable = data.resp_nombre ? `${data.resp_nombre} ${data.resp_apellido}` : `ID: ${data.tis_propietario}`;
    document.getElementById('info_responsable').innerText = responsable;
    document.getElementById('info_fecha_limite').innerText = data.tis_fecha_limite ? data.tis_fecha_limite.substring(0, 10) : 'Sin fecha límite';
    document.getElementById('info_contenido').innerHTML = data.tis_contenido ? data.tis_contenido.replace(/\n/g, '<br>') : 'Sin contenido';

    const badgeEstado = document.getElementById('badge_estado');
    badgeEstado.innerText = data.tis_estado || 'Pendiente';
    badgeEstado.className = `badge ${data.tis_estado === 'Ingresado' ? 'bg-success' : 'bg-primary'}`;

    document.getElementById('subtitulo_ingreso').innerText = `Expediente: ${data.tis_titulo} (Cód. ${data.rgt_id_publica})`;

    // Destinos
    const tablaDestinos = document.getElementById('tabla_destinos');
    tablaDestinos.innerHTML = '';

    if (data.destinos && data.destinos.length > 0) {
        data.destinos.forEach(dest => {
            let estadoColors = 'bg-slate-50 text-slate-400 border-slate-100';
            let estadoLabel = 'Pendiente';

            if (dest.tid_responde == 1) {
                estadoColors = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                estadoLabel = 'Aprobado';
            } else if ((dest.tid_responde == 0 || dest.tid_responde === '0') && dest.tid_fecha_respuesta) {
                estadoColors = 'bg-rose-50 text-rose-600 border-rose-100';
                estadoLabel = 'Rechazado';
            }

            const row = document.createElement('tr');
            row.className = 'hover:bg-slate-50/80 transition-all cursor-default group';
            row.innerHTML = `
                <td class="px-6 py-4">
                    <div class="font-bold text-slate-700 text-sm">${dest.usr_nombre} ${dest.usr_apellido}</div>
                    <div class="text-[10px] text-slate-400 truncate max-w-[180px]">${dest.usr_email}</div>
                </td>
                <!--<td class="px-6 py-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border bg-blue-50 text-primary-blue border-blue-100">
                        ${dest.tid_tipo}
                    </span>
                </td>-->
                <td class="px-6 py-4">
                    <span class="text-xs font-medium text-slate-500">${dest.tid_facultad}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs text-slate-400 italic">${dest.tid_tarea || '-'}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    ${dest.tid_requeido === '1'
                    ? '<span class="material-symbols-outlined text-emerald-500 text-lg">check_circle</span>'
                    : '<span class="material-symbols-outlined text-slate-200 text-lg">radio_button_unchecked</span>'}
                </td>
                <td class="px-6 py-4 text-right">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${estadoColors}">
                        ${estadoLabel}
                    </span>
                </td>
            `;
            tablaDestinos.appendChild(row);
        });
    } else {
        tablaDestinos.innerHTML = '<tr><td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">No hay destinatarios asignados.</td></tr>';
    }

    // Bitácora con Paginación
    const listaBitacora = document.getElementById('lista_bitacora');
    if (!listaBitacora) {
        console.warn('Elemento lista_bitacora no encontrado');
        return;
    }

    if (data.bitacora && Array.isArray(data.bitacora) && data.bitacora.length > 0) {
        // Invertimos para ver lo más reciente primero
        const bitacoraSorted = [...data.bitacora].reverse();
        window.currentBitacoraData = bitacoraSorted;
        renderBitacoraPagina(1);
    } else {
        listaBitacora.innerHTML = '<div class="p-4 text-center text-slate-400 text-xs italic">No hay registros de bitácora.</div>';
        const pagContainer = document.getElementById('paginacion_bitacora');
        if (pagContainer) pagContainer.innerHTML = '';
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
                    <span class="text-muted" style="font-size: 0.7rem;">${com.gco_creacion.substring(0, 10)}</span>
                </div>
                <div class="small text-dark">${com.gco_comentario}</div>
            `;
            listaComentarios.appendChild(div);
        });
    } else {
        listaComentarios.innerHTML = '<div class="list-group-item text-muted small">Sin comentarios.</div>';
    }

    // Multiancestro (Ancestry)
    renderizarTablaHijas(data);
    // Respuestas detalladas
    renderizarRespuestas(data.destinos || []);

    if (window.feather) window.feather.replace();
}

function renderizarRespuestas(destinos) {
    const contenedor = document.getElementById('contenedor_respuestas');
    if (!contenedor) return;
    contenedor.innerHTML = '';

    const respondidos = destinos.filter(d => d.tid_fecha_respuesta || d.tid_respuesta);

    if (respondidos.length === 0) return;

    const card = document.createElement('div');
    card.className = 'card shadow-sm border-0 mb-4';
    card.innerHTML = `
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-4">Respuestas de los Destinatarios</h5>
            <div id="lista_respuestas_detalle"></div>
        </div>
    `;
    contenedor.appendChild(card);

    const lista = card.querySelector('#lista_respuestas_detalle');

    respondidos.forEach(d => {
        let estadoColors = 'bg-emerald-50 text-emerald-600 border-emerald-100';
        let estadoLabel = 'Favorable';

        if (d.tid_responde == 0 || d.tid_responde === '0') {
            estadoColors = 'bg-rose-50 text-rose-600 border-rose-100';
            estadoLabel = 'No Favorable';
        }

        const item = document.createElement('div');
        item.className = 'bg-white border border-slate-100 rounded-2xl p-6 shadow-sm mb-6 last:mb-0 hover:border-blue-100 transition-colors';
        item.innerHTML = `
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4 pb-4 border-b border-slate-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary-blue font-bold text-sm">
                        ${d.usr_nombre ? d.usr_nombre[0] : '?'}${d.usr_apellido ? d.usr_apellido[0] : ''}
                    </div>
                    <div>
                        <div class="font-bold text-slate-800 text-sm">${d.usr_nombre} ${d.usr_apellido}</div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">${d.tid_facultad}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${estadoColors}">
                        ${estadoLabel}
                    </span>
                    <span class="text-[10px] font-bold text-slate-400">
                        ${d.tid_fecha_respuesta ? d.tid_fecha_respuesta.substring(0, 16) : ''}
                    </span>
                </div>
            </div>
            <div class="text-slate-600 text-[14px] leading-relaxed italic bg-slate-50/50 p-4 rounded-xl border border-slate-100" style="white-space: pre-wrap;">
                ${d.tid_respuesta || '<span class="text-slate-400 italic">Sin respuesta detallada</span>'}
            </div>
        `;
        lista.appendChild(item);
    });
}

function renderBitacoraPagina(pagina) {
    const itemsPorPagina = 10;
    const listaBitacora = document.getElementById('lista_bitacora');
    if (!listaBitacora || !window.currentBitacoraData) return;

    listaBitacora.innerHTML = '';
    const inicio = (pagina - 1) * itemsPorPagina;
    const fin = inicio + itemsPorPagina;
    const items = window.currentBitacoraData.slice(inicio, fin);

    items.forEach(entry => {
        const item = document.createElement('div');
        item.className = 'relative pl-6 pb-6 border-l-2 border-slate-100 last:border-l-0';
        item.innerHTML = `
            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-2 border-primary-blue shadow-sm"></div>
            <div class="space-y-1">
                <div class="flex justify-between items-start">
                    <div class="text-xs font-bold text-slate-700 uppercase tracking-tight">${entry.bit_evento}</div>
                    <div class="text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 rounded border border-slate-100">
                        ${entry.bit_creacion ? entry.bit_creacion.substring(0, 16) : '-'}
                    </div>
                </div>
                <div class="text-[11px] text-slate-500 font-medium">
                    Por: <span class="text-primary-blue font-bold">${entry.usr_nombre || 'Sistema'} ${entry.usr_apellido || ''}</span>
                </div>
                ${entry.bit_descripcion ? `<div class="text-[11px] text-slate-400 italic mt-1 leading-relaxed">${entry.bit_descripcion}</div>` : ''}
            </div>
        `;
        listaBitacora.appendChild(item);
    });

    renderPaginacionBitacora(window.currentBitacoraData.length, pagina);
}

function renderPaginacionBitacora(total, paginaActual) {
    const container = document.getElementById('paginacion_bitacora');
    if (!container) return;

    const itemsPorPagina = 10;
    const paginasTotales = Math.ceil(total / itemsPorPagina);
    container.innerHTML = '';

    if (paginasTotales <= 1) return;

    // Botón Anterior
    const btnAnt = document.createElement('button');
    btnAnt.className = `p-2 rounded-lg transition-all ${paginaActual === 1 ? 'text-slate-200 cursor-not-allowed' : 'text-slate-500 hover:bg-slate-50 hover:text-primary-blue'}`;
    btnAnt.innerHTML = '<span class="material-symbols-outlined text-lg">chevron_left</span>';
    btnAnt.disabled = paginaActual === 1;
    btnAnt.onclick = () => renderBitacoraPagina(paginaActual - 1);
    container.appendChild(btnAnt);

    // Indicador de Pág
    const span = document.createElement('span');
    span.className = 'text-[11px] font-bold text-slate-400 uppercase tracking-widest px-4';
    span.innerText = `Pág. ${paginaActual} de ${paginasTotales}`;
    container.appendChild(span);

    // Botón Siguiente
    const btnSig = document.createElement('button');
    btnSig.className = `p-2 rounded-lg transition-all ${paginaActual === paginasTotales ? 'text-slate-200 cursor-not-allowed' : 'text-slate-500 hover:bg-slate-50 hover:text-primary-blue'}`;
    btnSig.innerHTML = '<span class="material-symbols-outlined text-lg">chevron_right</span>';
    btnSig.disabled = paginaActual === paginasTotales;
    btnSig.onclick = () => renderBitacoraPagina(paginaActual + 1);
    container.appendChild(btnSig);
}

function renderizarMapa(relaciones, detalles = [], currentRgtId, userId = null) {
    const container = document.getElementById('network-container');
    const nodes = new vis.DataSet();
    const edges = new vis.DataSet();
    const addedNodes = new Set();
    const detallesMap = new Map();

    if (Array.isArray(detalles)) {
        detalles.forEach(d => {
            const rid = d.rgt_id_raw || d.rgt_id;
            if (rid) detallesMap.set(parseInt(rid), d);
        });
    }

    function getColorForNode(rgtId) {
        if (parseInt(rgtId) === parseInt(currentRgtId)) return '#ffc107';
        const det = detallesMap.get(parseInt(rgtId));
        if (det) {
            if (det.tis_estado === 'Resuelto_Favorable') return '#198754';
            if (det.tis_estado === 'Resuelto_NO_Favorable') return '#000000';
            const hasDest = det.destinos && det.destinos.length > 0;
            if (!hasDest) {
                return (parseInt(det.tis_propietario) === parseInt(userId)) ? '#dc3545' : '#fd7e14';
            }
        }
        return '#97c2fc';
    }

    function getTooltip(rgtId) {
        const det = detallesMap.get(parseInt(rgtId));
        return det ? det.tis_titulo : `RT-${rgtId}`;
    }

    const childrenOf = {};
    Object.values(relaciones).forEach(rel => {
        const p = rel.gma_padre_raw || rel.gma_padre;
        const h = rel.gma_hijo_raw || rel.gma_hijo;

        if (!childrenOf[p]) childrenOf[p] = [];
        childrenOf[p].push(h);

        [p, h].forEach(id => {
            if (!addedNodes.has(id)) {
                const det = detallesMap.get(parseInt(id));
                const label = det ? (det.tis_titulo || `RT-${id}`) : `RT-${id}`;
                nodes.add({ id, label: label, color: getColorForNode(id), title: getTooltip(id) });
                addedNodes.add(id);
            }
        });
        edges.add({ from: p, to: h, arrows: 'from' });
    });

    if (!addedNodes.has(parseInt(currentRgtId)) && currentRgtId) {
        const id = parseInt(currentRgtId);
        const det = detallesMap.get(id);
        const label = det ? (det.tis_titulo || `RT-${id}`) : `RT-${id}`;
        nodes.add({ id, label: label, color: '#ffc107', title: getTooltip(id) });
    }

    const data = { nodes, edges };
    const options = {
        layout: { hierarchical: { direction: 'UD', sortMethod: 'directed' } },
        physics: false,
        nodes: {
            shape: 'box',
            margin: 10,
            widthConstraint: {
                maximum: 92 // Forza al texto a hacer saltos de línea largos
            },
            font: {
                multi: 'html' // Opcional, pero vis soporta multiline automático limitando el wrap
            }
        },
        interaction: { hover: true, selectConnectedEdges: false }
    };

    let network = new vis.Network(container, data, options);
    window.currentNetworkInstance = network;
    window.currentRgtIdForMap = parseInt(currentRgtId);

    // Ajustar y enfocar cuando carga inicialmente
    setTimeout(() => {
        network.fit();
        network.focus(window.currentRgtIdForMap, { scale: 1.0, animation: { duration: 800, easingFunction: "easeInOutQuad" } });
    }, 500);

    network.on("selectNode", (params) => {
        const sid = params.nodes[0];
        const det = detallesMap.get(parseInt(sid));
        if (det && det.tis_id) {
            if (parseInt(sid) === parseInt(currentRgtId)) return;
            window.location.href = `ver.php?id=${det.tis_id}`;
        }
    });

    if (window.feather) window.feather.replace();
}

function renderizarTablaHijas(data) {
    const tbody = document.getElementById('tabla_hijas_directas');
    if (!tbody) return;

    tbody.innerHTML = '';

    // We need current rgtId
    const rgtId = parseInt(data.tis_registro_tramite_raw || data.tis_registro_tramite);
    const relaciones = data.multiancestro || {};

    // Find all direct children
    const directChildrenRgtIds = [];
    Object.values(relaciones).forEach(rel => {
        const pad = parseInt(rel.gma_padre_raw || rel.gma_padre);
        const hij = parseInt(rel.gma_hijo_raw || rel.gma_hijo);
        if (pad === rgtId) {
            directChildrenRgtIds.push(hij);
        }
    });

    if (directChildrenRgtIds.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-6 text-slate-400 italic">No hay solicitudes hijas directas.</td></tr>';
        return;
    }

    const detallesArbol = (window.currentDataForMap && window.currentDataForMap.detallesArbol) ? window.currentDataForMap.detallesArbol : [];
    const detallesMap = new Map();
    detallesArbol.forEach(d => {
        const rid = d.rgt_id_raw || d.rgt_id;
        if (rid) detallesMap.set(parseInt(rid), d);
    });

    directChildrenRgtIds.forEach(hijoRgtId => {
        const det = detallesMap.get(hijoRgtId);
        if (det) {
            let badgeClass = 'bg-blue-50 text-primary-blue border-blue-100';
            if (det.tis_estado === 'Resuelto_Favorable') badgeClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            else if (det.tis_estado === 'Resuelto_NO_Favorable') badgeClass = 'bg-rose-50 text-rose-600 border-rose-100';
            else if (det.tis_estado === 'Ingresado') badgeClass = 'bg-amber-50 text-amber-600 border-amber-100';

            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50/50 transition-colors';
            tr.innerHTML = `
                <td class="px-6 py-4 font-bold text-slate-700">${det.rgt_id_publica || det.tis_id_raw || '-'}</td>
                <td class="px-6 py-4 text-slate-600 font-medium">${det.tis_titulo || 'Sin título'}</td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border ${badgeClass}">
                        ${det.tis_estado}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="ver.php?id=${det.tis_id}" class="inline-flex items-center gap-1 text-primary-blue hover:text-blue-800 font-bold text-xs uppercase tracking-widest bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[16px]">visibility</span> Ver
                    </a>
                </td>
            `;
            tbody.appendChild(tr);
        } else {
            // Unresolved detail
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50/50 transition-colors';
            tr.innerHTML = `
                <td class="px-6 py-4 font-bold text-slate-400">RGT-${hijoRgtId}</td>
                <td class="px-6 py-4 text-slate-400 italic">Detalles no disponibles</td>
                <td class="px-6 py-4">-</td>
                <td class="px-6 py-4 text-right">-</td>
            `;
            tbody.appendChild(tr);
        }
    });
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
    window.currentNetworkInstance = network;
    window.currentRgtIdForMap = parseInt(currentId);

    setTimeout(() => {
        network.fit();
        network.focus(window.currentRgtIdForMap, { scale: 1.0, animation: { duration: 800, easingFunction: "easeInOutQuad" } });
    }, 500);

    network.on("doubleClick", (params) => {
        if (params.nodes.length > 0 && params.nodes[0] != currentId) {
            window.location.search = `?rgt_id=${params.nodes[0]}`;
        }
    });

    if (window.feather) window.feather.replace();
}

async function descargarDocumento(Id, nombre) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/gesdoc/general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'Bajar', doc_id: Id }),
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
        const response = await fetch(`${window.API_BASE_URL}/general/comentarios.php`, {
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
        window.location.href = 'index.php';
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

        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
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
        const response = await fetch(`${window.API_BASE_URL}/general/verify_session.php`, {
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

// Escuchar el evento cuando se muestra la pestaña "Dependencia"
document.addEventListener('shown.bs.tab', async function (event) {
    if (event.target.getAttribute('data-bs-target') === '#tab-dependencia') {

        // Si ya renderizamos el mapa antes, solo reenfocamos
        if (window.mapRendered && window.currentNetworkInstance && window.currentRgtIdForMap) {
            window.currentNetworkInstance.fit();
            setTimeout(() => {
                window.currentNetworkInstance.focus(window.currentRgtIdForMap, {
                    scale: 1.0,
                    animation: { duration: 800, easingFunction: "easeInOutQuad" }
                });
            }, 50);
            return;
        }

        // Si no está renderizado, preparamos la data
        if (window.currentDataForMap && window.currentDataForMap.multiancestro && Object.keys(window.currentDataForMap.multiancestro).length > 0) {
            const dataMap = window.currentDataForMap;
            const multiancestro = dataMap.multiancestro;
            const rgtId = dataMap.tis_registro_tramite;

            const rgtIds = new Set();
            rgtIds.add(parseInt(rgtId));
            Object.values(multiancestro).forEach(rel => {
                rgtIds.add(parseInt(rel.gma_padre));
                rgtIds.add(parseInt(rel.gma_hijo));
            });

            try {
                // Fetch tree details for colors / tooltips
                const respDetalles = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ACCION: 'DETALLES_ARBOL', rgt_ids: Array.from(rgtIds) })
                });
                const resDetalles = await respDetalles.json();

                // Llama la función render pre-existente
                setTimeout(() => renderizarMapa(multiancestro, resDetalles.data || [], rgtId, window.currentUserId), 100);
            } catch (e) {
                console.error("Error loading tree details:", e);
                // Fallback sin detalles
                setTimeout(() => renderizarMapaRelaciones(multiancestro, rgtId), 100);
            }

            window.mapRendered = true;
        } else {
            // Manejar un caso donde no haya relaciones: mostrar mensaje
            const container = document.getElementById('network-container');
            if (container) {
                container.innerHTML = '<div class="flex items-center justify-center h-full text-slate-400 italic">No hay relaciones registradas para este documento.</div>';
            }
        }
    }
});

window.abrirModalEstablecerDependencia = async function () {
    const modalEl = document.getElementById('modalEstablecerDependencia');
    if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
        await cargarSolicitudesParaDependencia();

        // Configurar filtro de búsqueda
        const buscarInput = document.getElementById('buscar_padre');
        if (buscarInput) {
            buscarInput.onkeyup = function () {
                const text = this.value.toLowerCase();
                const rows = document.querySelectorAll('#lista_solicitudes_padre tr');
                rows.forEach(row => {
                    row.style.display = row.innerText.toLowerCase().includes(text) ? '' : 'none';
                });
            };
        }
    } else {
        console.error("No se encontró el modal modalEstablecerDependencia");
    }
}

async function cargarSolicitudesParaDependencia() {
    try {
        const tbody = document.getElementById('lista_solicitudes_padre');
        tbody.innerHTML = '<tr><td colspan="4" class="text-center p-3">Cargando...</td></tr>';

        const respSession = await fetch(`${window.API_BASE_URL}/general/verify_session.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'VERIFICAR' })
        });
        const sessionData = await respSession.json();
        const currentUserId = sessionData.user?.id;

        if (!currentUserId) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">Error de sesión</td></tr>';
            return;
        }

        const resp = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const result = await resp.json();

        if (result.status === 'success') {
            const filtered = result.data.filter(sol =>
                parseInt(sol.tis_propietario) === parseInt(currentUserId) &&
                sol.tis_estado !== 'Resuelto_Favorable' &&
                sol.tis_estado !== 'Resuelto_NO_Favorable' &&
                parseInt(sol.tis_registro_tramite) !== parseInt(currentRgtId)
            );

            if (filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">No hay solicitudes elegibles</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            filtered.forEach(sol => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="small fw-bold">${sol.tis_id || sol.rgt_id_publica}</td>
                    <td class="small">${sol.tis_titulo}</td>
                    <td><span class="badge bg-light text-dark border small">${sol.tis_estado}</span></td>
                    <td>
                        <button class="btn btn-sm btn-success py-0 px-2" onclick="vincularComoPadre(${sol.tis_registro_tramite}, '${sol.tis_titulo}')">
                            Vincular
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
    } catch (e) { console.error(e); }
}

window.vincularComoPadre = async function (parentRgtId, parentTitle) {
    const confirm = await Swal.fire({
        title: '¿Vincular Dependencia?',
        text: `¿Vincular "${parentTitle}" como un antecesor?`,
        icon: 'question',
        showCancelButton: true
    });

    if (!confirm.isConfirmed) return;

    try {
        Swal.fire({ title: 'Vinculando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const respLink = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'VINCULAR_HIJO', padre_id: parentRgtId, hijo_id: currentRgtId })
        });
        const resLink = await respLink.json();

        if (resLink.status === 'success') {
            Swal.fire('Éxito', 'Dependencia establecida.', 'success');
            const m = bootstrap.Modal.getInstance(document.getElementById('modalEstablecerDependencia'));
            if (m) m.hide();
            location.reload();
        } else {
            Swal.fire('Error', resLink.message || 'Fallo al vincular', 'error');
        }
    } catch (e) { console.error(e); }
};