<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Hospital;

class HospitalController extends Controller
{
    /**
     * Show hospitals near the user's location.
     *
     * @return \Illuminate\Http\Response
     */
    public function nearby(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius', 3000); // Set default radius

        $hospitals = Hospital::withinRadius($latitude, $longitude, $radius)
            ->get(['name', 'address', 'latitude', 'longitude']);

        return response()->json($hospitals);
    }
    
}
