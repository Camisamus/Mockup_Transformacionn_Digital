<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Historial de Participaciones - Municipio de Cuidados</title>
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
                        "background-light": "#f8fafc",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
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
        .sidebar-item-active {
            @apply bg-primary/10 text-primary border-r-4 border-primary;
        }
        .sidebar-item {
            @apply flex items-center gap-3 px-6 py-3 text-[#617589] hover:bg-slate-50 transition-colors cursor-pointer;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#111418] dark:text-white font-display">
<div class="flex min-h-screen">
<aside class="w-64 bg-white dark:bg-slate-900 border-r border-[#dbe0e6] dark:border-slate-700 flex flex-col fixed h-full z-50">
<div class="p-6">
<div class="flex items-center gap-3 mb-8">
<div class="flex items-center justify-center bg-primary/10 p-2 rounded-lg">
<span class="material-symbols-outlined text-primary text-2xl font-bold">location_city</span>
</div>
<div class="flex flex-col">
<h2 class="text-xs font-bold leading-tight uppercase tracking-wider text-primary">Municipio de Cuidados</h2>
<p class="text-[10px] font-medium text-[#617589]">Viña del Mar</p>
</div>
</div>
<nav class="flex flex-col gap-1 -mx-6">
<a href="index.php"><div class="sidebar-item">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-bold text-sm">Inicio</span>
</div></a>
<div class="sidebar-item">
<span class="material-symbols-outlined">event</span>
<span class="font-bold text-sm">Próximas Ferias</span>
</div>
<div class="sidebar-item sidebar-item-active">
<span class="material-symbols-outlined">history</span>
<span class="font-bold text-sm">Historial</span>
</div>
<div class="sidebar-item">
<span class="material-symbols-outlined">mail</span>
<span class="font-bold text-sm">Mensajería</span>
<span class="ml-auto bg-red-500 text-white text-[10px] px-1.5 rounded-full">2</span>
</div>
<div class="sidebar-item">
<span class="material-symbols-outlined">notifications</span>
<span class="font-bold text-sm">Notificaciones</span>
</div>
<div class="sidebar-item">
<span class="material-symbols-outlined">person</span>
<span class="font-bold text-sm">Mi Perfil</span>
</div>
</nav>
</div>
<div class="mt-auto p-6 border-t border-[#dbe0e6] dark:border-slate-700">
<a href="../index.php" class="flex items-center gap-3 text-red-500 hover:text-red-600 font-bold text-sm">
<span class="material-symbols-outlined">logout</span>
                Cerrar Sesión
            </a>
</div>
</aside>
<main class="flex-1 ml-64">
<header class="flex items-center justify-between bg-white dark:bg-slate-900 px-10 py-4 border-b border-[#dbe0e6] dark:border-slate-700 sticky top-0 z-40">
<div>
<h1 class="text-xl font-bold">Historial de Participaciones</h1>
<p class="text-xs text-[#617589]">Consulta tus participaciones anteriores y evaluaciones.</p>
</div>
<div class="flex items-center gap-4">
<div class="flex flex-col items-end">
<p class="text-xs font-semibold text-[#617589]">ID Emprendedor</p>
<p class="text-sm font-bold text-primary">24.551-K</p>
</div>
<div class="h-10 w-px bg-[#dbe0e6] dark:bg-slate-700"></div>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-primary/20" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAoE5vJuZ39E1hg22mqDH8F_KtJirG6Tl0uOKQfK2XJPWR39Ri1kFCyygUkSenMZUu5Z21E5BGoYYtUlqTuSx03vDxQA5CThEo_viI0R1KbM50LUrGZ3U9seku1711k0P3yA_L_7nzzqKRFOVET_2cV6lehpmiZyio4LmJI26Yjb_yPbdjy36UhgaWQVVwoa_Q5Bszc80Ajoauf-CQ3lZ0H8xR8t93I2xADX93H-coz2H6Spc3DltzRFcEOUHDWXPy8NIW3L41by8gL");'></div>
</div>
</header>
<div class="p-10 max-w-6xl mx-auto">
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h2 class="text-2xl font-black text-[#111418] dark:text-white">Registro Histórico</h2>
<p class="text-[#617589]">Listado de ferias finalizadas en las que has participado.</p>
</div>
<div class="flex gap-2">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#617589] text-sm">search</span>
<input class="pl-9 pr-4 py-2 border border-[#dbe0e6] rounded-lg text-sm focus:ring-primary focus:border-primary bg-white dark:bg-slate-800 dark:border-slate-700" placeholder="Buscar feria..." type="text"/>
</div>
</div>
</div>
<div class="space-y-4">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
<div class="p-6 flex flex-col md:flex-row items-center gap-6">
<div class="h-24 w-24 rounded-xl overflow-hidden flex-shrink-0">
<img alt="Feria" class="w-full h-full object-cover grayscale opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK"/>
</div>
<div class="flex-1 space-y-2 text-center md:text-left">
<div class="flex items-center justify-center md:justify-start gap-2">
<h3 class="font-bold text-lg">Feria Primavera Plaza O'Higgins</h3>
<span class="bg-slate-100 dark:bg-slate-700 text-[#617589] text-[10px] font-bold px-2 py-0.5 rounded uppercase">Finalizada</span>
</div>
<div class="flex flex-wrap justify-center md:justify-start gap-y-2 gap-x-6 text-sm text-[#617589]">
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">location_on</span>
<span>Plaza O'Higgins, Viña del Mar</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">calendar_month</span>
<span>10 - 13 de Octubre, 2023</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm text-success">how_to_reg</span>
<span class="font-medium text-success">Asistencia: 100% (4/4 días)</span>
</div>
</div>
</div>
<div class="w-full md:w-auto">
<button class="w-full md:w-auto px-6 py-2.5 bg-primary hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20 text-sm flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-lg">rate_review</span>
                                Evaluar Participación
                            </button>
</div>
</div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden opacity-90">
<div class="p-6 flex flex-col md:flex-row items-center gap-6">
<div class="h-24 w-24 rounded-xl overflow-hidden flex-shrink-0">
<img alt="Feria" class="w-full h-full object-cover grayscale opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK"/>
</div>
<div class="flex-1 space-y-2 text-center md:text-left">
<div class="flex items-center justify-center md:justify-start gap-2">
<h3 class="font-bold text-lg">Feria Artesanal Potrerillos</h3>
<span class="bg-slate-100 dark:bg-slate-700 text-[#617589] text-[10px] font-bold px-2 py-0.5 rounded uppercase">Finalizada</span>
</div>
<div class="flex flex-wrap justify-center md:justify-start gap-y-2 gap-x-6 text-sm text-[#617589]">
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">location_on</span>
<span>Parque Quinta Vergara</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">calendar_month</span>
<span>15 - 18 de Septiembre, 2023</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm text-success">how_to_reg</span>
<span class="font-medium text-success">Asistencia: 100% (4/4 días)</span>
</div>
</div>
</div>
<div class="w-full md:w-auto flex flex-col items-center gap-2">
<div class="flex items-center gap-1.5 text-success bg-success/10 px-4 py-2 rounded-xl font-bold text-sm">
<span class="material-symbols-outlined text-lg">check_circle</span>
                                Ya Evaluado
                            </div>
<span class="text-[10px] text-[#617589] font-medium italic">Rúbrica completada</span>
</div>
</div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden opacity-90">
<div class="p-6 flex flex-col md:flex-row items-center gap-6">
<div class="h-24 w-24 rounded-xl overflow-hidden flex-shrink-0">
<img alt="Feria" class="w-full h-full object-cover grayscale opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK"/>
</div>
<div class="flex-1 space-y-2 text-center md:text-left">
<div class="flex items-center justify-center md:justify-start gap-2">
<h3 class="font-bold text-lg">Expo Emprendedor Invierno</h3>
<span class="bg-slate-100 dark:bg-slate-700 text-[#617589] text-[10px] font-bold px-2 py-0.5 rounded uppercase">Finalizada</span>
</div>
<div class="flex flex-wrap justify-center md:justify-start gap-y-2 gap-x-6 text-sm text-[#617589]">
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">location_on</span>
<span>Plaza México</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm">calendar_month</span>
<span>02 - 05 de Julio, 2023</span>
</div>
<div class="flex items-center gap-1.5">
<span class="material-symbols-outlined text-sm text-warning">how_to_reg</span>
<span class="font-medium text-warning">Asistencia: 75% (3/4 días)</span>
</div>
</div>
</div>
<div class="w-full md:w-auto flex flex-col items-center gap-2">
<div class="flex items-center gap-1.5 text-success bg-success/10 px-4 py-2 rounded-xl font-bold text-sm">
<span class="material-symbols-outlined text-lg">check_circle</span>
                                Ya Evaluado
                            </div>
</div>
</div>
</div>
</div>
<div class="mt-8 flex justify-center">
<nav class="flex items-center gap-2">
<button class="p-2 border border-[#dbe0e6] rounded-lg hover:bg-slate-50">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="w-10 h-10 bg-primary text-white rounded-lg font-bold">1</button>
<button class="w-10 h-10 border border-[#dbe0e6] rounded-lg hover:bg-slate-50 font-bold">2</button>
<button class="p-2 border border-[#dbe0e6] rounded-lg hover:bg-slate-50">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</nav>
</div>
</div>
<footer class="border-t border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-slate-900 py-10 px-10">
<div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
<div class="flex flex-col gap-1">
<p class="font-bold text-[#111418] dark:text-white">Municipio de Cuidados</p>
<p class="text-xs text-[#617589]">© 2023 Ilustre Municipalidad de Viña del Mar.</p>
<p class="text-[10px] text-[#617589]">Gestión de Fomento Productivo y Emprendimiento.</p>
</div>
<div class="flex gap-8 text-sm font-semibold text-[#617589]">
<a class="hover:text-primary transition-colors" href="#">Base de Datos</a>
<a class="hover:text-primary transition-colors" href="#">Manual del Emprendedor</a>
<a class="hover:text-primary transition-colors" href="#">Mesa de Ayuda</a>
</div>
</div>
</footer>
</main>
</div>

</body></html>