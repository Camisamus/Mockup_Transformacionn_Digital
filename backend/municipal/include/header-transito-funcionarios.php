<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Municipio de Cuidados - Panel Tránsito</title>
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
    
    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

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
        }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #dbe0e6; border-radius: 10px; }
        
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
        
        /* Utils */
        .btn-primary { background-color: var(--gob-primary); border-color: var(--gob-primary); }
        .text-primary { color: var(--gob-primary) !important; }
        .bg-light { background-color: #f8f9fa !important; }
    </style>
</head>
<body>

    <div class="wrapper-portal">
        <aside class="sidebar-portal shadow-sm">
            <div class="p-4 d-flex flex-column h-100" style="gap: 1.5rem;">
                <!-- Brand -->
                <div class="d-flex align-items-center mb-4 px-2" style="gap: 0.75rem;">
                    <div class="bg-primary d-flex align-items-center justify-content-center text-white rounded" style="width: 40px; height: 40px; flex-shrink: 0;">
                        <span class="material-symbols-outlined">directions_car</span>
                    </div>
                    <div class="d-flex flex-column overflow-hidden">
                        <h1 class="font-weight-bold text-uppercase mb-0 text-truncate" style="font-size: 11px; letter-spacing: -0.0125em; line-height: 1.2;">Dirección de Tránsito</h1>
                        <p class="text-muted mb-0" style="font-size: 10px;">Gestión de Licencias</p>
                    </div>
                </div>

                <!-- Navigation -->
                <ul class="nav nav-pills flex-column flex-grow-1 overflow-auto custom-scrollbar" style="gap: 2px;">
                    <li class="px-3 mb-2 mt-2">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Operaciones</small>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
                            <span class="material-symbols-outlined">calendar_month</span>
                            <span>Dashboard Semanal</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'agenda.php') ? 'active' : ''; ?>" href="agenda.php">
                            <span class="material-symbols-outlined">view_agenda</span>
                            <span>Agenda Diaria</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'reportes.php') ? 'active' : ''; ?>" href="reportes.php">
                            <span class="material-symbols-outlined">bar_chart</span>
                            <span>Reportes</span>
                        </a>
                    </li>

                    <li class="mt-4 pt-4 border-top px-3 mb-2">
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Administración</small>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'configuracion.php') ? 'active' : ''; ?>" href="configuracion.php">
                            <span class="material-symbols-outlined">settings_suggest</span>
                            <span>Config. Cupos</span>
                        </a>
                    </li>
                    
                     <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <span class="material-symbols-outlined">arrow_back</span>
                            <span>Volver al Portal</span>
                        </a>
                    </li>
                </ul>

                <!-- User Footer -->
                <div class="mt-auto d-flex align-items-center pt-3 border-top px-2" style="gap: 0.75rem;">
                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center font-weight-bold text-primary" style="width: 36px; height: 36px; font-size: 11px;">OP</div>
                    <div class="d-flex flex-column overflow-hidden">
                        <p class="font-weight-bold text-dark mb-0 text-truncate" style="font-size: 11px;">Operador Tránsito</p>
                        <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px;">Funcionario</p>
                    </div>
                </div>
            </div>
        </aside>
        <main class="main-portal">
