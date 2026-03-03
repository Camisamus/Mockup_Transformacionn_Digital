<?php 
$pageTitle = "Gestión de Postulaciones - Desarrollo Económico";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php'; 

// Datos mock basados en postulaciones_consulta_masiva_mock.json
$postulaciones = [
    [
        "rpj" => "RPJ-2020-001",
        "rut" => "76.123.456-7",
        "nombre_organizacion" => "Junta de Vecinos Los Aromos",
        "tipo_organizacion" => "Junta de Vecinos",
        "nombre_proyecto" => "Mejoramiento Plaza Vecinal",
        "tipo_fondo" => "Municipal",
        "fecha_ingreso" => "2024-03-15",
        "monto" => 5000000,
        "estado" => "Aprobado"
    ],
    [
        "rpj" => "RPJ-2019-045",
        "rut" => "76.234.567-8",
        "nombre_organizacion" => "Centro Cultural El Bosque",
        "tipo_organizacion" => "Centro Cultural",
        "nombre_proyecto" => "Talleres Culturales 2024",
        "tipo_fondo" => "Regional",
        "fecha_ingreso" => "2024-04-20",
        "monto" => 3200000,
        "estado" => "En Evaluación"
    ],
    [
        "rpj" => "RPJ-2021-089",
        "rut" => "76.345.678-9",
        "nombre_organizacion" => "Club Deportivo Las Palmas",
        "tipo_organizacion" => "Club Deportivo",
        "nombre_proyecto" => "Equipamiento Deportivo",
        "tipo_fondo" => "Municipal",
        "fecha_ingreso" => "2024-05-10",
        "monto" => 7500000,
        "estado" => "Pendiente"
    ],
    [
        "rpj" => "RPJ-2018-123",
        "rut" => "76.456.789-0",
        "nombre_organizacion" => "Agrupación de Artesanos Unidos",
        "tipo_organizacion" => "Agrupación",
        "nombre_proyecto" => "Capacitación Emprendedores",
        "tipo_fondo" => "Nacional",
        "fecha_ingreso" => "2023-11-25",
        "monto" => 2800000,
        "estado" => "Finalizado"
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
    .badge-aprobado { background: #e8f5e9; color: #2e7d32; }
    .badge-evaluacion { background: #fff3e0; color: #ef6c00; }
    .badge-pendiente { background: #e3f2fd; color: #007bff; }
    .badge-finalizado { background: #f5f5f5; color: #616161; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <!-- Header Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Gestión de Postulaciones</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Control y seguimiento de proyectos comunitarios y emprendimiento</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">add_circle</span> NUEVA POSTULACIÓN
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Proyectos</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">24</h3>
                <span class="text-emerald-500 font-bold text-xs">+5 este mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">En Evaluación</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">8</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Proceso</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Monto Asignado</p>
            <div class="flex items-end justify-between">
                <h3 class="text-2xl font-extrabold text-slate-800 mb-0">$18.5M</h3>
                <span class="text-slate-400 font-bold text-xs">Anual</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-danger">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Pendientes Cierre</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">3</h3>
                <span class="text-rose-500 font-bold text-xs">Urgente</span>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white gob-card rounded-2xl overflow-hidden p-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
            <div class="md:col-span-4 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Buscador (Nombre / Organización / RUT)</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-slate-400 text-xl">search</span>
                    <input type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm bg-slate-50/50" placeholder="Buscar postulación...">
                </div>
            </div>
            <div class="md:col-span-3 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado</label>
                <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                    <option>Todos los estados</option>
                    <option>Aprobado</option>
                    <option>En Evaluación</option>
                    <option>Pendiente</option>
                    <option>Finalizado</option>
                </select>
            </div>
            <div class="md:col-span-3 space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo de Fondo</label>
                <select class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                    <option>Todos los fondos</option>
                    <option>Municipal</option>
                    <option>Regional</option>
                    <option>Nacional</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <button class="w-full py-2.5 rounded-xl bg-slate-800 text-white font-bold text-[11px] uppercase tracking-wider hover:bg-black transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">filter_alt</span> FILTRAR
                </button>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span> Resultados encontradas
                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] ml-2 font-black border border-slate-200"><?= count($postulaciones) ?> TOTAL</span>
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">Organización / Proyecto</th>
                        <th class="px-6 py-4">RPJ / RUT</th>
                        <th class="px-6 py-4">Fondo / Monto</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-[15px] text-slate-600">
                    <?php foreach ($postulaciones as $p): ?>
                    <tr class="hover:bg-slate-50/80 transition-all cursor-pointer">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-black text-slate-800 tracking-tight"><?= $p['nombre_organizacion'] ?></span>
                                <span class="text-slate-400 text-xs mt-0.5 italic"><?= $p['nombre_proyecto'] ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-700"><?= $p['rpj'] ?></span>
                                <span class="text-slate-400 text-[10px] font-medium tracking-wide"><?= $p['rut'] ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium text-slate-700"><?= $p['tipo_fondo'] ?></span>
                                <span class="text-primary-blue text-sm font-black">$<?= number_format($p['monto'], 0, ',', '.') ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php 
                            $statusClass = 'badge-pendiente';
                            if ($p['estado'] == 'Aprobado') $statusClass = 'badge-aprobado';
                            if ($p['estado'] == 'En Evaluación') $statusClass = 'badge-evaluacion';
                            if ($p['estado'] == 'Finalizado') $statusClass = 'badge-finalizado';
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $p['estado'] ?></span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-1">
                                <button class="action-btn text-slate-400 hover:text-primary-blue p-2" title="Ver Detalles" onclick="window.location.href='postulacion_ver.php?id=1'">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>
                                <button class="text-slate-400 hover:text-amber-500 p-2" title="Editar">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="text-primary-blue p-2" title="Gestionar">
                                    <span class="material-symbols-outlined">settings</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Mostrando <?= count($postulaciones) ?> registros</span>
            
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
        // Redirección directa por onclick
    });
</script>

<?php include '../../api/general/footer.php'; ?>