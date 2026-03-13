<?php
$pageTitle = "Nuevo Ingreso";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';

use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places&callback=initMap" async defer></script>

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
        vertical-align: middle;
        line-height: 1;
    }

    .gob-card {
        border: 1px solid rgba(226, 232, 240, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .drop-zone {
        border: 2px dashed #E0FFFF;
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background-color: #F0FFFF;
    }

    .drop-zone:hover {
        border-color: #1a5f9c;
        background-color: #e0f2fe;
    }

    /* Estilos para asegurar que los modales de Bootstrap se vean bien con Tailwind */
    .modal-backdrop {
        z-index: 1040 !important;
    }

    .modal {
        z-index: 1050 !important;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">
    <form id="form_crear_ingreso">

        <div
            class="bg-white border border-slate-100 rounded-3xl p-6 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6 sticky top-4 z-20">
            <div class="space-y-1">
                <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Crear Nuevo Ingreso</h1>
                <p class="text-slate-400 text-sm font-medium">Complete la información para iniciar el flujo documental.
                </p>
            </div>

            <div class="flex items-center gap-4 w-full lg:w-auto justify-end">
                <button type="button" onclick="location.href='index.php'"
                    class="text-slate-400 font-bold hover:text-slate-600 transition-all text-[13px] uppercase tracking-wider">Cancelar</button>
                <button type="submit"
                    class="flex items-center gap-2 bg-primary-blue hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px]">save</span> ENVIAR INGRESO
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-4">

            <div class="lg:col-span-7 space-y-6">

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                        <span class="text-primary-blue font-bold">1.</span>
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Información General</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="space-y-2">
                            <label for="tis_titulo"
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Título del
                                Ingreso</label>
                            <input type="text" id="tis_titulo" placeholder="Ej: Solicitud de Permiso de Edificación"
                                class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3"
                                required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="tis_tipo"
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo de
                                    Documento</label>
                                <select id="tis_tipo" required
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3">
                                    <option value="" selected disabled>Cargando tipos...</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="tis_fecha_limite"
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha de
                                    Vencimiento</label>
                                <input type="date" id="tis_fecha_limite"
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3" />
                                <p class="text-[10px] text-slate-400 italic">Por defecto: 20 días hábiles.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="tis_tipo_solicitante"
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo solicitante</label>
                                <select id="tis_tipo_solicitante"
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3">
                                    <option value="" selected disabled>Seleccione tipo...</option>
                                    <option value="natural">Persona Natural</option>
                                    <option value="juridica">Persona Jurídica</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="tis_nombre_solicitante"
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre del solicitante</label>
                                <div class="flex shadow-sm">
                                    <input type="text" id="tis_nombre_solicitante" readonly placeholder="Seleccione un solicitante..."
                                        class="flex-grow border-slate-200 rounded-l-xl focus:ring-primary-blue text-[15px] p-3 bg-slate-50 italic" />
                                    <input type="hidden" id="tis_id_solicitante">
                                    <button type="button" id="btn_buscar_solicitante"
                                        class="bg-slate-800 text-white px-4 rounded-r-xl hover:bg-black transition-colors flex items-center">
                                        <span class="material-symbols-outlined">search</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="tis_contenido"
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Contenido /
                                Providencia</label>
                            <textarea id="tis_contenido" rows="8" placeholder="Detalle aquí la solicitud..."
                                class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-4 bg-slate-50 italic focus:bg-white transition-all"></textarea>
                        </div>
                    </div>
                </div>

                <!-- BLOQUE 2: GEOLOCALIZACIÓN -->
                <div class="bg-white gob-card rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">location_on</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">2. Geolocalización</h3>
                        </div>
                        <div class="flex items-center bg-slate-100 px-4 py-2 rounded-xl">
                            <input type="checkbox" id="chk_geoloc"
                                class="w-4 h-4 text-primary-blue border-slate-300 rounded focus:ring-primary-blue cursor-pointer">
                            <label for="chk_geoloc"
                                class="ml-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest cursor-pointer">Activar Mapa</label>
                        </div>
                    </div>
                    <div id="geolocalizacion_area" class="px-6 py-6 lg:px-10 space-y-6 hidden">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección</label>
                            <div class="flex shadow-sm">
                                <input type="text" id="Geo_dir" placeholder="Calle, número, Viña del Mar"
                                    class="flex-grow border-slate-200 rounded-l-xl px-4 py-3 text-sm focus:ring-primary-blue" />
                                <button type="button" id="btn_buscar_geo" 
                                    class="bg-slate-800 text-white px-6 rounded-r-xl hover:bg-black transition-colors">
                                    <span class="material-symbols-outlined">search</span>
                                </button>
                            </div>
                            <input type="hidden" id="Latitud">
                            <input type="hidden" id="Longitud">
                        </div>
                        <div id="map_desve" style="height: 400px;" class="w-full border border-slate-100 rounded-2xl"></div>
                    </div>
                </div>

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                        <span class="material-symbols-outlined text-primary-blue">upload_file</span>
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">3. Adjuntos y Enlaces</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Enlaces
                                Externos</label>
                            <div class="flex gap-2">
                                <input type="text" id="input_enlace" placeholder="https://..."
                                    class="flex-1 rounded-xl border-slate-200 text-sm focus:ring-primary-blue">
                                <button type="button" id="btn_agregar_enlace"
                                    class="bg-slate-800 text-white px-3 rounded-xl flex items-center hover:bg-black transition-colors">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                            <div id="lista_enlaces" class="space-y-2 max-h-[150px] overflow-y-auto"></div>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Documentos
                                Adjuntos</label>
                            <div class="drop-zone" id="drop_zone">
                                <input type="file" id="input_archivo" hidden multiple>
                                <span class="material-symbols-outlined text-slate-300 text-3xl mb-1">cloud_upload</span>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Click para adjuntar</p>
                            </div>
                            <div id="lista_documentos" class="space-y-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white gob-card rounded-2xl overflow-hidden sticky top-32">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">group_add</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">4. Distribución y Flujo</h3>
                        </div>
                        <span
                            class="bg-slate-100 text-slate-500 text-[10px] px-2 py-1 rounded font-bold uppercase border border-slate-200">Funcionarios
                            Involucrados</span>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-3 flex items-start gap-3 rounded-r-lg">
                            <span class="material-symbols-outlined text-blue-500 text-xl">info</span>
                            <p class="text-blue-700 text-[11px] leading-tight">
                                <strong>Nota:</strong> Los responsables solo recibirán el documento una vez que todos
                                los visadores hayan aprobado en cadena.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <label
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest block">Seleccionar
                                Destinatario</label>
                            <button type="button" onclick="abrirModalBuscarFuncionario()"
                                class="w-full flex items-center justify-between bg-slate-50 border border-slate-200 hover:border-primary-blue p-3 rounded-xl text-slate-500 transition-all group">
                                <span class="text-sm">Haga clic para buscar en la base de datos...</span>
                                <span
                                    class="material-symbols-outlined group-hover:text-primary-blue">person_search</span>
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left" id="tabla_destinos">
                                <thead
                                    class="bg-slate-50 text-slate-400 font-bold uppercase text-[9px] tracking-widest">
                                    <tr>
                                        <th class="px-2 py-3">Funcionario(a)</th>
                                        <th class="px-2 py-3 text-center">Rol</th>
                                        <th class="px-2 py-3 text-right">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_destinos" class="divide-y divide-slate-50">
                                    <tr id="placeholder_destinos">
                                        <td colspan="3" class="px-2 py-10 text-center text-slate-400 italic text-xs">
                                            No hay destinatarios agregados. Utilice el buscador para añadir personal.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div
                        class="bg-slate-50 p-4 border-t border-slate-100 flex justify-between items-center text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                        <span>Total Visadores: <strong id="countVisadores" class="text-primary-blue">0</strong></span>
                        <span>Total Responsables: <strong id="countResponsables"
                                class="text-primary-blue">0</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modalBusquedaFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-800 border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Buscar Funcionario Destino</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-6">
                <div class="row g-2 mb-4">
                    <div class="col-md-7">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start-xl">
                                <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
                            </span>
                            <input type="text" class="form-control border-start-0 rounded-end-xl text-sm"
                                id="buscar_fnc_input" placeholder="Buscar por nombre o apellido...">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <select class="form-select rounded-xl text-sm" id="filtro_area_fnc">
                            <option value="">Todas las Áreas</option>
                            <option value="SIN_AREA">Sin Área Asignada</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase text-[10px] tracking-widest sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="text-xs">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfigurarDestino" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-primary-blue border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Configurar Atribuciones</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-6">
                <div class="mb-4 text-center">
                    <div class="inline-block p-3 bg-blue-50 rounded-full mb-2">
                        <span class="material-symbols-outlined text-primary-blue text-3xl">manage_accounts</span>
                    </div>
                    <h6 id="fnc_nombre_config" class="font-bold text-slate-800 italic uppercase text-sm tracking-wide">
                    </h6>
                    <input type="hidden" id="fnc_id_config">
                </div>

                <div class="space-y-4">
                    <div style="display: none;">
                        <select id="m_destino_tipo">
                            <option value="Para" selected>Para</option>
                        </select>
                    </div>

                    <div>
                        <label for="m_destino_facultad"
                            class="text-[11px] font-bold text-slate-400 uppercase block mb-1">Facultad / Rol</label>
                        <select class="form-select rounded-xl text-sm w-full border-slate-200 focus:ring-primary-blue"
                            id="m_destino_facultad">
                            <option value="Responsable">Responsable (Acción directa)</option>
                            <option value="Firmante">Firmante (Firma digital)</option>
                            <option value="Visador">Visador (Revisión/Aprobación)</option>
                            <option value="Lector">Lector (Solo lectura)</option>
                        </select>
                    </div>

                    <div id="container_m_destino_tarea">
                        <label for="m_destino_tarea"
                            class="text-[11px] font-bold text-slate-400 uppercase block mb-1">Labor a Realizar</label>
                        <select class="form-select rounded-xl text-sm w-full border-slate-200 focus:ring-primary-blue"
                            id="m_destino_tarea">
                            <option value="ejecutar lo requerido">Ejecutar lo requerido</option>
                            <option value="generar informe">Generar informe técnico</option>
                            <option value="tomar conocimiento">Tomar conocimiento</option>
                            <option value="responder al remitente">Responder al remitente</option>
                        </select>
                    </div>

                    <div class="pt-2">
                        <div class="d-flex align-items-center bg-light p-3 rounded-3 border">
                            <div class="form-check form-switch m-0 p-0" style="min-width: 50px;">
                                <input class="form-check-input m-0 cursor-pointer" type="checkbox"
                                    id="m_destino_requerido" checked role="switch"
                                    style="width: 2.4em; height: 1.2em; float: none; position: relative; cursor: pointer;">
                            </div>
                            <label class="form-check-label text-sm font-semibold text-secondary mb-0"
                                for="m_destino_requerido" style="margin-left: 12px; cursor: pointer;">
                                Requiere Respuesta Formal
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-slate-50 border-0 p-4">
                <button type="button"
                    class="btn btn-link text-slate-400 text-decoration-none text-[11px] uppercase font-bold"
                    data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button"
                    class="bg-primary-blue hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-[11px] font-bold uppercase shadow-lg transition-all"
                    id="btn_confirmar_destino">
                    Agregar a la Lista
                </button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../recursos/js/funcionarios/ingresos/crear.js"></script>
<script src="../../recursos/js/helpers.js"></script>

<!-- MODALES DE BÚSQUEDA DE SOLICITANTES (REPLICADOS DE DESVE) -->

<!-- Modal Buscar Organización -->
<div class="modal fade" id="modalBuscarOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-800 border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Buscar Organización / Entidad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-6">
                <div class="d-flex mb-4 gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-xl">
                            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
                        </span>
                        <input type="text" class="form-control border-start-0 rounded-end-xl text-sm"
                            id="filtroOrganizacion" placeholder="Filtrar por nombre o RUT...">
                    </div>
                    <button type="button" class="bg-primary-blue text-white px-4 rounded-xl hover:bg-blue-700 transition-colors flex items-center"
                        onclick="abrirModalNuevaOrganizacion()">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase text-[10px] tracking-widest sticky-top">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_org" class="text-xs text-slate-600">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva Organización -->
<div class="modal fade" id="modalNuevaOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-primary-blue border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Nueva Organización</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-6">
                <form id="form_nueva_organizacion" class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RUT *</label>
                        <input type="text" class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3" id="orgc_rut" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre *</label>
                        <input type="text" class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3" id="orgc_nombre" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Código</label>
                            <input type="text" class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3" id="orgc_codigo">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RPJ</label>
                            <input type="text" class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3" id="orgc_rpj">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-slate-50 border-0 p-4">
                <button type="button" class="text-slate-400 font-bold text-[11px] uppercase" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="bg-primary-blue text-white px-6 py-2 rounded-xl font-bold text-[11px] uppercase shadow-lg"
                    onclick="guardarNuevaOrganizacion()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Contribuyente -->
<div class="modal fade" id="modalBuscarContribuyente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-800 border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Buscar Persona / Contribuyente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-6">
                <div class="d-flex mb-4 gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-xl">
                            <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
                        </span>
                        <input type="text" class="form-control border-start-0 rounded-end-xl text-sm"
                            id="filtroContribuyente" placeholder="Buscar por nombre o RUT...">
                    </div>
                    <button type="button" class="bg-primary-blue text-white px-4 rounded-xl hover:bg-blue-700 transition-colors flex items-center"
                        onclick="abrirModalNuevoContribuyente()">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase text-[10px] tracking-widest sticky-top">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Completo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_contrib" class="text-xs text-slate-600">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Contribuyente -->
<div class="modal fade" id="modalNuevoContribuyente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-primary-blue border-0 py-4">
                <h5 class="modal-title text-white fw-bold fs-6">Nuevo Contribuyente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-6">
                <form id="form_nuevo_contribuyente" class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RUT *</label>
                        <input type="text" id="nc_rut" required class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombres *</label>
                        <input type="text" id="nc_nombre" required class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Apellido Paterno *</label>
                            <input type="text" id="nc_paterno" required class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Apellido Materno</label>
                            <input type="text" id="nc_materno" class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-sm p-3">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-slate-50 border-0 p-4">
                <button type="button" class="text-slate-400 font-bold text-[11px] uppercase" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="bg-primary-blue text-white px-6 py-2 rounded-xl font-bold text-[11px] uppercase shadow-lg"
                    onclick="guardarNuevoContribuyente()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php include '../../api/general/footer.php'; ?>