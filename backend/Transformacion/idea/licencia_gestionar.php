<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestionar Documentos - Portal Vecinos</title>
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
                    <a class="text-slate-600 dark:text-slate-300 text-sm font-medium hover:text-primary transition-colors" href="licencia_dashboard.php">Dashboard</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-primary/10 rounded-full p-1 border border-primary/20">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDcxlAXsQezr8-d0Z0NfXjH3nYCD6EWiAs1RuIN6asSENnPPr23z-ThjB-WLsEKusrp-k3MvkMJHFrPWZmU2FRN6uqhqO3JfzpEBRaSLcBlpukLISbnI2pR6MbjTXe0wufYF6V6Jz0lJAfXmBgu2NRVlIL_EKCIMIpMZgv06yqFOPZ5QwDRNjCBEdkbXE-agG7p45edyzUiPGyykT7F8oNgBrynN4tURAZvCxZpowMAvxsFsOgo0T6YNM9_mwasrnbkoGanvM9GvTqb");'></div>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-[1000px] mx-auto w-full px-6 py-12">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
                <div>
                    <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2 tracking-tight">Gestionar Documentos</h1>
                    <p class="text-slate-500 text-lg">Carga los requisitos necesarios para tu trámite de Licencia de Conducir.</p>
                </div>
                <div class="bg-primary/5 border border-primary/10 px-4 py-2 rounded-xl text-primary text-sm font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">description</span> Trámite: Renovación Clase B
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Zona de Requisitos -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">task_alt</span>
                                Lista de Requisitos
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Requisito 1 -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border-2 border-slate-50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                                <div class="bg-emerald-100 text-emerald-600 p-2 rounded-full shadow shadow-emerald-500/10">
                                    <span class="material-symbols-outlined block text-base">check</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1">Cédula de Identidad (Ambos Lados)</h4>
                                    <p class="text-[10px] text-slate-500 mb-2 font-bold uppercase tracking-wider">Última carga: 05 Mar, 2024</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded font-bold">Documento Vigente</span>
                                    </div>
                                </div>
                                <button class="text-slate-400 hover:text-primary transition-colors"><span class="material-symbols-outlined">visibility</span></button>
                                <button class="text-slate-400 hover:text-red-500 transition-colors"><span class="material-symbols-outlined">delete</span></button>
                            </div>

                            <!-- Requisito 2 -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border-2 border-primary/20 bg-primary/5 transition-all">
                                <div class="bg-primary/20 text-primary p-2 rounded-full shadow shadow-primary-500/10">
                                    <span class="material-symbols-outlined block text-base">upload</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1 flex items-center gap-2">
                                        Certificado de Estudios (8° Básico o Sup.)
                                        <span class="bg-amber-100 text-amber-700 text-[9px] font-bold px-1.5 py-0.5 rounded leading-none">REQUERIDO</span>
                                    </h4>
                                    <p class="text-[10px] text-slate-500 mb-3 uppercase tracking-wider">Aún no se han cargado archivos.</p>
                                    <button class="bg-primary text-white text-[11px] font-bold px-4 py-1.5 rounded-lg shadow-lg shadow-primary/20 hover:scale-105 transition-transform">Subir Archivo</button>
                                </div>
                            </div>

                            <!-- Requisito 3 -->
                            <div class="flex items-start gap-4 p-4 rounded-xl border-2 border-slate-50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30">
                                <div class="bg-slate-200 text-slate-400 p-2 rounded-full">
                                    <span class="material-symbols-outlined block text-base">hourglass_empty</span>
                                </div>
                                <div class="flex-1 opacity-50">
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1">Certificado de Antecedentes (Electrónico)</h4>
                                    <p class="text-[10px] text-slate-500 lowercase tracking-wider">El sistema lo obtendrá automáticamente 48h antes de la cita.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Zona Dropzone -->
                    <div class="border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-2xl p-12 text-center bg-white/50 dark:bg-slate-900/50 hover:bg-white dark:hover:bg-slate-900 hover:border-primary transition-all group flex flex-col items-center gap-4 cursor-pointer">
                        <div class="size-16 rounded-full bg-primary/5 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-4xl">cloud_upload</span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 dark:text-white mb-1">Cargar Archivo</p>
                            <p class="text-sm text-slate-400">Arrastra archivos aquí o haz clic para seleccionar (PDF, JPG, PNG)</p>
                        </div>
                    </div>
                </div>

                <!-- Resumen y Ayuda -->
                <div class="space-y-6">
                    <div class="bg-slate-900 text-white p-6 rounded-2xl shadow-xl">
                        <h3 class="font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-400">shield</span>
                            Carga Segura
                        </h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">Tus documentos son procesados bajo estrictas normas de privacidad y solo serán accesibles por el personal del Departamento de Tránsito.</p>
                        <div class="bg-slate-800 p-4 rounded-xl text-center">
                            <p class="text-xs text-slate-400 mb-1">Progreso de Documentación</p>
                            <div class="text-2xl font-bold text-white mb-2">33%</div>
                            <div class="w-full bg-slate-700 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full w-[33%]" style="width: 33%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">¿Necesitas ayuda?</h3>
                        <div class="space-y-4">
                            <p class="text-sm text-slate-500">Si no cuentas con tu certificado de estudios, puedes obtenerlo en línea en:</p>
                            <a href="#" class="text-primary text-sm font-bold flex items-center gap-2 hover:underline">
                                Mineduc en Línea <span class="material-symbols-outlined text-sm">open_in_new</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-start pt-12">
                <a href="licencia_confirmar.php" class="text-slate-500 font-bold hover:text-primary transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">arrow_back</span> Volver al Comprobante
                </a>
            </div>
        </main>

        <footer class="py-12 border-t border-slate-100 dark:border-slate-800 mt-24">
            <div class="max-w-[1000px] mx-auto text-center px-6">
                 <p class="text-slate-400 text-xs font-medium">© 2024 Ilustre Municipalidad de Viña del Mar.<br/>Dirección de Tránsito y Transporte Público.</p>
            </div>
        </footer>
    </div>
</body>
</html>
