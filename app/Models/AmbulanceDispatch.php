<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceDispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_no',
        'patient_name',
        'phone',
        'vehicle_no',
        'driver_name',
        'driver_phone',
        'pickup_location',
        'destination',
        'fare_amount',
        'status',
    ];

    protected $casts = [
        'fare_amount' => 'decimal:2',
    ];
}
