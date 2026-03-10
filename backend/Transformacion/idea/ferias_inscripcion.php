<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Registro de Emprendedor - Portal Municipal</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#111418] dark:text-white transition-colors duration-200">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
<header class="flex items-center justify-between border-b border-solid border-[#e5e7eb] dark:border-[#2d3748] bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-4">
<div class="text-primary size-8">
<svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path clip-rule="evenodd" d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z" fill="currentColor" fill-rule="evenodd"></path>
<path clip-rule="evenodd" d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z" fill="currentColor" fill-rule="evenodd"></path>
</svg>
</div>
<h2 class="text-lg font-bold leading-tight tracking-tight">Portal Municipal del Emprendedor</h2>
</div>
<div class="flex gap-4">
<button class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 transition-colors">
<span class="material-symbols-outlined text-xl">notifications</span>
</button>
<div class="flex items-center gap-3 pl-4 border-l border-gray-200 dark:border-gray-700">
<div class="text-right hidden sm:block">
<p class="text-xs font-bold">Sesión de Invitado</p>
<p class="text-[10px] text-gray-500">Registro en curso</p>
</div>
<button class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white overflow-hidden">
<span class="material-symbols-outlined text-2xl">account_circle</span>
</button>
</div>
</div>
</header>
<main class="flex-1 max-w-[1024px] mx-auto w-full py-10 px-6">
<div class="mb-10">
<div class="flex justify-between items-end mb-6 px-2">
<div>
<h1 class="text-3xl font-bold tracking-tight">Registro de Emprendedor</h1>
<p class="text-gray-500 dark:text-gray-400 mt-1">Siga los pasos para formalizar su actividad en la comuna.</p>
</div>
<div class="text-right">
<span class="text-sm font-semibold text-primary">Paso 1 de 3</span>
<p class="text-xs text-gray-400 font-medium">Siguiente: Validación de RUT</p>
</div>
</div>
<div class="relative mb-8">
<div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 dark:bg-gray-800 -translate-y-1/2 rounded-full overflow-hidden">
<div class="bg-primary h-full transition-all duration-500" style="width: 33.33%;"></div>
</div>
<div class="relative flex justify-between">
<div class="flex flex-col items-center">
<div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark">1</div>
<span class="text-[10px] font-bold mt-2 uppercase text-primary">Categoría</span>
</div>
<div class="flex flex-col items-center">
<div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark">2</div>
<span class="text-[10px] font-bold mt-2 uppercase text-gray-400">Validación</span>
</div>
<div class="flex flex-col items-center">
<div class="w-8 h-8 bg-gray-200 dark:bg-gray-800 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold ring-4 ring-white dark:ring-background-dark">3</div>
<span class="text-[10px] font-bold mt-2 uppercase text-gray-400">Documentos</span>
</div>
</div>
</div>
</div>
<div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
<div class="p-8" id="step-1">
<div class="mb-8">
<div class="flex items-center gap-2 mb-2">
<h2 class="text-2xl font-bold">1. Categoría de Negocio</h2>
<span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
</div>
<p class="text-gray-500 dark:text-gray-400">Seleccione el área principal de su actividad comercial. Esto determinará los documentos requeridos posteriormente.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<div class="group cursor-pointer border-2 border-primary bg-primary/5 rounded-xl p-6 transition-all hover:shadow-md relative overflow-hidden">
<div class="absolute top-3 right-3 text-primary">
<span class="material-symbols-outlined">check_circle</span>
</div>
<div class="w-12 h-12 bg-primary text-white rounded-lg flex items-center justify-center mb-4">
<span class="material-symbols-outlined text-2xl">restaurant</span>
</div>
<h3 class="font-bold text-lg mb-1">Alimentos</h3>
<p class="text-sm text-gray-600 dark:text-gray-400">Comida preparada, snacks, productos orgánicos y bebidas.</p>
</div>
<div class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5">
<div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined text-2xl">brush</span>
</div>
<h3 class="font-bold text-lg mb-1">Artesanía</h3>
<p class="text-sm text-gray-600 dark:text-gray-400">Trabajos manuales, cerámica, joyería y orfebrería.</p>
</div>
<div class="group cursor-pointer border-2 border-transparent bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 transition-all hover:border-primary/50 hover:bg-primary/5">
<div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined text-2xl">checkroom</span>
</div>
<h3 class="font-bold text-lg mb-1">Textil &amp; Moda</h3>
<p class="text-sm text-gray-600 dark:text-gray-400">Ropa, accesorios, tejidos y diseño textil personalizado.</p>
</div>
</div>
</div>
<div class="p-8 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/30" id="step-2">
<div class="max-w-xl mx-auto py-6">
<div class="flex items-center gap-2 mb-4">
<h2 class="text-xl font-bold">2. Validación de RUT</h2>
<span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
</div>
<p class="text-sm text-gray-500 mb-6">Ingrese su RUT para verificar su identidad y sincronizar antecedentes comerciales de forma automática.</p>
<div class="flex flex-col gap-4">
<div class="relative">
<label class="block text-xs font-bold text-gray-400 mb-1 uppercase">RUT del Emprendedor</label>
<input class="w-full pl-12 pr-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all font-medium" placeholder="12.345.678-9" type="text"/>
<span class="material-symbols-outlined absolute left-4 top-[38px] text-gray-400">fingerprint</span>
</div>
<div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded-lg border border-green-100 dark:border-green-900/30">
<span class="material-symbols-outlined text-2xl">verified</span>
<div>
<p class="text-sm font-bold">Identidad Validada</p>
<p class="text-xs opacity-80">Verificado exitosamente con el Registro Civil.</p>
</div>
</div>
</div>
</div>
</div>
<div class="p-8 border-t border-gray-100 dark:border-gray-800" id="step-3">
<div class="flex items-center justify-between mb-6">
<div>
<div class="flex items-center gap-2 mb-1">
<h2 class="text-xl font-bold">3. Carga de Documentos</h2>
<span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">Obligatorio</span>
</div>
<p class="text-sm text-gray-500">Documentación requerida para la categoría <span class="text-primary font-semibold">Alimentos</span>.</p>
</div>
<div class="bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1.5 border border-amber-200 dark:border-amber-800">
<span class="material-symbols-outlined text-base">pending_actions</span>
                        VALIDACIÓN PENDIENTE
                    </div>
