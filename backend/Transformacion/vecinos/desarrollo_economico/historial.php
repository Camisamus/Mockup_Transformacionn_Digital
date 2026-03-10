<?php
$pageTitle = "Historial de Participaciones";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';
?>

<style>
    .feria-card:hover { border-color: #006FB3 !important; box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; transform: translateY(-3px); }
    .status-badge { font-size: 0.6rem; font-weight: 700; padding: 4px 10px; border-radius: 9999px; letter-spacing: 0.5px; }
</style>

<div class="row g-4 mb-5">
    <!-- Header -->
    <div class="col-lg-12">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-end gap-4 mb-5">
            <div>
                <h1 class="h1 fw-black text-dark mb-1">Registro Histórico de Ferias</h1>
                <p class="text-muted mb-0 lead opacity-75">Consulta tus participaciones anteriores y evaluaciones completadas.</p>
            </div>
            <div class="bg-white border rounded-4 shadow-sm p-1 position-relative" style="min-width: 300px;">
                <span class="position-absolute start-0 top-50 translate-middle-y ps-3 text-muted">
                    <?php echo getIcon('search', '', ['width'=>16]); ?>
                </span>
                <input type="text" class="form-control border-0 bg-transparent py-2 ps-5 shadow-none" placeholder="Buscar feria por nombre...">
            </div>
        </div>

        <div class="vstack gap-4">
            <!-- Feria 1 -->
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden feria-card border-2">
                <div class="p-4 p-md-5 d-flex flex-column flex-md-row align-items-center gap-5">
                    <div class="rounded-4 overflow-hidden shadow-sm flex-shrink-0" style="width: 120px; height: 120px;">
                        <img alt="Feria" class="w-100 h-100 object-fit-cover grayscale opacity-75" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkQf-P-yq7EOXxtPMal5FVuuL3ws932lHvHEg1H_U24j1AAe7RYzXDfoRnD_nY8IPMd53fIhMSwyw0baqX4Y-e4GbjYyoiMgUO2ooXfWdKyI7e4ufwWwjHDHdMJNzd1zOyftq1hhEDhk2ObywD4FZZVB6FMtYAdXCuP-vhRNvIBgxCy7XGK6WzCVkEEPZVk8YS1N0ExTMyVJaCyvzBHUoQdZSF7m9c-yspmLrNr5oNOf65NLYMbFUcF0z2dLkOtE-EM7s3o_k-8MJK">
                    </div>
                    
                    <div class="flex-grow-1 text-center text-md-start">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-3">
                            <h4 class="h5 fw-black text-dark mb-0">Feria Primavera Plaza O'Higgins</h4>
                            <span class="status-badge bg-light text-muted uppercase">Finalizada</span>
                        </div>
                        
                        <div class="row g-4 text-start justify-content-center justify-content-md-start">
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-primary"><?php echo getIcon('map-pin', '', ['width'=>16]); ?></span>
                                <span class="small fw-bold text-muted">Plaza O'Higgins, Viña del Mar</span>
                            </div>
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-primary"><?php echo getIcon('calendar', '', ['width'=>16]); ?></span>
                                <span class="small fw-bold text-muted">10 - 13 de Octubre, 2023</span>
                            </div>
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-success"><?php echo getIcon('check-circle', '', ['width'=>16]); ?></span>
                                <span class="small fw-black text-success">Asistencia: 100% (4/4 días)</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 w-md-auto">
                        <a href="evaluar.php" class="btn btn-primary rounded-4 px-4 py-3 fw-black shadow-lg shadow-primary-500/10 d-flex align-items-center justify-content-center gap-2 border-0">
                            <?php echo getIcon('edit-3', 'text-white', ['width'=>18]); ?>
                            Evaluar Participación
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feria 2 -->
            <div class="card border-0 shadow-sm rounded-5 overflow-hidden feria-card border-2 opacity-75">
                <div class="p-4 p-md-5 d-flex flex-column flex-md-row align-items-center gap-5">
                    <div class="rounded-4 overflow-hidden shadow-sm flex-shrink-0" style="width: 120px; height: 120px;">
                        <img alt="Feria" class="w-100 h-100 object-fit-cover grayscale opacity-50 pe-none" src="https://lh3.googleusercontent.com/fife/ALs6D_H3p9v9R4R1S-L_P5C1oD4oH">
                    </div>
                    
                    <div class="flex-grow-1 text-center text-md-start">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-3">
                            <h4 class="h5 fw-black text-dark mb-0 opacity-75">Feria Artesanal Potrerillos</h4>
                            <span class="status-badge bg-light text-muted uppercase">Finalizada</span>
                        </div>
                        
                        <div class="row g-4 text-start justify-content-center justify-content-md-start opacity-75">
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-primary"><?php echo getIcon('map-pin', '', ['width'=>16]); ?></span>
                                <span class="small fw-bold text-muted">Parque Quinta Vergara</span>
                            </div>
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-primary"><?php echo getIcon('calendar', '', ['width'=>16]); ?></span>
                                <span class="small fw-bold text-muted">15 - 18 de Septiembre, 2023</span>
                            </div>
                            <div class="col-auto d-flex align-items-center gap-2">
                                <span class="text-success"><?php echo getIcon('check-circle', '', ['width'=>16]); ?></span>
                                <span class="small fw-black text-success">Asistencia: 100% (4/4 días)</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 w-md-auto text-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-4 px-4 py-2 fw-black small d-flex align-items-center justify-content-center gap-2 mb-1">
                            <?php echo getIcon('check', '', ['width'=>16]); ?> Ya Evaluado
                        </div>
                        <span class="text-uppercase text-muted fw-bold italic" style="font-size: 0.5rem; letter-spacing: 0.5px;">RÚBRICA COMPLETADA</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-5 pt-4">
            <nav class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-white border-light border-2 rounded-4 p-2 shadow-sm"><?php echo getIcon('chevron-left', '', ['width'=>18]); ?></button>
                <button class="btn btn-primary rounded-4 fw-black shadow-lg shadow-primary-500/10" style="width: 44px; height: 44px;">1</button>
                <button class="btn btn-white border-light border-2 rounded-4 fw-bold shadow-sm" style="width: 44px; height: 44px;">2</button>
                <button class="btn btn-white border-light border-2 rounded-4 p-2 shadow-sm"><?php echo getIcon('chevron-right', '', ['width'=>18]); ?></button>
            </nav>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
