// ingr_historial.js
let ingresosData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos() {
    // Generate mock data
    ingresosData = [
        { id: 'ING-2024-001', fecha: '2024-02-01', estado: 'VIGENTE', tipo: 'Patente Municipal', responsable: 'Juan Perez', monto: 150000 },
        { id: 'ING-2024-002', fecha: '2024-02-05', estado: 'PAGADO', tipo: 'Derecho de Aseo', responsable: 'Maria Gonzalez', monto: 45000 },
        { id: 'ING-2024-003', fecha: '2024-02-10', estado: 'ANULADO', tipo: 'Permiso Obras', responsable: 'Pedro Soto', monto: 0 },
        { id: 'ING-2024-004', fecha: '2024-03-01', estado: 'VIGENTE', tipo: 'Multa Tránsito', responsable: 'Ana Li', monto: 80000 },
        { id: 'ING-2024-005', fecha: '2024-03-15', estado: 'PAGADO', tipo: 'Patente Alcoholes', responsable: 'Jose Silva', monto: 300000 }
    ];
    renderizarTabla(ingresosData);
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    datos.forEach(item => {
        const tr = document.createElement('tr');

        let badgeClass = 'bg-success';
        if (item.estado === 'PAGADO') badgeClass = 'bg-primary';
        if (item.estado === 'ANULADO') badgeClass = 'bg-danger';

        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(item.monto);

        tr.innerHTML = `
            <td class="fw-bold">${item.id}</td>
            <td>${item.fecha.substring(0, 10)}</td>
            <td><span class="badge ${badgeClass} fw-normal">${item.estado}</span></td>
            <td>${item.tipo}</td>
            <td>${item.responsable}</td>
            <td class="fw-bold">${montoFormateado}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${item.id}')" title="Ver Detalle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

window.buscarIngresos = function () {
    const filtros = {
        id: document.getElementById('filtro_id').value.toLowerCase(),
        fechaInicio: document.getElementById('filtro_fecha_inicio').value,
        fechaFin: document.getElementById('filtro_fecha_fin').value,
        responsable: document.getElementById('filtro_responsable').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase()
    };

    const datosFiltrados = ingresosData.filter(item => {
        let cumple = true;

        if (filtros.id && !item.id.toLowerCase().includes(filtros.id)) cumple = false;

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

        if (filtros.responsable && !item.responsable.toLowerCase().includes(filtros.responsable)) cumple = false;
        if (filtros.estado && item.estado.toLowerCase() !== filtros.estado) cumple = false;

        return cumple;
    });

    renderizarTabla(datosFiltrados);
}

window.limpiarFiltros = function () {
    document.getElementById('formFiltros').reset();
    renderizarTabla(ingresosData);
}

window.verDetalle = function (id) {
    // Placeholder for detail view redirect
    window.location.href = 'ingr_consultar.html?id=' + id;
}
