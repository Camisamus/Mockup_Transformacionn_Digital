<?php
$pageTitle = "Solicitud de Revisi�n Cobro de Patente";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Revisi�n Cobro de Patente</h2>
            <p class="text-muted mb-0">Gestione la revisi�n y aclaraci�n de cobros para patentes municipales</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_revision_cobro')">
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
            <div class="d-flex">
                <div class="me-3"><i data-feather="info"></i></div>
                <div>
                    Dirigido a: <strong>Directora del Departamento de Patentes y Publicidad</strong>
                </div>
            </div>
        </div>

        <!-- 1. Identificaci�n Solicitante y Patente -->
        <div class="section-card">
            <div class="section-title">1. Identificaci�n de la Patente y Solicitante</div>
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
                    <label class="form-label">Nombre o Raz�n Social</label>
                    <input type="text" class="form-control" id="nombreRazonSocial">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giro</label>
                    <input type="text" class="form-control" id="giro">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Direcci�n</label>
                    <input type="text" class="form-control" id="direccion">
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombre de Contacto</label>
                    <input type="text" class="form-control" id="nombreContacto">
                </div>
                <div class="col-md-4">
                    <label class="form-label">E-MAIL</label>
                    <input type="email" class="form-control" id="emailContacto">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tel�fono</label>
                    <input type="tel" class="form-control" id="fonoContacto">
                </div>
            </div>
        </div>

        <!-- 2. Motivo de la Revisi�n -->
        <div class="section-card">
            <div class="section-title">2. Motivo de Revisi�n (Seleccione)</div>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="motivoCalculo">
                        <label class="form-check-label" for="motivoCalculo">C�lculo de Patente</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="motivoAseo">
                        <label class="form-check-label" for="motivoAseo">Doble Cobro de Aseo</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="motivoPropaganda">
                        <label class="form-check-label" for="motivoPropaganda">C�lculo Propaganda</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="motivoOtroCheck"
                            onclick="document.getElementById('motivoOtroText').disabled = !this.checked">
                        <label class="form-check-label" for="motivoOtroCheck">Otro (especificar)</label>
                    </div>
                    <input type="text" class="form-control mt-1 form-control-sm" id="motivoOtroText"
                        placeholder="Detalle el motivo..." disabled>
                </div>
            </div>
        </div>

        <!-- 3. Datos para Devoluci�n -->
        <div class="section-card">
            <div class="section-title">3. Datos Bancarios para Devoluci�n (Si aplica)</div>
            <p class="small text-muted">Complete solo si solicita devoluci�n de dinero.</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Titular de la Cuenta</label>
                    <input type="text" class="form-control" id="bancoTitular">
                </div>
                <div class="col-md-6">
                    <label class="form-label">RUT Titular</label>
                    <input type="text" class="form-control" id="bancoRut">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Banco</label>
                    <input type="text" class="form-control" id="bancoNombre">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tipo de Cuenta</label>
                    <select class="form-select" id="bancoTipoCuenta">
                        <option value="">Seleccione...</option>
                        <option value="Corriente">Cuenta Corriente</option>
                        <option value="Vista">Cuenta Vista / RUT</option>
                        <option value="Ahorro">Cuenta de Ahorro</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">N�mero de Cuenta</label>
                    <input type="text" class="form-control" id="bancoNumCuenta">
                </div>
            </div>
        </div>

        <!-- 4. Antecedentes a Adjuntar -->
        <div class="section-card">
            <div class="section-title">4. Antecedentes Adjuntos</div>
            <div class="alert alert-light border small text-muted mb-3">
                <strong>Requisito General:</strong> Se debe adjuntar Fotocopia de la(s) �ltima(s) Patente(s)
                Cancelada(s).
            </div>

            <div class="row g-3 align-items-center mb-2">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjRenta">
                        <label class="form-check-label fw-bold" for="adjRenta">Declaraci�n de Renta S.I.I.</label>
                    </div>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control form-control-sm" placeholder="Indicar A�os (ej: 2023, 2024)"
                        id="aniosRenta">
                </div>
            </div>

            <div class="row g-3 align-items-center mb-2">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjPatentes">
                        <label class="form-check-label fw-bold" for="adjPatentes">Patentes Anteriores</label>
                    </div>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control form-control-sm" placeholder="Indicar A�os / Semestres"
                        id="aniosPatentes">
                </div>
            </div>

            <div class="row g-3 align-items-center">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjOtros">
                        <label class="form-check-label fw-bold" for="adjOtros">Otros Antecedentes Fundantes</label>
                    </div>
                    <textarea class="form-control mt-2" rows="2" placeholder="Describa otros documentos adjuntos..."
                        id="otrosDocs"></textarea>
                </div>
            </div>
        </div>

        <!-- Firma -->
        <div class="section-card">
            <div class="mt-4">
                <label class="form-label fw-bold">Firma del Solicitante</label>
                <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                    id="seccionFirma">
                    [Espacio para Firma Digital o Manuscrita]
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