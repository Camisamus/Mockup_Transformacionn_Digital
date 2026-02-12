<?php
include("../../include/header-usuarios.php");
?>

<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1 px-6">
    
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden mb-8">
        <div class="bg-success/5 p-8 flex flex-col items-center text-center border-b border-success/10">
            <div class="size-16 bg-success rounded-full flex items-center justify-center mb-4 shadow-lg shadow-success/20">
                <span class="material-symbols-outlined text-white text-4xl">inventory</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-black text-[#111418] dark:text-white mb-2">Comprobación de Reservas Mensuales</h1>
            <p class="text-[#617589] max-w-lg">Has utilizado tus 14 créditos mensuales para asegurar los siguientes espacios.</p>
        </div>

        <!-- Reservas Activas (2) -->
        <div class="p-8 space-y-6">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Reserva 1 -->
                <div class="flex-1 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 bg-slate-50 dark:bg-slate-900/50 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3">
                        <span class="text-[10px] font-black bg-primary/10 text-primary px-3 py-1 rounded-full uppercase">Confirmada</span>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="size-12 rounded-xl bg-primary flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">storefront</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-black leading-tight">Plaza Mayor - Zona A</h4>
                            <p class="text-xs text-[#617589]">Miércoles, 25 Oct 2023</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white dark:bg-slate-800 p-3 rounded-xl border border-slate-100 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-[#617589] uppercase mb-1">Puesto</p>
                            <p class="text-base font-black text-primary">Módulo #42</p>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-3 rounded-xl border border-slate-100 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-[#617589] uppercase mb-1">Costo</p>
                            <p class="text-base font-black text-primary">7 Créditos</p>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción Reserva 1 -->
                    <div class="space-y-3">
                        <button class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-primary/20 text-sm">
                            <span class="material-symbols-outlined text-lg">description</span>
                            Descargar Comprobante
                        </button>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="asistencia.php" class="flex items-center justify-center gap-2 bg-success hover:bg-emerald-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-success/20 text-xs">
                                <span class="material-symbols-outlined text-lg">how_to_reg</span>
                                Registrar Asistencia
                            </a>
                            <a href="evaluar.php" class="flex items-center justify-center gap-2 bg-info hover:bg-indigo-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-info/20 text-xs">
                                <span class="material-symbols-outlined text-lg">rate_review</span>
                                Evaluar Feria
                            </a>
                        </div>
                        <a href="cancelar.php" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-red-600/20 text-sm">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            Cancelar mi Inscripción
                        </a>
                    </div>
                </div>

                <!-- Reserva 2 -->
                <div class="flex-1 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 bg-slate-50 dark:bg-slate-900/50 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-3">
                        <span class="text-[10px] font-black bg-primary/10 text-primary px-3 py-1 rounded-full uppercase">Confirmada</span>
                    </div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="size-12 rounded-xl bg-primary flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">park</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-black leading-tight">Plaza de Armas</h4>
                            <p class="text-xs text-[#617589]">Viernes, 27 Oct 2023</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white dark:bg-slate-800 p-3 rounded-xl border border-slate-100 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-[#617589] uppercase mb-1">Puesto</p>
                            <p class="text-base font-black text-primary">Módulo #15</p>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-3 rounded-xl border border-slate-100 dark:border-slate-700">
                            <p class="text-[10px] font-bold text-[#617589] uppercase mb-1">Costo</p>
                            <p class="text-base font-black text-primary">7 Créditos</p>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción Reserva 2 -->
                    <div class="space-y-3">
                        <button class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-primary/20 text-sm">
                            <span class="material-symbols-outlined text-lg">description</span>
                            Descargar Comprobante
                        </button>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="asistencia.php" class="flex items-center justify-center gap-2 bg-success hover:bg-emerald-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-success/20 text-xs">
                                <span class="material-symbols-outlined text-lg">how_to_reg</span>
                                Registrar Asistencia
                            </a>
                            <a href="evaluar.php" class="flex items-center justify-center gap-2 bg-info hover:bg-indigo-600 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-info/20 text-xs">
                                <span class="material-symbols-outlined text-lg">rate_review</span>
                                Evaluar Feria
                            </a>
                        </div>
                        <button class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-md shadow-red-600/20 text-sm">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            Cancelar mi Inscripción
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Section - Reserva 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8">
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 text-center lg:text-left">
                <div class="flex flex-col lg:flex-row items-center justify-between mb-6 gap-4">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">map</span>
                        Layout de la Feria: Plaza Mayor
                    </h3>
                    <div class="flex gap-4 items-center flex-wrap justify-center">
                        <div class="flex items-center gap-2">
                            <div class="size-3 bg-primary rounded-sm shadow-sm"></div>
                            <span class="text-xs font-medium">Tu Puesto (#42)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="size-3 bg-slate-200 dark:bg-slate-600 rounded-sm"></div>
                            <span class="text-xs font-medium">Ocupado</span>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 dark:bg-slate-900/50 p-6 md:p-8 rounded-xl border border-slate-200 dark:border-slate-700 overflow-x-auto">
                    <div class="min-w-[500px]">
                        <div class="flex justify-center mb-8">
                            <div class="px-10 py-3 bg-slate-300 dark:bg-slate-700 rounded-t-3xl border-x border-t border-slate-400 dark:border-slate-600 text-xs font-black uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400 text-center">
                                Acceso Principal - Plaza Mayor
                            </div>
                        </div>
                        <div class="stall-grid">
                            <!-- Filas de puestos 1-8 -->
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">1</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">2</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">3</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">4</div>
                            <div class="col-span-2"></div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">5</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">6</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">7</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">8</div>
                            <div class="col-span-10 h-8"></div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">30</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">31</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">32</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">33</div>
                            <div class="col-span-2 flex items-center justify-center">
                                <div class="w-full h-1 bg-slate-300 dark:bg-slate-700 rounded-full"></div>
                            </div>
                            <div class="h-12 flex flex-col items-center justify-center rounded-md bg-primary text-white shadow-lg shadow-primary/40 ring-4 ring-primary/20 scale-110 z-10 transition-transform">
                                <span class="text-[10px] font-black">42</span>
                                <span class="material-symbols-outlined text-xs">person_pin</span>
                            </div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">43</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">44</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">45</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1 hidden lg:block">
             <div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 sticky top-24">
                <h3 class="font-bold text-base mb-4">Ayuda</h3>
                <div class="p-4 bg-amber-50 dark:bg-amber-900/10 rounded-xl border border-dashed border-amber-200 dark:border-amber-700">
                    <p class="text-[11px] text-amber-700 dark:text-amber-400 leading-tight">
                        Este mapa muestra tu ubicación exacta para la primera reserva.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Section - Reserva 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8">
        <div class="lg:col-span-3">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 text-center lg:text-left">
                <div class="flex flex-col lg:flex-row items-center justify-between mb-6 gap-4">
                    <h3 class="text-lg font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-info">map</span>
                        Layout de la Feria: Plaza de Armas
                    </h3>
                    <div class="flex gap-4 items-center flex-wrap justify-center">
                        <div class="flex items-center gap-2">
                            <div class="size-3 bg-info rounded-sm shadow-sm"></div>
                            <span class="text-xs font-medium">Tu Puesto (#15)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="size-3 bg-slate-200 dark:bg-slate-600 rounded-sm"></div>
                            <span class="text-xs font-medium">Ocupado</span>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 dark:bg-slate-900/50 p-6 md:p-8 rounded-xl border border-slate-200 dark:border-slate-700 overflow-x-auto">
                    <div class="min-w-[500px]">
                        <div class="flex justify-center mb-8">
                            <div class="px-10 py-3 bg-slate-300 dark:bg-slate-700 rounded-t-3xl border-x border-t border-slate-400 dark:border-slate-600 text-xs font-black uppercase tracking-[0.2em] text-slate-600 dark:text-slate-400 text-center">
                                Acceso Norte - Plaza de Armas
                            </div>
                        </div>
                        <div class="stall-grid">
                            <!-- Filas de puestos 1-8 -->
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-slate-200 dark:bg-slate-700 text-[10px] font-bold opacity-40">1</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">2</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">3</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">4</div>
                            <div class="col-span-2"></div>
                             <div class="h-12 flex flex-col items-center justify-center rounded-md bg-info text-white shadow-lg shadow-info/40 ring-4 ring-info/20 scale-110 z-10 transition-transform">
                                <span class="text-[10px] font-black">15</span>
                                <span class="material-symbols-outlined text-xs">person_pin</span>
                            </div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">16</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">17</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">18</div>
                            <div class="col-span-10 h-8"></div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold text-slate-300">A1</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold text-slate-300">A2</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold text-slate-300">A3</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold text-slate-300">A4</div>
                            <div class="col-span-2 flex items-center justify-center">
                                <div class="w-full h-1 bg-slate-300 dark:bg-slate-700 rounded-full"></div>
                            </div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold opacity-40">B1</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">B2</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">B3</div>
                            <div class="h-12 flex items-center justify-center rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-[10px] font-bold">B4</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-1 hidden lg:block">
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6 sticky top-24">
                <h3 class="font-bold text-base mb-4">Ayuda</h3>
                 <div class="p-4 bg-blue-50 dark:bg-blue-900/10 rounded-xl border border-dashed border-blue-200 dark:border-blue-700">
                    <p class="text-[11px] text-blue-700 dark:text-blue-400 leading-tight">
                        Este mapa muestra tu ubicación exacta para la segunda reserva.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Finales -->
    <div class="flex justify-center mb-12">
        <a href="index.php" class="flex items-center justify-center gap-2 bg-white dark:bg-slate-700 border border-[#dbe0e6] dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-600 text-[#111418] dark:text-white font-bold py-4 px-10 rounded-2xl transition-all shadow-lg text-lg">
            <span class="material-symbols-outlined text-2xl">home</span>
            Volver al Panel Principal
        </a>
    </div>

</div>
</main>

<?php include("../include/footer-usuarios.php"); ?>