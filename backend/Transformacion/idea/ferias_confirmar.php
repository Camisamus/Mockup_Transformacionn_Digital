<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Confirmación de Reserva - Municipio de Cuidados</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "success": "#10b981",
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
        .stall-grid {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#111418] dark:text-white font-display">
<div class="relative flex min-h-screen flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3">
<div class="flex items-center justify-center bg-primary/10 p-2 rounded-lg">
<span class="material-symbols-outlined text-primary text-2xl">location_city</span>
</div>
<div class="flex flex-col">
<h2 class="text-sm font-bold leading-tight uppercase tracking-wider text-primary">Municipio de Cuidados</h2>
<p class="text-[10px] font-medium text-[#617589]">Viña del Mar</p>
</div>
</div>
</div>
<div class="flex items-center gap-4">
<div class="flex flex-col items-end">
<p class="text-xs font-semibold text-[#617589]">Créditos Disponibles</p>
<p class="text-sm font-bold text-primary">7 Créditos</p>
</div>
<div class="h-10 w-px bg-[#dbe0e6] dark:bg-slate-700 mx-2"></div>
<button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
<span class="text-sm font-medium">Mi Cuenta</span>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8 border border-slate-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCKV_w90SJ6DnuOvmVxYTfRXxpxFsRIzZ2Ckea8yTfgQC7TF4WJu4zpIXRkBTwcBHVfFts4pmUGwZJGpFHCNK30rktZbDdfeMV6xWOgpudb5yjCXr7fOYB9uTvK815Hx738eRbUjUc1rtPlUcBtbV1RjcDs1gAch7x4c7fuBFLPZ7On6qtMxsWFfeBRwxUtxNys1vrJiDZzwmOcqR0AMmficJxVV_CrWvR8YYd166akAFrwW3kNDCAJ1Q37llxNS1gsC5wWlA9tBOS3");'></div>
</button>
</div>
</header>
<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[1100px] flex-1 px-6">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden mb-8">
<div class="bg-success/10 p-8 flex flex-col items-center text-center border-b border-success/20">
<div class="size-16 bg-success rounded-full flex items-center justify-center mb-4 shadow-lg shadow-success/20">
<span class="material-symbols-outlined text-white text-4xl">check_circle</span>
</div>
<h1 class="text-2xl md:text-3xl font-black text-[#111418] dark:text-white mb-2">¡Reserva Confirmada Exitosamente!</h1>
<p class="text-[#617589] max-w-lg">Tu espacio ha sido asignado correctamente. Ya puedes revisar los detalles de tu ubicación en el plano de la feria.</p>
</div>
<div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="flex items-center gap-4 p-4 bg-background-light dark:bg-slate-900/50 rounded-xl">
<div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary">account_balance</span>
</div>
<div>
<p class="text-xs font-bold text-[#617589] uppercase">Plaza / Feria</p>
<p class="text-base font-bold">Plaza Mayor - Zona A</p>
</div>
</div>
<div class="flex items-center gap-4 p-4 bg-background-light dark:bg-slate-900/50 rounded-xl">
<div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-primary">calendar_month</span>
</div>
<div>
<p class="text-xs font-bold text-[#617589] uppercase">Fecha Asignada</p>
<p class="text-base font-bold">Miércoles, 25 Oct 2023</p>
</div>
</div>
<div class="flex items-center gap-4 p-4 bg-primary/10 border border-primary/20 rounded-xl">
<div class="size-12 rounded-lg bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white">store</span>
</div>
<div>
<p class="text-xs font-bold text-primary uppercase">Puesto Asignado</p>
<p class="text-xl font-black text-primary">Módulo #42</p>
</div>
</div>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
<div class="lg:col-span-3">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6">
<div class="flex items-center justify-between mb-6">
<h3 class="text-lg font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-primary">map</span>
                                Layout de la Feria: Plaza Mayor
                            </h3>
<div class="flex gap-4 items-center">
<div class="flex items-center gap-2">
<div class="size-3 bg-primary rounded-sm shadow-sm"></div>
<span class="text-xs font-medium">Tu Puesto</span>
</div>
<div class="flex items-center gap-2">
<div class="size-3 bg-slate-200 dark:bg-slate-600 rounded-sm"></div>
<span class="text-xs font-medium">Ocupado</span>
</div>
<div class="flex items-center gap-2">
<div class="size-3 bg-white border border-slate-300 rounded-sm"></div>
<span class="text-xs font-medium">Disponible</span>
</div>
</div>
</div>
<div class="bg-slate-100 dark:bg-slate-900 p-8 rounded-xl border border-slate-200 dark:border-slate-700">
<div class="flex justify-center mb-8">
<div class="px-10 py-3 bg-slate-300 dark:bg-slate-700 rounded-t-3xl border-x border-t border-slate-400 dark:border-slate-600 text-xs font-black uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400">
                                    Acceso Principal - Av. Libertad
                                </div>
</div>
<div class="stall-grid">
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">1</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">2</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">3</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">4</div>
<div class="col-span-2"></div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">5</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">6</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">7</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">8</div>
<div class="col-span-10 h-8"></div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">30</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">31</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">32</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">33</div>
<div class="col-span-2 flex items-center justify-center">
<div class="w-full h-1 bg-slate-300 dark:bg-slate-700 rounded-full"></div>
</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">34</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">35</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">36</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">37</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">38</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">39</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">40</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">41</div>
<div class="col-span-2"></div>
<div class="h-12 flex flex-col items-center justify-center rounded-md bg-primary text-white shadow-lg shadow-primary/40 ring-4 ring-primary/20 scale-110 z-10 transition-transform">
<span class="text-[10px] font-black">42</span>
<span class="material-symbols-outlined text-xs">person_pin</span>
</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">43</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">44</div>
<div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">45</div>
</div>
<div class="mt-8 flex justify-between items-center px-4">
<div class="flex items-center gap-2 text-slate-400">
<span class="material-symbols-outlined">water_drop</span>
<span class="text-[10px] font-bold uppercase">Punto de Agua</span>
</div>
<div class="flex items-center gap-2 text-slate-400">
<span class="material-symbols-outlined">bolt</span>
<span class="text-[10px] font-bold uppercase">Conexión Eléctrica</span>
</div>
<div class="flex items-center gap-2 text-slate-400">
<span class="material-symbols-outlined">wc</span>
<span class="text-[10px] font-bold uppercase">Servicios</span>
</div>
</div>
</div>
</div>
</div>
<div class="lg:col-span-1">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 flex flex-col gap-4 sticky top-24">
<h3 class="font-bold text-base mb-2">Acciones Disponibles</h3>
<button class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-xl transition-all shadow-lg shadow-primary/20">
<span class="material-symbols-outlined text-xl">picture_as_pdf</span>
                            Descargar Comprobante PDF
                        </button>
<button class="w-full flex items-center justify-center gap-2 bg-white dark:bg-slate-700 border border-[#dbe0e6] dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-600 text-[#111418] dark:text-white font-bold py-3 px-4 rounded-xl transition-all">
<span class="material-symbols-outlined text-xl">home</span>
                            Volver al Panel Principal
                        </button>
<div class="mt-4 p-4 bg-slate-50 dark:bg-slate-900/40 rounded-xl border border-dashed border-slate-200 dark:border-slate-700">
<p class="text-xs font-bold text-[#617589] uppercase mb-2 flex items-center gap-1">
<span class="material-symbols-outlined text-sm">info</span>
                                Recordatorios
                            </p>
<ul class="text-[11px] space-y-2 text-[#617589] leading-tight">
<li class="flex gap-2"><span class="text-primary">•</span> Presenta tu comprobante digital al llegar.</li>
<li class="flex gap-2"><span class="text-primary">•</span> Horario de montaje: 07:00 AM - 08:30 AM.</li>
<li class="flex gap-2"><span class="text-primary">•</span> Mantener el espacio limpio es obligatorio.</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</main>
<footer class="mt-12 border-t border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark py-8">
<div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[#617589] text-sm">
<div class="flex items-center gap-4">
<div class="flex flex-col">
<p class="font-bold text-[#111418] dark:text-white">Municipio de Cuidados</p>
<p>© 2023 Sistema de Gestión de Espacios Públicos - Viña del Mar.</p>
</div>
</div>
<div class="flex gap-6">
<a class="hover:text-primary transition-colors" href="#">Reglamento de Ferias</a>
<a class="hover:text-primary transition-colors" href="#">Soporte Técnico</a>
<a class="hover:text-primary transition-colors" href="#">Contacto Municipal</a>
</div>
</div>
</footer>
</div>

</body></html>