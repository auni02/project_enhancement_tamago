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
        Schema::create('risk_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risk_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('vulnerability');
            $table->unsignedTinyInteger('impact');
            $table->unsignedTinyInteger('likelihood');
            $table->unsignedInteger('risk_level'); // This is vulnerability × impact × likelihood
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_evaluations');
    }
};
