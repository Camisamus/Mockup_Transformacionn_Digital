<?php
$pageTitle = "Consultar Solicitud DESVE";
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
                    "soft-cyan": "#F0FFFF",
                    "cyan-border": "#E0FFFF"
                    "gray-info": "#D3D3D3",
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
        vertical-align: middle; line-height: 1;
    }
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    
    #lista_comentarios::-webkit-scrollbar { width: 5px; }
    #lista_comentarios::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left"> 
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight" id="header_public_id">Consulta DESVE</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium" id="header_expediente">Visualizando detalles de la solicitud</p>
        </div>
        
        <div class="flex flex-wrap gap-2 w-full lg:w-auto">
            <div id="col_ir_responder">
                <button type="button" id="btn_ir_responder" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">chat_bubble</span> Responder
                </button>
            </div>
            <div id="col_ir_modificar">
                <button type="button" id="btn_ir_modificar" class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">edit_note</span> Modificar
                </button>
            </div>
            <button type="button" onclick="location.href='index.php'" class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2 px-5 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider">
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
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">1. Información de la Solicitud</h3>
                    </div>
                    <span id="badge_estado" class="px-4 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-bold border border-slate-200 uppercase tracking-widest">Cargando...</span>
                </div>
        
                <div class="p-6 lg:p-10 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-3 space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre del Expediente</label>
                    <div class="text-xl font-extrabold text-slate-800 p-3 bg-slate-50/50 rounded-xl border border-slate-100" id="info_expediente">-</div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right block">Código DESVE</label>
                    <div class="text-center font-mono text-lg text-primary-blue bg-blue-50 py-3 rounded-xl border border-blue-100 font-bold" id="info_desve">-</div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center block">Reingreso Vinculado</label>
                <div class="flex items-center justify-center gap-3 p-3 bg-slate-50 border border-slate-100 rounded-xl text-slate-600 italic font-medium" id="info_reingreso">
                    <span class="material-symbols-outlined text-slate-400">search</span> -
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo de Solicitante (Origen)</label>
                    <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[15px]" id="info_origen">-</div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre de Entidad / Vecino</label>
                    <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[15px]" id="info_tipo_org">-</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha de Recepción</label>
                    <div class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl text-slate-700 text-[15px] font-medium">
                        <span class="material-symbols-outlined text-slate-400">calendar_month</span>
                        <span id="info_fecha_recepcion">-</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Sector</label>
                    <div class="text-slate-700 font-medium p-3 bg-white border border-slate-200 rounded-xl text-[15px]" id="info_sector">-</div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 space-y-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary-blue">location_on</span>
                    <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">2. Geolocalización</h3>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección del Suceso</label>
                    <div class="text-slate-700 font-medium p-3 bg-soft-cyan border border-cyan-border rounded-xl text-[15px] flex items-center gap-3">
                        <span class="material-symbols-outlined text-slate-400 text-lg">home_pin</span>
                        <span id="info_direccion">-</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Latitud</label>
                        <div class="text-slate-700 font-mono p-3 bg-soft-cyan border border-cyan-border rounded-xl text-sm" id="info_latitud">-</div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Longitud</label>
                        <div class="text-slate-700 font-mono p-3 bg-soft-cyan border border-cyan-border rounded-xl text-sm" id="info_longitud">-</div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 space-y-6">
                </div>
        </div>
    </div>
</div>

<div class="lg:col-span-4 space-y-6">
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
                    <button type="button" id="btn_abrir_comentario" class="p-2 bg-white border border-cyan-border hover:bg-slate-50 rounded-lg text-primary-blue shadow-sm">
                        <span class="material-symbols-outlined text-[20px]">add_comment</span>
                    </button>
                </div>
                <div id="lista_comentarios" class="p-5 max-h-[400px] overflow-y-auto space-y-4 text-[14px] italic"></div>
            </div>

            <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                <div class="p-5 border-b border-cyan-border flex items-center gap-2">
                    <span class="material-symbols-outlined text-slate-500">link</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Reingresos Vinculados</h3>
                </div>
                <div class="p-2 overflow-x-auto">
                    <table class="w-full text-left text-[13px]" id="tabla_reingresos">
                        <thead class="bg-cyan-100/50 text-slate-500 font-bold uppercase text-[10px]">
                            <tr><th class="px-4 py-3">ID</th><th class="px-4 py-3 text-end">Acción</th></tr>
                        </thead>
                        <tbody id="tbody_reingresos" class="divide-y divide-cyan-100"></tbody>
                    </table>
                </div>
            </div>

            <div class="bg-slate-800 rounded-3xl p-8 shadow-xl text-white space-y-5">
                <h5 class="font-bold uppercase text-[11px] tracking-widest text-slate-400 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">analytics</span> Estadísticas
                </h5>
                <div class="flex justify-between items-end border-b border-slate-700 pb-4">
                    <span class="text-sm text-slate-300 font-medium">Días Transcurridos</span>
                    <span class="text-3xl font-black" id="info_dias_ingreso">-</span>
                </div>
                <div class="flex justify-between items-end">
                    <span class="text-sm text-slate-300 font-medium">Días Vencimiento</span>
                    <span class="text-3xl font-black text-gob-warning" id="info_dias_vencimiento">-</span>
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


