<?php
$pageTitle = "Historial de Pagos";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid">
    <h3 class="mb-4">Historial de Pagos de Patentes</h3>

    <div class="section-card" id="historialSection">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="section-title m-0">Registro de Pagos</div>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-success"
                    onclick="exportTableToExcel('tablaHistorial', 'historial_pagos')">
                    <i data-feather="download" class="me-1"></i> Exportar Excel
                </button>
                <button class="btn btn-outline-danger"
                    onclick="exportElementToPDF('historialSection', 'historial_pagos')">
                    <i data-feather="file-text" class="me-1"></i> Exportar PDF
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-custom mb-0" id="tablaHistorial">
                <thead class="table-light text-center">
                    <tr>
                        <th>PATENTE</th>
                        <th>TIPO</th>
                        <th>PERIODO</th>
                        <th>ESTADO</th>
                        <th>NETO ($)</th>
                        <th>IPC ($)</th>
                        <th>MULTA ($)</th>
                        <th>TOTAL ($)</th>
                        <th>VENCIMIENTO</th>
                        <th>FECHA PAGO</th>
                        <th>FORMA PAGO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="historialBody" class="text-center">
                    <!-- Data will be loaded via JS -->
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/historial_pagos.js"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>