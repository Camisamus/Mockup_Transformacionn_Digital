<?php
$pageTitle = "Ver Ingreso";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
<link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" type="text/css" />

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                    "soft-cyan": "#F0FFFF",
                    "cyan-border": "#E0FFFF"
                },
                fontFamily: { "sans": ["Inter", "sans-serif"] }
            }
        }
    }
</script>

<style>
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { vertical-align: middle; line-height: 1; }
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    #network-container { width: 100%; height: 600px; background-color: #f8f9fa; border-radius: 1.5rem; }
    
    /* Pestañas Premium */
    #ingresosTabs { background-color: white; border-radius: 9999px; padding: 5px; border: 1px solid #e2e8f0; display: inline-flex; overflow-x: auto; max-width: 100%; }
    #ingresosTabs .nav-link { border: none !important; color: #64748b; font-size: 11px; font-weight: 700; padding: 10px 18px; border-radius: 9999px; transition: all 0.3s ease; text-transform: uppercase; white-space: nowrap; }
    #ingresosTabs .nav-link.active { background-color: #1a5f9c !important; color: white !important; box-shadow: 0 4px 6px -1px rgba(26, 95, 156, 0.3); }
    
    .label-custom { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-8 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6">
        <div class="space-y-1">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Gestión de Ingreso</h1>
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider italic" id="subtitulo_ingreso tracking-tighter">Cargando detalles...</p>
        </div>

        <div class="flex flex-wrap gap-2 w-full lg:w-auto justify-end">
            <button type="button" onclick="location.href='index.php'" class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[12px] uppercase tracking-wider">
                <span class="material-symbols-outlined text-[20px]">grid_view</span> Bandeja
            </button>
        </div>
    </div>

    <div class="flex justify-start overflow-x-auto pb-2">
        <ul class="nav nav-tabs border-0" id="ingresosTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-detalle">Detalle</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-derivacion">Derivación</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-dependencia">Dependencia</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-mapa">Mapa</button></li>
            <li class="nav-item"><button class="nav-link text-gob-warning" data-bs-toggle="tab" data-bs-target="#tab-visar">Visar</button></li>
            <li class="nav-item"><button class="nav-link text-gob-success" data-bs-toggle="tab" data-bs-target="#tab-responder">Responder</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-historial">Historial</button></li>
        </ul>
    </div>

    <div class="tab-content" id="ingresosTabContent">
        
        <div class="tab-pane fade show active" id="tab-detalle" role="tabpanel">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Detalles del Ingreso</h3>
                            <span class="px-4 py-1.5 rounded-lg bg-blue-50 text-primary-blue text-[11px] font-bold border border-blue-100 uppercase" id="badge_estado">Cargando...</span>
                        </div>
                        <div class="p-6 lg:p-10 space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="label-custom">Título</label>
                                    <div class="text-lg font-extrabold text-slate-800" id="info_titulo">-</div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="label-custom">ID RGT</label>
                                        <div class="text-[15px] font-bold text-slate-700" id="info_rgt_id">-</div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="label-custom">ID Público</label>
                                        <div class="font-mono text-primary-blue" id="info_id_publica">-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3 pt-6 border-t border-slate-50">
                                <label class="label-custom">Contenido</label>
                                <div class="bg-slate-50 p-6 rounded-2xl text-slate-700 italic" id="info_contenido" style="white-space: pre-wrap; min-height: 150px;">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white gob-card rounded-2xl p-5 space-y-4">
                        <h5 class="label-custom flex items-center gap-2"><span class="material-symbols-outlined text-sm">link</span> Enlaces</h5>
                        <div id="lista_enlaces" class="space-y-2"></div>
                    </div>
                    <div class="bg-soft-cyan border border-cyan-border rounded-2xl p-5 space-y-4">
                        <h5 class="label-custom flex items-center gap-2"><span class="material-symbols-outlined text-sm text-primary-blue">attach_file</span> Adjuntos</h5>
                        <div id="lista_documentos" class="space-y-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-derivacion" role="tabpanel">
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="table-responsive">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] uppercase font-bold text-slate-400 tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Funcionario</th>
                                <th class="px-6 py-4 text-center">Rol</th>
                                <th class="px-6 py-4 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_destinos" class="divide-y divide-slate-100 text-sm"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-dependencia" role="tabpanel">
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8">
                <ul id="lista_multiancestro" class="bg-white rounded-2xl p-6 shadow-sm space-y-3"></ul>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-mapa" role="tabpanel">
            <div class="bg-white gob-card rounded-3xl overflow-hidden">
                <div id="network-container"></div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-visar" role="tabpanel">
            <div class="bg-white gob-card rounded-2xl p-8 text-center space-y-4">
                <span class="material-symbols-outlined text-gob-warning text-5xl">verified_user</span>
                <h3 class="font-bold text-slate-800 uppercase tracking-wide">Módulo de Visación</h3>
                <div id="contenedor_visar" class="max-w-2xl mx-auto">
                    </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-responder" role="tabpanel">
            <div id="contenedor_responder_completo" class="space-y-6">
                </div>
        </div>

        <div class="tab-pane fade" id="tab-historial" role="tabpanel">
            <div class="bg-white gob-card rounded-2xl p-8">
                <div id="lista_bitacora" class="space-y-4"></div>
                <div id="paginacion_bitacora" class="flex justify-center mt-6"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNuevoComentario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Agregar Comentario</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-8">
                <textarea class="w-full rounded-2xl border-slate-200 text-sm p-4 focus:ring-primary-blue" id="textoNuevoComentario" rows="4" placeholder="Escriba aquí..."></textarea>
            </div>
            <div class="p-6 bg-slate-50 border-t flex justify-end gap-3">
                <button type="button" class="bg-primary-blue text-white font-bold py-2.5 px-8 rounded-xl text-xs uppercase" onclick="guardarComentario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/permisos.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/ver.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/responder.js"></script>

<?php include '../../api/general/footer.php'; ?>