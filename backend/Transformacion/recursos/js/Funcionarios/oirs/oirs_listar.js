/**
 * OIRS Listar Component Logic
 */
$(document).ready(function () {
    // Toggle advanced filters
    $('#btnAdvancedToggle').click(function () {
        $('#advancedPanel').toggleClass('show');
        $(this).toggleClass('active btn-primary btn-outline-primary');
        if ($(this).hasClass('active')) {
            $(this).text('MENOS FILTROS');
        } else {
            $(this).text('MÁS FILTROS');
        }
    });

    // Hover effect
    $('.oirs-row').hover(
        function () { $(this).css('transition', 'transform 0.1s ease').css('transform', 'scale(1.002)'); },
        function () { $(this).css('transform', 'scale(1)'); }
    );

    // Filter simulation
    $('.input-group input').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $("#tableBody .oirs-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Export simulation
    $('.btn-success').click(function () {
        Swal.fire({
            title: 'Exportando...',
            text: 'Se está generando el archivo Excel con los resultados.',
            icon: 'info',
            timer: 1500,
            showConfirmButton: false
        });
    });
});
