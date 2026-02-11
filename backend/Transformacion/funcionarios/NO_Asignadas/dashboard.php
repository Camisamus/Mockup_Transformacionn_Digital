<?php
$pageTitle = "Tablero de Control";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Tablero de Control Municipal</h2>
            <p class="text-muted mb-0">Resumen operativo y estadísticas clave del sistema</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" onclick="location.reload()">
                        <i data-feather="refresh-cw" class="me-2"></i>
                        Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Banner (Modernized) -->
    <div class="card shadow-sm border-0 mb-4 bg-primary overflow-hidden position-relative"
        style="background: linear-gradient(135deg, #006FB3 0%, #004e7c 100%) !important;">
        <div class="card-body p-lg-5 p-4 position-relative" style="z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold text-white mb-2">Bienvenido al Sistema de Gestión</h2>
                    <p class="lead text-white mb-0 opacity-75">Visualice el estado de sus solicitudes y las métricas
                        clave de su departamento.</p>
                </div>
            </div>
        </div>
        <!-- Subtle background decoration -->
        <div class="position-absolute end-0 top-0 h-100 p-lg-5 p-4 opacity-10 d-none d-lg-block">
            <i data-feather="activity" style="width: 160px; height: 160px; color: white;"></i>
        </div>
    </div>

    <!-- KPI Cards Grid (Standardized Style) -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-info">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="text-muted small fw-bold text-uppercase mb-0">Solicitudes Pendientes</h6>
                        <div class="rounded-circle bg-info bg-opacity-10 p-2">
                            <i data-feather="clock" class="text-info" style="width: 16px; height: 16px;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0">12</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-success">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="text-muted small fw-bold text-uppercase mb-0">Patentes Aprobadas (Mes)</h6>
                        <div class="rounded-circle bg-success bg-opacity-10 p-2">
                            <i data-feather="check-circle" class="text-success" style="width: 16px; height: 16px;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0">45</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-warning">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="text-muted small fw-bold text-uppercase mb-0">Por Revisar</h6>
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                            <i data-feather="eye" class="text-warning" style="width: 16px; height: 16px;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0 text-warning">8</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100 border-start border-4 border-danger">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="text-muted small fw-bold text-uppercase mb-0">Rechazadas</h6>
                        <div class="rounded-circle bg-danger bg-opacity-10 p-2">
                            <i data-feather="x-circle" class="text-danger" style="width: 16px; height: 16px;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-0 text-danger">3</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Sections -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-4">Actividad Reciente</h5>
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i data-feather="bar-chart-2" class="text-muted opacity-50"
                                style="width: 32px; height: 32px;"></i>
                        </div>
                        <p class="text-muted mb-0">No hay actividad registrada recientemente para mostrar gráficos.</p>
                        <button class="btn btn-link btn-sm text-decoration-none mt-2"
                            onclick="location.reload()">Sincronizar Datos</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Accesos Directos</h5>
                    <div class="list-group list-group-flush">
                        <a href="bandeja.php"
                            class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-3">
                                    <i data-feather="inbox" class="text-primary" style="width: 18px; height: 18px;"></i>
                                </div>
                                <span class="small fw-bold">Ver Bandeja de Entrada</span>
                            </div>
                            <i data-feather="chevron-right" class="text-muted" style="width: 14px; height: 14px;"></i>
                        </a>
                        <a href="ingr_crear.php"
                            class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-3">
                                    <i data-feather="plus-circle" class="text-primary"
                                        style="width: 18px; height: 18px;"></i>
                                </div>
                                <span class="small fw-bold">Crear Nuevo Ingreso</span>
                            </div>
                            <i data-feather="chevron-right" class="text-muted" style="width: 14px; height: 14px;"></i>
                        </a>
                        <a href="atenciones_lista_espera.php"
                            class="list-group-item list-group-item-action border-0 px-0 py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-3">
                                    <i data-feather="users" class="text-primary" style="width: 18px; height: 18px;"></i>
                                </div>
                                <span class="small fw-bold">Ver Lista de Espera</span>
                            </div>
                            <i data-feather="chevron-right" class="text-muted" style="width: 14px; height: 14px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>

<?php include '../../api/footer.php'; ?>