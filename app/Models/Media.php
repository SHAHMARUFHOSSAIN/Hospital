<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'title',
        'type',
        'file_path',
        'url',
        'alt',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->url) && Str::startsWith($this->url, ['http://', 'https://'])) {
            return $this->url;
        }

        if (!empty($this->file_path)) {
            $path = Str::replaceFirst('storage/', '', ltrim($this->file_path, '/'));
            return url('uploads/' . $path);
        }

        if ($this->type === 'brand') {
            return 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=300&q=80';
        }

        return 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80';
    }
}