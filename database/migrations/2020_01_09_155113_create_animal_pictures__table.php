<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('picture_url');
            $table->unsignedBigInteger('id_animal');
            $table->timestamps();
        });
        Schema::table('animal_pictures', function($table) {
            $table->foreign('id_animal')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_pictures');
    }
}
