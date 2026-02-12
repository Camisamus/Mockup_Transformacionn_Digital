<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Municipio de Cuidados - Gestión OIRS</title>
    <!-- Framework Kit Digital (Gob.cl) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap" rel="stylesheet">
    <link href="/municipal/css/gob.cl.css" rel="stylesheet">

    <!-- Bootstrap 4 / Kit Digital Base (Gob.cl) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --gob-primary: #006FB3;
            --gob-success: #2D717C;
            --gob-warning: #FFA11B;
            --gob-danger: #FE6565;
            --gob-bg: #EEEEEE;
        }
        body { 
            font-family: 'Roboto', sans-serif; 
            background-color: var(--gob-bg);
            color: #333;
        }
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #dbe0e6; border-radius: 10px; }
        
        /* Navegación Estándar Bootstrap 4 */
        .sidebar-portal .nav-pills .nav-link {
            border-radius: 0;
            padding: 0.75rem 1.5rem;
            color: #444;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-left: 4px solid transparent;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sidebar-portal .nav-pills .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--gob-primary);
        }

        .sidebar-portal .nav-pills .nav-link.active {
            background-color: rgba(0, 111, 179, 0.08) !important;
            color: var(--gob-primary) !important;
            font-weight: 700;
            border-left: 4px solid var(--gob-primary);
        }

        .sidebar-portal .nav-pills .nav-link .material-symbols-outlined {
            font-size: 24px;
        }

        /* Sistema de Layout Robusto */
        .wrapper-portal {
            display: flex;
            height: 100vh;
            overflow: hidden;
            width: 100%;
        }

        .sidebar-portal {
            width: 280px;
            flex-shrink: 0;
            background: white;
            border-right: 1px solid #dee2e6;
            height: 100%;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .main-portal {
            flex-grow: 1;
            min-width: 0;
            height: 100%;
            overflow-y: auto;
            background-color: #F8F9FA;
            display: flex;
            flex-direction: column;
            padding: 0 !important;
        }

        @media (max-width: 991.98px) {
            .sidebar-portal {
                position: fixed;
                left: -260px;
            }
            .sidebar-portal.show {
                left: 0;
            }
        }

        .bg-primary { background-color: var(--gob-primary) !important; }
        .font-serif { font-family: 'Roboto Slab', serif !important; }
    </style>
</head>
<body>

    <div class="wrapper-portal">
        <aside class="sidebar-portal shadow-sm">
            <div class="p-4 d-flex flex-column h-100" style="gap: 1.5rem;">
                <div class="d-flex align-items-center mb-4 px-2" style="gap: 0.75rem;">
                    <div class="bg-primary d-flex align-items-center justify-content-center text-white rounded" style="width: 40px; height: 40px; flex-shrink: 0;">
                        <span class="material-symbols-outlined">location_city</span>
                    </div>
                    <div class="d-flex flex-column overflow-hidden">
                        <h1 class="font-weight-bold text-uppercase mb-0 text-truncate" style="font-size: 11px; letter-spacing: -0.0125em; line-height: 1.2;">Gestión OIRS</h1>
                        <p class="text-muted mb-0" style="font-size: 10px;">Municipio de Cuidados</p>
                    </div>
                </div>

                <ul class="nav nav-pills flex-column flex-grow-1 overflow-auto custom-scrollbar" style="gap: 2px;">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-muted" href="/municipal/funcionarios/index.php" style="font-size: 12px; opacity: 0.8;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                            <span>Volver al Panel</span>
                        </a>
                    </li>

                    <li class="px-3 mb-2 mt-2">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Operaciones</small>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/index.php">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard OIRS</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'ingresar.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/ingresar.php">
                            <span class="material-symbols-outlined">add_circle</span>
                            <span>Ingresar OIRS</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'consulta.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/consulta.php">
                            <span class="material-symbols-outlined">search</span>
                            <span>Consulta OIRS</span>
                        </a>
                    </li>

                    <li class="px-3 mb-2 mt-4">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Flujo de Revisión</small>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'revisar.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/revisar.php">
                            <span class="material-symbols-outlined">pending_actions</span>
                            <span>Solicitudes por Revisar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'visacion.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/visacion.php">
                            <span class="material-symbols-outlined">rule</span>
                            <span>Visación de Solicitudes</span>
                        </a>
                    </li>

                    <li class="px-3 mb-2 mt-4">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Gestión y Control</small>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'informe.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/informe.php">
                            <span class="material-symbols-outlined">analytics</span>
                            <span>Informe de Gestión</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'ajustes.php') ? 'active' : ''; ?>" href="/municipal/funcionarios/oirs/ajustes.php">
                            <span class="material-symbols-outlined">settings</span>
                            <span>Ajuste de OIRS</span>
                        </a>
                    </li>
                </ul>

                <div class="mt-auto d-flex align-items-center pt-3 border-top px-2" style="gap: 0.75rem;">
                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center font-weight-bold text-primary" style="width: 36px; height: 36px; font-size: 11px;">AM</div>
                    <div class="d-flex flex-column overflow-hidden">
                        <p class="font-weight-bold text-dark mb-0 text-truncate" style="font-size: 11px;">Alejandro M.</p>
                        <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px;">Administrador</p>
                    </div>
                </div>
            </div>
        </aside>
<main class="main-portal">
<script>
$(document).ready(function() {
    $('.sidebar-toggle').on('click', function() {
        $('.sidebar-portal').toggleClass('show');
    });
});
</script>
