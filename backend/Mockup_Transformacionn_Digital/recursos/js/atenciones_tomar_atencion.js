document.addEventListener('DOMContentLoaded', function () {
    console.log('Tomar Atención loaded');
    cargarAtenciones();
});

function cargarAtenciones() {
    fetch('../recursos/jsons/atenciones_tomar_atencion_mock.json')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaTomarAtencion tbody');
            tbody.innerHTML = ''; // Clear existing content

            data.forEach(atencion => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="col-id">${atencion.codigo}</td>
                    <td><span class="type-badge">${atencion.tipo}</span></td>
                    <td>${atencion.organizacion}</td>
                    <td>${atencion.rut}</td>
                    <td>${atencion.area}</td>
                    <td><span class="tiempo-badge"><i data-feather="clock"></i> ${atencion.tiempo_espera}</span></td>
                    <td class="col-desc">${atencion.descripcion}</td>
                    <td class="text-end">
                        <button class="action-btn-tomar float-end" onclick="abrirModalAtencion('${atencion.codigo}')">
                            <i data-feather="user"></i> Tomar
                        </button>
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
            console.error('Error cargando atenciones:', error);
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
