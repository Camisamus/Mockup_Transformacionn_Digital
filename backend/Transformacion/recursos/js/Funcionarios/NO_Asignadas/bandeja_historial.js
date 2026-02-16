
let allItems = [];
let currentPage = 1;
const itemsPerPage = 10;
let modalFiltrar = null;
let fechaInicio = null;
let fechaFin = null;

document.addEventListener('DOMContentLoaded', async function () {
    modalFiltrar = new bootstrap.Modal(document.getElementById('modalFiltrarFechas'));

    // Set default dates (last 30 days)
    const hoy = new Date();
    const hace30Dias = new Date();
    hace30Dias.setDate(hoy.getDate() - 30);

    document.getElementById('fechaFin').value = formatDateForInput(hoy);
    document.getElementById('fechaInicio').value = formatDateForInput(hace30Dias);

    // Load initial data
    await cargarHistorial();

    // Event listeners
    document.getElementById('btnFiltrar').addEventListener('click', () => {
        modalFiltrar.show();
    });

    document.getElementById('btnAplicarFiltro').addEventListener('click', async () => {
        fechaInicio = document.getElementById('fechaInicio').value;
        fechaFin = document.getElementById('fechaFin').value;

        if (!fechaInicio || !fechaFin) {
            Swal.fire('Error', 'Debe seleccionar ambas fechas', 'error');
            return;
        }

        if (new Date(fechaInicio) > new Date(fechaFin)) {
            Swal.fire('Error', 'La fecha de inicio debe ser anterior a la fecha fin', 'error');
            return;
        }

        modalFiltrar.hide();
        await cargarHistorial(fechaInicio, fechaFin);
        actualizarRangoFechas(fechaInicio, fechaFin);
    });

    document.getElementById('btnLimpiarFiltro').addEventListener('click', async () => {
        // Reset to last 30 days
        const hoy = new Date();
        const hace30Dias = new Date();
        hace30Dias.setDate(hoy.getDate() - 30);

        document.getElementById('fechaFin').value = formatDateForInput(hoy);
        document.getElementById('fechaInicio').value = formatDateForInput(hace30Dias);

        fechaInicio = null;
        fechaFin = null;

        modalFiltrar.hide();
        await cargarHistorial();
        document.getElementById('rangoFechas').innerText = 'Últimos 30 días';
    });
});

async function cargarHistorial(inicio = null, fin = null) {
    const tbody = document.querySelector('#tablaBandeja tbody');
    tbody.innerHTML = '<tr><td colspan="6" class="text-center">Cargando historial...</td></tr>';

    try {
        const fetchUrl = '../api/bandeja_historial.php';

        const requestBody = {
            ACCION: "LISTAR_HISTORIAL"
        };

        if (inicio && fin) {
            requestBody.fecha_inicio = inicio;
            requestBody.fecha_fin = fin;
        }

        const response = await fetch(fetchUrl, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(requestBody)
        });

        if (response.status === 401) {
            window.logout();
            return;
        }

        const result = await response.json();

        if (result.status === 'success') {
            allItems = result.data;
            renderPage(1);
            actualizarKPIs();
        } else {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }

    } catch (e) {
        console.error("Error loading history:", e);
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error de conexión</td></tr>';
    }
}

function renderPage(page) {
    currentPage = page;
    const tbody = document.querySelector('#tablaBandeja tbody');

    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = allItems.slice(start, end);

    renderTable(paginatedItems, tbody);
    renderPagination(allItems.length, page);

    const infoDiv = document.querySelector('.pagination-info');
    if (infoDiv) {
        infoDiv.innerText = `Mostrando ${Math.min(start + 1, allItems.length)}-${Math.min(end, allItems.length)} de ${allItems.length} solicitudes`;
    }
}

function renderTable(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay solicitudes cerradas en este período.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.style.cursor = 'pointer';

        // Determine badge color based on origin
        let badgeClass = 'bg-success';
        if (item.origen === 'Ingresos') {
            badgeClass = item.estado === 'Resuelto_Favorable' ? 'bg-success' : 'bg-secondary';
        } else if (item.origen === 'TAREAS') {
            badgeClass = 'bg-info';
        }

        // Format estado for display
        let estadoDisplay = item.estado;
        if (item.estado === 'Resuelto_Favorable') estadoDisplay = 'Resuelto Favorable';
        if (item.estado === 'Resuelto_NO_Favorable') estadoDisplay = 'Resuelto No Favorable';

        row.innerHTML = `
            <td class="fw-bold text-primary">${item.asunto || 'Sin Asunto'}</td>
            <td>${item.origen}</td>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 10px;">YO</div>
                    <span>${item.rol_usuario}</span>
                </div>
            </td>
            <td>${item.fecha}</td>
            <td>${item.fecha_cierre || '-'}</td>
            <td><span class="badge ${badgeClass} fw-normal">${estadoDisplay}</span></td>
        `;

        row.addEventListener('click', () => {
            if (item.origen === 'DESVE') {
                window.location.href = `desve/desve_consultar.php?id=${item.id}`;
            } else if (item.origen === 'Ingresos') {
                window.location.href = `ingresos/ingr_consultar.php?id=${item.id}`;
            } else if (item.origen === 'TAREAS') {
                Swal.fire({
                    title: item.asunto,
                    text: item.detalle || 'Tarea completada',
                    icon: 'info',
                    confirmButtonText: 'Cerrar'
                });
            }
        });

        tbody.appendChild(row);
    });

    if (window.feather) feather.replace();
}

function renderPagination(totalItems, currentPage) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const btnAnt = document.getElementById('btnAnterior');
    const btnSig = document.getElementById('btnSiguiente');

    if (btnAnt) {
        btnAnt.disabled = currentPage === 1;
        btnAnt.onclick = () => renderPage(currentPage - 1);
    }
    if (btnSig) {
        btnSig.disabled = currentPage === totalPages || totalPages === 0;
        btnSig.onclick = () => renderPage(currentPage + 1);
    }
}

function actualizarKPIs() {
    const totalDesve = allItems.filter(item => item.origen === 'DESVE').length;
    const totalIngresos = allItems.filter(item => item.origen === 'Ingresos').length;
    const totalTareas = allItems.filter(item => item.origen === 'TAREAS').length;

    document.getElementById('totalSolicitudes').innerText = allItems.length;
    document.getElementById('totalCerrados').innerHTML = `${totalTareas} Tareas<br>${totalDesve} DESVE <br> ${totalIngresos} Ingresos <br>`;
}

function actualizarRangoFechas(inicio, fin) {
    const fechaInicioObj = new Date(inicio);
    const fechaFinObj = new Date(fin);

    const rangoTexto = `${fechaInicioObj.toLocaleDateString('es-CL')} - ${fechaFinObj.toLocaleDateString('es-CL')}`;
    document.getElementById('rangoFechas').innerText = rangoTexto;
}

function formatearFecha(fecha) {
    if (!fecha) return '-';
    const d = new Date(fecha);
    return d.toLocaleDateString('es-CL');
}

function formatDateForInput(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}
