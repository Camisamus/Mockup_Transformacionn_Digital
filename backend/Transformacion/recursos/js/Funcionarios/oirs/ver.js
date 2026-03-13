/**
 * OIRS Consulta Component Logic
 */
let mapIncidente, mapHome;
let markerIncidente, markerHome;
const apiBase = '../../api';
let currentOirsId = null;

$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    currentOirsId = urlParams.get('id');

    // 1. Inicializar con datos del servidor
    if (window.oirsData && window.oirsData.solicitud) {
        renderizarDatos(window.oirsData.solicitud);
    } else if (!currentOirsId) {
        solicitarID();
    }

    // 2. Persistencia de Pestañas (Tabs)
    const restoreTab = () => {
        const activeTab = localStorage.getItem('activeTab_oirs_ver');
        if (activeTab) {
            try {
                const tabEl = document.querySelector(`#oirsTabs a[href="${activeTab}"]`);
                if (tabEl) {
                    if (window.bootstrap && bootstrap.Tab) {
                        const tab = new bootstrap.Tab(tabEl);
                        tab.show();
                    } else if ($(tabEl).tab) {
                        $(tabEl).tab('show');
                    } else {
                        tabEl.click();
                    }
                }
            } catch (e) {
                console.warn('[OIRS] Error restaurando pestaña:', e);
            }
        }
    };

    // Intentar restaurar inmediatamente o cuando cargue todo
    if (document.readyState === 'complete') {
        restoreTab();
    } else {
        window.addEventListener('load', restoreTab);
    }

    // Escuchar el cambio de pestaña para guardarlo
    $(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"]', function (e) {
        const target = $(e.target).attr('href');
        localStorage.setItem('activeTab_oirs_ver', target);
    });

    // Event Listeners para Asignación
    $('#btn_asignar').on('click', guardarAsignacion);

    // Event Listeners para Gestión Individual
    $(document).on('click', '#btn_responder_preliminar', () => guardarGestion({
        oig_respuesta_preliminar: $('#oig_respuesta_preliminar').val(),
        oig_requiere_respuesta_tecnica: $('#oig_requiere_respuesta_tecnica').val()
    }));

    $(document).on('click', '#btn_responder_tecnico', () => guardarGestion({
        oig_respuesta_tecnica: $('#oig_respuesta_tecnica').val(),
        oig_solicitud_ejecutada: $('#oig_solicitud_ejecutada').val(),
        oig_fuente_financiamiento: $('#oig_fuente_financiamiento').val()
    }));

    $(document).on('click', '#btn_notificar_ejecucion', () => guardarGestion({
        oig_notificacion_ejecucion: $('#oig_notificacion_ejecucion').val(),
        oig_realizada_en_plazo: $('#oig_realizada_en_plazo').val()
    }));

    $(document).on('click', '#btn_responder_aclaratoria', () => guardarGestion({
        oig_respuesta_aclaratoria: $('#oig_respuesta_aclaratoria').val()
    }));

    /* OIRS: Visibilidad será estrictamente secuencial tras el guardado del paso anterior */

    // BOTÓN GUARDAR TODOS LOS CAMBIOS
    $(document).on('click', '#btn_guardar_todo', () => {
        const payload = {
            oig_respuesta_preliminar: $('#oig_respuesta_preliminar').val(),
            oig_requiere_respuesta_tecnica: $('#oig_requiere_respuesta_tecnica').val(),
            oig_respuesta_tecnica: $('#oig_respuesta_tecnica').val(),
            oig_solicitud_ejecutada: $('#oig_solicitud_ejecutada').val(),
            oig_fuente_financiamiento: $('#oig_fuente_financiamiento').val(),
            oig_notificacion_ejecucion: $('#oig_notificacion_ejecucion').val(),
            oig_realizada_en_plazo: $('#oig_realizada_en_plazo').val(),
            oig_respuesta_aclaratoria: $('#oig_respuesta_aclaratoria').val()
        };
        guardarGestion(payload);
    });

    // Event Listeners for File Upload (Municipio)
    $('#customFileMuni').on('change', async function (e) {
        const files = e.target.files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                selectedFilesMuni.push({
                    nombre: files[i].name,
                    file: files[i]
                });
            }
            renderFileListMuni();
            $(this).val('');
        }
    });

    $('#btnGuardarAdjuntosMuni').on('click', guardarAdjuntosMuni);
});

// Logic to filter subtematicas locally
$('#oirs_tematica').on('change', function () {
    const temId = $(this).val();
    const select = $('#oirs_subtematica');
    select.empty().append('<option disabled selected>Seleccione...</option>');

    if (window.oirsData && window.oirsData.listas && window.oirsData.listas.subtematicas) {
        window.oirsData.listas.subtematicas.filter(s => s.tem_id == temId).forEach(s => {
            select.append(`<option value="${s.sub_id}">${s.sub_nombre}</option>`);
        });
    }
});

