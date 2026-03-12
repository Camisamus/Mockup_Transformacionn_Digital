// Variables globales para los mapas
let mapCont, markerCont, mapInc, markerInc, geocoder;
let isUpdatingFromMapCont = false;
let isUpdatingFromMapInc = false;
let allSubtematicas = [];

// Lista de archivos seleccionados
let selectedFilesOirs = [];



$('#rut_contribuyente').on('blur', function () {
    let formattedRut = formatRut($(this).val());
    $(this).val(formattedRut);
});

$(document).ready(function () {
    // Carga inicial
    cargarListas();

    // --- Cambio de Tipo de Persona ---
    $('#cont_tipo_persona').change(function () {
        const tipo = $(this).val();
        if (tipo === 'natural') {
            $('#campos_natural').removeClass('d-none');
            $('#campos_juridica').addClass('d-none');
        } else {
            $('#campos_natural').addClass('d-none');
            $('#campos_juridica').removeClass('d-none');
        }
    });

    // --- Búsqueda de RUT Contribuyente ---
    $('#btnBuscarRut').click(async function () {
        const rut = $('#rut_contribuyente').val();
        if (!rut) {
            Swal.fire('Atención', 'Por favor ingrese un RUT para buscar.', 'warning');
            return;
        }

        $('#rutStatus').show();
        let btn = $(this);
        btn.prop('disabled', true);

        try {
            const response = await fetch('../../api/sisadmin/mantenedores/general/contribuyentes_general.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'BUSCAR_RUT', tgc_rut: rut })
            });

            const res = await response.json();

            if (res.status === 'success') {
                const c = res.data;
                // Autocompletar datos básicos
                $('#cont_tipo_persona').val(c.tgc_tipo).trigger('change');

                if (c.tgc_tipo === 'natural') {
                    $('#cont_nombre').val(c.tgc_nombre);
                    $('#cont_apellido_p').val(c.tgc_apellido_paterno);
                    $('#cont_apellido_m').val(c.tgc_apellido_materno);
                    $('#cont_sexo').val(c.tgc_sexo);
                    $('#cont_fecha_nac').val(c.tgc_fecha_nacimiento);
                    $('#cont_estado_civil').val(c.tgc_estado_civil);
                    $('#cont_escolaridad').val(c.tgc_escolaridad);
                } else {
                    $('#cont_razon_social').val(c.tgc_razon_social);
                    $('#cont_rep_rut').val(c.tgc_rep_rut);
                    $('#cont_rep_nombre_completo').val(c.tgc_rep_nombre_completo);
                }

                $('#cont_email').val(c.tgc_correo_electronico);
                $('#cont_telefono').val(c.tgc_telefono_contacto);

                // Autocompletar Dirección y Mapa
                if (c.tcd_calle) {
                    const dirCompleta = `${c.tcd_calle}${c.tcd_numero ? ' ' + c.tcd_numero : ''}`;
                    $('#cont_direccion').val(dirCompleta);
                    if (c.tcd_latitud && c.tcd_longitud) {
                        updateMap('cont', parseFloat(c.tcd_latitud), parseFloat(c.tcd_longitud));
                    }
                }

                Swal.fire({
                    title: 'Usuario Encontrado',
                    text: 'Los datos del contribuyente han sido cargados.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    title: 'Usuario no registrado',
                    text: 'El RUT ingresado no se encuentra en nuestros registros. Por favor, complete los datos manualmente.',
                    icon: 'info'
                });
            }
        } catch (error) {
            console.error('Error al buscar RUT:', error);
            Swal.fire('Error', 'Ocurrió un error al consultar el RUT.', 'error');
        } finally {
            $('#rutStatus').hide();
            btn.prop('disabled', false);
        }
    });

    // --- Geocodificación Automática al Escribir Dirección ---
    // --- Búsqueda Manual de Dirección en Mapa ---

    $('#btnBuscarDirCont').click(function () {
        const address = $('#cont_direccion').val();
        if (address) {
            geocodeAddress('cont', address);
        } else {
            Swal.fire('Atención', 'Ingrese una dirección para buscar en el mapa.', 'info');
        }
    });

    $('#btnBuscarDirInc').click(function () {
        const address = $('#oirs_direccion_incidente').val();
        if (address) {
            geocodeAddress('inc', address);
        } else {
            Swal.fire('Atención', 'Ingrese una dirección para buscar en el mapa.', 'info');
        }
    });

    $('#cont_direccion').on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#btnBuscarDirCont').click();
        }
    });

    $('#oirs_direccion_incidente').on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#btnBuscarDirInc').click();
        }
    });

    // --- Lógica de Navegación Stepper ---
    $('.btnNext').click(function () {
        let next = $(this).data('next');
        $('.step-content').addClass('d-none');
        $(`#step-${next}`).removeClass('d-none');
        $(`#step-${next}-indicator`).addClass('active');
        $(`#step-${next - 1}-indicator`).addClass('completed').removeClass('active');
        window.scrollTo(0, 0);
        if (window.feather) feather.replace();
        if (next === 2 && mapInc) google.maps.event.trigger(mapInc, 'resize');
    });

    $('.btnPrev').click(function () {
        let prev = $(this).data('prev');
        $('.step-content').addClass('d-none');
        $(`#step-${prev}`).removeClass('d-none');
        $(`#step-${prev}-indicator`).addClass('active').removeClass('completed');
        $(`#step-${prev + 1}-indicator`).removeClass('active');
        window.scrollTo(0, 0);
        if (window.feather) feather.replace();
    });

    // --- Gestión de PDF ---
    $('#btnDescargarPDF').click(function () {
        generarComprobante(); // La función interna ya maneja la extracción del ID
    });

    // --- Cambio de Temática / Subtemática ---
    $('#oirs_tematica').change(function () {
        const temId = $(this).val();
        const subSelect = $('#oirs_subtematica');
        subSelect.empty().append('<option value="" selected disabled>Seleccione subtemática...</option>');
        const filtered = allSubtematicas.filter(s => s.tem_id == temId);
        filtered.forEach(s => {
            subSelect.append(`<option value="${s.sub_id}">${s.sub_nombre}</option>`);
        });
    });

    // --- Finalizar Registro ---
    $('#btnFinalizar').click(async function () {
        let btn = $(this);

        if (!$('#oirs_descripcion').val() || !$('#oirs_tematica').val()) {
            Swal.fire('Atención', 'Por favor complete la descripción y temática de la solicitud.', 'warning');
            return;
        }

        const confirm = await Swal.fire({
            title: '¿Confirmar Registro?',
            text: "Se generará un nuevo folio de atención OIRS.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Registrar',
            cancelButtonText: 'Cancelar'
        });

        if (!confirm.isConfirmed) return;

        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-2"></span>Registrando...');

        let payload = {
            ACCION: 'CREAR',
            // ... (Se asume que todos los IDs de los inputs en tu HTML coinciden con estos)
            cont_tipo_persona: $('#cont_tipo_persona').val(),
            cont_rut: $('#rut_contribuyente').val(),
            cont_nombres: $('#cont_nombre').val(),
            cont_apellido_paterno: $('#cont_apellido_p').val(),
            cont_apellido_materno: $('#cont_apellido_m').val(),
            cont_sexo: $('#cont_sexo').val(),
            cont_fecha_nacimiento: $('#cont_fecha_nac').val(),
            cont_estado_civil: $('#cont_estado_civil').val(),
            cont_escolaridad: $('#cont_escolaridad').val(),
            cont_nacionalidad: $('#cont_nacionalidad').val(),
            cont_email: $('#cont_email').val(),
            cont_telefono: $('#cont_telefono').val(),
            cont_razon_social: $('#cont_razon_social').val(),
            cont_nombre_fantasia: $('#cont_nombre_fantasia').val(),
            cont_giro: $('#cont_giro').val(),
            cont_rep_rut: $('#cont_rep_rut').val(),
            cont_rep_nombre_completo: $('#cont_rep_nombre_completo').val(),
            cont_direccion: $('#cont_direccion').val(),
            cont_latitud: $('#cont_lat').val(),
            cont_longitud: $('#cont_lng').val(),
            oirs_tipo_atencion: $('#oirs_tipo_atencion').val(),
            oirs_origen_consulta: $('#oirs_origen').val(),
            oirs_condicion: $('#oirs_condicion').val(),
            oirs_creacion: $('#oirs_fecha_reg').val() + ' ' + $('#oirs_hora_reg').val(),
            oirs_tematica: $('#oirs_tematica').val(),
            oirs_subtematica: $('#oirs_subtematica').val(),
            oirs_calle: $('#oirs_direccion_incidente').val(),
            oirs_sector: $('#oirs_sector').val(),
            oirs_descripcion: $('#oirs_descripcion').val(),
            oirs_estado: 1,
            oirs_latitud: $('#oirs_lat').val(),
            oirs_longitud: $('#oirs_lng').val(),
            oirs_respuesta: $('#oirs_respuesta').val(),
            documentos: selectedFilesOirs
        };

        try {
            const response = await fetch('../../api/oirs/solicitudes.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const res = await response.json();

            if (res.status === 'success') {
                const nuevoId = res.id;
                $('#oirs_folio_final').text('OIRS #' + nuevoId);

                // ACTUALIZACIÓN: Re-vinculamos el botón para el ID recién creado
                $('#btnDescargarPDF').off('click').on('click', function () {
                    generarComprobante(nuevoId);
                });

                $('.step-content').addClass('d-none');
                $('#step-3').removeClass('d-none');
                $('#step-3-indicator').addClass('active completed');
                $('#step-2-indicator').addClass('completed').removeClass('active');

                window.scrollTo(0, 0);
                if (window.feather) feather.replace();

                Swal.fire({ title: '¡Registrado!', text: 'La solicitud ha sido ingresada correctamente.', icon: 'success', timer: 2000, showConfirmButton: false });
            } else {
                throw new Error(res.message || 'Error desconocido');
            }
        } catch (error) {
            console.error('Error al registrar OIRS:', error);
            Swal.fire('Error', 'No se pudo registrar la solicitud: ' + error.message, 'error');
        } finally {
            btn.prop('disabled', false).html('Finalizar Registro <span class="material-symbols-outlined ml-2" style="font-size: 18px;">check_circle</span>');
        }
    });

}); // Fin del document.ready

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

