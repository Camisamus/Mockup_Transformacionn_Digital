<?php
$pageTitle = "Tablero de Control";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


<div class="container-fluid py-4">
    <!-- Header & Toolbar -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Tablero de Control Municipal</h2>
            <p class="text-muted mb-0">Resumen operativo y estadísticas clave del sistema</p>
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

    <!-- Welcome Banner -->
    <div class="card shadow-sm border-0 mb-4 bg-primary  overflow-hidden">
        <div class="card-body p-5 position-relative" style="z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-2">Bienvenido al Sistema de Gestión</h2>
                    <p class="lead mb-0 opacity-75">Visualice el estado de sus solicitudes y las métricas clave de
                        su departamento.</p>
                </div>
            </div>
        </div>
        <!-- Subtle background decoration -->
        <div class="position-absolute end-0 top-0 h-100 p-5 opacity-10 d-none d-lg-block">
            <i data-feather="activity" style="width: 200px; height: 200px;"></i>
        </div>
    </div>

    <!-- KPI Cards Grid -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-info">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Solicitudes Pendientes</h6>
                    <h3 class="fw-bold mb-0">12</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-success">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Patentes Aprobadas (Mes)</h6>
                    <h3 class="fw-bold mb-0">45</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-warning">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Por Revisar</h6>
                    <h3 class="fw-bold mb-0 text-warning">8</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-danger">
                <div class="card-body p-4">
                    <h6 class="text-muted small fw-bold text-uppercase mb-2">Rechazadas</h6>
                    <h3 class="fw-bold mb-0 text-danger">3</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Placeholder for charts or more data -->
    <div class="row g-4 mt-2">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold fs-6 mb-3">Actividad Reciente</h5>
                <div class="text-center py-5">
                    <i data-feather="bar-chart-2" class="text-muted opacity-25 mb-3"
                        style="width: 64px; height: 64px;"></i>
                    <p class="text-muted">No hay actividad registrada recientemente para mostrar gráficos.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-4">
                <h5 class="fw-bold fs-6 mb-3">Accesos Directos</h5>
                <div class="list-group list-group-flush small">
                    <a href="bandeja.php"
                        class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center">
                        Ver Bandeja de Entrada <i data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
                    </a>
                    <a href="ingr_crear.php"
                        class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center">
                        Crear Nuevo Ingreso <i data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
                    </a>
                    <a href="atenciones_lista_espera.php"
                        class="list-group-item list-group-item-action border-0 px-0 d-flex justify-content-between align-items-center">
                        Ver Lista de Espera <i data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


<?php include '../api/footer.php'; ?>