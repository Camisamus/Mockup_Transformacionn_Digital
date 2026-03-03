<?php 
$pageTitle = "Gestión de Espacios - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock de espacios
$espacios = [
    [
        "id" => "ESP-01",
        "nombre" => "Sala de Cowork Central",
        "ubicación" => "Piso 1, Edificio Consistorial",
        "capacidad" => "12 Personas",
        "tipo" => "Abierto",
        "estado" => "Disponible"
    ],
    [
        "id" => "ESP-02",
        "nombre" => "Sala de Reuniones A",
        "ubicación" => "Piso 2, Edificio Consistorial",
        "capacidad" => "6 Personas",
        "tipo" => "Privado",
        "estado" => "Reservado"
    ],
    [
        "id" => "ESP-03",
        "nombre" => "Taller de Prototipado",
        "ubicación" => "Anexo 5 Oriente",
        "capacidad" => "8 Personas",
        "tipo" => "Técnico",
        "estado" => "Mantenimiento"
    ],
    [
        "id" => "ESP-04",
        "nombre" => "Auditorio de Capacitación",
        "ubicación" => "Piso 1, Edificio Consistorial",
        "capacidad" => "40 Personas",
        "tipo" => "Evento",
        "estado" => "Disponible"
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
    .badge-disponible { background: #e8f5e9; color: #2e7d32; }
    .badge-reservado { background: #fff3e0; color: #ef6c00; }
    .badge-mantenimiento { background: #ffebee; color: #c62828; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Gestión de Espacios</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Administración de áreas de trabajo y salas de capacitación</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add_home</span> NUEVO ESPACIO
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Espacios Disponibles</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">12</h3>
                <span class="text-emerald-500 font-bold text-xs">Uso inmediato</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Reservas para Hoy</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">5</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Confirmadas</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Usuarios del Mes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">84</h3>
                <span class="text-slate-400 font-bold text-xs uppercase">+15% crec.</span>
            </div>
        </div>
    </div>

    <!-- Grid de Espacios -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($espacios as $esp): ?>
        <div class="bg-white gob-card rounded-2xl overflow-hidden hover:shadow-lg transition-all border border-slate-100">
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-start">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-primary-blue flex items-center justify-center border border-blue-100">
                        <span class="material-symbols-outlined text-2xl">
                            <?php 
                            if ($esp['tipo'] == 'Abierto') echo 'meeting_room';
                            elseif ($esp['tipo'] == 'Privado') echo 'domain';
                            elseif ($esp['tipo'] == 'Técnico') echo 'build';
                            else echo 'groups';
                            ?>
                        </span>
                    </div>
                    <?php 
                    $statusClass = 'badge-disponible';
                    if ($esp['estado'] == 'Reservado') $statusClass = 'badge-reservado';
                    if ($esp['estado'] == 'Mantenimiento') $statusClass = 'badge-mantenimiento';
                    ?>
                    <span class="status-badge <?= $statusClass ?>"><?= $esp['estado'] ?></span>
                </div>
                
                <div>
                    <h4 class="font-black text-slate-800 text-lg leading-tight"><?= $esp['nombre'] ?></h4>
                    <p class="text-slate-400 text-xs mt-1 flex items-center gap-1 font-medium">
                        <span class="material-symbols-outlined text-sm">location_on</span> <?= $esp['ubicación'] ?>
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-50 flex justify-between items-center text-[13px] font-bold text-slate-500">
                    <span class="flex items-center gap-1 font-black"><span class="material-symbols-outlined text-sm">person</span> <?= $esp['capacidad'] ?></span>
                    <span class="bg-slate-50 px-2 py-1 rounded text-[10px] uppercase tracking-widest"><?= $esp['tipo'] ?></span>
                </div>

                <button class="w-full mt-4 py-2.5 rounded-xl border-2 border-primary-blue text-primary-blue font-black text-xs uppercase tracking-widest hover:bg-primary-blue hover:text-white transition-all">
                    GESTIONAR RESERVA
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
            if ($(this).text().trim() === 'GESTIONAR RESERVA') {
                Swal.fire({
                    title: 'Portal de Reservas',
                    text: 'Conectando con el módulo de agenda municipal...',
                    icon: 'info',
                    confirmButtonColor: '#1a5f9c'
                });
            }
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>