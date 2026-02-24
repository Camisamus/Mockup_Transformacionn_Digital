<?php
$pageTitle = "DESVE";
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
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    /* Reset y corrección de fuentes exacto a test.php */
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    
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

    /* Estilos de estados de test.php */
    .badge-alta { background-color: #fee2e2; color: #b91c1c; font-weight: 700; padding: 4px 10px; border-radius: 6px; font-size: 11px; }
    .badge-media { background-color: #eff6ff; color: #1d4ed8; font-weight: 700; padding: 4px 10px; border-radius: 6px; font-size: 11px; }
    
    /* Sombras exactas de test.php */
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left"> 
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Listado de Solicitudes</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Aquí tienes las solicitudes que requieren tu atención. Puedes ver sus
                        detalles y
                        avanzar en su gestion desde la lista.</p>
        </div>
        <div class="flex-shrink-0">
            <button type="button" onclick="location.href='nuevo.php'"
                class="bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-sm uppercase tracking-wider">
                NUEVO DESVE
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 flex justify-between items-center bg-white">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-blue">list_alt</span>
                <h3 class="font-bold text-slate-700">Solicitudes Pendientes</h3>
            </div>
            
            <select class="rounded-lg border-slate-200 text-xs font-semibold text-slate-400 focus:ring-primary-blue py-1.5" id="filtro_rango">
                <option value="30">Últimos 30 días</option>
                <option value="60">Últimos 60 días</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                        <th class="px-6 py-4 text-center">Acción</th>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Cod. DESVE</th>
                        <th class="px-6 py-4">Solicitante</th>
                        <th class="px-6 py-4">Fecha Rec.</th>
                        <th class="px-6 py-4">Vencimiento</th>
                        <th class="px-6 py-4 text-center">Prioridad</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody id="tbody_desve" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                    </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4 bg-white">
            <div class="flex gap-3">
                <button type="button" class="flex items-center gap-2 bg-[#1d7344] hover:bg-[#155a34] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider" id="btn_excel">
                    <span class="material-symbols-outlined text-sm">description</span> EXCEL
                </button>
                <button type="button" class="flex items-center gap-2 bg-[#d32f2f] hover:bg-[#b71c1c] text-white px-5 py-2.5 rounded-lg text-xs font-bold transition-all shadow-md uppercase tracking-wider" id="btn_pdf">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> PDF
                </button>
            </div>

            <nav class="flex items-center gap-1">
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined">chevron_left</span></button>
                <div class="flex gap-1" id="pagination_container">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary-blue text-white font-bold text-xs">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 font-bold text-xs hover:bg-slate-50">2</button>
                </div>
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg"><span class="material-symbols-outlined">chevron_right</span></button>
            </nav>

            <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                Mostrando <span id="current_view">1 a 4</span> de <span id="resultados_count">0</span> resultados
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>

<script src="../../recursos/js/funcionarios/desve/desve_listado_ingresos.js"></script>

<?php include '../../api/general/footer.php'; ?>