<!----<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4" id="header_public_id">Consulta DESVE</h2>
            <p class="text-muted mb-0" id="header_expediente">Visualizando detalles de la solicitud</p>
        </div>
    </div>-->

    <!-- Actions Card -->
    <!--<div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto" id="col_ir_responder">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" id="btn_ir_responder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 1 1-7.6-13.5 8.38 8.38 0 0 1 3.8.9L21 3z">
                            </path>
                        </svg>
                        Responder
                    </button>
                </div>
                <div class="col-12 col-md-auto" id="col_ir_modificar">
                    <button type="button" class="btn btn-toolbar w-100 shadow-sm" id="btn_ir_modificar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Modificar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='index.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Bandeja DESVE
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">-->
        <!-- Left Column: Main Info -->
        <!--<div class="col-lg-8">-->
            <!-- Info Card -->
            <!--<div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold fs-6 mb-0">Detalles de la Solicitud</h5>
                        <span class="badge bg-light text-dark border fw-normal" id="badge_estado">Cargando...</span>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-muted small d-block fw-bold mb-1">Nombre del Expediente</label>
                            <span class="fs-5 fw-bold" id="info_expediente">-</span>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small d-block fw-bold mb-1">ID Interno</label>
                            <span id="info_id" class="small">-</span>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small d-block fw-bold mb-1">Código RGT</label>
                            <code id="info_rgt" class="small">-</code>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small d-block fw-bold mb-1">Código DESVE</label>
                            <code id="info_desve" class="small">-</code>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small d-block fw-bold mb-1">Reingreso</label>
                            <code id="info_reingreso" class="small">-</code>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Origen</label>
                            <span id="info_origen" class="small">-</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Tipo Organización</label>
                            <span id="info_tipo_org" class="small">-</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Sector</label>
                            <span id="info_sector" class="small">-</span>
                        </div>

                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Fecha Recepción</label>
                            <span id="info_fecha_recepcion" class="small">-</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Prioridad</label>
                            <span id="info_prioridad" class="small">-</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block fw-bold mb-1">Vencimiento</label>
                            <span id="info_vencimiento" class="small">-</span>
                        </div>

                        <div class="col-12">
                            <label class="text-muted small d-block fw-bold mb-2">Destinatarios</label>
                            <div class="table-responsive border rounded">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light text-uppercase small">
                                        <tr>
                                            <th>Funcionario</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_destinos" class="small">-->
                                        <!-- Dynamic -->
                                    <!--</tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small d-block fw-bold mb-1">Responsable (Creador)</label>
                            <span id="info_responsable" class="small">-</span>
                        </div>

                        <div class="col-12">
                            <hr class="opacity-10">
                            <label class="text-muted small d-block fw-bold mb-2">Detalle del Ingreso</label>
                            <div class="bg-light p-3 rounded small border" id="info_detalle"
                                style="white-space: pre-wrap;">-</div>
                        </div>

                        <div class="col-12">
                            <label class="text-muted small d-block fw-bold mb-2">Observaciones</label>
                            <div class="bg-light p-3 rounded small border" id="info_observaciones"
                                style="white-space: pre-wrap;">-</div>
                        </div>
                    </div>
                </div>
            </div>-->

            <!-- Bitácora de Respuestas -->
            <!--<div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Bitácora de Respuestas</h5>
                        <button class="btn btn-sm btn-link text-decoration-none p-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseRespuestas" aria-expanded="true"
                            aria-controls="collapseRespuestas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div class="collapse show" id="collapseRespuestas">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabla_respuestas">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th>ID</th>
                                        <th>Funcionario</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Respuesta / Comentario</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_respuestas" class="small">-->
                                    <!-- Dynamic -->
                                <!--</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>-->

            <!-- Bitácora de Auditoría -->
            <!--<div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Bitácora de Auditoría</h5>
                        <button class="btn btn-sm btn-link text-decoration-none p-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseAudit" aria-expanded="false"
                            aria-controls="collapseAudit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div class="collapse" id="collapseAudit">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_audit" class="small">-->
                                    <!-- Dynamic -->
                                <!--</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- Right Column: Sidebar -->
        <!--<div class="col-lg-4">-->
            <!-- Documentos -->
            <!--<div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Documentos Adjuntos</h5>
                    <div id="lista_documentos" class="list-group list-group-flush">-->
                        <!-- Dynamic -->
                    <!--</div>
                </div>
            </div>-->

            <!-- Comentarios -->
            <!--<div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Comentarios</h5>
                        <button type="button" class="btn btn-toolbar p-1" id="btn_abrir_comentario"
                            title="Agregar Comentario">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="lista_comentarios" class="list-group list-group-flush"
                        style="max-height: 300px; overflow-y: auto;">-->
                        <!-- Dynamic -->
                    <!--</div>
                </div>
            </div>-->

            <!-- Reingresos -->
            <!--<div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Reingresos Vinculados</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tabla_reingresos">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th>ID</th>
                                    <th>Expediente</th>
                                    <th class="text-end">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_reingresos" class="small">-->
                                <!-- Dynamic -->
                            <!--</tbody>
                        </table>
                    </div>
                </div>
            </div>-->

            <!-- Metrics Card -->
            <!--<div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Estadísticas del Trámite</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small text-muted">Días Transcurridos:</span>
                        <span class="fw-bold small" id="info_dias_ingreso">-</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small text-muted">Días para Vencimiento:</span>
                        <span class="fw-bold small" id="info_dias_vencimiento">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->



<script src="https://unpkg.com/feather-icons"></script>

<script src="../../recursos/js/funcionarios/desve/consultar.js"></script>

<?php include '../../api/general/footer.php'; ?>