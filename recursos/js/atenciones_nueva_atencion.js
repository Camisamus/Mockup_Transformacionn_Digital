// atenciones_nueva_atencion.js
// Handles functionality for creating a new attention

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formNuevaAtencion');
    const rutInput = document.getElementById('rut');
    const nombreInput = document.getElementById('nombre_solicitante');

    // Simulate mock data for RUT autocomplete
    rutInput.addEventListener('blur', function () {
        if (this.value === '76.123.456-7') {
            nombreInput.value = 'Junta de Vecinos N°1 El Progreso';
        } else if (this.value.length > 8) {
            nombreInput.value = 'Juan Pérez (Simulado)';
        } else {
            nombreInput.value = '';
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            e.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Simulate successful submission
        const tipo = document.getElementById('tipo_atencion').value;
        const rut = document.getElementById('rut').value;
        const nombre = nombreInput.value;

        alert(`Atención registrada exitosamente.\n\nRUT: ${rut}\nNombre: ${nombre}\nTipo: ${tipo}`);

        // Reset form or redirect
        form.reset();
        form.classList.remove('was-validated');
        // window.location.href = 'atenciones_lista_espera.html'; // Optional redirect
    });
});
