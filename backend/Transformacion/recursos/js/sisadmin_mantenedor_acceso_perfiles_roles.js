// Mantenedor de Asignación Perfiles/Roles
let allData = [];
let perfiles = [];
let roles = [];
let categorias = [];
let currentModal = null;

document.addEventListener('DOMContentLoaded', () => {
    initializeModal();
    initializeSelect2();
    loadDependencies();
    loadData();
    attachEventListeners();
});

function initializeModal() {
    const modalElement = document.getElementById('modal-form');
    if (modalElement) {
        currentModal = new bootstrap.Modal(modalElement);
    }
}

function initializeSelect2() {
    $('#entry-perfil, #entry-categoria').select2({
        dropdownParent: $('#modal-form')
    });
}

function attachEventListeners() {
    const btnNew = document.getElementById('btn-new');
    if (btnNew) {
        btnNew.addEventListener('click', () => {
            if (currentModal) {
                document.getElementById('main-form').reset();
                $('#entry-perfil, #entry-categoria').val(null).trigger('change');
                document.getElementById('roles-checkbox-container').innerHTML = '<p class="text-muted small mb-0">Seleccione una categoría para ver los roles.</p>';
                currentModal.show();
            }
        });
    }

    const btnSave = document.getElementById('btn-save');
    if (btnSave) {
        btnSave.addEventListener('click', saveData);
    }

    const filterText = document.getElementById('filter-text');
    if (filterText) {
        filterText.addEventListener('input', filterData);
    }

    const selectCategoria = document.getElementById('entry-categoria');
    if (selectCategoria) {
        $(selectCategoria).on('change', renderRoleCheckboxes);
    }
}

async function loadDependencies() {
    try {
        const [resP, resR] = await Promise.all([
            fetch(`${window.API_BASE_URL}/perfiles_acceso.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }),
            fetch(`${window.API_BASE_URL}/roles_acceso.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            })
        ]);

        const dataP = await resP.json();
        const dataR = await resR.json();

        if (dataP.status === 'success') {
            perfiles = dataP.data;
            const select = document.getElementById('entry-perfil');
            select.innerHTML = '<option value="">Seleccione Perfil</option>';
            perfiles.forEach(p => {
                const opt = new Option(p.prf_nombre, p.prf_id);
                select.add(opt);
            });
        }

        if (dataR.status === 'success') {
            roles = dataR.data;
            // Identify categories based on rol_tipo or dot notation
            // Fix: Filter by unique rol_id to avoid duplicate categories in dropdown
            const rawCategorias = roles.filter(r => r.rol_tipo === 'categoria' || !r.rol_id.includes('.'));
            const categoryMap = new Map();
            rawCategorias.forEach(c => {
                if (!categoryMap.has(c.rol_id)) {
                    categoryMap.set(c.rol_id, c);
                }
            });
            categorias = Array.from(categoryMap.values());

            const select = document.getElementById('entry-categoria');
            select.innerHTML = '<option value="">Seleccione Categoría</option>';
            categorias.forEach(c => {
                const opt = new Option(c.rol_nombre, c.rol_id);
                select.add(opt);
            });
        }
    } catch (error) {
        console.error('Error loading dependencies:', error);
    }
}

window.loadData = async function () {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-5"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Cargando datos...</td></tr>';
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/perfiles_roles_acceso.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });

        const data = await response.json();
        if (data.status === 'success' && data.data) {
            allData = data.data;
            renderTable(allData);
        } else {
            renderEmptyState('No se pudieron cargar los datos.');
        }
    } catch (error) {
        console.error('Error loading data:', error);
        renderEmptyState('Error de conexión.');
    }
}

function renderTable(dataItems) {
    const tbody = document.getElementById('table-body');
    if (!tbody) return;

    if (!dataItems || dataItems.length === 0) {
        renderEmptyState('No se encontraron registros.');
        return;
    }

    tbody.innerHTML = '';
    dataItems.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><span class="fw-bold">${item.prf_nombre}</span></td>
            <td>${item.rol_nombre}</td>
            <td><code>${item.pfr_rol_id}</code></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.pfr_perfil_id}, '${item.pfr_rol_id}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });

    if (window.feather) feather.replace();
}

function renderEmptyState(message) {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center py-5 text-muted small">${message}</td></tr>`;
    }
}

function filterData() {
    const filterVal = document.getElementById('filter-text').value.toLowerCase();

    const filtered = allData.filter(item => {
        const textMatch = !filterVal ||
            (item.prf_nombre && item.prf_nombre.toLowerCase().includes(filterVal)) ||
            (item.rol_nombre && item.rol_nombre.toLowerCase().includes(filterVal)) ||
            (item.pfr_rol_id && item.pfr_rol_id.toLowerCase().includes(filterVal));
        return textMatch;
    });

    renderTable(filtered);
}