function renderizarDatos(d) {
    if (!d) return;

    const isClosed = [4, 5].includes(parseInt(d.oirs_estado));
    if ($('#oig_respuesta_preliminar').length === 0) $('label:contains("Respuesta Preliminar")').next('textarea').attr('id', 'oig_respuesta_preliminar');
    if ($('#oig_respuesta_tecnica').length === 0) $('label:contains("Respuesta por Unidad Técnica")').next('textarea').attr('id', 'oig_respuesta_tecnica');
    if ($('#oig_solicitud_ejecutada').length === 0) $('label:contains("¿La solicitud será ejecutada?")').next('select').attr('id', 'oig_solicitud_ejecutada');

    // Datos Principales (Some pre-filled by PHP, others need JS processing)
    $('#oirs_id_visual').val(d.oirs_id || 'N/A');
    $('#oirs_estado_visual').val(d.oirs_estado || 'Sin asignar');
    $('#oirs_folio').html(`Folio: <strong class="text-white">${d.rgt_id_publica || d.oirs_id || 'N/A'}</strong>`);

    const fechaHora = d.oirs_creacion ? d.oirs_creacion.split(' ') : ['', ''];
    $('#oirs_fecha').val(fechaHora[0]);
    $('#oirs_hora').val(fechaHora[1] ? fechaHora[1].substring(0, 5) : '');

    $('#oirs_calle').val(d.oirs_calle);
    $('#oirs_lat').val(d.oirs_latitud);
    $('#oirs_lng').val(d.oirs_longitud);
    $('#oirs_descripcion').val(d.oirs_descripcion);

    // Contribuyente
    $('#cont_rut').val(d.tgc_rut);
    $('#cont_nombre').val(d.tgc_nombre || d.tgc_razon_social);
    $('#cont_apellido_paterno').val(d.tgc_apellido_paterno);
    $('#cont_apellido_materno').val(d.tgc_apellido_materno);
    $('#cont_sexo').val(d.tgc_sexo);
    $('#cont_fecha_nacimiento').val(d.tgc_fecha_nacimiento);
    $('#cont_estado_civil').val(d.tgc_estado_civil);
    $('#cont_nacionalidad').val(d.tgc_nacionalidad);
    $('#cont_email').val(d.tgc_correo_electronico);
    $('#cont_telefono').val(d.tgc_telefono_contacto);
    $('#cont_direccion').val(d.cont_calle);

    // Gestión
    // Check if gestion data is flat in 'd' or properly nested 'gestion'
    // Based on Controller, often it's flat if JOINed, but let's support both
    const g = d.gestion || d;

    // 1. Respuesta Preliminar (Siempre visible)
    $('#oig_respuesta_preliminar').val(g.oig_respuesta_preliminar);
    const hasPrelimRes = g.oig_respuesta_preliminar && g.oig_respuesta_preliminar.trim() !== '';
    if (hasPrelimRes) {
        $('#oig_respuesta_preliminar').prop('disabled', true);
        $('#btn_responder_preliminar').hide();
        $('#info_auditoria_preliminar').show();
        $('#txt_preliminar_user').text(`Respuesta entregada por: ${g.oig_res_pre_origen_nombre || '-'}`);
        let fPre = '-';
        if (g.oig_res_pre_fecha) {
            let partes = g.oig_res_pre_fecha.split(' ')[0].split('-');
            fPre = partes.length === 3 ? `${partes[2]}-${partes[1]}-${partes[0]}` : g.oig_res_pre_fecha;
        }
        $('#txt_preliminar_fec').text(`Fecha: ${fPre}`);
    } else {
        $('#oig_respuesta_preliminar').prop('disabled', false);
        $('#btn_responder_preliminar').show();
        $('#info_auditoria_preliminar').hide();
    }

    $('#oig_requiere_respuesta_tecnica').val(g.oig_requiere_respuesta_tecnica || "");

    // 2. Respuesta Técnica
    const requiresTechnical = (g.oig_requiere_respuesta_tecnica == 1 || g.oig_requiere_respuesta_tecnica === 'Si');
    // SEQUENTIAL: Mostrar bloque técnico SOLO si la preliminar ya fue guardada y requiere técnica
    const mostrarPorPermiso = window.oirsData && window.oirsData.permisos ? window.oirsData.permisos.mostrarBloqueTecnica : true;
    if (hasPrelimRes && requiresTechnical && mostrarPorPermiso) {
        $('#container_respuesta_tecnica').show();
        $('#oig_respuesta_tecnica').val(g.oig_respuesta_tecnica || "");

        const hasTechnicalRes = g.oig_respuesta_tecnica && g.oig_respuesta_tecnica.trim() !== '';
        if (hasTechnicalRes) {
            $('#oig_respuesta_tecnica').prop('disabled', true);
            $('#btn_responder_tecnico').hide();
            $('#info_auditoria_tecnica').show();
            $('#txt_tecnica_user').text(`Respuesta entregada por: ${g.oig_res_tec_origen_nombre || '-'}`);
            let fTec = '-';
            if (g.oig_res_tec_fecha) {
                let partes = g.oig_res_tec_fecha.split(' ')[0].split('-');
                fTec = partes.length === 3 ? `${partes[2]}-${partes[1]}-${partes[0]}` : g.oig_res_tec_fecha;
            }
            $('#txt_tecnica_fec').text(`Fecha: ${fTec}`);
        } else {
            $('#oig_respuesta_tecnica').prop('disabled', false);
            $('#btn_responder_tecnico').show();
            $('#info_auditoria_tecnica').hide();
        }
    } else {
        $('#container_respuesta_tecnica').hide();
    }

    $('#oig_solicitud_ejecutada').val(g.oig_solicitud_ejecutada || "");
    $('#oig_fuente_financiamiento').val(g.oig_fuente_financiamiento || "");

    // 3. Notificación Ejecución
    const executionPlanned = (g.oig_solicitud_ejecutada == 1 || g.oig_solicitud_ejecutada === 'Si');
    const hasTechnicalRes = g.oig_respuesta_tecnica && g.oig_respuesta_tecnica.trim() !== '';
    // SEQUENTIAL: Mostrar bloque ejecución SOLO si la técnica ya fue guardada y está planificada
    const mostrarEjecucionPorPermiso = window.oirsData && window.oirsData.permisos ? window.oirsData.permisos.mostrarBloqueEjecucion : true;
    if (hasTechnicalRes && executionPlanned && mostrarEjecucionPorPermiso) {
        $('#container_notificacion_ejecucion').show();
        $('#oig_notificacion_ejecucion').val(g.oig_notificacion_ejecucion || "");
        $('#oig_realizada_en_plazo').val(g.oig_realizada_en_plazo || "");

        const hasExecutionRes = g.oig_notificacion_ejecucion && g.oig_notificacion_ejecucion.trim() !== '';
        if (hasExecutionRes) {
            $('#oig_notificacion_ejecucion').prop('disabled', true);
            $('#btn_notificar_ejecucion').hide();
            $('#info_auditoria_ejecucion').show();
            $('#txt_ejecucion_user').text(`Respuesta entregada por: ${g.oig_res_not_origen_nombre || '-'}`);
            let fExe = '-';
            if (g.oig_res_not_fecha) {
                let partes = g.oig_res_not_fecha.split(' ')[0].split('-');
                fExe = partes.length === 3 ? `${partes[2]}-${partes[1]}-${partes[0]}` : g.oig_res_not_fecha;
            }
            $('#txt_ejecucion_fec').text(`Fecha: ${fExe}`);
        } else {
            $('#oig_notificacion_ejecucion').prop('disabled', false);
            $('#btn_notificar_ejecucion').show();
            $('#info_auditoria_ejecucion').hide();
        }
    } else {
        // Bloqueo de estado cerrado dentro de renderizarDatos general si es necesario
        $('#container_notificacion_ejecucion').hide();
    }

    // 4. Aclaratoria
    const aclaratoria = g.oig_aclaratoria_contribuyente || d.oig_aclaratoria_contribuyente || d.aclaratoria_contribuyente;
    if (aclaratoria && aclaratoria.trim() !== '' && aclaratoria !== 'Sin comentarios adicionales del contribuyente.') {
        $('#container_aclaratoria').show();
        $('#oig_aclaratoria_contribuyente').val(aclaratoria).prop('disabled', true);
    } else {
        $('#container_aclaratoria').hide();
    }
    const respAclaratoria = g.oig_respuesta_aclaratoria || d.oig_respuesta_aclaratoria;
    $('#oig_respuesta_aclaratoria').val(respAclaratoria || "");

    // Disable all if closed
    if (isClosed || d.oirs_estado === 'Cerrada' || d.oirs_estado === 'Terminada') {
        $('#oig_requiere_respuesta_tecnica, #oig_solicitud_ejecutada, #oig_fuente_financiamiento, #oig_realizada_en_plazo').prop('disabled', true);
        $('#btn_responder_preliminar, #btn_responder_tecnico, #btn_notificar_ejecucion, #btn_guardar_todo').hide();
    }



    // Extra fields
    $('#oig_instruccion_asignacion').val(''); // Always empty for new assignment

    // Asignaciones
    const asignaciones = d.asignaciones || [];
    window.asignacionesActuales = asignaciones;
    renderAsignaciones(asignaciones);

    // Historial
    const historial = d.historial || [];
    renderHistorial(historial);

    // Adjuntos
    // Adjuntos
    const adjuntos = d.adjuntos || [];
    renderAdjuntos(adjuntos);

    // Google Maps
    // Helper to safely parse coordinates (handling comma vs dot)
    const parseCoord = (val) => {
        if (!val) return 0;
        const str = String(val).replace(',', '.');
        return parseFloat(str);
    };

    const latI = parseCoord(d.oirs_latitud);
    const lngI = parseCoord(d.oirs_longitud);
    const latH = parseCoord(d.cont_lat);
    const lngH = parseCoord(d.cont_lng);

    console.log('[Map] DB Coords OIRS:', latI, lngI);
    console.log('[Map] DB Coords Contribuyente:', latH, lngH);

    // Construct address if needed
    let addressH = null;
    if (d.cont_calle) {
        addressH = `${d.cont_calle}`;
        if (d.cont_numero) addressH += ` ${d.cont_numero}`;
        addressH += `, Viña del Mar, Región de Valparaíso, Chile`;
    }

    if (typeof google === 'object' && typeof google.maps === 'object') {
        initMap(latI, lngI, latH, lngH, addressH);
    } else {
        window.pendingMapData = { latI, lngI, latH, lngH, addressH };
    }
}

