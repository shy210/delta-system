<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Datos generales
            $table->foreignId('supplier_id')
                ->nullable()
                ->after('nombre')
                ->constrained('suppliers')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->after('supplier_id')
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->after('category_id')
                ->constrained('categories')
                ->nullOnDelete();

            $table->text('descripcion_corta')
                ->nullable()
                ->after('descripcion');

            $table->enum('tipo_venta', ['unidad', 'kilogramo', 'metro'])
                ->default('unidad')
                ->after('descripcion_corta');

            $table->string('referencia')
                ->nullable()
                ->after('tipo_venta');

            $table->foreignId('sucursal_id')
                ->nullable()
                ->after('referencia')
                ->constrained('branches')
                ->nullOnDelete();

            $table->boolean('aplica_descuento')
                ->default(false)
                ->after('sucursal_id');

            $table->text('descripcion_larga')
                ->nullable()
                ->after('aplica_descuento');

            // Inventario
            $table->boolean('maneja_series')
                ->default(false)
                ->after('stock_minimo');

            $table->decimal('stock_maximo', 10, 2)
                ->default(0)
                ->after('maneja_series');

            // Precios adicionales
            $table->decimal('ganancia_porcentaje', 8, 2)
                ->default(0)
                ->after('costo_compra');

            $table->decimal('precio_2', 12, 2)
                ->nullable()
                ->after('precio_publico');

            $table->decimal('precio_3', 12, 2)
                ->nullable()
                ->after('precio_2');

            $table->decimal('precio_4', 12, 2)
                ->nullable()
                ->after('precio_3');

            $table->decimal('precio_5', 12, 2)
                ->nullable()
                ->after('precio_4');

            $table->decimal('precio_6', 12, 2)
                ->nullable()
                ->after('precio_5');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['subcategory_id']);
            $table->dropForeign(['sucursal_id']);

            $table->dropColumn([
                'supplier_id',
                'category_id',
                'subcategory_id',
                'descripcion_corta',
                'tipo_venta',
                'referencia',
                'sucursal_id',
                'aplica_descuento',
                'descripcion_larga',
                'maneja_series',
                'stock_maximo',
                'ganancia_porcentaje',
                'precio_2',
                'precio_3',
                'precio_4',
                'precio_5',
                'precio_6',
            ]);
        });
    }
};