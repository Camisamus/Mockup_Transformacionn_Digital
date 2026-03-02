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
            <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
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
                        <input type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm bg-slate-50/50" placeholder="Escribe para buscar...">
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
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Prioridad</label>
                        <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                            <option>Todas</option>
                            <option>Urgente</option>
                            <option>Alta</option>
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

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span> Resultados encontrados
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200">12 SOLICITUDES</span>
            </h3>
            <div class="flex items-center gap-4 text-slate-400">
                <span class="text-[11px] font-bold uppercase tracking-tighter">Ordenar por: <span class="text-slate-800">Recientes</span></span>
                <span class="material-symbols-outlined cursor-pointer hover:text-primary-blue transition-colors">sort</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Folio / Fecha</th>
                        <th class="px-6 py-4">Contribuyente</th>
                        <th class="px-6 py-4">Temática</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-600">
                    <tr class="oirs-row hover:bg-slate-50/80 transition-all cursor-pointer" data-folio="2024-8851">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-black text-slate-800 tracking-tight">#OIRS-2024-8851</span>
                                <span class="text-slate-400 text-xs mt-0.5 italic">Hoy, 09:45 AM</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-primary-blue flex items-center justify-center font-bold text-[10px] border border-blue-100">RC</div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-700">Rodrigo Canales</span>
                                    <span class="text-slate-400 text-[10px] font-medium tracking-wide">15.441.229-K</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium text-slate-700">Aseo y Ornato</span>
                                <span class="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Microbasural</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="status-badge badge-ingresada">Recibida</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                <button class="action-btn text-slate-400 hover:text-primary-blue" title="Ver Detalles">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                                <button class="action-btn text-slate-400 hover:text-amber-500" title="Editar">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="action-btn text-primary-blue" title="Responder">
                                    <span class="material-symbols-outlined">reply</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Mostrando 1 a 3 de 12 registros</span>
            
            <nav class="flex items-center gap-1">
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined text-lg">chevron_left</span></button>
                <div class="flex gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary-blue text-white font-bold text-xs">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 font-bold text-xs hover:bg-slate-50">2</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 font-bold text-xs hover:bg-slate-50">3</button>
                </div>
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined text-lg">chevron_right</span></button>
            </nav>
        </div>
    </div>
</div>

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