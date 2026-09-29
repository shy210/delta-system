<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'customer_id',
        'user_id',
        'tipo_precio',
        'fecha_creacion',
        'fecha_vencimiento',
        'estado',
        'subtotal',
        'descuento_total',
        'total',
        'notas',
    ];

    protected function casts(): array
    {
        return [
            'fecha_creacion' => 'date',
            'fecha_vencimiento' => 'date',
            'subtotal' => 'decimal:2',
            'descuento_total' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}