<?php
$pageTitle = "Modificar Solicitud DESVE";
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
    <form id="form_modificar_desve">

        <div
            class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col lg:flex-row justify-between items-start lg:items-center shadow-sm gap-6 sticky top-4 z-20">
            <div class="space-y-1 w-full text-left">
                <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight" id="header_public_id">
                    Modificar Solicitud</h1>
                <p class="text-slate-400 text-sm lg:text-[15px] font-medium" id="header_expediente">Actualice los campos
                    requeridos de la solicitud.</p>
            </div>

            <div class="flex items-center gap-4 w-full lg:w-auto justify-end">
                <button type="button" id="btn_cancelar_toolbar"
                    class="text-slate-400 font-bold hover:text-slate-600 transition-all text-[13px] uppercase tracking-wider">Cancelar</button>
                <button type="submit"
                    class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-primary-blue hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200/50 transition-all text-[13px] uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[20px]">save</span> GUARDAR CAMBIOS
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
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center block">Reingreso</label>
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
                    <div id="geolocalizacion_area" class="p-6 lg:p-10 space-y-6 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-2 space-y-2">
                                <label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección</label>
                                <div class="flex shadow-sm h-[48px]"><input type="text" id="Geo_dir"
                                        placeholder="Calle, número"
                                        class="flex-grow border-slate-200 rounded-l-xl px-4" /><button type="button"
                                        id="btn_buscar_geo" class="bg-slate-800 text-white px-6 rounded-r-xl"><span
                                            class="material-symbols-outlined">search</span></button></div>
                            </div>
                            <div class="space-y-2"><label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Latitud</label><input
                                    type="text" id="Latitud" readonly
                                    class="w-full border-slate-200 rounded-xl text-sm bg-slate-50 p-3" /></div>
                            <div class="space-y-2"><label
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Longitud</label><input
                                    type="text" id="Longitud" readonly
                                    class="w-full border-slate-200 rounded-xl text-sm bg-slate-50 p-3" /></div>
                        </div>
                        <div id="map_desve" style="height: 400px;"
                            class="w-full border border-slate-100 rounded-2xl shadow-inner"></div>
                    </div>
                </div>

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 flex items-center justify-between bg-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-blue">group_add</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">3. Destinatarios</h3>
                        </div>
                        <button type="button" onclick="abrirModalBuscarFuncionario()"
                            class="flex items-center gap-2 bg-slate-800 hover:bg-black text-white font-bold py-1.5 px-4 rounded-lg text-[10px] uppercase tracking-wider transition-all">
                            <span class="material-symbols-outlined text-sm">person_add</span> Agregar
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[14px]" id="tabla_destinos">
                            <thead
                                class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px] tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-3">Funcionario</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_destinos" class="divide-y divide-slate-50 text-slate-600 italic">
                                <tr id="placeholder_destinos">
                                    <td colspan="3" class="px-6 py-8 text-center text-slate-400">Cargando
                                        destinatarios...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white gob-card rounded-2xl overflow-hidden">
                    <div class="p-5 border-b border-slate-50 bg-slate-50/50">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-gob-success">forum</span>
                            <h3 class="font-bold text-slate-700 uppercase text-sm tracking-wide">Bitácora de Respuestas
                            </h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left" id="tabla_respuestas">
                            <thead
                                class="bg-slate-50 text-slate-400 uppercase text-[10px] font-bold tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4">Fecha</th>
                                    <th class="px-6 py-4">Funcionario</th>
                                    <th class="px-6 py-4">Acción</th>
                                    <th class="px-6 py-4">Contenido</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_respuestas" class="divide-y divide-slate-50 text-[13px] text-slate-600">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">

                <div class="bg-[#D3D3D3] border border-slate-300 rounded-3xl p-8 shadow-sm space-y-6">
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">settings_suggest</span> Estado y Tiempos
                    </h2>

                    <div class="space-y-3">
                        <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Estado de
                            Entrega</label>
                        <div class="flex p-1 bg-white/50 rounded-xl border border-slate-200 shadow-inner">
                            <input type="radio" name="EstadoEntrega" id="estadoPendiente" value="0"
                                class="hidden peer/p">
                            <label for="estadoPendiente"
                                class="flex-1 text-center py-2 text-[11px] font-bold rounded-lg cursor-pointer peer-checked/p:bg-gob-warning peer-checked/p:text-white text-slate-500 transition-all uppercase">Pendiente</label>

                            <input type="radio" name="EstadoEntrega" id="estadoRespondido" value="1"
                                class="hidden peer/r">
                            <label for="estadoRespondido"
                                class="flex-1 text-center py-2 text-[11px] font-bold rounded-lg cursor-pointer peer-checked/r:bg-gob-success peer-checked/r:text-white text-slate-500 transition-all uppercase">Respondido</label>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t border-slate-300 pt-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Días
                                Transcurridos</label>
                            <input type="text" id="info_dias_ingreso" readonly
                                class="w-full bg-white/40 border-none rounded-xl text-lg font-black text-slate-700 text-center focus:ring-0" />
                        </div>
                        <div class="space-y-1">
                            <label
                                class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Restantes</label>
                            <input type="text" id="info_dias_vencimiento" readonly
                                class="w-full bg-white/40 border-none rounded-xl text-lg font-black text-slate-700 text-center focus:ring-0" />
                        </div>
                    </div>
                </div>

                <div class="bg-soft-cyan border border-cyan-border rounded-2xl overflow-hidden shadow-sm">
                    <div class="p-5 border-b border-cyan-border flex items-center gap-2"><span
                            class="material-symbols-outlined text-primary-blue text-[20px]">attach_file</span>
                        <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Documentos</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div id="lista_documentos_guardados" class="space-y-2 mb-4"></div>
                        <div class="drop-zone" id="drop_zone">
                            <input type="file" id="inputArchivosSolicitud" hidden multiple><span
                                class="material-symbols-outlined text-slate-300 text-3xl mb-1">cloud_upload</span>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Subir nuevos
                                archivos</p>
                        </div>
                        <div id="listaArchivosSolicitud" class="space-y-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="idIngreso">
        <input type="hidden" id="IngresoDesve">
        <input type="hidden" id="Prioridad">
        <input type="hidden" id="FechaVecimiento">
        <input type="hidden" id="Reingresado">
        <input type="hidden" id="Responsable">
    </form>
