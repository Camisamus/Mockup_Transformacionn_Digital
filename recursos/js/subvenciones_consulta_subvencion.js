// subvenciones_consulta_subvencion.js
// Handles subsidy consultation functionality

document.addEventListener('DOMContentLoaded', function () {
    // Initialize RUT formatting
    const rutInput = document.getElementById('rut_organizacion');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            formatearRUT(this);
        });
    }
});

/**
 * Search for a subsidy
 */
function buscarSubvencion() {
    const numero = document.getElementById('numero').value.trim();

    if (!numero) {
        alert('Por favor ingrese un número de subvención para buscar.');
        return;
    }

    console.log('Buscando subvención:', numero);
    // In production, this would make an API call
    alert('Funcionalidad de búsqueda en desarrollo.\n\nBuscando subvención: ' + numero);
}

/**
 * Create new subsidy
 */
function crearNuevo() {
    if (confirm('¿Desea crear una nueva subvención? Los datos actuales se limpiarán.')) {
        limpiarFormulario();
        console.log('Creando nueva subvención');
    }
}

/**
 * Modify existing subsidy
 */
function modificar() {
    const numero = document.getElementById('numero').value.trim();

    if (!numero) {
        alert('Debe buscar una subvención antes de modificarla.');
        return;
    }

    console.log('Modificando subvención:', numero);
    alert('Funcionalidad de modificación en desarrollo.');
}

/**
 * Change subsidy status
 */
function cambiarEstado() {
    const numero = document.getElementById('numero').value.trim();
    const estadoActual = document.getElementById('estado').value;

    if (!numero) {
        alert('Debe buscar una subvención antes de cambiar su estado.');
        return;
    }

    console.log('Cambiando estado de subvención:', numero, 'Estado actual:', estadoActual);
    alert('Funcionalidad de cambio de estado en desarrollo.');
}

/**
 * Print subsidy as PDF
 */
function imprimirPDF() {
    const numero = document.getElementById('numero').value.trim();

    if (!numero) {
        alert('Debe buscar una subvención antes de imprimir.');
        return;
    }

    console.log('Imprimiendo PDF de subvención:', numero);
    alert('Generando PDF...\n\nEsta funcionalidad generará un documento PDF con los datos de la subvención.');
}

/**
 * Clear all form fields
 */
function limpiarFormulario() {
    document.getElementById('numero').value = '';
    document.getElementById('estado').value = '';
    document.getElementById('fecha').value = '';
    document.getElementById('tipo_subvencion').value = '';
    document.getElementById('rut_organizacion').value = '';
    document.getElementById('nombre_organizacion').value = '';
    document.getElementById('monto_solicitado').value = '';
    document.getElementById('organismo_aprobador').value = '';
    document.getElementById('anio').value = '';
    document.getElementById('anio_decreto').value = '';
    document.getElementById('numero_decreto').value = '';
    document.getElementById('numero_monto').value = '';
    document.getElementById('anio_matriz').value = '';
    document.getElementById('finalidad_proyecto').value = '';
    document.getElementById('objetivo_subvencion').value = '';

    console.log('Formulario limpiado');
}

/**
 * Save subsidy as draft
 */
function guardarBorrador() {
    if (validarCamposRequeridos(false)) {
        console.log('Guardando borrador de subvención');
        alert('Borrador guardado exitosamente.');
    }
}

/**
 * Save subsidy
 */
function guardarSubvencion() {
    if (validarCamposRequeridos(true)) {
        const datos = {
            numero: document.getElementById('numero').value,
            estado: document.getElementById('estado').value,
            fecha: document.getElementById('fecha').value,
            tipo_subvencion: document.getElementById('tipo_subvencion').value,
            rut_organizacion: document.getElementById('rut_organizacion').value,
            nombre_organizacion: document.getElementById('nombre_organizacion').value,
            monto_solicitado: document.getElementById('monto_solicitado').value,
            organismo_aprobador: document.getElementById('organismo_aprobador').value,
            anio: document.getElementById('anio').value,
            anio_decreto: document.getElementById('anio_decreto').value,
            numero_decreto: document.getElementById('numero_decreto').value,
            numero_monto: document.getElementById('numero_monto').value,
            anio_matriz: document.getElementById('anio_matriz').value,
            finalidad_proyecto: document.getElementById('finalidad_proyecto').value,
            objetivo_subvencion: document.getElementById('objetivo_subvencion').value
        };

        console.log('Guardando subvención:', datos);
        alert('Subvención guardada exitosamente.');
    }
}

/**
 * Validate required fields
 */
function validarCamposRequeridos(strict = true) {
    const camposRequeridos = [
        { id: 'numero', nombre: 'Número' },
        { id: 'fecha', nombre: 'Fecha' },
        { id: 'rut_organizacion', nombre: 'RUT Organización' },
        { id: 'nombre_organizacion', nombre: 'Nombre Organización' },
        { id: 'monto_solicitado', nombre: 'Monto Solicitado' }
    ];

    const camposVacios = [];

    for (const campo of camposRequeridos) {
        const valor = document.getElementById(campo.id).value.trim();
        if (!valor) {
            camposVacios.push(campo.nombre);
        }
    }

    if (camposVacios.length > 0 && strict) {
        alert('Por favor complete los siguientes campos requeridos:\n\n' + camposVacios.join('\n'));
        return false;
    }

    return true;
}

/**
 * Format RUT with dots and dash
 */
function formatearRUT(input) {
    let value = input.value.replace(/[^0-9kK]/g, '');

    if (value.length > 1) {
        const dv = value.slice(-1);
        const number = value.slice(0, -1);
        const formattedNumber = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        input.value = formattedNumber + '-' + dv;
    }
}
