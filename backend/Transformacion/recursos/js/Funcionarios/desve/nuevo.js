document.addEventListener('DOMContentLoaded', async function () {
    // Ensure API_BASE_URL is available
    if (!window.API_BASE_URL) {
        window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';
    }

    await loadInitialData();
    // Auth handled by PHP
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
    document.getElementById('orgc_rut').addEventListener('blur', function () { this.value = formatRut(this.value) });
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

    // Geolocation checkbox toggle
    const chkGeoloc = document.getElementById('chk_geoloc');
    if (chkGeoloc) {
        chkGeoloc.addEventListener('change', function () {
            const area = document.getElementById('geolocalizacion_area');
            if (this.checked) {
                area.style.display = 'block';
                // Trigger map resize/re-center with a small delay to ensure the div is rendered
                setTimeout(() => {
                    if (map) {
                        google.maps.event.trigger(map, 'resize');
                        map.setCenter(marker ? marker.getPosition() : defaultLocation);
                    }
                }, 200);
            } else {
                area.style.display = 'none';
            }
        });
    }

    // Geolocation search button
    const btnBuscarGeo = document.getElementById('btn_buscar_geo');
    if (btnBuscarGeo) {
        btnBuscarGeo.addEventListener('click', buscarDireccion);
    }
});

let organizaciones = [];
let organizacionesDESVE = [];
let organizacionesComunitarias = [];
let contribuyentes = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let areas = [];
let sectores = [];
let Solicitudes = [];
let selectedFiles = [];
let OrigenEspecial = 0; // Changed from boolean to integer (0, 1, 2)
let destinos = []; // Array for multiple destinations
let modalBusqueda = null;

// Map variables
let map, marker, geocoder;
const defaultLocation = { lat: -33.0248, lng: -71.5570 }; // Viña del Mar

window.initMap = function () {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map_desve"), {
        zoom: 15,
        center: defaultLocation,
        mapTypeControl: false,
        streetViewControl: false,
    });

    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: defaultLocation,
    });

    // Update coordinates when marker is dragged
    marker.addListener("dragend", function (event) {
        updateCoordinates(event.latLng);
    });

    // Move marker when map is clicked
    map.addListener("click", function (event) {
        marker.setPosition(event.latLng);
        updateCoordinates(event.latLng);
    });
};

function updateCoordinates(latLng) {
    document.getElementById("Latitud").value = latLng.lat().toFixed(6);
    document.getElementById("Longitud").value = latLng.lng().toFixed(6);
}

function buscarDireccion() {
    const address = document.getElementById("Geo_dir").value;
    if (!address) return;

    geocoder.geocode({ address: address + ", Viña del Mar, Chile" }, function (results, status) {
        if (status === "OK") {
            const pos = results[0].geometry.location;
            map.setCenter(pos);
            marker.setPosition(pos);
            updateCoordinates(pos);
        } else {
            Swal.fire('Error', 'No se pudo encontrar la dirección: ' + status, 'error');
        }
    });
}


async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, contribRes, tipoRes, prioRes, funcRes, secRes, solRes, orgComRes, areasRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}sisadmin/organizaciones/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}sisadmin/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, { ...fetchOptions, body: JSON.stringify({ ACCION: "CONSULTAM", S: "REINGRESO" }) }).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin\mantenedores\general\areas_general.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        organizacionesDESVE = extractData(orgResDESVE);
        contribuyentes = extractData(contribRes);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);
        Solicitudes = extractData(solRes);
        console.log('Solicitudes cargadas para reingreso:', Solicitudes.length, Solicitudes);
        organizacionesComunitarias = extractData(orgComRes);
        areas = extractData(areasRes);

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

