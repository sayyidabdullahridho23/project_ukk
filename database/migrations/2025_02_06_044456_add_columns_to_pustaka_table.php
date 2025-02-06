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
        Schema::table('tbl_pustaka', function (Blueprint $table) {
            $table->string('kondisi_rusak')->nullable()->after('denda_hilang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pustaka', function (Blueprint $table) {
            $table->dropColumn(['denda_hilang', 'kondisi_rusak']);
        });
    }
};
