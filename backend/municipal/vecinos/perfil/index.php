<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Mi Perfil Ciudadano";
$content_php = __DIR__ . '/content_perfil.php';

if (!file_exists($content_php)) {
    file_put_contents($content_php, '
        <div class="max-w-4xl mx-auto space-y-10">
            <!-- Encabezado de Perfil -->
            <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-10 flex flex-col md:flex-row items-center gap-10">
                <div class="relative group">
                    <div class="size-32 rounded-[48px] bg-primary/10 flex items-center justify-center text-primary text-4xl font-black border-4 border-white dark:border-slate-800 shadow-xl overflow-hidden">
                        RV
                    </div>
                    <button class="absolute -right-2 -bottom-2 size-10 bg-slate-900 text-white rounded-2xl flex items-center justify-center border-4 border-white dark:border-slate-800 scale-90 hover:scale-100 transition-all">
                        <span class="material-symbols-outlined text-lg">edit</span>
                    </button>
                </div>
                <div class="flex flex-col gap-2 text-center md:text-left flex-1">
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Rodrigo Valdés</h2>
                    <p class="text-slate-500 font-bold uppercase text-[11px] tracking-[0.2em] flex items-center justify-center md:justify-start gap-2">
                        <span class="size-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Vecino Verificado
                    </p>
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start mt-4">
                        <div class="px-5 py-2.5 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">fingerprint</span>
                            <span class="text-xs font-black text-slate-700 dark:text-slate-300">12.345.678-K</span>
                        </div>
                         <div class="px-5 py-2.5 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">home</span>
                            <span class="text-xs font-black text-slate-700 dark:text-slate-300">Reñaca Alto</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de Configuración -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Datos Personales -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8 space-y-6">
                    <h3 class="text-lg font-black text-slate-800 dark:text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Datos Personales
                    </h3>
                    <div class="space-y-4">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-2">Correo Electrónico</label>
                            <input type="email" value="rodrigo.v@gmail.com" class="bg-slate-50 dark:bg-slate-800 border-transparent rounded-2xl px-5 py-4 text-sm font-medium focus:ring-primary">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-2">Teléfono de contacto</label>
                            <input type="tel" value="+56 9 1234 5678" class="bg-slate-50 dark:bg-slate-800 border-transparent rounded-2xl px-5 py-4 text-sm font-medium focus:ring-primary">
                        </div>
                    </div>
                    <button class="w-full py-4 bg-slate-900 text-white rounded-[24px] font-black text-xs hover:bg-slate-800 transition-all shadow-xl">Actualizar Info</button>
                </div>

                <!-- Seguridad -->
                <div class="bg-white dark:bg-slate-900 rounded-[40px] border border-slate-200 dark:border-slate-800 p-8 space-y-6">
                    <h3 class="text-lg font-black text-slate-800 dark:text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">security</span>
                        Seguridad
                    </h3>
                    <div class="space-y-4">
                        <a href="password.php" class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl group hover:border-primary border border-transparent transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">lock_reset</span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Cambiar Contraseña</span>
                            </div>
                            <span class="material-symbols-outlined text-slate-300">chevron_right</span>
                        </a>
                        <a href="seguridad.php" class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-2xl group hover:border-primary border border-transparent transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">shield</span>
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Doble Factor Aut.</span>
                            </div>
                            <span class="material-symbols-outlined text-slate-300">chevron_right</span>
                        </a>
                    </div>
                    <div class="pt-4 flex flex-col gap-3">
                         <p class="text-[10px] text-slate-400 font-medium text-center italic">Último acceso: 05 Feb 2026 a las 09:30</p>
                         <button class="text-rose-500 text-[10px] font-black uppercase tracking-[0.2em] hover:underline">Eliminar Cuenta</button>
                    </div>
                </div>
            </div>
        </div>
    ');
}

renderLayout($page_title, $content_php);
?>
