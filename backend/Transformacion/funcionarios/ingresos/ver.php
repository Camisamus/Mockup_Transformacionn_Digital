<?php
$pageTitle = "Ver Ingreso";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
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

    #network-container {
        width: 100%;
        height: 600px;
        background-color: #f8f9fa;
        border-radius: 1.5rem;
    }

    /* Estilo de la barra de pestañas premium */
    #ingresosTabs {
        background-color: white;
        border-radius: 9999px;
        padding: 5px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        display: inline-flex;
    }

    #ingresosTabs .nav-item {
        margin-right: 0;
    }

    #ingresosTabs .nav-link {
        border: none !important;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 9999px;
        transition: all 0.3s ease;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    #ingresosTabs .nav-link.active {
        background-color: #1a5f9c !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(26, 95, 156, 0.3);
    }

    #ingresosTabs .nav-link:hover:not(.active) {
        background-color: #f1f5f9;
        color: #1a5f9c;
    }

    .label-custom {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">

    <div
        class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Consulta de Ingresos</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider italic"
                id="subtitulo_ingreso">Visualizando detalles de la solicitud</p>
        </div>

        <div class="flex flex-wrap gap-2 w-full lg:w-auto justify-end">
            <div id="col_ir_responder" style="display: none;">
                <button type="button" id="btn_ir_responder"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">task_alt</span> Responder
                </button>
            </div>
            <!--<div id="col_ir_preparar" style="display: none;">
                <button type="button" id="btn_ir_preparar"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">share</span> Preparar
                </button>
            </div>-->
            <div id="col_ir_modificar" style="display: none;">
                <button type="button" id="btn_ir_modificar"
                    class="flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px] text-primary-blue">edit_note</span> Modificar
                </button>
            </div>
            <button type="button" onclick="location.href='index.php'"
                class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider">
                <span class="material-symbols-outlined text-[20px]">grid_view</span> Bandeja
            </button>
        </div>
    </div>

    <!-- Barra de Pestañas -->
    <div class="flex justify-start mb-2">
        <ul class="nav nav-tabs border-0" id="ingresosTabs" role="tablist">
            <li class="nav-item" role="presentation" id="nav-detalle">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-detalle" type="button"
                    role="tab">Detalle de la consulta</button>
            </li>
            <li class="nav-item" role="presentation" id="nav-derivacion">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-derivacion" type="button"
                    role="tab">Derivación</button>
            </li>
            <li class="nav-item" role="presentation" id="nav-dependencia">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-dependencia" type="button"
                    role="tab">Dependencia</button>
            </li>
            <li class="nav-item" role="presentation" id="nav-visar">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-visar" type="button"
                    role="tab">Visar</button>
            </li>
            <li class="nav-item" role="presentation" id="nav-responder">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-responder" type="button"
                    role="tab">Responder</button>
            </li>
            <li class="nav-item" role="presentation" id="nav-historial">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-historial" type="button"
                    role="tab">Historial</button>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="ingresosTabContent">
        <!-- PESTAÑA: DETALLE -->
        <div class="tab-pane fade show active" id="tab-detalle" role="tabpanel">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-blue">description</span>
                                <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Detalles del
                                    Ingreso</h3>
                            </div>
                            <span
                                class="px-4 py-1.5 rounded-lg bg-blue-50 text-primary-blue text-[11px] font-bold border border-blue-100 uppercase tracking-widest"
                                id="badge_estado">Cargando...</span>
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
                                        <div class="inline-block bg-slate-50 border border-slate-100 px-3 py-1 rounded-lg text-xs font-mono text-primary-blue"
                                            id="info_id_publica">-</div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-slate-50">
                                <div class="space-y-1">
                                    <label class="label-custom">Fecha Ingreso</label>
                                    <div class="text-[14px] text-slate-600 font-medium" id="info_fecha">-</div>
                                </div>
                                <div class="space-y-1">
                                    <label class="label-custom">Propietario</label>
                                    <div class="text-[14px] text-slate-600 font-medium" id="info_responsable">-</div>
                                </div>
                                <div class="space-y-1">
                                    <label class="label-custom">Fecha Vencimiento</label>
                                    <div class="text-[14px] text-rose-600 font-black" id="info_fecha_limite">-</div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-6 border-t border-slate-50">
                                <label class="label-custom">Contenido / Cuerpo</label>
                                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-[15px] text-slate-700 leading-relaxed italic"
                                    id="info_contenido" style="white-space: pre-wrap; min-height: 150px;">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 bg-white">
                            <h5
                                class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-blue text-lg">link</span> Enlaces
                                Adjuntos
                            </h5>
                        </div>
                        <div id="lista_enlaces" class="p-4 space-y-2"></div>
                    </div>

                    <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                        <div class="p-5 border-b border-cyan-border">
                            <h5
                                class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-blue text-lg">attach_file</span>
                                Documentos Adjuntos
                            </h5>
                        </div>
                        <div id="lista_documentos" class="p-4 space-y-2"></div>
                    </div>

                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-white">
                            <h5
                                class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary-blue text-lg">sticky_note_2</span>
                                Comentarios
                            </h5>
                            <button type="button"
                                class="bg-slate-800 text-white px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-black transition-all"
                                id="btn_abrir_comentario">
                                + Agregar
                            </button>
                        </div>
                        <div id="lista_comentarios" class="p-4 max-h-[400px] overflow-auto space-y-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PESTAÑA: DERIVACIÓN -->
        <div class="tab-pane fade" id="tab-derivacion" role="tabpanel">
            <div class="space-y-6">
                <div class="bg-white border border-slate-100 rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-slate-50 bg-white">
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">group</span> Destinatarios y
                            Permisos
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                                    <th class="px-6 py-4">Funcionario</th>
                                    <!--<th class="px-6 py-4">Tipo</th>-->
                                    <th class="px-6 py-4">Facultad</th>
                                    <th class="px-6 py-4">Tarea</th>
                                    <th class="px-6 py-4 text-center">Requerido</th>
                                    <th class="px-6 py-4 text-right">Estado</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_destinos" class="divide-y divide-slate-100 text-[13px] text-slate-600">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="contenedor_respuestas" class="space-y-6"></div>
            </div>
        </div>

        <!-- PESTAÑA: DEPENDENCIA -->
        <div class="tab-pane fade" id="tab-dependencia" role="tabpanel">
            <div class="bg-[#F0F9FF] border border-blue-100 rounded-3xl p-8 space-y-6">
                <div class="flex justify-between items-center border-b border-blue-50 pb-4">
                    <h5
                        class="font-extrabold text-primary-blue uppercase text-sm tracking-widest flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl font-black">account_tree</span> Relaciones
                        Jerárquicas (Árbol RGT)
                    </h5>
                    <button type="button"
                        class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider"
                        onclick="abrirModalEstablecerDependencia()" style="display: block;">
                        + Nueva Dependencia
                    </button>

                    <a href="#" target="_blank" rel="noopener noreferrer" id="btn_crear_hija"
                        class="flex items-center justify-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2.5 px-6 rounded-xl shadow-lg transition-all text-[13px] uppercase tracking-wider">
                        + Crear solicitud hija
                    </a>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-blue-50 shadow-sm">
                    <ul id="lista_multiancestro" class="space-y-3"></ul>
                </div>
            </div>

            <div class="bg-white gob-card rounded-3xl overflow-hidden shadow-sm">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-white">
                    <h5 class="font-bold text-slate-700 uppercase text-sm tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue">hub</span> Mapa de Relaciones Visual
                    </h5>
                    <div class="text-[11px] text-slate-400 font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-slate-300">mouse</span> Navegue con el ratón
                        (zoom y arrastre).
                    </div>
                </div>
                <div id="network-container" style="height: 700px;"></div>
            </div>
        </div>


        <!-- PESTAÑA: VISAR -->
        <div class="tab-pane fade" id="tab-visar" role="tabpanel">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                            <span class="material-symbols-outlined text-gob-warning">verified_user</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Estado de Aprobaciones
                                (Circuito de Visación)</h3>
                        </div>
                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="w-full text-left">
                                    <thead
                                        class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-widest">
                                        <tr>
                                            <th class="px-6 py-4">Funcionario</th>
                                            <th class="px-6 py-4">Rol</th>
                                            <th class="px-6 py-4 text-center">Requerido</th>
                                            <th class="px-6 py-4 text-right">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla_destinos_status"
                                        class="divide-y divide-slate-50 text-[13px] text-slate-600">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white gob-card rounded-2xl p-8 border-t-4 border-gob-warning shadow-md text-center">
                        <h4 class="text-slate-800 font-extrabold text-lg mb-2 tracking-tight">¿Desea visar este
                            documento?</h4>
                        <p class="text-slate-400 text-sm mb-6 italic">Su aprobación permitirá que el flujo continúe
                            hacia el siguiente responsable.</p>
                        <div class="flex justify-center gap-4">
                            <button type="button" onclick="rechazarVisacion()"
                                class="bg-rose-50 text-rose-600 border border-rose-100 px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-rose-100 transition-all">Rechazar</button>
                            <button type="button" onclick="aprobarVisacion()"
                                class="bg-gob-warning text-white px-8 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-lg shadow-yellow-200/50 hover:bg-amber-600 transition-all">Aprobar
                                y Visar</button>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                        <h5
                            class="text-amber-800 font-bold text-xs uppercase tracking-widest mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">info</span> Regla de Negocio
                        </h5>
                        <p class="text-[12px] text-amber-700 leading-relaxed">
                            Usted ha sido asignado como <strong>Visador</strong>. Su rol es técnico/administrativo y es
                            requisito previo para la respuesta final.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="lg:col-span-4">
                    <div class="bg-white gob-card rounded-2xl p-6 border-l-4 border-gob-info">
                        <h5 class="text-gob-info font-bold text-xs uppercase tracking-widest mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">info</span> Información del Rol
                        </h5>
                        <div class="space-y-4">
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-1">Rol Asignado</p>
                                <p class="text-slate-700 font-bold text-sm" id="info_rol_visador">Cargando...</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-1">Facultad</p>
                                <p class="text-slate-700 font-bold text-sm" id="info_facultad_visador">Cargando...</p>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-1">Tipo de Trámite</p>
                                <p class="text-slate-700 font-bold text-sm" id="info_tipo_tramite_visador">Cargando...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>-->




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
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-link text-muted text-decoration-none small"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-dark btn-sm px-4"
                            onclick="guardarComentario()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal OTP Firma -->
        <div class="modal fade" id="modalOTP" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-dark ">
                        <h5 class="modal-title fw-bold fs-6">Verificación de Firma</h5>
                    </div>
                    <div class="modal-body text-center p-5">
                        <p class="mb-4 small text-muted">Ingrese el código de verificación enviado a su correo
                            electrónico.
                        </p>
                        <div class="mb-4 d-flex justify-content-center">
                            <input type="text" class="form-control text-center fw-bold fs-3 border-dark"
                                id="inp_otp_code" maxlength="6" style="width: 200px; letter-spacing: 5px;"
                                placeholder="000000">
                        </div>
                        <div class="text-danger fw-bold small d-flex align-items-center justify-content-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            Tiempo restante: <span id="otp_timer">04:00</span>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light justify-content-center">
                        <button type="button" class="btn btn-link text-muted text-decoration-none small me-3"
                            onclick="cerrarOTP(true)">Cancelar</button>
                        <button type="button" class="btn btn-dark btn-sm px-4" onclick="confirmarFirmaOTP()">Confirmar
                            Firma</button>
                    </div>
                </div>
            </div>
        </div>

        <!--PESTAÑA: RESPONDER-->
        <div class="tab-pane fade" id="tab-responder" role="tabpanel">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 space-y-6">
                    <div class="bg-white gob-card rounded-2xl overflow-hidden">
                        <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                            <span class="material-symbols-outlined text-gob-success">maps_ugc</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Emitir Respuesta Final
                            </h3>
                        </div>

                        <div class="p-8">
                            <form id="form_responder_ingreso" class="space-y-6">
                                <div class="space-y-2">
                                    <label for="tis_respuesta" class="label-custom">Contenido de la Respuesta
                                        (Opcional)</label>
                                    <textarea id="tis_respuesta" rows="6"
                                        class="w-full border-slate-200 rounded-2xl focus:ring-primary-blue text-[15px] p-4 bg-slate-50 italic focus:bg-white transition-all"
                                        placeholder="Escriba aquí la respuesta final o resolución..."></textarea>
                                </div>

                                <div class="space-y-2">
                                    <label for="inp_archivo_decreto" class="label-custom">Incluir Decreto en respuesta
                                        (Opcional)</label>
                                    <div
                                        class="flex items-center gap-4 p-4 bg-soft-cyan border border-cyan-border rounded-2xl">
                                        <span
                                            class="material-symbols-outlined text-primary-blue text-3xl">picture_as_pdf</span>
                                        <div class="flex-1">
                                            <input type="file" id="inp_archivo_decreto"
                                                accept=".pdf,.doc,.docx,.jpg,.png"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[11px] file:font-bold file:bg-primary-blue file:text-white hover:file:bg-blue-700 cursor-pointer">
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-slate-400 font-medium italic mt-2">
                                        * Si adjunta un archivo, este se guardará automáticamente con el prefijo
                                        <strong>"Decreto - "</strong>.
                                    </p>
                                </div>

                                <div class="pt-6 border-t border-slate-50 flex justify-end gap-3">
                                    <button type="button"
                                        class="text-slate-400 font-bold text-xs uppercase px-4 hover:text-slate-600">Limpiar</button>
                                    <button type="submit"
                                        class="bg-gob-success text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-emerald-200/50 text-xs uppercase tracking-widest hover:bg-emerald-600 transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">send</span> Enviar Respuesta
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-slate-800 text-white rounded-2xl p-6 shadow-xl">
                        <h5 class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-4">Instrucciones de
                            Cierre</h5>
                        <ul class="space-y-4">
                            <li class="flex gap-3 items-start text-sm">
                                <span class="material-symbols-outlined text-gob-success text-lg">check_circle</span>
                                <span>Al enviar la respuesta, el estado del ingreso cambiará a
                                    <strong>"Resuelto"</strong>.</span>
                            </li>
                            <li class="flex gap-3 items-start text-sm">
                                <span class="material-symbols-outlined text-gob-success text-lg">check_circle</span>
                                <span>El documento dejará de estar pendiente en su bandeja personal.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal OTP Firma -->
        <div class="modal fade" id="modalOTP" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-dark ">
                        <h5 class="modal-title fw-bold fs-6">Verificación de Firma</h5>
                    </div>
                    <div class="modal-body text-center p-5">
                        <p class="mb-4 small text-muted">Ingrese el código de verificación enviado a su correo
                            electrónico.
                        </p>
                        <div class="mb-4 d-flex justify-content-center">
                            <input type="text" class="form-control text-center fw-bold fs-3 border-dark"
                                id="inp_otp_code" maxlength="6" style="width: 200px; letter-spacing: 5px;"
                                placeholder="000000">
                        </div>
                        <div class="text-danger fw-bold small d-flex align-items-center justify-content-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            Tiempo restante: <span id="otp_timer">04:00</span>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light justify-content-center">
                        <button type="button" class="btn btn-link text-muted text-decoration-none small me-3"
                            onclick="cerrarOTP(true)">Cancelar</button>
                        <button type="button" class="btn btn-dark btn-sm px-4" onclick="confirmarFirmaOTP()">Confirmar
                            Firma</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- PESTAÑA: HISTORIAL -->
        <div class="tab-pane fade" id="tab-historial" role="tabpanel">
            <div class="bg-white gob-card rounded-2xl overflow-hidden p-8 shadow-sm">
                <div class="flex justify-between items-center mb-8 border-b border-slate-50 pb-4">
                    <h5 class="font-bold text-slate-700 uppercase text-sm tracking-wide flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary-blue text-2xl">history_edu</span> Bitácora
                        de Auditoría Completa
                    </h5>
                </div>
                <div class="space-y-4 mb-6 min-h-[100px]" id="lista_bitacora"></div>
                <div id="paginacion_bitacora"
                    class="flex justify-center items-center gap-2 pt-6 border-t border-slate-50"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMapa" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Mapa de
                    Relaciones (Multi-Ancestro)</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-0">
                <div id="network-container"></div>
            </div>
            <div class="p-6 bg-slate-50 flex justify-between items-center border-t">
                <div class="text-[11px] text-slate-400 font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">mouse</span> Navegue con el ratón (zoom y arrastre).
                </div>
                <button type="button"
                    class="bg-slate-800 text-white px-6 py-2 rounded-xl text-xs font-bold uppercase tracking-widest"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNuevoComentario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Agregar
                    Comentario</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-8">
                <div class="space-y-2">
                    <label class="label-custom">Su Comentario u Observación</label>
                    <textarea class="w-full rounded-2xl border-slate-200 text-sm p-4 focus:ring-primary-blue"
                        id="textoNuevoComentario" rows="4" placeholder="Escriba aquí..."></textarea>
                </div>
            </div>
            <div class="p-6 bg-slate-50 border-t flex justify-end gap-3">
                <button type="button" class="text-slate-400 font-bold text-xs uppercase px-4"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button"
                    class="bg-primary-blue text-white font-bold py-2.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 text-xs uppercase"
                    onclick="guardarComentario()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Establecer Dependencia -->
<div class="modal fade" id="modalEstablecerDependencia" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Establecer Dependencia (Vincular Padre)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="small text-muted mb-4">Seleccione una de sus solicitudes activas para que sea la
                    <strong>antecesora</strong> de la solicitud actual.
                </p>
                <div class="input-group input-group-sm mb-4">
                    <span class="input-group-text bg-white border-end-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input type="text" class="form-control border-start-0" id="buscar_padre"
                        placeholder="Filtrar por título o ID...">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Estado</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_solicitudes_padre" class="small">
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Cargando solicitudes...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/permisos.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/ver.js"></script>

<script>
    // Lógica adicional para Visación y Respuestas
    let isRechazando = false;

    // Poblar la tabla de visación cuando los datos estén listos
    const originalRenderizarIngreso = window.renderizarIngreso;
    window.renderizarIngreso = function (data) {
        if (typeof originalRenderizarIngreso === 'function') {
            originalRenderizarIngreso(data);
        }
        renderizarTablaVisacion(data.destinos || []);
    };

    function renderizarTablaVisacion(destinos) {
        const tabla = document.getElementById('tabla_destinos_status');
        if (!tabla) return;
        tabla.innerHTML = '';

        destinos.forEach(dest => {
            let estadoColors = 'bg-slate-50 text-slate-400 border-slate-100';
            let estadoLabel = 'Pendiente';

            if (dest.tid_responde == 1) {
                estadoColors = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                estadoLabel = 'Aprobado';
            } else if ((dest.tid_responde == 0 || dest.tid_responde === '0') && dest.tid_fecha_respuesta) {
                estadoColors = 'bg-rose-50 text-rose-600 border-rose-100';
                estadoLabel = 'Rechazado';
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4">
                    <div class="font-bold text-slate-700 text-sm">${dest.usr_nombre} ${dest.usr_apellido}</div>
                    <div class="text-[10px] text-slate-400">${dest.usr_email}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase border bg-blue-50 text-primary-blue border-blue-100">${dest.tid_facultad}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    ${dest.tid_requeido == 1 ? '<span class="material-symbols-outlined text-emerald-500">check_circle</span>' : '-'}
                </td>
                <td class="px-6 py-4 text-right">
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase border ${estadoColors}">${estadoLabel}</span>
                </td>
            `;
            tabla.appendChild(row);
        });
    }

    async function aprobarVisacion() {
        const { isConfirmed } = await Swal.fire({
            title: '¿Confirmar Visación?',
            text: "Su aprobación permitirá que el flujo continúe.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1a5f9c',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, Aprobar',
            cancelButtonText: 'Cancelar'
        });

        if (isConfirmed) {
            Swal.fire({ title: 'Procesando...', didOpen: () => Swal.showLoading() });
            try {
                const urlParams = new URLSearchParams(window.location.search);
                const id = urlParams.get('id');

                // 1. Responder Favorablemente
                await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        ACCION: 'RESPONDER',
                        ing_id: id,
                        tis_estado: 'Resuelto_Favorable',
                        tis_respuesta: 'Visación aprobada por responsable.'
                    })
                });

                // 2. Cambiar estado a "Visado" (Como pide el usuario)
                await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        ACCION: 'ACTUALIZAR_ESTADO',
                        ing_id: id,
                        ing_estado_entrega: 'Visado'
                    })
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Aprobado y Visado',
                    text: 'La visación ha sido registrada correctamente.',
                    timer: 2000
                }).then(() => location.reload());

            } catch (e) {
                console.error(e);
                Swal.fire('Error', 'No se pudo procesar la visación', 'error');
            }
        }
    }

    function rechazarVisacion() {
        isRechazando = true;
        const modal = new bootstrap.Modal(document.getElementById('modalNuevoComentario'));
        modal.show();
    }

    const originalGuardarComentario = window.guardarComentario;
    window.guardarComentario = async function () {
        if (!isRechazando) {
            if (typeof originalGuardarComentario === 'function') originalGuardarComentario();
            return;
        }

        const texto = document.getElementById('textoNuevoComentario').value.trim();
        if (!texto) {
            Swal.fire('Atención', 'Debe indicar por qué fue rechazada la visación.', 'warning');
            return;
        }

        Swal.fire({ title: 'Rechazando...', didOpen: () => Swal.showLoading() });
        try {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            await fetch(`${window.API_BASE_URL}/ingresos/ingresos.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    ACCION: 'RESPONDER',
                    ing_id: id,
                    tis_estado: 'Resuelto_NO_Favorable',
                    tis_respuesta: 'Visación Rechazada: ' + texto
                })
            });

            Swal.fire({
                icon: 'error',
                title: 'Visación Rechazada',
                text: 'Se ha registrado el rechazo y el comentario.',
                timer: 2000
            }).then(() => location.reload());

        } catch (e) {
            console.error(e);
            Swal.fire('Error', 'No se pudo registrar el rechazo', 'error');
        }
    };
</script>

<?php include '../../api/general/footer.php'; ?>