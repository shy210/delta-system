<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_applications', function (Blueprint $table) {
            $table->id();

            // Cliente relacionado
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Estado de la solicitud
            $table->string('estado')
                ->default('pendiente');

            // Datos adicionales
            $table->string('tipo_cliente');

            $table->string('ocupacion_actividad');

            $table->string('telefono_trabajo')
                ->nullable();

            $table->string('referencia_personal')
                ->nullable();

            $table->string('telefono_referencia')
                ->nullable();

            $table->text('observaciones_adicionales')
                ->nullable();

            // Monto requerido
            $table->decimal('cantidad_solicitada', 12, 2);

            $table->string('moneda', 10)
                ->default('MXN');

            $table->string('frecuencia_pago');

            $table->text('observaciones_monto')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_applications');
    }
};