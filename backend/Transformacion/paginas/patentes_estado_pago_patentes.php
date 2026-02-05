<?php
$pageTitle = "Estado de Pago - Patentes";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-0 bg-primary  p-3 rounded-top">
            <h5 class="mb-0 fw-bold">PERIODOS ADEUDADOS PATENTES MUNICIPALES</h5>
            <a href="#" class=" text-decoration-none small">¿Necesitas Ayuda?</a>
        </div>

        <!-- User Info -->
        <div class="bg-white border border-top-0 p-3 mb-4 shadow-sm">
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>RUT:</strong> <span class="text-muted">76.543.210-K</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>NOMBRE:</strong> <span class="text-muted">COMERCIALIZADORA EJEMPLO SPA</span>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-0" id="paymentTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="debt-tab" data-bs-toggle="tab" data-bs-target="#debt" type="button"
                    role="tab" aria-selected="true">Patentes Adeudadas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" type="button"
                    role="tab" aria-selected="false">Patentes Pagadas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button"
                    role="tab" aria-selected="false">Información Histórica</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content border border-top-0 p-4 bg-white shadow-sm" id="paymentTabsContent">
            <div class="tab-pane fade show active" id="debt" role="tabpanel" aria-labelledby="debt-tab">

                <!-- Summary Boxes -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="summary-box">
                            <div class="summary-header">TOTALES DEUDA SEGÚN NÂ° RUT</div>
                            <div class="summary-content d-flex justify-content-around">
                                <div>
                                    <div class="small fw-bold text-muted">TOTAL DEUDA</div>
                                    <div class="h5 mb-0">$0</div>
                                </div>
                                <div>
                                    <div class="small fw-bold text-muted">NÂ° PATENTES</div>
                                    <div class="h5 mb-0">0</div>
                                </div>
                                <div>
                                    <div class="small fw-bold text-muted">NÂ° GIROS</div>
                                    <div class="h5 mb-0">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary-box">
                            <div class="summary-header">TOTALES DEUDA SEGÚN NÂ° RUT</div>
                            <div class="summary-content d-flex justify-content-around">
                                <div>
                                    <div class="small fw-bold text-muted">TOTAL A PAGAR</div>
                                    <div class="h5 mb-0">$0</div>
                                </div>
                                <div>
                                    <div class="small fw-bold text-muted">NÂ° PATENTES</div>
                                    <div class="h5 mb-0">0</div>
                                </div>
                                <div>
                                    <div class="small fw-bold text-muted">NÂ° GIROS</div>
                                    <div class="h5 mb-0">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="patent-table-header">
                            <tr>
                                <th>PATENTE</th>
                                <th>TIPO</th>
                                <th>EMIS</th>
                                <th>PERIODO</th>
                                <th>F.VENC.</th>
                                <th>F.PLAZO</th>
                                <th>NETO</th>
                                <th>IPC</th>
                                <th>MULTA</th>
                                <th>TOTAL</th>
                                <th>PAGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="11" class="text-center py-4 text-muted fst-italic">
                                    Ud. no registra deudas pendientes
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-warning  fw-bold">Borrar Selección</button>
                    <button class="btn btn-primary fw-bold px-4">Iniciar Pago</button>
                    <button class="btn btn-secondary fw-bold ms-2">â®¨ Salir</button>
                </div>
            </div>

            <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <!-- Detailed Table for Paid Patents -->
                <!-- Export Buttons per Guidelines -->
                <div class="d-flex justify-content-end gap-2 mb-2">
                    <button class="btn btn-outline-success btn-sm"
                        onclick="exportTableToExcel('tablaPagadas', 'patentes_pagadas')">
                        <i data-feather="file-text"></i> Excel
                    </button>
                    <button class="btn btn-outline-danger btn-sm"
                        onclick="exportElementToPDF('tablaPagadas', 'patentes_pagadas')">
                        <i data-feather="file-text"></i> PDF
                    </button>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center align-middle" id="tablaPagadas">
                        <thead class="patent-table-header">
                            <tr>
                                <th>NÂ°PATENTE</th>
                                <th>TIPO</th>
                                <th>PERIODO</th>
                                <th>PAGADO EN</th>
                                <th>TOTAL</th>
                                <th>VENCIMIENTO</th>
                                <th>DESCARGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data loaded dynamically from ../recursos/jsons/patentes_estado_pago_mock.json -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="text-center py-5 text-muted">
                    <p>No hay información histórica disponible.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="../recursos/js/export_utils.js"></script>
    <script src="../recursos/js/patentes_estado_pago.js"></script>
    <script>
        feather.replace();
    </script>
    

<?php include '../api/footer.php'; ?>

