<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Organizaciones Territoriales";
$content_php = __DIR__ . '/content_organizaciones.php';

if (!file_exists($content_php)) {
    file_put_contents($content_php, '
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <!-- Estado de Organización -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-black text-slate-800 dark:text-white flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">groups_2</span>
                            Mi Organización
                        </h3>
                        <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-xl uppercase tracking-widest border border-emerald-100">Vigente</span>
                    </div>
                    
                    <div class="flex flex-col md:flex-row gap-8 items-center bg-slate-50 dark:bg-slate-800/50 p-8 rounded-[32px]">
                        <div class="size-24 rounded-[32px] bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-4xl">domain</span>
                        </div>
                        <div class="flex flex-col gap-2 text-center md:text-left">
                            <h4 class="text-xl font-black text-slate-800 dark:text-white">Junta de Vecinos #44 - Reñaca Alto</h4>
                            <p class="text-slate-500 text-sm font-medium">Personalidad Jurídica: 4052-K • Desde 1998</p>
                            <div class="flex flex-wrap gap-2 justify-center md:justify-start mt-2">
                                <span class="px-3 py-1 bg-white dark:bg-slate-800 text-[10px] font-bold rounded-lg border border-slate-200 dark:border-slate-700">Territorial</span>
                                <span class="px-3 py-1 bg-white dark:bg-slate-800 text-[10px] font-bold rounded-lg border border-slate-200 dark:border-slate-700">Unidad 12</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historial de Acreditaciones -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8">
                    <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6">Historial de Acreditaciones</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-2xl transition-colors cursor-pointer border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                            <div class="flex items-center gap-4">
                                <div class="size-10 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined">verified</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold">Directiva Periodo 2024-2026</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Aprobado el 15 Ene 2024</span>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-slate-300">chevron_right</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <!-- Acciones -->
                <div class="bg-primary rounded-[40px] p-8 text-white">
                    <h4 class="text-xl font-black mb-4 leading-tight">¿Necesitas acreditar nueva directiva?</h4>
                    <p class="text-white/70 text-xs font-medium mb-6">Inicia el proceso digital para actualizar la información legal de tu organización.</p>
                    <a href="acreditar.php" class="block w-full py-4 bg-white text-primary text-center rounded-[24px] font-black text-sm shadow-xl">Comenzar Acreditación</a>
                </div>

                <!-- Ayuda -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8">
                    <h4 class="text-lg font-black mb-4">Ayuda para Organizaciones</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="#" class="flex items-center gap-3 text-xs font-bold text-slate-500 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-primary text-lg">download</span>
                                Guía de Acreditación (PDF)
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 text-xs font-bold text-slate-500 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-primary text-lg">help</span>
                                Preguntas Frecuentes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    ');
}

renderLayout($page_title, $content_php);
?>
