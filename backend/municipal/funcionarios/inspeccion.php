<?php
include("../include/header-funcionarios.php");
?>
<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1 px-6">
<div class="flex flex-col gap-2 mb-8">
<h1 class="text-[#111418] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Inspección y Control en Terreno</h1>
<p class="text-[#617589] text-base font-normal">Registro de asistencia y verificación física de emprendedores en ferias municipales.</p>
</div>
<div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm mb-6">
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-[#111418] dark:text-white">Seleccionar Feria / Espacio</label>
<select class="form-select rounded-lg border-[#dbe0e6] dark:border-slate-700 dark:bg-slate-900 focus:ring-primary">
<option>Plaza Victoria</option>
<option>Parque Quinta Vergara</option>
<option>Muelle Vergara</option>
<option>Plaza Latorre</option>
</select>
</div>
<div class="flex flex-col gap-2">
<label class="text-sm font-bold text-[#111418] dark:text-white">Fecha de Inspección</label>
<input class="form-input rounded-lg border-[#dbe0e6] dark:border-slate-700 dark:bg-slate-900 focus:ring-primary" type="date" value="2023-10-25"/>
</div>
<div class="flex items-center gap-2">
<button class="flex-1 bg-primary hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">search</span>
                            Filtrar Lista
                        </button>
</div>
</div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden mb-6">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-[#dbe0e6] dark:border-slate-700">
<th class="px-6 py-4 text-xs font-black text-[#617589] uppercase tracking-widest">Emprendedor / Negocio</th>
<th class="px-6 py-4 text-xs font-black text-[#617589] uppercase tracking-widest">Puesto Asignado</th>
<th class="px-6 py-4 text-xs font-black text-[#617589] uppercase tracking-widest">Categoría</th>
<th class="px-6 py-4 text-xs font-black text-[#617589] uppercase tracking-widest text-center">Confirmar Asistencia</th>
</tr>
</thead>
<tbody class="divide-y divide-[#dbe0e6] dark:divide-slate-700">
<tr class="table-row-hover transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-primary font-bold">MR</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">María Rodríguez</span>
<span class="text-xs text-[#617589]">Artesanías El Sol</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<span class="bg-blue-50 dark:bg-blue-900/20 text-primary text-xs font-black px-3 py-1 rounded-full border border-blue-100 dark:border-blue-800">A-12</span>
</td>
<td class="px-6 py-4">
<span class="text-sm text-[#617589]">Artesanía</span>
</td>
<td class="px-6 py-4 text-center">
<input class="form-checkbox size-6 rounded border-[#dbe0e6] text-primary focus:ring-primary cursor-pointer" type="checkbox"/>
</td>
</tr>
<tr class="table-row-hover transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-primary font-bold">JS</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Juan Soto</span>
<span class="text-xs text-[#617589]">Miel Pura Viña</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<span class="bg-blue-50 dark:bg-blue-900/20 text-primary text-xs font-black px-3 py-1 rounded-full border border-blue-100 dark:border-blue-800">A-14</span>
</td>
<td class="px-6 py-4">
<span class="text-sm text-[#617589]">Alimentos</span>
</td>
<td class="px-6 py-4 text-center">
<input class="form-checkbox size-6 rounded border-[#dbe0e6] text-primary focus:ring-primary cursor-pointer" type="checkbox"/>
</td>
</tr>
<tr class="table-row-hover transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-primary font-bold">LC</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Lucía Contreras</span>
<span class="text-xs text-[#617589]">Diseños Marinos</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<span class="bg-blue-50 dark:bg-blue-900/20 text-primary text-xs font-black px-3 py-1 rounded-full border border-blue-100 dark:border-blue-800">B-03</span>
</td>
<td class="px-6 py-4">
<span class="text-sm text-[#617589]">Textil</span>
</td>
<td class="px-6 py-4 text-center">
<input class="form-checkbox size-6 rounded border-[#dbe0e6] text-primary focus:ring-primary cursor-pointer" type="checkbox"/>
</td>
</tr>
<tr class="table-row-hover transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-primary font-bold">PA</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Pedro Alvarado</span>
<span class="text-xs text-[#617589]">Vivero Los Pinos</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<span class="bg-blue-50 dark:bg-blue-900/20 text-primary text-xs font-black px-3 py-1 rounded-full border border-blue-100 dark:border-blue-800">C-01</span>
</td>
<td class="px-6 py-4">
<span class="text-sm text-[#617589]">Plantas</span>
</td>
<td class="px-6 py-4 text-center">
<input class="form-checkbox size-6 rounded border-[#dbe0e6] text-primary focus:ring-primary cursor-pointer" type="checkbox"/>
</td>
</tr>
</tbody>
</table>
<div class="p-6 bg-slate-50 dark:bg-slate-900/50 flex justify-end items-center gap-4">
<p class="text-sm text-[#617589] font-medium">Mostrando 4 emprendedores asignados</p>
</div>
</div>
<header class="h-16 flex items-center justify-between border-b border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 px-6 shrink-0 z-10">
<div class="flex items-center gap-4 flex-1">
<h2 class="text-lg font-bold tracking-tight">Inspección Municipal en Terreno</h2>
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
<div class="flex flex-col md:flex-row justify-between items-center gap-6 p-6 bg-white dark:bg-slate-800 rounded-xl border-2 border-primary/20 shadow-lg">
<div class="flex items-center gap-4">
<div class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined">fact_check</span>
</div>
<div>
<h4 class="text-lg font-black">Finalizar Inspección</h4>
<p class="text-sm text-[#617589]">Al confirmar, se actualizará el estado de asistencia de todos los seleccionados.</p>
</div>
</div>
<button class="w-full md:w-auto bg-primary hover:bg-blue-600 text-white font-black py-4 px-10 rounded-xl transition-all shadow-xl shadow-primary/30 flex items-center justify-center gap-3 group">
<span class="material-symbols-outlined">save</span>
<span class="uppercase tracking-tight">Guardar y Confirmar Asistencia</span>
</button>
</div>
</div>
<?php include("../include/footer-funcionarios.php"); ?>