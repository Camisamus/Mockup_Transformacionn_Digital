<?php
$current_url = $_SERVER['REQUEST_URI'];
?>
<aside class="bg-white d-flex flex-column h-100 shadow-sm border-right w-100" style="z-index: 20;">
    <div class="p-4 d-flex flex-column" style="gap: 2rem; height: 100%;">
        <!-- Brand/Logo -->
        <div class="d-flex align-items-center pb-3 border-bottom" style="gap: 1rem;">
            <div class="d-flex flex-column">
                <h2 class="h6 font-serif font-bold text-dark text-uppercase mb-0" style="letter-spacing: -0.01em; line-height: 1;">Portal Ciudadano</h2>
                <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 9px; letter-spacing: 0.2em; margin-top: 6px; text-decoration: underline; text-underline-offset: 4px;">Versión 2.0</p>
            </div>
        </div>

        <!-- Navegación -->
        <ul class="nav nav-pills flex-column flex-grow-1 overflow-auto custom-scrollbar" style="gap: 2px;">
            <li class="px-3 mb-2 mt-2">
                <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">General</small>
            </li>
            
            <li class="nav-item">
                <a href="/municipal/vecinos/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'index.php') !== false && strpos($_SERVER['PHP_SELF'], 'vecinos') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Panel de Control</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/orientacion/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'orientacion') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">smart_toy</span>
                    <span>Orientación IA</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <small class="px-3 mb-2 text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Servicios Municipales</small>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/oirs/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'oirs') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">contact_support</span>
                    <span>OIRS Digital</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/licencias/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'licencias') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">license</span>
                    <span>Licencias</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/emprendimiento/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'emprendimiento') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">storefront</span>
                    <span>Ferias y Emprendo</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/organizaciones/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'organizaciones') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">groups</span>
                    <span>Organizaciones</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <small class="px-3 mb-2 text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em; opacity: 0.7;">Mi Espacio</small>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/mensajes/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'mensajes') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">mail</span>
                    <span>Mensajería</span>
                    <span class="badge badge-danger ml-auto" style="font-size: 9px; padding: 0.35em 0.65em;">2</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/municipal/vecinos/perfil/index.php" class="nav-link <?php echo (strpos($_SERVER['PHP_SELF'], 'perfil') !== false) ? 'active' : ''; ?>">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span>Mi Perfil</span>
                </a>
            </li>
        </ul>

        <!-- User Profile Mini -->
        <div class="mt-auto pt-3 border-top d-flex align-items-center" style="gap: 0.75rem;">
            <div class="d-flex align-items-center justify-content-center bg-light border font-weight-bold text-primary" style="width: 36px; height: 36px; font-size: 12px;">RV</div>
            <div class="d-flex flex-column overflow-hidden">
                <span class="text-dark font-weight-bold text-truncate" style="font-size: 11px;">Rodrigo Valdés</span>
                <span class="text-primary font-weight-bold text-uppercase" style="font-size: 9px;">Verificado</span>
            </div>
            <button class="btn btn-link p-1 py-0 ml-auto text-muted shadow-none">
                <span class="material-symbols-outlined" style="font-size: 18px;">logout</span>
            </button>
        </div>
    </div>
</aside>
