// Logic for Consulta Organizacion Page
document.addEventListener('DOMContentLoaded', async () => {
    console.log('Consulta Organización loaded');
    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1:8081/api';

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    if (!id) {
        solicitarID();
    } else {
        // Mock load data
        console.log('Loading organization:', id);
        loadOrganizacion(id);
    }

    // Initialize RUT formatting
    const rutInput = document.getElementById('rut');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            formatearRUT(this);
        });
    }
});

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Organización no especificada',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="org_id">Cód. Interno (Interno)</option>
                    <option value="org_rut" selected>RUT (Ej: 99.999.999-9)</option>
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
        window.location.href = 'organizaciones_consulta_masiva.html';
        return;
    }

    const { type, value } = formValues;
    window.location.href = `organizaciones_consulta_organizacion.html?id=${value}`;
}

async function loadOrganizacion(id) {
    try {
        const response = await fetch('../recursos/jsons/organizaciones_organizacion_mock.json');
        const data = await response.json();
        const org = data.organizacion;

        // Populate fields
        document.getElementById('nombre').value = org.nombre;
        document.getElementById('rut').value = org.rut;
        document.getElementById('codigo').value = org.codigo;
        // ... populate more if needed as per UI

        renderAtenciones();
        renderProyectos();
    } catch (e) {
        console.error('Error loading org data', e);
    }
}

function renderAtenciones() {
    fetch('../recursos/jsons/organizaciones_atenciones_mock.json')
        .then(r => r.json())
        .then(data => {
            const tbody = document.querySelector('#tablaAtenciones tbody');
            tbody.innerHTML = '';
            data.atenciones.forEach(at => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="fw-bold">${at.numeroAtencion}</td>
                    <td>${at.fecha}</td>
                    <td>${at.atencion}</td>
                    <td>${at.proyecto}</td>
                    <td><span class="badge ${at.estadoClass} fw-normal">${at.estado}</span></td>
                    <td>${at.usuario}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary"><i data-feather="eye"></i></button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            feather.replace();
        });
}

function renderProyectos() {
    fetch('../recursos/jsons/organizaciones_proyectos_mock.json')
        .then(r => r.json())
        .then(data => {
            const tbody = document.querySelector('#tablaProyectos tbody');
            tbody.innerHTML = '';
            data.proyectos.forEach(pr => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${pr.unidad}</td>
                    <td>${pr.anio}</td>
                    <td class="fw-bold">${pr.numeroIngreso}</td>
                    <td>${pr.nombreProyecto}</td>
                    <td>${pr.tipoFondo}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-outline-secondary"><i data-feather="eye"></i></button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            feather.replace();
        });
}

function buscarOrganizacion() { solicitarID(); }
function nuevaOrganizacion() { window.location.href = 'organizaciones_consulta_organizacion.html'; }
function editarFormulario() { Swal.fire('Edición', 'Habilitando campos...', 'info'); }
function generarCertificado() { Swal.fire('PDF', 'Generando certificado...', 'info'); }

function guardarCambios() {
    Swal.fire('Éxito', 'Organización guardada correctamente.', 'success');
}

function limpiarFormulario() {
    document.getElementById('formOrganizacion').reset();
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
