<link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" type="text/css" />
<style>
    #network-container {
        width: 100%;
        height: 600px;
        background-color: #f8f9fa;
    }
</style>
<?php
$pageTitle = "Preparar Ingreso (Relaciones)";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Preparar Relaciones</h2>
            <p class="text-muted mb-0" id="subtitulo_preparar">Gestionando Árbol multiancestro para la solicitud</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm" id="btn_nueva_hija">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        Nueva Solicitud Hija
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        id="btn_establecer_dependencia">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                        Establecer Dependencia
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='ingr_bandeja.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Bandeja
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold fs-6 mb-0">Mapa de Relaciones Actual</h5>
                        <div class="d-flex align-items-center gap-4">
                            <div class="form-check form-switch small mb-0">
                                <input class="form-check-input" type="checkbox" id="toggle_no_favorables" checked
                                    role="switch">
                                <label class="form-check-label fw-bold x-small text-muted"
                                    for="toggle_no_favorables">Ver No Favorables (Negro)</label>
                            </div>
                            <div class="small text-muted x-small">Solicitud actual en <span
                                    class="badge bg-warning text-dark fw-normal">Amarillo</span></div>
                        </div>
                    </div>
                    <div id="network-container" class="rounded border"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Solicitud Hija -->
<div class="modal fade" id="modalCrearHija" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Crear Nueva Solicitud Hija</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_crear_hija">
                    <div class="mb-3">
                        <label for="h_titulo" class="form-label small fw-bold">Título</label>
                        <input type="text" class="form-control form-control-sm" id="h_titulo" required
                            placeholder="Título de la sub-solicitud">
                    </div>
                    <div class="mb-3">
                        <label for="h_tipo" class="form-label small fw-bold">Tipo de Ingreso</label>
                        <select class="form-select form-select-sm" id="h_tipo" required>
                            <option value="" selected disabled>Cargando tipos...</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="h_contenido" class="form-label small fw-bold">Contenido / Descripción</label>
                        <textarea class="form-control form-control-sm" id="h_contenido" rows="5"
                            placeholder="Detalles de la sub-solicitud..."></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit"
                            class="btn btn-dark btn-sm d-flex align-items-center justify-content-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Crear y Vincular
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Establecer Dependencia -->
<div class="modal fade" id="modalEstablecerDependencia" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Establecer Dependencia (Vincular Padre)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <p class="small text-muted mb-4">Seleccione una de sus solicitudes activas para que sea la
                    <strong>antecesora</strong> de la solicitud actual.
                </p>
                <div class="input-group input-group-sm mb-4">
                    <span class="input-group-text bg-white border-end-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input type="text" class="form-control border-start-0" id="buscar_padre"
                        placeholder="Filtrar por título o ID...">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Estado</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_solicitudes_padre" class="small">
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Cargando solicitudes...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/ingr_permissions.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/ingr_preparar.js"></script>

<?php include '../../api/footer.php'; ?>