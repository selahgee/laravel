<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public function reverseGeocode($latitude, $longitude)
    {
        $apiKey = config('services.google_maps.api_key');
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
            'latlng' => "{$latitude},{$longitude}",
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['results'][0]['formatted_address'])) {
                return $data['results'][0]['formatted_address'];
            } else {
                // Handle case where formatted address is not available
                return null;
            }
        } else {
            // Handle HTTP request failure
            return null;
        }
    }
}
