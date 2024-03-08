<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\GeocodingService;
use App\Models\Notification;




class BookingController extends Controller
{
    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'hospital_latitude' => 'required|numeric',
            'hospital_longitude' => 'required|numeric',
            'medical_requirements' => 'nullable|string',
        ]);
    
        // Reverse geocode pickup location
        $pickupLocation = $this->geocodingService->reverseGeocode($validatedData['pickup_latitude'], $validatedData['pickup_longitude']);
    
        // Reverse geocode hospital location
        $hospitalLocation = $this->geocodingService->reverseGeocode($validatedData['hospital_latitude'], $validatedData['hospital_longitude']);
    
        // Create a new Booking instance
        $booking = new Booking();
        $booking->user_id = auth()->id(); // Assuming the user is authenticated
        $booking->pickup_latitude = $validatedData['pickup_latitude'];
        $booking->pickup_longitude = $validatedData['pickup_longitude'];
        $booking->pickup_location = $pickupLocation;
        $booking->hospital_latitude = $validatedData['hospital_latitude'];
        $booking->hospital_longitude = $validatedData['hospital_longitude'];
        $booking->hospital_location = $hospitalLocation;
        $booking->medical_requirements = $validatedData['medical_requirements'];
        $booking->status = 'pending'; // Set default status to 'pending'
    
        // Save the booking
        $booking->save();
    
        // After successfully booking, create and save the notification
        $message = "Booking received from {$pickupLocation} to {$hospitalLocation}.";
        $notification = new Notification();
        $notification->user_id = auth()->id();
        $notification->message = $message;
        $notification->save();
    
        // Return a response
        return response()->json(['message' => 'Booking saved successfully'], 200);
    }
}