// Funciones para renderizar y eliminar archivos (Globales)
function renderFileListOirs() {
    const listContainer = $('#lista_archivos_oirs');
    listContainer.empty();

    selectedFilesOirs.forEach((file, index) => {
        const item = $(`
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-2">
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined mr-2 text-primary" style="font-size: 18px;">description</span>
                    <span class="small text-truncate" style="max-width: 250px;">${file.nombre}</span>
                </div>
                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFileOirs(${index})">
                    <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                </button>
            </div>
        `);
        listContainer.append(item);
    });
}

window.removeFileOirs = function (index) {
    selectedFilesOirs.splice(index, 1);
    renderFileListOirs();
};

async function cargarListas() {
    const apiBase = '../../api';
    const payload = { ACCION: 'CONSULTAM' };

    try {
        // Tipos de Atención
        fetch(`${apiBase}/oirs/tipo_atencion.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            const select = $('#oirs_tipo_atencion');
            select.empty().append('<option value="" selected disabled>Seleccione tipo...</option>');
            if (res.status === 'success') {
                res.data.forEach(d => select.append(`<option value="${d.tat_id}">${d.tat_nombre}</option>`));
            }
        });

        // Condiciones
        fetch(`${apiBase}/oirs/condiciones.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            const select = $('#oirs_condicion');
            select.empty().append('<option value="" selected disabled>Seleccione condición...</option>');
            if (res.status === 'success') {
                res.data.forEach(d => select.append(`<option value="${d.con_id}">${d.con_nombre}</option>`));
            }
        });

        // Temáticas
        fetch(`${apiBase}/oirs/tematicas.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            const select = $('#oirs_tematica');
            select.empty().append('<option value="" selected disabled>Seleccione temática...</option>');
            if (res.status === 'success') {
                res.data.forEach(d => select.append(`<option value="${d.tem_id}">${d.tem_nombre}</option>`));
            }
        });

        // Subtemáticas (para filtro posterior)
        fetch(`${apiBase}/oirs/subtematicas.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            if (res.status === 'success') allSubtematicas = res.data;
        });

        // Sectores
        fetch(`${apiBase}/general/sectores.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            const select = $('#oirs_sector');
            select.empty().append('<option value="" selected disabled>Seleccione sector...</option>');
            if (res.status === 'success') {
                res.data.forEach(d => select.append(`<option value="${d.sec_id}">${d.sec_nombre}</option>`));
            }
        });

        // Escolaridad
        fetch(`${apiBase}/general/escolaridad.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            const select = $('#cont_escolaridad');
            select.empty().append('<option value="" selected disabled>Seleccione escolaridad...</option>');
            if (res.status === 'success') {
                res.data.forEach(d => select.append(`<option value="${d.esc_id}">${d.esc_nombre}</option>`));
            }
        });

    } catch (error) {
        console.error('Error al cargar listas:', error);
    }
}

