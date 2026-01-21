document.addEventListener('DOMContentLoaded', () => {
    cargarBandeja();

    const formFiltros = document.getElementById('form_filtros');
    const inputTitulo = document.getElementById('filtro_titulo');
    const inputRgt = document.getElementById('filtro_rgt');
    const inputId = document.getElementById('filtro_id');

    const limpiarOtros = (actual) => {
        if (actual !== inputTitulo) inputTitulo.value = '';
        if (actual !== inputRgt) inputRgt.value = '';
        if (actual !== inputId) inputId.value = '';
    };

    inputTitulo.addEventListener('input', () => limpiarOtros(inputTitulo));
    inputRgt.addEventListener('input', () => limpiarOtros(inputRgt));
    inputId.addEventListener('input', () => limpiarOtros(inputId));

    formFiltros.addEventListener('submit', (e) => {
        e.preventDefault();
        const filters = {
            tis_titulo: document.getElementById('filtro_titulo').value,
            rgt_id_publica: document.getElementById('filtro_rgt').value,
            tis_id: document.getElementById('filtro_id').value
        };
        cargarBandeja(filters);
    });

    document.getElementById('btn_limpiar').addEventListener('click', () => {
        setTimeout(() => cargarBandeja(), 10); // Wait for reset
    });
});

async function cargarBandeja(filters = {}) {
    const tabla = document.getElementById('tabla_ingresos');

    try {
        const response = await fetch(`${window.API_BASE_URL}/ingresos_ingresos.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                ACCION: 'CONSULTAM',
                ...filters
            })
        });

        const result = await response.json();

        if (result.status === 'success') {
            renderizarTabla(result.data);
        } else {
            tabla.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error: ${result.message}</td></tr>`;
        }
    } catch (error) {
        console.error('Error:', error);
        tabla.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error de conexión con el servidor.</td></tr>`;
    }
}

function renderizarTabla(data) {
    const tabla = document.getElementById('tabla_ingresos');
    tabla.innerHTML = '';

    if (data.length === 0) {
        tabla.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">No se encontraron registros.</td></tr>';
        return;
    }

    data.forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'cursor-pointer';
        tr.onclick = () => {
            window.location.href = `ingr_consultar.html?id=${item.tis_id}`;
        };

        const rgtCode = item.rgt_id_publica || '-';

        tr.innerHTML = `
            <td class="ps-4 text-muted small">${item.tis_id}</td>
            <td class="rgt-container">
                <button class="btn btn-xs btn-outline-secondary py-0 px-2 btn-show-code" style="font-size: 0.75rem;">
                    <i data-feather="eye" style="width: 12px; height: 12px;"></i> Ver
                </button>
                <code class="d-none">${rgtCode}</code>
            </td>
            <td>
                <div class="fw-bold">${item.tis_titulo || 'Sin título'}</div>
                <div class="small text-muted text-truncate" style="max-width: 300px;">${item.tis_contenido || ''}</div>
            </td>
            <td><span class="small">${item.tis_fecha || '-'}</span></td>
            <td><span class="badge ${item.tis_estado === 'Ingresado' ? 'bg-success' : 'bg-primary'}">${item.tis_estado || '-'}</span></td>
            <td class="text-end pe-4">
                <button class="btn btn-sm btn-outline-primary py-0" title="Consultar">
                    <i data-feather="eye" style="width: 14px; height: 14px;"></i>
                </button>
            </td>
        `;

        // Attach click to the show button
        const btnShow = tr.querySelector('.btn-show-code');
        btnShow.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent tr.onclick
            Swal.fire({
                title: 'Código Público (RGT)',
                html: `<div class="p-3 bg-light rounded shadow-sm">
                        <code style="font-size: 2rem; letter-spacing: 2px;">${rgtCode}</code>
                       </div>`,
                confirmButtonText: 'Cerrar',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        });

        tabla.appendChild(tr);
    });

    if (window.feather) window.feather.replace();
}
