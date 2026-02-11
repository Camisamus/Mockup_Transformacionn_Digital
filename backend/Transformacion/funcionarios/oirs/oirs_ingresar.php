<?php
$pageTitle = "Ingresar OIRS";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<style>
    /* Stepper Styles adapted to standard system */
    .step-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        position: relative;
    }

    .step-header::before {
        content: "";
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: #dee2e6;
        z-index: 1;
    }

    .step-item {
        position: relative;
        z-index: 2;
        background: #f8f9fa;
        padding: 0 10px;
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 2px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .step-item.active .step-circle {
        background: #003399;
        /* Standard primary */
        border-color: #003399;
        color: white;
    }

    .step-item.completed .step-circle {
        background: #198754;
        /* Success */
        border-color: #198754;
        color: white;
    }

    .step-label {
        font-size: 11px;
        font-weight: bold;
        text-uppercase: uppercase;
        color: #6c757d;
    }

    .step-item.active .step-label {
        color: #003399;
    }

    .map-container {
        height: 200px;
        background: #e9ecef;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        margin-top: 5px;
    }

    .form-section-title {
        border-bottom: 2px solid #003399;
        padding-bottom: 5px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: bold;
        color: #003399;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Ingresar Solicitud OIRS</h2>
            <p class="text-muted mb-0">Atención de Contribuyentes</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar btn-dark" onclick="location.href='oirs_bandeja.php'">
                <i data-feather="grid" class="me-2"></i>
                Bandeja
            </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10">
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
                    <div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                        <div class="card-body p-4">
                            <h5 class="form-section-title">Datos Básicos del Contribuyente</h5>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">RUT
                                        Contribuyente</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="rut_contribuyente"
                                            placeholder="12.345.678-9">
                                        <button class="btn btn-dark" type="button" id="btnBuscarRut">
                                            <i data-feather="search" style="width: 14px; height: 14px;"></i>
                                        </button>
                                    </div>
                                    <small class="text-info" id="rutStatus" style="display:none;">Cargando
                                        datos...</small>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Tipo
                                        Contribuyente</label>
                                    <select class="form-select form-select-sm" id="tipo_persona">
                                        <option value="natural">Persona Natural</option>
                                        <option value="juridica">Persona Jurídica</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- CAMPOS PERSONA NATURAL -->
                            <div id="campos_natural">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Nombre</label>
                                        <input type="text" class="form-control form-control-sm" name="nombre">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Apellido
                                            Paterno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_p">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Apellido
                                            Materno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_m">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Sexo</label>
                                        <select class="form-select form-select-sm">
                                            <option>Masculino</option>
                                            <option>Femenino</option>
                                            <option>Otro / No Binario</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Fecha
                                            Nacimiento</label>
                                        <input type="date" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Estado
                                            Civil</label>
                                        <select class="form-select form-select-sm">
                                            <option>Soltero/a</option>
                                            <option>Casado/a</option>
                                            <option>Divorciado/a</option>
                                            <option>Viudo/a</option>
                                            <option>Acuerdo Unión Civil</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label
                                            class="form-label small fw-bold text-muted text-uppercase">Escolaridad</label>
                                        <select class="form-select form-select-sm">
                                            <option>Básica</option>
                                            <option>Media</option>
                                            <option>Técnico Profesional</option>
                                            <option>Universitaria</option>
                                            <option>Postgrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- CAMPOS PERSONA JURÍDICA -->
                            <div id="campos_juridica" class="d-none">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Razón
                                            Social</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <h6 class="fw-bold text-dark mb-3 mt-4" style="font-size: 12px;">Representante / Quien
                                    realiza trámite</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">RUT
                                            Representante</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Nombre
                                            Completo</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small fw-bold text-muted text-uppercase">Cargo</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-3">
                                    <label
                                        class="form-label small fw-bold text-muted text-uppercase">Nacionalidad</label>
                                    <input type="text" class="form-control form-control-sm" value="Chilena">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Correo
                                        Electrónico</label>
                                    <input type="email" class="form-control form-control-sm"
                                        placeholder="ejemplo@correo.com">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Teléfono
                                        Contacto</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="+56 9 ...">
                                </div>
                            </div>

                            <h5 class="form-section-title mt-5">Dirección del Contribuyente</h5>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Dirección</label>
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="Calle, Número, Depto/Casa">
                                    <div class="map-container mt-2">
                                        <i data-feather="map" class="me-2"></i>
                                        <span class="small fw-bold">MAPA DE GOOGLE (Interface)</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Comuna</label>
                                    <select class="form-select form-select-sm">
                                        <option>Viña del Mar</option>
                                        <option>Valparaíso</option>
                                        <option>Concón</option>
                                        <option>Quilpué</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-dark px-5 btnNext" data-next="2">
                                    Continuar a Registro <i data-feather="arrow-right" class="ms-2"
                                        style="width: 16px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ETAPA 2: REGISTRO DE SOLICITUD -->
                <div class="step-content d-none" id="step-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="form-section-title">Detalles de la Solicitud</h5>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Tipo de
                                        Atención</label>
                                    <select class="form-select form-select-sm">
                                        <option>Consulta</option>
                                        <option>Denuncia</option>
                                        <option>Felicitaciones</option>
                                        <option>Reclamo</option>
                                        <option>Sugerencia</option>
                                        <option>Solicitud</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Origen
                                        Consulta</label>
                                    <select class="form-select form-select-sm">
                                        <option>Presencial</option>
                                        <option>Teléfono</option>
                                        <option>Terreno</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Condición
                                        Especial</label>
                                    <select class="form-select form-select-sm">
                                        <option>Ninguna</option>
                                        <option>Adulto Mayor</option>
                                        <option>Dirigente</option>
                                        <option>Embarazada</option>
                                        <option>Persona con Discapacidad</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Fecha
                                        Registro</label>
                                    <input type="date" class="form-control form-control-sm"
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Hora
                                        Registro</label>
                                    <input type="time" class="form-control form-control-sm"
                                        value="<?php echo date('H:i'); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Temática
                                        Principal</label>
                                    <select class="form-select form-select-sm">
                                        <option>Aseo y Ornato</option>
                                        <option>Seguridad Pública</option>
                                        <option>Tránsito</option>
                                        <option>Desarrollo Comunitario</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label
                                        class="form-label small fw-bold text-muted text-uppercase">Subtemática</label>
                                    <select class="form-select form-select-sm">
                                        <option>Bacheo</option>
                                        <option>Iluminación</option>
                                        <option>Recolección de basura</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Ubicación del
                                        Incidente</label>
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="¿Dónde ocurre?">
                                    <div class="map-container mt-2">
                                        <i data-feather="map-pin" class="me-2"></i>
                                        <span class="small fw-bold">UBICACIÓN DE LA SOLICITUD</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Sector</label>
                                    <select class="form-select form-select-sm">
                                        <option>Sector 1: Plan de Viña</option>
                                        <option>Sector 2: Reñaca / Concón</option>
                                        <option>Sector 3: cerros Orientales</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Descripción de la
                                        Solicitud</label>
                                    <textarea class="form-control form-control-sm" rows="4"
                                        placeholder="Detalle aquí lo solicitado..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Respuesta
                                        Inmediata (Opcional)</label>
                                    <textarea class="form-control form-control-sm border-dashed" rows="3"
                                        placeholder="Si entrega respuesta en el acto, regístrela aquí..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Adjuntar
                                        Archivos</label>
                                    <input class="form-control form-control-sm" type="file" id="formFileMultiple"
                                        multiple>
                                    <small class="text-muted">Puede subir imágenes, PDFs o documentos (Máx. 5MB cada
                                        uno).</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-outline-secondary px-4 btnPrev"
                                    data-prev="1">Volver</button>
                                <button type="button" id="btnFinalizar" class="btn btn-success px-5 fw-bold">
                                    REGISTRAR SOLICITUD <i data-feather="check-circle" class="ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ETAPA 3: FINALIZACIÓN -->
                <div class="step-content d-none" id="step-3">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <i data-feather="check-circle" class="text-success"
                                    style="width: 80px; height: 80px;"></i>
                            </div>
                            <h3 class="fw-bold text-dark">¡Solicitud Registrada con Éxito!</h3>
                            <p class="text-muted mb-4">La OIRS ha sido ingresada con el folio:
                                <strong>#OIRS-<?php echo date('Y'); ?>-XXXX</strong>
                            </p>

                            <hr class="my-4">

                            <p class="fw-bold text-muted text-uppercase small mb-3">¿Qué desea hacer a continuación?</p>

                            <div class="d-flex justify-content-center gap-3">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"
                                    onclick="window.print();">
                                    <i data-feather="printer"></i>
                                    Imprimir Comprobante
                                </button>
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-2"
                                    onclick="location.reload()">
                                    <i data-feather="plus"></i>
                                    Nueva Solicitud
                                </button>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <a href="oirs_bandeja.php"
                                    class="text-primary fw-bold small text-decoration-none">Volver a la Bandeja</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    feather.replace();
</script>

<script src="../../recursos/js/funcionarios/oirs/oirs_ingresar.js"></script>

<?php include '../../api/footer.php'; ?>