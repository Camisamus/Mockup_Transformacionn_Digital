<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Municipal - Login</title>
    <link href="recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="recursos/css/style.css" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="watermark-bg" style="font-family: 'Roboto', sans-serif;">

    <!-- Login Screen Only -->
    <div id="login-screen" class="d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-sm border-0" style="width: 350px; border-radius: 4px !important;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow"
                        style="width: 64px; height: 64px; background-color: #006FB3 !important;">
                        <i data-feather="lock" class="text-white" style="width: 32px; height: 32px;"></i>
                    </div>
                    <h3 class="fw-bold text-dark font-serif">Acceso Municipal</h3>
                    <p class="text-muted small">Gestión Municipal de Solicitudes</p>
                </div>

                <div id="login-container">
                    <div class="mb-3">
                        <label for="emailInput" class="form-label small fw-bold">Correo Electrónico</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="nombre@municipalidad.cl">
                    </div>
                    <div class="d-grid gap-3 mb-3">
                        <button type="button" class="btn btn-primary btn-lg w-100 py-2 shadow-sm fw-bold"
                            onclick="handleEmailLogin()">
                            Ingresar
                        </button>
                    </div>

                    <div class="text-center mb-3">
                        <span class="text-muted small">o</span>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="button"
                            class="btn btn-outline-danger btn-lg w-100 d-flex align-items-center justify-content-center gap-2 py-3 shadow-sm"
                            id="googleLoginBtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            <span class="fw-bold">Ingresar con Google</span>
                        </button>
                    </div>
                </div>

                <div id="loading-spinner" class="text-center d-none mt-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="text-muted small mt-2">Autenticando sesión...</p>
                </div>

                <div id="login-error" class="alert alert-danger mt-3 small d-none">
                    Error
                </div>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <small class="text-muted">Municipalidad 2024</small>
            </div>
        </div>
    </div>

    <!-- Temporary Login Help -->
    <div class="position-fixed bottom-0 start-0 p-3" style="z-index: 1000; max-width: 300px;">
        <div class="card shadow border-0 bg-white bg-opacity-75">
            <div
                class="card-header bg-dark text-white p-2 small fw-bold d-flex justify-content-between align-items-center">
                <span>Cuentas de Prueba (Temporal)</span>
                <button type="button" class="btn-close btn-close-white" style="font-size: 0.5rem;"
                    onclick="this.parentElement.parentElement.parentElement.remove()"></button>
            </div>
            <div class="card-body p-2 overflow-auto" style="max-height: 200px;">
                <div class="list-group list-group-flush small">
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">juan.hervas@munivina.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">leticia.meneses@munivina.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">ramon.martinez@munivina.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">ingresos.admin@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">ingresos.operador@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">ingresos.funcionario@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">ingresos.externo@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">desve.admin@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">desve.operador@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">desve.funcionario@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">desve.externo@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">oirs.admin@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">oirs.operador@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">oirs.funcionario@test.cl</button>
                    <button class="list-group-item list-group-item-action p-1 border-0"
                        onclick="copyToLogin(this.textContent)">oirs.externo@test.cl</button>
                </div>
            </div>
            <div class="card-footer p-1 text-center bg-light">
                <small class="text-muted" style="font-size: 0.6rem;">Click para copiar al login</small>
            </div>
        </div>
    </div>

    <script>
        function copyToLogin(email) {
            const input = document.getElementById('emailInput');
            if (input) {
                input.value = email;
                input.focus();
            }
        }
    </script>

    <!-- Scripts -->
    <script src="recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <script>
        feather.replace();

        const CLIENT_ID = '664056732869-nqieqd6qdovnt9u3jfqnckrnckkhmn26.apps.googleusercontent.com';

        // Global initialization function
        window.initGoogleLogin = function () {
            if (typeof google === 'undefined') {
                console.error("Google script not loaded yet.");
                return;
            }

            google.accounts.id.initialize({
                client_id: CLIENT_ID,
                callback: handleCredentialResponse,
                ux_mode: 'popup',
                use_fedcm_for_prompt: true,
                auto_select: false
            });

            google.accounts.id.renderButton(
                document.getElementById("googleLoginBtn"),
                {
                    theme: "outline",
                    size: "large",
                    type: "standard"
                }
            );
        };

        // Force check login on load
        document.addEventListener('DOMContentLoaded', () => {
            // If already logged in, redirect to PHP page
            if (localStorage.getItem('isLoggedIn') === 'true') {
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('user_data');
                window.location.href = 'Funcionarios/bandeja.php';
                return;
            }

            if (typeof google !== 'undefined') {
                window.initGoogleLogin();
            } else {
                window.addEventListener('load', window.initGoogleLogin);
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

            fetch('api/login.php', {
                method: 'POST',
                credentials: 'include', // Important for session cookie
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: '',
                    ACCION: 'LOGIN'
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        localStorage.setItem('isLoggedIn', 'true');
                        if (data.data && data.data.user) {
                            localStorage.setItem('user_data', JSON.stringify({ user: data.data.user }));
                        }
                        window.location.href = 'Funcionarios/bandeja.php';
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

        function handleCredentialResponse(response) {
            const loginError = document.getElementById('login-error');
            const loginContainer = document.getElementById('login-container');
            const loadingSpinner = document.getElementById('loading-spinner');

            loginContainer.classList.add('d-none');
            loadingSpinner.classList.remove('d-none');
            loginError.classList.add('d-none');


            fetch('../google/callback.php', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    token: response.credential,
                    ACCION: 'login_google'
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        localStorage.setItem('isLoggedIn', 'true');
                        if (data.user) {
                            localStorage.setItem('user_data', JSON.stringify(data.user));
                        }
                        window.location.href = 'Funcionarios/bandeja.php';
                    } else {
                        loadingSpinner.classList.add('d-none');
                        loginContainer.classList.remove('d-none');
                        loginError.classList.remove('d-none');
                        loginError.textContent = data.error || 'Error en la autenticación con Google';
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