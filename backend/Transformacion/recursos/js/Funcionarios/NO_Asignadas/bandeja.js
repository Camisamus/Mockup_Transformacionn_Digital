let funcionarios = [];
let allItems = [];
let tareasQueAsigne = [];
let currentPageBandeja = 1;
let currentPageAsigne = 1;
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
        const fetchUrl = `${window.API_BASE_URL}/general/bandeja.php`;

        const response = await fetch(fetchUrl, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "LISTAR_BANDEJA" })
        });

        if (response.status === 401) {
            window.logout();
            return;
        }

        // Cargar Funcionarios para búsqueda
        const respFunc = await fetch(`${window.API_BASE_URL}/general/funcionarios.php`, {
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

        const fetchUrl2 = '../api/general/tareas.php';
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
            console.error("Error loading assigned tasks:", result2.message);
        }

    } catch (e) {
        console.error("Error loading inbox:", e);
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error de conexión</td></tr>';
    }
});

function renderPage(page) {
    currentPageBandeja = page;
    const tbody = document.querySelector('#tablaBandeja tbody');

    // Calculate slice
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = allItems.slice(start, end);

    renderTable(paginatedItems, tbody);
    renderPagination(allItems.length, page);

    document.getElementById('totalTareas').innerText = allItems.length;

    // Improved atrasadas logic to avoid split issues if format varies
    const threeDaysAgo = new Date(Date.now() - 3 * 24 * 60 * 60 * 1000);
    document.getElementById('totalTareasAtrasadas').innerText = allItems.filter(item => {
        if (!item.fecha_original) return false;
        return new Date(item.fecha_original) < threeDaysAgo;
    }).length;

    // Update info text
    const infoDiv = document.querySelector('.pagination-info');
    if (infoDiv) {
        infoDiv.innerText = `Mostrando ${Math.min(start + 1, allItems.length)}-${Math.min(end, allItems.length)} de ${allItems.length} tareas`;
    }
}

function renderPageTareasqueasigne(page) {
    currentPageAsigne = page;
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
        tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">No hay tareas pendientes.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-slate-50/80 transition-all cursor-pointer group';

        // Status Color Mapping
        let statusClass = 'bg-slate-50 text-slate-600 border-slate-100';
        if (item.estado === 'Atrasada') statusClass = 'bg-rose-50 text-rose-600 border-rose-100';
        else if (item.estado === 'Completada') statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
        else if (item.estado === 'En Progreso') statusClass = 'bg-blue-50 text-blue-600 border-blue-100';
        else if (item.estado === 'Pendiente') statusClass = 'bg-amber-50 text-amber-600 border-amber-100';

        // Responsible Avatar logic
        const initials = 'YO'; // Static as per original code

        row.innerHTML = `
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span class="font-black text-slate-800 tracking-tight group-hover:text-primary-blue transition-colors">
                        ${item.asunto || 'Sin Asunto'}
                    </span>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mt-1">ID: #${item.id}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-wider">
                    ${item.origen}
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-primary-blue text-white rounded-full flex items-center justify-center text-[10px] font-bold shadow-sm">
                        ${initials}
                    </div>
                    <span class="text-sm font-semibold text-slate-600">Yo mismo</span>
                </div>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="text-sm font-medium text-slate-500">${item.fecha}</span>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="text-sm font-bold ${item.estado === 'Atrasada' ? 'text-rose-500' : 'text-slate-600'}">
                    ${item.fecha_limite || '-'}
                </span>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusClass}">
                    ${item.estado}
                </span>
            </td>
        `;

        row.addEventListener('click', () => {
            if (item.origen === 'DESVE') {
                window.location.href = `desve/consultar.php?id=${item.id}`;
            } else if (item.origen === 'Ingresos') {
                window.location.href = `ingresos/ver.php?id=${item.idcif}`;
            } else if (item.origen === 'Patentes') {
                Swal.fire('Info', 'Módulo de Patentes en construcción', 'info');
            } else if (item.origen === 'TAREAS') {
                Swal.fire({
                    title: item.asunto,
                    text: item.detalle,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#1a5f9c',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Terminar',
                    cancelButtonText: 'Cerrar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        ejecutarTerminarTarea(item.id);
                    }
                });
            }
        });

        tbody.appendChild(row);
    });
}

