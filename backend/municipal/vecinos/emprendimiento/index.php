<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dashboard de Emprendedor - Municipio de Cuidados</title>
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
<div class="sidebar-item sidebar-item-active">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-bold text-sm">Inicio</span>
</div>
<div class="sidebar-item">
<span class="material-symbols-outlined">event</span>
<span class="font-bold text-sm">Próximas Ferias</span>
</div>
<a href="historial.php"><div class="sidebar-item">
<span class="material-symbols-outlined">history</span>
<span class="font-bold text-sm">Historial</span>
</div></a>
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
<h1 class="text-xl font-bold">Bienvenida, Andrea</h1>
<p class="text-xs text-[#617589]">Viernes, 24 de Octubre de 2023</p>
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
<div class="mb-8">
<h2 class="text-2xl font-black text-[#111418] dark:text-white">Panel de Gestión</h2>
<p class="text-[#617589]">Gestiona tus ferias y asistencias desde un solo lugar.</p>
</div>
<div class="grid grid-cols-12 gap-6">
<div class="col-span-12 lg:col-span-8">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 overflow-hidden shadow-sm h-full">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 flex justify-between items-center">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">stars</span>
<h3 class="font-bold">Próxima Feria Asignada</h3>
</div>
<span class="bg-primary/10 text-primary text-[10px] font-bold px-3 py-1 rounded-full uppercase">Confirmada</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2">
<div class="p-6 space-y-4">
<div>
<h4 class="text-xl font-black text-primary">Feria de Emprendimiento</h4>
<p class="text-sm text-[#617589]">Plaza de Viña del Mar</p>
</div>
<div class="space-y-3">
<div class="flex items-center gap-3">
<div class="bg-slate-100 dark:bg-slate-700 p-2 rounded-lg">
<span class="material-symbols-outlined text-slate-600 dark:text-slate-300">calendar_today</span>
</div>
<div>
<p class="text-[10px] uppercase font-bold text-[#617589]">Fecha de Inicio</p>
<p class="text-sm font-bold">24 de Octubre, 2023</p>
</div>
</div>
<div class="flex items-center gap-3">
<div class="bg-slate-100 dark:bg-slate-700 p-2 rounded-lg">
<span class="material-symbols-outlined text-slate-600 dark:text-slate-300">location_on</span>
</div>
<div>
<p class="text-[10px] uppercase font-bold text-[#617589]">Ubicación</p>
<p class="text-sm font-bold">Sector Pileta, Puesto #42</p>
</div>
</div>
</div>
<a href="asistencia.php" class="w-full py-3 bg-primary hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
<span class="material-symbols-outlined">qr_code_scanner</span>
                                        Registrar Asistencia de Hoy
                                    </a>
</div>
<div class="h-full min-h-[250px] relative">
<img alt="Mapa Ubicación" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK"/>
<div class="absolute inset-0 bg-primary/10"></div>
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
<div class="relative">
<span class="material-symbols-outlined text-primary text-5xl fill-1">location_on</span>
<span class="absolute top-0 right-0 flex h-3 w-3">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
<div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm">
<h3 class="font-bold mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-warning">account_balance_wallet</span>
                                Resumen de Créditos
                            </h3>
<div class="flex items-end justify-between mb-2">
<span class="text-4xl font-black text-primary">07 <span class="text-lg text-[#617589] font-medium">/ 14</span></span>
<span class="text-xs font-bold text-success bg-success/10 px-2 py-1 rounded">50% Utilizado</span>
</div>
<div class="w-full bg-slate-100 dark:bg-slate-700 h-2 rounded-full mb-4">
<div class="bg-primary h-2 rounded-full" style="width: 50%"></div>
</div>
<p class="text-[10px] text-[#617589]">Créditos disponibles para postulación a ferias municipales durante el semestre actual.</p>
</div>
<div class="bg-primary text-white p-6 rounded-2xl shadow-lg shadow-primary/30 flex flex-col justify-between h-full">
<div>
<h3 class="font-bold text-lg leading-tight mb-2">¿Estás en tu puesto?</h3>
<p class="text-white/80 text-xs mb-6">No olvides registrar tu entrada y salida hoy para mantener tus beneficios.</p>
</div>
<a class="bg-white text-primary text-sm font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 hover:bg-slate-50 transition-colors" href="#">
<span class="material-symbols-outlined">camera_alt</span>
                                Tomar Foto de Asistencia
                            </a>
</div>
</div>
<div class="col-span-12">
<div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h3 class="font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-success">fact_check</span>
                                        Mis Asistencias - Feria Actual
                                    </h3>
<p class="text-xs text-[#617589]">Seguimiento de cumplimiento de los 4 días de feria.</p>
</div>
<div class="flex gap-4">
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-success"></span>
<span class="text-[10px] font-bold uppercase text-[#617589]">Presente</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-warning"></span>
<span class="text-[10px] font-bold uppercase text-[#617589]">En curso</span>
</div>
<div class="flex items-center gap-1.5">
<span class="w-3 h-3 rounded-full bg-slate-200"></span>
<span class="text-[10px] font-bold uppercase text-[#617589]">Pendiente</span>
</div>
</div>
</div>
<div class="p-8">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
<div class="relative flex flex-col items-center p-6 rounded-2xl bg-success/5 border border-success/20">
<div class="bg-success text-white p-3 rounded-full mb-3">
<span class="material-symbols-outlined text-2xl">check_circle</span>
</div>
<span class="font-black text-lg">Día 1</span>
<span class="text-[10px] font-bold text-success uppercase">Completado</span>
<p class="text-[10px] text-[#617589] mt-2">24 Oct - 08:30 a 19:00</p>
</div>
<div class="relative flex flex-col items-center p-6 rounded-2xl bg-warning/5 border-2 border-warning shadow-md scale-105 z-10">
<div class="bg-warning text-white p-3 rounded-full mb-3">
<span class="material-symbols-outlined text-2xl">hourglass_top</span>
</div>
<span class="font-black text-lg">Día 2</span>
<span class="text-[10px] font-bold text-warning uppercase">En curso (Hoy)</span>
<p class="text-[10px] text-[#617589] mt-2">Entrada: 08:45 AM</p>
</div>
<div class="relative flex flex-col items-center p-6 rounded-2xl bg-slate-50 border border-slate-200">
<div class="bg-slate-200 text-slate-400 p-3 rounded-full mb-3">
<span class="material-symbols-outlined text-2xl">schedule</span>
</div>
<span class="font-black text-lg text-slate-400">Día 3</span>
<span class="text-[10px] font-bold text-slate-400 uppercase">Pendiente</span>
<p class="text-[10px] text-[#617589] mt-2">Programado: 26 Oct</p>
</div>
<div class="relative flex flex-col items-center p-6 rounded-2xl bg-slate-50 border border-slate-200">
<div class="bg-slate-200 text-slate-400 p-3 rounded-full mb-3">
<span class="material-symbols-outlined text-2xl">schedule</span>
</div>
<span class="font-black text-lg text-slate-400">Día 4</span>
<span class="text-[10px] font-bold text-slate-400 uppercase">Pendiente</span>
<p class="text-[10px] text-[#617589] mt-2">Programado: 27 Oct</p>
</div>
</div>
<div class="mt-8 flex flex-col gap-2">
<div class="flex justify-between text-xs font-bold">
<span>Progreso de Cumplimiento</span>
<span>25%</span>
</div>
<div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
<div class="bg-success h-full transition-all" style="width: 25%"></div>
</div>
</div>
</div>
</div>
</div>
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