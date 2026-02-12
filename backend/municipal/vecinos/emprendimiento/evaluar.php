<?php

include("../../include/header-usuarios.php");
?>
<main class="flex flex-1 justify-center py-8">
<div class="layout-content-container flex flex-col max-w-[900px] flex-1 px-6">
<div class="mb-8">
<h1 class="text-3xl font-black text-[#111418] dark:text-white">Evaluación de Participación</h1>
<p class="text-[#617589]">Tu opinión es fundamental para mejorar nuestras ferias y servicios municipales.</p>
</div>
<form class="space-y-8">
<section class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
<h3 class="text-lg font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-primary">event_available</span>
                            Registro de Asistencia
                        </h3>
<p class="text-sm text-[#617589]">Marca los días en los que estuviste presente en la feria.</p>
</div>
<div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-4">
<label class="flex flex-col items-center p-4 border border-[#dbe0e6] dark:border-slate-700 rounded-xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
<input class="size-6 rounded border-slate-300 text-primary focus:ring-primary mb-3" type="checkbox"/>
<span class="text-sm font-bold">Día 1</span>
<span class="text-[10px] text-[#617589]">Lun 23 Oct</span>
</label>
<label class="flex flex-col items-center p-4 border border-[#dbe0e6] dark:border-slate-700 rounded-xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
<input class="size-6 rounded border-slate-300 text-primary focus:ring-primary mb-3" type="checkbox"/>
<span class="text-sm font-bold">Día 2</span>
<span class="text-[10px] text-[#617589]">Mar 24 Oct</span>
</label>
<label class="flex flex-col items-center p-4 border border-[#dbe0e6] dark:border-slate-700 rounded-xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
<input class="size-6 rounded border-slate-300 text-primary focus:ring-primary mb-3" type="checkbox"/>
<span class="text-sm font-bold">Día 3</span>
<span class="text-[10px] text-[#617589]">Mié 25 Oct</span>
</label>
<label class="flex flex-col items-center p-4 border border-[#dbe0e6] dark:border-slate-700 rounded-xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
<input class="size-6 rounded border-slate-300 text-primary focus:ring-primary mb-3" type="checkbox"/>
<span class="text-sm font-bold">Día 4</span>
<span class="text-[10px] text-[#617589]">Jue 26 Oct</span>
</label>
</div>
</section>
<section class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm overflow-hidden">
<div class="p-6 border-b border-[#dbe0e6] dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
<h3 class="text-lg font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-primary">reviews</span>
                            Rúbrica de Evaluación
                        </h3>
<p class="text-sm text-[#617589]">Califica los siguientes aspectos de 1 a 5 estrellas.</p>
</div>
<div class="p-6 space-y-8">
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h4 class="font-bold text-sm">1. Calidad del espacio asignado</h4>
<p class="text-xs text-[#617589]">Dimensiones, estado del puesto y ubicación.</p>
</div>
<div class="flex items-center gap-1 star-rating flex-row-reverse justify-end">
<input class="hidden" id="p1-5" name="q1" type="radio" value="5"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p1-5">star</label>
<input class="hidden" id="p1-4" name="q1" type="radio" value="4"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p1-4">star</label>
<input class="hidden" id="p1-3" name="q1" type="radio" value="3"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p1-3">star</label>
<input class="hidden" id="p1-2" name="q1" type="radio" value="2"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p1-2">star</label>
<input class="hidden" id="p1-1" name="q1" type="radio" value="1"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p1-1">star</label>
</div>
</div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h4 class="font-bold text-sm">2. Flujo de público y visitantes</h4>
<p class="text-xs text-[#617589]">Cantidad de personas y potencial de ventas.</p>
</div>
<div class="flex items-center gap-1 star-rating flex-row-reverse justify-end">
<input class="hidden" id="p2-5" name="q2" type="radio" value="5"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p2-5">star</label>
<input class="hidden" id="p2-4" name="q2" type="radio" value="4"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p2-4">star</label>
<input class="hidden" id="p2-3" name="q2" type="radio" value="3"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p2-3">star</label>
<input class="hidden" id="p2-2" name="q2" type="radio" value="2"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p2-2">star</label>
<input class="hidden" id="p2-1" name="q2" type="radio" value="1"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p2-1">star</label>
</div>
</div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h4 class="font-bold text-sm">3. Organización municipal</h4>
<p class="text-xs text-[#617589]">Apoyo del personal y logística de la feria.</p>
</div>
<div class="flex items-center gap-1 star-rating flex-row-reverse justify-end">
<input class="hidden" id="p3-5" name="q3" type="radio" value="5"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p3-5">star</label>
<input class="hidden" id="p3-4" name="q3" type="radio" value="4"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p3-4">star</label>
<input class="hidden" id="p3-3" name="q3" type="radio" value="3"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p3-3">star</label>
<input class="hidden" id="p3-2" name="q3" type="radio" value="2"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p3-2">star</label>
<input class="hidden" id="p3-1" name="q3" type="radio" value="1"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p3-1">star</label>
</div>
</div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
<div>
<h4 class="font-bold text-sm">4. Satisfacción general</h4>
<p class="text-xs text-[#617589]">Experiencia global en el evento.</p>
</div>
<div class="flex items-center gap-1 star-rating flex-row-reverse justify-end">
<input class="hidden" id="p4-5" name="q4" type="radio" value="5"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p4-5">star</label>
<input class="hidden" id="p4-4" name="q4" type="radio" value="4"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p4-4">star</label>
<input class="hidden" id="p4-3" name="q4" type="radio" value="3"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p4-3">star</label>
<input class="hidden" id="p4-2" name="q4" type="radio" value="2"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p4-2">star</label>
<input class="hidden" id="p4-1" name="q4" type="radio" value="1"/><label class="material-symbols-outlined cursor-pointer text-slate-300 text-3xl" for="p4-1">star</label>
</div>
</div>
</div>
</section>
<section class="bg-white dark:bg-slate-800 rounded-2xl border border-[#dbe0e6] dark:border-slate-700 shadow-sm p-6">
<label class="block text-sm font-bold mb-2" for="comments">Comentarios Adicionales o Sugerencias</label>
<textarea class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-sm focus:ring-primary focus:border-primary" id="comments" placeholder="Cuéntanos más sobre tu experiencia o qué podríamos mejorar..." rows="4"></textarea>
</section>
<div class="flex flex-col md:flex-row gap-4 items-center justify-end pb-12">
<button class="w-full md:w-auto px-8 py-3 rounded-xl border border-[#dbe0e6] dark:border-slate-700 font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors" type="button">
                        Cancelar
                    </button>
<button class="w-full md:w-auto flex items-center justify-center gap-2 bg-primary hover:bg-blue-600 text-white font-bold py-3 px-12 rounded-xl transition-all shadow-lg shadow-primary/20" type="submit">
<span class="material-symbols-outlined">send</span>
                        Enviar Evaluación
                    </button>
</div>
</form>
</div>
</main>
<?php include("../include/footer-usuarios.php"); ?>