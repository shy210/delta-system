<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'pais',
        'whatsapp',
        'correo',
        'contacto_alternativo',
        'fecha_nacimiento',
        'codigo_postal',
        'estado',
        'municipio',
        'colonia',
        'calle',
        'numero_exterior',
        'numero_interior',
        'precio',
        'tipo_identificacion',
        'razon_social',
        'regimen_fiscal',
        'empresa',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
        ];
    }

    /**
     * Usuario relacionado con el cliente.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Órdenes de servicio del cliente.
     */
    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }

    /**
     * Solicitudes de crédito del cliente.
     */
    public function creditApplications(): HasMany
    {
        return $this->hasMany(CreditApplication::class);
    }
}