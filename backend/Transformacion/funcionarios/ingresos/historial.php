<?php
$pageTitle = "Historial de Ingresos";
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
    .material-symbols-outlined { font-family: 'Material Symbols Outlined' !important; vertical-align: middle; line-height: 1; }
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Historial de Ingresos</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider">Consulta y revisión histórica de registros</p>
        </div>
        <div class="flex flex-row gap-3 w-full lg:w-auto justify-center lg:justify-end">
            <button type="button" onclick="buscarIngresos()"
                class="flex-1 lg:flex-none whitespace-nowrap bg-primary-blue hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-[13px] uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">search</span> BUSCAR
            </button>
            <button type="button"
                class="flex-1 lg:flex-none whitespace-nowrap bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">description</span> EXPORTAR EXCEL
            </button>
        </div>
    </div>

    <div class="bg-white gob-card rounded-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
            <span class="material-symbols-outlined text-primary-blue">filter_alt</span>
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Filtros de Búsqueda</h3>
        </div>
        <div class="p-6 lg:p-8">
            <form id="formFiltros" onsubmit="event.preventDefault(); buscarIngresos();" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label for="filtro_id" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">ID Ingreso</label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" id="filtro_id" placeholder="Ej: ID Interno">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_fecha_inicio" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha (Inicio)</label>
                        <input type="date" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" id="filtro_fecha_inicio">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_fecha_fin" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha (Fin)</label>
                        <input type="date" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" id="filtro_fecha_fin">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_estado" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" id="filtro_estado">
                            <option value="">Todos (Favorables y No Favorables)</option>
                            <option value="Resuelto_Favorable">Favorable</option>
                            <option value="Resuelto_NO_Favorable">No Favorable</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="md:col-span-2 space-y-2">
                        <label for="filtro_responsable" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Responsable</label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" id="filtro_responsable" placeholder="Nombre Responsable">
                    </div>
                    <div class="md:col-span-2 flex gap-3">
                        <button type="submit" class="flex-1 bg-slate-800 hover:bg-black text-white font-bold py-2.5 rounded-xl shadow-md transition-all text-[11px] uppercase tracking-widest flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">search</span> APLICAR FILTROS
                        </button>
                        <button type="button" onclick="limpiarFiltros()" class="px-6 py-2.5 border-2 border-slate-200 text-slate-400 font-bold rounded-xl hover:bg-slate-50 transition-all text-[11px] uppercase tracking-widest">
                            LIMPIAR
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden min-h-[400px]">
        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span> Resultados encontrados
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200" id="resultados_count">0</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left" id="tablaResultados">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Fecha</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4">Tipo Ingreso</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-600 italic">
                    </tbody>
            </table>
        </div>

        <div id="pagination_container" class="p-6 bg-slate-50/30 border-t border-slate-100 flex justify-end items-center">
            </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/ingresos/historial.js"></script>

<!--<div class="container-fluid py-4">-->
    <!-- Header & Toolbar -->
    <!--<div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Historial de Ingresos</h2>
            <p class="text-muted mb-0">Consulta y revisión histórica de ingresos</p>
        </div>
        <div class="toolbar">
            <button class="btn btn-toolbar" onclick="buscarIngresos()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                Buscar
            </button>
            <button class="btn btn-toolbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Exportar Excel
            </button>
        </div>
    </div>-->

    <!-- Filtros de Búsqueda -->
    <!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold fs-6 mb-1">Filtros de Búsqueda</h5>
            <p class="text-muted small mb-4">Aplique filtros para refinar los resultados</p>

            <form id="formFiltros" onsubmit="event.preventDefault(); buscarIngresos();">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="filtro_id" class="form-label small fw-bold">ID Ingreso</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_id"
                            placeholder="Ej: ID Interno">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_inicio" class="form-label small fw-bold">Fecha (Inicio)</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_inicio">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_fecha_fin" class="form-label small fw-bold">Fecha (Fin)</label>
                        <input type="date" class="form-control form-control-sm" id="filtro_fecha_fin">
                    </div>
                    <div class="col-md-3">
                        <label for="filtro_estado" class="form-label small fw-bold">Estado</label>
                        <select class="form-select form-select-sm" id="filtro_estado">
                            <option value="">Todos (Favorables y No Favorables)</option>
                            <option value="Resuelto_Favorable">Favorable</option>
                            <option value="Resuelto_NO_Favorable">No Favorable</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filtro_responsable" class="form-label small fw-bold">Responsable</label>
                        <input type="text" class="form-control form-control-sm" id="filtro_responsable"
                            placeholder="Nombre Responsable">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>
                        <button type="button" class="btn btn-link text-decoration-none text-muted small"
                            onclick="limpiarFiltros()">
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>-->

    <!-- Resultados -->
    <!--<div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold fs-6">Resultados (<span id="resultados_count">0</span>)</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaResultados">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Tipo Ingreso</th>
                            <th>Responsable</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="small">-->
                        <!-- Data loaded dynamically -->
                    <!--</tbody>
                </table>
            </div>
            <div id="pagination_container" class="py-3 border-top"></div>
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/ingresos/historial.js"></script>-->


<?php include '../../api/general/footer.php'; ?>