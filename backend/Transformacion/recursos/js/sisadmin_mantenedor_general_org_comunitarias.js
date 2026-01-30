// Mantenedor General de Organizaciones Comunitarias
let allData = [];
let allTypes = [];
let currentModal = null;
let currentMode = 'create';

document.addEventListener('DOMContentLoaded', () => {
    initializeModal();
    initializeSelect2();
    loadTypes();
    loadContribuyentes(); // Populate legal representatives
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
    $('#entry-replegal').select2({
        dropdownParent: $('#modal-form'),
        language: {
            noResults: function () {
                return "No se encontraron resultados";
            }
        },
        placeholder: "Buscar representante por nombre o RUT"
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
    const entryRut = document.getElementById('entry-rut');
    if (entryRut) {
        entryRut.addEventListener('change', function () {
            this.value = formatRut(this.value);
        });
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
            allTypes = data.data;
            const select = document.getElementById('entry-tipo');
            select.innerHTML = '<option value="">Seleccione</option>';
            allTypes.forEach(type => {
                if (type.tor_id !== '3' && type.tor_id !== '4' && type.tor_id !== '5' && type.tor_id !== '6' && type.tor_id !== '7' && type.tor_id !== '8') {
                    const opt = document.createElement('option');
                    opt.value = type.tor_id;
                    opt.textContent = type.tor_nombre;
                    select.appendChild(opt);
                }
            });
        }
    } catch (error) {
        console.error('Error loading types:', error);
    }
}

async function loadContribuyentes() {
    try {
        const response = await fetch(`${window.API_BASE_URL}/contribuyentes_general.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const data = await response.json();
        if (data.status === 'success' && data.data) {
            // Populate Select2
            const select = $('#entry-replegal');
            select.empty();
            select.append(new Option("Seleccione contribuyente", ""));
            data.data.forEach(c => {
                const fullName = `${c.tgc_nombre} ${c.tgc_apellido_paterno} ${c.tgc_apellido_materno} (${c.tgc_rut})`;
                const option = new Option(fullName, c.tgc_id);
                select.append(option);
            });
        }
    } catch (error) {
        console.error('Error loading contribuyentes:', error);
    }
}

window.loadData = async function () {
    const tbody = document.getElementById('table-body');
    if (tbody) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-5"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Cargando datos...</td></tr>';
    }

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_comunitarias_general.php`, {
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

        let repLegalNombre = item.rep_rut ? `${item.tgc_nombre} ${item.tgc_apellido_paterno}` : 'N/A';
        let inscripcionDate = item.ogc_inscripcion ? new Date(item.ogc_inscripcion).toLocaleDateString() : 'N/A';
        let vigenciaDate = item.orgc_vigencia ? new Date(item.orgc_vigencia).toLocaleDateString() : 'N/A';

        row.innerHTML = `
            <td class="fw-bold">${item.orgc_rut}</td>
            <td>${item.orgc_nombre}</td>
            <td><span class="badge bg-light text-dark border fw-normal">${item.tipo_nombre || 'Desconocido'}</span></td>
            <td><small>${repLegalNombre}</small></td>
            <td><small>${inscripcionDate}</small></td>
            <td><small>${vigenciaDate}</small></td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="editItem(${item.orgc_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteItem(${item.orgc_id})">
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
        tbody.innerHTML = `<tr><td colspan="7" class="text-center py-5 text-muted small">${message}</td></tr>`;
    }
}

function filterData() {
    const filterVal = document.getElementById('filter-text').value.toLowerCase();

    const filtered = allData.filter(item => {
        const textMatch = !filterVal ||
            (item.orgc_rut && item.orgc_rut.toLowerCase().includes(filterVal)) ||
            (item.orgc_nombre && item.orgc_nombre.toLowerCase().includes(filterVal));
        return textMatch;
    });

    renderTable(filtered);
}

window.openModal = function (mode, data = null) {
    currentMode = mode;
    const modalTitle = document.getElementById('modalFormLabel');
    const form = document.getElementById('main-form');

    if (form) form.reset();
    $('#entry-replegal').val(null).trigger('change'); // Reset Select2
    const idInput = document.getElementById('entry-id');
    if (idInput) idInput.value = '';

    if (mode === 'create') {
        if (modalTitle) modalTitle.textContent = 'Nueva Organización';
    } else if (mode === 'edit' && data) {
        if (modalTitle) modalTitle.textContent = 'Editar Organización';
        if (idInput) idInput.value = data.orgc_id;

        document.getElementById('entry-rut').value = data.orgc_rut;
        document.getElementById('entry-nombre').value = data.orgc_nombre;
        document.getElementById('entry-tipo').value = data.orgc_tipo_organizacion;
        document.getElementById('entry-rpj').value = data.orgc_rpj;
        document.getElementById('entry-codigo').value = data.orgc_codigo;
        document.getElementById('entry-unidad').value = data.orgc_unidad_vecinal;

        // Date formatting for input type="date" and "datetime-local"
        if (data.ogc_inscripcion) {
            // Need 'YYYY-MM-DDTHH:MM' for datetime-local
            const d = new Date(data.ogc_inscripcion);
            // Simple format adjustment (or use library like moment.js if available, but manual string manipulation is safer without deps)
            // Assuming the API returns a standard SQL datetime string 'YYYY-MM-DD HH:MM:SS'
            document.getElementById('entry-inscripcion').value = data.ogc_inscripcion.replace(' ', 'T').slice(0, 16);
        }

        if (data.orgc_vigencia) {
            document.getElementById('entry-vigencia').value = data.orgc_vigencia;
        }

        $('#entry-replegal').val(data.ogc_rep_legal).trigger('change');
    }

    if (currentModal) currentModal.show();
}

window.editItem = function (id) {
    const item = allData.find(o => o.orgc_id == id);
    if (item) openModal('edit', item);
}

window.deleteItem = async function (id) {
    const result = await Swal.fire({
        title: '¿Eliminar registro?',
        text: 'Esta acción eliminará el registro permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch(`${window.API_BASE_URL}/organizaciones_comunitarias_general.php`, {
                method: 'POST',
                credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ ACCION: 'BORRAR', orgc_id: id })
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
    const form = document.getElementById('main-form');
    // Manual validation for Select2 (as it hides original select)
    if (!$('#entry-replegal').val()) {
        Swal.fire('Error', 'Debe seleccionar un Representante Legal', 'warning');
        return;
    }

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const id = document.getElementById('entry-id').value;
    const payload = {
        ACCION: currentMode === 'create' ? 'CREAR' : 'ACTUALIZAR',
        orgc_rut: document.getElementById('entry-rut').value,
        orgc_nombre: document.getElementById('entry-nombre').value,
        orgc_tipo_organizacion: document.getElementById('entry-tipo').value,
        ogc_rep_legal: $('#entry-replegal').val(),
        ogc_inscripcion: document.getElementById('entry-inscripcion').value,
        orgc_vigencia: document.getElementById('entry-vigencia').value,
        orgc_rpj: document.getElementById('entry-rpj').value,
        orgc_codigo: document.getElementById('entry-codigo').value,
        orgc_unidad_vecinal: document.getElementById('entry-unidad').value
    };

    if (currentMode === 'edit') payload.orgc_id = parseInt(id);

    try {
        const response = await fetch(`${window.API_BASE_URL}/organizaciones_comunitarias_general.php`, {
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
        console.error(error);
        Swal.fire('Error', 'Error de conexión.', 'error');
    }
}


function formatRut(rut) {
    if (!rut) return '';

    // Clean data, remove non-numeric or k
    let value = rut.replace(/[^0-9kK]/g, '');

    if (value.length <= 1) return value;

    // Split body and dv
    const dv = value.slice(-1).toUpperCase();
    let body = value.slice(0, -1);

    // Format body with dots
    body = body.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return `${body}-${dv}`;
}