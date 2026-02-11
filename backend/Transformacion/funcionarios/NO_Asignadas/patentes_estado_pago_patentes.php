<?php
$pageTitle = "Estado de Pago - Patentes";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Periodos Adeudados Patentes Municipales</h2>
            <p class="text-muted mb-0">Consulte deudas, pagos anteriores e informaci�n hist�rica de sus patentes</p>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6 border-end">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-light p-2 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-primary">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">76.543.210-K</h6>
                            <p class="text-muted mb-0 small text-uppercase">RUT Contribuyente</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ps-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-light p-2 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-primary">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="9" y1="3" x2="9" y2="21"></line>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-uppercase">COMERCIALIZADORA EJEMPLO SPA</h6>
                            <p class="text-muted mb-0 small text-uppercase">Nombre o Raz�n Social</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-pills mb-4 gap-2" id="paymentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4 shadow-sm" id="debt-tab" data-bs-toggle="tab"
                data-bs-target="#debt" type="button" role="tab" aria-selected="true">
                <i data-feather="alert-circle" class="me-1" style="width: 16px;"></i> Patentes Adeudadas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 shadow-sm" id="paid-tab" data-bs-toggle="tab"
                data-bs-target="#paid" type="button" role="tab" aria-selected="false">
                <i data-feather="check-circle" class="me-1" style="width: 16px;"></i> Patentes Pagadas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 shadow-sm" id="history-tab" data-bs-toggle="tab"
                data-bs-target="#history" type="button" role="tab" aria-selected="false">
                <i data-feather="clock" class="me-1" style="width: 16px;"></i> Informaci�n Hist�rica
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="paymentTabsContent">
        <!-- Debt Tab -->
        <div class="tab-pane fade show active" id="debt" role="tabpanel" aria-labelledby="debt-tab">

            <!-- Summary Boxes -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 text-uppercase small text-muted">Totales Deuda por RUT</h6>
                            <div class="row text-center">
                                <div class="col-4 border-end">
                                    <div class="h5 mb-0 fw-bold">$0</div>
                                    <div class="small text-muted text-uppercase" style="font-size: 0.7rem;">Total
                                        Deuda</div>
                                </div>
                                <div class="col-4 border-end">
                                    <div class="h5 mb-0 fw-bold">0</div>
                                    <div class="small text-muted text-uppercase" style="font-size: 0.7rem;">N°
                                        Patentes</div>
                                </div>
                                <div class="col-4">
                                    <div class="h5 mb-0 fw-bold">0</div>
                                    <div class="small text-muted text-uppercase" style="font-size: 0.7rem;">N°
                                        Giros</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 text-uppercase small opacity-75">Seleccionado para Pago</h6>
                            <div class="row text-center">
                                <div class="col-4 border-end border-white border-opacity-25">
                                    <div class="h5 mb-0 fw-bold">$0</div>
                                    <div class="small text-white text-opacity-75 text-uppercase"
                                        style="font-size: 0.7rem;">Total a Pagar</div>
                                </div>
                                <div class="col-4 border-end border-white border-opacity-25">
                                    <div class="h5 mb-0 fw-bold">0</div>
                                    <div class="small text-white text-opacity-75 text-uppercase"
                                        style="font-size: 0.7rem;">N° Patentes</div>
                                </div>
                                <div class="col-4">
                                    <div class="h5 mb-0 fw-bold">0</div>
                                    <div class="small text-white text-opacity-75 text-uppercase"
                                        style="font-size: 0.7rem;">N° Giros</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Table -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-uppercase small fw-bold">
                                <th class="ps-3">Patente</th>
                                <th>Tipo</th>
                                <th>Emis</th>
                                <th>Periodo</th>
                                <th>F.Venc.</th>
                                <th>F.Plazo</th>
                                <th>Neto</th>
                                <th>IPC</th>
                                <th>Multa</th>
                                <th>Total</th>
                                <th class="text-center pe-3">Pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="11" class="text-center py-5">
                                    <div class="text-muted">
                                        <i data-feather="check-circle" class="mb-2 text-success d-block mx-auto"
                                            style="width: 32px; height: 32px;"></i>
                                        Ud. no registra deudas pendientes
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-3">
                    <div class="row g-2 justify-content-md-end">
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-toolbar btn-outline-warning w-100 shadow-sm fw-bold">
                                Borrar Selecci�n
                            </button>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-toolbar btn-outline-secondary w-100 shadow-sm fw-bold">
                                ⮨ Salir
                            </button>
                        </div>
                        <div class="col-12 col-md-auto">
                            <button class="btn btn-toolbar btn-dark w-100 shadow-sm fw-bold px-4">
                                Iniciar Pago
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paid Tab -->
        <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-uppercase small text-muted">Historial de Patentes Pagadas</h6>
                    <div class="btn-group">
                        <button class="btn btn-outline-success btn-sm px-3"
                            onclick="exportTableToExcel('tablaPagadas', 'patentes_pagadas')">
                            <i data-feather="file-text" class="me-1" style="width: 14px;"></i> Excel
                        </button>
                        <button class="btn btn-outline-danger btn-sm px-3"
                            onclick="exportElementToPDF('tablaPagadas', 'patentes_pagadas')">
                            <i data-feather="file" class="me-1" style="width: 14px;"></i> PDF
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tablaPagadas">
                        <thead class="bg-light">
                            <tr class="text-uppercase small fw-bold">
                                <th class="ps-3">N°Patente</th>
                                <th>Tipo</th>
                                <th>Periodo</th>
                                <th>Pagado En</th>
                                <th>Total</th>
                                <th>Vencimiento</th>
                                <th class="text-center pe-3">Acci�n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- History Tab -->
        <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
            <div class="card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <div class="opacity-25 mb-3">
                        <i data-feather="database" style="width: 48px; height: 48px;"></i>
                    </div>
                    <p class="text-muted">No hay informaci�n hist�rica disponible actualmente.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/patentes_estado_pago.js"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>