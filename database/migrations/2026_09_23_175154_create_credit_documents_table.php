<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_documents', function (Blueprint $table) {
            $table->id();

            // Solicitud de crédito relacionada
            $table->foreignId('credit_application_id')
                ->constrained('credit_applications')
                ->cascadeOnDelete();

            // Tipo de documento
            $table->string('tipo_documento');

            // Ruta del archivo almacenado
            $table->string('archivo');

            // Estado de revisión
            $table->string('estado')
                ->default('pendiente');

            // Observaciones de revisión
            $table->text('observaciones')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_documents');
    }
};