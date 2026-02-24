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
    /* Reset y corrección de fuentes exacto a test2.php */
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

    /* Estilos de estados */
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

    /* Sombras exactas de test2.php */
    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Historial DESVE</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Visualiza el historial de las solicitudes DESVE
                Cerradas asignadas a ti.</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='nuevo.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider">
                NUEVO DESVE
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">

        <div class="p-4 border-b border-slate-50 flex justify-between items-center bg-white">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">history</span>
                <h3 class="font-bold text-slate-700">Historial de Solicitudes</h3>
            </div>

            <div class="flex items-center gap-3">
                <select
                    class="rounded-lg border-slate-200 text-xs font-semibold text-slate-400 focus:ring-primary-blue py-1.5"
                    id="filtro_rango">
                    <option value="30">Últimos 30 días</option>
                    <option value="60">Últimos 60 días</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tablaAtenciones">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4 text-center">Acción</th>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Fecha Rec.</th>
                        <th class="px-6 py-4">Vencimiento</th>
                        <th class="px-6 py-4 text-center">Prioridad</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">
                            <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbody_desve" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">

            <div class="flex gap-3">
                <button type="button"
                    class="flex items-center gap-2 bg-[#1d7344] hover:bg-[#155a34] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_exportar_excel">
                    <span class="material-symbols-outlined text-sm">description</span> EXCEL
                </button>
                <button type="button"
                    class="flex items-center gap-2 bg-[#d32f2f] hover:bg-[#b71c1c] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_exportar_pdf">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> PDF
                </button>
            </div>

            <nav class="flex items-center gap-1">
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <div class="flex gap-1" id="pagination_container">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary-blue text-white font-bold text-xs">1</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 font-bold text-xs hover:bg-slate-50">2</button>
                </div>
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </nav>

            <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                Resultados (<span id="resultados_count">0</span>)
            </div>
        </div>
    </div>
</div>
<!--<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">

        <div class="card-body p-4">
            <div class="main-header mb-4">
                <div class="header-title">
                    <h2 class="fw-bold fs-4">Historial DESVE</h2>
                    <p class="text-muted mb-0">Visualiza el historial de las solicitudes DESVE Cerradas asignadas a ti.
                    </p>
                </div>
                <div class="header-action">
                    <button type="button" class="btn btn-toolbar btn-dark" id="btn_exportar_excel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Excel
                    </button>
                </div>
                <div class="header-action">
                    <button type="button" class="btn btn-toolbar btn-dark" id="btn_exportar_pdf">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        PDF
                    </button>
                </div>
                <div class="header-action">
                    <button type="button" class="btn btn-toolbar btn-dark" onclick="location.href='nuevo.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nuevo DESVE
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- Filtros de Búsqueda -->

<!--<div class="card shadow-sm border-0 mb-4" style="display: none;">
    <div class="card-body p-4">
        <h5 class="fw-bold fs-6 mb-3">Filtros de Búsqueda</h5>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Fecha Desde</label>
                <input type="date" class="form-control form-control-sm" id="filtro_fecha_desde">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Fecha Hasta</label>
                <input type="date" class="form-control form-control-sm" id="filtro_fecha_hasta">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Estado Entrega</label>
                <select class="form-select form-select-sm" id="filtro_estado">
                    <option value="">Todos</option>
                    <option value="0">Pendiente</option>
                    <option value="1">Respondido</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Sector</label>
                <select class="form-select form-select-sm" id="filtro_sector">
                    <option value="">Todos</option>-->
                    <!-- Dynamic -->
                <!--</select>
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="filtro_ocultar_reingresos" role="switch">
                    <label class="form-check-label small fw-bold" for="filtro_ocultar_reingresos">
                        Ocultar reingresos
                    </label>
                </div>
            </div>

            <div class="col-md-6 d-flex justify-content-end gap-2">
                <button class="btn btn-dark btn-sm px-4 d-flex align-items-center gap-2" id="btn_buscar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar
                </button>
                <button class="btn btn-link btn-sm text-muted text-decoration-none" id="btn_limpiar">
                    Limpiar
                </button>
            </div>
        </div>
    </div>
</div>-->

<!-- Tabla de Resultados -->
<!--<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <div class="fw-bold small">Resultados (<span id="resultados_count">0</span>)</div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tablaAtenciones">
                <thead class="table-light text-uppercase small">
                    <tr>
                        <th style="width: 50px;">Acción</th>
                        <th style="width: 80px;">ID</th>
                        <th class="d-none d-md-table-cell">Fecha Rec.</th>
                        <th class="d-none d-md-table-cell">Vencimiento</th>
                        <th class="d-none d-md-table-cell">Prioridad</th>
                        <th class="d-none d-md-table-cell text-center">Estado</th>
                        <th style="width: 50px;" class="text-center"><i data-feather="plus-circle"></i></th>
                    </tr>
                </thead>
                <tbody id="tbody_desve" class="small">-->
                    <!-- Populated via JS -->
                <!--</tbody>
            </table>
        </div>
    </div>
</div>
</div>-->

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/desve/historial.js"></script>

<?php include '../../api/general/footer.php'; ?>