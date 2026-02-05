<?php
$pageTitle = "Solicitud de Modificación de Domicilio";
require_once '../api/auth_check.php';
include '../api/header.php';
?>


    <div class="container-fluid">
        <h3 class="mb-4">Solicitud de Modificación y/o Rectificación de Domicilio</h3>

        <div id="form-container">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-sm btn-danger"
                    onclick="exportElementToPDF('form-container', 'solicitud_modificacion_domicilio')">
                    <i data-feather="file-text" class="me-1"></i> Exportar Formulario (PDF)
                </button>
            </div>

            <!-- Notes Alert -->
            <div class="alert alert-warning mb-4" role="alert">
                <div class="d-flex">
                    <div class="me-3"><i data-feather="alert-triangle"></i></div>
                    <div>
                        <h6 class="alert-heading fw-bold">Notas Importantes</h6>
                        <ul class="mb-0 small">
                            <li>Toda la documentación debe estar a nombre del contribuyente o de la sociedad si tiene
                                personalidad jurídica.</li>
                            <li>El domicilio debe corresponder al lugar donde se ejerce la actividad comercial.</li>
                            <li>Podrán ser requeridos otros documentos no mencionados para giros o rubros más
                                específicos.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 1. Identificación y Giro -->
            <div class="section-card">
                <div class="section-title">1. Identificación del Contribuyente y Actividad</div>
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
                            <label class="form-label fw-bold text-muted">Dirección Anterior</label>
                            <textarea class="form-control" id="direccionAnterior" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded border border-primary">
                            <label class="form-label fw-bold text-primary">Dirección Modificada (Nueva)</label>
                            <textarea class="form-control" id="direccionNueva" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Documentación Requerida -->
            <div class="section-card">
                <div class="section-title">3. Requisitos y Antecedentes (Marque lo que adjunta)</div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docPatente">
                            <label class="form-check-label" for="docPatente">Fotocopia simple de la(s) última(s)
                                patente(s) pagada(s).</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docCedula">
                            <label class="form-check-label" for="docCedula">Fotocopia Cédula de Identidad (P. Natural) o
                                RUT Sociedad y Rep. Legal.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docSII">
                            <label class="form-check-label" for="docSII">Fotocopia Aviso de Modificación de Domicilio
                                ante S.I.I.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docContribuciones">
                            <label class="form-check-label" for="docContribuciones">Fotocopia Recibo de Contribuciones o
                                NÂ° Rol Avalúo.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docCertNumero">
                            <label class="form-check-label" for="docCertNumero">Certificado de Número.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docFotos">
                            <label class="form-check-label" for="docFotos">2 Fotografías (interior y exterior) del
                                establecimiento.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docUrb">
                            <label class="form-check-label" for="docUrb">Certificado Técnico Urbanístico e Informe
                                Factibilidad Uso Suelo.</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="docRecepcion">
                            <label class="form-check-label" for="docRecepcion">Recepción Definitiva.</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="form-label fw-bold">Documentos Sanitarios (si aplican)</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docSanitaria">
                        <label class="form-check-label" for="docSanitaria">Resolución Sanitaria favorable (Seremi de
                            Salud - Quinta NÂ° 231).</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="docInofensiva">
                        <label class="form-check-label" for="docInofensiva">Calificación de Actividad Inofensiva y/o
                            Molesta (Seremi de Salud).</label>
                    </div>
                </div>
            </div>

            <!-- 4. Datos de Contacto y Firma -->
            <div class="section-card">
                <div class="section-title">4. Datos de Contacto y Firma</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Dirección Particular</label>
                        <input type="text" class="form-control" id="dirParticular">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Correo Electrónico</label>
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

            <!-- 5. Geolocalización (Google Maps) -->
            <div class="section-card">
                <div class="section-title">5. Geolocalización del Nuevo Domicilio</div>
                <div class="alert alert-info small" role="alert">
                    <i data-feather="map-pin" class="me-1"></i> Ingrese la dirección exacta para ubicarla en el mapa.
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Calle</label>
                        <input type="text" class="form-control" id="mapCalle" placeholder="Ej: Av. Providencia">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Número</label>
                        <input type="text" class="form-control" id="mapNumero" placeholder="Ej: 1234">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Comuna</label>
                        <input type="text" class="form-control" id="mapComuna" value="Santiago">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Región</label>
                        <input type="text" class="form-control" id="mapRegion" value="Metropolitana" readonly>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary btn-sm" onclick="buscarDireccion()">
                            <i data-feather="search" class="me-1"></i> Buscar en Mapa
                        </button>
                    </div>
                </div>

                <!-- Map Container -->
                <div id="map" style="height: 400px; width: 100%; border-radius: 8px; border: 1px solid #ddd;"
                    class="mb-3"></div>

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

        <!-- Actions -->
        <div class="d-flex justify-content-end mb-5 gap-2">
            <button class="btn btn-secondary">Cancelar</button>
            <button class="btn btn-primary" onclick="alert('Formulario Enviado')">Enviar Solicitud</button>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="../recursos/js/export_utils.js"></script>
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Maps Integration -->
    <script src="../recursos/js/maps_integration.js"></script>

    <!-- Google Maps API (Replace YOUR_API_KEY_HERE) -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&callback=initMap" async defer></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>


<?php include '../api/footer.php'; ?>

