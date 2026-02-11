<?php
$pageTitle = "Solicitud de Certificado de Distribuci�n Capital Apertura Sucursal";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Certificado de Distribuci�n Capital Apertura Sucursal</h2>
            <p class="text-muted mb-0">Gestione la apertura de sucursales en otras comunas</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_certificado_apertura_sucursal')">
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
                <p class="mb-0 text-muted">Departamento de Patentes y Publicidad</p>
                <p class="mb-0 text-muted small">Rep�blica de Chile</p>
            </div>
            <div class="text-center mt-3">
                <h6 class="fw-bold text-primary">SOLICITUD DE CERTIFICADO DE DISTRIBUCI�N CAPITAL APERTURA SUCURSAL
                </h6>
            </div>
        </div>

        <!-- Alert Info -->
        <div class="alert alert-info mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="me-3"><i data-feather="info"></i></div>
                <div>
                    <strong>Informaci�n Importante:</strong> Este certificado es requerido para la apertura de
                    sucursales en otras comunas.
                    Aseg�rese de completar todos los campos y adjuntar la documentaci�n requerida.
                </div>
            </div>
        </div>

        <!-- 1. Datos de Identificaci�n del Contribuyente -->
        <div class="section-card">
            <div class="section-title">1. Datos de Identificaci�n del Contribuyente</div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">ROL</label>
                    <input type="text" class="form-control" id="rol" placeholder="Rol de Patente">
                </div>
                <div class="col-md-3">
                    <label class="form-label">RUT</label>
                    <input type="text" class="form-control" id="rut" placeholder="12.345.678-9">
                </div>
                <div class="col-md-6">
                    <label class="form-label">NOMBRE</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre o Raz�n Social">
                </div>
                <div class="col-md-6">
                    <label class="form-label">DIRECCI�N</label>
                    <input type="text" class="form-control" id="direccion" placeholder="Direcci�n Comercial">
                </div>
                <div class="col-md-6">
                    <label class="form-label">GIRO</label>
                    <input type="text" class="form-control" id="giro" placeholder="Giro Comercial">
                </div>
                <div class="col-md-6">
                    <label class="form-label">TEL�FONO</label>
                    <input type="tel" class="form-control" id="telefono" placeholder="+56 9 1234 5678">
                </div>
                <div class="col-md-6">
                    <label class="form-label">CORREO ELECTR�NICO</label>
                    <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.cl">
                </div>
            </div>
        </div>

        <!-- 2. Detalles de la Solicitud -->
        <div class="section-card">
            <div class="section-title">2. Detalles de la Solicitud</div>

            <div class="mb-4">
                <label class="form-label fw-bold">Ilustre Municipalidad de:</label>
                <input type="text" class="form-control" id="municipalidadDestino"
                    placeholder="Ingrese el nombre de la municipalidad de destino del certificado">
                <small class="text-muted">Indique la municipalidad donde se presentar� este certificado</small>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">N�mero trabajadores sucursal</label>
                    <input type="number" class="form-control" id="trabajadoresSucursal" min="0"
                        placeholder="Trabajadores proyectados en la nueva sucursal">
                    <small class="text-muted">N�mero de trabajadores proyectados en la nueva sucursal</small>
                </div>
            </div>
        </div>

        <!-- 3. Declaraci�n Trabajadores Casa Matriz -->
        <div class="section-card">
            <div class="section-title">3. Declaraci�n Trabajadores Casa Matriz Vi�a del Mar</div>

            <div class="info-badge mb-3">
                <i data-feather="users" class="me-2"></i>
                <strong>Declaraci�n de Trabajadores:</strong> Indique el n�mero total de trabajadores de la casa
                matriz en Vi�a del Mar
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">N�mero trabajadores</label>
                    <input type="number" class="form-control" id="trabajadoresCasaMatriz" min="0"
                        placeholder="Total de trabajadores en casa matriz">
                    <small class="text-muted">Total de trabajadores de la casa matriz en Vi�a del Mar</small>
                </div>
            </div>
        </div>

        <!-- 4. Antecedentes Adjuntos -->
        <div class="section-card">
            <div class="section-title">4. Antecedentes Adjuntos (Requisitos Obligatorios)</div>

            <div class="alert alert-warning mb-3" role="alert">
                <div class="d-flex">
                    <div class="me-3"><i data-feather="alert-triangle"></i></div>
                    <div>
                        <strong>Documentos Requeridos:</strong> Debe adjuntar todos los documentos listados a
                        continuaci�n para procesar su solicitud.
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjFormulario">
                        <label class="form-check-label fw-bold" for="adjFormulario">
                            Formulario de solicitud completo
                        </label>
                        <div class="ms-4 mt-1">
                            <small class="text-muted">Disponible en el Sitio Web y en el M�dulo de Informaciones del
                                Departamento de Patentes y Publicidad</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjPatentes">
                        <label class="form-check-label fw-bold" for="adjPatentes">
                            Fotocopia de la(s) �ltima(s) Patente(s) Cancelada(s)
                        </label>
                        <div class="ms-4 mt-1">
                            <small class="text-muted">Adjuntar copia de las patentes municipales pagadas</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjSII">
                        <label class="form-check-label fw-bold" for="adjSII">
                            Formulario S.I.I con apertura Sucursal
                        </label>
                        <div class="ms-4 mt-1">
                            <small class="text-muted">Formulario del Servicio de Impuestos Internos que acredita la
                                apertura de la sucursal</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Firma y Recepci�n -->
        <div class="section-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="mt-4">
                        <label class="form-label fw-bold">FIRMA DEL CONTRIBUYENTE O REPRESENTANTE LEGAL</label>
                        <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                            id="seccionFirma">
                            [Firma Digital o Manuscrita]
                        </div>
                        <div class="mt-3">
                            <label class="form-label small">Nombre del Firmante</label>
                            <input type="text" class="form-control" id="nombreFirmante" placeholder="Nombre completo">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border-start">
                    <div class="mt-4 ps-md-3">
                        <label class="form-label fw-bold text-muted">Uso Interno (Recepci�n Municipal)</label>
                        <div class="mb-3">
                            <label class="form-label small">Fecha de Recepci�n</label>
                            <input type="date" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">N�mero de Ingreso</label>
                            <input type="text" class="form-control" placeholder="Folio Autom�tico" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Recibido por</label>
                            <input type="text" class="form-control" placeholder="Funcionario Municipal" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Observaciones</label>
                            <textarea class="form-control" rows="2" disabled></textarea>
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