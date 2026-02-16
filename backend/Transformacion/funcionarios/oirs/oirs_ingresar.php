<?php
$pageTitle = "Ingresar Solicitud OIRS";
require_once '../../api/auth_check.php';
include 'header-oirs-funcionarios.php';
?>

<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-xl-12">

            <!-- Stepper -->
            <div class="step-header">
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
            </div>

            <form id="oirsForm" enctype="multipart/form-data">

                <!-- ETAPA 1: IDENTIFICACIÓN -->
                <div class="step-content" id="step-1">
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

                            <hr>

                            <!-- CAMPOS PERSONA NATURAL -->
                            <div id="campos_natural">
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
                            </div>

                            <!-- CAMPOS PERSONA JURÍDICA -->
                            <div id="campos_juridica" class="d-none">
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
                </div>

                <!-- ETAPA 2: REGISTRO DE SOLICITUD -->
                <div class="step-content d-none" id="step-2">
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
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="oirs_adjuntos"
                                            name="oirs_adjuntos[]" multiple>
                                        <label class="custom-file-label font-weight-bold text-muted" for="oirs_adjuntos"
                                            style="font-size: 11px;">Elegir archivos...</label>
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
                </div>

                <!-- ETAPA 3: FINALIZACIÓN -->
                <div class="step-content d-none" id="step-3">
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
</div>

<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<!-- Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&callback=initMap&libraries=places"
    async defer></script>

<script src="../../recursos/js/funcionarios/oirs/oirs_ingresar.js"></script>
<?php include 'footer-funcionarios.php'; ?>