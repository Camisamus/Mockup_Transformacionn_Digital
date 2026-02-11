/**
 * OIRS Ingresar Component Logic
 */
$(document).ready(function () {
    // Stepper Navigation Logic
    $('.btnNext').click(function () {
        let next = $(this).data('next');

        // Basic validation or logic can be added here

        $('.step-content').addClass('d-none');
        $(`#step-${next}`).removeClass('d-none');

        // Update indicators
        $(`#step-${next}-indicator`).addClass('active');
        $(`#step-${next - 1}-indicator`).addClass('completed').removeClass('active');

        window.scrollTo(0, 0);
        feather.replace();
    });

    $('.btnPrev').click(function () {
        let prev = $(this).data('prev');

        $('.step-content').addClass('d-none');
        $(`#step-${prev}`).removeClass('d-none');

        // Update indicators
        $(`#step-${prev}-indicator`).addClass('active').removeClass('completed');
        $(`#step-${prev + 1}-indicator`).removeClass('active');

        window.scrollTo(0, 0);
        feather.replace();
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

    // Simulación búsqueda RUT
    $('#btnBuscarRut').click(function () {
        let rut = $('#rut_contribuyente').val();
        if (rut) {
            $('#rutStatus').fadeIn();
            setTimeout(function () {
                $('#rutStatus').text('¡Datos encontrados!');

                // Pre-llenado simulado
                if ($('#tipo_persona').val() === 'natural') {
                    $('input[name="nombre"]').val('Juan Pablo');
                    $('input[name="apellido_p"]').val('Martínez');
                    $('input[name="apellido_m"]').val('González');
                }

                $('#rutStatus').delay(1000).fadeOut();
            }, 1000);
        } else {
            Swal.fire({
                title: 'Atención',
                text: 'Por favor ingrese un RUT para buscar.',
                icon: 'warning',
                confirmButtonColor: '#003399'
            });
        }
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
                // Here you would normally perform the AJAX call to save

                // Show success step
                $('.step-content').addClass('d-none');
                $('#step-3').removeClass('d-none');

                // Finalize indicators
                $('#step-3-indicator').addClass('active completed');
                $('#step-2-indicator').addClass('completed').removeClass('active');

                window.scrollTo(0, 0);
                feather.replace();

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
