<?php
$pageTitle = "Confirmación de Reserva";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center mb-5">
            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center p-3 mb-4 shadow shadow-success-500/10" style="width: 80px; height: 80px;">
                <?php echo getIcon('check-circle', '', ['width'=>48, 'height'=>48]); ?>
            </div>
            <h1 class="h1 fw-bold text-dark mb-2 tracking-tight">¡Hora Agendada con Éxito!</h1>
            <p class="text-muted lead">Tu cita ha sido confirmada. Hemos enviado un respaldo a tu correo electrónico.</p>
        </div>

        <!-- Ticket de Reserva -->
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden mb-5">
            <div class="row g-0">
                <!-- Seccion QR / Lateral -->
                <div class="col-md-3 bg-primary p-5 d-flex flex-column align-items-center justify-content-center gap-4 text-white text-center">
                    <div class="bg-white p-3 rounded-4 shadow-lg mb-2">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=LIC-2024-00123" alt="QR Code" class="img-fluid rounded-3" style="width: 140px;"/>
                    </div>
                    <p class="small text-uppercase fw-bold tracking-widest opacity-75 mb-0">ID #LIC-2024-00123</p>
                </div>

                <!-- Seccion Datos -->
                <div class="col-md-9 p-5 position-relative">
                    <div class="position-absolute top-5 end-5 text-primary opacity-5 d-none d-md-block">
                        <?php echo getIcon('file-text', '', ['width'=>150, 'height'=>150]); ?>
                    </div>

                    <div class="row g-4 mb-5 relative z-10">
                        <div class="col-sm-6">
                            <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Trámite</p>
                            <p class="h5 fw-bold text-dark mb-0">Renovación Clase B</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Cédula de Identidad</p>
                            <p class="h5 fw-bold text-dark mb-0">12.345.678-9</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Fecha de la Cita</p>
                            <p class="h5 fw-bold text-dark mb-0">Miércoles 06 Mar, 2024</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 1px;">Hora de Atención</p>
                            <p class="h5 fw-bold text-dark mb-0">10:30 AM</p>
                        </div>
                    </div>

                    <div class="border-top pt-4 mb-4">
                        <p class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Ubicación</p>
                        <p class="small text-dark fw-medium d-flex align-items-center gap-2 mb-0">
                            <span class="text-primary"><?php echo getIcon('map-pin', '', ['width'=>16]); ?></span>
                            Departamento de Tránsito - Av. Marina S/N, Viña del Mar.
                        </p>
                    </div>

                    <div class="alert bg-warning-light border-0 py-3 rounded-4 d-flex align-items-start gap-3 mb-0 shadow-sm">
                        <div class="text-warning"><?php echo getIcon('alert-triangle', '', ['width'=>20]); ?></div>
                        <div class="small">
                            <p class="fw-bold text-dark text-uppercase mb-1" style="font-size: 0.65rem;">Instrucciones para el Día de la Cita:</p>
                            <p class="text-muted mb-0">Debes presentarte 15 minutos antes y haber cargado tu documentación en el portal para agilizar el proceso.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <button class="btn btn-white border shadow-sm w-100 p-4 rounded-4 fw-bold text-dark d-flex flex-column align-items-center gap-2 hover-primary">
                    <span class="text-primary"><?php echo getIcon('download', '', ['width'=>24]); ?></span>
                    <span class="small">Descargar Ticket PDF</span>
                </button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-white border shadow-sm w-100 p-4 rounded-4 fw-bold text-dark d-flex flex-column align-items-center gap-2 hover-primary">
                    <span class="text-success"><?php echo getIcon('calendar', '', ['width'=>24]); ?></span>
                    <span class="small">Sincronizar Calendario</span>
                </button>
            </div>
            <div class="col-md-4">
                <a href="gestionar.php" class="btn btn-primary w-100 p-4 rounded-4 shadow-lg fw-bold d-flex flex-column align-items-center gap-2 border-0">
                    <span class="text-white"><?php echo getIcon('upload-cloud', '', ['width'=>24]); ?></span>
                    <span class="small">Subir Documentos Ahora</span>
                </a>
            </div>
        </div>

        <div class="text-center">
            <a href="index.php" class="btn btn-link text-muted fw-bold text-decoration-underline underline-offset-4 small">Volver al Dashboard de Licencias</a>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
