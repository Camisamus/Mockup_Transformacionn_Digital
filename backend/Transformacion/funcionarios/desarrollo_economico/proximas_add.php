<?php 
$pageTitle = "Configurar Nueva Convocatoria - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 
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

    .input-premium {
        @apply w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm bg-slate-50/50 p-2.5 transition-all;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header / Action Bar -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <nav class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                <a href="proximas.php" class="hover:text-primary-blue">Próximas Actividades</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-primary-blue">Nueva Convocatoria</span>
            </nav>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Planificar Nueva Feria/Actividad</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium tracking-wider italic">Configure los parámetros para la apertura de nuevas vacantes en espacios públicos.</p>
        </div>
        <div class="flex gap-3 w-full md:w-auto">
            <button class="bg-white border-2 border-slate-200 hover:border-slate-300 text-slate-600 font-bold py-3 px-8 rounded-xl transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">drafts</span> GUARDAR BORRADOR
            </button>
            <button id="btnPublicar" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">publish</span> PUBLICAR AHORA
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Form Config -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Step 1: Ubicación -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">pin_drop</span> 1. Ubicación y Espacio
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Espacio Público</label>
                        <select class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3 bg-slate-50">
                            <option>Seleccione un lugar...</option>
                            <option value="1">Plaza Vergara</option>
                            <option value="2">Plaza México</option>
                            <option value="3">Muelle Vergara</option>
                            <option value="4">Quinta Vergara</option>
                        </select>
                    </div>
                    <div class="rounded-2xl overflow-hidden border border-slate-100 h-40 relative group">
                        <img src="https://images.unsplash.com/photo-1577083552431-6e5fd01aa342?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" />
                        <div class="absolute inset-0 bg-primary-blue/10 flex items-center justify-center">
                            <span class="bg-white/90 px-4 py-2 rounded-full text-[10px] font-black text-primary-blue shadow-lg">MAPA DE DISTRIBUCIÓN</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Periodo -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">calendar_month</span> 2. Periodo de Ejecución
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Mes de Planificación</label>
                        <input type="month" class="w-full rounded-xl border-slate-200 focus:ring-primary-blue text-sm p-3" value="2024-11">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Semana Inicio</label>
                        <select class="w-full rounded-xl border-slate-200 text-sm p-3">
                            <option>Semana 1</option>
                            <option>Semana 2</option>
                            <option>Semana 3</option>
                            <option>Semana 4</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Duración (Semanas)</label>
                        <input type="number" class="w-full rounded-xl border-slate-200 text-sm p-3" min="1" max="4" value="1">
                    </div>
                </div>
            </div>

            <!-- Step 3: Cupos -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-6">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">group</span> 3. Cupos por Rubro
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Artesanías</span>
                        <input type="number" class="w-16 rounded-xl border-slate-200 text-center font-black text-primary-blue text-sm" value="12">
                    </div>
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Gastronomía</span>
                        <input type="number" class="w-16 rounded-xl border-slate-200 text-center font-black text-primary-blue text-sm" value="5">
                    </div>
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Textil</span>
                        <input type="number" class="w-16 rounded-xl border-slate-200 text-center font-black text-primary-blue text-sm" value="8">
                    </div>
                    <div class="pt-4 border-t border-dashed border-slate-200 flex justify-between items-center">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Vacantes</span>
                        <span class="text-2xl font-black text-primary-blue">25</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Visual & Window -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Calendar View -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-8">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">view_timeline</span> Visualización de Programación
                    </h3>
                    <div class="flex bg-slate-100 p-1 rounded-xl">
                        <button class="px-4 py-1.5 text-[10px] font-black uppercase rounded-lg bg-white shadow-sm text-primary-blue">Mensual</button>
                        <button class="px-4 py-1.5 text-[10px] font-black uppercase text-slate-400">Semanal</button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-px bg-slate-100 border border-slate-100 rounded-2xl overflow-hidden shadow-inner">
                    <!-- Week Headers -->
                    <?php $days = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom']; foreach($days as $d): ?>
                    <div class="bg-white p-3 text-center text-[10px] font-black uppercase tracking-widest text-slate-400"><?= $d ?></div>
                    <?php endforeach; ?>

                    <!-- Empty Days -->
                    <div class="bg-white h-24 p-2 text-slate-300 text-[10px]">28</div>
                    <div class="bg-white h-24 p-2 text-slate-300 text-[10px]">29</div>
                    <div class="bg-white h-24 p-2 text-slate-300 text-[10px]">30</div>
                    <div class="bg-white h-24 p-2 text-slate-300 text-[10px]">31</div>

                    <!-- Nov 1st to 3rd -->
                    <div class="bg-white h-24 p-3"><span class="text-[10px] font-black text-slate-400">01</span></div>
                    <div class="bg-white h-24 p-3"><span class="text-[10px] font-black text-slate-400">02</span></div>
                    <div class="bg-white h-24 p-3"><span class="text-[10px] font-black text-slate-400 text-rose-400">03</span></div>

                    <!-- Selected Week -->
                    <div class="bg-blue-50 h-24 p-3 border-y-2 border-primary-blue relative group cursor-pointer">
                        <span class="text-[10px] font-black text-primary-blue">04</span>
                        <div class="mt-2 bg-primary-blue text-white text-[8px] p-2 rounded-lg font-black uppercase tracking-widest leading-none">Nueva Feria Plaza Vergara</div>
                    </div>
                    <?php for($i=5; $i<=10; $i++): ?>
                    <div class="bg-blue-50 h-24 p-3 border-y-2 border-primary-blue">
                        <span class="text-[10px] font-black text-primary-blue"><?= sprintf("%02d", $i) ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Configuration Window -->
            <div class="bg-white gob-card rounded-3xl p-8 space-y-8">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">app_registration</span> 4. Ventana de Postulación
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-3xl bg-blue-50 border border-blue-100 space-y-3">
                        <div class="flex items-center gap-2 text-primary-blue">
                            <span class="material-symbols-outlined">event_upcoming</span>
                            <span class="text-[10px] font-black uppercase tracking-widest">Apertura</span>
                        </div>
                        <input type="datetime-local" class="w-full bg-white rounded-xl border-blue-100 p-3 font-black text-sm text-slate-800" value="2024-10-25T09:00">
                    </div>
                    <div class="p-6 rounded-3xl bg-rose-50 border border-rose-100 space-y-3">
                        <div class="flex items-center gap-2 text-rose-500">
                            <span class="material-symbols-outlined">event_busy</span>
                            <span class="text-[10px] font-black uppercase tracking-widest">Cierre Fatal</span>
                        </div>
                        <input type="datetime-local" class="w-full bg-white rounded-xl border-rose-100 p-3 font-black text-sm text-slate-800" value="2024-10-31T23:59">
                    </div>
                </div>

                <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="material-symbols-outlined text-slate-400">info</span>
                    <p class="text-[13px] text-slate-500 italic leading-relaxed">
                        Al publicar esta convocatoria, el sistema enviará automáticamente una notificación a los <strong>142 emprendedores</strong> registrados en el catastro y habilitará el botón de postulación en la plataforma pública.
                    </p>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#btnPublicar').click(function () {
            Swal.fire({
                title: '¿Publicar Convocatoria?',
                text: "Esta acción habilitará las postulaciones en el portal público y notificará a los usuarios.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1a5f9c',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'SÍ, PUBLICAR',
                cancelButtonText: 'CANCELAR'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('¡Publicado!', 'La convocatoria ya está visible para los ciudadanos.', 'success')
                    .then(() => {
                        window.location.href = 'proximas.php';
                    });
                }
            });
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>
