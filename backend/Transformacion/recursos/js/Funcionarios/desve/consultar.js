document.addEventListener('DOMContentLoaded', async function () {
    const params = new URLSearchParams(window.location.search);
    const solicitationId = params.get('id');

    if (!solicitationId) {
        solicitarID();
        return;
    }

    if (!window.API_BASE_URL) window.API_BASE_URL = 'http://127.0.0.1/Transformacion/api';

    await loadInitialData();
    loadSolicitationDetails(solicitationId);

    // Event Listeners
    document.getElementById('btn_ir_modificar').onclick = () => window.location.href = `modificar.php?id=${solicitationId}`;
    document.getElementById('btn_ir_responder').onclick = () => window.location.href = `responder.php?id=${solicitationId}`;

    document.getElementById('btn_abrir_comentario').onclick = () => {
        const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
        modal.show();
    };

    if (window.feather) feather.replace();
});

let organizaciones = [];
let organizacionesDESVE = [];
let tiposOrganizacion = [];
let prioridades = [];
let funcionarios = [];
let sectores = [];
let organizacionesComunitarias = [];
let contribuyentes = [];
let currentSolRegistroId = null;
let currentUser = null;

// Paginación Auditoría
let auditData = [];
let currentAuditPage = 1;
const itemsPerPage = 10;

// Map variables
let map, marker;
const defaultLocation = { lat: -33.0248, lng: -71.5570 }; // Viña del Mar

