<?php
$pageTitle = "Historial de Ingresos";
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
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        vertical-align: middle;
        line-height: 1;
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
                <span class="material-symbols-outlined text-[18px]">description</span> DESCARGAR REPORTE
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
                            <option value="">Todos los Estados</option>
                            <option value="Ingresado">Pendiente (Ingresado)</option>
                            <option value="Resuelto_Favorable">Resuelto: Favorable</option>
                            <option value="Resuelto_NO_Favorable">Resuelto: No Favorable</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
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
                <span class="material-symbols-outlined text-primary-blue">history</span> Historial de Solicitudes
            </h3>
            <!--<div class="flex gap-3">
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
            </div>-->
        </div>

        <div class="overflow-x-auto p-4">
            <table class="w-full text-left" id="tablaResultados">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Rol</th>
                        <th class="px-6 py-4">Título / Contenido</th>
                        <th class="px-6 py-4 text-center">Fecha Ing.</th>
                        <th class="px-6 py-4 text-center">Vencimiento</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody id="tbody_ingresos" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<!-- Export Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script>
    if (window.feather) feather.replace();
</script>
<script src="../../recursos/js/funcionarios/ingresos/historial.js"></script>
<?php include '../../api/general/footer.php'; ?>