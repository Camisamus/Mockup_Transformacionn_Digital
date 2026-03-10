<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard de Licencias - Portal Vecinos</title>
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
                        "display": ["Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 transition-colors duration-200">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <!-- Header -->
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-10 py-3 sticky top-0 z-50">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-4 text-primary font-bold">
                    <div class="size-8">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <h2 class="text-slate-900 dark:text-white text-lg tracking-tight">Portal Vecinos</h2>
                </div>
                <nav class="hidden md:flex items-center gap-6">
                    <a class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors" href="#">Inicio</a>
                    <a class="text-primary text-sm font-bold border-b-2 border-primary py-4" href="#">Licencias</a>
                    <a class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors" href="#">Pagos</a>
                    <a class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors" href="#">Tramites</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-primary/10 rounded-full p-1 border border-primary/20">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDcxlAXsQezr8-d0Z0NfXjH3nYCD6EWiAs1RuIN6asSENnPPr23z-ThjB-WLsEKusrp-k3MvkMJHFrPWZmU2FRN6uqhqO3JfzpEBRaSLcBlpukLISbnI2pR6MbjTXe0wufYF6V6Jz0lJAfXmBgu2NRVlIL_EKCIMIpMZgv06yqFOPZ5QwDRNjCBEdkbXE-agG7p45edyzUiPGyykT7F8oNgBrynN4tURAZvCxZpowMAvxsFsOgo0T6YNM9_mwasrnbkoGanvM9GvTqb");'></div>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-[1200px] mx-auto w-full px-6 py-8">
            <nav class="flex items-center gap-2 text-sm mb-6">
                <a class="text-slate-500 hover:text-primary" href="#">Inicio</a>
                <span class="material-symbols-outlined text-xs text-slate-400">chevron_right</span>
                <span class="text-slate-900 dark:text-white font-medium">Gestión de Licencias de Conducir</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Columna Izquierda: Estado de la Licencia -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8 shadow-sm overflow-hidden relative">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <span class="material-symbols-outlined text-[120px]">badge</span>
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Documento Vigente</span>
                                <span class="text-slate-400 text-sm">•</span>
                                <span class="text-slate-500 text-sm">Próximo vencimiento: 12 Octubre, 2026</span>
                            </div>
                            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2 leading-tight">Juan Pablo Pérez González</h1>
                            <p class="text-slate-500 font-medium mb-8">RUT: 12.345.678-9</p>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                                <div>
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Clase</p>
                                    <p class="text-xl font-bold text-primary">B y C</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Otorgamiento</p>
                                    <p class="text-xl font-bold text-slate-800 dark:text-white">12/10/2020</p>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Control</p>
                                    <p class="text-xl font-bold text-slate-800 dark:text-white">12/10/2026</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trámites en Curso -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">pending_actions</span>
                                Mis Trámites en Curso
                            </h3>
                            <span class="bg-primary/10 text-primary text-[10px] font-bold px-2.5 py-1 rounded-full">1 Activo</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-6 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                                <div class="bg-white dark:bg-slate-900 rounded-full p-3 shadow-sm text-primary">
                                    <span class="material-symbols-outlined block">update</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-slate-900 dark:text-white">Renovación Licencia Clase B</h4>
                                        <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded leading-none">Pendiente de Documentos</span>
                                    </div>
                                    <p class="text-sm text-slate-500 mb-4">Iniciado el 05 de Marzo, 2024</p>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full w-[45%]" style="width: 45%;"></div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase">Solicitud</span>
                                        <span class="text-[10px] font-bold text-primary uppercase">Carga Doc.</span>
                                        <span class="text-[10px] font-bold text-slate-300 uppercase">Exámenes</span>
                                        <span class="text-[10px] font-bold text-slate-300 uppercase">Entrega</span>
                                    </div>
                                </div>
                                <a href="licencia_gestionar.php" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 hover:border-primary p-2 rounded-lg transition-colors group">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Accesos Rápidos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="licencia_reservar.php" class="bg-primary text-white p-6 rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all flex items-center justify-between overflow-hidden relative group">
                            <div class="relative z-10">
                                <h3 class="text-lg font-bold mb-1">Reservar Hora</h3>
                                <p class="text-primary-100/80 text-sm">Agenda tu examen práctico o médico</p>
                            </div>
                            <span class="material-symbols-outlined text-5xl opacity-20 relative z-10 group-hover:scale-110 transition-transform">calendar_month</span>
                        </a>
                        <a href="licencia_gestionar.php" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 rounded-2xl hover:border-primary transition-all flex items-center justify-between group">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Cargar Documentos</h3>
                                <p class="text-slate-500 text-sm">Sube tu certificado de estudios o médico</p>
                            </div>
                            <span class="material-symbols-outlined text-slate-300 group-hover:text-primary group-hover:scale-110 transition-all text-5xl">cloud_upload</span>
                        </a>
                    </div>
                </div>

                <!-- Columna Derecha: Información y Ayuda -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-6">Requisitos Generales</h3>
                        <ul class="space-y-4">
                            <li class="flex gap-3">
                                <span class="material-symbols-outlined text-emerald-500 text-xl">check_circle</span>
                                <div class="text-sm">
                                    <p class="font-bold text-slate-700 dark:text-slate-200">Cédula de Identidad</p>
                                    <p class="text-slate-500">Vigente y original</p>
                                </div>
                            </li>
                            <li class="flex gap-3">
                                <span class="material-symbols-outlined text-emerald-500 text-xl">check_circle</span>
                                <div class="text-sm">
                                    <p class="font-bold text-slate-700 dark:text-slate-200">Certificado de Estudios</p>
                                    <p class="text-slate-500">Acreditación de escolaridad</p>
                                </div>
                            </li>
                            <li class="flex gap-3">
                                <span class="material-symbols-outlined text-primary text-xl">info</span>
                                <div class="text-sm">
                                    <p class="font-bold text-slate-700 dark:text-slate-200">Licencia Anterior</p>
                                    <p class="text-slate-500">En caso de renovación</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 opacity-10">
                            <span class="material-symbols-outlined text-[120px]">help</span>
                        </div>
                        <h3 class="font-bold text-lg mb-2 relative z-10">¿Tienes dudas?</h3>
                        <p class="text-slate-400 text-sm mb-6 relative z-10">Revisa nuestra sección de preguntas frecuentes o contáctanos directamente.</p>
                        <button class="w-full bg-slate-800 hover:bg-slate-700 text-white py-2.5 rounded-lg text-sm font-bold transition-colors relative z-10">
                            Ir al Centro de Ayuda
                        </button>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">Noticias Municipales</h3>
                        <div class="space-y-4">
                            <div class="group cursor-pointer">
                                <p class="text-[10px] font-bold text-primary uppercase mb-1">02 Mar, 2024</p>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white group-hover:text-primary transition-colors">Extensión de prórroga para licencias vencidas en 2023</h4>
                            </div>
                            <div class="group cursor-pointer">
                                <p class="text-[10px] font-bold text-primary uppercase mb-1">28 Feb, 2024</p>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-white group-hover:text-primary transition-colors">Nuevo simulador de examen teórico disponible gratis</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 px-10 mt-auto">
            <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="size-8 text-slate-400">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-xs font-medium">© 2024 Portal de Vecinos - Ilustre Municipalidad de Viña del Mar.<br/>Departamento de Tránsito y Licencias.</p>
                </div>
                <div class="flex gap-8">
                    <a class="text-slate-400 hover:text-primary transition-colors text-xs font-bold" href="#">Términos</a>
                    <a class="text-slate-400 hover:text-primary transition-colors text-xs font-bold" href="#">Privacidad</a>
                    <a class="text-slate-400 hover:text-primary transition-colors text-xs font-bold" href="#">Contacto</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>