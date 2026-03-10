<?php
$pageTitle = "Registro de Emprendedor";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<style>
    .stepper-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
    }
    .stepper-line {
        height: 4px;
        background-color: #dee2e6;
        flex-grow: 1;
        margin: 0 1rem;
        border-radius: 10px;
    }
    .option-card {
        border: 2px solid transparent;
        cursor: pointer;
        transition: 0.2s;
        border-radius: 20px;
        height: 100%;
    }
    .option-card:hover { border-color: #006FB3; transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .option-card.active { border-color: #006FB3; background-color: rgba(0, 111, 179, 0.05); }
    .status-pill {
        font-size: 0.55rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 9999px;
        letter-spacing: 0.5px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-5 px-lg-4">
            <div>
                <h1 class="h1 fw-bold text-dark mb-1 tracking-tight">Registro de Emprendedor</h1>
                <p class="text-muted mb-0 lead opacity-75">Siga los pasos para formalizar su actividad en la comuna.</p>
            </div>
            <div class="text-end mb-md-2">
                <span class="text-primary fw-bold small">Paso 1 de 3</span>
                <p class="text-muted small mb-0">Siguiente: Validación de RUT</p>
            </div>
        </div>

        <!-- Stepper -->
        <div class="d-flex align-items-center mb-5 px-lg-5">
            <div class="d-flex flex-column align-items-center gap-2">
                <div class="stepper-circle bg-primary text-white shadow-lg">1</div>
                <span class="small fw-bold text-primary text-uppercase" style="font-size: 0.55rem;">Categoría</span>
            </div>
            <div class="stepper-line"><div class="bg-primary h-100 w-33 rounded-pill"></div></div>
            <div class="d-flex flex-column align-items-center gap-2">
                <div class="stepper-circle bg-light text-muted border border-2">2</div>
                <span class="small fw-bold text-muted text-uppercase" style="font-size: 0.55rem;">Validación</span>
            </div>
            <div class="stepper-line"></div>
            <div class="d-flex flex-column align-items-center gap-2">
                <div class="stepper-circle bg-light text-muted border border-2">3</div>
                <span class="small fw-bold text-muted text-uppercase" style="font-size: 0.55rem;">Documentos</span>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
            <!-- Sección 1 -->
            <div class="p-4 p-md-5 border-bottom px-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h2 class="h3 fw-bold text-dark mb-0">1. Categoría de Negocio</h2>
                        <span class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                    </div>
                    <p class="text-muted mb-0">Seleccione el área principal de su actividad comercial. Esto determinará los documentos requeridos posteriormente.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card option-card active p-4 position-relative">
                            <div class="position-absolute top-0 end-0 p-3 text-primary">
                                <?php echo getIcon('check-circle', '', ['width'=>24]); ?>
                            </div>
                            <div class="bg-primary text-white rounded-4 d-inline-flex p-3 mb-4 shadow-lg shadow-primary-500/10">
                                <?php echo getIcon('coffee', '', ['width'=>32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Alimentos</h4>
                            <p class="small text-muted mb-0 lh-base">Comida preparada, snacks, productos orgánicos y bebidas.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card option-card p-4">
                            <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-4">
                                <?php echo getIcon('edit-3', '', ['width'=>32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Artesanía</h4>
                            <p class="small text-muted mb-0 lh-base">Trabajos manuales, cerámica, joyería y orfebrería.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card option-card p-4">
                            <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-4">
                                <?php echo getIcon('scissors', '', ['width'=>32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Textil & Moda</h4>
                            <p class="small text-muted mb-0 lh-base">Ropa, accesorios, tejidos y diseño textil.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 2 -->
            <div class="p-4 p-md-5 bg-light bg-opacity-25 border-bottom px-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h2 class="h3 fw-bold text-dark mb-0">2. Validación de RUT</h2>
                        <span class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                    </div>
                    <p class="text-muted mb-0">Ingrese su RUT para verificar su identidad y sincronizar antecedentes automáticamente.</p>
                </div>

                <div class="row justify-content-center py-4">
                    <div class="col-md-8 col-lg-6">
                        <div class="mb-4">
                            <label class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.6rem; letter-spacing: 1px;">RUT del Emprendedor</label>
                            <div class="input-group input-group-lg shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted px-4 rounded-start-4">
                                    <?php echo getIcon('user', '', ['width'=>20]); ?>
                                </span>
                                <input type="text" class="form-control bg-white border-start-0 py-4 fw-bold rounded-end-4" placeholder="12.345.678-9" style="font-size: 1rem;">
                            </div>
                        </div>

                        <div class="alert bg-success-light border border-success border-opacity-10 p-4 rounded-4 d-flex align-items-center gap-3">
                            <div class="text-success"><?php echo getIcon('user-check', '', ['width'=>32, 'height'=>32]); ?></div>
                            <div>
                                <h6 class="fw-bold text-success mb-0">Identidad Validada</h6>
                                <p class="small text-muted mb-0">Verificado exitosamente con el Registro Civil.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 3 -->
            <div class="p-4 p-md-5 px-lg-5">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-4 mb-5">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <h2 class="h3 fw-bold text-dark mb-0">3. Carga de Documentos</h2>
                            <span class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                        </div>
                        <p class="text-muted mb-0">Documentación requerida para la categoría <span class="text-primary fw-bold">Alimentos</span>.</p>
                    </div>
                    <span class="status-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10 py-2 px-3 fw-black d-flex align-items-center gap-2 shadow-sm">
                         <?php echo getIcon('clock', '', ['width'=>16]); ?> VALIDACIÓN PENDIENTE
                    </span>
                </div>

                <div class="vstack gap-3 mb-5">
                    <!-- Doc 1 -->
                    <div class="card p-4 border-light bg-opacity-50 overflow-hidden shadow-sm flex-row align-items-center gap-4 hover-primary" style="border-radius: 16px;">
                        <div class="bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center">
                            <?php echo getIcon('file-text', '', ['width'=>24]); ?>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Cédula de Identidad (Ambos Lados)</h6>
                            <p class="small text-muted mb-0">cedula_identidad_final.pdf • 1.2MB</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-pill bg-success-light text-success shadow-none border border-success border-opacity-10">VALIDADO</span>
                            <button class="btn btn-white text-muted border-0 p-2 rounded-circle hover-primary"><?php echo getIcon('eye', '', ['width'=>20]); ?></button>
                        </div>
                    </div>

                    <!-- Doc 2 -->
                    <div class="card p-4 border-primary border-2 border-dashed bg-primary-light flex-row align-items-center gap-4 hover-shadow" style="border-radius: 16px;">
                        <div class="bg-primary text-white rounded-4 p-3 d-flex align-items-center justify-content-center shadow shadow-primary-500/10">
                            <?php echo getIcon('shield', '', ['width'=>24]); ?>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold text-dark mb-1">Resolución Sanitaria (Seremi)</h6>
                            <p class="small text-muted mb-0">Obligatorio para emprendimientos de alimentos</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10">REQUERIDO</span>
                            <button class="btn btn-primary rounded-4 px-4 py-2 small fw-bold shadow-lg border-0 d-flex align-items-center gap-2">
                                <?php echo getIcon('upload-cloud', '', ['width'=>16]); ?> Subir Archivo
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 pt-4 mt-5 border-top">
                    <button class="btn btn-white text-muted fw-bold d-flex align-items-center gap-2 px-0 border-0 shadow-none">
                        <?php echo getIcon('save', '', ['width'=>20]); ?> Guardar y Salir
                    </button>
                    <div class="d-flex gap-3 w-100 w-md-auto">
                        <button class="btn btn-white border-light border-2 text-dark fw-bold rounded-4 px-5 py-3 flex-grow-1 flex-md-grow-0 d-flex align-items-center justify-content-center gap-2">
                            <?php echo getIcon('arrow-left', '', ['width'=>18]); ?> Anterior
                        </button>
                        <button class="btn btn-primary btn-lg rounded-4 px-5 py-3 fw-bold flex-grow-1 flex-md-grow-0 shadow-lg d-flex align-items-center justify-content-center gap-2 border-0">
                            Siguiente <?php echo getIcon('arrow-right', 'text-white', ['width'=>18]); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4"><?php echo getIcon('lock', '', ['width'=>20]); ?></div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Proceso Seguro</p>
                        <p class="small text-muted mb-0 line-clamp-2">Sus datos están protegidos según la Ley 19.628.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4"><?php echo getIcon('help-circle', '', ['width'=>20]); ?></div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">¿Necesita Ayuda?</p>
                        <p class="small text-muted mb-0 line-clamp-2">Contacte al Departamento: soporte@municipalidad.cl</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4"><?php echo getIcon('history', '', ['width'=>20]); ?></div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Auto-Guardado</p>
                        <p class="small text-muted mb-0 line-clamp-2">Su progreso se guarda automáticamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
