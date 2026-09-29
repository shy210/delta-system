<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_combos', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();

            $table->decimal('precio_venta', 12, 2)->default(0);
            $table->decimal('costo_total', 12, 2)->default(0);
            $table->decimal('ganancia', 12, 2)->default(0);

            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_combos');
    }
};