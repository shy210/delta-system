
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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();

            // Cotización relacionada
            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->cascadeOnDelete();

            // Tipo de artículo
            $table->enum('tipo', [
                'producto',
                'servicio',
                'manual'
            ]);

            // Referencias opcionales a productos y servicios
            // Se dejan sin relación por ahora hasta revisar
            // los modelos existentes del sistema.
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();

            // Nombre guardado como historial de la cotización
            $table->string('nombre');

            // Información del artículo
            $table->text('descripcion')->nullable();

            $table->decimal('cantidad', 10, 2)->default(1);
            $table->decimal('precio_unitario', 12, 2)->default(0);
            $table->decimal('descuento', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};