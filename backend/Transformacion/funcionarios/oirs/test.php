<?php
$pageTitle = "Ingresar Solicitud OIRS";
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
    body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { font-family: 'Material Symbols Outlined' !important; vertical-align: middle; line-height: 1; }
    .gob-card { border: 1px solid rgba(226, 232, 240, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    
    /* Estilo del Stepper Imagen 1 */
    .step-circle { width: 35px; height: 35px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-weight: 800; margin-bottom: 8px; transition: all 0.3s; }
    .step-item.active .step-circle { background: #1a5f9c; color: white; box-shadow: 0 0 0 4px rgba(26, 95, 156, 0.2); }
    .step-item.active .step-label { color: #1a5f9c; font-weight: 700; }
    .step-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; }
</style>

<div class="max-w-[1200px] mx-auto p-4 lg:p-8 space-y-6">

    <div class="bg-white border border-slate-100 rounded-3xl p-6 lg:p-10 flex flex-col sm:flex-row justify-between items-center shadow-sm gap-6">
        <div class="space-y-1 w-full text-left">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight">Ingreso de Solicitud OIRS</h1>
            <p class="text-slate-400 text-sm lg:text-[15px] font-medium uppercase tracking-wider">Atención de Contribuyentes</p>
        </div>
    </div>

    <div class="flex justify-between items-center max-w-3xl mx-auto px-4 py-4">
        <div class="step-item active flex flex-col items-center flex-1 relative" id="step-1-indicator">
            <div class="step-circle">1</div>
            <div class="step-label">Identificación</div>
        </div>
        <div class="h-[2px] bg-slate-200 flex-1 -mt-8 mx-2"></div>
        <div class="step-item flex flex-col items-center flex-1 relative" id="step-2-indicator">
            <div class="step-circle">2</div>
            <div class="step-label">Datos Solicitud</div>
        </div>
        <div class="h-[2px] bg-slate-200 flex-1 -mt-8 mx-2"></div>
        <div class="step-item flex flex-col items-center flex-1 relative" id="step-3-indicator">
            <div class="step-circle">3</div>
            <div class="step-label">Finalización</div>
        </div>
    </div>

    <form id="oirsForm" enctype="multipart/form-data">
        
        <div class="step-content space-y-6" id="step-1">
            
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                    <span class="material-symbols-outlined text-primary-blue">person_search</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Datos Básicos del Contribuyente</h3>
                </div>
                <div class="p-6 lg:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RUT Contribuyente</label>
                            <div class="flex gap-2 h-11">
                                <input type="text" id="rut_contribuyente" placeholder="12.345.678-9" 
                                    class="flex-1 rounded-xl border-slate-200 focus:ring-primary-blue text-sm px-4">
                                <button type="button" id="btnBuscarRut" class="bg-primary-blue text-white px-5 rounded-xl hover:bg-blue-800 transition-all flex items-center">
                                    <span class="material-symbols-outlined">search</span>
                                </button>
                            </div>
                            <small class="text-primary-blue font-bold text-[10px] animate-pulse" id="rutStatus" style="display:none;">BUSCANDO...</small>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo Contribuyente</label>
                            <select id="cont_tipo_persona" class="w-full h-11 rounded-xl border-slate-200 text-sm focus:ring-primary-blue px-4">
                                <option value="natural">Persona Natural</option>
                                <option value="juridica">Persona Jurídica</option>
                            </select>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <div id="campos_natural" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre</label>
                                <input type="text" id="cont_nombre" name="nombre" class="w-full h-11 rounded-xl border-slate-200 text-sm focus:ring-primary-blue px-4 bg-slate-50/50">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Apellido Paterno</label>
                                <input type="text" id="cont_apellido_p" name="apellido_p" class="w-full h-11 rounded-xl border-slate-200 text-sm focus:ring-primary-blue px-4 bg-slate-50/50">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Apellido Materno</label>
                                <input type="text" id="cont_apellido_m" name="apellido_m" class="w-full h-11 rounded-xl border-slate-200 text-sm focus:ring-primary-blue px-4 bg-slate-50/50">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Sexo</label>
                                <select id="cont_sexo" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                    <option value="">Seleccione...</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro / No Binario</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha Nacimiento</label>
                                <input type="date" id="cont_fecha_nac" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Estado Civil</label>
                                <select id="cont_estado_civil" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                    <option value="">Seleccione...</option>
                                    <option value="Soltero/a">Soltero/a</option>
                                    <option value="Casado/a">Casado/a</option>
                                    <option value="Divorciado/a">Divorciado/a</option>
                                    <option value="Viudo/a">Viudo/a</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Escolaridad</label>
                                <select id="cont_escolaridad" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                    <option value="" disabled selected>Cargando...</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Correo Electrónico</label>
                                <input type="email" id="cont_email" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Teléfono</label>
                                <input type="text" id="cont_telefono" class="w-full h-11 rounded-xl border-slate-200 text-sm" placeholder="+56 9 ...">
                            </div>
                        </div>

                        <div id="campos_juridica" class="grid grid-cols-1 gap-6 d-none">
                             <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Razón Social</label>
                                <input type="text" id="cont_razon_social" name="cont_razon_social" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">RUT Representante</label>
                                    <input type="text" id="cont_rep_rut" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nombre Representante</label>
                                    <input type="text" id="cont_rep_nombre" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Cargo</label>
                                    <input type="text" id="cont_rep_cargo" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                    <span class="material-symbols-outlined text-primary-blue">location_on</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Dirección del Contribuyente</h3>
                </div>
                <div class="p-6 lg:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección</label>
                            <input type="text" id="cont_direccion" placeholder="Calle, Número, Depto/Casa" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Comuna</label>
                            <select id="cont_comuna" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                <option>Viña del Mar</option>
                                <option>Valparaíso</option>
                                <option>Concón</option>
                                <option>Quilpué</option>
                            </select>
                        </div>
                    </div>
                    <div id="map" class="w-full rounded-2xl border border-slate-100 shadow-inner" style="height: 350px;"></div>
                    <input type="hidden" id="cont_lat" name="cont_lat"><input type="hidden" id="cont_lng" name="cont_lng">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" class="btnNext bg-primary-blue text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-blue-200/50 uppercase tracking-widest text-xs flex items-center gap-2" data-next="2">
                    Continuar al Paso 2 <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>

        <div class="step-content d-none space-y-6" id="step-2">
            <div class="bg-white gob-card rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-50 flex items-center gap-2 bg-white">
                    <span class="material-symbols-outlined text-primary-blue">assignment</span>
                    <h3 class="font-bold text-slate-700 uppercase text-xs tracking-widest">Detalles de la Solicitud OIRS</h3>
                </div>
                <div class="p-6 lg:p-8 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tipo de Atención</label>
                            <select id="oirs_tipo_atencion" class="w-full h-11 rounded-xl border-slate-200 text-sm focus:ring-primary-blue px-4">
                                <option value="" selected disabled>Cargando...</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Origen Consulta</label>
                            <select id="oirs_origen" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                <option value="Presencial">Presencial</option>
                                <option value="Web">Web</option>
                                <option value="Teléfono">Teléfono</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Condición Especial</label>
                            <select id="oirs_condicion" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                <option value="" selected disabled>Cargando...</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fecha</label>
                            <input type="date" id="oirs_fecha_reg" name="oirs_fecha_reg" value="<?php echo date('Y-m-d'); ?>" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Hora</label>
                            <input type="time" id="oirs_hora_reg" name="oirs_hora_reg" value="<?php echo date('H:i'); ?>" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Temática</label>
                            <select id="oirs_tematica" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                <option value="" selected disabled>Cargando...</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Subtemática</label>
                            <select id="oirs_subtematica" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                <option value="" selected disabled>Seleccione...</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <div class="md:col-span-8 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Dirección del Incidente</label>
                                <input type="text" id="oirs_direccion_incidente" placeholder="¿Dónde ocurre?" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                            </div>
                            <div id="map_incidente" class="w-full rounded-2xl border border-slate-100" style="height: 250px;"></div>
                            <input type="hidden" id="oirs_lat" name="oirs_lat"><input type="hidden" id="oirs_lng" name="oirs_lng">
                        </div>
                        <div class="md:col-span-4 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Sector</label>
                                <select id="oirs_sector" class="w-full h-11 rounded-xl border-slate-200 text-sm">
                                    <option value="" selected disabled>Cargando...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Descripción de la Solicitud</label>
                            <textarea id="oirs_descripcion" name="oirs_descripcion" rows="4" class="w-full rounded-2xl border-slate-200 text-sm p-4 bg-slate-50 italic focus:bg-white transition-all" placeholder="Detalle lo solicitado..."></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Respuesta Inmediata (Opcional)</label>
                            <textarea id="oirs_respuesta" name="oirs_respuesta" rows="3" class="w-full rounded-2xl border-slate-200 text-sm p-4 focus:ring-gob-success" placeholder="Registro de respuesta en el acto..."></textarea>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-4">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Adjuntar Archivos</label>
                        <div class="flex items-center gap-4">
                            <input type="file" id="oirs_adjuntos" name="oirs_adjuntos[]" multiple class="text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300">
                        </div>
                        <div id="lista_archivos_oirs" class="grid grid-cols-1 md:grid-cols-2 gap-2"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <button type="button" class="btnPrev text-slate-400 font-bold text-xs uppercase tracking-widest flex items-center gap-2 hover:text-slate-600 transition-all" data-prev="1">
                    <span class="material-symbols-outlined text-lg">arrow_back</span> Volver
                </button>
                <button type="button" id="btnFinalizar" class="bg-gob-success text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-emerald-200/50 uppercase tracking-widest text-xs flex items-center gap-2">
                    REGISTRAR SOLICITUD <span class="material-symbols-outlined">verified</span>
                </button>
            </div>
        </div>

        <div class="step-content d-none" id="step-3">
            <div class="bg-white gob-card rounded-3xl p-10 lg:p-20 text-center space-y-8">
                <div class="flex justify-center">
                    <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center animate-bounce">
                        <span class="material-symbols-outlined text-6xl">check_circle</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <h3 class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tight">¡Solicitud Registrada con Éxito!</h3>
                    <p class="text-slate-400 font-medium">La OIRS ha sido ingresada al sistema con el folio:</p>
                    <div class="inline-block bg-slate-100 px-6 py-2 rounded-full font-mono text-xl font-bold text-primary-blue border border-slate-200 mt-2" id="oirs_folio_final">#OIRS-2024-8921</div>
                </div>
                
                <div class="h-px bg-slate-100 max-w-md mx-auto"></div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                    <button type="button" onclick="window.print();" class="flex items-center justify-center gap-2 bg-slate-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:bg-black transition-all text-xs uppercase tracking-wider">
                        <span class="material-symbols-outlined">picture_as_pdf</span> Imprimir Comprobante
                    </button>
                    <a href="ingresar.php" class="flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-700 font-bold py-3 px-8 rounded-xl shadow-sm hover:bg-slate-50 transition-all text-xs uppercase tracking-wider">
                        <span class="material-symbols-outlined">add</span> Nueva Solicitud
                    </a>
                </div>

                <div class="pt-6">
                    <a href="index.php" class="text-primary-blue font-bold text-xs uppercase tracking-[0.2em] hover:underline transition-all">Volver al Dashboard</a>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&callback=initMap&libraries=places" async defer></script>
<script src="../../recursos/js/funcionarios/oirs/oirs_ingresar.js"></script>

<?php include '../../api/general/footer.php'; ?>