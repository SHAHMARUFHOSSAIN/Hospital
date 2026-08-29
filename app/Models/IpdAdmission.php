<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpdAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no',
        'patient_id',
        'cabin_id',
        'attending_doctor_id',
        'admission_date',
        'discharge_date',
        'status',
        'daily_rent',
        'total_bill_amount',
        'discharge_summary',
        'notes',
    ];

    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
        'daily_rent' => 'decimal:2',
        'total_bill_amount' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function cabin()
    {
        return $this->belongsTo(Cabin::class, 'cabin_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Director::class, 'attending_doctor_id');
    }
}
