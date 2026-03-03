<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Mantenedor: Espacios Públicos y Ferias - Municipio de Cuidados</title>
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 lg:px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-4 text-primary">
<div class="size-8 flex items-center justify-center bg-primary/10 rounded-lg">
<span class="material-symbols-outlined text-primary text-2xl">location_city</span>
</div>
<h2 class="text-slate-900 dark:text-slate-100 text-lg font-bold leading-tight tracking-[-0.015em]">Municipio de Cuidados</h2>
</div>
<nav class="hidden md:flex items-center gap-6">
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Dashboard</a>
<a class="text-primary text-sm font-bold border-b-2 border-primary pb-1" href="#">Espacios</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Ferias</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Reportes</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Configuración</a>
</nav>
</div>
<div class="flex flex-1 justify-end gap-4 lg:gap-8">
<label class="hidden sm:flex flex-col min-w-40 h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full border border-slate-200 dark:border-slate-700">
<div class="text-slate-400 flex items-center justify-center pl-4 bg-slate-50 dark:bg-slate-800 rounded-l-lg">
<span class="material-symbols-outlined text-xl">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 border-none bg-slate-50 dark:bg-slate-800 focus:ring-0 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 px-4 rounded-r-lg text-sm" placeholder="Buscar espacios..."/>
</div>
</label>
<div class="flex gap-2">
<button class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
<span class="material-symbols-outlined">account_circle</span>
</button>
</div>
</div>
</header>
<div class="flex flex-1 overflow-hidden">
<aside class="hidden lg:flex flex-col w-64 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 gap-6">
<div class="flex flex-col">
<h1 class="text-slate-900 dark:text-slate-100 text-base font-bold">Mantenedor</h1>
<p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider">Viña del Mar</p>
</div>
<div class="flex flex-col gap-1">
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-xl">dashboard</span>
<p class="text-sm font-medium">Panel General</p>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary" href="#">
<span class="material-symbols-outlined text-xl">location_on</span>
<p class="text-sm font-bold">Gestión de Espacios</p>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-xl">calendar_today</span>
<p class="text-sm font-medium">Calendario de Ferias</p>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-xl">description</span>
<p class="text-sm font-medium">Solicitudes</p>
</a>
<div class="h-px bg-slate-200 dark:border-slate-800 my-2"></div>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="#">
<span class="material-symbols-outlined text-xl">settings</span>
<p class="text-sm font-medium">Configuración</p>
</a>
</div>
</aside>
<main class="flex-1 overflow-y-auto p-4 lg:p-8">
<div class="max-w-[1200px] mx-auto space-y-8">
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
<div>
<h2 class="text-slate-900 dark:text-slate-100 text-3xl font-black leading-tight tracking-tight">Mantenedor de Ferias y Espacios Públicos</h2>
<p class="text-slate-500 dark:text-slate-400 text-base mt-1">Gestión centralizada de infraestructura y recintos feriales municipales de Viña del Mar.</p>
</div>
<button class="flex items-center justify-center gap-2 rounded-lg bg-primary text-white px-5 py-2.5 text-sm font-bold hover:bg-blue-600 transition-all shadow-sm shadow-primary/20">
<span class="material-symbols-outlined text-lg">add_circle</span>
<span>Crear Nuevo Espacio Público</span>
</button>
</div>
<div class="flex border-b border-slate-200 dark:border-slate-800 gap-8">
<button class="flex items-center border-b-2 border-primary text-primary pb-3 font-bold text-sm">Plazas</button>
<button class="flex items-center border-b-2 border-transparent text-slate-500 dark:text-slate-400 pb-3 font-medium text-sm hover:text-slate-700 transition-colors">Parques</button>
<button class="flex items-center border-b-2 border-transparent text-slate-500 dark:text-slate-400 pb-3 font-medium text-sm hover:text-slate-700 transition-colors">Centros Recreativos</button>
<button class="flex items-center border-b-2 border-transparent text-slate-500 dark:text-slate-400 pb-3 font-medium text-sm hover:text-slate-700 transition-colors">Bordes Costeros</button>
</div>
<div class="grid grid-cols-1 gap-6">
<div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Espacio Público</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ubicación</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Capacidad</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">Layout</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Servicios</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Categorías</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800">
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined">nature_people</span>
</div>
<span class="font-bold text-slate-900 dark:text-slate-100">Plaza Victoria</span>
</div>
</td>
<td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400">Centro Viña</td>
<td class="px-6 py-5 text-center">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200">
                                                        45 Puestos
                                                    </span>
