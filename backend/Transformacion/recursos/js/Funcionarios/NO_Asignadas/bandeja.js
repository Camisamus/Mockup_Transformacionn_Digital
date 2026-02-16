
let funcionarios = [];
let allItems = [];
let tareasQueAsigne = [];
let currentPage = 1;
const itemsPerPage = 5; // Mostrar 5 items por página
// Modals
let modalBusqueda = null;
let modalCrearTarea = null;

document.addEventListener('DOMContentLoaded', async function () {
    modalBusqueda = new bootstrap.Modal(document.getElementById('modalBusquedaFuncionario'));
    modalCrearTarea = new bootstrap.Modal(document.getElementById('modalCrearTarea'));

    // Cargar datos de la bandeja
    const API_BASE_URL = window.API_BASE_URL || (window.location.origin + '/transformacion/api');
    const tbody = document.querySelector('#tablaBandeja tbody');

    // Clear loading/static
    tbody.innerHTML = '<tr><td colspan="6" class="text-center">Cargando bandeja...</td></tr>';

    try {
        // Fetch Inbox
        // Use relative path which is robust in this structure (Funcionarios/ -> api/)
        const fetchUrl = '../api/bandeja.php';

        const response = await fetch(fetchUrl, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "LISTAR_BANDEJA" })
        });

        if (response.status === 401) {
            // Redirect or handle unauth
            window.logout();
            //window.location.href = 'index.php';
            return;
        }
        // Cargar Funcionarios para búsqueda
        const respFunc = await fetch(`${window.API_BASE_URL}/funcionarios.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: 'CONSULTAM' })
        });
        const resultFunc = await respFunc.json();
        if (resultFunc.status === 'success') {
            funcionarios = resultFunc.data;
        }

        const result = await response.json();

        if (result.status === 'success') {
            allItems = result.data;
            renderPage(1);
        } else {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }
        const fetchUrl2 = '../api/tareas.php';

        const response2 = await fetch(fetchUrl2, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "LISTAR" })
        });

        const result2 = await response2.json();

        if (result2.status === 'success') {
            tareasQueAsigne = result2.data;
            renderPageTareasqueasigne(1);
        } else {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }

    } catch (e) {
        console.error("Error loading inbox:", e);
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error de conexión</td></tr>';
    }
});

function renderPage(page) {
    currentPage = page;
    const tbody = document.querySelector('#tablaBandeja tbody');

    // Calculate slice
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = allItems.slice(start, end);

    renderTable(paginatedItems, tbody);
    renderPagination(allItems.length, page);
    document.getElementById('totalTareas').innerText = allItems.length;
    document.getElementById('totalTareasAtrasadas').innerText = allItems.filter(item => new Date(item.fecha.split('-').reverse().join('-')) < new Date(Date.now() - 3 * 24 * 60 * 60 * 1000)).length;
    // Update info text
    const infoDiv = document.querySelector('.pagination-info');
    if (infoDiv) {
        infoDiv.innerText = `Mostrando ${Math.min(start + 1, allItems.length)}-${Math.min(end, allItems.length)} de ${allItems.length} tareas`;
    }
}

function renderPageTareasqueasigne(page) {
    currentPage = page;
    const tbody = document.querySelector('#tablaTareasQueAsigne tbody');

    // Calculate slice
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = tareasQueAsigne.slice(start, end);

    renderTableTareasqueasigne(paginatedItems, tbody);
    renderPaginationTareasqueasigne(tareasQueAsigne.length, page);
    // Update info text
    const infoDiv = document.querySelector('#paginationInfoTareasQueAsigne');
    if (infoDiv) {
        infoDiv.innerText = `Mostrando ${Math.min(start + 1, tareasQueAsigne.length)}-${Math.min(end, tareasQueAsigne.length)} de ${tareasQueAsigne.length} tareas`;
    }
}

function renderTable(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">No hay tareas pendientes.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.style.cursor = 'pointer';

        // Add ID for expansion mapping
        const rowId = `row-${Math.random().toString(36).substr(2, 9)}`;
        row.dataset.bsTarget = `#${rowId}`;

        // Status Badge Logic
        let statusClass = 'status-pendiente';
        if (item.estado === 'Atrasada') statusClass = 'status-atrasada';
        else if (item.estado === 'Completada') statusClass = 'status-completada';
        else if (item.estado === 'En Progreso') statusClass = 'status-en-progreso';

        // Responsible
        const respHTML = `
            <div class="responsible-cell">
                <div class="user-avatar avatar-blue">YO</div>
                <span>Mí mismo</span>
            </div>`;

        // Main Row Content
        // We ensure "d-none d-md-table-cell" for columns we want to hide on mobile
        row.innerHTML = `
            <td class="task-title fw-bold text-primary">
                ${item.asunto || 'Sin Asunto'}
            </td>
            <td>${item.origen}</td> 
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary  rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 10px;">YO</div>
                    <span>Yo mismo</span>
                </div>
            </td>
            <td>${item.fecha}</td>
            <td>${item.fecha_limite || '-'}</td>
            <td><span class="badge ${item.estado === 'Atrasada' ? 'bg-danger' : (item.estado === 'Completada' ? 'bg-success' : 'bg-warning text-dark')} fw-normal">${item.estado}</span></td>
        `;

        // Navigation on row click (excluding the toggle button)
        row.addEventListener('click', (e) => {
            if (e.target.closest('button')) return; // Ignore if clicked toggle

            if (item.origen === 'DESVE') {
                window.location.href = `desve/desve_consultar.php?id=${item.id}`;
            } else if (item.origen === 'Ingresos') {
                window.location.href = `ingresos/ingr_consultar.php?id=${item.id}`;
            } else if (item.origen === 'Patentes') {
                Swal.fire('Info', 'Módulo de Patentes en construcción', 'info');
            } else if (item.origen === 'TAREAS') {
                Swal.fire({
                    title: item.asunto,
                    text: item.detalle, // Aquí muestras el detalle que mencionabas
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Terminar',
                    cancelButtonText: 'Cerrar',
                    reverseButtons: true // Opcional: pone el botón de confirmar a la derecha
                }).then((result) => {
                    if (result.isConfirmed) {
                        ejecutarTerminarTarea(item.id);
                    }
                });
            } else {
                Swal.fire('Info', `Navegación para ${item.origen} no definida.`, 'info');
            }
        });

        tbody.appendChild(row);

        // Expanded Row (Hidden by default)
        const expandedRow = document.createElement('tr');
        expandedRow.id = rowId;
        expandedRow.classList.add('d-md-none'); // Only for mobile
        expandedRow.style.display = 'none';
        expandedRow.style.backgroundColor = '#f8f9fa';

        expandedRow.innerHTML = `
            <td colspan="6">
                <div class="p-3">
                    <p><strong>Rol en tarea:</strong> ${item.origen}</p>
                    <p><strong>Responsable:</strong> Mí mismo</p>
                    <p><strong>Proyecto/Sector:</strong> ${item.origen}</p>
                    <p><strong>Entrega:</strong> ${item.fecha}</p>
                    <button class="btn btn-sm btn-primary mt-2" onclick="
                        if('${item.origen}' === 'DESVE') window.location.href = 'desve/desve_consultar.php?id=${item.id}';
                        else if ('${item.origen}' === 'Ingresos') window.location.href = 'ingresos/ingr_consultar.php?id=${item.id}';
                        else Swal.fire('Info', 'Módulo en construcción', 'info');
                    ">Ver Detalle</button>
                </div>
            </td>
        `;
        tbody.appendChild(expandedRow);
    });

    if (window.feather) feather.replace();
}

