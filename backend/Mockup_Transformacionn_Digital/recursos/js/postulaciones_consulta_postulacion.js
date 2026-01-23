// postulaciones_consulta_postulacion.js
document.addEventListener('DOMContentLoaded', async () => {
    console.log('Postulaciones loaded');
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1:8081/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
    } else {
        console.log('Loading postulación:', id);
        cargarDatosPostulacion(id);
    }

    const rutInput = document.getElementById('rut');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            formatearRUT(this);
        });
    }
});

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Postulación no especificada',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="post_id">Cód. Interno (Interno)</option>
                    <option value="post_num">N° Ingreso (Ej: POST-2024-001)</option>
                    <option value="post_rut">RUT Organización</option>
                </select>
            </div>
            <div class="mb-2 text-start">
                <label class="form-label small fw-bold">Valor:</label>
                <input id="swal-id-value" class="form-control" placeholder="Ingrese el valor...">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Ir a Listado Masivo',
        allowOutsideClick: false,
        preConfirm: () => {
            const type = document.getElementById('swal-id-type').value;
            const value = document.getElementById('swal-id-value').value.trim();
            if (!value) {
                Swal.showValidationMessage('¡Debe ingresar un valor!');
                return false;
            }
            return { type, value };
        }
    });

    if (!formValues) {
        window.location.href = 'postulaciones_consulta_masiva.html';
        return;
    }

    window.location.href = `postulaciones_consulta_postulacion.html?id=${formValues.value}`;
}

function cargarDatosPostulacion(id) {
    // Mock population
    document.getElementById('numero_ingreso').value = id;
    document.getElementById('ant_nombre').value = 'MOCK PROJECT NAME';
}

function buscarPostulacion() { solicitarID(); }
function crearNueva() { window.location.href = 'postulaciones_consulta_postulacion.html'; }
function modificar() { Swal.fire('Edición', 'Habilitando campos para modificación...', 'info'); }
function imprimirPDF() { Swal.fire('PDF', 'Generando comprobante de postulación...', 'info'); }

function guardar() {
    Swal.fire('Éxito', 'Postulación guardada correctamente.', 'success');
}

async function cancelar() {
    const res = await Swal.fire({
        title: '¿Confirmar?',
        text: 'Se perderán los cambios no guardados.',
        icon: 'warning',
        showCancelButton: true
    });
    if (res.isConfirmed) location.reload();
}

function formatearRUT(input) {
    let value = input.value.replace(/[^0-9kK]/g, '');
    if (value.length > 1) {
        const dv = value.slice(-1);
        const number = value.slice(0, -1);
        const formattedNumber = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        input.value = formattedNumber + '-' + dv;
    }
}
