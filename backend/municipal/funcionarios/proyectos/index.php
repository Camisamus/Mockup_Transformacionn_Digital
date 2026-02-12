<?php
include("../../include/header-funcionarios.php");

// Mock Data: 200 Proyectos (Generamos unos cuantos detallados y el resto genéricos)
$proyectos = [];
$tipos = ['Infraestructura', 'Social', 'Salud', 'Educación', 'Seguridad'];
$estados = ['Pendiente', 'Evaluado', 'Priorizado'];
$colores = ['Pendiente' => 'bg-amber-100 text-amber-600', 'Evaluado' => 'bg-blue-100 text-blue-600', 'Priorizado' => 'bg-emerald-100 text-emerald-600'];

for ($i = 1; $i <= 200; $i++) {
    $proyectos[] = [
        'id' => $i,
        'nombre' => "Proyecto " . str_pad($i, 3, '0', STR_PAD_LEFT) . ": " . ($i % 2 == 0 ? "Mejoramiento Seccional" : "Ampliación de Cobertura"),
        'tipo' => $tipos[array_rand($tipos)],
        'presupuesto' => rand(10, 500) . " Millones",
        'estado' => $estados[array_rand($estados)],
        'lat' => -33.0245 + (rand(-100, 100) / 1000),
        'lng' => -71.5518 + (rand(-100, 100) / 1000),
        'votos' => rand(0, 10)
    ];
}

// Estadísticas
$votos_totales = array_sum(array_column($proyectos, 'votos'));
$quienes_votaron = ["Juan Pérez", "María Soto", "Carlos Díaz", "Ana Morales", "Roberto Jara"]; // 5 de 10
?>

    <!-- Cabecera de Página -->
    <header class="bg-white border-bottom shadow-sm px-4 d-flex align-items-center justify-content-between" style="height: 80px; border-bottom-width: 4px !important; border-bottom-color: var(--gob-primary) !important; flex-shrink: 0; z-index: 10;">
        <div class="d-flex align-items-center" style="gap: 1.5rem;">
            <button class="btn btn-link d-lg-none p-0 text-dark sidebar-toggle mr-2">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="d-flex flex-column">
                <h2 class="h5 font-serif font-bold text-dark mb-0">Priorización de Proyectos 2026</h2>
                <p class="text-primary font-weight-bold text-uppercase mb-0" style="font-size: 10px; letter-spacing: 0.1em; margin-top: 4px;">Panel de Gestión Municipal</p>
            </div>
        </div>
        <div class="d-flex align-items-center" style="gap: 2rem;">
            <div class="d-flex align-items-center" style="gap: 0.75rem;">
                <div class="d-flex" style="margin-left: 0.5rem;">
                    <?php foreach ($quienes_votaron as $nombre): ?>
                        <div class="rounded-circle bg-light border border-white d-flex align-items-center justify-content-center font-weight-bold text-muted shadow-sm" style="width: 32px; height: 32px; font-size: 10px; margin-left: -8px;" title="<?php echo $nombre; ?>">
                            <?php echo substr($nombre, 0, 1); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em;">Participación: 5/10</span>
            </div>
            <a href="votar.php" class="btn btn-primary font-weight-bold py-2 px-4 shadow-sm" style="font-size: 11px; letter-spacing: 0.1em; border-radius: 0;">ACCESO VOTACIÓN</a>
        </div>
    </header>

    <div class="d-flex flex-grow-1 overflow-hidden">
        <!-- Panel Izquierdo: Lista de Proyectos -->
        <aside class="bg-white border-right d-flex flex-column shadow-sm" style="width: 400px; flex-shrink: 0;">
            <div class="p-4 border-bottom">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="font-weight-bold text-dark text-uppercase mb-0" style="font-size: 11px; letter-spacing: 0.15em;">Listado de Iniciativas</h3>
                    <span class="badge badge-light border text-muted px-2 py-1" style="font-size: 9px; font-weight: bold; border-radius: 0;"><?php echo count($proyectos); ?> TOTAL</span>
                </div>
                <div class="position-relative">
                    <span class="material-symbols-outlined position-absolute" style="left: 12px; top: 10px; color: #94a3b8; font-size: 18px;">search</span>
                    <input type="text" placeholder="Buscar por nombre o ID..." class="form-control form-control-sm border-2 bg-light shadow-none" style="padding-left: 40px; border-radius: 2px; font-size: 12px; height: 38px;">
                </div>
            </div>
            
            <div class="flex-grow-1 overflow-auto custom-scrollbar">
                <div class="list-group list-group-flush">
                    <?php foreach ($proyectos as $p): ?>
                        <div class="list-group-item list-group-item-action border-0 p-4 border-bottom project-card cursor-pointer transition-all">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="text-muted font-weight-bold text-uppercase" style="font-size: 9px; letter-spacing: 0.2em;">ID: #<?php echo str_pad($p['id'], 3, '0', STR_PAD_LEFT); ?></span>
                                <span class="badge px-2 py-1 font-weight-bold text-uppercase" style="font-size: 8px; letter-spacing: 0.1em; border-radius: 0; border: 1px solid currentColor; <?php 
                                    echo ($p['estado'] == 'Pendiente') ? 'color: #856404; background-color: #FFF3CD;' : 
                                         (($p['estado'] == 'Evaluado') ? 'color: var(--gob-primary); background-color: rgba(0,111,179,0.05); border-color: var(--gob-primary);' : 
                                         'color: #155724; background-color: #D4EDDA;'); ?>">
                                    <?php echo $p['estado']; ?>
                                </span>
                            </div>
                            <h4 class="h6 font-weight-bold text-dark mb-3 leading-snug project-title transition-all"><?php echo $p['nombre']; ?></h4>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                    <span class="material-symbols-outlined text-muted" style="font-size: 16px;">payments</span>
                                    <span class="text-muted font-weight-bold text-uppercase" style="font-size: 10px;"><?php echo $p['presupuesto']; ?></span>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                    <span class="material-symbols-outlined text-primary font-weight-bold" style="font-size: 16px;">how_to_vote</span>
                                    <span class="text-primary font-weight-bold text-uppercase" style="font-size: 10px;"><?php echo $p['votos']; ?> Votos</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>

        <!-- Panel Derecho: Mapa y Resumen -->
        <section class="flex-grow-1 d-flex flex-column overflow-hidden" style="background-color: var(--gob-bg);">
            <!-- Widgets Superiores -->
            <div class="p-4 row m-0" style="gap: 1.5rem; flex-shrink: 0;">
                <div class="col bg-white p-4 border shadow-sm d-flex align-items-center m-0" style="gap: 1.5rem; border-radius: 0;">
                    <div class="bg-primary text-white d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; border-radius: 2px;">
                        <span class="material-symbols-outlined" style="font-size: 32px;">trending_up</span>
                    </div>
                    <div>
                        <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Total Votación</p>
                        <h5 class="h4 font-serif font-bold text-dark mb-0"><?php echo $votos_totales; ?></h5>
                    </div>
                </div>
                <div class="col bg-white p-4 border shadow-sm d-flex align-items-center m-0" style="gap: 1.5rem; border-radius: 0;">
                    <div class="bg-success text-white d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; border-radius: 2px;">
                        <span class="material-symbols-outlined" style="font-size: 32px;">check_circle</span>
                    </div>
                    <div>
                        <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Priorizados</p>
                        <h5 class="h4 font-serif font-bold text-dark mb-0">12</h5>
                    </div>
                </div>
                <div class="col bg-white p-4 border shadow-sm d-flex align-items-center m-0" style="gap: 1.5rem; border-radius: 0;">
                    <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; border-radius: 2px;">
                        <span class="material-symbols-outlined" style="font-size: 32px;">map</span>
                    </div>
                    <div>
                        <p class="text-muted font-weight-bold text-uppercase mb-1" style="font-size: 10px; letter-spacing: 0.1em;">Sectores</p>
                        <h5 class="h4 font-serif font-bold text-dark mb-0">8</h5>
                    </div>
                </div>
            </div>

            <!-- Mapa -->
            <div class="flex-grow-1 p-4 pt-0">
                <div class="w-100 h-100 bg-white border shadow-sm position-relative overflow-hidden" style="border-radius: 0;">
                    <!-- Simulación de Mapa Institucional -->
                    <div class="position-absolute h-100 w-100" style="background-color: #E5E7EB; opacity: 0.5;"></div>
                    <div class="position-absolute h-100 w-100 d-flex align-items-center justify-content-center">
                        <div class="text-center" style="max-width: 480px; padding: 2rem;">
                            <span class="material-symbols-outlined text-muted mb-3" style="font-size: 64px;">public</span>
                            <h4 class="h5 font-serif font-bold text-dark mb-3">Capa de Geoprocesamiento Institucional</h4>
                            <p class="text-muted mb-4" style="font-size: 13px; line-height: 1.6;">Visualización de los 200 proyectos territoriales bajo norma de planificación zonal 2026.</p>
                            <button class="btn btn-dark px-5 py-3 font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.2em; border-radius: 0;">VER CAPAS TÉCNICAS</button>
                        </div>
                    </div>

                    <!-- Marcadores -->
                    <div class="position-absolute bg-primary border border-white shadow" style="top: 25%; left: 33%; width: 20px; height: 20px; border-radius: 50%; border-width: 3px !important; z-index: 5;"></div>
                    <div class="position-absolute bg-success border border-white shadow" style="top: 50%; left: 50%; width: 16px; height: 16px; border-radius: 50%; border-width: 2px !important; z-index: 5;"></div>
                    <div class="position-absolute bg-warning border border-white shadow" style="bottom: 33%; right: 25%; width: 16px; height: 16px; border-radius: 50%; border-width: 2px !important; z-index: 5;"></div>
                </div>
            </div>
        </section>
    </div>

