<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_adjustments', function (Blueprint $table) {
            $table->id();

            $table->enum('tipo', ['entrada', 'salida']);

            $table->text('descripcion')->nullable();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->decimal('cantidad', 10, 2);

            $table->string('codigo_barras')->nullable();

            $table->enum('estatus', [
                'pendiente',
                'aprobado',
                'rechazado'
            ])->default('pendiente');

            $table->foreignId('usuario_registro_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('usuario_aprobo_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('fecha_aprobacion')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_adjustments');
    }
};