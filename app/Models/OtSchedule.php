<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'ot_no',
        'patient_id',
        'surgeon_id',
        'operation_type',
        'ot_room',
        'scheduled_datetime',
        'status',
        'anesthetist_name',
        'notes',
    ];

    protected $casts = [
        'scheduled_datetime' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function surgeon()
    {
        return $this->belongsTo(Director::class, 'surgeon_id');
    }
}
