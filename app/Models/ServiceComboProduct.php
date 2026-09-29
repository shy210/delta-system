<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceComboProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_combo_id',
        'product_id',
        'cantidad',
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',
        ];
    }

    public function combo(): BelongsTo
    {
        return $this->belongsTo(
            ServiceCombo::class,
            'service_combo_id'
        );
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }
}