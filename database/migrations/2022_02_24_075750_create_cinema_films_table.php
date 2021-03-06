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
        Schema::create('cinema_films', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cinema_id");
            $table->unsignedBigInteger("film_id");
            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas');
            $table->foreign('film_id')
                ->references('id')
                ->on('films');
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
        Schema::dropIfExists('cinema_films');
    }
};
