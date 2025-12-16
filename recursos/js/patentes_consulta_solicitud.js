// patentes_consulta_solicitud.js
// Handles search and display of patent solicitudes with group logic

let solicitudesData = [];
let currentSolicitud = null;

// Load mock data on page load
document.addEventListener('DOMContentLoaded', function () {
    loadSolicitudesData();
    setupEventListeners();

    // Check for ID parameter in URL
    const urlParams = new URLSearchParams(window.location.search);
    const solicitudId = urlParams.get('id');
    if (solicitudId) {
        // Wait for data to load, then search
        setTimeout(() => {
            document.getElementById('searchSolicitudId').value = solicitudId;
            searchSolicitud();
        }, 500);
    }
});

// Load solicitudes from mock JSON
async function loadSolicitudesData() {
    try {
        const response = await fetch('../recursos/jsons/patentes_solicitudes_mock.json');
        const data = await response.json();
        solicitudesData = data.solicitudes;
    } catch (error) {
        console.error('Error loading solicitudes data:', error);
    }
}

// Setup event listeners
function setupEventListeners() {
    // Search button
    document.getElementById('btnBuscar').addEventListener('click', searchSolicitud);

    // Clear button
    document.getElementById('btnLimpiar').addEventListener('click', clearSearch);

    // Enter key on search input
    document.getElementById('searchSolicitudId').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            searchSolicitud();
        }
    });

    // Load solicitud from group dropdown
    document.getElementById('btnCargarSolicitud').addEventListener('click', loadFromGroupSelect);

    // Auto-load when selecting from dropdown
    document.getElementById('selectGrupoSolicitudes').addEventListener('change', function () {
        if (this.value) {
            loadFromGroupSelect();
        }
    });
}

// Search for solicitud by ID or tramitador
function searchSolicitud() {
    const searchId = document.getElementById('searchSolicitudId').value.trim();
    const searchTramitador = document.getElementById('searchTramitador').value.trim();

    if (!searchId && !searchTramitador) {
        alert('Por favor ingrese un ID de solicitud o un tramitador');
        return;
    }

    let solicitud = null;

    // Priority: search by ID first if provided
    if (searchId) {
        solicitud = solicitudesData.find(s => s.numero.toLowerCase() === searchId.toLowerCase());
    } else if (searchTramitador) {
        // Search by tramitador - get first match
        solicitud = solicitudesData.find(s =>
            s.tramitador && s.tramitador.toLowerCase() === searchTramitador.toLowerCase()
        );
    }

    if (solicitud) {
        displaySolicitud(solicitud);
    } else {
        showNoResults();
    }

    // Refresh feather icons
    feather.replace();
}

// Display solicitud information
function displaySolicitud(solicitud) {
    currentSolicitud = solicitud;

    // Hide no results message
    document.getElementById('noResultsSection').classList.add('d-none');

    // Check if solicitud is part of a group
    if (solicitud.grupoId && solicitud.grupoSolicitudes.length > 0) {
        showGroupSection(solicitud);
    } else {
        hideGroupSection();
    }

    // Show solicitud content
    showSolicitudContent(solicitud);

    // Refresh feather icons
    feather.replace();
}

// Show group section for multi-tramite solicitudes
function showGroupSection(solicitud) {
    const groupSection = document.getElementById('groupSection');
    const selectElement = document.getElementById('selectGrupoSolicitudes');

    // Clear previous options
    selectElement.innerHTML = '<option value="">Seleccione una solicitud...</option>';

    // Add group solicitudes to dropdown
    solicitud.grupoSolicitudes.forEach(solicitudId => {
        const option = document.createElement('option');
        option.value = solicitudId;
        option.textContent = solicitudId;

        // Mark current solicitud
        if (solicitudId === solicitud.numero) {
            option.textContent += ' (Actual)';
            option.selected = true;
        }

        selectElement.appendChild(option);
    });

    // Show group section
    groupSection.classList.remove('d-none');
}

// Hide group section
function hideGroupSection() {
    document.getElementById('groupSection').classList.add('d-none');
}

// Load solicitud from group dropdown selection
function loadFromGroupSelect() {
    const selectedId = document.getElementById('selectGrupoSolicitudes').value;

    if (!selectedId) {
        return;
    }

    const solicitud = solicitudesData.find(s => s.numero === selectedId);

    if (solicitud) {
        displaySolicitud(solicitud);
    }
}

// Show solicitud content
function showSolicitudContent(solicitud) {
    const contentSection = document.getElementById('solicitudContentSection');

    // Update title
    document.getElementById('solicitudTitle').textContent = `Detalle de Solicitud: ${solicitud.numero}`;

    // Update information fields
    document.getElementById('infoNumero').textContent = solicitud.numero;
    document.getElementById('infoRut').textContent = solicitud.rut;
    document.getElementById('infoFecha').textContent = solicitud.fechaIngreso;
    document.getElementById('infoTramite').textContent = solicitud.tipoTramite;
    document.getElementById('infoGrupo').textContent = solicitud.grupo;
    document.getElementById('infoTramitador').textContent = solicitud.tramitador;

    // Update estado badge
    const estadoBadge = document.getElementById('infoEstado');
    estadoBadge.textContent = solicitud.estado;
    estadoBadge.className = `badge ${solicitud.estadoClass}`;

    // Generate form content (mock)
    generateFormContent(solicitud);

    // Generate timeline
    generateTimeline(solicitud);

    // Show content section
    contentSection.classList.remove('d-none');
}

