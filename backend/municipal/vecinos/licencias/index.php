<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Licencias de Conducir - Trámites y Reservas";
$content_php = __DIR__ . '/content_licencias.php';

if (!file_exists($content_php)) {
    file_put_contents($content_php, '
        <div class="space-y-10">
            <!-- Banner Alerta Vencimiento -->
            <div class="bg-amber-50 dark:bg-amber-900/20 border-2 border-amber-200 dark:border-amber-700 p-8 rounded-[40px] flex items-center gap-6">
                <div class="size-16 bg-amber-500 rounded-3xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-amber-500/30">
                    <span class="material-symbols-outlined text-3xl">warning</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="text-lg font-black text-amber-900 dark:text-amber-400">Tu licencia vence en 45 días</h4>
                    <p class="text-amber-700/80 dark:text-amber-500/80 text-sm font-medium">Te recomendamos solicitar tu reserva de hora con anticipación para evitar inconvenientes.</p>
                </div>
                <a href="solicitar.php" class="ml-auto px-8 py-4 bg-amber-500 text-white font-black text-sm rounded-[24px] shadow-xl shadow-amber-500/20 transition-all hover:scale-105">Agendar Hora ahora</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tarjetas de Trámites -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8 flex flex-col gap-6">
                    <div class="size-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-2xl">drive_eta</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-800 dark:text-white">Primera Licencia</h4>
                        <p class="text-slate-500 text-xs font-medium mt-1">Obtén tu licencia por primera vez (Clase B o C).</p>
                    </div>
                    <a href="#" class="mt-auto flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl group hover:bg-primary transition-all">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 group-hover:text-white">Iniciar Solicitud</span>
                        <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">arrow_forward</span>
                    </a>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8 flex flex-col gap-6">
                    <div class="size-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                        <span class="material-symbols-outlined text-2xl">autorenew</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-800 dark:text-white">Renovación</h4>
                        <p class="text-slate-500 text-xs font-medium mt-1">Renueva tu licencia vigente de forma simplificada.</p>
                    </div>
                    <a href="#" class="mt-auto flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl group hover:bg-primary transition-all">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 group-hover:text-white">Renovar ahora</span>
                        <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">arrow_forward</span>
                    </a>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8 flex flex-col gap-6">
                    <div class="size-14 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500">
                        <span class="material-symbols-outlined text-2xl">info</span>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-800 dark:text-white">Requisitos y Costos</h4>
                        <p class="text-slate-500 text-xs font-medium mt-1">Conoce la documentación necesaria y los valores vigentes.</p>
                    </div>
                    <a href="#" class="mt-auto flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl group hover:bg-primary transition-all">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 group-hover:text-white">Ver Información</span>
                        <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    ');
}

renderLayout($page_title, $content_php);
?>
