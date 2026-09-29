<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'estado',
        'tipo_cliente',
        'ocupacion_actividad',
        'telefono_trabajo',
        'referencia_personal',
        'telefono_referencia',
        'observaciones_adicionales',
        'cantidad_solicitada',
        'moneda',
        'frecuencia_pago',
        'observaciones_monto',
    ];

    protected function casts(): array
    {
        return [
            'cantidad_solicitada' => 'decimal:2',
        ];
    }

    /**
     * Cliente relacionado con la solicitud de crédito.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Documentos relacionados con la solicitud de crédito.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(CreditDocument::class);
    }
}