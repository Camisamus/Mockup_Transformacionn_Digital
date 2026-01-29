document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/api';
    }

    await loadInitialData();
    seguridad();
    populateSelects();

    // Default to current date
    document.getElementById('FechaUltimaRecepcion').value = getCurrentDate();

    // Populate Responsible from session
    const userData = JSON.parse(localStorage.getItem('user_data') || '{}');
    const userId = userData.user ? userData.user.id : null;
    const responsableEl = document.getElementById('Responsable');
    if (userId && responsableEl) {
        responsableEl.setAttribute('data-user-id', userId);
    }

    // Event Listeners
    document.getElementById('ID_Organizacion').addEventListener('change', handleTipoOrgChange);
    //document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleTipoOrgChange);

    // btn_nuevo_origen onclick is set dynamically in handleTipoOrgChange

    // Initialize modal
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalFuncionarios'));

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
let organizacionesComunitarias = [];
let contribuyentes = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let Solicitudes = [];
let selectedFiles = [];
let OrigenEspecial = 0; // Changed from boolean to integer (0, 1, 2)
let destinos = []; // Array for multiple destinations
let modalBusqueda = null;

function formatRut(rut) {
    if (!rut) return '';
    let value = rut.replace(/[^0-9kK]/g, '');
    if (value.length <= 1) return value;
    const dv = value.slice(-1).toUpperCase();
    let body = value.slice(0, -1);
    body = body.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return `${body}-${dv}`;
}

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, orgComRes, contribRes, tipoRes, prioRes, funcRes, secRes, solRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        organizacionesDESVE = extractData(orgResDESVE);
        organizacionesComunitarias = extractData(orgComRes);
        contribuyentes = extractData(contribRes);
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
    const ReingresoSelect = document.getElementById('Reingreso');
    ReingresoSelect.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
    Solicitudes.forEach(o => {
        const option = document.createElement('option');
        option.value = o.sol_id;
        option.innerText = o.sol_ingreso_desve + " - " + o.sol_nombre_expediente;
        ReingresoSelect.appendChild(option);
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

    const orgSelect = document.getElementById('OrigenSolicitud');
    const btnNuevoOrigen = document.getElementById('btn_nuevo_origen');
    orgSelect.innerHTML = '<option value="" selected disabled>Seleccione organización...</option>';

    // Determine priority
    const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
    const ORG_PRIO = selectedTipo ? selectedTipo.tor_prioridad_id : "";

    // Conditional logic based on organization type
    if (idOrgId == "1" || idOrgId == "2") {
        // Territorial (1) or Funcional (2) -> Use Organizaciones Comunitarias
        OrigenEspecial = 0; // Normal
        btnNuevoOrigen.disabled = true;
        btnNuevoOrigen.onclick = null;
        orgSelect.disabled = false; // Enable dropdown

        organizacionesComunitarias.forEach(o => {
            if (o.orgc_tipo_organizacion == idOrgId) {
                const option = document.createElement('option');
                option.value = `OC_${o.orgc_id}`; // Prefix to identify source
                option.innerText = o.orgc_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else if (idOrgId == "3" || idOrgId == "5") {
        // Particular (3) or Ley Transparencia (5) -> Use Contributor Search
        OrigenEspecial = 1; // Special/Transparency
        btnNuevoOrigen.disabled = false;
        btnNuevoOrigen.onclick = () => abrirModalBuscarContribuyente();
        orgSelect.disabled = true; // Disable dropdown, use search instead
    } else if (["4", "6", "7"].includes(idOrgId)) {
        // Special Origins (Concejales, Contraloría, Congreso)
        OrigenEspecial = 2; // Super Special
        btnNuevoOrigen.disabled = false;
        btnNuevoOrigen.onclick = () => {
            const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
            modal.show();
        };
        orgSelect.disabled = false;

        organizacionesDESVE.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    } else {
        // Default: Use general organizations
        OrigenEspecial = 0;
        btnNuevoOrigen.disabled = true;
        btnNuevoOrigen.onclick = null;
        orgSelect.disabled = false;

        organizaciones.forEach(o => {
            if (o.org_tipo_id == idOrgId) {
                const option = document.createElement('option');
                option.value = o.org_id;
                option.innerText = o.org_nombre;
                orgSelect.appendChild(option);
            }
        });
    }

    // Set priority and calculate expiration
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

    // Parse origin value to extract actual ID
    let origenValue = document.getElementById('OrigenSolicitud').value;
    let origenTexto = '';

    // Handle different origin formats
    if (origenValue.startsWith('OC_')) {
        // Organizacion Comunitaria
        const ocId = origenValue.replace('OC_', '');
        const oc = organizacionesComunitarias.find(o => o.orgc_id == ocId);
        origenTexto = oc ? oc.orgc_nombre : '';
        origenValue = ocId; // Use the actual ID
    } else if (origenValue.startsWith('CONTRIB_')) {
        // Contributor
        const contribId = origenValue.replace('CONTRIB_', '');
        const contrib = contribuyentes.find(c => c.tgc_id == contribId);
        origenTexto = contrib ? `${contrib.tgc_nombre} ${contrib.tgc_apellido_paterno} ${contrib.tgc_apellido_materno}`.trim() : '';
        origenValue = contribId; // Use the actual ID
    }

    const body = {
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_ingreso_desve: document.getElementById('Codigo_DESVE').value,
        sol_reingreso_id: document.getElementById('Reingreso').value,
        sol_origen_id: origenValue,
        sol_origen_texto: origenTexto,
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: document.getElementById('FechaUltimaRecepcion').value + ' 00:00:00',
        sol_prioridad_id: prio ? prio.pri_id : null,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: reverseDate(document.getElementById('FechaVecimiento').value) + ' 00:00:00',
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_responsable: document.getElementById('Responsable')?.getAttribute('data-user-id') || null,
        sol_origen_esp: OrigenEspecial,
        destinos: destinos, // Multiple destinations
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
        { id: 'Sector', name: 'Sector' }
    ];

    for (const field of required) {
        if (!document.getElementById(field.id).value) {
            Swal.fire('Atención', `El campo ${field.name} es obligatorio.`, 'warning');
            return false;
        }
    }

    // Check for at least one destination
    if (destinos.length === 0) {
        Swal.fire('Atención', 'Debe agregar al menos un destinatario.', 'warning');
        return false;
    }

    return true;
}

// Modal & Officials logic
function abrirModalBuscarFuncionario() {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    funcionarios.forEach(f => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>${f.fnc_nombre || '-'}</td>
            <td>${f.fnc_apellido || '-'}</td>
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

    modalBusqueda.show();
}

window.seleccionarFuncionario = function (id) {
    const f = funcionarios.find(x => x.fnc_id == id);
    if (f) {
        const nombreCompleto = `${f.fnc_nombre || ''} ${f.fnc_apellido || ''}`.trim();

        // Add directly to destinos array
        destinos.push({
            usr_id: f.fnc_id,
            usr_nombre_completo: nombreCompleto
        });

        renderizarDestinos();
    }
    modalBusqueda.hide();
};

function renderizarDestinos() {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    if (destinos.length === 0) {
        tbody.innerHTML = '<tr id="placeholder_destinos"><td colspan="2" class="text-center text-muted py-3 small">No hay destinatarios agregados.</td></tr>';
        return;
    }

    destinos.forEach((d, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="small">${d.usr_nombre_completo}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="eliminarDestino(${index})">
                    <i data-feather="trash-2" style="width:14px"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

window.eliminarDestino = function (index) {
    destinos.splice(index, 1);
    renderizarDestinos();
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

// Contributor Search and Creation Functions
window.abrirModalBuscarContribuyente = function () {
    const tbody = document.getElementById('lista_busqueda_contrib');
    tbody.innerHTML = '';

    contribuyentes.forEach(c => {
        const nombreCompleto = `${c.tgc_nombre || ''} ${c.tgc_apellido_paterno || ''} ${c.tgc_apellido_materno || ''}`.trim();
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${c.tgc_rut || '-'}</td>
            <td>${nombreCompleto}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarContribuyente('${c.tgc_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroContribuyente').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    const modal = new bootstrap.Modal(document.getElementById('modalBuscarContribuyente'));
    modal.show();
};

window.seleccionarContribuyente = function (id) {
    const c = contribuyentes.find(x => x.tgc_id == id);
    if (c) {
        const orgSelect = document.getElementById('OrigenSolicitud');
        orgSelect.disabled = false;
        orgSelect.innerHTML = `<option value="CONTRIB_${c.tgc_id}" selected>${c.tgc_nombre} ${c.tgc_apellido_paterno} ${c.tgc_apellido_materno} (${c.tgc_rut})</option>`;
    }
    bootstrap.Modal.getInstance(document.getElementById('modalBuscarContribuyente')).hide();
};

window.abrirModalNuevoContribuyente = function () {
    // Close search modal first
    const searchModal = bootstrap.Modal.getInstance(document.getElementById('modalBuscarContribuyente'));
    if (searchModal) searchModal.hide();

    // Reset form
    document.getElementById('form_nuevo_contribuyente').reset();

    // Add RUT formatting
    const rutInput = document.getElementById('nc_rut');
    rutInput.onchange = function () {
        this.value = formatRut(this.value);
    };

    const modal = new bootstrap.Modal(document.getElementById('modalNuevoContribuyente'));
    modal.show();
};

window.guardarNuevoContribuyente = async function () {
    const form = document.getElementById('form_nuevo_contribuyente');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const payload = {
        ACCION: 'CREAR',
        tgc_rut: document.getElementById('nc_rut').value,
        tgc_nombre: document.getElementById('nc_nombre').value,
        tgc_apellido_paterno: document.getElementById('nc_paterno').value,
        tgc_apellido_materno: document.getElementById('nc_materno').value
    };

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const result = await response.json();

        if (result.status === 'success') {
            // Reload contributors
            const contribRes = await fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }).then(r => r.json());

            contribuyentes = extractData(contribRes);

            bootstrap.Modal.getInstance(document.getElementById('modalNuevoContribuyente')).hide();
            Swal.fire('Éxito', 'Contribuyente creado correctamente.', 'success');

            // Reopen search modal
            setTimeout(() => abrirModalBuscarContribuyente(), 300);
        } else {
            Swal.fire('Error', result.message || 'Error al guardar', 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
};
