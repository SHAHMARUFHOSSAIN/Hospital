<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $table = 'career_applications';
    
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'address',
        'cv_path',
        'cover_letter',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function getCvUrlAttribute(): string
    {
        if (empty($this->cv_path)) {
            return '#';
        }
        $cleanPath = ltrim(str_replace('storage/', '', $this->cv_path), '/');
        return url('uploads/' . $cleanPath);
    }
}