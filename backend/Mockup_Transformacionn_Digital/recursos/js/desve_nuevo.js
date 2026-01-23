document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/api';
    }

    await loadInitialData();
    populateSelects();

    // Default to current date
    document.getElementById('FechaUltimaRecepcion').value = getCurrentDate();

    // Populate Responsible from session
    const userData = JSON.parse(localStorage.getItem('user_data') || '{}');
    const userId = userData.user ? userData.user.id : null;
    if (userId) {
        document.getElementById('Responsable').setAttribute('data-user-id', userId);
    }

    // Event Listeners
    document.getElementById('ID_Organizacion').addEventListener('change', handleTipoOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleTipoOrgChange);

    document.getElementById('btn_nuevo_origen').onclick = () => {
        const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
        modal.show();
    };

    document.getElementById('form_nuevo_desve').onsubmit = (e) => {
        e.preventDefault();
        guardarSolicitud();
    };

    // Drag and Drop
    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('inputArchivosSolicitud');

    dropZone.onclick = () => fileInput.click();
    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('active'); };
    dropZone.ondragleave = () => dropZone.classList.remove('active');
    dropZone.ondrop = (e) => {
        e.preventDefault();
        dropZone.classList.remove('active');
        handleFiles(e.dataTransfer.files);
    };
    fileInput.onchange = (e) => handleFiles(e.target.files);

    if (window.feather) feather.replace();
});

let organizaciones = [];
let organizacionesDESVE = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let Solicitudes = [];
let selectedFiles = [];
let OrigenEspecial = false;

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, tipoRes, prioRes, funcRes, secRes, solRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        organizacionesDESVE = extractData(orgResDESVE);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);
        Solicitudes = extractData(solRes);
    } catch (e) {
        console.error("Error loading initial data:", e);
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

function populateSelects() {
    const IDorgSelect = document.getElementById('ID_Organizacion');
    IDorgSelect.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
    tiposOrganizacion.forEach(o => {
        const option = document.createElement('option');
        option.value = o.tor_id;
        option.innerText = o.tor_nombre;
        IDorgSelect.appendChild(option);
    });

    const secSelect = document.getElementById('Sector');
    secSelect.innerHTML = '<option value="" selected disabled>Seleccione sector...</option>';
    sectores.forEach(s => {
        const option = document.createElement('option');
        option.value = s.sec_id;
        option.innerText = s.sec_nombre;
        secSelect.appendChild(option);
    });
}

function handleTipoOrgChange() {
    const idOrgId = document.getElementById('ID_Organizacion').value;
    if (!idOrgId) return;

    let idEsp = ["3", "4", "5", "6", "7"];
    let ORG_PRIO = "";

    const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
    if (selectedTipo) ORG_PRIO = selectedTipo.tor_prioridad_id;

    const orgSelect = document.getElementById('OrigenSolicitud');
    orgSelect.innerHTML = '<option value="" selected disabled>Seleccione organización...</option>';

    if (!idEsp.includes(idOrgId)) {
        OrigenEspecial = false;
        document.getElementById('btn_nuevo_origen').disabled = true;
        organizaciones.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else {
        OrigenEspecial = true;
        document.getElementById('btn_nuevo_origen').disabled = false;
        organizacionesDESVE.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    }

    const prio = prioridades.find(p => p.pri_id == ORG_PRIO);
    if (prio) {
        document.getElementById('Prioridad').value = prio.pri_nombre;
        calculateVencimiento(parseInt(prio.pri_tiempo_establecido) || 0);
    }
}

function calculateVencimiento(days) {
    const fechaIngresoValue = document.getElementById('FechaUltimaRecepcion').value;
    if (!fechaIngresoValue) return;

    let date = new Date(fechaIngresoValue);
    let count = 0;
    while (count < days) {
        date.setDate(date.getDate() + 1);
        if (date.getDay() !== 0 && date.getDay() !== 6) {
            count++;
        }
    }

    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');

    document.getElementById('FechaVecimiento').value = `${day}-${month}-${year}`;
}

function getCurrentDate() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedFiles.push({
                nombre: file.name,
                base64: e.target.result
            });
            renderFileList();
        };
        reader.readAsDataURL(file);
    });
}