window.initMap = function () {
    const mapElement = document.getElementById("map_desve");
    if (!mapElement) return;

    map = new google.maps.Map(mapElement, {
        zoom: 15,
        center: defaultLocation,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: true,
        styles: [
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [{ "visibility": "off" }]
            }
        ]
    });

    marker = new google.maps.Marker({
        map: map,
        position: defaultLocation,
        visible: false,
        animation: google.maps.Animation.DROP
    });
};

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, tipoRes, prioRes, funcRes, secRes, orgComRes, contribRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/desve/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/desve/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/general/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/organizaciones/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/contribuyentes_general.php`, fetchOptions).then(r => r.json())
        ]);

        organizaciones = extractData(orgRes);
        organizacionesDESVE = extractData(orgResDESVE);
        tiposOrganizacion = extractData(tipoRes);
        prioridades = extractData(prioRes);
        funcionarios = extractData(funcRes);
        sectores = extractData(secRes);
        organizacionesComunitarias = extractData(orgComRes);
        contribuyentes = extractData(contribRes);
    } catch (e) {
        console.error("Error loading initial data:", e);
    }
}

function extractData(response) {
    if (Array.isArray(response)) return response;
    if (response.data && Array.isArray(response.data)) return response.data;
    return [];
}

async function loadSolicitationDetails(id) {
    try {
        // 1. Verify Session
        const sessionRes = await fetch(`${window.API_BASE_URL}/general/verify_session.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "" })
        });
        const sessionData = await sessionRes.json();

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
        currentUser = sessionData.user;
        const response = await fetch(`${window.API_BASE_URL}/desve/solicitudes.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ sol_id: id, ACCION: "CONSULTAM", ver_clave: true })
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            const sol = result.data;
            let aux = false;
            sol.destinos.forEach(destino => {
                if (destino.tid_destino == String(currentUser.id)) {
                    aux = true;
                }
            });
            if (!aux) {
                aux = sol.sol_responsable === currentUser.id;
            }
            // 3. Security Check (Only assigned official can respond)
            if (!aux) {
                await Swal.fire({
                    title: 'Acceso Denegado',
                    text: `Esta solicitud está asignada a otro funcionario.`,
                    icon: 'error',
                    confirmButtonText: 'Volver a Bandeja'
                });
                window.location.href = 'index.php';
                return;
            }
            currentSolRegistroId = sol.sol_registro_tramite;

            // Header info
            document.getElementById('header_public_id').innerText = `Consulta DESVE: ${sol.sol_ingreso_desve || sol.sol_id}`;
            document.getElementById('header_expediente').innerText = sol.sol_nombre_expediente || 'Sin nombre de expediente';

            // Badge status
            const badge = document.getElementById('badge_estado');
            if (sol.sol_estado_entrega == 1) {
                badge.innerText = 'Respondido';
                badge.className = 'badge bg-success';
            } else {
                badge.innerText = 'Pendiente';
                badge.className = 'badge bg-warning text-dark';
            }

            // Main Info
            document.getElementById('info_expediente').innerText = sol.sol_nombre_expediente || '-';
            document.getElementById('info_id').innerText = sol.sol_id || '-';
            document.getElementById('info_rgt').innerText = sol.rgt_id_publica || '-';
            document.getElementById('info_desve').innerText = sol.sol_ingreso_desve || '';
            document.getElementById('info_reingreso').innerText = sol.sol_reingreso_id || '';

            // Resolve Origin
            let originName = '-';
            let tipoOrgName = '-';

            // Resolve Organization Type and Origen
            // Resolve Organization Type and Origen
            let org = null;
            let tiporg = null;

            switch (parseInt(sol.sol_origen_esp)) {
                case 0:
                    // Try Community Orgs first
                    org = organizacionesComunitarias.find(o => o.orgc_id == sol.sol_origen_id);
                    if (org) {
                        tiporg = tiposOrganizacion.find(t => t.tor_id == org.orgc_tipo_organizacion);
                        document.getElementById('info_origen').innerText = org.orgc_nombre;
                    } else {
                        // Fallback to General Orgs
                        org = organizaciones.find(o => o.org_id == sol.sol_origen_id);
                        if (org) {
                            tiporg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id); // Assuming field mismatch
                            document.getElementById('info_origen').innerText = org.org_nombre;
                        }
                    }
                    if (!org) document.getElementById('info_origen').innerText = sol.sol_origen_texto || 'Desconocido/Texto Manual';

                    break;
                case 1:
                    org = contribuyentes.find(o => o.tgc_id == sol.sol_origen_id);
                    if (org) {
                        document.getElementById('info_origen').innerText = `${org.tgc_nombre} ${org.tgc_apellido_paterno}`;
                        document.getElementById('info_tipo_org').innerText = "Particular / Contribuyente";
                    }
                    break;
                case 2:
                    org = organizacionesDESVE.find(o => o.org_id == sol.sol_origen_id);
                    if (org) {
                        tiporg = tiposOrganizacion.find(t => t.tor_id == org.org_tipo_id);
                        document.getElementById('info_origen').innerText = org.org_nombre;
                    }
                    break;
                default:
                    document.getElementById('info_origen').innerText = sol.sol_origen_texto || '-';
            }

            if (tiporg) {
                document.getElementById('info_tipo_org').innerText = tiporg.tor_nombre;
            }

            document.getElementById('info_latitud').innerText = sol.sol_latitud || '-';
            document.getElementById('info_longitud').innerText = sol.sol_longitud || '-';
            document.getElementById('info_direccion').innerText = sol.sol_direccion || '-';

            if (sol.sol_latitud && sol.sol_longitud) {
                const pos = { lat: parseFloat(sol.sol_latitud), lng: parseFloat(sol.sol_longitud) };
                const sectionMap = document.getElementById('section_map');
                if (sectionMap) sectionMap.classList.remove('hidden');

                // Esperar a que el mapa esté inicializado (usando las variables locales del módulo)
                const checkMap = setInterval(() => {
                    if (map && marker) {
                        clearInterval(checkMap);
                        map.setCenter(pos);
                        marker.setPosition(pos);
                        marker.setVisible(true);
                        google.maps.event.trigger(map, 'resize');
                    }
                }, 200);
            } else {
                const sectionMap = document.getElementById('section_map');
                if (sectionMap) sectionMap.classList.add('hidden');
            }

            const sector = sectores.find(s => s.sec_id == sol.sol_sector_id);
            document.getElementById('info_sector').innerText = sector ? sector.sec_nombre : '-';

            document.getElementById('info_fecha_recepcion').innerText = sol.sol_fecha_recepcion.substring(0, 10) || '-';

            const prio = prioridades.find(p => p.pri_id == sol.sol_prioridad_id);
            document.getElementById('info_prioridad').innerText = prio ? prio.pri_nombre : '-';

            document.getElementById('info_vencimiento').innerText = sol.sol_fecha_vencimiento.substring(0, 10) || '-';

            // Responsable
            const resp = funcionarios.find(f => f.fnc_id == sol.sol_responsable);
            document.getElementById('info_responsable').innerText = resp ? `${resp.fnc_nombre} ${resp.fnc_apellido}` : (sol.sol_responsable || '-');

            document.getElementById('info_detalle').innerText = sol.sol_detalle || 'Sin detalle';
            document.getElementById('info_observaciones').innerText = sol.sol_observaciones || 'Sin observaciones';

            const calcularTranscurridos = () => {
                if (!sol.sol_fecha_recepcion) return 0;
                const fecha_recep = new Date(sol.sol_fecha_recepcion.replace(/-/g, '/')); // replace para mejor compatibilidad
                const hoy = new Date();
                // Normalizamos a medianoche para comparar solo días
                const inicio = new Date(fecha_recep.getFullYear(), fecha_recep.getMonth(), fecha_recep.getDate());
                const fin = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

                const diff = fin - inicio;
                return Math.max(0, Math.floor(diff / (1000 * 60 * 60 * 24)));
            };

            // 2. Lógica para Días de Vencimiento (desde hoy hasta el vencimiento)
            const calcularVencimiento = () => {
                if (!sol.sol_fecha_vencimiento) return 0;
                const fecha_vence = new Date(sol.sol_fecha_vencimiento.replace(/-/g, '/'));
                const hoy = new Date();

                const fin = new Date(fecha_vence.getFullYear(), fecha_vence.getMonth(), fecha_vence.getDate());
                const inicio = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());

                const diff = fin - inicio;
                // Aquí no usamos Math.max porque si es negativo significa que YA ESTÁ VENCIDO
                return Math.floor(diff / (1000 * 60 * 60 * 24));
            };
            // Metrics
            // 3. Asignación al DOM
            // Usamos el cálculo solo si el valor del JSON es "0" o null
            document.getElementById('info_dias_ingreso').innerText =
                (sol.sol_dias_transcurridos && sol.sol_dias_transcurridos !== "0")
                    ? sol.sol_dias_transcurridos
                    : calcularTranscurridos();

            document.getElementById('info_dias_vencimiento').innerText =
                (sol.sol_dias_vencimiento && sol.sol_dias_vencimiento !== "0")
                    ? sol.sol_dias_vencimiento
                    : calcularVencimiento();
            // Render Bitacoras & Destinations
            renderResponseBitacora(sol.respuestas || []);

            // Auditoría con paginación (Orden descendente)
            auditData = (sol.bitacora || []).sort((a, b) => {
                const dateA = a.bit_creacion || a.bit_fecha || '';
                const dateB = b.bit_creacion || b.bit_fecha || '';
                return new Date(dateB) - new Date(dateA);
            });
            renderAuditPage(1);

            renderComentarios(sol.comentarios || []);
            renderReingresos(sol.reingresos || []);
            renderDestinos(sol.destinos || []);

            // Load Documents
            loadDocuments();

        } else {
            Swal.fire('Error', 'No se pudieron cargar los detalles de la solicitud.', 'error');
        }
    } catch (e) {
        console.error("Load Details Error:", e);
    }
}

function renderResponseBitacora(respuestas) {
    const tbody = document.getElementById('tbody_respuestas');
    tbody.innerHTML = '';
    respuestas.forEach(r => {
        const func = funcionarios.find(f => f.fnc_id == r.res_funcionario || f.usr_id == r.res_funcionario);
        const name = func ? `${func.fnc_nombre} ${func.fnc_apellido}` : (r.res_funcionario || 'N/A');
        const fecha = r.res_creacion ? r.res_creacion.substring(0, 10) : '-';

        const row = `
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4 font-mono text-xs text-slate-400">${r.res_id}</td>
                <td class="px-6 py-4 font-bold text-slate-700">${name}</td>
                <td class="px-6 py-4 text-slate-500">${fecha}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider ${r.res_tipo === 'Respuesta Final' ? 'bg-gob-success/10 text-gob-success border border-gob-success/20' : 'bg-primary-blue/10 text-primary-blue border border-primary-blue/20'}">
                        ${r.res_tipo}
                    </span>
                </td>
                <td class="px-6 py-4 text-slate-600 italic leading-relaxed">${r.res_texto}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function toggleAuditoria() {
    const collapse = document.getElementById('collapse_audit');
    const btn = document.getElementById('btn_toggle_audit');
    const isHidden = collapse.classList.contains('hidden');

    if (isHidden) {
        collapse.classList.remove('hidden');
        btn.style.transform = 'rotate(180deg)';
    } else {
        collapse.classList.add('hidden');
        btn.style.transform = 'rotate(0deg)';
    }
}

window.renderAuditPage = function (page) {
    currentAuditPage = page;
    const tbody = document.getElementById('tbody_audit');
    tbody.innerHTML = '';

    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageItems = auditData.slice(start, end);

    if (pageItems.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="px-6 py-10 text-center text-slate-400">No hay registros de auditoría.</td></tr>';
        document.getElementById('pagination_audit').innerHTML = '';
        return;
    }

    pageItems.forEach(entry => {
        const fechaFull = entry.bit_creacion || entry.bit_fecha || '';
        const fecha = fechaFull.substring(0, 10) || '-';
        const hora = fechaFull.substring(11, 16) || '';

        const row = `
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="text-slate-700 font-medium">${fecha}</div>
                    <div class="text-slate-400 text-[10px]">${hora}</div>
                </td>
                <td class="px-6 py-4 font-bold text-slate-700">${entry.usr_nombre} ${entry.usr_apellido}</td>
                <td class="px-6 py-4">
                    <div class="text-slate-600 text-[13px]">${entry.bit_evento}</div>
                </td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });

    renderAuditPagination();
};

function renderAuditPagination() {
    const container = document.getElementById('pagination_audit');
    const totalPages = Math.ceil(auditData.length / itemsPerPage);
    if (totalPages <= 1) {
        container.innerHTML = '';
        return;
    }

    let html = '';

    // Botón Anterior
    html += `
        <button onclick="renderAuditPage(${currentAuditPage - 1})" 
            ${currentAuditPage === 1 ? 'disabled' : ''}
            class="p-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-white hover:text-primary-blue disabled:opacity-30 disabled:hover:bg-transparent transition-all">
            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
        </button>
    `;

    // Páginas
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentAuditPage - 1 && i <= currentAuditPage + 1)) {
            html += `
                <button onclick="renderAuditPage(${i})" 
                    class="min-w-[32px] h-[32px] rounded-lg text-xs font-bold transition-all ${currentAuditPage === i ? 'bg-primary-blue text-white shadow-md' : 'text-slate-500 hover:bg-white hover:text-primary-blue border border-transparent hover:border-slate-200'}">
                    ${i}
                </button>
            `;
        } else if (i === currentAuditPage - 2 || i === currentAuditPage + 2) {
            html += `<span class="text-slate-300 px-1">...</span>`;
        }
    }

    // Botón Siguiente
    html += `
        <button onclick="renderAuditPage(${currentAuditPage + 1})" 
            ${currentAuditPage === totalPages ? 'disabled' : ''}
            class="p-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-white hover:text-primary-blue disabled:opacity-30 disabled:hover:bg-transparent transition-all">
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        </button>
    `;

    container.innerHTML = html;
}

function renderComentarios(comments) {
    const container = document.getElementById('lista_comentarios');
    container.innerHTML = '';
    if (comments.length === 0) {
        container.innerHTML = '<div class="text-muted p-2 small">No hay comentarios.</div>';
        return;
    }
    comments.forEach(c => {
        const fecha = c.gco_creacion ? c.gco_creacion.substring(0, 10) : '-';
        const item = `
            <div class="list-group-item px-0 border-0 border-bottom">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <strong>${c.usr_nombre} ${c.usr_apellido}</strong>
                    <span>${fecha}</span>
                </div>
                <div class="small">${c.gco_comentario}</div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', item);
    });
}

function renderReingresos(reingresos) {
    const tbody = document.getElementById('tbody_reingresos');
    tbody.innerHTML = '';
    if (!reingresos || reingresos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted small">Sin reingresos vinculados.</td></tr>';
        return;
    }
    // Note: This matches the previous logic for tabulating reingresos if available in the result.
}

function renderDestinos(destinos) {
    const tbody = document.getElementById('tbody_destinos');
    tbody.innerHTML = '';

    if (!destinos || destinos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="px-6 py-10 text-center text-slate-400">Sin destinatarios.</td></tr>';
        return;
    }

    destinos.forEach(d => {
        const name = d.usr_nombre_completo || 'Desconocido';
        const area = d.usr_area_nombre || '-';

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-colors";
        tr.innerHTML = `
            <td class="px-6 py-4 font-bold text-slate-700">${name}</td>
            <td class="px-6 py-4 text-slate-500">${area}</td>
            <td class="px-6 py-4 text-slate-400 text-[12px] italic">${d.usr_email || '-'}</td>
        `;
        tbody.appendChild(tr);
    });
}

async function loadDocuments() {
    try {
        const container = document.getElementById('lista_documentos');
        container.innerHTML = `
            <div class="flex flex-col items-center justify-center py-8 text-slate-400">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-blue mb-2"></div>
                <span class="text-xs font-medium uppercase tracking-widest">Buscando...</span>
            </div>
        `;

        const response = await fetch(`${window.API_BASE_URL}/gesdoc/general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: currentSolRegistroId }),
            credentials: 'include'
        });
        const result = await response.json();
        container.innerHTML = '';

        if (result.status === 'success' && result.documentos && result.documentos.length > 0) {
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
                    <button onclick="descargarDocumento('${doc.doc_id}', '${doc.doc_nombre_documento}')" 
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
        console.error("Load Documents Error:", e);
        document.getElementById('lista_documentos').innerHTML = `
            <div class="p-4 bg-red-50 text-red-600 rounded-xl border border-red-100 flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                <span class="text-xs font-bold uppercase tracking-wide">Error al conectar con la gestor documental</span>
            </div>
        `;
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
};

window.guardarComentario = async function () {
    const texto = document.getElementById('textoNuevoComentario').value.trim();
    if (!texto) return;

    try {
        const response = await fetch(`${window.API_BASE_URL}/general/comentarios.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CREAR", rgt_id: currentSolRegistroId, gco_texto: texto })
        });
        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('textoNuevoComentario').value = '';
            bootstrap.Modal.getInstance(document.getElementById('modalNuevoComentario')).hide();
            loadSolicitationDetails(new URLSearchParams(window.location.search).get('id'));
        }
    } catch (e) {
        console.error(e);
    }
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
        cancelButtonText: 'Volver a Bandeja',
        allowOutsideClick: false,
        confirmButtonText: 'Buscar',
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