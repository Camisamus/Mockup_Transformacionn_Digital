// subvenciones_consulta_subvencion.js
document.addEventListener('DOMContentLoaded', async function () {
    console.log('Consulta de Subvención loaded');
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1:8081/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
    } else {
        // Mock load data
        console.log('Loading subsidy:', id);
    }

    // Initialize RUT formatting
    const rutInput = document.getElementById('rut_organizacion');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            formatearRUT(this);
        });
    }
});

function buscarSubvencion() {
    solicitarID();
}

async function crearNuevo() {
    const { isConfirmed } = await Swal.fire({
        title: '¿Desea crear una nueva subvención?',
        text: 'Los datos actuales se perderán si no han sido guardados.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, nuevo',
        cancelButtonText: 'Cancelar'
    });

    if (isConfirmed) {
        window.location.href = 'subvenciones_consulta_subvencion.php';
    }
}

function modificar() {
    Swal.fire('Información', 'Habilitando edición de campos...', 'info');
}

function cambiarEstado() {
    Swal.fire('Estado', 'Funcionalidad de cambio de estado en desarrollo.', 'info');
}

function imprimirPDF() {
    Swal.fire('PDF', 'Generando PDF de la subvención...', 'info');
}

function limpiarFormulario() {
    document.getElementById('formSubvencion').reset();
}

function guardarBorrador() {
    Swal.fire('Éxito', 'Borrador guardado correctamente.', 'success');
}

async function guardarSubvencion() {
    const form = document.getElementById('formSubvencion');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const { isConfirmed } = await Swal.fire({
        title: '¿Guardar subvención?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar'
    });

    if (isConfirmed) {
        Swal.fire('Éxito', 'Subvención guardada correctamente.', 'success');
    }
}

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Subvención no especificada',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="sub_id">ID Interno</option>
                    <option value="sub_numero" selected>Número Subvención (Ej: SUB-001)</option>
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
        window.location.href = 'subvenciones_consulta_masiva.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        // Mock search logic
        setTimeout(() => {
            if (value === '999' || value.toUpperCase() === 'SUB-999') {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('id', '999');
                window.location.href = newUrl.toString();
            } else {
                Swal.fire('No encontrado', 'No se encontró ninguna subvención con ese criterio.', 'error').then(() => {
                    solicitarID();
                });
            }
        }, 800);

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
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

