<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'branch_id',
        'estado',
        'problema_reportado',
        'solucion',
        'revisado_anteriormente',
        'fecha_reparacion_programada',
        'fecha_entrega_prometida',
        'hora_entrega_prometida',
        'tiene_garantia',
        'costo_total',
        'anticipo',
        'firma',
    ];

    protected function casts(): array
    {
        return [
            'revisado_anteriormente' => 'boolean',
            'tiene_garantia' => 'boolean',
            'fecha_reparacion_programada' => 'date',
            'fecha_entrega_prometida' => 'date',
            'costo_total' => 'decimal:2',
            'anticipo' => 'decimal:2',
        ];
    }

    /**
     * Cliente de la orden.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Sucursal / locación de la orden.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Dispositivo asociado a la orden.
     */
    public function device(): HasOne
    {
        return $this->hasOne(Device::class);
    }
}