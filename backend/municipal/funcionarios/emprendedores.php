<?php
include("../include/header-funcionarios.php");
?>
<header class="h-16 flex items-center justify-between border-b border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 px-6 shrink-0 z-10">
<div class="flex items-center gap-4 flex-1">
<h2 class="text-lg font-bold tracking-tight">Gestión de Emprendedores</h2>
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
<!-- Page Heading -->
<div class="flex flex-col gap-2 mb-8">
<h1 class="text-[#111418] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Gestión de Emprendedores</h1>
<p class="text-[#617589] dark:text-gray-400 text-base font-normal">Monitoreo de desempeño, participación y cumplimiento del programa municipal de Viña del Mar.</p>
</div>
<!-- KPI Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
<!-- KPI 1: Promedio de Evaluación -->
<div class="flex flex-col gap-3 rounded-xl p-8 bg-white dark:bg-gray-800 border border-[#dbe0e6] dark:border-gray-700 shadow-sm relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-6xl text-primary">stars</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary fill-icon">stars</span>
<p class="text-[#617589] dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Promedio de Evaluación</p>
</div>
<div class="flex items-baseline gap-3">
<p class="text-[#111418] dark:text-white tracking-tight text-5xl font-black leading-tight">4.2</p>
<p class="text-[#617589] dark:text-gray-400 text-lg">/ 5.0</p>
</div>
<div class="flex items-center gap-2 text-[#078838] bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded w-fit">
<span class="material-symbols-outlined text-sm font-bold">trending_up</span>
<p class="text-sm font-bold leading-normal">+5.2% vs mes anterior</p>
</div>
</div>
<!-- KPI 2: Índice de Asistencia -->
<div class="flex flex-col gap-3 rounded-xl p-8 bg-white dark:bg-gray-800 border border-[#dbe0e6] dark:border-gray-700 shadow-sm relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-6xl text-primary">calendar_month</span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">how_to_reg</span>
<p class="text-[#617589] dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Índice de Asistencia</p>
</div>
<div class="flex items-baseline gap-3">
<p class="text-[#111418] dark:text-white tracking-tight text-5xl font-black leading-tight">85.4%</p>
</div>
<div class="flex items-center gap-2 text-[#078838] bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded w-fit">
<span class="material-symbols-outlined text-sm font-bold">trending_up</span>
<p class="text-sm font-bold leading-normal">+2.1% participación</p>
</div>
</div>
</div>
<!-- Section Header with Filters -->
<div class="flex flex-col md:flex-row justify-between items-end md:items-center mb-6 gap-4">
<h2 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight tracking-[-0.015em]">Listado de Emprendedores Inscritos</h2>
<div class="flex gap-2 p-1 bg-gray-100 dark:bg-gray-800 rounded-lg">
<button class="flex h-9 items-center justify-center gap-x-2 rounded-md bg-white dark:bg-gray-700 px-4 shadow-sm">
<p class="text-primary text-sm font-bold leading-normal">Todos</p>
</button>
<button class="flex h-9 items-center justify-center gap-x-2 rounded-md px-4 hover:bg-white/50 dark:hover:bg-gray-600 transition-all">
<p class="text-[#617589] dark:text-gray-300 text-sm font-medium leading-normal">Artesanía</p>
</button>
<button class="flex h-9 items-center justify-center gap-x-2 rounded-md px-4 hover:bg-white/50 dark:hover:bg-gray-600 transition-all">
<p class="text-[#617589] dark:text-gray-300 text-sm font-medium leading-normal">Gastronomía</p>
</button>
<button class="flex h-9 items-center justify-center gap-x-2 rounded-md px-4 hover:bg-white/50 dark:hover:bg-gray-600 transition-all">
<p class="text-[#617589] dark:text-gray-300 text-sm font-medium leading-normal">Textil</p>
</button>
</div>
</div>
<!-- Main Data Table -->
<div class="bg-white dark:bg-gray-800 rounded-xl border border-[#dbe0e6] dark:border-gray-700 overflow-hidden shadow-sm">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-background-light dark:bg-gray-900/50 text-[#617589] dark:text-gray-400 text-sm font-bold uppercase tracking-wider">
<th class="px-6 py-4">Emprendedor</th>
<th class="px-6 py-4">RUT</th>
<th class="px-6 py-4">Rubro</th>
<th class="px-6 py-4">Evaluación</th>
<th class="px-6 py-4">Asistencia</th>
<th class="px-6 py-4 text-center">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-[#f0f2f4] dark:divide-gray-700">
<!-- Row 1 -->
<tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">ML</div>
<div>
<p class="text-[#111418] dark:text-white font-bold">María Luz Valdivia</p>
<p class="text-[#617589] text-xs">Inscrita: Mar 2023</p>
</div>
</div>
</td>
<td class="px-6 py-5 text-[#111418] dark:text-gray-300 font-medium">12.345.678-9</td>
<td class="px-6 py-5">
<span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-primary text-xs font-bold rounded-full">Artesanía</span>
</td>
<td class="px-6 py-5">
<div class="flex text-yellow-500">
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined text-lg">star</span>
</div>
<span class="text-xs text-[#617589] font-medium ml-1">4.0 / 5.0</span>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 max-w-[80px]">
<div class="bg-[#078838] h-2 rounded-full" style="width: 95%"></div>
</div>
<span class="text-[#111418] dark:text-white font-bold">95%</span>
</div>
</td>
<td class="px-6 py-5 text-center">
<a href="emprendedores-detalle.php" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all inline-flex items-center gap-2">
<span>Ver</span>
<span class="material-symbols-outlined text-sm">visibility</span>
</a>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">JS</div>
<div>
<p class="text-[#111418] dark:text-white font-bold">Jorge Sepúlveda</p>
<p class="text-[#617589] text-xs">Inscrito: Ene 2024</p>
</div>
</div>
</td>
<td class="px-6 py-5 text-[#111418] dark:text-gray-300 font-medium">15.987.654-2</td>
<td class="px-6 py-5">
<span class="px-3 py-1 bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-xs font-bold rounded-full">Gastronomía</span>
</td>
<td class="px-6 py-5">
<div class="flex text-yellow-500">
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg text-primary/30">star</span>
</div>
<span class="text-xs text-[#617589] font-medium ml-1">4.8 / 5.0</span>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 max-w-[80px]">
<div class="bg-[#078838] h-2 rounded-full" style="width: 82%"></div>
</div>
<span class="text-[#111418] dark:text-white font-bold">82%</span>
</div>
</td>
<td class="px-6 py-5 text-center">
<button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all inline-flex items-center gap-2">
<span>Ver</span>
<span class="material-symbols-outlined text-sm">visibility</span>
</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">AE</div>
<div>
<p class="text-[#111418] dark:text-white font-bold">Andrea Espinoza</p>
<p class="text-[#617589] text-xs">Inscrita: Feb 2024</p>
</div>
</div>
</td>
<td class="px-6 py-5 text-[#111418] dark:text-gray-300 font-medium">17.123.456-k</td>
<td class="px-6 py-5">
<span class="px-3 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-xs font-bold rounded-full">Textil</span>
</td>
<td class="px-6 py-5">
<div class="flex text-yellow-500">
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined text-lg">star</span>
<span class="material-symbols-outlined text-lg">star</span>
</div>
<span class="text-xs text-[#617589] font-medium ml-1">3.2 / 5.0</span>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 max-w-[80px]">
<div class="bg-yellow-500 h-2 rounded-full" style="width: 64%"></div>
</div>
<span class="text-[#111418] dark:text-white font-bold">64%</span>
</div>
</td>
<td class="px-6 py-5 text-center">
<button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all inline-flex items-center gap-2">
<span>Ver</span>
<span class="material-symbols-outlined text-sm">visibility</span>
</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">RM</div>
<div>
<p class="text-[#111418] dark:text-white font-bold">Roberto Méndez</p>
<p class="text-[#617589] text-xs">Inscrito: Dic 2023</p>
</div>
</div>
</td>
<td class="px-6 py-5 text-[#111418] dark:text-gray-300 font-medium">9.654.321-7</td>
<td class="px-6 py-5">
<span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-primary text-xs font-bold rounded-full">Artesanía</span>
</td>
<td class="px-6 py-5">
<div class="flex text-yellow-500">
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
<span class="material-symbols-outlined fill-icon text-lg">star</span>
</div>
<span class="text-xs text-[#617589] font-medium ml-1">5.0 / 5.0</span>
</td>
<td class="px-6 py-5">
<div class="flex items-center gap-2">
<div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 max-w-[80px]">
<div class="bg-[#078838] h-2 rounded-full" style="width: 98%"></div>
</div>
<span class="text-[#111418] dark:text-white font-bold">98%</span>
</div>
</td>
<td class="px-6 py-5 text-center">
<button class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all inline-flex items-center gap-2">
<span>Ver</span>
<span class="material-symbols-outlined text-sm">visibility</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Table Footer / Pagination -->
<div class="px-6 py-4 flex items-center justify-between border-t border-[#f0f2f4] dark:border-gray-700 bg-background-light/30 dark:bg-gray-800/50">
<p class="text-sm text-[#617589] dark:text-gray-400">Mostrando 4 de 128 emprendedores</p>
<div class="flex gap-2">
<button class="p-2 border border-[#dbe0e6] dark:border-gray-700 rounded hover:bg-white dark:hover:bg-gray-700 transition-colors disabled:opacity-50" disabled="">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="p-2 border border-[#dbe0e6] dark:border-gray-700 rounded hover:bg-white dark:hover:bg-gray-700 transition-colors">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</div>
</main>
<?php include("../include/footer-funcionarios.php"); ?>