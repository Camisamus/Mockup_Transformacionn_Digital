<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Mantenedor: Registro de Emprendedores - Viña del Mar</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<!-- Top Navigation Bar -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-10 py-3">
<div class="flex items-center gap-8">
<div class="flex items-center gap-4 text-primary">
<div class="size-8 flex items-center justify-center">
<span class="material-symbols-outlined text-4xl">domain</span>
</div>
<h2 class="text-slate-900 dark:text-slate-100 text-lg font-bold leading-tight tracking-tight">Municipio de Cuidados</h2>
</div>
<label class="flex flex-col min-w-40 h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-slate-500 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg" data-icon="search">
<span class="material-symbols-outlined">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 rounded-lg text-slate-900 dark:text-slate-100 focus:outline-0 focus:ring-0 border-none bg-slate-100 dark:bg-slate-800 h-full placeholder:text-slate-500 px-4 rounded-l-none pl-2 text-base font-normal" placeholder="Buscar..." value=""/>
</div>
</label>
</div>
<div class="flex flex-1 justify-end gap-8">
<div class="flex items-center gap-6">
<a class="text-slate-900 dark:text-slate-100 text-sm font-medium hover:text-primary transition-colors" href="#">Dashboard</a>
<a class="text-primary text-sm font-bold border-b-2 border-primary py-1" href="#">Emprendedores</a>
<a class="text-slate-900 dark:text-slate-100 text-sm font-medium hover:text-primary transition-colors" href="#">Reportes</a>
<a class="text-slate-900 dark:text-slate-100 text-sm font-medium hover:text-primary transition-colors" href="#">Configuración</a>
</div>
<div class="flex gap-2">
<button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 hover:bg-slate-200 dark:hover:bg-slate-700">
<span class="material-symbols-outlined text-xl">notifications</span>
</button>
<button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 hover:bg-slate-200 dark:hover:bg-slate-700">
<span class="material-symbols-outlined text-xl">account_circle</span>
</button>
</div>
</div>
</header>
<div class="flex flex-1">
<!-- Sidebar -->
<aside class="w-64 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 hidden lg:flex flex-col justify-between">
<div class="flex flex-col gap-6">
<div class="flex flex-col px-3">
<h1 class="text-slate-900 dark:text-slate-100 text-base font-bold leading-normal">Gestión Municipal</h1>
<p class="text-slate-500 text-sm font-normal">Viña del Mar</p>
</div>
<nav class="flex flex-col gap-1">
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
<span class="material-symbols-outlined">home</span>
<span class="text-sm font-medium">Inicio</span>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white shadow-md shadow-primary/20" href="#">
<span class="material-symbols-outlined">group</span>
<span class="text-sm font-medium">Registro Emprendedores</span>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
<span class="material-symbols-outlined">badge</span>
<span class="text-sm font-medium">Validación RUT</span>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
<span class="material-symbols-outlined">description</span>
<span class="text-sm font-medium">Documentación</span>
</a>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="text-sm font-medium">Configuración</span>
</a>
</nav>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 flex flex-col p-8 overflow-y-auto">
<!-- Title & Description -->
<div class="mb-8">
<h2 class="text-slate-900 dark:text-slate-100 text-3xl font-extrabold tracking-tight">Mantenedor de Registro de Emprendedores</h2>
<p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Gestión y validación de nuevos registros de emprendimientos locales de Viña del Mar.</p>
</div>
<!-- Filters & Search Bar -->
<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-6 mb-8 shadow-sm">
<div class="flex flex-wrap items-end gap-4">
<div class="flex-1 min-w-[300px]">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 block">Búsqueda rápida</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg focus:ring-2 focus:ring-primary text-sm" placeholder="Buscar por RUT o Nombre de Emprendimiento..." type="text"/>
</div>
</div>
<div class="w-48">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 block">Estado</label>
<div class="relative">
<select class="w-full pl-3 pr-10 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg focus:ring-2 focus:ring-primary text-sm appearance-none cursor-pointer">
<option>Todos</option>
<option>Pendiente</option>
<option>Documentación Incompleta</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
</div>
</div>
<div class="w-48">
<label class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 block">Validación RUT</label>
<div class="relative">
<select class="w-full pl-3 pr-10 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg focus:ring-2 focus:ring-primary text-sm appearance-none cursor-pointer">
<option>Cualquiera</option>
<option>Validado</option>
<option>No Validado</option>
</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
</div>
</div>
<button class="bg-primary hover:bg-primary/90 text-white font-bold py-2 px-6 rounded-lg transition-all text-sm h-[38px] flex items-center gap-2">
<span class="material-symbols-outlined text-sm">filter_alt</span>
                                Aplicar Filtros
                            </button>
