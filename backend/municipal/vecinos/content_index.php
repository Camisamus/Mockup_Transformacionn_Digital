<div class="row mb-4">
    <!-- Widgets de Resumen -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center" style="gap: 1rem;">
                <div class="bg-light p-3 rounded text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                    <span class="material-symbols-outlined" style="font-size: 24px;">mail</span>
                </div>
                <div class="d-flex flex-column">
                    <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em;">Nuevos Mensajes</small>
                    <h3 class="h4 font-weight-bold text-dark mb-0">02</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center" style="gap: 1rem;">
                <div class="bg-light p-3 rounded text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                    <span class="material-symbols-outlined" style="font-size: 24px;">pending_actions</span>
                </div>
                <div class="d-flex flex-column">
                    <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em;">En Trámite</small>
                    <h3 class="h4 font-weight-bold text-dark mb-0">03</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center" style="gap: 1rem;">
                <div class="bg-light p-3 rounded text-success d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                    <span class="material-symbols-outlined" style="font-size: 24px;">verified</span>
                </div>
                <div class="d-flex flex-column">
                    <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em;">Estado Vecino</small>
                    <span class="badge badge-success text-uppercase py-1" style="font-size: 9px; width: fit-content;">Verificado</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm stat-card">
            <div class="card-body d-flex align-items-center" style="gap: 1rem;">
                <div class="bg-light p-3 rounded text-danger d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                    <span class="material-symbols-outlined" style="font-size: 24px;">event</span>
                </div>
                <div class="d-flex flex-column">
                    <small class="text-muted text-uppercase font-weight-bold" style="font-size: 10px; letter-spacing: 0.1em;">Próxima Fecha</small>
                    <h3 class="h6 font-weight-bold text-dark mb-0 text-truncate">15 Mar 2026</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Seccion Bienvenida -->
        <div class="card border-0 bg-primary text-white shadow-sm mb-4" style="border-radius: 15px; overflow: hidden;">
            <div class="card-body p-4 p-md-5 position-relative" style="z-index: 1;">
                <div class="max-w-md">
                    <h2 class="h1 font-serif font-weight-bold mb-3">¡Hola, Rodrigo!</h2>
                    <p class="lead mb-0 opacity-80" style="font-size: 16px;">Bienvenido a tu portal de servicios. Revisa tus mensajes y accede rápidamente a tus trámites.</p>
                </div>
                <span class="material-symbols-outlined position-absolute" style="right: -40px; bottom: -40px; font-size: 200px; opacity: 0.05; pointer-events: none;">location_city</span>
            </div>
        </div>

        <!-- Tabla de Mensajería -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="h5 font-weight-bold text-dark mb-0 d-flex align-items-center" style="gap: 0.75rem;">
                        <span class="material-symbols-outlined text-primary">forum</span>
                        Bandeja de Mensajes
                    </h3>
                    <a href="mensajes/index.php" class="small font-weight-bold text-primary text-decoration-none">Ver todos</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-muted text-uppercase py-2" style="font-size: 10px; letter-spacing: 0.05em;">Remitente</th>
                                <th class="border-0 text-muted text-uppercase py-2" style="font-size: 10px; letter-spacing: 0.05em;">Asunto</th>
                                <th class="border-0 text-muted text-uppercase py-2 text-right" style="font-size: 10px; letter-spacing: 0.05em;">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3">
                                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded" style="width: 32px; height: 32px; font-size: 10px; font-weight: 800;">M</div>
                                        <span class="font-weight-bold text-dark" style="font-size: 13px;">Municipio</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted" style="font-size: 13px;">Confirmación de Reserva #554</span>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="text-muted font-weight-bold" style="font-size: 11px;">Hoy, 09:30</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-3">
                                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                        <div class="bg-warning text-white d-flex align-items-center justify-content-center rounded" style="width: 32px; height: 32px; font-size: 10px; font-weight: 800;">O</div>
                                        <span class="font-weight-bold text-dark" style="font-size: 13px;">OIRS</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted" style="font-size: 13px;">Respuesta Solicitud Alumbrado</span>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="text-muted font-weight-bold" style="font-size: 11px;">Ayer, 16:15</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Trámites Disponibles -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h3 class="h6 font-weight-bold text-dark mb-4">Trámites Disponibles</h3>
                <div class="d-flex flex-column" style="gap: 0.75rem;">
                    <a href="oirs/index.php" class="d-flex align-items-center p-3 border rounded text-decoration-none bg-light hover-bg-primary transition-all shadow-none" style="gap: 1rem;">
                        <div class="bg-white p-2 rounded text-primary d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <span class="material-symbols-outlined">contact_support</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark mb-0" style="font-size: 13px;">OIRS</span>
                            <small class="text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">Consultas y Reclamos</small>
                        </div>
                    </a>

                    <a href="licencias/index.php" class="d-flex align-items-center p-3 border rounded text-decoration-none bg-light hover-bg-primary transition-all shadow-none" style="gap: 1rem;">
                        <div class="bg-white p-2 rounded text-primary d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <span class="material-symbols-outlined">license</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark mb-0" style="font-size: 13px;">Licencia de Conducir</span>
                            <small class="text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">Reservas y Pagos</small>
                        </div>
                    </a>

                    <a href="emprendimiento/index.php" class="d-flex align-items-center p-3 border rounded text-decoration-none bg-light hover-bg-primary transition-all shadow-none" style="gap: 1rem;">
                        <div class="bg-white p-2 rounded text-primary d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <span class="material-symbols-outlined">storefront</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark mb-0" style="font-size: 13px;">Emprendimiento</span>
                            <small class="text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">Reserva de Plazas</small>
                        </div>
                    </a>

                    <a href="organizaciones/index.php" class="d-flex align-items-center p-3 border rounded text-decoration-none bg-light hover-bg-primary transition-all shadow-none" style="gap: 1rem;">
                        <div class="bg-white p-2 rounded text-primary d-flex align-items-center justify-content-center border" style="width: 40px; height: 40px; flex-shrink: 0;">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="font-weight-bold text-dark mb-0" style="font-size: 13px;">Org. Territoriales</span>
                            <small class="text-muted text-uppercase" style="font-size: 9px; letter-spacing: 0.05em;">Acreditaciones</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Ayuda IA -->
        <div class="card border-0 bg-dark text-white shadow-sm mb-4" style="border-radius: 15px; background: #1a1a1a !important;">
            <div class="card-body p-4 text-center position-relative overflow-hidden">
                <div class="position-relative" style="z-index: 1;">
                    <div class="bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow" style="width: 50px; height: 50px;">
                        <span class="material-symbols-outlined" style="font-size: 28px;">smart_toy</span>
                    </div>
                    <h4 class="h6 font-weight-bold mb-1">Asistente Ciudadano</h4>
                    <p class="small text-muted mb-4">¿Dudas con algún trámite? Pregúntame.</p>
                    <a href="orientacion/index.php" class="btn btn-white btn-block text-dark font-weight-bold shadow-sm" style="background: white; border-radius: 10px;">Iniciar Chat</a>
                </div>
                <div class="position-absolute" style="top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(0, 111, 179, 0.2); filter: blur(30px); border-radius: 50%;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg-primary:hover {
        background-color: var(--gob-primary) !important;
        border-color: var(--gob-primary) !important;
    }
    .hover-bg-primary:hover span, 
    .hover-bg-primary:hover small {
        color: white !important;
    }
    .hover-bg-primary:hover .bg-white {
        background-color: rgba(255,255,255,0.2) !important;
        border-color: transparent !important;
        color: white !important;
    }
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    .opacity-80 { opacity: 0.8; }
</style>
