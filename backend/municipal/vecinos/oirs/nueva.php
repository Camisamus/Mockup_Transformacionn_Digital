<?php
include_once(__DIR__ . '/../layout/layout.php');

$page_title = "Nueva Solicitud OIRS";

// Capturamos el contenido en una variable para el layout
ob_start();
?>
<div class="container py-5">
    <div class="card border-0 shadow-sm" style="border-radius: 0;">
        <!-- Header Formulario -->
        <div class="card-header p-5 bg-light border-bottom d-flex align-items-center justify-content-between" style="border-radius: 0;">
            <div class="mr-3">
                <h2 class="h3 font-serif font-bold text-dark mb-2">Ingreso de Nueva Solicitud</h2>
                <p class="text-muted mb-0 font-weight-medium" style="font-size: 14px;">Complete el formulario oficial para procesar su requerimiento ciudadano.</p>
            </div>
            <div class="d-flex align-items-center justify-content-center border border-primary text-primary" style="width: 64px; height: 64px; background-color: rgba(0, 111, 179, 0.1);">
                <span class="material-symbols-outlined" style="font-size: 40px;">add_task</span>
            </div>
        </div>

        <form class="card-body p-5" id="oirsForm">
            <!-- Sección 1: Categorización -->
            <section class="mb-5">
                <h3 class="h5 font-serif font-bold text-dark d-flex align-items-center mb-4">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mr-3" style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">01</span>
                    Categorización del Requerimiento
                </h3>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold text-muted text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.1em;">Área Temática</label>
                        <select id="tematica" name="tematica" class="select2-base w-100">
                            <option value="">Seleccione Temática...</option>
                            <option value="aseo">Aseo y Ornato</option>
                            <option value="seguridad">Seguridad Pública</option>
                            <option value="iluminacion">Iluminación</option>
                            <option value="transito">Tránsito y Transporte</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="font-weight-bold text-muted text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.1em;">Subcategoría</label>
                        <select id="subtematica" name="subtematica" class="select2-base w-100">
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- Sección 2: Ubicación -->
            <section class="mb-5">
                <h3 class="h5 font-serif font-bold text-dark d-flex align-items-center mb-4">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mr-3" style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">02</span>
                    Localización Geográfica
                </h3>
                <div class="form-group mb-4">
                    <div class="position-relative">
                        <span class="material-symbols-outlined position-absolute" style="left: 15px; top: 12px; color: #94a3b8;">location_on</span>
                        <input type="text" id="address-input" placeholder="Ingrese o busque la dirección en la comuna..." class="form-control form-control-lg border-2 border-light shadow-none" style="padding-left: 48px; border-radius: 4px; font-size: 14px;">
                    </div>
                </div>
                <!-- Mapa de Google -->
                <div id="map" class="w-100 bg-light border-2 border-light border-dashed position-relative overflow-hidden mb-4" style="height: 320px; border-radius: 4px;">
                    <div class="position-absolute h-100 w-100 d-flex align-items-center justify-content-center bg-light">
                        <div class="text-center">
                            <span class="material-symbols-outlined text-muted" style="font-size: 48px;">map</span>
                            <p class="font-weight-bold text-muted text-uppercase mt-2" style="font-size: 10px; letter-spacing: 0.1em;">Cargando Mapa Institucional...</p>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
            </section>

            <!-- Sección 3: Evidencia y Descripción -->
            <section class="mb-5">
                <h3 class="h5 font-serif font-bold text-dark d-flex align-items-center mb-4">
                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mr-3" style="width: 32px; height: 32px; font-size: 12px; font-weight: bold;">03</span>
                    Detalles y Evidencia
                </h3>
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-muted text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.1em;">Relato de la Situación</label>
                    <textarea rows="4" placeholder="Describa de forma clara y precisa el problema detectado..." class="form-control border-2 border-light shadow-none" style="padding: 1rem 1.5rem; font-size: 14px; border-radius: 4px;"></textarea>
                </div>
                
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-muted text-uppercase mb-2 d-block" style="font-size: 11px; letter-spacing: 0.1em;">Registro Fotográfico (Opcional)</label>
                    <div class="custom-file-upload d-flex flex-column align-items-center justify-content-center bg-light border-2 border-dashed border-light rounded cursor-pointer" style="height: 180px;">
                        <span class="material-symbols-outlined text-muted mb-2" style="font-size: 40px;">cloud_upload</span>
                        <p class="font-weight-bold text-muted text-uppercase mb-1" style="font-size: 12px; letter-spacing: 0.1em;">Subir archivo adjunto</p>
                        <p class="text-muted mb-0" style="font-size: 10px;">Formatos permitidos: JPG, PNG • Máx: 5MB</p>
                        <input type="file" class="d-none" id="fileInput">
                    </div>
                </div>
            </section>

            <!-- Footer Formulario -->
            <div class="pt-4 d-flex flex-column flex-sm-row" style="gap: 1.25rem;">
                <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center font-weight-bold py-3 px-5 text-uppercase" style="letter-spacing: 0.1em; flex: 1;">
                    <span class="material-symbols-outlined mr-2">send</span>
                    Registrar Solicitud
                </button>
                <a href="index.php" class="btn btn-outline-secondary d-flex align-items-center justify-content-center font-weight-bold py-3 px-5 text-uppercase" style="letter-spacing: 0.1em; border-width: 2px;">Regresar</a>
            </div>
        </form>
    </div>
