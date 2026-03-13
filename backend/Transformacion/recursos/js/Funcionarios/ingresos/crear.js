document.addEventListener('DOMContentLoaded', () => {
    cargarListas();
    setupEventListeners();
});

// Esta función corre solo cuando TODO (imágenes, scripts, CSS) terminó de cargar
window.addEventListener('load', () => {// Espera 100ms adicionales después de que todo cargó
    setTimeout(() => {
        // Auth handled by PHP
    }, 1);
});

let funcionarios = [];
let areas = [];
let destinos = [];
let enlaces = [];
let documentos = [];
let tiposOrganizacion = [];
let organizacionesDESVE = [];

// Modals
let modalBusqueda = null;
let modalConfig = null;
let modalBuscarOrg = null;
let modalBuscarContrib = null;
let modalNuevaOrg = null;
let modalNuevoContrib = null;

// Listas de Solicitantes
let organizacionesComunitarias = [];
let contribuyentes = [];
let organizacionesGenerales = [];

// Variables de Mapa (DESVE)
let map, marker, geocoder;
const defaultLocation = { lat: -33.0248, lng: -71.5570 }; // Viña del Mar

async function cargarListas() {
    try {
        Swal.fire({ title: 'Cargando datos...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };

        // Cargar múltiples listas en paralelo (Replicando lógica DESVE)
        const [respTipos, respFunc, respAreas, respOrgCom, respContrib, respOrgGen, respTipoOrg, respOrgDESVE] = await Promise.all([
            fetch(`${window.API_BASE_URL}/ingresos/tipos_ingresos.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/areas_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json())
        ]);

        // 1. Tipos de Ingreso
        const selectTipo = document.getElementById('tis_tipo');
        selectTipo.innerHTML = '<option value="" selected disabled>Seleccione un tipo...</option>';
        if (respTipos.status === 'success') {
            respTipos.data.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t.titi_id;
                opt.textContent = t.titi_nombre;
                selectTipo.appendChild(opt);
            });
        }

        // 2. Funcionarios
        if (respFunc.status === 'success') {
            funcionarios = respFunc.data;
        }

        // 3. Áreas
        if (respAreas.status === 'success') {
            areas = respAreas.data;
            const selectArea = document.getElementById('filtro_area_fnc');
            if (selectArea) {
                selectArea.innerHTML = '<option value="">Todas las Áreas</option><option value="SIN_AREA">Sin Área Asignada</option>';
                areas.forEach(a => {
                    const opt = document.createElement('option');
                    opt.value = a.tga_id;
                    opt.textContent = a.tga_nombre;
                    selectArea.appendChild(opt);
                });
            }
        }

        // 4. Organizaciones Comunitarias
        organizacionesComunitarias = extractData(respOrgCom);

        // 5. Contribuyentes (Personas Naturales)
        contribuyentes = extractData(respContrib);

        // 6. Organizaciones Generales (Personas Jurídicas)
        organizacionesGenerales = extractData(respOrgGen);

        // 7. Tipos de Organización (Para dropdown Tipo Solicitante)
        tiposOrganizacion = extractData(respTipoOrg);
        const selectTipoSol = document.getElementById('tis_tipo_solicitante');
        selectTipoSol.innerHTML = '<option value="" selected disabled>Seleccione tipo...</option>';
        tiposOrganizacion.forEach(t => {
            const opt = document.createElement('option');
            opt.value = t.tor_id;
            opt.textContent = t.tor_nombre;
            selectTipoSol.appendChild(opt);
        });

        // 8. Organizaciones DESVE (Especiales)
        organizacionesDESVE = extractData(respOrgDESVE);

        Swal.close();
    } catch (error) {
        console.error('Error al cargar listas:', error);
        Swal.fire('Error', 'No se pudieron cargar algunas listas de datos.', 'error');
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

function setupEventListeners() {
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalBusquedaFuncionario'));
    modalConfig = new bootstrap.Modal(document.getElementById('modalConfigurarDestino'));
    modalBuscarOrg = new bootstrap.Modal(document.getElementById('modalBuscarOrganizacion'));
    modalBuscarContrib = new bootstrap.Modal(document.getElementById('modalBuscarContribuyente'));
    modalNuevaOrg = new bootstrap.Modal(document.getElementById('modalNuevaOrganizacion'));
    modalNuevoContrib = new bootstrap.Modal(document.getElementById('modalNuevoContribuyente'));

    // Botón de búsqueda de solicitante
    document.getElementById('btn_buscar_solicitante').onclick = () => {
        const idTipo = document.getElementById('tis_tipo_solicitante').value;
        if (!idTipo) {
            Swal.fire('Atención', 'Seleccione primero el tipo de solicitante.', 'warning');
            return;
        }

        handleTipoSolicitanteAction(idTipo);
    };

    document.getElementById('tis_tipo_solicitante').addEventListener('change', (e) => {
        handleTipoSolicitanteChange(e.target.value);
    });

    // Filtros de búsqueda en tiempo real
    document.getElementById('filtroOrganizacion').onkeyup = function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#lista_busqueda_org tr');
        rows.forEach(tr => tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none');
    };

    document.getElementById('filtroContribuyente').onkeyup = function() {
        const val = this.value.toLowerCase();
        const rows = document.querySelectorAll('#lista_busqueda_contrib tr');
        rows.forEach(tr => tr.style.display = tr.innerText.toLowerCase().includes(val) ? '' : 'none');
    };

    // Formateo de RUT al perder foco
    document.getElementById('orgc_rut').onblur = function() { this.value = formatRut(this.value); };
    document.getElementById('nc_rut').onblur = function() { this.value = formatRut(this.value); };

    // Lógica del Mapa (DESVE)
    document.getElementById('chk_geoloc').addEventListener('change', function () {
        const area = document.getElementById('geolocalizacion_area');
        area.classList.toggle('hidden', !this.checked);
        if (this.checked && typeof google !== 'undefined') { 
            setTimeout(() => { if (map) google.maps.event.trigger(map, 'resize'); }, 100); 
        }
    });

    document.getElementById('btn_buscar_geo').onclick = buscarDireccion;
    document.getElementById('Geo_dir').onkeypress = (e) => { if (e.key === 'Enter') buscarDireccion(); };

    // Búsqueda de funcionarios
    document.getElementById('buscar_fnc_input').addEventListener('input', () => {
        filtrarBusquedaFuncionarios();
    });

    document.getElementById('filtro_area_fnc').addEventListener('change', () => {
        filtrarBusquedaFuncionarios();
    });

    // Control de requerido y labores según facultad (rol)
    document.getElementById('m_destino_facultad').addEventListener('change', (e) => {
        const checkReq = document.getElementById('m_destino_requerido');
        const tareaSelect = document.getElementById('m_destino_tarea');
        const tareaContainer = document.getElementById('container_m_destino_tarea');
        const facultad = e.target.value;

        // Limpiar opciones actuales de labor
        tareaSelect.innerHTML = '';
        tareaContainer.classList.remove('hidden');

        if (facultad === 'Responsable' || facultad === 'Firmante') {
            const options = [
                { val: 'ejecutar lo requerido', text: 'Ejecutar lo requerido' },
                { val: 'generar informe', text: 'Generar informe técnico' },
                { val: 'tomar conocimiento', text: 'Tomar conocimiento' },
                { val: 'responder al remitente', text: 'Responder al remitente' }
            ];
            options.forEach(opt => {
                const el = document.createElement('option');
                el.value = opt.val;
                el.textContent = opt.text;
                tareaSelect.appendChild(el);
            });
            checkReq.disabled = false;
        } else if (facultad === 'Visador') {
            const el = document.createElement('option');
            el.value = 'ejecutar lo requerido';
            el.textContent = 'Ejecutar lo requerido';
            tareaSelect.appendChild(el);
            tareaSelect.value = 'ejecutar lo requerido';

            tareaContainer.classList.add('hidden');
            checkReq.checked = true;
            checkReq.disabled = false;
        } else if (facultad === 'Lector') {
            const el = document.createElement('option');
            el.value = 'tomar conocimiento';
            el.textContent = 'Tomar conocimiento';
            tareaSelect.appendChild(el);
            tareaSelect.value = 'tomar conocimiento';

            checkReq.checked = false;
            checkReq.disabled = true;
        }
    });

    // Confirmar destino
    document.getElementById('btn_confirmar_destino').onclick = () => {
        const id = document.getElementById('fnc_id_config').value;
        const nombre = document.getElementById('fnc_nombre_config').textContent;
        const tipo = document.getElementById('m_destino_tipo').value;
        const facultad = document.getElementById('m_destino_facultad').value || '-';
        const tarea = document.getElementById('m_destino_tarea').value || 'tomar conocimiento';
        const requerido = document.getElementById('m_destino_requerido').checked;

        destinos.push({
            usr_id: id,
            usr_nombre_completo: nombre,
            tid_tipo: tipo,
            tid_facultad: facultad,
            tid_tarea: tarea,
            tid_requeido: requerido ? '1' : '0'
        });

        renderizarDestinos();
        modalConfig.hide();
    };

    // Enlaces
    document.getElementById('btn_agregar_enlace').onclick = () => {
        const input = document.getElementById('input_enlace');
        const url = input.value.trim();
        if (url) {
            enlaces.push(url);
            input.value = '';
            renderizarEnlaces();
        }
    };

    // Documentos
    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('input_archivo');
    dropZone.onclick = () => fileInput.click();
    fileInput.onchange = (e) => handleFiles(e.target.files);
    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('active'); };
    dropZone.ondragleave = () => dropZone.classList.remove('active');
    dropZone.ondrop = (e) => { e.preventDefault(); dropZone.classList.remove('active'); handleFiles(e.dataTransfer.files); };

    // Submit
    document.getElementById('form_crear_ingreso').onsubmit = (e) => {
        e.preventDefault();
        guardarIngreso();
    };

}

function abrirModalBuscarFuncionario() {
    document.getElementById('buscar_fnc_input').value = '';
    document.getElementById('filtro_area_fnc').value = '';
    renderizarBusquedaFuncionarios(funcionarios);
    modalBusqueda.show();
}

function filtrarBusquedaFuncionarios() {
    const term = document.getElementById('buscar_fnc_input').value.toLowerCase();
    const areaId = document.getElementById('filtro_area_fnc').value;

    const filtrados = funcionarios.filter(f => {
        const matchesTerm = f.fnc_nombre.toLowerCase().includes(term) ||
            f.fnc_apellido.toLowerCase().includes(term) ||
            (f.fnc_email && f.fnc_email.toLowerCase().includes(term));

        let matchesArea = true;
        if (areaId === 'SIN_AREA') {
            matchesArea = !f.fnc_area_id;
        } else if (areaId) {
            matchesArea = f.fnc_area_id == areaId;
        }

        return matchesTerm && matchesArea;
    });

    renderizarBusquedaFuncionarios(filtrados);
}

function renderizarBusquedaFuncionarios(lista) {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    lista.forEach(f => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>
                <div>${f.fnc_nombre}</div>
                <div class="x-small text-muted">${f.fnc_area_nombre || '<span class="italic">Sin Área</span>'}</div>
            </td>
            <td>${f.fnc_apellido}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-primary" onclick="seleccionarFuncionario(${f.fnc_id}, '${f.fnc_nombre} ${f.fnc_apellido}')">
                    <i data-feather="plus"></i> Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

function seleccionarFuncionario(id, nombre) {
    document.getElementById('fnc_id_config').value = id;
    document.getElementById('fnc_nombre_config').textContent = nombre;
    // Reset fields
    document.getElementById('m_destino_tipo').value = 'Para';
    document.getElementById('m_destino_facultad').value = 'Responsable';
    document.getElementById('m_destino_tarea').value = 'ejecutar lo requerido';
    const checkReq = document.getElementById('m_destino_requerido');
    checkReq.checked = true;
    checkReq.disabled = false;

    modalBusqueda.hide();

    // Disparar evento para inicializar opciones según el rol por defecto (Responsable)
    document.getElementById('m_destino_facultad').dispatchEvent(new Event('change'));

    modalConfig.show();
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => {
            documentos.push({
                nombre: file.name,
                base64: e.target.result
            });
            renderizarDocumentos();
        };
        reader.readAsDataURL(file);
    });
}

function renderizarDestinos() {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    if (destinos.length === 0) {
        tbody.innerHTML = '<tr id="placeholder_destinos"><td colspan="5" class="text-center text-muted py-3 small">No hay destinatarios agregados.</td></tr>';
    }

    destinos.forEach((d, index) => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50 transition-colors';
        tr.innerHTML = `
            <td class="px-2 py-4">
                <div class="font-bold text-slate-700 text-sm">${d.usr_nombre_completo}</div>
                <div class="text-[10px] text-slate-400 italic">${d.tid_tarea}</div>
            </td>
            <td class="px-2 py-4 text-center">
                <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider border bg-blue-50 text-primary-blue border-blue-100">
                    ${d.tid_facultad}
                </span>
            </td>
            <td class="px-2 py-4 text-right">
                <button type="button" class="text-rose-500 hover:text-rose-700 transition-colors" onclick="eliminarDestino(${index})">
                    <span class="material-symbols-outlined text-lg">delete</span>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

function renderizarEnlaces() {
    const list = document.getElementById('lista_enlaces');
    list.innerHTML = '';
    enlaces.forEach((url, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center py-2';
        item.innerHTML = `
            <div class="text-truncate" style="max-width: 80%">${url}</div>
            <i data-feather="x-circle" class="btn-remove" onclick="eliminarEnlace(${index})" style="width:14px"></i>
        `;
        list.appendChild(item);
    });
    if (window.feather) window.feather.replace();
}

function renderizarDocumentos() {
    const list = document.getElementById('lista_documentos');
    list.innerHTML = '';
    documentos.forEach((doc, index) => {
        const item = document.createElement('div');
        item.className = 'list-group-item d-flex justify-content-between align-items-center py-2';
        item.innerHTML = `
            <div class="text-truncate" style="max-width: 80%"><i data-feather="file" style="width:14px" class="me-1"></i> ${doc.nombre}</div>
            <i data-feather="x-circle" class="btn-remove" onclick="eliminarDocumento(${index})" style="width:14px"></i>
        `;
        list.appendChild(item);
    });
    if (window.feather) window.feather.replace();
}

function eliminarDestino(index) { destinos.splice(index, 1); renderizarDestinos(); }
function eliminarEnlace(index) { enlaces.splice(index, 1); renderizarEnlaces(); }
function eliminarDocumento(index) { documentos.splice(index, 1); renderizarDocumentos(); }

async function guardarIngreso() {
    try {
        const payload = {
            ACCION: 'CREAR',
            tis_titulo: document.getElementById('tis_titulo').value,
            tis_tipo: document.getElementById('tis_tipo').value,
            tis_contenido: document.getElementById('tis_contenido').value,
            tis_id_solicitante: document.getElementById('tis_id_solicitante').value,
            tis_nombre_solicitante: document.getElementById('tis_nombre_solicitante').value,
            tis_tipo_solicitante: document.getElementById('tis_tipo_solicitante').value,
            tis_estado: 'Ingresado',
            tis_fecha: new Date().toISOString().split('T')[0],
            destinos: destinos,
            enlaces: enlaces,
            documentos: documentos,
            // Datos de Geolocalización
            Latitud: document.getElementById('Latitud').value,
            Longitud: document.getElementById('Longitud').value,
            Geo_dir: document.getElementById('Geo_dir').value,
            tis_geolocalizacion: document.getElementById('chk_geoloc').checked ? 1 : 0
        };

        if (destinos.length === 0) {
            Swal.fire('Atención', 'Debe agregar al menos un destinatario', 'warning');
            return;
        }

        Swal.fire({
            title: 'Guardando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const response = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (result.status === 'success') {

            const urlParams = new URLSearchParams(window.location.search);
            const idPadre = urlParams.get('rgt_id_padre');
            if (idPadre) {
                // Ya tenemos el rgt_id directo desde el retorno de CREAR
                const childRgtId = result.rgt_id;

                const respLink = await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        ACCION: 'VINCULAR_HIJO',
                        padre_id: idPadre,
                        hijo_id: childRgtId
                    })
                });
                const resLink = await respLink.json();

                if (resLink.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'El ingreso ha sido creado correctamente.',
                        confirmButtonText: 'Ir a la Bandeja'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                } else {
                    Swal.fire('Atención', 'Se creó pero falló el vínculo.', 'warning');
                    window.location.href = 'index.php';
                }
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El ingreso ha sido creado correctamente.',
                    confirmButtonText: 'Ir a la Bandeja'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            }
        } else {
            Swal.fire('Error', result.message || 'No se pudo crear el ingreso', 'error');
        }

    } catch (error) {
        console.error('Error al guardar:', error);
        Swal.fire('Error', 'Ocurrió un error al conectar con el servidor', 'error');
    }
}

// --- FUNCIONES DE LÓGICA DE SOLICITANTES (REPLICADAS DE DESVE) ---

function handleTipoSolicitanteChange(idTipo) {
    const orgDisplay = document.getElementById('tis_nombre_solicitante');
    const orgHidden = document.getElementById('tis_id_solicitante');
    const btnBuscar = document.getElementById('btn_buscar_solicitante');

    // Reset current selection
    orgDisplay.value = '';
    orgHidden.value = '';
    btnBuscar.style.display = 'flex';

    // Lógica especial para tipos 6 y 7 (Auto-completado)
    if (["6", "7"].includes(idTipo)) {
        const matchingDESVE = organizacionesDESVE.filter(o => o.org_tipo_id == idTipo);
        if (matchingDESVE.length > 0) {
            orgDisplay.value = matchingDESVE[0].org_nombre;
            orgHidden.value = matchingDESVE[0].org_id;
            btnBuscar.style.display = 'none';
        }
    }
}

function handleTipoSolicitanteAction(idTipo) {
    if (idTipo == "1" || idTipo == "2") {
        // Territorial (1) o Funcional (2) -> Buscar Organizaciones Comunitarias
        abrirModalBuscarOrganizacion(idTipo);
    } else if (idTipo == "3" || idTipo == "5") {
        // Particular (3) o Ley Transparencia (5) -> Buscar Contribuyentes (Personas)
        abrirModalBuscarContribuyente();
    } else if (idTipo == "4") {
        // Concejales (4) -> Buscar en Organizaciones Generales o DESVE con filtro 4
        abrirModalBuscarOrganizacion(idTipo);
    } else {
        // Otros casos o por defecto
        abrirModalBuscarOrganizacion(idTipo);
    }
}

function abrirModalBuscarOrganizacion(idTipo = null) {
    const tbody = document.getElementById('lista_busqueda_org');
    tbody.innerHTML = '';

    // Filtrar según el tipo si se proporciona
    let listado = [];
    if (idTipo == "1" || idTipo == "2") {
        listado = organizacionesComunitarias.filter(o => o.orgc_tipo_organizacion == idTipo).map(o => ({ 
            id: `OC_${o.orgc_id}`, 
            nombre: o.orgc_nombre, 
            rut: o.orgc_rut 
        }));
    } else if (idTipo == "4") {
        listado = organizacionesDESVE.filter(o => o.org_tipo_id == idTipo).map(o => ({ 
            id: o.org_id, 
            nombre: o.org_nombre, 
            rut: '-' 
        }));
    } else {
        // Combinación de todo lo que no sea persona
        listado = [...organizacionesGenerales.map(o => ({ id: o.org_id, nombre: o.org_nombre, rut: '-' })), 
                   ...organizacionesComunitarias.map(o => ({ id: `OC_${o.orgc_id}`, nombre: o.orgc_nombre, rut: o.orgc_rut }))];
    }

    if (listado.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="text-center py-4 text-slate-400 italic">No se encontraron registros para este tipo.</td></tr>';
    }

    listado.forEach(o => {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50 cursor-pointer transition-colors';
        tr.innerHTML = `
            <td class="px-4 py-3">${o.rut || '-'}</td>
            <td class="px-4 py-3 font-medium">${o.nombre}</td>
            <td class="px-4 py-3 text-end">
                <button type="button" class="btn btn-sm btn-primary px-3 rounded-lg" onclick="seleccionarSolicitante('${o.id}', '${o.nombre}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    modalBuscarOrg.show();
}

function abrirModalBuscarContribuyente() {
    const tbody = document.getElementById('lista_busqueda_contrib');
    tbody.innerHTML = '';

    contribuyentes.forEach(c => {
        const nombreCompleto = `${c.tgc_nombre} ${c.tgc_apellido_paterno} ${c.tgc_apellido_materno}`.trim();
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-slate-50 cursor-pointer transition-colors';
        tr.innerHTML = `
            <td class="px-4 py-3">${c.tgc_rut || '-'}</td>
            <td class="px-4 py-3 font-medium">${nombreCompleto}</td>
            <td class="px-4 py-3 text-end">
                <button type="button" class="btn btn-sm btn-primary px-3 rounded-lg" onclick="seleccionarSolicitante('CONTRIB_${c.tgc_id}', '${nombreCompleto}')">Seleccionar</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    modalBuscarContrib.show();
}

window.seleccionarSolicitante = function (id, nombre) {
    document.getElementById('tis_nombre_solicitante').value = nombre;
    document.getElementById('tis_id_solicitante').value = id;
    
    // Cerrar modales abiertos
    if (modalBuscarOrg) modalBuscarOrg.hide();
    if (modalBuscarContrib) modalBuscarContrib.hide();
};

window.abrirModalNuevaOrganizacion = function() { modalBuscarOrg.hide(); modalNuevaOrg.show(); };
window.abrirModalNuevoContribuyente = function() { modalBuscarContrib.hide(); modalNuevoContrib.show(); };

window.guardarNuevaOrganizacion = async function() {
    const rut = document.getElementById('orgc_rut').value;
    const nombre = document.getElementById('orgc_nombre').value;
    if(!rut || !nombre) return Swal.fire('Error', 'RUT y Nombre son obligatorios', 'error');

    try {
        const body = {
            ACCION: 'CREAR',
            orgc_rut: rut,
            orgc_nombre: nombre,
            orgc_codigo: document.getElementById('orgc_codigo').value,
            orgc_rpj: document.getElementById('orgc_rpj').value,
            orgc_tipo_organizacion: '1' // Por defecto Territorial si no se especifica
        };

        const resp = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        const res = await resp.json();

        if(res.status === 'success') {
            await cargarListas(); // Recargar listas
            modalNuevaOrg.hide();
            Swal.fire('Éxito', 'Organización creada correctamente', 'success').then(() => abrirModalBuscarOrganizacion());
        } else {
            Swal.fire('Error', res.message || 'Error al guardar', 'error');
        }
    } catch (e) { console.error(e); }
};

window.guardarNuevoContribuyente = async function() {
    const rut = document.getElementById('nc_rut').value;
    const nombre = document.getElementById('nc_nombre').value;
    const paterno = document.getElementById('nc_paterno').value;
    if(!rut || !nombre || !paterno) return Swal.fire('Error', 'Faltan campos obligatorios', 'error');

    try {
        const body = {
            ACCION: 'CREAR',
            tgc_rut: rut,
            tgc_nombre: nombre,
            tgc_apellido_paterno: paterno,
            tgc_apellido_materno: document.getElementById('nc_materno').value
        };

        const resp = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        const res = await resp.json();

        if(res.status === 'success') {
            await cargarListas(); // Recargar listas
            modalNuevoContrib.hide();
            Swal.fire('Éxito', 'Contribuyente creado correctamente', 'success').then(() => abrirModalBuscarContribuyente());
        } else {
            Swal.fire('Error', res.message || 'Error al guardar', 'error');
        }
    } catch (e) { console.error(e); }
};

// --- FUNCIONES GOOGLE MAPS (REPLICADAS DE DESVE) ---

window.initMap = function () {
    if (!document.getElementById("map_desve")) return;

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

    marker.addListener("dragend", function (event) {
        updateCoordinates(event.latLng);
    });

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
