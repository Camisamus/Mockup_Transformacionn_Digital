<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Orientación al Ciudadano (IA)";
$content_php = __DIR__ . '/content_orientacion.php';

if (!file_exists($content_php)) {
    file_put_contents($content_php, '
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-slate-900 rounded-[48px] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col h-[650px]">
                <!-- Chat Header -->
                <div class="p-8 bg-slate-900 text-white flex items-center gap-6 relative">
                    <div class="size-16 bg-primary rounded-[24px] flex items-center justify-center shadow-lg shadow-primary/30 shrink-0">
                        <span class="material-symbols-outlined text-3xl">smart_toy</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl font-black">Asistente Municipal</h3>
                        <p class="text-slate-400 text-xs font-medium flex items-center gap-2">
                            <span class="size-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            Siempre en línea para ayudarte
                        </p>
                    </div>
                    <div class="absolute -right-8 -top-8 size-32 bg-primary/20 blur-3xl rounded-full"></div>
                </div>

                <!-- Chat Messages -->
                <div class="flex-1 overflow-y-auto custom-scrollbar p-10 space-y-8 bg-slate-50/30 dark:bg-slate-900/50">
                    <div class="flex gap-4 max-w-[80%]">
                        <div class="size-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-xl">smart_toy</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-6 rounded-[28px] rounded-tl-none border border-slate-100 dark:border-slate-700 shadow-sm space-y-3">
                            <p class="text-sm font-bold text-slate-800 dark:text-white leading-relaxed">
                                ¡Hola, Rodrigo! Soy tu asistente virtual. ¿En qué trámite municipal te gustaría recibir orientación hoy?
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <button class="px-4 py-2 bg-slate-50 dark:bg-slate-700 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary/10 hover:text-primary transition-all rounded-lg border border-slate-100 dark:border-slate-600">Licencias B</button>
                                <button class="px-4 py-2 bg-slate-50 dark:bg-slate-700 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary/10 hover:text-primary transition-all rounded-lg border border-slate-100 dark:border-slate-600">Patente Comercial</button>
                                <button class="px-4 py-2 bg-slate-50 dark:bg-slate-700 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary/10 hover:text-primary transition-all rounded-lg border border-slate-100 dark:border-slate-600">Subsidios Pago Agua</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 ml-auto max-w-[80%] flex-row-reverse">
                         <div class="size-10 bg-primary/20 rounded-xl flex items-center justify-center text-primary font-black shrink-0">RV</div>
                         <div class="bg-primary text-white p-6 rounded-[28px] rounded-tr-none shadow-lg shadow-primary/20">
                             <p class="text-sm font-bold leading-relaxed">Necesito saber qué documentos llevar para renovar mi licencia de conducir clase B.</p>
                         </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-8 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
                    <div class="flex gap-4 bg-slate-50 dark:bg-slate-800 p-2 rounded-[32px] border border-slate-100 dark:border-slate-700">
                        <input type="text" placeholder="Escribe tu duda aquí..." class="flex-1 bg-transparent border-transparent px-6 text-sm font-medium focus:ring-0">
                        <button class="size-14 bg-primary text-white rounded-[24px] flex items-center justify-center shadow-xl shadow-primary/30 hover:scale-105 active:scale-95 transition-all">
                            <span class="material-symbols-outlined transform rotate-[-45deg] scale-125">send</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    ');
}

renderLayout($page_title, $content_php);
?>