function renderTableTareasqueasigne(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">No hay tareas pendientes.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.style.cursor = 'pointer';

        // Add ID for expansion mapping
        const rowId = `row-${Math.random().toString(36).substr(2, 9)}`;
        row.dataset.bsTarget = `#${rowId}`;

        // Main Row Content
        let rowContent = ``;
        if (item.tar_estado == 0) {
            rowContent = `
            <td>${item.tar_titulo}</td>
            <td>${nombrefuncionario(item.tar_asignado)}</td>
            <td>${fechaformato(item.tar_fecha_creacion)}</td>
            <td>${fechaformato(item.tar_plazo)}</td>
            <td><span class="badge bg-warning text-dark">Pendiente</span></td>
        `;
        } else {
            rowContent = `
            <td>${item.tar_titulo}</td>
            <td>${nombrefuncionario(item.tar_asignado)}</td>
            <td>${fechaformato(item.tar_fecha_creacion)}</td>
            <td>${fechaformato(item.tar_plazo)}</td>
            <td><span class="badge bg-success text-dark">Terminado</span></td>
        `;
        }

        row.innerHTML = rowContent;

        // Navigation on row click (excluding the toggle button)
        row.addEventListener('click', (e) => {
            if (item.tar_estado == 0) {
                Swal.fire({
                    title: item.tar_titulo,
                    text: item.tar_detalle, // Aquí muestras el detalle que mencionabas
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Terminar',
                    cancelButtonText: 'Cerrar',
                    reverseButtons: true // Opcional: pone el botón de confirmar a la derecha
                }).then((result) => {
                    if (result.isConfirmed) {
                        ejecutarTerminarTarea(item.tar_id);
                    }
                });
            }
        });
        tbody.appendChild(row);

    });

    if (window.feather) feather.replace();
}

