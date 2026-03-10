// Global Variables
let solicitationId = null;
let currentUser = {};
let organizaciones = [];
let contribuyentes = [];
let prioridades = [];
let funcionarios = [];
let areas = [];
let organizacionesComunitarias = [];
let organizacionesDESVE = [];
let Solicitudes = [];
let currentSolRegistroId = null;
let destinos = [];
let selectedFiles = [];
let OrigenEspecial = 0; // 0: Normal, 1: Contribuyente, 2: Especial
let modalBusqueda;
let auditData = [];
let currentAuditPage = 1;
let itemsPerPage = 10;
let tiposOrganizacion = [];
let sectores = [];
let map, marker, geocoder;
let sessionData;
const defaultLocation = { lat: -33.0248997, lng: -71.5570399 }; // Viña del Mar

document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    solicitationId = params.get('id');

    if (!solicitationId) {
        solicitarID();
        return;
    }

    if (!window.API_BASE_URL) {
        const currentPath = window.location.pathname;
        const basePath = currentPath.substring(0, currentPath.lastIndexOf('/funcionarios/'));
        window.API_BASE_URL = window.location.origin + basePath + '/api';
    }
    // 1. Verify Session
    const sessionRes = await fetch(`${window.API_BASE_URL}/general/verify_session.php`, {
        method: 'POST',
        credentials: 'include',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ACCION: "" })
    });
    sessionData = await sessionRes.json();

    if (!sessionData.isAuthenticated || !sessionData.user) {
        await Swal.fire({
            title: "Sesión Requerida",
            text: "Debe iniciar sesión para acceder a esta página.",
            icon: "warning",
            confirmButtonText: "Ir al Login"
        });
        window.location.href = 'index.php'; // Assuming index is login
        return;
    }
    currentUser = sessionData.user || {};
    if (!currentUser.id) {
        console.warn("User ID not found in session, some features might be limited.");
    }

    await loadInitialData();
    populateSelects();
    loadSolicitationDetails(solicitationId, currentUser);
    // Initialize modal
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalFuncionarios'));

    // Event Listeners
    document.getElementById('ID_Organizacion').addEventListener('change', handleTipoOrgChange);
    document.getElementById('FechaUltimaRecepcion').addEventListener('change', handleTipoOrgChange);
    document.getElementById('Prioridad').addEventListener('change', function () {
        const prioId = this.value;
        const prio = prioridades.find(p => p.pri_id == prioId);
        if (prio && prio.pri_tiempo_establecido) {
            calculateVencimiento(parseInt(prio.pri_tiempo_establecido));
        }
    });

    const btnNuevoOrigen = document.getElementById('btn_nuevo_origen');
    if (btnNuevoOrigen) {
        btnNuevoOrigen.onclick = () => {
            const modal = new bootstrap.Modal(document.getElementById('modalNuevoOrigenEspecial'));
            modal.show();
        };
    }

    // Geolocation Toggle Logic
    const chkGeoloc = document.getElementById('chk_geoloc');
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

    document.getElementById('btn_buscar_geo').onclick = function () {
        const address = document.getElementById('Geo_dir').value;
        if (address) {
            geocodeAddress(address);
        } else {
            Swal.fire('Atención', 'Ingrese una dirección para buscar.', 'warning');
        }
    };

    document.getElementById('form_modificar_desve').onsubmit = (e) => {
        e.preventDefault();
        actualizarSolicitud();
    };

    document.getElementById('btn_cancelar_toolbar').onclick = () => {
        window.location.href = `consultar.php?id=${solicitationId}`;
    };

    // Drag and Drop for new files
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

window.abrirModalReingreso = function () {
    console.log('abrirModalReingreso llamado. Solicitudes:', Solicitudes.length, Solicitudes);
    const tbody = document.getElementById('lista_busqueda_reingreso');
    if (!tbody) return;
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

    const filtro = document.getElementById('filtroReingreso');
    if (filtro) {
        filtro.onkeyup = function () {
            const val = this.value.toLowerCase();
            Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
                tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none';
            });
        };
    }

    const modalElem = document.getElementById('modalReingreso');
    if (modalElem) {
        const modal = new bootstrap.Modal(modalElem);
        modal.show();
    }
};

