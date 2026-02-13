<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Registro Móvil - Dirección de Tránsito</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="/municipal/css/gob.cl.css" rel="stylesheet">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .mobile-container {
            max-width: 480px;
            margin: 0 auto;
            min-height: 100vh;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        .header-mobile {
            background: #006FB3;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .content-mobile {
            padding: 2rem;
            flex: 1;
        }
        .form-control-lg {
            border-radius: 12px;
            font-size: 1.1rem;
        }
        .btn-register {
            background: #006FB3;
            color: white;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(0,111,179,0.3);
        }
    </style>
</head>
<body>

    <div class="mobile-container">
        <div class="header-mobile">
            <h1 class="h5 font-weight-bold mb-0">Registro de Usuario</h1>
            <p class="small mb-0" style="opacity: 0.8;">Complete sus datos para la atención</p>
        </div>
        
        <div class="content-mobile" id="formView">
            <form id="mobileForm" onsubmit="return false;">
                <div class="form-group">
                    <label class="font-weight-bold text-muted small text-uppercase">RUT</label>
                    <input type="text" class="form-control form-control-lg bg-light" id="inputRut" readonly>
                </div>
                
                <div class="form-group">
                    <label class="font-weight-bold text-muted small text-uppercase">Nombre</label>
                    <input type="text" class="form-control form-control-lg" id="inputNombre" placeholder="Ej: Juan" required autofocus>
                </div>

                <div class="form-group mb-5">
                    <label class="font-weight-bold text-muted small text-uppercase">Apellido</label>
                    <input type="text" class="form-control form-control-lg" id="inputApellido" placeholder="Ej: Pérez" required>
                </div>
                
                <button class="btn btn-register btn-block" onclick="saveMobile()">Registrarme</button>
            </form>
        </div>

        <div class="content-mobile text-center d-flex flex-column align-items-center justify-content-center" id="successView" style="display: none !important;">
            <div class="text-success mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <h2 class="h4 font-weight-bold text-dark">¡Registro Exitoso!</h2>
            <p class="text-muted">Sus datos han sido guardados.</p>
            <div class="alert alert-info border-0 bg-light p-3 rounded w-100 mt-4">
                <small class="font-weight-bold d-block text-dark">Siguiente paso:</small>
                Vuelva al tótem e ingrese su RUT nuevamente.
            </div>
        </div>
        
        <div class="bg-light p-3 text-center text-muted small">
            Dirección de Tránsito Municipal
        </div>
    </div>

    <script>
        // Get RUT from URL
        const urlParams = new URLSearchParams(window.location.search);
        const rutParams = urlParams.get('rut');
        
        if(rutParams) {
            document.getElementById('inputRut').value = rutParams;
        }

        function saveMobile() {
            const rut = document.getElementById('inputRut').value;
            const nombre = document.getElementById('inputNombre').value;
            const apellido = document.getElementById('inputApellido').value;

            if(!nombre || !apellido) {
                alert('Por favor complete todos los campos');
                return;
            }

            // SIMULATION: Save to LocalStorage
            // NOTE: In a real scenario this would send data to the server DB
            // For this demo to work on the same browser (simulated flow), we use localStorage
            let db = JSON.parse(localStorage.getItem('usersDB')) || {};
            db[rut] = { nombre: nombre, apellido: apellido };
            localStorage.setItem('usersDB', JSON.stringify(db));

            // Also set current for immediate ease
            localStorage.setItem('currentUser', JSON.stringify({rut: rut, nombre: nombre, apellido: apellido}));

            document.getElementById('formView').style.display = 'none';
            document.getElementById('successView').style.setProperty('display', 'flex', 'important');
        }
    </script>
</body>
</html>
