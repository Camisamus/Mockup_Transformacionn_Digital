<?php
$pageTitle = "Bandeja OIRS";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';

use App\Controllers\sistema_funcionariocontroller;

$funcionarioCtrl = new sistema_funcionariocontroller($db);
$rol = $funcionarioCtrl->getMiRolOIRS();
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
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

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Estilos DataTables para que no rompan el diseño Tailwind */
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

    table.dataTable no-footer {
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #1a5f9c !important;
        color: white !important;
        border: none !important;
        border-radius: 8px !important;
    }

    .status-badge {
        font-size: 10px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-ingresada { background: #e3f2fd; color: #007bff; }
    .badge-proceso { background: #fff3e0; color: #ef6c00; }
    .badge-resuelta { background: #e8f5e9; color: #2e7d32; }
    .badge-vencida { background: #ffebee; color: #c62828; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Solicitudes por Revisar OIRS</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic">Gesti&oacute;n de solicitudes ciudadanas pendientes</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" id="btn_exportar_excel" class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">download</span> EXPORTAR EXCEL
            </button>
        </div>
    </div>

    <!-- Filtros de Búsqueda (Opcional, pero mantenemos por consistencia) -->
    <div class="bg-white gob-card rounded-2xl overflow-hidden p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">B&uacute;squeda R&aacute;pida</label>
                <input type="text" id="filter-search" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm" placeholder="Folio, RUT o Nombre">
            </div>
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha</label>
                <input type="date" id="filter-fecha" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
            </div>
            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado</label>
                <select id="filter-estado" class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                    <option value="">Todos los estados</option>
                    <option value="0">Recibida / Nueva</option>
                    <option value="1">Visada</option>
                    <option value="2">Resp. Ejecutar</option>
                    <option value="3">Respondida</option>
                    <option value="4">Ejecutada</option>
                    <option value="5">Notificada</option>
                </select>
            </div>
            <div>
                <button id="btnReset" class="w-full py-2.5 rounded-xl border-2 border-slate-200 text-slate-400 font-bold text-[11px] uppercase tracking-wider hover:bg-slate-50 transition-all">
                    LIMPIAR FILTROS
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden min-h-[400px]">
        <div class="overflow-x-auto p-4" id="tabla-resultados-oirs">
            <!-- El contenido será renderizado por OirsTable.renderTable en tabla_flujo.js -->
            <div class="flex justify-center p-20">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-primary-blue"></div>
            </div>
        </div>

        <div class="p-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <div class="flex gap-3">
                <button type="button"
                    class="flex items-center gap-2 bg-[#1d7344] hover:bg-[#155a34] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_excel_footer">
                    <span class="material-symbols-outlined text-sm">description</span> EXCEL
                </button>
                <button type="button"
                    class="flex items-center gap-2 bg-[#d32f2f] hover:bg-[#b71c1c] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider"
                    id="btn_pdf_footer">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script src="../../recursos/js/funcionarios/oirs/revisar.js"></script>

<script>
    $(document).ready(function () {
        OirsTable.init('revisar');

        // Filtros manuales si es necesario (OirsTable ya maneja su propia carga, pero podemos añadir listeners)
        $('#filter-search, #filter-fecha, #filter-estado').on('keyup change', function() {
            // Aquí podrías implementar un filtrado local sobre la DataTable si lo deseas
            // o llamar de nuevo a loadData con parámetros si el API los soporta.
        });

        $('#btnReset').click(function() {
            $('#filter-search, #filter-fecha, #filter-estado').val('');
            OirsTable.loadData();
        });

        $('#btn_exportar_excel, #btn_excel_footer').click(function() {
            exportToExcel('table-oirs-render', 'OIRS_Pendientes');
        });

        $('#btn_pdf_footer').click(function() {
            exportElementToPDF('tabla-resultados-oirs', 'OIRS_Pendientes');
        });
    });
</script>

<?php include '../../api/general/footer.php'; ?>