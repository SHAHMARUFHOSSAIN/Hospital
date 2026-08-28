<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'head_of_dept',
        'opd_hours',
        'emergency_contact',
        'bed_info',
        'description',
        'image',
        'logo',
        'images',
        'video_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }

    public function showrooms(): HasMany
    {
        return $this->hasMany(Showroom::class);
    }

    public function getFeaturedProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('is_featured', true);
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

    public function getMedicalIconAttribute(): string
    {
        $name = strtolower($this->name . ' ' . $this->slug);
        if (Str::contains($name, ['cardio', 'heart'])) return 'fa-heart-pulse';
        if (Str::contains($name, ['neuro', 'brain'])) return 'fa-brain';
        if (Str::contains($name, ['pedia', 'child', 'baby'])) return 'fa-baby';
        if (Str::contains($name, ['ortho', 'bone', 'joint'])) return 'fa-bone';
        if (Str::contains($name, ['onco', 'cancer', 'chemo'])) return 'fa-ribbon';
        if (Str::contains($name, ['mater', 'gynae', 'women', 'mother'])) return 'fa-person-breastfeeding';
        if (Str::contains($name, ['nephro', 'kidney', 'dialysis'])) return 'fa-notes-medical';
        if (Str::contains($name, ['radio', 'imaging', 'xray', 'ct', 'mri'])) return 'fa-x-ray';
        if (Str::contains($name, ['emerg', 'trauma', 'icu'])) return 'fa-truck-medical';
        if (Str::contains($name, ['surg', 'ot', 'operat'])) return 'fa-user-nurse';
        if (Str::contains($name, ['dental', 'tooth'])) return 'fa-tooth';
        if (Str::contains($name, ['eye', 'vision', 'opht'])) return 'fa-eye';
        if (Str::contains($name, ['patho', 'lab', 'blood', 'test'])) return 'fa-vial';
        return 'fa-stethoscope';
    }

    public function getMedicalThemeAttribute(): array
    {
        $name = strtolower($this->name . ' ' . $this->slug);
        if (Str::contains($name, ['cardio', 'heart'])) {
            return ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100', 'hover_bg' => 'group-hover:bg-rose-600'];
        }
        if (Str::contains($name, ['neuro', 'brain'])) {
            return ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100', 'hover_bg' => 'group-hover:bg-indigo-600'];
        }
        if (Str::contains($name, ['pedia', 'child', 'baby'])) {
            return ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'hover_bg' => 'group-hover:bg-amber-600'];
        }
        if (Str::contains($name, ['ortho', 'bone', 'joint'])) {
            return ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'hover_bg' => 'group-hover:bg-emerald-600'];
        }
        if (Str::contains($name, ['onco', 'cancer', 'chemo'])) {
            return ['bg' => 'bg-fuchsia-50', 'text' => 'text-fuchsia-600', 'border' => 'border-fuchsia-100', 'hover_bg' => 'group-hover:bg-fuchsia-600'];
        }
        if (Str::contains($name, ['emerg', 'trauma', 'icu'])) {
            return ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-100', 'hover_bg' => 'group-hover:bg-red-600'];
        }
        return ['bg' => 'bg-sky-50', 'text' => 'text-[#0284C7]', 'border' => 'border-sky-100', 'hover_bg' => 'group-hover:bg-[#0284C7]'];
    }
}