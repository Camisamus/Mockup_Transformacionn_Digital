// organizaciones_consulta_masiva.js
// Handles search functionality and data loading for mass organization queries

let organizacionesData = [];

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the page
    cargarDatosIniciales();
});

/**
 * Load initial data into the results table from JSON mock file
 */
function cargarDatosIniciales() {
    fetch('../recursos/jsons/organizaciones_consulta_masiva_mock.json')
        .then(response => response.json())
        .then(data => {
            organizacionesData = data;
            renderizarTabla(organizacionesData);
            actualizarContadorResultados();
        })
        .catch(error => {
            console.error('Error al cargar datos:', error);
            const tbody = document.querySelector('#tablaResultados tbody');
            tbody.innerHTML = '<tr><td colspan="10" class="text-center text-danger">Error al cargar los datos</td></tr>';
        });
}

/**
 * Render the table with organization data
 */
function renderizarTabla(datos) {
    const tbody = document.querySelector('#tablaResultados tbody');
    tbody.innerHTML = '';

    if (datos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="10" class="text-center">No se encontraron resultados</td></tr>';
        return;
    }

    datos.forEach(org => {
        const row = document.createElement('tr');

        // Format directiva actual
        const directivaActualHTML = org.directivaActual.map(d =>
            `${d.nombre} (${d.cargo})`
        ).join('<br>');

        // Format directivas anteriores
        let directivasAnterioresHTML = 'Sin registros';
        if (org.directivasAnteriores.length > 0) {
            directivasAnterioresHTML = org.directivasAnteriores.map(da => {
                const miembros = da.miembros.map(m => `${m.nombre} (${m.cargo})`).join('<br>');
                return `${da.periodo}: ${miembros}`;
            }).join('<br>');
        }

        row.innerHTML = `
            <td>${org.rut}</td>
            <td>${org.nombre}</td>
            <td>${org.codigo}</td>
            <td>${org.rpj}</td>
            <td>${org.fechaInscripcion}</td>
            <td>${org.fechaTerminoVigencia}</td>
            <td>${directivaActualHTML}</td>
            <td>${directivasAnterioresHTML}</td>
            <td>${org.representanteLegal}</td>
            <td>${org.unidadVecinal}</td>
        `;

        tbody.appendChild(row);
    });
}

/**
 * Search organizations based on filter criteria
 */
function buscarOrganizaciones() {
    // Get filter values
    const filtros = {
        rut: document.getElementById('filtro_rut').value.trim(),
        nombre: document.getElementById('filtro_nombre').value.trim(),
        codigo: document.getElementById('filtro_codigo').value.trim(),
        rpj: document.getElementById('filtro_rpj').value.trim(),
        fechaInscripcionInicio: document.getElementById('filtro_fecha_inscripcion_inicio').value,
        fechaInscripcionFin: document.getElementById('filtro_fecha_inscripcion_fin').value,
        fechaTerminoInicio: document.getElementById('filtro_fecha_termino_inicio').value,
        fechaTerminoFin: document.getElementById('filtro_fecha_termino_fin').value,
        representanteLegal: document.getElementById('filtro_representante_legal').value.trim(),
        unidadVecinal: document.getElementById('filtro_unidad_vecinal').value.trim(),
        direccion: document.getElementById('filtro_direccion').value.trim(),
        telefono: document.getElementById('filtro_telefono').value.trim(),
        ley19418: document.getElementById('filtro_ley_19418').value,
        rendicionesPendientes: document.getElementById('filtro_rendiciones_pendientes').value
    };

    console.log('Buscando con filtros:', filtros);

    // Filter the data based on criteria
    let resultadosFiltrados = organizacionesData.filter(org => {
        // RUT filter
        if (filtros.rut && !org.rut.toLowerCase().includes(filtros.rut.toLowerCase())) {
            return false;
        }

        // Nombre filter
        if (filtros.nombre && !org.nombre.toLowerCase().includes(filtros.nombre.toLowerCase())) {
            return false;
        }

        // Código filter
        if (filtros.codigo && !org.codigo.toLowerCase().includes(filtros.codigo.toLowerCase())) {
            return false;
        }

        // RPJ filter
        if (filtros.rpj && !org.rpj.toLowerCase().includes(filtros.rpj.toLowerCase())) {
            return false;
        }

        // Fecha inscripción range filter
        if (filtros.fechaInscripcionInicio && org.fechaInscripcion < filtros.fechaInscripcionInicio) {
            return false;
        }
        if (filtros.fechaInscripcionFin && org.fechaInscripcion > filtros.fechaInscripcionFin) {
            return false;
        }

        // Fecha término vigencia range filter
        if (filtros.fechaTerminoInicio && org.fechaTerminoVigencia < filtros.fechaTerminoInicio) {
            return false;
        }
        if (filtros.fechaTerminoFin && org.fechaTerminoVigencia > filtros.fechaTerminoFin) {
            return false;
        }

        // Representante legal filter
        if (filtros.representanteLegal && !org.representanteLegal.toLowerCase().includes(filtros.representanteLegal.toLowerCase())) {
            return false;
        }

        // Unidad vecinal filter
        if (filtros.unidadVecinal && !org.unidadVecinal.toLowerCase().includes(filtros.unidadVecinal.toLowerCase())) {
            return false;
        }

        return true;
    });

    // Render filtered results
    renderizarTabla(resultadosFiltrados);
    actualizarContadorResultados();
}

