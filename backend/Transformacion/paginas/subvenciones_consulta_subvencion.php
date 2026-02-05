<?php
$pageTitle = "Consulta de Subvención";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid py-4">
        <!-- Header & Toolbar -->
        <div class="main-header mb-4">
            <div class="header-title">
                <h2 class="fw-bold fs-4">Consulta de Subvención</h2>
                <p class="text-muted mb-0">Búsqueda, creación y modificación de subvenciones</p>
            </div>
            <div class="toolbar">
                <button class="btn btn-toolbar" onclick="buscarSubvencion()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar
                </button>
                <button class="btn btn-toolbar" onclick="crearNuevo()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nuevo
                </button>
                <button class="btn btn-toolbar" onclick="modificar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Modificar
                </button>
                <button class="btn btn-toolbar" onclick="cambiarEstado()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 4v6h-6"></path>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                    Cambiar Estado
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
                <button class="btn btn-toolbar btn-dark " onclick="guardarSubvencion()">
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

        <!-- Datos de la Subvención -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h3 class="h6 fw-bold mb-1">Información de la Subvención</h3>
                <p class="text-muted small mb-4">Complete los datos de la subvención</p>

                <form id="formSubvencion" onsubmit="event.preventDefault(); guardarSubvencion();">
                    <div class="row g-3">
                        <!-- Row 1 -->
                        <div class="col-md-4">
                            <label for="numero" class="form-label small fw-bold">Número <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="numero" placeholder="Ej: SUB-2024-001" required>
                        </div>
                        <div class="col-md-4">
                            <label for="estado" class="form-label small fw-bold">Estado</label>
                            <select class="form-select" id="estado">
                                <option value="">Seleccione...</option>
                                <option value="vigente">Vigente</option>
                                <option value="finalizada">Finalizada</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="rechazada">Rechazada</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha" class="form-label small fw-bold">Fecha <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha" required>
                        </div>

                        <!-- Row 2 -->
                        <div class="col-md-4">
                            <label for="tipo_subvencion" class="form-label small fw-bold">Tipo de Subvención</label>
                            <select class="form-select" id="tipo_subvencion">
                                <option value="">Seleccione...</option>
                                <option value="deportiva">Deportiva</option>
                                <option value="cultural">Cultural</option>
                                <option value="social">Social</option>
                                <option value="educacional">Educacional</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="rut_organizacion" class="form-label small fw-bold">RUT Organización <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rut_organizacion" placeholder="XX.XXX.XXX-X"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="nombre_organizacion" class="form-label small fw-bold">Nombre Organización <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre_organizacion"
                                placeholder="Nombre de la organización" required>
                        </div>

                        <!-- Row 3 -->
                        <div class="col-md-4">
                            <label for="monto_solicitado" class="form-label small fw-bold">Monto Solicitado ($) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="monto_solicitado" placeholder="0" step="1000"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="organismo_aprobador" class="form-label small fw-bold">Organismo
                                Aprobador</label>
                            <input type="text" class="form-control" id="organismo_aprobador"
                                placeholder="Nombre del organismo">
                        </div>
                        <div class="col-md-4">
                            <label for="anio" class="form-label small fw-bold">Año</label>
                            <input type="number" class="form-control" id="anio" placeholder="2024" min="2000"
                                max="2100">
                        </div>

                        <!-- Row 4 -->
                        <div class="col-md-4">
                            <label for="anio_decreto" class="form-label small fw-bold">Año de Decreto</label>
                            <input type="number" class="form-control" id="anio_decreto" placeholder="2024" min="2000"
                                max="2100">
                        </div>
                        <div class="col-md-4">
                            <label for="numero_decreto" class="form-label small fw-bold">Número de Decreto</label>
                            <input type="text" class="form-control" id="numero_decreto" placeholder="Ej: DEC-2024-123">
                        </div>
                        <div class="col-md-4">
                            <label for="numero_monto" class="form-label small fw-bold">Número de Monto</label>
                            <input type="number" class="form-control" id="numero_monto" placeholder="0" step="1000">
                        </div>

                        <!-- Row 5 -->
                        <div class="col-md-6">
                            <label for="anio_matriz" class="form-label small fw-bold">Año de Matriz</label>
                            <input type="number" class="form-control" id="anio_matriz" placeholder="2024" min="2000"
                                max="2100">
                        </div>
                        <div class="col-md-6">
                            <label for="finalidad_proyecto" class="form-label small fw-bold">Finalidad del
                                Proyecto</label>
                            <input type="text" class="form-control" id="finalidad_proyecto"
                                placeholder="Descripción breve de la finalidad">
                        </div>

                        <!-- Row 6 - Objetivo de la Subvención -->
                        <div class="col-12">
                            <label for="objetivo_subvencion" class="form-label small fw-bold">Objetivo de la
                                Subvención</label>
                            <textarea class="form-control" id="objetivo_subvencion" rows="3"
                                placeholder="Describa el objetivo de la subvención..."></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        feather.replace();
    </script>
    <script src="../recursos/js/subvenciones_consulta_subvencion.js"></script>
    

<?php include '../api/footer.php'; ?>

