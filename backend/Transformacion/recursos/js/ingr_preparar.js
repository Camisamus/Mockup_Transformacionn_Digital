document.addEventListener('DOMContentLoaded', async () => {
    console.log("Preparing view initialized");
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (!id) {
        await checkAndRequestID();
        return;
    }

    try {
        await cargarTipos();
        await cargarDatosPreparar(id);
        setupEventListeners(id);
    } catch (err) {
        console.error("Initialization error:", err);
    }
});

let network = null;
let currentRequestId = null;
let currentRgtId = null;

async function cargarTipos() {
    try {
        const resp = await fetch(`${window.API_BASE_URL}/ingresos_tipos_ingreso.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const result = await resp.json();
        const select = document.getElementById('h_tipo');
        if (select) {
            select.innerHTML = '<option value="" selected disabled>Seleccione un tipo...</option>';
            if (result.status === 'success') {
                result.data.forEach(t => {
                    const opt = document.createElement('option');
                    opt.value = t.titi_id;
                    opt.textContent = t.titi_nombre;
                    select.appendChild(opt);
                });
            }
        }
    } catch (e) { console.error("Error loading types:", e); }
}

async function cargarDatosPreparar(id) {
    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM', ing_id: id })
        });
        const result = await response.json();

        if (result.status === 'success') {
            const data = result.data;

            // RBAC Enforcement
            const perms = IngrPermissions.getPermissions(data.rol_usuario);
            if (!perms.preparar) {
                Swal.fire({
                    title: 'Acceso Denegado',
                    text: 'Usted no tiene permisos para ver las relaciones de esta solicitud.',
                    icon: 'error',
                    confirmButtonText: 'Ver Detalle',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = `ingr_consultar.php?id=${id}`;
                });
                return;
            }

            // Show modification buttons for authorized roles (Responsable, Visador, Firmante)
            const btnHija = document.getElementById('btn_nueva_hija');
            const btnDep = document.getElementById('btn_establecer_dependencia');
            if (btnHija) btnHija.style.display = perms.preparar ? 'block' : 'none';
            if (btnDep) btnDep.style.display = perms.preparar ? 'block' : 'none';

            currentRequestId = data.tis_id;
            currentRgtId = parseInt(data.tis_registro_tramite);
            document.getElementById('subtitulo_preparar').innerText = `Gestionando: ${data.tis_titulo} (ID: ${data.tis_id})`;

            const rgtIds = new Set();
            rgtIds.add(currentRgtId);

            if (data.multiancestro) {
                Object.values(data.multiancestro).forEach(rel => {
                    rgtIds.add(parseInt(rel.gma_padre));
                    rgtIds.add(parseInt(rel.gma_hijo));
                });
            }

            const respDetalles = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'DETALLES_ARBOL', rgt_ids: Array.from(rgtIds) })
            });
            const resDetalles = await respDetalles.json();

            let sessionUser = null;
            try {
                const respSession = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ACCION: 'VERIFICAR' })
                });
                const sessionData = await respSession.json();
                sessionUser = sessionData.user?.id;
            } catch (e) { console.warn("Session check failed."); }

            renderizarMapa(data.multiancestro || {}, resDetalles.data || [], sessionUser);
        }
    } catch (e) { console.error("Error loading data:", e); }
}

function setupEventListeners(parentId) {
    console.log("Setting up event listeners...");

    // Modal Hija
    const modalHijaEl = document.getElementById('modalCrearHija');
    if (modalHijaEl) {
        const modalHija = new bootstrap.Modal(modalHijaEl);
        document.getElementById('btn_nueva_hija').onclick = () => {
            document.getElementById('form_crear_hija').reset();
            modalHija.show();
        };
        document.getElementById('form_crear_hija').onsubmit = async (e) => {
            e.preventDefault();
            await crearSolicitudHija(parentId, modalHija);
        };
    }

    // Modal Dependencia
    const modalDepEl = document.getElementById('modalEstablecerDependencia');
    const btnDep = document.getElementById('btn_establecer_dependencia');

    if (modalDepEl && btnDep) {
        const modalDep = new bootstrap.Modal(modalDepEl);
        btnDep.onclick = async () => {
            console.log("Click on Establecer Dependencia");
            modalDep.show();
            await cargarSolicitudesParaDependencia();
        };

        const buscarInput = document.getElementById('buscar_padre');
        if (buscarInput) {
            buscarInput.onkeyup = function () {
                const text = this.value.toLowerCase();
                const rows = document.querySelectorAll('#lista_solicitudes_padre tr');
                rows.forEach(row => {
                    row.style.display = row.innerText.toLowerCase().includes(text) ? '' : 'none';
                });
            };
        }
        const toggle = document.getElementById('toggle_no_favorables');
        if (toggle) {
            toggle.onchange = () => {
                cargarDatosPreparar(parentId);
            };
        }
    } else {
        console.error("Modal or Button for dependency not found!", { modalDepEl, btnDep });
    }
}

async function crearSolicitudHija(parentId, modalInstance) {
    try {
        const payload = {
            ACCION: 'CREAR',
            tis_titulo: document.getElementById('h_titulo').value,
            tis_tipo: document.getElementById('h_tipo').value,
            tis_contenido: document.getElementById('h_contenido').value,
            tis_estado: 'Ingresado',
            tis_fecha: new Date().toISOString().split('T')[0],
            destinos: []
        };

        Swal.fire({ title: 'Creando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        const respCrear = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const resCrear = await respCrear.json();

        if (resCrear.status === 'success') {
            const childRequestId = resCrear.id;
            const respChild = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM', ing_id: childRequestId })
            });
            const resChild = await respChild.json();
            const childRgtId = resChild.data.tis_registro_tramite;

            const respLink = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'VINCULAR_HIJO',
                    padre_id: currentRgtId,
                    hijo_id: childRgtId
                })
            });
            const resLink = await respLink.json();

            if (resLink.status === 'success') {
                Swal.fire('Éxito', 'Solicitud hija creada y vinculada.', 'success');
                modalInstance.hide();
                await cargarDatosPreparar(parentId);
            } else {
                Swal.fire('Atención', 'Se creó pero falló el vínculo.', 'warning');
            }
        }
    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error en el proceso.', 'error');
    }
}

async function cargarSolicitudesParaDependencia() {
    try {
        const tbody = document.getElementById('lista_solicitudes_padre');
        tbody.innerHTML = '<tr><td colspan="4" class="text-center p-3">Cargando...</td></tr>';

        const respSession = await fetch(`${window.API_BASE_URL}/verify_session.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'VERIFICAR' })
        });
        const sessionData = await respSession.json();
        const currentUserId = sessionData.user?.id;

        if (!currentUserId) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">Error de sesión</td></tr>';
            return;
        }

        const resp = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const result = await resp.json();

        if (result.status === 'success') {
            const filtered = result.data.filter(sol =>
                parseInt(sol.tis_responsable) === parseInt(currentUserId) &&
                sol.tis_estado !== 'Resuelto_Favorable' &&
                sol.tis_estado !== 'Resuelto_NO_Favorable' &&
                parseInt(sol.tis_registro_tramite) !== parseInt(currentRgtId)
            );

            if (filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">No hay solicitudes elegibles</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            filtered.forEach(sol => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="small fw-bold">${sol.tis_id || sol.rgt_id_publica}</td>
                    <td class="small">${sol.tis_titulo}</td>
                    <td><span class="badge bg-light text-dark border small">${sol.tis_estado}</span></td>
                    <td>
                        <button class="btn btn-sm btn-success py-0 px-2" onclick="vincularComoPadre(${sol.tis_registro_tramite}, '${sol.tis_titulo}')">
                            Vincular
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
    } catch (e) { console.error(e); }
}

