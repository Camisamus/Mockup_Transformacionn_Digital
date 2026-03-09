// Mantenedor de Gestión de Roles OIRS
let allData = [];
let fnsData = [];
let areasData = [];
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
    $('#entry-funcionario, #entry-area').select2({
        dropdownParent: $('#modal-form'),
        theme: 'bootstrap-5'
    });
}

function attachEventListeners() {
    const btnNew = document.getElementById('btn-new');
    if (btnNew) {
        btnNew.addEventListener('click', () => {
            if (currentModal) {
                document.getElementById('main-form').reset();
                $('#entry-funcionario, #entry-area').val(null).trigger('change');
                document.getElementById('entry-jefe').checked = false;
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
}

async function loadDependencies() {
    try {
        const [resF, resA] = await Promise.all([
            fetch(`${window.API_BASE_URL}/general/funcionarios.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            }),
            fetch(`${window.API_BASE_URL}/sisadmin/mantenedores/general/areas_general.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'CONSULTAM' })
            })
        ]);

        const dataF = await resF.json();
        const dataA = await resA.json();

        if (dataF.status === 'success') {
            fnsData = dataF.data;
            const select = document.getElementById('entry-funcionario');
            fnsData.forEach(f => {
                const opt = new Option(`${f.fnc_nombre} ${f.fnc_apellido}`, f.fnc_id);
                select.add(opt);
            });
        }

        if (dataA.status === 'success') {
            areasData = dataA.data;
            const select = document.getElementById('entry-area');
            areasData.forEach(a => {
                const opt = new Option(a.tga_nombre, a.tga_id);
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
        const response = await fetch(`${window.API_BASE_URL}/oirs/roles_oirs.php`, {
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
        const esJefe = parseInt(item.ofa_p) === 1;
        row.innerHTML = `
            <td>
                <div class="fw-bold">${item.usuario_nombre} ${item.usuario_apellid}</div>
                <small class="text-muted">ID: ${item.ofa_funcionario}</small>
            </td>
            <td>${item.area_nombre}</td>
            <td class="text-center">
                <span class="badge ${esJefe ? 'bg-success' : 'bg-light text-dark border'}">
                    ${esJefe ? 'SÍ' : 'NO'}
                </span>
            </td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.ofa_funcionario}, ${item.ofa_area})">
                    <i data-feather="trash-2"></i>
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
        const fullFn = `${item.usuario_nombre} ${item.usuario_apellid}`.toLowerCase();
        const areaName = (item.area_nombre || '').toLowerCase();

        return !filterVal ||
            fullFn.includes(filterVal) ||
            areaName.includes(filterVal);
    });

    renderTable(filtered);
}

window.deleteItem = async function (funcionario_id, area_id) {
    const result = await Swal.fire({
        title: '¿Eliminar asignación?',
        text: 'Se eliminará el vínculo del funcionario con esta área.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/oirs/roles_oirs.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'BORRAR',
                    ofa_funcionario: funcionario_id,
                    ofa_area: area_id
                })
            });

            const data = await response.json();
            if (data.status === 'success') {
                Swal.fire('Éxito', 'Asignación eliminada correctamente.', 'success');
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
    const fn_id = document.getElementById('entry-funcionario').value;
    const area_id = document.getElementById('entry-area').value;
    const es_jefe = document.getElementById('entry-jefe').checked ? 1 : 0;

    if (!fn_id || !area_id) {
        Swal.fire('Atención', 'Seleccione funcionario y área', 'warning');
        return;
    }

    Swal.fire({
        title: 'Procesando...',
        text: 'Guardando asignación...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        const payload = {
            ACCION: 'CREAR',
            ofa_funcionario: parseInt(fn_id),
            ofa_area: parseInt(area_id),
            ofa_p: es_jefe
        };

        const response = await fetch(`${window.API_BASE_URL}/oirs/roles_oirs.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (data.status === 'success') {
            await Swal.fire('Éxito', 'Asignación creada correctamente.', 'success');
            if (currentModal) currentModal.hide();
            loadData();
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch (error) {
        console.error('Save error:', error);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
}
