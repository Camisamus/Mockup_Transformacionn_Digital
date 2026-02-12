<?php
include("../include/header-funcionarios.php");
?>
<!-- Cabecera de Página -->
<header class="bg-white border-bottom shadow-sm px-4 d-flex align-items-center justify-content-between" style="height: 70px; border-bottom: 3px solid var(--gob-primary) !important; flex-shrink: 0; z-index: 10;">
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <button class="btn btn-link d-lg-none p-0 text-dark sidebar-toggle mr-2 shadow-none">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="d-flex flex-column">
            <h2 class="h6 font-serif font-bold text-dark mb-0">Dashboard de Funcionarios</h2>
            <p class="text-primary font-weight-bold text-uppercase mb-0" 
            style="font-size: 9px; letter-spacing: 0.15em; margin-top: 2px;">Sistema Unificado de Gestión Municipal de Cuidados</p>
        </div>
    </div>
    <div class="d-flex align-items-center" style="gap: 1rem;">
        <div class="d-none d-md-flex align-items-center text-muted font-weight-bold mr-3" style="font-size: 10px; gap: 0.5rem;">
            <span class="rounded-circle bg-warning" style="width: 8px; height: 8px;"></span>
            <span class="text-uppercase" style="letter-spacing: 0.05em;">15 Solicitudes Urgentes</span>
        </div>
        <button class="btn btn-light btn-sm rounded-circle p-2 border-0 shadow-none position-relative">
            <span class="material-symbols-outlined" style="font-size: 22px; color: #64748b;">notifications</span>
            <span class="position-absolute bg-danger border border-white rounded-circle" style="top: 8px; right: 8px; width: 8px; height: 8px;"></span>
        </button>
    </div>
</header>

<div class="flex-grow-1 p-4 overflow-auto custom-scrollbar">
    <!-- Widgets de Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm stat-card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Total Organizaciones</p>
                            <h3 class="h4 font-serif font-bold text-dark mb-0">1,284</h3>
                        </div>
                        <div class="bg-light p-2 rounded text-primary border d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <span class="material-symbols-outlined">corporate_fare</span>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center text-success font-weight-bold" style="font-size: 11px;">
                        <span class="material-symbols-outlined mr-1" style="font-size: 14px;">trending_up</span>
                        <span>+12 este mes</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm stat-card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Uso de Plazas</p>
                            <h3 class="h4 font-serif font-bold text-dark mb-0">85%</h3>
                        </div>
                        <div class="bg-light p-2 rounded text-success border d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <span class="material-symbols-outlined">park</span>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center text-success font-weight-bold" style="font-size: 11px;">
                        <span class="material-symbols-outlined mr-1" style="font-size: 14px;">trending_up</span>
                        <span>+5% vs mes anterior</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm stat-card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Solicitudes Nuevas</p>
                            <h3 class="h4 font-serif font-bold text-dark mb-0">42</h3>
                        </div>
                        <div class="bg-light p-2 rounded text-warning border d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center text-warning font-weight-bold" style="font-size: 11px;">
                        <span class="material-symbols-outlined mr-1" style="font-size: 14px;">schedule</span>
                        <span>8 requieren atención</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm stat-card">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Participantes</p>
                            <h3 class="h4 font-serif font-bold text-dark mb-0">15.4k</h3>
                        </div>
                        <div class="bg-light p-2 rounded text-info border d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <span class="material-symbols-outlined">person_celebrate</span>
                        </div>
                    </div>
                    <div class="mt-3 d-flex align-items-center text-info font-weight-bold" style="font-size: 11px;">
                        <span class="material-symbols-outlined mr-1" style="font-size: 14px;">group</span>
                        <span>Registrados en sistema</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Panel Izquierdo: Formulario y Notas -->
        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <h3 class="h6 font-weight-bold text-dark mb-0">Notas 1</h3>
                    <span class="badge badge-light border text-muted px-2" style="font-size: 9px; font-weight: bold;">Recientes</span>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-0">
                        <div class="bg-light border text-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px; flex-shrink: 0;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                        </div>
                        <div>
                            <p class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Validación pendiente</p>
                            <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.4;">Sector Gómez Carreño requiere revisión de personalidad jurídica.</p>
                            <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 9px; opacity: 0.6;">Hace 15 min • J. Soto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <h3 class="h6 font-weight-bold text-dark mb-0">Notas 2</h3>
                    <span class="badge badge-light border text-muted px-2" style="font-size: 9px; font-weight: bold;">Recientes</span>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-0">
                        <div class="bg-light border text-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px; flex-shrink: 0;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                        </div>
                        <div>
                            <p class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Validación pendiente</p>
                            <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.4;">Sector Gómez Carreño requiere revisión de personalidad jurídica.</p>
                            <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 9px; opacity: 0.6;">Hace 15 min • J. Soto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom p-4 d-flex align-items-center justify-content-between">
                    <h3 class="h6 font-weight-bold text-dark mb-0">Notas 3</h3>
                    <span class="badge badge-light border text-muted px-2" style="font-size: 9px; font-weight: bold;">Recientes</span>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-0">
                        <div class="bg-light border text-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 32px; height: 32px; flex-shrink: 0;">
                            <span class="material-symbols-outlined" style="font-size: 16px;">chat</span>
                        </div>
                        <div>
                            <p class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Validación pendiente</p>
                            <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.4;">Sector Gómez Carreño requiere revisión de personalidad jurídica.</p>
                            <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 9px; opacity: 0.6;">Hace 15 min • J. Soto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.stat-card { transition: all 0.3s ease; }
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important; }
.form-control-sm { height: 38px !important; border-radius: 4px !important; }
.btn-primary { background-color: var(--gob-primary) !important; border-color: var(--gob-primary) !important; }
.btn-primary:hover { background-color: #005a91 !important; }
</style>

<?php include("../include/footer-funcionarios.php"); ?>