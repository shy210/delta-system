<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // Datos existentes
        'codigo',
        'nombre',
        'categoria',
        'marca',
        'descripcion',

        // Relaciones de Inventario
        'supplier_id',
        'category_id',
        'subcategory_id',
        'sucursal_id',

        // Datos generales
        'descripcion_corta',
        'tipo_venta',
        'referencia',
        'aplica_descuento',
        'descripcion_larga',

        // Precios existentes
        'precio_publico',
        'precio_mayoreo',
        'precio_tecnicos',
        'costo_compra',

        // Precios de Inventario
        'ganancia_porcentaje',
        'precio_2',
        'precio_3',
        'precio_4',
        'precio_5',
        'precio_6',

        // Inventario
        'stock',
        'stock_minimo',
        'stock_maximo',
        'maneja_series',

        // Estado
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'precio_publico' => 'decimal:2',
            'precio_mayoreo' => 'decimal:2',
            'precio_tecnicos' => 'decimal:2',
            'costo_compra' => 'decimal:2',

            'ganancia_porcentaje' => 'decimal:2',
            'precio_2' => 'decimal:2',
            'precio_3' => 'decimal:2',
            'precio_4' => 'decimal:2',
            'precio_5' => 'decimal:2',
            'precio_6' => 'decimal:2',

            'stock' => 'decimal:2',
            'stock_minimo' => 'decimal:2',
            'stock_maximo' => 'decimal:2',

            'aplica_descuento' => 'boolean',
            'maneja_series' => 'boolean',
            'activo' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function categoriaRelacion(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'sucursal_id');
    }

    public function series(): HasMany
{
    return $this->hasMany(ProductSeries::class, 'product_id');
}

public function combos(): HasMany
{
    return $this->hasMany(
        ServiceComboProduct::class,
        'product_id'
    );
}
}