window.deleteItem = async function (perfil_id, rol_id) {
    const result = await Swal.fire({
        title: '¿Eliminar vínculo?',
        text: 'Se eliminará el acceso de este perfil a este rol.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/perfiles_roles_acceso.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'BORRAR',
                    pfr_perfil_id: perfil_id,
                    pfr_rol_id: rol_id
                })
            });

            const data = await response.json();
            if (data.status === 'success') {
                Swal.fire('Éxito', 'Vínculo eliminado correctamente.', 'success');
                loadData();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Error de conexión.', 'error');
        }
    }
}

function renderRoleCheckboxes() {
    const categoriaId = document.getElementById('entry-categoria').value;
    const container = document.getElementById('roles-checkbox-container');

    if (!categoriaId) {
        container.innerHTML = '<p class="text-muted small mb-0">Seleccione una categoría para ver los roles.</p>';
        return;
    }

    // Filter roles that belong to this category (start with categoriaId + ".")
    const filteredRoles = roles.filter(r => r.rol_id.startsWith(categoriaId + '.') && r.rol_tipo !== 'categoria');

    if (filteredRoles.length === 0) {
        if (categoriaId === '0') {
            container.innerHTML = `
                <div class="alert alert-info py-2 px-3 small mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <strong>Bandeja</strong> es una página directa. Haga clic en <strong>Vincular</strong> para asignar.
                </div>
            `;
        } else {
            container.innerHTML = '<p class="text-muted small mb-0">No hay roles definidos para esta categoría.</p>';
        }
        return;
    }

    container.innerHTML = `
        <div class="mb-2 border-bottom pb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check-all-roles">
                <label class="form-check-label fw-bold" for="check-all-roles">Seleccionar Todos</label>
            </div>
        </div>
        <div class="role-list">
            ${filteredRoles.map(r => `
                <div class="form-check">
                    <input class="form-check-input role-checkbox" type="checkbox" value="${r.rol_id}" id="role-${r.rol_id}">
                    <label class="form-check-label" for="role-${r.rol_id}">${r.rol_nombre} <small class="text-muted">(${r.rol_id})</small></label>
                </div>
            `).join('')}
        </div>
    `;

    document.getElementById('check-all-roles').addEventListener('change', (e) => {
        const checked = e.target.checked;
        container.querySelectorAll('.role-checkbox').forEach(cb => cb.checked = checked);
    });
}

async function saveData() {
    const perfil = document.getElementById('entry-perfil').value;
    const categoriaId = document.getElementById('entry-categoria').value;
    const selectedRoles = Array.from(document.querySelectorAll('.role-checkbox:checked')).map(cb => cb.value);

    if (!perfil) {
        Swal.fire('Atención', 'Seleccione un perfil', 'warning');
        return;
    }

    if (selectedRoles.length === 0 && categoriaId !== '0') {
        Swal.fire('Atención', 'Seleccione al menos un rol', 'warning');
        return;
    }

    // Include the category ID itself in the assignment list
    // Special case for '0' (Bandeja): it always gets included if selected
    const rolesToAssign = [...new Set([categoriaId, ...selectedRoles])].filter(Boolean);

    Swal.fire({
        title: 'Procesando...',
        text: `Asignando ${rolesToAssign.length} items (categoría y roles) al perfil.`,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        let results = [];
        for (const rol_id of rolesToAssign) {
            const payload = {
                ACCION: 'CREAR',
                pfr_perfil_id: parseInt(perfil),
                pfr_rol_id: rol_id
            };

            const response = await fetch(`${window.API_BASE_URL}/perfiles_roles_acceso.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await response.json();

            // Treat "Already exists" as a success for the bulk report
            if (data.status === 'error' && data.message.includes('ya existe')) {
                results.push({ status: 'success', duplicate: true });
            } else {
                results.push(data);
            }
        }

        const successCount = results.filter(r => r.status === 'success').length;
        const errorCount = results.length - successCount;

        if (successCount > 0) {
            await Swal.fire({
                title: 'Éxito',
                text: `${successCount} vínculos creados correctamente.${errorCount > 0 ? ` (${errorCount} fallaron)` : ''}`,
                icon: 'success'
            });
            if (currentModal) currentModal.hide();
            loadData();
        } else {
            Swal.fire('Error', 'No se pudieron crear los vínculos.', 'error');
        }
    } catch (error) {
        console.error('Save error:', error);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
}
