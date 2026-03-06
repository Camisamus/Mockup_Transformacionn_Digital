document.addEventListener('DOMContentLoaded', async () => {
    // SSR Sync: Si el servidor ya inyectó los datos, los usamos directamente
    if (window.serverData) {
        console.log("SSR: Usando datos precargados del servidor");
        // Nota: window.currentUserId ya viene inyectado desde ver.php
        await inicializarConSSR(window.serverData);
    } else {
        // Fallback para CSR (aunque en esta versión siempre habrá serverData)
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        const rgtId = urlParams.get('rgt_id');

        if (id || rgtId) {
            cargarDatosIngreso({ ing_id: id, rgt_id: rgtId });
        } else {
            checkAndRequestID();
        }
    }

    // Inicialización de pestañas de Bootstrap 5 nativa
    const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(tabEl => {
        tabEl.addEventListener('click', function (event) {
            event.preventDefault();
            const tab = bootstrap.Tab.getOrCreateInstance(this);
            tab.show();
        });
    });

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


async function crearDerivacion() {
    const urlParams = new URLSearchParams(window.location.search);
    currentRgtId = urlParams.get('id');
    window.open(`../ingresos/crear.php?rgt_id_padre=${currentRgtId}`, '_blank');
}

function descargarExpediente() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        Swal.fire('Error', 'ID de solicitud no encontrado.', 'error');
        return;
    }

    // Abrir directamente el PHP que genera el PDF en modo nativo
    // Pasamos el ID por GET para acceso directo desde la nueva pestaña
    window.open(`${window.API_BASE_URL}/reportes/pdf_ingresos_expediente.php?ID=${id}`, '_blank');
}
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
                console.log(data['tis_id_raw']);
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
    //document.getElementById('info_rgt_id').innerText = data.rgt_id_raw || data.rgt_id || '-';
    //document.getElementById('info_id_publica').innerText = data.rgt_id_publica || '-';
    if (document.getElementById('info_tipo')) {
        document.getElementById('info_tipo').innerText = data.tis_tipo || 'Ingreso General';
    }
    document.getElementById('info_contenido').innerHTML = data.tis_contenido ? data.tis_contenido.replace(/\n/g, '<br>') : 'Sin contenido';

    const badgeEstado = document.getElementById('badge_estado');
    badgeEstado.innerText = data.tis_estado || 'Pendiente';
    badgeEstado.className = `badge ${data.tis_estado === 'Ingresado' ? 'bg-success' : 'bg-primary'}`;

    //document.getElementById('subtitulo_ingreso').innerText = `Expediente: ${data.tis_titulo} (Cód. ${data.rgt_id_publica})`;

    if (document.getElementById('info_fecha')) {
        document.getElementById('info_fecha').innerText = (data.tis_creacion && data.tis_creacion.length >= 10) ? data.tis_creacion.substring(0, 10) : '-';
    }
    if (document.getElementById('info_responsable')) {
        const responsable = data.resp_nombre ? `${data.resp_nombre} ${data.resp_apellido}` : `ID: ${data.tis_propietario}`;
        document.getElementById('info_responsable').innerText = responsable;
    }
    if (document.getElementById('info_fecha_limite')) {
        document.getElementById('info_fecha_limite').innerText = data.tis_fecha_limite ? data.tis_fecha_limite.substring(0, 10) : 'Sin fecha límite';
    }

    // Flujo de Visación (Timeline Estilo Imagen 3)
    const timeline = document.getElementById('flujo_visacion_timeline');
    if (timeline && data.destinos) {
        timeline.innerHTML = '';
        data.destinos.forEach(d => {
            let icon = 'radio_button_unchecked';
            let iconColor = 'text-slate-300';
            let statusText = 'En espera';
            let statusClass = 'text-slate-400';
            let detailText = '';
            let canVisar = false;

            const esUsuarioActual = parseInt(d.tid_destino) === parseInt(window.currentUserId);

            if (d.tid_responde == 1) {
                icon = 'check_circle';
                iconColor = 'text-cyan-600';
                statusText = 'Visado';
                statusClass = 'text-slate-400';
                detailText = `Visado el ${d.tid_fecha_resp ? d.tid_fecha_resp.substring(0, 16).replace(' ', ' ') : ''}`;
            } else if ((d.tid_responde == 0 || d.tid_responde === '0') && d.tid_fecha_respuesta) {
                icon = 'cancel';
                iconColor = 'text-rose-500';
                statusText = 'Rechazado';
                statusClass = 'text-rose-500';
                detailText = `Rechazado el ${d.tid_fecha_respuesta.substring(0, 16)}`;
            } else if (!d.tid_fecha_respuesta && d.tid_requeido == 1) {
                // Si es el usuario actual, marcamos pendiente activa
                if (esUsuarioActual) {
                    icon = 'pending'; // El círculo con los tres puntitos
                    iconColor = 'text-amber-500';
                    statusText = 'Pendiente de Visación';
                    statusClass = 'text-amber-500 font-bold';
                    canVisar = true;
                } else {
                    icon = 'radio_button_unchecked';
                    iconColor = 'text-slate-300';
                    statusText = 'En espera';
                    statusClass = 'text-slate-400';
                }
            }

            const item = document.createElement('div');
            item.className = 'px-6 py-5 flex items-center justify-between hover:bg-slate-50 transition-colors';
            item.innerHTML = `
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0">
                        <span class="material-symbols-outlined ${iconColor} text-[32px]">${icon}</span>
                    </div>
                    <div>
                        <div class="font-black text-slate-700 text-[15px] leading-tight">
                            ${esUsuarioActual ? 'Ud.' : d.usr_nombre + ' ' + d.usr_apellido} (${d.tid_facultad})
                        </div>
                        <div class="text-[12px] ${statusClass} mt-0.5">
                            ${detailText || statusText}
                        </div>
                    </div>
                </div>
                ${canVisar ? `
                    <button onclick="irAResponder()" class="px-4 py-1.5 bg-[#346d77] text-white rounded text-[12px] font-bold hover:bg-[#2a5861] transition-all shadow-sm">
                        Visar
                    </button>
                ` : ''}
            `;
            timeline.appendChild(item);
        });
    }

    // Vista Rápida: Subtareas / Derivaciones (Estilo Imagen 2)
    const miniTabla = document.getElementById('tabla_derivaciones_mini');
    if (miniTabla) {
        miniTabla.innerHTML = '';
        if (data.destinos && data.destinos.length > 0) {
            data.destinos.forEach(dest => {
                let statusClass = 'bg-amber-100 text-amber-700';
                let statusLabel = 'Pendiente';

                if (dest.tid_responde == 1) {
                    statusClass = 'bg-emerald-100 text-emerald-700';
                    statusLabel = 'Completada';
                } else if ((dest.tid_responde == 0 || dest.tid_responde === '0') && dest.tid_fecha_respuesta) {
                    statusClass = 'bg-rose-100 text-rose-700';
                    statusLabel = 'Rechazada';
                }

                const item = document.createElement('div');
                item.className = 'flex items-center justify-between group py-2 px-1';
                item.innerHTML = `
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-slate-300 text-lg rotate-180">subdirectory_arrow_right</span>
                        <div>
                            <div class="font-black text-slate-700 text-[12px] leading-tight mb-0.5">${dest.tid_tarea || 'Consultar / Revisar'}</div>
                            <div class="text-[10px] text-slate-400 font-medium">Asignado a: ${dest.usr_nombre} ${dest.usr_apellido}</div>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-tighter ${statusClass}">
                        ${statusLabel}
                    </span>
                `;
                miniTabla.appendChild(item);
            });
        } else {
            miniTabla.innerHTML = '<div class="py-6 text-center text-slate-400 italic text-[11px]">Sin derivaciones activas.</div>';
        }
    }

    // Bitácora con Paginación
    const listaBitacora = document.getElementById('lista_bitacora');
    if (listaBitacora) {
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
    } else {
        console.info('Elemento lista_bitacora no existe o no tiene permisos.');
    }

    // Enlaces
    const listaEnlaces = document.getElementById('lista_enlaces_grid');
    if (listaEnlaces) {
        listaEnlaces.innerHTML = '';
        if (data.enlaces && data.enlaces.length > 0) {
            data.enlaces.forEach(link => {
                const url = link.tge_enlace.startsWith('http') ? link.tge_enlace : `https://${link.tge_enlace}`;
                const div = document.createElement('div');
                div.className = 'bg-slate-50 border border-slate-100 rounded-xl p-4 flex items-center justify-between group hover:bg-blue-50 hover:border-blue-100 transition-all cursor-pointer';
                div.onclick = () => window.open(url, '_blank');
                div.innerHTML = `
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-primary-blue group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">link</span>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-[13px] font-bold text-slate-700 truncate">${link.tge_enlace}</div>
                            <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Enlace Externo</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-primary-blue transition-colors">open_in_new</span>
                `;
                listaEnlaces.appendChild(div);
            });
        }
    }

    // Documentos
    const listaDocumentos = document.getElementById('lista_documentos_grid');
    if (listaDocumentos) {
        listaDocumentos.innerHTML = '';
        if (data.documentos && data.documentos.length > 0) {
            data.documentos.forEach(doc => {
                const div = document.createElement('div');
                div.className = 'bg-slate-50 border border-slate-100 rounded-xl p-4 flex items-center justify-between group hover:bg-blue-50 hover:border-blue-100 transition-all cursor-pointer';
                div.onclick = () => descargarDocumento(doc.doc_id, doc.doc_nombre_documento);
                div.innerHTML = `
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-rose-500 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-[13px] font-bold text-slate-700 truncate" title="${doc.doc_nombre_documento}">${doc.doc_nombre_documento}</div>
                            <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Documento PDF / Adjunto</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-primary-blue transition-colors">download</span>
                `;
                listaDocumentos.appendChild(div);
            });
        }
    }

    // Comentarios
    const listaComentarios = document.getElementById('lista_comentarios');
    if (listaComentarios) {
        listaComentarios.innerHTML = '';
        if (data.comentarios && data.comentarios.length > 0) {
            data.comentarios.forEach(com => {
                const div = document.createElement('div');
                div.className = 'bg-white border border-slate-100 rounded-2xl p-5 shadow-sm hover:border-blue-100 transition-colors';
                div.innerHTML = `
                    <div class="flex justify-between items-center mb-3">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-primary-blue flex items-center justify-center font-bold text-xs">
                                ${com.usr_nombre[0]}${com.usr_apellido[0]}
                            </div>
                            <span class="text-[13px] font-black text-slate-800">${com.usr_nombre} ${com.usr_apellido}</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">${com.gco_creacion.substring(0, 16)}</span>
                    </div>
                    <div class="text-[14px] text-slate-600 leading-relaxed italic border-l-4 border-slate-100 pl-4 py-1">
                        ${com.gco_comentario}
                    </div>
                `;
                listaComentarios.appendChild(div);
            });
        } else {
            listaComentarios.innerHTML = '<div class="py-10 text-center text-slate-400 text-sm italic">No hay comentarios registrados aún.</div>';
        }
    }

    // Multiancestro (Ancestry)
    renderizarTablaHijas(data);
    renderizarTablaProgenitoras(data);
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
    if (!container) return;

    // Limpiar contenedor para evitar duplicados si se llama varias veces
    container.innerHTML = '';

    const nodes = new vis.DataSet();
    const edges = new vis.DataSet();
    const addedNodes = new Set();
    const detallesMap = new Map();

    // Normalizar detalles para búsqueda rápida
    if (Array.isArray(detalles)) {
        detalles.forEach(d => {
            const rid = d.rgt_id_raw || d.rgt_id;
            if (rid) detallesMap.set(parseInt(rid), d);
        });
    }

    function getColorForNode(rgtId) {
        if (parseInt(rgtId) === parseInt(currentRgtId)) return '#ffc107'; // Amarillo para actual
        const det = detallesMap.get(parseInt(rgtId));
        if (det) {
            if (det.tis_estado === 'Resuelto_Favorable') return '#198754';
            if (det.tis_estado === 'Resuelto_NO_Favorable') return '#dc3545';
            if (det.tis_estado === 'Ingresado') return '#0d6efd';
        }
        return '#97c2fc'; // Color por defecto (Lector o Pendiente)
    }

    function getTooltip(rgtId) {
        const det = detallesMap.get(parseInt(rgtId));
        return det ? `${det.tis_titulo}\nEstado: ${det.tis_estado || '?'}` : `RT-${rgtId}`;
    }

    // Convertir relaciones a array si es objeto
    const relArray = Array.isArray(relaciones) ? relaciones : Object.values(relaciones);

    console.log("Renderizando mapa con relaciones:", relArray);

    relArray.forEach(rel => {
        const p = parseInt(rel.gma_padre_raw || rel.gma_padre);
        const h = parseInt(rel.gma_hijo_raw || rel.gma_hijo);

        if (isNaN(p) || isNaN(h)) return;

        // Agregar Nodos
        [p, h].forEach(id => {
            if (!addedNodes.has(id)) {
                const det = detallesMap.get(id);
                const label = det ? (det.tis_titulo || `RT-${id}`) : `RT-${id}`;
                nodes.add({
                    id,
                    label: label,
                    color: {
                        background: getColorForNode(id),
                        border: '#2b7ce9'
                    },
                    title: getTooltip(id)
                });
                addedNodes.add(id);
            }
        });

        // Agregar Aristas (Flechas)
        edges.add({
            from: p,
            to: h,
            arrows: {
                from: { enabled: true, scaleFactor: 1, type: 'arrow' }
            },
            color: { color: '#848484' }
        });
    });

    // Asegurar que el nodo actual esté presente aunque no tenga relaciones
    if (currentRgtId && !addedNodes.has(parseInt(currentRgtId))) {
        const id = parseInt(currentRgtId);
        const det = detallesMap.get(id);
        const label = det ? (det.tis_titulo || `RT-${id}`) : `RT-${id}`;
        nodes.add({
            id,
            label: label,
            color: { background: '#ffc107', border: '#e67e22' },
            title: getTooltip(id)
        });
        addedNodes.add(id);
    }

    const data = { nodes, edges };
    const options = {
        layout: {
            hierarchical: {
                enabled: true,
                direction: 'UD',
                sortMethod: 'directed',
                nodeSpacing: 150,
                levelSeparation: 150
            }
        },
        physics: {
            hierarchicalRepulsion: {
                nodeDistance: 120
            }
        },
        nodes: {
            shape: 'box',
            margin: 10,
            widthConstraint: {
                maximum: 120
            },
            font: {
                size: 12,
                face: 'Inter',
                multi: 'html'
            },
            borderWidth: 2,
            shadow: true
        },
        edges: {
            width: 2,
            shadow: true,
            smooth: {
                type: 'cubicBezier',
                forceDirection: 'vertical',
                roundness: 0.4
            }
        },
        interaction: {
            hover: true,
            selectConnectedEdges: false,
            tooltipDelay: 200
        }
    };

    let network = new vis.Network(container, data, options);
    window.currentNetworkInstance = network;
    window.currentRgtIdForMap = parseInt(currentRgtId);

    // Ajustar y enfocar
    network.once('afterDrawing', () => {
        network.fit();
        if (window.currentRgtIdForMap) {
            network.focus(window.currentRgtIdForMap, {
                scale: 1.0,
                animation: { duration: 1000, easingFunction: "easeInOutQuad" }
            });
        }
    });

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
    const rgtId = parseInt(data.tis_registro_tramite_raw || data.tis_registro_tramite || data.rgt_id_raw || data.rgt_id);
    const relaciones = data.multiancestro || {};

    // Find all direct children
    const directChildrenRgtIds = [];
    const relArray = Array.isArray(relaciones) ? relaciones : Object.values(relaciones);

    relArray.forEach(rel => {
        const pad = parseInt(rel.gma_padre_raw || rel.gma_padre);
        const hij = parseInt(rel.gma_hijo_raw || rel.gma_hijo);
        if (pad && pad === rgtId && hij) {
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

function renderizarTablaProgenitoras(data) {
    const tbody = document.getElementById('tabla_progenitoras');
    if (!tbody) return;
    tbody.innerHTML = '';

    const rgtId = parseInt(data.tis_registro_tramite_raw || data.tis_registro_tramite || data.rgt_id_raw || data.rgt_id);
    const relaciones = data.multiancestro || {};
    const directParentRgtIds = [];
    const relArray = Array.isArray(relaciones) ? relaciones : Object.values(relaciones);

    relArray.forEach(rel => {
        const pad = parseInt(rel.gma_padre_raw || rel.gma_padre);
        const hij = parseInt(rel.gma_hijo_raw || rel.gma_hijo);
        if (hij && hij === rgtId && pad) {
            directParentRgtIds.push(pad);
        }
    });

    if (directParentRgtIds.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-6 text-slate-400 italic">No hay solicitudes progenitoras.</td></tr>';
        return;
    }

    const detallesArbol = (window.currentDataForMap && window.currentDataForMap.detallesArbol) ? window.currentDataForMap.detallesArbol : [];
    const detallesMap = new Map();
    detallesArbol.forEach(d => {
        const rid = d.rgt_id_raw || d.rgt_id;
        if (rid) detallesMap.set(parseInt(rid), d);
    });

    directParentRgtIds.forEach(padreRgtId => {
        const det = detallesMap.get(padreRgtId);
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
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50/50 transition-colors';
            tr.innerHTML = `
                <td class="px-6 py-4 font-bold text-slate-400">RGT-${padreRgtId}</td>
                <td class="px-6 py-4 text-slate-400 italic">Detalles no disponibles</td>
                <td class="px-6 py-4">-</td>
                <td class="px-6 py-4 text-right">-</td>
            `;
            tbody.appendChild(tr);
        }
    });
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
        if (window.currentDataForMap && window.currentDataForMap.multiancestro) {
            const dataMap = window.currentDataForMap;
            const multiancestro = dataMap.multiancestro;
            const rgtId = dataMap.tis_registro_tramite;

            try {
                // Llama la función render con los detalles ya cargados
                const currentIdNum = parseInt(rgtId);
                setTimeout(() => renderizarMapa(multiancestro, window.currentDataForMap.detallesArbol || [], currentIdNum, window.currentUserId), 100);
            } catch (e) {
                console.error("Error loading tree details:", e);
                const currentIdNum = parseInt(rgtId);
                setTimeout(() => renderizarMapa(multiancestro, [], currentIdNum, window.currentUserId), 100);
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

async function inicializarConSSR(data) {
    currentRgtId = parseInt(data.tis_registro_tramite_raw || data.tis_registro_tramite);
    window.currentUserId = parseInt(window.currentUserId || 0);

    // Configurar enlace para solicitud hija
    const btnHija = document.getElementById('btn_crear_hija');
    if (btnHija) {
        btnHija.href = `../ingresos/crear.php?rgt_id_padre=${currentRgtId}`;
    }

    // Datos para el Mapa
    window.currentDataForMap = {
        multiancestro: data.multiancestro || {},
        tis_registro_tramite: currentRgtId,
        detallesArbol: []
    };

    // Await the details before rendering tables that need them
    await preCargarDetallesArbol(data);

    // Now render everything
    renderizarIngreso(data);

    // Restaurar manejadores de botones (ya renderizados por PHP)
    const id = data.tis_id;
    const btnResponder = document.getElementById('btn_ir_responder');
    if (btnResponder && id) {
        btnResponder.onclick = () => window.location.href = `responder.php?id=${id}`;
    }

    const btnModificar = document.getElementById('btn_ir_modificar');
    if (btnModificar && id) {
        btnModificar.onclick = () => window.location.href = `modificar.php?id=${id}`;
    }

    const btnComent = document.getElementById('btn_abrir_comentario');
    if (btnComent) {
        btnComent.onclick = () => {
            const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
            modal.show();
        };
    }

    // Cargar bitácora si existe el contenedor
    //if (document.getElementById('lista_bitacora')) {
    //    actualizarBitacora(data.tis_id);
    //}

    if (data.destinos && document.getElementById('tabla_destinos')) {
        renderizarDestinos(data.destinos);
    }
}

async function preCargarDetallesArbol(data) {
    const rgtIds = new Set();
    const mainRgtId = parseInt(data.tis_registro_tramite_raw || data.tis_registro_tramite);
    if (!isNaN(mainRgtId)) rgtIds.add(mainRgtId);

    if (data.multiancestro) {
        const relNodes = Array.isArray(data.multiancestro) ? data.multiancestro : Object.values(data.multiancestro);
        relNodes.forEach(rel => {
            const p = parseInt(rel.gma_padre_raw || rel.gma_padre);
            const h = parseInt(rel.gma_hijo_raw || rel.gma_hijo);
            if (!isNaN(p)) rgtIds.add(p);
            if (!isNaN(h)) rgtIds.add(h);
        });
    }

    const idsArray = Array.from(rgtIds).filter(id => !isNaN(id) && id !== null);
    if (idsArray.length === 0) return;

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
}

function renderizarDestinos(destinos) {
    const tablaDestinos = document.getElementById('tabla_destinos');
    if (!tablaDestinos) return;
    tablaDestinos.innerHTML = '';

    destinos.forEach(dest => {
        let estadoColors = 'bg-slate-50 text-slate-400 border-slate-100';
        let estadoLabel = 'Pendiente';

        if (dest.tid_confirmado === 1) {
            estadoColors = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            estadoLabel = 'Visado';
        } else if (dest.tid_confirmado === -1) {
            estadoColors = 'bg-rose-50 text-rose-600 border-rose-100';
            estadoLabel = 'Rechazado';
        }

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/5 transition-colors";
        tr.innerHTML = `
            <td class="px-6 py-4 font-bold text-slate-700">${dest.usr_nombre} ${dest.usr_apellido}</td>
            <td class="px-6 py-4 text-slate-400 font-medium">${dest.tid_rol || 'Destino'}</td>
            <td class="px-6 py-4 text-center">
                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full ${dest.tid_obligatorio ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-400'}">
                    <span class="material-symbols-outlined text-[14px]">${dest.tid_obligatorio ? 'priority_high' : 'check'}</span>
                </span>
            </td>
            <td class="px-6 py-4 text-right">
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase border ${estadoColors}">
                    ${estadoLabel}
                </span>
            </td>
        `;
        tablaDestinos.appendChild(tr);
    });
}
