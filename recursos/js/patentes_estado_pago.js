document.addEventListener('DOMContentLoaded', () => {
    const tablePagadasBody = document.querySelector('#tablaPagadas tbody');

    // Load Data
    fetch('../recursos/jsons/patentes_estado_pago_mock.json')
        .then(response => response.json())
        .then(data => {
            renderPagadas(data.pagadas);
        })
        .catch(error => console.error('Error loading mock data:', error));

    function renderPagadas(data) {
        if (!tablePagadasBody) return;
        tablePagadasBody.innerHTML = '';

        if (data.length === 0) {
            tablePagadasBody.innerHTML = '<tr><td colspan="7" class="text-muted">No hay información disponible</td></tr>';
            return;
        }

        data.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.nPatente}</td>
                <td>${item.tipo}</td>
                <td>${item.periodo}</td>
                <td>${item.pagadoEn}</td>
                <td>${item.total}</td>
                <td>${item.vencimiento}</td>
                <td>
                    <button class="btn btn-danger btn-sm text-white" title="Descargar Comprobante">
                        <i data-feather="file-text"></i> PDF
                    </button>
                </td>
            `;
            tablePagadasBody.appendChild(row);
        });
        
        // Re-initialize feather icons for new content
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    }
});
