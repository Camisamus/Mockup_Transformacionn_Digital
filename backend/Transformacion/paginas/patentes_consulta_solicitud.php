<?php
$pageTitle = "Consulta de Solicitud";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

    <div class="container-fluid">
        <h2 class="mb-4">Consulta de Solicitud</h2>

        <!-- Search Section -->
        <div class="section-card">
            <div class="section-title">Buscar Solicitud</div>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">ID de Solicitud</label>
                    <input type="text" class="form-control" id="searchSolicitudId" placeholder="Ej: PC-2024-001">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tramitador</label>
                    <input type="text" class="form-control" id="searchTramitador" placeholder="Ej: JUAN">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" id="btnBuscar">
                        <i data-feather="search" class="me-1"></i> Buscar
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-secondary w-100" id="btnLimpiar">
                        <i data-feather="x" class="me-1"></i> Limpiar
                    </button>
                </div>
            </div>
            <div class="mt-2">
                <small class="text-muted">
                    <i data-feather="info" style="width: 14px; height: 14px;"></i>
                    Puede buscar por ID de solicitud o por tramitador. Si ingresa ambos, se buscará por ID.
                </small>
            </div>
        </div>

        <!-- Group Information Section (Hidden by default) -->
        <div class="section-card d-none" id="groupSection">
            <div class="group-alert">
                <div class="d-flex align-items-center mb-2">
                    <i data-feather="users" class="me-2"></i>
                    <strong>Esta solicitud es parte de un grupo (multi-trámite)</strong>
                </div>
                <p class="mb-2 small">Esta solicitud está vinculada con otras solicitudes del mismo grupo.
                    Seleccione una solicitud del grupo para ver su contenido:</p>
                <div class="row g-2 align-items-center">
                    <div class="col-md-8">
                        <label class="form-label mb-1 small">Solicitudes del Grupo:</label>
                        <select class="form-select" id="selectGrupoSolicitudes">
                            <option value="">Seleccione una solicitud...</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-sm btn-primary w-100" id="btnCargarSolicitud" style="margin-top: 24px;">
                            <i data-feather="eye" class="me-1"></i> Ver Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solicitud Content Section (Hidden by default) -->
        <div id="solicitudContentSection" class="d-none">
            <!-- Header with actions -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0" id="solicitudTitle">Detalle de Solicitud</h4>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-danger" onclick="window.print()">
                        <i data-feather="file" class="me-1"></i> Exportar PDF
                    </button>
                </div>
            </div>

            <!-- Solicitud Information Card -->
            <div class="section-card">
                <div class="section-title">Información General</div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Número de Solicitud</label>
                        <div class="fw-bold" id="infoNumero">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small">RUT Solicitante</label>
                        <div class="fw-bold" id="infoRut">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Fecha de Ingreso</label>
                        <div class="fw-bold" id="infoFecha">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Estado</label>
                        <div>
                            <span class="badge" id="infoEstado">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Tipo de Trámite</label>
                        <div class="fw-bold" id="infoTramite">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Grupo</label>
                        <div class="fw-bold" id="infoGrupo">-</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small">Tramitador</label>
                        <div class="fw-bold" id="infoTramitador">-</div>
                    </div>
                </div>
            </div>

            <!-- Form Content Container -->
            <div id="contenedorFormulario">
                <!-- Dynamic form content will be loaded here -->
            </div>

            <!-- Timeline/Bitácora Section -->
            <div class="section-card">
                <div class="section-title">Bitácora de la Solicitud</div>
                <div id="timelineContainer">
                    <!-- Timeline loaded dynamically -->
                </div>
            </div>
        </div>

        <!-- No Results Message (Hidden by default) -->
        <div class="section-card d-none" id="noResultsSection">
            <div class="alert alert-warning mb-0">
                <i data-feather="alert-circle" class="me-2"></i>
                No se encontró ninguna solicitud con el ID especificado.
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <script>feather.replace()</script>
    <script src="../recursos/js/patentes_consulta_solicitud.js"></script>

<?php include '../api/footer.php'; ?>