window.seleccionarReingreso = function (id) {
    const s = Solicitudes.find(x => x.sol_id == id);
    if (s) {
        if (document.getElementById('ReingresoDisplay')) document.getElementById('ReingresoDisplay').value = `${s.sol_ingreso_desve} - ${s.sol_nombre_expediente}`;
        if (document.getElementById('Reingreso')) document.getElementById('Reingreso').value = s.sol_id;
    }
    const modalElem = document.getElementById('modalReingreso');
    if (modalElem) {
        const instance = bootstrap.Modal.getInstance(modalElem);
        if (instance) instance.hide();
    }
};

// --- Geolocation Functions (Global) ---
window.initMap = function () {
    const latInput = document.getElementById('Latitud') ? document.getElementById('Latitud').value : null;
    const lngInput = document.getElementById('Longitud') ? document.getElementById('Longitud').value : null;

    const initialPos = (latInput && lngInput)
        ? { lat: parseFloat(latInput), lng: parseFloat(lngInput) }
        : defaultLocation;

    const mapElement = document.getElementById("map_desve");
    if (!mapElement) return;

    map = new google.maps.Map(mapElement, {
        center: initialPos,
        zoom: 15,
    });

    marker = new google.maps.Marker({
        position: initialPos,
        map: map,
        draggable: true,
    });

    geocoder = new google.maps.Geocoder();

    marker.addListener("dragend", function (event) {
        updateCoordinates(event.latLng);
    });

    map.addListener("click", function (event) {
        marker.setPosition(event.latLng);
        updateCoordinates(event.latLng);
    });
};

function updateCoordinates(latLng) {
    if (document.getElementById("Latitud")) document.getElementById("Latitud").value = latLng.lat().toFixed(7);
    if (document.getElementById("Longitud")) document.getElementById("Longitud").value = latLng.lng().toFixed(7);
}

function geocodeAddress(address) {
    if (!geocoder) {
        geocoder = new google.maps.Geocoder();
    }
    geocoder.geocode({ address: address + ", Viña del Mar, Chile" }, function (results, status) {
        if (status === "OK") {
            const pos = results[0].geometry.location;
            if (map) map.setCenter(pos);
            if (marker) marker.setPosition(pos);
            updateCoordinates(pos);
        } else {
            Swal.fire("Error", "No se pudo geocodificar la dirección: " + status, "error");
        }
    });
}

function abrirModalNuevoComentario() {
    const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
    modal.show();
}

