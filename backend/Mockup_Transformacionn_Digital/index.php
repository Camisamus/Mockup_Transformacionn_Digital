<?php
session_start();

// Si ya está autenticado, redirige al dashboard
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login con Google</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
        }

        .google-login-btn {
            width: 100%;
            padding: 12px 20px;
            background-color: #4285F4;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background-color 0.3s;
        }

        .google-login-btn:hover {
            background-color: #357ae8;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4285F4;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Bienvenido!</h1>

        <button class="google-login-btn" id="googleLoginBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                ircle cx="12" cy="12" r="10"></circle>
            </svg>
            Iniciar sesión con Google
        </button>

        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Autenticando...</p>
        </div>
    </div>

    <!-- Google Sign-In Script -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        // Tu ID de cliente de Google
        const CLIENT_ID = '664056732869-nqieqd6qdovnt9u3jfqnckrnckkhmn26.apps.googleusercontent.com';

        // Esperar a que el DOM esté listo
        window.addEventListener('load', function () {
            // Verificar que google está disponible
            if (typeof google === 'undefined') {
                console.error('Google Sign-In no se cargó correctamente');
                document.getElementById('googleLoginBtn').disabled = true;
                document.getElementById('googleLoginBtn').textContent = 'Error: Google Sign-In no disponible';
                return;
            }

            // Inicializar Google Sign-In
            google.accounts.id.initialize({
                client_id: CLIENT_ID,
                callback: handleCredentialResponse,
                ux_mode: 'popup'
            });

            // Agregar click listener al botón
            document.getElementById('googleLoginBtn').addEventListener('click', function (e) {
                e.preventDefault();
                // Mostrar el prompt de Google
                google.accounts.id.prompt((notification) => {
                    if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                        // Si el prompt no se muestra, hacer un login manual
                        google.accounts.id.renderButton(
                            document.getElementById('googleLoginBtn'),
                            {
                                theme: 'filled_blue',
                                size: 'large',
                                text: 'signin_with'
                            }
                        );
                    }
                });
            });
        });

        // Función que maneja la respuesta del login
        function handleCredentialResponse(response) {
            const loading = document.getElementById('loading');
            loading.style.display = 'block';
            document.getElementById('googleLoginBtn').disabled = true;

            // Enviar el token JWT a tu servidor PHP
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
                        window.location.href = 'dashboard.php';
                    } else {
                        alert('Error: ' + data.error);
                        loading.style.display = 'none';
                        document.getElementById('googleLoginBtn').disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error en la autenticación: ' + error.message);
                    loading.style.display = 'none';
                    document.getElementById('googleLoginBtn').disabled = false;
                });
        }
    </script>
</body>

</html>