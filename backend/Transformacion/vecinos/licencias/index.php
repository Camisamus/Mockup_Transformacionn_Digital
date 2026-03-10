<?php
$pageTitle = "Dashboard de Licencias";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<!-- Estilos específicos para este módulo que complementan el sistema -->
<style>
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        border-color: #006FB3 !important;
    }
    .status-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bg-primary-light {
        background-color: rgba(0, 111, 179, 0.08);
    }
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="row g-4">
    <!-- Columna Principal -->
    <div class="col-lg-8">
        <!-- Estado de la Licencia -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="status-badge bg-success text-white">Documento Vigente</span>
                    <span class="text-muted small">•</span>
                    <span class="text-muted small">Próximo vencimiento: 12 Octubre, 2026</span>
                </div>
                
                <h1 class="h2 fw-bold text-dark mb-1">Juan Pablo Pérez González</h1>
                <p class="text-muted fw-medium mb-4">RUT: 12.345.678-9</p>

                <hr class="my-4 opacity-10">

                <div class="row g-4">
                    <div class="col-6 col-md-4">
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Clase</p>
                        <p class="h4 fw-bold text-primary mb-0">B y C</p>
                    </div>
                    <div class="col-6 col-md-4">
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Otorgamiento</p>
                        <p class="h4 fw-bold text-dark mb-0">12/10/2020</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Próximo Control</p>
                        <p class="h4 fw-bold text-dark mb-0">12/10/2026</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trámites en Curso -->
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <?php echo getIcon('clock', 'text-primary', ['width'=>20, 'height'=>20]); ?>
                    Mis Trámites en Curso
                </h5>
                <span class="badge bg-primary-light text-primary rounded-pill px-3 py-2">1 Activo</span>
            </div>
            <div class="card-body p-4">
                <div class="p-4 rounded-4 bg-light border d-flex align-items-center gap-4">
                    <div class="icon-box bg-white shadow-sm text-primary flex-shrink-0">
                        <?php echo getIcon('refresh-cw', '', ['width'=>24, 'height'=>24]); ?>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="fw-bold text-dark mb-0">Renovación Licencia Clase B</h6>
                            <span class="status-badge bg-warning text-dark" style="font-size: 0.6rem;">Pendiente de Documentos</span>
                        </div>
                        <p class="small text-muted mb-3">Iniciado el 05 de Marzo, 2024</p>
                        <div class="progress" style="height: 6px; border-radius: 10px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem;">Solicitud</span>
                            <span class="text-uppercase text-primary fw-bold" style="font-size: 0.55rem;">Carga Doc.</span>
                            <span class="text-uppercase text-muted fw-bold opacity-50" style="font-size: 0.55rem;">Exámenes</span>
                            <span class="text-uppercase text-muted fw-bold opacity-50" style="font-size: 0.55rem;">Entrega</span>
                        </div>
                    </div>
                    <a href="gestionar.php" class="btn btn-white border shadow-sm rounded-3 p-2 text-muted">
                        <?php echo getIcon('chevron-right'); ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div class="row g-4">
            <div class="col-md-6">
                <a href="reservar.php" class="card border-0 bg-primary text-white h-100 card-hover transition-all text-decoration-none" style="border-radius: 20px;">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">Reservar Hora</h5>
                            <p class="small opacity-75 mb-0">Agenda tu examen práctico o médico</p>
                        </div>
                        <div class="opacity-25">
                            <?php echo getIcon('calendar', '', ['width'=>48, 'height'=>48]); ?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="gestionar.php" class="card border-0 bg-white h-100 border-start border-primary border-4 card-hover shadow-sm transition-all text-decoration-none" style="border-radius: 20px;">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Cargar Documentos</h5>
                            <p class="small text-muted mb-0">Sube tu certificado de estudios o médico</p>
                        </div>
                        <div class="text-primary opacity-25">
                            <?php echo getIcon('upload-cloud', '', ['width'=>48, 'height'=>48]); ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Columna Lateral -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-4">Requisitos Generales</h6>
                <div class="d-flex gap-3 mb-4">
                    <div class="text-success"><?php echo getIcon('check-circle', '', ['width'=>20, 'height'=>20]); ?></div>
                    <div>
                        <p class="small fw-bold text-dark mb-0">Cédula de Identidad</p>
                        <p class="small text-muted mb-0">Vigente y original</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="text-success"><?php echo getIcon('check-circle', '', ['width'=>20, 'height'=>20]); ?></div>
                    <div>
                        <p class="small fw-bold text-dark mb-0">Certificado de Estudios</p>
                        <p class="small text-muted mb-0">Acreditación de escolaridad</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="text-primary"><?php echo getIcon('info', '', ['width'=>20, 'height'=>20]); ?></div>
                    <div>
                        <p class="small fw-bold text-dark mb-0">Licencia Anterior</p>
                        <p class="small text-muted mb-0">En caso de renovación</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 bg-dark text-white mb-4" style="border-radius: 20px; background: linear-gradient(135deg, #101922 0%, #1a2a3a 100%);">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-2">¿Tienes dudas?</h6>
                <p class="small opacity-75 mb-4">Revisa nuestra sección de preguntas frecuentes o contáctanos directamente.</p>
                <button class="btn btn-outline-light btn-sm w-100 fw-bold py-2 rounded-3 border-secondary opacity-75">Ir al Centro de Ayuda</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4">
                <h6 class="fw-bold text-dark mb-3">Noticias Municipales</h6>
                <div class="mb-3 pb-3 border-bottom border-light">
                    <p class="text-primary fw-bold mb-1" style="font-size: 0.6rem; letter-spacing: 0.5px;">02 MAR, 2024</p>
                    <a href="#" class="small fw-bold text-dark text-decoration-none hover-primary">Extensión de prórroga para licencias vencidas en 2023</a>
                </div>
                <div>
                    <p class="text-primary fw-bold mb-1" style="font-size: 0.6rem; letter-spacing: 0.5px;">28 FEB, 2024</p>
                    <a href="#" class="small fw-bold text-dark text-decoration-none hover-primary">Nuevo simulador de examen teórico disponible gratis</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>