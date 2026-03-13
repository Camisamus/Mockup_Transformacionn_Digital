<?php
$pageTitle = "Nueva Solicitud OIRS";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';

// Fetch initial lists
use App\Controllers\oirs_tipoatencioncontroller;
use App\Controllers\oirs_tematicacontroller;
use App\Controllers\oirs_subtematicacontroller;

$atencionCtrl = new oirs_tipoatencioncontroller($db);
$tematicaCtrl = new oirs_tematicacontroller($db);
$subtemeticaCtrl = new oirs_subtematicacontroller($db);

$tiposAtencion = $atencionCtrl->getAll()['data'] ?? [];
$tematicas = $tematicaCtrl->getAll()['data'] ?? [];
$subtematicas = $subtemeticaCtrl->getAll()['data'] ?? [];
?>

<style>
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
        position: relative;
    }
    .step-indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e2e8f0;
        z-index: 1;
        transform: translateY(-50%);
    }
    .step-dot {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        font-weight: 700;
        transition: all 0.3s;
    }
    .step-dot.active {
        border-color: #006FB3;
        background-color: #006FB3;
        color: white;
        box-shadow: 0 0 0 4px rgba(0, 111, 179, 0.1);
    }
    .step-dot.completed {
        border-color: #10b981;
        background-color: #10b981;
        color: white;
    }
    .step-label {
        position: absolute;
        top: 50px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        width: 100px;
        text-align: center;
        left: 50%;
        transform: translateX(-50%);
    }
    .step-dot.active + .step-label { color: #006FB3; }
    
    .wizard-card {
        border-radius: 32px;
        background-color: white;
        box-shadow: 0 20px 40px rgba(0,0,0,0.03);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }
    
    .option-card {
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        height: 100%;
        position: relative;
    }
    .option-card:hover {
        border-color: #006FB3;
        background-color: rgba(0, 111, 179, 0.02);
        transform: translateY(-4px);
    }
    .option-card.active {
        border-color: #006FB3;
        background-color: rgba(0, 111, 179, 0.04);
        box-shadow: 0 10px 20px rgba(0, 111, 179, 0.05);
    }
    .option-card .check-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #006FB3;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.25s;
    }
    .option-card.active .check-icon {
        opacity: 1;
        transform: scale(1);
    }
    
    .step-content { display: none; }
    .step-content.active { display: block; animation: fadeIn 0.4s ease-out; }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <!-- Step Indicator -->
        <div class="step-indicator px-4">
            <div class="position-relative">
                <div class="step-dot active" data-step="1">1</div>
                <div class="step-label">Acción</div>
            </div>
            <div class="position-relative">
                <div class="step-dot" data-step="2">2</div>
                <div class="step-label">Tema</div>
            </div>
            <div class="position-relative">
                <div class="step-dot" data-step="3">3</div>
                <div class="step-label">Motivo</div>
            </div>
            <div class="position-relative">
                <div class="step-dot" data-step="4">4</div>
                <div class="step-label">Mis Datos</div>
            </div>
            <div class="position-relative">
                <div class="step-dot" data-step="5">5</div>
                <div class="step-label">Detalles</div>
            </div>
        </div>

        <div class="wizard-card">
            <form id="formNuevaOirs">
                <!-- STEP 1: ¿Qué desea hacer? -->
                <div class="step-content active p-5" id="step-1">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">¿Qué desea realizar hoy?</h2>
                        <p class="text-muted">Seleccione el tipo de trámite o interacción con el municipio.</p>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($tiposAtencion as $t): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="option-card p-4 text-center select-type" data-value="<?= $t['tat_id'] ?>">
                                    <div class="check-icon"><?= getIcon('check-circle', '', ['width' => 20, 'height' => 20]) ?></div>
                                    <div class="mx-auto mb-3 text-primary bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                                        <?= getIcon('help-circle', '', ['width' => 28, 'height' => 28]) ?>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-2"><?= $t['tat_nombre'] ?></h6>
                                    <p class="small text-muted mb-0">Iniciar una <?= strtolower($t['tat_nombre']) ?> municipal.</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- STEP 2: ¿Sobre qué tema? -->
                <div class="step-content p-5" id="step-2">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">¿Sobre qué tema es su caso?</h2>
                        <p class="text-muted">Elija la categoría que mejor describa su requerimiento.</p>
                    </div>
                    <div class="row g-4" id="tematica-container">
                        <?php foreach ($tematicas as $t): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="option-card p-4 text-center select-theme" data-value="<?= $t['tem_id'] ?>">
                                    <div class="check-icon"><?= getIcon('check-circle', '', ['width' => 20, 'height' => 20]) ?></div>
                                    <div class="mx-auto mb-3 text-primary bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                                        <?= getIcon('box', '', ['width' => 28, 'height' => 28]) ?>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0"><?= $t['tem_nombre'] ?></h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- STEP 3: Motivo específico -->
                <div class="step-content p-5" id="step-3">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">¿Qué está ocurriendo exactamente?</h2>
                        <p class="text-muted">Seleccione el motivo de su solicitud para derivarla correctamente.</p>
                    </div>
                    <div class="row g-3" id="subtematica-container">
                        <!-- Se poblará dinámicamente -->
                    </div>
                </div>

                <!-- NEW STEP 4: Confirmar Datos -->
                <div class="step-content p-5" id="step-4">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">Confirme sus datos de contacto</h2>
                        <p class="text-muted">Asegúrese de que su información esté correcta para que podamos contactarlo.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Mi Nombre</label>
                            <input type="text" class="form-control rounded-4 border-slate-200 bg-light p-3" value="<?= htmlspecialchars($_SESSION['vecino_nombre'] . ' ' . $_SESSION['vecino_apellido']) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Mi RUT</label>
                            <input type="text" class="form-control rounded-4 border-slate-200 bg-light p-3" value="<?= htmlspecialchars($_SESSION['vecino_rut']) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Correo de Notificación</label>
                            <input type="email" class="form-control rounded-4 border-slate-200 p-3" id="oirs_email_cont" value="<?= htmlspecialchars($_SESSION['vecino_email']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Teléfono de contacto</label>
                            <input type="text" class="form-control rounded-4 border-slate-200 p-3" id="oirs_tel_cont" placeholder="Ej: +56 9 1234 5678">
                        </div>
                        <div class="col-12 text-center p-3 bg-primary bg-opacity-5 rounded-4 mt-4">
                             <p class="small text-muted mb-0"><?= getIcon('info', 'text-primary me-2', ['width'=>16,'height'=>16]) ?> Estos datos se usarán solo para esta solicitud específica.</p>
                        </div>
                    </div>
                </div>

                <!-- STEP 5: Detalles finales -->
                <div class="step-content p-5" id="step-5">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold text-dark">Cuéntenos más detalles</h2>
                        <p class="text-muted">Describa su solicitud y, si es necesario, adjunte archivos o fotos.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark mb-2">Descripción de la Solicitud</label>
                            <textarea class="form-control rounded-4 border-slate-200 p-4" rows="6" id="oirs_descripcion" placeholder="Explique aquí los detalles de su caso..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Calle / Dirección aproximada</label>
                            <input type="text" class="form-control rounded-4 border-slate-200 p-3" id="oirs_calle" placeholder="Ej: Av. Libertad 123">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark mb-2">Sector / Referencia</label>
                            <input type="text" class="form-control rounded-4 border-slate-200 p-3" id="oirs_sector" placeholder="Ej: Miraflores Bajo">
                        </div>
                        <div class="col-12">
                            <div class="p-4 rounded-4 bg-light border border-dashed text-center">
                                <div class="mb-2 text-muted"><?= getIcon('image', '', ['width' => 32, 'height' => 32]) ?></div>
                                <p class="mb-0 small fw-bold text-dark">Añadir documentos o fotografías</p>
                                <p class="text-muted x-small mb-3">Máximo 5 archivos (PDF, JPG, PNG)</p>
                                <input type="file" id="oirs_archivos" class="d-none" multiple>
                                <button type="button" class="btn btn-white btn-sm border px-4 rounded-pill" onclick="$('#oirs_archivos').click()">Seleccionar archivos</button>
                                <div id="file-list" class="mt-3 row g-2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-4 px-5 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none px-0" id="btn-prev" style="display:none;">
                        <?= getIcon('chevron-left', 'me-1', ['width' => 18, 'height' => 18]) ?> VOLVER
                    </button>
                    <div class="ms-auto d-flex gap-3">
                        <a href="index.php" class="btn btn-link text-muted fw-bold text-decoration-none">CANCELAR</a>
                        <button type="button" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" id="btn-next">
                            SIGUIENTE <?= getIcon('chevron-right', 'ms-1', ['width' => 18, 'height' => 18]) ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    let formData = {
        oirs_tipo_atencion: null,
        oirs_tematica: null,
        oirs_subtematica: null
    };

    const subtematicasRaw = <?= json_encode($subtematicas) ?>;

    $(document).ready(function() {
        // Step 1: Select Type
        $('.select-type').on('click', function() {
            $('.select-type').removeClass('active');
            $(this).addClass('active');
            formData.oirs_tipo_atencion = $(this).data('value');
            setTimeout(nextStep, 300);
        });

        // Step 2: Select Theme
        $('.select-theme').on('click', function() {
            $('.select-theme').removeClass('active');
            $(this).addClass('active');
            formData.oirs_tematica = $(this).data('value');
            
            // Filter subthemes
            renderSubthemes(formData.oirs_tematica);
            setTimeout(nextStep, 300);
        });

        // Step 3: Select Motif (dynamic delegated)
        $(document).on('click', '.select-motif', function() {
            $('.select-motif').removeClass('active');
            $(this).addClass('active');
            formData.oirs_subtematica = $(this).data('value');
            setTimeout(nextStep, 300);
        });

        $('#btn-next').on('click', nextStep);
        $('#btn-prev').on('click', prevStep);

        // File handling
        $('#oirs_archivos').on('change', function(e) {
            const files = e.target.files;
            $('#file-list').empty();
            for(let i=0; i<files.length; i++) {
                $('#file-list').append(`<div class="col-4"><small class="badge bg-white border text-dark w-100 text-truncate p-2">${files[i].name}</small></div>`);
            }
        });
    });

    function renderSubthemes(temId) {
        const container = $('#subtematica-container');
        container.empty();
        const filtered = subtematicasRaw.filter(s => s.tem_id == temId);
        
        if(filtered.length === 0) {
            container.html('<div class="col-12 py-5 text-center text-muted">No hay motivos específicos para este tema.</div>');
            return;
        }

        filtered.forEach(s => {
            container.append(`
                <div class="col-md-6">
                    <div class="option-card p-3 d-flex align-items-center gap-3 select-motif" data-value="${s.sub_id}">
                        <div class="check-icon"><span class="material-symbols-outlined fs-6">check_circle</span></div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-pill p-2">
                             <span class="material-symbols-outlined fs-5">info</span>
                        </div>
                        <h6 class="fw-bold text-dark mb-0 small">${s.sub_nombre}</h6>
                    </div>
                </div>
            `);
        });
    }

    function nextStep() {
        if (currentStep === 1 && !formData.oirs_tipo_atencion) {
            Swal.fire('Atención', 'Por favor seleccione una acción.', 'warning');
            return;
        }
        if (currentStep === 2 && !formData.oirs_tematica) {
            Swal.fire('Atención', 'Por favor seleccione un tema.', 'warning');
            return;
        }
        if (currentStep === 3 && !formData.oirs_subtematica) {
            Swal.fire('Atención', 'Por favor seleccione el motivo específico.', 'warning');
            return;
        }
        if (currentStep === 4) {
             const email = $('#oirs_email_cont').val();
             if(!email || !email.includes('@')) {
                 Swal.fire('Atención', 'Por favor ingrese un correo válido.', 'warning');
                 return;
             }
        }

        if (currentStep < 5) {
            currentStep++;
            updateWizardUI();
        } else {
            finalSubmit();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateWizardUI();
        }
    }

    function updateWizardUI() {
        // Update Steps
        $('.step-dot').each(function() {
            const step = $(this).data('step');
            if (step < currentStep) {
                $(this).addClass('completed').removeClass('active').html('<?= getIcon('check', '', ['width' => 16, 'height' => 16]) ?>');
            } else if (step === currentStep) {
                $(this).addClass('active').removeClass('completed').html(step);
            } else {
                $(this).removeClass('active completed').html(step);
            }
        });

        // Update Content
        $('.step-content').removeClass('active');
        $(`#step-${currentStep}`).addClass('active');

        // Buttons
        $('#btn-prev').toggle(currentStep > 1);
        $('#btn-next').html(currentStep === 5 ? 'ENVIAR SOLICITUD <?= getIcon("send", "ms-1", ["width" => 18, "height" => 18]) ?>' : 'SIGUIENTE <?= getIcon("chevron-right", "ms-1", ["width" => 18, "height" => 18]) ?>');
    }

    async function finalSubmit() {
        const descripcion = $('#oirs_descripcion').val().trim();
        if (!descripcion) {
            Swal.fire('Atención', 'Por favor describa su caso.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Enviando solicitud...',
            text: 'Estamos procesando su requerimiento',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        const finalData = {
            accion: 'NUEVA',
            oirs_tipo_atencion: formData.oirs_tipo_atencion,
            oirs_tematica: formData.oirs_tematica,
            oirs_subtematica: formData.oirs_subtematica,
            oirs_descripcion: descripcion,
            oirs_calle: $('#oirs_calle').val(),
            oirs_sector: $('#oirs_sector').val(),
            oirs_origen_consulta: 'Portal Vecino'
        };

        try {
            const response = await fetch('../../api/vecinos/oirs.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(finalData)
            });
            const result = await response.json();

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Solicitud Enviada!',
                    text: 'Su requerimiento ha sido ingresado correctamente con el folio ' + (result.folio || result.id),
                    confirmButtonText: 'IR A MIS SOLICITUDES'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            } else {
                Swal.fire('Error', result.message || 'No se pudo enviar la solicitud.', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error', 'Hubo un problema de conexión.', 'error');
        }
    }
</script>

<?php include '../../apivec/general/footer.php'; ?>
