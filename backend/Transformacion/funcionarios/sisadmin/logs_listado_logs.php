<?php
$pageTitle = "Listado de Logs";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Listado de Logs</h2>
            <p class="text-muted mb-0">Visualizaci�n y gesti�n de eventos de auditor�a del sistema</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-success w-100 shadow-sm"
                        onclick="Swal.fire('Info', 'Exportando logs...', 'info')">
                        <i data-feather="file-text" class="me-2"></i>
                        Exportar Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros de B�squeda -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de B�squeda</h5>
            <p class="text-muted small mb-4">Filtre los eventos por fecha, tipo o m�dulo</p>

            <form id="formFiltros" onsubmit="event.preventDefault(); buscarLogs();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filtro_fecha_desde" class="form-label small fw-bold">Fecha Desde</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_desde">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_hasta" class="form-label small fw-bold">Fecha Hasta</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_hasta">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_tipo" class="form-label small fw-bold">Tipo de Evento</label>
                        <select class="form-select form-select-sm" id="filtro_tipo">
                            <option value="">Todos</option>
                            <option value="info">Informaci�n</option>
                            <option value="warning">Advertencia</option>
                            <option value="error">Error</option>
                            <option value="critical">Cr�tico</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_modulo" class="form-label small fw-bold">M�dulo</label>
                        <select class="form-select form-select-sm" id="filtro_modulo">
                            <option value="">Todos</option>
                            <option value="organizaciones">Organizaciones</option>
                            <option value="patentes">Patentes</option>
                            <option value="subvenciones">Subvenciones</option>
                            <option value="postulaciones">Postulaciones</option>
                            <option value="atenciones">Atenciones</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="filtro_usuario" class="form-label small fw-bold">Usuario / Operador</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_usuario"
                            placeholder="Ej: jsmith">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm">
                            <i data-feather="search"></i>
                            Buscar
                        </button>
                        <button type="button" class="btn btn-link text-decoration-none text-muted small"
                            onclick="limpiarFiltros()">
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold fs-6">Eventos Registrados (<span id="resultados_count">0</span>)</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaLogs">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>ID</th>
                            <th>Fecha/Hora</th>
                            <th>Tipo</th>
                            <th>M�dulo</th>
                            <th>Usuario</th>
                            <th>Acci�n</th>
                            <th>Descripci�n</th>
                            <th>IP</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/sisadmin/logs_listado_logs.js"></script>


<?php include '../../api/footer.php'; ?>