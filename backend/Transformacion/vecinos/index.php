<?php
$pageTitle = "Dashboard Vecinos";
require_once '../apivec/general/auth_check_vecinos.php';
require_once '../apivec/general/layout_functions.php';
include '../apivec/general/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 16px;">
            <div class="card-body p-5 text-center">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                    style="width: 80px; height: 80px;">
                    <i data-feather="smile" class="text-primary" style="width: 40px; height: 40px;"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">¡Bienvenido(a),
                    <?php echo htmlspecialchars($_SESSION['vecino_nombre']); ?>!</h2>
                <p class="text-muted">Estamos preparando nuevas funciones para tu portal ciudadano.</p>
                <div class="mt-4 pt-4 border-top">
                    <p class="small text-secondary mb-0">Próximamente podrás realizar solicitudes y seguir tus trámites
                        desde aquí.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>

<?php include '../apivec/general/footer.php'; ?>