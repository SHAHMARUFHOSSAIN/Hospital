<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_no',
        'patient_id',
        'test_name',
        'category',
        'parameters',
        'status',
        'impression',
        'referred_by',
        'report_date',
    ];

    protected $casts = [
        'parameters' => 'array',
        'report_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function generateReportNo(): string
    {
        $last = self::latest('id')->first();
        $next = $last ? $last->id + 1 : 1;
        return 'LAB-' . date('Y') . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
