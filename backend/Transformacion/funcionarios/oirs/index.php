<?php
$pageTitle = "Bandeja OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';
?>

<div class="container-fluid p-4">

    <!-- Tarjetas de Indicadores Rápidos -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-primary) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Total Solicitudes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">1.284</h3>
                        <span class="text-success font-weight-bold" style="font-size: 11px;">+12% mes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-warning) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Pendientes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">42</h3>
                        <span class="text-warning font-weight-bold" style="font-size: 11px;">Crítico</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm" style="border-radius: 8px; border-left: 4px solid #6c757d !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Tiempo Promedio</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">3.2d</h3>
                        <span class="text-muted font-weight-bold" style="font-size: 11px;">Días hábiles</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm"
                style="border-radius: 8px; border-left: 4px solid var(--gob-success) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1"
                        style="font-size: 10px; letter-spacing: 0.05em;">Resueltas (Mes)</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">156</h3>
                        <span class="text-success font-weight-bold" style="font-size: 11px;">94% tasa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráficos Placeholder -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0 d-flex align-items-center">
                        <span class="material-symbols-outlined text-primary mr-2">bar_chart</span>
                        Solicitudes por Estado (Últimos 30 días)
                    </h3>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center bg-light-soft"
                    style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted"
                            style="font-size: 48px; opacity: 0.3;">monitoring</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico de barras: Distribución de estados]
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0 d-flex align-items-center">
                        <span class="material-symbols-outlined text-primary mr-2">Grain</span>
                        Tipos de Solicitud
                    </h3>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted"
                            style="font-size: 48px; opacity: 0.3;">Grain</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico Multitud: Reclamos vs Consultas]
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <div id="tabla-resultados-oirs"></div>

</div>

<script src="../../recursos/js/funcionarios/oirs/oirs_bandeja.js"></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        // Initialize table with 'bandeja' view
        OirsTable.init('bandeja');

        // ... existing event handlers if any ...
    });
</script>
<?php include 'footer-funcionarios.php'; ?>