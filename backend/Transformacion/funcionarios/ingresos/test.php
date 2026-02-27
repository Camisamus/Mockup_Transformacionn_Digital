<?php
$pageTitle = "Consultar Ingreso";
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
    .material-symbols-outlined { font-family: 'Material Symbols Outlined' !important; vertical-align: middle; line-height: 1; }
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    #network-container { width: 100%; height: 600px; background-color: #f8f9fa; border-radius: 1.5rem; }
    .label-custom { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Consulta de Ingreso</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic" id="subtitulo_ingreso">Visualizando detalles de la solicitud</p>
        </div>

        <div class="flex flex-wrap gap-2 w-full lg:w-auto justify-end">
            <div id="col_ir_responder" style="display: none;">
                <button type="button" id="btn_ir_responder" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">task_alt</span> Responder
                </button>
            </div>
            <div id="col_ir_preparar" style="display: none;">
                <button type="button" id="btn_ir_preparar" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">share</span> Preparar
                </button>
            </div>
            <div id="col_ir_modificar" style="display: none;">
                <button type="button" id="btn_ir_modificar" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">edit_note</span> Modificar
                </button>
            </div>
            <button type="button" onclick="location.href='index.php'"
                class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider">
                <span class="material-symbols-outlined text-[20px]">grid_view</span> Bandeja
            </button>
        </div>
    </div>

    <div class="bg-white gob-card rounded-2xl overflow-hidden shadow-sm">
        <div class="p-6 lg:p-8">
            <form id="form_filtros_consulta" class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                <div class="md:col-span-4 space-y-2">
                    <label for="filtro_titulo" class="label-custom">Título</label>
                    <input type="text" id="filtro_titulo" placeholder="Buscar por título..." class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                </div>
                <div class="md:col-span-3 space-y-2">
                    <label for="filtro_rgt" class="label-custom">ID Público (RGT)</label>
                    <input type="text" id="filtro_rgt" placeholder="Cód. RGT..." class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm font-mono">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label for="filtro_id" class="label-custom">ID Interno</label>
                    <input type="number" id="filtro_id" placeholder="ID..." class="w-full px-4 py-2.5 rounded-xl border-slate-200 focus:ring-primary-blue text-sm">
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 bg-primary-blue hover:bg-blue-700 text-white font-bold py-2.5 rounded-xl shadow-md transition-all text-[11px] uppercase tracking-widest flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">manage_search</span> Consultar
                    </button>
                    <button type="reset" id="btn_limpiar" class="px-3 bg-white border border-slate-200 text-slate-400 hover:text-slate-600 rounded-xl transition-all">
                        <span class="material-symbols-outlined text-lg">restart_alt</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 space-y-6">
            
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">description</span>
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Detalles del Ingreso</h3>
                    </div>
                    <span class="px-4 py-1.5 rounded-lg bg-blue-50 text-primary-blue text-[11px] font-bold border border-blue-100 uppercase tracking-widest" id="badge_estado">Cargando...</span>
                </div>

                <div class="p-6 lg:p-10 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="label-custom text-slate-400">Título</label>
                            <div class="text-lg font-extrabold text-slate-800" id="info_titulo">-</div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="label-custom text-slate-400">ID Trámite (RGT)</label>
                                <div class="text-[15px] font-bold text-slate-700" id="info_rgt_id">-</div>
                            </div>
                            <div class="space-y-2">
                                <label class="label-custom text-slate-400">ID Público</label>
                                <div class="inline-block bg-slate-50 border border-slate-100 px-3 py-1 rounded-lg text-xs font-mono text-primary-blue" id="info_id_publica">-</div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-slate-50">
                        <div class="space-y-1">
                            <label class="label-custom">Fecha de Ingreso</label>
                            <div class="text-[14px] text-slate-600 font-medium" id="info_fecha">-</div>
                        </div>
                        <div class="space-y-1">
                            <label class="label-custom">Responsable</label>
                            <div class="text-[14px] text-slate-600 font-medium" id="info_responsable">-</div>
                        </div>
                        <div class="space-y-1">
                            <label class="label-custom">Fecha Límite</label>
                            <div class="text-[14px] text-rose-600 font-black" id="info_fecha_limite">-</div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-6 border-t border-slate-50">
                        <label class="label-custom">Contenido / Cuerpo</label>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-[15px] text-slate-700 leading-relaxed italic" id="info_contenido" style="white-space: pre-wrap; min-height: 150px;">-</div>
                    </div>
                </div>
            </div>

            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 bg-white">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">group</span>
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Destinatarios y Permisos</h3>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-[14px]">
                        <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b">
                            <tr>
                                <th class="px-6 py-4">Funcionario</th>
                                <th class="px-6 py-4">Tipo</th>
                                <th class="px-6 py-4">Facultad</th>
                                <th class="px-6 py-4">Tarea</th>
                                <th class="px-6 py-4 text-center">Requerido</th>
                                <th class="px-6 py-4 text-right">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_destinos" class="divide-y divide-slate-50 text-slate-600 font-medium"></tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white gob-card rounded-2xl overflow-hidden p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h5 class="font-bold text-slate-700 uppercase text-sm tracking-wide flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">history_edu</span> Bitácora de Auditoría
                        </h5>
                        <button class="p-2 hover:bg-slate-50 rounded-lg transition-all" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBitacora">
                            <span class="material-symbols-outlined">expand_more</span>
                        </button>
                    </div>
                    <div class="collapse show" id="collapseBitacora">
                        <div class="space-y-4" id="lista_bitacora"></div>
                    </div>
                </div>

                <div id="contenedor_respuestas" class="space-y-6"></div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 bg-white">
                    <h5 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue text-lg">link</span> Enlaces Adjuntos
                    </h5>
                </div>
                <div id="lista_enlaces" class="p-4 space-y-2"></div>
            </div>

            <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                <div class="p-5 border-b border-cyan-border">
                    <h5 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue text-lg">attach_file</span> Documentos Adjuntos
                    </h5>
                </div>
                <div id="lista_documentos" class="p-4 space-y-2"></div>
            </div>

            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
                    <h5 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue text-lg">sticky_note_2</span> Comentarios
                    </h5>
                    <button type="button" class="bg-slate-800 text-white px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-black transition-all" id="btn_abrir_comentario">
                        + Agregar
                    </button>
                </div>
                <div id="lista_comentarios" class="p-4 max-h-[400px] overflow-auto space-y-3"></div>
            </div>

            <div class="bg-[#F0F9FF] border border-blue-100 rounded-3xl p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-primary-blue uppercase text-[11px] tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">account_tree</span> Relaciones (Árbol RGT)
                    </h5>
                    <button type="button" class="bg-primary-blue text-white px-3 py-1.5 rounded-xl shadow-md text-[10px] font-bold uppercase hover:bg-blue-700" id="btn_ver_mapa">
                        Ver Mapa
                    </button>
                </div>
                <p class="text-[11px] text-slate-500 font-medium italic">Trámites correlacionados dinámicamente.</p>
                <ul id="lista_multiancestro" class="space-y-2"></ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMapa" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Mapa de Relaciones (Multi-Ancestro)</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-0">
                <div id="network-container"></div>
            </div>
            <div class="p-6 bg-slate-50 flex justify-between items-center border-t">
                <div class="text-[11px] text-slate-400 font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">mouse</span> Navegue con el ratón (zoom y arrastre).
                </div>
                <button type="button" class="bg-slate-800 text-white px-6 py-2 rounded-xl text-xs font-bold uppercase tracking-widest" data-bs-dismiss="modal">Cerrar</button>
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
                <div class="space-y-2">
                    <label class="label-custom">Su Comentario u Observación</label>
                    <textarea class="w-full rounded-2xl border-slate-200 text-sm p-4 focus:ring-primary-blue" id="textoNuevoComentario" rows="4" placeholder="Escriba aquí..."></textarea>
                </div>
            </div>
            <div class="p-6 bg-slate-50 border-t flex justify-end gap-3">
                <button type="button" class="text-slate-400 font-bold text-xs uppercase px-4" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="bg-primary-blue text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 text-xs uppercase" onclick="guardarComentario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/permisos.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/consultar.js"></script>

<?php include '../../api/general/footer.php'; ?>