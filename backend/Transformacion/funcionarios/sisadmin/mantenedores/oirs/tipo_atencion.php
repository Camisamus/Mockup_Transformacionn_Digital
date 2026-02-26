<?php
$pageTitle = "Mantenedor Tipos de Atención OIRS";
require_once '../../../../api/auth_check.php';
include '../../header.php';
?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Tipos de Atención OIRS</h2>
            <p class="text-muted mb-0">Gestión de tipos de atención para solicitudes OIRS</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" onclick="loadData()">
                        <i data-feather="refresh-cw" class="me-2"></i>
                        Actualizar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" id="btn-new">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo Tipo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Filtrar por Nombre de Tipo</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="filter-text" class="form-label small fw-bold">Buscar</label>
                    <input type="text" class="form-control form-control-sm" id="filter-text"
                        placeholder="Ej: Consulta, Reclamo...">
                </div>
            </div>
        </div>
    </div>

    <!-- Listado -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tipos de Atención</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle small" id="tablaDatos">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                                Cargando datos...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Create/Edit -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6" id="modalFormLabel">Nuevo Tipo de Atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="main-form">
                    <input type="hidden" id="entry-id">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Nombre del Tipo <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="entry-nombre" required
                                placeholder="Ej: Consulta">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btn-save">Guardar Tipo</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../../../../recursos/js/funcionarios/sisadmin/mantenedores/oirs/oirs_tipo_atencion.js"></script>

<?php include '../../../../api/footer.php'; ?>