<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name', 'address', 'latitude', 'longitude'];

    public function scopeWithinRadius($query, $latitude, $longitude, $radius)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        return $query->select('name', 'address', 'latitude', 'longitude')
            ->selectRaw("acos(sin(radians(?)) * sin(radians(latitude)) + cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?))) * ? AS distance", [
                $latitude,
                $latitude,
                $longitude,
                $radius / $earthRadius // Adjusted to divide by earth radius
            ])
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
    }
}
