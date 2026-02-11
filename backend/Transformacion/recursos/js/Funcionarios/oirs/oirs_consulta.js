/**
 * OIRS Consulta Component Logic
 */
$(document).ready(function () {
    // Initializing tooltips if any

    // Tab switching logic is handled by Bootstrap Pills

    // Handle form submissions simulation
    $('.btn-primary').on('click', function (e) {
        if ($(this).text().includes('Enviar Respuesta')) {
            Swal.fire({
                title: 'Respuesta Enviada',
                text: 'Se ha notificado al contribuyente exitosamente.',
                icon: 'success',
                confirmButtonColor: '#003399'
            });
        }
    });

    // Handle file uploads UI simulation
    $('input[type="file"]').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        if (fileName) {
            Swal.fire({
                title: 'Archivo seleccionado',
                text: fileName,
                icon: 'info'
            });
        }
    });
});
