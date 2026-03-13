<?php
$pageTitle = "Detalle Solicitud OIRS";
$pathPrefix = "../../"; 
require_once '../../apivec/general/auth_check_vecinos.php';
require_once '../../apivec/general/layout_functions.php';
include '../../apivec/general/header.php';

$oirsId = $_GET['id'] ?? null;

if (!$oirsId) {
    header('Location: index.php');
    exit;
}

use App\Controllers\oirs_solicitudcontroller;
$solicitudCtrl = new oirs_solicitudcontroller($db);
$result = $solicitudCtrl->getById($oirsId);

if ($result['status'] === 'error') {
    echo "<div class='alert alert-danger'>Solicitud no encontrada o no permitida.</div>";
    include '../../apivec/general/footer.php';
    exit;
}

$oirs = $result['data'];

// Verificar que pertenece al contribuyente logueado
if ($oirs['oirs_propietario'] != $_SESSION['vecino_id'] && $oirs['rgt_contribuyente'] != $_SESSION['vecino_id']) {
   echo "<div class='alert alert-danger'>No tiene acceso a esta solicitud.</div>";
   include '../../apivec/general/footer.php';
   exit;
}

$statusMap = [
    0 => ['label' => 'Enviada', 'class' => 'bg-secondary text-white'],
    1 => ['label' => 'Recibida', 'class' => 'bg-info text-white'],
    2 => ['label' => 'En Proceso', 'class' => 'bg-warning text-dark'],
    3 => ['label' => 'Pendiente Respuesta', 'class' => 'bg-primary text-white'],
    4 => ['label' => 'Finalizada', 'class' => 'bg-success text-white'],
    5 => ['label' => 'Cerrada', 'class' => 'bg-dark text-white']
];

$status = $statusMap[$oirs['oirs_estado']] ?? ['label' => 'Desconocido', 'class' => 'bg-light text-muted'];
?>

<style>
    .timeline-container {
        position: relative;
        padding-left: 2rem;
        margin-top: 2rem;
    }
    .timeline-container::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 31px;
        width: 2px;
        background-color: #f1f5f9;
        z-index: 1;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
        z-index: 2;
    }
    .timeline-dot {
        position: absolute;
        left: -11px;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: white;
        border: 4px solid #006FB3;
    }
    .timeline-content {
        background-color: white;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .info-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #94a3b8;
    }
    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1e293b;
    }
</style>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Main Card -->
        <div class="bg-white rounded-5 shadow-sm border p-4 p-md-5 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start mb-4 gap-3">
                <div>
                   <h1 class="h3 fw-extrabold text-dark mb-1">Folio: <?= $oirs['rgt_id_publica'] ?></h1>
                   <div class="d-flex align-items-center gap-2">
                       <span class="badge rounded-pill <?= $status['class'] ?> py-2 px-3"><?= $status['label'] ?></span>
                       <span class="text-muted small">•</span>
                       <span class="text-muted small">Ingresado el <?= date('d/m/Y H:i', strtotime($oirs['rgt_creacion'])) ?></span>
                   </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-4" data-bs-toggle="dropdown">
                        ACCIONES <?= getIcon('chevron-down', 'ms-1', ['width' => 14, 'height' => 14]) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                        <li><a class="dropdown-item rounded-3 small p-2" href="#"><?= getIcon('printer', 'me-2', ['width'=>16,'height'=>16]) ?> Imprimir Comprobante</a></li>
                        <li><a class="dropdown-item rounded-3 small p-2" href="index.php"><?= getIcon('arrow-left', 'me-2', ['width'=>16,'height'=>16]) ?> Volver al listado</a></li>
                    </ul>
                </div>
            </div>

            <div class="row g-4 mb-5 p-4 rounded-4 bg-light bg-opacity-50 border">
                <div class="col-md-6">
                    <p class="info-label mb-1">Tipo de Atención</p>
                    <p class="info-value mb-0"><?= $oirs['tat_nombre'] ?></p>
                </div>
                <div class="col-md-6">
                    <p class="info-label mb-1">Temática</p>
                    <p class="info-value mb-0"><?= $oirs['tem_nombre'] ?></p>
                </div>
                <div class="col-md-12">
                    <p class="info-label mb-1">Descripción del requerimiento</p>
                    <p class="text-dark small mb-0 fs-6"><?= nl2br(htmlspecialchars($oirs['oirs_descripcion'])) ?></p>
                </div>
            </div>

            <h5 class="fw-bold text-dark mb-4">Cronología de la solicitud</h5>
            <div class="timeline-container">
                <?php if (empty($oirs['historial'])): ?>
                   <p class="text-muted small">Aún no hay actualizaciones.</p>
                <?php else: ?>
                   <?php foreach ($oirs['historial'] as $h): ?>
                      <div class="timeline-item">
                          <div class="timeline-dot"></div>
                          <div class="timeline-content">
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span class="fw-bold text-dark small"><?= $h['bit_accion'] ?></span>
                                  <span class="text-muted x-small"><?= date('d/m/Y H:i', strtotime($h['bit_creacion'])) ?></span>
                              </div>
                              <p class="small text-muted mb-0"><?= $h['bit_detalle'] ?></p>
                          </div>
                      </div>
                   <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="timeline-item">
                    <div class="timeline-dot bg-success border-success"></div>
                    <div class="timeline-content shadow-none border-dashed bg-light bg-opacity-50">
                        <p class="fw-bold text-dark small mb-0">Solicitud Recibida Correctamente</p>
                        <p class="x-small text-muted mb-0">Estamos trabajando en su requerimiento.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Side Cards -->
        <div class="bg-white rounded-5 shadow-sm border p-4 mb-4">
            <h6 class="fw-bold text-dark mb-4">Respuesta del Municipio</h6>
            <?php if (!empty($oirs['gestion']) && !empty($oirs['gestion']['oig_respuesta_preliminar'])): ?>
                <div class="p-3 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-20">
                    <p class="small text-dark mb-0"><?= nl2br(htmlspecialchars($oirs['gestion']['oig_respuesta_preliminar'])) ?></p>
                </div>
            <?php else: ?>
                <div class="text-center py-4 text-muted">
                    <?= getIcon('clock', 'mb-3 opacity-50', ['width' => 32, 'height' => 32]) ?>
                    <p class="small mb-0">Aún no se ha emitido una respuesta formal.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-5 shadow-sm border p-4">
            <h6 class="fw-bold text-dark mb-4">Archivos Adjuntos</h6>
            <?php if (empty($oirs['adjuntos'])): ?>
                <p class="text-muted small">No hay archivos adjuntos.</p>
            <?php else: ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($oirs['adjuntos'] as $a): ?>
                        <a href="<?= $pathPrefix . $a['doc_ruta'] ?>" target="_blank" class="d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none border hover-bg-light">
                            <?= getIcon('file-text', 'text-primary') ?>
                            <div class="overflow-hidden">
                                <p class="small fw-bold text-dark mb-0 text-truncate"><?= $a['doc_nombre'] ?></p>
                                <p class="x-small text-muted mb-0">PDF Document</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../../apivec/general/footer.php'; ?>
