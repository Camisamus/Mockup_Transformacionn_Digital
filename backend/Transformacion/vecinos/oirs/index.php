<?php
$pageTitle = "Mis Solicitudes OIRS";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';

// Obtener datos iniciales mediante PHP para cargar rápido
use App\Controllers\oirs_solicitudcontroller;
$solicitudCtrl = new oirs_solicitudcontroller($db);
$resumen = $solicitudCtrl->getSummaryByContribuyente($_SESSION['vecino_id'])['data'] ?? [];
$solicitudes = $solicitudCtrl->getByContribuyente($_SESSION['vecino_id'])['data'] ?? [];
?>

<style>
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0, 111, 179, 0.1) !important;
        border-color: #006FB3 !important;
    }
    .status-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .icon-box-large {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .table-custom thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.8px;
        color: #64748b;
        border: none;
        padding: 18px 20px;
    }
    .table-custom tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-action:hover {
        background-color: #006FB3;
        color: white !important;
    }
</style>

<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="bg-white rounded-4 shadow-sm border p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
            <div>
                <h1 class="h2 fw-bold text-dark mb-2">¡Hola, <?= htmlspecialchars($_SESSION['vecino_nombre']) ?>!</h1>
                <p class="text-muted mb-0">Bienvenido a tu portal de solicitudes OIRS. Aquí puedes gestionar todos tus requerimientos municipales.</p>
            </div>
            <div class="flex-shrink-0">
                <a href="nuevo.php" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg d-flex align-items-center gap-2">
                    <?= getIcon('plus', '', ['width' => 20, 'height' => 20]) ?>
                    NUEVA SOLICITUD
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 24px;">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="icon-box-large bg-primary bg-opacity-10 text-primary">
                    <?= getIcon('list', '', ['width' => 32, 'height' => 32]) ?>
                </div>
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem;">Total Ingresos</p>
                    <h3 class="fw-bold mb-0"><?= $resumen['total'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 24px;">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="icon-box-large bg-warning bg-opacity-10 text-warning">
                    <?= getIcon('clock', '', ['width' => 32, 'height' => 32]) ?>
                </div>
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem;">En Proceso</p>
                    <h3 class="fw-bold mb-0"><?= $resumen['pendientes'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 24px;">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div class="icon-box-large bg-success bg-opacity-10 text-success">
                    <?= getIcon('check-circle', '', ['width' => 32, 'height' => 32]) ?>
                </div>
                <div>
                    <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem;">Finalizadas</p>
                    <h3 class="fw-bold mb-0"><?= ($resumen['finalizadas'] ?? 0) + ($resumen['cerradas'] ?? 0) ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 24px;">
    <div class="card-header bg-transparent border-0 pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Cronología de mis Solicitudes</h5>
            <div class="dropdown">
                <button class="btn btn-light btn-sm rounded-pill px-3 border shadow-none" data-bs-toggle="dropdown">
                    Filtrar Todo <?= getIcon('chevron-down', 'ms-1', ['width' => 14, 'height' => 14]) ?>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Folio</th>
                        <th>Temática</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($solicitudes)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="opacity-50 mb-3"><?= getIcon('file-text', '', ['width' => 48, 'height' => 48]) ?></div>
                                <p class="text-muted">Aún no has ingresado solicitudes OIRS.</p>
                                <a href="nuevo.php" class="btn btn-outline-primary rounded-pill px-4">Ingresar mi primera solicitud</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($solicitudes as $s): ?>
                            <?php 
                                $statusClass = 'bg-secondary';
                                $statusText = 'Recibida';
                                switch($s['oirs_estado']){
                                    case 0: $statusClass = 'bg-secondary text-white'; $statusText = 'Enviada'; break;
                                    case 1: $statusClass = 'bg-info text-white'; $statusText = 'Recibida'; break;
                                    case 2: $statusClass = 'bg-warning text-dark'; $statusText = 'En Proceso'; break;
                                    case 4: $statusClass = 'bg-success text-white'; $statusText = 'Finalizada'; break;
                                    case 5: $statusClass = 'bg-dark text-white'; $statusText = 'Cerrada'; break;
                                }
                            ?>
                            <tr>
                                <td>
                                    <span class="d-block fw-bold text-dark"><?= date('d/m/Y', strtotime($s['rgt_creacion'])) ?></span>
                                    <span class="small text-muted"><?= date('H:i', strtotime($s['rgt_creacion'])) ?> hrs</span>
                                </td>
                                <td>
                                    <span class="text-primary fw-bold"><?= $s['rgt_id_publica'] ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-light text-primary border-primary rounded-3"><?= $s['tem_nombre'] ?></span>
                                </td>
                                <td>
                                    <p class="mb-0 text-truncate small" style="max-width: 250px;" title="<?= $s['oirs_descripcion'] ?>">
                                        <?= $s['oirs_descripcion'] ?>
                                    </p>
                                </td>
                                <td>
                                    <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="ver.php?id=<?= $s['oirs_id'] ?>" class="btn-action text-primary bg-primary bg-opacity-10" title="Ver Detalle">
                                        <?= getIcon('eye', '', ['width' => 16, 'height' => 16]) ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>