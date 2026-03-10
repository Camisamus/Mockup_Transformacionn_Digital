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
    /* Reset y corrección de fuentes exacto a test.php */
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

    /* Estilos de estados de test.php */
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

    /* Sombras exactas de test.php */
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
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Solicitudes Pendientes</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">En este listado encontrarás los ingresos pedidos por ti o aquellos que se encuentran bajo su reponsabilidad.</p>
        </div>

    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
      
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

        <div class="p-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <div class="flex gap-3">
                <button type="button"
                    class="flex items-center gap-2 bg-[#1d7344] hover:bg-[#155a34] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_excel">
                    <span class="material-symbols-outlined text-sm">description</span> EXCEL
                </button>
                <button type="button"
                    class="flex items-center gap-2 bg-[#d32f2f] hover:bg-[#b71c1c] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_pdf">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> PDF
                </button>
            </div>

            <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider d-none">
                Mostrando <span id="current_view">1 a 4</span> de <span id="resultados_count_old">0</span> resultados
            </div>
        </div>
    </div>
</div>
<!--<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">

        <div class="card-body p-4">-->
<!-- Main Header -->
<!--<div class="main-header mb-4">
                <div class="header-title">
                    <h2 class="fw-bold fs-4">Solicitudes DESVE</h2>
                    <p class="text-muted mb-0">Aquí tienes las solicitudes que requieren tu atención. Puedes ver sus
                        detalles y
                        avanzar en su gestion desde la lista.</p>
                </div>
                <div class="header-action">
                    <button type="button" class="btn btn-toolbar btn-dark" onclick="location.href='nuevo.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        NUEVO DESVE
                    </button>
                </div>
            </div>
        </div>
    </div>-->
<!-- Filtros de Búsqueda -->
<!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4" style="display: none;">
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
                            <th style="width: 80px;">Cod. DESVE</th>
                            <th style="width: 80px;">Solicitante</th>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/desve/pendientes.js"></script>

<?php include '../../api/general/footer.php'; ?>