function renderHistorial(historial) {
    const container = $('#timeline_container');
    container.empty();

    if (!historial || historial.length === 0) {
        container.append('<p class="text-muted text-center p-4">No hay registros en el historial aún.</p>');
        return;
    }

    historial.forEach((h, index) => {
        // 1. Formatear la fecha a un formato limpio: DD/MM/AAAA HH:mm AM/PM
        let fechaFormateada = 'Fecha no disponible';
        if (h.bit_creacion) {
            const dateObj = new Date(h.bit_creacion);
            fechaFormateada = dateObj.toLocaleDateString('es-CL', {
                day: '2-digit', month: '2-digit', year: 'numeric'
            }) + ' ' + dateObj.toLocaleDateString('en-US', { // en-US para obtener AM/PM
                hour: '2-digit', minute: '2-digit', hour12: true
            }).split(', ')[1]; // Tomar solo la parte de la hora
        }

        const usuario = `${h.usr_nombre || ''} ${h.usr_apellido || ''}`.trim();

        // 2. Limpiar el título del evento (Especial para asignaciones)
        let eventoVisual = h.bit_evento;
        if (h.bit_evento.includes('Asignación de OIRS')) {
            // Buscamos el ID del CARGO asignado en la cadena: "... (Funcionario ID: X)"
            const regex = /\(Funcionario ID: (\d+)\)/;
            const match = h.bit_evento.match(regex);

            if (match && match[1]) {
                const idAsignado = match[1];

                // 1. Buscar en la lista global de CARGOS
                let cargo = window.oirsData?.listas?.cargos?.find(c => (c.car_id == idAsignado));
                let nombreAsignado = '';

                if (cargo) {
                    nombreAsignado = cargo.car_nombre;
                } else {
                    // 2. Buscar como respaldo en las asignaciones de la solicitud (donde ya vienen los nombres resueltos del backend)
                    const asgResp = window.oirsData?.solicitud?.asignaciones?.find(a => a.oia_asignacion == idAsignado);
                    if (asgResp) {
                        nombreAsignado = asgResp.car_nombre || 'Cargo Desconocido';
                    }
                }

                if (nombreAsignado) {
                    eventoVisual = `Asignación de OIRS a ${nombreAsignado}`;
                } else {
                    // Si no lo encuentra, al menos quitamos el "(Funcionario ID: X)" para que se vea más limpio
                    eventoVisual = h.bit_evento.split(' por ')[0] + ' a Cargo (ID: ' + idAsignado + ')';
                }
            }
        }

        // 3. Determinar si es el último elemento para ocultar la línea conectoras
        const isLast = index === historial.length - 1;
        const lineClass = isLast ? 'd-none' : '';

        // 4. Construir el ítem de la línea de tiempo
        const item = `
            <div class="timeline-item d-flex position-relative mb-0">
                <div class="timeline-markers d-flex flex-col align-items-center position-relative me-4">
                    <div class="timeline-badge bg-primary rounded-circle" 
                         style="width: 12px; height: 12px; margin-top: 6px; z-index: 2;">
                    </div>
                    <div class="timeline-line position-absolute ${lineClass}" 
                         style="width: 2px; background-color: #e0e6ed; top: 12px; bottom: -12px; left: 5px; z-index: 1;">
                    </div>
                </div>

                <div class="timeline-content pb-5">
                    <h5 class="font-weight-bold text-dark mb-1" style="font-size: 1.1rem; line-height: 1.2;">
                        ${eventoVisual}
                    </h5>
                    
                    <div class="text-muted mb-2" style="font-size: 0.9rem;">
                        ${fechaFormateada} - Por ${usuario || 'Sistema'}
                    </div>

                    ${h.bit_comentario ? `
                        <p class="text-secondary mb-0" style="font-size: 0.95rem; max-width: 600px;">
                            ${h.bit_comentario}
                        </p>
                    ` : ''}
                </div>
            </div>
        `;
        container.append(item);
    });
}

