document.addEventListener('DOMContentLoaded', function () {
    console.log('Consulta de Atención loaded');
    // Here we can initialize data or load details if an ID is provided in the URL
});

function buscarAtencion() {
    alert('Funcionalidad de búsqueda en desarrollo');
}

function nuevaAtencion() {
    // Reset form
    document.getElementById('formConsultaAtencion').reset();

    // Set default keys if needed
    // document.getElementById('codigoAtencion').value = 'AT-NEW';
}

function modificarAtencion() {
    alert('Habilitar edición de campos');
    // Logic to enable disabled fields would go here
}

function exportarPDF() {
    alert('Generando PDF...');
}

function guardarAtencion() {
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

    console.log('Guardando atención:', data);
    alert('Atención guardada correctamente (Simulado)');
}
