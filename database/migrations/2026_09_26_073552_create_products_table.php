<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Identificación
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->string('categoria')->nullable();
            $table->string('marca')->nullable();

            // Descripción
            $table->text('descripcion')->nullable();

            // Precios
            $table->decimal('precio_publico', 12, 2)->default(0);
            $table->decimal('precio_mayoreo', 12, 2)->default(0);
            $table->decimal('precio_tecnicos', 12, 2)->default(0);
            $table->decimal('costo_compra', 12, 2)->default(0);

            // Inventario
            $table->decimal('stock', 10, 2)->default(0);
            $table->decimal('stock_minimo', 10, 2)->default(0);

            // Estado
            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};