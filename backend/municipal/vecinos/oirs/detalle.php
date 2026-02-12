<?php
include_once(__DIR__ . '/../layout/layout.php');

$id = isset($_GET['id']) ? $_GET['id'] : '4402';
$page_title = "Detalle Solicitud #OIRS-2026-" . $id;

ob_start();
?>
<div class="row" style="gap: 2rem;">
    <!-- Columna Principal -->
    <div class="col-lg-8" style="gap: 2rem; display: flex; flex-direction: column;">
        <!-- Card Detalle Principal -->
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px;">
            <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap: 1.5rem;">
                <div class="d-flex align-items-center" style="gap: 1.25rem;">
                    <div class="bg-primary-soft d-flex align-items-center justify-content-center text-primary" style="width: 64px; height: 64px; border-radius: 16px;">
                        <span class="material-symbols-outlined" style="font-size: 32px;">lightbulb</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.15em;">Código Único</span>
                        <h2 class="h4 font-weight-bold text-dark mb-0">#OIRS-2026-<?php echo $id; ?></h2>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-md-end text-md-right">
                    <span class="badge badge-warning-soft font-weight-bold text-uppercase px-3 py-2 italic mb-2" style="font-size: 10px; border-radius: 8px;">En Revisión</span>
                    <span class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.1em; opacity: 0.6;">Estado Actual</span>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                <!-- Grid de Info -->
                <div class="row mb-5">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-3 text-muted">
                             <span class="material-symbols-outlined mr-2" style="font-size: 18px;">category</span>
                             <span class="font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Clasificación</span>
                        </div>
                        <div class="bg-light p-4 border rounded-lg" style="border-radius: 12px !important;">
                             <p class="text-muted font-weight-bold mb-1" style="font-size: 10px;">TEMÁTICA</p>
                             <p class="font-weight-bold text-dark mb-2" style="font-size: 14px;">Alumbrado Público</p>
                             <p class="text-muted font-weight-bold mb-0" style="font-size: 10px;">SUBITEM: POSTE SIN LUZ</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-3 text-muted">
                             <span class="material-symbols-outlined mr-2" style="font-size: 18px;">location_on</span>
                             <span class="font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Ubicación Geográfica</span>
                        </div>
                        <div class="bg-light p-4 border rounded-lg" style="border-radius: 12px !important;">
                             <p class="text-muted font-weight-bold mb-1" style="font-size: 10px;">DIRECCIÓN</p>
                             <p class="font-weight-bold text-dark mb-2" style="font-size: 14px;">Calle Quillota #455, Viña del Mar</p>
                             <p class="text-muted font-weight-bold mb-0 text-uppercase" style="font-size: 10px;">Coordenadas: -33.0245, -71.5518</p>
                        </div>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                         <h4 class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 0.15em;">Descripción del Vecino</h4>
                         <span class="text-muted font-weight-bold" style="font-size: 9px;">04 FEB 2026 • 15:30</span>
                    </div>
                    <div class="p-4 bg-light border-left border-primary rounded-lg shadow-sm" style="border-left-width: 4px !important; border-radius: 12px; font-size: 14px; color: #4b5563; line-height: 1.6; font-style: italic; font-weight: 500; background-color: rgba(0, 111, 179, 0.03);">
                        "Buenas tardes, reporto que el poste de luz frente a mi domicilio no enciende hace 3 noches. El sector está muy oscuro y es peligroso para los vecinos que regresan tarde del trabajo."
                    </div>
                </div>

                <!-- Evidencia -->
                <div>
                     <h4 class="text-muted font-weight-bold text-uppercase mb-4" style="font-size: 10px; letter-spacing: 0.15em;">Evidencia Visual Adjunta</h4>
                     <div class="d-flex flex-wrap" style="gap: 1.25rem;">
                         <div class="position-relative overflow-hidden cursor-zoom-in shadow-sm report-image-container" style="width: 192px; height: 144px; border-radius: 20px;">
                             <div class="overlay-zoom position-absolute w-100 h-100 d-flex align-items-center justify-content-center transition-all" style="background: rgba(0,0,0,0.3); opacity: 0; z-index: 2;">
                                 <span class="material-symbols-outlined text-white" style="font-size: 32px;">zoom_in</span>
                             </div>
                             <img src="https://images.unsplash.com/photo-1542451313056-b7c8e626645f?auto=format&fit=crop&w=400&h=300" class="w-100 h-100 object-cover shadow-hover transition-all">
                         </div>
                         <div class="d-flex flex-column align-items-center justify-content-center border-dashed bg-light opacity-50" style="width: 192px; height: 144px; border-radius: 20px; border: 2px dashed #cbd5e1; gap: 0.5rem;">
                             <span class="material-symbols-outlined text-muted">add_photo_alternate</span>
                             <span class="font-weight-bold text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">Sin más fotos</span>
                         </div>
                     </div>
                </div>
            </div>
        </div>

        <!-- Panel de Interacción / Timeline -->
        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 24px; gap: 2.5rem; display: flex; flex-direction: column;">
            <h3 class="h5 font-weight-bold text-dark d-flex align-items-center mb-0" style="gap: 1rem;">
                <span class="material-symbols-outlined text-primary" style="font-size: 32px;">history_edu</span>
                Cronología de Atención Ciudadana
            </h3>

            <div class="timeline position-relative" style="padding-left: 60px;">
                <div class="timeline-line position-absolute h-100" style="left: 24px; width: 2px; background: #e2e8f0; top: 0;"></div>
                
                <!-- Evento 1 -->
                <div class="timeline-item position-relative mb-5">
                    <div class="timeline-icon position-absolute d-flex align-items-center justify-content-center bg-light border border-white text-muted shadow-sm" style="left: -60px; width: 48px; height: 48px; border-radius: 16px; border-width: 4px !important; z-index: 2;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">assignment_turned_in</span>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 9px; letter-spacing: 0.15em;">04 FEB 2026 - 15:30 • SISTEMA</span>
                        <h4 class="h6 font-weight-bold text-dark text-uppercase mb-2" style="letter-spacing: -0.01em;">Solicitud Ingresada con Éxito</h4>
                        <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.6;">Su requerimiento ha sido registrado en la base de datos municipal y se encuentra en la etapa de pre-calificación técnica.</p>
                    </div>
                </div>
                
                <!-- Evento 2 (Respuesta) -->
                <div class="timeline-item position-relative mb-0">
                    <div class="timeline-icon position-absolute d-flex align-items-center justify-content-center bg-success-soft border border-white text-success shadow-lg" style="left: -60px; width: 48px; height: 48px; border-radius: 16px; border-width: 4px !important; z-index: 2;">
                        <span class="material-symbols-outlined" style="font-size: 20px;">account_balance</span>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="mb-3">
                            <span class="text-success font-weight-bold text-uppercase mb-1 d-block" style="font-size: 9px; letter-spacing: 0.15em;">05 FEB 2026 - 10:15 • DEP. OPERACIONES</span>
                            <h4 class="h6 font-weight-bold text-dark text-uppercase mb-0" style="letter-spacing: -0.01em;">Programación de Inspección en Terreno</h4>
                        </div>
                        <div class="p-4 p-md-5 bg-success-soft border border-success-light shadow-inner" style="border-radius: 20px;">
                            <p class="text-dark font-weight-bold mb-3" style="font-size: 14px; line-height: 1.7; color: var(--gob-secondary) !important;">
                                "Estimado vecino, hemos recibido su reporte. Un equipo de la unidad de alumbrado público visitará el sector el día de mañana para realizar el reemplazo de la luminaria dañada y revisar el cableado del sector."
                            </p>
                            <div class="d-flex">
                                 <span class="badge badge-success-soft font-weight-bold px-3 py-1 text-uppercase" style="font-size: 9px; border-radius: 20px; border: 1px solid rgba(45, 113, 124, 0.2);">Asignado a: Cuadrilla 05</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acción Reabrir -->
            <div class="pt-5 border-top">
                <button onclick="solicitarAclaratoria()" class="btn btn-dark w-100 py-3 d-flex align-items-center justify-content-center" style="border-radius: 16px; gap: 1rem; font-weight: bold; font-size: 14px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2);">
                    <span class="material-symbols-outlined" style="font-size: 20px;">edit_note</span>
                    Solicitar Aclaratoria / Reabrir Caso
                </button>
                <p class="text-muted font-weight-bold text-center mt-4 text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em; opacity: 0.6;">¿La respuesta no soluciona el problema? Haga clic arriba.</p>
            </div>
        </div>
    </div>

    <!-- Columna Detalle Lateral -->
    <div class="col-lg-4" style="gap: 2rem; display: flex; flex-direction: column;">
        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 24px; gap: 2rem; display: flex; flex-direction: column;">
             <h4 class="h6 font-weight-bold text-dark text-uppercase mb-0" style="letter-spacing: -0.01em;">Estado del Proceso</h4>
             <div class="stepper position-relative" style="padding-left: 1.5rem;">
                 <div class="stepper-line position-absolute h-100" style="left: 15px; width: 1px; background: #e2e8f0; top: 0;"></div>
                 
                 <div class="d-flex align-items-center mb-4 position-relative" style="gap: 1.5rem;">
                     <div class="bg-success rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; z-index: 2; border: 4px solid white;">
                         <span class="material-symbols-outlined font-weight-bold" style="font-size: 14px;">check</span>
                     </div>
                     <div class="d-flex flex-column">
                         <span class="font-weight-bold text-dark" style="font-size: 12px;">Ingreso y Validación</span>
                         <span class="text-success font-weight-bold text-uppercase" style="font-size: 9px;">Completado</span>
                     </div>
                 </div>
                 
                 <div class="d-flex align-items-center mb-4 position-relative" style="gap: 1.5rem;">
                     <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; z-index: 2; border: 4px solid white;">
                         <span class="material-symbols-outlined font-weight-bold" style="font-size: 14px;">refresh</span>
                     </div>
                     <div class="d-flex flex-column">
                         <span class="font-weight-bold text-dark" style="font-size: 12px;">Respuesta / Ejecución</span>
                         <span class="text-warning font-weight-bold text-uppercase" style="font-size: 9px;">En Proceso</span>
                     </div>
                 </div>
                 
                 <div class="d-flex align-items-center position-relative opacity-50" style="gap: 1.5rem;">
                     <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-muted" style="width: 32px; height: 32px; z-index: 2; border: 4px solid white;">
                         <span class="material-symbols-outlined" style="font-size: 14px;">lock</span>
                     </div>
                     <div class="d-flex flex-column">
                         <span class="font-weight-bold text-muted" style="font-size: 12px;">Cierre y Calificación</span>
                         <span class="text-muted font-weight-bold text-uppercase" style="font-size: 9px;">Pendiente</span>
                     </div>
                 </div>
             </div>
        </div>

        <!-- Mapa Lateral Mini -->
        <div class="card border-0 bg-primary text-white p-4 p-md-5 overflow-hidden position-relative group" style="border-radius: 24px; gap: 1.5rem; box-shadow: 0 20px 40px -10px rgba(0, 111, 179, 0.3);">
            <span class="material-symbols-outlined position-absolute" style="font-size: 180px; color: rgba(255,255,255,0.1); right: -40px; bottom: -40px; transform: rotate(12deg); transition: transform 0.7s;">map</span>
            <div class="position-relative" style="z-index: 2; gap: 1.5rem; display: flex; flex-direction: column;">
                <div class="d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; border-radius: 16px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);">
                    <span class="material-symbols-outlined" style="font-size: 32px;">explore</span>
                </div>
                <div>
                    <h4 class="h5 font-weight-bold text-white mb-2">Ubicación en Mapa de la Ciudad</h4>
                    <p class="text-white opacity-75" style="font-size: 12px; line-height: 1.6;">Visualice el lugar exacto del reporte y otras incidencias cercanas reportadas por vecinos.</p>
                </div>
                <button class="btn btn-white w-100 font-weight-bold py-3 transition-all" style="border-radius: 12px; font-size: 12px; background: white; color: var(--gob-primary); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);">Ver Ubicación Exacta</button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-primary-soft { background-color: rgba(0, 111, 179, 0.1); }
