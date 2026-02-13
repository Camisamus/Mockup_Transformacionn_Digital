<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Bienvenido - Dirección de Tránsito</title>
    
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
            overflow: hidden;
            display: flex;
            flex-direction: column;
            user-select: none; /* Kiosk mode prevention */
        }
        
        .kiosk-header {
            background: white;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            z-index: 10;
        }
        
        .kiosk-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .rut-display {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: #333;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            width: 100%;
            max-width: 500px;
        }
        
        .key-btn {
            background: white;
            border: none;
            border-radius: 16px;
            height: 80px;
            font-size: 2rem;
            font-weight: 500;
            color: #444;
            box-shadow: 0 4px 0 #dbe0e6;
            transition: all 0.1s;
        }
        
        .key-btn:active {
            transform: translateY(4px);
            box-shadow: none;
            background-color: #f8f9fa;
        }
        
        .key-btn.action-k {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .key-btn.action-del {
            color: #dc3545;
        }
        
        .btn-continue {
            background: var(--primary-color);
            color: white;
            font-size: 1.5rem;
            padding: 1rem 3rem;
            border-radius: 50px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,111,179,0.3);
            width: 100%;
            max-width: 500px;
            margin-top: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.2s;
        }
        
        .btn-continue:active {
            transform: scale(0.98);
        }

        /* Modal specific styles for larger touch targets */
        .modal-touch .form-control {
            height: 60px;
            font-size: 1.5rem;
        }
        
        .modal-touch .modal-content {
            border-radius: 20px;
        }
        
        .modal-touch .btn-primary {
            height: 60px;
            font-size: 1.5rem;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <header class="kiosk-header">
        <div class="d-flex align-items-center justify-content-center mb-2">
            <span class="material-symbols-outlined text-primary" style="font-size: 48px; margin-right: 15px;">location_city</span>
            <div class="text-left">
                <h1 class="h3 font-weight-bold mb-0 text-uppercase" style="letter-spacing: -1px;">Municipio de Cuidados</h1>
                <p class="text-muted mb-0 font-weight-bold text-uppercase" style="letter-spacing: 2px; font-size: 0.9rem;">Dirección de Tránsito</p>
            </div>
        </div>
        <h2 class="h5 text-primary mt-3 font-weight-bold">Bienvenido, por favor ingrese su RUT</h2>
    </header>

    <div class="kiosk-container flex-column">
        
        <!-- RUT Display -->
        <div class="rut-display" id="rutDisplay">
            <span class="text-muted" style="opacity: 0.3;">RUT sin puntos</span>
        </div>
        
        <!-- Numpad -->
        <div class="keypad">
            <button class="key-btn" onclick="addNumber('1')">1</button>
            <button class="key-btn" onclick="addNumber('2')">2</button>
            <button class="key-btn" onclick="addNumber('3')">3</button>
            <button class="key-btn" onclick="addNumber('4')">4</button>
            <button class="key-btn" onclick="addNumber('5')">5</button>
            <button class="key-btn" onclick="addNumber('6')">6</button>
            <button class="key-btn" onclick="addNumber('7')">7</button>
            <button class="key-btn" onclick="addNumber('8')">8</button>
            <button class="key-btn" onclick="addNumber('9')">9</button>
            <button class="key-btn action-k" onclick="addNumber('K')">K</button>
            <button class="key-btn" onclick="addNumber('0')">0</button>
            <button class="key-btn action-del" onclick="deleteNumber()"><span class="material-symbols-outlined" style="font-size: 32px;">backspace</span></button>
        </div>
        
        <button class="btn-continue" onclick="checkRut()">Continuar</button>
        
    </div>

    <!-- Registration Modal (NEW USER or EDIT) -->
    <div class="modal fade modal-touch" id="registerModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-primary pl-3 pt-3 h3">Ingreso de Datos</h5>
                    <button type="button" class="close p-3" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 2rem;">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <p class="text-muted h5 mb-4">Por favor ingrese su nombre para llamarlo por pantalla.</p>
                    <form id="registerForm">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-uppercase text-muted">Nombre</label>
                            <input type="text" class="form-control bg-light border-0" id="inputNombre" placeholder="Ej: Juan">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-uppercase text-muted">Apellido</label>
                            <input type="text" class="form-control bg-light border-0" id="inputApellido" placeholder="Ej: Pérez">
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block px-5 font-weight-bold shadow-sm" onclick="submitRegistration()">Guardar y Continuar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Identity Modal (EXISTING USER) -->
    <div class="modal fade modal-touch" id="confirmIdentityModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body p-5 text-center">
                    <h3 class="text-muted text-uppercase mb-3 font-weight-bold" style="font-size: 1.2rem; letter-spacing: 2px;">Confirmación de Identidad</h3>
                    <h2 class="display-4 font-weight-bold text-primary mb-4" id="confirmNameDisplay">Juan Pérez</h2>
                    <p class="h4 text-muted mb-5">¿Es este su nombre?</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-light btn-lg btn-block border py-4 font-weight-bold text-muted" style="font-size: 1.5rem; border-radius: 15px;" onclick="correctIdentity()">No, corregir</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success btn-lg btn-block py-4 font-weight-bold shadow-sm" style="font-size: 1.5rem; border-radius: 15px;" onclick="confirmIdentity()">Sí, soy yo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let currentRut = '';

        function formatRut(rut) {
            // Simple formatter for display
            if (rut.length <= 1) return rut;
            
            let cleanRut = rut.replace(/[^0-9kK]/g, '');
            let body = cleanRut.slice(0, -1);
            let dv = cleanRut.slice(-1).toUpperCase();
            
            if (cleanRut.length < 2) return cleanRut;
            
            return body.replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '-' + dv;
        }

        function addNumber(num) {
            if (currentRut.length >= 9) return; // Limit length
            currentRut += num;
            updateDisplay();
        }

        function deleteNumber() {
            currentRut = currentRut.slice(0, -1);
            updateDisplay();
        }

        function updateDisplay() {
            const display = document.getElementById('rutDisplay');
            if (currentRut.length === 0) {
                display.innerHTML = '<span class="text-muted" style="opacity: 0.3;">RUT sin puntos</span>';
            } else {
                display.innerText = formatRut(currentRut);
            }
        }

        function checkRut() {
            if (currentRut.length < 7) {
                Swal.fire({
                    icon: 'warning',
                    title: 'RUT Incompleto',
                    text: 'Por favor ingrese un RUT válido.',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            // SIMULATION LOGIC:
            // Check if user exists in our "Local DB" (simulated by localStorage key 'usersDB')
            let db = JSON.parse(localStorage.getItem('usersDB')) || {};
            let storedUser = db[currentRut];

            if (storedUser) {
                 // FOUND in Local DB (e.g. just registered via Mobile)
                 localStorage.setItem('currentUser', JSON.stringify({rut: currentRut, ...storedUser}));
                 window.location.href = 'confirmar_identidad.php';
                 return;
            }

            // Fallback Simulation Rules
            let user = { rut: currentRut, nombre: '', apellido: '' };

            if (currentRut.endsWith('9')) {
                // NOT FOUND / NEW USER / NO RESERVATION
                window.location.href = 'no_registrado.php?rut=' + currentRut;
                return;
            } else {
                // KNOWN USER SIMULATION
                let simulatedName = "Juan";
                let simulatedLast = "Pérez";
                
                if(currentRut.endsWith('1')) { simulatedName = "María"; simulatedLast = "González"; }
                if(currentRut.endsWith('2')) { simulatedName = "Carlos"; simulatedLast = "Tapia"; }

                user.nombre = simulatedName;
                user.apellido = simulatedLast;
                
                localStorage.setItem('currentUser', JSON.stringify(user));
                window.location.href = 'confirmar_identidad.php';
            }
        }

        function submitRegistration() {
            const nombre = document.getElementById('inputNombre').value;
            const apellido = document.getElementById('inputApellido').value;

            if (!nombre || !apellido) {
                Swal.fire({
                    icon: 'error',
                    title: 'Datos Faltantes',
                    text: 'Por favor complete su nombre y apellido.',
                });
                return;
            }
            
            // Register and proceed
            localStorage.setItem('currentUser', JSON.stringify({rut: currentRut, nombre: nombre, apellido: apellido}));
            $('#registerModal').modal('hide');
            window.location.href = 'tramites.php';
        }

        function confirmIdentity() {
            const user = JSON.parse(localStorage.getItem('tempUser'));
            localStorage.setItem('currentUser', JSON.stringify(user));
            $('#confirmIdentityModal').modal('hide');
            window.location.href = 'tramites.php';
        }

        function correctIdentity() {
             $('#confirmIdentityModal').modal('hide');
             // Open register modal to correct name manually
             document.getElementById('inputNombre').value = '';
             document.getElementById('inputApellido').value = '';
             $('#registerModal').modal('show');
        }
    </script>
</body>
</html>
