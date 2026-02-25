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

<!--<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">-->

            <!-- Stepper -->
            <!--<div class="step-header">
                <div class="step-item active" id="step-1-indicator">
                    <div class="step-circle">1</div>
                    <div class="step-label">Identificación Contribuyente</div>
                </div>
                <div class="step-item" id="step-2-indicator">
                    <div class="step-circle">2</div>
                    <div class="step-label">Datos de la Solicitud</div>
                </div>
                <div class="step-item" id="step-3-indicator">
                    <div class="step-circle">3</div>
                    <div class="step-label">Finalización</div>
                </div>
            </div>-->       

            <!--<form id="oirsForm" enctype="multipart/form-data">-->

                <!-- ETAPA 1: IDENTIFICACIÓN -->
                <!--<div class="step-content" id="step-1">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-4">
                            <h4 class="form-section-title">Datos Básicos del Contribuyente</h4>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">RUT
                                        Contribuyente</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="rut_contribuyente"
                                            placeholder="12.345.678-9">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="btnBuscarRut">
                                                <span class="material-symbols-outlined"
                                                    style="font-size: 16px;">search</span>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-info" id="rutStatus" style="display:none;">Cargando
                                        datos...</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Tipo
                                        Contribuyente</label>
                                    <select class="form-control form-control-sm" id="cont_tipo_persona">
                                        <option value="natural">Persona Natural</option>
                                        <option value="juridica">Persona Jurídica</option>
                                    </select>
                                </div>
                            </div>

                            <hr>-->

                            <!-- CAMPOS PERSONA NATURAL -->
                            <!--<div id="campos_natural">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nombre</label>
                                        <input type="text" class="form-control form-control-sm" name="nombre"
                                            id="cont_nombre">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Apellido
                                            Paterno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_p"
                                            id="cont_apellido_p">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Apellido
                                            Materno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_m"
                                            id="cont_apellido_m">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Sexo</label>
                                        <select class="form-control form-control-sm" id="cont_sexo">
                                            <option value="">Seleccione...</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Otro">Otro / No Binario</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Fecha
                                            Nacimiento</label>
                                        <input type="date" class="form-control form-control-sm" id="cont_fecha_nac">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Estado
                                            Civil</label>
                                        <select class="form-control form-control-sm" id="cont_estado_civil">
                                            <option value="">Seleccione...</option>
                                            <option value="Soltero/a">Soltero/a</option>
                                            <option value="Casado/a">Casado/a</option>
                                            <option value="Divorciado/a">Divorciado/a</option>
                                            <option value="Viudo/a">Viudo/a</option>
                                            <option value="Acuerdo Unión Civil">Acuerdo Unión Civil</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nivel
                                            Escolaridad</label>
                                        <select class="form-control form-control-sm" id="cont_escolaridad">
                                            <option value="" selected disabled>Cargando...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>-->

                            <!-- CAMPOS PERSONA JURÍDICA -->
                            <!--<div id="campos_juridica" class="d-none">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Razón
                                            Social</label>
                                        <input type="text" class="form-control form-control-sm" id="cont_razon_social"
                                            name="cont_razon_social">
                                    </div>
                                </div>
                                <h6 class="font-weight-bold text-dark mb-3 mt-2" style="font-size: 12px;">Datos
                                    Representante / Quien realiza trámite</h6>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">RUT
                                            Representante</label>
                                        <input type="text" class="form-control form-control-sm" id="cont_rep_rut"
                                            name="cont_rep_rut">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nombre
                                            Completo</label>
                                        <input type="text" class="form-control form-control-sm" id="cont_rep_nombre"
                                            name="cont_rep_nombre">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Cargo</label>
                                        <input type="text" class="form-control form-control-sm" id="cont_rep_cargo"
                                            name="cont_rep_cargo">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Nacionalidad</label>
                                    <input type="text" class="form-control form-control-sm" id="cont_nacionalidad"
                                        value="Chilena">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Correo
                                        Electrónico</label>
                                    <input type="email" class="form-control form-control-sm" id="cont_email"
                                        placeholder="ejemplo@correo.com">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Teléfono
                                        Contacto</label>
                                    <input type="text" class="form-control form-control-sm" id="cont_telefono"
                                        placeholder="+56 9 ...">
                                </div>
                            </div>

                            <h4 class="form-section-title mt-4">Dirección del Contribuyente</h4>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Dirección</label>
                                    <input type="text" class="form-control form-control-sm" id="cont_direccion"
                                        placeholder="Calle, Número, Depto/Casa">
                                    <input type="hidden" id="cont_lat" name="cont_lat">
                                    <input type="hidden" id="cont_lng" name="cont_lng">
                                    <div id="map" class="mt-2"
                                        style="height: 300px; width: 100%; border-radius: 8px; border: 1px solid #ddd;">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Comuna</label>
                                    <select class="form-control form-control-sm" id="cont_comuna">
                                        <option>Viña del Mar</option>
                                        <option>Valparaíso</option>
                                        <option>Concón</option>
                                        <option>Quilpué</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-primary px-5 btnNext" data-next="2">Continuar a
                                    Registro <span class="material-symbols-outlined ml-2"
                                        style="font-size: 18px;">arrow_forward</span></button>
                            </div>
                        </div>
                    </div>
                </div>-->

                <!-- ETAPA 2: REGISTRO DE SOLICITUD -->
                <!--<div class="step-content d-none" id="step-2">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-4">
                            <h4 class="form-section-title">Detalles de la Solicitud</h4>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Tipo de
                                        Atención</label>
                                    <select class="form-control form-control-sm" id="oirs_tipo_atencion">
                                        <option value="" selected disabled>Cargando...</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Origen
                                        Consulta</label>
                                    <select class="form-control form-control-sm" id="oirs_origen">
                                        <option value="Presencial">Presencial</option>
                                        <option value="Teléfono">Teléfono</option>
                                        <option value="Terreno">Terreno</option>
                                        <option value="Web">Web</option>
                                        <option value="Email">Email</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Condición
                                        Especial</label>
                                    <select class="form-control form-control-sm" id="oirs_condicion">
                                        <option value="" selected disabled>Cargando...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Fecha
                                        Registro</label>
                                    <input type="date" class="form-control form-control-sm" id="oirs_fecha_reg"
                                        name="oirs_fecha_reg" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Hora
                                        Registro</label>
                                    <input type="time" class="form-control form-control-sm" id="oirs_hora_reg"
                                        name="oirs_hora_reg" value="<?php echo date('H:i'); ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Temática
                                        Principal</label>
                                    <select class="form-control form-control-sm" id="oirs_tematica">
                                        <option value="" selected disabled>Cargando...</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Subtemática</label>
                                    <select class="form-control form-control-sm" id="oirs_subtematica">
                                        <option value="" selected disabled>Seleccione temática...</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Dirección del
                                        Incidente/Solicitud</label>
                                    <input type="text" class="form-control form-control-sm"
                                        id="oirs_direccion_incidente" name="oirs_direccion_incidente"
                                        placeholder="¿Dónde ocurre?">
                                    <input type="hidden" id="oirs_lat" name="oirs_lat">
                                    <input type="hidden" id="oirs_lng" name="oirs_lng">
                                    <div id="map_incidente" class="mt-2"
                                        style="height: 250px; width: 100%; border-radius: 8px; border: 1px solid #ddd;">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Sector</label>
                                    <select class="form-control form-control-sm" id="oirs_sector">
                                        <option value="" selected disabled>Cargando...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Descripción de la
                                        Solicitud</label>
                                    <textarea class="form-control border bg-light shadow-none" id="oirs_descripcion"
                                        name="oirs_descripcion" rows="4"
                                        placeholder="Detalle aquí lo solicitado por el contribuyente..."></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Respuesta Inmediata
                                        (Opcional)</label>
                                    <textarea class="form-control border bg-white shadow-none" id="oirs_respuesta"
                                        name="oirs_respuesta" rows="3"
                                        placeholder="Si el funcionario entrega respuesta en el acto, regístrela aquí..."></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="font-weight-bold small text-muted text-uppercase">Adjuntar Archivos /
                                        Usuario</label>
                                    <div>
                                        <input type="file" class="form-control form-control-sm" id="oirs_adjuntos"
                                            name="oirs_adjuntos[]" multiple>
                                        <div id="lista_archivos_oirs" class="list-group list-group-flush mt-2 small">-->
                                            <!-- Dynamic list of selected files -->
                                        <!--</div>
                                    </div>
                                    <small class="text-muted">Puede subir imágenes, PDFs o documentos (Máx. 5MB cada
                                        uno).</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light border px-4 btnPrev"
                                    data-prev="1">Volver</button>
                                <button type="button" id="btnFinalizar"
                                    class="btn btn-success px-5 font-weight-bold">REGISTRAR SOLICITUD <span
                                        class="material-symbols-outlined ml-2"
                                        style="font-size: 18px;">check_circle</span></button>
                            </div>
                        </div>
                    </div>
                </div>-->

                <!-- ETAPA 3: FINALIZACIÓN -->
                <!--<div class="step-content d-none" id="step-3">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <span class="material-symbols-outlined text-success"
                                    style="font-size: 80px;">verified</span>
                            </div>
                            <h3 class="font-weight-bold text-dark">¡Solicitud Registrada con Éxito!</h3>
                            <p class="text-muted mb-4">La OIRS ha sido ingresada al sistema con el folio:
                                <strong id="oirs_folio_final">#OIRS-2024-8921</strong>
                            </p>

                            <hr class="my-4">

                            <p class="font-weight-bold text-muted text-uppercase small mb-3">¿Qué desea hacer a
                                continuación?</p>

                            <div class="row justify-content-center" style="gap: 1rem;">
                                <button type="button" class="btn btn-primary d-flex align-items-center"
                                    style="gap: 0.5rem;" onclick="window.print();">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                    <span>Imprimir Comprobante PDF</span>
                                </button>
                                <a href="/municipal/funcionarios/oirs/ingresar.php"
                                    class="btn btn-outline-primary d-flex align-items-center" style="gap: 0.5rem;">
                                    <span class="material-symbols-outlined">add</span>
                                    <span>Nueva Solicitud</span>
                                </a>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <a href="/municipal/funcionarios/oirs/index.php"
                                    class="text-primary font-weight-bold small">Volver al Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>-->

<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<!-- Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&callback=initMap&libraries=places"
    async defer></script>

<script src="../../recursos/js/funcionarios/oirs/ingresar.js"></script>
<?php include '../../api/general/footer.php'; ?>