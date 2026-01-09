// atenciones_listado_atenciones.js
// Handles attentions listing functionality

let atencionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

async function cargarDatos() {
    try {
        const response = await fetch('../recursos/jsons/atenciones_listado_mock.json');
        atencionesData = await response.json();
        renderizarTabla(atencionesData);
    } catch (error) {
        console.error('Error cargando datos de atenciones:', error);
    }
}

function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaAtenciones tbody');
    tbody.innerHTML = '';

    datos.forEach(atencion => {
        const tr = document.createElement('tr');

        let badgeClass = 'badge-completada';
        if (atencion.estado === 'En Proceso') badgeClass = 'badge-proceso';
        if (atencion.estado === 'Pendiente') badgeClass = 'badge-pendiente';

        tr.innerHTML = `
            <td>${atencion.numero_atencion}</td>
            <td>${atencion.fecha}</td>
            <td>${atencion.tipo}</td>
            <td>${atencion.organizacion}</td>
            <td>${atencion.proyecto}</td>
            <td><span class="badge ${badgeClass}">${atencion.estado}</span></td>
            <td>${atencion.usuario}</td>
            <td>${atencion.area}</td>
            <td><button class="btn btn-sm btn-outline-secondary" onclick="verDetalle('${atencion.numero_atencion}')">👁️</button></td>
        `;

        tbody.appendChild(tr);
    });

    document.getElementById('resultados_count').textContent = datos.length;
}

function buscarAtenciones() {
    const filtros = {
        estado: document.getElementById('filtro_estado').value.toLowerCase(),
        tipo: document.getElementById('filtro_tipo').value.toLowerCase(),
        organizacion: document.getElementById('filtro_organizacion').value.toLowerCase()
    };

    const datosFiltrados = atencionesData.filter(atencion => {
        let cumple = true;

        if (filtros.estado && !atencion.estado.toLowerCase().includes(filtros.estado)) {
            cumple = false;
        }
        if (filtros.tipo && !atencion.tipo.toLowerCase().includes(filtros.tipo)) {
            cumple = false;
        }
        if (filtros.organizacion && !atencion.organizacion.toLowerCase().includes(filtros.organizacion)) {
            cumple = false;
        }

        return cumple;
    });

    renderizarTabla(datosFiltrados);
}

function limpiarFiltros() {
    document.getElementById('filtro_fecha_desde').value = '';
    document.getElementById('filtro_fecha_hasta').value = '';
    document.getElementById('filtro_estado').value = '';
    document.getElementById('filtro_tipo').value = '';
    document.getElementById('filtro_organizacion').value = '';

    renderizarTabla(atencionesData);
}

function verDetalle(numero) {
    console.log('Ver detalle de atención:', numero);
    window.location.href = 'atenciones_consulta_atencion.html?numero=' + numero;
}
