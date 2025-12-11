document.addEventListener('DOMContentLoaded', function () {
    console.log('Lista de Espera loaded');
});

function abrirModalAtencion(id) {
    var myModal = new bootstrap.Modal(document.getElementById('modalAtender'));
    // In a real application, you would fetch the details for 'id' here
    // and populate the modal fields before showing it.

    // Update title for demo purposes
    var modalTitle = document.getElementById('modalTitle');
    if (modalTitle) {
        modalTitle.innerText = 'Atender: ' + id;
    }

    myModal.show();
}
