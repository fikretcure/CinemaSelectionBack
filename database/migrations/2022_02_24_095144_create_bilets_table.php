<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("city_id");
            $table->unsignedBigInteger("cinema_id");
            $table->unsignedBigInteger("film_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("seat");
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas');
            $table->foreign('film_id')
                ->references('id')
                ->on('films');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bilets');
    }
};
