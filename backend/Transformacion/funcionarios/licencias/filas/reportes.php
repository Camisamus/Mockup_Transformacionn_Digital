<?php
$pageTitle = "Licencias";
require_once '../../../api/general/auth_check.php';
include '../../../api/general/header.php';
?>


<div class="container-fluid p-4">

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <h6 class="text-muted text-uppercase mb-2" style="font-size: 11px;">Tasa de Asistencia</h6>
                <h2 class="font-weight-bold text-success mb-0">85%</h2>
                <small class="text-muted">Promedio semanal</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <h6 class="text-muted text-uppercase mb-2" style="font-size: 11px;">Trámite Más Solicitado</h6>
                <h2 class="font-weight-bold text-primary mb-0">Renovación</h2>
                <small class="text-muted">65% del total</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <h6 class="text-muted text-uppercase mb-2" style="font-size: 11px;">Cupos No Utilizados (No Show)</h6>
                <h2 class="font-weight-bold text-danger mb-0">15%</h2>
                <small class="text-muted">Oportunidad de mejora</small>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Breakdown by Group -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Asistencia por Grupo</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="font-weight-bold">3ra Edad</span>
                            <span class="text-muted">95% Asistencia</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 95%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="font-weight-bold">Prioritarios</span>
                            <span class="text-muted">90% Asistencia</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="font-weight-bold">Vecinos</span>
                            <span class="text-muted">82% Asistencia</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 82%"></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="font-weight-bold">Otros</span>
                            <span class="text-muted">60% Asistencia</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breakdown by Tramite -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="font-weight-bold text-dark mb-0">Demanda por Trámite</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 13px;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 pl-4">Trámite
                                    </th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">
                                        Solicitudes</th>
                                    <th class="border-0 font-weight-bold text-muted text-uppercase py-3 text-center">
                                        Atendidos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-4 font-weight-bold">Renovación</td>
                                    <td class="text-center">150</td>
                                    <td class="text-center text-success font-weight-bold">142</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 font-weight-bold">Primera Licencia</td>
                                    <td class="text-center">80</td>
                                    <td class="text-center text-success font-weight-bold">78</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 font-weight-bold">Control 6 Años</td>
                                    <td class="text-center">45</td>
                                    <td class="text-center text-success font-weight-bold">40</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 font-weight-bold">Duplicados</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center text-success font-weight-bold">15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../../../recursos/js/funcionarios/licencias/filas/reportes.js"></script>
<?php include '../../../api/general/footer.php'; ?>