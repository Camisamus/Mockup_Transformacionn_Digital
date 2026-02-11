<?php
$pageTitle = "Bandeja de Entrada";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Bandeja de Entrada</h2>
            <p class="text-muted mb-0">Gesti�n centralizada de tareas y solicitudes pendientes</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end text-end">
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
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="abrirModalCrearTarea()">
                        <i data-feather="plus" class="me-2"></i>
                        Nueva Tarea
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="window.location.href = 'bandeja_historial.php'">
                        <i data-feather="clock" class="me-2"></i>
                        Historial
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
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Pendientes</h6>
                        <h2 class="fw-bold mb-0" id="totalTareas">...</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-4 border-warning h-100"
                title="Tareas con fecha 3 d�as atr�s o m�s">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-4">
                        <i data-feather="alert-triangle" class="text-warning" style="width: 24px; height: 24px;"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small fw-bold text-uppercase mb-1">Tareas Atrasadas</h6>
                        <h2 class="fw-bold mb-0 text-warning" id="totalTareasAtrasadas">...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Table Layer -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tareas Pendientes</h5>
                <div class="pagination-info text-muted small">Mostrando tareas actuales</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaBandeja">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / T�tulo</th>
                            <th>Origen</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Fecha limite</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small" id="table-body">
                        <!-- Data loaded dynamically by bandeja.js -->
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Cargando tareas...</td>
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

    <!-- Tareas Assigned by me Table Layer -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Tareas Asignadas por m�</h5>
                <div class="pagination-info text-muted small" id="paginationInfoTareasQueAsigne"></div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaTareasQueAsigne">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Asunto / T�tulo</th>
                            <th>Responsable</th>
                            <th>Fecha</th>
                            <th>Fecha limite</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically by bandeja.js -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination controls -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnAnteriorAsigne" disabled>
                    <i data-feather="chevron-left" class="me-1"></i> Anterior
                </button>
                <button class="btn btn-sm btn-outline-secondary px-4 shadow-sm" id="btnSiguienteAsigne">
                    Siguiente <i data-feather="chevron-right" class="ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Crear tarea -->
<div class="modal fade" id="modalCrearTarea" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Crear Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form-crear-tarea">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="titulo" class="form-label small fw-bold">Asunto <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="tar_titulo" class="form-control" id="titulo" required
                                placeholder="T�tulo descriptivo">
                        </div>
                        <div class="col-12">
                            <label for="detalle" class="form-label small fw-bold">Descripci�n <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="tar_detalle" id="detalle" rows="3" required
                                placeholder="Detalle de la tarea"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="tar_plazo" class="form-label small fw-bold">Fecha L�mite <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="tar_plazo" class="form-control" id="tar_plazo" required>
                        </div>
                        <div class="col-md-6">
                            <label for="responsable" class="form-label small fw-bold">Responsable <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="responsable" id="responsable" required
                                    disabled placeholder="No asignado">
                                <button type="button" class="btn btn-dark" onclick="abrirModalBuscarFuncionario()">
                                    <i data-feather="search" style="width: 16px; height: 16px;"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" name="asignador" id="asignador" required hidden>
                            <input type="text" class="form-control" name="usr_id" id="usr_id" required hidden>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm" id="btnGuardarTarea"
                    onclick="guardarTarea()">Guardar Tarea</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Funcionario -->
<div class="modal fade" id="modalBusquedaFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Destino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group mb-4 shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i data-feather="search" class="text-muted" style="width: 16px; height: 16px;"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="buscar_fnc_input"
                        placeholder="Buscar por nombre o apellido...">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-end">Acci�n</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="small">
                            <!-- Dynamic -->
                        </tbody>
                    </table>
                </div>
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

<script src="../recursos/js/funcionarios/NO_Asignadas/bandeja.js"></script>

<?php include '../api/footer.php'; ?>