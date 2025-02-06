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
        Schema::table('tgl_transaksi', function (Blueprint $table) {
            $table->decimal('denda_rusak', 10, 2)->nullable()->after('reject_reason');
            $table->decimal('denda_hilang', 10, 2)->nullable()->after('denda_rusak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tgl_transaksi', function (Blueprint $table) {
            $table->dropColumn(['denda_rusak', 'denda_hilang']);
        });
    }
};
