<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('petID')->unsigned();
            $table->foreign('petID')->references('id')->on('animals');
            $table->bigInteger('requesterUserID')->unsigned();
            $table->foreign('requesterUserID')->references('id')->on('users');
            $table->string('adoptionStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
