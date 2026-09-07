<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar las migraciones.
     */
    public function up(): void
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();

            // Cliente relacionado
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Sucursal / locación donde se recibe el equipo
            $table->foreignId('branch_id')
                ->constrained('branches')
                ->restrictOnDelete();

            // Estado actual de la orden
            $table->string('estado')->default('recibida');

            // Detalles del servicio
            $table->text('problema_reportado');
            $table->text('solucion')->nullable();

            // ¿El equipo fue revisado anteriormente?
            $table->boolean('revisado_anteriormente')->default(false);

            // Fechas y horarios
            $table->date('fecha_reparacion_programada')->nullable();
            $table->date('fecha_entrega_prometida')->nullable();
            $table->time('hora_entrega_prometida')->nullable();

            // Garantía
            $table->boolean('tiene_garantia')->default(false);

            // Información económica
            $table->decimal('costo_total', 10, 2)->default(0);
            $table->decimal('anticipo', 10, 2)->default(0);

            // Firma del cliente
            $table->text('firma')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};