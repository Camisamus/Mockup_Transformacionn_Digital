<?php
$pageTitle = "Ingresar Respuesta DESVE";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<div class="container-fluid py-4">
    <!-- Main Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4" id="header_public_id">Ingresar Respuesta</h2>
            <p class="text-muted mb-0" id="header_expediente">Detalles de la solicitud y formulario de respuesta</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="button" id="btn-save-response-toolbar"
                        class="btn btn-toolbar btn-dark w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Guardar Respuesta
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-toolbar btn-dark w-100 shadow-sm"
                        onclick="location.href='desve_listado_ingresos.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Bandeja DESVE
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification / Loading State -->
    <div id="loading-check" class="text-center mt-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Procesando...</span>
        </div>
        <p class="mt-2 text-muted">Verificando acceso y cargando datos...</p>
    </div>

    <div id="step-2" class="d-none">
        <div class="row g-4">
            <!-- Left: Info and History -->
            <div class="col-lg-8">
                <!-- Request Details Card -->
                <div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-4">Detalles de la Solicitud</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">ID Ingreso</label>
                                <div id="display-id" class="fw-bold small">-</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Ingreso Desve</label>
                                <div id="display-desve" class="fw-bold small">-</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Expediente</label>
                                <div id="display-expediente" class="fw-bold small">-</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Tipo de Organización</label>
                                <div id="display-org-tipo" class="small">-</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Organización (Origen)</label>
                                <div id="display-org-nombre" class="small">-</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Fecha Recepción</label>
                                <div id="display-recepcion" class="small">-</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold text-muted">Prioridad</label>
                                <div id="display-prioridad" class="small">-</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Sector</label>
                                <div id="display-sector" class="small">-</div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small fw-bold text-muted">Detalle de Ingreso</label>
                            <div id="display-detalle" class="p-3 bg-light border rounded small"
                                style="min-height: 80px; white-space: pre-wrap;">-</div>
                        </div>
                    </div>
                </div>

                <!-- History Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold fs-6 mb-0">Historial de Respuestas</h5>
                            <button class="btn btn-sm btn-link text-dark p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHistorial">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </div>
                        <div class="collapse show" id="collapseHistorial">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light text-uppercase small">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Funcionario</th>
                                            <th>Tipo</th>
                                            <th>Contenido</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bitacora-respuestas-body" class="small">
                                        <!-- Dynamic -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Form and Sidebars -->
            <div class="col-lg-4">
                <!-- Documentos -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Documentos Adjuntos</h5>
                        <div id="lista_documentos" class="list-group list-group-flush">
                            <!-- Dynamic -->
                        </div>
                    </div>
                </div>
                <!-- Response Form Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Redactar Respuesta</h5>

                        <div class="mb-3">
                            <label for="input-respuesta" class="form-label small fw-bold">Contenido</label>
                            <textarea id="input-respuesta" class="form-control form-control-sm" rows="8"
                                placeholder="Escriba su respuesta aquí..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Adjuntar Archivos</label>
                            <div class="drop-zone" id="drop_zone">
                                <input type="file" id="inputArchivosRespuesta" hidden multiple>
                                <div class="small text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="mb-1">
                                        <path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 4.16"></path>
                                        <polyline points="16 10 12 6 8 10"></polyline>
                                        <line x1="12" y1="6" x2="12" y2="18"></line>
                                    </svg>
                                    <br>Haga clic para adjuntar
                                </div>
                            </div>
                            <div id="listaArchivosRespuesta" class="list-group list-group-flush mt-2 small">
                                <!-- Dynamic -->
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="check-respuesta-definitiva">
                                <label class="form-check-label small fw-bold" for="check-respuesta-definitiva">Respuesta
                                    Definitiva</label>
                            </div>
                            <div class="form-text x-small">Finaliza el trámite al guardar.</div>
                        </div>

                    </div>
                </div>

                <!-- Metrics Sidebar -->
                <div class="card shadow-sm border-0 mb-4 bg-light">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Métricas y Comentarios</h5>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form x-small text-muted d-block fw-bold mb-1">Días
                                    Transcurridos</label>
                                <span id="display-dias-ingreso"
                                    class="badge bg-white text-dark border w-100 fw-normal py-2">-</span>
                            </div>
                            <div class="col-6">
                                <label class="form x-small text-muted d-block fw-bold mb-1">P/Vencimiento</label>
                                <span id="display-dias-vencimiento"
                                    class="badge bg-white text-dark border w-100 fw-normal py-2">-</span>
                            </div>
                        </div>

                        <hr class="my-3 opacity-10">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-bold mb-0">Observaciones Internas</label>
                            <button class="btn btn-sm btn-outline-dark py-0 px-2" id="btn_abrir_comentario"
                                style="font-size: 0.7rem;">
                                + Comentario
                            </button>
                        </div>
                        <div id="comentarios-container" class="small overflow-auto" style="max-height: 200px;">
                            <!-- Dynamic -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Comentario -->
<div class="modal fade" id="modalNuevoComentario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Agregar Comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-0">
                    <label for="textoNuevoComentario" class="form-label small fw-bold">Su Comentario</label>
                    <textarea class="form-control form-control-sm" id="textoNuevoComentario" rows="4"
                        placeholder="Escriba aquí su comentario interno..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4" onclick="guardarComentario()">Guardar</button>
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
<script src="../../recursos/js/funcionarios/desve/desve_responder.js"></script>

<?php include '../../api/footer.php'; ?>