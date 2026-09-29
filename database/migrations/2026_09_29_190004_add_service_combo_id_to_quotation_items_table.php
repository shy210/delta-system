<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->foreignId('service_combo_id')
                ->nullable()
                ->after('service_id')
                ->constrained('service_combos')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropForeign([
                'service_combo_id',
            ]);

            $table->dropColumn('service_combo_id');
        });
    }
};