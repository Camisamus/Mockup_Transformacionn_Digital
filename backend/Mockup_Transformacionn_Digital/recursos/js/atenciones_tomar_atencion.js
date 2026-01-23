document.addEventListener('DOMContentLoaded', function () {
    console.log('Tomar Atención loaded');
    cargarAtenciones();
});

function cargarAtenciones() {
    fetch('../recursos/jsons/atenciones_tomar_atencion_mock.json')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaTomarAtencion tbody');
            tbody.innerHTML = '';

            data.forEach(atencion => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="fw-bold">${atencion.codigo}</td>
                    <td><span class="badge bg-white text-dark border fw-normal px-2">${atencion.tipo}</span></td>
                    <td>${atencion.organizacion}</td>
                    <td>${atencion.rut}</td>
                    <td>${atencion.area}</td>
                    <td><span class="badge bg-light text-dark fw-normal border"><i data-feather="clock" style="width:12px"></i> ${atencion.tiempo_espera}</span></td>
                    <td class="text-muted">${atencion.descripcion}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-dark px-3" onclick="abrirModalAtencion('${atencion.codigo}')">
                            Tomar
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            if (typeof feather !== 'undefined') feather.replace();
        })
        .catch(error => {
            console.error('Error cargando atenciones:', error);
        });
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
