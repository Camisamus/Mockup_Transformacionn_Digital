<?php
$pageTitle = "Sistema de Patentes - Login";
require_once 'api/auth_check.php';
include 'api/header.php';
?>


<!-- Login Screen Only -->
<div id="login-screen" class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm border-0" style="width: 350px;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div class="bg-primary  rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                    style="width: 64px; height: 64px;">
                    <i data-feather="lock" style="width: 32px; height: 32px;"></i>
                </div>
                <h3 class="fw-bold text-dark">Acceso Municipal</h3>
                <p class="text-muted small">Gestión de Patentes y Solicitudes</p>
            </div>

            <form id="login-form">
                <div class="mb-3">
                    <img src="recursos/img/ClaveUnica.jpg" alt="Clave Unica" class="img-fluid">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
                <div id="login-error" class="text-danger text-center mt-3 small d-none">
                    Credenciales incorrectas
                </div>
            </form>
        </div>
        <div class="card-footer bg-white text-center py-3">
            <small class="text-muted">Municipalidad 2024</small>
        </div>
    </div>
</div>

<!-- No Iframe. No Sidebar. Just Login. -->

<script src="recursos/js/bootstrap.bundle.min.js"></script>
<script src="recursos/js/code.js"></script>
<script>
    feather.replace();
    // Force check login on load
    document.addEventListener('DOMContentLoaded', () => {
        // If already logged in, redirect immediately
        if (localStorage.getItem('isLoggedIn') === 'true') {
            window.location.href = '/Funcionarios/patentes_mis_solicitudes_C.php';
        }
    });
</script>

<?php include 'api/footer.php'; ?>