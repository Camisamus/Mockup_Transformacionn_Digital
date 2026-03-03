<?php 
$pageTitle = "Hoja de Vida del Emprendedor";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock para el emprendedor
$emprendedor = [
    "nombre" => "Creaciones Viña del Mar SpA",
    "rut" => "76.543.210-K",
    "representante" => "Juan Pérez",
    "email" => "contacto@creacionesvina.cl",
    "telefono" => "+56 9 8765 4321",
    "direccion" => "Viña del Mar, Chile",
    "rubro" => "Artesanía en Madera y Decoración",
    "estado" => "Activo",
    "ferias_total" => 32,
    "asistencia" => "96.8%",
    "calificacion" => "4.9/5.0",
    "sanciones" => 0
];
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                    "gob-danger": "#ef4444"
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal; font-style: normal; line-height: 1;
        display: inline-block; white-space: nowrap; word-wrap: normal;
        direction: ltr; -webkit-font-smoothing: antialiased;
        vertical-align: middle;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header Section de la Hoja de Vida -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="flex flex-col md:flex-row items-center gap-6 w-full">
            <div class="w-32 h-32 rounded-2xl bg-blue-50 text-primary-blue flex items-center justify-center border border-blue-100 relative group overflow-hidden">
                <span class="material-symbols-outlined text-6xl group-hover:scale-110 transition-transform">person</span>
                <div class="absolute bottom-0 w-full bg-primary-blue/80 text-white text-[10px] py-1 font-bold uppercase tracking-widest text-center">FOTO PERFIL</div>
            </div>
            <div class="text-center md:text-left space-y-2">
                <div class="flex items-center justify-center md:justify-start gap-3">
                    <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight"><?= $emprendedor['nombre'] ?></h1>
                    <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-emerald-200"><?= $emprendedor['estado'] ?></span>
                </div>
                <p class="text-slate-500 font-medium text-sm lg:text-base italic">RUT: <?= $emprendedor['rut'] ?> | <span class="text-primary-blue font-bold"><?= $emprendedor['rubro'] ?></span></p>
                <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-4">
                    <span class="flex items-center gap-1.5 text-slate-400 text-xs font-bold uppercase"><span class="material-symbols-outlined text-lg">mail</span> <?= $emprendedor['email'] ?></span>
                    <span class="flex items-center gap-1.5 text-slate-400 text-xs font-bold uppercase"><span class="material-symbols-outlined text-lg">call</span> <?= $emprendedor['telefono'] ?></span>
                    <span class="flex items-center gap-1.5 text-slate-400 text-xs font-bold uppercase"><span class="material-symbols-outlined text-lg">location_on</span> <?= $emprendedor['direccion'] ?></span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 w-full md:w-auto">
            <button class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">description</span> CERTIFICADO
            </button>
            <button class="bg-slate-800 hover:bg-black text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">edit</span> EDITAR FICHA
            </button>
        </div>
    </div>

    <!-- Stats Row similar a Hoja de Vida -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-2xl p-6 border-l-4 border-l-primary-blue">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-400 uppercase font-black tracking-widest text-[10px]">Total Ferias</span>
                <span class="material-symbols-outlined text-primary-blue">storefront</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800"><?= $emprendedor['ferias_total'] ?></h3>
            <p class="text-emerald-500 font-bold text-[10px] mt-1">+4 último trim.</p>
        </div>
        <div class="bg-white gob-card rounded-2xl p-6 border-l-4 border-l-gob-success">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-400 uppercase font-black tracking-widest text-[10px]">Asistencia</span>
                <span class="material-symbols-outlined text-gob-success">event_available</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800"><?= $emprendedor['asistencia'] ?></h3>
            <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2 overflow-hidden">
                <div class="bg-gob-success h-full" style="width: 96.8%"></div>
            </div>
        </div>
        <div class="bg-white gob-card rounded-2xl p-6 border-l-4 border-l-gob-warning">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-400 uppercase font-black tracking-widest text-[10px]">Calificación</span>
                <span class="material-symbols-outlined text-gob-warning">star</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800"><?= $emprendedor['calificacion'] ?></h3>
            <div class="flex gap-0.5 mt-2">
                <span class="material-symbols-outlined text-gob-warning text-xs">star</span>
                <span class="material-symbols-outlined text-gob-warning text-xs">star</span>
                <span class="material-symbols-outlined text-gob-warning text-xs">star</span>
                <span class="material-symbols-outlined text-gob-warning text-xs">star</span>
                <span class="material-symbols-outlined text-gob-warning text-xs">star</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-2xl p-6 border-l-4 border-l-primary-blue bg-gradient-to-br from-white to-blue-50/30">
            <div class="flex items-center justify-between mb-2">
                <span class="text-slate-400 uppercase font-black tracking-widest text-[10px]">Saldo de Puntos</span>
                <span class="material-symbols-outlined text-primary-blue">toll</span>
            </div>
            <div class="flex items-baseline gap-1">
                <h3 class="text-3xl font-black text-slate-800">21</h3>
                <span class="text-slate-400 text-xs font-bold">PTS</span>
            </div>
            <p class="text-[10px] font-bold mt-1">
                <span class="text-emerald-500">+14 recarga mensual</span>
            </p>
            <div class="mt-3 flex gap-2">
                <button class="flex-1 py-1.5 bg-primary-blue/10 hover:bg-primary-blue/20 text-primary-blue rounded-lg text-[9px] font-black uppercase transition-all">Historial Puntos</button>
                <button class="flex-1 py-1.5 bg-slate-800 text-white rounded-lg text-[9px] font-black uppercase transition-all" onclick="alert('Módulo de Ajuste Administrativo')">Ajustar</button>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Timeline Section -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white gob-card rounded-3xl p-8 space-y-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">history</span> Historial de Participación
                    </h3>
                    <button class="text-primary-blue font-bold text-[10px] uppercase tracking-wider hover:underline">Ver Todo</button>
                </div>

                <div class="relative pl-8 space-y-8 before:content-[''] before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                    <div class="relative">
                        <div class="absolute -left-[30px] top-1.5 size-4 rounded-full bg-gob-success border-4 border-white shadow-sm"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black text-gob-success uppercase tracking-widest">Finalizado</span>
                            <h4 class="text-base font-black text-slate-800">Feria de Emprendimiento "Viña de Primavera"</h4>
                            <p class="text-xs text-slate-400 font-medium">15 Oct - 22 Oct, 2023 | Plaza O'Higgins</p>
                            <div class="mt-3 bg-slate-50 p-4 rounded-2xl border border-slate-100 italic text-sm text-slate-600">
                                "Excelente disposición, stand muy bien decorado y cumplimiento de horarios impecable."
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[30px] top-1.5 size-4 rounded-full bg-primary-blue border-4 border-white shadow-sm"></div>
                        <div class="space-y-1">
                            <span class="text-[10px] font-black text-primary-blue uppercase tracking-widest">Aprobado</span>
                            <h4 class="text-base font-black text-slate-800">Feria Navideña Potencia Viña 2023</h4>
                            <p class="text-xs text-slate-400 font-medium">Asignación de Puesto: #12, Sector Artesanías.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="space-y-6">
            <!-- Documentation -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">folder_open</span> Documentación
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-gob-success">check_circle</span>
                        <div class="flex-1">
                            <p class="text-xs font-black text-slate-800 tracking-tight">Actividades SII</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Vigente</p>
                        </div>
                        <button class="material-symbols-outlined text-slate-300 hover:text-primary-blue">download</button>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-gob-warning">warning</span>
                        <div class="flex-1">
                            <p class="text-xs font-black text-slate-800 tracking-tight">Resolución Sanitaria</p>
                            <p class="text-[10px] font-bold text-gob-warning uppercase tracking-widest mt-0.5">Vence en 15 días</p>
                        </div>
                        <button class="material-symbols-outlined text-slate-300 hover:text-primary-blue">upload</button>
                    </div>
                </div>
                <button class="w-full py-3 rounded-xl border-2 border-primary-blue text-primary-blue font-black text-[10px] uppercase tracking-widest hover:bg-primary-blue hover:text-white transition-all">
                    ACTUALIZAR CARPETA
                </button>
            </div>

            <!-- Internal Notes -->
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8 space-y-4">
                <h4 class="text-[10px] font-black text-primary-blue uppercase tracking-widest">Notas Administrativas</h4>
                <p class="text-sm text-blue-800 italic leading-relaxed font-black">
                    "El emprendedor ha solicitado espacio para taller de carpintería avanzada. Se recomienda para ferias de temática 'Hogar y Oficio'."
                </p>
                <button class="flex items-center gap-1 text-[10px] font-black text-primary-blue uppercase tracking-widest hover:underline">
                    <span class="material-symbols-outlined text-sm">edit</span> Editar nota interna
                </button>
            </div>
        </div>

    </div>

</div>

<?php include '../../api/general/footer.php'; ?>