/**
 * Clear all filter inputs
 */
function limpiarFiltros() {
    document.getElementById('filtro_rut').value = '';
    document.getElementById('filtro_nombre').value = '';
    document.getElementById('filtro_codigo').value = '';
    document.getElementById('filtro_rpj').value = '';
    document.getElementById('filtro_fecha_inscripcion_inicio').value = '';
    document.getElementById('filtro_fecha_inscripcion_fin').value = '';
    document.getElementById('filtro_fecha_termino_inicio').value = '';
    document.getElementById('filtro_fecha_termino_fin').value = '';
    document.getElementById('filtro_representante_legal').value = '';
    document.getElementById('filtro_unidad_vecinal').value = '';
    document.getElementById('filtro_direccion').value = '';
    document.getElementById('filtro_telefono').value = '';
    document.getElementById('filtro_ley_19418').value = '';
    document.getElementById('filtro_rendiciones_pendientes').value = '';

    console.log('Filtros limpiados');
}

/**
 * Update the results counter
 */
function actualizarContadorResultados() {
    const tbody = document.querySelector('#tablaResultados tbody');
    const rowCount = tbody.querySelectorAll('tr').length;
    document.getElementById('resultados_count').textContent = rowCount;
}

/**
 * Export results to Excel
 */
function exportarExcel() {
    // In production, this would generate an actual Excel file
    alert('Exportando resultados a Excel...\n\nEsta funcionalidad generará un archivo .xlsx con todos los resultados de la búsqueda.');
    console.log('Exportar a Excel');
}

/**
 * Export results to PDF
 */
function exportarPDF() {
    // In production, this would generate an actual PDF file
    alert('Exportando resultados a PDF...\n\nEsta funcionalidad generará un archivo PDF con todos los resultados de la búsqueda.');
    console.log('Exportar a PDF');
}

/**
 * Format RUT with dots and dash
 */
function formatearRUT(input) {
    let value = input.value.replace(/[^0-9kK]/g, '');

    if (value.length > 1) {
        const dv = value.slice(-1);
        const number = value.slice(0, -1);
        const formattedNumber = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        input.value = formattedNumber + '-' + dv;
    }
}

// Add RUT formatting on blur
document.addEventListener('DOMContentLoaded', function () {
    const rutInput = document.getElementById('filtro_rut');
    if (rutInput) {
        rutInput.addEventListener('blur', function () {
            formatearRUT(this);
        });
    }
});
