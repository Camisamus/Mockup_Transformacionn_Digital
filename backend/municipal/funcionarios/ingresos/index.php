<?php include '../../include/header-ingresos-funcionarios.php'; ?>

<!-- Header de la página -->
<div class="bg-white border-bottom px-4 py-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <button class="btn btn-link p-0 mr-3 d-lg-none sidebar-toggle text-dark">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="d-flex flex-column">
                <h2 class="h6 font-serif font-bold text-dark mb-0">Dashboard de Gestión Documental</h2>
                <p class="text-primary font-weight-bold text-uppercase mb-0" 
                style="font-size: 9px; letter-spacing: 0.15em; margin-top: 2px;">Sistema de Ingresos Administrativos</p>
            </div>
        </div>
        <div class="d-flex align-items-center" style="gap: 1rem;">
            <div class="badge badge-success px-3 py-2 text-uppercase d-none d-md-inline-block" style="font-size: 10px; letter-spacing: 0.05em;">
                Servicio Operativo
            </div>
            <button class="btn btn-light btn-sm border shadow-none d-flex align-items-center" style="gap: 0.5rem; font-size: 11px; font-weight: 600;">
                <span class="material-symbols-outlined" style="font-size: 18px;">notifications</span>
                <span class="d-none d-sm-inline">Notificaciones</span>
            </button>
        </div>
    </div>
</div>

<!-- Contenido Principal -->
<div class="container-fluid p-4">
    
    <!-- Tarjetas de Indicadores Rápidos -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm" style="border-radius: 8px; border-left: 4px solid var(--gob-primary) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Total Solicitudes</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">1.284</h3>
                        <span class="text-success font-weight-bold" style="font-size: 11px;">+12% mes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm" style="border-radius: 8px; border-left: 4px solid var(--gob-warning) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Pendientes</p>
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
                    <p class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Tiempo Promedio</p>
                    <div class="d-flex align-items-end justify-content-between">
                        <h3 class="h2 font-weight-bold mb-0">3.2d</h3>
                        <span class="text-muted font-weight-bold" style="font-size: 11px;">Días hábiles</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius: 8px; border-left: 4px solid var(--gob-success) !important;">
                <div class="card-body p-4">
                    <p class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 10px; letter-spacing: 0.05em;">Resueltas (Mes)</p>
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
                <div class="card-body p-4 d-flex align-items-center justify-content-center bg-light-soft" style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.3;">monitoring</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico de barras: Distribución de estados]</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0 d-flex align-items-center">
                        <span class="material-symbols-outlined text-primary mr-2">pie_chart</span>
                        Tipos de Solicitud
                    </h3>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-muted" style="font-size: 48px; opacity: 0.3;">donut_large</span>
                        <p class="text-muted mt-2" style="font-size: 13px;">[Gráfico circular: Reclamos vs Consultas]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas Recientes -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4">
                    <h3 class="h6 font-weight-bold text-dark mb-0">Solicitudes Urgentes / Próximas a Vencer</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light text-muted text-uppercase" style="font-size: 10px; letter-spacing: 0.05em;">
                                <tr>
                                    <th class="px-4 py-3 border-0">ID</th>
                                    <th class="px-4 py-3 border-0">Asunto</th>
                                    <th class="px-4 py-3 border-0">Días Restantes</th>
                                    <th class="px-4 py-3 border-0 text-center">Prioridad</th>
                                    <th class="px-4 py-4 border-0 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 13px;">
                                <tr>
                                    <td class="px-4 py-3 align-middle font-weight-bold">#OIRS-8821</td>
                                    <td class="px-4 py-3 align-middle">Solicitud de bacheo en Calle Quillota</td>
                                    <td class="px-4 py-3 align-middle text-danger font-weight-bold">1 día</td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <span class="badge badge-danger px-2 py-1">ALTA</span>
                                    </td>
                                    <td class="px-4 py-3 align-middle text-right">
                                        <button class="btn btn-link text-primary font-weight-bold p-0 shadow-none">Gestionar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 align-middle font-weight-bold">#OIRS-8825</td>
                                    <td class="px-4 py-3 align-middle">Consulta sobre permisos de edificación</td>
                                    <td class="px-4 py-3 align-middle text-warning font-weight-bold">3 días</td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <span class="badge badge-warning px-2 py-1">MEDIA</span>
                                    </td>
                                    <td class="px-4 py-3 align-middle text-right">
                                        <button class="btn btn-link text-primary font-weight-bold p-0 shadow-none">Gestionar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../include/footer-funcionarios.php'; ?>
