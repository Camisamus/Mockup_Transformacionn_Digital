<?php
$pageTitle = "Consulta de Atenci�n";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header & Toolbar -->
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Consulta de Atenci�n</h2>
            <p class="text-muted mb-0">Consulta y gestiona informaci�n de atenciones individuales</p>
        </div>
        <div class="toolbar">
            <button class="btn btn-toolbar" onclick="buscarAtencion()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                Buscar
            </button>
            <button class="btn btn-toolbar" onclick="nuevaAtencion()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nueva
            </button>
            <button class="btn btn-toolbar" onclick="modificarAtencion()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Modificar
            </button>
            <button class="btn btn-toolbar" onclick="exportarPDF()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Exportar PDF
            </button>
            <button class="btn btn-toolbar btn-dark " onclick="guardarAtencion()">
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

    <!-- Informaci�n de la Atenci�n -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-1">Informaci�n de la Atenci�n</h3>
            <p class="text-muted small mb-4">Datos generales de la atenci�n realizada</p>

            <form id="formConsultaAtencion" onsubmit="event.preventDefault(); guardarAtencion();">
                <!-- Row 1 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="tipoAtencion" class="form-label small fw-bold">Tipo de Atenci�n</label>
                        <select class="form-select" id="tipoAtencion">
                            <option selected disabled>Seleccione...</option>
                            <option value="consulta">Consulta</option>
                            <option value="tramite">Tr�mite</option>
                            <option value="reclamo">Reclamo</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="codigoAtencion" class="form-label small fw-bold">C�digo de Atenci�n</label>
                        <input type="text" class="form-control" id="codigoAtencion" placeholder="AT-XXXX">
                    </div>
                    <div class="col-md-4">
                        <label for="codigoOrganizacion" class="form-label small fw-bold">C�digo de
                            Organizaci�n</label>
                        <input type="text" class="form-control" id="codigoOrganizacion" placeholder="OC-XXXX">
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="rut" class="form-label small fw-bold">RUT</label>
                        <input type="text" class="form-control" id="rut" placeholder="12345678-9">
                    </div>
                    <div class="col-md-8">
                        <label for="nombreOrganizacion" class="form-label small fw-bold">Nombre de la
                            Organizaci�n</label>
                        <input type="text" class="form-control" id="nombreOrganizacion"
                            placeholder="Nombre de la Organizaci�n">
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="estado" class="form-label small fw-bold">Estado</label>
                        <select class="form-select" id="estado">
                            <option selected disabled>Seleccione...</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En Proceso</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="proyecto" class="form-label small fw-bold">Proyecto</label>
                        <input type="text" class="form-control" id="proyecto" placeholder="Proyecto relacionado">
                    </div>
                    <div class="col-md-4">
                        <label for="area" class="form-label small fw-bold">�rea</label>
                        <select class="form-select" id="area">
                            <option selected disabled>Seleccione...</option>
                            <option value="social">Social</option>
                            <option value="legal">Legal</option>
                            <option value="tecnica">T�cnica</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="unidadVecinal" class="form-label small fw-bold">Unidad Vecinal</label>
                        <input type="text" class="form-control" id="unidadVecinal" placeholder="Unidad vecinal">
                    </div>
                    <div class="col-md-4">
                        <label for="fechaAtencion" class="form-label small fw-bold">Fecha de Atenci�n</label>
                        <input type="date" class="form-control" id="fechaAtencion">
                    </div>
                    <div class="col-md-4">
                        <label for="usuarioIngreso" class="form-label small fw-bold">Usuario de Ingreso</label>
                        <input type="text" class="form-control" id="usuarioIngreso" placeholder="Nombre del usuario"
                            value="Carlos P�rez">
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="usuarioResponsable" class="form-label small fw-bold">Usuario Responsable</label>
                        <input type="text" class="form-control" id="usuarioResponsable"
                            placeholder="Nombre del usuario">
                    </div>
                </div>

                <!-- Descripci�n -->
                <div class="mb-3">
                    <label for="descripcionAtencion" class="form-label small fw-bold">Descripci�n de la
                        Atenci�n</label>
                    <textarea class="form-control" id="descripcionAtencion" rows="3"
                        placeholder="Describa detalladamente la atenci�n realizada..."></textarea>
                </div>

                <!-- Observaciones -->
                <div class="mb-3">
                    <label for="observaciones" class="form-label small fw-bold">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3"
                        placeholder="Observaciones adicionales..."></textarea>
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
<script src="../../recursos/js/funcionarios/NO_Asignadas/atenciones_consulta_atencion.js"></script>


<?php include '../../api/footer.php'; ?>