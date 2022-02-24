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
        Schema::create('city_cinemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("cinema_id");
            $table->unsignedBigInteger("cities_id");
            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas');
            $table->foreign('cities_id')
                ->references('id')
                ->on('cities');
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
        Schema::dropIfExists('city_cinemas');
    }
};
