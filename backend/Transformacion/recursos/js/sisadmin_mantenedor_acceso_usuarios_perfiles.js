// Mantenedor de Asignación Usuarios/Perfiles
let allData = [];
let usuarios = [];
let perfiles = [];
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
    $('#entry-usuario, #entry-perfil, #entry-subrogante').select2({
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
        const [resU, resP] = await Promise.all([
            fetch(`${window.API_BASE_URL}/usuarios_acceso.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }),
            fetch(`${window.API_BASE_URL}/perfiles_acceso.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            })
        ]);

        const dataU = await resU.json();
        const dataP = await resP.json();

        if (dataU.status === 'success') {
            usuarios = dataU.data;
            const selectU = document.getElementById('entry-usuario');
            const selectS = document.getElementById('entry-subrogante');
            usuarios.forEach(u => {
                const label = `${u.usr_nombre} ${u.usr_apellido} (${u.usr_rut})`;
                selectU.add(new Option(label, u.usr_id));
                selectS.add(new Option(label, u.usr_id));
            });
        }

        if (dataP.status === 'success') {
            perfiles = dataP.data;
            const selectP = document.getElementById('entry-perfil');
            perfiles.forEach(p => {
                selectP.add(new Option(p.prf_nombre, p.prf_id));
            });
        }
    } catch (error) {
        console.error('Error loading dependencies:', error);
    }
}

window.loadData = async function () {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-5"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Cargando datos...</td></tr>';
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/usuarios_perfiles_acceso.php`, {
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
        const fInicio = item.usp_fecha_inicio ? new Date(item.usp_fecha_inicio).toLocaleDateString() : 'N/A';
        const fTermino = item.usp_fecha_termino ? new Date(item.usp_fecha_termino).toLocaleDateString() : 'Indefinida';
        const subrogante = item.subrogante_nombre ? `${item.subrogante_nombre} ${item.subrogante_apellido}` : '-';

        row.innerHTML = `
            <td><span class="fw-bold">${item.usuario_nombre} ${item.usuario_apellido}</span></td>
            <td><span class="badge bg-light text-dark border fw-normal">${item.perfil_nombre}</span></td>
            <td><small>${fInicio} - ${fTermino}</small></td>
            <td><small>${subrogante}</small></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="editItem(${item.usp_usuario_id}, ${item.usp_perfil_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.usp_usuario_id}, ${item.usp_perfil_id})">
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
        tbody.innerHTML = `<tr><td colspan="5" class="text-center py-5 text-muted small">${message}</td></tr>`;
    }
}

function filterData() {
    const filterVal = document.getElementById('filter-text').value.toLowerCase();
    const filtered = allData.filter(item => {
        const textMatch = !filterVal ||
            (`${item.usuario_nombre} ${item.usuario_apellido}`).toLowerCase().includes(filterVal) ||
            item.perfil_nombre.toLowerCase().includes(filterVal);
        return textMatch;
    });
    renderTable(filtered);
}

window.openModal = function (mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalFormLabel');
    const form = document.getElementById('main-form');

    if (form) form.reset();
    $('#entry-usuario, #entry-perfil, #entry-subrogante').val(null).trigger('change');

    if (mode === 'create') {
        if (modalTitle) modalTitle.textContent = 'Nueva Asignación';
        $('#entry-usuario, #entry-perfil').prop('disabled', false);
    } else if (mode === 'edit' && data) {
        if (modalTitle) modalTitle.textContent = 'Editar Asignación';
        $('#entry-usuario').val(data.usp_usuario_id).trigger('change').prop('disabled', true);
        $('#entry-perfil').val(data.usp_perfil_id).trigger('change').prop('disabled', true);

        if (data.usp_fecha_inicio) document.getElementById('entry-inicio').value = data.usp_fecha_inicio.replace(' ', 'T').slice(0, 16);
        if (data.usp_fecha_termino) document.getElementById('entry-termino').value = data.usp_fecha_termino.replace(' ', 'T').slice(0, 16);
        if (data.usp_usuario_subrogante_id) $('#entry-subrogante').val(data.usp_usuario_subrogante_id).trigger('change');
    }

    if (currentModal) currentModal.show();
}

window.editItem = function (usr_id, prf_id) {
    const item = allData.find(o => o.usp_usuario_id == usr_id && o.usp_perfil_id == prf_id);
    if (item) openModal('edit', item);
}

window.deleteItem = async function (usr_id, prf_id) {
    const result = await Swal.fire({
        title: '¿Eliminar asignación?',
        text: 'El usuario perderá este perfil.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/usuarios_perfiles_acceso.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'BORRAR',
                    usp_usuario_id: usr_id,
                    usp_perfil_id: prf_id
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
    const usuario = document.getElementById('entry-usuario').value;
    const perfil = document.getElementById('entry-perfil').value;
    const inicio = document.getElementById('entry-inicio').value;
    const termino = document.getElementById('entry-termino').value;
    const subrogante = document.getElementById('entry-subrogante').value;

    if (!usuario || !perfil) {
        Swal.fire('Atención', 'Seleccione usuario y perfil', 'warning');
        return;
    }

    const payload = {
        ACCION: currentMode === 'create' ? 'CREAR' : 'ACTUALIZAR',
        usp_usuario_id: parseInt(usuario),
        usp_perfil_id: parseInt(perfil),
        usp_fecha_inicio: inicio || null,
        usp_fecha_termino: termino || null,
        usp_usuario_subrogante_id: subrogante ? parseInt(subrogante) : null
    };

    try {
        const response = await fetch(`${window.API_BASE_URL}/usuarios_perfiles_acceso.php`, {
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
