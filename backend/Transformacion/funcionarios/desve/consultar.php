<?php
$pageTitle = "Consultar Solicitud DESVE";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />

<script id="tailwind-config">
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary-blue": "#1a5f9c",
                    "gob-warning": "#f59e0b",
                    "gob-success": "#10b981",
                    "cyan-border": "#E0FFFF",
                    "gray-info": "#D3D3D3",
                    "soft-cyan": "#F0FFFF"
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

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    #lista_comentarios::-webkit-scrollbar {
        width: 5px;
    }

    #lista_comentarios::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6 sticky top-4 z-20">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight" id="header_public_id">Consulta
                DESVE</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium" id="header_expediente">Visualizando detalles de
                la solicitud</p>
        </div>

        <div class="flex flex-wrap gap-2 w-full lg:w-auto justify-end">
            <div id="col_ir_responder">
                <button type="button" id="btn_ir_responder"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all text-[12px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">chat_bubble</span> Responder
                </button>
            </div>
            <div id="col_ir_modificar">
                <button type="button" id="btn_ir_modificar"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all text-[12px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">edit_note</span> Modificar
                </button>
            </div>
            <button type="button" onclick="location.href='index.php'"
                class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[12px] uppercase tracking-wider">
                <span class="material-symbols-outlined text-[20px]">grid_view</span> Bandeja
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">description</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">1. Detalles de la
                            Solicitud</h3>
                    </div>
                    <span id="badge_estado"
                        class="px-4 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-bold border border-slate-200 uppercase tracking-widest">Cargando...</span>
                </div>

                <div class="p-6 lg:p-10 space-y-8">
                    <!-- Fila Principal: Expediente e ID DESVE -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                        <div class="md:col-span-3 space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Nombre del
                                Expediente</label>
                            <div class="text-xl font-extrabold text-slate-800 p-4 bg-slate-50/50 rounded-xl border border-slate-100"
                                id="info_expediente">-</div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] text-right block">Código
                                DESVE</label>
                            <div class="text-center font-mono text-lg text-primary-blue bg-blue-50 py-4 rounded-xl border border-blue-100 font-bold"
                                id="info_desve">-</div>
                        </div>
                    </div>

                    <!-- Fila 2: IDs Secundarios -->
                    <div class="grid grid-cols-1">

                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Reingreso</label>
                            <div class="text-slate-700 font-mono p-3 bg-slate-50 border border-slate-100 rounded-xl text-sm"
                                id="info_reingreso">-</div>
                        </div>
                    </div>

                    <!-- Fila 3: Origen y Tipo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Origen /
                                Solicitante</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px]"
                                id="info_origen">-</div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Entidad /
                                Tipo Org</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px]"
                                id="info_tipo_org">-</div>
                        </div>
                    </div>

                    <!-- Fila 4: Fechas y Prioridad -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Fecha
                                Recepción</label>
                            <div
                                class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl text-slate-700 text-[14px] font-medium">
                                <span class="material-symbols-outlined text-slate-400 text-lg">calendar_month</span>
                                <span id="info_fecha_recepcion">-</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Prioridad</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px"
                                id="info_prioridad">-</div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Vencimiento</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px]"
                                id="info_vencimiento">-</div>
                        </div>
                    </div>

                    <!-- Fila 5: Sector y Responsable -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Sector</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px]"
                                id="info_sector">-</div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Responsable
                                (Creador)</label>
                            <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[14px]"
                                id="info_responsable">-</div>
                        </div>
                    </div>

                    <!-- Detalles y Observaciones -->
                    <div class="space-y-6 pt-6 border-t border-slate-100">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Detalle del
                                Ingreso</label>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-[14px] leading-relaxed text-slate-700 italic min-h-[100px]"
                                id="info_detalle" style="white-space: pre-wrap;">-</div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Observaciones</label>
                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-[14px] leading-relaxed text-slate-700 italic min-h-[80px]"
                                id="info_observaciones" style="white-space: pre-wrap;">-</div>
                        </div>
                    </div>

                    <!-- Geolocalización -->
                    <div class="pt-6 border-t border-slate-100 space-y-6">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">location_on</span>
                            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">2. Geolocalización
                            </h3>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Dirección</label>
                            <div
                                class="text-slate-700 font-medium p-3.5 bg-soft-cyan border border-cyan-border rounded-xl text-[14px] flex items-center gap-3">
                                <span class="material-symbols-outlined text-slate-400 text-lg">home_pin</span>
                                <span id="info_direccion">-</span>
                            </div>
                        </div>

                        <!-- Contenedor del Mapa -->
                        <div id="section_map" class="hidden space-y-2 pt-4">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Ubicación en
                                Mapa</label>
                            <div id="map_desve" style="height: 400px;"
                                class="w-full border border-slate-100 rounded-2xl shadow-inner bg-slate-50 flex items-center justify-center">
                                <div class="flex flex-col items-center text-slate-300">
                                    <span class="material-symbols-outlined text-[40px] animate-pulse">map</span>
                                    <span class="text-[10px] font-bold uppercase tracking-widest mt-2">Cargando
                                        mapa...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bitácoras -->
            <div class="space-y-6">
                <!-- Destinatarios -->
                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">groups</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">3. Destinatarios</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[13px]">
                            <thead
                                class="bg-slate-50 text-slate-500 font-bold uppercase text-[9px] tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Funcionario</th>
                                    <th class="px-6 py-4">Área</th>
                                    <th class="px-6 py-4">Email</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_destinos" class="divide-y divide-slate-50 text-slate-600">
                                <!-- JS Populated -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bitácora de Respuestas -->
                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">history_edu</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">4. Bitácora de Respuestas
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[13px]">
                            <thead
                                class="bg-slate-50 text-slate-500 font-bold uppercase text-[9px] tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Funcionario</th>
                                    <th class="px-6 py-4">Fecha</th>
                                    <th class="px-6 py-4">Tipo</th>
                                    <th class="px-6 py-4">Respuesta</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_respuestas" class="divide-y divide-slate-50 text-slate-600">
                                <!-- JS Populated -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bitácora de Auditoría -->
                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between cursor-pointer group"
                        onclick="toggleAuditoria()">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">visibility</span>
                            <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">5. Bitácora de
                                Auditoría
                            </h3>
                        </div>
                        <span id="btn_toggle_audit"
                            class="material-symbols-outlined text-slate-400 group-hover:text-primary-blue transition-all">expand_more</span>
                    </div>
                    <div id="collapse_audit" class="hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-[13px]">
                                <thead
                                    class="bg-slate-50 text-slate-500 font-bold uppercase text-[9px] tracking-widest border-b border-slate-100">
                                    <tr>
                                        <th class="px-6 py-4">Fecha</th>
                                        <th class="px-6 py-4">Usuario</th>
                                        <th class="px-6 py-4">Evento</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_audit" class="divide-y divide-slate-50 text-slate-600">
                                    <!-- JS Populated -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Paginación -->
                        <div id="pagination_audit"
                            class="p-4 border-t border-slate-50 bg-slate-50/30 flex justify-center gap-2">
                            <!-- JS Populated -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-6 sticky top-[100px]">
            <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                <div class="p-5 border-b border-cyan-border flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">attach_file</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Documentos Adjuntos</h3>
                </div>
                <div class="p-5" id="lista_documentos"></div>
            </div>

            <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                <div class="p-5 border-b border-cyan-border flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-amber-500">sticky_note_2</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Comentarios</h3>
                    </div>
                    <button type="button" id="btn_abrir_comentario"
                        class="p-2 bg-white border border-cyan-border hover:bg-slate-50 rounded-lg text-primary-blue shadow-sm">
                        <span class="material-symbols-outlined text-[20px]">add_comment</span>
                    </button>
                </div>
                <div id="lista_comentarios" class="p-5 max-h-[400px] overflow-y-auto space-y-4 text-[13px] italic">
                </div>
            </div>

            <div id="card_reingreso"
                class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                <div class="p-5 border-b border-cyan-border flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-500">link</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Reingresos Vinculados</h3>
                </div>
                <div class="p-5" id="contenedor_reingreso">
                    <div class="flex flex-col items-center justify-center py-4 text-slate-400 italic text-xs">
                        Sin reingresos vinculados
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-3xl p-8 shadow-xl text-white space-y-5">
                <h5 class="font-bold uppercase text-[10px] tracking-widest text-slate-400 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">analytics</span> Estadísticas
                </h5>
                <div class="flex justify-between items-end border-b border-slate-700 pb-4">
                    <span class="text-xs text-slate-300 font-medium">Días Transcurridos</span>
                    <span class="text-4xl font-black" id="info_dias_ingreso">-</span>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-xs text-slate-300 font-medium">Días Vencimiento</span>
                    <span class="text-4xl font-black text-gob-warning" id="info_dias_vencimiento">-</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Comentario -->
<div class="modal fade" id="modalNuevoComentario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Agregar Comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-0">
                    <label for="textoNuevoComentario" class="form-label small fw-bold">Su Comentario</label>
                    <textarea class="form-control form-control-sm" id="textoNuevoComentario" rows="4"
                        placeholder="Escriba aquí su comentario u observación..."></textarea>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4" onclick="guardarComentario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../recursos/js/funcionarios/desve/consultar.js"></script>
<script src="../../recursos/js/helpers.js"></script>

<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places&callback=initMap"
    async defer></script>

<?php include '../../api/general/footer.php'; ?>