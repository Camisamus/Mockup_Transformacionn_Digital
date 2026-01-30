document.addEventListener('DOMContentLoaded', async function () {
    console.log('Consulta de Atención loaded');
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
        return;
    }

    // Logic to load attention details by id...
    console.log('Loading attention ID:', id);
});

function buscarAtencion() {
    solicitarID();
}

function nuevaAtencion() {
    window.location.href = 'atenciones_nueva_atencion.html';
}

function modificarAtencion() {
    Swal.fire('Información', 'Habilitando edición de campos...', 'info');
    // Logic to enable fields
}

function exportarPDF() {
    Swal.fire('Exportar', 'Generando PDF de la atención...', 'info');
}

async function guardarAtencion() {
    // Collect data
    const data = {
        tipo: document.getElementById('tipoAtencion').value,
        codigo: document.getElementById('codigoAtencion').value,
        organizacion: document.getElementById('codigoOrganizacion').value,
        rut: document.getElementById('rut').value,
        nombreOrg: document.getElementById('nombreOrganizacion').value,
        estado: document.getElementById('estado').value,
        proyecto: document.getElementById('proyecto').value,
        area: document.getElementById('area').value,
        unidad: document.getElementById('unidadVecinal').value,
        fecha: document.getElementById('fechaAtencion').value,
        usuarioIngreso: document.getElementById('usuarioIngreso').value,
        usuarioResp: document.getElementById('usuarioResponsable').value,
        descripcion: document.getElementById('descripcionAtencion').value,
        observaciones: document.getElementById('observaciones').value,
    };

    const { isConfirmed } = await Swal.fire({
        title: '¿Guardar cambios?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar'
    });

    if (isConfirmed) {
        Swal.fire('Éxito', 'Atención guardada correctamente (Simulado)', 'success');
        console.log('Guardando atención:', data);
    }
}

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Atención no especificada',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="atn_id">ID Interno</option>
                    <option value="atn_codigo" selected>Código Atención (Ej: AT-001)</option>
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
        cancelButtonText: 'Ir a Listado',
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
        window.location.href = 'atenciones_listado_atenciones.html';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        // Mocking search logic for Atenciones
        // In a real scenario, this would call an API like solicitudes_desve.php but for atenciones

        setTimeout(() => {
            // Simulated success for demonstration
            if (value === '999' || value === 'AT-999') {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('id', '999');
                window.location.href = newUrl.toString();
            } else {
                Swal.fire('No encontrado', 'No se encontró ninguna atención con ese criterio.', 'error').then(() => {
                    solicitarID();
                });
            }
        }, 800);

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}
