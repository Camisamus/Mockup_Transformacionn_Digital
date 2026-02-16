// Mantenedor de Orígenes Especiales
let allOrganizations = [];
let allTypes = [];
let currentModal = null;
let currentMode = 'create';

document.addEventListener('DOMContentLoaded', () => {
    initializeModal();
    loadTypes();
    loadData();
    attachEventListeners();
});

function initializeModal() {
    const modalElement = document.getElementById('modal-origin');
    if (modalElement) {
        currentModal = new bootstrap.Modal(modalElement);
    }
}

function attachEventListeners() {
    const btnNew = document.getElementById('btn-new-origin');
    if (btnNew) {
        btnNew.addEventListener('click', () => {
            openModal('create');
        });
    }

    const btnSave = document.getElementById('btn-save-origin');
    if (btnSave) {
        btnSave.addEventListener('click', saveData);
    }

    const filterName = document.getElementById('filter-name');
    if (filterName) {
        filterName.addEventListener('input', filterData);
    }

    const filterType = document.getElementById('filter-type');
    if (filterType) {
        filterType.addEventListener('change', filterData);
    }
}

async function loadTypes() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/tipo_organizaciones.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });

        const data = await response.json();
        if (data.status === 'success' && data.data) {
            allTypes = data.data.filter(type => type.tor_id != 1 && type.tor_id != 2);
            populateTypeDropdowns();
        }
    } catch (error) {
        console.error('Error loading types:', error);
    }
}

function populateTypeDropdowns() {
    const filterSelect = document.getElementById('filter-type');
    const modalSelect = document.getElementById('origin-type');

    if (filterSelect) {
        filterSelect.innerHTML = '<option value="">Todos</option>';
        allTypes.forEach(type => {
            const opt = document.createElement('option');
            opt.value = type.tor_id;
            opt.textContent = type.tor_nombre;
            filterSelect.appendChild(opt);
        });
    }

    if (modalSelect) {
        modalSelect.innerHTML = '<option value="">Seleccione un tipo</option>';
        allTypes.forEach(type => {
            const opt = document.createElement('option');
            opt.value = type.tor_id;
            opt.textContent = type.tor_nombre;
            modalSelect.appendChild(opt);
        });
    }
}

window.loadData = async function () {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-5"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Cargando datos...</td></tr>';
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });

        const data = await response.json();
        if (data.status === 'success' && data.data) {
            allOrganizations = data.data;
            renderTable(allOrganizations);
        } else {
            renderEmptyState('No se pudieron cargar los datos.');
        }
    } catch (error) {
        console.error('Error loading data:', error);
        renderEmptyState('Error de conexión.');
    }
}

function renderTable(organizations) {
    const tbody = document.getElementById('table-body');
    if (!tbody) return;

    if (!organizations || organizations.length === 0) {
        renderEmptyState('No se encontraron registros.');
        return;
    }

    tbody.innerHTML = '';
    organizations.forEach(org => {
        const row = document.createElement('tr');
        const type = allTypes.find(t => t.tor_id == org.org_tipo_id);
        const typeName = type ? type.tor_nombre : 'N/A';

        row.innerHTML = `
            <td class="fw-bold">${org.org_id}</td>
            <td>${org.org_nombre}</td>
            <td><span class="badge bg-light text-dark border fw-normal">${typeName}</span></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="editOrganization(${org.org_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteOrganization(${org.org_id})">
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
    const nameFilter = document.getElementById('filter-name').value.toLowerCase();
    const typeFilter = document.getElementById('filter-type').value;

    const filtered = allOrganizations.filter(org => {
        let cumpleNombre = !nameFilter || org.org_nombre.toLowerCase().includes(nameFilter);
        let cumpleTipo = !typeFilter || org.org_tipo_id == typeFilter;
        return cumpleNombre && cumpleTipo;
    });

    renderTable(filtered);
}

window.openModal = function (mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalOriginLabel');
    const form = document.getElementById('form-origin');

    if (form) form.reset();
    const idInput = document.getElementById('origin-id');
    if (idInput) idInput.value = '';

    if (mode === 'create') {
        if (modalTitle) modalTitle.textContent = 'Nuevo Origen Especial';
    } else if (mode === 'edit' && data) {
        if (modalTitle) modalTitle.textContent = 'Editar Origen Especial';
        if (idInput) idInput.value = data.org_id;
        document.getElementById('origin-name').value = data.org_nombre;
        document.getElementById('origin-type').value = data.org_tipo_id;
    }

    if (currentModal) currentModal.show();
}

window.editOrganization = function (id) {
    const org = allOrganizations.find(o => o.org_id == id);
    if (org) openModal('edit', org);
}

window.deleteOrganization = async function (id) {
    const result = await Swal.fire({
        title: '¿Eliminar registro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'BORRAR', org_id: id })
            });

            const data = await response.json();
            if (data.status === 'success') {
                Swal.fire('Éxito', 'Registro eliminado correctamente.', 'success');
                loadData();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Error de conexión.', 'error');
        }
    }
}

async function saveData() {
    const form = document.getElementById('form-origin');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const id = document.getElementById('origin-id').value;
    const name = document.getElementById('origin-name').value;
    const typeId = document.getElementById('origin-type').value;

    const payload = {
        ACCION: currentMode === 'create' ? 'CREAR' : 'ACTUALIZAR',
        org_nombre: name,
        org_tipo_id: parseInt(typeId)
    };

    if (currentMode === 'edit') payload.org_id = parseInt(id);

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await response.json();
        if (data.status === 'success') {
            Swal.fire('Éxito', 'Datos guardados correctamente.', 'success');
            if (currentModal) currentModal.hide();
            loadData();
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch (error) {
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
}
