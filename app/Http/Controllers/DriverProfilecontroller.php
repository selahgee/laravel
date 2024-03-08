<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('driver.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Add other fields as needed
        $user->save();

        $driver = $user->driver; // Assuming you have a one-to-one relationship defined between User and Driver models

        if ($driver) {
            $driver->current_location = $request->input('current_location');
            $driver->status = $request->input('status');
            // Add other fields as needed
            $driver->save();
        }

        return redirect()->route('driver.profile')->with('success', 'Profile updated successfully.');
    }
}
