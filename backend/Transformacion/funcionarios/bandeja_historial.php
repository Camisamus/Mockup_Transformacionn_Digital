<?php
$pageTitle = "Historial de Solicitudes";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Historial de Solicitudes</h2>
            <p class="text-muted mb-0">Consulta de solicitudes cerradas</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" id="btnFiltrar">
                        <i data-feather="filter" class="me-2"></i>
                        Filtrar por Fechas
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm"
                        onclick="Swal.fire('Info', 'Exportando historial...', 'info')">
                        <i data-feather="download" class="me-2"></i>
                        Exportar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="window.location.href = 'bandeja.php'">
                        <i data-feather="arrow-left" class="me-2"></i>
                        Volver a Bandeja
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Metrics (Standardized) -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-success h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-4">
                        <i data-feather="check-circle" class="text-success" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Solicitudes Cerradas</h6>
                        <h2 class="fw-bold mb-0" id="totalSolicitudes">...</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-info h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-4">
                        <i data-feather="calendar" class="text-info" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Rango de Fechas</h6>
                        <h6 class="fw-bold mb-0 text-info" id="rangoFechas">Últimos 30 días</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 border-start border-4 border-primary h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-4">
                        <i data-feather="award" class="text-primary" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Cerrados</h6>
                        <h2 class="fw-bold mb-0 text-primary" id="totalCerrados">...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Table Layer -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Solicitudes Cerradas</h5>
                <div class="pagination-info text-muted small">Mostrando historial</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaBandeja">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / Título</th>
                            <th>Origen</th>
                            <th>Responsable</th>
                            <th>Fecha Recepción</th>
                            <th>Fecha Cierre</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="table-body">
                        <!-- Data loaded dynamically by bandeja_historial.js -->
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Cargando historial...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination controls -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnAnterior" disabled>
                    <i data-feather="chevron-left" class="me-1"></i> Anterior
                </button>
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnSiguiente">
                    Siguiente <i data-feather="chevron-right" class="ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Filtrar por Fechas -->
<div class="modal fade" id="modalFiltrarFechas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Filtrar por Rango de Fechas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formFiltrarFechas">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="fechaInicio" class="form-label small fw-bold">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" required>
                        </div>
                        <div class="col-12">
                            <label for="fechaFin" class="form-label small fw-bold">Fecha Fin</label>
                            <input type="date" class="form-control" id="fechaFin" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-secondary px-4 shadow-sm" id="btnLimpiarFiltro">
                    Limpiar Filtro
                </button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btnAplicarFiltro">
                    Aplicar Filtro
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/funcionarios/NO_Asignadas/bandeja_historial.js"></script>

<?php include '../api/footer.php'; ?>