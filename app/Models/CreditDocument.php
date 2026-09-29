<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'credit_application_id',
        'tipo_documento',
        'archivo',
        'estado',
        'observaciones',
    ];

    /**
     * Solicitud de crédito relacionada.
     */
    public function creditApplication(): BelongsTo
    {
        return $this->belongsTo(CreditApplication::class);
    }
}