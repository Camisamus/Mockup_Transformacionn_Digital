<?php
$pageTitle = "Solicitud de Certificado de No Deuda Patente";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid">
        <h3 class="mb-4">Solicitud de Certificado de No Deuda Patente</h3>

        <div id="form-container">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-sm btn-danger"
                    onclick="exportElementToPDF('form-container', 'solicitud_certificado_no_deuda')">
                    <i data-feather="file-text" class="me-1"></i> Exportar Formulario (PDF)
                </button>
            </div>

            <!-- Header Info -->
            <div class="alert alert-info mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="me-3"><i data-feather="info"></i></div>
                    <div>
                        <strong>Dirigido a:</strong> Director(a) del Departamento de Patentes y Publicidad.<br>
                        <small>Amparado en el Artículo NÂ°29 de la Ley 3.063.</small>
                    </div>
                </div>
            </div>

            <!-- 1. Identificación Solicitante -->
            <div class="section-card">
                <div class="section-title">1. Identificación del Solicitante</div>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Rol Patente</label>
                        <input type="text" class="form-control" id="rolPatente">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">RUT</label>
                        <input type="text" class="form-control" id="rutContribuyente">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nombre o Razón Social</label>
                        <input type="text" class="form-control" id="nombreRazonSocial">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giro</label>
                        <input type="text" class="form-control" id="giro">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">E-MAIL</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
            </div>

            <!-- 2. Propósito -->
            <div class="section-card">
                <div class="section-title">2. Propósito del Certificado</div>
                <div class="mb-3">
                    <label class="form-label">Para ser presentado en la Ilustre Municipalidad de:</label>
                    <input type="text" class="form-control" placeholder="Ingrese nombre de la Municipalidad de destino"
                        id="muniDestino">
                </div>
            </div>

            <!-- 3. Antecedentes -->
            <div class="section-card">
                <div class="section-title">3. Antecedentes Adjuntos (Marque lo que adjunta)</div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="adjPatente">
                            <label class="form-check-label" for="adjPatente">Fotocopia de la última patente pagada
                                (Requisito Obligatorio).</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="adjTermino">
                            <label class="form-check-label" for="adjTermino">Ingreso Término de Negocio NÂº (Si
                                aplica).</label>
                        </div>
                        <input type="text" class="form-control form-control-sm mt-1 w-50 ms-4"
                            placeholder="NÂ° de Ingreso" id="numTermino">
                    </div>
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="adjSII">
                            <label class="form-check-label" for="adjSII">Formulario del S.I.I con cambio de
                                domicilio.</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Firma y Recepción -->
            <div class="section-card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="form-label fw-bold">Firma del Contribuyente o Representante Legal</label>
                            <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                                id="seccionFirma">
                                [Firma Digital o Manuscrita]
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border-start">
                        <div class="mt-4 ps-md-3">
                            <label class="form-label fw-bold text-muted">Uso Interno (Recepción)</label>
                            <div class="mb-3">
                                <label class="form-label small">Fecha de Ingreso</label>
                                <input type="date" class="form-control" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Número de Ingreso</label>
                                <input type="text" class="form-control" placeholder="Folio Automático" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end mb-5 gap-2">
            <button class="btn btn-secondary">Cancelar</button>
            <button class="btn btn-primary" onclick="alert('Solicitud Enviada')">Enviar Solicitud</button>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="../recursos/js/export_utils.js"></script>
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>


<?php include '../api/footer.php'; ?>

