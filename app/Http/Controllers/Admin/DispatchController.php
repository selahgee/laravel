<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Driver;

class DispatchController extends Controller
{
    public function dispatchDriver(Request $request)
    {
        // Validate the request
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            // Add other necessary validation rules
        ]);

        // Get the user's location from the request
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        // Query to find the closest available driver
        $closestDriver = Driver::selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance')
            ->orderBy('distance')
            ->first([$userLatitude, $userLongitude, $userLatitude]);

        if ($closestDriver) {
            // Update the booking status to 'completed' or mark it as dispatched
            Booking::where('status', 'pending')
                ->update(['status' => 'completed', 'driver_id' => $closestDriver->id]);

            // Calculate time and distance (dummy values for demonstration)
            $estimatedTime = '30 minutes';
            $estimatedDistance = '5 kilometers';

            // Construct confirmation message
            $confirmationMessage = "Driver Details:\n";
            $confirmationMessage .= "Name: {$closestDriver->name}\n";
            $confirmationMessage .= "Email: {$closestDriver->email}\n";
            $confirmationMessage .= "Phone: {$closestDriver->phone}\n";
            $confirmationMessage .= "Estimated Time: $estimatedTime\n";
            $confirmationMessage .= "Estimated Distance: $estimatedDistance\n";

            // Send confirmation receipt as a notification
            auth()->user()->notify(new DispatchConfirmation($confirmationMessage));

            // Return a response (you can customize the response as needed)
            return response()->json(['success' => true, 'message' => 'Driver dispatched successfully']);
        } else {
            // Handle the case when no available drivers are found
            return response()->json(['success' => false, 'message' => 'No available drivers']);
        }
    }
}
