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
        Schema::create('customers', function (Blueprint $table) {

            $table->id();

            // Relación con la cuenta de usuario
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Datos personales
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('telefono', 20);
            $table->string('pais', 100);
            $table->string('whatsapp', 20);
            $table->string('correo');
            $table->string('contacto_alternativo')->nullable();
            $table->date('fecha_nacimiento');

            // Domicilio
            $table->string('codigo_postal', 10);
            $table->string('estado', 100);
            $table->string('municipio', 100);
            $table->string('colonia', 150);
            $table->string('calle');
            $table->string('numero_exterior', 20);
            $table->string('numero_interior', 20)->nullable();

            // Datos fiscales y comerciales
            $table->decimal('precio_publico', 10, 2);
            $table->string('tipo_identificacion', 100);
            $table->string('razon_social');
            $table->string('regimen_fiscal', 150);
            $table->string('empresa');

            $table->timestamps();
        });
    }

    /**
     * Revertir las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};