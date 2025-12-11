// subvenciones_consulta_masiva.js
// Handles mass subsidy query functionality

let subvencionesData = [];

// Load data on page load
document.addEventListener('DOMContentLoaded', function () {
    cargarDatos();
});

/**
 * Load subsidy data from JSON file
 */
async function cargarDatos() {
    try {
        const response = await fetch('../recursos/jsons/subvenciones_consulta_masiva_mock.json');
        subvencionesData = await response.json();
        renderizarTabla(subvencionesData);
    } catch (error) {
        console.error('Error cargando datos de subvenciones:', error);
    }
}

/**
 * Render table with subsidy data
 */
function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    datos.forEach(subvencion => {
        const tr = document.createElement('tr');

        // Estado badge
        let badgeClass = 'badge-vigente';
        if (subvencion.estado_actual === 'PENDIENTE') badgeClass = 'badge-pendiente';
        if (subvencion.estado_actual === 'CERRADA') badgeClass = 'badge-cerrada';

        // Format currency
        const montoFormateado = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP'
        }).format(subvencion.monto);

        tr.innerHTML = `
            <td>${subvencion.numero}</td>
            <td>${subvencion.fecha}</td>
            <td><span class="badge ${badgeClass}">${subvencion.estado_actual}</span></td>
            <td>${subvencion.rut}</td>
            <td>${subvencion.nombre}</td>
            <td>${montoFormateado}</td>
            <td>${subvencion.anio_decreto}</td>
            <td>${subvencion.numero_decreto}</td>
        `;

        tbody.appendChild(tr);
    });

    // Update count
    document.getElementById('resultados_count').textContent = datos.length;
}

/**
 * Search subsidies with filters
 */
function buscarSubvenciones() {
    const filtros = {
        numero: document.getElementById('filtro_numero').value.toLowerCase(),
        rut: document.getElementById('filtro_rut').value.toLowerCase(),
        estado: document.getElementById('filtro_estado').value.toLowerCase()
    };

    const datosFiltrados = subvencionesData.filter(subvencion => {
        let cumple = true;

        if (filtros.numero && !subvencion.numero.toLowerCase().includes(filtros.numero)) {
            cumple = false;
        }
        if (filtros.rut && !subvencion.rut.toLowerCase().includes(filtros.rut)) {
            cumple = false;
        }
        if (filtros.estado && subvencion.estado_actual.toLowerCase() !== filtros.estado) {
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
    document.getElementById('filtro_numero').value = '';
    document.getElementById('filtro_fecha_inicio').value = '';
    document.getElementById('filtro_fecha_fin').value = '';
    document.getElementById('filtro_estado').value = '';
    document.getElementById('filtro_rut').value = '';
    document.getElementById('filtro_numero2').value = '';
    document.getElementById('filtro_monto_maximo').value = '';
    document.getElementById('filtro_numero_decreto').value = '';

    renderizarTabla(subvencionesData);
    console.log('Filtros limpiados');
}
