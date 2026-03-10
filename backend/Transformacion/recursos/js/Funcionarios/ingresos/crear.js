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

// Modals
let modalBusqueda = null;
let modalConfig = null;

async function cargarListas() {
    try {
        // Cargar Tipos de Ingreso desde DB
        const respTipos = await fetch(`${window.API_BASE_URL}/ingresos/tipos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultTipos = await respTipos.json();

        const selectTipo = document.getElementById('tis_tipo');
        selectTipo.innerHTML = '<option value="" selected disabled>Seleccione un tipo...</option>';

        if (resultTipos.status === 'success') {
            resultTipos.data.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t.titi_id; // O titi_id si prefieres usar ID
                opt.textContent = t.titi_nombre;
                selectTipo.appendChild(opt);
            });
        }

        // Cargar Funcionarios para búsqueda
        const respFunc = await fetch(`${window.API_BASE_URL}/general/funcionarios.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultFunc = await respFunc.json();
        if (resultFunc.status === 'success') {
            funcionarios = resultFunc.data;
        }

        // Cargar Áreas
        const respAreas = await fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/areas_general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultAreas = await respAreas.json();
        if (resultAreas.status === 'success') {
            areas = resultAreas.data;
            const selectArea = document.getElementById('filtro_area_fnc');
            if (selectArea) {
                areas.forEach(a => {
                    const opt = document.createElement('option');
                    opt.value = a.tga_id;
                    opt.textContent = a.tga_nombre;
                    selectArea.appendChild(opt);
                });
            }
        }

    } catch (error) {
        console.error('Error al cargar listas:', error);
    }
}

function setupEventListeners() {
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalBusquedaFuncionario'));
    modalConfig = new bootstrap.Modal(document.getElementById('modalConfigurarDestino'));

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
            tis_estado: 'Ingresado',
            tis_fecha: new Date().toISOString().split('T')[0],
            destinos: destinos,
            enlaces: enlaces,
            documentos: documentos
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

