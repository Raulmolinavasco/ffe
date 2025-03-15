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
        Schema::create('centro_educativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nif');
            $table->string('email');
            $table->string('telefono');
            $table->string('codigo_centro');
            $table->string('localidad');
            $table->string('provincia');
            $table->string('calle');
            $table->string('codigo_postal');
            $table->string('nombre_director');
            $table->string('apellidos_director');
            $table->string('nif_director');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_educativos');
    }
};
