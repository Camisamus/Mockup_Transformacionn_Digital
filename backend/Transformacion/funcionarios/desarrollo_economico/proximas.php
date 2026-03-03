<?php 
$pageTitle = "Próximas Actividades - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock de próximas actividades
$actividades = [
    [
        "fecha" => "2024-03-25",
        "hora" => "10:30",
        "nombre" => "Feria de Emprendimiento Local",
        "lugar" => "Plaza de Viña del Mar",
        "tipo" => "Feria",
        "cupos" => "50/60",
        "estado" => "Próximo"
    ],
    [
        "fecha" => "2024-04-02",
        "hora" => "15:00",
        "nombre" => "Taller de Modelo de Negocios Canvas",
        "lugar" => "Sala de Cowork Central",
        "tipo" => "Taller",
        "cupos" => "12/20",
        "estado" => "Inscripciones Abiertas"
    ],
    [
        "fecha" => "2024-04-10",
        "hora" => "09:00",
        "nombre" => "Charla Informativa Fondos Concursables",
        "lugar" => "Auditorio Municipal",
        "tipo" => "Charla",
        "cupos" => "80/100",
        "estado" => "Próximo"
    ],
    [
        "fecha" => "2024-04-15",
        "hora" => "11:00",
        "nombre" => "Webinar: Marketing Digital para Pymes",
        "lugar" => "Vía Zoom",
        "tipo" => "Online",
        "cupos" => "150/200",
        "estado" => "Inscripciones Abiertas"
    ]
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

    .status-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-proximo { background: #e3f2fd; color: #1a5f9c; }
    .badge-inscripciones { background: #e8f5e9; color: #2e7d32; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Próximas Actividades</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Agenda de fomento, capacitación y eventos municipales</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='proximas_add.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span> CREAR CONVOCATORIA
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Actividades del Mes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">18</h3>
                <span class="text-emerald-500 font-bold text-xs uppercase">Programadas</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Inscritos</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">214</h3>
                <span class="text-slate-400 font-bold text-xs uppercase">Histórico</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Cupos Disponibles</p>
            <div class="flex items-end justify-between">
                <h3 class="text-2xl font-extrabold text-slate-800 mb-0">45%</h3>
                <span class="text-emerald-500 font-bold text-xs">Ocupación</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Próximo Cierre</p>
            <div class="flex items-end justify-between">
                <h3 class="text-xl font-extrabold text-slate-800 mb-0">Hoy 18:00</h3>
                <span class="text-rose-500 font-bold text-xs uppercase italic">Inscripción</span>
            </div>
        </div>
    </div>

    <!-- Timeline/List of Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <?php foreach ($actividades as $act): ?>
        <div class="bg-white gob-card rounded-2xl overflow-hidden hover:shadow-lg transition-all border border-slate-100 p-6 flex flex-col md:flex-row gap-6 items-center">
            <div class="flex-shrink-0 w-full md:w-32 h-32 rounded-2xl bg-slate-50 flex flex-col items-center justify-center border border-slate-100">
                <span class="text-primary-blue font-black text-3xl"><?= date('d', strtotime($act['fecha'])) ?></span>
                <span class="text-slate-400 text-xs font-black uppercase tracking-widest"><?= date('M', strtotime($act['fecha'])) ?></span>
                <span class="bg-primary-blue text-white px-3 py-1 rounded-full text-[10px] mt-2 font-bold"><?= $act['hora'] ?></span>
            </div>

            <div class="flex-grow space-y-2 text-center md:text-left">
                <div class="flex flex-col md:flex-row md:items-center gap-3">
                    <h4 class="font-black text-slate-800 text-xl tracking-tight leading-none"><?= $act['nombre'] ?></h4>
                    <?php 
                    $statusClass = 'badge-proximo';
                    if ($act['estado'] == 'Inscripciones Abiertas') $statusClass = 'badge-inscripciones';
                    ?>
                    <div class="flex justify-center md:justify-start">
                        <span class="status-badge <?= $statusClass ?>"><?= $act['estado'] ?></span>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 pt-2">
                    <p class="text-slate-500 text-sm flex items-center justify-center md:justify-start gap-1 font-bold">
                        <span class="material-symbols-outlined text-slate-400 text-lg">location_on</span> <?= $act['lugar'] ?>
                    </p>
                    <p class="text-slate-500 text-sm flex items-center justify-center md:justify-start gap-1 font-bold">
                        <span class="material-symbols-outlined text-slate-400 text-lg">category</span> <?= $act['tipo'] ?>
                    </p>
                    <p class="text-slate-500 text-sm flex items-center justify-center md:justify-start gap-1 font-bold">
                        <span class="material-symbols-outlined text-slate-400 text-lg">group</span> Cupos: <?= $act['cupos'] ?>
                    </p>
                </div>
            </div>

            <div class="flex-shrink-0 flex flex-col gap-2 w-full md:w-auto">
                <button class="px-8 py-3 rounded-xl bg-slate-800 text-white font-black text-xs uppercase tracking-widest hover:bg-black transition-all">
                    LISTA INSCRITOS
                </button>
                <button class="px-8 py-3 rounded-xl border-2 border-slate-100 text-slate-600 font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition-all">
                    GESTIONAR
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('button').click(function () {
            const btnText = $(this).text().trim();
            if (btnText === 'LISTA INSCRITOS' || btnText === 'GESTIONAR') {
                Swal.fire({
                    title: 'Gestión de Actividad',
                    text: 'Accediendo al panel de administración de eventos...',
                    icon: 'info',
                    confirmButtonColor: '#1a5f9c'
                });
            }
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>