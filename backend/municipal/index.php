<?php

include("include/header.php");

?>

<main class="flex-1 flex items-center justify-center p-6">
<div class="w-full max-w-[520px] bg-white dark:bg-slate-900 shadow-2xl rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800">
<div class="pt-10 pb-4">
<div class="flex justify-center mb-4">
<div class="bg-primary/10 p-3 rounded-full">
<span class="material-symbols-outlined text-primary text-3xl">shield_lock</span>
</div>
</div>
<h1 class="text-slate-900 dark:text-white tracking-tight text-[28px] font-bold leading-tight px-4 text-center">Portal de Acceso y Seguridad</h1>
<p class="text-slate-500 dark:text-slate-400 text-sm text-center mt-2">Gestión de ferias y uso de espacio público</p>
</div>
<div class="px-6">
<div class="flex border-b border-slate-200 dark:border-slate-700 gap-8 justify-center">
<a class="flex flex-col items-center justify-center border-b-[3px] border-primary text-primary pb-3 pt-4 transition-all" href="#">
<p class="text-sm font-bold leading-normal tracking-wide">Emprendedor</p>
</a>
<a class="flex flex-col items-center justify-center border-b-[3px] border-transparent text-slate-400 dark:text-slate-500 pb-3 pt-4 hover:text-slate-600 dark:hover:text-slate-300 transition-all" href="#">
<p class="text-sm font-bold leading-normal tracking-wide">Funcionario</p>
</a>
</div>
</div>
<div class="p-8 space-y-6">
<div class="flex flex-col gap-1.5">
<label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">RUT</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">badge</span>
<input class="form-input flex w-full rounded-lg text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:outline-0 focus:ring-2 focus:ring-primary/20 focus:border-primary h-12 pl-12 pr-4 placeholder:text-slate-400 dark:placeholder:text-slate-600 text-base font-normal transition-all" placeholder="XX.XXX.XXX-X" type="text"/>
</div>
</div>
<div class="flex flex-col gap-1.5">
<div class="flex justify-between items-center">
<label class="text-slate-700 dark:text-slate-300 text-sm font-semibold leading-normal">Contraseña</label>
<a class="text-primary text-xs font-semibold hover:underline" href="#">¿Olvidé mi contraseña?</a>
</div>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
<input class="form-input flex w-full rounded-lg text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:outline-0 focus:ring-2 focus:ring-primary/20 focus:border-primary h-12 pl-12 pr-12 placeholder:text-slate-400 dark:placeholder:text-slate-600 text-base font-normal transition-all" placeholder="••••••••" type="password"/>
<button class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
<span class="material-symbols-outlined text-xl">visibility</span>
</button>
</div>
</div>
<div class="flex items-center gap-2">
<input class="w-4 h-4 rounded text-primary focus:ring-primary border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800" id="remember" type="checkbox"/>
<label class="text-sm text-slate-600 dark:text-slate-400 cursor-pointer" for="remember">Recordar dispositivo por 30 días</label>
</div>
<a href="usuarios/registrar.php" class="w-full flex items-center justify-center rounded-lg h-12 bg-primary text-white text-base font-bold tracking-wide shadow-lg shadow-primary/25 hover:bg-primary/90 hover:-translate-y-0.5 transition-all">
<span>Iniciar Sesión Usuario</span>
</a>

<a href="funcionarios/index.php" class="w-full flex items-center justify-center rounded-lg h-12 bg-primary text-white text-base font-bold tracking-wide shadow-lg shadow-primary/25 hover:bg-primary/90 hover:-translate-y-0.5 transition-all">
<span>Iniciar Sesión Funcionario</span>
</a>

<div class="flex items-start gap-3 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-lg">
<span class="material-symbols-outlined text-primary text-xl mt-0.5">info</span>
<p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Para recuperar su cuenta, necesitará acceso a su correo electrónico registrado para recibir un código de verificación de 6 dígitos.
                    </p>
</div>
</div>
<div class="h-2 bg-gradient-to-r from-primary via-blue-400 to-primary"></div>
</div>
</main>
<?php

include("include/footer.php");

?>