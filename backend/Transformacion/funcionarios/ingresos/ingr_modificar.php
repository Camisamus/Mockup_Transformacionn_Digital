<?php
$pageTitle = "Modificar Ingreso";
require_once '../../api/auth_check.php';
include 'header.php';
?>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Modificar Ingreso</h2>
            <p class="text-muted mb-0">Edite los campos necesarios para actualizar el tr�mite</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button type="submit" form="form_modificar_ingreso"
                        class="btn btn-toolbar btn-dark w-100 d-flex align-items-center justify-content-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Actualizar Ingreso
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="button"
                        class="btn btn-toolbar btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2"
                        id="btn_cancelar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        Cancelar
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

    <form id="form_modificar_ingreso">
        <div class="row g-4">
            <!-- Left Column: Main Form -->
            <div class="col-lg-8">
                <!-- General Info -->
                <div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-4">Informaci�n General</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="tis_titulo" class="form-label small fw-bold">T�tulo del Ingreso</label>
                                <input type="text" class="form-control form-control-sm" id="tis_titulo" required
                                    placeholder="Ej: Solicitud de Permiso de Edificaci�n">
                            </div>
                            <div class="col-md-12">
                                <label for="tis_tipo" class="form-label small fw-bold">Tipo de Ingreso</label>
                                <select class="form-select form-select-sm" id="tis_tipo" required>
                                    <option value="" selected disabled>Cargando tipos...</option>
                                    <!-- Dynamic -->
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tis_contenido" class="form-label small fw-bold">Contenido /
                                    Descripci�n</label>
                                <textarea class="form-control form-control-sm" id="tis_contenido" rows="8"
                                    placeholder="Detalle aqu� la solicitud..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destinos -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold fs-6 mb-0">Destinatarios</h5>
                            <button type="button" class="btn btn-toolbar btn-dark "
                                onclick="abrirModalBuscarFuncionario()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                Buscar Funcionario
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabla_destinos">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th>Funcionario</th>
                                        <th>Tipo</th>
                                        <th>Facultad</th>
                                        <th class="text-center">Req.</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_destinos" class="small">
                                    <tr id="placeholder_destinos">
                                        <td colspan="5" class="text-center text-muted py-4">No hay destinatarios
                                            agregados.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Respuestas de Destinatarios -->
                <div id="contenedor_respuestas"></div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4">
                <!-- Comentarios -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold fs-6 mb-0">Comentarios</h5>
                            <button type="button" class="btn btn-sm btn-outline-dark py-0" id="btn_abrir_comentario"
                                style="font-size: 0.75rem;">
                                + Comentario
                            </button>
                        </div>
                        <div id="lista_comentarios" class="list-group list-group-flush small overflow-auto"
                            style="max-height: 300px;">
                            <div class="text-center py-3 text-muted">Cargando comentarios...</div>
                        </div>
                    </div>
                </div>

                <!-- Enlaces -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Enlaces Externos</h5>
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" id="input_enlace" placeholder="https://...">
                            <button class="btn btn-dark" type="button" id="btn_agregar_enlace">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </button>
                        </div>
                        <div id="lista_enlaces" class="list-group list-group-flush small">
                            <!-- Dynamic -->
                        </div>
                    </div>
                </div>

                <!-- Documentos -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Documentos Guardados</h5>
                        <div id="lista_documentos_guardados" class="list-group list-group-flush small mb-4">
                            <!-- Dynamic -->
                        </div>

                        <h5 class="fw-bold fs-6 mb-2">Adjuntar Nuevos</h5>
                        <div class="drop-zone mb-3" id="drop_zone">
                            <input type="file" id="input_archivo" hidden multiple>
                            <div class="small text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mb-2">
                                    <path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 4.16"></path>
                                    <polyline points="16 10 12 6 8 10"></polyline>
                                    <line x1="12" y1="6" x2="12" y2="18"></line>
                                </svg>
                                <br>Haga clic para adjuntar
                            </div>
                        </div>
                        <div id="lista_documentos_nuevos" class="list-group list-group-flush small">
                            <!-- Dynamic -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<!-- Modal Buscar Funcionario -->
<div class="modal fade" id="modalBusquedaFuncionario" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Destino</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="input-group input-group-sm mb-4">
                    <span class="input-group-text bg-white border-end-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </span>
                    <input type="text" class="form-control border-start-0" id="buscar_fnc_input"
                        placeholder="Buscar por nombre o apellido...">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase small sticky-top">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-end">Acci�n</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="small">
                            <!-- Dynamic -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Configurar Destino -->
<div class="modal fade" id="modalConfigurarDestino" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Configurar Destino: <span id="fnc_nombre_config"
                        class="text-primary italic"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" id="fnc_id_config">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="m_destino_tipo" class="form-label small fw-bold">Tipo de Destino</label>
                        <select class="form-select form-select-sm" id="m_destino_tipo">
                            <option value="Para">Para</option>
                            <option value="Copia">Copia</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="m_destino_facultad" class="form-label small fw-bold">Facultad</label>
                        <select class="form-select form-select-sm" id="m_destino_facultad">
                            <option value="Responsable">Responsable</option>
                            <option value="Firmante">Firmante</option>
                            <option value="Visador">Visador</option>
                            <option value="Consultor">Consultor</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="m_destino_tarea" class="form-label small fw-bold">Labor / Tarea</label>
                        <select class="form-select form-select-sm" id="m_destino_tarea">
                            <option value="ejecutar lo requerido">Ejecutar lo requerido</option>
                            <option value="generar informe">Generar informe</option>
                            <option value="tomar conocimiento">Tomar conocimiento</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch p-0 ms-4">
                            <input class="form-check-input" type="checkbox" id="m_destino_requerido" checked
                                role="switch">
                            <label class="form-check-label small fw-bold" for="m_destino_requerido">Requiere
                                Respuesta</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Atr�s</button>
                <button type="button" class="btn btn-dark btn-sm px-4" id="btn_confirmar_destino">Actualizar</button>
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
                        placeholder="Escriba aqu� su comentario interno..."></textarea>
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

<script src="../../recursos/js/funcionarios/ingresos/ingr_permissions.js"></script>
<script src="../../recursos/js/funcionarios/ingresos/ingr_modificar.js"></script>

<?php include '../../api/footer.php'; ?>