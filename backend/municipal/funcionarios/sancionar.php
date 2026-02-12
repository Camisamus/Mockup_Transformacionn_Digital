<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Expediente Digital del Emprendedor - Viña del Mar</title>
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
<style type="text/tailwindcss">
        body {
            font-family: 'Public Sans', sans-serif;
        }
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen text-[#111418] dark:text-white relative overflow-hidden">
<div class="fixed inset-0 z-[60] flex items-center justify-center p-4 backdrop-blur-sm bg-black/40">
<div class="bg-white dark:bg-[#1a2632] w-full max-w-lg rounded-xl shadow-2xl border border-[#dbe0e6] dark:border-[#2a343f] overflow-hidden">
<div class="px-6 py-4 border-b border-[#f0f2f4] dark:border-[#2a343f] flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded size-8" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCeaHUp0QXwm85C0Us_4E6bnwtYnRwvzcQKyg5rdmm3VaRM4rll3Elt1IofBmx0e3ekdXWcqbeDgiIVPQ_ZlAZEC-XIqXQxRMp3XHvsgsR0yeZRoMisSllTIQbrY1Muh_TSj-G_4sJ7nbLdojdn2u2PuqUNQgKaXcU7jMoY0vI6rqgtmOTVKprlvjDLddBtq2OscbShnQBpwKwf3iHn3vV80nA6jI0vPpRaecFah69pbFZ4GPyq_RxE9P1ACG9zefyGuLdkGX8fa41R");'></div>
<h2 class="text-lg font-bold">Registrar Nueva Sanción</h2>
</div>
<button class="text-[#617589] hover:text-[#111418] dark:hover:text-white">
<span class="material-symbols-outlined">close</span>
</button>
</div>
<div class="p-6 space-y-5">
<div class="space-y-2">
<label class="text-sm font-semibold text-[#111418] dark:text-gray-200">Tipo de Sanción</label>
<select class="w-full rounded-lg border-[#dbe0e6] dark:border-[#2a343f] bg-white dark:bg-[#2a343f] text-sm focus:ring-primary focus:border-primary">
<option disabled="" selected="" value="">Seleccione un tipo...</option>
<option value="inasistencia">Inasistencia injustificada</option>
<option value="incumplimiento">Incumplimiento de rubro</option>
<option value="comportamiento">Comportamiento indebido</option>
</select>
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-[#111418] dark:text-gray-200">Duración</label>
<div class="grid grid-cols-3 gap-3">
<label class="relative flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-[#364350] border-[#dbe0e6] dark:border-[#2a343f]">
<input class="sr-only" name="duration" type="radio" value="1m"/>
<span class="text-sm font-medium">1 mes</span>
</label>
<label class="relative flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-[#364350] border-[#dbe0e6] dark:border-[#2a343f]">
<input class="sr-only" name="duration" type="radio" value="3m"/>
<span class="text-sm font-medium">3 meses</span>
</label>
<label class="relative flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-[#364350] border-[#dbe0e6] dark:border-[#2a343f]">
<input class="sr-only" name="duration" type="radio" value="perm"/>
<span class="text-sm font-medium">Permanente</span>
</label>
</div>
</div>
<div class="space-y-2">
<label class="text-sm font-semibold text-[#111418] dark:text-gray-200">Descripción y Motivo</label>
<textarea class="w-full rounded-lg border-[#dbe0e6] dark:border-[#2a343f] bg-white dark:bg-[#2a343f] text-sm focus:ring-primary focus:border-primary placeholder:text-gray-400" placeholder="Detalle los motivos de la sanción..." rows="4"></textarea>
</div>
<div class="flex items-center gap-3">
<input class="rounded border-[#dbe0e6] dark:border-[#2a343f] text-primary focus:ring-primary" id="notify" type="checkbox"/>
<label class="text-sm text-[#617589] dark:text-gray-300" for="notify">Notificar automáticamente por correo al emprendedor</label>
</div>
</div>
<div class="px-6 py-4 bg-gray-50 dark:bg-[#242f3a] flex items-center justify-end gap-3">
<button class="px-5 py-2 text-sm font-bold text-[#617589] hover:text-[#111418] dark:hover:text-white transition-colors">
                    Cancelar
                </button>
<button class="px-5 py-2 text-sm font-bold bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                    Confirmar Sanción
                </button>
</div>
</div>
</div>
<div class="opacity-40 pointer-events-none select-none">
<header class="flex items-center justify-between border-b border-solid border-b-[#f0f2f4] dark:border-b-[#2a343f] bg-white dark:bg-[#1a2632] px-10 py-3 sticky top-0 z-50">
<div class="flex items-center gap-8">
<div class="flex items-center gap-4">
<div class="size-8 text-primary">
<svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z"></path>
</svg>
</div>
<h2 class="text-lg font-bold">Expediente Digital</h2>
</div>
</div>
</header>
<div class="flex max-w-[1440px] mx-auto">
<aside class="w-64 min-h-[calc(100vh-64px)] bg-white dark:bg-[#1a2632] border-r border-[#f0f2f4] dark:border-[#2a343f] p-4 lg:flex flex-col">
<div class="flex gap-3 items-center mb-4">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCeaHUp0QXwm85C0Us_4E6bnwtYnRwvzcQKyg5rdmm3VaRM4rll3Elt1IofBmx0e3ekdXWcqbeDgiIVPQ_ZlAZEC-XIqXQxRMp3XHvsgsR0yeZRoMisSllTIQbrY1Muh_TSj-G_4sJ7nbLdojdn2u2PuqUNQgKaXcU7jMoY0vI6rqgtmOTVKprlvjDLddBtq2OscbShnQBpwKwf3iHn3vV80nA6jI0vPpRaecFah69pbFZ4GPyq_RxE9P1ACG9zefyGuLdkGX8fa41R");'></div>
<div class="flex flex-col">
<h1 class="text-sm font-bold truncate">Municipio de Cuidados</h1>
<p class="text-[#617589] text-xs">Viña del Mar</p>
</div>
</div>
</aside>
<main class="flex-1 flex flex-col gap-6 p-8">
<div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f] p-6">
<div class="flex justify-between items-center">
<div class="flex gap-6">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-xl h-28 w-28 border border-[#dbe0e6] dark:border-[#2a343f]" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCA736bd43Us9iHRAdMJRfQ05OlPD-RqupBWf9NkNQptdKZcOoRl4O54vCWekXwS7nANzaplLSreRI-3fd-xAFyZnPzeek_ZskyT4xu7weU63ZNY3sRkvRNH3bYtlGUiKTk5cuDgad-MGRo01tG1Bogxl_1bwNSv1xnkEv7snfQG0JZob1iAci7eRivHSJH_RIh1NQiodGVc6qa4aTSFf3QKkn6E2n48p9q-cfOjjSHzLnmoke6l-numr-Ig79WJHRkQnxFDdGYp5Ae");'></div>
<div>
<h2 class="text-2xl font-bold">Artesanías Mar del Plata</h2>
<p class="text-[#617589] text-sm mt-1">RUT: 77.654.321-K | Orfebrería</p>
</div>
</div>
</div>
</div>
<div class="grid grid-cols-2 gap-4">
<div class="h-32 bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f]"></div>
<div class="h-32 bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f]"></div>
</div>
<div class="bg-white dark:bg-[#1a2632] rounded-xl border border-[#dbe0e6] dark:border-[#2a343f] h-96"></div>
</main>
</div>
</div>

</body></html>