document.addEventListener('DOMContentLoaded', function () {
    console.log('Lista de Espera loaded');
    cargarListaEspera();
});

function cargarListaEspera() {
    fetch('../recursos/jsons/atenciones_lista_espera_mock.json')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaEspera tbody');
            tbody.innerHTML = '';

            data.forEach(atencion => {
                const row = document.createElement('tr');

                let badgeClass = 'badge-normal';
                if (atencion.prioridad === 'ALTA') badgeClass = 'badge-alta';
                else if (atencion.prioridad === 'BAJA') badgeClass = 'badge-baja';

                row.innerHTML = `
                    <td><span class="${badgeClass}">${atencion.prioridad}</span></td>
                    <td class="fw-bold">${atencion.codigo}</td>
                    <td><span class="badge bg-white text-dark border fw-normal px-2">${atencion.tipo}</span></td>
                    <td>${atencion.organizacion}</td>
                    <td>${atencion.rut}</td>
                    <td>${atencion.area}</td>
                    <td>${atencion.uv}</td>
                    <td>${atencion.ingreso}</td>
                    <td><span class="badge bg-light text-dark fw-normal border"><i data-feather="clock" style="width:12px"></i> ${atencion.tiempo}</span></td>
                    <td>${atencion.usuario}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${atencion.codigo}')">
                                <i data-feather="eye" style="width:14px"></i>
                            </button>
                            <button class="btn btn-sm btn-dark px-3" onclick="abrirModalAtencion('${atencion.codigo}')">
                                Tomar
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            if (typeof feather !== 'undefined') feather.replace();
        })
        .catch(error => {
            console.error('Error cargando lista de espera:', error);
        });
}

function verDetalle(id) {
    window.location.href = `atenciones_consulta_atencion.php?id=${id}`;
}

function abrirModalAtencion(id) {
    var myModal = new bootstrap.Modal(document.getElementById('modalAtender'));
    var modalTitle = document.getElementById('modalTitle');
    if (modalTitle) modalTitle.innerText = 'Atender: ' + id;
    myModal.show();
}

window.completarAtencion = async function () {
    const { isConfirmed } = await Swal.fire({
        title: '¿Finalizar atención?',
        text: "Se registrará la solución y se cerrará la atención.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, finalizar',
        cancelButtonText: 'Cancelar'
    });

    if (isConfirmed) {
        Swal.fire({
            title: 'Procesando...',
            didOpen: () => Swal.showLoading()
        });

        setTimeout(() => {
            Swal.fire('Éxito', 'Atención finalizada correctamente.', 'success').then(() => {
                location.reload();
            });
        }, 1000);
    }
};

