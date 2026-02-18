<?php
$current_page = basename($_SERVER['PHP_SELF']);
require_once '../../api/auth_check.php';
?>
<!DOCTYPE html>
<html class="light" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Municipio de Cuidados - Gestión OIRS</title>
    <!-- Framework Kit Digital (Gob.cl) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap" rel="stylesheet">
    <link href="<?php echo $pathPrefix; ?>recursos/css/gob.cl.css" rel="stylesheet">

    <!-- Bootstrap 4 / Kit Digital Base (Gob.cl) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
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

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #dbe0e6;
            border-radius: 10px;
        }

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

        .bg-primary {
            background-color: var(--gob-primary) !important;
        }

        .font-serif {
            font-family: 'Roboto Slab', serif !important;
        }

        /* ========================================
           CARDS & CONTAINERS
           ======================================== */
        .search-card {
            background: white;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* ========================================
           FORM CONTROLS
           ======================================== */
        .filter-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 800;
            color: #8898aa;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control-cool {
            border-radius: 8px;
            font-size: 13px;
            transition: all 0.2s;
            background-color: #f8f9fa;
        }

        .form-control-cool:focus {
            border-color: var(--gob-primary);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(0, 111, 179, 0.1);
        }

        /* ========================================
           STATUS BADGES
           ======================================== */
        .status-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-ingresada {
            background: #e3f2fd;
            color: #007bff;
        }

        .badge-proceso {
            background: #fff3e0;
            color: #ef6c00;
        }

        .badge-resuelta {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-vencida {
            background: #ffebee;
            color: #c62828;
        }

        /* ========================================
           TABLE & ROWS
           ======================================== */
        .oirs-row {
            transition: all 0.2s ease;
        }

        .oirs-row:hover {
            background-color: rgba(0, 111, 179, 0.02) !important;
            cursor: pointer;
            transform: scale(1.002);
        }

        .table-header {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-body {
            font-size: 13px;
        }

        /* ========================================
           ACTION BUTTONS
           ======================================== */
        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background-color: #f1f3f5;
            transform: translateY(-2px);
        }

        /* ========================================
           ADVANCED FILTERS
           ======================================== */
        .advanced-filters {
            height: 0;
            overflow: hidden;
            transition: height 0.3s ease-out;
        }

        .advanced-filters.show {
            height: auto;
            padding-top: 1rem;
            border-top: 1px dashed #dee2e6;
            margin-top: 1rem;
        }

        /* ========================================
           UTILITY CLASSES
           ======================================== */
        .user-avatar {
            width: 32px;
            height: 32px;
            font-weight: bold;
            font-size: 11px;
        }

        .user-avatar-primary {
            background: #e7f1ff;
        }

        .user-avatar-danger {
            background: #fff5f5;
        }

        .icon-sm {
            font-size: 18px;
        }

        .icon-md {
            font-size: 20px;
        }

        .text-xs {
            font-size: 9px;
        }

        .text-xxs {
            font-size: 11px;
        }

        /* ========================================
           STEPPER
           ======================================== */
        .step-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-header::before {
            content: "";
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #dee2e6;
            z-index: 1;
        }

        .step-item {
            position: relative;
            z-index: 2;
            background: var(--gob-bg);
            padding: 0 10px;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .step-item.active .step-circle {
            background: var(--gob-primary);
            border-color: var(--gob-primary);
            color: white;
        }

        .step-item.completed .step-circle {
            background: var(--gob-success);
            border-color: var(--gob-success);
            color: white;
        }

        .step-label {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            color: #6c757d;
        }

        .step-item.active .step-label {
            color: var(--gob-primary);
        }

        /* ========================================
           FORM SECTIONS
           ======================================== */
        .form-section-title {
            border-bottom: 2px solid var(--gob-primary);
            padding-bottom: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
            color: var(--gob-primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* ========================================
           MAP CONTAINER
           ======================================== */
        .map-container {
            height: 200px;
            background: #e9ecef;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            margin-top: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link href="<?php echo $pathPrefix; ?>recursos/css/gob.cl.css" rel="stylesheet">

    <!-- Preload Critical Fonts to minimize FOUT -->
    <link rel="preload" href="<?php echo $pathPrefix; ?>recursos/fonts/roboto-400.ttf" as="font" type="font/ttf"
        crossorigin>
    <link rel="preload" href="<?php echo $pathPrefix; ?>recursos/fonts/roboto-700.ttf" as="font" type="font/ttf"
        crossorigin>
    <link rel="preload" href="<?php echo $pathPrefix; ?>recursos/fonts/robotoslab-700.ttf" as="font" type="font/ttf"
        crossorigin>

    <link href="<?php echo $pathPrefix; ?>recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $pathPrefix; ?>recursos/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Additional CSS can be injected here if needed -->
</head>

<body style="padding: 0; margin: 0;">

    <div id="wrapper-layout" class="d-flex h-100" style="min-height: 100vh;">
        <!-- Sidebar -->
        <div id="sidebar-container" class="sidebar-portal shadow-sm">
            <div class="p-4 d-flex flex-column h-100" style="gap: 1.5rem;">
                <div class="d-flex align-items-center mb-4 px-2" style="gap: 0.75rem;">

                    <div class="d-flex flex-column overflow-hidden">

                        <img src="../../recursos/img/logo.png" />
                    </div>
                </div>

                <div class="flex-grow-1 overflow-auto custom-scrollbar">
                    <?php echo $sidebarHtml; ?>
                </div>

                <div class="mt-auto d-flex align-items-center pt-3 border-top px-2" style="gap: 0.75rem;">
                    <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center font-weight-bold text-primary"
                        style="width: 36px; height: 36px; font-size: 11px; color: #006FB3 !important;">
                        <?php echo strtoupper(substr($userData['nombre'], 0, 1) . substr($userData['apellido'], 0, 1)); ?>
                    </div>
                    <div class="d-flex flex-column overflow-hidden">
                        <p class="font-weight-bold text-dark mb-0 text-truncate" style="font-size: 11px;">
                            <?php echo $userData['nombre'] . ' ' . $userData['apellido']; ?>
                        </p>
                        <p class="text-primary font-weight-bold text-uppercase mb-0"
                            style="font-size: 9px; color: #006FB3 !important;">Funcionario</p>
                    </div>
                    <button class="btn btn-link p-0 ml-auto text-muted shadow-none"
                        onclick="localStorage.removeItem('isLoggedIn'); localStorage.removeItem('user_data'); window.location.href='<?php echo $pathPrefix; ?>api/logout.php'">
                        <?php echo getIcon('log-out', '', ['width' => '18', 'height' => '18']); ?>
                    </button>
                </div>
            </div>
        </div>

        <div id="sidebar-overlay" onclick="$('#sidebar-container').removeClass('show'); $(this).removeClass('show');">
        </div>

        <!-- Main Content -->
        <main class="main-portal flex-grow-1 watermark-bg">

            <header class="bg-white border-bottom shadow-sm px-4 d-flex align-items-center justify-content-between"
                style="height: 70px; border-bottom: 3px solid #006FB3 !important; flex-shrink: 0; z-index: 10;">
                <div class="d-flex align-items-center" style="gap: 1rem;">
                    <button class="btn btn-link d-lg-none p-0 text-dark" id="sidebar-toggle" style="box-shadow: none;">
                        <?php echo getIcon('menu'); ?>
                    </button>
                    <div class="d-flex flex-column">
                        <h2 class="h6 font-serif font-bold text-dark mb-0" id="page-title">
                            <?php echo isset($pageTitle) ? $pageTitle : 'Sistema de Gestión'; ?>
                        </h2>
                        <p class="text-primary font-weight-bold text-uppercase mb-0"
                            style="font-size: 9px; letter-spacing: 0.15em; margin-top: 2px; color: #006FB3 !important;">
                            Sistema Unificado de Gestión Municipal de Cuidados</p>
                    </div>
                </div>
                <!-- Notifications/Widgets as per mockup -->
                <div class="d-flex align-items-center" style="gap: 1rem;">
                    <div class="d-none d-md-flex align-items-center text-muted font-weight-bold mr-3"
                        style="font-size: 10px; gap: 0.5rem;">
                        <span class="rounded-circle bg-warning" style="width: 8px; height: 8px;"></span>
                        <span class="text-uppercase" style="letter-spacing: 0.05em;">Solicitudes Pendientes</span>
                    </div>
                    <button class="btn btn-light btn-sm rounded-circle p-2 border-0 shadow-none position-relative">
                        <?php echo getIcon('bell', 'text-muted'); ?>
                    </button>
                </div>
            </header>

            <div class="container-fluid p-4" id="main-content-container">
                <!-- Page Content Starts Here -->

                <script>
                    $(document).ready(function () {
                        $('#sidebar-toggle').on('click', function () {
                            $('#sidebar-container').addClass('show');
                            $('#sidebar-overlay').addClass('show');
                        });
                    });
                </script>