function renderPaginationTareasqueasigne(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    // Simplified pagination for the new UI buttons
    const container = document.querySelector('.pagination-controls');

    if (!container) return; // Should allow this gracefully

    container.innerHTML = '';
    const btnAnt = document.getElementById('btnAnterior');
    const btnSig = document.getElementById('btnSiguiente');

    if (btnAnt) {
        btnAnt.disabled = currentPage === 1;
        btnAnt.onclick = () => renderPageTareasqueasigne(currentPage - 1);
    }
    if (btnSig) {
        btnSig.disabled = currentPage === totalPages;
        btnSig.onclick = () => renderPageTareasqueasigne(currentPage + 1);
    }

    // Page Numbers (simplified: just current of total)
    /* 
    // If we wanted numbered buttons:
    for (let i = 1; i <= totalPages; i++) {
        // ...
    } 
    */

    // Previous Button

}

function toggleRow(rowId, event) {
    event.stopPropagation();
    const row = document.getElementById(rowId);
    if (row.style.display === 'none') {
        row.style.display = 'table-row';
        event.currentTarget.innerHTML = '<i data-feather="minus-circle"></i>';
    } else {
        row.style.display = 'none';
        event.currentTarget.innerHTML = '<i data-feather="plus-circle"></i>';
    }
    if (window.feather) feather.replace();
}

// Global scope for toggleRow
window.toggleRow = toggleRow;

function renderPagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    // Simplified pagination for the new UI buttons
    const container = document.querySelector('.pagination-controls');

    if (!container) return; // Should allow this gracefully

    container.innerHTML = '';
    const btnAnt = document.getElementById('btnAnterior');
    const btnSig = document.getElementById('btnSiguiente');

    if (btnAnt) {
        btnAnt.disabled = currentPage === 1;
        btnAnt.onclick = () => renderPage(currentPage - 1);
    }
    if (btnSig) {
        btnSig.disabled = currentPage === totalPages;
        btnSig.onclick = () => renderPage(currentPage + 1);
    }

    // Page Numbers (simplified: just current of total)
    /* 
    // If we wanted numbered buttons:
    for (let i = 1; i <= totalPages; i++) {
        // ...
    } 
    */

    // Previous Button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'btn btn-sm btn-outline-secondary px-3';
    prevBtn.innerText = 'Anterior';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => renderPage(currentPage - 1);
    container.appendChild(prevBtn);


    // Next Button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'btn btn-sm btn-outline-secondary px-3';
    nextBtn.innerText = 'Siguiente';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => renderPage(currentPage + 1);
    container.appendChild(nextBtn);
}


