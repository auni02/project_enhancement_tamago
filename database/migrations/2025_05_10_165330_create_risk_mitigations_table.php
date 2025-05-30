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
        Schema::create('risk_mitigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risk_id')->constrained()->onDelete('cascade');
            $table->string('risk_level'); // e.g. Green, Yellow, Red
            $table->text('existing_control')->nullable();
            $table->enum('risk_treatment', ['avoidance', 'mitigation', 'transfer', 'acceptance']);
            $table->text('solution_details')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // staff ID
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->date('date_assigned')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_mitigations');
    }
};
