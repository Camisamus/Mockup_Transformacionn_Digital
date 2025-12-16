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

    // Check for tramitador URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const tramitadorFilter = urlParams.get('tramitador');

    // Load solicitudes data from JSON
    function loadSolicitudes() {
        fetch('../recursos/jsons/patentes_solicitudes_mock.json')
            .then(response => response.json())
            .then(data => {
                solicitudesData = data.solicitudes || [];

                // Apply tramitador filter if present
                let filteredData = solicitudesData;
                if (tramitadorFilter) {
                    filteredData = solicitudesData.filter(s =>
                        s.tramitador && s.tramitador.toUpperCase() === tramitadorFilter.toUpperCase()
                    );
                }

                renderSolicitudes(filteredData);
            })
            .catch(error => console.error('Error loading solicitudes:', error));
    }

    // Load historial data from JSON
    function loadHistorial() {
        fetch('../recursos/jsons/patentes_historial_mock.json')
            .then(response => response.json())
            .then(data => {
                historialData = data.historial || [];
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
                    <td colspan="8" class="text-center text-muted">No se encontraron solicitudes</td>
                </tr>
            `;
            return;
        }

        solicitudes.forEach(solicitud => {
            const row = document.createElement('tr');

            // Group Logic
            let grupoCell = '-';
            if (solicitud.total_grupo && solicitud.total_grupo > 1) {
                grupoCell = `
                    <button class="btn btn-sm btn-outline-info" onclick="verHermanas('${solicitud.grupo_id}')">
                        ${solicitud.posicion_grupo}/${solicitud.total_grupo} <i data-feather="users"></i>
                    </button>
                `;
            } else if (solicitud.total_grupo === 1) {
                grupoCell = '1/1';
            }

            row.innerHTML = `
                <td><a href="patentes_consulta_solicitud.html?id=${solicitud.numero}" class="text-primary fw-bold">${solicitud.numero}</a></td>
                <td>${solicitud.rut}</td>
                <td>${solicitud.fechaIngreso}</td>
                <td>${solicitud.tipoTramite || '-'}</td>
                <td>${grupoCell}</td>
                <td>${solicitud.tramitador || '-'}</td>
                <td><span class="badge ${solicitud.estadoClass}">${solicitud.estado}</span></td>
                <td><button class="btn btn-sm btn-outline-primary" onclick="descargarSolicitud('${solicitud.numero}')"><i data-feather="download"></i> Descargar</button></td>
            `;
            tbody.appendChild(row);
        });
        feather.replace();
    }

    // Modal Logic for Groups
    window.verHermanas = function (grupoId) {
        const siblings = solicitudesData.filter(s => s.grupo_id === grupoId);

        const modalBody = document.getElementById('modalHermanasBody');
        if (!modalBody) return; // Should be in HTML

        let html = `
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead><tr><th>Solicitud</th><th>Trámite</th><th>Estado</th></tr></thead>
                    <tbody>
        `;

        siblings.forEach(s => {
            html += `
                <tr>
                    <td>${s.numero}</td>
                    <td>${s.tipoTramite}</td>
                    <td><span class="badge ${s.estadoClass}">${s.estado}</span></td>
                </tr>
            `;
        });

        html += '</tbody></table></div>';
        modalBody.innerHTML = html;

        const modal = new bootstrap.Modal(document.getElementById('modalHermanas'));
        modal.show();
    };


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
        if (btnBuscar) btnBuscar.addEventListener('click', handleSearch);
        if (btnLimpiar) btnLimpiar.addEventListener('click', handleClear);
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

    function handleClear() {
        searchNumero.value = '';
        searchRut.value = '';
        searchFecha.value = '';
        searchEstado.value = '';
        renderSolicitudes(solicitudesData);
    }

    function formatDate(dateString) {
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    }
});

// Global function placeholder
function descargarSolicitud(numero) {
    alert(`Descargando solicitud ${numero}...\n(Funcionalidad de mockup)`);
}
