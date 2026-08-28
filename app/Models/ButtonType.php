<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ButtonType extends Model
{
    protected $fillable = [
        'name',
        'variant',
        'description',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function variants(): array
    {
        return [
            'emergency' => '24/7 Emergency & Trauma Center',
            'icu' => 'ICU & Critical Intensive Care',
            'surgery' => 'Robotic & Modular Surgical Suite',
            'cathlab' => 'Interventional Cath Lab',
            'pediatric' => 'Pediatric & NICU/PICU Division',
            'diagnostics' => '3.0T MRI & Advanced Diagnostics',
        ];
    }

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

        return 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80';
    }
}
