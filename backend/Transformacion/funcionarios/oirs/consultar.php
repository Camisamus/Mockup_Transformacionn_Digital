<?php 
$pageTitle = "Consulta General OIRS";
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

    .status-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-ingresada { background: #e3f2fd; color: #007bff; }
    .badge-proceso { background: #fff3e0; color: #ef6c00; }
    .badge-resuelta { background: #e8f5e9; color: #2e7d32; }
    .badge-vencida { background: #ffebee; color: #c62828; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Consulta General OIRS</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Buscador Inteligente de Solicitudes</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" id="btn_exportar_excel" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">download</span> EXPORTAR RESULTADOS
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
                        <input type="text" id="filter-search" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm bg-slate-50/50" placeholder="Escribe para buscar...">
                    </div>
                </div>
                <div class="md:col-span-3 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha de Ingreso</label>
                    <input type="date" id="filter-fecha" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                </div>
                <div class="md:col-span-3 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado de la Solicitud</label>
                    <select id="filter-estado" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                        <option value="">Todos los estados</option>
                        <option value="0">Recibida / Nueva</option>
                        <option value="1">Visada</option>
                        <option value="2">Resp. Ejecutar</option>
                        <option value="3">Respondida</option>
                        <option value="4">Ejecutada</option>
                        <option value="5">Notificada</option>
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
                        <select id="filter-sector" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option value="">Todos los sectores</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Temática Principal</label>
                        <select id="filter-tematica" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option value="">Todas las temáticas</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Subtemática</label>
                        <select id="filter-subtematica" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option value="">Todas las subtemáticas</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Prioridad</label>
                        <select id="filter-prioridad" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option value="">Todas</option>
                            <option value="3">Urgente</option>
                            <option value="2">Alta</option>
                            <option value="1">Normal</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4">
                    <button class="text-slate-400 font-bold text-[11px] uppercase tracking-widest hover:text-rose-500 transition-colors" id="btnReset">
                        LIMPIAR TODO
                    </button>
                    <button id="btnAplicarFiltros" class="bg-slate-800 text-white px-6 py-2.5 rounded-xl font-bold text-[11px] uppercase tracking-widest hover:bg-black transition-all shadow-md">
                        APLICAR FILTROS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span> Resultados encontrados
                <span id="solicitudes-count" class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200">0 SOLICITUDES</span>
            </h3>
        </div>

        <div class="overflow-x-auto p-4">
            <table class="w-full text-left" id="table-oirs-consulta">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Folio / Fecha</th>
                        <th class="px-6 py-4">Contribuyente</th>
                        <th class="px-6 py-4">Temática</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-oirs-consulta" class="divide-y divide-slate-100 text-[15px] text-slate-600">
                    <!-- Datos cargados dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts OIRS -->
<script src="../../recursos/js/funcionarios/oirs/consultar.js"></script>

<script>
    $(document).ready(function () {
        // Toggle filtros avanzados
        $('#btnAdvanced').click(function () {
            $('#advancedPanel').toggleClass('show');
            const isActive = $('#advancedPanel').hasClass('show');
            $(this).toggleClass('bg-primary-blue text-white border-primary-blue');
            $(this).html(isActive ? 
                '<span class="material-symbols-outlined text-lg">expand_less</span> MENOS FILTROS' : 
                '<span class="material-symbols-outlined text-lg">tune</span> MÁS FILTROS');
        });

        // Limpiar Filtros
        $('#btnReset').click(function () {
            $('input, select').val('');
        });

        // Acción botones
        $('.action-btn').click(function (e) {
            e.stopPropagation();
            Swal.fire({
                title: 'Vista previa',
                text: 'Aquí se abrirá la gestión de la solicitud seleccionada.',
                icon: 'info',
                confirmButtonColor: '#1a5f9c'
            });
        });

        // Redirección por fila
        $('.oirs-row').click(function () {
            let folio = $(this).data('folio');
            if(folio) window.location.href = 'oirs-ver.php?folio=' + folio;
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>