.bg-success-soft { background-color: rgba(45, 113, 124, 0.1); }
.bg-warning-soft { background-color: rgba(255, 161, 27, 0.1); }
.border-success-light { border-color: rgba(45, 113, 124, 0.2) !important; }
.badge-warning-soft { background-color: rgba(255, 161, 27, 0.15); color: #856404; }
.badge-success-soft { background-color: rgba(45, 113, 124, 0.1); color: var(--gob-secondary); }

.report-image-container:hover .overlay-zoom { opacity: 1 !important; }
.report-image-container:hover img { transform: scale(1.1); }
.object-cover { object-fit: cover; }
.transition-all { transition: all 0.2s ease-in-out; }
.cursor-zoom-in { cursor: zoom-in; }
.shadow-hover:hover { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important; }
</style>

<script>
function solicitarAclaratoria() {
    Swal.fire({
        title: 'Solicitar Aclaratoria',
        input: 'textarea',
        inputLabel: '¿Por qué reabre este caso?',
        inputPlaceholder: 'Escriba aquí sus dudas o por qué la respuesta no es satisfactoria...',
        inputAttributes: {
            'aria-label': 'Escriba aquí sus dudas'
        },
        showCancelButton: true,
        confirmButtonText: 'Enviar Reclamo',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#137fec',
        borderRadius: '24px',
        inputValidator: (value) => {
            if (!value) {
                return 'Debe escribir una razón para reabrir el caso'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Caso Reabierto',
                text: 'Su solicitud ha sido enviada nuevamente al departamento correspondiente.',
                icon: 'success',
                borderRadius: '24px'
            });
        }
    });
}
</script>
<?php
$content = ob_get_clean();
renderLayout($page_title, $content);
?>
