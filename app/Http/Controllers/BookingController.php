<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function save(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'medical_requirements' => 'nullable|string',
        ]);

        // Save booking to database
        Booking::create($validatedData);

        return response()->json(['message' => 'Booking saved successfully']);
    }
    
}
