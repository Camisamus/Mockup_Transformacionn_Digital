// desve_historial.js
let desveData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos() {
    // Generate mock data since there isn't a dedicated endpoint yet
    desveData = [
        { numero: '2024001', fecha: '2024-01-10', estado: 'PENDIENTE', rut: '12.345.678-9', solicitante: 'Juan Perez', asunto: 'Solicitud de patente' },
        { numero: '2024002', fecha: '2024-01-12', estado: 'RESPONDIDO', rut: '9.876.543-2', solicitante: 'Maria Gonzalez', asunto: 'Consulta de deuda' },
        { numero: '2024003', fecha: '2024-01-15', estado: 'ANULADO', rut: '11.222.333-4', solicitante: 'Empresa XYZ', asunto: 'Certificado de obras' },
        { numero: '2024004', fecha: '2024-01-20', estado: 'PENDIENTE', rut: '5.555.555-5', solicitante: 'Pedro Soto', asunto: 'Permiso de circulación' },
        { numero: '2024005', fecha: '2024-01-25', estado: 'RESPONDIDO', rut: '6.666.666-6', solicitante: 'Ana Li', asunto: 'Reclamo' }
    ];
    renderizarTabla(desveData);
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    datos.forEach(item => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (item.estado === 'PENDIENTE') badgeClass = 'bg-warning text-dark';
        if (item.estado === 'ANULADO') badgeClass = 'bg-danger';

        tr.innerHTML = `
            <td class="fw-bold">${item.numero}</td>
            <td>${item.fecha}</td>
            <td><span class="badge ${badgeClass} fw-normal">${item.estado}</span></td>
            <td>${item.rut}</td>
            <td>${item.solicitante}</td>
            <td>${item.asunto}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${item.numero}')" title="Ver Detalle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

window.buscarDesve = function () {
    const filtros = {
        numero: document.getElementById('filtro_numero').value.toLowerCase(),
        fechaInicio: document.getElementById('filtro_fecha_inicio').value,
        fechaFin: document.getElementById('filtro_fecha_fin').value,
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase()
    };

    const datosFiltrados = desveData.filter(item => {
        let cumple = true;

        if (filtros.numero && !item.numero.toLowerCase().includes(filtros.numero)) cumple = false;

        if (filtros.fechaInicio) {
            const fechaItem = new Date(item.fecha);
            const fechaFiltro = new Date(filtros.fechaInicio);
            if (fechaItem < fechaFiltro) cumple = false;
        }

        if (filtros.fechaFin) {
            const fechaItem = new Date(item.fecha);
            const fechaFiltro = new Date(filtros.fechaFin);
            if (fechaItem > fechaFiltro) cumple = false;
        }

        if (filtros.rut && !item.rut.toLowerCase().includes(filtros.rut)) cumple = false;
        if (filtros.estado && item.estado.toLowerCase() !== filtros.estado) cumple = false;

        return cumple;
    });

    renderizarTabla(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTabla(desveData);
}

window.verDetalle = function (numero) {
    // Logic to view details, maybe redirect to desve_modificar.html or a dedicated view
    // For now, we'll assume desve_modificar for 'responder' or similar
    window.location.href = 'desve_modificar.html?id=' + numero;
}
