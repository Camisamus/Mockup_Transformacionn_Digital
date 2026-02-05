<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link href="<?php echo $pathPrefix; ?>recursos/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $pathPrefix; ?>recursos/css/style.css" rel="stylesheet">
    <link href="https://cdn.digital.gob.cl/framework/css/gob.cl.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Additional CSS can be injected here if needed -->
</head>

<body style="padding: 0; margin: 0; overflow: hidden;">

    <div id="wrapper-layout" class="d-flex h-100" style="min-height: 100vh;">
        <!-- Sidebar -->
        <div id="sidebar-container" class="flex-shrink-0 sidebar-entrance" style="min-width: 250px; max-width: 250px;">
            <?php echo $sidebarHtml; ?>
        </div>

        <!-- Main Content -->
        <main class="flex-grow-1 p-0 bg-light d-flex flex-column content-entrance"
            style="height: 100vh; overflow-y: auto;">

            <header class="sticky-top p-0" style="z-index: 1000;">
                <div class="header-gob"
                    style="background-color: #003399; color: white; width: 100%; padding: 5px 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo $pathPrefix; ?>recursos/img/NdPOjvBw.jpeg" alt="Gobierno de Chile"
                                style="height: 50px; width: auto; object-fit: contain;">
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-white small d-none d-md-inline" id="header-user-name">Usuario:
                                <?php echo $userData['nombre'] . ' ' . $userData['apellido']; ?>
                            </span>
                            <button type="button" class="btn btn-sm btn-danger border-0"
                                style="background-color: #dc3545;"
                                onclick="localStorage.removeItem('isLoggedIn'); localStorage.removeItem('user_data'); window.location.href='<?php echo $pathPrefix; ?>api/logout.php'">
                                <span class="d-none d-sm-inline">Salir</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center w-100">
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="sidebar-toggle">
                            <span data-feather="menu"></span>
                        </button>
                        <h4 class="m-0 text-primary fw-bold fs-5" id="page-title">
                            <?php
                            // Try to guess title from script name or define $pageTitle in page
                            echo isset($pageTitle) ? $pageTitle : 'Sistema de Gestión';
                            ?>
                        </h4>
                    </div>
                </div>
            </header>

            <div class="container-fluid pb-5 px-4" id="main-content-container">
                <!-- Page Content Starts Here -->