<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('risk_mitigations', function (Blueprint $table) {
            $table->text('staff_solution')->nullable(); // staff input
            $table->boolean('admin_approved')->default(false); // for admin approval
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('risk_mitigations', function (Blueprint $table) {
            //
        });
    }
};
