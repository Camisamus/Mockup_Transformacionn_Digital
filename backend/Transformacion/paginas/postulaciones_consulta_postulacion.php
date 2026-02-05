<?php
$pageTitle = "Consulta de Postulación";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid py-4">
        <!-- Header & Toolbar -->
        <div class="main-header mb-4">
            <div class="header-title">
                <h2 class="fw-bold fs-4">Consulta de Postulación</h2>
                <p class="text-muted mb-0">Búsqueda, creación y modificación de postulaciones a fondos</p>
            </div>
            <div class="toolbar">
                <button class="btn btn-toolbar" onclick="buscarPostulacion()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar
                </button>
                <button class="btn btn-toolbar" onclick="crearNueva()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nueva
                </button>
                <button class="btn btn-toolbar" onclick="modificar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Modificar
                </button>
                <button class="btn btn-toolbar" onclick="imprimirPDF()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Imprimir PDF
                </button>
                <button class="btn btn-toolbar btn-dark " onclick="guardar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg>
                    Guardar
                </button>
            </div>
        </div>

        <form id="formPostulacion">
            <!-- Datos Principales -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-1">Datos Principales</h5>
                    <p class="text-muted small mb-4">Información básica de la postulación y la organización</p>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="organizacion" class="form-label small fw-bold">Organización</label>
                            <input type="text" class="form-control form-control-sm" id="organizacion"
                                placeholder="Nombre organización">
                        </div>
                        <div class="col-md-3">
                            <label for="rut" class="form-label small fw-bold">RUT</label>
                            <input type="text" class="form-control form-control-sm" id="rut" placeholder="XX.XXX.XXX-X">
                        </div>
                        <div class="col-md-2">
                            <label for="rpj" class="form-label small fw-bold">RPJ</label>
                            <input type="text" class="form-control form-control-sm" id="rpj">
                        </div>
                        <div class="col-md-2">
                            <label for="unidad" class="form-label small fw-bold">Unidad</label>
                            <input type="text" class="form-control form-control-sm" id="unidad">
                        </div>
                        <div class="col-md-2">
                            <label for="numero_ingreso" class="form-label small fw-bold">NÂ° Ingreso</label>
                            <input type="text" class="form-control form-control-sm text-primary fw-bold"
                                id="numero_ingreso">
                        </div>

                        <div class="col-md-3">
                            <label for="tipo" class="form-label small fw-bold">Tipo</label>
                            <select class="form-select form-select-sm" id="tipo">
                                <option value="">Seleccione...</option>
                                <option value="social">Social</option>
                                <option value="cultural">Cultural</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="codigo" class="form-label small fw-bold">Código</label>
                            <input type="text" class="form-control form-control-sm" id="codigo">
                        </div>
                        <div class="col-md-6">
                            <label for="proyecto" class="form-label small fw-bold">Proyecto</label>
                            <input type="text" class="form-control form-control-sm" id="proyecto"
                                placeholder="Nombre del proyecto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Antecedentes del Proyecto -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-1">1. Antecedentes del Proyecto</h5>
                    <p class="text-muted small mb-4">Detalles técnicos y descriptivos</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ant_nombre" class="form-label small fw-bold">Nombre del Proyecto</label>
                            <input type="text" class="form-control form-control-sm" id="ant_nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="ant_finalidad" class="form-label small fw-bold">Finalidad</label>
                            <input type="text" class="form-control form-control-sm" id="ant_finalidad">
                        </div>
                        <div class="col-12">
                            <label for="ant_objetivo" class="form-label small fw-bold">Objetivo</label>
                            <textarea class="form-control form-control-sm" id="ant_objetivo" rows="2"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="ant_tipo_proyecto" class="form-label small fw-bold">Tipo Proyecto</label>
                            <select class="form-select form-select-sm" id="ant_tipo_proyecto">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="ant_fecha_ingreso" class="form-label small fw-bold">F. Ingreso</label>
                            <input type="date" class="form-control form-control-sm" id="ant_fecha_ingreso">
                        </div>
                        <div class="col-md-2">
                            <label for="ant_num_participantes" class="form-label small fw-bold">Participantes</label>
                            <input type="number" class="form-control form-control-sm" id="ant_num_participantes">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financiamientos -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-1">2. Financiamientos</h5>
                    <p class="text-muted small mb-4">Detalle de montos y fuentes de financiamiento</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="fin_monto_solicitado" class="form-label small fw-bold">Monto Solicitado
                                ($)</label>
                            <input type="number" class="form-control form-control-sm" id="fin_monto_solicitado">
                        </div>
                        <div class="col-md-4">
                            <label for="fin_monto_propuesto" class="form-label small fw-bold">Monto Propuesto
                                ($)</label>
                            <input type="number" class="form-control form-control-sm" id="fin_monto_propuesto">
                        </div>
                        <div class="col-md-4">
                            <label for="fin_modalidad" class="form-label small fw-bold">Modalidad</label>
                            <select class="form-select form-select-sm" id="fin_modalidad">
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refrendaciones -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-3">Refrendaciones</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaRefrendaciones">
                            <thead class="table-light text-uppercase small">
                                <tr>
                                    <th>NÂ° Decreto</th>
                                    <th>Tipo</th>
                                    <th>Año</th>
                                    <th>NÂ° Ref</th>
                                    <th>Cuota</th>
                                    <th>F. Cheque</th>
                                    <th>Quien Retira</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <!-- Mock data -->
                                <tr>
                                    <td>DEC-2024-123</td>
                                    <td>Total</td>
                                    <td>2024</td>
                                    <td>REF-045</td>
                                    <td>1/1</td>
                                    <td>15-06-2024</td>
                                    <td>Juan Pérez</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Evaluación (Solo Lectura) -->
            <div class="card shadow-sm border-0 bg-light mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold fs-6 mb-1">Evaluación <span class="badge bg-secondary fw-normal ms-2">Solo
                            Lectura</span></h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Estado</label>
                            <input type="text" class="form-control form-control-sm" id="eval_estado" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Puntaje</label>
                            <input type="text" class="form-control form-control-sm" id="eval_puntaje" readonly>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Observación</label>
                            <textarea class="form-control form-control-sm" id="eval_observacion" rows="2"
                                readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mb-5">
                <button type="button" class="btn btn-outline-secondary px-4 shadow-sm" onclick="cancelar()">
                    Limpiar / Cancelar
                </button>
                <button type="button" class="btn btn-primary px-4 shadow-sm" onclick="guardar()">
                    Guardar Postulación
                </button>
            </div>
        </form>

    </div>

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        feather.replace();
    </script>
    <script src="../recursos/js/postulaciones_consulta_postulacion.js"></script>
    

<?php include '../api/footer.php'; ?>

