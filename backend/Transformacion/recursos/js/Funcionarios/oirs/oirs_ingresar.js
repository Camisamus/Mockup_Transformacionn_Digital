/**
 * OIRS Ingresar Component Logic
 */
let allSubtematicas = [];
$('#rut_contribuyente').on('blur', function () {
    // Formatear RUT 
    let formattedRut = formatRut($(this).val());
    $('#rut_contribuyente').val(formattedRut);

    // Helper: Formatear RUT
    function formatRut(rut) {
        let value = rut.replace(/[.-]/g, '');
        if (value.length < 2) return value;
        let dv = value.slice(-1);
        let num = value.slice(0, -1);
        return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '-' + dv;
    }
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
    $('#tipo_persona').change(function () {
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

                // Formatear dirección
                let dirParts = [];
                if (d.tcd_calle) dirParts.push(d.tcd_calle);
                if (d.tcd_numero) dirParts.push(d.tcd_numero);
                if (d.tcd_casa) dirParts.push(`Casa ${d.tcd_casa}`);
                if (d.tcd_departamento) dirParts.push(`Depto ${d.tcd_departamento}`);
                if (d.tcd_aclaratoria) dirParts.push(`(${d.tcd_aclaratoria})`);

                $('#cont_direccion').val(dirParts.join(' '));

            } else {
                $('#rutStatus').text('No encontrado.').delay(1000).fadeOut();

                // bloquear
                $('#rut_contribuyente').val(formattedRut).prop('readonly', true);

                // Focus en nombre
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

    // Helper: Formatear RUT
    function formatRut(rut) {
        let value = rut.replace(/[.-]/g, '');
        if (value.length < 2) return value;
        let dv = value.slice(-1);
        let num = value.slice(0, -1);
        return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '-' + dv;
    }

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
    $('#btnFinalizar').click(function () {
        Swal.fire({
            title: '¿Confirmar Registro?',
            text: "Se generará un nuevo folio de atención OIRS.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Registrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
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
            }
        });
    });
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
