<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}