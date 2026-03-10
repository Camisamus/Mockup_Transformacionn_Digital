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
    style="font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); overflow: auto !important; height: auto !important; min-height: 100vh;">

    <div id="login-screen" class="d-flex align-items-center justify-content-center min-vh-100 py-5">
        <div class="card shadow-2xl border-0 overflow-hidden" style="width: 450px; border-radius: 28px !important;">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <img src="/Transformacion/recursos/img/logo_vina_del_mar.png" alt="Logo Viña del Mar"
                        class="img-fluid mb-4" style="width: 180px;">
                    <h3 class="fw-bold text-slate-800 mb-1" style="letter-spacing: -0.025em;" id="main-title">Acceso
                        Vecinos</h3>
                    <p class="text-slate-500 small" id="main-subtitle">Ingrese sus credenciales para continuar</p>
                </div>

                <!-- Tabs Custom -->
                <div class="d-flex bg-slate-100 p-1 mb-5 rounded-4" style="border-radius: 16px !important;">
                    <button class="btn btn-primary flex-fill fw-bold py-2 rounded-4 shadow-sm" id="btn-tab-login"
                        onclick="showForm('login')" style="border-radius: 12px !important; font-size: 0.85rem;">Iniciar
                        Sesión</button>
                    <button class="btn text-slate-600 flex-fill fw-bold py-2 rounded-4 border-0" id="btn-tab-register"
                        onclick="showForm('register')"
                        style="border-radius: 12px !important; font-size: 0.85rem;">Registrarme</button>
                </div>

                <!-- Login Form -->
                <form id="login-container" onsubmit="event.preventDefault(); handleLogin();">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-slate-700 mb-2">RUT</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-slate-200 ps-3 pe-2"><i data-feather="user" style="width: 18px; color: #64748b;"></i></span>
                            <input type="text" class="form-control form-control-lg border-slate-200 border-start-0 ps-1" id="rutInput" placeholder="12.345.678-9" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-slate-700 mb-2">Clave de Acceso</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-slate-200 ps-3 pe-2"><i data-feather="lock" style="width: 18px; color: #64748b;"></i></span>
                            <input type="password" class="form-control form-control-lg border-slate-200 border-start-0 ps-1" id="passInput" placeholder="••••••••" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;" required>
                        </div>
                    </div>
                    <div class="text-end mb-5">
                        <a href="javascript:void(0)" onclick="showForm('forgot')" class="text-primary small fw-bold text-decoration-none">¿Olvidó su contraseña?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-lg fw-bold border-0" style="border-radius: 14px; background: linear-gradient(135deg, #006FB3 0%, #004a7c 100%); transition: all 0.3s;">
                        Ingresar al Portal
                    </button>
                </form>

                <!-- Register Form (Multi-step) -->
                <form id="register-container" class="d-none" onsubmit="event.preventDefault(); handleRegister();">
                    <div class="row g-3">
                        <div class="col-12" id="step-rut">
                            <label class="form-label small fw-bold text-slate-700 mb-1">RUT para Comenzar</label>
                            <div class="input-group">
                                <input type="text" class="form-control border-slate-200" id="regRut" placeholder="12.345.678-9" required style="border-radius: 10px 0 0 10px;">
                                <button type="button" id="btn-check-rut" onclick="checkRut()" class="btn btn-primary px-4 fw-bold" style="border-radius: 0 10px 10px 0;">Verificar</button>
                            </div>
                        </div>

                        <!-- Campos que se muestran tras verificar RUT -->
                        <div id="register-fields" class="row g-3 d-none">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Nombres</label>
                                <input type="text" class="form-control border-slate-200" id="regNombre" placeholder="Nombres" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Apellido Paterno</label>
                                <input type="text" class="form-control border-slate-200" id="regPaterno" placeholder="Apellido Paterno" required style="border-radius: 10px;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Apellido Materno</label>
                                <input type="text" class="form-control border-slate-200" id="regMaterno" placeholder="Apellido Materno" required style="border-radius: 10px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Correo Electrónico</label>
                                <input type="email" class="form-control border-slate-200" id="regEmail" placeholder="correo@ejemplo.com" required style="border-radius: 10px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Teléfono de Contacto</label>
                                <input type="text" class="form-control border-slate-200" id="regTelefono" placeholder="+569 ..." style="border-radius: 10px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Nueva Clave de Acceso</label>
                                <input type="password" class="form-control border-slate-200" id="regPass" placeholder="Clave de Acceso" required style="border-radius: 10px;">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700 mb-1">Confirmar Clave</label>
                                <input type="password" class="form-control border-slate-200" id="regPassConfirm" placeholder="Confirmar Clave" required style="border-radius: 10px;">
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" id="regPrivacy" required>
                                    <label class="form-check-label text-slate-500" for="regPrivacy">
                                        Acepto las <a href="#" class="text-primary fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#privacyModal">Políticas de Privacidad</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg w-100 py-3 mt-4 shadow-lg fw-bold border-0" style="border-radius: 14px; background: #10b981;">
                                Crear mi Cuenta
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Forgot Password Form -->
                <form id="forgot-container" class="d-none" onsubmit="event.preventDefault(); handleForgot();">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-slate-700 mb-2">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-slate-200 ps-3 pe-2"><i data-feather="mail" style="width: 18px; color: #64748b;"></i></span>
                            <input type="email" class="form-control form-control-lg border-slate-200 border-start-0 ps-1" id="forgotEmail" placeholder="correo@ejemplo.com" style="border-radius: 0 12px 12px 0; font-size: 0.95rem;" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-lg fw-bold border-0" style="border-radius: 14px; background: #006FB3;">
                        Enviar Link de Recuperación
                    </button>
                    <div class="text-center mt-4">
                        <a href="javascript:void(0)" onclick="showForm('login')" class="text-slate-500 small fw-bold text-decoration-none">Volver al Login</a>
                    </div>
                </form>

                <div id="loading-spinner" class="text-center d-none mt-4">
                    <div class="spinner-border text-primary" role="status" style="width: 2rem; height: 2rem;"></div>
                    <p class="text-slate-500 small mt-3 fw-bold">Procesando solicitud...</p>
                </div>

                <div id="status-message" class="alert mt-4 small d-none" style="border-radius: 12px;"></div>
            </div>
            <div class="card-footer bg-slate-50 text-center py-4 border-0">
                <small class="text-slate-400 font-medium">Sistema Municipal de Cuidados &copy; 2026</small>
            </div>
        </div>
    </div>

    <script src="recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        feather.replace();

        // Formateo de RUT
        function formatRut(value) {
            value = value.replace(/[^0-9kK]/g, '');
            if (value.length < 2) return value;
            let body = value.slice(0, -1);
            let dv = value.slice(-1).toUpperCase();
            body = body.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return body + "-" + dv;
        }

        document.getElementById('rutInput').addEventListener('input', (e) => e.target.value = formatRut(e.target.value));
        document.getElementById('regRut').addEventListener('input', (e) => e.target.value = formatRut(e.target.value));

        function showForm(type) {
            const loginBtn = document.getElementById('btn-tab-login');
            const regBtn = document.getElementById('btn-tab-register');
            const loginForm = document.getElementById('login-container');
            const regForm = document.getElementById('register-container');
            const forgotForm = document.getElementById('forgot-container');
            const subtitle = document.getElementById('main-subtitle');
            const statusMsg = document.getElementById('status-message');

            statusMsg.classList.add('d-none');
            forgotForm.classList.add('d-none');

            if (type === 'login') {
                loginBtn.classList.add('btn-primary', 'shadow-sm');
                loginBtn.classList.remove('text-slate-600');
                regBtn.classList.add('text-slate-600');
                regBtn.classList.remove('btn-primary', 'shadow-sm');
                loginForm.classList.remove('d-none');
                regForm.classList.add('d-none');
                subtitle.textContent = 'Ingrese sus credenciales para continuar';
            } else if (type === 'register') {
                regBtn.classList.add('btn-primary', 'shadow-sm');
                regBtn.classList.remove('text-slate-600');
                loginBtn.classList.add('text-slate-600');
                loginBtn.classList.remove('btn-primary', 'shadow-sm');
                regForm.classList.remove('d-none');
                loginForm.classList.add('d-none');
                subtitle.textContent = 'Complete el formulario para unirse al portal';

                // Reset register steps
                document.getElementById('register-fields').classList.add('d-none');
                document.getElementById('btn-check-rut').classList.remove('d-none');
                document.getElementById('regRut').disabled = false;
            } else if (type === 'forgot') {
                loginForm.classList.add('d-none');
                regForm.classList.add('d-none');
                forgotForm.classList.remove('d-none');
                subtitle.textContent = 'Recupere su cuenta ingresando su correo';
            }
        }

        window.checkRut = function () {
            const rut = document.getElementById('regRut').value;
            if (rut.length < 8) {
                Swal.fire('Error', 'Por favor ingrese un RUT válido', 'error');
                return;
            }

            const loadingSpinner = document.getElementById('loading-spinner');
            loadingSpinner.classList.remove('d-none');

            fetch('apivec/general/registro_vecinos.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ rut, ACCION: 'BUSCAR_RUT' })
            })
                .then(res => res.json())
                .then(data => {
                    loadingSpinner.classList.add('d-none');
                    document.getElementById('register-fields').classList.remove('d-none');
                    document.getElementById('btn-check-rut').classList.add('d-none');
                    document.getElementById('regRut').disabled = true;

                    if (data.success && data.data) {
                        const d = data.data;
                        document.getElementById('regNombre').value = d.tgc_nombre || '';
                        document.getElementById('regPaterno').value = d.tgc_apellido_paterno || '';
                        document.getElementById('regMaterno').value = d.tgc_apellido_materno || '';
                        document.getElementById('regEmail').value = d.tgc_correo_electronico || '';
                        document.getElementById('regTelefono').value = d.tgc_telefono_contacto || '';
                        Swal.fire('¡RUT Encontrado!', 'Hemos precargado sus datos como contribuyente.', 'info');
                    }
                });
        }

        window.handleLogin = function () {
            const rut = document.getElementById('rutInput').value;
            const password = document.getElementById('passInput').value;
            const statusMsg = document.getElementById('status-message');
            const loginForm = document.getElementById('login-container');
            const loadingSpinner = document.getElementById('loading-spinner');

            loadingSpinner.classList.remove('d-none');
            loginForm.classList.add('d-none');
            statusMsg.classList.add('d-none');

            fetch('apivec/general/login_vecinos.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ rut, password, ACCION: 'LOGIN_VECINO' })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        localStorage.setItem('isLoggedInVecino', 'true');
                        window.location.href = 'vecinos/index.php';
                    } else {
                        loadingSpinner.classList.add('d-none');
                        loginForm.classList.remove('d-none');
                        statusMsg.className = 'alert alert-danger mt-4 small';
                        statusMsg.textContent = data.message;
                        statusMsg.classList.remove('d-none');
                    }
                });
        }

        window.handleRegister = function () {
            const password = document.getElementById('regPass').value;
            const passwordConfirm = document.getElementById('regPassConfirm').value;
            const statusMsg = document.getElementById('status-message');

            if (password !== passwordConfirm) {
                statusMsg.className = 'alert alert-danger mt-4 small';
                statusMsg.textContent = 'Las claves ingresadas no coinciden.';
                statusMsg.classList.remove('d-none');
                return;
            }

            const payload = {
                ACCION: 'REGISTRO_VECINO',
                rut: document.getElementById('regRut').value,
                nombre: document.getElementById('regNombre').value,
                paterno: document.getElementById('regPaterno').value,
                materno: document.getElementById('regMaterno').value,
                email: document.getElementById('regEmail').value,
                telefono: document.getElementById('regTelefono').value,
                password: password,
                privacidad: document.getElementById('regPrivacy').checked ? 1 : 0
            };

            const regForm = document.getElementById('register-container');
            const loadingSpinner = document.getElementById('loading-spinner');

            loadingSpinner.classList.remove('d-none');
            regForm.classList.add('d-none');

            fetch('apivec/general/registro_vecinos.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    loadingSpinner.classList.add('d-none');
                    if (data.status === 'success') {
                        Swal.fire({
                            title: '¡Excelente!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ir al Login'
                        }).then(() => {
                            showForm('login');
                            regForm.classList.remove('d-none');
                        });
                    } else {
                        regForm.classList.remove('d-none');
                        statusMsg.className = 'alert alert-danger mt-4 small';
                        statusMsg.textContent = data.message;
                        statusMsg.classList.remove('d-none');
                    }
                });
        }

        window.handleForgot = function () {
            const email = document.getElementById('forgotEmail').value;
            const loadingSpinner = document.getElementById('loading-spinner');
            const forgotForm = document.getElementById('forgot-container');

            loadingSpinner.classList.remove('d-none');
            forgotForm.classList.add('d-none');

            fetch('apivec/general/recuperar_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, ACCION: 'SOLICITAR_RECUPERACION' })
            })
                .then(res => res.json())
                .then(data => {
                    loadingSpinner.classList.add('d-none');
                    forgotForm.classList.remove('d-none');
                    if (data.success) {
                        Swal.fire('Correo Enviado', data.message, 'success').then(() => showForm('login'));
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
        }
    </script>
    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-2xl" style="border-radius: 24px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold text-slate-800" id="privacyModalLabel">Política de Privacidad y
                        Tratamiento de Datos Personales</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-4" style="max-height: 60vh; overflow-y: auto;">
                    <div class="text-slate-600 space-y-4">
                        <p class="small lh-base mb-4">Los datos personales proporcionados en este registro, incluyendo
                            RUT, nombre, datos de contacto y demás información ingresada, serán recopilados y tratados
                            por la Municipalidad de Viña del Mar con el único propósito de gestionar el acceso a la
                            plataforma municipal y permitir la prestación de servicios digitales a la comunidad.</p>

                        <p class="small lh-base mb-4">Esta información podrá ser utilizada para la identificación del
                            usuario, gestión de solicitudes, reserva de horas, postulación a programas o fondos
                            municipales, ingreso y seguimiento de requerimientos a través de la OIRS, y otras gestiones
                            propias de la atención ciudadana.</p>

                        <p class="small lh-base mb-4">El tratamiento de los datos se realizará conforme a lo establecido
                            en la Ley N°19.628 sobre Protección de la Vida Privada, resguardando la confidencialidad,
                            integridad y seguridad de la información. Los datos no serán utilizados para fines
                            comerciales ni para finalidades distintas a las propias de la gestión municipal.</p>

                        <p class="small lh-base fw-bold">Al registrarse en la plataforma, el usuario declara que la
                            información proporcionada es verídica y autoriza su tratamiento para los fines señalados.
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-slate-100 fw-bold border-0 px-4"
                        style="border-radius: 12px; background: #f1f5f9; color: #475569;"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary fw-bold px-4"
                        style="border-radius: 12px; background: #006FB3;" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>