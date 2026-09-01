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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('logo')->nullable();

            $table->string('pais');
            $table->string('moneda')->default('MXN');

            $table->string('telefono');
            $table->text('descripcion')->nullable();

            $table->string('codigo_postal', 10);
            $table->string('estado');
            $table->string('municipio');
            $table->string('colonia');

            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};