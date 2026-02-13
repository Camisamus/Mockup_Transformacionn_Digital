<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Sin Reserva - Dirección de Tránsito</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1" rel="stylesheet"/>
    <link href="/municipal/css/gob.cl.css" rel="stylesheet">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <style>
        :root {
            --primary-color: #006FB3;
            --secondary-color: #2D717C;
            --accent-color: #FFA11B;
        }
        
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            user-select: none;
        }

        .alert-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 600px;
            position: relative;
        }

        .qr-placeholder {
            width: 200px;
            height: 200px;
            background: #fff;
            margin: 2rem auto;
            border: 4px solid var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            padding: 10px;
        }

        .qr-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .btn-xl {
            padding: 1rem 2rem;
            font-size: 1.2rem;
            border-radius: 12px;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="alert-card">
        <span class="material-symbols-outlined text-danger mb-3" style="font-size: 64px;">warning</span>
        <h1 class="h3 font-weight-bold text-dark mb-2">Usted no tiene reserva para hoy</h1>
        <p class="text-muted h5">Por favor escanee el siguiente código QR para <br>registrar su información.</p>
        
        <div class="qr-placeholder" id="qrContainer">
            <!-- QR code will be generated here -->
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://localhost/municipal/gestordefilas/mobile_register.php" alt="QR Code">
        </div>

        <p class="small text-muted mb-4 font-weight-bold text-uppercase" style="letter-spacing: 1px;">Registro Express en su celular</p>

        <div class="row">
             <div class="col-6">
                <a href="index.php" class="btn btn-outline-secondary btn-block btn-xl">Volver al Inicio</a>
            </div>
            <div class="col-6">
                <a href="index.php?retry=true" class="btn btn-primary btn-block btn-xl shadow-sm">Ya me registré</a>
            </div>
        </div>
        
         <!-- Simulation Helper -->
         <div class="mt-4 pt-4 border-top">
            <small class="text-muted d-block mb-2"><i>Simulación (Abre en nueva pestaña para probar):</i></small>
            <a href="#" class="btn btn-sm btn-light border small" onclick="openSimMobile()">Abrir Formulario Móvil</a>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const rut = urlParams.get('rut') || 'UNKNOWN';

        // Dynamic QR
        // Ideally point to actual IP, but for localhost simulation use relative or fix
        const mobileUrl = window.location.origin + '/municipal/gestordefilas/mobile_register.php?rut=' + rut;
        document.querySelector('#qrContainer img').src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(mobileUrl)}`;

        function openSimMobile() {
            window.open(mobileUrl, '_blank', 'width=400,height=800');
        }
    </script>
</body>
</html>
