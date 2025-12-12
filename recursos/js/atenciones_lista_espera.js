document.addEventListener('DOMContentLoaded', function () {
    console.log('Lista de Espera loaded');
    cargarListaEspera();
});

function cargarListaEspera() {
    fetch('../recursos/jsons/atenciones_lista_espera_mock.json')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaEspera tbody');
            tbody.innerHTML = ''; // Clear existing content

            data.forEach(atencion => {
                const row = document.createElement('tr');

                // Determine badge class based on priority
                let badgeClass = 'badge-normal';
                if (atencion.prioridad === 'ALTA') {
                    badgeClass = 'badge-alta';
                } else if (atencion.prioridad === 'BAJA') {
                    badgeClass = 'badge-baja';
                }

                row.innerHTML = `
                    <td><span class="${badgeClass}">${atencion.prioridad}</span></td>
                    <td>${atencion.codigo}</td>
                    <td><span class="type-badge">${atencion.tipo}</span></td>
                    <td>${atencion.organizacion}</td>
                    <td>${atencion.rut}</td>
                    <td>${atencion.area}</td>
                    <td>${atencion.uv}</td>
                    <td>${atencion.ingreso}</td>
                    <td><span class="tiempo-badge"><i data-feather="clock"></i> ${atencion.tiempo}</span></td>
                    <td>${atencion.usuario}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i data-feather="eye" class="action-icon"></i>
                            <button class="action-btn-tomar" onclick="abrirModalAtencion('${atencion.codigo}')">
                                <i data-feather="user"></i> Tomar
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            // Re-initialize feather icons after adding new content
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        })
        .catch(error => {
            console.error('Error cargando lista de espera:', error);
        });
}

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
