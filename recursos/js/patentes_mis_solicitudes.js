// Logic for Mis Solicitudes Page

document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements
    const tablaSolicitudes = document.getElementById('tablaSolicitudes');
    const timelineContainer = document.getElementById('timelineContainer');
    const btnBuscar = document.getElementById('btnBuscar');
    const btnLimpiar = document.getElementById('btnLimpiar');

    // Search inputs
    const searchNumero = document.getElementById('searchNumero');
    const searchRut = document.getElementById('searchRut');
    const searchFecha = document.getElementById('searchFecha');
    const searchEstado = document.getElementById('searchEstado');

    let solicitudesData = [];
    let historialData = [];

    // Initialize
    loadSolicitudes();
    loadHistorial();
    setupEventListeners();

    // Load solicitudes data from JSON
    function loadSolicitudes() {
        fetch('../recursos/jsons/patentes_solicitudes_mock.json')
            .then(response => response.json())
            .then(data => {
                solicitudesData = data.solicitudes;
                renderSolicitudes(solicitudesData);
            })
            .catch(error => console.error('Error loading solicitudes:', error));
    }

    // Load historial data from JSON
    function loadHistorial() {
        fetch('../recursos/jsons/patentes_historial_mock.json')
            .then(response => response.json())
            .then(data => {
                historialData = data.historial;
                renderHistorial(historialData);
            })
            .catch(error => console.error('Error loading historial:', error));
    }

    // Render solicitudes table
    function renderSolicitudes(solicitudes) {
        const tbody = tablaSolicitudes.querySelector('tbody');
        tbody.innerHTML = '';

        if (solicitudes.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-muted">No se encontraron solicitudes</td>
                </tr>
            `;
            return;
        }

        solicitudes.forEach(solicitud => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><a href="#" class="text-primary">${solicitud.numero}</a></td>
                <td>${solicitud.rut}</td>
                <td>${solicitud.fechaIngreso}</td>
                <td>${solicitud.tipoTramite || '-'}</td>
                <td>${solicitud.grupo || '-'}</td>
                <td><span class="badge ${solicitud.estadoClass}">${solicitud.estado}</span></td>
                <td><button class="btn btn-sm btn-outline-primary" onclick="descargarSolicitud('${solicitud.numero}')">📄 Descargar Solicitud</button></td>
            `;
            tbody.appendChild(row);
        });
    }

    // Render historial timeline
    function renderHistorial(historial) {
        timelineContainer.innerHTML = '';

        if (historial.length === 0) {
            timelineContainer.innerHTML = '<div class="text-muted">No hay historial disponible</div>';
            return;
        }

        historial.forEach(evento => {
            const timelineItem = document.createElement('div');
            timelineItem.className = 'timeline-item';
            timelineItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>📋 Encargado(a): ${evento.encargado}</strong>
                        <div class="text-muted small">📅 Fecha: ${evento.fecha} ⏰ Hora: ${evento.hora}</div>
                        <div class="mt-1">${evento.estado}</div>
                        <div class="text-primary small mt-1">Detalle ${evento.detalle}</div>
                    </div>
                </div>
            `;
            timelineContainer.appendChild(timelineItem);
        });
    }

    // Setup event listeners
    function setupEventListeners() {
        if (btnBuscar) {
            btnBuscar.addEventListener('click', handleSearch);
        }

        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', handleClear);
        }
    }

    // Handle search/filter
    function handleSearch() {
        const numero = searchNumero.value.trim().toLowerCase();
        const rut = searchRut.value.trim();
        const fecha = searchFecha.value;
        const estado = searchEstado.value;

        const filtered = solicitudesData.filter(solicitud => {
            const matchNumero = !numero || solicitud.numero.toLowerCase().includes(numero);
            const matchRut = !rut || solicitud.rut.includes(rut);
            const matchFecha = !fecha || solicitud.fechaIngreso === formatDate(fecha);
            const matchEstado = !estado || solicitud.estado === estado;

            return matchNumero && matchRut && matchFecha && matchEstado;
        });

        renderSolicitudes(filtered);
    }

    // Handle clear filters
    function handleClear() {
        searchNumero.value = '';
        searchRut.value = '';
        searchFecha.value = '';
        searchEstado.value = '';
        renderSolicitudes(solicitudesData);
    }

    // Format date from input (YYYY-MM-DD) to display format (DD/MM/YYYY)
    function formatDate(dateString) {
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    }
});

// Global function for download button (placeholder)
function descargarSolicitud(numero) {
    alert(`Descargando solicitud ${numero}...\n(Funcionalidad de mockup)`);
}
