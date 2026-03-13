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

    .option-card:hover {
        border-color: #006FB3;
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
    }

    .option-card.active {
        border-color: #006FB3;
        background-color: rgba(0, 111, 179, 0.05);
    }

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

        <!-- Stepper (Oculto en Paso 0) -->
        <div id="main-stepper" class="d-none align-items-center mb-5 px-lg-5">
            <div class="d-flex flex-column align-items-center gap-2">
                <div class="stepper-circle bg-primary text-white shadow-lg">1</div>
                <span class="small fw-bold text-primary text-uppercase" style="font-size: 0.55rem;">Categoría</span>
            </div>
            <div class="stepper-line">
                <div class="bg-primary h-100 w-33 rounded-pill"></div>
            </div>
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
            <!-- Sección 0: Mis Emprendimientos -->
            <div id="section-0" class="p-4 p-md-5 border-bottom px-lg-5">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4 mb-5">
                    <div>
                        <h2 class="h3 fw-bold text-dark mb-1">Mis Emprendimientos</h2>
                        <p class="text-muted mb-0">Gestione sus negocios inscritos actualmente en el sistema.</p>
                    </div>
                    <button id="btn-add-new"
                        class="btn btn-primary btn-lg rounded-4 px-4 py-3 fw-bold shadow-lg d-flex align-items-center gap-2 border-0">
                        <?php echo getIcon('plus', 'text-white', ['width' => 20]); ?> Agregar Nuevo
                    </button>
                </div>

                <div id="my-records-container" class="row g-4">
                    <div class="col-12 text-center p-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2 text-muted">Cargando sus registros...</p>
                    </div>
                </div>
            </div>
            <!-- Sección 1 -->
            <div id="section-1" class="p-4 p-md-5 border-bottom px-lg-5">
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h2 class="h3 fw-bold text-dark mb-0">1. Categoría de Negocio</h2>
                        <span
                            class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                    </div>
                    <p class="text-muted mb-0">Seleccione el área principal de su actividad comercial. Esto determinará
                        los documentos requeridos posteriormente.</p>
                </div>

                <div class="row g-4" id="category-selector">
                    <div class="col-md-4">
                        <div class="card option-card active p-4 position-relative" data-rubro="1">
                            <div class="position-absolute top-0 end-0 p-3 text-primary icon-check">
                                <?php echo getIcon('check-circle', '', ['width' => 24]); ?>
                            </div>
                            <div
                                class="bg-primary text-white rounded-4 d-inline-flex p-3 mb-4 shadow-lg shadow-primary-500/10">
                                <?php echo getIcon('coffee', '', ['width' => 32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Alimentos</h4>
                            <p class="small text-muted mb-0 lh-base">Comida preparada, snacks, productos orgánicos y
                                bebidas.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card option-card p-4 position-relative" data-rubro="2">
                            <div class="position-absolute top-0 end-0 p-3 text-primary icon-check d-none">
                                <?php echo getIcon('check-circle', '', ['width' => 24]); ?>
                            </div>
                            <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-4">
                                <?php echo getIcon('edit-3', '', ['width' => 32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Artesanía</h4>
                            <p class="small text-muted mb-0 lh-base">Trabajos manuales, cerámica, joyería y orfebrería.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card option-card p-4 position-relative" data-rubro="3">
                            <div class="position-absolute top-0 end-0 p-3 text-primary icon-check d-none">
                                <?php echo getIcon('check-circle', '', ['width' => 24]); ?>
                            </div>
                            <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-4">
                                <?php echo getIcon('scissors', '', ['width' => 32]); ?>
                            </div>
                            <h4 class="h5 fw-bold text-dark mb-2">Textil & Moda</h4>
                            <p class="small text-muted mb-0 lh-base">Ropa, accesorios, tejidos y diseño textil.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 2 -->
            <div id="section-2" class="p-4 p-md-5 bg-light bg-opacity-25 border-bottom px-lg-5 d-none">
                <div class="mb-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h2 class="h3 fw-bold text-dark mb-0">2. Validación de RUT</h2>
                        <span
                            class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                    </div>
                    <p class="text-muted mb-0">Ingrese su RUT para verificar su identidad y sincronizar antecedentes
                        automáticamente.</p>
                </div>

                <div class="row justify-content-center py-4">
                    <div class="col-md-10 col-lg-8">
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="text-uppercase text-muted fw-bold mb-1"
                                    style="font-size: 0.6rem; letter-spacing: 1px;">RUT del Emprendedor</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span
                                        class="input-group-text bg-white border-end-0 text-muted px-4 rounded-start-4">
                                        <?php echo getIcon('user', '', ['width' => 20]); ?>
                                    </span>
                                    <input type="text" id="input-rut"
                                        class="form-control bg-white border-start-0 py-4 fw-bold rounded-end-4"
                                        placeholder="12.345.678-9">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="text-uppercase text-muted fw-bold mb-1"
                                    style="font-size: 0.6rem; letter-spacing: 1px;">Nombre de Fantasía</label>
                                <input type="text" id="input-fantasia"
                                    class="form-control form-control-lg rounded-4 shadow-sm py-3"
                                    placeholder="Ej: Mi Pyme">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="text-uppercase text-muted fw-bold mb-1"
                                style="font-size: 0.6rem; letter-spacing: 1px;">Descripción del Emprendimiento</label>
                            <textarea id="input-descripcion" class="form-control rounded-4 shadow-sm" rows="3"
                                placeholder="Cuéntenos brevemente qué hace su negocio..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="text-uppercase text-muted fw-bold mb-1"
                                style="font-size: 0.6rem; letter-spacing: 1px;">Dirección Comercial / Tributaria</label>
                            <div class="input-group input-group-lg shadow-sm mb-3">
                                <input type="text" id="input-direccion"
                                    class="form-control form-control-lg rounded-start-4 shadow-none py-3"
                                    placeholder="Calle, Número, Comuna">
                                <button id="btn-buscar-direccion" class="btn btn-primary px-4 rounded-end-4 fw-bold">
                                    <?php echo getIcon('search', 'text-white', ['width' => 18]); ?> Buscar
                                </button>
                            </div>

                            <!-- Contenedor del Mapa -->
                            <div id="map-container" class="rounded-4 overflow-hidden border shadow-sm"
                                style="height: 300px; width: 100%; position: relative;">
                                <div id="map" style="height: 100%; width: 100%;"></div>
                            </div>
                            <input type="hidden" id="input-lat">
                            <input type="hidden" id="input-lon">
                        </div>

                        <div id="rut-success-alert"
                            class="alert bg-success-light border border-success border-opacity-10 p-4 rounded-4 d-none align-items-center gap-3">
                            <div class="text-success">
                                <?php echo getIcon('user-check', '', ['width' => 32, 'height' => 32]); ?>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-success mb-0">Identidad Validada</h6>
                                <p class="small text-muted mb-0">Verificado exitosamente con el Registro Civil.</p>
                            </div>
                        </div>

                        <!-- Carga de documentos de identidad -->
                        <div class="mt-4 p-4 border border-dashed rounded-4 bg-light bg-opacity-50">
                            <h6 class="fw-bold mb-3">Documentación de Respaldo</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="small fw-bold text-muted mb-2">Cédula de Identidad (Ambos
                                        Lados)</label>
                                    <input type="file" id="file-cedula" class="form-control form-control-sm rounded-3">
                                </div>
                                <div id="container-estatutos" class="col-md-6 d-none">
                                    <label class="small fw-bold text-muted mb-2">Estatutos / Verificación
                                        Autoridad</label>
                                    <input type="file" id="file-estatutos"
                                        class="form-control form-control-sm rounded-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 3 -->
            <div id="section-3" class="p-4 p-md-5 px-lg-5 d-none">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-4 mb-5">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <h2 class="h3 fw-bold text-dark mb-0">3. Carga de Documentos</h2>
                            <span
                                class="status-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">OBLIGATORIO</span>
                        </div>
                        <p class="text-muted mb-0">Documentación requerida para la categoría <span
                                class="text-primary fw-bold">Alimentos</span>.</p>
                    </div>
                    <span
                        class="status-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10 py-2 px-3 fw-black d-flex align-items-center gap-2 shadow-sm">
                        <?php echo getIcon('clock', '', ['width' => 16]); ?> VALIDACIÓN PENDIENTE
                    </span>
                </div>

                <div id="dynamic-docs-container" class="vstack gap-3 mb-5">
                    <!-- Aquí se cargarán dinámicamente los documentos requeridos -->
                    <div class="text-center p-4 text-muted">
                        <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                        Cargando requisitos según categoría...
                    </div>
                </div>

                <hr class="my-5 opacity-10">

                <div class="mb-5">
                    <h5 class="fw-bold text-dark mb-4">Multimedia del Negocio</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 border rounded-4 bg-light bg-opacity-25 h-100">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3">
                                        <?php echo getIcon('image', 'text-primary', ['width' => 20]); ?>
                                    </div>
                                    <h6 class="fw-bold mb-0">Imagen de Portada</h6>
                                </div>
                                <p class="small text-muted mb-3">Se mostrará en la cabecera de su perfil público.</p>
                                <input type="file" id="file-portada" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 border rounded-4 bg-light bg-opacity-25 h-100">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-3">
                                        <?php echo getIcon('box', 'text-primary', ['width' => 20]); ?>
                                    </div>
                                    <h6 class="fw-bold mb-0">Logo del Negocio</h6>
                                </div>
                                <p class="small text-muted mb-3">Imagen cuadrada recomendada para el catálogo.</p>
                                <input type="file" id="file-logo" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- Fin Section 3 -->

            <!-- Navegación unificada -->
            <div id="nav-container" class="p-4 p-md-5 px-lg-5 pt-4 border-top d-none">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">

                    <div class="d-flex gap-3 w-100 w-md-auto">
                        <button id="btn-prev"
                            class="btn btn-white border-light border-2 text-dark fw-bold rounded-4 px-5 py-3 flex-grow-1 flex-md-grow-0 d-none align-items-center justify-content-center gap-2">
                            <?php echo getIcon('arrow-left', '', ['width' => 18]); ?> Anterior
                        </button>
                        <button id="btn-next"
                            class="btn btn-primary btn-lg rounded-4 px-5 py-3 fw-bold flex-grow-1 flex-md-grow-0 shadow-lg d-flex align-items-center justify-content-center gap-2 border-0">
                            Siguiente <?php echo getIcon('arrow-right', 'text-white', ['width' => 18]); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!-- Fin Card -->

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <?php echo getIcon('lock', '', ['width' => 20]); ?>
                    </div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1"
                            style="font-size: 0.55rem; letter-spacing: 1px;">Proceso Seguro</p>
                        <p class="small text-muted mb-0 line-clamp-2">Sus datos están protegidos según la Ley 19.628.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <?php echo getIcon('help-circle', '', ['width' => 20]); ?>
                    </div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1"
                            style="font-size: 0.55rem; letter-spacing: 1px;">¿Necesita Ayuda?</p>
                        <p class="small text-muted mb-0 line-clamp-2">Contacte al Departamento: soporte@municipalidad.cl
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 p-2">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4">
                        <?php echo getIcon('history', '', ['width' => 20]); ?>
                    </div>
                    <div>
                        <p class="text-uppercase text-muted fw-bold mb-1"
                            style="font-size: 0.55rem; letter-spacing: 1px;">Auto-Guardado</p>
                        <p class="small text-muted mb-0 line-clamp-2">Su progreso se guarda automáticamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../recursos/js/helpers.js"></script>
<?php
use App\Config\AppConfig;
$googleMapsKey = AppConfig::getGoogleMapsKey();
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $googleMapsKey; ?>&libraries=places"></script>
<script src="../../recursos/js/vecinos/desarrollo_economico/inscripcion.js"></script>

<?php include '../../apivec/general/footer.php'; ?>