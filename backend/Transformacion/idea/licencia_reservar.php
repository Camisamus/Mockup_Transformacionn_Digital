<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Reservar Hora Licencia - Portal Vecinos</title>
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
                    <a class="text-primary text-sm font-bold border-b-2 border-primary py-4" href="#">Reservar Hora</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-primary/10 rounded-full p-1 border border-primary/20">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDcxlAXsQezr8-d0Z0NfXjH3nYCD6EWiAs1RuIN6asSENnPPr23z-ThjB-WLsEKusrp-k3MvkMJHFrPWZmU2FRN6uqhqO3JfzpEBRaSLcBlpukLISbnI2pR6MbjTXe0wufYF6V6Jz0lJAfXmBgu2NRVlIL_EKCIMIpMZgv06yqFOPZ5QwDRNjCBEdkbXE-agG7p45edyzUiPGyykT7F8oNgBrynN4tURAZvCxZpowMAvxsFsOgo0T6YNM9_mwasrnbkoGanvM9GvTqb");'></div>
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-[900px] mx-auto w-full px-6 py-12">
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4 tracking-tight">Reservar Hora</h1>
                <p class="text-slate-500 text-lg">Sigue los pasos para agendar tu cita en el Departamento de Tránsito.</p>
            </div>

            <!-- Stepper -->
            <div class="flex items-center gap-4 mb-12">
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="size-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">1</div>
                    <span class="text-sm font-bold text-slate-900 dark:text-white">Trámite</span>
                </div>
                <div class="h-px bg-slate-200 dark:bg-slate-800 flex-1"></div>
                <div class="flex items-center gap-2 text-slate-400">
                    <div class="size-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-bold">2</div>
                    <span class="text-sm font-medium">Fecha y Hora</span>
                </div>
                <div class="h-px bg-slate-200 dark:bg-slate-800 flex-1"></div>
                <div class="flex items-center gap-2 text-slate-400">
                    <div class="size-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-bold">3</div>
                    <span class="text-sm font-medium">Confirmación</span>
                </div>
            </div>

            <form action="licencia_confirmar.php" method="POST" class="space-y-8">
                <!-- Paso 1 Content: Seleccion de Tramite -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative block group cursor-pointer">
                        <input type="radio" name="tramite" class="peer absolute opacity-0 cursor-pointer" checked value="renovacion"/>
                        <div class="p-6 border-2 border-slate-100 dark:border-slate-800 rounded-2xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all h-full flex flex-col items-start gap-4">
                            <div class="bg-primary/10 text-primary p-3 rounded-xl">
                                <span class="material-symbols-outlined text-4xl block">update</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Renovación</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">Para licencias que están por vencer o vencidas de la comuna.</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 bg-primary text-white size-6 rounded-full flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity">
                            <span class="material-symbols-outlined text-sm">check</span>
                        </div>
                    </label>

                    <label class="relative block group cursor-pointer">
                        <input type="radio" name="tramite" class="peer absolute opacity-0 cursor-pointer" value="primera_vez"/>
                        <div class="p-6 border-2 border-slate-100 dark:border-slate-800 rounded-2xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all h-full flex flex-col items-start gap-4">
                            <div class="bg-slate-100 dark:bg-slate-800 text-slate-500 p-3 rounded-xl peer-checked:bg-primary/10 peer-checked:text-primary transition-colors">
                                <span class="material-symbols-outlined text-4xl block">new_releases</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Primera Licencia</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">Solicitud de licencia por primera vez (Clase B o C).</p>
                            </div>
                        </div>
                    </label>

                    <label class="relative block group cursor-pointer">
                        <input type="radio" name="tramite" class="peer absolute opacity-0 cursor-pointer" value="duplicado"/>
                        <div class="p-6 border-2 border-slate-100 dark:border-slate-800 rounded-2xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all h-full flex flex-col items-start gap-4">
                            <div class="bg-slate-100 dark:bg-slate-800 text-slate-500 p-3 rounded-xl peer-checked:bg-primary/10 peer-checked:text-primary transition-colors">
                                <span class="material-symbols-outlined text-4xl block">content_copy</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Duplicado</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">En caso de extravío, robo o deterioro de la licencia vigente.</p>
                            </div>
                        </div>
                    </label>

                    <label class="relative block group cursor-pointer">
                        <input type="radio" name="tramite" class="peer absolute opacity-0 cursor-pointer" value="expansion"/>
                        <div class="p-6 border-2 border-slate-100 dark:border-slate-800 rounded-2xl peer-checked:border-primary peer-checked:bg-primary/5 transition-all h-full flex flex-col items-start gap-4">
                            <div class="bg-slate-100 dark:bg-slate-800 text-slate-500 p-3 rounded-xl peer-checked:bg-primary/10 peer-checked:text-primary transition-colors">
                                <span class="material-symbols-outlined text-4xl block">add_circle_outline</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-1">Ampliación de Clase</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">Para agregar nuevas clases (Profesionales, Clase D, etc.)</p>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Selección de Fecha y Hora (Simulado como un solo grid por ahora) -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-8">
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-8 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">event_available</span>
                        Selecciona tu Fecha y Bloque Horario
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Calendario Mock -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="font-bold text-slate-800 dark:text-white">Marzo, 2024</span>
                                <div class="flex gap-2">
                                    <button type="button" class="p-1 hover:bg-slate-100 rounded transition-colors"><span class="material-symbols-outlined">chevron_left</span></button>
                                    <button type="button" class="p-1 hover:bg-slate-100 rounded transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
                                </div>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center mb-2">
                                <span class="text-[10px] uppercase font-bold text-slate-400">Lu</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400">Ma</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400">Mi</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400">Ju</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400">Vi</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400 text-red-400">Sa</span>
                                <span class="text-[10px] uppercase font-bold text-slate-400 text-red-400">Do</span>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center">
                                <!-- Mocking days -->
                                <div class="text-slate-300 py-2 text-sm">26</div>
                                <div class="text-slate-300 py-2 text-sm">27</div>
                                <div class="text-slate-300 py-2 text-sm">28</div>
                                <div class="text-slate-300 py-2 text-sm">29</div>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">1</button>
                                <div class="py-2 text-sm text-slate-300">2</div>
                                <div class="py-2 text-sm text-slate-300">3</div>
                                
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">4</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white bg-primary text-white rounded shadow-lg shadow-primary/20">5</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">6</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">7</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">8</button>
                                <div class="py-2 text-sm text-slate-300">9</div>
                                <div class="py-2 text-sm text-slate-300">10</div>
                                <!-- ... more days -->
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">11</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">12</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">13</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">14</button>
                                <button type="button" class="py-2 text-sm font-medium text-slate-900 dark:text-white hover:bg-primary/10 rounded">15</button>
                            </div>
                        </div>

                        <!-- Slots -->
                        <div class="space-y-4">
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Miercoles 06 de Marzo</p>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="block cursor-pointer">
                                    <input type="radio" name="horario" class="peer absolute opacity-0 cursor-pointer" value="09:00"/>
                                    <div class="py-3 px-4 text-center border-2 border-slate-100 dark:border-slate-800 rounded-xl peer-checked:border-primary peer-checked:bg-primary text-slate-900 dark:text-white peer-checked:text-white transition-all font-bold">09:00 AM</div>
                                </label>
                                <label class="block cursor-pointer">
                                    <input type="radio" name="horario" class="peer absolute opacity-0 cursor-pointer" checked value="10:30"/>
                                    <div class="py-3 px-4 text-center border-2 border-slate-100 dark:border-slate-800 rounded-xl peer-checked:border-primary peer-checked:bg-primary text-slate-900 dark:text-white peer-checked:text-white transition-all font-bold">10:30 AM</div>
                                </label>
                                <label class="block cursor-pointer">
                                    <input type="radio" name="horario" class="peer absolute opacity-0 cursor-pointer" value="12:00"/>
                                    <div class="py-3 px-4 text-center border-2 border-slate-100 dark:border-slate-800 rounded-xl peer-checked:border-primary peer-checked:bg-primary text-slate-900 dark:text-white peer-checked:text-white transition-all font-bold">12:00 PM</div>
                                </label>
                                <label class="block cursor-pointer">
                                    <input type="radio" name="horario" class="peer absolute opacity-0 cursor-pointer" value="14:30"/>
                                    <div class="py-3 px-4 text-center border-2 border-slate-100 dark:border-slate-800 rounded-xl peer-checked:border-primary peer-checked:bg-primary text-slate-900 dark:text-white peer-checked:text-white transition-all font-bold">02:30 PM</div>
                                </label>
                            </div>
                            <p class="text-[11px] text-slate-500 bg-slate-50 dark:bg-slate-800 p-3 rounded-lg flex gap-2">
                                <span class="material-symbols-outlined text-sm">lock</span>
                                Tu hora será reservada por 15 minutos mientras completas el trámite.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-800">
                    <a href="licencia_dashboard.php" class="text-slate-500 font-bold hover:text-primary transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined">arrow_back</span> Cancelar
                    </a>
                    <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-10 py-4 rounded-2xl font-bold shadow-xl shadow-primary/20 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-3">
                        Agendar Cita <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </form>
        </main>

        <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 px-10 mt-auto">
            <div class="max-w-[1200px] mx-auto flex justify-between items-center">
                <p class="text-slate-500 text-xs">© 2024 Portal de Vecinos - Ilustre Municipalidad de Viña del Mar.</p>
                <div class="flex gap-6">
                    <a class="text-slate-400 hover:text-primary transition-colors text-xs font-bold" href="#">Ayuda</a>
                    <a class="text-slate-400 hover:text-primary transition-colors text-xs font-bold" href="#">Términos</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>