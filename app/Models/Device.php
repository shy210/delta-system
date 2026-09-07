<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    protected $fillable = [
        'service_order_id',
        'tipo_equipo',
        'imei_numero_serie',
        'marca',
        'modelo',
        'color',
        'tipo_bloqueo',
        'dato_bloqueo',
        'tamano_patron',
        'condiciones_equipo',
        'accesorios_entregados',
        'estado_general',
        'observaciones',
    ];

    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}