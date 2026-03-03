<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Vecinos - Login</title>
    <link href="recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="recursos/css/style.css" rel="stylesheet">
</head>

<body class="watermark-bg"
    style="font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">

    <div id="login-screen" class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-2xl border-0" style="width: 400px; border-radius: 24px !important; overflow: hidden;">
            <div class="card-body p-5">
                <div class="text-center mb-8">
                    <div class="bg-primary rounded-2xl d-inline-flex align-items-center justify-content-center mb-4 shadow-lg"
                        style="width: 72px; height: 72px; background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%) !important;">
                        <i data-feather="home" class="text-white" style="width: 36px; height: 36px;"></i>
                    </div>
                    <h3 class="fw-bold text-slate-800 mb-1" style="letter-spacing: -0.025em;">Acceso Vecinos</h3>
                    <p class="text-slate-500 small">Portal Ciudadano de Solicitudes</p>
                </div>

                <div id="login-container">
                    <div class="mb-4">
                        <label for="emailInput" class="form-label small fw-bold text-slate-700 mb-2">Correo
                            Electrónico</label>
                        <input type="email" class="form-control form-control-lg border-slate-200" id="emailInput"
                            placeholder="tu@correo.cl" style="border-radius: 12px; font-size: 0.95rem;">
                    </div>
                    <div class="d-grid gap-3">
                        <button type="button" class="btn btn-primary btn-lg w-100 py-3 shadow-md fw-bold border-0"
                            style="border-radius: 12px; background: #006FB3; transition: all 0.2s;"
                            onclick="handleEmailLogin()">
                            Ingresar al Portal
                        </button>
                    </div>
                </div>

                <div id="loading-spinner" class="text-center d-none mt-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="text-slate-500 small mt-3 font-medium">Autenticando sesión...</p>
                </div>

                <div id="login-error" class="alert alert-danger mt-4 small d-none" style="border-radius: 12px;">
                    Error
                </div>
            </div>
            <div class="card-footer bg-slate-50 text-center py-4 border-0">
                <small class="text-slate-400 font-medium">Sistema Municipal &copy; 2026</small>
            </div>
        </div>
    </div>

    <!-- Accounts for Testing -->
    <div class="position-fixed bottom-0 start-0 p-4" style="z-index: 1000; max-width: 320px;">
        <div class="card shadow-xl border-0"
            style="border-radius: 16px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(8px);">
            <div class="card-header bg-slate-800 text-white p-3 small fw-bold d-flex justify-content-between align-items-center"
                style="border-radius: 16px 16px 0 0;">
                <span>Cuentas de Vecinos</span>
                <button type="button" class="btn-close btn-close-white" style="font-size: 0.6rem;"
                    onclick="this.parentElement.parentElement.parentElement.remove()"></button>
            </div>
            <div class="card-body p-2">
                <div class="list-group list-group-flush small">
                    <button class="list-group-item list-group-item-action p-2 border-0 rounded-lg mb-1"
                        onclick="copyToLogin(this.textContent)">vecino@test.cl</button>
                    <button class="list-group-item list-group-item-action p-2 border-0 rounded-lg"
                        onclick="copyToLogin(this.textContent)">maria.vecina@test.cl</button>
                </div>
            </div>
            <div class="card-footer p-2 text-center bg-slate-50" style="border-radius: 0 0 16px 16px;">
                <small class="text-slate-400" style="font-size: 0.7rem;">Click para copiar</small>
            </div>
        </div>
    </div>

    <script src="recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <script>
        feather.replace();

        function copyToLogin(email) {
            const input = document.getElementById('emailInput');
            if (input) {
                input.value = email;
                input.focus();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Reset login state if needed, or redirect if already logged in as neighbor
            if (localStorage.getItem('isLoggedInVecino') === 'true') {
                window.location.href = 'vecinos/index.php';
            }
        });

        window.handleEmailLogin = function () {
            const email = document.getElementById('emailInput').value;
            const loginError = document.getElementById('login-error');
            const loginContainer = document.getElementById('login-container');
            const loadingSpinner = document.getElementById('loading-spinner');

            if (!email) {
                loginError.classList.remove('d-none');
                loginError.textContent = 'Por favor, ingrese su correo electrónico.';
                return;
            }

            loginContainer.classList.add('d-none');
            loadingSpinner.classList.remove('d-none');
            loginError.classList.add('d-none');

            fetch('apivec/general/login_vecinos.php', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    ACCION: 'LOGIN_VECINO'
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        localStorage.setItem('isLoggedInVecino', 'true');
                        if (data.data && data.data.vecino) {
                            localStorage.setItem('vecino_data', JSON.stringify({ vecino: data.data.vecino }));
                        }
                        window.location.href = 'vecinos/index.php';
                    } else {
                        loadingSpinner.classList.add('d-none');
                        loginContainer.classList.remove('d-none');
                        loginError.classList.remove('d-none');
                        loginError.textContent = data.message || 'Error en la autenticación.';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingSpinner.classList.add('d-none');
                    loginContainer.classList.remove('d-none');
                    loginError.classList.remove('d-none');
                    loginError.textContent = 'Error de conexión con el servidor.';
                });
        }
    </script>
</body>

</html>