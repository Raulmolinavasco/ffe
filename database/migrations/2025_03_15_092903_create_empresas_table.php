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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nif');
            $table->string('localidad');
            $table->string('provincia');
            $table->bigInteger('codigo_postal');
            $table->string('calle');
            $table->string('telefono');
            $table->string('email');
            $table->string('nombre_tutor');
            $table->string('apellidos_tutor');
            $table->string('nif_tutor');
            $table->string('email_tutor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
