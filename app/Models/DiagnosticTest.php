<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category_name',
        'price',
        'description',
        'preparation_instructions',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Accessor aliases for seamless template compatibility
    public function getPriceBdtAttribute()
    {
        return $this->attributes['price'] ?? 0;
    }

    public function getDepartmentAttribute()
    {
        return $this->attributes['category_name'] ?? 'General Pathology';
    }

    public function getPreparationInfoAttribute()
    {
        return $this->attributes['preparation_instructions'] ?? '';
    }
}
