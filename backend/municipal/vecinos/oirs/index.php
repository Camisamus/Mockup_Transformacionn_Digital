<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "OIRS Digital - Bienvenido";

ob_start();
?>
<div class="container py-5">
    <!-- Banner Institucional OIRS -->
    <div class="position-relative overflow-hidden bg-dark p-5 text-white shadow-sm d-flex align-items-center justify-content-between mb-5" style="border-bottom: 8px solid var(--gob-primary);">
        <div class="position-relative" style="z-index: 10; max-width: 700px;">
            <h1 class="display-5 font-serif font-bold mb-4">Sistema de Atención Ciudadana (OIRS)</h1>
            <p class="text-light lead mb-4" style="font-size: 1.1rem; opacity: 0.8;">Canal oficial para la gestión de solicitudes, reclamos y sugerencias ciudadanas de la Ilustre Municipalidad de Viña del Mar.</p>
            <div class="d-flex flex-wrap" style="gap: 1rem;">
                <a href="nueva.php" class="btn btn-primary px-5 py-3 font-weight-bold text-uppercase" style="letter-spacing: 0.1em; border-radius: 0;">NUEVA SOLICITUD</a>
                <a href="acreditar_organizacion.php" class="btn btn-outline-light px-5 py-3 font-weight-bold text-uppercase" style="letter-spacing: 0.1em; border-radius: 0;">ACREDITAR ENTIDAD</a>
            </div>
        </div>
        <div class="d-none d-lg-block">
            <span class="material-symbols-outlined" style="font-size: 180px; color: rgba(255,255,255,0.1); user-select: none;">support_agent</span>
        </div>
    </div>

    <div class="row">
        <!-- Panel Solicitudes -->
        <div class="col-lg-8">
            <div class="bg-white border p-4 p-md-5 shadow-sm mb-4">
                <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                    <h3 class="h4 font-serif font-bold text-dark d-flex align-items-center mb-0">
                        <span class="material-symbols-outlined text-primary mr-3" style="font-size: 32px;">task</span>
                        Mis Solicitudes en Gestión
                    </h3>
                    <a href="historial.php" class="text-uppercase font-weight-bold text-primary" style="font-size: 11px; letter-spacing: 0.1em; text-decoration: underline; text-underline-offset: 4px;">Ver mi historial</a>
                </div>
                
                <div class="oirs-list">
                    <!-- Ticket 1 -->
                    <div onclick="window.location.href='detalle.php?id=4402'" class="oirs-item p-4 mb-3 border bg-light cursor-pointer transition-all">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap: 1.5rem;">
                            <div class="d-flex align-items-center" style="gap: 1.5rem;">
                                <div class="d-flex align-items-center justify-content-center bg-white border" style="width: 56px; height: 56px; flex-shrink: 0;">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 24px;">lightbulb</span>
                                </div>
                                <div class="d-flex flex-column overflow-hidden">
                                    <span class="h6 font-weight-bold text-dark mb-1 text-truncate">Avería en Alumbrado Público - Calle Vergara</span>
                                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Ticket: #OIRS-2026-4402</span>
                                        <span class="bg-muted rounded-circle" style="width: 4px; height: 4px; background-color: #CCC;"></span>
                                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Ingresado ayer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="gap: 1.5rem;">
                                <span class="badge badge-warning px-4 py-2 font-weight-bold text-uppercase" style="font-size: 10px; background-color: #FFF3CD; color: #856404; border: 1px solid #FFEEBA; border-radius: 0;">En Proceso</span>
                                <span class="material-symbols-outlined text-muted arrow-icon">arrow_forward_ios</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 2 -->
                    <div onclick="window.location.href='detalle.php?id=4395'" class="oirs-item p-4 mb-3 border bg-light cursor-pointer transition-all">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between" style="gap: 1.5rem;">
                            <div class="d-flex align-items-center" style="gap: 1.5rem;">
                                <div class="d-flex align-items-center justify-content-center bg-white border" style="width: 56px; height: 56px; flex-shrink: 0;">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 24px;">description</span>
                                </div>
                                <div class="d-flex flex-column overflow-hidden">
                                    <span class="h6 font-weight-bold text-dark mb-1 text-truncate">Consulta sobre Plan de Reciclaje Comunal</span>
                                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Ticket: #OIRS-2026-4395</span>
                                        <span class="bg-muted rounded-circle" style="width: 4px; height: 4px; background-color: #CCC;"></span>
                                        <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Hace 3 días</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="gap: 1.5rem;">
                                <span class="badge badge-success px-4 py-2 font-weight-bold text-uppercase" style="font-size: 10px; background-color: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; border-radius: 0;">Respondida</span>
                                <span class="material-symbols-outlined text-muted arrow-icon">arrow_forward_ios</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lateral Info -->
        <div class="col-lg-4">
            <div class="bg-white border p-4 p-md-5 d-flex flex-column align-items-center text-center shadow-sm mb-5" style="gap: 1.5rem;">
                <div class="d-flex align-items-center justify-content-center border" style="width: 80px; height: 80px; background-color: #D1E7DD; color: #198754;">
                    <span class="material-symbols-outlined" style="font-size: 48px;">verified_user</span>
                </div>
                <div>
                    <h4 class="h5 font-serif font-bold text-dark mb-3">Certificación de Entidades</h4>
                    <p class="text-muted" style="font-size: 13px; line-height: 1.6;">Valide su rol como representante legal de organizaciones territoriales para reportes grupales.</p>
                </div>
                <a href="acreditar_organizacion.php" class="btn btn-dark w-100 py-3 font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.15em; border-radius: 0;">INICIAR TRÁMITE</a>
            </div>

            <div class="p-4 bg-white border-left border-primary shadow-sm" style="border-left-width: 8px !important;">
                <h5 class="text-primary font-weight-bold text-uppercase mb-3" style="font-size: 11px; letter-spacing: 0.3em;">Importante</h5>
                <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.6;">Para situaciones que requieran intervención inmediata por riesgo de seguridad, llame a la Central de Emergencias: <b>1402</b>.</p>
            </div>
        </div>
    </div>
</div>

<style>
.oirs-item:hover {
    background-color: #FFF !important;
    border-color: var(--gob-primary) !important;
}
.oirs-item:hover .arrow-icon {
    color: var(--gob-primary) !important;
    transform: translateX(5px);
}
.transition-all {
    transition: all 0.3s ease;
}
.cursor-pointer {
    cursor: pointer;
}
</style>
<?php
$content = ob_get_clean();
renderLayout($page_title, $content);
?>