async function guardarComentario() {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) return;

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const response = await fetch(`${window.API_BASE_URL}/desve/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                com_solicitud_id: solicitationId,
                com_texto: texto
            })
        });
        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario')).hide();
            Swal.fire('Éxito', "Comentario guardado", 'success');
            // Refresh details to show new comment
            loadSolicitationDetails(solicitationId, currentUser);
        } else {
            Swal.fire('Error', result.message || "Error al guardar", 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', "Error de conexión", 'error');
    }
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
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, { ...fetchOptions, body: JSON.stringify({ ACCION: "CONSULTAM", S: "REINGRESO" }) }).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/areas_general.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        contribuyentes = extractData(contribRes);
        organizacionesDESVE = extractData(orgResDESVE);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);
        Solicitudes = extractData(solRes);
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

    const prioSelect = document.getElementById('Prioridad');
    if (prioSelect) {
        prioSelect.innerHTML = '<option value="" selected disabled>Seleccione prioridad...</option>';
        prioridades.forEach(p => {
            const option = document.createElement('option');
            option.value = p.pri_id;
            option.innerText = p.pri_nombre;
            prioSelect.appendChild(option);
        });
    }

    const respSelect = document.getElementById('Responsable');
    if (respSelect) {
        respSelect.innerHTML = '<option value="" selected disabled>Seleccione responsable...</option>';
        funcionarios.forEach(f => {
            const option = document.createElement('option');
            option.value = f.fnc_id;
            option.innerText = `${f.fnc_nombre} ${f.fnc_apellido}`;
            respSelect.appendChild(option);
        });
    }
}

async function loadSolicitationDetails(id, currentUser) {
    try {
        currentUser = sessionData.user;
        const response = await fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM" })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            const sol = Array.isArray(result.data) ? result.data[0] : result.data;
            if (!sol) {
                Swal.fire("Error", "No se encontraron datos de la solicitud.", "error");
                return;
            }
            let aux = sol.sol_responsable === currentUser.id;
            // 3. Security Check (Only assigned official can respond)
            if (!aux) {
                await Swal.fire({
                    title: 'Acceso Denegado',
                    text: `Esta solicitud pertenece a otro funcionario.`,
                    icon: 'error',
                    confirmButtonText: 'Volver a Bandeja'
                });
                window.location.href = 'index.php';
                return;
            }
            currentSolRegistroId = sol.sol_registro_tramite;

            // Debug Security Check
            if (sol.sol_responsable && currentUser.id && sol.sol_responsable != String(currentUser.id)) {
                console.warn(`Aviso: Usted no es el funcionario responsable (${sol.sol_responsable}) de esta solicitud (CurrentUser: ${currentUser.id}).`);
            }
            if (!sol.sol_responsable) {
                console.warn("Aviso: Esta solicitud no tiene un funcionario responsable asignado.");
            }


            document.getElementById('header_public_id').innerText = `Modificar DESVE: ${sol.sol_ingreso_desve || sol.sol_id_raw || sol.sol_id}`;
            document.getElementById('header_expediente').innerText = sol.sol_nombre_expediente || '';

            // Map Fields
            // Mapping IDs to Form
            document.getElementById('idIngreso').value = sol.sol_id;
            document.getElementById('Codigo_DESVE').value = sol.sol_ingreso_desve || '';
            document.getElementById('Reingreso').value = sol.sol_reingreso_id || '';
            document.getElementById('NombreExpediente').value = sol.sol_nombre_expediente || '';
            document.getElementById('DetalleIngreso').value = sol.sol_detalle || '';
            document.getElementById('Observaciones').value = sol.sol_observaciones || '';

            const fechaRecepcion = (sol.sol_fecha_recepcion || '').split(' ')[0] || '';
            document.getElementById('FechaUltimaRecepcion').value = fechaRecepcion;
            document.getElementById('Sector').value = sol.sol_sector_id || '';
            document.getElementById('Prioridad').value = sol.sol_prioridad_id || '';
            document.getElementById('FechaVecimiento').value = sol.sol_fecha_vencimiento || '';
            document.getElementById('Responsable').value = sol.sol_responsable || '';
            document.getElementById('Reingresado').value = sol.sol_reingreso_id || '';

            // Resolve Organization Type and Origen
            let orgTipoId = null;
            let resolvedOrigenTexto = sol.sol_origen_texto || '';
            const solOrigenId = sol.sol_origen_id;

            switch (parseInt(sol.sol_origen_esp)) {
                case 0:
                    let org = organizacionesComunitarias.find(o => o.orgc_id == solOrigenId) || organizaciones.find(o => o.org_id == solOrigenId);
                    if (org) {
                        orgTipoId = org.orgc_tipo_organizacion || org.org_tipo_id;
                        if (!resolvedOrigenTexto) resolvedOrigenTexto = org.orgc_nombre || org.org_nombre;
                    }
                    break;
                case 1:
                    let contrib = contribuyentes.find(o => o.tgc_id == solOrigenId);
                    if (contrib) {
                        orgTipoId = "3"; // Particular
                        if (!resolvedOrigenTexto) resolvedOrigenTexto = `${contrib.tgc_nombre} ${contrib.tgc_apellido_paterno} ${contrib.tgc_apellido_materno} (${contrib.tgc_rut})`.trim();
                    }
                    break;
                case 2:
                    let orgD = organizacionesDESVE.find(o => o.org_id == solOrigenId);
                    if (orgD) {
                        orgTipoId = orgD.org_tipo_id;
                        if (!resolvedOrigenTexto) resolvedOrigenTexto = orgD.org_nombre;
                    }
                    break;
            }

            if (orgTipoId) document.getElementById('ID_Organizacion').value = orgTipoId;
            document.getElementById('OrigenSolicitud').value = solOrigenId || '';
            document.getElementById('OrigenSolicitudDisplay').value = resolvedOrigenTexto || '';
            OrigenEspecial = parseInt(sol.sol_origen_esp) || 0;

            // Status
            if (sol.sol_estado_entrega == 1) {
                document.getElementById('estadoRespondido').checked = true;
            } else {
                document.getElementById('estadoPendiente').checked = true;
            }

            // Map Population
            if (sol.sol_latitud && sol.sol_longitud) {
                const chkGeo = document.getElementById('chk_geoloc');
                if (!chkGeo.checked) {
                    chkGeo.checked = true;
                    // Trigger the change event to show the area
                    chkGeo.dispatchEvent(new Event('change'));
                }
                document.getElementById('Latitud').value = sol.sol_latitud;
                document.getElementById('Longitud').value = sol.sol_longitud;
                document.getElementById('Geo_dir').value = sol.sol_direccion || '';

                // If map is already initialized, update it. If not, initMap will handle it using these values.
                if (map && marker) {
                    const pos = { lat: parseFloat(sol.sol_latitud), lng: parseFloat(sol.sol_longitud) };
                    marker.setPosition(pos);
                    map.setCenter(pos);
                }
            }

            // Populate ReingresoDisplay if there's a reingreso_id
            if (sol.sol_reingreso_id) {
                const reingresoSol = Solicitudes.find(s => s.sol_id == sol.sol_reingreso_id);
                if (reingresoSol) {
                    document.getElementById('ReingresoDisplay').value = `${reingresoSol.sol_ingreso_desve} - ${reingresoSol.sol_nombre_expediente}`;
                }
            }
            // Metrics using helpers
            document.getElementById('info_dias_ingreso').value = calcularDiasTranscurridos(sol.sol_fecha_recepcion);
            document.getElementById('info_dias_vencimiento').value = calcularDiasHabilesRestantes(sol.sol_fecha_vencimiento);
            document.getElementById('Prioridad').value = sol.sol_prioridad_id;

            const fechaVenc = (sol.sol_fecha_vencimiento || '').split(' ')[0] || '';
            document.getElementById('FechaVecimiento').value = fechaVenc;

            document.getElementById('Responsable').value = sol.sol_responsable;
            document.getElementById('Reingresado').value = sol.sol_reingreso_id;

            if (document.getElementById('idIngresoVisible')) document.getElementById('idIngresoVisible').value = sol.sol_id_raw || sol.sol_id;
            if (document.getElementById('Codigo_RGT')) document.getElementById('Codigo_RGT').value = sol.rgt_id_publica || '';

            currentSolRegistroId = sol.sol_registro_tramite;
            destinos = sol.destinos || [];
            renderDestinos();
            renderResponseBitacora(sol.respuestas || []);

            if (currentSolRegistroId) {
                loadExistingDocuments(currentSolRegistroId);
            } else {
                console.warn("No hay ID de trámite para cargar documentos.");
            }

            // Render additional sections for parity with consultar.js
            auditData = (sol.bitacora || []).sort((a, b) => {
                const dateA = a.bit_creacion || a.bit_fecha || '';
                const dateB = b.bit_creacion || b.bit_fecha || '';
                return new Date(dateB) - new Date(dateA);
            });
            renderAuditPage(1);
            renderComentarios(sol.comentarios || []);
            renderReingresosVinculados(sol.reingresos || []);
        }
    } catch (e) {
        console.error("Load Details Error:", e);
    }
}


function handleTipoOrgChange() {
    const idOrgId = document.getElementById('ID_Organizacion').value;
    if (!idOrgId) return;

    const orgDisplay = document.getElementById('OrigenSolicitudDisplay');
    const orgHidden = document.getElementById('OrigenSolicitud');
    const btnBuscarOrigen = document.getElementById('btn_buscar_origen');
    const btnNuevoOrigen = document.getElementById('btn_nuevo_origen');

    // Show/Hide buttons and set handlers
    if (idOrgId == "1" || idOrgId == "2") {
        // Territorial (1) or Funcional (2) -> Search Organizations
        OrigenEspecial = 0;
        btnBuscarOrigen.classList.remove('hidden');
        btnNuevoOrigen.classList.remove('hidden');
        btnBuscarOrigen.disabled = false;
        btnNuevoOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarOrganizacion();
        btnNuevoOrigen.onclick = () => abrirModalNuevaOrganizacion();

    } else if (idOrgId == "3" || idOrgId == "5") {
        // Particular (3) or Ley Transparencia (5) -> Use Contributor Search
        OrigenEspecial = 1;
        btnBuscarOrigen.classList.remove('hidden');
        btnNuevoOrigen.classList.add('hidden');
        btnBuscarOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarContribuyente();

    } else if (["4", "6", "7"].includes(idOrgId)) {
        // Special Origins (Concejales, Contraloría, Congreso)
        OrigenEspecial = 2;
        btnBuscarOrigen.classList.remove('hidden');
        btnNuevoOrigen.classList.add('hidden');
        btnBuscarOrigen.disabled = false;

        btnBuscarOrigen.onclick = () => abrirModalBuscarOrganizacion();

    } else {
        // Default
        OrigenEspecial = 0;
        btnBuscarOrigen.classList.add('hidden');
        btnNuevoOrigen.classList.add('hidden');
    }

    // Determine priority
    const selectedTipo = tiposOrganizacion.find(t => t.tor_id == idOrgId);
    if (selectedTipo) {
        const prio = prioridades.find(p => p.pri_id == selectedTipo.tor_prioridad_id);
        if (prio) {
            document.getElementById('Prioridad').value = prio.pri_id;
            if (prio.pri_tiempo_establecido) calculateVencimiento(parseInt(prio.pri_tiempo_establecido));
        }
    }
}


function calculateVencimiento(days) {
    const fechaIngresoValue = document.getElementById('FechaUltimaRecepcion').value;
    if (!fechaIngresoValue) return;

    let date = new Date(fechaIngresoValue);
    let count = 0;
    while (count < days) {
        date.setDate(date.getDate() + 1);
        if (date.getDay() !== 0 && date.getDay() !== 6) count++;
    }
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    document.getElementById('FechaVecimiento').value = `${year}-${month}-${day} 00:00:00`;
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedFiles.push({ nombre: file.name, base64: e.target.result });
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
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-1 border rounded';
        item.innerHTML = `
            <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus text-success me-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="14 2 14 9 20 9"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
            <span class="small">${file.nombre}</span></div>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFile(${index})"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
        `;
        listContainer.appendChild(item);
    });
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    renderFileList();
}

async function loadExistingDocuments(tramiteId = null) {
    const idToUse = tramiteId || currentSolRegistroId;
    if (!idToUse) return;

    try {
        const container = document.getElementById('lista_documentos_guardados');
        container.innerHTML = `
            <div class="flex flex-col items-center justify-center py-8 text-slate-400">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-blue mb-2"></div>
                <span class="text-xs font-medium uppercase tracking-widest">Buscando...</span>
            </div>
        `;
        const response = await fetch(`${window.API_BASE_URL}/gesdoc/general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: idToUse }),
            credentials: 'include'
        });
        const result = await response.json();
        container.innerHTML = '<div class="text-center py-2"><span class="small text-muted">Buscando documentos...</span></div>';
        if (result.status === 'success' && result.documentos && result.documentos.length > 0) {
            container.innerHTML = '';
            const grid = document.createElement('div');
            grid.className = 'grid grid-cols-1 gap-2';

            result.documentos.forEach(doc => {
                const item = document.createElement('div');
                item.className = 'group flex items-center justify-between p-3 bg-white border border-cyan-100 rounded-xl hover:border-primary-blue hover:shadow-md transition-all duration-200';
                item.innerHTML = `
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="p-2 bg-blue-50 text-primary-blue rounded-lg">
                            <span class="material-symbols-outlined text-[20px]">description</span>
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-[13px] font-bold text-slate-700 text-truncate" title="${doc.doc_nombre_documento}">${doc.doc_nombre_documento}</span>
                            <span class="text-[10px] text-slate-400 uppercase font-medium leading-none">${doc.doc_privado == 1 ? 'Privado' : 'Público'}</span>
                        </div>
                    </div>
                    <button type="button" onclick="descargarDocumento('${doc.doc_id}', '${doc.doc_nombre_documento}')" 
                            class="p-2 text-slate-400 hover:text-primary-blue hover:bg-blue-50 rounded-lg transition-colors"
                            title="Descargar">
                        <span class="material-symbols-outlined text-[20px]">download</span>
                    </button>
                `;
                grid.appendChild(item);
            });
            container.appendChild(grid);
        } else {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-10 text-slate-300 border-2 border-dashed border-cyan-50 rounded-2xl">
                    <span class="material-symbols-outlined text-[40px] mb-2">folder_off</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest">Sin documentos adjuntos</span>
                </div>
            `;
        }

    } catch (e) {
        console.error(e);
    }
}


window.descargarDocumento = async function (id, nombre) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/gesdoc/general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'Bajar', doc_id: id }),
            credentials: 'include'
        });
        if (!response.ok) throw new Error('Error en descarga');
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = nombre;
        a.click();
        window.URL.revokeObjectURL(url);
    } catch (e) {
        Swal.fire('Error', 'No se pudo descargar el archivo.', 'error');
    }
}


function renderResponseBitacora(respuestas) {
    const tbody = document.getElementById('tbody_respuestas');
    if (!tbody) return;
    tbody.innerHTML = '';

    if (!respuestas || respuestas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-8 text-center text-slate-400 italic font-medium bg-slate-50/30">No hay respuestas registradas</td></tr>';
        return;
    }

    respuestas.forEach(r => {
        const resFuncId = r.res_funcionario || r.res_funcionaio;
        const func = resFuncId ? funcionarios.find(f => f.fnc_id == resFuncId || f.usr_id == resFuncId) : null;
        const name = func ? `${func.fnc_nombre} ${func.fnc_apellido}` : (resFuncId || 'N/A');
        const fecha = (r.res_creacion || r.res_fecha || '').substring(0, 10) || '-';
        const row = `
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 font-mono text-[11px] text-slate-400">#${r.res_id}</td>
                <td class="px-6 py-4 font-medium text-slate-700">${name}</td>
                <td class="px-6 py-4 text-slate-500">${fecha}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider ${r.res_tipo === 'Respuesta Final' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-blue-50 text-blue-600 border border-blue-100'}">
                        ${r.res_tipo}
                    </span>
                </td>
                <td class="px-6 py-4 text-slate-600 italic leading-relaxed text-[12px]">${r.res_texto}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

async function actualizarSolicitud() {
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
        sol_id: document.getElementById('idIngreso').value,
        sol_ingreso_desve: document.getElementById('Codigo_DESVE').value,
        sol_reingreso_id: document.getElementById('Reingreso').value,
        sol_nombre_expediente: document.getElementById('NombreExpediente').value,
        sol_origen_id: origenValue,
        sol_origen_texto: origenTexto,
        sol_detalle: document.getElementById('DetalleIngreso').value,
        sol_fecha_recepcion: document.getElementById('FechaUltimaRecepcion').value + ' 00:00:00',
        sol_prioridad_id: document.getElementById('Prioridad').value,
        sol_sector_id: document.getElementById('Sector').value,
        sol_fecha_vencimiento: document.getElementById('FechaVecimiento').value,
        sol_estado_entrega: document.getElementById('estadoRespondido').checked,
        sol_observaciones: document.getElementById('Observaciones').value,
        sol_responsable: document.getElementById('Responsable').value || null,
        sol_latitud: document.getElementById('chk_geoloc').checked ? document.getElementById('Latitud').value : null,
        sol_longitud: document.getElementById('chk_geoloc').checked ? document.getElementById('Longitud').value : null,
        sol_direccion: document.getElementById('chk_geoloc').checked ? document.getElementById('Geo_dir').value : null,
        destinos: destinos,
        sol_origen_esp: OrigenEspecial,
        documentos: selectedFiles,
        ACCION: "ACTUALIZAR"
    };

    try {
        Swal.fire({ title: 'Actualizando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const response = await fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body),
            credentials: 'include'
        });
        const result = await response.json();
        if (result.status === 'success') {
            await Swal.fire('Éxito', "Actualizado con éxito", 'success');
            window.location.href = `consultar.php?id=${body.sol_id}`;
        } else {
            Swal.fire('Error', result.message || "Error al actualizar", 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', "Error de conexión.", 'error');
    }
}

window.guardarOrigenEspecial = async function () {
    const texto = document.getElementById('textoNuevoOrigenEspecial').value.trim();
    const idTipo = document.getElementById('ID_Organizacion').value;
    if (!texto) return;
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
    } catch (e) { console.error(e); }
};

async function solicitarID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="sol_id">ID Interno (DESVE)</option>
                    <option value="rgt_id_publica" selected>Cód. Público (Ej: 260123-1349-D4)</option>
                    <option value="rgt_id">ID Trámite (RGT)</option>
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
        cancelButtonText: 'Volver a Bandeja',
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
        window.location.href = 'index.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        const payload = { ACCION: 'CONSULTAM' };
        if (type === 'sol_id') payload.sol_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];

            if (results.length > 0 && results[0].sol_id) {
                const foundId = results[0].sol_id;
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('id', foundId);
                window.location.href = newUrl.toString();
            } else {
                Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                    solicitarID();
                });
            }
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                solicitarID();
            });
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}

