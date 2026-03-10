<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Confirmación de Reserva - Portal Vecinos</title>
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

        <main class="flex-1 max-w-[800px] mx-auto w-full px-6 py-12">
            <div class="text-center mb-12">
                <div class="bg-emerald-100 dark:bg-emerald-900 shadow-xl shadow-emerald-500/10 text-emerald-600 dark:text-emerald-400 size-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-5xl">check_circle</span>
                </div>
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-2 tracking-tight">¡Hora Agendada con Éxito!</h1>
                <p class="text-slate-500 text-lg">Tu cita ha sido confirmada. Hemos enviado un respaldo a tu correo electrónico.</p>
            </div>

            <!-- Ticket de Reserva -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl shadow-primary/5 overflow-hidden flex flex-col md:flex-row relative">
                <!-- Seccion QR / Lateral -->
                <div class="bg-primary p-10 flex flex-col items-center justify-center gap-6 text-white md:w-64">
                    <div class="bg-white p-4 rounded-2xl shadow-xl">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=LIC-2024-00123" alt="QR Code" class="size-32 rounded-lg grayscale invert-0"/>
                    </div>
                    <p class="text-[10px] uppercase font-bold tracking-[0.2em] text-primary-100/60">ID #LIC-2024-00123</p>
                </div>

                <!-- Seccion Datos -->
                <div class="p-10 flex-1 relative">
                    <div class="absolute top-8 right-8 text-primary/5">
                        <span class="material-symbols-outlined text-[100px]">history_edu</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 relative z-10">
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Trámite</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">Renovación Clase B</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Cédula</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">12.345.678-9</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Fecha</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">Miercoles 06 Mar, 2024</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-1">Hora</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">10:30 AM</p>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 dark:border-slate-800 pt-8 mb-8">
                        <p class="text-xs text-slate-400 uppercase font-bold tracking-widest mb-3">Lugar del Examen</p>
                        <p class="text-sm text-slate-700 dark:text-slate-300 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            Departamento de Tránsito - Av. Marina S/N, Viña del Mar.
                        </p>
                    </div>

                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-900 p-4 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-amber-600">report_problem</span>
                        <div class="text-xs text-amber-700 dark:text-amber-400 leading-relaxed">
                            <p class="font-bold mb-1 uppercase">IMPORTANTE:</p>
                            <p>Debes presentarte 15 minutos antes de la hora acordada y haber cargado tu documentación en el portal para agilizar el proceso.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                <button class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-primary p-4 rounded-2xl transition-all flex flex-col items-center gap-2 group">
                    <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">picture_as_pdf</span>
                    <span class="text-sm font-bold text-slate-800 dark:text-white">Descargar Ticket</span>
                </button>
                <button class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-primary p-4 rounded-2xl transition-all flex flex-col items-center gap-2 group">
                    <span class="material-symbols-outlined text-emerald-500 group-hover:scale-110 transition-transform">calendar_add_on</span>
                    <span class="text-sm font-bold text-slate-800 dark:text-white">Añadir al Calendario</span>
                </button>
                <a href="licencia_gestionar.php" class="bg-primary hover:bg-primary/90 text-white p-4 rounded-2xl shadow-xl shadow-primary/20 transition-all flex flex-col items-center justify-center gap-2 group">
                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">cloud_upload</span>
                    <span class="text-sm font-bold">Cargar Documentos</span>
                </a>
            </div>

            <div class="mt-12 text-center">
                <a href="licencia_dashboard.php" class="text-slate-400 hover:text-primary transition-colors font-bold text-sm underline underline-offset-4">Volver al Dashboard</a>
            </div>
        </main>

        <footer class="py-12 text-center text-slate-500 text-xs">
            © 2024 Portal de Vecinos - Ilustre Municipalidad de Viña del Mar.
        </footer>
    </div>
</body>
</html>