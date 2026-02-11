// Mantenedor de Asignación Usuarios/Áreas
let allData = [];
let usuarios = [];
let areas = [];
let currentModal = null;
let currentMode = 'create';

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
    $('#entry-usuario, #entry-area').select2({
        dropdownParent: $('#modal-form')
    });
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

async function loadDependencies() {
    try {
        const [resU, resA] = await Promise.all([
            fetch(`${window.API_BASE_URL}/usuarios_acceso.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }),
            fetch(`${window.API_BASE_URL}/areas_general.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            })
        ]);

        const dataU = await resU.json();
        const dataA = await resA.json();

        if (dataU.status === 'success') {
            usuarios = dataU.data;
            const selectU = document.getElementById('entry-usuario');
            usuarios.forEach(u => {
                const label = `${u.usr_nombre} ${u.usr_apellido} (${u.usr_rut})`;
                selectU.add(new Option(label, u.usr_id));
            });
        }

        if (dataA.status === 'success') {
            areas = dataA.data;
            const selectA = document.getElementById('entry-area');
            areas.forEach(a => {
                selectA.add(new Option(a.tga_nombre, a.tga_id));
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
        const response = await fetch(`${window.API_BASE_URL}/areas_usuarios_general.php`, {
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
        const badgeClass = item.tgau_estado == 1 ? 'bg-success' : 'bg-secondary';
        const badgeLabel = item.tgau_estado == 1 ? 'Activo' : 'Inactivo';

        row.innerHTML = `
            <td><span class="fw-bold">${item.usuario_nombre} ${item.usuario_apellido}</span></td>
            <td><span class="badge bg-light text-dark border fw-normal">${item.area_nombre}</span></td>
            <td><span class="badge ${badgeClass}">${badgeLabel}</span></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="editItem(${item.tgau_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.tgau_id})">
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
            (`${item.usuario_nombre} ${item.usuario_apellido}`).toLowerCase().includes(filterVal) ||
            item.area_nombre.toLowerCase().includes(filterVal);
        return textMatch;
    });
    renderTable(filtered);
}

window.openModal = function (mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalFormLabel');
    const form = document.getElementById('main-form');

    if (form) form.reset();
    $('#entry-usuario, #entry-area').val(null).trigger('change');

    if (mode === 'create') {
        if (modalTitle) modalTitle.textContent = 'Nueva Asignación';
        document.getElementById('entry-id').value = '';
        document.getElementById('entry-estado').value = '1';
    } else if (mode === 'edit' && data) {
        if (modalTitle) modalTitle.textContent = 'Editar Asignación';
        document.getElementById('entry-id').value = data.tgau_id;
        $('#entry-usuario').val(data.tgau_usuario).trigger('change');
        $('#entry-area').val(data.tgau_area).trigger('change');
        document.getElementById('entry-estado').value = data.tgau_estado;
    }

    if (currentModal) currentModal.show();
}

window.editItem = function (id) {
    const item = allData.find(o => o.tgau_id == id);
    if (item) openModal('edit', item);
}

window.deleteItem = async function (id) {
    const result = await Swal.fire({
        title: '¿Eliminar asignación?',
        text: 'Se eliminará permanentemente la relación del usuario con el área.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/areas_usuarios_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'BORRAR',
                    tgau_id: id
                })
            });

            const data = await response.json();
            if (data.status === 'success') {
                Swal.fire('Éxito', 'Asignación eliminada.', 'success');
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
    const id = document.getElementById('entry-id').value;
    const usuario = document.getElementById('entry-usuario').value;
    const area = document.getElementById('entry-area').value;
    const estado = document.getElementById('entry-estado').value;

    if (!usuario || !area) {
        Swal.fire('Atención', 'Seleccione usuario y área', 'warning');
        return;
    }

    const payload = {
        ACCION: currentMode === 'create' ? 'CREAR' : 'ACTUALIZAR',
        tgau_id: id,
        tgau_usuario: parseInt(usuario),
        tgau_area: parseInt(area),
        tgau_estado: parseInt(estado)
    };

    try {
        const response = await fetch(`${window.API_BASE_URL}/areas_usuarios_general.php`, {
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
