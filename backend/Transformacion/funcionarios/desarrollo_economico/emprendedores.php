<?php 
$pageTitle = "Gestión de Emprendedores - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock basados en empresas_mock.json
$emprendedores = [
    [
        "rut" => "76.123.456-7",
        "nombre" => "Comercializadora Los Aromos SpA",
        "representante" => "Juan Pérez",
        "categoria" => "Comercio",
        "doc" => "Escritura.pdf",
        "estado" => "Activo"
    ],
    [
        "rut" => "77.987.654-3",
        "nombre" => "Servicios El Bosque E.I.R.L",
        "representante" => "María González",
        "categoria" => "Servicios",
        "doc" => "Poder.pdf",
        "estado" => "Activo"
    ],
    [
        "rut" => "78.456.123-9",
        "nombre" => "Artesanías Marinas Ltda",
        "representante" => "Pedro Soto",
        "categoria" => "Artesanía",
        "doc" => "Constitucion.pdf",
        "estado" => "Pendiente"
    ],
    [
        "rut" => "79.111.222-K",
        "nombre" => "Gastronomía Viñamarina",
        "representante" => "Ana Palma",
        "categoria" => "Gastronomía",
        "doc" => "Patente.pdf",
        "estado" => "Activo"
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
    .badge-activo { background: #e8f5e9; color: #2e7d32; }
    .badge-pendiente { background: #fff3e0; color: #ef6c00; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Catastro de Emprendedores</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Gestión integral de la red de fomento productivo</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">person_add</span> REGISTRAR EMPRENDEDOR
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Registrados</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">142</h3>
                <span class="text-emerald-500 font-bold text-xs">+12% mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Formalizados</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">87</h3>
                <span class="text-slate-400 font-bold text-xs uppercase">61% tasa</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Capacitados (2024)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">54</h3>
                <span class="text-emerald-500 font-bold text-xs">Vía OTEC</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Rubro Principal</p>
            <div class="flex items-end justify-between">
                <h3 class="text-xl font-extrabold text-slate-800 mb-0">Comercio</h3>
                <span class="text-slate-400 font-bold text-xs uppercase">Mayoría</span>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white gob-card rounded-2xl overflow-hidden p-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
            <div class="md:col-span-5 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Búsqueda (RUT / Nombre / Categoría)</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-slate-400 text-xl">search</span>
                    <input type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm bg-slate-50/50" placeholder="Escribe para buscar...">
                </div>
            </div>
            <div class="md:col-span-4 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Categoría / Rubro</label>
                <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                    <option>Todas las categorías</option>
                    <option>Comercio</option>
                    <option>Servicios</option>
                    <option>Artesanía</option>
                    <option>Gastronomía</option>
                    <option>Tecnología</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <button class="w-full py-2.5 rounded-xl bg-slate-800 text-white font-bold text-[11px] uppercase tracking-wider hover:bg-black transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">filter_alt</span> FILTRAR RED
                </button>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">groups</span> Emprendedores Registrados
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200"><?= count($emprendedores) ?> TOTAL</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Emprendedor / Empresa</th>
                        <th class="px-6 py-4">RUT</th>
                        <th class="px-6 py-4 text-center">Categoría</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-600">
                    <?php foreach ($emprendedores as $e): ?>
                    <tr class="hover:bg-slate-50/80 transition-all cursor-pointer">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-primary-blue flex items-center justify-center font-bold text-xs border border-blue-100 uppercase">
                                    <?= substr($e['nombre'], 0, 2) ?>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-slate-800 tracking-tight"><?= $e['nombre'] ?></span>
                                    <span class="text-slate-400 text-xs mt-0.5 italic">Rep: <?= $e['representante'] ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-700"><?= $e['rut'] ?></span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-slate-500 font-medium bg-slate-100 px-3 py-1 rounded-lg text-xs"><?= $e['categoria'] ?></span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php 
                            $statusClass = 'badge-pendiente';
                            if ($e['estado'] == 'Activo') $statusClass = 'badge-activo';
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $e['estado'] ?></span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                <button class="action-btn text-slate-400 hover:text-primary-blue" title="Ver Hoja de Vida" onclick="window.location.href='emprendedores_ver.php?id=1'">
                                    <span class="material-symbols-outlined">assignment_ind</span>
                                </button>
                                <button class="text-slate-400 hover:text-amber-500 p-2" title="Editar">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="text-primary-blue p-2" title="Contactar">
                                    <span class="material-symbols-outlined">mail</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Mostrando <?= count($emprendedores) ?> registros</span>
            
            <nav class="flex items-center gap-1">
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined text-lg">chevron_left</span></button>
                <div class="flex gap-1">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary-blue text-white font-bold text-xs">1</button>
                </div>
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined text-lg">chevron_right</span></button>
            </nav>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // La redirección ahora es directa por el onclick del botón de Hoja de Vida
    });
</script>

<?php include '../../api/general/footer.php'; ?>