window.abrirModalReingreso = function () {
    console.log('abrirModalReingreso llamado. Solicitudes:', Solicitudes.length, Solicitudes);
    const tbody = document.getElementById('lista_busqueda_reingreso');
    tbody.innerHTML = '';

    Solicitudes.forEach(s => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${s.sol_ingreso_desve || '-'}</td>
            <td>${s.sol_nombre_expediente || '-'}</td>
            <td>${s.sol_fecha_recepcion ? s.sol_fecha_recepcion.split(' ')[0] : '-'}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarReingreso('${s.sol_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroReingreso').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    const modal = new bootstrap.Modal(document.getElementById('modalReingreso'));
    modal.show();
};

window.seleccionarReingreso = function (id) {
    const s = Solicitudes.find(x => x.sol_id == id);
    if (s) {
        document.getElementById('ReingresoDisplay').value = `${s.sol_ingreso_desve} - ${s.sol_nombre_expediente}`;
        document.getElementById('Reingreso').value = s.sol_id;
    }
    bootstrap.Modal.getInstance(document.getElementById('modalReingreso')).hide();
};

function handleTipoOrgChange() {
    const idOrgId = document.getElementById('ID_Organizacion').value;
    if (!idOrgId) return;

    const orgDisplay = document.getElementById('OrigenSolicitudDisplay');
    const orgHidden = document.getElementById('OrigenSolicitud');
    const btnBuscarOrigen = document.getElementById('btn_buscar_origen');
    //const btnNuevoOrigen = document.getElementById('btn_nuevo_origen');

    // Reset current selection
    orgDisplay.value = '';
    orgHidden.value = '';

    // Determine priority
    const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
    const ORG_PRIO = selectedTipo ? selectedTipo.tor_prioridad_id : "";

    // Show/Hide buttons and set handlers
    if (idOrgId == "1" || idOrgId == "2") {
        // Territorial (1) or Funcional (2) -> Search Organizations
        OrigenEspecial = 0;
        btnBuscarOrigen.style.display = 'block';
        //btnNuevoOrigen.style.display = 'none';
        btnBuscarOrigen.disabled = false;
        //btnNuevoOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarOrganizacion();
        //btnNuevoOrigen.onclick = () => abrirModalNuevaOrganizacion();

    } else if (idOrgId == "3" || idOrgId == "5") {
        // Particular (3) or Ley Transparencia (5) -> Use Contributor Search
        OrigenEspecial = 1;
        btnBuscarOrigen.style.display = 'block';
        //btnNuevoOrigen.style.display = 'none';
        btnBuscarOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarContribuyente();

    } else if (["4"].includes(idOrgId)) {
        // Special Origins (Concejales, Contraloría, Congreso)
        OrigenEspecial = 2;
        btnBuscarOrigen.style.display = 'block';
        //btnNuevoOrigen.style.display = 'none';
        btnBuscarOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarOrganizacion();

    } else if (["6", "7"].includes(idOrgId)) {
        // Special Origins (Concejales, Contraloría, Congreso)
        OrigenEspecial = 2;
        btnBuscarOrigen.style.display = 'none';

        const matchingDESVE = organizacionesDESVE.filter(o => o.org_tipo_id == idOrgId);
        if (matchingDESVE.length > 0) {
            OrigenSolicitudDisplay.value = matchingDESVE[0].org_nombre;
            OrigenSolicitud.value = matchingDESVE[0].org_id;
        }

    } else {
        // Default
        OrigenEspecial = 0;
        btnBuscarOrigen.style.display = 'none';
        //btnNuevoOrigen.style.display = 'none';
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
        sol_latitud: document.getElementById('chk_geoloc').checked ? document.getElementById('Latitud').value : null,
        sol_longitud: document.getElementById('chk_geoloc').checked ? document.getElementById('Longitud').value : null,
        sol_direccion: document.getElementById('chk_geoloc').checked ? document.getElementById('Geo_dir').value : null,
        destinos: destinos, // Multiple destinations
        documentos: selectedFiles,
        ACCION: "CREAR"
    };

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
            credentials: 'include'
        });
        const result = await response.json();

        if (result.status === 'success') {
            await Swal.fire('Éxito', "Solicitud creada con éxito", 'success');
            window.location.href = 'index.php';
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



    // Populate Areas if not already
    // Populate Areas if not already
    const areaSelect = document.getElementById('filtro_area_fnc');
    if (areaSelect && areaSelect.options.length <= 2) {
        areaSelect.innerHTML = '<option value="">Todas las Áreas</option><option value="SIN_AREA">Sin Área Asignada</option>';
        areas.forEach(a => {
            const opt = document.createElement('option');
            opt.value = a.tga_id;
            opt.textContent = a.tga_nombre;
            areaSelect.appendChild(opt);
        });
    }

    funcionarios.forEach(f => {
        const row = document.createElement('tr');
        row.setAttribute('data-area-id', f.fnc_area_id || 'SIN_AREA');
        row.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>
                <div>${f.fnc_nombre || '-'}</div>
                <div class="x-small text-muted">${f.fnc_area_nombre || 'Sin Área'}</div>
            </td>
            <td>${f.fnc_apellido || '-'}</td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarFuncionario('${f.fnc_id}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    const filterFunc = function () {
        const val = document.getElementById('buscar_fnc_input').value.toLowerCase();
        const areaVal = document.getElementById('filtro_area_fnc').value;
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.forEach(tr => {
            const textMatch = tr.innerText.toLowerCase().includes(val);
            const rowAreaId = tr.getAttribute('data-area-id');

            let areaMatch = true;
            if (areaVal === '') {
                areaMatch = true;
            } else {
                areaMatch = (rowAreaId == areaVal);
            }

            tr.style.display = textMatch && areaMatch ? '' : 'none';
        });
    };

    const inputFunc = document.getElementById('buscar_fnc_input');
    const selectFunc = document.getElementById('filtro_area_fnc');

    if (inputFunc) inputFunc.onkeyup = filterFunc;
    if (selectFunc) selectFunc.onchange = filterFunc;

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
        const response = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, {
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
            const orgResDESVE = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, {
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
        document.getElementById('OrigenSolicitudDisplay').value = `${c.tgc_nombre} ${c.tgc_apellido_paterno} ${c.tgc_apellido_materno} (${c.tgc_rut})`;
        document.getElementById('OrigenSolicitud').value = `CONTRIB_${c.tgc_id}`;
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

        const response = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const result = await response.json();

        if (result.status === 'success') {
            // Reload contributors
            const contribRes = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, {
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

// Organization Search and Creation Functions
window.abrirModalBuscarOrganizacion = function () {
    const tbody = document.getElementById('lista_busqueda_org');
    tbody.innerHTML = '';
    const idOrgId = document.getElementById('ID_Organizacion').value;

    // Filter organizations by type
    const matchingComunitarias = organizacionesComunitarias.filter(o => o.orgc_tipo_organizacion == idOrgId);
    const matchingDESVE = organizacionesDESVE.filter(o => o.org_tipo_id == idOrgId);
    const matchingGeneral = organizaciones.filter(o => o.org_tipo_id == idOrgId);

    // Populate table
    matchingComunitarias.forEach(o => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${o.orgc_rut || '-'}</td>
            <td>${o.orgc_nombre}</td>
            <td><span class="badge bg-info text-dark">Comunitaria</span></td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarOrganizacion('OC_${o.orgc_id}', '${o.orgc_nombre}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    matchingDESVE.forEach(o => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>-</td>
            <td>${o.org_nombre}</td>
            <td><span class="badge bg-secondary">DESVE</span></td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarOrganizacion('${o.org_id}', '${o.org_nombre}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    matchingGeneral.forEach(o => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>-</td>
            <td>${o.org_nombre}</td>
            <td><span class="badge bg-light text-dark">General</span></td>
            <td class="text-end">
                <button type="button" class="btn btn-sm btn-primary" onclick="seleccionarOrganizacion('${o.org_id}', '${o.org_nombre}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('filtroOrganizacion').onkeyup = function () {
        const val = this.value.toLowerCase();
        Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
            tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
        });
    };

    const modal = new bootstrap.Modal(document.getElementById('modalBuscarOrganizacion'));
    modal.show();
};

window.seleccionarOrganizacion = function (id, nombre) {
    document.getElementById('OrigenSolicitudDisplay').value = nombre;
    document.getElementById('OrigenSolicitud').value = id;
    const modalEl = document.getElementById('modalBuscarOrganizacion');
    const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
    modal.hide();
};

window.abrirModalNuevaOrganizacion = function () {
    const searchModalEl = document.getElementById('modalBuscarOrganizacion');
    const searchModal = bootstrap.Modal.getInstance(searchModalEl);
    if (searchModal) searchModal.hide();

    document.getElementById('form_nueva_organizacion').reset();
    const modal = new bootstrap.Modal(document.getElementById('modalNuevaOrganizacion'));
    modal.show();
};

window.guardarNuevaOrganizacion = async function () {
    const form = document.getElementById('form_nueva_organizacion');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const idTipo = document.getElementById('ID_Organizacion').value;
    const payload = {
        ACCION: 'CREAR',
        orgc_nombre: document.getElementById('orgc_nombre').value,
        orgc_rut: document.getElementById('orgc_rut').value,
        orgc_codigo: document.getElementById('orgc_codigo').value,
        orgc_rpj: document.getElementById('orgc_rpj').value,
        orgc_tipo_organizacion: idTipo
    };

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const response = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const result = await response.json();

        if (result.status === 'success') {
            // Reload organizations
            const orgRes = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }).then(r => r.json());

            organizacionesComunitarias = extractData(orgRes);

            bootstrap.Modal.getInstance(document.getElementById('modalNuevaOrganizacion')).hide();
            Swal.fire('Éxito', 'Organización creada correctamente.', 'success');

            // Automatically select it
            if (result.id) {
                seleccionarOrganizacion(`OC_${result.id}`, payload.orgc_nombre);
            } else {
                const newOrg = organizacionesComunitarias.find(o => o.orgc_nombre === payload.orgc_nombre);
                if (newOrg) seleccionarOrganizacion(`OC_${newOrg.orgc_id}`, newOrg.orgc_nombre);
            }
        } else {
            Swal.fire('Error', result.message || 'Error al guardar', 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
};

