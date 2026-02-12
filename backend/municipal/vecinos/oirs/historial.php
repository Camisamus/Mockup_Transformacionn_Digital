<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Historial de Solicitudes OIRS";

ob_start();
?>
<div class="row mb-5 align-items-center">
    <div class="col-md">
        <h2 class="h2 font-weight-bold text-dark mb-3 mb-md-0">Mi Historial OIRS</h2>
    </div>
    <div class="col-md-auto d-flex flex-wrap" style="gap: 1rem;">
        <div class="position-relative">
            <span class="material-symbols-outlined position-absolute" style="left: 12px; top: 10px; color: #94a3b8; font-size: 20px;">search</span>
            <input type="text" id="searchHistorial" placeholder="Buscar por código o tema..." class="form-control border shadow-sm pl-5" style="width: 280px; height: 45px; border-radius: 8px; font-size: 13px; font-weight: bold; padding-left: 40px !important;">
        </div>
        <button class="btn btn-white border shadow-sm d-flex align-items-center font-weight-bold text-uppercase" style="gap: 0.5rem; border-radius: 8px; font-size: 10px; letter-spacing: 0.1em; height: 45px; background: white;">
            <span class="material-symbols-outlined" style="font-size: 18px;">filter_alt</span>
            Filtrar
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr class="bg-light border-bottom">
                    <th class="px-4 py-3 border-0 text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.15em;">Código / Fecha</th>
                    <th class="px-4 py-3 border-0 text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.15em;">Temática / Problema</th>
                    <th class="px-4 py-3 border-0 text-muted font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.15em;">Estado</th>
                    <th class="px-4 py-3 border-0 text-muted font-weight-bold text-uppercase text-right" style="font-size: 10px; letter-spacing: 0.15em;">Acción</th>
                </tr>
            </thead>
            <tbody id="historialTable">
                <?php
                // Mock data para demostración unificada
                $items = [
                    ['id' => '4402', 'fecha' => '04 Feb 2026', 'tema' => 'Alumbrado Público', 'desc' => 'Poste sin luz en Calle Quillota #455...', 'estado' => 'En Revisión', 'color' => 'amber'],
                    ['id' => '4395', 'fecha' => '01 Feb 2026', 'tema' => 'Plan Regulador', 'desc' => 'Consulta sobre densificación sector bajo...', 'estado' => 'Respondida', 'color' => 'emerald'],
                    ['id' => '4210', 'fecha' => '20 Ene 2026', 'tema' => 'Aseo y Ornato', 'desc' => 'Retiro de microbasural en Quebrada Blanca.', 'estado' => 'Ejecutada', 'color' => 'primary']
                ];

                foreach($items as $item): 
                    $colorClass = $item['color'] === 'primary' ? 'primary' : ($item['color'] === 'amber' ? 'warning' : 'success');
                ?>
                <tr class="hover-bg-light transition-all cursor-pointer" onclick="window.location.href='detalle.php?id=<?php echo $item['id']; ?>'">
                    <td class="px-4 py-4">
                        <div class="d-flex flex-column">
                            <span class="text-primary font-weight-bold" style="font-size: 13px;">#OIRS-2026-<?php echo $item['id']; ?></span>
                            <span class="text-muted font-weight-bold mt-1" style="font-size: 10px;"><?php echo $item['fecha']; ?></span>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="d-flex flex-column" style="gap: 2px;">
                            <span class="font-weight-bold text-dark" style="font-size: 13px;"><?php echo $item['tema']; ?></span>
                            <p class="text-muted mb-0 text-truncate" style="font-size: 11px; max-width: 300px;"><?php echo $item['desc']; ?></p>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="badge badge-soft-<?php echo $colorClass; ?> font-weight-bold text-uppercase px-2 py-1" style="font-size: 9px; letter-spacing: 0.05em; border: 1px solid rgba(0,0,0,0.05);">
                            <?php echo $item['estado']; ?>
                        </span>
                    </td>
                    <td class="px-4 py-4 text-right">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted transition-all action-icon" style="width: 36px; height: 36px; border-radius: 8px;">
                            <span class="material-symbols-outlined" style="font-size: 18px;">visibility</span>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="p-4 border-top bg-light text-center">
             <button class="btn btn-link py-0 text-muted font-weight-bold text-uppercase d-flex align-items-center justify-content-center mx-auto" style="font-size: 10px; letter-spacing: 0.25em; text-decoration: none;">
                 Cargar solicitudes anteriores
                 <span class="material-symbols-outlined ml-2" style="font-size: 16px;">expand_more</span>
             </button>
        </div>
    </div>
</div>

<style>
.hover-bg-light:hover { background-color: rgba(248, 249, 250, 0.8) !important; }
.hover-bg-light:hover .action-icon { background-color: var(--gob-primary) !important; color: white !important; }
.transition-all { transition: all 0.2s ease-in-out; }
.cursor-pointer { cursor: pointer; }

.badge-soft-primary { background-color: rgba(0, 111, 179, 0.1); color: var(--gob-primary); }
.badge-soft-warning { background-color: rgba(255, 161, 27, 0.1); color: #856404; }
.badge-soft-success { background-color: rgba(45, 113, 124, 0.1); color: var(--gob-secondary); }
</style>

<script>
$(document).ready(function() {
    $('#searchHistorial').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("#historialTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
<?php
$content = ob_get_clean();
renderLayout($page_title, $content);
?>
