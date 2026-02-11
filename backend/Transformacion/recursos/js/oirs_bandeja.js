/**
 * OIRS Bandeja Component Logic
 */
$(document).ready(function () {
    // Hover effects already handled by CSS and scale
    $('.oirs-row').hover(
        function () { $(this).css('transition', 'transform 0.1s ease').css('transform', 'scale(1.002)'); },
        function () { $(this).css('transform', 'scale(1)'); }
    );

    // Filter simulation
    $('input[placeholder="Buscar folio o RUT..."]').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $(".oirs-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Action button clicks propagation
    $('.btn-icon').click(function (e) {
        e.stopPropagation();
        // Handle specific actions if needed
    });
});
