<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'product_id',
        'cantidad',
        'codigo_barras',
        'estatus',
        'usuario_registro_id',
        'usuario_aprobo_id',
        'fecha_aprobacion',
    ];

    protected function casts(): array
    {
        return [
            'cantidad' => 'decimal:2',
            'fecha_aprobacion' => 'datetime',
        ];
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function usuarioRegistro(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_registro_id');
    }

    public function usuarioAprobo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_aprobo_id');
    }
}