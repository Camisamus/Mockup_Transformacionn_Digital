document.addEventListener('DOMContentLoaded', function () {
    loadPaymentHistory();
});

async function loadPaymentHistory() {
    const tableBody = document.getElementById('historialBody');

    try {
        const response = await fetch('../recursos/jsons/historial_pagos_mock.json');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();

        tableBody.innerHTML = ''; // Clear existing content

        data.forEach(item => {
            const row = document.createElement('tr');

            // Format numbers as currency CLP
            const formatCurrency = (amount) => {
                return new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(amount);
            };

            // Badge for Status
            let badgeClass = 'bg-secondary';
            if (item.estado === 'Pagado') badgeClass = 'bg-success';
            if (item.estado === 'Pendiente') badgeClass = 'bg-warning text-dark';
            if (item.estado === 'Vencido') badgeClass = 'bg-danger';

            row.innerHTML = `
                <td class="fw-bold">${item.patente}</td>
                <td>${item.tipo}</td>
                <td>${item.periodo}</td>
                <td><span class="badge ${badgeClass}">${item.estado}</span></td>
                <td>${formatCurrency(item.neto)}</td>
                <td>${formatCurrency(item.ipc)}</td>
                <td>${formatCurrency(item.multa)}</td>
                <td class="fw-bold">${formatCurrency(item.total)}</td>
                <td>${item.vencimiento}</td>
                <td>${item.fecha_pago}</td>
                <td>${item.forma_pago}</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" title="${item.acciones}">
                        <i data-feather="eye"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        // Re-initialize Feather icons for new content
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

    } catch (error) {
        console.error('Error loading payment history:', error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="12" class="text-center text-danger">
                    Error al cargar los datos. Por favor intente nuevamente.
                </td>
            </tr>
        `;
    }
}
