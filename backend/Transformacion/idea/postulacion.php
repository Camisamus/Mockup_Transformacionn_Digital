<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gestión de Postulaciones y Cupos - Viña del Mar</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        body {
            font-family: "Public Sans", sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<!-- TopNavBar Modificado -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-10 py-3">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3 text-primary">
<div class="size-8 flex items-center justify-center bg-primary rounded-lg text-white">
<span class="material-symbols-outlined">account_balance</span>
</div>
<div class="flex flex-col">
<h2 class="text-slate-900 dark:text-slate-100 text-lg font-bold leading-tight tracking-tight">Municipio de Cuidados</h2>
<span class="text-xs font-medium text-slate-500 uppercase tracking-widest">Viña del Mar</span>
</div>
</div>
<label class="flex flex-col min-w-40 h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-slate-500 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg border-r-0">
<span class="material-symbols-outlined text-xl">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-100 focus:outline-0 focus:ring-0 border-none bg-slate-100 dark:bg-slate-800 focus:border-none h-full placeholder:text-slate-500 px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal" placeholder="Buscar postulante..." value=""/>
</div>
</label>
</div>
<div class="flex flex-1 justify-end gap-8">
<nav class="flex items-center gap-6">
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#">Dashboard</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#">Ferias</a>
<a class="text-primary text-sm font-bold border-b-2 border-primary py-1" href="#">Postulaciones</a>
<a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="#">Reportes</a>
</nav>
<div class="flex gap-2">
<button class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
</div>
<div class="bg-primary/10 border border-primary/20 aspect-square rounded-full size-10 flex items-center justify-center text-primary font-bold overflow-hidden" data-alt="User profile avatar circle">
                    AD
                </div>
</div>
</header>
<main class="flex-1 flex flex-col max-w-[1280px] mx-auto w-full px-10 py-8">
<!-- Breadcrumbs -->
<div class="flex flex-wrap gap-2 mb-6">
<a class="text-slate-500 text-sm font-medium flex items-center gap-1" href="#">
<span class="material-symbols-outlined text-sm">home</span> Inicio
                </a>
<span class="text-slate-400 text-sm">/</span>
<span class="text-slate-500 text-sm font-medium">Mantenedor</span>
<span class="text-slate-400 text-sm">/</span>
<span class="text-slate-900 dark:text-slate-100 text-sm font-bold tracking-tight">Gestión de Postulaciones</span>
</div>
<!-- Header Section -->
<div class="flex flex-wrap justify-between items-end gap-4 mb-8">
<div class="flex flex-col gap-2">
<div class="flex items-center gap-3">
<h1 class="text-slate-900 dark:text-slate-100 text-3xl font-black leading-tight tracking-tight">Feria Artesanal Quinta Vergara</h1>
<span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Publicada</span>
</div>
<p class="text-slate-500 text-base font-normal">Gestión de postulantes y asignación de cupos según puntaje de prioridad</p>
</div>
<div class="flex gap-3">
<button class="flex items-center justify-center gap-2 rounded-lg h-11 px-6 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm font-bold hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined text-lg">download</span>
                        Exportar
                    </button>
<button class="flex items-center justify-center gap-2 rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold hover:bg-blue-600 shadow-lg shadow-primary/20 transition-all">
<span class="material-symbols-outlined text-lg">check_circle</span>
                        Aprobación Masiva
                    </button>
</div>
</div>
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Total Postulantes</p>
<span class="text-primary bg-primary/10 p-2 rounded-lg material-symbols-outlined">group</span>
</div>
<p class="text-slate-900 dark:text-slate-100 tracking-tight text-3xl font-black">150</p>
<p class="text-slate-400 text-xs">Aumento del 12% vs última feria</p>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Cupos Disponibles</p>
<span class="text-blue-500 bg-blue-500/10 p-2 rounded-lg material-symbols-outlined">event_seat</span>
</div>
<p class="text-slate-900 dark:text-slate-100 tracking-tight text-3xl font-black">45 / 100</p>
<div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full mt-2">
<div class="bg-primary h-1.5 rounded-full" style="width: 55%"></div>
</div>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Pendientes</p>
<span class="text-amber-500 bg-amber-500/10 p-2 rounded-lg material-symbols-outlined">pending_actions</span>
</div>
<p class="text-slate-900 dark:text-slate-100 tracking-tight text-3xl font-black">82</p>
<p class="text-amber-500 text-xs font-semibold">Requieren acción inmediata</p>
</div>
<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex justify-between items-start">
<p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Créditos Promedio</p>
<span class="text-emerald-500 bg-emerald-500/10 p-2 rounded-lg material-symbols-outlined">payments</span>
</div>
<p class="text-slate-900 dark:text-slate-100 tracking-tight text-3xl font-black">9.4</p>
<p class="text-emerald-500 text-xs font-semibold">Cumplimiento alto</p>
</div>
</div>
<!-- Filter Tabs -->
<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
<div class="flex border-b border-slate-200 dark:border-slate-800 px-6 overflow-x-auto scrollbar-hide">
<button class="flex items-center gap-2 border-b-2 border-transparent text-slate-500 py-4 px-4 font-bold text-sm whitespace-nowrap hover:text-slate-700 transition-all">
                        Todos <span class="bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded text-[10px]">150</span>
</button>
<button class="flex items-center gap-2 border-b-2 border-primary text-primary py-4 px-4 font-bold text-sm whitespace-nowrap">
                        Pendientes <span class="bg-primary/10 px-2 py-0.5 rounded text-[10px]">82</span>
</button>
<button class="flex items-center gap-2 border-b-2 border-transparent text-slate-500 py-4 px-4 font-bold text-sm whitespace-nowrap hover:text-slate-700 transition-all">
                        Aprobados <span class="bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded text-[10px]">48</span>
</button>
<button class="flex items-center gap-2 border-b-2 border-transparent text-slate-500 py-4 px-4 font-bold text-sm whitespace-nowrap hover:text-slate-700 transition-all">
                        Rechazados <span class="bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded text-[10px]">20</span>
</button>
</div>
<!-- Applications Table -->
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 text-xs font-bold uppercase tracking-widest border-b border-slate-200 dark:border-slate-800">
<th class="px-6 py-4">Postulante</th>
<th class="px-6 py-4">Puesto Solicitado</th>
<th class="px-6 py-4 text-center">Prioridad</th>
<th class="px-6 py-4 text-center">Estado Créditos</th>
<th class="px-6 py-4">Fecha</th>
<th class="px-6 py-4 text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800">
<!-- Row 1 -->
<tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden" data-alt="Applicant portrait thumbnail">
<span class="material-symbols-outlined text-slate-400">person</span>
</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-slate-900 dark:text-slate-100 tracking-tight">Carolina Sepúlveda</span>
<span class="text-xs text-slate-500">caro.sep@mail.com</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-medium text-slate-700 dark:text-slate-300">Zona A - Puesto 12</span>
<span class="text-[10px] text-primary font-bold uppercase tracking-tighter">Vista rápida: Frente a pileta</span>
</div>
</td>
<td class="px-6 py-4 text-center">
<span class="inline-flex items-center justify-center bg-blue-100 text-blue-700 font-black text-sm size-8 rounded-lg border border-blue-200">95</span>
</td>
<td class="px-6 py-4 text-center">
<div class="flex flex-col items-center">
<span class="text-sm font-bold text-emerald-600">12 Créditos</span>
<span class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">Cumple (7+)</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-xs text-slate-500 font-medium">12 Oct, 2023</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="bg-primary/10 hover:bg-primary hover:text-white text-primary px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Aprobar</button>
<button class="bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Rechazar</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden" data-alt="Applicant portrait thumbnail">
<span class="material-symbols-outlined text-slate-400">person</span>
</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-slate-900 dark:text-slate-100 tracking-tight">Roberto Mondaca</span>
<span class="text-xs text-slate-500">r.mondaca@mail.com</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-medium text-slate-700 dark:text-slate-300">Zona B - Puesto 04</span>
<span class="text-[10px] text-primary font-bold uppercase tracking-tighter">Vista rápida: Entrada principal</span>
</div>
</td>
<td class="px-6 py-4 text-center">
<span class="inline-flex items-center justify-center bg-slate-100 text-slate-600 font-black text-sm size-8 rounded-lg border border-slate-200">72</span>
</td>
<td class="px-6 py-4 text-center">
<div class="flex flex-col items-center">
<span class="text-sm font-bold text-red-600">5 Créditos</span>
<span class="text-[10px] font-bold text-red-500 uppercase tracking-tighter">Insuficiente</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-xs text-slate-500 font-medium">10 Oct, 2023</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="bg-primary/10 hover:bg-primary hover:text-white text-primary px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Aprobar</button>
<button class="bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Rechazar</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="size-10 rounded-full bg-slate-200 flex items-center justify-center overflow-hidden" data-alt="Applicant portrait thumbnail">
<span class="material-symbols-outlined text-slate-400">person</span>
</div>
<div class="flex flex-col">
<span class="text-sm font-bold text-slate-900 dark:text-slate-100 tracking-tight">Mariela Jara</span>
<span class="text-xs text-slate-500">m.jara@mail.com</span>
</div>
</div>
</td>
<td class="px-6 py-4">
<div class="flex flex-col">
<span class="text-sm font-medium text-slate-700 dark:text-slate-300">Zona A - Puesto 01</span>
<span class="text-[10px] text-primary font-bold uppercase tracking-tighter">Vista rápida: Esquina alto flujo</span>
</div>
</td>
<td class="px-6 py-4 text-center">
<span class="inline-flex items-center justify-center bg-blue-100 text-blue-700 font-black text-sm size-8 rounded-lg border border-blue-200">88</span>
</td>
<td class="px-6 py-4 text-center">
<div class="flex flex-col items-center">
<span class="text-sm font-bold text-emerald-600">8 Créditos</span>
<span class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">Cumple (7+)</span>
</div>
</td>
<td class="px-6 py-4">
<span class="text-xs text-slate-500 font-medium">11 Oct, 2023</span>
</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="bg-primary/10 hover:bg-primary hover:text-white text-primary px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Aprobar</button>
<button class="bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Rechazar</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="flex items-center justify-between px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/30">
<p class="text-sm text-slate-500">Mostrando <span class="font-bold">1-10</span> de <span class="font-bold">82</span> pendientes</p>
<div class="flex gap-1">
<button class="p-1 rounded border border-slate-300 dark:border-slate-700 text-slate-500 hover:bg-white disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-base">chevron_left</span>
</button>
<button class="bg-primary text-white font-bold text-xs px-3 py-1 rounded">1</button>
<button class="text-slate-600 font-bold text-xs px-3 py-1 rounded hover:bg-slate-100 dark:hover:bg-slate-800">2</button>
<button class="text-slate-600 font-bold text-xs px-3 py-1 rounded hover:bg-slate-100 dark:hover:bg-slate-800">3</button>
<button class="p-1 rounded border border-slate-300 dark:border-slate-700 text-slate-500 hover:bg-white">
<span class="material-symbols-outlined text-base">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Selection Preview / Bulk Actions Tooltip -->
<div class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-8 py-4 rounded-full shadow-2xl flex items-center gap-6 z-50 animate-bounce-subtle">
<p class="text-sm font-medium"><span class="bg-primary px-2 py-0.5 rounded text-xs font-bold mr-2">82</span> postulaciones pendientes por evaluar</p>
<div class="h-4 w-[1px] bg-slate-700"></div>
<button class="text-sm font-bold text-primary hover:text-blue-400 transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-lg">auto_awesome</span>
                    Aprobar automát. por puntaje
                </button>
</div>
</main>
<!-- Footer -->
<footer class="mt-auto px-10 py-6 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-center">
<p class="text-slate-400 text-xs font-medium uppercase tracking-widest">© 2023 Municipalidad de Viña del Mar - Sistema de Gestión de Cuidados</p>
</footer>
</div>
</div>
</body></html>