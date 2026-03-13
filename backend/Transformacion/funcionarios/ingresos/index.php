<?php
$pageTitle = "Bandeja Ingresos";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script id="tailwind-config">

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
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal;
        font-style: normal;
        line-height: 1;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
        vertical-align: middle;
    }

    /* Sombras suaves */
    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Estilos DataTables para que no rompan el diseño Tailwind */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        font-size: 12px;
        color: #64748b !important;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    table.dataTable thead th {
        border-bottom: 1px solid #f1f5f9 !important;
    }

    table.dataTable no-footer {
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #1a5f9c !important;
        color: white !important;
        border: none !important;
        border-radius: 8px !important;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Bienvenido al Sistema de
                Ingresos
            </h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Gestión y análisis de solicitudes de ingreso al
                sistema.</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='crear.php'"
                class="bg-[#1e56a0] hover:bg-[#164687] text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add_circle</span> NUEVO INGRESO
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Ingresos</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="metricTotal">...</h3>
                <span class="text-emerald-500 font-bold text-xs" id="percTotal">+0% mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Pendientes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="metricPendientes">...</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Activas</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tiempo Promedio</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="metricPromedio">...</h3>
                <span class="text-slate-400 font-bold text-xs">Días hábiles</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Finalizados (Mes)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="metricMes">...</h3>
                <span class="text-emerald-500 font-bold text-xs">Completados</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">bar_chart</span>
                <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Ingresos por Estado (Últimos 30
                    días)</h3>
            </div>
            <div class="p-6">
                <canvas id="chartEstado" class="w-full" style="max-height: 250px;"></canvas>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">pie_chart</span>
                <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Tipos de Ingreso</h3>
            </div>
            <div class="p-6">
                <canvas id="chartTipo" class="w-full" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span> Ingresos Pendientes (Vista Rápida)
            </h3>
            <span class="text-xs font-semibold text-slate-400">Listado de trámites activos</span>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left" id="tablaPrincipal">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="text-center px-6 py-4">Cod. Ingreso</th>
                        <th class="px-6 py-4">Rol</th>
                        <th class="px-6 py-4">Materia / Título</th>
                        <th class="text-center px-6 py-4">Fecha Ing.</th>
                        <th class="text-center px-6 py-4">Vencimiento</th>
                        <th class="text-center px-6 py-4">Estado</th>
                        <th class="text-center px-6 py-4">Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla_ingresos" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/ingresos/index.js"></script>

<!--<div class="container-fluid py-4">-->
<!-- Header -->
<!--<div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Bandeja de Ingresos</h2>
            <p class="text-muted mb-0">Gestión y búsqueda de solicitudes de ingreso</p>
        </div>
    </div>-->

<!-- Actions Card -->
<!--<div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='crear.php'">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo Ingreso
                    </button>
                </div>
            </div>
        </div>
    </div>-->

<!-- Filtros -->
<!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-3">Filtros de Búsqueda</h5>
            <form id="form_filtros" class="row g-3">
                <div class="col-md-4">
                    <label for="filtro_titulo" class="form-label small fw-bold">Título</label>
                    <input type="text" class="form-control" id="filtro_titulo" placeholder="Buscar por título...">
                </div>
                <div class="col-md-3">
                    <label for="filtro_rgt" class="form-label small fw-bold">ID Público (RGT)</label>
                    <input type="text" class="form-control" id="filtro_rgt" placeholder="Cód. RGT...">
                </div>
                <div class="col-md-2">
                    <label for="filtro_id" class="form-label small fw-bold">ID Interno</label>
                    <input type="number" class="form-control" id="filtro_id" placeholder="ID...">
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit"
                        class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                        <i data-feather="search" style="width: 16px; height: 16px;"></i>
                        Buscar
                    </button>
                    <button type="reset" class="btn btn-outline-secondary shadow-sm" id="btn_limpiar">
                        <i data-feather="refresh-cw" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>-->

<!-- Tabla -->
<!--<div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h5 class="fw-bold fs-6 mb-0">Listado de Ingresos</h5>
                <div class="pagination-info text-muted small">Mostrando registros recientes</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th class="text-end pe-4">Acciones</th>
                            <th>Título</th>
                            <th>Fecha Solo</th>
                            <th>Límite</th>
                            <th>Estado</th>
                            <th>Asignación</th>
                            <th>Cód. Público</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_ingresos" class="small">-->
<!-- Dynamic -->
<!--<tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="spinner-border text-primary spinner-border-sm" role="status"></div>
                                <span class="ms-2 text-muted">Cargando ingresos...</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="pagination_container" class="py-3 border-top d-flex justify-content-end"></div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>-->

<!--<script src="../../recursos/js/funcionarios/ingresos/bandeja.js"></script>-->

<?php include '../../api/general/footer.php'; ?>