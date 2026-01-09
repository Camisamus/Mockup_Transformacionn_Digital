// postulaciones_consulta_postulacion.js
// Handles application consultation functionality

function buscarPostulacion() {
    console.log('Buscando postulación');
    Swal.fire('Búsqueda', 'Funcionalidad de búsqueda en desarrollo.', 'info');
}

function crearNueva() {
    console.log('Creando nueva postulación');
    // Clear all form fields
    document.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type === 'checkbox' || el.type === 'radio') {
            el.checked = false;
        } else {
            el.value = '';
        }
        el.removeAttribute('readonly');
    });
}

function modificar() {
    console.log('Modificando postulación');
    // Enable all fields except evaluation section
    document.querySelectorAll('input:not([id^="eval_"]), select, textarea:not([id^="eval_"])').forEach(el => {
        el.removeAttribute('readonly');
        el.removeAttribute('disabled');
    });
}

function guardar() {
    console.log('Guardando postulación');

    // Validate required fields
    const requiredFields = ['organizacion', 'rut', 'ant_nombre'];
    let isValid = true;

    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    if (isValid) {
        Swal.fire('Éxito', 'Postulación guardada exitosamente.', 'success');
    } else {
        Swal.fire('Atención', 'Por favor complete todos los campos requeridos (*).', 'warning');
    }
}

async function cancelar() {
    console.log('Cancelando cambios');
    const result = await Swal.fire({
        title: '¿Está seguro?',
        text: '¿Está seguro que desea cancelar los cambios?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, continuar editando'
    });
    if (result.isConfirmed) {
        location.reload();
    }
}

function imprimirPDF() {
    console.log('Imprimiendo PDF de la postulación');
    Swal.fire('PDF', 'Generando PDF de la postulación...', 'info');
}

// Format RUT on blur
document.addEventListener('DOMContentLoaded', function () {
    const rutInput = document.getElementById('rut');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            // Simple RUT formatting (add dashes and dots)
            let rut = this.value.replace(/\./g, '').replace(/-/g, '');
            if (rut.length > 1) {
                const dv = rut.slice(-1);
                const number = rut.slice(0, -1);
                this.value = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + dv;
            }
        });
    }
});
