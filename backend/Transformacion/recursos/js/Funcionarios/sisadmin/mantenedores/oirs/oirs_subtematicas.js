// Mantenedor de Subtemáticas OIRS
let allData = [];
let allTematicas = [];
let currentModal = null;
let currentMode = 'create';

document.addEventListener('DOMContentLoaded', () => {
    initializeModal();
    loadData();
    loadTematicas();
    attachEventListeners();
});

function initializeModal() {
    const modalElement = document.getElementById('modal-form');
    if (modalElement) {
        currentModal = new bootstrap.Modal(modalElement);
    }
}

function attachEventListeners() {
    const btnNew = document.getElementById('btn-new');
    if (btnNew) {
        btnNew.addEventListener('click', () => {
            openModal('create');
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
}

async function loadTematicas() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/trd_oirs_tematicas.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });

        const data = await response.json();
        if (data.status === 'success' && data.data) {
            allTematicas = data.data;
            const select = document.getElementById('entry-tem-id');
            if (select) {
                select.innerHTML = '<option value="" selected disabled>Seleccione temática...</option>';
                allTematicas.forEach(t => {
                    const opt = document.createElement('option');
                    opt.value = t.tem_id;
                    opt.textContent = t.tem_nombre;
                    select.appendChild(opt);
                });
            }
        }
    } catch (error) {
        console.error('Error loading tematicas:', error);
    }
}

window.loadData = async function () {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-5"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Cargando datos...</td></tr>';
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/trd_oirs_subtematicas.php`, {
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
            <td class="fw-bold text-muted">${item.sub_id}</td>
            <td><span class="badge bg-light text-dark border small">${item.tematica_nombre || 'Desconocida'}</span></td>
            <td>${item.sub_nombre}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="editItem(${item.sub_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.sub_id})">
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
            (item.sub_nombre && item.sub_nombre.toLowerCase().includes(filterVal)) ||
            (item.tematica_nombre && item.tematica_nombre.toLowerCase().includes(filterVal));
        return textMatch;
    });

    renderTable(filtered);
}

window.openModal = function (mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalFormLabel');
    const form = document.getElementById('main-form');

    if (form) form.reset();
    const idInput = document.getElementById('entry-id');
    if (idInput) idInput.value = '';

    if (mode === 'create') {
        if (modalTitle) modalTitle.textContent = 'Nueva Subtemática';
    } else if (mode === 'edit' && data) {
        if (modalTitle) modalTitle.textContent = 'Editar Subtemática';
        if (idInput) idInput.value = data.sub_id;
        document.getElementById('entry-tem-id').value = data.tem_id;
        document.getElementById('entry-nombre').value = data.sub_nombre;
    }

    if (currentModal) currentModal.show();
}

window.editItem = function (id) {
    const item = allData.find(o => o.sub_id == id);
    if (item) openModal('edit', item);
}

window.deleteItem = async function (id) {
    const result = await Swal.fire({
        title: '¿Eliminar subtemática?',
        text: 'Esta acción eliminará permanentemente el registro.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/trd_oirs_subtematicas.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'BORRAR', sub_id: id })
            });

            const data = await response.json();
            if (data.status === 'success') {
                Swal.fire('Éxito', 'Subtemática eliminada correctamente.', 'success');
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
    const form = document.getElementById('main-form');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const id = document.getElementById('entry-id').value;
    const temId = document.getElementById('entry-tem-id').value;
    const nombre = document.getElementById('entry-nombre').value;

    const payload = {
        ACCION: currentMode === 'create' ? 'CREAR' : 'ACTUALIZAR',
        tem_id: parseInt(temId),
        sub_nombre: nombre
    };

    if (currentMode === 'edit') payload.sub_id = parseInt(id);

    try {
        const response = await fetch(`${window.API_BASE_URL}/trd_oirs_subtematicas.php`, {
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
