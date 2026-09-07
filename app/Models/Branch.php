<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'nombre',
        'logo',
        'pais',
        'moneda',
        'telefono',
        'descripcion',
        'codigo_postal',
        'estado',
        'municipio',
        'colonia',
        'calle',
        'numero_exterior',
        'numero_interior',
    ];

    public function serviceOrders(): HasMany
{
    return $this->hasMany(ServiceOrder::class);
}
}