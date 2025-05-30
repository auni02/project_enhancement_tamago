<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('risks', function (Blueprint $table) {
            $table->string('review_state')->default('New')->after('reported_date');
        });
    }

    public function down()
    {
        Schema::table('risks', function (Blueprint $table) {
            $table->dropColumn('review_state');
        });
    }
};
