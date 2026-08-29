<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'phone',
        'email',
        'age',
        'gender',
        'blood_group',
        'address',
        'medical_history',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class)->latest();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class)->latest();
    }

    public function labReports()
    {
        return $this->hasMany(LabReport::class)->latest();
    }

    public static function generatePatientId(): string
    {
        $last = self::latest('id')->first();
        $next = $last ? $last->id + 1 : 1;
        return 'PAT-' . date('Y') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
