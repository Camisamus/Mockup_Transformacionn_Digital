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

    // Inicializar con datos del servidor
    if (window.oirsData && window.oirsData.solicitud) {
        renderizarDatos(window.oirsData.solicitud);
    } else if (!currentOirsId) {
        solicitarID();
    }

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

    // Toggle de visibilidad dinámica
    $('#oig_requiere_respuesta_tecnica').on('change', function () {
        if ($(this).val() == '1' || $(this).val() === 'Si') {
            $('#container_respuesta_tecnica').slideDown();
        } else {
            $('#container_respuesta_tecnica').slideUp();
        }
    });

    $('#oig_solicitud_ejecutada').on('change', function () {
        if ($(this).val() == '1' || $(this).val() === 'Si') {
            $('#container_notificacion_ejecucion').slideDown();
        } else {
            $('#container_notificacion_ejecucion').slideUp();
        }
    });

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

    // Fix IDs if needed (from original code)
    if ($('#oig_respuesta_preliminar').length === 0) $('label:contains("Respuesta Preliminar")').next('textarea').attr('id', 'oig_respuesta_preliminar');
    if ($('#oig_respuesta_tecnica').length === 0) $('label:contains("Respuesta por Unidad Técnica")').next('textarea').attr('id', 'oig_respuesta_tecnica');
    if ($('#oig_solicitud_ejecutada').length === 0) $('label:contains("¿La solicitud será ejecutada?")').next('select').attr('id', 'oig_solicitud_ejecutada');

    // Datos Principales (Some pre-filled by PHP, others need JS processing)
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

    // 1. Respuesta Preliminar
    $('#oig_respuesta_preliminar').val(g.oig_respuesta_preliminar);
    if (g.oig_respuesta_preliminar && g.oig_respuesta_preliminar.trim() !== '') {
        $('#oig_respuesta_preliminar').prop('disabled', true);
        $('#btn_responder_preliminar').hide(); // Optionally hide button if already responded
    } else {
        $('#oig_respuesta_preliminar').prop('disabled', false);
        $('#btn_responder_preliminar').show();
    }

    $('#oig_requiere_respuesta_tecnica').val(g.oig_requiere_respuesta_tecnica);
    // Disable if closed
    const isClosed = [4, 5].includes(parseInt(d.oirs_estado)); // Assuming 4=Cerrada, 5=Terminada based on common enums, or string check
    // If state is string:
    if (d.oirs_estado === 'Cerrada' || d.oirs_estado === 'Terminada') {
        $('#oig_requiere_respuesta_tecnica').prop('disabled', true);
        $('#btn_responder_preliminar').prop('disabled', true); // Also disable button if closed
    }

    // 2. Respuesta Técnica
    const requiresTechnical = (g.oig_requiere_respuesta_tecnica == 1 || g.oig_requiere_respuesta_tecnica === 'Si');
    if (requiresTechnical) {
        $('#container_respuesta_tecnica').show();
        $('#oig_respuesta_tecnica').val(g.oig_respuesta_tecnica);
    } else {
        $('#container_respuesta_tecnica').hide();
    }

    $('#oig_solicitud_ejecutada').val(g.oig_solicitud_ejecutada);
    $('#oig_fuente_financiamiento').val(g.oig_fuente_financiamiento);

    // 3. Notificación Ejecución
    const executionPlanned = (g.oig_solicitud_ejecutada === 'Si' || g.oig_solicitud_ejecutada == 1);
    if (executionPlanned) {
        $('#container_notificacion_ejecucion').show();
        $('#oig_notificacion_ejecucion').val(g.oig_notificacion_ejecucion);
        $('#oig_realizada_en_plazo').val(g.oig_realizada_en_plazo);
    } else {
        $('#container_notificacion_ejecucion').hide();
    }

    // 4. Aclaratoria
    const aclaratoria = g.oig_aclaratoria_contribuyente || d.oig_aclaratoria_contribuyente || d.aclaratoria_contribuyente;
    $('#container_aclaratoria').show();
    if (aclaratoria && aclaratoria.trim() !== '') {
        $('#oig_aclaratoria_contribuyente').val(aclaratoria).prop('disabled', true);
    }
    const respAclaratoria = g.oig_respuesta_aclaratoria || d.oig_respuesta_aclaratoria;
    $('#oig_respuesta_aclaratoria').val(respAclaratoria);



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

    historial.forEach(h => {
        const fecha = new Date(h.bit_creacion).toLocaleString('es-CL');
        const item = `
            <div class="timeline-item">
                <span class="d-block font-weight-bold text-dark">${h.bit_evento}</span>
                <small class="text-muted">${fecha} - ${h.usr_nombre || ''} ${h.usr_apellido || ''}</small>
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

        const item = `
            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden mb-4 shadow-sm hover:shadow-md transition-all">
                <div class="p-5 flex justify-between align-items-center cursor-pointer hover:bg-slate-50 transition-colors" 
                     id="${headingId}" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-2xl">person</span>
                        </div>
                        <div>
                            <h6 class="text-[15px] font-bold text-slate-800 mb-0.5">${asg.usr_nombre || 'Funcionario'} ${asg.usr_apellido || ''}</h6>
                            <p class="text-[11px] text-slate-400 uppercase tracking-widest font-medium">Asignado el ${asg.oia_creacion ? new Date(asg.oia_creacion).toLocaleDateString() : 'N/A'}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-100" style="background-color: #fffbeb; color: #d97706; border: 1px solid #fef3c7;">Pendiente Revisión</span>
                        <span class="material-symbols-outlined text-slate-300 transition-transform dropdown-icon">expand_more</span>
                    </div>
                </div>

                <div id="${collapseId}" class="collapse ${isFirst ? 'show' : ''}" data-bs-parent="#accordionAsignaciones">
                    <div class="p-6 bg-slate-50 border-t border-slate-100" style="min-height: 100px;">
                        <!-- Hilo de Chat -->
                        <div class="mb-6 space-y-3" id="${chatContainerId}" style="min-height: 40px;">
                            <div class="text-center py-4 text-slate-400">
                                <span class="spinner-border spinner-border-sm mr-2"></span> Cargando conversaciones...
                            </div>
                        </div>

                        <!-- Bloque Tu Gestión -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm mt-4">
                            <h6 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">edit_note</span> Tu Gestión para esta Tarea
                            </h6>
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 1)" 
                                        class="btn bg-success text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-xs uppercase tracking-widest d-flex align-items-center justify-content-center gap-2" style="background-color: #10b981 !important; border: none;">
                                    <span class="material-symbols-outlined text-sm">check_circle</span> Aprobar Respuesta
                                </button>
                                <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 2)"
                                        class="btn bg-danger text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-sm text-xs uppercase tracking-widest d-flex align-items-center justify-content-center gap-2" style="background-color: #f43f5e !important; border: none;">
                                    <span class="material-symbols-outlined text-sm">error</span> Solicitar Corrección
                                </button>
                            </div>
                            <div class="relative mt-3">
                                <textarea id="msg_asg_${asg.oia_id}" 
                                          class="form-control rounded-xl border-slate-200 text-sm p-3 focus:ring-primary-blue shadow-sm bg-slate-50 mb-2" 
                                          style="min-height: 80px;"
                                          placeholder="Escribe un comentario adicional para el funcionario..."></textarea>
                                <div class="flex justify-end">
                                    <button type="button" onclick="gestionarAsignacion(${asg.oia_id}, 0)"
                                            class="btn btn-link p-0 text-primary-link text-[11px] font-bold uppercase tracking-widest hover:text-blue-700 flex items-center gap-1 transition-colors no-underline" style="color: #006FB3;">
                                        Enviar Comentario <span class="material-symbols-outlined text-sm">send</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.append(item);

        // Intentar cargar el historial de forma asíncrona
        cargarHistorialAsignacion(asg.oia_id, asg.oia_creacion, instruccion, chatContainerId);
    });
}

