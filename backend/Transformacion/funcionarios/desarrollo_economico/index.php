<?php


$pageTitle = "Bandeja OIRS";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal; font-style: normal; line-height: 1;
        display: inline-block; white-space: nowrap; word-wrap: normal;
        direction: ltr; -webkit-font-smoothing: antialiased;
        vertical-align: middle;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Bienvenido a Desarrollo Económico</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium tracking-wider">Gestión integral de fomento productivo, emprendimiento y espacios.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <button type="button" onclick="location.href='postulacion.php'"
                class="bg-slate-800 hover:bg-black text-white font-bold py-3 px-6 rounded-xl shadow-sm transition-all text-xs uppercase tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">list_alt</span> POSTULACIONES
            </button>
            <button type="button" onclick="location.href='emprendedores.php'"
                class="bg-slate-800 hover:bg-black text-white font-bold py-3 px-6 rounded-xl shadow-sm transition-all text-xs uppercase tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">groups</span> EMPRENDEDORES
            </button>
        </div>
    </div>

    <!-- Sub-menu de Acceso Rápido -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="postulacion.php" class="bg-white p-4 rounded-2xl border border-slate-100 hover:border-primary-blue hover:shadow-md transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary-blue flex items-center justify-center group-hover:bg-primary-blue group-hover:text-white transition-all">
                    <span class="material-symbols-outlined">assignment</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Módulo</p>
                    <p class="text-sm font-bold text-slate-700">Postulaciones</p>
                </div>
            </div>
        </a>
        <a href="emprendedores.php" class="bg-white p-4 rounded-2xl border border-slate-100 hover:border-primary-blue hover:shadow-md transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary-blue flex items-center justify-center group-hover:bg-primary-blue group-hover:text-white transition-all">
                    <span class="material-symbols-outlined">groups</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Módulo</p>
                    <p class="text-sm font-bold text-slate-700">Emprendedores</p>
                </div>
            </div>
        </a>
        <a href="espacios.php" class="bg-white p-4 rounded-2xl border border-slate-100 hover:border-primary-blue hover:shadow-md transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary-blue flex items-center justify-center group-hover:bg-primary-blue group-hover:text-white transition-all">
                    <span class="material-symbols-outlined">meeting_room</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Módulo</p>
                    <p class="text-sm font-bold text-slate-700">Espacios</p>
                </div>
            </div>
        </a>
        <a href="proximas.php" class="bg-white p-4 rounded-2xl border border-slate-100 hover:border-primary-blue hover:shadow-md transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-primary-blue flex items-center justify-center group-hover:bg-primary-blue group-hover:text-white transition-all">
                    <span class="material-symbols-outlined">calendar_month</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Módulo</p>
                    <p class="text-sm font-bold text-slate-700">Próximas</p>
                </div>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Solicitudes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="oirs-total-count">...</h3>
                <span class="text-emerald-500 font-bold text-xs">+12% mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Pendientes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="oirs-pending-count">...</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Crítico</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tiempo Promedio</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="oirs-avg-time">...</h3>
                <span class="text-slate-400 font-bold text-xs">Días hábiles</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Resueltas (Mes)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="oirs-resolved-month">...</h3>
                <span class="text-emerald-500 font-bold text-xs">94% tasa</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">bar_chart</span>
                <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Solicitudes por Estado (Últimos 30 días)</h3>
            </div>
            <div class="p-6 h-[300px]">
                <canvas id="chartEstado"></canvas>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">pie_chart</span>
                <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Tipos de Solicitud</h3>
            </div>
            <div class="p-6 h-[300px]">
                <canvas id="chartTipo"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <h3 class="font-bold text-slate-700">Solicitudes Urgentes / Próximas a Vencer</h3>
            <span class="text-xs font-semibold text-slate-400">Mostrando top 5</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Asunto</th>
                        <th class="px-6 py-4">Días Restantes</th>
                        <th class="px-6 py-4 text-center">Prioridad</th>
                        <th class="px-6 py-4 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100" id="tbody_desve">
                </tbody>
            </table>
        </div>
    </div>


</div>


<script src="../../recursos/js/funcionarios/oirs/index.js"></script>
<script>
    $(document).ready(function () {
        // Mantiene la funcionalidad original de inicialización
        if (typeof OirsTable !== 'undefined') {
            OirsTable.init('bandeja');
        }
    });
</script>
<!--<div class="container-fluid p-4">-->

    <!-- Tarjetas de Indicadores Rápidos -->
    <!--<div class="row mb-4">
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

    <div class="row">-->
        <!-- Gráficos Placeholder -->
        <!--<div class="col-lg-8 mb-4">
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
    </div>-->

    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->
    <!--<div id="tabla-resultados-oirs"></div>

</div>

<script src="../../recursos/js/funcionarios/oirs/oirs_bandeja.js"></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        // Initialize table with 'bandeja' view
        OirsTable.init('bandeja');

        // ... existing event handlers if any ...
    });
</script>-->
<?php include '../../api/general/footer.php'; ?>