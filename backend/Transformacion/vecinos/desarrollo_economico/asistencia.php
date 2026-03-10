<?php
$pageTitle = "Registro Diario de Asistencia";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<style>
    .step-active { border-color: #006FB3 !important; background-color: rgba(0, 111, 179, 0.05) !important; color: #006FB3 !important; }
    .status-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 8px; }
    .photo-area:hover { border-color: #006FB3 !important; background-color: rgba(0, 111, 179, 0.02) !important; }
    .status-pill { font-size: 0.55rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; letter-spacing: 0.5px; }
</style>

<div class="row justify-content-center">
    <div class="col-lg-12 px-lg-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end gap-5 mb-5">
            <div>
                <h1 class="h1 fw-black text-dark mb-1">Registro Diario de Asistencia</h1>
                <p class="text-muted mb-0 lead opacity-75">Feria de Emprendimiento - Plaza de Viña</p>
            </div>
            <div class="bg-white border rounded-4 p-1 shadow-sm d-flex gap-1 overflow-hidden" style="min-width: 320px;">
                <button class="btn btn-primary rounded-3 flex-grow-1 fw-bold small">Día 1</button>
                <button class="btn btn-white border-0 rounded-3 flex-grow-1 text-muted fw-bold small hover-primary">Día 2</button>
                <button class="btn btn-white border-0 rounded-3 flex-grow-1 text-muted fw-bold small hover-primary">Día 3</button>
                <button class="btn btn-white border-0 rounded-3 flex-grow-1 text-muted fw-bold small hover-primary">Día 4</button>
            </div>
        </div>

        <div class="row g-5">
            <!-- Columna Entrada -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden border-start border-success border-5">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center p-5 pt-5 px-4">
                        <div>
                            <h3 class="h5 fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                                <span class="text-success"><?php echo getIcon('log-in', '', ['width'=>20]); ?></span>
                                Registro de Entrada
                            </h3>
                            <p class="small text-muted mb-0 lh-base">Apertura de puesto y montaje</p>
                        </div>
                        <span class="status-pill bg-success bg-opacity-10 text-success border border-success border-opacity-10">COMPLETADO</span>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="bg-light bg-opacity-50 p-4 rounded-4 d-flex justify-content-between align-items-center mb-5 border border-dashed border-light">
                            <div class="vstack">
                                <span class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Hora de Registro</span>
                                <span class="h2 fw-black text-primary mb-0">08:45 AM</span>
                            </div>
                            <div class="text-success"><?php echo getIcon('check-circle', '', ['width'=>48, 'height'=>48]); ?></div>
                        </div>

                        <div class="vstack gap-3 mb-5 px-1">
                            <label class="small fw-bold text-dark">Fotografía del Puesto Montado</label>
                            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm position-relative group cursor-pointer border-2 border-dashed border-light photo-area">
                                <img alt="Puesto montado" class="w-100 h-100 object-fit-cover transition-all" src="https://lh3.googleusercontent.com/fife/ALs6D_H3p9v9R4R1S-L_P5C1oD4oH">
                                <div class="position-absolute inset-0 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center opacity-0 group-hover:opacity-100 transition-all">
                                    <button class="btn btn-white bg-white text-dark fw-bold rounded-4 shadow-lg d-flex align-items-center gap-2">
                                        <?php echo getIcon('maximize', '', ['width'=>16]); ?> Ver foto ampliando
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-light bg-slate-100 text-muted fw-black w-100 py-3 rounded-4 shadow-none opacity-50 border-0 cursor-not-allowed">
                            <?php echo getIcon('shield', '', ['width'=>18]); ?> ENTRADA REGISTRADA
                        </button>
                    </div>
                </div>
            </div>

            <!-- Columna Salida -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden border-start border-warning border-5">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center p-5 pt-5 px-4">
                        <div>
                            <h3 class="h5 fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                                <span class="text-warning"><?php echo getIcon('log-out', '', ['width'=>20]); ?></span>
                                Registro de Salida
                            </h3>
                            <p class="small text-muted mb-0 lh-base">Cierre y retiro de productos</p>
                        </div>
                        <span class="status-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-10">PENDIENTE</span>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <div class="bg-light bg-opacity-50 p-4 rounded-4 d-flex justify-content-between align-items-center mb-5 border border-dashed border-light">
                            <div class="vstack">
                                <span class="text-uppercase text-muted fw-bold mb-1" style="font-size: 0.55rem; letter-spacing: 1px;">Hora Actual</span>
                                <span class="h2 fw-black text-dark mb-0">18:12 PM</span>
                            </div>
                            <div class="text-muted opacity-50"><?php echo getIcon('clock', '', ['width'=>48, 'height'=>48]); ?></div>
                        </div>

                        <div class="vstack gap-3 mb-5 px-1">
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <label class="small fw-bold text-dark">Fotografía de Respaldo Obligatoria</label>
                                <span class="text-danger fw-bold" style="font-size: 0.55rem;">* REQUERIDO</span>
                            </div>
                            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-none position-relative group cursor-pointer border-2 border-dashed border-light bg-light bg-opacity-50 photo-area d-flex flex-column align-items-center justify-content-center gap-3">
                                <div class="bg-white border border-light rounded-circle p-4 shadow-sm text-muted opacity-50 group-hover:scale-110 transition-all d-flex align-items-center justify-content-center">
                                    <?php echo getIcon('camera', '', ['width'=>40, 'height'=>40]); ?>
                                </div>
                                <div class="text-center px-4">
                                    <p class="small fw-bold text-dark mb-1">Haz clic para capturar o subir foto</p>
                                    <p class="text-muted mb-0 lh-base" style="font-size: 0.65rem;">Debe mostrar el puesto desarmado y limpio de basuras.</p>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg w-100 py-3 rounded-4 shadow-lg shadow-primary-500/10 fw-black d-flex align-items-center justify-content-center gap-2 border-0">
                            <?php echo getIcon('send', '', ['width'=>18]); ?> REGISTRAR SALIDA
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer / Status -->
        <div class="row g-4 mt-5 align-items-center">
             <div class="col-lg-9">
                <div class="card border-0 shadow-sm p-4 rounded-5">
                    <div class="d-flex flex-wrap gap-5 align-items-center px-2">
                         <div class="d-flex align-items-center">
                             <span class="status-dot bg-success shadow shadow-success-500/10"></span>
                             <span class="small fw-bold text-dark">Entrada: <span class="text-success">OK</span></span>
                         </div>
                         <div class="d-flex align-items-center">
                             <span class="status-dot bg-warning shadow shadow-warning-500/10"></span>
                             <span class="small fw-bold text-dark">Salida: <span class="text-warning">ESPERANDO</span></span>
                         </div>
                         <div class="d-flex align-items-center">
                             <span class="status-dot bg-light border shadow-none"></span>
                             <span class="small fw-bold text-muted">Verificación Municipal: <span class="opacity-75">PENDIENTE</span></span>
                         </div>
                    </div>
                </div>
             </div>
             <div class="col-lg-3 text-lg-end px-4">
                 <p class="small text-muted italic mb-0 opacity-75">ID Registro: #F-20231024-882</p>
             </div>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
