<?php
include("../../include/header-funcionarios.php");

$id = isset($_GET['id']) ? $_GET['id'] : '001';
$nombre = "Proyecto " . str_pad($id, 3, '0', STR_PAD_LEFT) . ": Mejoramiento Seccional Parque Sausalito";
?>

    <!-- Cabecera de Página -->
    <header class="bg-white border-bottom shadow-sm px-4 d-flex align-items-center justify-content-between" style="height: 80px; border-bottom-width: 4px !important; border-bottom-color: var(--gob-primary) !important; flex-shrink: 0; z-index: 10;">
        <div class="d-flex align-items-center" style="gap: 1.5rem;">
            <a href="index.php" class="p-2 text-muted hover-bg-light transition-all rounded-circle d-flex align-items-center justify-content-center" style="text-decoration: none;">
                <span class="material-symbols-outlined font-weight-bold">arrow_back</span>
            </a>
            <button class="btn btn-link d-lg-none p-0 text-dark sidebar-toggle mr-3 shadow-none">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="d-flex flex-column">
                <h2 class="h5 font-serif font-bold text-dark mb-0"><?php echo $nombre; ?></h2>
                <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 0.1em; margin-top: 4px;">Ficha Técnica de Iniciativa Territorial</p>
            </div>
        </div>
        <div class="d-flex align-items-center" style="gap: 1rem;">
             <button class="btn btn-outline-dark font-weight-bold py-2 px-4" style="font-size: 11px; letter-spacing: 0.1em; border-radius: 0; border-width: 2px;">EDITAR FICHA</button>
             <button class="btn btn-primary font-weight-bold py-2 px-4 shadow-sm" style="font-size: 11px; letter-spacing: 0.1em; border-radius: 0;">PRIORIZAR</button>
        </div>
    </header>

    <div class="flex-grow-1 overflow-auto p-4 p-md-5" style="background-color: var(--gob-bg);">
        <div class="container-fluid">
            <div class="row" style="gap: 2rem;">
                
                <!-- Columna Principal: Info Técnica -->
                <div class="col-lg-8" style="gap: 2rem; display: flex; flex-direction: column;">
                    <!-- Card General -->
                    <div class="bg-white border shadow-sm p-4 p-md-5" style="border-radius: 0;">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5 border-bottom pb-5" style="gap: 2rem;">
                            <div class="d-flex align-items-center" style="gap: 1.5rem;">
                                <div class="bg-light border border-primary d-flex align-items-center justify-content-center text-primary" style="width: 80px; height: 80px; border-width: 2px !important;">
                                    <span class="material-symbols-outlined" style="font-size: 40px;">engineering</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.15em;">Estado Administrativo</span>
                                    <span class="h4 font-serif font-bold text-dark mb-0">Evaluación Técnica de Factibilidad</span>
                                </div>
                            </div>
                            <div class="text-md-right">
                                <p class="text-muted font-weight-bold text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.15em;">Presupuesto Estimado 2026</p>
                                <h4 class="h2 font-serif font-bold text-primary mb-0">$450.000.000</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-3 mb-4">
                                 <p class="text-muted font-weight-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 0.1em;">Categoría</p>
                                 <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                     <span class="material-symbols-outlined text-primary" style="font-size: 20px;">park</span>
                                     <span class="font-weight-bold text-dark" style="font-size: 13px;">Infraestructura</span>
                                 </div>
                            </div>
                            <div class="col-6 col-md-3 mb-4">
                                 <p class="text-muted font-weight-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 0.1em;">Unidad técnica</p>
                                 <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                     <span class="material-symbols-outlined text-primary" style="font-size: 20px;">account_balance</span>
                                     <span class="font-weight-bold text-dark" style="font-size: 13px;">SECPLA</span>
                                 </div>
                            </div>
                            <div class="col-6 col-md-3 mb-4">
                                 <p class="text-muted font-weight-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 0.1em;">Población Objetivo</p>
                                 <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                     <span class="material-symbols-outlined text-primary" style="font-size: 20px;">diversity_3</span>
                                     <span class="font-weight-bold text-dark" style="font-size: 13px;">Vecinos Sector</span>
                                 </div>
                            </div>
                            <div class="col-6 col-md-3 mb-4">
                                 <p class="text-muted font-weight-bold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 0.1em;">Prioridad</p>
                                 <div class="d-flex align-items-center" style="gap: 0.75rem;">
                                     <span class="material-symbols-outlined text-primary" style="font-size: 20px;">how_to_vote</span>
                                     <span class="font-weight-bold text-dark" style="font-size: 13px;">8 / 10 Votos</span>
                                 </div>
                            </div>
                        </div>

                        <div class="pt-4 border-top mt-4">
                            <h4 class="font-weight-bold text-dark text-uppercase d-flex align-items-center mb-4" style="font-size: 11px; letter-spacing: 0.2em; gap: 1rem;">
                                <span class="bg-dark text-white d-flex align-items-center justify-content-center font-weight-bold" style="width: 24px; height: 24px; font-size: 10px;">i</span>
                                Resumen Ejecutivo
                            </h4>
                            <p class="text-muted font-weight-medium mb-0" style="font-size: 14px; line-height: 1.8;">
                                Este proyecto contempla la intervención integral del sector oriente del Parque Sausalito, incluyendo la reposición de senderos peatonales, instalación de mobiliario urbano sostenible (bancas de madera certificada), y sistema de iluminación solar LED con sensores de movimiento. El objetivo es mejorar la seguridad del parque durante las horas vespertinas y fomentar el uso recreativo local.
                            </p>
                        </div>
                    </div>

                    <!-- Documentación -->
                    <div class="bg-white border shadow-sm p-4 p-md-5" style="border-radius: 0;">
                        <h4 class="font-weight-bold text-dark text-uppercase d-flex align-items-center mb-5" style="font-size: 11px; letter-spacing: 0.2em; gap: 1rem;">
                            <span class="material-symbols-outlined text-primary">imagesmode</span>
                            Documentación y Antecedentes Visuales
                        </h4>
                        <div class="row" style="gap: 1.5rem; margin: 0;">
                            <div class="col-md col-6 p-0 border position-relative overflow-hidden cursor-zoom-in project-img-container" style="aspect-ratio: 16/10;">
                                <img src="https://images.unsplash.com/photo-1542451313056-b7c8e626645f?auto=format&fit=crop&w=400&h=300" class="w-100 h-100 object-cover shadow-hover transition-all">
                            </div>
                            <div class="col-md col-6 p-0 border bg-light d-flex flex-column align-items-center justify-content-center text-center p-3" style="aspect-ratio: 16/10; gap: 0.75rem; border-style: dashed !important;">
                                 <span class="material-symbols-outlined text-muted" style="font-size: 32px;">picture_as_pdf</span>
                                 <span class="text-muted font-weight-bold text-uppercase" style="font-size: 9px; letter-spacing: 0.1em; line-height: 1.4;">PLANOS_<br>ESTRUCTURA.PDF</span>
                            </div>
                            <div class="col-md col-12 p-0 border bg-light d-flex flex-column align-items-center justify-content-center text-center p-3 group cursor-pointer hover-bg-white transition-all shadow-hover" style="aspect-ratio: 16/10; gap: 0.75rem; border-style: dashed !important;">
                                 <span class="material-symbols-outlined text-muted group-hover-primary" style="font-size: 32px;">add_photo_alternate</span>
                                 <span class="text-muted font-weight-bold text-uppercase" style="font-size: 9px; letter-spacing: 0.1em;">CARGAR ARCHIVO</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Lateral: Mapa y QR -->
                <aside class="col-lg-4" style="gap: 2rem; display: flex; flex-direction: column;">
                    <!-- QR de Acceso Público -->
                    <div class="bg-dark p-5 text-white shadow-sm text-center" style="border-bottom: 8px solid var(--gob-primary); border-radius: 0;">
                        <div class="bg-white p-3 border border-light mx-auto mb-4" style="width: 192px; height: 192px; border-width: 4px !important;">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=http://localhost/municipal/funcionarios/proyectos/votar.php?id=<?php echo $id; ?>" class="w-100 h-100">
                        </div>
                        <h4 class="h5 font-serif font-bold text-white mb-2">Acceso a Votación</h4>
                        <p class="text-light opacity-50 font-weight-bold text-uppercase mb-4" style="font-size: 10px; letter-spacing: 0.2em; line-height: 1.6;">Código oficial para recepción de preferencias ciudadanas en terreno</p>
                        <button onclick="window.print()" class="btn btn-outline-light w-100 py-3 font-weight-bold text-uppercase d-flex align-items-center justify-content-center" style="border-radius: 0; font-size: 11px; letter-spacing: 0.1em; gap: 0.75rem;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">print</span>
                            IMPRIMIR PAPELETA
                        </button>
                    </div>

                    <!-- Ubicación Geográfica -->
                    <div class="bg-white border p-4 p-md-5 shadow-sm" style="border-radius: 0;">
                        <h4 class="font-weight-bold text-dark text-uppercase mb-4" style="font-size: 11px; letter-spacing: 0.15em;">Georreferenciación</h4>
                        <div class="w-100 mb-4 position-relative overflow-hidden border" style="height: 220px;">
                             <img src="https://maps.googleapis.com/maps/api/staticmap?center=-33.0245,-71.5518&zoom=15&size=400x250&key=YOUR_KEY" class="w-100 h-100 object-cover" style="filter: grayscale(1); opacity: 0.6;">
                             <div class="position-absolute h-100 w-100 d-flex align-items-center justify-content-center" style="top: 0; left: 0;">
                                 <div class="bg-primary border border-white shadow-lg" style="width: 32px; height: 32px; border-width: 4px !important; border-radius: 0;"></div>
                             </div>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="font-weight-bold text-dark text-uppercase mb-1" style="font-size: 11px; letter-spacing: -0.02em;">Sector Sausalito Oriente - Lote A-2</p>
                            <p class="text-muted font-weight-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 0.1em;">Viña del Mar, Chile</p>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>

<style>
.shadow-hover:hover { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important; }
.hover-bg-white:hover { background-color: #fff !important; border-color: var(--gob-primary) !important; }
.hover-bg-white:hover .group-hover-primary { color: var(--gob-primary) !important; }
.object-cover { object-fit: cover; }
.transition-all { transition: all 0.2s ease-in-out; }
.cursor-zoom-in { cursor: zoom-in; }
</style>

<?php include("../../include/footer-funcionarios.php"); ?>
