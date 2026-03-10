<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Centro de Reservas de Plazas</title>
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
<body class="bg-background-light dark:bg-background-dark text-[#111418] dark:text-white font-display">
<div class="relative flex min-h-screen flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-4 text-[#111418] dark:text-white">
<div class="size-6 text-primary">
<span class="material-symbols-outlined text-3xl">account_balance</span>
</div>
<h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Centro de Reservas</h2>
</div>
<nav class="hidden md:flex items-center gap-9">
<a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Mis Reservas</a>
<a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Panel</a>
<a class="text-sm font-medium leading-normal hover:text-primary transition-colors" href="#">Configuración</a>
</nav>
</div>
<div class="flex flex-1 justify-end gap-8 items-center">
<label class="flex flex-col min-w-40 !h-10 max-w-64">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-[#617589] flex border-none bg-[#f0f2f4] dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg">
<span class="material-symbols-outlined text-[20px]">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111418] dark:text-white focus:outline-0 focus:ring-0 border-none bg-[#f0f2f4] dark:bg-slate-800 focus:border-none h-full placeholder:text-[#617589] px-4 rounded-l-none pl-2 text-sm font-normal" placeholder="Buscar plazas..." value=""/>
</div>
</label>
<div class="flex items-center gap-3">
<button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal">
<span>Perfil</span>
</button>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border border-slate-200" data-alt="User profile avatar placeholder" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCKV_w90SJ6DnuOvmVxYTfRXxpxFsRIzZ2Ckea8yTfgQC7TF4WJu4zpIXRkBTwcBHVfFts4pmUGwZJGpFHCNK30rktZbDdfeMV6xWOgpudb5yjCXr7fOYB9uTvK815Hx738eRbUjUc1rtPlUcBtbV1RjcDs1gAch7x4c7fuBFLPZ7On6qtMxsWFfeBRwxUtxNys1vrJiDZzwmOcqR0AMmficJxVV_CrWvR8YYd166akAFrwW3kNDCAJ1Q37llxNS1gsC5wWlA9tBOS3");'></div>
</div>
</div>
</header>
<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1 px-6">
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
<div class="flex flex-col gap-2">
<h1 class="text-[#111418] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Reserva de Plazas Públicas</h1>
<p class="text-[#617589] text-base font-normal">Módulo de gestión municipal para ferias de emprendimiento y uso del espacio público.</p>
</div>
<div class="bg-white dark:bg-slate-800 p-6 rounded-xl border border-[#dbe0e6] dark:border-slate-700 w-full md:w-80 shadow-sm">
<div class="flex gap-6 justify-between mb-2">
<p class="text-[#111418] dark:text-white text-base font-bold leading-normal">Créditos Disponibles</p>
<p class="text-primary text-lg font-black leading-normal">14</p>
</div>
<div class="rounded-full bg-[#dbe0e6] dark:bg-slate-700 h-2.5 overflow-hidden">
<div class="h-full rounded-full bg-primary" style="width: 100%;"></div>
</div>
<p class="text-[#617589] text-xs mt-3 font-medium uppercase tracking-wider">Asignación mensual vigente</p>
</div>
</div>
<div class="flex flex-col md:flex-row justify-between items-end border-b border-[#dbe0e6] dark:border-slate-700 mb-6">
<div class="flex gap-8 overflow-x-auto">
<a class="flex flex-col items-center justify-center border-b-[3px] border-primary text-primary pb-[13px] pt-4 whitespace-nowrap" href="#">
<p class="text-sm font-bold tracking-[0.015em]">Esta Semana</p>
</a>
<a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-[#617589] pb-[13px] pt-4 whitespace-nowrap hover:text-[#111418] dark:hover:text-white" href="#">
<p class="text-sm font-bold tracking-[0.015em]">Próxima Semana</p>
</a>
<a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-[#617589] pb-[13px] pt-4 whitespace-nowrap hover:text-[#111418] dark:hover:text-white" href="#">
<p class="text-sm font-bold tracking-[0.015em]">Calendario Mensual</p>
</a>
</div>
<div class="flex gap-2 py-3">
<button class="flex gap-2 px-3 py-2 rounded-lg bg-white dark:bg-slate-800 border border-[#dbe0e6] dark:border-slate-700 text-[#111418] dark:text-white items-center justify-center text-sm font-medium">
<span class="material-symbols-outlined text-xl">map</span>
                        Ver Mapa
                    </button>
<button class="p-2 rounded-lg bg-white dark:bg-slate-800 border border-[#dbe0e6] dark:border-slate-700 text-[#111418] dark:text-white flex items-center justify-center">
<span class="material-symbols-outlined">filter_list</span>
</button>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
<div class="lg:col-span-3 flex flex-col gap-4">
<div class="grid grid-cols-8 gap-2 px-4 py-2 text-xs font-bold text-[#617589] uppercase tracking-wider">
<div class="col-span-2">Espacio / Plaza</div>
<div class="text-center">Lun 23</div>
<div class="text-center">Mar 24</div>
<div class="text-center">Mié 25</div>
<div class="text-center">Jue 26</div>
<div class="text-center">Vie 27</div>
<div class="text-center">Sáb 28</div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-[#dbe0e6] dark:border-slate-700 shadow-sm grid grid-cols-8 gap-2 items-center">
<div class="col-span-2 flex items-center gap-3">
<div class="size-12 rounded-lg bg-cover bg-center shrink-0" data-alt="Plaza Mayor" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBY0el0uftkNayKlDZ-a_AIVD-QIjUsjRKwXzeCqLCLAfP51_3C_dBqtDhz0gc-wjl2fNu2bxUjvFS_60x4I9kl-TT36BO-iMHG23X31HaP_n-qB2wfPmti2yiQDlVIWYoIyRrveI6BQ6jNQVdP567RYOn4bPG1xGgK8cAkec-lBH0VDLV1_4_4rbwab9TD5yu9P9N0G6ymDfgQFfPVsnMrAnj12mAsnKT5ohq-3bDrbBXOiGdnoB_LMdaCTgqsqjKTGCxvkZ5rVMzz');"></div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Plaza Mayor</span>
<span class="text-[11px] text-[#617589]">Cap: 12 Puestos</span>
</div>
</div>
<div class="h-12 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-center justify-center cursor-default">
<span class="material-symbols-outlined text-green-600 dark:text-green-400 text-lg">check_circle</span>
</div>
<div class="h-12 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-center justify-center cursor-not-allowed group relative">
<span class="material-symbols-outlined text-red-600 dark:text-red-400 text-lg">block</span>
<div class="absolute bottom-full mb-2 hidden group-hover:block w-48 bg-slate-900 text-white text-[10px] p-2 rounded shadow-lg z-10 text-center">Validación: Ya posee una reserva en esta plaza este mes</div>
</div>
<div class="h-12 bg-primary rounded-lg flex items-center justify-center ring-2 ring-primary ring-offset-2 dark:ring-offset-slate-800">
<span class="material-symbols-outlined text-white text-lg">event_available</span>
</div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-[#dbe0e6] dark:border-slate-700 shadow-sm grid grid-cols-8 gap-2 items-center">
<div class="col-span-2 flex items-center gap-3">
<div class="size-12 rounded-lg bg-cover bg-center shrink-0" data-alt="Parque Central" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCtFfw5xw-DyWyhxeNYurpkRU8ZZ3-X3mPYIVyRlIASMbCnq6XsJBwZWS_942LgMAn6IPT2eznoREV_shOckVClQq3dCLgYm-CDKl4yzvARhrDZLaSrheGAglzfQTiXqjEL0Hfs2YFv47u72vHI4SJziLoQxYUCs9qE3_vNIQdPCUnSYoHsXRAFoRhxDXHuaq9z5wlSh0SB5632NKzXmSEehQgruBEA5iBdQe0v2BHE_UWxKDAMoOCB0MfrjrANGJIA_XsQkDhpmhI0');"></div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Parque Central</span>
<span class="text-[11px] text-[#617589]">Cap: 25 Puestos</span>
</div>
</div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-center justify-center cursor-not-allowed group relative">
<span class="material-symbols-outlined text-red-600 dark:text-red-400 text-lg">lock</span>
<div class="absolute bottom-full mb-2 hidden group-hover:block w-48 bg-slate-900 text-white text-[10px] p-2 rounded shadow-lg z-10 text-center">Validación: Máximo 2 reservas por semana permitido</div>
</div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
</div>
<div class="bg-white dark:bg-slate-800 rounded-xl p-4 border border-[#dbe0e6] dark:border-slate-700 shadow-sm grid grid-cols-8 gap-2 items-center">
<div class="col-span-2 flex items-center gap-3">
<div class="size-12 rounded-lg bg-cover bg-center shrink-0" data-alt="Centro Cultural" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDDh8aQYJq45c_qkloERf0p3HO8Ay3g3w-OolpYLN1xsJ_6IMDQOkYEjdirW9usb6OsI4k8ggaBe2YcJPA6MnDCNbss1fd9y6FfFdUl0mcMNGNutvRXf492PMEKqH0DwwjQAnUwG2AetD5Uylymi8AR0XF8WMfV2Vcg_UTZUjW-s7zuePXYDZMMQJ4MmzmLAWH-GzQo3-Fnr42S7O2_3YymvVgLjBpgd0HAsOlrqxXUG0hxfKfuVVaVQ4_YrrRiQetXdJtcmr30FJQ5');"></div>
<div class="flex flex-col">
<span class="text-sm font-bold text-[#111418] dark:text-white">Centro Cultural</span>
<span class="text-[11px] text-[#617589]">Cap: 8 Puestos</span>
</div>
</div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
<div class="h-12 bg-gray-100 dark:bg-slate-700/50 border border-dashed border-gray-300 dark:border-slate-600 rounded-lg flex items-center justify-center cursor-pointer hover:bg-white dark:hover:bg-slate-700"></div>
</div>
</div>
<div class="lg:col-span-1">
<div class="bg-white dark:bg-slate-800 rounded-xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 sticky top-24">
<h3 class="text-lg font-bold mb-4 flex items-center gap-2">
<span class="material-symbols-outlined text-primary">shopping_basket</span>
                            Resumen de Reserva
                        </h3>
<div class="space-y-4 mb-6">
<div class="flex flex-col gap-1 pb-4 border-b border-slate-100 dark:border-slate-700">
<p class="text-xs text-[#617589] font-semibold uppercase">Espacio Seleccionado</p>
<p class="text-sm font-bold">Plaza Mayor - Zona A</p>
</div>
<div class="flex flex-col gap-1 pb-4 border-b border-slate-100 dark:border-slate-700">
<p class="text-xs text-[#617589] font-semibold uppercase">Fecha y Horario</p>
<p class="text-sm font-bold">Miércoles, 25 Oct 2023</p>
<p class="text-xs text-[#617589]">08:00 AM - 06:00 PM</p>
</div>
<div class="flex justify-between items-center py-2">
<p class="text-sm font-medium">Costo de Reserva</p>
<p class="text-sm font-black text-primary">7 Créditos</p>
</div>
<div class="flex justify-between items-center py-2">
<p class="text-sm font-medium">Nuevo Balance</p>
<p class="text-sm font-black">7 Créditos</p>
</div>
</div>
<button class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 mb-4">
<span>Confirmar Reserva</span>
<span class="text-sm opacity-80">(7 Créditos)</span>
</button>
<div class="p-3 bg-blue-50 dark:bg-blue-900/10 rounded-lg border border-blue-100 dark:border-blue-800/50">
<div class="flex gap-2">
<span class="material-symbols-outlined text-primary text-sm">info</span>
<p class="text-[11px] text-primary leading-tight font-medium">Esta reserva requiere 24h de antelación para cancelación. Los créditos se reembolsan según reglas BPMN.</p>
</div>
</div>
</div>
<div class="mt-6 flex flex-col gap-2 p-4">
<p class="text-xs font-bold text-[#617589] uppercase mb-1">Leyenda</p>
<div class="flex items-center gap-2 text-xs">
<div class="size-3 bg-primary rounded-sm"></div>
<span>Seleccionado</span>
</div>
<div class="flex items-center gap-2 text-xs">
<div class="size-3 bg-red-100 border border-red-300 rounded-sm"></div>
<span>Bloqueado por Regla</span>
</div>
<div class="flex items-center gap-2 text-xs">
<div class="size-3 bg-green-100 border border-green-300 rounded-sm"></div>
<span>Ya Reservado</span>
</div>
</div>
</div>
</div>
</div>
</main>
<footer class="mt-12 border-t border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark py-8">
<div class="max-w-[1200px] mx-auto px-6 flex justify-between items-center text-[#617589] text-sm">
<p>© 2023 Sistema de Gestión de Espacios Municipales.</p>
<div class="flex gap-6">
<a class="hover:text-primary" href="#">Políticas</a>
<a class="hover:text-primary" href="#">Términos de Servicio</a>
<a class="hover:text-primary" href="#">Centro de Ayuda</a>
</div>
</div>
</footer>
</div>

</body></html>