function renderTableTareasqueasigne(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">No hay tareas asignadas.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.className = 'hover:bg-slate-50/80 transition-all cursor-pointer group';

        const isTerminado = item.tar_estado != 0;
        const statusClass = isTerminado
            ? 'bg-emerald-50 text-emerald-600 border-emerald-100'
            : 'bg-amber-50 text-amber-600 border-amber-100';
        const statusLabel = isTerminado ? 'Terminado' : 'Pendiente';

        row.innerHTML = `
            <td class="px-6 py-4">
                <div class="flex flex-col">
                    <span class="font-black text-slate-800 tracking-tight group-hover:text-primary-blue transition-colors">
                        ${item.tar_titulo}
                    </span>
                    <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest mt-1">ID: #${item.tar_id}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-slate-700 text-white rounded-full flex items-center justify-center text-[10px] font-bold shadow-sm">
                        ${nombrefuncionario(item.tar_asignado).substring(0, 2).toUpperCase()}
                    </div>
                    <span class="text-sm font-semibold text-slate-600">${nombrefuncionario(item.tar_asignado)}</span>
                </div>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="text-sm font-medium text-slate-500">${fechaformato(item.tar_creacion)}</span>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="text-sm font-bold text-slate-600">${fechaformato(item.tar_plazo)}</span>
            </td>
            <td class="px-6 py-4 text-center">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border ${statusClass}">
                    ${statusLabel}
                </span>
            </td>
        `;

        row.addEventListener('click', () => {
            if (!isTerminado) {
                Swal.fire({
                    title: item.tar_titulo,
                    text: item.tar_detalle,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#1a5f9c',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Terminar',
                    cancelButtonText: 'Cerrar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        ejecutarTerminarTarea(item.tar_id);
                    }
                });
            }
        });
        tbody.appendChild(row);
    });
}

function renderPaginationTareasqueasigne(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const btnAnt = document.getElementById('btnAnteriorAsigne');
    const btnSig = document.getElementById('btnSiguienteAsigne');

    if (btnAnt) {
        btnAnt.disabled = currentPage === 1;
        btnAnt.onclick = (e) => {
            e.preventDefault();
            renderPageTareasqueasigne(currentPage - 1);
        };
    }
    if (btnSig) {
        btnSig.disabled = (currentPage === totalPages || totalPages === 0);
        btnSig.onclick = (e) => {
            e.preventDefault();
            renderPageTareasqueasigne(currentPage + 1);
        };
    }

    // Handle dynamic container if present
    const container = document.querySelector('#tablaTareasQueAsigne .pagination-controls');
    if (container) {
        container.innerHTML = '';
        // (Optional: add numbered page buttons here)
    }
}

function renderPagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const btnAnt = document.getElementById('btnAnterior');
    const btnSig = document.getElementById('btnSiguiente');

    if (btnAnt) {
        btnAnt.disabled = currentPage === 1;
        btnAnt.onclick = (e) => {
            e.preventDefault();
            renderPage(currentPage - 1);
        };
    }
    if (btnSig) {
        btnSig.disabled = (currentPage === totalPages || totalPages === 0);
        btnSig.onclick = (e) => {
            e.preventDefault();
            renderPage(currentPage + 1);
        };
    }

    // Handle dynamic container if present
    const container = document.querySelector('#tablaBandeja .pagination-controls');
    if (container) {
        container.innerHTML = '';
        // (Optional: add numbered page buttons here)
    }
}

function toggleRow(rowId, event) {
    event.stopPropagation();
    const row = document.getElementById(rowId);
    if (!row) return;
    if (row.style.display === 'none') {
        row.style.display = 'table-row';
        event.currentTarget.innerHTML = '<i data-feather="minus-circle"></i>';
    } else {
        row.style.display = 'none';
        event.currentTarget.innerHTML = '<i data-feather="plus-circle"></i>';
    }
    if (window.feather) feather.replace();
}

window.toggleRow = toggleRow;


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
    const fetchUrl = '../api/general/tareas.php';
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
    const fetchUrl = '../api/general/tareas.php';
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