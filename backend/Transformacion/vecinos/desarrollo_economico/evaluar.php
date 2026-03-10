<?php
$pageTitle = "Evaluación de Participación";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<style>
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #fbbf24;
    }
    .check-card:hover { border-color: #006FB3 !important; background-color: rgba(0, 111, 179, 0.05) !important; }
    .star-label { font-size: 2.5rem; transition: 0.2s; cursor: pointer; color: #dee2e6; }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="mb-5 text-center">
            <h1 class="h1 fw-black text-dark mb-2">Evaluación de Participación</h1>
            <p class="text-muted lead opacity-75">Tu opinión es fundamental para mejorar nuestras ferias y servicios municipales.</p>
        </div>

        <form>
            <!-- Registro de Asistencia -->
             <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5 px-lg-4">
                <div class="card-header bg-transparent border-0 pt-5 px-4">
                    <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                        <span class="text-primary"><?php echo getIcon('calendar-check', '', ['width'=>24]); ?></span>
                        Registro de Asistencia
                    </h5>
                    <p class="small text-muted mb-0 lh-base">Marca los días en los que estuviste presente en la feria.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">
                        <div class="col-6 col-md-3">
                            <label class="w-100 pointer mb-0">
                                <input type="checkbox" class="d-none">
                                <div class="card h-100 border-2 rounded-4 p-4 text-center check-card border-light transition-all">
                                    <input class="form-check-input mx-auto mb-3" type="checkbox" style="width: 24px; height: 24px;">
                                    <h6 class="fw-bold text-dark mb-1">Día 1</h6>
                                    <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">Lun 23 Oct</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="w-100 pointer mb-0">
                                <input type="checkbox" class="d-none">
                                <div class="card h-100 border-2 rounded-4 p-4 text-center check-card border-light transition-all">
                                    <input class="form-check-input mx-auto mb-3" type="checkbox" style="width: 24px; height: 24px;">
                                    <h6 class="fw-bold text-dark mb-1">Día 2</h6>
                                    <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">Mar 24 Oct</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="w-100 pointer mb-0">
                                <input type="checkbox" class="d-none">
                                <div class="card h-100 border-2 rounded-4 p-4 text-center check-card border-light transition-all">
                                    <input class="form-check-input mx-auto mb-3" type="checkbox" style="width: 24px; height: 24px;">
                                    <h6 class="fw-bold text-dark mb-1">Día 3</h6>
                                    <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">Mié 25 Oct</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="w-100 pointer mb-0">
                                <input type="checkbox" class="d-none">
                                <div class="card h-100 border-2 rounded-4 p-4 text-center check-card border-light transition-all">
                                    <input class="form-check-input mx-auto mb-3" type="checkbox" style="width: 24px; height: 24px;">
                                    <h6 class="fw-bold text-dark mb-1">Día 4</h6>
                                    <span class="text-uppercase text-muted fw-bold" style="font-size: 0.55rem; letter-spacing: 0.5px;">Jue 26 Oct</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rúbrica de Evaluación -->
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5 px-lg-4">
                <div class="card-header bg-transparent border-0 pt-5 px-4">
                    <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                        <span class="text-primary"><?php echo getIcon('star', '', ['width'=>24]); ?></span>
                        Rúbrica de Evaluación
                    </h5>
                    <p class="small text-muted mb-0 lh-base">Califica los siguientes aspectos de 1 a 5 estrellas.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="vstack gap-5">
                        <?php 
                        $questions = [
                            ["Calidad del espacio", "Dimensiones, estado del puesto y ubicación."],
                            ["Flujo de público", "Cantidad de personas y potencial de ventas."],
                            ["Organización municipal", "Apoyo del personal y logística de la feria."],
                            ["Satisfacción general", "Experiencia global en el evento."]
                        ];
                        foreach($questions as $idx => $q): ?>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-4">
                            <div>
                                <h6 class="fw-bold text-dark mb-1"><?php echo ($idx+1) . ". " . $q[0]; ?></h6>
                                <p class="small text-muted mb-0 lh-base"><?php echo $q[1]; ?></p>
                            </div>
                            <div class="d-flex flex-row-reverse star-rating gap-1 h4 mb-0">
                                <?php for($i=5; $i>=1; $i--): ?>
                                    <input class="d-none" id="q<?php echo $idx; ?>-<?php echo $i; ?>" name="q<?php echo $idx; ?>" type="radio" value="<?php echo $i; ?>">
                                    <label class="star-label bi bi-star-fill leading-none" for="q<?php echo $idx; ?>-<?php echo $i; ?>">★</label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Comentarios -->
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5">
                    <label class="h6 fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                        <?php echo getIcon('message-square', 'text-primary'); ?>
                        Comentarios Adicionales o Sugerencias
                    </label>
                    <textarea class="form-control border-light bg-light bg-opacity-25 rounded-4 p-4 shadow-none" rows="5" placeholder="Cuéntanos más sobre tu experiencia o qué podríamos mejorar..."></textarea>
                </div>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-end align-items-center gap-4 py-5">
                <button class="btn btn-white text-muted fw-bold px-5 border-0 shadow-none font-bold" type="button">Cancelar</button>
                <button class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg d-flex align-items-center gap-2 border-0" type="submit">
                    <?php echo getIcon('send', '', ['width'=>18]); ?> Enviar Evaluación
                </button>
            </div>
        </form>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
