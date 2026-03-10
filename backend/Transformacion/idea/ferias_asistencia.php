<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Registro Diario de Asistencia - Municipio de Cuidados</title>
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
                        "warning": "#f59e0b",
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
<style type="text/tailwindcss">
        body {
            font-family: 'Public Sans', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .step-active {
            @apply border-primary bg-primary/5 text-primary;
        }
        .status-dot {
            @apply w-2.5 h-2.5 rounded-full inline-block mr-2;
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
<p class="text-xs font-semibold text-[#617589]">Perfil Emprendedor</p>
<p class="text-sm font-bold text-primary">ID: 24.551-K</p>
</div>
<div class="h-10 w-px bg-[#dbe0e6] dark:bg-slate-700 mx-2"></div>
<button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
<span class="text-sm font-medium">Mi Cuenta</span>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8 border border-slate-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAoE5vJuZ39E1hg22mqDH8F_KtJirG6Tl0uOKQfK2XJPWR39Ri1kFCyygUkSenMZUu5Z21E5BGoYYtUlqTuSx03vDxQA5CThEo_viI0R1KbM50LUrGZ3U9seku1711k0P3yA_L_7nzzqKRFOVET_2cV6lehpmiZyio4LmJI26Yjb_yPbdjy36UhgaWQVVwoa_Q5Bszc80Ajoauf-CQ3lZ0H8xR8t93I2xADX93H-coz2H6Spc3DltzRFcEOUHDWXPy8NIW3L41by8gL");'></div>
</button>
</div>
</header>
<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[1000px] flex-1 px-6">
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<h1 class="text-3xl font-black text-[#111418] dark:text-white">Registro Diario de Asistencia</h1>
<p class="text-[#617589]">Feria de Emprendimiento - Plaza de Viña</p>
</div>
<div class="bg-white dark:bg-slate-800 p-1.5 rounded-xl border border-[#dbe0e6] dark:border-slate-700 flex gap-1 shadow-sm">
<button class="px-4 py-2 rounded-lg text-sm font-bold bg-primary text-white">Día 1</button>
<button class="px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-700 text-[#617589]">Día 2</button>
<button class="px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-700 text-[#617589]">Día 3</button>
<button class="px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-100 dark:hover:bg-slate-700 text-[#617589]">Día 4</button>
</div>
</div>
<div class="grid md:grid-cols-2 gap-8">
<section class="flex flex-col gap-4">
<div class="bg-white dark:bg-slate-800 rounded-2xl border-l-4 border-l-success border-y border-r border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 flex justify-between items-center">
<div>
<h3 class="text-lg font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-success">login</span>
                                    Registro de Entrada
                                </h3>
<p class="text-xs text-[#617589]">Apertura de puesto y montaje</p>
</div>
<span class="px-3 py-1 bg-success/10 text-success text-[10px] font-bold rounded-full uppercase tracking-wider">Completado</span>
</div>
<div class="p-6 space-y-6">
<div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl">
<div class="flex flex-col">
<span class="text-[10px] uppercase font-bold text-[#617589]">Hora de Registro</span>
<span class="text-2xl font-black text-primary">08:45 AM</span>
</div>
<span class="material-symbols-outlined text-success text-3xl">check_circle</span>
</div>
<div class="space-y-3">
<label class="text-sm font-bold block">Fotografía del Puesto Montado</label>
<div class="aspect-video relative rounded-xl overflow-hidden border-2 border-dashed border-slate-200 dark:border-slate-700 group">
<img alt="Puesto montado" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIIrC9P_BFvEHO12a220T67QdCMoyNVe3Wr1pf8wRt4B--kd44OcDVpwTRmsOxe8gLB2iUR1nVyL0yA3i-cjZdBByQ5ndXRk4bIua5j1cl_Q3d-kmGTeKgI8hQLRC7q-yd5hVTf-h-8oJFlIPNlyPn8e7mL8TkJ5q00MfFG8bnkstoUN87BwUlNiJNU6aIKgFhRGqDvJzxz1pTRSYsF09VXtYwSF5bP6E0LrH0HCfQPs5VC5u262GWEkXtaZlSrYz_kAHSuuquZ7Ke"/>
<div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
<button class="bg-white text-black px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-base">visibility</span> Ver foto
                                        </button>
</div>
</div>
</div>
<button class="w-full py-3 bg-slate-100 dark:bg-slate-700 text-slate-400 font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2" disabled="">
<span class="material-symbols-outlined">verified</span>
                                Entrada Registrada
                            </button>
</div>
</div>
</section>
<section class="flex flex-col gap-4">
<div class="bg-white dark:bg-slate-800 rounded-2xl border-l-4 border-l-warning border-y border-r border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 flex justify-between items-center">
<div>
<h3 class="text-lg font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-warning">logout</span>
                                    Registro de Salida
                                </h3>
<p class="text-xs text-[#617589]">Cierre y retiro de productos</p>
</div>
<span class="px-3 py-1 bg-warning/10 text-warning text-[10px] font-bold rounded-full uppercase tracking-wider">Pendiente</span>
</div>
<div class="p-6 space-y-6">
<div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl">
<div class="flex flex-col">
<span class="text-[10px] uppercase font-bold text-[#617589]">Hora Actual</span>
<span class="text-2xl font-black">18:12 PM</span>
</div>
<span class="material-symbols-outlined text-slate-300 text-3xl">schedule</span>
</div>
<div class="space-y-3">
<label class="text-sm font-bold block flex items-center justify-between">
                                    Fotografía de Respaldo Obligatoria
                                    <span class="text-[10px] text-red-500 font-normal">* Requerido</span>
</label>
<div class="aspect-video relative rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 flex flex-col items-center justify-center bg-slate-50 dark:bg-slate-900/30 hover:bg-slate-100 transition-colors cursor-pointer group">
<span class="material-symbols-outlined text-slate-400 text-4xl mb-2 group-hover:scale-110 transition-transform">add_a_photo</span>
<span class="text-xs font-medium text-[#617589]">Haz clic para capturar o subir foto</span>
<span class="text-[10px] text-[#617589] mt-1">Debe mostrar el puesto desarmado y limpio</span>
</div>
</div>
<button class="w-full py-3 bg-primary hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
<span class="material-symbols-outlined">send</span>
                                Registrar Salida
                            </button>
</div>
</div>
</section>
</div>
<div class="mt-8 p-4 bg-white dark:bg-slate-800 rounded-xl border border-[#dbe0e6] dark:border-slate-700 flex items-center justify-between">
<div class="flex items-center gap-6">
<div class="flex items-center">
<span class="status-dot bg-success"></span>
<span class="text-sm font-medium">Entrada: OK</span>
</div>
<div class="flex items-center">
<span class="status-dot bg-warning"></span>
<span class="text-sm font-medium">Salida: Esperando</span>
</div>
<div class="flex items-center">
<span class="status-dot bg-slate-300"></span>
<span class="text-sm font-medium">Verificación Municipal: Pendiente</span>
</div>
</div>
<p class="text-xs text-[#617589] italic">ID Registro: #F-20231024-882</p>
</div>
</div>
</main>
<footer class="mt-auto border-t border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark py-8">
<div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[#617589] text-sm">
<div class="flex items-center gap-4">
<div class="flex flex-col">
<p class="font-bold text-[#111418] dark:text-white">Municipio de Cuidados</p>
<p>© 2023 Sistema de Gestión de Espacios Públicos - Viña del Mar.</p>
</div>
</div>
<div class="flex gap-6">
<a class="hover:text-primary transition-colors" href="#">Reglamento de Asistencia</a>
<a class="hover:text-primary transition-colors" href="#">Ayuda</a>
<a class="hover:text-primary transition-colors" href="#">Soporte</a>
</div>
</div>
</footer>
</div>

</body></html>