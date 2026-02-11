<?php
$pageTitle = "Solicitud de Certificado de Distribuci�n de Capital Propio";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Certificado de Distribuci�n de Capital Propio</h2>
            <p class="text-muted mb-0">Gestione la distribuci�n de capital propio para patentes comerciales</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_certificado_capital_propio')">
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
        <div class="header-box mb-4">
            <div class="text-center mb-3">
                <h5 class="fw-bold mb-1">I. MUNICIPALIDAD DE VI�A DEL MAR</h5>
                <p class="mb-0 text-muted">Departamento de Rentas Municipales</p>
                <p class="mb-0 text-muted small">Rep�blica de Chile</p>
            </div>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Ingreso</label>
                    <input type="text" class="form-control" id="ingreso" placeholder="N° de Ingreso">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Fecha</label>
                    <input type="date" class="form-control" id="fecha">
                </div>
            </div>
        </div>

        <!-- 1. Informaci�n del Contribuyente/Empresa -->
        <div class="section-card">
            <div class="section-title">1. Informaci�n del Contribuyente/Empresa</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre o Raz�n Social</label>
                    <input type="text" class="form-control" id="nombreRazonSocial">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Domicilio Comercial</label>
                    <input type="text" class="form-control" id="domicilioComercial">
                </div>
                <div class="col-md-3">
                    <label class="form-label">R.U.T.</label>
                    <input type="text" class="form-control" id="rut" placeholder="12.345.678-9">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tel�fono</label>
                    <input type="tel" class="form-control" id="telefono">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Patente Rol</label>
                    <input type="text" class="form-control" id="patenteRol">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Giro</label>
                    <input type="text" class="form-control" id="giro">
                </div>
            </div>
        </div>

        <!-- 2. Destino de Presentaci�n del Certificado -->
        <div class="section-card">
            <div class="section-title">2. Destino de Presentaci�n del Certificado</div>
            <div class="mb-3">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="destino" id="destinoMunicipalidad"
                        value="municipalidad">
                    <label class="form-check-label" for="destinoMunicipalidad">
                        I. Municipalidad de
                    </label>
                </div>
                <input type="text" class="form-control ms-4 w-75" id="nombreMunicipalidad"
                    placeholder="Ingrese nombre de la Municipalidad">
            </div>
            <div class="mb-3">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="destino" id="destinoOtraInstitucion"
                        value="otra">
                    <label class="form-check-label" for="destinoOtraInstitucion">
                        Otra Instituci�n
                    </label>
                </div>
                <input type="text" class="form-control ms-4 w-75" id="nombreOtraInstitucion"
                    placeholder="Ingrese nombre de la Instituci�n">
            </div>
        </div>

        <!-- 3. Motivos de la Solicitud -->
        <div class="section-card">
            <div class="section-title">3. Motivos de la Solicitud</div>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="motivoAperturaSucursal">
                        <label class="form-check-label" for="motivoAperturaSucursal">
                            Apertura de Sucursal en otra Comuna
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="motivoOtro">
                        <label class="form-check-label" for="motivoOtro">
                            Otro Motivo
                        </label>
                    </div>
                    <textarea class="form-control ms-4" rows="2" id="otroMotivoDetalle"
                        placeholder="Especifique el motivo"></textarea>
                </div>
            </div>
        </div>

        <!-- 4. Total de Trabajadores -->
        <div class="section-card">
            <div class="section-title">4. Informaci�n Laboral</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Total de trabajadores empresa al 30/04/20...</label>
                    <input type="number" class="form-control" id="totalTrabajadores" min="0"
                        placeholder="Ingrese n�mero de trabajadores">
                </div>
            </div>
        </div>

        <!-- Firma y Recepci�n -->
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
                        <label class="form-label fw-bold text-muted">Uso Interno (Recepci�n)</label>
                        <div class="mb-3">
                            <label class="form-label small">Fecha de Recepci�n</label>
                            <input type="date" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">N�mero de Folio</label>
                            <input type="text" class="form-control" placeholder="Folio Autom�tico" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Recibido por</label>
                            <input type="text" class="form-control" placeholder="Funcionario" disabled>
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