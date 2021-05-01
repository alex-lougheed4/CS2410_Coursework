<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('petSpecies');
            $table->string('petBreed');
            $table->string('petSex');
            $table->string('petDOB');
            $table->string('petName');
            $table->string('petStatus');
            $table->string('description',256) ->nullable();
            $table->string('image',256)->nullable();
            $table->bigInteger('petOwner')->unsigned()->nullable();
            $table->foreign('petOwner')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
