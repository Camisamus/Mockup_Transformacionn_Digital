<?php
$pageTitle = "Asignación Roles/Usuaios";
require_once '../../../../api/general/auth_check.php';
include '../../../../api/general/header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Asignación Usuarios / Perfiles</h2>
            <p class="text-muted mb-0">Gestión de perfiles asignados a usuarios y sus vigencias</p>
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
                        Nueva Asignación
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Filtrar por nombre de Usuario o Perfil</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="filter-text" class="form-label small fw-bold">Buscar</label>
                    <input type="text" class="form-control form-control-sm" id="filter-text"
                        placeholder="Ej: Juan o Administrador...">
                </div>
            </div>
        </div>
    </div>

    <!-- Listado -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Asignaciones</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle small" id="tablaDatos">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Vigencia (Inicio - T¿rmino)</th>
                            <th>Subrogante</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td colspan="5" class="text-center py-5">
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
                <h5 class="modal-title fw-bold fs-6" id="modalFormLabel">Nueva Asignación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="main-form">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Usuario <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control bg-light" id="entry-usuario-label" readonly
                                    placeholder="Seleccione Usuario...">
                                <input type="hidden" id="entry-usuario" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="abrirModalSeleccion('usuario', 'entry-usuario')">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Perfil <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control bg-light" id="entry-perfil-label" readonly
                                    placeholder="Seleccione Perfil...">
                                <input type="hidden" id="entry-perfil" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="abrirModalSeleccion('perfil', 'entry-perfil')">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Fecha Inicio</label>
                            <input type="datetime-local" class="form-control" id="entry-inicio">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Fecha Término</label>
                            <input type="datetime-local" class="form-control" id="entry-termino">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Usuario Subrogante</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control bg-light" id="entry-subrogante-label" readonly
                                    placeholder="Sin Subrogante">
                                <input type="hidden" id="entry-subrogante">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="abrirModalSeleccion('usuario', 'entry-subrogante')">
                                    <i data-feather="search"></i>
                                </button>
                                <button class="btn btn-outline-danger" type="button"
                                    onclick="limpiarSeleccion('entry-subrogante')">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btn-save">Guardar Asignación</button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-list-container {
        max-height: 400px;
        overflow-y: auto;
    }
    .modal-list-item {
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .modal-list-item:hover {
        background-color: #f8f9fa;
    }
</style>

<!-- Modal Buscar Usuario -->
<div class="modal fade" id="modal-buscar-usuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="text" class="form-control form-control-sm mb-3" id="input-buscar-usuario-modal" placeholder="Filtrar por nombre o RUT...">
                <div class="modal-list-container border rounded">
                    <table class="table table-sm table-hover mb-0">
                        <tbody id="lista-usuarios-modal">
                            <!-- Se llena por JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Perfil -->
<div class="modal fade" id="modal-buscar-perfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <input type="text" class="form-control form-control-sm mb-3" id="input-buscar-perfil-modal" placeholder="Filtrar por nombre de perfil...">
                <div class="modal-list-container border rounded">
                    <table class="table table-sm table-hover mb-0">
                        <tbody id="lista-perfiles-modal">
                            <!-- Se llena por JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../../../../recursos/js/funcionarios/sisadmin/mantenedores/acceso/usuarios_roles.js"></script>

<?php include '../../../../api/general/footer.php'; ?>