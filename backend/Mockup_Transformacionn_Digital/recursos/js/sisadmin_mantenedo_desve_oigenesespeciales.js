// Mantenedor de Orígenes Especiales
// Handles CRUD operations for trd_desve_organizaciones

let allOrganizations = [];
let allTypes = [];
let currentModal = null;
let currentMode = 'create'; // 'create' or 'edit'

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initializeModal();
    loadTypes();
    loadData();
    attachEventListeners();
});

/**
 * Initialize Bootstrap modal
 */
function initializeModal() {
    const modalElement = document.getElementById('modal-origin');
    currentModal = new bootstrap.Modal(modalElement);
}

/**
 * Attach event listeners to buttons and filters
 */
function attachEventListeners() {
    // New Origin button
    document.getElementById('btn-new-origin').addEventListener('click', () => {
        openModal('create');
    });

    // Save button
    document.getElementById('btn-save-origin').addEventListener('click', saveData);

    // Filter inputs
    document.getElementById('filter-name').addEventListener('input', filterData);
    document.getElementById('filter-type').addEventListener('change', filterData);
}

/**
 * Load organization types from API
 */
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
            // Filter out types 1 and 2
            allTypes = data.data.filter(type => type.tor_id != 1 && type.tor_id != 2);
            populateTypeDropdowns();
        } else {
            console.error('Error loading types:', data.message);
            Swal.fire('Error', 'No se pudieron cargar los tipos de organización', 'error');
        }
    } catch (error) {
        console.error('Error loading types:', error);
        Swal.fire('Error', 'Error de conexión al cargar tipos', 'error');
    }
}

/**
 * Populate type dropdowns (filter and modal)
 */
function populateTypeDropdowns() {
    const filterSelect = document.getElementById('filter-type');
    const modalSelect = document.getElementById('origin-type');

    // Clear existing options (except the first one)
    filterSelect.innerHTML = '<option value="">Todos</option>';
    modalSelect.innerHTML = '<option value="">Seleccione un tipo</option>';

    // Add type options
    allTypes.forEach(type => {
        const filterOption = document.createElement('option');
        filterOption.value = type.tor_id;
        filterOption.textContent = type.tor_nombre;
        filterSelect.appendChild(filterOption);

        const modalOption = document.createElement('option');
        modalOption.value = type.tor_id;
        modalOption.textContent = type.tor_nombre;
        modalSelect.appendChild(modalOption);
    });
}

/**
 * Load organizations from API
 */
async function loadData() {
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
            console.error('Error loading data:', data.message);
            renderEmptyState('Error al cargar los datos');
        }
    } catch (error) {
        console.error('Error loading data:', error);
        renderEmptyState('Error de conexión');
    }
}

/**
 * Render the organizations table
 */
function renderTable(organizations) {
    const tbody = document.getElementById('table-body');

    if (!organizations || organizations.length === 0) {
        renderEmptyState('No se encontraron orígenes especiales');
        return;
    }

    tbody.innerHTML = '';

    organizations.forEach(org => {
        const row = document.createElement('tr');

        // Find type name
        const type = allTypes.find(t => t.tor_id == org.org_tipo_id);
        const typeName = type ? type.tor_nombre : 'N/A';

        row.innerHTML = `
            <td>${org.org_id}</td>
            <td>${org.org_nombre}</td>
            <td>${typeName}</td>
            <td>
                <button class="action-btn btn-edit" onclick="editOrganization(${org.org_id})">
                    <i data-feather="edit-2" style="width: 14px; height: 14px;"></i>
                    Editar
                </button>
                <button class="action-btn btn-delete" onclick="deleteOrganization(${org.org_id})">
                    <i data-feather="trash-2" style="width: 14px; height: 14px;"></i>
                    Eliminar
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });

    // Replace feather icons
    if (window.feather) {
        feather.replace();
    }
}

/**
 * Render empty state
 */
function renderEmptyState(message) {
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = `
        <tr>
            <td colspan="4" class="empty-state">
                <div>
                    <i data-feather="inbox"></i>
                    <p>${message}</p>
                </div>
            </td>
        </tr>
    `;
    if (window.feather) {
        feather.replace();
    }
}

/**
 * Filter data based on inputs
 */
function filterData() {
    const nameFilter = document.getElementById('filter-name').value.toLowerCase();
    const typeFilter = document.getElementById('filter-type').value;

    let filtered = allOrganizations;

    // Filter by name
    if (nameFilter) {
        filtered = filtered.filter(org =>
            org.org_nombre.toLowerCase().includes(nameFilter)
        );
    }

    // Filter by type
    if (typeFilter) {
        filtered = filtered.filter(org => org.org_tipo_id == typeFilter);
    }

    renderTable(filtered);
}

/**
 * Open modal for create or edit
 */
function openModal(mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalOriginLabel');
    const form = document.getElementById('form-origin');

    // Reset form
    form.reset();
    document.getElementById('origin-id').value = '';

    if (mode === 'create') {
        modalTitle.textContent = 'Nuevo Origen';
    } else if (mode === 'edit' && data) {
        modalTitle.textContent = 'Editar Origen';
        document.getElementById('origin-id').value = data.org_id;
        document.getElementById('origin-name').value = data.org_nombre;
        document.getElementById('origin-type').value = data.org_tipo_id;
    }

    currentModal.show();
}

/**
 * Edit organization
 */
window.editOrganization = function (id) {
    const org = allOrganizations.find(o => o.org_id == id);
    if (org) {
        openModal('edit', org);
    }
}

/**
 * Delete organization
 */
window.deleteOrganization = async function (id) {
    const result = await Swal.fire({
        title: '¿Está seguro?',
        text: 'Esta acción eliminará el origen especial',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (!result.isConfirmed) {
        return;
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'BORRAR',
                org_id: id
            })
        });

        const data = await response.json();

        if (data.status === 'success') {
            Swal.fire('Eliminado', data.message, 'success');
            loadData(); // Reload data
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch (error) {
        console.error('Error deleting organization:', error);
        Swal.fire('Error', 'Error de conexión al eliminar', 'error');
    }
}

/**
 * Save data (create or update)
 */
async function saveData() {
    const form = document.getElementById('form-origin');

    // Validate form
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

    if (currentMode === 'edit') {
        payload.org_id = parseInt(id);
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_desve.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (data.status === 'success') {
            Swal.fire('Éxito', data.message, 'success');
            currentModal.hide();
            loadData(); // Reload data
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch (error) {
        console.error('Error saving data:', error);
        Swal.fire('Error', 'Error de conexión al guardar', 'error');
    }
}
