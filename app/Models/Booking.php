<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_latitude',
        'pickup_longitude',
        'pickup_location',
        'hospital_latitude',
        'hospital_longitude',
        'hospital_location',
        'medical_requirements',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
