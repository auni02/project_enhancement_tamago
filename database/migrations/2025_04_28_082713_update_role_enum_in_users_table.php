<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateRoleEnumInUsersTable extends Migration
{
    public function up()
    {
        // Modify ENUM to include 'super-admin'
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'staff', 'super-admin') DEFAULT 'staff'");
    }

    public function down()
    {
        // Revert back to original ENUM
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'staff') DEFAULT 'staff'");
    }
}
