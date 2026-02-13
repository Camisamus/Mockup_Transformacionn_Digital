<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Confirmar Identidad - Dirección de Tránsito</title>
    
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
            user-select: none;
        }

        .header-kiosk {
            padding: 1.5rem;
            text-align: center;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }

        /* Confirmation State Styles */
        .confirm-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 700px;
            animation: fadeIn 0.3s ease-out;
        }

        .user-name-display {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin: 1.5rem 0;
            text-transform: capitalize;
        }

        .btn-xl {
            padding: 1rem 2rem;
            font-size: 1.5rem;
            border-radius: 12px;
            height: 80px;
        }

        /* Edit/Input State Styles */
        .input-card {
            width: 100%;
            max-width: 800px;
            display: none; /* Hidden by default */
            animation: slideUp 0.3s ease-out;
        }

        .form-control-lg {
            height: 70px;
            font-size: 1.8rem;
            border-radius: 12px;
            background-color: white;
            border: 2px solid #e0e0e0;
        }
        
        .form-control-lg:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(0,111,179,0.1);
        }

        /* Virtual Keyboard */
        .keyboard-container {
            background: #dbe0e6;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: none; /* Hidden by default */
            z-index: 1000;
        }

        .keyboard-row {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .key {
            background: white;
            border-radius: 5px;
            margin: 0 4px;
            height: 50px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 500;
            color: #333;
            box-shadow: 0 2px 0 rgba(0,0,0,0.1);
            cursor: pointer;
            flex: 1;
            max-width: 60px;
        }

        .key:active {
            transform: translateY(2px);
            box-shadow: none;
            background: #f0f0f0;
        }

        .key-space {
            max-width: 300px;
            flex: 4;
        }
        
        .key-action {
             background: #cbd3da;
             font-size: 1rem;
             max-width: 80px;
             flex: 1.5;
        }
        
        .active-input {
            border-color: var(--primary-color) !important;
            background-color: #fff !important;
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    </style>
</head>
<body>

    <header class="header-kiosk h5 mb-0 font-weight-bold text-primary">
        Identificación de Usuario
    </header>

    <div class="content-area">
        
        <!-- View 1: Confirm Identity -->
        <div class="confirm-card" id="viewConfirm">
            <p class="h4 text-muted">¿Es este su nombre?</p>
            <div class="user-name-display" id="displayName">...</div>
            
            <div class="row mt-5">
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block btn-xl font-weight-bold" onclick="showEditMode()">
                        No, corregir
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary btn-block btn-xl font-weight-bold shadow-sm" onclick="confirmAndContinue()">
                        Sí, continuar
                    </button>
                </div>
            </div>
            
            <div class="mt-4">
                 <a href="index.php" class="text-muted"><small>Cancelar y volver al inicio</small></a>
            </div>
        </div>

        <!-- View 2: Edit / Input Name -->
        <div class="input-card" id="viewEdit">
             <h3 class="text-center font-weight-bold text-dark mb-4">Ingrese su Nombre Completo</h3>
             
             <form id="nameForm" onsubmit="return false;">
                 <div class="form-group">
                     <input type="text" class="form-control form-control-lg mb-3" id="inputNombre" placeholder="Nombre" readonly onfocus="setActiveInput(this)">
                 </div>
                 <div class="form-group">
                     <input type="text" class="form-control form-control-lg mb-4" id="inputApellido" placeholder="Apellido" readonly onfocus="setActiveInput(this)">
                 </div>
                 
                 <button class="btn btn-success btn-lg btn-block font-weight-bold shadow-sm" style="height: 60px; font-size: 1.4rem;" onclick="saveName()">
                     Confirmar Datos <span class="material-symbols-outlined align-middle ml-2">arrow_forward</span>
                 </button>
                 
                  <div class="text-center mt-3">
                     <button class="btn btn-link text-muted btn-lg" onclick="cancelEdit()">Cancelar</button>
                </div>
             </form>
        </div>

    </div>

    <!-- Virtual Keyboard -->
    <div class="keyboard-container" id="virtualKeyboard">
        <div class="keyboard-row">
            <div class="key" onclick="typeKey('Q')">Q</div>
            <div class="key" onclick="typeKey('W')">W</div>
            <div class="key" onclick="typeKey('E')">E</div>
            <div class="key" onclick="typeKey('R')">R</div>
            <div class="key" onclick="typeKey('T')">T</div>
            <div class="key" onclick="typeKey('Y')">Y</div>
            <div class="key" onclick="typeKey('U')">U</div>
            <div class="key" onclick="typeKey('I')">I</div>
            <div class="key" onclick="typeKey('O')">O</div>
            <div class="key" onclick="typeKey('P')">P</div>
        </div>
        <div class="keyboard-row">
            <div class="key" onclick="typeKey('A')">A</div>
            <div class="key" onclick="typeKey('S')">S</div>
            <div class="key" onclick="typeKey('D')">D</div>
            <div class="key" onclick="typeKey('F')">F</div>
            <div class="key" onclick="typeKey('G')">G</div>
            <div class="key" onclick="typeKey('H')">H</div>
            <div class="key" onclick="typeKey('J')">J</div>
            <div class="key" onclick="typeKey('K')">K</div>
            <div class="key" onclick="typeKey('L')">L</div>
            <div class="key" onclick="typeKey('Ñ')">Ñ</div>
        </div>
        <div class="keyboard-row">
            <div class="key" onclick="typeKey('Z')">Z</div>
            <div class="key" onclick="typeKey('X')">X</div>
            <div class="key" onclick="typeKey('C')">C</div>
            <div class="key" onclick="typeKey('V')">V</div>
            <div class="key" onclick="typeKey('B')">B</div>
            <div class="key" onclick="typeKey('N')">N</div>
            <div class="key" onclick="typeKey('M')">M</div>
            <div class="key key-action" onclick="backspace()"><span class="material-symbols-outlined">backspace</span></div>
        </div>
        <div class="keyboard-row">
            <div class="key key-space" onclick="typeKey(' ')">Espacio</div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Init
        const user = JSON.parse(localStorage.getItem('currentUser'));
        if (!user) window.location.href = 'index.php';

        let activeInputId = 'inputNombre'; // Default focus

        // Logic to determine initial view
        if (user.nombre && user.apellido) {
            // Existing user flow
            document.getElementById('displayName').textContent = user.nombre + ' ' + user.apellido;
            document.getElementById('inputNombre').value = user.nombre;
            document.getElementById('inputApellido').value = user.apellido;
        } else {
            // New user flow (Force edit mode)
            showEditMode();
            // Clear default values just in case
            document.getElementById('inputNombre').value = '';
            document.getElementById('inputApellido').value = '';
        }

        function showEditMode() {
            document.getElementById('viewConfirm').style.display = 'none';
            document.getElementById('viewEdit').style.display = 'block';
            document.getElementById('virtualKeyboard').style.display = 'block';
            
            // Highlight first input
            setActiveInput(document.getElementById('inputNombre'));
        }

        function cancelEdit() {
            if (user.nombre && user.apellido) {
                // Return to confirm screen if we had data
                document.getElementById('viewEdit').style.display = 'none';
                document.getElementById('virtualKeyboard').style.display = 'none';
                document.getElementById('viewConfirm').style.display = 'block';
            } else {
                // Return to index if we were a new user canceling entry
                window.location.href = 'index.php';
            }
        }

        function confirmAndContinue() {
            window.location.href = 'tramites.php';
        }

        function saveName() {
            const nombre = document.getElementById('inputNombre').value.trim();
            const apellido = document.getElementById('inputApellido').value.trim();

            if(nombre.length < 2 || apellido.length < 2) {
                Swal.fire('Error', 'Por favor ingrese nombres válidos', 'warning');
                return;
            }

            user.nombre = nombre;
            user.apellido = apellido;
            localStorage.setItem('currentUser', JSON.stringify(user));
            
            window.location.href = 'tramites.php';
        }

        // Keyboard Logic
        function setActiveInput(el) {
            document.querySelectorAll('.form-control').forEach(i => i.classList.remove('active-input'));
            el.classList.add('active-input');
            activeInputId = el.id;
        }

        function typeKey(char) {
            const input = document.getElementById(activeInputId);
            input.value += char;
            
            // Auto-capitalize proper nouns logic could go here
        }

        function backspace() {
             const input = document.getElementById(activeInputId);
             input.value = input.value.slice(0, -1);
        }

        // Attach touch events for inputs to emulate focus without system keyboard
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('click', function() {
                setActiveInput(this);
            });
        });

    </script>
</body>
</html>
