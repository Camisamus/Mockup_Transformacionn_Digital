<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Selección de Trámite - Dirección de Tránsito</title>
    
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
            overflow: auto; 
            padding-bottom: 2rem;
            user-select: none;
        }

        .header-kiosk {
            padding: 2rem;
            text-align: center;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .procedure-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            padding: 0 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .procedure-card {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.2s;
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .procedure-card:active {
            transform: scale(0.96);
            background-color: #f8f9fa;
        }

        .procedure-icon {
            font-size: 64px;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .procedure-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            line-height: 1.2;
        }

        .btn-other {
            grid-column: span 2;
            background: var(--secondary-color);
            color: white;
        }
        
        .btn-other .procedure-icon,
        .btn-other .procedure-title {
            color: white !important;
        }

        /* Modal specific styles */
        .modal-touch .modal-content {
            border-radius: 20px;
        }
        
        .modal-touch .list-group-item {
            padding: 1.5rem 2rem;
            font-size: 1.4rem;
            font-weight: 500;
        }
        
        .modal-touch .modal-title {
             font-size: 1.8rem;
        }
    </style>
</head>
<body>

    <header class="header-kiosk sticky-top">
        <h1 class="h2 font-weight-bold text-primary mb-2">Seleccione su Trámite</h1>
        <p class="text-muted mb-0 h5">Toque la opción que desea realizar</p>
    </header>

    <div class="procedure-grid">
        <!-- Card 1 -->
        <div class="procedure-card" onclick="selectTramite('Licencia Primera Vez')">
            <span class="material-symbols-outlined procedure-icon">badge</span>
            <span class="procedure-title">Obtención Primera Licencia</span>
        </div>

        <!-- Card 2 -->
        <div class="procedure-card" onclick="selectTramite('Renovación Licencia')">
            <span class="material-symbols-outlined procedure-icon">update</span>
            <span class="procedure-title">Renovación de Licencia</span>
        </div>

        <!-- Card 3 -->
        <div class="procedure-card" onclick="selectTramite('Duplicado')">
            <span class="material-symbols-outlined procedure-icon">content_copy</span>
            <span class="procedure-title">Duplicado</span>
        </div>

        <!-- Card 4 -->
        <div class="procedure-card" onclick="selectTramite('Examen Práctico')">
            <span class="material-symbols-outlined procedure-icon">directions_car</span>
            <span class="procedure-title">Examen Práctico</span>
        </div>

        <!-- Card 5 (Otros) -->
        <div class="procedure-card btn-other" onclick="openOtrosModal()">
            <span class="material-symbols-outlined procedure-icon">more_horiz</span>
            <span class="procedure-title">Otros Trámites</span>
        </div>
    </div>
    
    <div class="text-center mt-5 mb-5">
        <a href="index.php" class="btn btn-link text-muted btn-lg"><span class="material-symbols-outlined align-middle mr-2">arrow_back</span> Volver al Inicio</a>
    </div>

    <!-- Modal Otros -->
    <div class="modal fade modal-touch" id="otrosModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark pl-3 pt-3">Otros Servicios</h5>
                    <button type="button" class="close p-4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="list-group list-group-flush">
                        <button type="button" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between" onclick="selectTramite('Control Médico')">
                            Control Médico
                            <span class="material-symbols-outlined text-muted">chevron_right</span>
                        </button>
                        <button type="button" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between" onclick="selectTramite('Consulta Coordinación')">
                            Consulta Coordinación
                            <span class="material-symbols-outlined text-muted">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check if user is logged in (simulated)
        if (!localStorage.getItem('currentUser')) {
           window.location.href = 'index.php';
        }

        const user = JSON.parse(localStorage.getItem('currentUser'));
        
        // Display User Name
        document.querySelector('.h5.text-muted.mb-0').innerHTML = 
            `Hola, <b class="text-primary">${user.nombre}</b>. Toque la opción que desea realizar`;

        function openOtrosModal() {
            $('#otrosModal').modal('show');
        }

        function selectTramite(tramite) {
            // Logic to register ticket
            Swal.fire({
                title: 'Confirmando...',
                html: 'Generando ticket para: <br><b>' + tramite + '</b>',
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            }).then(() => {
                // Pass data to success page
                localStorage.setItem('lastTicket', JSON.stringify({
                    tramite: tramite,
                    user: user,
                    number: 'A-' + Math.floor(Math.random() * 100), // Random ticket
                    time: new Date().toLocaleTimeString()
                }));
                window.location.href = 'exito.php';
            });
        }
    </script>
</body>
</html>
