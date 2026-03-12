<?php
$pageTitle = "DESVE";
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
    /* Reset y corrección de fuentes */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    /* Forzar renderizado de iconos Material Symbols */
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

    /* Estilos personalizados para estados */
    .badge-alta {
        background-color: #fee2e2;
        color: #b91c1c;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
    }

    .badge-media {
        background-color: #eff6ff;
        color: #1d4ed8;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
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
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Bienvenido al sistema DESVE </h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Aquí podrás encontrar un resumen de los estados
                de las solicitudes ingresadas a DESVE.</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='nuevo.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider">
                NUEVO DESVE
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Solicitudes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">1.284</h3>
                <span class="text-emerald-500 font-bold text-xs">+12% mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Pendientes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">42</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Crítico</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tiempo Promedio</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">3.2d</h3>
                <span class="text-slate-400 font-bold text-xs">Días hábiles</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Resueltas (Mes)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">156</h3>
                <span class="text-emerald-500 font-bold text-xs">94% tasa</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">bar_chart</span>
                <h3 class="font-bold text-slate-700">Solicitudes por Estado (Últimos 30 días)</h3>
            </div>
            <div class="p-6">
                <canvas id="chartBarras" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">pie_chart</span>
                <h3 class="font-bold text-slate-700">Tipos de Solicitud</h3>
            </div>
            <div class="p-6">
                <canvas id="chartDona" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <h3 class="font-bold text-slate-700">Solicitudes Pendientes (Vista Rápida)</h3>
            <span class="text-xs font-semibold text-slate-400">Listado completo de pendientes</span>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left" id="tablaAtenciones">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="text-center px-6 py-4">Cod. DESVE</th>
                        <th class="px-6 py-4">Rol</th>
                        <th class="px-6 py-4">Materia / Solicitante</th>
                        <th class="text-center px-6 py-4">Fecha Rec.</th>
                        <th class="text-center px-6 py-4">Vencimiento</th>
                        <th class="text-center px-6 py-4">Prioridad</th>
                        <th class="text-center px-6 py-4">Estado</th>
                        <th class="text-center px-6 py-4">Acción</th>
                    </tr>
                </thead>
                <tbody id="tbody_desve" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/desve/index.js"></script>
<script src="../../recursos/js/helpers.js"></script>

<?php include '../../api/general/footer.php'; ?>