function renderFileList() {
    const listContainer = document.getElementById('listaArchivosSolicitud');
    listContainer.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
        item.innerHTML = `
            <div>
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file text-primary me-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
               <span class="small">${file.nombre}</span>
            </div>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFile(${index})">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        `;
        listContainer.appendChild(item);
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    renderFileList();
}

async function guardarSolicitud() {
    if (!validarFormulario()) return;

    const prioName = document.getElementById('Prioridad').value;
    const prio = prioridades.find(p => p.pri_nombre === prioName);

    const body = {
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_origen_id: document.getElementById('OrigenSolicitud').value,
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: document.getElementById('FechaUltimaRecepcion').value + ' 00:00:00',
        sol_prioridad_id: prio ? prio.pri_id : null,
        sol_funcionario_id: document.getElementById('FuncionarioInternoId').value,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: reverseDate(document.getElementById('FechaVecimiento').value) + ' 00:00:00',
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_responsable: document.getElementById('Responsable')?.getAttribute('data-user-id') || null,
        sol_origen_esp: OrigenEspecial,
        documentos: selectedFiles,
        ACCION: "CREAR"
    };

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
            credentials: 'include'
        });
        const result = await response.json();

        if (result.status === 'success') {
            await Swal.fire('Éxito', "Solicitud creada con éxito", 'success');
            window.location.href = 'desve_listado_ingresos.html';
        } else {
            Swal.fire('Error', result.message || "Error al guardar solicitud", 'error');
        }
    } catch (e) {
        console.error("Save Error:", e);
        Swal.fire('Error', "Error de conexión al guardar.", 'error');
    }
}

function reverseDate(d) {
    if (!d || d === 'Pendiente') return '';
    const parts = d.split('-');
    return `${parts[2]}-${parts[1]}-${parts[0]}`;
}

function validarFormulario() {
    const required = [
        { id: 'NombreExpediente', name: 'Nombre del Expediente' },
        { id: 'ID_Organizacion', name: 'Tipo de Organización' },
        { id: 'OrigenSolicitud', name: 'Origen de Solicitud' },
        { id: 'FechaUltimaRecepcion', name: 'Fecha de Recepción' },
        { id: 'Sector', name: 'Sector' },
        { id: 'FuncionarioInternoId', name: 'Funcionario Interno' }
    ];

    for (const field of required) {
        if (!document.getElementById(field.id).value) {
            Swal.fire('Atención', `El campo ${field.name} es obligatorio.`, 'warning');
            return false;
        }
    }
    return true;
}

// Modal & Officials logic
function abrirModalFuncionarios() {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    funcionarios.forEach(f => {
        const nombreCompleto = `${f.fnc_nombre || ''} ${f.fnc_apellido || ''}`.trim();
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${f.fnc_rut || '-'}</td>
            <td>${nombreCompleto}</td>
            <td>${f.fnc_cargo || '-'}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarFuncionario('${f.fnc_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroFuncionario').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    const modal = new bootstrap.Modal(document.getElementById('modalFuncionarios'));
    modal.show();
}

window.seleccionarFuncionario = function (id) {
    const f = funcionarios.find(x => x.fnc_id == id);
    if (f) {
        document.getElementById('FuncionarioInternoId').value = f.fnc_id;
        document.getElementById('FuncionarioInternoNombre').value = `${f.fnc_nombre} ${f.fnc_apellido}`;
    }
    bootstrap.Modal.getInstance(document.getElementById('modalFuncionarios')).hide();
};

window.guardarOrigenEspecial = async function () {
    const texto = document.getElementById('textoNuevoOrigenEspecial').value.trim();
    const idTipo = document.getElementById('ID_Organizacion').value;

    if (!texto) return Swal.fire('Atención', 'Ingrese un nombre.', 'warning');

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CREAR", org_tipo_id: idTipo, org_nombre: texto })
        });
        const result = await response.json();

        if (result.status === 'success') {
            document.getElementById('textoNuevoOrigenEspecial').value = '';
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoOrigenEspecial')).hide();

            // Reload organizations
            const orgResDESVE = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: "CONSULTAM" })
            }).then(r => r.json());

            organizacionesDESVE = extractData(orgResDESVE);
            handleTipoOrgChange();
            Swal.fire('Éxito', 'Origen especial guardado.', 'success');
        }
    } catch (e) {
        console.error(e);
    }
};
