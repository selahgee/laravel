<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use GuzzleHttp\Client;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $driver = Driver::where('user_id', $user->id)->first(); // Fetch the driver record
        return view('driver.CRUD.index', compact('user', 'driver')); // Pass the driver to the view
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_number' => 'required|string',
            'current_location' => 'required|string',            
            'number_plate' => 'required|string',
            'status' => 'required|in:available,not available',
        ]);

        $user = auth()->user();
        
        // Create a new Driver instance
        $driver = new Driver();
        $driver->user_id = $user->id;
        $driver->name = $user->name; // Fetching name from the users table
        $driver->email = $user->email; // Fetching email from the users table
        $driver->contact_number = $request->contact_number;
        $driver->current_location = $request->current_location;       
        $driver->number_plate = $request->number_plate;
        $driver->status = $request->status;
        $driver->save();

        return redirect()->route('driver.CRUD.index')->with('success', 'Driver created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'contact_number' => 'required|string',
        'current_location' => 'required|string',
        'number_plate' => 'required|string',
        'status' => 'required|in:available,not available',
    ]);

    // Get the location from the request
    $location = $request->input('current_location');

    // Geocode the provided address using Google Maps Geocoding API
    $apiKey = env('GOOGLE_MAPS_API_KEY');
    $client = new Client();
    $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', [
        'query' => [
            'address' => $location,
            'key' => $apiKey,
        ],
    ]);

    $body = $response->getBody();
    $data = json_decode($body, true);

    // Check if the geocoding was successful and extract the latitude and longitude
    if ($data['status'] === 'OK' && isset($data['results'][0]['geometry']['location'])) {
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];

        // Update the driver's information in the database
        $driver = Driver::findOrFail($id);
        $driver->name = $request->input('name');
        $driver->email = $request->input('email');
        $driver->contact_number = $request->input('contact_number');
        $driver->current_location = $location;
        $driver->current_latitude = $latitude; // Update current latitude
        $driver->current_longitude = $longitude; // Update current longitude
        $driver->number_plate = $request->input('number_plate');
        $driver->status = $request->input('status');
        $driver->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    } else {
        // Redirect back with error message if geocoding fails
        return redirect()->back()->with('error', 'Failed to geocode the provided address.');
    }
}


    public function destroy(string $id)
    {
        //
    }
}
