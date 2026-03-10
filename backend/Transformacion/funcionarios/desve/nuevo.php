<?php
$pageTitle = "DESVE";
require_once '../../api/general/auth_check.php';
include '../../api/general/header.php';
?>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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

    .input-readonly-dashed {
        background-color: #f9fafb !important;
        border-style: dashed !important;
        border-width: 1.5px !important;
    }

    .drop-zone {
        border: 2px dashed #E0FFFF;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background-color: #F0FFFF;
    }

    .drop-zone:hover {
        border-color: #1a5f9c;
        background-color: #e0f2fe;
    }
</style>

<div class="max-w-[1400px] mx-auto p-4 lg:p-8 space-y-6">
    <form id="form_nuevo_desve" enctype="multipart/form-data">
        <input type="hidden" id="Responsable" name="Responsable">
        <input type="hidden" id="Plazo" name="Plazo" value="10">

        <div
            class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6 sticky top-4 z-20">
            <div class="space-y-1 w-full text-left">
                <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Crear Nueva Solicitud</h1>
                <p class="text-slate-400 text-sm lg:text-[15px] font-medium">Complete los campos para ingresar un nuevo
                    requerimiento.</p>
            </div>

            <div class="flex items-center gap-4 w-full lg:w-auto justify-end">
                <a class="text-slate-400 font-bold hover:text-slate-600 transition-all text-[13px] uppercase tracking-wider"
                    href="index.php">Cancelar</a>
                <button type="submit"
                    class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-primary-blue hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px]">save</span> GUARDAR SOLICITUD
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-4">

            <div class="lg:col-span-8 space-y-6">

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                        <span class="material-symbols-outlined text-primary-blue">edit_document</span>
                        <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">1. Información de la
                            Solicitud</h3>
                    </div>

                    <div class="p-6 lg:p-10 space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="md:col-span-3 space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre del
                                    Expediente</label>
                                <input type="text" id="NombreExpediente" placeholder="Ej: Consulta por Luminaria"
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3 bg-[#D3D3D3]/20"
                                    required />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right block">Código
                                    DESVE</label>
                                <input type="text" id="Codigo_DESVE" placeholder="123"
                                    class="w-full text-center font-mono text-lg text-primary-blue bg-blue-50 py-3 rounded-xl border border-blue-100 font-bold" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-left block">Reingreso</label>
                            <div class="flex shadow-sm h-[48px]">
                                <input type="text" id="ReingresoDisplay" readonly
                                    placeholder="Seleccione solicitud previa..."
                                    class="flex-grow border-slate-200 rounded-l-xl text-[15px] italic input-readonly-dashed px-4" />
                                <input type="hidden" id="Reingreso" value="">
                                <button type="button" onclick="abrirModalReingreso()"
                                    class="bg-slate-800 text-white px-6 rounded-r-xl transition-colors"><span
                                        class="material-symbols-outlined">search</span></button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo de
                                    Solicitante</label>
                                <select id="ID_Organizacion" required
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3 bg-[#D3D3D3]/20">
                                    <option value="" disabled selected>Seleccione tipo...</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre de
                                    la entidad/Vecino</label>
                                <div class="flex shadow-sm h-[48px]">
                                    <input type="text" id="OrigenSolicitudDisplay" readonly
                                        placeholder="Seleccione organización..."
                                        class="flex-grow border-slate-200 rounded-l-xl text-[15px] input-readonly-dashed px-4" />
                                    <input type="hidden" id="OrigenSolicitud" required>
                                    <button type="button" onclick="abrirModalBuscarOrganizacion()"
                                        id="btn_buscar_origen"
                                        class="bg-slate-100 px-4 border-y border-slate-200 flex items-center text-slate-600"><span
                                            class="material-symbols-outlined">search</span></button>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha de
                                    Recepción</label>
                                <input type="date" id="FechaUltimaRecepcion" required
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3 bg-[#D3D3D3]/20" />
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Sector</label>
                                <select id="Sector" required
                                    class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-3 bg-[#D3D3D3]/20"></select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Detalle de
                                Ingreso</label>
                            <textarea id="DetalleIngreso" name="DetalleIngreso" rows="4"
                                class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-4 bg-[#D3D3D3]/30 italic"
                                placeholder="Escriba el detalle aquí..." required></textarea>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Observaciones</label>
                            <textarea id="Observaciones" rows="2"
                                class="w-full border-slate-200 rounded-xl focus:ring-primary-blue text-[15px] p-4 bg-[#D3D3D3]/30"
                                placeholder="Comentarios adicionales..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">location_on</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">2. Geolocalización</h3>
                        </div>
                        <div class="flex items-center bg-slate-100 px-4 py-2 rounded-xl">
                            <input type="checkbox" id="chk_geoloc"
                                class="w-4 h-4 text-primary-blue border-slate-300 rounded focus:ring-primary-blue cursor-pointer">
                            <label for="chk_geoloc"
                                class="ml-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest cursor-pointer">Activar
                                Mapa</label>
                        </div>
                    </div>
                    <div id="geolocalizacion_area" class="px-6 py-2 lg:px-10 lg:py-4 space-y-6 hidden">
                        <div class="grid grid-cols-1 ">
                            <div class="md:col-span-2 space-y-2">
                                <label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección</label>
                                <div class="flex shadow-sm h-[48px]"><input type="text" id="Geo_dir"
                                        placeholder="Calle, número"
                                        class="flex-grow border-slate-200 rounded-l-xl px-4" /><button type="button"
                                        id="btn_buscar_geo" class="bg-slate-800 text-white px-6 rounded-r-xl"><span
                                            class="material-symbols-outlined">search</span></button></div>
                            
                            <input
                                    type="hidden" id="Latitud" readonly
                                    class="w-full border-slate-200 rounded-xl text-sm bg-slate-50 p-3" />
                                <input
                                    type="hidden" id="Longitud" readonly
                                    class="w-full border-slate-200 rounded-xl text-sm bg-slate-50 p-3" />

                                        </div>
                            
                        </div>
                        <div id="map_desve" style="height: 400px;" class="w-full border border-slate-100 rounded-2xl">
                        </div>
                    </div>
                </div>

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">group_add</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">3. Destinatarios</h3>
                        </div>
                        <button type="button" onclick="abrirModalBuscarFuncionario()"
                            class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-2 px-5 rounded-xl text-[11px] uppercase tracking-wider transition-all">
                            <span class="material-symbols-outlined text-sm">person_add</span> Buscar Funcionario
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[14px]" id="tabla_destinos">
                            <thead
                                class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px] tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Funcionario</th>
                                    <th class="px-6 py-4 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_destinos" class="divide-y divide-slate-50 text-slate-600 italic">
                                <tr id="placeholder_destinos">
                                    <td colspan="2" class="px-6 py-10 text-center text-slate-400">No hay destinatarios
                                        agregados.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-[#D3D3D3] border border-slate-300 rounded-3xl p-8 shadow-sm space-y-6">
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">analytics</span> Información Automática
                    </h2>
                    <div class="space-y-2"><label
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Prioridad
                            Estimada</label><input type="text" id="Prioridad" name="Prioridad" readonly
                            value="Calculando..."
                            class="w-full bg-white/50 border border-slate-200 rounded-xl text-xl font-black text-gob-warning text-center py-4 focus:ring-0" />
                    </div>
                    <div class="space-y-2 border-t border-slate-300 pt-6"><label
                            class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Vencimiento
                            Proyectado</label><input type="text" id="FechaVecimiento" name="FechaVecimiento" readonly
                            value="Pendiente"
                            class="w-full bg-white/50 border border-slate-200 rounded-xl text-xl font-black text-slate-700 text-center py-4 focus:ring-0" />
                    </div>
                </div>

                <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                    <div class="p-5 border-b border-cyan-border flex items-center gap-2"><span
                            class="material-symbols-outlined text-primary-blue text-[20px]">attach_file</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Documentos Adjuntos</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="drop-zone" id="drop_zone">
                            <input type="file" id="inputArchivosSolicitud" hidden multiple><span
                                class="material-symbols-outlined text-slate-300 text-4xl mb-2">cloud_upload</span>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Arrastre o haga
                                clic aquí</p>
                        </div>
                        <div id="listaArchivosSolicitud" class="space-y-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modales -->


<!-- Si no están en un archivo aparte, incluirlos directamente del original -->
<div class="modal fade" id="modalFuncionarios" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Interno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="row g-2 p-3">
                <div class="col-md-7">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="buscar_fnc_input"
                            placeholder="Buscar por nombre o apellido...">
                    </div>
                </div>
                <div class="col-md-5">
                    <select class="form-select form-select-sm" id="filtro_area_fnc">
                        <option value="">Todas las Áreas</option>
                        <option value="SIN_AREA">Sin Área Asignada</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive p-3" style="max-height: 400px;">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Funcionario</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="lista_busqueda_fnc" class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReingreso" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Solicitud para Reingreso</h5><button type="button"
                    class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <input type="text" class="form-control form-control-sm mb-3" id="filtroReingreso"
                    placeholder="Buscar por código DESVE o nombre de expediente...">
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>Código</th>
                                <th>Expediente</th>
                                <th>Fecha</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_reingreso" class="small"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBuscarOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Organización</h5><button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex mb-3"><input type="text" class="form-control form-control-sm me-2"
                        id="filtroOrganizacion" placeholder="Filtrar por nombre o RUT..."><button type="button"
                        class="btn btn-sm btn-dark" onclick="abrirModalNuevaOrganizacion()">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button></div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_org" class="small"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva Organización -->
<div class="modal fade" id="modalNuevaOrganizacion" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Nueva Organización</h5><button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_nueva_organizacion">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label small fw-bold">RUT *</label><input type="text"
                                class="form-control" id="orgc_rut" required></div>
                        <div class="col-12"><label class="form-label small fw-bold">Nombre *</label><input type="text"
                                class="form-control" id="orgc_nombre" required></div>
                        <div class="col-6"><label class="form-label small fw-bold">Código</label><input type="text"
                                class="form-control" id="orgc_codigo"></div>
                        <div class="col-6"><label class="form-label small fw-bold">RPJ</label><input type="text"
                                class="form-control" id="orgc_rpj"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0"><button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarNuevaOrganizacion()">Guardar</button></div>
        </div>
    </div>
</div>

<!-- Modal Buscar Contribuyente -->
<div class="modal fade" id="modalBuscarContribuyente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Persona / Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-3">
                <div class="d-flex gap-2">
                    <input type="text" id="filtroContribuyente" class="form-control form-control-sm"
                        placeholder="Buscar por nombre o RUT...">
                    <button type="button" class="btn btn-sm btn-dark" onclick="abrirModalNuevoContribuyente()">+
                        NUEVO</button>
                </div>
            </div>
            <div class="table-responsive p-3" style="max-height: 400px;">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>RUT</th>
                            <th>Nombre Completo</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="lista_busqueda_contrib" class="small"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Contribuyente -->
<div class="modal fade" id="modalNuevoContribuyente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Nuevo Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_nuevo_contribuyente">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label small fw-bold">RUT *</label><input type="text"
                                id="nc_rut" required class="form-control form-control-sm"></div>
                        <div class="col-12"><label class="form-label small fw-bold">Nombres *</label><input type="text"
                                id="nc_nombre" required class="form-control form-control-sm"></div>
                        <div class="col-6"><label class="form-label small fw-bold">Apellido Paterno *</label><input
                                type="text" id="nc_paterno" required class="form-control form-control-sm"></div>
                        <div class="col-6"><label class="form-label small fw-bold">Apellido Materno</label><input
                                type="text" id="nc_materno" class="form-control form-control-sm"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarNuevoContribuyente()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../recursos/js/funcionarios/desve/nuevo.js"></script>
<script src="../../recursos/js/helpers.js"></script>
<script>
    document.getElementById('chk_geoloc').addEventListener('change', function () {
        const area = document.getElementById('geolocalizacion_area');
        area.classList.toggle('hidden', !this.checked);
        if (this.checked && typeof initMap === 'function') { setTimeout(() => { if (window.map) google.maps.event.trigger(window.map, 'resize'); }, 100); }
    });
</script>

<?php use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey(); ?>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places&callback=initMap"
    async defer></script>
<?php include '../../api/general/footer.php'; ?>