<?php
$pageTitle = "Bandeja Ingresos";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Bandeja de Ingresos</h2>
            <p class="text-muted mb-0">Gestión y búsqueda de solicitudes de ingreso</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='ingr_crear.php'">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo Ingreso
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-3">Filtros de Búsqueda</h5>
            <form id="form_filtros" class="row g-3">
                <div class="col-md-4">
                    <label for="filtro_titulo" class="form-label small fw-bold">Título</label>
                    <input type="text" class="form-control" id="filtro_titulo" placeholder="Buscar por título...">
                </div>
                <div class="col-md-3">
                    <label for="filtro_rgt" class="form-label small fw-bold">ID Público (RGT)</label>
                    <input type="text" class="form-control" id="filtro_rgt" placeholder="Cód. RGT...">
                </div>
                <div class="col-md-2">
                    <label for="filtro_id" class="form-label small fw-bold">ID Interno</label>
                    <input type="number" class="form-control" id="filtro_id" placeholder="ID...">
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit"
                        class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <i data-feather="search" style="width: 16px; height: 16px;"></i>
                        Buscar
                    </button>
                    <button type="reset" class="btn btn-outline-secondary shadow-sm" id="btn_limpiar">
                        <i data-feather="refresh-cw" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Ingresos</h5>
                <div class="pagination-info text-muted small">Mostrando registros recientes</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th class="text-end pe-4">Acciones</th>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Asignación</th>
                            <th>Cód. Público</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_ingresos" class="small">
                        <!-- Dynamic -->
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
                                <span class="ms-2 text-muted">Cargando ingresos...</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="pagination_container" class="py-3 border-top d-flex justify-content-end"></div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/ingresos/ingr_bandeja.js"></script>

<?php include '../../api/footer.php'; ?>