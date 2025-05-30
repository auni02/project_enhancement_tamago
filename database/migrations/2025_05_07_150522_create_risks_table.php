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
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who reported
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Link to company
            $table->string('category'); // operational, technical, cybersecurity
            $table->string('risk_detail');
            $table->text('problem_description');
            $table->date('reported_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};
