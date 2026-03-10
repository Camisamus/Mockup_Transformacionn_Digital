<?php
$pageTitle = "Historial OIRS";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

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

    /* Manejo del panel colapsable con Tailwind */
    #advancedPanel {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }
    #advancedPanel.show {
        max-height: 500px;
        transition: max-height 0.5s ease-in;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Historial OIRS</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider">Búsqueda y Seguimiento de Solicitudes</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='ingresar.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add_circle</span> NUEVA OIRS
            </button>
        </div>
    </div>

    <div class="bg-white gob-card rounded-2xl overflow-hidden">
        <div class="p-6 lg:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                <div class="md:col-span-4 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Búsqueda Rápida (ID / RUT / Nombre)</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-slate-400 text-xl">search</span>
                        <input type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" placeholder="Escribe para buscar...">
                    </div>
                </div>
                <div class="md:col-span-3 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha de Ingreso</label>
                    <input type="date" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                </div>
                <div class="md:col-span-3 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado de la Solicitud</label>
                    <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                        <option>Todos los estados</option>
                        <option>Recibida / Nueva</option>
                        <option>En Proceso</option>
                        <option>Finalizada / Resuelta</option>
                        <option>Vencida / Fuera de Plazo</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <button class="w-full py-2.5 rounded-xl border-2 border-primary-blue text-primary-blue font-bold text-[11px] uppercase tracking-wider hover:bg-primary-blue hover:text-white transition-all flex items-center justify-center gap-2" id="btnAdvanced">
                        <span class="material-symbols-outlined text-lg">tune</span> MÁS FILTROS
                    </button>
                </div>
            </div>

            <div id="advancedPanel" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pt-4 border-t border-slate-50">
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Sector Territorial</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option>Todos los sectores</option>
                            <option>Plan de Viña</option>
                            <option>Santa Inés</option>
                            <option>Miraflores</option>
                            <option>Reñaca</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Temática Principal</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option>Todas las temáticas</option>
                            <option>Aseo y Ornato</option>
                            <option>Infraestructura Urbana</option>
                            <option>Seguridad Pública</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Subtemática</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option>Todas las subtemáticas</option>
                            <option>Bacheo / Hoyos</option>
                            <option>Luminarias</option>
                            <option>Microbasurales</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Prioridad</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4">
                    <button class="text-slate-400 font-bold text-[11px] uppercase tracking-widest hover:text-rose-500 transition-colors" id="btnReset">
                        LIMPIAR TODO
                    </button>
                    <button class="bg-slate-800 text-white px-6 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-black transition-all shadow-md">
                        APLICAR FILTROS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden min-h-[400px]">
        <div class="p-4 border-b border-slate-50 bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">history</span> Resultados del Historial
            </h3>
        </div>
        <div id="tabla-resultados-oirs">
            </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        // Toggle Filtros Avanzados (Adaptado a Tailwind)
        $('#btnAdvanced').on('click', function () {
            const $panel = $('#advancedPanel');
            const $btn = $(this);
            $panel.toggleClass('show');
            $btn.toggleClass('bg-primary-blue text-white');
            
            const isActive = $panel.hasClass('show');
            $btn.html(isActive ? 
                '<span class="material-symbols-outlined text-lg">expand_less</span> MENOS FILTROS' : 
                '<span class="material-symbols-outlined text-lg">tune</span> MÁS FILTROS');
        });

        // Limpiar Filtros
        $('#btnReset').on('click', function () {
            $('input, select').val('');
        });
    });
</script>

<script src="../../recursos/js/funcionarios/oirs/index.js"></script>
<script src="../../recursos/js/funcionarios/oirs/tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        // Inicialización original del historial
        if (typeof OirsTable !== 'undefined') {
            OirsTable.init('historial');
        }
    });
</script>

<!--<div class="container-fluid p-4">-->

    <!-- ========================================
         FILTROS DE BÚSQUEDA
         ======================================== -->
    <!--<div class="card search-card mb-4 border-0">
        <div class="card-body p-4">-->
            <!-- Filtros Principales -->
            <!--<div class="row align-items-end">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="filter-label">Búsqueda Rápida (ID / RUT / Nombre)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent text-muted">
                                <span class="material-symbols-outlined icon-sm">search</span>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-cool pl-0 border-left-0"
                            placeholder="Escribe para buscar...">
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control form-control-cool">
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <label class="filter-label">Estado de la Solicitud</label>
                    <select class="form-control form-control-cool">
                        <option>Todos los estados</option>
                        <option>Recibida / Nueva</option>
                        <option>En Proceso</option>
                        <option>Finalizada / Resuelta</option>
                        <option>Vencida / Fuera de Plazo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-primary btn-block font-weight-bold" id="btnAdvanced"
                        style="font-size: 11px; height: 38px;">
                        MÁS FILTROS
                    </button>
                </div>
            </div>-->

            <!-- Filtros Avanzados (Colapsable) -->
            <!--<div class="advanced-filters" id="advancedPanel">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Sector Territorial</label>
                        <select class="form-control form-control-cool">
                            <option>Todos los sectores</option>
                            <option>Plan de Viña</option>
                            <option>Santa Inés</option>
                            <option>Miraflores</option>
                            <option>Reñaca</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Temática Principal</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las temáticas</option>
                            <option>Aseo y Ornato</option>
                            <option>Infraestructura Urbana</option>
                            <option>Seguridad Pública</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Subtemática</label>
                        <select class="form-control form-control-cool">
                            <option>Todas las subtemáticas</option>
                            <option>Bacheo / Hoyos</option>
                            <option>Luminarias</option>
                            <option>Microbasurales</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="filter-label">Prioridad</label>
                        <select class="form-control form-control-cool">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
                            <option>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <button class="btn btn-link text-muted small font-weight-bold shadow-none" id="btnReset">
                        Limpiar todo
                    </button>
                    <button class="btn btn-primary px-4 font-weight-bold ml-2" style="font-size: 12px;">
                        APLICAR FILTROS
                    </button>
                </div>
            </div>
        </div>
    </div>-->

    <!-- ========================================
         TABLA DE RESULTADOS
         ======================================== -->

    <!--<div id="tabla-resultados-oirs"></div>

</div>

<script>
    $(document).ready(function () {
        // Toggle Filtros Avanzados
        $('#btnAdvanced').on('click', function () {
            const $panel = $('#advancedPanel');
            const $btn = $(this);
            $panel.toggleClass('show');
            $btn.toggleClass('active btn-primary btn-outline-primary');
            $btn.text($btn.hasClass('active') ? 'MENOS FILTROS' : 'MÁS FILTROS');
        });

        // Limpiar Filtros
        $('#btnReset').on('click', function () {
            $('.form-control-cool').val('');
        });
    });
</script>

<script src="../../recursos/js/funcionarios/oirs/oirs_bandeja.js"></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_tabla_flujo.js"></script>
<script>
    $(document).ready(function () {
        OirsTable.init('historial');
    });
</script>-->
<?php include '../../api/general/footer.php'; ?>