function renderDestinos() {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    if (!destinos || destinos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted small">Sin destinatarios.</td></tr>';
        return;
    }

    destinos.forEach(d => {
        const name = d.usr_nombre_completo || 'Desconocido';
        const area = d.usr_area_nombre || d.fnc_area_nombre || '-';

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="px-6 py-4">${name}</td>
            <td class="px-6 py-4 text-slate-500">${area}</td>
            <td class="px-6 py-4 text-slate-400 font-mono text-xs">${d.usr_email || d.fnc_email || '-'}</td>
            <td class="px-6 py-4 text-right">
                <button type="button" class="text-red-400 hover:text-red-600 transition-colors" onclick="removeDestino(${d.tid_destino || d.fnc_id})">
                   <span class="material-symbols-outlined text-[18px]">delete</span>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) feather.replace();
}
async function removeDestino(id) {
    aux = [];
    destinos.forEach(d => {
        if (d.tid_destino != id) {
            aux.push(d);
        }
    });
    destinos = aux;
    renderDestinos();
}
// Modal & Officials logic
function abrirModalBuscarFuncionario() {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

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
            tid_destino: f.fnc_id,
            tid_solicitud: f.fnc_id,
            tid_fecha_respuesta: null,
            tid_id: f.fnc_id,
            tid_responde: null,
            usr_id: f.fnc_id,
            usr_apellido: f.fnc_apellido,
            usr_email: f.fnc_email,
            usr_nombre: f.fnc_nombre,
            usr_nombre_completo: nombreCompleto
        });

        renderDestinos();
    }
    modalBusqueda.hide();
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
        OrigenEspecial = 1;
    }
    const modalElem = document.getElementById('modalBuscarContribuyente');
    if (modalElem) {
        const instance = bootstrap.Modal.getInstance(modalElem);
        if (instance) instance.hide();
    }
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



