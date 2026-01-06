
document.addEventListener('DOMContentLoaded', async function () {
    const API_BASE_URL = window.location.origin + '/api';
    const tbody = document.querySelector('.tasks-table tbody');

    // Clear loading/static
    tbody.innerHTML = '<tr><td colspan="6" class="text-center">Cargando bandeja...</td></tr>';

    try {
        // 1. Fetch Session/Inbox Data
        // Verify session first? Usually handled by layout_manager or the API returns 401.
        // We'll trust the API 401 response or let layout_manager handle auth redirects if it runs first.

        // Fetch Inbox
        const response = await fetch(`${API_BASE_URL}/bandeja.php`, {
            method: 'POST',
            credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ACCION: "LISTAR_BANDEJA" })
        });

        if (response.status === 401) {
            window.location.href = '../page.html';
            return;
        }

        const result = await response.json();

        if (result.status === 'success') {
            renderTable(result.data, tbody);
        } else {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }

    } catch (e) {
        console.error("Error loading inbox:", e);
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Error de conexión</td></tr>';
    }
});

function renderTable(items, tbody) {
    if (!items || items.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay tareas pendientes.</td></tr>';
        return;
    }

    tbody.innerHTML = '';

    items.forEach(item => {
        const row = document.createElement('tr');
        row.style.cursor = 'pointer';

        // Navigation Logic
        row.onclick = () => {
            if (item.origen === 'Ingresos') {
                window.location.href = `ingresos_ingresar_respuesta.html?id=${item.id}`;
            } else if (item.origen === 'Patentes') {
                // Placeholder
                alert("Módulo de Patentes en construcción");
            } else {
                alert(`Navegación para ${item.origen} no definida.`);
            }
        };

        // Status Badge Logic
        let statusClass = 'status-pendiente';
        if (item.estado === 'Atrasada') statusClass = 'status-atrasada';
        else if (item.estado === 'Completada') statusClass = 'status-completada';
        else if (item.estado === 'En Progreso') statusClass = 'status-en-progreso';

        // Responsible (Current User) - Could format better if we had data
        const respHTML = `
            <div class="responsible-cell">
                <div class="user-avatar avatar-blue">YO</div>
                <span>Mí mismo</span>
            </div>`;

        row.innerHTML = `
            <td class="task-title font-weight-bold">${item.asunto || 'Sin Asunto'}</td>
            <td class="task-role">${item.origen}</td> <!-- Using Origen as Role/Type context -->
            <td>${respHTML}</td>
            <td>${item.origen}</td> <!-- Project/Sector -->
            <td>${new Date(item.fecha).toLocaleDateString()}</td>
            <td><span class="status-badge ${statusClass}">${item.estado}</span></td>
        `;

        tbody.appendChild(row);
    });
}