function renderAdjuntos(adjuntos) {
    const container = $('#contenedor_adjuntos_usuario');
    container.empty();

    // Filter public documents (doc_privado == 0 or undefined)
    const publicDocs = adjuntos.filter(a => !a.doc_privado || a.doc_privado == 0);

    if (publicDocs.length === 0) {
        container.html('<div class="col-12"><small class="text-muted">No hay archivos adjuntos.</small></div>');
    } else {
        publicDocs.forEach(a => {
            const item = `
                <div class="col-md-3 mb-3">
                    <div class="card h-100 text-decoration-none shadow-sm border-0" style="cursor:pointer" onclick="descargarDocumento(${a.doc_id}, '${a.doc_nombre_documento}')">
                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-3">
                            <span class="material-symbols-outlined text-primary mb-2" style="font-size: 32px;">description</span>
                            <small class="text-dark font-weight-bold text-truncate w-100" title="${a.doc_nombre_documento}">${a.doc_nombre_documento}</small>
                            <span class="badge badge-light mt-2">${a.version_fecha || a.doc_creacion}</span>
                        </div>
                    </div>
                </div>
            `;
            container.append(item);
        });
    }

    // Render Private Documents (Municipio)
    renderAdjuntosMuni(adjuntos);
}

function renderAdjuntosMuni(adjuntos) {
    // This function assumes the table exists in the "Adjuntos Municipio" tab
    // Table body selector: #tab-adjuntos-muni table tbody
    const tbody = $('#tab-adjuntos-muni table tbody');
    if (tbody.length === 0) return;

    tbody.empty();

    // Filter private documents (doc_privado == 1)
    const privateDocs = adjuntos.filter(a => a.doc_privado == 1);

    if (privateDocs.length === 0) {
        tbody.html('<tr><td colspan="4" class="text-center text-muted">No hay documentos internos cargados.</td></tr>');
        return;
    }

    privateDocs.forEach(a => {
        const tr = `
            <tr>
                <td><span class="material-symbols-outlined align-middle mr-1 text-danger">picture_as_pdf</span> ${a.doc_nombre_documento}</td>
                <td>${a.usr_nombre || 'Sistema'}</td> <!-- usr_nombre might need to be joined in backend or available in 'a' -->
                <td>${a.version_fecha || a.doc_creacion}</td>
                <td class="text-right"><a href="#" class="text-primary" onclick="descargarDocumento(${a.doc_id}, '${a.doc_nombre_documento}'); return false;">Descargar</a></td>
            </tr>
        `;
        tbody.append(tr);
    });
}

