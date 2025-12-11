let map;
let marker;
let geocoder;

function initMap() {
    // Default location: Santiago, Chile
    const defaultLocation = { lat: -33.4489, lng: -70.6693 };

    // Initialize Map
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: defaultLocation,
    });

    // Initialize Geocoder
    geocoder = new google.maps.Geocoder();

    // Initialize Marker (hidden at first)
    marker = new google.maps.Marker({
        map: map,
        draggable: true, // Allow user to refine position
    });

    // Update inputs when marker works
    marker.addListener("dragend", () => {
        const position = marker.getPosition();
        updateCoordinates(position);
    });
}

function buscarDireccion() {
    const calle = document.getElementById("mapCalle").value;
    const numero = document.getElementById("mapNumero").value;
    const comuna = document.getElementById("mapComuna").value;
    const region = document.getElementById("mapRegion").value;

    if (!calle || !numero || !comuna) {
        alert("Por favor ingrese Calle, Número y Comuna.");
        return;
    }

    const address = `${calle} ${numero}, ${comuna}, ${region}, Chile`;

    geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
            const location = results[0].geometry.location;

            // Center map
            map.setCenter(location);
            map.setZoom(16);

            // Set marker
            marker.setPosition(location);
            marker.setVisible(true);

            // Update inputs
            updateCoordinates(location);
        } else {
            alert("No se pudo encontrar la dirección: " + status);
        }
    });
}

function updateCoordinates(latLng) {
    document.getElementById("mapLat").value = latLng.lat();
    document.getElementById("mapLng").value = latLng.lng();
}