function cargarHistorialAsignacion(asgId, fechaCreacion, instruccion, containerId) {
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

            // Mensaje inicial (Instrucción)
            htmlChat += `
            <div class="flex items-start mb-4">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 max-w-[85%] shadow-sm">
                    <div class="flex items-center mb-1">
                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mr-2">Asignador (Instrucción)</span>
                        <span class="text-[9px] text-blue-400">${fechaCreacion ? new Date(fechaCreacion).toLocaleString() : 'N/A'}</span>
                    </div>
                    <p class="text-sm text-slate-700 m-0">${instruccion || '<i>Sin instrucción específica</i>'}</p>
                </div>
            </div>
        `;

            // Hilo de conversación
            historial.forEach(msg => {
                const isMe = msg.oac_emisor == (window.oirsData?.solicitud?.rgt_creador || 1); // Comparar con creador de la OIRS o el encargado
                const alignment = isMe ? 'justify-end' : 'justify-start';
                const bgColor = isMe ? 'bg-white border-slate-200' : 'bg-blue-50 border-blue-100';
                const extraStyles = isMe ? 'margin-left: auto;' : 'margin-right: auto;';
                const label = isMe ? 'Encargado (Tú)' : `${msg.usr_nombre} ${msg.usr_apellido}`;
                const labelColor = isMe ? 'text-slate-500' : 'text-blue-600';

                let statusBadge = '';
                if (msg.oac_marcado == 1) statusBadge = '<span class="ml-2 px-2 py-0.5 bg-teal-100 text-teal-700 text-[9px] font-bold rounded-full uppercase" style="background-color: #d1fae5; color: #047857;">Aprobada</span>';
                if (msg.oac_marcado == 2) statusBadge = '<span class="ml-2 px-2 py-0.5 bg-rose-100 text-rose-700 text-[9px] font-bold rounded-full uppercase" style="background-color: #ffe4e6; color: #be123e;">Corrección</span>';

                htmlChat += `
                <div class="flex ${alignment} mb-4" style="display: flex; ${isMe ? 'justify-content: flex-end;' : ''}">
                    <div class="${bgColor} border rounded-2xl p-4 max-w-[85%] shadow-sm" style="${extraStyles} min-width: 200px; border: 1px solid #e2e8f0; background-color: ${isMe ? '#ffffff' : '#f0f9ff'};">
                        <div class="flex items-center mb-1 gap-2" style="display: flex; align-items: center;">
                            <span class="text-[10px] font-bold ${labelColor} uppercase tracking-widest">${label}</span>
                            <span class="text-[9px] text-slate-400">${new Date(msg.oac_creacion).toLocaleString()}</span>
                            ${statusBadge}
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
        body: JSON.stringify({
            ACCION: 'ASIGNACION_COMENTAR',
            oac_asignacion: asignacionId,
            oac_mensaje: mensaje || (marcado === 1 ? 'Respuesta aprobada' : 'Se solicita corrección'),
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
                });
                // Recargar datos para ver el nuevo comentario
                renderAsignaciones(window.asignacionesActuales || []);
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
        Swal.fire('Atención', 'Seleccione un funcionario para asignar', 'warning');
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

let _funcionariosOIRS = null; // caché local

function _getFuncionariosOIRS() {
    if (!_funcionariosOIRS) {
        _funcionariosOIRS = (window.oirsData && window.oirsData.listas && window.oirsData.listas.funcionarios)
            ? window.oirsData.listas.funcionarios
            : [];
    }
    return _funcionariosOIRS;
}

function abrirModalBuscarFuncionario() {
    const buscarInput = document.getElementById('buscar_fnc_input');
    const filtroArea = document.getElementById('filtro_area_fnc_oirs');
    if (buscarInput) buscarInput.value = '';
    if (filtroArea) filtroArea.value = '';
    renderizarBusquedaFuncionariosOIRS(_getFuncionariosOIRS());
}

function filtrarBusquedaFuncionariosOIRS() {
    const term = $('#buscar_fnc_input').val().toLowerCase();
    const areaId = $('#filtro_area_fnc_oirs').val();

    const filtrados = _getFuncionariosOIRS().filter(f => {
        const matchesTerm =
            (f.fnc_nombre && f.fnc_nombre.toLowerCase().includes(term)) ||
            (f.fnc_apellido && f.fnc_apellido.toLowerCase().includes(term)) ||
            (f.fnc_email && f.fnc_email.toLowerCase().includes(term));

        let matchesArea = true;
        if (areaId === 'SIN_AREA') {
            matchesArea = !f.fnc_area_id;
        } else if (areaId) {
            matchesArea = f.fnc_area_id == areaId;
        }

        return matchesTerm && matchesArea;
    });

    renderizarBusquedaFuncionariosOIRS(filtrados);
}

function renderizarBusquedaFuncionariosOIRS(lista) {
    const tbody = document.getElementById('lista_busqueda_fnc_oirs');
    if (!tbody) return;
    tbody.innerHTML = '';

    if (lista.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-3">No se encontraron funcionarios.</td></tr>';
        return;
    }

    lista.forEach(f => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="small">${f.fnc_id || '-'}</td>
            <td class="small">${f.fnc_email || '-'}</td>
            <td class="small">
                <div>${f.fnc_nombre || '-'}</div>
                <div class="text-muted" style="font-size:11px">${f.fnc_area_nombre || 'Sin Área'}</div>
            </td>
            <td class="small">${f.fnc_apellido || '-'}</td>
            <td class="text-right">
                <button class="btn btn-sm btn-outline-primary"
                    onclick="seleccionarFuncionarioOIRS(${f.fnc_id}, '${(f.fnc_nombre || '')} ${(f.fnc_apellido || '')}')">
                    Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function seleccionarFuncionarioOIRS(id, nombre) {
    const hiddenInput = document.getElementById('oig_asignacion');
    const displayInput = document.getElementById('oig_asignacion_display');
    if (hiddenInput) hiddenInput.value = id;
    if (displayInput) displayInput.value = nombre.trim();

    // Cerrar el modal usando API de Bootstrap
    const modalEl = document.getElementById('modalBuscarFuncionario');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) {
        modalInstance.hide();
    } else {
        // Fallback si no hay instancia creada
        $('#modalBuscarFuncionario').modal('hide');
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
            console.error('Error parsing JSON:', text);
            Swal.fire('Error', 'Respuesta inválida del servidor: ' + text.substring(0, 100), 'error');
        }
    }).catch(err => {
        console.error('Error en actualización:', err);
        Swal.fire('Error', 'No se pudo conectar con el servidor: ' + err.message, 'error');
    });
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
