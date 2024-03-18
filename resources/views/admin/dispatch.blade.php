@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dispatch Driver</h1>
    <form id="dispatchForm" method="POST">
        @csrf
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="longitude" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="dispatchDriver()">Dispatch Driver</button>
    </form>
</div>

<script>
        function dispatchDriver() {
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude').value;
    
            // AJAX request to dispatch the driver
            $.ajax({
                url: "{{ route('admin.dispatch.driver') }}",
                type: "POST", 
                data: {
                    "_token": "{{ csrf_token() }}",
                    "latitude": latitude,
                    "longitude": longitude
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('An error occurred while dispatching the driver. Please try again.');
                }
            });
        }
    </script>
@endsection