// --- Geolocation Functions ---



// --- Organization Search and Creation Functions ---
window.abrirModalBuscarOrganizacion = function () {
    const tbody = document.getElementById('lista_busqueda_org');
    tbody.innerHTML = '';
    const idOrgId = document.getElementById('ID_Organizacion').value;

    const matchingComunitarias = organizacionesComunitarias.filter(o => o.orgc_tipo_organizacion == idOrgId);
    const matchingDESVE = organizacionesDESVE.filter(o => o.org_tipo_id == idOrgId);
    const matchingGeneral = organizaciones.filter(o => o.org_tipo_id == idOrgId);

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
            const orgRes = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }).then(r => r.json());

            organizacionesComunitarias = extractData(orgRes);

            bootstrap.Modal.getInstance(document.getElementById('modalNuevaOrganizacion')).hide();
            Swal.fire('Éxito', 'Organización creada correctamente.', 'success');

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



// Additional rendering functions for parity with consultar.js

function renderAuditPage(page) {
    const tbody = document.getElementById('tbody_audit');
    const pagination = document.getElementById('pagination_audit');
    if (!tbody || !pagination) return;

    currentAuditPage = page;
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageData = auditData.slice(start, end);

    tbody.innerHTML = '';
    if (pageData.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="px-6 py-4 text-center text-slate-400">No hay registros de auditoría</td></tr>';
        pagination.innerHTML = '';
        return;
    }

    pageData.forEach(item => {
        const row = `
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 text-slate-500 whitespace-nowrap">${item.bit_fecha || item.bit_creacion || '-'}</td>
                <td class="px-6 py-4 font-medium text-slate-700">${item.bit_usuario || item.usr_nombre || 'Sistema'}</td>
                <td class="px-6 py-4 text-slate-600">${item.bit_evento || item.bit_accion || '-'}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });

    renderAuditPagination();
}

function renderAuditPagination() {
    const pagination = document.getElementById('pagination_audit');
    const totalPages = Math.ceil(auditData.length / itemsPerPage);
    pagination.innerHTML = '';

    if (totalPages <= 1) return;

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.innerText = i;
        btn.className = `w-8 h-8 rounded-lg text-xs font-bold transition-all ${i === currentAuditPage ? 'bg-primary-blue text-white shadow-md' : 'bg-white text-slate-400 hover:bg-slate-100 border border-slate-200'}`;
        btn.onclick = () => renderAuditPage(i);
        pagination.appendChild(btn);
    }
}

function toggleAuditoria() {
    const collapse = document.getElementById('collapse_audit');
    const btn = document.getElementById('btn_toggle_audit');
    if (!collapse || !btn) return;

    if (collapse.classList.contains('hidden')) {
        collapse.classList.remove('hidden');
        btn.style.transform = 'rotate(180deg)';
    } else {
        collapse.classList.add('hidden');
        btn.style.transform = 'rotate(0deg)';
    }
}

function renderComentarios(comentarios) {
    const container = document.getElementById('lista_comentarios');
    if (!container) return;

    container.innerHTML = '';
    if (!comentarios || comentarios.length === 0) {
        container.innerHTML = '<div class="text-center py-8 text-slate-400 italic">No hay comentarios</div>';
        return;
    }

    comentarios.forEach(c => {
        const item = `
            <div class="bg-white p-4 rounded-xl border border-cyan-100 shadow-sm space-y-2">
                <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-widest text-primary-blue">
                    <span>${c.usr_nombre + " " + c.usr_apellido || 'Usuario'}</span>
                    <span class="text-slate-400">${c.gco_creacion.substring(0, 10) || ''}</span>
                </div>
                <p class="text-slate-600 leading-relaxed">${c.gco_comentario}</p>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', item);
    });
}

