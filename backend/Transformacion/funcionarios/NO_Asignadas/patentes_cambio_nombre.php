<?php
$pageTitle = "Solicitud de Cambio de Nombre";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Cambio de Nombre</h2>
            <p class="text-muted mb-0">Gestione la actualizaci�n de nombre para patentes comerciales</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_cambio_nombre')">
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
                    <button class="btn btn-toolbar btn-dark w-100 shadow-sm" onclick="alert('Formulario Enviado')">
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
        <!-- Notes Alert -->
        <div class="alert alert-warning mb-4" role="alert">
            <div class="d-flex">
                <div class="me-3"><i data-feather="alert-triangle"></i></div>
                <div>
                    <h6 class="alert-heading fw-bold">Notas Importantes</h6>
                    <ul class="mb-0 small">
                        <li>La documentaci�n debe estar emitida a nombre del contribuyente o de la sociedad.</li>
                        <li>El domicilio debe corresponder al lugar donde se ejerce la actividad comercial.</li>
                        <li>Un croquis claro de la ubicaci�n exacta agilizar� la visita inspectiva.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 1. Datos de la Solicitud -->
        <div class="section-card">
            <div class="section-title">1. Datos de la Patente y Cambio de Nombre</div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Rol Patente</label>
                    <input type="text" class="form-control" id="rolPatente">
                </div>
                <div class="col-md-9">
                    <label class="form-label">Giro</label>
                    <input type="text" class="form-control" id="giroPatente">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold text-muted">Nombre ANTERIOR</label>
                    <input type="text" class="form-control bg-light" id="nombreAnterior">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-primary">Nombre ACTUAL (Nuevo)</label>
                    <input type="text" class="form-control border-primary" id="nombreActual">
                </div>

                <div class="col-md-4">
                    <label class="form-label">RUT</label>
                    <input type="text" class="form-control" id="rutContribuyente">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Direcci�n</label>
                    <input type="text" class="form-control" id="direccion">
                </div>
            </div>
        </div>

        <!-- 2. Requisitos y Documentaci�n -->
        <div class="section-card">
            <div class="section-title">2. Requisitos y Documentaci�n (Marque lo que adjunta)</div>

            <div class="subsection-header">General Requerido</div>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docPatente">
                        <label class="form-check-label" for="docPatente">Fotocopia simple de �ltima(s) patenete(s)
                            pagada(s).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docCompraventa">
                        <label class="form-check-label" for="docCompraventa">Contrato Compraventa legalizado ante
                            notario.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docArriendo">
                        <label class="form-check-label" for="docArriendo">Contrato Arrendamiento o Escritura
                            Propiedad (Legalizado).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSII">
                        <label class="form-check-label" for="docSII">Iniciaci�n Actividades S.I.I. / Avisos
                            Modificaciones.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docFotos">
                        <label class="form-check-label" for="docFotos">2 Fotograf�as del establecimiento (interior y
                            exterior).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docTecnico">
                        <label class="form-check-label" for="docTecnico">Certificado T�cnico Urban�stico
                            (DOM).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docUsoSuelo">
                        <label class="form-check-label" for="docUsoSuelo">Informe Factibilidad Uso Suelo
                            (DOM).</label>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="subsection-header">Persona Natural</div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docCedula">
                        <label class="form-check-label" for="docCedula">Fotocopia C�dula de Identidad.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="subsection-header">Persona Jur�dica</div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSociedad">
                        <label class="form-check-label" for="docSociedad">Fotocopia RUT Sociedad y C.I. Rep.
                            Legal.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docEscritura">
                        <label class="form-check-label" for="docEscritura">Escritura Sociedad, Extracto, Vigencia (y
                            Acta S.A.).</label>
                    </div>
                </div>
            </div>

            <div class="subsection-header text-primary mt-3">Requisitos Espec�ficos por Giro</div>
            <div class="row g-2">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSanitaria">
                        <label class="form-check-label" for="docSanitaria">Resoluci�n Sanitaria Favorable
                            (Alimentos, M�dicos, etc.).</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docInformeSanitario">
                        <label class="form-check-label" for="docInformeSanitario">Informe Sanitario / Calif.
                            Inofensiva o Molesta (Talleres, Bodegas).</label>
                    </div>
                </div>
            </div>

            <div class="subsection-header text-danger mt-3">Patentes de Alcohol / Sucursales</div>
            <div class="row g-2">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docAlcohol">
                        <label class="form-check-label" for="docAlcohol">Cert. Antecedentes y DJ Art. 4° Ley 19.925
                            (Alcoholes).</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSucursal">
                        <label class="form-check-label" for="docSucursal">Apertura Sucursal S.I.I. y Cert.
                            Distribuci�n Capital (Sucursales).</label>
                    </div>
                </div>
            </div>

        </div>

        <!-- 3. Datos de Contacto y Firma -->
        <div class="section-card">
            <div class="section-title">3. Datos de Contacto y Firma</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre Contacto</label>
                    <input type="text" class="form-control" id="nombreContacto">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tel�fono</label>
                    <input type="tel" class="form-control" id="telefono">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Direcci�n Particular</label>
                    <input type="text" class="form-control" id="dirParticular">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Correo Electr�nico</label>
                    <input type="email" class="form-control" id="email">
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label fw-bold">Firma del Contribuyente o Representante Legal</label>
                <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                    id="seccionFirma">
                    [Espacio para Firma Digital]
                </div>
            </div>
        </div>

        <!-- 4. Geolocalizaci�n (Google Maps) -->
        <div class="section-card">
            <div class="section-title">4. Geolocalizaci�n</div>
            <div class="alert alert-info small" role="alert">
                <i data-feather="map-pin" class="me-1"></i> Ingrese la direcci�n exacta para ubicarla en el mapa.
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Calle</label>
                    <input type="text" class="form-control" id="mapCalle" placeholder="Ej: Av. Providencia">
                </div>
                <div class="col-md-2">
                    <label class="form-label">N�mero</label>
                    <input type="text" class="form-control" id="mapNumero" placeholder="Ej: 1234">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Comuna</label>
                    <input type="text" class="form-control" id="mapComuna" value="Santiago">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Regi�n</label>
                    <input type="text" class="form-control" id="mapRegion" value="Metropolitana" readonly>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary btn-sm" onclick="buscarDireccion()">
                        <i data-feather="search" class="me-1"></i> Buscar en Mapa
                    </button>
                </div>
            </div>

            <!-- Map Container -->
            <div id="map" style="height: 400px; width: 100%; border-radius: 8px; border: 1px solid #ddd;" class="mb-3">
            </div>

            <!-- Coordinates -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Latitud</label>
                    <input type="text" class="form-control form-control-sm bg-light" id="mapLat" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Longitud</label>
                    <input type="text" class="form-control form-control-sm bg-light" id="mapLng" readonly>
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
<!-- Custom Maps Integration -->
<script src="../../recursos/js/maps_integration.js"></script>

<!-- Google Maps API (Replace YOUR_API_KEY_HERE) -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&callback=initMap" async defer></script>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>