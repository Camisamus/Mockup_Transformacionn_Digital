// postulaciones_consulta_masiva.js
// Handles mass applications query functionality

let postulacionesData = [];

// Load data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

/**
 * Load applications data from JSON file
 */
async function cargarDatos() {
    try {
        const response = await fetch('../recursos/jsons/postulaciones_consulta_masiva_mock.json');
        postulacionesData = await response.json();
        renderizarTabla(postulacionesData);
    } catch (error) {
        console.error('Error cargando datos de postulaciones:', error);
    }
}

/**
 * Render table with applications data
 */
function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaPostulaciones tbody');
    tbody.innerHTML = '';

    datos.forEach(postulacion => {
        const tr = document.createElement('tr');

        // Estado badge
        let badgeClass = 'badge-aprobado';
        if (postulacion.estado === 'En Evaluación') badgeClass = 'badge-evaluacion';
        if (postulacion.estado === 'Pendiente') badgeClass = 'badge-pendiente';
        if (postulacion.estado === 'Finalizado') badgeClass = 'badge-finalizado';

        // Format currency
        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(postulacion.monto);

        tr.innerHTML = `
            <td>${postulacion.rpj}</td>
            <td>${postulacion.rut}</td>
            <td>${postulacion.nombre_organizacion}</td>
            <td>${postulacion.tipo_organizacion}</td>
            <td>${postulacion.codigo_organizacion}</td>
            <td>${postulacion.numero_proyecto}</td>
            <td>${postulacion.numero_subvencion}</td>
            <td>${postulacion.nombre_proyecto}</td>
            <td>${postulacion.finalidad_proyecto}</td>
            <td>${postulacion.tipo_fondo}</td>
            <td>${postulacion.unidad}</td>
            <td>${postulacion.fecha_ingreso}</td>
            <td>${montoFormateado}</td>
            <td><span class="badge ${badgeClass}">${postulacion.estado}</span></td>
            <td>${postulacion.anio_ingreso}</td>
            <td>${postulacion.numero_ingreso}</td>
        `;

        tbody.appendChild(tr);
    });

    // Update count
    document.getElementById('resultados_count').textContent = datos.length;
}

/**
 * Search applications with filters
 */
function buscarPostulaciones() {
    const filtros = {
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        nombre_org: document.getElementById('filtro_nombre_org').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase(),
        unidad: document.getElementById('filtro_unidad').value.toLowerCase()
    };

    const datosFiltrados = postulacionesData.filter(postulacion => {
        let cumple = true;

        if (filtros.rut && !postulacion.rut.toLowerCase().includes(filtros.rut)) {
            cumple = false;
        }
        if (filtros.nombre_org && !postulacion.nombre_organizacion.toLowerCase().includes(filtros.nombre_org)) {
            cumple = false;
        }
        if (filtros.estado && !postulacion.estado.toLowerCase().includes(filtros.estado)) {
            cumple = false;
        }
        if (filtros.unidad && !postulacion.unidad.toLowerCase().includes(filtros.unidad)) {
            cumple = false;
        }

        return cumple;
    });

    renderizarTabla(datosFiltrados);
    console.log('Búsqueda realizada. Resultados:', datosFiltrados.length);
}

/**
 * Clear all filters
 */
function limpiarFiltros() {
    document.getElementById('filtro_id').value = '';
    document.getElementById('filtro_rut').value = '';
    document.getElementById('filtro_nombre_org').value = '';
    document.getElementById('filtro_tipo_postulacion').value = '';
    document.getElementById('filtro_tipo_proyecto').value = '';
    document.getElementById('filtro_etapa').value = '';
    document.getElementById('filtro_tipo_fondo').value = '';
    document.getElementById('filtro_unidad').value = '';
    document.getElementById('filtro_monto_maximo').value = '';
    document.getElementById('filtro_fecha_inicio').value = '';
    document.getElementById('filtro_fecha_fin').value = '';
    document.getElementById('filtro_estado').value = '';

    renderizarTabla(postulacionesData);
    console.log('Filtros limpiados');
}
