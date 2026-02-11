<?php
$pageTitle = "Lista de Espera";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Lista de Espera</h2>
            <p class="text-muted mb-0">Atenciones pendientes de ser atendidas</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm">
                        <i data-feather="file-text" class="me-2"></i>
                        Exportar Excel
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm">
                        <i data-feather="file" class="me-2"></i>
                        Exportar PDF
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="location.reload()">
                        <i data-feather="refresh-cw" class="me-2"></i>
                        Actualizar Lista
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- M�tricas (Standardized) -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-primary h-100">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Total en Espera</h6>
                    <h2 class="fw-bold mb-0 text-primary">4</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-danger h-100">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Prioridad Alta</h6>
                    <h2 class="fw-bold mb-0 text-danger">1</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-info h-100">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Prioridad Normal</h6>
                    <h2 class="fw-bold mb-0 text-info">2</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-4 border-warning h-100">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Tiempo Promedio</h6>
                    <h2 class="fw-bold mb-0 text-warning">25m</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Atenciones en Espera -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <div>
                    <h5 class="fw-bold fs-6 mb-1">Atenciones en Espera</h5>
                    <p class="text-muted small mb-0">Listado ordenado por tiempo de espera</p>
                </div>
                <div class="text-muted small d-flex align-items-center gap-2">
                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                    <span>Actualizado hace 1 min</span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaEspera">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Prioridad</th>
                            <th>C�digo</th>
                            <th>Tipo</th>
                            <th>Organizaci�n</th>
                            <th>RUT</th>
                            <th>�rea</th>
                            <th>UV</th>
                            <th>Ingreso</th>
                            <th>Tiempo</th>
                            <th>Usuario</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically from atenciones_lista_espera_mock.json -->
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                                Cargando lista de espera...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-light border shadow-xs mt-4 d-flex align-items-center gap-3 mb-0">
                <div class="rounded-circle bg-info bg-opacity-10 p-2 text-info">
                    <i data-feather="info" style="width: 18px; height: 18px;"></i>
                </div>
                <div class="small">
                    <strong>Nota:</strong> Las atenciones se ordenan autom�ticamente por prioridad y tiempo de espera.
                    Las atenciones de <strong>alta prioridad</strong> se muestran primero para garantizar una respuesta
                    oportuna.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Atender Atenci�n -->
<div class="modal fade" id="modalAtender" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light border-0 p-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalTitle">Atender: AT-001234</h5>
                    <p class="text-muted small mb-0">Complete la informaci�n para procesar esta atenci�n</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Informaci�n de la Atenci�n -->
                <div class="card bg-light border-0 mb-4 shadow-xs">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-3 small d-flex align-items-center">
                            <i data-feather="user" class="me-2 text-primary" style="width: 14px;"></i>
                            Detalles de la Cita
                        </h6>
                        <div class="row g-3 small">
                            <div class="col-md-4">
                                <label class="d-block text-muted">Tipo:</label>
                                <span class="fw-bold">Consulta</span>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block text-muted">C�digo:</label>
                                <span class="fw-bold">AT-001234</span>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block text-muted">Fecha:</label>
                                <span class="fw-bold">2024-12-03 09:15</span>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block text-muted">Organizaci�n:</label>
                                <span class="fw-bold d-block">Junta de Vecinos N�1 El Progreso</span>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block text-muted">RUT:</label>
                                <span class="fw-bold">76.123.456-7</span>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block text-muted">�rea/UV:</label>
                                <span class="fw-bold">Desarrollo Social / UV-15</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form id="formAtender" onsubmit="event.preventDefault();">
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Descripci�n Original</label>
                        <div class="p-3 bg-white border rounded small text-muted shadow-xs">
                            Consulta sobre proceso de postulaci�n a subvenciones municipales
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Estado de la Atenci�n</label>
                            <select class="form-select">
                                <option>En Atenci�n</option>
                                <option>Completada</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Usuario Responsable</label>
                            <input type="text" class="form-control" value="Usuario Actual" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Soluci�n / Respuesta <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3"
                            placeholder="Describa la soluci�n proporcionada..."></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold">Observaciones Adicionales</label>
                        <textarea class="form-control" rows="2" placeholder="Observaciones adicionales..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 bg-light justify-content-end gap-2">
                <button type="button" class="btn btn-link text-decoration-none text-muted small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark px-4 shadow-sm">
                    Completar Atenci�n
                </button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/atenciones_lista_espera.js"></script>

<?php include '../../api/footer.php'; ?>