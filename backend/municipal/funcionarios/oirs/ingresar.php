<?php include '../../include/header-oirs-funcionarios.php'; ?>

<!-- Estilos para el Stepper y Mapas -->
<style>
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
        background: var(--gob-bg);
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
        background: var(--gob-primary);
        border-color: var(--gob-primary);
        color: white;
    }
    .step-item.completed .step-circle {
        background: var(--gob-success);
        border-color: var(--gob-success);
        color: white;
    }
    .step-label {
        font-size: 11px;
        font-weight: bold;
        text-uppercase;
        color: #6c757d;
    }
    .step-item.active .step-label {
        color: var(--gob-primary);
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
        border-bottom: 2px solid var(--gob-primary);
        padding-bottom: 5px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: bold;
        color: var(--gob-primary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>

<div class="bg-white border-bottom px-4 py-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <button class="btn btn-link p-0 mr-3 d-lg-none sidebar-toggle text-dark">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="d-flex flex-column">
                <h2 class="h6 font-serif font-bold text-dark mb-0">Ingreso de Solicitud OIRS</h2>
                <p class="text-primary font-weight-bold text-uppercase mb-0" 
                style="font-size: 9px; letter-spacing: 0.15em; margin-top: 2px;">Atención de Contribuyentes</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
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
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-4">
                            <h4 class="form-section-title">Datos Básicos del Contribuyente</h4>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">RUT Contribuyente</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="rut_contribuyente" placeholder="12.345.678-9">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" id="btnBuscarRut">
                                                <span class="material-symbols-outlined" style="font-size: 16px;">search</span>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-info" id="rutStatus" style="display:none;">Cargando datos...</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Tipo Contribuyente</label>
                                    <select class="form-control form-control-sm" id="tipo_persona">
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
                                        <input type="text" class="form-control form-control-sm" name="nombre">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Apellido Paterno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_p">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Apellido Materno</label>
                                        <input type="text" class="form-control form-control-sm" name="apellido_m">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Sexo</label>
                                        <select class="form-control form-control-sm">
                                            <option>Masculino</option>
                                            <option>Femenino</option>
                                            <option>Otro / No Binario</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Fecha Nacimiento</label>
                                        <input type="date" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Estado Civil</label>
                                        <select class="form-control form-control-sm">
                                            <option>Soltero/a</option>
                                            <option>Casado/a</option>
                                            <option>Divorciado/a</option>
                                            <option>Viudo/a</option>
                                            <option>Acuerdo Unión Civil</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nivel Escolaridad</label>
                                        <select class="form-control form-control-sm">
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
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Razón Social</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <h6 class="font-weight-bold text-dark mb-3 mt-2" style="font-size: 12px;">Datos Representante / Quien realiza trámite</h6>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">RUT Representante</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Nombre Completo</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="font-weight-bold small text-muted text-uppercase">Cargo</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Nacionalidad</label>
                                    <input type="text" class="form-control form-control-sm" value="Chilena">
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-sm" placeholder="ejemplo@correo.com">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Teléfono Contacto</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="+56 9 ...">
                                </div>
                            </div>

                            <h4 class="form-section-title mt-4">Dirección del Contribuyente</h4>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Dirección</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Calle, Número, Depto/Casa">
                                    <div class="map-container mt-2">
                                        <span class="material-symbols-outlined mr-2">map</span>
                                        <span class="small font-weight-bold">MAPA DE GOOGLE (Interface)</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Comuna</label>
                                    <select class="form-control form-control-sm">
                                        <option>Viña del Mar</option>
                                        <option>Valparaíso</option>
                                        <option>Concón</option>
                                        <option>Quilpué</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-primary px-5 btnNext" data-next="2">Continuar a Registro <span class="material-symbols-outlined ml-2" style="font-size: 18px;">arrow_forward</span></button>
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
                                    <label class="font-weight-bold small text-muted text-uppercase">Tipo de Atención</label>
                                    <select class="form-control form-control-sm">
                                        <option>Consulta</option>
                                        <option>Denuncia</option>
                                        <option>Felicitaciones</option>
                                        <option>Reclamo</option>
                                        <option>Sugerencia</option>
                                        <option>Solicitud</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Origen Consulta</label>
                                    <select class="form-control form-control-sm">
                                        <option>Presencial</option>
                                        <option>Teléfono</option>
                                        <option>Terreno</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Condición Especial</label>
                                    <select class="form-control form-control-sm">
                                        <option>Ninguna</option>
                                        <option>Adulto Mayor</option>
                                        <option>Dirigente</option>
                                        <option>Embarazada</option>
                                        <option>Persona con Discapacidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Fecha Registro</label>
                                    <input type="date" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Hora Registro</label>
                                    <input type="time" class="form-control form-control-sm" value="<?php echo date('H:i'); ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Temática Principal</label>
                                    <select class="form-control form-control-sm">
                                        <option>Aseo y Ornato</option>
                                        <option>Seguridad Pública</option>
                                        <option>Tránsito</option>
                                        <option>Desarrollo Comunitario</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Subtemática</label>
                                    <select class="form-control form-control-sm">
                                        <option>Bacheo</option>
                                        <option>Iluminación</option>
                                        <option>Recolección de basura</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-7 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Dirección del Incidente/Solicitud</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="¿Dónde ocurre?">
                                    <div class="map-container mt-2">
                                        <span class="material-symbols-outlined mr-2">map</span>
                                        <span class="small font-weight-bold">UBICACIÓN DE LA SOLICITUD</span>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Sector</label>
                                    <select class="form-control form-control-sm">
                                        <option>Sector 1: Plan de Viña</option>
                                        <option>Sector 2: Reñaca / Concón</option>
                                        <option>Sector 3: cerros Orientales</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Descripción de la Solicitud</label>
                                    <textarea class="form-control border bg-light shadow-none" rows="4" placeholder="Detalle aquí lo solicitado por el contribuyente..."></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold small text-muted text-uppercase">Respuesta Inmediata (Opcional)</label>
                                    <textarea class="form-control border bg-white shadow-none" rows="3" placeholder="Si el funcionario entrega respuesta en el acto, regístrela aquí..."></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="font-weight-bold small text-muted text-uppercase">Adjuntar Archivos / Usuario</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" multiple>
                                        <label class="custom-file-label font-weight-bold text-muted" for="customFile" style="font-size: 11px;">Elegir archivos...</label>
                                    </div>
                                    <small class="text-muted">Puede subir imágenes, PDFs o documentos (Máx. 5MB cada uno).</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-light border px-4 btnPrev" data-prev="1">Volver</button>
                                <button type="button" id="btnFinalizar" class="btn btn-success px-5 font-weight-bold">REGISTRAR SOLICITUD <span class="material-symbols-outlined ml-2" style="font-size: 18px;">check_circle</span></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ETAPA 3: FINALIZACIÓN -->
                <div class="step-content d-none" id="step-3">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <span class="material-symbols-outlined text-success" style="font-size: 80px;">verified</span>
                            </div>
                            <h3 class="font-weight-bold text-dark">¡Solicitud Registrada con Éxito!</h3>
                            <p class="text-muted mb-4">La OIRS ha sido ingresada al sistema con el folio: <strong>#OIRS-2024-8921</strong></p>
                            
                            <hr class="my-4">
                            
                            <p class="font-weight-bold text-muted text-uppercase small mb-3">¿Qué desea hacer a continuación?</p>
                            
                            <div class="row justify-content-center" style="gap: 1rem;">
                                <button type="button" class="btn btn-primary d-flex align-items-center" style="gap: 0.5rem;" onclick="window.print();">
                                    <span class="material-symbols-outlined">picture_as_pdf</span>
                                    <span>Imprimir Comprobante PDF</span>
                                </button>
                                <a href="/municipal/funcionarios/oirs/ingresar.php" class="btn btn-outline-primary d-flex align-items-center" style="gap: 0.5rem;">
                                    <span class="material-symbols-outlined">add</span>
                                    <span>Nueva Solicitud</span>
                                </a>
                            </div>
                            
                            <div class="mt-4 pt-3 border-top">
                                <a href="/municipal/funcionarios/oirs/index.php" class="text-primary font-weight-bold small">Volver al Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Lógica del Stepper
    $('.btnNext').click(function() {
        let next = $(this).data('next');
        $('.step-content').addClass('d-none');
        $(`#step-${next}`).removeClass('d-none');
        $(`#step-${next}-indicator`).addClass('active');
        $(`#step-${next-1}-indicator`).addClass('completed').removeClass('active');
        window.scrollTo(0, 0);
    });

    $('.btnPrev').click(function() {
        let prev = $(this).data('prev');
        $('.step-content').addClass('d-none');
        $(`#step-${prev}`).removeClass('d-none');
        $(`#step-${prev}-indicator`).addClass('active').removeClass('completed');
        $(`#step-${prev+1}-indicator`).removeClass('active');
        window.scrollTo(0, 0);
    });

    // Toggle Persona Natural / Jurídica
    $('#tipo_persona').change(function() {
        if ($(this).val() === 'juridica') {
            $('#campos_natural').addClass('d-none');
            $('#campos_juridica').removeClass('d-none');
        } else {
            $('#campos_natural').removeClass('d-none');
            $('#campos_juridica').addClass('d-none');
        }
    });

    // Simulación búsqueda RUT
    $('#btnBuscarRut').click(function() {
        let rut = $('#rut_contribuyente').val();
        if (rut) {
            $('#rutStatus').fadeIn();
            setTimeout(function() {
                $('#rutStatus').text('¡Datos encontrados!');
                // Pre-llenado simulado
                $('input[name="nombre"]').val('Juan Pablo');
                $('input[name="apellido_p"]').val('Martínez');
                $('input[name="apellido_m"]').val('González');
                $('#rutStatus').delay(1000).fadeOut();
            }, 1000);
        }
    });

    // Finalizar
    $('#btnFinalizar').click(function() {
        Swal.fire({
            title: '¿Confirmar Registro?',
            text: "Se generará un nuevo folio de atención.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#006FB3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Registrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('.step-content').addClass('d-none');
                $('#step-3').removeClass('d-none');
                $('#step-3-indicator').addClass('active completed');
                $('#step-2-indicator').addClass('completed').removeClass('active');
                window.scrollTo(0, 0);
            }
        });
    });

    // Custom File Label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName || 'Elegir archivos...');
    });
});
</script>

<?php include '../../include/footer-funcionarios.php'; ?>