// Google Maps Logic
window.initMap = async function () {
    const defaultLoc = { lat: -33.0245, lng: -71.5518 }; // Viña del Mar
    geocoder = new google.maps.Geocoder();

    // 1. Mapa Contribuyente
    mapCont = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: defaultLoc,
        disableDefaultUI: false,
    });

    markerCont = new google.maps.Marker({
        map: mapCont,
        draggable: true,
        position: defaultLoc,
    });

    markerCont.addListener("dragend", () => {
        const pos = markerCont.getPosition();
        reverseGeocode('cont', pos.lat(), pos.lng());
    });

    // 2. Mapa Incidente
    mapInc = new google.maps.Map(document.getElementById("map_incidente"), {
        zoom: 14,
        center: defaultLoc,
        disableDefaultUI: false,
    });

    markerInc = new google.maps.Marker({
        map: mapInc,
        draggable: true,
        position: defaultLoc,
    });

    markerInc.addListener("dragend", () => {
        const pos = markerInc.getPosition();
        reverseGeocode('inc', pos.lat(), pos.lng());
    });
};

async function updateMap(type, lat, lng, centerMap = true) {
    const pos = { lat: lat, lng: lng };
    if (type === 'cont') {
        if (!markerCont) return;
        markerCont.setPosition(pos);
        if (centerMap && mapCont) mapCont.setCenter(pos);
        $('#cont_lat').val(lat);
        $('#cont_lng').val(lng);

        // --- AGREGAR ESTO: Si el checkbox está marcado, replicar en incidente ---
        if ($('#copy_address').is(':checked')) {
            updateMap('inc', lat, lng, centerMap);
        }
        // -----------------------------------------------------------------------

    } else {
        if (!markerInc) return;
        markerInc.setPosition(pos);
        if (centerMap && mapInc) mapInc.setCenter(pos);
        $('#oirs_lat').val(lat);
        $('#oirs_lng').val(lng);
    }
}