</td>
<td class="px-6 py-5 text-center">
<button class="text-primary hover:underline text-xs font-bold flex items-center justify-center gap-1 mx-auto">
<span class="material-symbols-outlined text-sm">map</span> Ver Mapa
                                                    </button>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold uppercase tracking-tight">Luz</span>
<span class="text-[10px] px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold uppercase tracking-tight">Agua</span>
</div>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold uppercase tracking-tight">Artesanía</span>
<span class="text-[10px] px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold uppercase tracking-tight">Alimentos</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">edit</span>
</button>
</td>
</tr>
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined">deck</span>
</div>
<span class="font-bold text-slate-900 dark:text-slate-100">Plaza Colombia</span>
</div>
</td>
<td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400">Sector Casino</td>
<td class="px-6 py-5 text-center">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200">
                                                        60 Puestos
                                                    </span>
</td>
<td class="px-6 py-5 text-center">
<button class="text-primary hover:underline text-xs font-bold flex items-center justify-center gap-1 mx-auto">
<span class="material-symbols-outlined text-sm">map</span> Ver Mapa
                                                    </button>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold uppercase tracking-tight">Luz</span>
</div>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold uppercase tracking-tight">General</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<button class="text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">edit</span>
</button>
</td>
</tr>
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-5">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
<span class="material-symbols-outlined">construction</span>
</div>
<span class="font-bold text-slate-900 dark:text-slate-100">Plaza México</span>
</div>
</td>
<td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-400">Sector Centro</td>
<td class="px-6 py-5 text-center">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200">
                                                        30 Puestos
                                                    </span>
</td>
<td class="px-6 py-5 text-center">
<button class="text-slate-400 cursor-not-allowed text-xs font-bold flex items-center justify-center gap-1 mx-auto" disabled="">
<span class="material-symbols-outlined text-sm">lock</span> Bloqueado
                                                    </button>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 font-bold uppercase tracking-tight">Agua</span>
</div>
</td>
<td class="px-6 py-5">
<div class="flex flex-wrap gap-1">
<span class="text-[10px] px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-bold uppercase tracking-tight">Flores</span>
</div>
</td>
<td class="px-6 py-5 text-right">
<span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-orange-100 text-orange-700 uppercase">Mantenimiento</span>
</td>
</tr>
</tbody>
</table>
</div>
<div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-between items-center">
<p class="text-xs text-slate-500 dark:text-slate-400">Mostrando 3 de 12 plazas públicas</p>
<div class="flex gap-2">
<button class="p-1 rounded bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-400"><span class="material-symbols-outlined text-sm">chevron_left</span></button>
<button class="p-1 rounded bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-400"><span class="material-symbols-outlined text-sm">chevron_right</span></button>
</div>
</div>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex items-center gap-4">
<div class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-3xl">store</span>
</div>
<div>
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Puestos Habilitados</p>
<p class="text-2xl font-black text-slate-900 dark:text-slate-100">1,240</p>
</div>
</div>
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex items-center gap-4">
<div class="size-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
<span class="material-symbols-outlined text-3xl">map</span>
</div>
<div>
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Layouts Digitalizados</p>
<p class="text-2xl font-black text-slate-900 dark:text-slate-100">85%</p>
</div>
</div>
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex items-center gap-4 md:col-span-2 lg:col-span-1">
<div class="size-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
<span class="material-symbols-outlined text-3xl">event_available</span>
</div>
<div>
<p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Ferias Activas Hoy</p>
<p class="text-2xl font-black text-slate-900 dark:text-slate-100">14</p>
</div>
</div>
</div>
<div class="bg-primary/5 rounded-2xl border border-primary/10 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
<div class="space-y-2">
<h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">¿Necesitas ayuda con el Layout de un espacio?</h3>
<p class="text-slate-600 dark:text-slate-400">Puedes cargar mapas en formato SVG o GeoJSON para definir coordenadas exactas de cada puesto.</p>
</div>
<button class="bg-white dark:bg-slate-900 text-primary border border-primary font-bold px-6 py-3 rounded-lg hover:bg-primary hover:text-white transition-all shadow-sm">
                                Consultar Guía Técnica
                            </button>
</div>
</div>
</main>
</div>
</div>
</div>
</body></html>