function renderAsignaciones(asignaciones) {
    console.log('[OIRS] Renderizando asignaciones:', asignaciones);
    const container = $('#accordionAsignaciones');
    container.empty();

    if (!asignaciones || asignaciones.length === 0) {
        container.html('<div class="alert alert-light text-center border">No hay asignaciones registradas.</div>');
        return;
    }

    asignaciones.forEach((asg, index) => {
        const isFirst = index === 0;
        const oiaId = asg.oia_id || `idx${index}`;
        const collapseId = `collapseAsg${oiaId}`;
        const headingId = `headingAsg${oiaId}`;
        const chatContainerId = `chat_container_${oiaId}`;

        // Determinar instrucción (manejar case sensitivity)
        const instruccion = asg.oia_instruccion || asg.oia_Instruccion || '<i>Sin instrucción específica</i>';

        // --- Lógica de Permisos ---
        const currentUserId = window.oirsData?.currentUserId || 0;
        const misCargosIds = window.oirsData?.misCargos?.map(c => parseInt(c.car_id)) || [];

        const esAsignador = currentUserId == asg.oia_asignador;
        // Ahora esAsignado significa que mi cargo está asignado
        const esAsignado = misCargosIds.includes(parseInt(asg.oia_asignacion));
        const estaFinalizada = asg.oia_estado == 2;
        const puedeGestionar = (esAsignador || esAsignado) && !estaFinalizada;

        const deleteButton = esAsignador
            ? `<button type="button" onclick="eliminarAsignacion(event, ${asg.oia_id})" class="text-slate-400 hover:text-red-500 transition-colors p-1" title="Eliminar asignación">
                   <span class="material-symbols-outlined text-lg">delete</span>
               </button>`
            : '';

        const managementBlock = puedeGestionar ? `
            <!-- Bloque Tu Gestión -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm mt-4">
                <h6 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">edit_note</span> Tu Gestión para esta Tarea
                </h6>
                ${esAsignador ? `
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 1)" 
                            class="btn bg-success text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-xs uppercase tracking-widest d-flex align-items-center justify-content-center gap-2" style="background-color: #10b981 !important; border: none;">
                        <span class="material-symbols-outlined text-sm">check_circle</span> Aceptar
                    </button>
                    <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 2)"
                            class="btn bg-danger text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-xs uppercase tracking-widest d-flex align-items-center justify-content-center gap-2" style="background-color: #f43f5e !important; border: none;">
                        <span class="material-symbols-outlined text-sm">cancel</span> Rechazar
                    </button>
                </div>
                ` : ''}
                <div class="relative mt-3">
                    <textarea id="msg_asg_${asg.oia_id}" 
                              class="form-control rounded-xl border-slate-200 text-sm p-3 focus:ring-primary-blue shadow-sm bg-slate-50 mb-2" 
                              style="min-height: 80px;"
                              placeholder="${esAsignador ? 'Escribe un comentario adicional para el funcionario...' : 'Escribe tu respuesta o comentario aquí...'}"></textarea>
                    <div class="flex justify-end">
                        <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 0)"
                                class="btn btn-link p-0 text-primary-link text-[11px] font-bold uppercase tracking-widest hover:text-blue-700 flex items-center gap-1 transition-colors no-underline" style="color: #006FB3;">
                            Enviar Comentario <span class="material-symbols-outlined text-sm">send</span>
                        </button>
                    </div>
                </div>
            </div>
        ` : (estaFinalizada ? `
            <div class="bg-teal-50 border border-teal-200 rounded-2xl p-4 text-center mt-4" style="background-color: #f0fdf4; border: 1px solid #bbf7d0;">
                <p class="text-[11px] font-bold text-teal-600 uppercase tracking-widest mb-0 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">verified</span> Gestión Finalizada y Aceptada
                </p>
            </div>
        ` : `
            <div class="bg-slate-100 border border-slate-200 rounded-2xl p-4 text-center mt-4">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-0">Vista de solo lectura (Sin permisos de gestión)</p>
            </div>
        `);

        const item = `
            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden mb-4 shadow-sm hover:shadow-md transition-all">
                <div class="p-5 flex justify-between align-items-center cursor-pointer hover:bg-slate-50 transition-colors asg-header-toggle" 
                     data-target="#${collapseId}">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-400">
                            <span class="material-symbols-outlined text-2xl">badge</span>
                        </div>
                        <div>
                            <h6 class="text-[15px] font-bold text-slate-800 mb-0.5">${asg.car_nombre || 'Cargo Desconocido'}</h6>
                            <p class="text-[11px] text-slate-400 uppercase tracking-widest font-medium">Asignado el ${asg.oia_creacion ? new Date(asg.oia_creacion).toLocaleDateString() : 'N/A'}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        ${estaFinalizada
                ? '<span class="badge rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-teal-600 border border-teal-100" style="background-color: #f0fdf4; color: #059669; border: 1px solid #bbf7d0;">Finalizada</span>'
                : '<span class="badge rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-100" style="background-color: #fffbeb; color: #d97706; border: 1px solid #fef3c7;">Asignación</span>'
            }
                        ${deleteButton}
                        <span class="material-symbols-outlined text-slate-300 transition-transform dropdown-icon">expand_more</span>
                    </div>
                </div>

                <div id="${collapseId}" class="asg-content-box" style="display: ${isFirst ? 'block' : 'none'}; border-top: 1px solid #f1f5f9;">
                    <div class="p-6 bg-slate-50" style="background-color: #f8fafc !important;">
                        <!-- Hilo de Chat -->
                        <div class="mb-6 space-y-3" id="${chatContainerId}" style="min-height: 40px;">
                            <div class="text-center py-4 text-slate-400">
                                <span class="spinner-border spinner-border-sm mr-2"></span> Cargando conversaciones...
                            </div>
                        </div>

                        ${managementBlock}
                    </div>
                </div>
            </div>
        `;
        container.append(item);

        const nombreAsignadorReal = asg.asignador_nombre ? `${asg.asignador_nombre} ${asg.asignador_apellido || ''}` : (asg.creador_nombre ? `${asg.creador_nombre} ${asg.creador_apellido || ''}` : 'Asignador');
        // Intentar cargar el historial de forma asíncrona
        cargarHistorialAsignacion(asg.oia_id, asg.oia_creacion, instruccion, chatContainerId, nombreAsignadorReal, asg.oia_asignador);
    });

    // Delegación de evento para el toggle manual (más robusto)
    $(document).off('click', '.asg-header-toggle').on('click', '.asg-header-toggle', function (e) {
        e.preventDefault();
        const targetSelector = $(this).data('target');
        const contentBox = $(targetSelector);

        console.log('[OIRS] Toggling:', targetSelector);
        contentBox.slideToggle(300);

        // Rotar icono
        $(this).find('.dropdown-icon').toggleClass('rotate-180');
    });
}

