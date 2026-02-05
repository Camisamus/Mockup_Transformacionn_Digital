<?php
$pageTitle = "Mantenedor Org. Comunitarias";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid py-4">
        <!-- Header & Toolbar -->
        <div class="main-header mb-4">
            <div class="header-title">
                <h2 class="fw-bold fs-4">Orgs. Comunitarias</h2>
                <p class="text-muted mb-0">Gestión de organizaciones comunitarias y sus representantes</p>
            </div>
            <div class="toolbar">
                <button class="btn btn-toolbar" onclick="loadData()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 4v6h-6"></path>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    Actualizar
                </button>
                <button class="btn btn-toolbar btn-dark" id="btn-new">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nueva Organización
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
                <p class="text-muted small mb-4">Filtrar por RUT de organización o Nombre</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="filter-text" class="form-label small fw-bold">Buscar</label>
                        <input type="text" class="form-control form-control-sm" id="filter-text"
                            placeholder="Ej: 11111111-1 o Club Deportivo...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold fs-6 mb-0">Listado de Organizaciones</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle small" id="tablaDatos">
                        <thead class="table-light text-uppercase">
                            <tr>
                                <th>RUT Org</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Rep. Legal</th>
                                <th>Inscripción</th>
                                <th>Vigencia</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Content loaded dynamically -->
                            <tr>
                                <td colspan="7" class="text-center py-5">
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold fs-6" id="modalFormLabel">Nueva Organización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="main-form">
                        <input type="hidden" id="entry-id">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">RUT Organización <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="entry-rut" required
                                    placeholder="12345678-9">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Nombre <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="entry-nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Tipo Organización <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="entry-tipo" required>
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Representante Legal <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="entry-replegal" style="width: 100%;" required>
                                    <option value="">Seleccione contribuyente</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Fecha Inscripción <span
                                        class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" id="entry-inscripcion" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Fecha Vigencia</label>
                                <input type="date" class="form-control" id="entry-vigencia">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">RPJ</label>
                                <input type="text" class="form-control" id="entry-rpj">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Código</label>
                                <input type="text" class="form-control" id="entry-codigo">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Unidad Vecinal</label>
                                <input type="text" class="form-control" id="entry-unidad">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        feather.replace();
    </script>
    
    <script src="../recursos/js/sisadmin_mantenedor_general_org_comunitarias.js"></script>

<?php include '../api/footer.php'; ?>

