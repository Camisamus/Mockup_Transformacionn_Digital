
let allItems = [];
let currentPage = 1;
const itemsPerPage = 5; // Mostrar 5 items por página

document.addEventListener('DOMContentLoaded', async function () {
    const API_BASE_URL = window.API_BASE_URL || (window.location.origin + '/api'); // Use global or fallback
    const tbody = document.querySelector('.tasks-table tbody');

    // Clear loading/static
    tbody.innerHTML = '<tr><td colspan="6" class="text-center">Cargando bandeja...</td></tr>';

    try {
        // Fetch Inbox
        // Check if API_BASE_URL is correct or needs adjustment based on environment
        const fetchUrl = (API_BASE_URL.endsWith('/api') ? API_BASE_URL : API_BASE_URL + '/api') + '/bandeja.php';

        // Fix for consistent URL usage
        const cleanBaseUrl = window.location.origin + (window.location.pathname.includes('/backend/') ? '/backend/api' : '/api');

        const response = await fetch(`${cleanBaseUrl}/bandeja.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "LISTAR_BANDEJA" })
        });

        if (response.status === 401) {
            // Redirect or handle unauth
            window.logout();
            //window.location.href = 'page.html';
            return;
        }

        const result = await response.json();

        if (result.status === 'success') {
            allItems = result.data;
            renderPage(1);
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
    const tbody = document.querySelector('.tasks-table tbody');

    // Calculate slice
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = allItems.slice(start, end);

    renderTable(paginatedItems, tbody);
    renderPagination(allItems.length, page);

    // Update info text
    const infoDiv = document.querySelector('.pagination-info');
    if (infoDiv) {
        infoDiv.innerText = `Mostrando ${Math.min(start + 1, allItems.length)}-${Math.min(end, allItems.length)} de ${allItems.length} tareas`;
    }
}

function renderTable(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay tareas pendientes.</td></tr>';
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
            <td class="task-title font-weight-bold">
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-link p-0 me-2 d-md-none" onclick="toggleRow('${rowId}', event)">
                        <i data-feather="plus-circle"></i>
                    </button>
                    ${item.asunto || 'Sin Asunto'}
                </div>
            </td>
            <td class="task-role d-none d-md-table-cell">${item.origen}</td> 
            <td class="d-none d-md-table-cell">${respHTML}</td>
            <td class="d-none d-md-table-cell">${item.origen}</td> 
            <td class="d-none d-md-table-cell">${new Date(item.fecha).toLocaleDateString()}</td>
            <td><span class="status-badge ${statusClass}">${item.estado}</span></td>
        `;

        // Navigation on row click (excluding the toggle button)
        row.addEventListener('click', (e) => {
            if (e.target.closest('button')) return; // Ignore if clicked toggle

            if (item.origen === 'DESVE') {
                window.location.href = `desve_responder.html?id=${item.id}`;
            } else if (item.origen === 'Ingresos') {
                window.location.href = `ingr_responder.html?id=${item.id}`;
            } else if (item.origen === 'Patentes') {
                Swal.fire('Info', 'Módulo de Patentes en construcción', 'info');
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
                    <p><strong>Entrega:</strong> ${new Date(item.fecha).toLocaleDateString()}</p>
                    <button class="btn btn-sm btn-primary mt-2" onclick="
                        if('${item.origen}' === 'DESVE') window.location.href = 'desve_responder.html?id=${item.id}';
                        else if ('${item.origen}' === 'Ingresos') window.location.href = 'ingr_responder.html?id=${item.id}';
                        else Swal.fire('Info', 'Módulo en construcción', 'info');
                    ">Ver Detalle</button>
                </div>
            </td>
        `;
        tbody.appendChild(expandedRow);
    });

    if (window.feather) feather.replace();
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
    const container = document.querySelector('.pagination-controls');

    if (!container) return; // Should allow this gracefully

    container.innerHTML = '';

    // Previous Button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'pagination-btn';
    prevBtn.innerText = 'Anterior';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => renderPage(currentPage - 1);
    container.appendChild(prevBtn);

    // Page Numbers (simplified: just current of total)
    /* 
    // If we wanted numbered buttons:
    for (let i = 1; i <= totalPages; i++) {
        // ...
    } 
    */

    // Next Button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'pagination-btn';
    nextBtn.innerText = 'Siguiente';
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => renderPage(currentPage + 1);
    container.appendChild(nextBtn);
}
