<?php
$pageTitle = "Modificar Solicitud DESVE";
require_once '../api/auth_check.php';
include '../api/header.php';
?>

<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4" id="header_public_id">Modificar DESVE</h2>
            <p class="text-muted mb-0" id="header_expediente">Actualice los campos de la solicitud</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar btn-dark "
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

    <form id="form_modificar_desve">
        <div class="row g-4">
            <!-- Left Column: Main Form -->
            <div class="col-lg-8">
                <!-- General Info -->
                <div class="card shadow-sm border-0 border-start border-4 border-primary mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-4">Información de la Solicitud</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="NombreExpediente" class="form-label small fw-bold">Nombre del
                                    Expediente</label>
                                <input type="text" class="form-control form-control-sm" id="NombreExpediente" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Codigo_DESVE" class="form-label small fw-bold">Codigo DESVE</label>
                                <input type="text" class="form-control form-control-sm" id="Codigo_DESVE"
                                    placeholder="Ej: Consulta por Luminaria">
                            </div>

                            <div class="col-md-6">
                                <label for="Reingreso" class="form-label small fw-bold">Reingreso</label>
                                <select class="form-select form-select-sm" id="Reingreso">
                                    <option value="" selected disabled>Seleccione tipo...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="ID_Organizacion" class="form-label small fw-bold">Tipo de
                                    Organización</label>
                                <select class="form-select form-select-sm" id="ID_Organizacion" required>
                                    <option value="" selected disabled>Seleccione tipo...</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="OrigenSolicitud" class="form-label small fw-bold">Origen de
                                    Solicitud</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-select" id="OrigenSolicitud" required>
                                        <option value="" selected disabled>Seleccione organización...</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" id="btn_nuevo_origen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="FechaUltimaRecepcion" class="form-label small fw-bold">Fecha de
                                    Recepción</label>
                                <input type="date" class="form-control form-control-sm" id="FechaUltimaRecepcion"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="Sector" class="form-label small fw-bold">Sector</label>
                                <select class="form-select form-select-sm" id="Sector" required>
                                    <!-- Populated via JS -->
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="DetalleIngreso" class="form-label small fw-bold">Detalle de
                                    Ingreso</label>
                                <textarea class="form-control form-control-sm" id="DetalleIngreso" rows="4"></textarea>
                            </div>

                            <div class="col-12">
                                <label for="Observaciones" class="form-label small fw-bold">Observaciones</label>
                                <textarea class="form-control form-control-sm" id="Observaciones" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Destinatarios -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold fs-6 mb-0">Destinatarios</h5>
                            <button type="button" class="btn btn-toolbar btn-dark"
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
                                        <th>Email</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_destinos" class="small">
                                    <tr id="placeholder_destinos">
                                        <td colspan="2" class="text-center text-muted py-4">No hay destinatarios
                                            agregados.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Bitácora de Respuestas -->
                <div class="card shadow-sm border-0 mb-4 bg-light">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Respuestas del Trámite</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabla_respuestas">
                                <thead class="table-light text-uppercase small">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Funcionario</th>
                                        <th>Acción</th>
                                        <th>Contenido</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_respuestas" class="small">
                                    <!-- Dynamic -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Estado y Tiempos</h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold d-block">Estado de Entrega</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="EstadoEntrega" id="estadoPendiente"
                                    value="0">
                                <label class="btn btn-outline-warning btn-sm" for="estadoPendiente">Pendiente</label>

                                <input type="radio" class="btn-check" name="EstadoEntrega" id="estadoRespondido"
                                    value="1">
                                <label class="btn btn-outline-success btn-sm" for="estadoRespondido">Respondido</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Días Transcurridos</label>
                            <input type="text" class="form-control form-control-sm bg-light" id="info_dias_ingreso"
                                readonly>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small fw-bold">Días para Vencimiento</label>
                            <input type="text" class="form-control form-control-sm bg-light" id="info_dias_vencimiento"
                                readonly>
                        </div>
                    </div>
                </div>

                <!-- Documentos -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold fs-6 mb-3">Documentos Adjuntos</h5>
                        <div id="lista_documentos_guardados" class="list-group list-group-flush small mb-3">
                            <!-- Existing -->
                        </div>

                        <label class="form-label small fw-bold">Añadir Nuevos Archivos</label>
                        <div class="drop-zone mb-3" id="drop_zone">
                            <input type="file" id="inputArchivosSolicitud" hidden multiple>
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
                        <div id="listaArchivosSolicitud" class="list-group list-group-flush small">
                            <!-- Selected -->
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <button type="submit"
                        class="btn btn-dark shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Guardar Cambios
                    </button>
                    <button type="button"
                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2"
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
            </div>
        </div>
        <input type="hidden" id="idIngreso">
        <input type="hidden" id="IngresoDesve">
        <input type="hidden" id="Prioridad">
        <input type="hidden" id="FechaVecimiento">
        <input type="hidden" id="Reingresado">
        <input type="hidden" id="Responsable">
    </form>
</div>

<!-- Modal Nuevo Origen Especial -->
<div class="modal fade" id="modalNuevoOrigenEspecial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Agregar Origen Especial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-0">
                    <label for="textoNuevoOrigenEspecial" class="form-label small fw-bold">Nuevo Origen
                        Especial</label>
                    <input type="text" class="form-control form-control-sm" id="textoNuevoOrigenEspecial"
                        placeholder="Escriba aquí el origen especial...">
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarOrigenEspecial()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Funcionarios -->
<div class="modal fade" id="modalFuncionarios" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Funcionario Interno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-sm" id="filtroFuncionario"
                        placeholder="Filtrar por nombre o RUT...">
                </div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_fnc" class="small">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Origen Especial -->
<div class="modal fade" id="modalNuevoOrigenEspecial" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Agregar Origen Especial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-0">
                    <label for="textoNuevoOrigenEspecial" class="form-label small fw-bold">Nuevo Origen
                        Especial</label>
                    <input type="text" class="form-control form-control-sm" id="textoNuevoOrigenEspecial"
                        placeholder="Escriba aquí el origen especial...">
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarOrigenEspecial()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Contribuyente -->
<div class="modal fade" id="modalBuscarContribuyente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Buscar Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <input type="text" class="form-control form-control-sm me-2" id="filtroContribuyente"
                        placeholder="Filtrar por RUT o nombre...">
                    <button type="button" class="btn btn-sm btn-dark" onclick="abrirModalNuevoContribuyente()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Nuevo
                    </button>
                </div>
                <div class="table-responsive" style="max-height: 400px;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Completo</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_busqueda_contrib" class="small">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Contribuyente -->
<div class="modal fade" id="modalNuevoContribuyente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold fs-6">Nuevo Contribuyente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="form_nuevo_contribuyente">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nc_rut" class="form-label small fw-bold">RUT <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_rut" required
                                placeholder="12345678-9">
                        </div>
                        <div class="col-12">
                            <label for="nc_nombre" class="form-label small fw-bold">Nombre <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_nombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nc_paterno" class="form-label small fw-bold">Apellido Paterno</label>
                            <input type="text" class="form-control form-control-sm" id="nc_paterno">
                        </div>
                        <div class="col-md-6">
                            <label for="nc_materno" class="form-label small fw-bold">Apellido Materno <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nc_materno" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-link text-muted text-decoration-none small"
                    data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark btn-sm px-4"
                    onclick="guardarNuevoContribuyente()">Guardar</button>
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

<script src="../recursos/js/desve_modificar.js"></script>

<?php include '../api/footer.php'; ?>