<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Director extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'designation',
        'degree',
        'specialization',
        'experience_years',
        'consultation_fee',
        'chamber_days',
        'chamber_time',
        'room_no',
        'photo',
        'bio',
        'facebook',
        'linkedin',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'experience_years' => 'integer',
        'consultation_fee' => 'decimal:2',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (!empty($this->photo) && Str::startsWith($this->photo, ['http://', 'https://'])) {
            return $this->photo;
        }

        if (!empty($this->photo)) {
            $cleanPath = ltrim(Str::replaceFirst('storage/', '', $this->photo), '/');
            if (file_exists(public_path('uploads/' . $cleanPath))) {
                return asset('uploads/' . $cleanPath);
            }
            if (file_exists(storage_path('app/public/' . $cleanPath))) {
                return asset('storage/' . $cleanPath);
            }
        }

        return 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80';
    }
}