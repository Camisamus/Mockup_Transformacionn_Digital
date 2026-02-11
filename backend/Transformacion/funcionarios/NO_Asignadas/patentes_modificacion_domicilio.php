<?php
$pageTitle = "Solicitud de Modificaci�n de Domicilio";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de Modificaci�n y/o Rectificaci�n de Domicilio</h2>
            <p class="text-muted mb-0">Gestione la actualizaci�n de domicilio para patentes comerciales</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_modificacion_domicilio')">
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
                        <li>Toda la documentaci�n debe estar a nombre del contribuyente o de la sociedad si tiene
                            personalidad jur�dica.</li>
                        <li>El domicilio debe corresponder al lugar donde se ejerce la actividad comercial.</li>
                        <li>Podr�n ser requeridos otros documentos no mencionados para giros o rubros m�s
                            espec�ficos.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 1. Identificaci�n y Giro -->
        <div class="section-card">
            <div class="section-title">1. Identificaci�n del Contribuyente y Actividad</div>
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
                <div class="col-12">
                    <label class="form-label">Giro de la patente(s) a modificar</label>
                    <input type="text" class="form-control" id="giroPatente">
                </div>
            </div>
        </div>

        <!-- 2. Cambio de Domicilio -->
        <div class="section-card">
            <div class="section-title">2. Antecedentes del Domicilio</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border">
                        <label class="form-label fw-bold text-muted">Direcci�n Anterior</label>
                        <textarea class="form-control" id="direccionAnterior" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded border border-primary">
                        <label class="form-label fw-bold text-primary">Direcci�n Modificada (Nueva)</label>
                        <textarea class="form-control" id="direccionNueva" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Documentaci�n Requerida -->
        <div class="section-card">
            <div class="section-title">3. Requisitos y Antecedentes (Marque lo que adjunta)</div>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docPatente">
                        <label class="form-check-label" for="docPatente">Fotocopia simple de la(s) �ltima(s)
                            patente(s) pagada(s).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docCedula">
                        <label class="form-check-label" for="docCedula">Fotocopia C�dula de Identidad (P. Natural) o
                            RUT Sociedad y Rep. Legal.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSII">
                        <label class="form-check-label" for="docSII">Fotocopia Aviso de Modificaci�n de Domicilio
                            ante S.I.I.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docContribuciones">
                        <label class="form-check-label" for="docContribuciones">Fotocopia Recibo de Contribuciones o
                            N° Rol Aval�o.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docCertNumero">
                        <label class="form-check-label" for="docCertNumero">Certificado de N�mero.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docFotos">
                        <label class="form-check-label" for="docFotos">2 Fotograf�as (interior y exterior) del
                            establecimiento.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docUrb">
                        <label class="form-check-label" for="docUrb">Certificado T�cnico Urban�stico e Informe
                            Factibilidad Uso Suelo.</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docRecepcion">
                        <label class="form-check-label" for="docRecepcion">Recepci�n Definitiva.</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label fw-bold">Documentos Sanitarios (si aplican)</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="docSanitaria">
                    <label class="form-check-label" for="docSanitaria">Resoluci�n Sanitaria favorable (Seremi de
                        Salud - Quinta N° 231).</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="docInofensiva">
                    <label class="form-check-label" for="docInofensiva">Calificaci�n de Actividad Inofensiva y/o
                        Molesta (Seremi de Salud).</label>
                </div>
            </div>
        </div>

        <!-- 4. Datos de Contacto y Firma -->
        <div class="section-card">
            <div class="section-title">4. Datos de Contacto y Firma</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Direcci�n Particular</label>
                    <input type="text" class="form-control" id="dirParticular">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tel�fono</label>
                    <input type="tel" class="form-control" id="telefono">
                </div>
                <div class="col-12">
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

        <!-- 5. Geolocalizaci�n (Google Maps) -->
        <div class="section-card">
            <div class="section-title">5. Geolocalizaci�n del Nuevo Domicilio</div>
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