</div>

<style>
/* Adaptación de Select2 al look institucional */
.select2-container--default .select2-selection--single {
    height: 48px !important;
    background-color: #FFF !important;
    border: 2px solid #F1F1F1 !important;
    border-radius: 4px !important;
    display: flex !important;
    align-items: center !important;
    padding: 0 1rem !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    font-size: 14px !important;
    font-weight: 500 !important;
    color: #444 !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    top: 0 !important;
    right: 1rem !important;
}
.select2-dropdown {
    border: 2px solid #F1F1F1 !important;
    border-radius: 4px !important;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    background-color: #FFF !important;
}
.select2-results__option--highlighted[aria-selected] {
    background-color: var(--gob-primary) !important;
}

.custom-file-upload:hover {
    background-color: #ECECEC !important;
    border-color: var(--gob-primary) !important;
}
.custom-file-upload:hover .material-symbols-outlined {
    color: var(--gob-primary) !important;
}

.border-light { border-color: #F1F1F1 !important; }
.cursor-pointer { cursor: pointer; }
</style>

<!-- Google Maps SDK -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

<script>
$(document).ready(function() {
    // Inicializar Select2
    $('.select2-base').select2({
        width: '100%',
        language: {
            noResults: function() { return "No se encontraron resultados"; },
            searching: function() { return "Buscando..."; }
        }
    });

    // Lógica dinámica de Subtemáticas
    const subtemas = {
        'aseo': ['Microbasural', 'Poda de Árboles', 'Retiro de Escombros', 'Limpieza de Quebradas'],
        'seguridad': ['Patrullaje Preventivo', 'Instalación de Alarmas', 'Denuncia de Actividad Ilícita'],
        'iluminacion': ['Poste Apagado', 'Luminaria Parpadeando', 'Nuevo Punto de Luz'],
        'transito': ['Señalética Dañada', 'Bache en Calzada', 'Semaforización']
    };

    $('#tematica').on('change', function() {
        const val = $(this).val();
        const $sub = $('#subtematica');
        $sub.html('<option value="">Seleccione Subtemática...</option>');
        
        if (subtemas[val]) {
            subtemas[val].forEach(t => {
                $sub.append(new Option(t, t.toLowerCase().replace(/\s+/g, '_')));
            });
        }
        $sub.trigger('change');
    });

    // Google Maps Integration
    function initMap() {
        const defaultLoc = { lat: -33.0245, lng: -71.5518 }; // Viña del Mar centro
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: defaultLoc,
            styles: [
                { "featureType": "all", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}] },
                { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": 0.84}] },
                { "featureType": "all", "elementType": "labels.icon", "stylers": [{"visibility": "off"}] },
                { "featureType": "administrative", "elementType": "geometry", "stylers": [{"weight": 0.6}, {"color": "#1a3541"}] }
            ] // Opcional: Estilo oscuro/moderno para el mapa
        });

        const marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: defaultLoc,
            animation: google.maps.Animation.DROP,
            icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            }
        });

        const input = document.getElementById("address-input");
        const autocomplete = new google.maps.places.Autocomplete(input, {
             componentRestrictions: { country: "cl" },
             fields: ["address_components", "geometry", "icon", "name"],
             strictBounds: false,
        });

        autocomplete.bindTo("bounds", map);

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (!place.geometry || !place.geometry.location) {
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            updateCoords(place.geometry.location);
        });

        marker.addListener("dragend", () => {
            updateCoords(marker.getPosition());
        });

        function updateCoords(location) {
            $('#lat').val(location.lat());
            $('#lng').val(location.lng());
        }
    }

    // Si Google Maps falla al cargar (por API KEY), mostramos un aviso
    if (typeof google === 'object' && typeof google.maps === 'object') {
        initMap();
    } else {
        $('#map').html(`
            <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-center" style="gap: 1rem;">
                <span class="material-symbols-outlined text-warning" style="font-size: 48px;">warning</span>
                <p class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.1em; line-height: 1.6;">
                    Google Maps no pudo cargarse.<br>Verifique su API KEY o conexión a internet.
                </p>
                <button type="button" class="btn btn-light btn-sm text-secondary font-weight-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.1em; border-radius: 20px; padding: 0.5rem 1.5rem;">Reintentar</button>
            </div>
        `);
    }

    // Manejo de envío
    $('#oirsForm').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Confirmar Solicitud?',
            text: "Se ingresará su requerimiento al sistema de atención ciudadana.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#137fec',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, Enviar',
            cancelButtonText: 'Revisar',
            borderRadius: '24px'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡Solicitud Enviada!',
                    text: 'Su código de seguimiento es: #OIRS-2026-XXXX',
                    icon: 'success',
                    borderRadius: '24px'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            }
        });
    });
});
</script>
<?php
$content = ob_get_clean();
renderLayout($page_title, $content);
?>
