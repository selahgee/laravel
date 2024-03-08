@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Driver Dashboard</h1>

        <div class="bookings">
            <h2>My Bookings</h2>

            @if($bookings->isEmpty())
                <p>No bookings available.</p>
            @else
                @foreach($bookings as $booking)
                    <div class="booking">
                        <h3>Booking ID: {{ $booking->id }}</h3>
                        <p>Status: {{ ucfirst($booking->status) }}</p>
                        <p>Pickup Location: {{ $booking->pickup_location }}</p>
                        <p>Hospital Location: {{ $booking->hospital_location }}</p>
                        <!-- Add more information here as needed -->
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('css/driverD.css') }}">
@endpush