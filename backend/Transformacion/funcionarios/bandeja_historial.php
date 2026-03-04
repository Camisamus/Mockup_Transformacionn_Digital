<?php
$pageTitle = "Historial de Solicitudes";
require_once '../api/general/auth_check.php';
include '../api/general/header.php';
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
        vertical-align: middle;
    }
    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    /* Mantenemos compatibilidad con el modal de Bootstrap */
    .modal-backdrop { z-index: 1040 !important; }
    .modal { z-index: 1050 !important; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Historial de Solicitudes</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Consulta de solicitudes cerradas y finalizadas.</p>
        </div>
        
        <div class="flex flex-row gap-3 w-full lg:w-auto justify-center lg:justify-end">
            <button type="button" id="btnFiltrar"
                class="flex-1 lg:flex-none whitespace-nowrap bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">filter_list</span> Filtrar por Fechas
            </button>
            <button type="button" onclick="window.location.href = 'index.php'"
                class="flex-1 lg:flex-none whitespace-nowrap bg-slate-700 hover:bg-slate-800 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span> Volver a Bandeja
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success flex items-center gap-4">
            <div class="rounded-full bg-emerald-50 p-4 text-gob-success">
                <span class="material-symbols-outlined text-3xl">check_circle</span>
            </div>
            <div>
                <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Solicitudes Cerradas</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="totalSolicitudes">...</h3>
            </div>
        </div>
        
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue flex items-center gap-4">
            <div class="rounded-full bg-blue-50 p-4 text-primary-blue">
                <span class="material-symbols-outlined text-3xl">calendar_today</span>
            </div>
            <div>
                <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Rango de Fechas</p>
                <h3 class="text-lg font-bold text-slate-700 mb-0" id="rangoFechas">Últimos 30 días</h3>
            </div>
        </div>

        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400 flex items-center gap-4">
            <div class="rounded-full bg-slate-50 p-4 text-slate-500">
                <span class="material-symbols-outlined text-3xl">history</span>
            </div>
            <div>
                <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Cerrados</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0" id="totalCerrados">...</h3>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">manage_search</span>
                <h3 class="font-bold text-slate-700">Listado de Solicitudes Finalizadas</h3>
            </div>
            <span class="pagination-info text-xs font-semibold text-slate-400">Mostrando historial</span>
        </div>
    
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="tablaBandeja">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Asunto / Título</th>
                        <th class="px-6 py-4">Origen</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4 text-center">Fecha Recepción</th>
                        <th class="px-6 py-4 text-center">Fecha Cierre</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[14px] text-slate-700" id="table-body">
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">Cargando historial...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-slate-50/50 flex justify-end gap-2 border-t border-slate-100">
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnAnterior" disabled>
                <span class="material-symbols-outlined text-sm">chevron_left</span> Anterior
            </button>
            <button class="flex items-center gap-1 bg-white border border-slate-200 px-4 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:bg-slate-50 disabled:opacity-50 transition-all" id="btnSiguiente">
                Siguiente <span class="material-symbols-outlined text-sm">chevron_right</span>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFiltrarFechas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="bg-slate-50 p-6 border-b border-slate-100">
                <h5 class="font-extrabold text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined">calendar_month</span> Filtrar por Rango de Fechas
                </h5>
            </div>
            <div class="p-6">
                <form id="formFiltrarFechas" class="space-y-4">
                    <div class="space-y-1">
                        <label for="fechaInicio" class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Fecha Inicio</label>
                        <input type="date" class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3" id="fechaInicio" required>
                    </div>
                    <div class="space-y-1">
                        <label for="fechaFin" class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Fecha Fin</label>
                        <input type="date" class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3" id="fechaFin" required>
                    </div>
                </form>
            </div>
            <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" class="text-slate-400 font-bold text-xs uppercase px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="bg-slate-200 text-slate-700 font-bold py-2.5 px-6 rounded-xl text-xs uppercase transition-all" id="btnLimpiarFiltro">
                    Limpiar Filtro
                </button>
                <button type="button" class="bg-primary-blue text-white font-bold py-2.5 px-6 rounded-xl text-xs uppercase shadow-lg" id="btnAplicarFiltro">
                    Aplicar Filtro
                </button>
            </div>
        </div>
    </div>
</div>

<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/funcionarios/NO_Asignadas/bandeja_historial.js"></script>

<?php include '../api/general/footer.php'; ?>