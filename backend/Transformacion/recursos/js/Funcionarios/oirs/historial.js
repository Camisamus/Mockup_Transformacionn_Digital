/**
 * OIRS Historial Component Logic
 */
$(document).ready(function () {
    // Toggle filters
    $('#btnAdvancedToggle').click(function () {
        $('#advancedPanel').toggleClass('show');
    });

    // Hover effect
    $('.oirs-row').hover(
        function () { $(this).css('transition', 'transform 0.1s ease').css('transform', 'scale(1.002)'); },
        function () { $(this).css('transform', 'scale(1)'); }
    );

    // Search simulation
    $('.input-group input').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $("#tableBody .oirs-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Export simulation
    $('.btn-success').click(function () {
        Swal.fire({
            title: 'Exportando Historial...',
            text: 'Se está preparando la descarga de sus gestiones.',
            icon: 'info',
            timer: 1500,
            showConfirmButton: false
        });
    });
});