</div>
<div class="space-y-4">
<div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900">
<div class="flex items-center gap-4">
<div class="bg-green-100 dark:bg-green-900/30 text-green-600 p-2 rounded-lg">
<span class="material-symbols-outlined">description</span>
</div>
<div>
<h4 class="font-semibold text-sm">Cédula de Identidad (Ambos Lados)</h4>
<p class="text-xs text-gray-400">cedula_identidad_final.pdf • 1.2MB</p>
</div>
</div>
<div class="flex items-center gap-3">
<span class="text-[10px] font-bold text-green-600 bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded border border-green-100 dark:border-green-900/30">VALIDADO</span>
<button class="text-gray-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined text-xl">visibility</span>
</button>
</div>
</div>
<div class="flex items-center justify-between p-4 border-2 border-dashed border-primary/30 rounded-xl bg-primary/5">
<div class="flex items-center gap-4">
<div class="bg-primary/20 text-primary p-2 rounded-lg">
<span class="material-symbols-outlined">health_and_safety</span>
</div>
<div>
<h4 class="font-semibold text-sm">Resolución Sanitaria (Seremi)</h4>
<p class="text-xs text-gray-500">Obligatorio para emprendimientos de alimentos</p>
</div>
</div>
<div class="flex items-center gap-3">
<span class="text-[10px] font-bold text-amber-600 bg-amber-50 dark:bg-amber-900/20 px-2 py-1 rounded border border-amber-100 dark:border-amber-900/30">REQUERIDO</span>
<button class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1 hover:bg-primary/90 transition-all shadow-sm">
<span class="material-symbols-outlined text-sm">upload</span>
                                SUBIR ARCHIVO
                            </button>
</div>
</div>
<div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800/30 opacity-80">
<div class="flex items-center gap-4">
<div class="bg-gray-200 dark:bg-gray-700 text-gray-500 p-2 rounded-lg">
<span class="material-symbols-outlined">receipt_long</span>
</div>
<div>
<h4 class="font-semibold text-sm">Iniciación de Actividades (SII)</h4>
<p class="text-xs text-gray-400">Verificando en servicios de impuestos...</p>
</div>
</div>
<div class="flex items-center gap-2">
<div class="w-4 h-4 border-2 border-gray-300 border-t-primary rounded-full animate-spin"></div>
<span class="text-[10px] font-bold text-gray-500 uppercase">Verificando</span>
</div>
</div>
</div>
</div>
<div class="p-6 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
<button class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
<span class="material-symbols-outlined">save</span>
                    GUARDAR Y SALIR
                </button>
<div class="flex gap-4">
<button class="px-6 py-2.5 rounded-lg text-sm font-bold border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-sm">arrow_back</span>
                        ANTERIOR
                    </button>
<button class="px-8 py-2.5 rounded-lg text-sm font-bold bg-primary text-white hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                        SIGUIENTE
                        <span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</div>
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
<div class="flex items-start gap-3">
<div class="bg-primary/10 text-primary p-2 rounded-lg">
<span class="material-symbols-outlined text-lg">security</span>
</div>
<div>
<h5 class="text-xs font-bold uppercase tracking-wider text-gray-400">Proceso Seguro</h5>
<p class="text-xs text-gray-600 dark:text-gray-400">Sus datos están protegidos según la Ley 19.628 de Protección de Datos Personales.</p>
</div>
</div>
<div class="flex items-start gap-3">
<div class="bg-primary/10 text-primary p-2 rounded-lg">
<span class="material-symbols-outlined text-lg">support_agent</span>
</div>
<div>
<h5 class="text-xs font-bold uppercase tracking-wider text-gray-400">¿Necesita Ayuda?</h5>
<p class="text-xs text-gray-600 dark:text-gray-400">Contacte al Departamento de Emprendimiento: soporte@municipalidad.cl</p>
</div>
</div>
<div class="flex items-start gap-3">
<div class="bg-primary/10 text-primary p-2 rounded-lg">
<span class="material-symbols-outlined text-lg">history</span>
</div>
<div>
<h5 class="text-xs font-bold uppercase tracking-wider text-gray-400">Auto-Guardado</h5>
<p class="text-xs text-gray-600 dark:text-gray-400">Su progreso se guarda automáticamente. Puede continuar más tarde.</p>
</div>
</div>
</div>
</main>
<footer class="py-10 text-center border-t border-gray-100 dark:border-gray-800 mt-10">
<p class="text-sm text-gray-400">© 2024 Sistema de Gestión Municipal • Módulo de Registro Externo</p>
</footer>
</div>

</body></html>