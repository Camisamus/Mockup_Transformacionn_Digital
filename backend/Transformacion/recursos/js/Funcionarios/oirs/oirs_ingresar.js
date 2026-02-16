// Variables globales para los mapas
let mapCont, markerCont, mapInc, markerInc, geocoder;
let isUpdatingFromMapCont = false;
let isUpdatingFromMapInc = false;

// Helper: Formatear RUT
function formatRut(rut) {
    let value = rut.replace(/[.-]/g, '');
    if (value.length < 2) return value;
    let dv = value.slice(-1);
    let num = value.slice(0, -1);
    return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '-' + dv;
}

$('#rut_contribuyente').on('blur', function () {
    // Formatear RUT 
    let formattedRut = formatRut($(this).val());
    $('#rut_contribuyente').val(formattedRut);
});

$(document).ready(function () {
    // Initial data load
    cargarListas();

    // Stepper Navigation Logic
    $('.btnNext').click(function () {
        let next = $(this).data('next');
        $('.step-content').addClass('d-none');
        $(`#step-${next}`).removeClass('d-none');
        $(`#step-${next}-indicator`).addClass('active');
        $(`#step-${next - 1}-indicator`).addClass('completed').removeClass('active');
        window.scrollTo(0, 0);
        if (window.feather) feather.replace();

        // Si se entra al paso 2, nos aseguramos que el segundo mapa se redimensione (si es necesario)
        if (next === 2 && mapInc) {
            google.maps.event.trigger(mapInc, 'resize');
        }
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

    // Toggle Persona Natural / Jurídica
    $('#cont_tipo_persona').change(function () {
        if ($(this).val() === 'juridica') {
            $('#campos_natural').addClass('d-none');
            $('#campos_juridica').removeClass('d-none');
        } else {
            $('#campos_natural').removeClass('d-none');
            $('#campos_juridica').addClass('d-none');
        }
    });

    // Búsqueda dinámica de RUT
    $('#btnBuscarRut').click(async function () {
        let rutValue = $('#rut_contribuyente').val().trim();
        if (!rutValue) {
            Swal.fire({
                title: 'Atención',
                text: 'Por favor ingrese un RUT para buscar.',
                icon: 'warning',
                confirmButtonColor: '#003399'
            });
            return;
        }

        $('#rutStatus').text('Buscando...').fadeIn();

        try {
            const response = await fetch('../../api/contribuyentes_general.php', {
                method: 'POST',
                body: JSON.stringify({
                    ACCION: 'BUSCAR_RUT',
                    tgc_rut: rutValue
                })
            });

            const res = await response.json();

            if (res.status === 'success' && res.data) {
                const d = res.data;
                $('#rutStatus').text('¡Datos encontrados!').delay(1000).fadeOut();

                // Poblar campos
                $('#cont_nombre').val(d.tgc_nombre || '');
                $('#cont_apellido_p').val(d.tgc_apellido_paterno || '');
                $('#cont_apellido_m').val(d.tgc_apellido_materno || '');
                $('#cont_sexo').val(d.tgc_sexo || '');
                $('#cont_fecha_nac').val(d.tgc_fecha_nacimiento || '');
                $('#cont_estado_civil').val(d.tgc_estado_civil || '');
                $('#cont_escolaridad').val(d.tgc_escolaridad || '');
                $('#cont_nacionalidad').val(d.tgc_nacionalidad || 'Chilena');
                $('#cont_email').val(d.tgc_correo_electronico || '');
                $('#cont_telefono').val(d.tgc_telefono_contacto || '');

                // Formatear dirección para el INPUT (Completa)
                let dirDisplay = [];
                if (d.tcd_calle) dirDisplay.push(d.tcd_calle);
                if (d.tcd_numero) dirDisplay.push(d.tcd_numero);
                if (d.tcd_casa) dirDisplay.push(`Casa ${d.tcd_casa}`);
                if (d.tcd_departamento) dirDisplay.push(`Depto ${d.tcd_departamento}`);
                if (d.tcd_aclaratoria) dirDisplay.push(`(${d.tcd_aclaratoria})`);
                $('#cont_direccion').val(dirDisplay.join(' '));

                // Formatear dirección para el MAPA (Geocodificación limpia)
                let dirGeocode = [];
                if (d.tcd_calle) dirGeocode.push(d.tcd_calle);
                if (d.tcd_numero) dirGeocode.push(d.tcd_numero);

                let comunaValue = $('#cont_comuna').val() || 'Viña del Mar';
                let geocodeString = dirGeocode.join(' ') + ", " + comunaValue;

                // Mapa Contribuyente: Prioridad a coordenadas de la BDD
                if (d.tcd_latitud && d.tcd_longitud) {
                    updateMap('cont', parseFloat(d.tcd_latitud), parseFloat(d.tcd_longitud), true);
                } else if (dirGeocode.length > 0) {
                    geocodeAddress('cont', geocodeString);
                }

            } else {
                $('#rutStatus').text('No encontrado.').delay(1000).fadeOut();
                $('#rut_contribuyente').prop('readonly', true);
                $('#cont_nombre').focus();

                Swal.fire({
                    title: 'Contribuyente Nuevo',
                    text: 'El RUT no se encuentra en nuestros registros. Por favor complete los datos manualmente.',
                    icon: 'info',
                    confirmButtonColor: '#003399'
                });
            }
        } catch (error) {
            console.error('Error in RUT search:', error);
            $('#rutStatus').text('Error de conexión.').fadeOut();
            Swal.fire('Error', 'No se pudo realizar la búsqueda.', 'error');
        }
    });

    // Event listener para cambios en la dirección del contribuyente (Geocodificación)
    $('#cont_direccion').on('blur', function () {
        let address = $(this).val();
        if (address && !isUpdatingFromMapCont) {
            geocodeAddress('cont', address);
        }
    });

    // Event listener para cambios en la dirección del incidente (Geocodificación)
    $('#oirs_direccion_incidente').on('blur', function () {
        let address = $(this).val();
        if (address && !isUpdatingFromMapInc) {
            geocodeAddress('inc', address);
        }
    });

    // Event listener for Temática change to update Subtemáticas
    $('#oirs_tematica').change(function () {
        const temId = $(this).val();
        const subSelect = $('#oirs_subtematica');
        subSelect.empty().append('<option value="" selected disabled>Seleccione subtemática...</option>');

        const filtered = allSubtematicas.filter(s => s.tem_id == temId);
        filtered.forEach(s => {
            subSelect.append(`<option value="${s.sub_id}">${s.sub_nombre}</option>`);
        });
    });

    // Finalizar Registro
    $('#btnFinalizar').click(async function () {
        let btn = $(this);

        // 1. Validar campos mínimos
        if (!$('#oirs_descripcion').val() || !$('#oirs_tematica').val()) {
            Swal.fire('Atención', 'Por favor complete la descripción y temática de la solicitud.', 'warning');
            return;
        }

        // 2. Confirmación
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

        // 3. Preparar Payload
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-2"></span>Registrando...');

        let payload = {
            ACCION: 'CREAR',
            // Datos del Contribuyente
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

            // Dirección Contribuyente (Opcional para historial)
            cont_direccion: $('#cont_direccion').val(),
            cont_latitud: $('#cont_lat').val(),
            cont_longitud: $('#cont_lng').val(),

            // Datos de la Solicitud
            oirs_tipo_atencion: $('#oirs_tipo_atencion').val(),
            oirs_origen_consulta: $('#oirs_origen').val(),
            oirs_condicion: $('#oirs_condicion').val(),
            oirs_fecha_hora: $('#oirs_fecha_reg').val() + ' ' + $('#oirs_hora_reg').val(),
            oirs_tematica: $('#oirs_tematica').val(),
            oirs_subtematica: $('#oirs_subtematica').val(),
            oirs_calle: $('#oirs_direccion_incidente').val(),
            oirs_sector: $('#oirs_sector').val(),
            oirs_descripcion: $('#oirs_descripcion').val(),
            oirs_estado: 1, // Recibida

            // Coordenadas Incidente
            oirs_latitud: $('#oirs_lat').val(),
            oirs_longitud: $('#oirs_lng').val(),

            // Documentos
            documentos: []
        };

        // 4. Leer archivos (si hay)
        const files = $('#oirs_adjuntos')[0].files;
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const fileData = await readFileAsBase64(files[i]);
                payload.documentos.push(fileData);
            }
        }

        // 5. Enviar a API
        try {
            const response = await fetch('../../api/oirs_solicitudes.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const res = await response.json();

            if (res.status === 'success') {
                // ÉXITO: Pasar a la etapa 3
                $('#oirs_folio_final').text('#OIRS-2602-' + res.id); // Placeholder format

                $('.step-content').addClass('d-none');
                $('#step-3').removeClass('d-none');
                $('#step-3-indicator').addClass('active completed');
                $('#step-2-indicator').addClass('completed').removeClass('active');
                window.scrollTo(0, 0);
                if (window.feather) feather.replace();

                Swal.fire({
                    title: '¡Registrado!',
                    text: 'La solicitud ha sido ingresada correctamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
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
});

async function cargarListas() {
    const apiBase = '../../api';
    const payload = { ACCION: 'CONSULTAM' };

    try {
        // Tipos de Atención
        fetch(`${apiBase}/trd_oirs_tipo_atencion.php`, {
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
        fetch(`${apiBase}/trd_oirs_condiciones.php`, {
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
        fetch(`${apiBase}/trd_oirs_tematicas.php`, {
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
        fetch(`${apiBase}/trd_oirs_subtematicas.php`, {
            method: 'POST',
            body: JSON.stringify(payload)
        }).then(r => r.json()).then(res => {
            if (res.status === 'success') allSubtematicas = res.data;
        });

        // Sectores
        fetch(`${apiBase}/sectores.php`, {
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
        fetch(`${apiBase}/trd_cont_escolaridad.php`, {
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
window.initMap = function () {
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

function updateMap(type, lat, lng, centerMap = true) {
    const pos = { lat: lat, lng: lng };
    if (type === 'cont') {
        if (!markerCont) return;
        markerCont.setPosition(pos);
        if (centerMap && mapCont) mapCont.setCenter(pos);
        $('#cont_lat').val(lat);
        $('#cont_lng').val(lng);
    } else {
        if (!markerInc) return;
        markerInc.setPosition(pos);
        if (centerMap && mapInc) mapInc.setCenter(pos);
        $('#oirs_lat').val(lat);
        $('#oirs_lng').val(lng);
    }
}

function geocodeAddress(type, address) {
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
        }
    });
}

function reverseGeocode(type, lat, lng) {
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
