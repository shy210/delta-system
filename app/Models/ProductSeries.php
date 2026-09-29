<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sucursal_id',
        'serie',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'sucursal_id');
    }
}