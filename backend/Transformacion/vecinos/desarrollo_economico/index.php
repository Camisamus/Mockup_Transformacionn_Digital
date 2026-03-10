<?php
$pageTitle = "Desarrollo Económico - Dashboard";
$pathPrefix = "../../";
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';

// Mock data based on ferias_dashboard.php
$userName = $_SESSION['vecino_nombre'] ?? "Andrea";
$userSurname = $_SESSION['vecino_apellido'] ?? "";
$userId = "24.551-K";
?>

<style>
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
        border-color: #006FB3 !important;
    }
    .status-badge {
        font-size: 0.65rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="mb-4">
            <h2 class="fw-black text-dark mb-1">Panel de Gestión</h2>
            <p class="text-muted">Gestiona tus ferias y asistencias desde un solo lugar.</p>
        </div>
    </div>

    <!-- Próxima Feria Asignada -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 20px;">
            <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-primary"><?php echo getIcon('star', '', ['width'=>20]); ?></span>
                    <h3 class="h5 fw-bold text-dark mb-0">Próxima Feria Asignada</h3>
                </div>
                <span class="status-badge bg-primary bg-opacity-10 text-primary">Confirmada</span>
            </div>
            <div class="row g-0 flex-grow-1">
                <div class="col-md-6 p-4">
                    <div class="mb-4">
                        <h4 class="h3 fw-black text-primary mb-1">Feria de Emprendimiento</h4>
                        <p class="text-muted small">Plaza de Viña del Mar</p>
                    </div>
                    
                    <div class="vstack gap-4 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light p-2 rounded-3 text-muted">
                                <?php echo getIcon('calendar', '', ['width'=>20]); ?>
                            </div>
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.6rem; letter-spacing: 0.5px;">Fecha de Inicio</p>
                                <p class="fw-bold text-dark mb-0">24 de Octubre, 2023</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light p-2 rounded-3 text-muted">
                                <?php echo getIcon('map-pin', '', ['width'=>20]); ?>
                            </div>
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.6rem; letter-spacing: 0.5px;">Ubicación</p>
                                <p class="fw-bold text-dark mb-0">Sector Pileta, Puesto #42</p>
                            </div>
                        </div>
                    </div>

                    <a href="asistencia.php" class="btn btn-primary btn-lg w-100 rounded-4 fw-bold shadow-lg d-flex align-items-center justify-content-center gap-2 py-3 border-0">
                        <?php echo getIcon('qr-code', 'text-white', ['width'=>20]); ?>
                        Registrar Asistencia de Hoy
                    </a>
                </div>
                <div class="col-md-6 position-relative min-vh-25 md:min-vh-0">
                    <div class="h-100 w-100 bg-center bg-cover" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK');">
                        <div class="absolute inset-0 bg-primary bg-opacity-10"></div>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <div class="position-relative">
                                <span class="text-primary"><?php echo getIcon('map-pin', 'fill-primary', ['width'=>48, 'height'=>48]); ?></span>
                                <span class="position-absolute top-0 end-0 translate-middle-y translate-middle-x badge rounded-circle bg-primary p-1 border border-3 border-white animate-pulse">
                                    <span class="visually-hidden">Aquí</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Columna Lateral -->
    <div class="col-lg-4">
        <div class="vstack gap-4 h-100">
            <!-- Créditos -->
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h6 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                    <span class="text-warning"><?php echo getIcon('credit-card', '', ['width'=>20]); ?></span>
                    Resumen de Créditos
                </h6>
                <div class="d-flex align-items-end justify-content-between mb-2">
                    <span class="h1 fw-black text-primary mb-0">07 <span class="h5 text-muted fw-medium mb-0">/ 14</span></span>
                    <span class="status-badge bg-success bg-opacity-10 text-success">50% Utilizado</span>
                </div>
                <div class="progress mb-3" style="height: 8px; border-radius: 10px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="small text-muted mb-0">Créditos disponibles para postulación a ferias municipales durante el semestre actual.</p>
            </div>

            <!-- Ayuda / Foto -->
            <div class="card border-0 bg-primary text-white p-4 rounded-4 flex-grow-1 d-flex flex-column justify-content-between shadow-lg" style="background: linear-gradient(135deg, #137fec 0%, #006FB3 100%);">
                <div class="mb-4">
                    <h5 class="fw-bold h4 leading-tight mb-2">¿Estás en tu puesto?</h5>
                    <p class="small opacity-75 mb-0">No olvides registrar tu entrada y salida hoy para mantener tus beneficios.</p>
                </div>
                <a href="asistencia.php" class="btn btn-white text-primary fw-bold rounded-3 py-3 d-flex align-items-center justify-content-center gap-2">
                    <?php echo getIcon('camera', '', ['width'=>20]); ?>
                    Tomar Foto de Asistencia
                </a>
            </div>
        </div>
    </div>

    <!-- Asistencias - Feria Actual -->
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-2">
            <div class="card-header bg-transparent border-0 p-4 d-flex flex-column flex-md-row justify-content-between gap-3">
                <div>
                    <h5 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                        <span class="text-success"><?php echo getIcon('check-square', '', ['width'=>20]); ?></span>
                        Mis Asistencias - Feria Actual
                    </h5>
                    <p class="small text-muted mb-0">Seguimiento de cumplimiento de los 4 días de feria.</p>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                        <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem;">Presente</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                        <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem;">En curso</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle bg-light border" style="width: 10px; height: 10px;"></span>
                        <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem;">Pendiente</span>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4 p-md-5 bg-light bg-opacity-50">
                <div class="row g-4">
                    <!-- Día 1 -->
                    <div class="col-6 col-md-3 text-center">
                        <div class="p-4 rounded-4 bg-white border border-success border-opacity-25 shadow-sm h-100">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex p-3 mb-3">
                                <?php echo getIcon('check-circle', '', ['width'=>24]); ?>
                            </div>
                            <h6 class="fw-black h5 mb-1">Día 1</h6>
                            <span class="status-badge text-success small">Completado</span>
                            <p class="small text-muted mt-3 mb-0">24 Oct - 08:30 a 19:00</p>
                        </div>
                    </div>
                    <!-- Día 2 -->
                    <div class="col-6 col-md-3 text-center">
                        <div class="p-4 rounded-4 bg-white border-primary border-2 shadow-lg h-100 scale-105 z-10 position-relative">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex p-3 mb-3">
                                <?php echo getIcon('clock', '', ['width'=>24]); ?>
                            </div>
                            <h6 class="fw-black h5 mb-1">Día 2</h6>
                            <span class="status-badge text-warning small">En curso (Hoy)</span>
                            <p class="small text-muted mt-3 mb-0">Entrada: 08:45 AM</p>
                        </div>
                    </div>
                    <!-- Día 3 -->
                    <div class="col-6 col-md-3 text-center">
                        <div class="p-4 rounded-4 bg-white border opacity-50 h-100">
                            <div class="bg-light text-muted opacity-50 rounded-circle d-inline-flex p-3 mb-3">
                                <?php echo getIcon('calendar', '', ['width'=>24]); ?>
                            </div>
                            <h6 class="fw-black h5 mb-1 text-muted">Día 3</h6>
                            <span class="status-badge text-muted small">Pendiente</span>
                            <p class="small text-muted mt-3 mb-0">Programado: 26 Oct</p>
                        </div>
                    </div>
                    <!-- Día 4 -->
                    <div class="col-6 col-md-3 text-center">
                        <div class="p-4 rounded-4 bg-white border opacity-50 h-100">
                            <div class="bg-light text-muted opacity-50 rounded-circle d-inline-flex p-3 mb-3">
                                <?php echo getIcon('calendar', '', ['width'=>24]); ?>
                            </div>
                            <h6 class="fw-black h5 mb-1 text-muted">Día 4</h6>
                            <span class="status-badge text-muted small">Pendiente</span>
                            <p class="small text-muted mt-3 mb-0">Programado: 27 Oct</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small fw-bold text-dark opacity-75">Progreso de Cumplimiento</span>
                        <span class="small fw-bold text-primary">25%</span>
                    </div>
                    <div class="progress shadow-sm" style="height: 12px; border-radius: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
