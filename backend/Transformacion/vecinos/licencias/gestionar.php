<?php
$pageTitle = "Gestionar Documentos";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end gap-3 mb-5 px-lg-4">
            <div>
                <h1 class="h1 fw-bold text-dark mb-1 tracking-tight">Gestionar Documentos</h1>
                <p class="text-muted mb-0 lead">Carga los requisitos necesarios para tu trámite de Licencia de Conducir.</p>
            </div>
            <div class="bg-primary-light border border-primary-subtle px-4 py-2 rounded-4 text-primary fw-bold small d-flex align-items-center gap-2 shadow-sm mb-md-2">
                <?php echo getIcon('file-text', '', ['width'=>18]); ?> Trámite: Renovación Clase B
            </div>
        </div>

        <div class="row g-5">
            <!-- Zona de Requisitos -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                            <?php echo getIcon('check-circle', 'text-primary'); ?>
                            Lista de Requisitos
                        </h5>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="vstack gap-4">
                            <!-- Requisito 1 -->
                            <div class="p-4 rounded-4 border-2 bg-light border-light d-flex flex-column flex-md-row align-items-start gap-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center p-2 shadow shadow-success-500/10">
                                    <?php echo getIcon('check', '', ['width'=>18, 'height'=>18]); ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1">Cédula de Identidad (Ambos Lados)</h6>
                                    <p class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.55rem; letter-spacing: 0.5px;">Última carga: 05 Mar, 2024</p>
                                    <span class="badge bg-success shadow-none rounded-pill px-3 py-1 fw-bold" style="font-size: 0.6rem;">DOCUMENTO VIGENTE</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-white border-0 shadow-none text-muted p-2 rounded-circle hover-primary"><?php echo getIcon('eye', '', ['width', 20]); ?></button>
                                    <button class="btn btn-white border-0 shadow-none text-muted p-2 rounded-circle hover-danger"><?php echo getIcon('trash', '', ['width', 20]); ?></button>
                                </div>
                            </div>

                            <!-- Requisito 2 -->
                            <div class="p-4 rounded-4 border-2 bg-primary-light border-primary-subtle d-flex flex-column flex-md-row align-items-start gap-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center p-2 shadow shadow-primary-500/10">
                                    <?php echo getIcon('upload', '', ['width'=>18, 'height'=>18]); ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                                        Certificado de Estudios (8° Básico o Sup.)
                                        <span class="badge bg-warning text-dark shadow-none rounded-pill px-2 py-1 fw-bold" style="font-size: 0.55rem;">REQUERIDO</span>
                                    </h6>
                                    <p class="text-uppercase text-muted fw-bold mb-3" style="font-size: 0.55rem; letter-spacing: 0.5px;">Aún no se han cargado archivos</p>
                                    <button class="btn btn-primary btn-sm rounded-3 py-2 px-4 shadow-sm fw-bold border-0">Subir Archivo</button>
                                </div>
                            </div>

                            <!-- Requisito 3 -->
                            <div class="p-4 rounded-4 border-2 bg-light border-light d-flex flex-column flex-md-row align-items-start gap-3 opacity-50">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center p-2">
                                    <?php echo getIcon('clock', '', ['width'=>18, 'height'=>18]); ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold text-dark mb-1">Certificado de Antecedentes (Electrónico)</h6>
                                    <p class="small text-muted mb-0">El sistema lo obtendrá automáticamente antes de la cita.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zona Dropzone -->
                <div class="card border-0 shadow-none rounded-5 d-flex flex-column align-items-center justify-content-center p-5 text-center transition-all cursor-pointer bg-white border-2 border-dashed border-light hover-border-primary" style="min-height: 200px;">
                    <div class="bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center p-3 mb-3 shadow-sm transition-all shadow-primary-500/5">
                        <?php echo getIcon('upload-cloud', '', ['width'=>32, 'height'=>32]); ?>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Cargar Archivo Nuevo</h6>
                    <p class="small text-muted mb-0">Arrastra archivos aquí o haz clic para seleccionar (PDF, JPG, PNG)</p>
                </div>
            </div>

            <!-- Resumen y Seguridad -->
            <div class="col-lg-4">
                <div class="card border-0 bg-dark text-white rounded-5 shadow-lg mb-4" style="background: linear-gradient(135deg, #101922 0%, #1a2a3a 100%);">
                    <div class="card-body p-4 p-md-5">
                        <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                            <span class="text-success"><?php echo getIcon('shield', '', ['width'=>20]); ?></span>
                            Carga Segura de Datos
                        </h6>
                        <p class="small opacity-75 mb-5 lh-lg">Tus documentos son procesados bajo estrictas normas de privacidad y solo serán accesibles por el personal del Departamento de Tránsito.</p>
                        
                        <div class="bg-white bg-opacity-10 py-4 px-3 rounded-4 border border-white border-opacity-10 text-center shadow-sm">
                            <p class="small text-uppercase fw-bold opacity-50 mb-2" style="font-size: 0.6rem; letter-spacing: 1px;">Estado de Documentación</p>
                            <div class="h3 fw-bold mb-3">33%</div>
                            <div class="progress bg-white bg-opacity-10" style="height: 6px; border-radius: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-5" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-4">¿Necesitas ayuda?</h6>
                        <div class="vstack gap-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="text-muted"><?php echo getIcon('help-circle', '', ['width'=>20]); ?></div>
                                <p class="small text-muted mb-0 lh-base">Si no cuentas con tu certificado de estudios, puedes obtenerlo en línea en <strong>Mineduc en Línea</strong>.</p>
                            </div>
                            <a href="#" class="btn btn-white border border-light text-primary fw-bold small p-3 rounded-4 text-decoration-none shadow-sm shadow-primary-500/5 d-flex align-items-center justify-content-center gap-2">
                                Mineduc en Línea <?php echo getIcon('external-link', '', ['width'=>14]); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 px-lg-4">
            <a href="confirmar.php" class="btn btn-white text-muted fw-bold d-flex align-items-center gap-2 px-0 shadow-none border-0 small">
                <?php echo getIcon('arrow-left', '', ['width'=>16]); ?> Volver al Comprobante
            </a>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
