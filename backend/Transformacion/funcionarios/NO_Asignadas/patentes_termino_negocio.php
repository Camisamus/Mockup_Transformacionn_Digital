<?php
$pageTitle = "Solicitud de T¿rmino de Negocio";
require_once '../../api/auth_check.php';
include 'header.php';
?>


<div class="container-fluid py-4">
    <div class="main-header mb-4">
        <div class="header-title">
            <h2 class="fw-bold fs-4">Solicitud de T¿rmino de Negocio</h2>
            <p class="text-muted mb-0">Gestione el cierre formal de actividades para patentes comerciales</p>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="card shadow-sm border-0 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row g-2 justify-content-md-end">
                <div class="col-12 col-md-auto">
                    <button class="btn btn-toolbar btn-outline-danger w-100 shadow-sm"
                        onclick="exportElementToPDF('form-container', 'solicitud_termino_negocio')">
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
        <!-- 1. Identificación Solicitante -->
        <div class="section-card">
            <div class="section-title">1. Identificación del Contribuyente y Patente</div>
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
                    <label class="form-label">Dirección (Calle, N°, Población)</label>
                    <input type="text" class="form-control" id="direccion">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Giro</label>
                    <input type="text" class="form-control" id="giro">
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

        <!-- 2. Estado de Deuda -->
        <div class="section-card">
            <div class="section-title">2. Estado de la Patente (Deuda)</div>
            <div class="alert alert-warning small mb-3">
                <strong>Importante:</strong> Si existe deuda, debe pagar o suscribir convenio en el Depto. de
                Cobranzas.
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estadoDeuda" id="deudaSinDeuda">
                        <label class="form-check-label" for="deudaSinDeuda">Sin Deuda</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estadoDeuda" id="deudaConDeuda">
                        <label class="form-check-label" for="deudaConDeuda">Con Deuda (Adjuntar Cert.
                            Cobranzas)</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="estadoDeuda" id="deudaConvenio">
                        <label class="form-check-label" for="deudaConvenio">Con Convenio (Adjuntar Cert.
                            Cobranzas)</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Antecedentes -->
        <div class="section-card">
            <div class="section-title">3. Antecedentes Adjuntos (Marque lo que adjunta)</div>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjPatente">
                        <label class="form-check-label" for="adjPatente">Fotocopia simple ¿ltima Patente pagada (al
                            d¿a).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjTerminoGiro">
                        <label class="form-check-label" for="adjTerminoGiro">T¿rmino de Giro / Cierre Sucursal
                            (S.I.I.).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjF29">
                        <label class="form-check-label" for="adjF29">Fotocopia F-29 sin movimientos (o fundantes
                            actividad).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjHonorarios">
                        <label class="form-check-label" for="adjHonorarios">Resumen Boletas Honorarios (Patente
                            Profesional).</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="adjCobranzas">
                        <label class="form-check-label" for="adjCobranzas">Certificado Depto. Cobranzas (si hay
                            deuda/convenio).</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Geolocalización (Google Maps) -->
        <div class="section-card">
            <div class="section-title">4. Geolocalización</div>
            <div class="alert alert-info small" role="alert">
                <i data-feather="map-pin" class="me-1"></i> Ingrese la dirección exacta para ubicarla en el mapa.
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Calle</label>
                    <input type="text" class="form-control" id="mapCalle" placeholder="Ej: Av. Providencia">
                </div>
                <div class="col-md-2">
                    <label class="form-label">N°mero</label>
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

        <!-- Firma y Fiscalización -->
        <div class="section-card">
            <div class="mt-2">
                <label class="form-label fw-bold">Firma del Contribuyente</label>
                <div class="border border-2 border-secondary border-dashed p-5 text-center text-muted rounded bg-light"
                    id="seccionFirma">
                    [Firma Digital]
                </div>
            </div>
            <div class="mt-4 pt-3 border-top">
                <label class="form-label fw-bold text-muted small text-uppercase">Uso Exclusivo Dpto.
                    Fiscalización</label>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label small">Fecha Fiscalización</label>
                        <input type="date" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="col-md-9">
                        <label class="form-label small">Informe (Verificación Dirección y Estado Patente)</label>
                        <textarea class="form-control form-control-sm bg-light" rows="3" disabled></textarea>
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
<!-- Custom Maps Integration -->
<script src="../../recursos/js/maps_integration.js"></script>

<!-- Google Maps API (Replace YOUR_API_KEY_HERE) -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&callback=initMap" async defer></script>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


<?php include '../../api/footer.php'; ?>