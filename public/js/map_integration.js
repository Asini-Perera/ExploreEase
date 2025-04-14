let marker;

function initMap() {
    const initialLocation = {
        lat: 6.9271,
        lng: 79.8612
    }; // Default center: Colombo

    const map = new google.maps.Map(document.getElementById("map"), {
        center: initialLocation,
        zoom: 8,
    });

    map.addListener("click", (event) => {
        const clickedLocation = event.latLng;

        // If marker exists, just move it
        if (marker) {
            marker.setPosition(clickedLocation);
        } else {
            marker = new google.maps.Marker({
                position: clickedLocation,
                map: map,
            });
        }

        // Set lat/lng values in hidden fields
        document.getElementById("latitude").value = clickedLocation.lat();
        document.getElementById("longitude").value = clickedLocation.lng();
    });
}

// Initialize map when page loads
window.onload = initMap;