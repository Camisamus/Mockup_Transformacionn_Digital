// subvenciones_consulta_pago.js
document.addEventListener('DOMContentLoaded', async function () {
    console.log('Consulta de Pago loaded');
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1:8081/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
    } else {
        // Mock load data
        console.log('Loading payment for subsidy:', id);
        mostrarDatosPago(id);
    }
});

function buscarPago() {
    solicitarID();
}

async function nuevoPago() {
    const { isConfirmed } = await Swal.fire({
        title: '¿Registrar nuevo pago?',
        text: 'Se habilitarán los campos para ingresar un nuevo registro.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, nuevo',
        cancelButtonText: 'Cancelar'
    });

    if (isConfirmed) {
        document.getElementById('datos_pago_card').style.display = 'block';
        document.getElementById('formPago').reset();
        document.querySelectorAll('#formPago input, #formPago textarea').forEach(el => {
            el.removeAttribute('readonly');
        });
    }
}

function mostrarDatosPago(id) {
    document.getElementById('datos_pago_card').style.display = 'block';
    // In production, fetch data. For mock:
    if (id === '1' || id === '999') {
        document.getElementById('pago_numero').value = id;
        document.getElementById('pago_fecha_evento').value = '2024-09-15';
        document.getElementById('pago_estado').value = 'TERMINADA';
        document.getElementById('pago_fecha_digitalizacion').value = '2024-09-20';
        document.getElementById('pago_responsable').value = 'María González López';
        document.getElementById('pago_glosa').value = 'Pago primera cuota subvención municipal';
        document.getElementById('pago_observaciones').value = 'Pago procesado correctamente según resolución N° 123/2024';
    }
}

async function guardarCambios() {
    const { isConfirmed } = await Swal.fire({
        title: '¿Guardar cambios?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, guardar'
    });

    if (isConfirmed) {
        Swal.fire('Éxito', 'Pago guardado correctamente.', 'success');
    }
}

function imprimirPDF() {
    Swal.fire('PDF', 'Generando PDF del pago...', 'info');
}

function cancelar() {
    document.getElementById('datos_pago_card').style.display = 'none';
}

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Pago no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="sub_numero" selected>Número Subvención (Ej: 1)</option>
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
        window.location.href = 'subvenciones_consulta_masiva_pagos.html';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        setTimeout(() => {
            if (value === '1' || value === '999') {
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('id', value);
                window.location.href = newUrl.toString();
            } else {
                Swal.fire('No encontrado', 'No se encontró ningún pago para esa subvención.', 'error').then(() => {
                    solicitarID();
                });
            }
        }, 800);

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}
