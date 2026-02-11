<?php
$pageTitle = "Mantenedor General de Contribuyentes";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Mantenedor de Contribuyentes</h2>
            <p class="text-muted mb-0">Gestión de contribuyentes generales del sistema</p>
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
                        Nuevo Contribuyente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Busque por RUT o Nombre</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="filter-text" class="form-label small fw-bold">Buscar</label>
                    <input type="text" class="form-control form-control-sm" id="filter-text"
                        placeholder="Ej: 11111111-1 o Juan Perez">
                </div>
            </div>
        </div>
    </div>

    <!-- Listado -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Contribuyentes</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaDatos">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="small">
                        <!-- Content loaded dynamically -->
                        <tr>
                            <td colspan="6" class="text-center py-5">
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
                <h5 class="modal-title fw-bold fs-6" id="modalFormLabel">Nuevo Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="main-form">
                    <input type="hidden" id="entry-id">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="entry-rut" class="form-label small fw-bold">RUT <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="entry-rut" required placeholder="12345678-9">
                        </div>
                        <div class="col-12">
                            <label for="entry-nombre" class="form-label small fw-bold">Nombre <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="entry-nombre" required placeholder="Nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="entry-paterno" class="form-label small fw-bold">Apellido Paterno</label>
                            <input type="text" class="form-control" id="entry-paterno" placeholder="Apellido P.">
                        </div>
                        <div class="col-md-6">
                            <label for="entry-materno" class="form-label small fw-bold">Apellido Materno <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="entry-materno" required
                                placeholder="Apellido M.">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btn-save">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/sisadmin/sisadmin_mantenedor_general_contribuyentes.js"></script>

<?php include '../../api/footer.php'; ?>