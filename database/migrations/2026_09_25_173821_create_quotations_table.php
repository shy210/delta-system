
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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            // Folio de la cotización
            $table->string('folio')->unique();

            // Cliente relacionado
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Vendedor: administrador o empleado
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Datos de la cotización
            $table->enum('tipo_precio', [
                'publico',
                'mayoreo',
                'tecnicos'
            ])->default('publico');

            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento')->nullable();

            // Estado de la cotización
            $table->enum('estado', [
                'borrador',
                'enviada',
                'aprobada',
                'rechazada',
                'vencida'
            ])->default('borrador');

            // Totales
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('descuento_total', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            // Notas adicionales
            $table->text('notas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};