<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('id_pustaka');
            $table->timestamps();
            
            $table->foreign('id_pustaka')
                  ->references('id_pustaka')
                  ->on('tbl_pustaka')
                  ->onDelete('cascade');
                  
            $table->unique(['user_id', 'id_pustaka']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_favorites');
    }
};