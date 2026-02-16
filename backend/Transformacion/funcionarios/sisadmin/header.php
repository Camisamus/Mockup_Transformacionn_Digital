<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link href="<?php echo $pathPrefix; ?>recursos/css/gob.cl.css" rel="stylesheet">
    <link href="<?php echo $pathPrefix; ?>recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $pathPrefix; ?>recursos/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?php echo $pathPrefix; ?>recursos/js/layout_manager.js"></script>
    <!-- Additional CSS can be injected here if needed -->
</head>

<body style="padding: 0; margin: 0;">

    <div id="wrapper-layout" class="d-flex h-100" style="min-height: 100vh;">
        <!-- Sidebar -->
        <div id="sidebar-container" class="sidebar-portal shadow-sm">
            <div class="p-4 d-flex flex-column h-100" style="gap: 1.5rem;">
                <div class="d-flex align-items-center mb-4 px-2" style="gap: 0.75rem;">

                    <div class="d-flex flex-column overflow-hidden">
                        <img src="<?php echo $pathPrefix; ?>recursos/img/logo.png" />
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
                        <span data-feather="log-out" style="width: 18px; height: 18px;"></span>
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
                        <span data-feather="menu"></span>
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
                        <span data-feather="bell" style="width: 20px; height: 20px; color: #64748b;"></span>
                    </button>
                </div>
            </header>

            <div class="container-fluid pb-5 px-4 pt-4" id="main-content-container">
                <!-- Page Content Starts Here -->

                <script>
                    $(document).ready(function () {
                        $('#sidebar-toggle').on('click', function () {
                            $('#sidebar-container').addClass('show');
                            $('#sidebar-overlay').addClass('show');
                        });
                    });
                </script>