<style>
.project-card:hover { border-left: 4px solid var(--gob-primary) !important; background-color: #f8f9fa !important; }
.project-card:hover .project-title { color: var(--gob-primary) !important; }
.transition-all { transition: all 0.2s ease-in-out; }
.cursor-pointer { cursor: pointer; }

/* Reemplazo de Tailwind @apply */
.btn-primary { 
    background-color: var(--gob-primary) !important; 
    color: white !important; 
    border: none !important; 
    border-radius: 4px !important; 
}
.btn-primary:hover { 
    background-color: #005a91 !important; 
}

.btn-dark { 
    background-color: #334155 !important; 
    color: white !important; 
    border: none !important; 
    border-radius: 4px !important; 
}
.btn-dark:hover { 
    background-color: #1e293b !important; 
}

.stat-card { 
    background: white; 
    padding: 1.5rem; 
    border-radius: 8px; 
    border: 1px solid #dbe0e6; 
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); 
}

/* Badge colors without tailwind */
.bg-amber-100 { background-color: #fef3c7 !important; }
.text-amber-600 { color: #d97706 !important; }
.bg-blue-100 { background-color: #dbeafe !important; }
.text-blue-600 { color: #2563eb !important; }
.bg-emerald-100 { background-color: #d1fae5 !important; }
.text-emerald-600 { color: #059669 !important; }
</style>

<?php include("../../include/footer-funcionarios.php"); ?>
