<?php
$pageTitle = "Tomar Atenci�n";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Tomar Atenci�n</h2>
            <p class="text-muted mb-0">Selecciona una atenci�n en espera para atenderla</p>
        </div>
        <div class="toolbar">
            <button class="btn btn-toolbar" onclick="location.reload()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 4v6h-6"></path>
                    <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                </svg>
                Actualizar
            </button>
        </div>
    </div>

    <!-- M�tricas -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="metric-card shadow-sm border-0">
                <div>
                    <div class="metric-label">En Espera</div>
                    <div class="metric-value">2</div>
                </div>
                <i data-feather="clock" class="text-warning" style="width: 32px; height: 32px;"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card shadow-sm border-0">
                <div>
                    <div class="metric-label">En Atenci�n</div>
                    <div class="metric-value">0</div>
                </div>
                <i data-feather="user" class="text-info" style="width: 32px; height: 32px;"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card shadow-sm border-0">
                <div>
                    <div class="metric-label">Completadas Hoy</div>
                    <div class="metric-value">8</div>
                </div>
                <i data-feather="check-circle" class="text-success" style="width: 32px; height: 32px;"></i>
            </div>
        </div>
    </div>

    <!-- Atenciones Disponibles -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-1">Atenciones Disponibles</h3>
            <p class="text-muted small mb-4">Selecciona una atenci�n para comenzar a atenderla</p>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaTomarAtencion">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>C�digo</th>
                            <th>Tipo</th>
                            <th>Organizaci�n</th>
                            <th>RUT</th>
                            <th>�rea</th>
                            <th>Tiempo Espera</th>
                            <th>Descripci�n</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <!-- Data loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Atender Atenci�n -->
<div class="modal fade" id="modalAtender" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header border-0 pb-0 p-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalTitle">Atender: AT-001234</h5>
                    <p class="text-muted small mb-0">Complete la informaci�n para procesar esta atenci�n</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">

                <!-- Informaci�n de la Atenci�n -->
                <div class="card bg-white border-0 shadow-sm mb-4" style="background-color: #f8f9fa !important;">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-3 small">Detalles de la Cita</h6>

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
                                <span class="fw-bold d-block">Junta de Vecinos N°1 El Progreso</span>
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
                <form id="formAtender" onsubmit="event.preventDefault(); window.completarAtencion();">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Descripci�n Original</label>
                        <div class="p-2 bg-light rounded small text-muted">Consulta sobre proceso de postulaci�n a
                            subvenciones municipales</div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Estado de la Atenci�n</label>
                            <select class="form-select form-select-sm">
                                <option>En Atenci�n</option>
                                <option>Completada</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Usuario Responsable</label>
                            <input type="text" class="form-control form-control-sm" value="Usuario Actual" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Soluci�n / Respuesta <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" placeholder="Describa la soluci�n proporcionada..."
                            required></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold">Observaciones Adicionales</label>
                        <textarea class="form-control" rows="2" placeholder="Observaciones adicionales..."></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer border-0 p-4 justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formAtender" class="btn btn-dark px-4">
                    Completar Atenci�n
                </button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/atenciones_tomar_atencion.js"></script>


<?php include '../../api/footer.php'; ?>