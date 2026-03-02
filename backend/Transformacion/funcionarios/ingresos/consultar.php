<?php
$pageTitle = "Consultar Ingreso";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" type="text/css" />

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                    "soft-cyan": "#F0FFFF",
                    "cyan-border": "#E0FFFF"
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
        vertical-align: middle;
        line-height: 1;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    #network-container {
        width: 100%;
        height: 600px;
        background-color: #f8f9fa;
        border-radius: 1.5rem;
    }

    /* Estilo de la barra de pestañas premium */
    #ingresosTabs {
        background-color: white;
        border-radius: 9999px;
        padding: 5px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        display: inline-flex;
    }

    #ingresosTabs .nav-item {
        margin-right: 0;
    }

    #ingresosTabs .nav-link {
        border: none !important;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 9999px;
        transition: all 0.3s ease;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    #ingresosTabs .nav-link.active {
        background-color: #1a5f9c !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(26, 95, 156, 0.3);
    }

    #ingresosTabs .nav-link:hover:not(.active) {
        background-color: #f1f5f9;
        color: #1a5f9c;
    }

    .label-custom {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
    }
</style>


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
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        vertical-align: middle;
        line-height: 1;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Historial de Ingresos</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider">Consulta y revisión
                histórica de registros</p>
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
                        <label for="filtro_id" class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">ID
                            Ingreso</label>
                        <input type="text"
                            class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm"
                            id="filtro_id" placeholder="Ej: ID Interno">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_fecha_inicio"
                            class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha
                            (Inicio)</label>
                        <input type="date"
                            class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm"
                            id="filtro_fecha_inicio">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_fecha_fin"
                            class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha (Fin)</label>
                        <input type="date"
                            class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm"
                            id="filtro_fecha_fin">
                    </div>
                    <div class="space-y-2">
                        <label for="filtro_estado"
                            class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm"
                            id="filtro_estado">
                            <option value="">Todos (Favorables y No Favorables)</option>
                            <option value="Resuelto_Favorable">Favorable</option>
                            <option value="Resuelto_NO_Favorable">No Favorable</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                    <div class="md:col-span-2 space-y-2">
                        <label for="filtro_responsable"
                            class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Responsable</label>
                        <input type="text"
                            class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm"
                            id="filtro_responsable" placeholder="Nombre Responsable">
                    </div>
                    <div class="md:col-span-2 flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-slate-800 hover:bg-black text-white font-bold py-2.5 rounded-xl shadow-md transition-all text-[11px] uppercase tracking-widest flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">search</span> APLICAR FILTROS
                        </button>
                        <button type="button" onclick="limpiarFiltros()"
                            class="px-6 py-2.5 border-2 border-slate-200 text-slate-400 font-bold rounded-xl hover:bg-slate-50 transition-all text-[11px] uppercase tracking-widest">
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
                <span
                    class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200"
                    id="resultados_count">0</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left" id="tablaResultados">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Ver</th>
                        <th class="px-6 py-4">Título / Contenido</th>
                        <th class="px-6 py-4 text-center">Fecha</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4">Tipo Ingreso</th>
                        <th class="px-6 py-4">Responsable</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>

        <div id="pagination_container" class="p-6 bg-white border-t border-slate-50 flex justify-between items-center">
        </div>
    </div>

</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/ingresos/permisos.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/consultar.js"></script>

<?php include '../../api/general/footer.php'; ?>