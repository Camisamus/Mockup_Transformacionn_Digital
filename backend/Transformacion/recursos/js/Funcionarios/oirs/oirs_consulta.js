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

    if (!currentOirsId) {
        solicitarID();
        return;
    }

    // --- ID Fixes for oirs_consulta.php (if missing) ---
    // Fix: oig_respuesta_preliminar textarea
    if ($('#oig_respuesta_preliminar').length === 0) {
        // Find by placeholder or context
        $('label:contains("Respuesta Preliminar")').next('textarea').attr('id', 'oig_respuesta_preliminar');
        // Or if label structure is different
        $('textarea[placeholder*="respuesta oficial"]').eq(0).attr('id', 'oig_respuesta_preliminar');
    }
    // Fix: btn_responder_preliminar
    if ($('#btn_responder_preliminar').length === 0) {
        $('button:contains("Responder al Vecino")').eq(0).attr('id', 'btn_responder_preliminar');
    }
    // Fix: oig_respuesta_tecnica
    if ($('#oig_respuesta_tecnica').length === 0) {
        $('label:contains("Respuesta por Unidad Técnica")').next('textarea').attr('id', 'oig_respuesta_tecnica');
        $('textarea[placeholder*="respuesta oficial"]').eq(1).attr('id', 'oig_respuesta_tecnica');
    }
    // Fix: btn_responder_tecnico
    if ($('#btn_responder_tecnico').length === 0) {
        $('button:contains("Responder al Vecino")').eq(1).attr('id', 'btn_responder_tecnico');
    }
    // Fix: oig_solicitud_ejecutada
    if ($('#oig_solicitud_ejecutada').length === 0) {
        $('label:contains("¿La solicitud será ejecutada?")').next('select').attr('id', 'oig_solicitud_ejecutada');
    }


    // Inicializar con datos del servidor
    if (window.oirsData && window.oirsData.solicitud) {
        renderizarDatos(window.oirsData.solicitud);
    } else if (!currentOirsId && !window.oirsData.solicitud) {
        solicitarID();
    }

    // Event Listeners para Asignación
    $('#btn_asignar').on('click', guardarAsignacion);

    // Event Listeners para Gestión
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

    // Event Listeners for File Upload (Municipio) - Added here to avoid duplication
    $('#customFileMuni').on('change', async function (e) {
        const files = e.target.files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                // Store file object
                selectedFilesMuni.push({
                    nombre: files[i].name,
                    file: files[i]
                });
            }
            renderFileListMuni();
            $(this).val(''); // Clear input
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

    const fechaHora = d.oirs_fecha_hora ? d.oirs_fecha_hora.split(' ') : ['', ''];
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
    // Assume field key is 'aclaratoria_contribuyente' or 'oig_aclaratoria_contribuyente' inside 'd' or 'g'
    const aclaratoria = g.oig_aclaratoria_contribuyente || d.oig_aclaratoria_contribuyente || d.aclaratoria_contribuyente;
    if (aclaratoria && aclaratoria.trim() !== '') {
        $('#container_aclaratoria').show();
        $('#oig_aclaratoria_contribuyente').val(aclaratoria).prop('disabled', true);
        $('#container_respuesta_aclaratoria').show();
        // Assuming response for aclaratoria exists
        const respAclaratoria = g.oig_respuesta_aclaratoria || d.oig_respuesta_aclaratoria;
        $('#oig_respuesta_aclaratoria').val(respAclaratoria);
    } else {
        $('#container_aclaratoria').hide();
        $('#container_respuesta_aclaratoria').hide();
    }



    // Extra fields
    $('#oig_instruccion_asignacion').val(''); // Always empty for new assignment

    // Asignaciones
    const asignaciones = d.asignaciones || [];
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
        const fecha = new Date(h.bit_fecha).toLocaleString('es-CL');
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
                            <span class="badge badge-light mt-2">${a.version_fecha || a.doc_fecha}</span>
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
                <td>${a.version_fecha || a.doc_fecha}</td>
                <td class="text-right"><a href="#" class="text-primary" onclick="descargarDocumento(${a.doc_id}, '${a.doc_nombre_documento}'); return false;">Descargar</a></td>
            </tr>
        `;
        tbody.append(tr);
    });
}

function renderAsignaciones(asignaciones) {
    const container = $('#accordionAsignaciones');
    container.empty();

    if (asignaciones.length === 0) {
        container.html('<div class="alert alert-light text-center border">No hay asignaciones registradas.</div>');
        return;
    }

    asignaciones.forEach((asg, index) => {
        const isFirst = index === 0;
        const collapseId = `collapseAsg${index}`;
        const headingId = `headingAsg${index}`;

        const item = `
            <div class="card border mb-2 shadow-sm">
                <div class="card-header bg-white p-3" id="${headingId}" data-toggle="collapse"
                    data-target="#${collapseId}" aria-expanded="${isFirst}" aria-controls="${collapseId}"
                    style="cursor: pointer;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-3"
                                style="width: 40px; height: 40px;">
                                <span class="material-symbols-outlined text-primary">person</span>
                            </div>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-dark">${asg.usr_nombre} ${asg.usr_apellido}</h6>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="badge badge-pill badge-success mb-1">Asignado</span>
                        </div>
                    </div>
                </div>

                <div id="${collapseId}" class="collapse ${isFirst ? 'show' : ''}" aria-labelledby="${headingId}"
                    data-parent="#accordionAsignaciones">
                    <div class="card-body bg-light border-top">
                        <h6 class="font-weight-bold" style="font-size: 13px;">Instrucción / Mensaje:</h6>
                        <p class="mb-0 text-dark small">
                            ${asg.oia_Instruccion || '<i>Sin instrucción</i>'}
                        </p>
                    </div>
                </div>
            </div>
        `;
        container.append(item);
    });
}

async function descargarDocumento(Id, nombre) {
    try {
        const response = await fetch(`${apiBase}/gesdoc_general.php`, {
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

function guardarGestion(fields) {
    const data = {
        ACCION: 'ACTUALIZAR',
        oig_solicitud: currentOirsId,
        ...fields
    };

    ejecutarActualizacion(data);
}

function ejecutarActualizacion(data) {
    fetch(`${apiBase}/oirs_gestion.php`, {
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

        const response = await fetch(`${apiBase}/gesdoc_general.php`, {
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
        window.location.href = 'oirs_bandeja.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        const payload = { ACCION: 'BUSCAR' };
        payload[type] = value;

        const response = await fetch(`${apiBase}/oirs_solicitudes.php`, {
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
