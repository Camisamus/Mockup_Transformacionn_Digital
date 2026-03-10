<?php
$pageTitle = "Reservar Hora Licencia";
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
        height: 2px;
        background-color: #dee2e6;
        flex-grow: 1;
        margin: 0 1rem;
    }
    .option-card {
        border: 2px solid transparent;
        cursor: pointer;
        transition: 0.2s;
        border-radius: 20px;
    }
    .option-card:hover { border-color: #006FB3; transform: translateY(-3px); }
    .option-card input:checked + .card-content { border-color: #006FB3; background-color: rgba(0, 111, 179, 0.05); }
    .slot-button:hover { background-color: #006FB3 !important; color: white !important; border-color: #006FB3 !important; }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="mb-5 text-center">
            <h1 class="h1 fw-bold text-dark mb-2">Reserva tu Hora</h1>
            <p class="text-muted lead">Sigue los pasos para agendar tu cita en el Departamento de Tránsito.</p>
        </div>

        <!-- Stepper -->
        <div class="d-flex align-items-center mb-5 px-lg-5">
            <div class="d-flex align-items-center gap-2">
                <div class="stepper-circle bg-primary text-white">1</div>
                <span class="small fw-bold text-dark d-none d-md-block">Elegir Trámite</span>
            </div>
            <div class="stepper-line"></div>
            <div class="d-flex align-items-center gap-2">
                <div class="stepper-circle bg-light text-muted border">2</div>
                <span class="small fw-medium text-muted d-none d-md-block opacity-75">Seleccionar Horario</span>
            </div>
            <div class="stepper-line"></div>
            <div class="d-flex align-items-center gap-2">
                <div class="stepper-circle bg-light text-muted border">3</div>
                <span class="small fw-medium text-muted d-none d-md-block opacity-75">Confirmación</span>
            </div>
        </div>

        <form action="confirmar.php" method="POST">
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <label class="w-100 mb-0 pointer">
                        <input type="radio" name="tramite" class="d-none" checked value="renovacion">
                        <div class="card h-100 option-card border-2 shadow-sm">
                            <div class="card-body p-4 text-center">
                                <div class="bg-primary-light text-primary rounded-4 d-inline-flex p-3 mb-3">
                                    <?php echo getIcon('refresh-cw', '', ['width'=>32, 'height'=>32]); ?>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Renovación</h6>
                                <p class="small text-muted mb-0">Licencias vencidas o por vencer de la comuna.</p>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="w-100 mb-0 pointer">
                        <input type="radio" name="tramite" class="d-none" value="primera">
                        <div class="card h-100 option-card border-2 shadow-sm">
                            <div class="card-body p-4 text-center">
                                <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-3">
                                    <?php echo getIcon('award', '', ['width'=>32, 'height'=>32]); ?>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Primera Licencia</h6>
                                <p class="small text-muted mb-0">Solicitud inicial de licencia Clase B o C.</p>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="w-100 mb-0 pointer">
                        <input type="radio" name="tramite" class="d-none" value="duplicado">
                        <div class="card h-100 option-card border-2 shadow-sm">
                            <div class="card-body p-4 text-center">
                                <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-3">
                                    <?php echo getIcon('copy', '', ['width'=>32, 'height'=>32]); ?>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Duplicado</h6>
                                <p class="small text-muted mb-0">En caso de extravío, robo o deterioro.</p>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label class="w-100 mb-0 pointer">
                        <input type="radio" name="tramite" class="d-none" value="ampliacion">
                        <div class="card h-100 option-card border-2 shadow-sm">
                            <div class="card-body p-4 text-center">
                                <div class="bg-light text-muted rounded-4 d-inline-flex p-3 mb-3">
                                    <?php echo getIcon('plus-circle', '', ['width'=>32, 'height'=>32]); ?>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">Ampliación</h6>
                                <p class="small text-muted mb-0">Para agregar nuevas clases profesionales.</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-5" style="border-radius: 24px;">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                                <?php echo getIcon('calendar', 'text-primary'); ?> Selecciona el Día
                            </h5>
                            <!-- Mock Calendario -->
                            <div class="border rounded-4 p-4 text-center">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fw-bold text-dark small">Marzo, 2024</span>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-sm btn-light border-0"><?php echo getIcon('chevron-left', '', ['width'=>14]); ?></button>
                                        <button type="button" class="btn btn-sm btn-light border-0"><?php echo getIcon('chevron-right', '', ['width'=>14]); ?></button>
                                    </div>
                                </div>
                                <div class="row g-1 mb-2">
                                    <?php foreach(['LU','MA','MI','JU','VI','SA','DO'] as $d): ?>
                                        <div class="col text-muted fw-bold" style="font-size: 0.6rem;"><?php echo $d; ?></div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="row g-1">
                                    <!-- Simplified calendar mock -->
                                    <?php for($i=1; $i<=14; $i++): ?>
                                        <div class="col-2 col-md-1-7 mb-2">
                                            <button type="button" class="btn btn-sm w-100 <?php echo $i == 6 ? 'btn-primary fw-bold' : 'btn-white text-dark shadow-none'; ?> rounded-3 py-2" style="font-size: 0.75rem;"><?php echo $i; ?></button>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-start-md">
                            <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                                <?php echo getIcon('clock', 'text-primary'); ?> Bloque Horario
                            </h5>
                            <p class="small text-muted mb-4 fw-bold text-uppercase" style="letter-spacing: 0.5px;">Miércoles 06 de Marzo</p>
                            <div class="row g-3">
                                <?php foreach(['09:00 AM', '10:30 AM', '12:00 PM', '02:30 PM'] as $idx => $time): ?>
                                    <div class="col-6">
                                        <label class="w-100 pointer">
                                            <input type="radio" name="hora" class="d-none" <?php echo $idx == 1 ? 'checked' : ''; ?> value="<?php echo $time; ?>">
                                            <div class="btn btn-outline-light text-dark fw-bold w-100 py-3 rounded-4 slot-button border-secondary opacity-75 shadow-sm" style="font-size: 0.85rem; border: 2px solid #eee;">
                                                <?php echo $time; ?>
                                            </div>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="alert bg-primary-light border-0 mt-4 d-flex align-items-center gap-2" role="alert">
                                <div class="text-primary"><?php echo getIcon('lock', '', ['width'=>16]); ?></div>
                                <span class="small text-dark opacity-75">Tu hora se reservará por 15 minutos mientras confirmas.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="index.php" class="btn btn-white text-muted fw-bold d-flex align-items-center gap-2 px-4 shadow-none">
                    <?php echo getIcon('arrow-left', '', ['width'=>18]); ?> Cancelar
                </a>
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold shadow-lg d-flex align-items-center gap-3">
                    Agendar Cita <?php echo getIcon('chevron-right', '', ['width'=>18]); ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
