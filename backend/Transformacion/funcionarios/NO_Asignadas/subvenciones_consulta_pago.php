<?php
$pageTitle = "Consulta de Pago";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta de Pago</h2>
            <p class="text-muted mb-0">Buscar, crear o modificar registros de pagos de subvenciones</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" onclick="buscarPago()">
                        <i data-feather="search" class="me-2"></i>
                        Buscar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-success w-100 shadow-sm" onclick="nuevoPago()">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo Pago
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm" onclick="imprimirPDF()">
                        <i data-feather="file" class="me-2"></i>
                        Imprimir PDF
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="guardarCambios()">
                        <i data-feather="save" class="me-2"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Datos del Pago -->
    <div class="card shadow-sm border-0 mb-4 mx-auto" id="datos_pago_card" style="display: none; max-width: 800px;">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-1">Detalles del Pago</h3>
            <p class="text-muted small mb-4">Informaci�n t�cnica y administrativa del pago realizado</p>

            <form id="formPago" onsubmit="event.preventDefault(); guardarCambios();">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="pago_numero" class="form-label small fw-bold">N�mero Subvenci�n</label>
                        <input type="text" class="form-control" id="pago_numero" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="pago_fecha_evento" class="form-label small fw-bold">Fecha Evento</label>
                        <input type="date" class="form-control" id="pago_fecha_evento" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="pago_estado" class="form-label small fw-bold">Estado Evento</label>
                        <input type="text" class="form-control" id="pago_estado" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="pago_fecha_digitalizacion" class="form-label small fw-bold">Fecha
                            Digitalizaci�n</label>
                        <input type="date" class="form-control" id="pago_fecha_digitalizacion" readonly>
                    </div>

                    <div class="col-12">
                        <label for="pago_responsable" class="form-label small fw-bold">Responsable Evento</label>
                        <input type="text" class="form-control" id="pago_responsable" readonly>
                    </div>

                    <div class="col-12">
                        <label for="pago_glosa" class="form-label small fw-bold">Glosa Evento</label>
                        <input type="text" class="form-control" id="pago_glosa" readonly>
                    </div>

                    <div class="col-12">
                        <label for="pago_observaciones" class="form-label small fw-bold">Observaciones</label>
                        <textarea class="form-control" id="pago_observaciones" rows="3" readonly></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/subvenciones_consulta_pago.js"></script>


<?php include '../../api/footer.php'; ?>