<?php
$pageTitle = "Mantenedor Or¿genes Especiales";
require_once '../../../../api/auth_check.php';
include '../../header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Mantenedor de Or¿genes Especiales</h2>
            <p class="text-muted mb-0">Gestión de organizaciones externas y entidades p¿blicas relacionadas</p>
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
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" id="btn-new-origin">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo Origen
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Refine el listado de or¿genes por nombre o tipo</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="filter-name" class="form-label small fw-bold">Nombre del Origen</label>
                    <input type="text" class="form-control form-control-sm" id="filter-name"
                        placeholder="Ej: Dirección de Obras">
                </div>
                <div class="col-md-6">
                    <label for="filter-type" class="form-label small fw-bold">Tipo de Organización</label>
                    <select class="form-select form-select-sm" id="filter-type">
                        <option value="">Todos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Or¿genes</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaOrigenes">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Nombre</th>
                            <th>Tipo de Organización</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="small">
                        <!-- Content loaded dynamically -->
                        <tr>
                            <td colspan="4" class="text-center py-5">
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
<div class="modal fade" id="modal-origin" tabindex="-1" aria-labelledby="modalOriginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6" id="modalOriginLabel">Nuevo Origen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-origin">
                    <input type="hidden" id="origin-id">
                    <div class="mb-3">
                        <label for="origin-name" class="form-label small fw-bold">Nombre del Origen <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="origin-name" required
                            placeholder="Nombre descriptivo">
                    </div>
                    <div class="mb-0">
                        <label for="origin-type" class="form-label small fw-bold">Tipo de Organización <span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="origin-type" required>
                            <option value="">Seleccione un tipo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btn-save-origin">Guardar
                    Origen</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script
    src="../../../../recursos/js/funcionarios/sisadmin/mantenedores/desve/sisadmin_mantenedor_desve_oigenesespeciales.js"></script>

<?php include '../../../../api/footer.php'; ?>