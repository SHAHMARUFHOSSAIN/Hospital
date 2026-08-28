<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    protected $fillable = [
        'doctor_id',
        'cabin_id',
        'booking_type', // 'doctor_appointment', 'medical_service', 'cabin_booking'
        'serial_no',
        'appointment_date',
        'name',
        'email',
        'phone',
        'company',
        'message',
        'design_file',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'serial_no' => 'integer',
    ];

    public function doctor()
    {
        return $this->belongsTo(Director::class, 'doctor_id');
    }

    public function cabin()
    {
        return $this->belongsTo(Cabin::class, 'cabin_id');
    }

    public function getBookingTypeLabelAttribute(): string
    {
        return match($this->booking_type) {
            'cabin_booking' => 'Cabin Reservation',
            'medical_service' => 'Medical Service Booking',
            default => 'Doctor Appointment',
        };
    }

    public static function bookingTypes(): array
    {
        return [
            'doctor_appointment' => 'Doctor Appointment',
            'medical_service' => 'Medical Service Booking',
            'cabin_booking' => 'Cabin Reservation',
        ];
    }

    public static function statuses(): array
    {
        return ['new', 'contacted', 'completed', 'rejected'];
    }
}