// Generate mock form content
function generateFormContent(solicitud) {
    const container = document.getElementById('contenedorFormulario');

    // Clear previous content
    container.innerHTML = '';

    // Create mock form sections based on tramite type
    const formHTML = `
        <div class="section-card">
            <div class="section-title">Datos del Contribuyente</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">RUT</label>
                    <input type="text" class="form-control" value="${solicitud.rut}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nombre/Razón Social</label>
                    <input type="text" class="form-control" value="Empresa Ejemplo S.A." readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="contacto@ejemplo.cl" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" value="+56 9 1234 5678" readonly>
                </div>
            </div>
        </div>
        
        <div class="section-card">
            <div class="section-title">Dirección Comercial</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Región</label>
                    <input type="text" class="form-control" value="Región Metropolitana" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Comuna</label>
                    <input type="text" class="form-control" value="Santiago" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Calle</label>
                    <input type="text" class="form-control" value="Av. Libertador Bernardo O'Higgins" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Número</label>
                    <input type="text" class="form-control" value="1234" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Observaciones</label>
                    <input type="text" class="form-control" value="Oficina 501" readonly>
                </div>
            </div>
        </div>
        
        <div class="section-card">
            <div class="section-title">Información del Trámite</div>
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label">Tipo de Trámite</label>
                    <input type="text" class="form-control" value="${solicitud.tipoTramite}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giro Comercial</label>
                    <input type="text" class="form-control" value="Comercio al por menor" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Capital Propio</label>
                    <input type="text" class="form-control" value="$10.000.000" readonly>
                </div>
            </div>
        </div>
        
        <div class="section-card">
            <div class="section-title">Documentación Adjunta</div>
            <div class="alert alert-info">
                <i data-feather="paperclip" class="me-2"></i>
                <strong>Documentos presentados:</strong>
                <ul class="mb-0 mt-2">
                    <li>Cédula de Identidad del Representante Legal</li>
                    <li>Escritura de Constitución de Sociedad</li>
                    <li>Fotografías del Establecimiento (Interior y Exterior)</li>
                    <li>Certificado de Inicio de Actividades (SII)</li>
                    <li>Contrato de Arriendo o Título de Propiedad</li>
                </ul>
            </div>
        </div>
        
        <div class="section-card">
            <div class="section-title">Observaciones</div>
            <textarea class="form-control" rows="3" readonly>Solicitud ingresada correctamente. En proceso de revisión por el departamento correspondiente.</textarea>
        </div>
    `;

    container.innerHTML = formHTML;

    // Refresh feather icons
    feather.replace();
}

// Show no results message
function showNoResults() {
    // Hide other sections
    document.getElementById('groupSection').classList.add('d-none');
    document.getElementById('solicitudContentSection').classList.add('d-none');

    // Show no results message
    document.getElementById('noResultsSection').classList.remove('d-none');

    // Refresh feather icons
    feather.replace();
}

// Generate timeline for solicitud
function generateTimeline(solicitud) {
    const container = document.getElementById('timelineContainer');

    // Mock timeline data based on solicitud status
    const timelineEvents = [
        {
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '09:30',
            estado: 'Solicitud Ingresada',
            detalle: 'Solicitud recibida y registrada en el sistema'
        },
        {
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '10:15',
            estado: 'Documentación Revisada',
            detalle: 'Revisión inicial de documentos adjuntos'
        }
    ];

    // Add status-specific events
    if (solicitud.estado === 'En Proceso') {
        timelineEvents.push({
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '14:20',
            estado: 'En Proceso de Evaluación',
            detalle: 'Solicitud en revisión por el departamento técnico'
        });
    } else if (solicitud.estado === 'Aprobado') {
        timelineEvents.push({
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '16:45',
            estado: 'Aprobado',
            detalle: 'Solicitud aprobada. Pendiente emisión de certificado'
        });
    } else if (solicitud.estado === 'Rechazado') {
        timelineEvents.push({
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '15:30',
            estado: 'Rechazado',
            detalle: 'Solicitud rechazada. Documentación incompleta'
        });
    } else if (solicitud.estado === 'Pendiente') {
        timelineEvents.push({
            encargado: solicitud.tramitador,
            fecha: solicitud.fechaIngreso,
            hora: '11:00',
            estado: 'Pendiente de Información',
            detalle: 'Se requiere información adicional del solicitante'
        });
    }

    // Render timeline
    container.innerHTML = '';

    if (timelineEvents.length === 0) {
        container.innerHTML = '<div class="text-muted">No hay historial disponible</div>';
        return;
    }

    timelineEvents.forEach(evento => {
        const timelineItem = document.createElement('div');
        timelineItem.className = 'timeline-item';
        timelineItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>📋 Encargado(a): ${evento.encargado}</strong>
                    <div class="text-muted small">📅 Fecha: ${evento.fecha} ⏰ Hora: ${evento.hora}</div>
                    <div class="mt-1">${evento.estado}</div>
                    <div class="text-primary small mt-1">Detalle: ${evento.detalle}</div>
                </div>
            </div>
        `;
        container.appendChild(timelineItem);
    });
}

// Clear search and reset view
function clearSearch() {
    // Clear inputs
    document.getElementById('searchSolicitudId').value = '';
    document.getElementById('searchTramitador').value = '';

    // Hide all sections
    document.getElementById('groupSection').classList.add('d-none');
    document.getElementById('solicitudContentSection').classList.add('d-none');
    document.getElementById('noResultsSection').classList.add('d-none');

    // Reset current solicitud
    currentSolicitud = null;
}