function eliminarAsignacion(e, asgId) {
    if (e) {
        e.stopPropagation(); // Evitar que el acordeón se despliegue al hacer clic
    }

    Swal.fire({
        title: '¿Eliminar Asignación?',
        text: 'Esta acción removerá permanentemente esta asignación.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f43f5e',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({ title: 'Eliminando...', allowOutsideClick: false });
            Swal.showLoading();

            fetch(`${apiBase}/oirs/gestion.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'ELIMINAR_ASIGNACION', oia_id: asgId })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('¡Eliminada!', 'La asignación se ha removido correctamente.', 'success').then(() => {
                            location.reload(); // Refrescar tras eliminar
                        });
                    } else {
                        Swal.fire('Error', data.message || 'No se pudo eliminar.', 'error');
                    }
                })
                .catch(error => {
                    console.error("Error al eliminar Asignación:", error);
                    Swal.fire('Error', 'Hubo un error de comunicación con el servidor.', 'error');
                });
        }
    });
}

function cargarHistorialAsignacion(asgId, fechaCreacion, instruccion, containerId, nombreAsignador = "Asignador", asignadorId = null) {
    const chatContainer = $(`#${containerId}`);

    fetch(`${apiBase}/oirs/gestion.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ACCION: 'ASIGNACION_HISTORIAL', oac_asignacion: asgId })
    })
        .then(response => {
            if (!response.ok) throw new Error('Error en la red');
            return response.json();
        })
        .then(res => {
            const historial = res.data || [];
            let htmlChat = '';

            // Mensaje inicial (Instrucción) - SIEMPRE a la izquierda (Autor)
            const sessionId = parseInt(window.oirsData.currentUserId);
            const asgAsignadorId = parseInt(asignadorId);
            const isMeInit = (asgAsignadorId == sessionId);

            const alignmentInit = 'justify-start'; // Siempre inicio
            const bgColorInit = 'bg-blue-50 border-blue-100'; // Color de autor (azul suave)
            const labelInit = isMeInit ? 'Yo' : nombreAsignador;
            const labelColorInit = 'text-blue-600';

            htmlChat += `
            <div class="flex ${alignmentInit} mb-4" style="display: flex; justify-content: flex-start;">
                <div class="${bgColorInit} border rounded-2xl p-4 max-w-[85%] shadow-sm" style="margin-right: auto; min-width: 200px; border: 1px solid #e2e8f0; background-color: #f0f9ff;">
                    <div class="flex items-center mb-1 gap-2">
                        <span class="text-[10px] font-bold ${labelColorInit} uppercase tracking-widest">${labelInit}</span>
                        <span class="text-[9px] text-slate-400">${fechaCreacion ? new Date(fechaCreacion).toLocaleString() : 'N/A'}</span>
                    </div>
                    <p class="text-sm text-slate-700 m-0 mt-1">${instruccion || '<i>Sin instrucción específica</i>'}</p>
                </div>
            </div>
        `;

            // Hilo de conversación
            historial.forEach(msg => {
                const sessionUserId = parseInt(window.oirsData.currentUserId);
                const msgEmisorId = parseInt(msg.oac_emisor);
                const assignorId = parseInt(asignadorId);

                // Autor (Asignador) -> Izquierda, Otros (Respondedores) -> Derecha
                const isAssignor = (msgEmisorId == assignorId);
                const isMe = (msgEmisorId == sessionUserId);

                const alignment = isAssignor ? 'justify-start' : 'justify-end';
                const bgColor = isAssignor ? 'bg-blue-50 border-blue-100' : 'bg-white border-slate-200';
                const extraStyles = isAssignor ? 'margin-right: auto;' : 'margin-left: auto;';
                const label = isMe ? 'Yo' : `${msg.usr_nombre} ${msg.usr_apellido}`;
                const labelColor = isAssignor ? 'text-blue-600' : 'text-slate-500';

                let statusBadge = '';
                if (msg.oac_marcado == 1) statusBadge = '<span class="ml-2 px-2 py-0.5 bg-teal-100 text-teal-700 text-[9px] font-bold rounded-full uppercase" style="background-color: #d1fae5; color: #047857;">Aprobada</span>';
                if (msg.oac_marcado == 2) statusBadge = '<span class="ml-2 px-2 py-0.5 bg-rose-100 text-rose-700 text-[9px] font-bold rounded-full uppercase" style="background-color: #ffe4e6; color: #be123e;">Corrección</span>';

                const copyBtn = !isMe ? `
                    <button type="button" class="ml-auto text-slate-400 hover:text-primary-blue transition-colors flex items-center justify-center p-1 rounded-lg hover:bg-slate-100" title="Copiar respuesta" onclick="copiarTextoPortapapeles(\`${msg.oac_mensaje.replace(/`/g, '\\`').replace(/\$/g, '\\$')}\`)">
                        <span class="material-symbols-outlined text-[16px]">content_copy</span>
                    </button>` : '';

                htmlChat += `
                <div class="flex ${alignment} mb-4" style="display: flex; ${!isAssignor ? 'justify-content: flex-end;' : 'justify-content: flex-start;'}">
                    <div class="${bgColor} border rounded-2xl p-4 max-w-[85%] shadow-sm" style="${extraStyles} min-width: 200px; border: 1px solid #e2e8f0; background-color: ${isAssignor ? '#f0f9ff' : '#ffffff'};">
                        <div class="flex items-center mb-1 gap-2" style="display: flex; align-items: center; width: 100%;">
                            <span class="text-[10px] font-bold ${labelColor} uppercase tracking-widest">${label}</span>
                            <span class="text-[9px] text-slate-400">${new Date(msg.oac_creacion).toLocaleString()}</span>
                            ${statusBadge}
                            ${copyBtn}
                        </div>
                        <p class="text-sm text-slate-700 m-0 mt-1">${msg.oac_mensaje}</p>
                    </div>
                </div>
            `;
            });

            chatContainer.html(htmlChat);
        })
        .catch(err => {
            console.error('[OIRS] Error cargando historial:', err);
            chatContainer.html(`<div class="alert alert-warning text-xs p-2">Error al cargar historial: ${err.message}</div>`);
        });
}

function gestionarAsignacion(asignacionId, marcado) {
    const mensaje = $(`#msg_asg_${asignacionId}`).val();

    if (marcado === 0 && !mensaje.trim()) {
        Swal.fire('Atención', 'Por favor escribe un comentario.', 'warning');
        return;
    }

    fetch(`${apiBase}/oirs/gestion.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            ACCION: 'ASIGNACION_COMENTAR',
            oac_asignacion: asignacionId,
            oac_mensaje: mensaje || (marcado === 1 ? 'Aceptar' : 'Rechazar'),
            oac_marcado: marcado
        })
    })
        .then(response => response.json())
        .then(res => {
            if (res.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Acción registrada correctamente',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        });
}

async function descargarDocumento(Id, nombre) {
    try {
        const response = await fetch(`${apiBase}/gesdoc/general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'Bajar', doc_id: Id }),
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

function guardarAsignacion() {
    const data = {
        ACCION: 'ASIGNAR',
        oig_solicitud: currentOirsId,
        oig_asignacion: $('#oig_asignacion').val(),
        oig_instruccion_asignacion: $('#oig_instruccion_asignacion').val()
    };

    if (!data.oig_asignacion) {
        Swal.fire('Atención', 'Seleccione un cargo para asignar', 'warning');
        return;
    }

    ejecutarActualizacion(data);
}

// ============================================================
// MODAL BUSCAR FUNCIONARIO
// Lee la lista desde window.oirsData.listas.funcionarios,
// que fue inyectada desde PHP en el script al final de la página.
//
// *** PUNTO DE FILTRO FUTURO ***
// Cuando se deba restringir la lista de funcionarios según el
// usuario que trabaja la solicitud (ej: solo su área, o solo
// funcionarios con acceso OIRS), se debe aplicar el filtro
// en el array $funcionarios ANTES de json_encode() en el PHP,
// o bien aquí en tiempo de ejecución sobre this.funcionariosOIRS.
// ============================================================

// ============================================================
// MODAL BUSCAR CARGO
// ============================================================

let _cargosOIRS = null; // caché local

function _getCargosOIRS() {
    if (!_cargosOIRS) {
        _cargosOIRS = (window.oirsData && window.oirsData.listas && window.oirsData.listas.cargos)
            ? window.oirsData.listas.cargos
            : [];
    }
    return _cargosOIRS;
}

function abrirModalBuscarCargos() {
    const buscarInput = document.getElementById('buscar_fnc_input');
    if (buscarInput) buscarInput.value = '';
    renderizarBusquedaCargosOIRS(_getCargosOIRS());
}

function filtrarBusquedaCargosOIRS() {
    const term = $('#buscar_fnc_input').val().toLowerCase();

    const filtrados = _getCargosOIRS().filter(c => {
        return (c.car_nombre && c.car_nombre.toLowerCase().includes(term));
    });

    renderizarBusquedaCargosOIRS(filtrados);
}

// Hook original para el input
$(document).on('input', '#buscar_fnc_input', filtrarBusquedaCargosOIRS);

function renderizarBusquedaCargosOIRS(lista) {
    const tbody = document.getElementById('lista_busqueda_fnc_oirs');
    if (!tbody) return;
    tbody.innerHTML = '';

    if (lista.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-3">No se encontraron cargos.</td></tr>';
        return;
    }

    lista.forEach(c => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50 cursor-pointer';
        tr.onclick = () => seleccionarCargoOIRS(c.car_id, c.car_nombre);
        tr.innerHTML = `
            <td class="px-4 py-3">
                <div class="font-bold text-slate-700">#${c.car_id}</div>
                <div class="text-[13px] text-slate-800">${c.car_nombre}</div>
            </td>
            <td class="px-4 py-3">
                <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-md text-[11px] uppercase font-black">
                    ${c.area_nombre || 'Sin Área'}
                </span>
            </td>
            <td class="text-end px-4 py-3">
                <button class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg font-bold text-[11px] uppercase tracking-wider hover:bg-indigo-100 transition-all">
                    Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function seleccionarCargoOIRS(id, nombre) {
    const hiddenInput = document.getElementById('oig_asignacion');
    const displayInput = document.getElementById('oig_asignacion_display');
    if (hiddenInput) hiddenInput.value = id;
    if (displayInput) displayInput.value = nombre.trim();

    // Cerrar el modal usando API de Bootstrap
    const modalEl = document.getElementById('modalBuscarFuncionario');
    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
    if (modalInstance) {
        modalInstance.hide();
    }
}


function guardarGestion(fields) {
    const data = {
        ACCION: 'ACTUALIZAR',
        oig_solicitud: currentOirsId,
        ...fields
    };

    ejecutarActualizacion(data);
}

function ejecutarActualizacion(data) {
    fetch(`${apiBase}/oirs/gestion.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(async r => {
        const text = await r.text();
        const trimmedText = text.trim();
        try {
            // Remove BOM if present (rare) but just in case
            const cleanText = trimmedText.replace(/^\uFEFF/, '');
            const res = JSON.parse(cleanText);
            if (res.status === 'success') {
                Swal.fire('Éxito', res.message, 'success');
                location.reload();
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        } catch (e) {
            console.error('[OIRS] Error parseando respuesta:', e, 'Texto recibido:', text);
            Swal.fire('Error', 'Error al procesar la respuesta del servidor.', 'error');
        }
    }).catch(error => {
        console.error("Error en ejecución:", error);
        Swal.fire('Error', 'Hubo un error al procesar la solicitud.', 'error');
    });
}

function copiarTextoPortapapeles(texto) {
    if (!texto) return;

    const copiarYNotificar = () => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: 'success',
            title: 'Mensaje copiado al portapapeles'
        });
    };

    // Intento con API moderna (Requiere HTTPS o localhost)
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(texto).then(copiarYNotificar).catch(err => {
            console.error('Error al copiar al portapapeles:', err);
            fallbackCopiarTexto(texto, copiarYNotificar);
        });
    } else {
        // Fallback para contextos no seguros (HTTP)
        fallbackCopiarTexto(texto, copiarYNotificar);
    }
}

function fallbackCopiarTexto(text, callback) {
    const textArea = document.createElement("textarea");
    textArea.value = text;

    // Asegurar que no sea visible pero esté en el DOM
    textArea.style.position = "fixed";
    textArea.style.left = "-999999px";
    textArea.style.top = "-999999px";
    document.body.appendChild(textArea);

    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        if (successful && callback) callback();
    } catch (err) {
        console.error('Error en el fallback de copia:', err);
    }

    document.body.removeChild(textArea);
}

window.initMap = function (latI, lngI, latH, lngH, addressH) {
    const defaultLoc = { lat: -33.0245, lng: -71.5518 };

    // Check for pending data if arguments are missing (callback case)
    if (!latI && window.pendingMapData) {
        latI = window.pendingMapData.latI;
        lngI = window.pendingMapData.lngI;
        latH = window.pendingMapData.latH;
        lngH = window.pendingMapData.lngH;
        addressH = window.pendingMapData.addressH;
    }

    // Mapa Incidente
    // Use coordinates if valid, otherwise default
    const posI = (latI && lngI && !isNaN(latI) && !isNaN(lngI))
        ? { lat: latI, lng: lngI }
        : defaultLoc;

    mapIncidente = new google.maps.Map(document.getElementById("map_incidente"), {
        center: posI,
        zoom: 15,
        gestureHandling: 'none',      // Desactiva todos los gestos (arrastrar, zoom con dedos, etc.)
        zoomControl: false,           // Quita los botones de +/-
        scrollwheel: false,           // Desactiva el zoom con la rueda del ratón
        disableDoubleClickZoom: true, // Desactiva el zoom al hacer doble clic
        draggable: false,
    });
    markerIncidente = new google.maps.Marker({
        position: posI,
        map: mapIncidente,
        title: "Ubicación Solicitud"
    });

    // Mapa Domicilio
    function renderHomeMap(location) {
        mapHome = new google.maps.Map(document.getElementById("map_home"), {
            center: location,
            zoom: 15,
            gestureHandling: 'none',      // Desactiva todos los gestos (arrastrar, zoom con dedos, etc.)
            zoomControl: false,           // Quita los botones de +/-
            scrollwheel: false,           // Desactiva el zoom con la rueda del ratón
            disableDoubleClickZoom: true, // Desactiva el zoom al hacer doble clic
            draggable: false,
        });
        markerHome = new google.maps.Marker({
            position: location,
            map: mapHome,
            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png', // Blue dot for user
            title: "Domicilio Contribuyente"
        });
    }

    // Check if we have valid coordinates
    const hasCoordsH = (latH && lngH && !isNaN(latH) && !isNaN(lngH) && latH !== 0 && lngH !== 0);

    if (hasCoordsH) {
        renderHomeMap({ lat: latH, lng: lngH });
    } else if (addressH) {
        // Geocode if no coords but address exists
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: addressH }, (results, status) => {
            if (status === "OK" && results[0]) {
                renderHomeMap(results[0].geometry.location);
            } else {
                console.warn("Geocode for address failed: " + status);
                renderHomeMap(defaultLoc);
            }
        });
    } else {
        // Fallback
        renderHomeMap(defaultLoc);
    }


    // Initial render of filtered lists (requires renderizarDatos to be called first)
    // We'll hook into renderizarDatos for this.
}

