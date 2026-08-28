<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MedicalEquipment extends Model
{
    use HasFactory;

    protected $table = 'medical_equipments';

    protected $fillable = [
        'name',
        'model_name',
        'manufacturer',
        'country_of_origin',
        'department_name',
        'scan_fee',
        'description',
        'features',
        'specifications',
        'image',
        'gallery_images',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'scan_fee' => 'decimal:2',
        'gallery_images' => 'array',
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

        return 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80';
    }

    public function getGalleryUrlsAttribute(): array
    {
        $gallery = $this->gallery_images;
        if (empty($gallery) || !is_array($gallery)) {
            return [];
        }

        return array_map(function ($img) {
            if (Str::startsWith($img, ['http://', 'https://'])) {
                return $img;
            }
            $path = Str::replaceFirst('storage/', '', ltrim($img, '/'));
            if (file_exists(storage_path('app/public/' . $path))) {
                return asset('storage/' . $path);
            }
            return 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80';
        }, $gallery);
    }
}
