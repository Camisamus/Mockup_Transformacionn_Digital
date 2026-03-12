<?php
$pageTitle = "Ingresos Pendientes";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', sans-serif;
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        vertical-align: middle;
        line-height: 1;
    }

    /* Sombras suaves */
    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Estilos DataTables */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        font-size: 12px;
        color: #64748b !important;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    table.dataTable thead th {
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #1a5f9c !important;
        color: white !important;
        border: none !important;
        border-radius: 8px !important;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Ingresos Pendientes</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">En este listado encontrarás los ingresos pedidos por ti o aquellos que se encuentran bajo su responsabilidad.</p>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left" id="tablaPendientes">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="text-center px-6 py-4">Cod. Ingreso</th>
                        <th class="px-6 py-4">Rol</th>
                        <th class="px-6 py-4">Materia / Título</th>
                        <th class="text-center px-6 py-4">Fecha Ing.</th>
                        <th class="text-center px-6 py-4">Vencimiento</th>
                        <th class="text-center px-6 py-4">Estado</th>
                        <th class="text-center px-6 py-4">Acción</th>
                    </tr>
                </thead>
                <tbody id="tbody_pendientes" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <div class="flex gap-3">
                <button type="button"
                    class="flex items-center gap-2 bg-[#1d7344] hover:bg-[#155a34] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_exportar_excel">
                    <span class="material-symbols-outlined text-sm">description</span> EXCEL
                </button>
                <button type="button"
                    class="flex items-center gap-2 bg-[#d32f2f] hover:bg-[#b71c1c] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_exportar_pdf">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/ingresos/pendientes.js"></script>

<?php include '../../api/general/footer.php'; ?>
