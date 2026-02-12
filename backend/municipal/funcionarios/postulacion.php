<?php
include("../include/header-funcionarios.php");
?>
<header class="h-20 flex items-center justify-between border-b border-[#dbe0e6] dark:border-slate-800 bg-white dark:bg-slate-900 px-8 shrink-0 z-10">
    <div class="flex items-center gap-6 flex-1">
        <a href="pendientes.php" class="p-2 -ml-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-[#617589]">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div class="flex flex-col">
            <h2 class="text-lg font-bold tracking-tight">Detalle de Postulación Administrativa</h2>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-black text-[#617589] uppercase tracking-widest">ID: #4052</span>
                <span class="size-1 bg-[#617589] rounded-full"></span>
                <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded">EN REVISIÓN</span>
            </div>
        </div>
    </div>
    
    <div class="flex items-center gap-3">
        <button onclick="rejectPostulation()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-black text-danger hover:bg-danger/10 transition-all border border-transparent hover:border-danger/20">
            <span class="material-symbols-outlined text-lg">block</span>
            RECHAZAR
        </button>
        <button onclick="approvePostulation()" class="flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs font-black bg-success text-white hover:bg-emerald-600 transition-all shadow-lg shadow-success/30">
            <span class="material-symbols-outlined text-lg">verified</span>
            APROBAR POSTULACIÓN
        </button>
        <div class="w-px h-8 bg-[#dbe0e6] dark:bg-slate-800 mx-2"></div>
        <button class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 text-[#617589] hover:text-primary transition-all border border-[#dbe0e6] dark:border-slate-700">
            <span class="material-symbols-outlined">notifications</span>
        </button>
    </div>
</header>
<div class="flex-1 overflow-y-auto custom-scrollbar p-8">
<div class="max-w-6xl mx-auto space-y-8">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<section class="section-card">
<div class="flex items-center gap-3 mb-6 border-b border-background-light dark:border-slate-800 pb-4">
<span class="material-symbols-outlined text-primary">person</span>
<h3 class="text-lg font-bold">Datos del Emprendedor</h3>
</div>
<div class="grid grid-cols-2 gap-y-6 gap-x-4">
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Nombre Completo</label>
<p class="text-sm font-semibold">Carolina Andrea Valdivia Soto</p>
</div>
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">RUT</label>
<p class="text-sm font-semibold">16.842.331-K</p>
</div>
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Correo Electrónico</label>
<p class="text-sm font-semibold">carolina.valdivia@email.com</p>
</div>
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Teléfono de Contacto</label>
<p class="text-sm font-semibold">+56 9 8472 1192</p>
</div>
<div class="col-span-2">
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Dirección Particular</label>
<p class="text-sm font-semibold">Av. Libertad 1240, Depto 402, Viña del Mar</p>
</div>
</div>
</section>
<section class="section-card">
<div class="flex items-center gap-3 mb-6 border-b border-background-light dark:border-slate-800 pb-4">
<span class="material-symbols-outlined text-primary">storefront</span>
<h3 class="text-lg font-bold">Información del Negocio</h3>
</div>
<div class="grid grid-cols-2 gap-y-6 gap-x-4">
<div class="col-span-2">
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Nombre Fantasía</label>
<p class="text-sm font-semibold">Artesanías Mar del Norte</p>
</div>
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Rubro / Categoría</label>
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">Artesanía Manual</span>
</div>
<div>
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Años de Actividad</label>
<p class="text-sm font-semibold">4 años</p>
</div>
<div class="col-span-2">
<label class="block text-[10px] font-bold text-[#617589] uppercase mb-1">Descripción de Productos</label>
<p class="text-sm text-[#4a5568] dark:text-slate-300 leading-relaxed">
                                    Confección de artículos decorativos a base de madera reciclada y conchas recolectadas en el borde costero de la V Región. Proceso 100% artesanal y sustentable.
                                </p>
</div>
</div>
</section>
</div>
<section class="section-card">
<div class="flex items-center justify-between mb-6 border-b border-background-light dark:border-slate-800 pb-4">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">description</span>
<h3 class="text-lg font-bold">Documentos Adjuntos</h3>
</div>
<span class="text-xs text-[#617589] font-medium">4 archivos cargados</span>
</div>
<div class="grid grid-cols-1 xl:grid-cols-4 gap-4">
<div class="border border-[#dbe0e6] dark:border-slate-800 rounded-lg overflow-hidden group hover:border-primary/50 transition-colors">
<div class="aspect-[4/3] bg-slate-100 dark:bg-slate-800 flex items-center justify-center relative">
<span class="material-symbols-outlined text-slate-400 text-5xl">picture_as_pdf</span>
<div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
<button class="bg-white text-primary p-2 rounded-full shadow-lg">
<span class="material-symbols-outlined">zoom_in</span>
</button>
</div>
</div>
<div class="p-3 bg-white dark:bg-slate-900 flex items-center justify-between">
<div>
<p class="text-xs font-bold truncate">Cédula_Identidad.pdf</p>
<p class="text-[9px] text-[#617589] uppercase">1.2 MB • Frente y Dorso</p>
</div>
<span class="material-symbols-outlined text-success text-sm">verified</span>
</div>
</div>
<div class="border border-[#dbe0e6] dark:border-slate-800 rounded-lg overflow-hidden group hover:border-primary/50 transition-colors">
<div class="aspect-[4/3] bg-slate-100 dark:bg-slate-800 flex items-center justify-center relative">
<div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDc4ZqX-6y0xFdTb6By5dC4iADB7qWG54fKmzTFAUCngobmEWlH0cmTcwrHxmu9Rsos7ZaS2UATfXK1bOtp-ruelkxsyI0Ko5ocATQcFDquqA8fu1esL_81SPy_Os6MTq6BxJcRluDH3c-4ffycV1kRVK8Y1K_N6SpIwIPo8Dcxfz9zfTtyvwzvDnMesUX-eVSl9IhOfVRwZkKIzpyceDS3W9UXoj3FN63l0GZe-3mQHm6i68brMQ62-Ow9BasKVvLdijvqL5XoCXbp');"></div>
<div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
<button class="bg-white text-primary p-2 rounded-full shadow-lg">
<span class="material-symbols-outlined">zoom_in</span>
</button>
</div>
</div>
<div class="p-3 bg-white dark:bg-slate-900 flex items-center justify-between">
<div>
<p class="text-xs font-bold truncate">Patente_Municipal_2023.jpg</p>
<p class="text-[9px] text-[#617589] uppercase">2.4 MB • Vigente</p>
</div>
<span class="material-symbols-outlined text-success text-sm">verified</span>
</div>
</div>
<div class="border border-[#dbe0e6] dark:border-slate-800 rounded-lg overflow-hidden group hover:border-primary/50 transition-colors">
<div class="aspect-[4/3] bg-slate-100 dark:bg-slate-800 flex items-center justify-center relative">
<span class="material-symbols-outlined text-slate-400 text-5xl">inventory</span>
<div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
<button class="bg-white text-primary p-2 rounded-full shadow-lg">
<span class="material-symbols-outlined">zoom_in</span>
</button>
</div>
</div>
<div class="p-3 bg-white dark:bg-slate-900 flex items-center justify-between">
<div>
<p class="text-xs font-bold truncate">Iniciacion_Actividades.pdf</p>
<p class="text-[9px] text-[#617589] uppercase">850 KB • SII</p>
</div>
<span class="material-symbols-outlined text-success text-sm">verified</span>
</div>
</div>
<div class="border border-[#dbe0e6] dark:border-slate-800 rounded-lg overflow-hidden group hover:border-primary/50 transition-colors">
<div class="aspect-[4/3] bg-slate-100 dark:bg-slate-800 flex items-center justify-center relative">
<span class="material-symbols-outlined text-slate-400 text-5xl">feed</span>
<div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
<button class="bg-white text-primary p-2 rounded-full shadow-lg">
<span class="material-symbols-outlined">zoom_in</span>
</button>
</div>
</div>
<div class="p-3 bg-white dark:bg-slate-900 flex items-center justify-between">
<div>
<p class="text-xs font-bold truncate">Certificado_Residencia.pdf</p>
<p class="text-[9px] text-[#617589] uppercase">1.1 MB • Reciente</p>
</div>
<span class="material-symbols-outlined text-success text-sm">verified</span>
</div>
</div>
</div>
</section>
<section class="section-card">
<div class="flex items-center gap-3 mb-8 border-b border-background-light dark:border-slate-800 pb-4">
<span class="material-symbols-outlined text-primary">history</span>
<h3 class="text-lg font-bold">Historial de la Postulación</h3>
</div>
<div class="relative pl-8 space-y-8 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-[#dbe0e6] dark:before:bg-slate-800">
<div class="relative">
<div class="absolute -left-[27px] top-1.5 size-3.5 rounded-full border-2 border-white dark:border-slate-900 bg-primary"></div>
<div class="flex flex-col gap-1">
<div class="flex items-center gap-3">
<span class="text-xs font-bold">Postulación Recibida</span>
<span class="text-[10px] text-[#617589] font-medium uppercase">12 Oct 2024, 14:30</span>
</div>
<p class="text-xs text-[#617589]">Ingresada exitosamente a través del portal ciudadano por el usuario.</p>
</div>
</div>
<div class="relative">
<div class="absolute -left-[27px] top-1.5 size-3.5 rounded-full border-2 border-white dark:border-slate-900 bg-warning"></div>
<div class="flex flex-col gap-1">
<div class="flex items-center gap-3">
<span class="text-xs font-bold">Estado cambiado a: En Revisión</span>
<span class="text-[10px] text-[#617589] font-medium uppercase">13 Oct 2024, 09:15</span>
</div>
<p class="text-xs text-[#617589]">Asignada automáticamente al departamento de Fomento Productivo.</p>
<div class="mt-2 p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg text-xs italic text-[#617589] border border-slate-200 dark:border-slate-800">
                                    "Documentación inicial parece completa, proceder a verificar vigencia de patente municipal." - Asignado a Depto. Jurídico.
                                </div>
</div>
</div>
<div class="relative">
<div class="absolute -left-[27px] top-1.5 size-3.5 rounded-full border-2 border-white dark:border-slate-900 bg-slate-400"></div>
<div class="flex flex-col gap-1">
<div class="flex items-center gap-3">
<span class="text-xs font-bold">Documentos Verificados</span>
<span class="text-[10px] text-[#617589] font-medium uppercase">13 Oct 2024, 11:40</span>
</div>
<p class="text-xs text-[#617589]">Validación técnica de archivos PDF finalizada por J. Soto.</p>
</div>
</div>
</div>
</section>
<div class="h-12"></div> 
</div>
</div>
<script>
function approvePostulation() {
    Swal.fire({
        title: '¿Aprobar Postulación?',
        text: "Esta acción marcará al emprendedor como habilitado para reservar ferias.",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#617589',
        confirmButtonText: 'Sí, aprobar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '¡Postulación Aprobada!',
                text: 'El emprendedor ya puede realizar sus reservas.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pendientes.php';
            });
        }
    });
}

function rejectPostulation() {
    Swal.fire({
        title: 'Rechazar Postulación',
        text: "Se notificará al usuario de los motivos. Por favor, especifica la razón:",
        input: 'textarea',
        inputPlaceholder: 'Escribe el motivo del rechazo aquí...',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#617589',
        confirmButtonText: 'Confirmar Rechazo',
        cancelButtonText: 'Volver'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Postulación Rechazada',
                text: 'Se ha enviado la notificación al usuario.',
                icon: 'error',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'pendientes.php';
            });
        }
    });
}
</script>
<?php include("../include/footer-funcionarios.php"); ?>