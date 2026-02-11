<?php
$pageTitle = "Nueva Atención";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <!-- Header & Toolbar -->
    <div class="main-header mb-4 max-width-800 mx-auto">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Nueva Atención</h2>
            <p class="text-muted mb-0">Registrar una nueva atención en el sistema</p>
        </div>
        <div class="toolbar">
            <button type="button" class="btn btn-toolbar" onclick="window.history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Volver
            </button>
            <button type="submit" form="formNuevaAtencion" class="btn btn-toolbar btn-dark ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Registrar Atención
            </button>
        </div>
    </div>

    <!-- Formulario de Nueva Atención -->
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 800px;">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-1">Datos de la Atención</h3>
            <p class="text-muted small mb-4">Complete los campos obligatorios marcados con *</p>

            <form id="formNuevaAtencion" onsubmit="event.preventDefault(); window.registrarAtencion();">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">RUT Solicitante <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rut" placeholder="XX.XXX.XXX-X" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nombre Solicitante</label>
                        <input type="text" class="form-control bg-light" id="nombre_solicitante" readonly
                            placeholder="Se autocompleta al ingresar RUT">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Organización (Opcional)</label>
                        <input type="text" class="form-control" id="organizacion" placeholder="Buscar organización...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Tipo de Atención <span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="tipo_atencion" required>
                            <option value="">Seleccione...</option>
                            <option value="consulta">Consulta</option>
                            <option value="tramite">Trámite</option>
                            <option value="reclamo">Reclamo</option>
                            <option value="solicitud">Solicitud</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Descripción / Motivo <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="descripcion" rows="3"
                            placeholder="Describa el motivo de la atención..." required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Área Derivación</label>
                        <select class="form-select" id="area">
                            <option value="">Seleccione...</option>
                            <option value="social">Desarrollo Social</option>
                            <option value="obras">Obras Municipales</option>
                            <option value="transito">Trónsito</option>
                            <option value="patentes">Patentes</option>
                            <option value="juridico">Jurídico</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Prioridad</label>
                        <select class="form-select" id="prioridad">
                            <option value="normal" selected>Normal</option>
                            <option value="alta">Alta</option>
                            <option value="baja">Baja</option>
                        </select>
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
<script src="../../recursos/js/funcionarios/NO_Asignadas/atenciones_nueva_atencion.js"></script>


<?php include '../../api/footer.php'; ?>