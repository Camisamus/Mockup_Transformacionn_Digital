<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ticket Generado - Dirección de Tránsito</title>
    
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
            background-color: var(--primary-color);
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-direction: column;
            text-align: center;
            padding: 2rem;
        }
        
        .ticket-card {
            background: white;
            color: #333;
            padding: 4rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 700px;
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .ticket-name {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--primary-color);
            margin-top: 1rem;
            margin-bottom: 2rem;
            text-transform: capitalize;
        }
        
        .timer-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 3rem;
        }
        
        .timer-progress {
            height: 100%;
            background: var(--accent-color);
            width: 100%;
            transition: width 1s linear;
        }
    </style>
</head>
<body>

    <div class="ticket-card">
        <span class="material-symbols-outlined text-success" style="font-size: 80px;">check_circle</span>
        <h1 class="h2 font-weight-bold mt-4 mb-2 text-uppercase text-muted">Registro Exitoso</h1>
        
        <div class="bg-light rounded p-5 border border-dashed my-4">
            <small class="text-uppercase text-muted font-weight-bold" style="letter-spacing: 2px;">Hola</small>
            <div class="ticket-name" id="userName">...</div>
            <hr class="my-4">
            <p class="h4 text-secondary mb-0">Su solicitud: <b class="text-dark" id="ticketTramite">...</b></p>
             <p class="mt-3 text-muted small">Ticket: <span id="ticketNumber">...</span></p>
        </div>

        <p class="h3 font-weight-normal text-dark mb-2">Por favor tome asiento.</p>
        <p class="h3 font-weight-bold text-primary">Lo llamaremos por su nombre.</p>

        <div class="timer-bar">
            <div class="timer-progress" id="progressBar"></div>
        </div>
        <small class="text-muted mt-3 d-block font-weight-bold">Volviendo al inicio en <span id="countdown">8</span> segundos...</small>
    </div>

    <script>
        // Retrieve ticket data
        const ticketData = JSON.parse(localStorage.getItem('lastTicket'));
        
        if (ticketData && ticketData.user) {
            document.getElementById('userName').textContent = ticketData.user.nombre + ' ' + ticketData.user.apellido;
            document.getElementById('ticketTramite').textContent = ticketData.tramite;
            document.getElementById('ticketNumber').textContent = ticketData.number;
        } else {
            // Fallback
            document.getElementById('userName').textContent = 'Usuario Invitado';
            document.getElementById('ticketTramite').textContent = 'Atención General';
        }

        // Auto redirect timer
        let timeLeft = 8;
        const progressBar = document.getElementById('progressBar');
        const countdownDisplay = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            timeLeft--;
            countdownDisplay.textContent = timeLeft;
            progressBar.style.width = (timeLeft * (100/8)) + '%';
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                // Clear user session data
                localStorage.removeItem('currentUser');
                localStorage.removeItem('lastTicket');
                localStorage.removeItem('tempUser');
                window.location.href = 'index.php';
            }
        }, 1000);
    </script>
</body>
</html>