</div>

<div class="modal fade" id="modalFuncionarios" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Buscar
                    Funcionario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <input type="text" class="rounded-xl border-slate-200 text-sm" id="buscar_fnc_input"
                        placeholder="Nombre o apellido...">
                    <select class="rounded-xl border-slate-200 text-sm" id="filtro_area_fnc">
                        <option value="">Todas las Áreas</option>
                    </select>
                </div>
                <div class="table-responsive max-h-[400px] rounded-xl border border-slate-100">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase border-b">
                            <tr>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="text-[13px] text-slate-600"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReingreso" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-2xl rounded-3xl overflow-hidden">
            <div class="modal-header bg-slate-50 border-b p-6">
                <h5 class="modal-title font-extrabold text-slate-800 text-sm uppercase tracking-widest">Buscar Solicitud
                    Previa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="p-6">
                <input type="text" class="w-full rounded-xl border-slate-200 text-sm mb-4" id="filtroReingreso"
                    placeholder="Código DESVE o nombre...">
                <div class="table-responsive max-h-[400px] rounded-xl border border-slate-100">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase border-b">
                            <tr>
                                <th>Código</th>
                                <th>Expediente</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_reingreso" class="text-[13px] text-slate-600"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../recursos/js/helpers.js"></script>
<script src="../../recursos/js/funcionarios/desve/modificar.js"></script>

<script>
    document.getElementById('chk_geoloc').addEventListener('change', function () {
        const area = document.getElementById('geolocalizacion_area');
        area.classList.toggle('hidden', !this.checked);
        if (this.checked && typeof initMap === 'function') {
            setTimeout(() => { if (window.map) google.maps.event.trigger(window.map, 'resize'); }, 100);
        }
    });
    console.log("Modificar.php: Injected script check.");
</script>
<?php use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey(); ?>
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places&callback=initMap"
    async defer></script>
<?php include '../../api/general/footer.php'; ?>