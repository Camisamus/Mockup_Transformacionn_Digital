<?php
$pageTitle = "Solicitud de Certificado de No Deuda Patente";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Certificado de No Deuda Patente</h2>
            <p class="text-muted mb-0">Gestione la solicitud de certificados de vigencia de deuda de patentes</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_certificado_no_deuda')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Exportar Formulario (PDF)
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-secondary w-100 shadow-sm">
                        Cancelar
                    </button>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="alert('Solicitud Enviada')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 2 11 13"></polyline>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        Enviar Solicitud
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="form-container">
        <!-- Header Info -->
        <div class="alert alert-info mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="me-3"><i data-feather="info"></i></div>
                <div>
                    <strong>Dirigido a:</strong> Director(a) del Departamento de Patentes y Publicidad.<br>
                    <small>Amparado en el Art¿culo N°29 de la Ley 3.063.</small>
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
                    <label class="form-label">Tel¿fono</label>
                    <input type="tel" class="form-control" id="telefono">
                </div>
                <div class="col-md-6">
                    <label class="form-label">E-MAIL</label>
                    <input type="email" class="form-control" id="email">
                </div>
            </div>
        </div>

        <!-- 2. Prop¿sito -->
        <div class="section-card">
            <div class="section-title">2. Prop¿sito del Certificado</div>
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
                        <label class="form-check-label" for="adjPatente">Fotocopia de la ¿ltima patente pagada
                            (Requisito Obligatorio).</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjTermino">
                        <label class="form-check-label" for="adjTermino">Ingreso T¿rmino de Negocio Nº (Si
                            aplica).</label>
                    </div>
                    <input type="text" class="form-control form-control-sm mt-1 w-50 ms-4" placeholder="N° de Ingreso"
                        id="numTermino">
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
                            <label class="form-label small">N°mero de Ingreso</label>
                            <input type="text" class="form-control" placeholder="Folio Autom¿tico" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="../../recursos/js/export_utils.js"></script>
<script src="../../recursos/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>