<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censors', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('temperature');
            $table->unsignedBigInteger('heartbeat');
            $table->timestamps();
            $table->foreign('id')->references('id_patient')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('censors');
    }
}
