<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('precio_publico', 'precio');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->string('precio', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('precio', 'precio_publico');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->decimal('precio_publico', 10, 2)->change();
        });
    }
};