<?php
$pageTitle = "Consulta de Log";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Detalle de Log</h2>
            <p class="text-muted mb-0">Información técnica detallada del evento registrado</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" onclick="buscarLog()">
                        <i data-feather="search" class="me-2"></i>
                        Buscar Otro
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="Swal.fire('PDF', 'Generando reporte...', 'info')">
                        <i data-feather="file" class="me-2"></i>
                        Exportar PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detalle de Log -->
    <div class="card shadow-sm border-0 mb-4 mx-auto" style="max-width: 900px;">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Información del Evento</h5>
            <p class="text-muted small mb-4">Datos capturados por el sistema de auditor¿a</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="log_id" class="form-label small fw-bold">ID del Log</label>
                    <input type="text" class="form-control form-control-sm text-primary fw-bold" id="log_id" readonly>
                </div>
                <div class="col-md-6">
                    <label for="log_fecha" class="form-label small fw-bold">Fecha y Hora</label>
                    <input type="datetime-local" class="form-control form-control-sm" id="log_fecha" readonly>
                </div>

                <div class="col-md-6">
                    <label for="log_tipo" class="form-label small fw-bold">Tipo de Evento</label>
                    <input type="text" class="form-control form-control-sm" id="log_tipo" readonly>
                </div>
                <div class="col-md-6">
                    <label for="log_severidad" class="form-label small fw-bold">Severidad</label>
                    <input type="text" class="form-control form-control-sm" id="log_severidad" readonly>
                </div>

                <div class="col-md-6">
                    <label for="log_usuario" class="form-label small fw-bold">Usuario Responsable</label>
                    <input type="text" class="form-control form-control-sm" id="log_usuario" readonly>
                </div>
                <div class="col-md-6">
                    <label for="log_modulo" class="form-label small fw-bold">M¿dulo de Origen</label>
                    <input type="text" class="form-control form-control-sm" id="log_modulo" readonly>
                </div>

                <div class="col-md-6">
                    <label for="log_accion" class="form-label small fw-bold">Acción Ejecutada</label>
                    <input type="text" class="form-control form-control-sm" id="log_accion" readonly>
                </div>
                <div class="col-md-6">
                    <label for="log_ip" class="form-label small fw-bold">Dirección IP</label>
                    <input type="text" class="form-control form-control-sm" id="log_ip" readonly>
                </div>

                <div class="col-12">
                    <label for="log_descripcion" class="form-label small fw-bold">Descripción del Evento</label>
                    <textarea class="form-control form-control-sm" id="log_descripcion" rows="3" readonly></textarea>
                </div>

                <div class="col-12">
                    <label for="log_detalles" class="form-label small fw-bold">Detalles T¿cnicos / Stack
                        Trace</label>
                    <textarea class="form-control form-control-sm bg-light font-monospace small" id="log_detalles"
                        rows="6" readonly></textarea>
                </div>

                <div class="col-md-6">
                    <label for="log_resultado" class="form-label small fw-bold">Resultado de la Operación</label>
                    <input type="text" class="form-control form-control-sm" id="log_resultado" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mb-5">
        <button type="button" class="btn btn-outline-secondary px-4 shadow-sm" onclick="window.history.back()">
            Volver al Listado
        </button>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/sisadmin/logs_consulta_log.js"></script>


<?php include '../../api/footer.php'; ?>