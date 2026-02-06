<?php
$pageTitle = "Consultar Ingreso";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta de Ingreso</h2>
            <p class="text-muted mb-0" id="subtitulo_ingreso">Visualizando detalles de la solicitud</p>
        </div>
        <div class="toolbar d-flex gap-2">
            <button type="button" class="btn btn-toolbar btn-dark " id="btn_ir_responder" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 11 12 14 22 4"></polyline>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                </svg>
                Responder
            </button>
            <button type="button" class="btn btn-toolbar btn-dark " id="btn_ir_preparar" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="18" cy="5" r="3"></circle>
                    <circle cx="6" cy="12" r="3"></circle>
                    <circle cx="18" cy="19" r="3"></circle>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
                Preparar
            </button>
            <button type="button" class="btn btn-toolbar btn-dark " id="btn_ir_modificar" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Modificar
            </button>
            <button type="button" class="btn btn-toolbar btn-dark  shadow-sm"
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

    <!-- Search Filters in Consultation -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-4">
            <form id="form_filtros_consulta" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filtro_titulo" class="form-label small fw-bold">Título</label>
                    <input type="text" class="form-control form-control-sm" id="filtro_titulo"
                        placeholder="Buscar por título...">
                </div>
                <div class="col-md-3">
                    <label for="filtro_rgt" class="form-label small fw-bold">ID Público (RGT)</label>
                    <input type="text" class="form-control form-control-sm" id="filtro_rgt" placeholder="Cód. RGT...">
                </div>
                <div class="col-md-2">
                    <label for="filtro_id" class="form-label small fw-bold">ID Interno</label>
                    <input type="number" class="form-control form-control-sm" id="filtro_id" placeholder="ID...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit"
                        class="btn btn-dark btn-sm flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Consultar
                    </button>
                    <button type="reset" class="btn btn-outline-secondary btn-sm" id="btn_limpiar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 4 23 10 17 10"></polyline>
                            <polyline points="1 20 1 14 7 14"></polyline>
                            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column: Main Info -->
        <div class="col-lg-8">
            <!-- Info Card -->
            <div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold fs-6 mb-0">Detalles del Ingreso</h5>
                        <span class="badge bg-primary" id="badge_estado">Cargando...</span>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted d-block">Título</label>
                            <div class="fs-6 fw-bold" id="info_titulo">-</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted d-block">ID Trámite (RGT)</label>
                            <div class="fs-6 fw-bold" id="info_rgt_id">-</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-muted d-block">ID Público</label>
                            <div class="badge bg-light text-dark border fw-normal text-wrap text-break"
                                id="info_id_publica">-</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted d-block">Fecha de Ingreso</label>
                            <div class="small" id="info_fecha">-</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted d-block">Responsable</label>
                            <div class="small" id="info_responsable">-</div>
                        </div>
                        <div class="col-12">
                            <hr class="my-4 opacity-10">
                            <label class="form-label small fw-bold text-muted d-block mb-2">Contenido /
                                Cuerpo</label>
                            <div class="bg-light p-4 rounded border small" id="info_contenido"
                                style="white-space: pre-wrap; min-height: 151px;">
                                -
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destinos -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-4">Destinatarios y Permisos</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th>Funcionario</th>
                                    <th>Tipo</th>
                                    <th>Facultad</th>
                                    <th>Tarea</th>
                                    <th class="text-center">Requerido</th>
                                    <th class="text-end">Estado</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_destinos" class="small">
                                <!-- Dynamic -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bitácora -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Bitácora de Auditoría</h5>
                        <button class="btn btn-sm btn-link text-dark p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseBitacora">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                    <div class="collapse show" id="collapseBitacora">
                        <div class="timeline-small mt-3" id="lista_bitacora">
                            <!-- Dynamic -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Respuestas de Destinatarios -->
            <div id="contenedor_respuestas"></div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="col-lg-4">
            <!-- Enlaces -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Enlaces Adjuntos</h5>
                    <div id="lista_enlaces" class="list-group list-group-flush small">
                        <!-- Dynamic -->
                    </div>
                </div>
            </div>

            <!-- Documentos -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Documentos Adjuntos</h5>
                    <div id="lista_documentos" class="list-group list-group-flush small">
                        <!-- Dynamic -->
                    </div>
                </div>
            </div>

            <!-- Comentarios -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Comentarios</h5>
                        <button type="button" class="btn btn-sm btn-outline-dark px-2 py-0" id="btn_abrir_comentario"
                            style="font-size: 0.75rem;">
                            + Comentario
                        </button>
                    </div>
                    <div id="lista_comentarios" class="list-group list-group-flush small overflow-auto"
                        style="max-height: 400px;">
                        <!-- Dynamic -->
                    </div>
                </div>
            </div>

            <!-- Relaciones -->
            <div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold fs-6 mb-0">Relaciones (Árbol RGT)</h5>
                        <button type="button" class="btn btn-sm btn-dark px-2 py-0 shadow-sm" id="btn_ver_mapa"
                            style="font-size: 0.75rem;">
                            Ver Mapa
                        </button>
                    </div>
                    <p class="x-small text-muted mb-3">Listado de trámites correlacionados dinámicamente.</p>
                    <ul id="lista_multiancestro" class="list-group list-group-flush bg-transparent">
                        <!-- Dynamic -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Graph -->
<div class="modal fade" id="modalMapa" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Mapa de Relaciones (Multi-Ancestro)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div id="network-container"></div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <div class="small text-muted me-auto d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    Navegue con el ratón (zoom y arrastre).
                </div>
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Cerrar</button>
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
                        placeholder="Escriba aquí su comentario u observación..."></textarea>
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

<script src="../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>

<script src="../recursos/js/ingr_permissions.js"></script>
<script src="../recursos/js/ingr_consultar.js"></script>

<?php include '../api/footer.php'; ?>