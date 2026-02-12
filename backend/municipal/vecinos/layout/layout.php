<?php
/**
 * Layout Maestro del Portal Vecinos
 * modernizacion.munivina.cl
 */
function renderLayout($page_title, $content_php, $current_module = '') {
    include_once(__DIR__ . '/header.php');
    ?>
    <!-- Barra de Gobierno (Gobar) -->
    <div class="bg-white border-bottom shadow-sm" style="height: 50px; z-index: 1050; position: relative;">
        <div class="container-fluid h-100 d-flex align-items-center px-4">
            <a href="https://www.gob.cl/" target="_blank">
                <img src="https://framework.digital.gob.cl/img/logogob.svg" alt="Gob.cl" height="32">
            </a>
            <div class="ml-auto d-none d-sm-flex align-items-center" style="gap: 1.5rem;">
                <a href="#" class="text-muted text-decoration-none font-weight-bold" style="font-size: 11px; letter-spacing: 0.05em;">Trámites</a>
                <a href="#" class="text-muted text-decoration-none font-weight-bold" style="font-size: 11px; letter-spacing: 0.05em;">Servicios</a>
                <a href="#" class="text-muted text-decoration-none font-weight-bold" style="font-size: 11px; letter-spacing: 0.05em;">Noticias</a>
            </div>
        </div>
    </div>

    <div class="wrapper-portal">
        <!-- Menú Lateral -->
        <div class="sidebar-portal">
            <?php include_once(__DIR__ . '/sidebar.php'); ?>
        </div>
        
        <!-- Contenido Principal -->
        <main class="main-portal">
            <!-- Cabecera del Portal -->
            <header class="bg-white border-bottom d-flex align-items-center justify-content-between px-4" style="height: 70px; border-bottom: 3px solid var(--gob-primary) !important; flex-shrink: 0; z-index: 10;">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link d-lg-none mr-2 p-0 text-dark sidebar-toggle">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <div class="d-flex flex-column">
                        <h1 class="h6 font-serif font-bold text-dark mb-0" style="letter-spacing: -0.01em;"><?php echo $page_title; ?></h1>
                        <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.15em; margin-top: 2px;">Municipio de Viña del Mar</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center" style="gap: 1rem;">
                    <div class="position-relative d-none d-lg-block">
                        <span class="material-symbols-outlined position-absolute" style="left: 12px; top: 8px; color: #94a3b8; font-size: 18px;">search</span>
                        <input type="text" placeholder="Buscar trámite o servicio..." class="form-control form-control-sm border bg-light px-5" style="border-radius: 20px; font-size: 11px; width: 240px; height: 36px;">
                    </div>
                    <div class="vr mx-2 bg-light d-none d-md-block" style="width: 1px; height: 24px;"></div>
                    <button class="btn btn-light btn-sm rounded-circle p-2 border-0 shadow-none position-relative">
                        <span class="material-symbols-outlined" style="font-size: 22px; color: #64748b;">notifications</span>
                        <span class="position-absolute bg-danger border border-white rounded-circle" style="top: 8px; right: 8px; width: 8px; height: 8px;"></span>
                    </button>
                </div>
            </header>

            <!-- Área de Contenido -->
            <div class="flex-grow-1 p-4">
                <div class="container-fluid pb-5 px-0">
                    <?php 
                    if (is_file($content_php)) {
                        include($content_php); 
                    } else {
                        echo $content_php;
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <script>
    $(document).ready(function() {
        $('.sidebar-toggle').on('click', function() {
            $('.sidebar-portal').toggleClass('show');
        });
    });
    </script>
    <?php
    include_once(__DIR__ . '/footer.php');
}
?>
