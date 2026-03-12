<?php
$token = $_GET['token'] ?? '';
if (empty($token)) {
    header('Location: ../acceso_vecinos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Portal de Vecinos</title>
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="../recursos/css/style.css" rel="stylesheet">
</head>

<body class="watermark-bg"
    style="font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); overflow: auto !important; height: auto !important; min-height: 100vh;">
    <div class="d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="card shadow-2xl border-0 overflow-hidden" style="width: 450px; border-radius: 28px !important;">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <img src="/Transformacion/recursos/img/logo_vina_del_mar.png" alt="Logo Viña del Mar"
                        class="img-fluid mb-4" style="width: 180px;">
                    <h3 class="fw-bold text-slate-800 mb-1" style="letter-spacing: -0.025em;">Restablecer Contraseña
                    </h3>
                    <p class="text-slate-500 small">Cree una nueva clave de acceso</p>
                </div>

                <form id="reset-container" onsubmit="event.preventDefault(); handleReset();">
                    <input type="hidden" id="resetToken" value="<?php echo htmlspecialchars($token); ?>">

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-slate-700 mb-2">Nueva Clave de Acceso</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-slate-200 ps-3 pe-2"><i data-feather="lock"
                                    style="width: 18px; color: #64748b;"></i></span>
                            <input type="password"
                                class="form-control form-control-lg border-slate-200 border-start-0 ps-1" id="newPass"
                                placeholder="••••••••" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;"
                                required minlength="6">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label small fw-bold text-slate-700 mb-2">Confirmar Clave</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-slate-200 ps-3 pe-2"><i
                                    data-feather="check-circle" style="width: 18px; color: #64748b;"></i></span>
                            <input type="password"
                                class="form-control form-control-lg border-slate-200 border-start-0 ps-1"
                                id="newPassConfirm" placeholder="••••••••"
                                style="border-radius: 0 12px 12px 0; font-size: 0.95rem;" required minlength="6">
                        </div>
                    </div>

                    <div id="status-message" class="alert d-none small" style="border-radius: 12px;"></div>

                    <button type="submit" id="btn-submit"
                        class="btn btn-primary btn-lg w-100 py-3 shadow-lg fw-bold border-0"
                        style="border-radius: 14px; background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%); transition: all 0.3s;">
                        Actualizar Contraseña
                    </button>

                    <div id="loading-spinner" class="text-center d-none mt-4">
                        <div class="spinner-border text-primary" role="status" style="width: 2rem; height: 2rem;"></div>
                        <p class="text-slate-500 small mt-3 fw-bold">Procesando...</p>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-slate-50 text-center py-4 border-0">
                <small class="text-slate-400 font-medium">Sistema Municipal de Cuidados &copy; 2026</small>
            </div>
        </div>
    </div>

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        feather.replace();

        window.handleReset = function () {
            const token = document.getElementById('resetToken').value;
            const password = document.getElementById('newPass').value;
            const confirm = document.getElementById('newPassConfirm').value;
            const statusMsg = document.getElementById('status-message');
            const submitBtn = document.getElementById('btn-submit');
            const spinner = document.getElementById('loading-spinner');

            if (password !== confirm) {
                statusMsg.className = 'alert alert-danger mt-4 small';
                statusMsg.textContent = 'Las contraseñas no coinciden.';
                statusMsg.classList.remove('d-none');
                return;
            }

            if (password.length < 6) {
                statusMsg.className = 'alert alert-danger mt-4 small';
                statusMsg.textContent = 'La contraseña debe tener al menos 6 caracteres.';
                statusMsg.classList.remove('d-none');
                return;
            }

            statusMsg.classList.add('d-none');
            submitBtn.classList.add('d-none');
            spinner.classList.remove('d-none');

            fetch('../apivec/general/recuperar_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ token, password, ACCION: 'RESTABLECER_PASSWORD' })
            })
                .then(res => res.json())
                .then(data => {
                    spinner.classList.add('d-none');
                    if (data.success || data.status === 'success') {
                        Swal.fire({
                            title: '¡Contraseña Actualizada!',
                            text: data.message || 'Su contraseña ha sido actualizada correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Ir a Iniciar Sesión'
                        }).then(() => {
                            window.location.href = '../acceso_vecinos.php';
                        });
                    } else {
                        submitBtn.classList.remove('d-none');
                        statusMsg.className = 'alert alert-danger mt-4 small';
                        statusMsg.textContent = data.message || 'Error al actualizar la contraseña.';
                        statusMsg.classList.remove('d-none');
                    }
                })
                .catch(err => {
                    spinner.classList.add('d-none');
                    submitBtn.classList.remove('d-none');
                    statusMsg.className = 'alert alert-danger mt-4 small';
                    statusMsg.textContent = 'Error de conexión. Intente nuevamente.';
                    statusMsg.classList.remove('d-none');
                });
        };
    </script>
</body>

</html>