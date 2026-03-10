<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Evaluación de Participación - Municipio de Cuidados</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "success": "#10b981",
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
<style type="text/tailwindcss">
        body {
            font-family: 'Public Sans', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #fbbf24;
            font-variation-settings: 'FILL' 1;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#111418] dark:text-white font-display">
<div class="relative flex min-h-screen flex-col">
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-3">
<div class="flex items-center justify-center bg-primary/10 p-2 rounded-lg">
<span class="material-symbols-outlined text-primary text-2xl">location_city</span>
</div>
<div class="flex flex-col">
<h2 class="text-sm font-bold leading-tight uppercase tracking-wider text-primary">Municipio de Cuidados</h2>
<p class="text-[10px] font-medium text-[#617589]">Viña del Mar</p>
</div>
</div>
</div>
<div class="flex items-center gap-4">
<div class="flex flex-col items-end">
<p class="text-xs font-semibold text-[#617589]">Perfil Emprendedor</p>
<p class="text-sm font-bold text-primary">ID: 24.551-K</p>
</div>
<div class="h-10 w-px bg-[#dbe0e6] dark:bg-slate-700 mx-2"></div>
<button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
<span class="text-sm font-medium">Mi Cuenta</span>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8 border border-slate-200" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCKV_w90SJ6DnuOvmVxYTfRXxpxFsRIzZ2Ckea8yTfgQC7TF4WJu4zpIXRkBTwcBHVfFts4pmUGwZJGpFHCNK30rktZbDdfeMV6xWOgpudb5yjCXr7fOYB9uTvK815Hx738eRbUjUc1rtPlUcBtbV1RjcDs1gAch7x4c7fuBFLPZ7On6qtMxsWFfeBRwxUtxNys1vrJiDZzwmOcqR0AMmficJxVV_CrWvR8YYd166akAFrwW3kNDCAJ1Q37llxNS1gsC5wWlA9tBOS3");'></div>
</button>
</div>
</header>
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
<footer class="mt-auto border-t border-[#dbe0e6] dark:border-slate-700 bg-white dark:bg-background-dark py-8">
<div class="max-w-[1200px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[#617589] text-sm">
<div class="flex items-center gap-4">
<div class="flex flex-col">
<p class="font-bold text-[#111418] dark:text-white">Municipio de Cuidados</p>
<p>© 2023 Sistema de Gestión de Espacios Públicos - Viña del Mar.</p>
</div>
</div>
<div class="flex gap-6">
<a class="hover:text-primary transition-colors" href="#">Reglamento de Ferias</a>
<a class="hover:text-primary transition-colors" href="#">Soporte Técnico</a>
<a class="hover:text-primary transition-colors" href="#">Contacto Municipal</a>
</div>
</div>
</footer>
</div>

</body></html>