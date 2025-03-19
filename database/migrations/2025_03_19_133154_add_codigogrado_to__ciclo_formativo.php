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
        Schema::table('ciclo_formativos', function (Blueprint $table) {
            $table->string('codigo')->nullable();
            $table->string('grado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('_ciclo_formativo', function (Blueprint $table) {
            //
        });
    }
};
