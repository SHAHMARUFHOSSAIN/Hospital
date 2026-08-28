<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBank extends Model
{
    protected $fillable = [
        'blood_group',
        'units_available',
        'last_updated',
        'contact_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'units_available' => 'integer',
    ];
}