async function geocodeAddress(type, address) {
    if (!geocoder) return;

    let fullAddress = address;
    if (!address.includes(',')) {
        let comuna = (type === 'cont') ? ($('#cont_comuna').val() || 'Viña del Mar') : 'Viña del Mar';
        fullAddress += ", " + comuna;
    }
    fullAddress += ", Chile";

    geocoder.geocode({ address: fullAddress }, (results, status) => {
        if (status === "OK") {
            const loc = results[0].geometry.location;
            updateMap(type, loc.lat(), loc.lng());

            // Si fue exitoso y estamos en un contexto manual, podemos dar un pequeño feedback visual o simplemente dejar que el pin se mueva
        } else {
            Swal.fire({
                title: 'Ubicación no encontrada',
                text: 'No logramos posicionar la dirección en el mapa. Intenta ser más específico o marca el punto directamente en el mapa.',
                icon: 'warning'
            });
        }
    });
}

async function reverseGeocode(type, lat, lng) {
    if (!geocoder) return;
    const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                if (type === 'cont') {
                    isUpdatingFromMapCont = true;
                    $('#cont_direccion').val(results[0].formatted_address);
                    $('#cont_lat').val(lat);
                    $('#cont_lng').val(lng);
                    setTimeout(() => isUpdatingFromMapCont = false, 500);
                } else {
                    isUpdatingFromMapInc = true;
                    $('#oirs_direccion_incidente').val(results[0].formatted_address);
                    $('#oirs_lat').val(lat);
                    $('#oirs_lng').val(lng);
                    setTimeout(() => isUpdatingFromMapInc = false, 500);
                }
            }
        }
    });
}

// Nueva función para generar el comprobante PDF vía API Backend
function generarComprobante(idSolicitud) {
    if (!idSolicitud) {
        // Si no hay ID (por ejemplo, si presionan el botón manualmente antes de registrar)
        // Intentamos extraerlo del texto del folio si ya existe
        const folioTexto = $('#oirs_folio_final').text();
        idSolicitud = folioTexto.split('-').pop(); // Extrae el ID del final
    }

    if (idSolicitud && idSolicitud !== "") {
        // Abrir la API en una pestaña nueva pasando el ID
        window.open(`../../api/reportes/pdf_oirs_expediente.php?ID=${idSolicitud}`, '_blank');
    } else {
        Swal.fire('Error', 'No se encontró un ID de solicitud válido para generar el PDF.', 'error');
    }
}