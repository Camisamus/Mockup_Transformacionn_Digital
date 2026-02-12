<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Acreditar Agrupación u Organización";

ob_start();
?>
<div class="container py-4" style="max-width: 900px;">
    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 32px;">
        <!-- Header -->
        <div class="card-header p-5 text-white d-flex align-items-center justify-content-between border-0" style="background-color: var(--gob-secondary);">
            <div class="d-flex flex-column">
                <h2 class="h1 font-weight-bold mb-2">Certificación Jurídica</h2>
                <p class="mb-0 opacity-75 font-weight-medium" style="font-size: 16px;">Acredítate como representante legal para actuar en nombre de una organización.</p>
            </div>
            <div class="d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 24px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);">
                <span class="material-symbols-outlined" style="font-size: 40px;">verified_user</span>
            </div>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Info Importante -->
            <div class="d-flex p-4 mb-5" style="background-color: rgba(45, 113, 124, 0.05); border-radius: 20px; border: 1px solid rgba(45, 113, 124, 0.1); gap: 1.5rem;">
                <span class="material-symbols-outlined text-secondary" style="font-size: 28px;">info</span>
                <p class="text-secondary font-weight-bold mb-0" style="font-size: 13px; line-height: 1.6;">
                    Este proceso te permite validar que eres el presidente o representante legal de una agrupación. Una vez aprobado, podrás ingresar solicitudes OIRS con la personalidad jurídica de la organización.
                </p>
            </div>

            <form id="acreditarForm">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted font-weight-bold text-uppercase pl-2 mb-2" style="font-size: 10px; letter-spacing: 0.15em;">RUT de la Organización</label>
                        <input type="text" placeholder="Ej: 70.123.456-7" class="form-control form-control-lg border-0 bg-light shadow-none" style="border-radius: 12px; font-size: 14px; font-weight: bold; height: 50px;">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted font-weight-bold text-uppercase pl-2 mb-2" style="font-size: 10px; letter-spacing: 0.15em;">Nombre de la Organización</label>
                        <input type="text" placeholder="Nombre legal completo..." class="form-control form-control-lg border-0 bg-light shadow-none" style="border-radius: 12px; font-size: 14px; font-weight: bold; height: 50px;">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="text-muted font-weight-bold text-uppercase pl-2 mb-3 d-block" style="font-size: 10px; letter-spacing: 0.15em;">Documentación Requerida (PDF/JPG)</label>
                    <div class="row" style="gap: 1rem; margin: 0;">
                        <!-- Doc 1 -->
                        <div class="col-md p-4 bg-light border-dashed d-flex flex-column" style="border-radius: 24px; border: 2px dashed #cbd5e1; gap: 1.5rem;">
                            <div class="d-flex align-items-center" style="gap: 1rem;">
                                <div class="bg-secondary-soft d-flex align-items-center justify-content-center text-secondary" style="width: 40px; height: 40px; border-radius: 10px;">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">file_copy</span>
                                </div>
                                <span class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">Acta de Constitución</span>
                            </div>
                            <input type="file" class="form-control-file text-muted font-weight-bold" style="font-size: 11px;">
                        </div>
                        <!-- Doc 2 -->
                        <div class="col-md p-4 bg-light border-dashed d-flex flex-column" style="border-radius: 24px; border: 2px dashed #cbd5e1; gap: 1.5rem;">
                            <div class="d-flex align-items-center" style="gap: 1rem;">
                                <div class="bg-secondary-soft d-flex align-items-center justify-content-center text-secondary" style="width: 40px; height: 40px; border-radius: 10px;">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">badge</span>
                                </div>
                                <span class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">Certificado de Vigencia</span>
                            </div>
                            <input type="file" class="form-control-file text-muted font-weight-bold" style="font-size: 11px;">
                        </div>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-secondary btn-lg w-100 py-3 d-flex align-items-center justify-content-center shadow-lg" style="border-radius: 16px; gap: 1rem; font-weight: bold; font-size: 14px;">
                        <span class="material-symbols-outlined">verified</span>
                        Enviar para Validación Municipal
                    </button>
                    <p class="text-muted text-center mt-4 font-weight-medium mb-0" style="font-size: 11px;">La revisión de documentos toma aproximadamente 48 horas hábiles.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-secondary-soft { background-color: rgba(45, 113, 124, 0.1); }
.border-dashed { border-style: dashed !important; }
.btn-secondary { background-color: var(--gob-secondary) !important; border: none; }
.btn-secondary:hover { background-color: #245a63 !important; }
.text-secondary { color: var(--gob-secondary) !important; }
</style>

<script>
$(document).ready(function() {
    $('#acreditarForm').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Enviar Documentación?',
            text: "Sus documentos serán revisados por la Dirección de Desarrollo Comunitario.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#2D717C',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, Enviar ya',
            cancelButtonText: 'Revisar adjuntos',
            borderRadius: '24px'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡Recibido!',
                    text: 'Le notificaremos por este portal y por correo el resultado de su acreditación.',
                    icon: 'success',
                    borderRadius: '24px'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $('#acreditarForm').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Enviar Documentación?',
            text: "Sus documentos serán revisados por la Dirección de Desarrollo Comunitario.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#059669',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, Enviar ya',
            cancelButtonText: 'Revisar adjuntos',
            borderRadius: '24px'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡Recibido!',
                    text: 'Le notificaremos por este portal y por correo el resultado de su acreditación.',
                    icon: 'success',
                    borderRadius: '24px'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            }
        });
    });
});
</script>
<?php
$content = ob_get_clean();
renderLayout($page_title, $content);
?>
