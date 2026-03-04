<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
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
                        "display": ["Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
<!-- TopNavBar -->
<header class="border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 sticky top-0 z-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between h-16 items-center">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3">
<div class="text-primary">
<span class="material-symbols-outlined text-4xl">location_city</span>
</div>
<h1 class="text-xl font-bold tracking-tight">Municipio de Cuidados</h1>
</div>
<nav class="hidden md:flex items-center gap-6">
<a class="text-sm font-medium hover:text-primary transition-colors" href="#">Dashboard</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#">Ferias</a>
<a class="text-sm font-medium text-primary border-b-2 border-primary py-5" href="#">Postulaciones</a>
<a class="text-sm font-medium hover:text-primary transition-colors" href="#">Reportes</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="relative hidden sm:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
<input class="pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm w-64 focus:ring-2 focus:ring-primary" placeholder="Buscar convocatoria..." type="text"/>
</div>
<div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden border-2 border-primary/20">
<img alt="Avatar Usuario" data-alt="Portrait of a professional male city official" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAPJfGwbyWUiklmxNN64w-q_mmRqlnEk0fEzGO02jA-rWh_7jAAPDasUA71nn9L1YzSlylAUlMjQzp6s_mg1w2E_EDyHUnhi6WT7vd7xUPnBzlRP7HQt6MwlLhGgiRCUnLVy3aqz56bozy3PHqdW7K7XY98wIfsqkG4NOH6mlasWvZ5VDB0244U_DUosMLqrhNnKl8VYwkPCtRn9J7-aJyiMg2_YFC0qHKXSN0UY1_Lkq2TAjNDyjXrMSg-tvzwgVK7kYtChad3R0T"/>
</div>
</div>
</div>
</div>
</header>
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
<!-- Breadcrumb & Header -->
<div class="mb-8">
<nav class="flex items-center gap-2 text-sm text-slate-500 mb-4">
<a class="hover:text-primary" href="#">Gestión de Ferias</a>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="font-medium text-slate-900 dark:text-slate-100">Planificación de Postulaciones</span>
</nav>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-slate-100">Mantenedor de Próximas Postulaciones</h2>
<p class="text-slate-600 dark:text-slate-400 mt-1">Configure los parámetros para las nuevas convocatorias en espacios públicos de Viña del Mar.</p>
</div>
<div class="flex gap-3">
<button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
<span class="material-symbols-outlined text-lg">history</span>
                        Historial
                    </button>
<button class="flex items-center gap-2 px-6 py-2 rounded-lg bg-primary text-white font-bold text-sm hover:bg-blue-600 transition-colors shadow-lg shadow-primary/20">
<span class="material-symbols-outlined text-lg">publish</span>
                        Publicar Convocatoria
                    </button>
</div>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Configuration Column -->
<div class="lg:col-span-1 space-y-6">
<!-- Ubicación Section -->
<section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-primary">pin_drop</span>
<h3 class="font-bold text-lg">1. Ubicación y Espacio</h3>
</div>
<div class="space-y-4">
<div>
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Espacio Público</label>
<select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 focus:ring-primary focus:border-primary">
<option>Seleccionar espacio...</option>
<option>Plaza Vergara</option>
<option>Plaza México</option>
<option>Muelle Vergara</option>
<option>Parque Quinta Vergara</option>
</select>
</div>
<div class="rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 h-40 relative">
<img class="w-full h-full object-cover" data-alt="Satellite view of a central plaza area in Viña del Mar" data-location="Viña del Mar, Chile" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3U4DTxKb9XOhvTbA6piTFB5pKDaVUclcJnAailFUWpBVp1UwF0JQhZaedN1Pw5qWe9drCCNrYuETgMEjgstgHq10qIkTs2tunr6NQZlPrrx_fAM9XbQoYdyazd9WUhct40NTtBRO98aJyLDnNnPXqyqLQvc6HO32g_Q_vyt8c8gTtPBIjMEwJJ2dQsvPCE67G6xyq6WMOHl1dxbla7Yy-6P0zfKv3N0YRywZAh2Ucepktzb7Rvt_q3aHF0FdoHl8SemG7vnDkNdl-"/>
<div class="absolute inset-0 bg-primary/10 pointer-events-none"></div>
</div>
</div>
</section>
<!-- Periodo Section -->
<section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-primary">calendar_month</span>
<h3 class="font-bold text-lg">2. Periodo de Ejecución</h3>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="col-span-2">
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Mes de Planificación</label>
<input class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 focus:ring-primary focus:border-primary" type="month" value="2024-11"/>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Semana Inicio</label>
<select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 focus:ring-primary focus:border-primary">
<option>Semana 1</option>
<option>Semana 2</option>
<option>Semana 3</option>
<option>Semana 4</option>
</select>
</div>
<div>
<label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Semanas Duración</label>
<input class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 focus:ring-primary focus:border-primary" max="4" min="1" type="number" value="1"/>
</div>
</div>
</section>
<!-- Cupos Section -->
<section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-primary">group</span>
<h3 class="font-bold text-lg">3. Cupos por Rubro</h3>
</div>
<div class="space-y-3">
<div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800">
<span class="text-sm font-medium">Artesanías</span>
<input class="w-16 rounded border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-center text-sm py-1" type="number" value="12"/>
</div>
<div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800">
<span class="text-sm font-medium">Textil y Calzado</span>
<input class="w-16 rounded border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-center text-sm py-1" type="number" value="8"/>
</div>
<div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 dark:bg-slate-800">
<span class="text-sm font-medium">Alimentos Envasados</span>
<input class="w-16 rounded border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-center text-sm py-1" type="number" value="5"/>
</div>
<div class="pt-2 border-t border-slate-200 dark:border-slate-700 flex justify-between font-bold">
<span>Total Cupos</span>
<span class="text-primary">25</span>
</div>
</div>
</section>
</div>
<!-- Visual Planning Column -->
<div class="lg:col-span-2 space-y-6">
<!-- Timeline/Calendar View -->
<section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex items-center justify-between mb-6">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">view_timeline</span>
<h3 class="font-bold text-lg">Visualización de Programación</h3>
</div>
<div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-lg">
<button class="px-3 py-1 text-xs font-bold bg-white dark:bg-slate-700 shadow-sm rounded">Mensual</button>
<button class="px-3 py-1 text-xs font-bold text-slate-500">Semanal</button>
</div>
</div>
<div class="grid grid-cols-7 gap-px bg-slate-200 dark:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden">
<!-- Headers -->
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider">Lun</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider">Mar</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider">Mié</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider">Jue</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider">Vie</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider text-red-500">Sáb</div>
<div class="bg-slate-50 dark:bg-slate-800 p-2 text-center text-xs font-bold uppercase tracking-wider text-red-500">Dom</div>
<!-- Days (Sample Month Nov) -->
<div class="bg-white dark:bg-slate-900 h-24 p-2 text-slate-400">28</div>
<div class="bg-white dark:bg-slate-900 h-24 p-2 text-slate-400">29</div>
<div class="bg-white dark:bg-slate-900 h-24 p-2 text-slate-400">30</div>
<div class="bg-white dark:bg-slate-900 h-24 p-2 text-slate-400">31</div>
<!-- Nov 1st -->
<div class="bg-white dark:bg-slate-900 h-24 p-2">
<span class="text-xs font-medium">1</span>
</div>
<div class="bg-white dark:bg-slate-900 h-24 p-2">
<span class="text-xs font-medium">2</span>
</div>
<div class="bg-white dark:bg-slate-900 h-24 p-2">
<span class="text-xs font-medium">3</span>
</div>
<!-- Week 2 -->
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20 relative">
<span class="text-xs font-bold text-primary">4</span>
<div class="mt-1 bg-primary text-white text-[10px] p-1 rounded font-bold">Feria Plaza Vergara</div>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary">5</span>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary">6</span>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary">7</span>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary">8</span>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary text-red-500">9</span>
</div>
<div class="bg-blue-50/50 dark:bg-primary/10 h-24 p-2 border-y-2 border-primary/20">
<span class="text-xs font-bold text-primary text-red-500">10</span>
</div>
<!-- Rest of days placeholder -->
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">11</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">12</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">13</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">14</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">15</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">16</span></div>
<div class="bg-white dark:bg-slate-900 h-24 p-2"><span class="text-xs">17</span></div>
</div>
</section>
<!-- Postulation Dates Section -->
<section class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
<div class="flex items-center gap-2 mb-6">
<span class="material-symbols-outlined text-primary">app_registration</span>
<h3 class="font-bold text-lg">4. Ventana de Postulación</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="p-4 rounded-lg bg-primary/5 border border-primary/20">
<label class="block text-sm font-bold text-primary mb-2">Fecha Apertura Postulaciones</label>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">event_upcoming</span>
<input class="flex-1 bg-transparent border-none p-0 focus:ring-0 text-slate-900 dark:text-slate-100 font-medium" type="datetime-local" value="2024-10-25T09:00"/>
</div>
</div>
<div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800/50">
<label class="block text-sm font-bold text-red-600 dark:text-red-400 mb-2">Fecha Cierre Postulaciones</label>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-red-500">event_available</span>
<input class="flex-1 bg-transparent border-none p-0 focus:ring-0 text-slate-900 dark:text-slate-100 font-medium" type="datetime-local" value="2024-10-31T23:59"/>
</div>
</div>
</div>
<div class="mt-6 flex items-start gap-3 p-4 bg-slate-100 dark:bg-slate-800 rounded-lg">
<span class="material-symbols-outlined text-slate-500 mt-0.5">info</span>
<p class="text-sm text-slate-600 dark:text-slate-400">
                            Al publicar, se notificará automáticamente a los usuarios registrados en el sistema de ferias y se habilitará el formulario de postulación en el portal público durante las fechas definidas.
                        </p>
</div>
</section>
</div>
</div>
</main>
<footer class="max-w-7xl mx-auto px-4 py-12 border-t border-slate-200 dark:border-slate-800 text-center text-slate-500 text-sm">
<p>© 2024 Municipio de Cuidados - Municipalidad de Viña del Mar</p>
</footer>

```</body></html>