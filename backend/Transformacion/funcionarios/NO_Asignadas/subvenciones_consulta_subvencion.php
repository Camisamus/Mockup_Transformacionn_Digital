<?php
$pageTitle = "Consulta de Subvención";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta de Subvención</h2>
            <p class="text-muted mb-0">Búsqueda, creación y modificación de subvenciones</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-primary w-100 shadow-sm" onclick="buscarSubvencion()">
                        <i data-feather="search" class="me-2"></i>
                        Buscar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-success w-100 shadow-sm" onclick="crearNuevo()">
                        <i data-feather="plus" class="me-2"></i>
                        Nuevo
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-warning w-100 shadow-sm" onclick="modificar()">
                        <i data-feather="edit" class="me-2"></i>
                        Modificar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-secondary w-100 shadow-sm" onclick="cambiarEstado()">
                        <i data-feather="refresh-cw" class="me-2"></i>
                        Cambiar Estado
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm" onclick="imprimirPDF()">
                        <i data-feather="file" class="me-2"></i>
                        Imprimir PDF
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="guardarSubvencion()">
                        <i data-feather="save" class="me-2"></i>
                        Guardar
                    </button>
                </div>
            </div>
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
                        <label for="numero" class="form-label small fw-bold">N°mero <span
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
                        <input type="number" class="form-control" id="anio" placeholder="2024" min="2000" max="2100">
                    </div>

                    <!-- Row 4 -->
                    <div class="col-md-4">
                        <label for="anio_decreto" class="form-label small fw-bold">Año de Decreto</label>
                        <input type="number" class="form-control" id="anio_decreto" placeholder="2024" min="2000"
                            max="2100">
                    </div>
                    <div class="col-md-4">
                        <label for="numero_decreto" class="form-label small fw-bold">N°mero de Decreto</label>
                        <input type="text" class="form-control" id="numero_decreto" placeholder="Ej: DEC-2024-123">
                    </div>
                    <div class="col-md-4">
                        <label for="numero_monto" class="form-label small fw-bold">N°mero de Monto</label>
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

<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    feather.replace();
</script>
<script src="../../recursos/js/funcionarios/NO_Asignadas/subvenciones_consulta_subvencion.js"></script>


<?php include '../../api/footer.php'; ?>