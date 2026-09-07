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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            // Orden de servicio a la que pertenece el dispositivo
            $table->foreignId('service_order_id')
                ->unique()
                ->constrained('service_orders')
                ->cascadeOnDelete();

            // Información del equipo
            $table->string('tipo_equipo');
            $table->string('imei_numero_serie')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('color')->nullable();

            // Tipo de bloqueo
            $table->string('tipo_bloqueo')->nullable();

            // Datos del bloqueo
            $table->text('dato_bloqueo')->nullable();

            // Tamaño del patrón: 3x3, 4x4, 5x5, etc.
            $table->string('tamano_patron')->nullable();

            // Estado físico
            $table->text('condiciones_equipo')->nullable();
            $table->text('accesorios_entregados')->nullable();
            $table->string('estado_general')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};