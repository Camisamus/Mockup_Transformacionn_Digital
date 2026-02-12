<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Centro de Mensajes";
$content_php = __DIR__ . '/content_mensajes.php';

if (!file_exists($content_php)) {
    file_put_contents($content_php, '
        <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden flex h-[700px]">
            <!-- Sidebar de Mensajes -->
            <div class="w-80 border-r border-slate-100 dark:border-slate-800 flex flex-col">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                    <h3 class="font-black text-slate-800 dark:text-white">Inbox</h3>
                    <button class="size-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center hover:scale-105 transition-all">
                        <span class="material-symbols-outlined text-xl">edit_square</span>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    <div class="p-4 space-y-2">
                        <div class="p-4 bg-primary/5 rounded-[24px] border border-primary/10 flex flex-col gap-1 cursor-pointer">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-primary uppercase tracking-widest">Municipio</span>
                                <span class="text-[9px] text-slate-400 font-bold">HACE 2H</span>
                            </div>
                            <h4 class="text-xs font-extrabold text-slate-800 dark:text-white">Confirmación de Reserva</h4>
                            <p class="text-[10px] text-slate-500 line-clamp-1">Tu reserva para la Plaza Victoria ha sido exitosa...</p>
                        </div>
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-[24px] transition-all flex flex-col gap-1 cursor-pointer group">
                             <div class="flex justify-between items-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">OIRS Digital</span>
                                <span class="text-[9px] text-slate-400 font-bold">AYER</span>
                            </div>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-white">Respuesta a su consulta #55390</h4>
                            <p class="text-[10px] text-slate-500 line-clamp-1">Estimado vecino, respecto a su solicitud de iluminación...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visualizador de Mensaje -->
            <div class="flex-1 flex flex-col bg-slate-50/30 dark:bg-slate-900/50">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm sticky top-0">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex flex-col gap-1">
                            <span class="px-3 py-1 bg-primary/10 text-primary text-[9px] font-black rounded-lg uppercase tracking-wider w-fit mb-2">Notificación Oficial</span>
                            <h2 class="text-2xl font-black text-slate-800 dark:text-white">Confirmación de Reserva de Plaza</h2>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="p-3 text-slate-400 hover:text-danger transition-colors bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                             <button class="p-3 text-slate-400 hover:text-primary transition-colors bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                <span class="material-symbols-outlined">print</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-10 flex-1 overflow-y-auto custom-scrollbar">
                    <div class="bg-white dark:bg-slate-900 p-8 rounded-[40px] border border-slate-100 dark:border-slate-800 max-w-2xl mx-auto shadow-sm space-y-6">
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-medium">Estimado Rodrigo Valdés,</p>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                            Nos complace informarle que su reserva para participar en la <b>Feria de Emprendedores de Plaza Victoria</b> (Semana 2 de Marzo) ha sido procesada correctamente.
                        </p>
                        <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-[28px] border-l-4 border-primary space-y-2">
                             <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Código de Verificación</p>
                             <p class="text-lg font-black text-primary tracking-widest leading-none">PRT-2026-X89</p>
                        </div>
                        <p class="text-[11px] text-slate-400 font-medium italic">Atentamente,<br>Departamento de Fomento Productivo - Viña del Mar.</p>
                    </div>
                </div>
                <div class="p-6 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
                    <div class="flex gap-4 max-w-2xl mx-auto">
                        <input type="text" placeholder="Escribe tu respuesta..." class="flex-1 bg-slate-50 dark:bg-slate-800 border-transparent rounded-[20px] px-6 text-sm font-medium focus:ring-primary">
                        <button class="size-12 bg-primary text-white rounded-[20px] flex items-center justify-center shadow-lg shadow-primary/30">
                            <span class="material-symbols-outlined transform rotate-[-45deg] scale-110">send</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    ');
}

renderLayout($page_title, $content_php);
?>
