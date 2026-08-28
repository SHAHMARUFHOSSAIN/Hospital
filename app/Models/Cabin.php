<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cabin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_type',
        'floor_no',
        'bed_count',
        'oxygen_type',
        'rent_per_day',
        'amenities',
        'description',
        'image',
        'is_available',
        'is_active',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_active' => 'boolean',
        'rent_per_day' => 'decimal:2',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image) && Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (!empty($this->image)) {
            $path = Str::replaceFirst('storage/', '', ltrim($this->image, '/'));
            if (file_exists(storage_path('app/public/' . $path))) {
                return asset('storage/' . $path);
            }
        }

        return 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80';
    }
}
