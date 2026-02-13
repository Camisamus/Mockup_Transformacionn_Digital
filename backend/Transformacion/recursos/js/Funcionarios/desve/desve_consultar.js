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
    document.getElementById('btn_ir_modificar').onclick = () => window.location.href = `desve_modificar.php?id=${solicitationId}`;
    document.getElementById('btn_ir_responder').onclick = () => window.location.href = `desve_responder.php?id=${solicitationId}`;

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

async function loadInitialData() {
    try {
        const fetchOptions = {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "CONSULTAM" })
        };
        const [orgRes, orgResDESVE, tipoRes, prioRes, funcRes, secRes, orgComRes, contribRes] = await Promise.all([
            fetch(`${window.API_BASE_URL}/organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/prioridades.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/funcionarios.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/sectores.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/organizaciones_comunitarias_general.php`, fetchOptions).then(r => r.json()),
            fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, fetchOptions).then(r => r.json())
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
        const sessionRes = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
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
        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
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
                window.location.href = 'desve_listado_ingresos.php';
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
            } else if (!document.getElementById('info_tipo_org').innerText) {
                // Try to guess or leave empty
                // document.getElementById('info_tipo_org').innerText = '-';
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
            renderAuditBitacora(sol.bitacora || []);
            renderComments(sol.comentarios || []);
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

        const row = `
            <tr>
                <td>${r.res_id}</td>
                <td>${name}</td>
                <td>${r.res_fecha.substring(0, 10)}</td>
                <td><span class="badge ${r.res_tipo === 'Respuesta Final' ? 'bg-success' : 'bg-info'}">${r.res_tipo}</span></td>
                <td>${r.res_texto}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function renderAuditBitacora(bitacora) {
    const tbody = document.getElementById('tbody_audit');
    tbody.innerHTML = '';
    bitacora.forEach(entry => {
        const row = `
            <tr>
                <td>${entry.bit_fecha.substring(0, 10)}</td>
                <td>${entry.usr_nombre} ${entry.usr_apellido}</td>
                <td>${entry.bit_evento}</td>
            </tr>
        `;
        tbody.insertAdjacentHTML('beforeend', row);
    });
}

function renderComments(comments) {
    const container = document.getElementById('lista_comentarios');
    container.innerHTML = '';
    if (comments.length === 0) {
        container.innerHTML = '<div class="text-muted p-2 small">No hay comentarios.</div>';
        return;
    }
    comments.forEach(c => {
        const item = `
            <div class="list-group-item px-0 border-0 border-bottom">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <strong>${c.usr_nombre} ${c.usr_apellido}</strong>
                    <span>${c.gco_fecha.substring(0, 10)}</span>
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
        tbody.innerHTML = '<tr><td colspan="2" class="text-center text-muted small">Sin destinatarios.</td></tr>';
        return;
    }

    destinos.forEach(d => {
        // Fallback if joined fields are missing (should be present from backend query)
        const name = d.usr_nombre_completo || 'Desconocido';
        // const email = d.usr_email || '-'; // Assuming email might be available in future or via join

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${name}</td>
            <td>${d.usr_email || '-'}</td>
        `;
        tbody.appendChild(tr);
    });
}

async function loadDocuments() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/gesdoc_general.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "BuscarporTramite", tramite_id: currentSolRegistroId }),
            credentials: 'include'
        });
        const result = await response.json();
        const container = document.getElementById('lista_documentos');
        container.innerHTML = '';

        if (result.status === 'success' && result.documentos) {
            result.documentos.forEach(doc => {
                const item = document.createElement('div');
                item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-light mb-1 border rounded';
                item.innerHTML = `
                    <div class="text-truncate" style="max-width: 80%;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file me-2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                        <span class="small">${doc.doc_nombre_documento}</span>
                    </div>
                    <button class="btn btn-sm btn-link p-0" onclick="descargarDocumento('${doc.doc_id}', '${doc.doc_nombre_documento}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    </button>
                `;
                container.appendChild(item);
            });
        } else {
            container.innerHTML = '<div class="text-muted small">Sin documentos adjuntos.</div>';
        }
    } catch (e) {
        console.error("Load Documents Error:", e);
    }
}

window.descargarDocumento = async function (id, nombre) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/gesdoc_general.php`, {
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
        const response = await fetch(`${window.API_BASE_URL}/comentarios.php`, {
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
        window.location.href = 'desve_listado_ingresos.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        const payload = { ACCION: 'CONSULTAM' };
        if (type === 'sol_id') payload.sol_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/solicitudes_desve.php`, {
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

