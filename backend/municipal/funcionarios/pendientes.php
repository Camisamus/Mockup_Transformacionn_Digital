<?php
include("../include/header-funcionarios.php");
?>
<header class="h-16 flex items-center justify-between border-b border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 px-6 shrink-0 z-10">
<div class="flex items-center gap-4 flex-1">
<h2 class="text-lg font-bold tracking-tight">Bandeja de Solicitudes Pendientes</h2>
</div>
<div class="flex items-center gap-4">
<div class="flex items-center gap-2 text-xs font-medium text-[#617589]">
<span class="size-2 bg-amber-500 rounded-full"></span>
<span>15 Solicitudes urgentes</span>
</div>
<button class="p-2 rounded-lg bg-background-light dark:bg-slate-800 text-[#617589] hover:text-primary transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
</div>
</header>
<div class="flex-1 overflow-y-auto custom-scrollbar p-6">
<div class="max-w-7xl mx-auto space-y-6">
<div class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-[#dbe0e6] dark:border-slate-800 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
<div class="relative w-full md:w-96">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-background-light dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50" placeholder="Buscar por RUT o Nombre de Emprendedor..." type="text"/>
</div>
<div class="flex items-center gap-3 w-full md:w-auto">
<div class="flex items-center gap-2">
<label class="text-xs font-bold text-[#617589] uppercase whitespace-nowrap">Filtrar por:</label>
<select class="bg-background-light dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50 py-2 min-w-[140px]">
<option>Todos los Estados</option>
<option>Pendiente</option>
<option>Observado</option>
</select>
</div>
<button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-primary/90 transition-all">
<span class="material-symbols-outlined text-lg">filter_alt</span>
                            Aplicar
                        </button>
</div>
</div>
<div class="bg-white dark:bg-slate-900 rounded-xl border border-[#dbe0e6] dark:border-slate-800 shadow-sm overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-[#dbe0e6] dark:border-slate-800">
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider">ID de Solicitud</th>
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider">Emprendedor</th>
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider">Rubro</th>
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider">Fecha Postulación</th>
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider">Estado</th>
<th class="px-6 py-4 text-[11px] font-bold text-[#617589] uppercase tracking-wider text-right">Acción</th>
</tr>
</thead>
<tbody class="divide-y divide-[#f0f2f4] dark:divide-slate-800">
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<span class="text-xs font-bold text-primary">#SL-2024-0891</span>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-bold">María José Valenzuela</span>
<span class="text-[11px] text-[#617589]">15.678.901-2</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase">Artesanía Textil</span>
</td>
<td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                        12 Oct, 2024
                                    </td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-[10px] font-bold uppercase">
<span class="size-1.5 bg-amber-500 rounded-full"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<a href="postulacion.php" class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90 transition-all shadow-sm">
                                            Ver Detalle
</a>
</td>
</tr>
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<span class="text-xs font-bold text-primary">#SL-2024-0887</span>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-bold">Roberto Carlos Díaz</span>
<span class="text-[11px] text-[#617589]">12.443.210-K</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 text-[10px] font-bold uppercase">Gastronomía</span>
</td>
<td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                        11 Oct, 2024
                                    </td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 text-[10px] font-bold uppercase">
<span class="size-1.5 bg-red-500 rounded-full"></span>
                                            Observado
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<a href="postulacion.php" class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90 transition-all shadow-sm">
                                            Ver Detalle
</a>
</td>
</tr>
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<span class="text-xs font-bold text-primary">#SL-2024-0885</span>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-bold">Lucía Fernanda Torres</span>
<span class="text-[11px] text-[#617589]">18.223.445-4</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold uppercase">Plantas y Ornato</span>
</td>
<td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                        10 Oct, 2024
                                    </td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-[10px] font-bold uppercase">
<span class="size-1.5 bg-amber-500 rounded-full"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<a href="postulacion.php" class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90 transition-all shadow-sm">
                                            Ver Detalle
</a>
</td>
</tr>
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<span class="text-xs font-bold text-primary">#SL-2024-0882</span>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-bold">Jorge Andrés Paredes</span>
<span class="text-[11px] text-[#617589]">16.992.103-2</span>
</div>
</td>
<td class="px-6 py-4">
<span class="px-2.5 py-1 rounded bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase">Orfebrería</span>
</td>
<td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                        09 Oct, 2024
                                    </td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 text-[10px] font-bold uppercase">
<span class="size-1.5 bg-amber-500 rounded-full"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<a href="postulacion.php" class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90 transition-all shadow-sm">
                                            Ver Detalle
</a>
</td>
</tr>
</tbody>
</table>
</div>
<div class="p-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-50/50 dark:bg-slate-800/30 border-t border-[#dbe0e6] dark:border-slate-800">
<p class="text-xs text-[#617589] font-medium">Mostrando 1 a 4 de un total de 42 solicitudes entrantes</p>
<div class="flex gap-1">
<button class="size-9 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="size-9 flex items-center justify-center rounded-lg bg-primary text-white font-bold text-xs">1</button>
<button class="size-9 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors text-xs font-medium">2</button>
<button class="size-9 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors text-xs font-medium">3</button>
<button class="size-9 flex items-center justify-center rounded-lg border border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
<div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800 p-4 rounded-xl flex gap-3">
<span class="material-symbols-outlined text-blue-600">info</span>
<div>
<h4 class="text-sm font-bold text-blue-900 dark:text-blue-300">Procedimiento de Revisión</h4>
<p class="text-xs text-blue-700 dark:text-blue-400 mt-1">Recuerde que todas las solicitudes en estado 'Pendiente' deben ser validadas en un plazo máximo de 48 horas hábiles según el reglamento de ferias comunales 2024.</p>
</div>
</div>
</div>
</div>
<?php include("../include/footer-funcionarios.php"); ?>