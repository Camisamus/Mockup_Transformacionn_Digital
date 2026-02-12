<?php
include("../include/header-funcionarios.php");
?>

<header class="h-16 flex items-center justify-between border-b border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 px-6 shrink-0 z-10">
<div class="flex items-center gap-4 flex-1">
<h2 class="text-lg font-bold tracking-tight">Expediente Digital del Emprendedor</h2>
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
<!-- Main Content -->
<main class="flex-1 flex flex-col gap-6 p-8 overflow-y-auto">
<!-- Breadcrumbs -->
<div class="flex flex-wrap items-center gap-2">
<a class="text-[#617589] text-sm font-medium hover:text-primary" href="#">Inicio</a>
<span class="material-symbols-outlined text-[#617589] text-xs">chevron_right</span>
<a class="text-[#617589] text-sm font-medium hover:text-primary" href="#">Emprendedores</a>
<span class="material-symbols-outlined text-[#617589] text-xs">chevron_right</span>
<span class="text-primary text-sm font-semibold">Perfil Detallado</span>
</div>
<!-- Profile Header Card -->
<div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f] p-6 shadow-sm">
<div class="flex flex-col @container">
<div class="flex w-full flex-col gap-6 @[520px]:flex-row @[520px]:justify-between">
<div class="flex gap-6">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-xl h-28 w-28 border border-[#dbe0e6] dark:border-[#2a343f]" data-alt="Entrepreneurship product showcase" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCA736bd43Us9iHRAdMJRfQ05OlPD-RqupBWf9NkNQptdKZcOoRl4O54vCWekXwS7nANzaplLSreRI-3fd-xAFyZnPzeek_ZskyT4xu7weU63ZNY3sRkvRNH3bYtlGUiKTk5cuDgad-MGRo01tG1Bogxl_1bwNSv1xnkEv7snfQG0JZob1iAci7eRivHSJH_RIh1NQiodGVc6qa4aTSFf3QKkn6E2n48p9q-cfOjjSHzLnmoke6l-numr-Ig79WJHRkQnxFDdGYp5Ae");'></div>
<div class="flex flex-col justify-center">
<h2 class="text-[#111418] dark:text-white text-2xl font-bold leading-tight">Artesanías Mar del Plata</h2>
<div class="mt-2 space-y-1">
<p class="text-[#617589] text-sm flex items-center gap-2">
<span class="font-semibold text-[#111418] dark:text-gray-300">RUT:</span> 77.654.321-K 
                                        <span class="mx-2">|</span>
<span class="font-semibold text-[#111418] dark:text-gray-300">Rubro:</span> Orfebrería
                                    </p>
<p class="text-[#617589] text-sm flex items-center gap-2">
<span class="font-semibold text-[#111418] dark:text-gray-300">Representante:</span> Juan Pérez Soto
                                    </p>
</div>
</div>
</div>
<div class="flex items-center gap-3">
<button class="flex items-center justify-center rounded-lg h-10 px-5 bg-background-light dark:bg-[#2a343f] text-[#111418] dark:text-white text-sm font-bold hover:bg-gray-200 dark:hover:bg-[#364350] transition-colors">
<span class="material-symbols-outlined mr-2 text-[18px]">arrow_back</span>
                                Volver
                            </button>
<button class="flex items-center justify-center rounded-lg h-10 px-5 bg-red-500 text-white text-sm font-bold hover:bg-red-600 transition-colors shadow-sm">
<span class="material-symbols-outlined mr-2 text-[18px]">gavel</span>
                                Aplicar Sanción
                            </button>
</div>
</div>
</div>
</div>
<!-- Stats KPIs -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="flex flex-1 items-center gap-4 rounded-xl p-6 border border-[#dbe0e6] dark:border-[#2a343f] bg-white dark:bg-[#1a2632]">
<div class="size-12 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600">
<span class="material-symbols-outlined text-[28px]">stars</span>
</div>
<div>
<p class="text-[#617589] text-sm font-medium">Evaluación Promedio</p>
<div class="flex items-center gap-2">
<p class="text-[#111418] dark:text-white text-2xl font-bold">4.8 / 5.0</p>
<span class="text-[#078838] text-xs font-bold bg-[#e7f6ed] dark:bg-[#078838]/20 px-2 py-0.5 rounded-full">+0.2%</span>
</div>
<div class="flex gap-0.5 mt-1 text-yellow-400">
<span class="material-symbols-outlined text-[16px] fill-1">star</span>
<span class="material-symbols-outlined text-[16px] fill-1">star</span>
<span class="material-symbols-outlined text-[16px] fill-1">star</span>
<span class="material-symbols-outlined text-[16px] fill-1">star</span>
<span class="material-symbols-outlined text-[16px]">star_half</span>
</div>
</div>
</div>
<div class="flex flex-1 items-center gap-4 rounded-xl p-6 border border-[#dbe0e6] dark:border-[#2a343f] bg-white dark:bg-[#1a2632]">
<div class="size-12 rounded-full bg-blue-100 dark:bg-primary/20 flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[28px]">task_alt</span>
</div>
<div>
<p class="text-[#617589] text-sm font-medium">Asistencia Total</p>
<div class="flex items-center gap-2">
<p class="text-[#111418] dark:text-white text-2xl font-bold">95.0%</p>
<span class="text-[#078838] text-xs font-bold bg-[#e7f6ed] dark:bg-[#078838]/20 px-2 py-0.5 rounded-full">+5.0%</span>
</div>
<div class="w-32 h-2 bg-gray-100 dark:bg-gray-700 rounded-full mt-2 overflow-hidden">
<div class="h-full bg-primary" style="width: 95%"></div>
</div>
</div>
</div>
</div>
<!-- Tabbed Content Section -->
<div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f] overflow-hidden shadow-sm">
<!-- Tabs Header -->
<div class="flex border-b border-[#f0f2f4] dark:border-[#2a343f] px-6">
<button class="px-4 py-4 text-sm font-bold text-primary border-b-2 border-primary">Historial de Inscripciones</button>
<button class="px-4 py-4 text-sm font-medium text-[#617589] hover:text-[#111418] dark:hover:text-white">Registro de Asistencia</button>
<button class="px-4 py-4 text-sm font-medium text-[#617589] hover:text-[#111418] dark:hover:text-white">Evaluaciones Recibidas</button>
</div>
<!-- Table 1: Historial de Inscripciones -->
<div class="p-6">
<h3 class="text-lg font-bold mb-4">Inscripciones Recientes</h3>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-[#f0f2f4] dark:border-[#2a343f]">
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Fecha</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Evento / Plaza</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Estado</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589] text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-[#f0f2f4] dark:divide-[#2a343f]">
<tr class="hover:bg-background-light dark:hover:bg-[#2a343f] transition-colors">
<td class="py-4 px-4 text-sm">12 Oct 2023</td>
<td class="py-4 px-4 text-sm font-medium">Feria Plaza Victoria</td>
<td class="py-4 px-4 text-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Aprobada
                                        </span>
</td>
<td class="py-4 px-4 text-sm text-right">
<button class="text-primary font-bold hover:underline">Ver detalle</button>
</td>
</tr>
<tr class="hover:bg-background-light dark:hover:bg-[#2a343f] transition-colors">
<td class="py-4 px-4 text-sm">25 Sep 2023</td>
<td class="py-4 px-4 text-sm font-medium">Feria de Verano - Quinta Vergara</td>
<td class="py-4 px-4 text-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Aprobada
                                        </span>
</td>
<td class="py-4 px-4 text-sm text-right">
<button class="text-primary font-bold hover:underline">Ver detalle</button>
</td>
</tr>
<tr class="hover:bg-background-light dark:hover:bg-[#2a343f] transition-colors">
<td class="py-4 px-4 text-sm">02 Ago 2023</td>
<td class="py-4 px-4 text-sm font-medium">Boulevard Libertad</td>
<td class="py-4 px-4 text-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                            Rechazada
                                        </span>
</td>
<td class="py-4 px-4 text-sm text-right">
<button class="text-primary font-bold hover:underline">Ver detalle</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<!-- Table 2: Asistencia y Evaluación -->
<div class="p-6 pt-0">
<h3 class="text-lg font-bold mb-4">Resumen de Participación</h3>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="border-b border-[#f0f2f4] dark:border-[#2a343f]">
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Feria</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Asistencia</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Nota Rúbrica</th>
<th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-[#617589]">Comentarios</th>
</tr>
</thead>
<tbody class="divide-y divide-[#f0f2f4] dark:divide-[#2a343f]">
<tr class="hover:bg-background-light dark:hover:bg-[#2a343f] transition-colors">
<td class="py-4 px-4 text-sm font-medium">Feria Primavera Plaza Victoria</td>
<td class="py-4 px-4 text-sm">
<div class="flex items-center gap-2">
<span class="font-bold text-[#111418] dark:text-white">4 / 4</span>
<span class="text-xs text-[#617589]">(100%)</span>
</div>
</td>
<td class="py-4 px-4 text-sm">
<span class="font-bold text-primary">6.8</span>
</td>
<td class="py-4 px-4 text-sm text-[#617589] italic">Excelente disposición y calidad del producto...</td>
</tr>
<tr class="hover:bg-background-light dark:hover:bg-[#2a343f] transition-colors">
<td class="py-4 px-4 text-sm font-medium">Mercado de Diseño - Reñaca</td>
<td class="py-4 px-4 text-sm">
<div class="flex items-center gap-2">
<span class="font-bold text-[#111418] dark:text-white">2 / 2</span>
<span class="text-xs text-[#617589]">(100%)</span>
</div>
</td>
<td class="py-4 px-4 text-sm">
<span class="font-bold text-primary">7.0</span>
</td>
<td class="py-4 px-4 text-sm text-[#617589] italic">Presentación impecable del stand.</td>
</tr>
</tbody>
</table>
</div>
<div class="mt-8 p-4 rounded-lg bg-background-light dark:bg-[#2a343f] border border-[#dbe0e6] dark:border-[#2a343f] flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">info</span>
<p class="text-sm text-[#617589]">Para ver más detalles, descargue el <strong>Expediente PDF</strong> consolidado.</p>
</div>
<button class="flex items-center gap-2 text-sm font-bold text-primary">
<span class="material-symbols-outlined text-[20px]">download</span>
                            Descargar Expediente
                        </button>
</div>
</div>
</div>
</main>
</div>
<?php include("../include/footer-funcionarios.php"); ?>