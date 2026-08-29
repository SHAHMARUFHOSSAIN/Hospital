<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_name',
        'category',
        'quantity',
        'reorder_level',
        'unit_price',
        'supplier',
        'expiry_date',
        'notes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'unit_price' => 'decimal:2',
        'expiry_date' => 'date',
    ];

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->reorder_level;
    }

    public function isNearExpiry(): bool
    {
        if (!$this->expiry_date) return false;
        return $this->expiry_date->diffInDays(now(), false) >= -30;
    }
}
