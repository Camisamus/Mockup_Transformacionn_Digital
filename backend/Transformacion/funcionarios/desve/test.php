<?php
$pageTitle = "DESVE";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    /* Reset y corrección de fuentes */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    /* Forzar renderizado de iconos Material Symbols */
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal;
        font-style: normal;
        line-height: 1;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
        vertical-align: middle;
    }

    /* Estilos personalizados para estados */
    .badge-alta {
        background-color: #fee2e2;
        color: #b91c1c;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
    }

    .badge-media {
        background-color: #eff6ff;
        color: #1d4ed8;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
    }

    /* Sombras suaves */
    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Bienvenido </h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Aquí podrás encontrar un resumen de los estados
                de las solicitudes ingresadas a DESVE.</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='nuevo.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider">
                NUEVO DESVE
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-primary-blue">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Total Solicitudes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">1.284</h3>
                <span class="text-emerald-500 font-bold text-xs">+12% mes</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-warning">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Pendientes</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">42</h3>
                <span class="text-amber-500 font-bold text-xs uppercase">Crítico</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-slate-400">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Tiempo Promedio</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">3.2d</h3>
                <span class="text-slate-400 font-bold text-xs">Días hábiles</span>
            </div>
        </div>
        <div class="bg-white gob-card rounded-xl p-6 border-l-4 border-l-gob-success">
            <p class="text-slate-400 uppercase font-bold mb-1 tracking-widest text-[10px]">Resueltas (Mes)</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-extrabold text-slate-800 mb-0">156</h3>
                <span class="text-emerald-500 font-bold text-xs">94% tasa</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">bar_chart</span>
                <h3 class="font-bold text-slate-700">Solicitudes por Estado (Últimos 30 días)</h3>
            </div>
            <div class="p-6">
                <canvas id="chartBarras" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">pie_chart</span>
                <h3 class="font-bold text-slate-700">Tipos de Solicitud</h3>
            </div>
            <div class="p-6">
                <canvas id="chartDona" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-white flex justify-between items-center">
            <h3 class="font-bold text-slate-700">Solicitudes Urgentes / Próximas a Vencer</h3>
            <span class="text-xs font-semibold text-slate-400">Mostrando top 5</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Asunto</th>
                        <th class="px-6 py-4">Días Restantes</th>
                        <th class="px-6 py-4 text-center">Prioridad</th>
                        <th class="px-6 py-4 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-700">#1284</td>
                        <td class="px-6 py-4 text-slate-600 font-medium">Revisión de luminaria Calle 5</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-rose-500 font-bold text-sm">
                                <span class="material-symbols-outlined text-sm">schedule</span> 1 día
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="badge-alta">ALTA</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button
                                class="text-primary-blue font-bold hover:text-blue-800 transition-all text-sm">Gestionar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Inicialización de Gráficos Reales
    document.addEventListener('DOMContentLoaded', function () {
        // Gráfico de Barras
        const ctxBarras = document.getElementById('chartBarras').getContext('2d');
        new Chart(ctxBarras, {
            type: 'bar',
            data: {
                labels: ['Pendiente', 'En Revisión', 'Asignado', 'Completado'],
                datasets: [{
                    label: 'Solicitudes',
                    data: [42, 85, 63, 156],
                    backgroundColor: ['#f59e0b', '#1a5f9c', '#6366f1', '#10b981'],
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        // Gráfico de Dona
        const ctxDona = document.getElementById('chartDona').getContext('2d');
        new Chart(ctxDona, {
            type: 'doughnut',
            data: {
                labels: ['Reclamos', 'Consultas'],
                datasets: [{
                    data: [70, 30],
                    backgroundColor: ['#1a5f9c', '#e2e8f0'],
                    borderWidth: 0
                }]
            },
            options: { cutout: '70%', plugins: { legend: { position: 'bottom' } } }
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>