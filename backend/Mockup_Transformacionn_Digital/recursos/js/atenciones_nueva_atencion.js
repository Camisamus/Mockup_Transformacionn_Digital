// atenciones_nueva_atencion.js
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

    window.registrarAtencion = async function () {
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const { isConfirmed } = await Swal.fire({
            title: '¿Registrar nueva atención?',
            text: "Se guardarán los datos en el sistema.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        });

        if (isConfirmed) {
            Swal.fire({
                title: 'Registrando...',
                didOpen: () => Swal.showLoading()
            });

            // Simulate API call
            setTimeout(() => {
                Swal.fire('Éxito', 'Atención registrada correctamente.', 'success').then(() => {
                    form.reset();
                    window.location.href = 'atenciones_lista_espera.html';
                });
            }, 1000);
        }
    };
});
