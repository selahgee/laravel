


<?php $__env->startSection('content'); ?>

<div class="container">
    <?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h1><strong>Book Ambulance</strong></h1>
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <div id="map" style="height: 400px;"></div>
    <input type="hidden" name="pickup_latitude" id="pickup_latitude">
    <input type="hidden" name="pickup_longitude" id="pickup_longitude">
    <div class="form-group">
        <label for="hospital">Select Hospital:</label>
        <select name="hospital" id="hospital" class="form-control">
            <!-- Hospitals will be populated dynamically using JavaScript -->
        </select>
    </div>
    <div class="form-group">
        <label for="medical_requirements">Medical Requirements:</label>
        <textarea name="medical_requirements" id="medical_requirements" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="confirmSelection()">Book Ambulance</button>
    </div>
</div>
<script>
     document.querySelector('.btn-primary').addEventListener('click', confirmSelection);
     </script> 
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
        var status = document.getElementById('status').value;
        var awayScore = document.getElementById('awayScore').value;
        var homeScore = document.getElementById('homeScore').value;

        if (awayScore == 0 && homeScore == 0 && status === 'FINAL') {
            // Show a confirmation dialog
            if (confirm("You have entered a FINAL SCORE of 0-0. If this is correct, click OK. If not, click Cancel and update the Status / Score.")) {
                // User confirmed, proceed with form submission
                return true;
            } else {
                // User canceled, prevent form submission
                return false;
            }
        } else {
            // No special conditions, allow form submission
            return true;
        }
    }
    function calculateDistance(origin, destination) {
        return (google.maps.geometry.spherical.computeDistanceBetween(origin, destination) / 1000).toFixed(2); // Convert meters to kilometers
    }

    function calculateDuration(distance) {
        // Assume average ambulance speed of 60 km/h
        return Math.round((distance / 100) * 60); // Convert hours to minutes
    }

    function calculateAndDisplayRoute(origin, destination) {
        directionsService.route(
            {
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING'
            },
            function(response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            }
        );
    }
</script>



<!-- Include the Google Maps API script here -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAPS_API_KEY')); ?>&callback=initMap" async defer></script>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/booking.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/ambulance/booking.blade.php ENDPATH**/ ?>