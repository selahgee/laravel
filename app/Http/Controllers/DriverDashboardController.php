<?php

// app/Http/Controllers/DriverDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;

class DriverDashboardController extends Controller
{
    public function index()
    {
        // Retrieve bookings for the authenticated user based on their role
        $userRole = Auth::user()->role;
        $userId = Auth::id();
    
        if ($userRole === 'driver') {
            // If the authenticated user is a driver, retrieve bookings based on user_id
            $bookings = Booking::where('user_id', $userId)->get();
        } else {
            // An empty collection for non-driver roles           
            $bookings = collect();
        }
    
        return view('driver.dashboard.index', compact('bookings'));
    }

    public function acceptBooking(Request $request, $bookingId)
    {
        // Logic to accept the booking
        // Update the booking status or perform necessary actions

        return redirect()->route('driver.dashboard')->with('success', 'Booking accepted successfully.');
    }

    public function declineBooking(Request $request, $bookingId)
    {
        // Logic to decline the booking
        // Update the booking status or perform necessary actions

        return redirect()->route('driver.dashboard')->with('error', 'Booking declined.');
    }
}

