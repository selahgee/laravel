@extends('layouts.app')

@section('content')

<div class="container">
    <h1><strong>Book Ambulance</strong></h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div id="map" style="height: 400px;"></div>
    <input type="hidden" name="pickup_latitude" id="pickup_latitude">
    <input type="hidden" name="pickup_longitude" id="pickup_longitude">
   
    <div class="form-container">
        <label for="medical_requirements">Medical Requirements:</label>
        <textarea name="medical_requirements" id="medical_requirements" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <div class="btn-primary">
            <button type="button" class="btn btn-primary" onclick="confirmSelection()">Book Ambulance</button>
        </div>
    </div>
    <div id="distance_time_result"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    var map;
    var userMarker;
    var selectedHospitalMarker = null;
    var selectedHospitalId = null;
    var directionsService;
    var directionsRenderer;

    $(document).ready(function() {
        initMap();
    });

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: -1.2921, lng: 36.8219 }, // Nairobi coordinates
            zoom: 8
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: true
        });

        map.addListener('click', function(event) {
            placeMarker(event.latLng);
        });

        populateHospitals();
    }

    function placeMarker(location) {
        if (!userMarker) {
            userMarker = new google.maps.Marker({
                position: location,
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
            });
            document.getElementById('pickup_latitude').value = location.lat();
            document.getElementById('pickup_longitude').value = location.lng();
        } else if (!selectedHospitalMarker) {
            selectedHospitalMarker = new google.maps.Marker({
                position: location,
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
            });
            selectedHospitalId = location.id; // Assuming hospital ID is passed as the ID of the marker
            calculateAndDisplayRoute(userMarker.getPosition(), selectedHospitalMarker.getPosition());
        }
    }

    function populateHospitals() {
        $.ajax({
            url: '/api/hospitals/nearby',
            data: { latitude: map.getCenter().lat(), longitude: map.getCenter().lng(), radius: 3000 },
            success: function(hospitals) {
                displayHospitals(hospitals);
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to fetch hospitals.');
            }
        });
    }

   function confirmSelection() {
    var medicalRequirements = document.getElementById('medical_requirements').value;
    if (!medicalRequirements) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter your medical requirements!',
        });
        return;
    }

    // Calculate distance and time
    var origin = userMarker.getPosition();
    var destination = selectedHospitalMarker.getPosition();
    var distance = calculateDistance(origin, destination);
    var duration = calculateDuration(distance);

    // Ask for confirmation with distance and time
    Swal.fire({
        title: 'Booking Confirmation',
        html: 'Distance: ' + distance + ' km<br>Time: ' + duration + ' minutes<br>Are you sure you want to book the ambulance?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, book it!',
        cancelButtonText: 'No, cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Calculate and display shortest route
            calculateShortestRoute(origin, destination);

            // Store booking information in the database
            var bookingData = {
                _token: '{{ csrf_token() }}', // Include CSRF token
                pickup_latitude: document.getElementById('pickup_latitude').value,
                pickup_longitude: document.getElementById('pickup_longitude').value,
                hospital_latitude: selectedHospitalMarker.getPosition().lat(),
                hospital_longitude: selectedHospitalMarker.getPosition().lng(),
                medical_requirements: medicalRequirements,
};


            // Send AJAX request to save booking data
            $.ajax({
                url: '/bookings', // Your booking route
                method: 'POST',
                data: bookingData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Booking Successful!',
                        text: 'Your ambulance has been booked.',
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to book ambulance. Please try again later.',
                    });
                }
            });
        }
    });
}

function calculateDistance(origin, destination) {
    return (google.maps.geometry.spherical.computeDistanceBetween(origin, destination) / 1000).toFixed(2); // Convert meters to kilometers
}

function calculateDuration(distance) {
    // Assume average ambulance speed of 60 km/h
    return Math.round((distance / 60) * 60); // Convert hours to minutes
}

function calculateShortestRoute(origin, destination) {
    // Use Directions API to calculate shortest route
    // Display the route with a different line color
    var request = {
        origin: origin,
        destination: destination,
        travelMode: 'DRIVING',
        provideRouteAlternatives: true,
    };
    directionsService.route(request, function(response, status) {
        if (status === 'OK') {
            // Show the shortest route (first route alternative)
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(0); // Show the first route
            directionsRenderer.setOptions({ polylineOptions: { strokeColor: '#00FF00' } }); // Green color for shortest route
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

</script>

<!-- Include the Google Maps API script here -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endsection
@push('styles')
<link href="{{ asset('css/booking.css') }}" rel="stylesheet">
@endpush