// ... existing initMap ... 

async function guardarAdjuntosMuni() {
    if (selectedFilesMuni.length === 0) {
        Swal.fire('Atención', 'Seleccione al menos un archivo para subir.', 'warning');
        return;
    }

    if (!window.oirsData || !window.oirsData.solicitud) {
        Swal.fire('Error', 'No hay datos de solicitud cargados.', 'error');
        return;
    }

    // We need the RGT ID (tramite_id)
    const tramiteId = window.oirsData.solicitud.oirs_registro_tramite;

    // Show loading
    Swal.fire({
        title: 'Subiendo archivos...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });

    try {
        const formData = new FormData();
        formData.append('ACCION', 'Subir');
        formData.append('tramite_id', tramiteId);
        formData.append('doc_privado', 1); // Mark as private/internal
        // Pass user_id if needed, but SESSION should handle it in PHP.
        // Helper to append files
        selectedFilesMuni.forEach((item, index) => {
            formData.append(`archivos[]`, item.file);
        });

        const response = await fetch(`${apiBase}/gesdoc/general.php`, {
            method: 'POST',
            body: formData
        });

        // Check if response is JSON
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            throw new Error("Respuesta no válida del servidor");
        }

        const result = await response.json();

        if (result.status === 'success') {
            selectedFilesMuni = []; // Clear selection
            renderFileListMuni();

            // Reload page to refresh everything
            Swal.fire({
                title: 'Éxito',
                text: 'Archivos subidos correctamente',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });

        } else {
            console.error(result);
            let msg = result.message || 'Error al subir archivos';
            if (result.errors && result.errors.length > 0) {
                msg += ':<br>' + result.errors.join('<br>'); // HTML in Swal
            }
            Swal.fire('Error', msg, 'error');
        }
    } catch (error) {
        console.error(error);
        Swal.fire('Error', 'Error de conexión con el servidor', 'error');
    }
}

// --- FILE UPLOAD HELPERS ---

let selectedFilesMuni = [];

// Helper: Leer archivo como Base64
function readFileAsBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve({
            nombre: file.name,
            base64: reader.result.split(',')[1]
        });
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

function renderFileListMuni() {
    const container = $('#lista_archivos_muni');
    if (container.length === 0) return;

    container.empty();

    selectedFilesMuni.forEach((file, index) => {
        const item = $(`
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined mr-2 text-primary" style="font-size: 18px;">description</span>
                    <span class="small text-truncate" style="max-width: 250px;">${file.nombre}</span>
                </div>
                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFileMuni(${index})">
                    <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                </button>
            </div>
        `);
        container.append(item);
    });
}

window.removeFileMuni = function (index) {
    selectedFilesMuni.splice(index, 1);
    renderFileListMuni();
};

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-control">
                    <option value="id">ID Interno (OIRS)</option>
                    <option value="folio" selected>Folio (Cód. Público)</option>
                    <option value="rut">RUT Contribuyente</option>
                </select>
            </div>
            <div class="mb-2 text-start">
                <label class="form-label small fw-bold">Valor:</label>
                <input id="swal-id-value" class="form-control" placeholder="Ingrese el valor...">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        cancelButtonText: 'Volver a Bandeja',
        allowOutsideClick: false,
        confirmButtonText: 'Buscar',
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

        const payload = { ACCION: 'BUSCAR' };
        payload[type] = value;

        const response = await fetch(`${apiBase}/oirs/solicitudes.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];

            if (results.length > 0 && results[0].oirs_id) {
                // If multiple results (e.g. by RUT), we might need another selection step.
                // For now, let's take the first one or show a list if multiple.
                if (results.length > 1) {
                    // TODO: Show list to select. For now, take the latest (first one due to DESC sort).
                    const foundId = results[0].oirs_id;
                    const newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('id', foundId);
                    window.location.href = newUrl.toString();
                } else {
                    const foundId = results[0].oirs_id;
                    const newUrl = new URL(window.location.href);
                    newUrl.searchParams.set('id', foundId);
                    window.location.href = newUrl.toString();
                }
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