</div>
</div>
<!-- Table Section -->
<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">RUT</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nombre Emprendimiento</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Rubro</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Fecha Registro</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Estado</th>
<th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800">
<!-- Row 1 -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">12.345.678-9</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Cafetería del Mar</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Gastronomía</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">12 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
<span class="size-1.5 rounded-full bg-amber-600 dark:bg-amber-400"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white dark:hover:bg-primary transition-all text-slate-700 dark:text-slate-300 font-bold py-1.5 px-4 rounded-lg text-xs">
                                            Ver Expediente
                                        </button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">23.456.789-0</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Artesanías Reñaca</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Artesanía</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">14 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
<span class="size-1.5 rounded-full bg-red-600 dark:bg-red-400"></span>
                                            Doc. Incompleta
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white dark:hover:bg-primary transition-all text-slate-700 dark:text-slate-300 font-bold py-1.5 px-4 rounded-lg text-xs">
                                            Ver Expediente
                                        </button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">18.234.111-K</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Moda Sustentable Viña</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Vestuario</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">15 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
<span class="size-1.5 rounded-full bg-amber-600 dark:bg-amber-400"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white dark:hover:bg-primary transition-all text-slate-700 dark:text-slate-300 font-bold py-1.5 px-4 rounded-lg text-xs">
                                            Ver Expediente
                                        </button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">15.890.345-2</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Tour Fotográfico Jardín</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Turismo</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">16 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
<span class="size-1.5 rounded-full bg-amber-600 dark:bg-amber-400"></span>
                                            Pendiente
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white dark:hover:bg-primary transition-all text-slate-700 dark:text-slate-300 font-bold py-1.5 px-4 rounded-lg text-xs">
                                            Ver Expediente
                                        </button>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
<td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-slate-100">9.345.222-1</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Frutos Secos Quilpué</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">Alimentación</td>
<td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">17 Oct 2023</td>
<td class="px-6 py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
<span class="size-1.5 rounded-full bg-red-600 dark:bg-red-400"></span>
                                            Doc. Incompleta
                                        </span>
</td>
<td class="px-6 py-4 text-right">
<button class="bg-slate-100 dark:bg-slate-800 hover:bg-primary hover:text-white dark:hover:bg-primary transition-all text-slate-700 dark:text-slate-300 font-bold py-1.5 px-4 rounded-lg text-xs">
                                            Ver Expediente
                                        </button>
</td>
</tr>
</tbody>
</table>
<!-- Pagination -->
<div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 flex items-center justify-between border-t border-slate-200 dark:border-slate-800">
<span class="text-sm text-slate-500">Mostrando 1 a 5 de 24 registros</span>
<div class="flex gap-2">
<button class="p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="px-3 py-1 rounded-lg bg-primary text-white font-bold text-sm">1</button>
<button class="px-3 py-1 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 hover:bg-slate-50 text-sm">2</button>
<button class="px-3 py-1 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 hover:bg-slate-50 text-sm">3</button>
<button class="p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-500 hover:bg-slate-50">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Statistics Summary -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
<div class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-3xl">hourglass_empty</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase">Pendientes Revisión</p>
<h4 class="text-2xl font-black text-slate-900 dark:text-slate-100">14</h4>
</div>
</div>
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
<div class="size-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
<span class="material-symbols-outlined text-3xl">pending_actions</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase">Doc. Incompleta</p>
<h4 class="text-2xl font-black text-slate-900 dark:text-slate-100">10</h4>
</div>
</div>
<div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center gap-4">
<div class="size-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
<span class="material-symbols-outlined text-3xl">check_circle</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase">Aprobados Hoy</p>
<h4 class="text-2xl font-black text-slate-900 dark:text-slate-100">8</h4>
</div>
</div>
</div>
</main>
</div>
</div>
</div>
</body></html>