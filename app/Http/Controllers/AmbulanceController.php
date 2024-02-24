<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Spatie\Geocoder\Facades\Geocoder; // Import the Geocoder facade

class AmbulanceController extends Controller
{
    public function showBookingForm()
    {
        return view('ambulance.booking');
    }

    public function bookAmbulance(Request $request)
    {
        // Validate request data
        $request->validate([
            'pickup_location' => 'required',
            // Add more validation rules as per your requirements
        ]);

        // Geocode the pickup location to get latitude and longitude
        $geocodingResult = Geocoder::setApiKey(env('GOOGLE_MAPS_API_KEY'))
            ->getCoordinatesForAddress($request->pickup_location);

        // Check if geocoding was successful
        if ($geocodingResult['lat'] && $geocodingResult['lng']) {
            $pickup_latitude = $geocodingResult['lat'];
            $pickup_longitude = $geocodingResult['lng'];
        } else {
            // If geocoding fails, handle the error (e.g., display error message to user)
            return redirect()->back()->with('error', 'Failed to geocode pickup location');
        }

        // Retrieve destination latitude and longitude from the request
        $destination_latitude = $request->destination_latitude;
        $destination_longitude = $request->destination_longitude;

        // Create a new booking record
        Booking::create([
            
            'pickup_location' => $request->pickup_location,
            'pickup_latitude' => $pickup_latitude,
            'pickup_longitude' => $pickup_longitude,
            'destination_latitude' => $destination_latitude,
            'destination_longitude' => $destination_longitude,
            'hospital' => $request->hospital,
            'medical_requirements' => $request->medical_requirements,
            'pickup_time' => $request->pickup_time,
            // Add more fields as needed
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ambulance booked successfully!');
    }
}
