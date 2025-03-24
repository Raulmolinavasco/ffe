<?php

use App\Models\Plan_formativo;
use App\Models\Ra;
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
        Schema::create('plan_formativo_ra', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan_formativo::class)->index();
            $table->foreignIdFor(Ra::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
