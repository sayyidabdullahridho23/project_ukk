<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToTblRak extends Migration
{
    public function up()
    {
        Schema::table('tbl_rak', function (Blueprint $table) {
            $table->timestamps(); // Ini akan menambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::table('tbl_rak', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}