<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    protected $table = 'career_jobs';
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'type',
        'salary',
        'deadline',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function isExpired(): bool
    {
        return $this->deadline && $this->deadline->isPast();
    }
}