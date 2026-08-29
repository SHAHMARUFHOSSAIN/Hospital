<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_no',
        'patient_id',
        'doctor_id',
        'vitals_bp',
        'vitals_pulse',
        'vitals_weight',
        'vitals_temp',
        'chief_complaints',
        'diagnosis',
        'medicines',
        'advised_tests',
        'general_advice',
        'follow_up_date',
    ];

    protected $casts = [
        'medicines' => 'array',
        'follow_up_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Director::class, 'doctor_id');
    }

    public static function generatePrescriptionNo(): string
    {
        $last = self::latest('id')->first();
        $next = $last ? $last->id + 1 : 1;
        return 'RX-' . date('Y') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