function abrirModalCrearTarea() {
    document.getElementById('tar_plazo').value = obtenerProximoLunes8AM();
    document.getElementById('responsable').value = JSON.parse(localStorage.getItem('user_data')).user.nombre;
    document.getElementById('usr_id').value = JSON.parse(localStorage.getItem('user_data')).user.id;
    modalCrearTarea.show();
}
function abrirModalBuscarFuncionario() {
    document.getElementById('buscar_fnc_input').value = '';
    renderizarBusquedaFuncionarios('');
    modalBusqueda.show();
}

function renderizarBusquedaFuncionarios(filtro) {
    const tbody = document.getElementById('lista_busqueda_fnc');
    tbody.innerHTML = '';

    const term = filtro.toLowerCase();
    const filtrados = funcionarios.filter(f =>
        f.fnc_nombre.toLowerCase().includes(term) ||
        f.fnc_apellido.toLowerCase().includes(term) ||
        (f.fnc_email && f.fnc_email.toLowerCase().includes(term))
    );

    filtrados.forEach(f => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${f.fnc_id || '-'}</td>
            <td>${f.fnc_email || '-'}</td>
            <td>${(f.fnc_nombre).toUpperCase()}</td>
            <td>${(f.fnc_apellido).toUpperCase()}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-primary" onclick="seleccionarFuncionario(${f.fnc_id}, '${f.fnc_nombre} ${f.fnc_apellido}')">
                    <i data-feather="plus"></i> Seleccionar
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
    if (window.feather) window.feather.replace();
}

function seleccionarFuncionario(id, nombre) {
    document.getElementById('usr_id').value = id;
    document.getElementById('responsable').value = nombre;
    modalBusqueda.hide();
}
function obtenerProximoLunes8AM() {
    const fecha = new Date();
    const diaActual = fecha.getDay();

    // Calculamos días hasta el próximo lunes
    let diasHastaLunes = (1 - diaActual + 7) % 7;
    if (diasHastaLunes === 0) diasHastaLunes = 7;

    fecha.setDate(fecha.getDate() + diasHastaLunes);
    fecha.setHours(8, 0, 0, 0);

    // Formatear a YYYY-MM-DDTHH:mm (formato ISO local)
    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, '0');
    const dia = String(fecha.getDate()).padStart(2, '0');
    const horas = String(fecha.getHours()).padStart(2, '0');
    const minutos = String(fecha.getMinutes()).padStart(2, '0');

    return `${anio}-${mes}-${dia}T${horas}:${minutos}`;
}

function guardarTarea() {
    const formData = new FormData(document.getElementById('form-crear-tarea'));
    const data = {};
    data['ACCION'] = 'CREAR';
    formData.forEach((value, key) => data[key] = value);

    console.log('Datos a enviar:', data);

    // Aquí harás tu fetch a la API

    // Use relative path which is robust in this structure (Funcionarios/ -> api/)
    const fetchUrl = '../api/tareas.php';
    fetch(fetchUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                Swal.fire('¡Éxito!', 'Tarea creada correctamente', 'success');
                modalCrearTarea.hide();
                window.location.reload();
            } else {
                Swal.fire('Error', result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Error de conexión', 'error');
        });

}
function ejecutarTerminarTarea(id) {
    const data = {};
    data['ACCION'] = 'TERMINAR';
    data['tar_id'] = id;
    const fetchUrl = '../api/tareas.php';
    fetch(fetchUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                Swal.fire('¡Éxito!', 'Tarea terminada correctamente', 'success');
                window.location.reload();
            } else {
                Swal.fire('Error', result.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Error de conexión', 'error');
        });
} function nombrefuncionario(id) {
    // Buscamos al funcionario que coincida con el id
    const funcionario = funcionarios.find(f => f.fnc_id == id);

    // Si lo encuentra, retorna el nombre, si no, un mensaje o string vacío
    return funcionario ? `${funcionario.fnc_nombre} ${funcionario.fnc_apellido}` : "No encontrado";
}
function fechaformato(fecha1) {
    const fecha = new Date(fecha1);
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    return `${dia}/${mes}/${anio}`;
}