window.vincularComoPadre = async function (parentRgtId, parentTitle) {
    const confirm = await Swal.fire({
        title: '¿Vincular Dependencia?',
        text: `¿Vincular "${parentTitle}" como un antecesor?`,
        icon: 'question',
        showCancelButton: true
    });

    if (!confirm.isConfirmed) return;

    try {
        Swal.fire({ title: 'Vinculando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
        const respLink = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'VINCULAR_HIJO', padre_id: parentRgtId, hijo_id: currentRgtId })
        });
        const resLink = await respLink.json();

        if (resLink.status === 'success') {
            Swal.fire('Éxito', 'Dependencia establecida.', 'success');
            const m = bootstrap.Modal.getInstance(document.getElementById('modalEstablecerDependencia'));
            if (m) m.hide();
            location.reload();
        } else {
            Swal.fire('Error', resLink.message || 'Fallo al vincular', 'error');
        }
    } catch (e) { console.error(e); }
};

function renderizarMapa(relaciones, detalles = [], userId = null) {
    const container = document.getElementById('network-container');
    const nodes = new vis.DataSet();
    const edges = new vis.DataSet();
    const addedNodes = new Set();
    const detallesMap = new Map();

    if (Array.isArray(detalles)) {
        detalles.forEach(d => { if (d.rgt_id) detallesMap.set(parseInt(d.rgt_id), d); });
    }

    function getColorForNode(rgtId) {
        const idInt = parseInt(rgtId);
        if (idInt === currentRgtId) return '#ffc107';
        const det = detallesMap.get(idInt);
        if (det) {
            if (det.tis_estado === 'Resuelto_Favorable') return '#198754';
            if (det.tis_estado === 'Resuelto_NO_Favorable') return '#000000';
            const hasDest = det.destinos && det.destinos.length > 0;
            if (!hasDest) {
                return (parseInt(det.tis_responsable) === parseInt(userId)) ? '#dc3545' : '#fd7e14';
            }
        }
        return '#97c2fc';
    }

    function getTooltip(rgtId) {
        const det = detallesMap.get(parseInt(rgtId));
        return det ? det.tis_titulo : `RT-${rgtId}`;
    }

    const toggle = document.getElementById('toggle_no_favorables');
    const showNoFavorables = toggle ? toggle.checked : true;

    const childrenOf = {};
    Object.values(relaciones).forEach(rel => {
        const p = parseInt(rel.gma_padre);
        const h = parseInt(rel.gma_hijo);

        // Visibility Filtering
        if (!showNoFavorables) {
            const detP = detallesMap.get(p);
            const detH = detallesMap.get(h);
            if (detP?.tis_estado === 'Resuelto_NO_Favorable' || detH?.tis_estado === 'Resuelto_NO_Favorable') {
                return; // Skip this relation
            }
        }

        if (!childrenOf[p]) childrenOf[p] = [];
        childrenOf[p].push(h);

        [p, h].forEach(id => {
            if (!addedNodes.has(id)) {
                nodes.add({ id, label: `RT-${id}`, color: getColorForNode(id), title: getTooltip(id) });
                addedNodes.add(id);
            }
        });
        edges.add({ from: p, to: h, arrows: 'from' });
    });

    const clickableNodes = new Set();
    if (currentRgtId) {
        clickableNodes.add(currentRgtId);
        const q = [currentRgtId];
        while (q.length > 0) {
            const p = q.shift();
            if (childrenOf[p]) {
                childrenOf[p].forEach(c => { if (!clickableNodes.has(c)) { clickableNodes.add(c); q.push(c); } });
            }
        }
    }

    if (!addedNodes.has(currentRgtId) && currentRgtId) {
        nodes.add({ id: currentRgtId, label: `RT-${currentRgtId}`, color: '#ffc107', title: getTooltip(currentRgtId) });
        clickableNodes.add(currentRgtId);
    }

    const data = { nodes, edges };
    const options = {
        layout: { hierarchical: { direction: 'UD', sortMethod: 'directed' } },
        physics: false,
        nodes: { shape: 'box', margin: 10 },
        interaction: { hover: true, selectConnectedEdges: false }
    };

    if (network) network.destroy();
    network = new vis.Network(container, data, options);

    network.on("selectNode", (params) => {
        const sid = parseInt(params.nodes[0]);
        console.log("Node selected:", sid);
        console.log("Is clickable?", clickableNodes.has(sid));

        if (clickableNodes.has(sid)) {
            const det = detallesMap.get(sid);
            console.log("Node details:", det);

            if (det && det.tis_id) {
                console.log("Navigating to id:", det.tis_id);
                const isResolved = det.tis_estado === 'Resuelto_Favorable' || det.tis_estado === 'Resuelto_NO_Favorable';
                if (parseInt(det.tis_responsable) === parseInt(userId) && !isResolved) {
                    window.location.href = `ingr_modificar.php?id=${det.tis_id}`;
                } else {
                    window.location.href = `ingr_consultar.php?id=${det.tis_id}`;
                }
            } else {
                console.warn("Details missing for node:", sid);
            }
        } else {
            console.log("Node is non-clickable ancestor or lateral.");
            network.unselectAll();
        }
    });

    network.on("selectEdge", async (params) => {
        const edgeId = params.edges[0];
        const edgeData = edges.get(edgeId);
        if (!edgeData) return;

        const parentRgtId = edgeData.from;
        const childRgtId = edgeData.to;
        const childDet = detallesMap.get(childRgtId);
        const parentDet = detallesMap.get(parentRgtId);

        const isResolved = childDet?.tis_estado === 'Resuelto_Favorable' || childDet?.tis_estado === 'Resuelto_NO_Favorable';
        if (childDet && isResolved) {
            Swal.fire('Atención', 'No se pueden eliminar vínculos de solicitudes ya resueltas.', 'warning');
            network.unselectAll();
            return;
        }

        if (childDet && parseInt(childDet.tis_responsable) !== parseInt(userId)) {
            Swal.fire('Atención', 'No tienes permisos para eliminar este vínculo (No eres responsable de la solicitud hija).', 'warning');
            network.unselectAll();
            return;
        }

        const confirm = await Swal.fire({
            title: '¿Eliminar Vínculo?',
            text: `¿Estás seguro de que deseas eliminar la relación entre "${parentDet?.tis_titulo || parentRgtId}" y "${childDet?.tis_titulo || childRgtId}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirm.isConfirmed) {
            try {
                Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                const resp = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ACCION: 'ELIMINAR_VINCULO', padre_id: parentRgtId, hijo_id: childRgtId })
                });
                const res = await resp.json();
                if (res.status === 'success') {
                    Swal.fire('Eliminado', 'El vínculo ha sido eliminado correctamente.', 'success');
                    location.reload();
                } else {
                    Swal.fire('Error', res.message || 'No se pudo eliminar el vínculo', 'error');
                }
            } catch (e) {
                console.error(e);
                Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
            }
        }
        network.unselectAll();
    });

    if (window.feather) window.feather.replace();
}

async function checkAndRequestID() {
    const { value: formValues } = await Swal.fire({
        title: 'Trámite no especificado',
        html: `
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold">Tipo de Identificador:</label>
                <select id="swal-id-type" class="form-select">
                    <option value="tis_id">ID Interno (Solicitud)</option>
                    <option value="rgt_id_publica" selected>Cód. Público (Ej: H3k9L2p1)</option>
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
        window.location.href = 'ingr_bandeja.php';
        return;
    }

    const { type, value } = formValues;

    try {
        Swal.fire({ title: 'Buscando...', didOpen: () => Swal.showLoading() });

        let foundId = null;
        const payload = { ACCION: 'CONSULTAM' };

        if (type === 'tis_id') payload.tis_id = value;
        else if (type === 'rgt_id_publica') payload.rgt_id_publica = value;
        else if (type === 'rgt_id') payload.rgt_id = value;

        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).then(r => r.json());

        if (response.status === 'success' && response.data) {
            const results = Array.isArray(response.data) ? response.data : [response.data];
            if (results.length > 0 && results[0].tis_id) {
                foundId = results[0].tis_id;
            }
        }

        if (foundId) {
            Swal.close();
            // Reload with correct ID
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('id', foundId);
            window.location.href = newUrl.toString();
        } else {
            Swal.fire('No encontrado', 'No se encontró ninguna solicitud con ese criterio.', 'error').then(() => {
                checkAndRequestID(); // Retry
            });
        }

    } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Error de conexión', 'error');
    }
}

