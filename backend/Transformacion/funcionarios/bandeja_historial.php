<?php
$pageTitle = "Bandeja de Entrada";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Historial de tareas</h2>
            <p class="text-muted mb-0">Consulta de tareas finalizadas</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm"
                        onclick="Swal.fire('Info', 'Funcionamiento de filtros...', 'info')">
                        <i data-feather="filter" class="me-2"></i>
                        Filtrar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm"
                        onclick="Swal.fire('Info', 'Exportando tareas...', 'info')">
                        <i data-feather="download" class="me-2"></i>
                        Exportar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="Swal.fire('Info', 'Nueva tarea...', 'info')">
                        <i data-feather="plus" class="me-2"></i>
                        Nueva Tarea
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Metrics (Standardized) -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-primary h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-4">
                        <i data-feather="check-circle" class="text-primary" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Históricas</h6>
                        <h2 class="fw-bold mb-0" id="totalTareas">...</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-success h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-4">
                        <i data-feather="award" class="text-success" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Completadas</h6>
                        <h2 class="fw-bold mb-0 text-success">Calculando...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Table Layer -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tareas Finalizadas</h5>
                <div class="pagination-info text-muted small">Mostrando historial</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaBandeja">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / Título</th>
                            <th>Origen</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="table-body">
                        <!-- Data loaded dynamically by bandeja.js -->
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Cargando historial...</td>
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

<!-- Scripts -->
<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/bandeja_historial.js"></script>

<?php include '../api/footer.php'; ?>