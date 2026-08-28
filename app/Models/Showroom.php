<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showroom extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'video_url',
        'address',
        'phone',
        'email',
        'map_embed',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ShowroomImage::class);
    }
}

class ShowroomImage extends Model
{
    protected $fillable = [
        'showroom_id',
        'image',
        'sort_order',
    ];

    protected $table = 'showroom_images';

    public $timestamps = false;

    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class);
    }
}