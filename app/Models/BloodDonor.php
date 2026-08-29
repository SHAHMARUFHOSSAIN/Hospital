<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'phone',
        'email',
        'blood_group',
        'age',
        'gender',
        'address',
        'last_donated_date',
        'is_eligible',
        'notes',
    ];

    protected $casts = [
        'last_donated_date' => 'date',
        'is_eligible' => 'boolean',
    ];
}
