<?php
$pageTitle = "Solicitudes por Revisar OIRS";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitudes por Revisar</h2>
            <p class="text-muted mb-0">Listado de solicitudes OIRS pendientes de revisión</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar btn-dark" onclick="location.href='oirs_bandeja.php'">
                <i data-feather="grid" class="me-2"></i>
                Bandeja
            </button>
        </div>
    </div>

    <!-- Contenido de Revisar OIRS -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <p class="text-center py-5 text-muted">Módulo en desarrollo...</p>
        </div>
    </div>
</div>

<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/oirs_revisar.js"></script>

<?php include '../api/footer.php'; ?>