function renderReingresosVinculados(reingresos) {
    const tbody = document.getElementById('tbody_reingresos_vinculados');
    if (!tbody) return;

    tbody.innerHTML = '';
    if (!reingresos || reingresos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" class="px-4 py-6 text-center text-slate-400 italic">Sin reingresos</td></tr>';
        return;
    }

    reingresos.forEach(r => {
        const row = `
            <tr>
                <td class="px-4 py-3 font-mono text-primary-blue font-bold tracking-wider">#${r.rei_codigo_reingreso || r.rei_id}</td>
                <td class="px-4 py-3 text-end">
                    <button type="button" onclick="location.href='consultar.php?id=${r.rei_id}'" class="p-1.5 hover:bg-cyan-50 rounded-lg text-primary-blue transition-colors">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                    </button>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function abrirModalNuevoComentario() {
    const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
    modal.show();
}

async function guardarComentario() {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) return;

    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    try {
        Swal.fire({ title: 'Guardando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const response = await fetch(`${window.API_BASE_URL}/desve/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: "CREAR",
                com_solicitud_id: solicitationId,
                com_texto: texto
            })
        });
        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario')).hide();
            Swal.fire('Éxito', "Comentario guardado", 'success');
            // Refresh details to show new comment
            loadSolicitationDetails(solicitationId, currentUser);
        } else {
            Swal.fire('Error', result.message || "Error al guardar", 'error');
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', "Error de conexión", 'error');
    }
}
