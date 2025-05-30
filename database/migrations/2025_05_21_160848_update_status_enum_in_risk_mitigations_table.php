<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE risk_mitigations MODIFY status ENUM('Pending', 'Awaiting Approval', 'Completed') DEFAULT 'Pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE risk_mitigations MODIFY status ENUM('Pending', 'Completed') DEFAULT 'Pending'");
    }
};
